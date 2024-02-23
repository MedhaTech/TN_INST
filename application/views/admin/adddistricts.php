<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">

        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">


                <div class="col-md-6 offset-3">

                    <div class="card card-dark">
                        <div class="card-header">
                            <h3 class="card-title text-uppercase">Add District</h3>
                        </div>
                        <?php echo form_open('admin/adddistricts'); ?>
                        <div class="card-body">

                            <div class="form-group">
                                <label for="lgd_code">IDG Code:</label>
                                <input type="text" class="form-control" name="lgd_code" id="lgd_code"
                                    value="<?php echo set_value('lgd_code'); ?>">
                                <?=form_error('lgd_code','<div class="text-danger">','</div>');?>
                            </div>
                            <div class="form-group">
                                <label for="district_name">District Name:</label>
                                <input type="text" class="form-control" name="district_name" id="district_name"
                                    value="<?php echo set_value('district_name'); ?>">
                                <?=form_error('district_name','<div class="text-danger">','</div>');?>
                            </div>
                            <div class="form-group">
                                <label for="district_name_vernacular">Vernacular District Name:</label>
                                <input type="text" class="form-control" name="district_name_vernacular"
                                    id="district_name_vernacular"
                                    value="<?php echo set_value('district_name_vernacular'); ?>">
                                <?=form_error('district_name_vernacular','<div class="text-danger">','</div>');?>
                            </div>
                            <div class="form-group">
                                <label for="district_short_form">District Short Form:</label>
                                <input type="text" class="form-control" name="district_short_form"
                                    id="district_short_form" value="<?php echo set_value('district_short_form'); ?>">
                                <?=form_error('district_short_form','<div class="text-danger">','</div>');?>
                            </div>
                            <div class="form-group">
                                <label for="district_headquarters">District Headquarters:</label>
                                <input type="text" class="form-control" name="district_headquarters"
                                    id="district_headquarters"
                                    value="<?php echo set_value('district_headquarters'); ?>">
                                <?=form_error('district_headquarters','<div class="text-danger">','</div>');?>
                            </div>
                            <div class="form-group">
                                <label for="district_headquarters_vernacular">Vernacular District Headquarters
                                    Name:</label>
                                <input type="text" class="form-control" name="district_headquarters_vernacular"
                                    id="district_headquarters_vernacular"
                                    value="<?php echo set_value('district_headquarters_vernacular'); ?>">
                                <?=form_error('district_headquarters_vernacular','<div class="text-danger">','</div>');?>
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
                            <button type="submit" class="btn btn-success btn-sm">Add</button>
                            <a href="<?=base_url();?>admin/districts" class="btn btn-dark btn-sm float-right"
                                role="button">Cancel</a>
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