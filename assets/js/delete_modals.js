document.addEventListener("DOMContentLoaded", function () {
    let deleteForm;

    // Attach click event to delete buttons
    document.querySelectorAll(".delete-student-btn").forEach(button => {
        button.addEventListener("click", function (event) {
            event.preventDefault();
            deleteForm = this.closest("form");
            const deleteModal = new bootstrap.Modal(document.getElementById("deleteConfirmationModal"));
            deleteModal.show();
        });
    });

    // Confirm delete button in the confirmation modal
    document.getElementById("confirmDeleteButton").addEventListener("click", function () {
        if (deleteForm) deleteForm.submit();

        const deleteModal = bootstrap.Modal.getInstance(document.getElementById("deleteConfirmationModal"));
        deleteModal.hide();

        const successModal = new bootstrap.Modal(document.getElementById("deleteSuccessModal"));
        successModal.show();

        setTimeout(() => {
            successModal.hide();
        }, 3000);
    });
});

