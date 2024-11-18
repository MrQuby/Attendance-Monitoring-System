<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body">
                <div class="success-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <h5 class="modal-title">Success</h5>
                <p><?php echo $successMessage; ?></p>
            </div>
            <div class="justify-content-center">
                <a href="login_screen.php" id="continueButton" type="button" class="btn btn-success">Continue</a>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('continueButton').addEventListener('click', function (event) {
        event.preventDefault();

        document.body.classList.add('fade-out');

        setTimeout(function () {
            window.location.href = 'login_screen.php';
        }, 500);
    });
</script>