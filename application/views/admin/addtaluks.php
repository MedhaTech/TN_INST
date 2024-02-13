<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add Taluk</h1>
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



                            
                            <?php echo form_open('admin/addtaluks'); ?>
                            <div class="card-body">
                                                        
                                <div class="form-group">
                                <label for="status">Block Name:</label>
                                <select name="block_id" id="block_id" class="form-control input-lg select2">
                                <option value="">Select Block</option>
                                <?php
                                foreach($blocks as $row)
                                {
                                    echo '<option value="'.$row["block_id"].'">'.$row["block_name"].'</option>';
                                }
                                ?>
                                </select>
                                <?=form_error('block_name','<div class="text-danger">','</div>');?>
                                </div>
                                <div class="form-group">
                                    <label for="taluk_name">Taluk Name</label>
                                    <input type="text" class="form-control" name="taluk_name" id="taluk_name" value="<?php echo set_value('taluk_name'); ?>">
                                    <?=form_error('taluk_name','<div class="text-danger">','</div>');?>
                                </div>
                                <div class="form-group">
                                    <label for="taluk_name_vernacular">Vernacular Taluk Name:</label>
                                    <input type="text" class="form-control" name="taluk_name_vernacular" id="taluk_name_vernacular" value="<?php echo set_value('taluk_name_vernacular'); ?>">
                                    <?=form_error('taluk_name_vernacular','<div class="text-danger">','</div>');?>
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
                                <a href="<?=base_url();?>admin/taluks" class="btn btn-primary float-right" role="button">Cancel</a>
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