
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
   function confirmDelete(event, itemId) {
    event.preventDefault(); // Prevent the default form submission

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
            // Submit the form programmatically
            document.getElementById('delete-form-' + itemId).submit();
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire('Cancelled', 'Your Abort Delete.', 'info');
        }
    });
}
</script>


{{-- sweetalert for store data  --}}
@if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });

        Toast.fire({
            icon: 'success',
            title: '{{ session('success') }}'
        });
    });
</script>
@endif


{{-- sweetalert for update data  --}}
@if(session('success_update'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });

        Toast.fire({
            icon: 'success',
            title: '{{ session('success_update') }}'
        });
    });
</script>
@endif









