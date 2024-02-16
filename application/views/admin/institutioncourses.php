<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Institutional Courses</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                        <a href="<?php echo base_url('admin/addinstitutioncourses/');?>"><button type="button" class="btn btn-block btn-outline-primary">Add Institutional Courses</button></a>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"></h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Sl.No</th>
                                            <th>Institution ID</th>
                                            <th>Stream ID</th>
                                            <th>Course Duration</th>
                                            <th>Course Category</th>
                                            <th>Special Category</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=1; foreach ($institutioncourses as $institutioncourse) : ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $this->admin_model->get_field_value('institution_name', 'institutions', 'institution_id',$institutioncourse['institution_id']); ?></td>
                                                <td><?php echo $this->admin_model->get_field_value('stream_name', 'streams', 'stream_id',$institutioncourse['stream_id']); ?></td>
                                                <td><?php echo $institutioncourse['course_duration']; ?></td>
                                                <td><?php echo $institutioncourse['course_category']; ?></td>
                                                <td><?php echo $institutioncourse['special_category']; ?></td>
                                                <td><?php echo $institutioncourse['status']; ?></td>
                                                <td>
                                                    <a href="<?php echo base_url('admin/editinstitutioncourses/' . $institutioncourse['institution_course_id']); ?>">Edit</a>
                                                    <a href="<?php echo base_url('admin/deleteinstitutioncourses/' . $institutioncourse['institution_course_id']); ?>" onclick="return confirm('Are you sure you want to delete this institutioncourse?')">Delete</a>
                                                </td>
                                            </tr>
                                        <?php $i++; endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Sl.N0</th>
                                            <th>Institution ID</th>
                                            <th>Stream ID</th>
                                            <th>Course Duration</th>
                                            <th>Course Category</th>
                                            <th>Special Category</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>