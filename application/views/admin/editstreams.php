<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Stream</h1>
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
                            <h3 class="card-title text-uppercase">EDIT STREAM</h3>
                        </div>
                            
                            <?php echo form_open('admin/editstreams/' . $stream['stream_id']); ?>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="stream_name">Stream Name:</label>
                                    <input type="text" class="form-control" name="stream_name" id="stream_name" value="<?php echo set_value('stream_name', $stream['stream_name']); ?>">
                                    <?=form_error('stream_name','<div class="text-danger">','</div>');?>
                                </div>
                                <div class="form-group">
                                    <label for="stream_short_form"> Stream Short Form:</label>
                                    <input type="text" class="form-control" name="stream_short_form" id="stream_short_form" value="<?php echo set_value('stream_short_form', $stream['stream_short_form']); ?>">
                                    <?=form_error('stream_short_form','<div class="text-danger">','</div>');?>
                                </div>
                                <div class="form-group">
                                    <label for="sort_order">Sort Order:</label>
                                    <input type="number" min="1" class="form-control" name="sort_order" id="sort_order" value="<?php echo set_value('sort_order', $stream['sort_order']); ?>">
                                    <?=form_error('sort_order','<div class="text-danger">','</div>');?>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status:</label>
                                    <select class="form-control" name="status" id="status">
                                        <option value="ACTIVE" <?php echo ($stream['status'] == 'ACTIVE') ? 'selected' : ''; ?>>Active</option>
                                        <option value="INACTIVE" <?php echo ($stream['status'] == 'INACTIVE') ? 'selected' : ''; ?>>Inactive</option>
                                        <option value="DELETED" <?php echo ($stream['status'] == 'DELETED') ? 'selected' : ''; ?>>Deleted</option>
                                    </select>
                                    <?=form_error('status','<div class="text-danger">','</div>');?>
                                </div>

                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-success btn-sm">Update</button>
                                <a href="<?=base_url();?>admin/streams" class="btn btn-dark btn-sm float-right" role="button">Cancel</a>
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