{{-- image preview  --}}
<script>
    function previewImage(event) {
        var input = event.target;
        var imagePreview = document.getElementById('imagePreview');

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block';

                // Set the height and width of the image
                imagePreview.style.height = '180px'; // Set your desired height
                imagePreview.style.width = '240px'; // Set your desired width
            };

            reader.readAsDataURL(input.files[0]);
        } else {
            // Use a dummy image when no file is selected
            imagePreview.src = '{{ asset('assets/img/icon/dummy-image.jpg') }}';
            imagePreview.style.display = 'block';

            // Set the height and width of the dummy image
            imagePreview.style.height = '180px'; // Set your desired height
            imagePreview.style.width = '240px'; // Set your desired width
        }
    }
</script>

{{-- create page live text  --}}
<script>
    function updateMetaTitle(title) {
        document.getElementById('metaTitlePreview').innerText = title;
    }

    function updateMetaDescription(short_content) {
        const truncatedContent = short_content.substring(0, 150);
        document.getElementById('metaDescriptionPreview').innerText = truncatedContent;
    }
</script>
