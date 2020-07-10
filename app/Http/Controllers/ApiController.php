<?php

namespace App\Http\Controllers;

use App\Model\User;
use Lcobucci\JWT\Parser;
use App\Model\Attachment;
use Laravel\Passport\Token;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Model\AttachmentReply;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\AuthorizationException;

class ApiController extends Controller
{
    use ApiResponser;


    public function __construct()
    {
        $this->middleware('auth:api');
    }

    protected function allowedAdminAction()
    {
        if (Gate::denies('admin-action')) {
            throw new AuthorizationException('This action is unauthorized');
        }
    }

    public function getTokenUser(Request $request)
    {
        $bearerToken = $request->bearerToken();
        $tokenId = (new Parser())->parse($bearerToken)->getHeader('jti');
        $client = Token::find($tokenId)->client;
        $user = User::find($client->user_id);

        if (!$user) {
            throw new AuthorizationException('No User found for Bearer Access Token');
        }

        return $user;
    }

    public function masterUser()
    {
        $user = User::find(1);

        if (!$user) {
            throw new AuthorizationException('This action is unauthorized, try re-login for Access !');
        }

        return $user;
    }

    public function generalUser($userId)
    {
        $user = User::find($userId);

        if (!$user) {
            throw new AuthorizationException('This action is unauthorized, try re-login for Access !');
        }

        return $user;
    }

    public function getUser()
    {
        $user = auth('api')->user();

        if (!$user) {
            throw new AuthorizationException('This action is unauthorized, try re-login for Access !');
        }

        return $user;
    }

    public function appLog($data)
    {
        app('log')->info(json_encode($data));
    }

    public function appEvent($data)
    {
        AttachmentReply::create([
            'user_belong'     => isset($data['user_belong']) ? $data['user_belong'] : $this->getUser()->id,
            'order_id'        => $data['order_id'],
            'status_id'       => isset($data['status_id']) ? $data['status_id'] : 1,
            'message'         => $data['message'],
            'visitor'         => request()->ip()
        ]);
    }

    public function appAttachments(Request $request, $data)
    {
        $files = $request->file('attachments');
        if ($request->hasFile('attachments')) {
            foreach ($files as $file) {
                $filename = $file->store($data['file_path'] . '/' . $data['order_id']);
                Attachment::create([
                    'order_id'    => $data['order_id'],
                    'file_name'   => $filename,
                    'file_type'   => $file->getMimeType(),
                    'file_size'   => $file->getSize()
                ]);
            }
        }
    }
}
