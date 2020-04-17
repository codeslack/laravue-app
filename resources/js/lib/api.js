import axios from "axios";

export function get(url, params) {
    return axios({
        method: "GET",
        url: url,
        params: params
    });
}

export function byMethod(method, url, data) {
    return axios({
        method: method,
        url: url,
        data: data
    });
}

export function errorResponse(err) {
    if (err.response) {
        let hasError = err.response.data;
        let errorInfos = err.response.data.error;
        if (hasError.code === 409) {
            toastr["warning"](hasError.error.error, "Warning");
        } else if (err.response.status === 401 || err.response.status === 422) {
            for (let i in errorInfos) {
                if (errorInfos.hasOwnProperty(i)) {
                    toastr["error"](errorInfos[i], "Error");
                }
            }
        } else {
            toastr["info"](errorInfos, "Info");
        }
    }
}
