<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Programs</h1>
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
                                <h3 class="card-title text-uppercase">EDIT PROGRAM</h3>
                            </div>
                            <?php echo form_open('admin/editprograms/' . $program['program_id']); ?>
                            <div class="card-body">
                                                        
                                <div class="form-group">
                                    <label for="program_name">Program Name:</label>
                                    <input type="text" class="form-control" name="program_name" id="program_name" value="<?php echo set_value('program_name', $program['program_name']); ?>">
                                    <?=form_error('program_name','<div class="text-danger">','</div>');?>
                                </div>
                                <div class="form-group">
                                    <label for="program_short_name">Program Short Name:</label>
                                    <input type="text" class="form-control" name="program_short_name" id="program_short_name" value="<?php echo set_value('program_short_name', $program['program_short_name']); ?>">
                                    <?=form_error('program_short_name','<div class="text-danger">','</div>');?>
                                </div>
                                <div class="form-group">
                                    <label for="no_of_years">Number of Years:</label>
                                    <select class="form-control" name="no_of_years" id="no_of_years">
                                        <option value="1" <?php echo ($program['no_of_years'] == '1') ? 'selected' : ''; ?>>1</option>
                                        <option value="2" <?php echo ($program['no_of_years'] == '2') ? 'selected' : ''; ?>> 2</option>
                                        <option value="3" <?php echo ($program['no_of_years'] == '3') ? 'selected' : ''; ?>>3</option>
                                        <option value="4" <?php echo ($program['no_of_years'] == '4') ? 'selected' : ''; ?>>4</option>
                                        <option value="5" <?php echo ($program['no_of_years'] == '5') ? 'selected' : ''; ?>>5</option>
                                        <option value="6" <?php echo ($program['no_of_years'] == '6') ? 'selected' : ''; ?>>6</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="program_type">Program Type:</label>
                                    <select class="form-control" name="program_type" id="program_type">
                                        <option value="UG" <?php echo ($program['program_type'] == 'UG') ? 'selected' : ''; ?>>Ug</option>
                                        <option value="PG" <?php echo ($program['program_type'] == 'PG') ? 'selected' : ''; ?>> Pg</option>
                                        <option value="DIPLOMA" <?php echo ($program['program_type'] == 'DIPLOMA') ? 'selected' : ''; ?>>Diploma</option>
                                        
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="stream_short_form">Sort Order:</label>
                                    <input type="number" min="1" class="form-control" name="sort_order" id="sort_order" value="<?php echo set_value('sort_order', $program['sort_order']); ?>">
                                    <?=form_error('sort_order','<div class="text-danger">','</div>');?>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status:</label>
                                    <select class="form-control" name="status" id="status">
                                        <option value="ACTIVE" <?php echo ($program['status'] == 'ACTIVE') ? 'selected' : ''; ?>>Active</option>
                                        <option value="INACTIVE" <?php echo ($program['status'] == 'INACTIVE') ? 'selected' : ''; ?>>Inactive</option>
                                        <option value="DELETED" <?php echo ($program['status'] == 'DELETED') ? 'selected' : ''; ?>>Deleted</option>
                                    </select>
                                </div>
                               
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-success btn-sm">Update</button>
                                <a href="<?=base_url();?>admin/programs" class="btn btn-dark btn-sm float-right" role="button">Cancel</a>
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