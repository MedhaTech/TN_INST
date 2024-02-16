<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Block</h1>
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



                            
                            <?php echo form_open('admin/editblocks/' . $block['block_id']); ?>
                            <div class="card-body">
                                                        
                                <div class="form-group">
                                <label for="status">District Name:</label>
                                <select name="district_id" id="district_id" class="form-control input-lg select2">
                                <option value="">Select District</option>
                                <?php
                                foreach($districts as $row)
                                {
                                    echo '<option value="'.$row["district_id"].'">'.$row["district_name"].'</option>';
                                }
                                ?>
                                </select>
                                </div>
                                <div class="form-group">
                                    <label for="block_name">Block Name:</label>
                                    <input type="text" class="form-control" name="block_name" id="block_name" value="<?php echo set_value('block_name', $block['block_name']); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="block_name_vernacular">Vernacular Block Name:</label>
                                    <input type="text" class="form-control" name="block_name_vernacular" id="block_name_vernacular" value="<?php echo set_value('block_name_vernacular', $block['block_name_vernacular']); ?>">
                                    <?=form_error('block_name_vernacular','<div class="text-danger">','</div>');?>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status:</label>
                                    <select class="form-control" name="status" id="status">
                                        <option value="ACTIVE" <?php echo ($block['status'] == 'ACTIVE') ? 'selected' : ''; ?>>Active</option>
                                        <option value="INACTIVE" <?php echo ($block['status'] == 'INACTIVE') ? 'selected' : ''; ?>>Inactive</option>
                                        <option value="DELETED" <?php echo ($block['status'] == 'DELETED') ? 'selected' : ''; ?>>Deleted</option>
                                    </select>
                                    <?=form_error('status','<div class="text-danger">','</div>');?>
                                </div>
                               
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="<?=base_url();?>admin/blocks" class="btn btn-primary float-right" role="button">Cancel</a>
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