document.addEventListener("DOMContentLoaded", function() {
    let deleteForm; // Variable to hold the delete form

    // Attach click event to delete buttons
    document.querySelectorAll(".delete-student-btn").forEach(button => {
        button.addEventListener("click", function(event) {
            event.preventDefault();
            deleteForm = this.closest("form"); // Get the form for the delete action
            const deleteModal = new bootstrap.Modal(document.getElementById("deleteConfirmationModal"));
            deleteModal.show();
        });
    });

    // Confirm delete button in the confirmation modal
    document.getElementById("confirmDeleteButton").addEventListener("click", function() {
        // Submit the form to delete the student
        if (deleteForm) deleteForm.submit();

        // Hide confirmation modal
        const deleteModal = bootstrap.Modal.getInstance(document.getElementById("deleteConfirmationModal"));
        deleteModal.hide();

        // Show success modal
        const successModal = new bootstrap.Modal(document.getElementById("deleteSuccessModal"));
        successModal.show();

        // Automatically close success modal after 3 seconds
        setTimeout(() => {
            successModal.hide();
        }, 3000);
    });
});

