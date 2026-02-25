export function apiGetUsers(params = {}) {
  return window.axios.get(window.API_URL + '/users_api', { params });
}

export function apiGetDetailUsers(params = {}) {
  return window.axios.get(window.API_URL + `/manage/users_api`, { params });
}

export function apiReadDetailUser(id) {
  return window.axios.get(window.API_URL + `/manage/users_api/read/${id}`);
}

export function apiCreateUser(data) {
  return window.axios.post(window.API_URL + `/manage/users_api/create`, data);
}

export function apiUpdateUser(id, data) {
  return window.axios.put(window.API_URL + `/manage/users_api/update/${id}`, data);
}

export function apiDeleteUser(id) {
  return window.axios.delete(window.API_URL + `/manage/users_api/delete/${id}`);
}
