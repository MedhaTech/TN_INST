<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Taluks</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                        <a href="<?php echo base_url('admin/addtaluks/');?>"><button type="button" class="btn btn-block btn-outline-primary">Add Taluks</button></a>
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
                                            <th>Block Name</th>
                                            <th>Taluk Name</th>
                                            <th>Vernacular Taluk Name</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=1; foreach ($taluks as $taluk) : ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $this->admin_model->get_field_value('block_name', 'blocks', 'block_id',$taluk['block_id']); ?></td>
                                                <td><?php echo $taluk['taluk_name']; ?></td>
                                                <td><?php echo $taluk['taluk_name_vernacular']; ?></td>
                                                <td><?php echo $taluk['status']; ?></td>
                                                <td>
                                                    <a href="<?php echo base_url('admin/edittaluks/' . $taluk['taluk_id']); ?>">Edit</a>
                                                    <a href="<?php echo base_url('admin/deletetaluks/' . $taluk['taluk_id']); ?>" onclick="return confirm('Are you sure you want to delete this state?')">Delete</a>
                                                </td>
                                            </tr>
                                        <?php $i++; endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                        <th>Sl. No </th>
                                            <th>Block Name</th>
                                            <th>Taluk Name</th>
                                            <th>Vernacular Taluk Name</th>
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