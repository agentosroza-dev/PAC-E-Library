// // src/functions/swal.js

// import Swal from "sweetalert2";

// // Loading modal
// export const LoadingModal = () => {
//     Swal.fire({
//         title: "Loading...",
//         allowOutsideClick: false,
//         allowEscapeKey: false,
//         showConfirmButton: false,
//         willOpen: () => {
//             Swal.showLoading();
//         },
//     });
// };

// // Close modal
// export const CloseModal = () => {
//     Swal.close();
// };

// // Message modal
// export const MessageModal = (icon, title, message) => {
//     return Swal.fire({
//         icon: icon,
//         title: title,
//         text: message,
//         confirmButtonColor: "#3085d6",
//     });
// };

// // Confirm modal (what you need)
// export const ConfirmModal = (title, text, icon = "question") => {
//     return Swal.fire({
//         title: title,
//         text: text,
//         icon: icon,
//         showCancelButton: true,
//         confirmButtonColor: "#3085d6",
//         cancelButtonColor: "#d33",
//         confirmButtonText: "Yes",
//         cancelButtonText: "Cancel",
//     });
// };

// // Success modal
// export const SuccessModal = (message) => {
//     return Swal.fire({
//         icon: "success",
//         title: "Success",
//         text: message,
//         timer: 3000,
//         showConfirmButton: false,
//     });
// };

// // Error modal
// export const ErrorModal = (message) => {
//     return Swal.fire({
//         icon: "error",
//         title: "Error",
//         text: message,
//         confirmButtonColor: "#d33",
//     });
// };

// // Warning modal
// export const WarningModal = (message) => {
//     return Swal.fire({
//         icon: "warning",
//         title: "Warning",
//         text: message,
//         confirmButtonColor: "#f39c12",
//     });
// };

// // Info modal
// export const InfoModal = (message) => {
//     return Swal.fire({
//         icon: "info",
//         title: "Information",
//         text: message,
//         confirmButtonColor: "#3498db",
//     });
// };

// // Delete confirmation modal
// export const DeleteConfirmModal = (itemName = "item") => {
//     return Swal.fire({
//         title: "Are you sure?",
//         text: `You won't be able to revert this ${itemName}!`,
//         icon: "warning",
//         showCancelButton: true,
//         confirmButtonColor: "#d33",
//         cancelButtonColor: "#3085d6",
//         confirmButtonText: "Yes, delete it!",
//     });
// };

// // Form validation modal
// export const ValidationErrorModal = (errors) => {
//     let errorList = "<ul>";
//     Object.values(errors).forEach((error) => {
//         errorList += `<li>${error}</li>`;
//     });
//     errorList += "</ul>";

//     return Swal.fire({
//         icon: "error",
//         title: "Validation Error",
//         html: errorList,
//         confirmButtonColor: "#3085d6",
//     });
// };

import Swal from "sweetalert2";

/**
 * Get CSS variables from DaisyUI theme (v4+)
 * @param {string} colorName - The color name from DaisyUI
 * @returns {string} - The CSS variable string
 */
const getDaisyUIColor = (colorName) => {
    // DaisyUI v4+ CSS variables
    const colors = {
        // Primary colors
        primary: "var(--color-primary)",
        "primary-content": "var(--color-primary-content)",

        // Secondary colors
        secondary: "var(--color-secondary)",
        "secondary-content": "var(--color-secondary-content)",

        // Accent colors
        accent: "var(--color-accent)",
        "accent-content": "var(--color-accent-content)",

        // Neutral colors
        neutral: "var(--color-neutral)",
        "neutral-content": "var(--color-neutral-content)",

        // Base colors (surface)
        "base-100": "var(--color-base-100)",
        "base-200": "var(--color-base-200)",
        "base-300": "var(--color-base-300)",
        "base-content": "var(--color-base-content)",

        // Semantic colors
        info: "var(--color-info)",
        "info-content": "var(--color-info-content)",
        success: "var(--color-success)",
        "success-content": "var(--color-success-content)",
        warning: "var(--color-warning)",
        "warning-content": "var(--color-warning-content)",
        error: "var(--color-error)",
        "error-content": "var(--color-error-content)",
    };

    return colors[colorName] || "var(--color-primary)";
};

/**
 * Get the actual hex/rgb value from CSS variable
 * @param {string} cssVar - CSS variable string
 * @returns {string} - Hex color or falls back to CSS var
 */
const getColorValue = (cssVar) => {
    if (typeof window === "undefined") return cssVar;

    // Try to get computed value
    const temp = document.createElement("div");
    temp.style.color = cssVar;
    document.body.appendChild(temp);
    const computed = window.getComputedStyle(temp).color;
    document.body.removeChild(temp);

    // If we got a computed rgb value, use it, otherwise fallback to css var
    return computed && computed !== "rgba(0, 0, 0, 0)" ? computed : cssVar;
};

/**
 * Helper to get contrast text color
 * @param {string} bgColor - Background color CSS variable
 * @returns {string} - Contrast text color CSS variable
 */
const getContrastColor = (bgColor) => {
    const contrasts = {
        [getDaisyUIColor("primary")]: getDaisyUIColor("primary-content"),
        [getDaisyUIColor("secondary")]: getDaisyUIColor("secondary-content"),
        [getDaisyUIColor("accent")]: getDaisyUIColor("accent-content"),
        [getDaisyUIColor("neutral")]: getDaisyUIColor("neutral-content"),
        [getDaisyUIColor("info")]: getDaisyUIColor("info-content"),
        [getDaisyUIColor("success")]: getDaisyUIColor("success-content"),
        [getDaisyUIColor("warning")]: getDaisyUIColor("warning-content"),
        [getDaisyUIColor("error")]: getDaisyUIColor("error-content"),
    };
    return contrasts[bgColor] || getDaisyUIColor("base-content");
};

// DaisyUI theme configuration
const daisyTheme = {
    confirmButtonColor: getDaisyUIColor("primary"),
    cancelButtonColor: getDaisyUIColor("error"),
    background: getDaisyUIColor("base-100"),
    color: getDaisyUIColor("base-content"),
};

// Custom class for DaisyUI styling
const daisyClasses = {
    popup: "rounded-box shadow-2xl border border-base-300",
    title: "text-lg font-semibold text-base-content",
    htmlContainer: "text-base-content/70",
    confirmButton: "btn btn-primary",
    cancelButton: "btn btn-ghost",
    denyButton: "btn btn-error",
    closeButton: "btn btn-sm btn-circle btn-ghost absolute right-2 top-2",
    loader: "loading loading-spinner text-primary",
    actions: "gap-2 flex justify-end",
    timerProgressBar: "bg-primary",
};

/**
 * Loading modal
 * @param {string} title - Loading title
 * @param {string} text - Loading text
 * @returns {Promise} - Swal instance
 */
export const LoadingModal = (title = "Loading...", text = "Please wait...") => {
    return Swal.fire({
        title: title,
        text: text,
        allowOutsideClick: false,
        allowEscapeKey: false,
        showConfirmButton: false,
        background: getColorValue(getDaisyUIColor("base-100")),
        color: getColorValue(getDaisyUIColor("base-content")),
        customClass: {
            popup: daisyClasses.popup,
            title: daisyClasses.title,
            htmlContainer: daisyClasses.htmlContainer,
            loader: daisyClasses.loader,
        },
        didOpen: () => {
            Swal.showLoading();
        },
    });
};

/**
 * Close modal
 */
export const CloseModal = () => {
    Swal.close();
};

/**
 * Message modal with proper icon colors
 * @param {string} icon - Icon type (success, error, warning, info, question)
 * @param {string} title - Modal title
 * @param {string} message - Modal message
 * @returns {Promise} - Swal instance
 */
export const MessageModal = (icon, title, message) => {
    const iconColorMap = {
        success: getColorValue(getDaisyUIColor("success")),
        error: getColorValue(getDaisyUIColor("error")),
        warning: getColorValue(getDaisyUIColor("warning")),
        info: getColorValue(getDaisyUIColor("info")),
        question: getColorValue(getDaisyUIColor("primary")),
    };

    return Swal.fire({
        icon: icon,
        title: title,
        text: message,
        background: getColorValue(getDaisyUIColor("base-100")),
        color: getColorValue(getDaisyUIColor("base-content")),
        iconColor:
            iconColorMap[icon] || getColorValue(getDaisyUIColor("primary")),
        confirmButtonColor: getColorValue(getDaisyUIColor("primary")),
        customClass: {
            popup: daisyClasses.popup,
            title: daisyClasses.title,
            htmlContainer: daisyClasses.htmlContainer,
            confirmButton: daisyClasses.confirmButton,
        },
    });
};

/**
 * Confirm modal
 * @param {string} title - Modal title
 * @param {string} text - Modal text
 * @param {string} icon - Icon type (default: 'question')
 * @returns {Promise} - Swal instance
 */
export const ConfirmModal = (title, text, icon = "question") => {
    return Swal.fire({
        title: title,
        text: text,
        icon: icon,
        showCancelButton: true,
        confirmButtonColor: getColorValue(getDaisyUIColor("primary")),
        cancelButtonColor: getColorValue(getDaisyUIColor("error")),
        confirmButtonText: "Yes",
        cancelButtonText: "Cancel",
        background: getColorValue(getDaisyUIColor("base-100")),
        color: getColorValue(getDaisyUIColor("base-content")),
        iconColor: getColorValue(getDaisyUIColor("primary")),
        reverseButtons: true,
        customClass: {
            popup: daisyClasses.popup,
            title: daisyClasses.title,
            htmlContainer: daisyClasses.htmlContainer,
            cancelButton: daisyClasses.cancelButton,
            confirmButton: daisyClasses.confirmButton,
            actions: daisyClasses.actions,
        },
    });
};

/**
 * Success modal
 * @param {string} message - Success message
 * @param {number} timer - Auto close timer in ms
 * @returns {Promise} - Swal instance
 */
export const SuccessModal = (message, timer = 3000) => {
    return Swal.fire({
        icon: "success",
        title: "Success",
        text: message,
        timer: timer,
        showConfirmButton: false,
        background: getColorValue(getDaisyUIColor("base-100")),
        color: getColorValue(getDaisyUIColor("base-content")),
        iconColor: getColorValue(getDaisyUIColor("success")),
        timerProgressBar: true,
        customClass: {
            popup: daisyClasses.popup,
            title: daisyClasses.title,
            htmlContainer: daisyClasses.htmlContainer,
            timerProgressBar: "bg-success",
        },
    });
};

/**
 * Error modal
 * @param {string} message - Error message
 * @returns {Promise} - Swal instance
 */
export const ErrorModal = (message) => {
    return Swal.fire({
        icon: "error",
        title: "Error",
        text: message,
        confirmButtonColor: getColorValue(getDaisyUIColor("error")),
        background: getColorValue(getDaisyUIColor("base-100")),
        color: getColorValue(getDaisyUIColor("base-content")),
        iconColor: getColorValue(getDaisyUIColor("error")),
        customClass: {
            popup: daisyClasses.popup,
            title: daisyClasses.title,
            htmlContainer: daisyClasses.htmlContainer,
            confirmButton: "btn btn-error",
        },
    });
};

/**
 * Warning modal
 * @param {string} message - Warning message
 * @returns {Promise} - Swal instance
 */
export const WarningModal = (message) => {
    return Swal.fire({
        icon: "warning",
        title: "Warning",
        text: message,
        confirmButtonColor: getColorValue(getDaisyUIColor("warning")),
        background: getColorValue(getDaisyUIColor("base-100")),
        color: getColorValue(getDaisyUIColor("base-content")),
        iconColor: getColorValue(getDaisyUIColor("warning")),
        customClass: {
            popup: daisyClasses.popup,
            title: daisyClasses.title,
            htmlContainer: daisyClasses.htmlContainer,
            confirmButton: "btn btn-warning",
        },
    });
};

/**
 * Info modal
 * @param {string} message - Info message
 * @returns {Promise} - Swal instance
 */
export const InfoModal = (message) => {
    return Swal.fire({
        icon: "info",
        title: "Information",
        text: message,
        confirmButtonColor: getColorValue(getDaisyUIColor("info")),
        background: getColorValue(getDaisyUIColor("base-100")),
        color: getColorValue(getDaisyUIColor("base-content")),
        iconColor: getColorValue(getDaisyUIColor("info")),
        customClass: {
            popup: daisyClasses.popup,
            title: daisyClasses.title,
            htmlContainer: daisyClasses.htmlContainer,
            confirmButton: "btn btn-info",
        },
    });
};

/**
 * Delete confirmation modal
 * @param {string} itemName - Name of item to delete
 * @returns {Promise} - Swal instance
 */
export const DeleteConfirmModal = (itemName = "item") => {
    return Swal.fire({
        title: "Are you sure?",
        text: `You won't be able to revert this ${itemName}!`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: getColorValue(getDaisyUIColor("error")),
        cancelButtonColor: getColorValue(getDaisyUIColor("primary")),
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "Cancel",
        background: getColorValue(getDaisyUIColor("base-100")),
        color: getColorValue(getDaisyUIColor("base-content")),
        iconColor: getColorValue(getDaisyUIColor("warning")),
        reverseButtons: true,
        customClass: {
            popup: daisyClasses.popup,
            title: daisyClasses.title,
            htmlContainer: daisyClasses.htmlContainer,
            confirmButton: "btn btn-error",
            cancelButton: daisyClasses.confirmButton,
            actions: daisyClasses.actions,
        },
    });
};

/**
 * Form validation modal
 * @param {Object|Array} errors - Validation errors
 * @returns {Promise} - Swal instance
 */
export const ValidationErrorModal = (errors) => {
    let errorList =
        '<ul class="list-disc list-inside space-y-1 text-left mt-2">';

    const processErrors = (err) => {
        if (typeof err === "string") {
            errorList += `<li class="text-error-content bg-error/10 p-1 rounded">${err}</li>`;
        } else if (Array.isArray(err)) {
            err.forEach((msg) => {
                errorList += `<li class="text-error-content bg-error/10 p-1 rounded">${msg}</li>`;
            });
        } else if (typeof err === "object") {
            Object.values(err).forEach((val) => processErrors(val));
        }
    };

    processErrors(errors);
    errorList += "</ul>";

    return Swal.fire({
        icon: "error",
        title: "Validation Error",
        html: `
      <div class="text-base-content/70 mb-2">
        Please fix the following errors:
      </div>
      ${errorList}
    `,
        confirmButtonColor: getColorValue(getDaisyUIColor("primary")),
        background: getColorValue(getDaisyUIColor("base-100")),
        color: getColorValue(getDaisyUIColor("base-content")),
        iconColor: getColorValue(getDaisyUIColor("error")),
        customClass: {
            popup: `${daisyClasses.popup} max-w-md`,
            title: daisyClasses.title,
            htmlContainer: daisyClasses.htmlContainer,
            confirmButton: daisyClasses.confirmButton,
        },
    });
};

/**
 * Toast notification
 * @param {string} icon - Icon type (success, error, warning, info)
 * @param {string} message - Toast message
 * @param {string} position - Toast position
 * @returns {Promise} - Swal instance
 * // Success Toast
// Success with emoji
Toast("success", "🎉 Operation completed successfully!");

// Error with context
Toast("error", "⚠️ Network connection lost");

// Warning with action
Toast("warning", "⏰ Session expires in 5 minutes");

// Info with update
Toast("info", "✨ New features available!");
 */
export const Toast = (icon, message, position = "top-end") => {
    const iconColorMap = {
        success: getColorValue(getDaisyUIColor("success")),
        error: getColorValue(getDaisyUIColor("error")),
        warning: getColorValue(getDaisyUIColor("warning")),
        info: getColorValue(getDaisyUIColor("info")),
    };

    const Toast = Swal.mixin({
        toast: true,
        position: position,
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        background: getColorValue(getDaisyUIColor("base-100")),
        color: getColorValue(getDaisyUIColor("base-content")),
        iconColor:
            iconColorMap[icon] || getColorValue(getDaisyUIColor("primary")),
        customClass: {
            popup: "rounded-box shadow-xl border border-base-300",
            timerProgressBar: `bg-${icon}`,
        },
    });

    return Toast.fire({
        icon: icon,
        title: message,
    });
};

/**
 * Progress modal
 * @param {string} title - Modal title
 * @param {string} text - Modal text
 * @returns {Promise} - Swal instance
 */
export const ProgressModal = (
    title = "Processing...",
    text = "Please wait...",
) => {
    return Swal.fire({
        title: title,
        text: text,
        allowOutsideClick: false,
        showConfirmButton: false,
        background: getColorValue(getDaisyUIColor("base-100")),
        color: getColorValue(getDaisyUIColor("base-content")),
        didOpen: () => {
            Swal.showLoading();
        },
        customClass: {
            popup: daisyClasses.popup,
            title: daisyClasses.title,
            htmlContainer: daisyClasses.htmlContainer,
            loader: daisyClasses.loader,
        },
    });
};

/**
 * Custom modal with HTML content
 * @param {string} title - Modal title
 * @param {string} html - HTML content
 * @param {string} icon - Icon type
 * @returns {Promise} - Swal instance
 */
export const CustomModal = (title, html, icon = "info") => {
    const iconColorMap = {
        success: getColorValue(getDaisyUIColor("success")),
        error: getColorValue(getDaisyUIColor("error")),
        warning: getColorValue(getDaisyUIColor("warning")),
        info: getColorValue(getDaisyUIColor("info")),
        question: getColorValue(getDaisyUIColor("primary")),
    };

    return Swal.fire({
        title: title,
        html: html,
        icon: icon,
        background: getColorValue(getDaisyUIColor("base-100")),
        color: getColorValue(getDaisyUIColor("base-content")),
        iconColor:
            iconColorMap[icon] || getColorValue(getDaisyUIColor("primary")),
        confirmButtonColor: getColorValue(getDaisyUIColor("primary")),
        customClass: {
            popup: daisyClasses.popup,
            title: daisyClasses.title,
            htmlContainer: daisyClasses.htmlContainer,
            confirmButton: daisyClasses.confirmButton,
        },
    });
};

// Export all functions
export default {
    LoadingModal,
    CloseModal,
    MessageModal,
    ConfirmModal,
    SuccessModal,
    ErrorModal,
    WarningModal,
    InfoModal,
    DeleteConfirmModal,
    ValidationErrorModal,
    Toast,
    ProgressModal,
    CustomModal,
    // Utility functions
    getDaisyUIColor,
    getColorValue,
};
