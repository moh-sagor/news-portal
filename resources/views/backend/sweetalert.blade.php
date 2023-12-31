
{{-- edit icon sweetalert news --}}
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




{{-- edit categories --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Add event listener to all edit links with the class 'edit-category'
        document.querySelectorAll('.edit-category').forEach(function (editLink) {
            editLink.addEventListener('click', function (event) {
                event.preventDefault();
                const categoryId = this.getAttribute('data-id');

                // Use SweetAlert2 to confirm the edit action
                Swal.fire({
                    title: 'Edit Category?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, edit it!',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // If confirmed, navigate to the edit page
                        window.location.href = "{{ url('/categories') }}/" + categoryId + "/edit";
                    }
                });
            });
        });
    });
</script>


{{-- delete categories  --}}
<script>
   function confirmDeleteCategory(event, categoryId) {
    event.preventDefault();

    // Use SweetAlert2 to confirm the delete action
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
            document.getElementById('delete-item-' + categoryId).submit();
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire('Cancelled', 'Your Abort Delete.', 'info');
        }
    });
}
</script>




{{-- delete button sweetalert  news --}}
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


{{-- sweetalert for store news data  --}}
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


{{-- sweetalert for update news data  --}}
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









