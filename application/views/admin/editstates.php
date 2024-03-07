<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <!-- <div class="col-sm-6">
                        <h1>Edit State</h1>
                    </div> -->
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
                            <h3 class="card-title text-uppercase">Edit State</h3>
                        </div>
                            <?php echo form_open('admin/editstates/' . $state['state_id']); ?>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="state_name">State Name:<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="state_name" id="state_name" value="<?php echo set_value('state_name', $state['state_name']); ?>">
                                    <?=form_error('state_name','<div class="text-danger">','</div>');?>
                                </div>
                                <div class="form-group">
                                    <label for="state_name_vernacular">Vernacular State Name:</label>
                                    <input type="text" class="form-control" name="state_name_vernacular" id="state_name_vernacular" value="<?php echo set_value('state_name_vernacular', $state['state_name_vernacular']); ?>">
                                    <?=form_error('state_name_vernacular','<div class="text-danger">','</div>');?>
                                </div>
                                <!-- <div class="form-group">
                                    <label for="status">Status:<span class="text-danger">*</span></label>
                                    <select class="form-control" name="status" id="status">
                                        <option value="ACTIVE" <?php echo ($state['status'] == 'ACTIVE') ? 'selected' : ''; ?>>Active</option>
                                        <option value="INACTIVE" <?php echo ($state['status'] == 'INACTIVE') ? 'selected' : ''; ?>>Inactive</option>
                                        <option value="DELETED" <?php echo ($state['status'] == 'DELETED') ? 'selected' : ''; ?>>Deleted</option>
                                    </select>
                                    <?=form_error('status','<div class="text-danger">','</div>');?>
                                </div> -->

                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-success btn-sm">Update</button>
                                <a href="<?=base_url();?>admin/states" class="btn btn-dark btn-sm float-right" role="button">Cancel</a>
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