<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Institution Principals</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                        <a href="<?php echo base_url('admin/addinstitutionprincipals/');?>"><button type="button" class="btn btn-block btn-outline-primary">Add Institution Principals</button></a>
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
                                            <th>Institution Type</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($institutiontypes as $institutiontype) : ?>
                                            <tr>
                                                <td><?php echo $institutiontype['institution_type_id']; ?></td>
                                                <td><?php echo $institutiontype['institution_type']; ?></td>
                                                <td><?php echo $institutiontype['status']; ?></td>
                                                <td>
                                                    <a href="<?php echo base_url('admin/editinstitutiontypes/' . $institutiontype['institution_type_id']); ?>">Edit</a>
                                                    <a href="<?php echo base_url('admin/deleteinstitutiontypes/' . $institutiontype['institution_type_id']); ?>" onclick="return confirm('Are you sure you want to delete this state?')">Delete</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                        <th>Sl. No </th>
                                            <th>Institution Type</th>
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