export function apiGetChats(params = {}) {
  return window.axios.get(window.API_URL + '/chats', { params });
}
export function apiCreateChat(chatData) {
  return window.axios.post(window.API_URL + '/chats/create', chatData);
}
export function apiReadChat(chatId) {
  return window.axios.get(window.API_URL + `/chats/read/${chatId}`);
}
export function apiUpdateGroupChat(chatId, chatData) {
  return window.axios.patch(window.API_URL + `/chats/update/${chatId}`, chatData);
}
export function apiDeleteGroupChat(chatId) {
  return window.axios.delete(window.API_URL + `/chats/delete/${chatId}`);
}
export function apiLeaveGroupChat(chatId) {
  return window.axios.post(window.API_URL + `/chats/leave/${chatId}`);
}
export function apiGetChatFile(uri) {
  return window.axios.get(uri, {
    responseType: 'blob',
  });
}
