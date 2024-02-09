<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Institutions</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                        <a href="<?php echo base_url('admin/addinstitutions/');?>"><button type="button" class="btn btn-block btn-outline-primary">Add Institutions</button></a>
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
                                            <th>Institution Code</th>
                                            <th>Institution Name</th>
                                            <th>Vernacular Institution Name</th>
                                            <th>Institution Type ID</th>
                                            <th>Place ID</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=1; foreach ($institutions as $institution) : ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $institution['institution_code']; ?></td>
                                                <td><?php echo $institution['institution_name']; ?></td>
                                                <td><?php echo $institution['institution_name_vernacular']; ?></td>
                                                <td><?php echo $this->admin_model->get_field_value('institution_type', 'institutiontypes', 'institution_type_id',$institution['institution_type_id']); ?></td>
                                                <td><?php echo $this->admin_model->get_field_value('place_name', 'places', 'place_id',$institution['place_id']); ?></td>
                                                <td><?php echo $institution['status']; ?></td>
                                                <td>
                                                    <a href="<?php echo base_url('admin/editinstitution/' . $institution['institution_id']); ?>">Edit</a>
                                                    <a href="<?php echo base_url('admin/deleteinstitution/' . $institution['institution_id']); ?>" onclick="return confirm('Are you sure you want to delete this state?')">Delete</a>
                                                </td>
                                            </tr>
                                        <?php $i++; endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                        <th>Sl. No </th>
                                            <th>Institution Code</th>
                                            <th>Institution Name</th>
                                            <th>Vernacular Institution Name</th>
                                            <th>Institution Type ID</th>
                                            <th>Place ID</th>
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