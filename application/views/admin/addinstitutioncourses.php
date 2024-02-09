<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add Institutional Course</h1>
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
                            <?php echo form_open('admin/addinstitutioncourses'); ?>
                            <div class="card-body">
                              <div class="form-group">
                                <label for="status">Institution Name:</label>
                                <select name="institution_id" id="institution_id" class="form-control input-lg">
                                <option value="">Select Institution Name</option>
                                <?php
                                foreach($institutions as $row)
                                {
                                    echo '<option value="'.$row["institution_id"].'">'.$row["institution_name"].'</option>';
                                }
                                ?>
                                </select>
                                </div>
                                <div class="form-group">
                                <label for="status">Stream Name:</label>
                                <select name="stream_id" id="stream_id" class="form-control input-lg">
                                <option value="">Select Stream</option>
                                <?php
                                foreach($streams as $row)
                                {
                                    echo '<option value="'.$row["stream_id"].'">'.$row["stream_name"].'</option>';
                                }
                                ?>
                                </select>
                                </div>
                                <div class="form-group">
                                <label for="course_duration">Course Duration:</label>
                                    <select class="form-control" name="course_duration" id="course_duration">
                                    
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                <label for="course_category">Course Category:</label>
                                    <select class="form-control" name="course_category" id="course_category">
                                        <option value="UG">UG</option>
                                        <option value="PG">PG</option>
                                        <option value="DIPLOMA">DIPLOMA</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="special_category">Special Category:</label>
                                    <select class="form-control" name="special_category" id="special_category">
                                        <option value="0">0</option>
                                        <option value="1">1</option>
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