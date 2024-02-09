<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Institutional Course</h1>
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
                            <?php echo form_open('admin/editinstitutioncourses/' .$institutioncourse['institution_course_id']); ?>
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
                                <option value="">Select Stream </option>
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
                                        <option value="2" <?php echo ($institutioncourse['course_duration'] == '2') ? 'selected' : ''; ?>>2</option>
                                        <option value="3" <?php echo ($institutioncourse['course_duration'] == '3') ? 'selected' : ''; ?>> 3</option>
                                        <option value="4" <?php echo ($institutioncourse['course_duration'] == '4') ? 'selected' : ''; ?>>4</option>
                                        <option value="5" <?php echo ($institutioncourse['course_duration'] == '5') ? 'selected' : ''; ?>> 5</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="course_category">Course Category:</label>
                                    <select class="form-control" name="course_category" id="course_category">
                                        <option value="UG" <?php echo ($institutioncourse['course_category'] == 'UG') ? 'selected' : ''; ?>>UG</option>
                                        <option value="PG" <?php echo ($institutioncourse['course_category'] == 'PG') ? 'selected' : ''; ?>>PG</option>
                                        <option value="DIPLOMA" <?php echo ($institutioncourse['course_category'] == 'DIPLOMA') ? 'selected' : ''; ?>>DIPLOMA</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="special_category">Special Category:</label>
                                    <select class="form-control" name="special_category" id="special_category">
                                        <option value="0" <?php echo ($institutioncourse['special_category'] == '0') ? 'selected' : ''; ?>>0</option>
                                        <option value="1" <?php echo ($institutioncourse['special_category'] == '1') ? 'selected' : ''; ?>>1</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status:</label>
                                    <select class="form-control" name="status" id="status">
                                        <option value="ACTIVE" <?php echo ($institutioncourse['status'] == 'ACTIVE') ? 'selected' : ''; ?>>Active</option>
                                        <option value="INACTIVE" <?php echo ($institutioncourse['status'] == 'INACTIVE') ? 'selected' : ''; ?>>Inactive</option>
                                        <option value="DELETED" <?php echo ($institutioncourse['status'] == 'DELETED') ? 'selected' : ''; ?>>Deleted</option>
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