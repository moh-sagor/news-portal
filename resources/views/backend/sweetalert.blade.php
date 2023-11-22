
{{-- edit icon sweetalert  --}}
<script>
    function confirmEdit(itemId) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'You are about to edit this item.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes, edit it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect to the edit page or perform any other action
                window.location.href = '/edit/' + itemId ;
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                Swal.fire('Cancelled', 'Your edit is cancelled.', 'info');
            }
        });
    }
</script>




{{-- delete button sweetalert  --}}
<script>
    function confirmDelete() {
        const itemId = event.target.getAttribute('data-id');

        Swal.fire({
            title: 'Are you sure?',
            text: 'You are about to delete this item.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Perform the delete action, for example, send an AJAX request or redirect to a delete route
                Swal.fire('Deleted!', 'Your item has been deleted.', 'success');
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                Swal.fire('Cancelled', 'Your delete is cancelled.', 'info');
            }
        });
    }
</script>

