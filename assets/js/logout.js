document.getElementById("confirmLogout").addEventListener("click", function (event) {
    event.preventDefault();

    const logoutModal = document.getElementById("logoutModal");
    const bootstrapModal = bootstrap.Modal.getInstance(logoutModal);
    bootstrapModal.hide();

    const loadingSpinner = document.getElementById("loadingSpinner");
    loadingSpinner.classList.remove("d-none");

    setTimeout(function () {
        window.location.href = "logout.php";
    }, 2000);
});