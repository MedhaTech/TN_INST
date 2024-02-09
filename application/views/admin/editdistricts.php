<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit District</h1>
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
                            <?php echo form_open('admin/editdistrict/' . $district['district_id']); ?>
                            <div class="card-body">
         
                                <div class="form-group">
                                    <label for="district_name">District Name:</label>
                                    <input type="text" class="form-control" name="district_name" id="district_name" value="<?php echo set_value('district_name', $district['district_name']); ?>">

                                </div>
                                <div class="form-group">
                                    <label for="district_name_vernacular">Vernacular District Name:</label>
                                    <input type="text" class="form-control" name="district_name_vernacular" id="district_name_vernacular" value="<?php echo set_value('district_name_vernacular', $district['district_name_vernacular']); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="district_headquarters">District Headquarters:</label>
                                    <input type="text" class="form-control" name="district_headquarters" id="district_headquarters" value="<?php echo set_value('district_headquarters', $district['district_headquarters']); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="district_headquarters_vernacular">Vernacular District Name:</label>
                                    <input type="text" class="form-control" name="district_headquarters_vernacular" id="district_headquarters_vernacular" value="<?php echo set_value('district_headquarters_vernacular', $district['district_headquarters_vernacular']); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="status">Status:</label>
                                    <select class="form-control" name="status" id="status">
                                    <option value="ACTIVE" <?php echo ($district['status'] == 'ACTIVE') ? 'selected' : ''; ?>>Active</option>
                                        <option value="INACTIVE" <?php echo ($district['status'] == 'INACTIVE') ? 'selected' : ''; ?>>Inactive</option>
                                        <option value="DELETED" <?php echo ($district['status'] == 'DELETED') ? 'selected' : ''; ?>>Deleted</option>
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