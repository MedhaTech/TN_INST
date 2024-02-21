<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Institution Types</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                        <a href="<?php echo base_url('admin/addinstitutiontypes/');?>"><button type="button"
                         class="btn btn-block btn-sm btn-outline-primary"><i class="fas fa-plus"></i>Add Institution Types</button></a>
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
                                <table id="example2" class="table table-hover table-striped projects">
                                    <thead>
                                        <tr>
                                            <th width="15%">Sl. No </th>
                                            <th width="30%">Institution Type</th>
                                            <th width="40%">Short Name</th>
                                            <!-- <th >Status</th> -->
                                            <th width="25%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=1; foreach ($institutiontypes as $institutiontype) : ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $institutiontype['institution_type']; ?></td>
                                                <td><?php echo $institutiontype['institution_short_name']; ?></td>
                                                <!-- <td><?php echo $institutiontype['status']; ?></td> -->
                                                <td>
                                                    <a href="<?php echo base_url('admin/editinstitutiontypes/' . $institutiontype['institution_type_id']); ?>"class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i>Edit</a>
                                                    <a href="<?php echo base_url('admin/deleteinstitutiontypes/' . $institutiontype['institution_type_id']); ?>" 
                                                    class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure you want to delete this institutiontype?')"><i class="fas fa-trash"></i>Delete</a>
                                                </td>
                                            </tr>
                                        <?php $i++; endforeach; ?>
                                    </tbody>

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