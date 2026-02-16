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