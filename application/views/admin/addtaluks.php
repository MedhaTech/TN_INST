<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">

    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">


                <div class="col-md-6 offset-3">

                    <div class="card card-dark">
                        <div class="card-header">
                            <h3 class="card-title text-uppercase">ADD TALUK</h3>
                        </div>
                        <?php echo form_open('admin/addtaluks'); ?>
                        <div class="card-body">

                            <div class="form-group">
                                <label for="status">District Name <span class="text-danger">*</span></label>
                                <select name="district_id" id="district_id" class="form-control input-lg">
                                    <option value="">Select District</option>
                                    <?php
                                foreach($districts as $row)
                                {
                                    echo '<option value="'.$row["district_id"].'">'.$row["district_name"].'</option>';
                                }
                                ?>
                                </select>
                                <?=form_error('district_id','<div class="text-danger">','</div>');?>
                            </div>
                            <div class="form-group">
                                <label for="taluk_name">Taluk Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="taluk_name" id="taluk_name"
                                    value="<?php echo set_value('taluk_name'); ?>">
                                <?=form_error('taluk_name','<div class="text-danger">','</div>');?>
                            </div>
                            <div class="form-group">
                                <label for="taluk_name_vernacular">Vernacular Taluk Name</label>
                                <input type="text" class="form-control" name="taluk_name_vernacular"
                                    id="taluk_name_vernacular"
                                    value="<?php echo set_value('taluk_name_vernacular'); ?>">
                                <?=form_error('taluk_name_vernacular','<div class="text-danger">','</div>');?>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-success btn-sm">Add</button>
                            <a href="<?=base_url();?>admin/taluks" class="btn btn-dark btn-sm float-right"
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

<script>
$(document).ready(function() {
    var base_url = '<?php echo base_url(); ?>';



});
</script>