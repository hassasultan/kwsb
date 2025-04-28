<script>
    function validateCustomerName(element) {
        // Only allow letters, numbers, and spaces
        element.value = element.value.replace(/[^a-zA-Z0-9 ]/g, '');

        // Enforce 25 characters maximum even after removing special characters
        if (element.value.length > 25) {
            element.value = element.value.substring(0, 25);
        }
    }

    function validateDescription(element) {
        // Only allow letters, numbers, and spaces
        element.value = element.value.replace(/[^a-zA-Z0-9 ]/g, '');

        // Enforce 350 characters maximum even after removing special characters
        if (element.value.length > 350) {
            element.value = element.value.substring(0, 350);
        }
    }
</script>
