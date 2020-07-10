<?php

namespace App\Http\Controllers\User;

use App\Model\User;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Hash;


class UserController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        return User::latest()->paginate(10);
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'name'      => 'required|string|max:191',
            'mobile'    => 'required|min:10|max:10|unique:users',
            'email'     => 'required|string|email|max:191|unique:users',
            'password'  => 'required|string|min:8'
        ]);

        return User::create([
            'name' => $request['name'],
            'mobile' => $request['mobile'],
            'email' => $request['email'],
            'type' => $request['type'],
            'bio' => $request['bio'],
            'address' => $request['address'],
            'photo' => $request['photo'] != '' ? $request['photo'] : 'profile.svg',
            'password' => Hash::make($request['password']),
            'admin' => User::REGULAR_USER,
            'verified' => User::UNVERIFIED_USER,
            'verification_token' => User::generateVerificationCode(),
        ]);
    }

    public function updatePhoto(Request $request)
    {
        $user = auth('api')->user();


        $this->validate($request,[
            'image' => 'mimes:jpeg,jpg,png|required|max:500000' // max 10000kb
        ]);


        $currentPhoto = $user->photo;

        if($request->image != $currentPhoto){
            $name = time().'.' . $request->image->getClientOriginalExtension();

            $request->image->move(public_path('img/profile/'), $name);

            $request->merge(['photo' => $name]);

            if ('profile.svg' != $currentPhoto) {
                $userPhoto = public_path('img/profile/').$currentPhoto;
                if(file_exists($userPhoto)){
                    @unlink($userPhoto);
                }
            }

            $this->appLog($name);
        }
        
        $this->appLog($request->image);

        if ($request->has('photo')) {
            $user->photo = $request->photo;
        }


        $user->save();

        return $this->showMessage($user);
    }

    public function updateProfile(Request $request)
    {
        $user = auth('api')->user();


        $this->validate($request,[
            'name'      => 'required|string|max:191',
            'mobile'    => 'required|min:10|max:10|unique:users,mobile,'.$user->id,
            'email'     => 'required|string|email|max:191|unique:users,email,'.$user->id,
            'password'  => 'sometimes|required|min:8'
        ]);


        if ($request->has('name')) {
            $user->name = $request->name;
        }

        if ($request->has('mobile')) {
            $user->mobile = $request->mobile;
        }

        if ($request->has('email') && $user->email != $request->email) {
            $user->verified = User::UNVERIFIED_USER;
            $user->verification_token = User::generateVerificationCode();
            $user->email = $request->email;
        }

        if ($request->has('address')) {
            $user->address = $request->address;
        }

        if ($request->has('bio')) {
            $user->bio = $request->bio;
        }

        if ($request->has('password')) {
            $user->password = Hash::make($request->password);
        }

        if (!$user->isDirty()) {

            return $this->errorResponse('You need to specify a different value to update', 422);
        }

        $user->save();

        return $this->showMessage($user);


        return ['message' => "Success"];
    }

    public function update(Request $request, User $user)
    {
        $this->validate($request,[
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users,email,'.$user->id,
            'password' => 'sometimes|min:8',
            'admin' => 'in:' . User::ADMIN_USER . ',' . User::REGULAR_USER,
        ]);

        if ($request->has('name')) {
            $user->name = $request->name;
        }

        if ($request->has('email') && $user->email != $request->email) {
            $user->verified = User::UNVERIFIED_USER;
            $user->verification_token = User::generateVerificationCode();
            $user->email = $request->email;
        }

        if ($request->has('password')) {
            $user->password = Hash::make($request->password);
        }

        if ($request->has('admin')) {

            $this->allowedAdminAction();

            if (!$user->isVerified()) {

                return $this->errorResponse('Only verified users can modify the admin field',  409);
            }

            $user->admin = $request->admin;
        }

        if (!$user->isDirty()) {

            return $this->errorResponse('You need to specify a different value to update', 422);
        }

        $user->save();

        return $this->showOne($user);
    }

    public function destroy($id)
    {

        $this->authorize('isAdmin');

        $user = User::findOrFail($id);

        $user->delete();

        return ['message' => 'User Deleted'];
    }

    public function verify($token)
    {
        $user = User::where('verification_token', $token)->firstOrFail();

        $user->verified = User::VERIFIED_USER;
        $user->verification_token = null;
        // $user->email_verified_at = null;

        $user->save();

        return $this->showMessage('The account has been verified successfully');
    }

    public function resend(User $user)
    {
        if ($user->isVerified()) {
            return $this->errorResponse('This user is already verified', 409);
        }

        // retry(5, function () use ($user) {
        //     Mail::to($user)->send(new UserCreated($user));
        // }, 100);

        return $this->showMessage('The verification email has been resend');
    }
}
