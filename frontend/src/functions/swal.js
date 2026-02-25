// src/functions/swal.js

import Swal from 'sweetalert2';

// Loading modal
export const LoadingModal = () => {
  Swal.fire({
    title: 'Loading...',
    allowOutsideClick: false,
    allowEscapeKey: false,
    showConfirmButton: false,
    willOpen: () => {
      Swal.showLoading();
    }
  });
};

// Close modal
export const CloseModal = () => {
  Swal.close();
};

// Message modal
export const MessageModal = (icon, title, message) => {
  return Swal.fire({
    icon: icon,
    title: title,
    text: message,
    confirmButtonColor: '#3085d6',
  });
};

// Confirm modal (what you need)
export const ConfirmModal = (title, text, icon = 'question') => {
  return Swal.fire({
    title: title,
    text: text,
    icon: icon,
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes',
    cancelButtonText: 'Cancel'
  });
};

// Success modal
export const SuccessModal = (message) => {
  return Swal.fire({
    icon: 'success',
    title: 'Success',
    text: message,
    timer: 3000,
    showConfirmButton: false
  });
};

// Error modal
export const ErrorModal = (message) => {
  return Swal.fire({
    icon: 'error',
    title: 'Error',
    text: message,
    confirmButtonColor: '#d33',
  });
};

// Warning modal
export const WarningModal = (message) => {
  return Swal.fire({
    icon: 'warning',
    title: 'Warning',
    text: message,
    confirmButtonColor: '#f39c12',
  });
};

// Info modal
export const InfoModal = (message) => {
  return Swal.fire({
    icon: 'info',
    title: 'Information',
    text: message,
    confirmButtonColor: '#3498db',
  });
};

// Delete confirmation modal
export const DeleteConfirmModal = (itemName = 'item') => {
  return Swal.fire({
    title: 'Are you sure?',
    text: `You won't be able to revert this ${itemName}!`,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#d33',
    cancelButtonColor: '#3085d6',
    confirmButtonText: 'Yes, delete it!'
  });
};

// Form validation modal
export const ValidationErrorModal = (errors) => {
  let errorList = '<ul>';
  Object.values(errors).forEach(error => {
    errorList += `<li>${error}</li>`;
  });
  errorList += '</ul>';

  return Swal.fire({
    icon: 'error',
    title: 'Validation Error',
    html: errorList,
    confirmButtonColor: '#3085d6',
  });
};
