<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Place</h1>
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



                            <?php echo validation_errors(); ?>
                            <?php echo form_open('admin/editplaces/' . $place['place_id']); ?>
                            <div class="card-body">
                                                        
                                <div class="form-group">
                                <label for="status">Block Name:</label>
                                <select name="block_id" id="block_id" class="form-control input-lg">
                                <option value="">Select Block</option>
                                <?php
                                foreach($blocks as $row)
                                {
                                    echo '<option value="'.$row["block_id"].'">'.$row["block_name"].'</option>';
                                }
                                ?>
                                </select>
                                </div>
                                <div class="form-group">
                                    <label for="place_type">Place Type:</label>
                                    <select class="form-control" name="place_type" id="place_type">
                                        <option value="METRO" <?php echo ($place['place_type'] == 'METRO') ? 'selected' : ''; ?>>Metro</option>
                                        <option value="URBAN" <?php echo ($place['place_type'] == 'URBAN') ? 'selected' : ''; ?>> Urban</option>
                                        <option value="SEMI-URBAN" <?php echo ($place['place_type'] == 'SEMI-URBAN') ? 'selected' : ''; ?>>Semi-urban</option>
                                        <option value="RURAL" <?php echo ($place['place_type'] == 'RURAL') ? 'selected' : ''; ?>> Rural</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="place_name">Place Name:</label>
                                    <input type="text" class="form-control" name="place_name" id="place_name" value="<?php echo set_value('place_name', $place['place_name']); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="place_name_vernacular">Vernacular Place Name:</label>
                                    <input type="text" class="form-control" name="place_name_vernacular" id="place_name_vernacular" value="<?php echo set_value('block_name_vernacular', $place['place_name_vernacular']); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="pincode">Pincode</label>
                                    <input type="text" class="form-control" name="pincode" id="pincode" value="<?php echo set_value('block_name_vernacular', $place['pincode']); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="status">Status:</label>
                                    <select class="form-control" name="status" id="status">
                                        <option value="ACTIVE" <?php echo ($place['status'] == 'ACTIVE') ? 'selected' : ''; ?>>Active</option>
                                        <option value="INACTIVE" <?php echo ($place['status'] == 'INACTIVE') ? 'selected' : ''; ?>>Inactive</option>
                                        <option value="DELETED" <?php echo ($place['status'] == 'DELETED') ? 'selected' : ''; ?>>Deleted</option>
                                    </select>
                                </div>
                               
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
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