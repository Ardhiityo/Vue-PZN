import Swal from 'sweetalert2'

export const success = (message) => {
  Swal.fire({
  title: 'Success!',
  text: message,
  icon: 'success',
})
}

export const error = (message) => {
  Swal.fire({
  title: 'Failed!',
  text: message,
  icon: 'error',
})
}

export const confirm = async (message) => {
  const response = await Swal.fire({
  title: "Are you sure?",
  text: message,
  icon: "warning",
  showCancelButton: true,
  confirmButtonColor: "#3085d6",
  cancelButtonColor: "#d33",
  confirmButtonText: "Yes, delete it!"
  });
  
  return response.isConfirmed;
}