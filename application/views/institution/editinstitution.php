<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <!-- <h1>Edit Institution</h1> -->
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
                            <h3 class="card-title text-uppercase">Edit Institution</h3>
                        </div>
                        <?php echo form_open('institution/editinstitution/' . $institution['institution_id']); ?>
                        <div class="card-body">

                            <div class="form-group">
                                <label for="institution_name">Institution Name:</label>
                                <input type="text" class="form-control" name="institution_name" id="institution_name"
                                    value="<?php echo set_value('institution_name', $institution['institution_name']); ?>"
                                    readonly>
                                <?=form_error('institution_name','<div class="text-danger">','</div>');?>
                            </div>

                            <div class="form-group">
                                <label for="principal_name">Principal Name:</label>
                                <input type="text" class="form-control" name="principal_name" id="principal_name"
                                    value="<?php echo set_value('principal_name', $institution['principal_name']); ?>">
                                <?=form_error('principal_name','<div class="text-danger">','</div>');?>
                            </div>
                            <div class="form-group">
                                <label for="principal_mobile">Principal Mobile:</label>
                                <input type="text" class="form-control" name="principal_mobile" id="principal_mobile"
                                    value="<?php echo set_value('principal_mobile', $institution['principal_mobile']); ?>">
                                <?=form_error('principal_mobile','<div class="text-danger">','</div>');?>
                            </div>
                            <div class="form-group">
                                <label for="principal_whatsapp_mobile">Principal Watsapp Mobile:</label>
                                <input type="text" class="form-control" name="principal_whatsapp_mobile"
                                    id="principal_whatsapp_mobile"
                                    value="<?php echo set_value('principal_whatsapp_mobile', $institution['principal_whatsapp_mobile']); ?>">
                                <?=form_error('principal_whatsapp_mobile','<div class="text-danger">','</div>');?>
                            </div>
                            <div class="form-group">
                                <label for="principal_email">Principal Email:</label>
                                <input type="text" class="form-control" name="principal_email" id="principal_email"
                                    value="<?php echo set_value('principal_email', $institution['principal_email']); ?>">
                                <?=form_error('principal_email','<div class="text-danger">','</div>');?>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-success btn-sm">Update</button>
                                <a href="<?=base_url();?>institution/institutions"
                                    class="btn btn-dark btn-sm float-right" role="button">Cancel</a>
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