document.addEventListener('DOMContentLoaded', function () {
    var formChanged = false;

    // Listen for changes in form fields
    var formInputs = document.querySelectorAll('form input, form select, form textarea');
    formInputs.forEach(function (input) {
        input.addEventListener('change', function () {
            formChanged = true;
        });
    });

    // Prompt user if they try to leave the page with unsaved changes
    window.addEventListener('beforeunload', function (event) {
        if (formChanged) {
            var confirmationMessage = 'You have unsaved changes. Are you sure you want to leave?';
            event.returnValue = confirmationMessage; // Standard for most browsers
            return confirmationMessage; // For some older browsers
        }
    });

    // Disable form confirmation when submitting
    var submitButton = document.querySelector('form [type="submit"]');
    if (submitButton) {
        submitButton.addEventListener('click', function () {
            formChanged = false;
        });
    }
}); 