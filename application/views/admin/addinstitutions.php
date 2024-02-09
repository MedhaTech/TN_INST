<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add Institution</h1>
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
                            <?php echo form_open('admin/addinstitutions'); ?>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="institution_code">Institution Code:</label>
                                    <input type="text" class="form-control" name="institution_code" id="institution_code" value="<?php echo set_value('institution_code'); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="institution_name">Institution Name:</label>
                                    <input type="text" class="form-control" name="institution_name" id="institution_name" value="<?php echo set_value('institution_name'); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="institution_name_vernacular">Vernacular Institution Name:</label>
                                    <input type="text" class="form-control" name="institution_name_vernacular" id="institution_name_vernacular" value="<?php echo set_value('institution_name_vernacular'); ?>">
                                </div>
                                <div class="form-group">
                                <label for="status">Institution Type:</label>
                                <select name="institution_type_id" id="institution_type_id" class="form-control input-lg">
                                <option value="">Select Institution Type</option>
                                <?php
                                foreach($institution_types as $row)
                                {
                                    echo '<option value="'.$row["institution_type_id"].'">'.$row["institution_type"].'</option>';
                                }
                                ?>
                                </select>
                                </div>
                                <div class="form-group">
                                <label for="status">Place Name:</label>
                                <select name="place_id" id="place_id" class="form-control input-lg">
                                <option value="">Select Place</option>
                                <?php
                                foreach($places as $row)
                                {
                                    echo '<option value="'.$row["place_id"].'">'.$row["place_name"].'</option>';
                                }
                                ?>
                                </select>
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