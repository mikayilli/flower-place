import swal from 'sweetalert';
export default {
    swalConfirmMethod: function() {
        return swal({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
    },
    swalDeleteAlert(message = 'Your record has been deleted!') {
        swal("Good job!", message, "success",{
            button: "Close!"
        })
    },
    swalSuccessAlert(message = 'Successfully done!') {
        swal("Good job!", message, "success",{
            button: "Close!",
        })
    }
}
