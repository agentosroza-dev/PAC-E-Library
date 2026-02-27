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



// src/functions/swal.js

import Swal from 'sweetalert2';

// Get CSS variables from DaisyUI theme (v4+)
const getDaisyUIColor = (colorName, shade = 'default') => {
  // Correct DaisyUI v4+ CSS variables
  const colors = {
    // Primary colors
    primary: 'var(--color-primary)',
    'primary-content': 'var(--color-primary-content)',

    // Secondary colors
    secondary: 'var(--color-secondary)',
    'secondary-content': 'var(--color-secondary-content)',

    // Accent colors
    accent: 'var(--color-accent)',
    'accent-content': 'var(--color-accent-content)',

    // Neutral colors
    neutral: 'var(--color-neutral)',
    'neutral-content': 'var(--color-neutral-content)',

    // Base colors (surface)
    'base-100': 'var(--color-base-100)',
    'base-200': 'var(--color-base-200)',
    'base-300': 'var(--color-base-300)',
    'base-content': 'var(--color-base-content)',

    // Semantic colors
    info: 'var(--color-info)',
    'info-content': 'var(--color-info-content)',
    success: 'var(--color-success)',
    'success-content': 'var(--color-success-content)',
    warning: 'var(--color-warning)',
    'warning-content': 'var(--color-warning-content)',
    error: 'var(--color-error)',
    'error-content': 'var(--color-error-content)',
  };

  return colors[colorName] || 'var(--color-primary)';
};

// Helper to get contrast text color
const getContrastColor = (bgColor) => {
  const contrasts = {
    'var(--color-primary)': 'var(--color-primary-content)',
    'var(--color-secondary)': 'var(--color-secondary-content)',
    'var(--color-accent)': 'var(--color-accent-content)',
    'var(--color-neutral)': 'var(--color-neutral-content)',
    'var(--color-info)': 'var(--color-info-content)',
    'var(--color-success)': 'var(--color-success-content)',
    'var(--color-warning)': 'var(--color-warning-content)',
    'var(--color-error)': 'var(--color-error-content)',
  };
  return contrasts[bgColor] || 'var(--color-base-content)';
};

// DaisyUI theme configuration
const daisyTheme = {
  confirmButtonColor: getDaisyUIColor('primary'),
  cancelButtonColor: getDaisyUIColor('error'),
  background: getDaisyUIColor('base-100'),
  color: getDaisyUIColor('base-content'),
};

// Custom class for DaisyUI styling
const daisyClasses = {
  popup: 'rounded-box shadow-2xl border border-base-300',
  title: 'text-lg font-semibold text-base-content',
  htmlContainer: 'text-base-content/70',
  confirmButton: 'btn btn-primary',
  cancelButton: 'btn btn-ghost',
  denyButton: 'btn btn-error',
  closeButton: 'btn btn-sm btn-circle absolute right-2 top-2',
  loader: 'loading loading-spinner text-primary',
  actions: 'gap-2',
};

// Loading modal
export const LoadingModal = (title = 'Loading...') => {
  return Swal.fire({
    title: title,
    allowOutsideClick: false,
    allowEscapeKey: false,
    showConfirmButton: false,
    background: getDaisyUIColor('base-100'),
    color: getDaisyUIColor('base-content'),
    customClass: {
      popup: 'rounded-box shadow-2xl',
      title: 'text-lg font-semibold text-base-content',
      loader: 'loading loading-spinner text-primary',
    },
    willOpen: () => {
      Swal.showLoading();
    }
  });
};

// Close modal
export const CloseModal = () => {
  Swal.close();
};

// Message modal with proper icon colors
export const MessageModal = (icon, title, message) => {
  const iconColorMap = {
    success: getDaisyUIColor('success'),
    error: getDaisyUIColor('error'),
    warning: getDaisyUIColor('warning'),
    info: getDaisyUIColor('info'),
    question: getDaisyUIColor('primary'),
  };

  return Swal.fire({
    icon: icon,
    title: title,
    text: message,
    background: getDaisyUIColor('base-100'),
    color: getDaisyUIColor('base-content'),
    iconColor: iconColorMap[icon] || getDaisyUIColor('primary'),
    confirmButtonColor: getDaisyUIColor('primary'),
    customClass: {
      popup: 'rounded-box shadow-2xl border border-base-300',
      title: 'text-lg font-semibold text-base-content',
      htmlContainer: 'text-base-content/70',
      confirmButton: 'btn btn-primary',
    }
  });
};

// Confirm modal
export const ConfirmModal = (title, text, icon = 'question') => {
  return Swal.fire({
    title: title,
    text: text,
    icon: icon,
    showCancelButton: true,
    confirmButtonColor: getDaisyUIColor('primary'),
    cancelButtonColor: getDaisyUIColor('error'),
    confirmButtonText: 'Yes',
    cancelButtonText: 'Cancel',
    background: getDaisyUIColor('base-100'),
    color: getDaisyUIColor('base-content'),
    iconColor: getDaisyUIColor('primary'),
    reverseButtons: true,
    customClass: {
      popup: 'rounded-box shadow-2xl border border-base-300',
      title: 'text-lg font-semibold text-base-content',
      htmlContainer: 'text-base-content/70',
      confirmButton: 'btn btn-primary',
      cancelButton: 'btn btn-ghost',
      actions: 'gap-2',
    }
  });
};

// Success modal
export const SuccessModal = (message) => {
  return Swal.fire({
    icon: 'success',
    title: 'Success',
    text: message,
    timer: 3000,
    showConfirmButton: false,
    background: getDaisyUIColor('base-100'),
    color: getDaisyUIColor('base-content'),
    iconColor: getDaisyUIColor('success'),
    timerProgressBar: true,
    customClass: {
      popup: 'rounded-box shadow-2xl border border-base-300',
      title: 'text-lg font-semibold text-base-content',
      htmlContainer: 'text-base-content/70',
      timerProgressBar: 'bg-success',
    }
  });
};

// Error modal
export const ErrorModal = (message) => {
  return Swal.fire({
    icon: 'error',
    title: 'Error',
    text: message,
    confirmButtonColor: getDaisyUIColor('error'),
    background: getDaisyUIColor('base-100'),
    color: getDaisyUIColor('base-content'),
    iconColor: getDaisyUIColor('error'),
    customClass: {
      popup: 'rounded-box shadow-2xl border border-base-300',
      title: 'text-lg font-semibold text-base-content',
      htmlContainer: 'text-base-content/70',
      confirmButton: 'btn btn-error',
    }
  });
};

// Warning modal
export const WarningModal = (message) => {
  return Swal.fire({
    icon: 'warning',
    title: 'Warning',
    text: message,
    confirmButtonColor: getDaisyUIColor('warning'),
    background: getDaisyUIColor('base-100'),
    color: getDaisyUIColor('base-content'),
    iconColor: getDaisyUIColor('warning'),
    customClass: {
      popup: 'rounded-box shadow-2xl border border-base-300',
      title: 'text-lg font-semibold text-base-content',
      htmlContainer: 'text-base-content/70',
      confirmButton: 'btn btn-warning',
    }
  });
};

// Info modal
export const InfoModal = (message) => {
  return Swal.fire({
    icon: 'info',
    title: 'Information',
    text: message,
    confirmButtonColor: getDaisyUIColor('info'),
    background: getDaisyUIColor('base-100'),
    color: getDaisyUIColor('base-content'),
    iconColor: getDaisyUIColor('info'),
    customClass: {
      popup: 'rounded-box shadow-2xl border border-base-300',
      title: 'text-lg font-semibold text-base-content',
      htmlContainer: 'text-base-content/70',
      confirmButton: 'btn btn-info',
    }
  });
};

// Delete confirmation modal
export const DeleteConfirmModal = (itemName = 'item') => {
  return Swal.fire({
    title: 'Are you sure?',
    text: `You won't be able to revert this ${itemName}!`,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: getDaisyUIColor('error'),
    cancelButtonColor: getDaisyUIColor('primary'),
    confirmButtonText: 'Yes, delete it!',
    cancelButtonText: 'Cancel',
    background: getDaisyUIColor('base-100'),
    color: getDaisyUIColor('base-content'),
    iconColor: getDaisyUIColor('warning'),
    reverseButtons: true,
    customClass: {
      popup: 'rounded-box shadow-2xl border border-base-300',
      title: 'text-lg font-semibold text-base-content',
      htmlContainer: 'text-base-content/70',
      confirmButton: 'btn btn-error',
      cancelButton: 'btn btn-primary',
      actions: 'gap-2',
    }
  });
};

// Form validation modal
export const ValidationErrorModal = (errors) => {
  let errorList = '<ul class="list-disc list-inside space-y-1 text-left mt-2">';
  Object.values(errors).forEach(error => {
    if (Array.isArray(error)) {
      error.forEach(msg => {
        errorList += `<li class="text-error-content bg-error/10 p-1 rounded">${msg}</li>`;
      });
    } else {
      errorList += `<li class="text-error-content bg-error/10 p-1 rounded">${error}</li>`;
    }
  });
  errorList += '</ul>';

  return Swal.fire({
    icon: 'error',
    title: 'Validation Error',
    html: `
      <div class="text-base-content/70 mb-2">
        Please fix the following errors:
      </div>
      ${errorList}
    `,
    confirmButtonColor: getDaisyUIColor('primary'),
    background: getDaisyUIColor('base-100'),
    color: getDaisyUIColor('base-content'),
    iconColor: getDaisyUIColor('error'),
    customClass: {
      popup: 'rounded-box shadow-2xl border border-base-300 max-w-md',
      title: 'text-lg font-semibold text-base-content',
      htmlContainer: 'text-base-content/70',
      confirmButton: 'btn btn-primary',
    }
  });
};

// Toast notification
export const Toast = (icon, message, position = 'top-end') => {
  const iconColorMap = {
    success: getDaisyUIColor('success'),
    error: getDaisyUIColor('error'),
    warning: getDaisyUIColor('warning'),
    info: getDaisyUIColor('info'),
  };

  const Toast = Swal.mixin({
    toast: true,
    position: position,
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    background: getDaisyUIColor('base-100'),
    color: getDaisyUIColor('base-content'),
    iconColor: iconColorMap[icon] || getDaisyUIColor('primary'),
    customClass: {
      popup: 'rounded-box shadow-xl border border-base-300',
      timerProgressBar: `bg-${icon}`,
    }
  });

  return Toast.fire({
    icon: icon,
    title: message
  });
};

// Progress modal
export const ProgressModal = (title = 'Processing...') => {
  return Swal.fire({
    title: title,
    html: '<div class="progress-bar"></div>',
    allowOutsideClick: false,
    showConfirmButton: false,
    background: getDaisyUIColor('base-100'),
    color: getDaisyUIColor('base-content'),
    didOpen: () => {
      Swal.showLoading();
    },
    customClass: {
      popup: 'rounded-box shadow-2xl border border-base-300',
      title: 'text-lg font-semibold text-base-content',
      loader: 'loading loading-spinner text-primary',
    }
  });
};

// Custom modal with HTML content
export const CustomModal = (title, html, icon = 'info') => {
  const iconColorMap = {
    success: getDaisyUIColor('success'),
    error: getDaisyUIColor('error'),
    warning: getDaisyUIColor('warning'),
    info: getDaisyUIColor('info'),
    question: getDaisyUIColor('primary'),
  };

  return Swal.fire({
    title: title,
    html: html,
    icon: icon,
    background: getDaisyUIColor('base-100'),
    color: getDaisyUIColor('base-content'),
    iconColor: iconColorMap[icon] || getDaisyUIColor('primary'),
    confirmButtonColor: getDaisyUIColor('primary'),
    customClass: {
      popup: 'rounded-box shadow-2xl border border-base-300',
      title: 'text-lg font-semibold text-base-content',
      htmlContainer: 'text-base-content/70',
      confirmButton: 'btn btn-primary',
    }
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
};
