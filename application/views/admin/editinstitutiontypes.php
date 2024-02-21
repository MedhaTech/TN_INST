<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Institution Type</h1>
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
                            <h3 class="card-title text-uppercase">EDIT INSTITUTION TYPE</h3>
                        </div>
                            <!-- <?php echo validation_errors(); ?> -->
                            <?php echo form_open('admin/editinstitutiontypes/' . $institutiontype['institution_type_id']); ?>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="institution_type">Institution Type:</label>
                                    <input type="text" class="form-control" name="institution_type" id="institution_type" value="<?php echo set_value('institution_type', $institutiontype['institution_type']); ?>">
                                    <?=form_error('institution_type','<div class="text-danger">','</div>');?>
                                </div>
                                <div class="form-group">
                                    <label for="institution_short_name">Institution Short Name:</label>
                                    <input type="text" class="form-control" name="institution_short_name" id="institution_short_name" value="<?php echo set_value('institution_short_name', $institutiontype['institution_short_name']); ?>">
                                    <?=form_error('institution_short_name','<div class="text-danger">','</div>');?>
                                </div>
                                <div class="form-group">
                                    <label for="stream_short_form">Sort Order:</label>
                                    <input type="number" min="1" class="form-control" name="sort_order" id="sort_order" value="<?php echo set_value('sort_order', $institutiontype['sort_order']); ?>">
                                    <?=form_error('sort_order','<div class="text-danger">','</div>');?>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status:</label>
                                    <select class="form-control" name="status" id="status">
                                        <option value="ACTIVE" <?php echo ($institutiontype['status'] == 'ACTIVE') ? 'selected' : ''; ?>>Active</option>
                                        <option value="INACTIVE" <?php echo ($institutiontype['status'] == 'INACTIVE') ? 'selected' : ''; ?>>Inactive</option>
                                        <option value="DELETED" <?php echo ($institutiontype['status'] == 'DELETED') ? 'selected' : ''; ?>>Deleted</option>
                                    </select>
                                </div>

                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-success btn-sm">Update</button>
                                <a href="<?=base_url();?>admin/institution_types" class="btn btn-dark btn-sm float-right" role="button">Cancel</a>
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