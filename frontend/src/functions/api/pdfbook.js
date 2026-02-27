// @func/api/pdfbook.js

export const apiGetPDFBook = (params = {}) => {
  return window.axios.get(`${window.API_URL}/v1/pdf-books`, { params });
};

export const apiGetPDFBookID = (id) => {
  return window.axios.get(`${window.API_URL}/v1/pdf-books/${id}`);
};

export const apiCreatePDFBook = (data) => {
  return window.axios.post(`${window.API_URL}/v1/pdf-books`, data, {
    headers: {
      'Content-Type': 'multipart/form-data'
    }
  });
};

export const apiUpdatePDFBook = (id, data) => {
  // Using POST with _method=PUT for file uploads (Laravel requirement)
  return window.axios.post(`${window.API_URL}/v1/pdf-books/${id}`, data, {
    headers: {
      'Content-Type': 'multipart/form-data',
      'X-HTTP-Method-Override': 'PUT'
    }
  });
};

export const apiDeletePDFBook = (id) => {
  return window.axios.delete(`${window.API_URL}/v1/pdf-books/${id}`);
};

export const apiTogglePDFBookStatus = (id) => {
  return window.axios.patch(`${window.API_URL}/v1/pdf-books/${id}/toggle-status`);
};

export const apiDownloadPDFBookID = (id) => {
  return window.axios.get(`${window.API_URL}/v1/pdf-books/${id}/download`, {
    // responseType: 'blob', // Critical for file downloads
    headers: {
      'Accept': 'application/pdf, application/json'
    }
  });
};

export const apiGetCategories = () => {
  return window.axios.get(`${window.API_URL}/v1/categories`);
};
