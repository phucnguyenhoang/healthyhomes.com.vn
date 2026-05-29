<div class="d-flex align-items-center justify-content-center"
     style="min-height: calc(100vh - 52px); background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);">

    <div class="col-12 col-sm-9 col-md-6 col-lg-4 col-xl-3 px-4 py-5">

        <!-- Logo / Branding -->
        <div class="text-center mb-4">
            <div class="mb-3">
                <i class="fas fa-leaf fa-3x text-success"></i>
            </div>
            <h4 class="text-white font-weight-bold mb-0">Healthy Homes</h4>
            <small class="text-secondary">Administration Panel</small>
        </div>

        <!-- Login Card -->
        <div class="card border-0 shadow-lg">
            <div class="card-body p-4">
                <h6 class="card-title text-center text-muted mb-4">
                    <i class="fas fa-user-shield mr-1"></i> Sign in to continue
                </h6>

                <?php if (!empty($msg)): ?>
                <div class="alert alert-danger alert-dismissible fade show py-2" role="alert">
                    <i class="fas fa-exclamation-circle mr-1"></i>
                    <?php echo htmlspecialchars($msg); ?>
                    <button type="button" class="close py-2" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                </div>
                <?php endif; ?>

                <form method="post" action="<?php echo base_url('admin/login'); ?>" id="loginForm">
                    <div class="form-group">
                        <label class="small font-weight-bold text-muted text-uppercase">Username</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-light border-right-0">
                                    <i class="fas fa-user text-muted fa-sm"></i>
                                </span>
                            </div>
                            <input type="text"
                                   class="form-control border-left-0"
                                   name="username"
                                   placeholder="Enter username"
                                   autocomplete="username"
                                   required
                                   autofocus>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="small font-weight-bold text-muted text-uppercase">Password</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-light border-right-0">
                                    <i class="fas fa-lock text-muted fa-sm"></i>
                                </span>
                            </div>
                            <input type="password"
                                   class="form-control border-left-0"
                                   name="password"
                                   placeholder="Enter password"
                                   autocomplete="current-password"
                                   required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-dark btn-block mt-4" id="btnLogin">
                        <i class="fas fa-sign-in-alt mr-2"></i>Login
                    </button>
                </form>
            </div>
        </div>

        <p class="text-center mt-4 mb-0 small text-secondary">
            &copy; <?php echo date('Y'); ?> Healthy Homes. All rights reserved.
        </p>
    </div>
</div>

<script>
document.getElementById('loginForm').addEventListener('submit', function () {
    var btn = document.getElementById('btnLogin');
    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Signing in...';
});
</script>
