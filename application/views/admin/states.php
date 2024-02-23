<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">

    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header ui-sortable-handle" style="cursor: move;">
                            <h3 class="card-title">
                                <i class="fas fa-server mr-1"></i>
                                <?=$pageTitle;?>
                            </h3>
                            <div class="card-tools">
                                <ul class="nav nav-pills ml-auto">
                                    <li class="nav-item">
                                        <a class="btn btn-block btn-sm btn-outline-primary"
                                            href="<?php echo base_url('admin/addstates/');?>"><i
                                                class="fas fa-plus"></i> Add
                                            State</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-hover table-striped projects">
                                <thead>
                                    <tr>
                                        <th width="10%">No </th>
                                        <th width="25%">State Name</th>
                                        <th width="40%">Vernacular State Name</th>
                                        <!-- <th>Status</th> -->
                                        <th width="25%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; foreach ($states as $state) : ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $state['state_name']; ?></td>
                                        <td><?php echo $state['state_name_vernacular']; ?></td>
                                        <!-- <td><?php echo $state['status']; ?></td> -->
                                        <td>
                                            <a href="<?php echo base_url('admin/editstates/' . $state['state_id']); ?>"
                                                class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Edit</a>
                                            <a href="<?php echo base_url('admin/deletestates/' . $state['state_id']); ?>"
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure you want to delete this state?')"><i
                                                    class="fas fa-trash">
                                                </i> Delete</a>
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