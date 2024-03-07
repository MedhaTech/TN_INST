<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <!-- <h1>Edit Block</h1> -->
                </div>
                <div class="col-sm-6">
                    <!-- <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">DataTables</li>
                        </ol> -->
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">


                <div class="col-md-6 offset-3">

                    <div class="card card-dark">
                        <div class="card-header">
                            <h3 class="card-title text-uppercase"><?=$pageTitle;?></h3>
                        </div>
                        <?php echo form_open('admin/changePassword'); ?>
                        <div class="card-body">

                            <div class="form-group">
                                <label for="status">Current Password:</label>
                                <input type="password" class="form-control" name="current_password"
                                    id="current_password" value="<?php echo set_value('current_password', ''); ?>">
                                <?=form_error('current_password','<div class="text-danger">','</div>');?>
                            </div>
                            <div class="form-group">
                                <label for="block_name">New Password:</label>
                                <input type="password" class="form-control" name="new_password" id="new_password"
                                    value="<?php echo set_value('new_password', ''); ?>">
                                <?=form_error('new_password','<div class="text-danger">','</div>');?>
                            </div>
                            <div class="form-group">
                                <label for="block_name">Confirm Password:</label>
                                <input type="password" class="form-control" name="confirm_password"
                                    id="confirm_password" value="<?php echo set_value('confirm_password', ''); ?>">
                                <?=form_error('confirm_password','<div class="text-danger">','</div>');?>
                            </div>

                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-success btn-sm">UPDATE PASSWORD</button>
                            <a href="<?=base_url();?>admin/dashboard" class="btn btn-dark btn-sm float-right"
                                role="button">CANCEL</a>
                        </div>
                        <?php echo form_close(); ?>
                    </div>


                </div>









            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
</div>
<!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>