<script>
    function validateInput(element) {
        // Only allow letters, numbers, and spaces
        element.value = element.value.replace(/[^a-zA-Z0-9 ]/g, '');

        // Enforce 350 characters maximum even after removing special characters
        if (element.value.length > 350) {
            element.value = element.value.substring(0, 350);
        }
    }
    let maxLength = 0;

    if (element.id === 'customer-name') {
        maxLength = 25;
    } else if (element.id === 'description-box') {
        maxLength = 350;
    } else {
        return; // If not recognized, do nothing
    }

    // Allow only letters, numbers, and spaces
    element.value = element.value.replace(/[^a-zA-Z0-9 ]/g, '');

    // Limit to maximum allowed characters
    if (element.value.length > maxLength) {
        element.value = element.value.substring(0, maxLength);
    }
</script>
