<script>
    function validateInput(element) {
        let maxLength = 0;

        if (element.id === 'customer-name') {
            maxLength = 25;
        }
        if (element.id === 'description-box') {
            maxLength = 350;
        }

        // Allow only letters, numbers, and spaces
        element.value = element.value.replace(/[^a-zA-Z0-9 ]/g, '');

        // Limit to maximum allowed characters
        if (element.value.length > maxLength) {
            element.value = element.value.substring(0, maxLength);
        }
    }
</script>
