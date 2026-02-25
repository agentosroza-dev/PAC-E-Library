export async function postSignUp(user) {
    return await window.axios.post(window.API_URL + '/signup', user);
}
export async function postSignIn(user) {
    return await window.axios.post(window.API_URL + '/signin', user);
}
export async function postSignOut(token) {
    return await window.axios.post(window.API_URL + '/signout', null, {
        headers: {
            Authorization: `Bearer ${token}`
        }
    });
}
export async function postRequestResetLink(user) {
    return await window.axios.post(window.API_URL + '/password/forgot', user);
}
export async function patchRefreshToken(token) {
    return await window.axios.patch(window.API_URL + '/token/refresh', null, {
        headers: {
            Authorization: `Bearer ${token}`
        }
    });
}
export async function getVerifyAccount(token) {
    return await window.axios.get(window.API_URL + '/verify/account', {
        headers: {
            Authorization: `Bearer ${token}`
        }
    });
}
export async function patchChangePassword(user) {
    return await window.axios.patch(window.API_URL + '/password/change', user);
}
export async function patchCreatePassword(user) {
    return await window.axios.patch(window.API_URL + '/password/create', user);
}
export async function patchUpdateUserPhoto(photoData) {
    return await window.axios.patch(window.API_URL + '/update/photo', photoData);
}
