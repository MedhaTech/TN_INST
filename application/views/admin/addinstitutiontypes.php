<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add Institution Type</h1>
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


                    <div class="col-md-6">

                        <div class="card card-primary">



                           
                            <?php echo form_open('admin/addinstitutiontypes'); ?>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="institution_type">Institution Type:</label>
                                    <input type="text" class="form-control" name="institution_type" id="institution_type" value="<?php echo set_value('institution_type'); ?>">
                                    <?=form_error('institution_type','<div class="text-danger">','</div>');?>
                                </div>
                                <div class="form-group">
                                    <label for="institution_short_name">Institution Short Name:</label>
                                    <input type="text" class="form-control" name="institution_short_name" id="institution_short_name" value="<?php echo set_value('institution_short_name'); ?>">
                                    <?=form_error('institution_short_name','<div class="text-danger">','</div>');?>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status:</label>
                                    <select class="form-control" name="status" id="status">
                                        <option value="ACTIVE">Active</option>
                                        <option value="INACTIVE">Inactive</option>
                                        <option value="DELETED">Deleted</option>
                                    </select>
                                </div>
                               
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Add</button>
                                <a href="<?=base_url();?>admin/institution_types" class="btn btn-primary float-right" role="button">Cancel</a>
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