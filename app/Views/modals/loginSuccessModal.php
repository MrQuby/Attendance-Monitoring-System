<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="success-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <h5 class="modal-title">Login Success</h5>
                <p><?php echo $successMessage; ?></p>
            </div>
            <div class="justify-content-center">
                <a href="<?php echo htmlspecialchars($redirectUrl); ?>" id="continueButton" type="button" class="btn btn-success">Continue</a>
            </div>
        </div>
    </div>
</div>

<script>
    setTimeout(function () {
        window.location.href = "<?php echo htmlspecialchars($redirectUrl); ?>";
    }, 5000);

    document.getElementById('continueButton').addEventListener('click', function (event) {
        event.preventDefault();

        document.body.classList.add('fade-out');

        setTimeout(function () {
            window.location.href = "<?php echo htmlspecialchars($redirectUrl); ?>";
        }, 500);
    });
</script>