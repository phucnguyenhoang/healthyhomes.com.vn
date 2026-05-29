    <?php if (empty($hideNav)): ?>
        </div><!-- /.content-wrapper -->
    </div><!-- /.d-flex -->
    <?php endif; ?>

<!-- Bootstrap 4.5.2 bundle -->
<script src="/resources/js/bootstrap.bundle.min.js"></script>
<script>
    setTimeout(function () { $('.alert').fadeOut('slow'); }, 4000);
</script>
<?php if (!empty($extra_js)) echo $extra_js; ?>
</body>
</html>
