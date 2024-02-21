<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Programs</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                        <a href="<?php echo base_url('admin/addprograms/');?>"><button type="button" class="btn btn-block btn-outline-primary">Add Programs</button></a>
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
                                        <th>Sl. No </th>
                                            
                                            <th>Program Name</th>
                                            <th>Program Short Name</th>
                                            <th>Number of years</th>
                                            <th>Program Type</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=1; foreach ($programs as $program) : ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                
                                                <td><?php echo $program['program_name']; ?></td>
                                                <td><?php echo $program['program_short_name']; ?></td>
                                                <td><?php echo $program['no_of_years']; ?></td>
                                                <td><?php echo $program['program_type']; ?></td>
                                                <td><?php echo $program['status']; ?></td>
                                                <td>
                                                    <a href="<?php echo base_url('admin/editprograms/' . $program['program_id']); ?>">Edit</a>
                                                    <a href="<?php echo base_url('admin/deleteprograms/' . $program['program_id']); ?>" onclick="return confirm('Are you sure you want to delete this program?')">Delete</a>
                                                </td>
                                            </tr>
                                        <?php $i++; endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                        <th>Sl. No </th>
                                        
                                            <th>Program Name</th>
                                            <th>Program Short Name</th>
                                            <th>Number of years</th>
                                            <th>Program Type</th>
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
