// @func/api/pdfbook.js

/**
 * PDF Book API endpoints
 * Handles all PDF book related API calls
 */

/**
 * Get list of PDF books with optional filters
 * @param {Object} params - Query parameters (status, category_id, search, sort_field, sort_direction, per_page, page)
 * @returns {Promise} Axios promise
 */
export const apiGetPDFBook = (params = {}) => {
    return window.axios.get(`${window.API_URL}/v1/pdf-books`, { params });
};

/**
 * Get single PDF book by ID
 * @param {number|string} id - Book ID
 * @returns {Promise} Axios promise
 */
export const apiGetPDFBookID = (id) => {
    return window.axios.get(`${window.API_URL}/v1/pdf-books/${id}`);
};

/**
 * Create new PDF book with file upload
 * @param {FormData} data - Form data with book details and files
 * @returns {Promise} Axios promise
 */
export const apiCreatePDFBook = (data) => {
    return window.axios.post(`${window.API_URL}/v1/pdf-books`, data, {
        headers: {
            "Content-Type": "multipart/form-data",
        },
    });
};

/**
 * Update existing PDF book with file upload
 * @param {number|string} id - Book ID
 * @param {FormData} data - Form data with book details and files
 * @returns {Promise} Axios promise
 */
export const apiUpdatePDFBook = (id, data) => {
    // Using POST with _method=PUT for file uploads (Laravel requirement)
    return window.axios.post(`${window.API_URL}/v1/pdf-books/${id}`, data, {
        headers: {
            "Content-Type": "multipart/form-data",
            "X-HTTP-Method-Override": "PUT",
        },
    });
};

/**
 * Delete PDF book by ID
 * @param {number|string} id - Book ID
 * @returns {Promise} Axios promise
 */
export const apiDeletePDFBook = (id) => {
    return window.axios.delete(`${window.API_URL}/v1/pdf-books/${id}`);
};

/**
 * Toggle PDF book status (active/inactive)
 * @param {number|string} id - Book ID
 * @returns {Promise} Axios promise
 */
export const apiTogglePDFBookStatus = (id) => {
    return window.axios.post(
        `${window.API_URL}/v1/pdf-books/${id}/toggle-status`,
    );
};

/**
 * Download PDF file by book ID
 * @param {number|string} id - Book ID
 * @returns {Promise} Axios promise with blob response
 */
export const apiDownloadPDFBookID = (id) => {
    return window.axios.get(`${window.API_URL}/v1/pdf-books/${id}/download`, {
        responseType: "blob", // Critical for file downloads
        headers: {
            Accept: "application/pdf, application/json",
        },
    });
};

/**
 * Get all categories for dropdown
 * @returns {Promise} Axios promise
 */
export const apiGetCategories = () => {
    return window.axios.get(`${window.API_URL}/v1/pdf-categories`);
};

/**
 * Get popular books
 * @param {number} limit - Number of books to return
 * @returns {Promise} Axios promise
 */
export const apiGetPopularBooks = (limit = 10) => {
    return window.axios.get(`${window.API_URL}/v1/pdf-books/popular`, {
        params: { limit },
    });
};

/**
 * Get books by category
 * @param {number|string} categoryId - Category ID
 * @param {Object} params - Additional parameters
 * @returns {Promise} Axios promise
 */
export const apiGetBooksByCategory = (categoryId, params = {}) => {
    return window.axios.get(
        `${window.API_URL}/v1/pdf-categories/${categoryId}/books`,
        { params },
    );
};

// Add to @func/api/pdfbook.js

/**
 * Get user's favorite books
 */
export const apiGetMyFavorites = (params = {}) => {
    return window.axios.get(`${window.API_URL}/v1/favorites`, { params });
};

/**
 * Toggle favorite status for a book
 */
export const apiToggleFavorite = (id) => {
    return window.axios.post(`${window.API_URL}/v1/pdf-books/${id}/favorite`);
};

/**
 * Get favorite statistics
 */
export const apiGetFavoriteStatistics = () => {
    return window.axios.get(`${window.API_URL}/v1/favorites/statistics`);
};

/**
 * Check if a book is favorited
 */
export const apiCheckFavorite = (id) => {
    return window.axios.get(
        `${window.API_URL}/v1/pdf-books/${id}/favorite/check`,
    );
};
