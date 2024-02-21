<div class="login-box">
    <div class="login-logo">
        <img src="<?=base_url();?>assets/img/EDII_LOGO.png" alt="" width="100px" />
        <!-- <h3>Institution Login </h3> -->
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <h4 class="login-box-msg"><?=$pageTitle;?></h4>

            <?php echo form_open($action, 'class="js-validation-signin" method="POST"'); ?>
            <?php echo '<span class="text-danger">'.validation_errors().'</span>'; ?>
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Username" name="username">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
            </div>
            <div class="input-group mb-3">
                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-8">
                    <!-- <div class="icheck-primary">
                        <input type="checkbox" id="remember">
                        <label for="remember">
                            Remember Me
                        </label>
                    </div> -->
                </div>
                <!-- /.col -->
                <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                </div>
                <!-- /.col -->
            </div>
            <?php echo form_close(); ?>



        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->