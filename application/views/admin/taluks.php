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
                                            href="<?php echo base_url('admin/addtaluks/');?>"><i
                                                class="fas fa-plus"></i> Add
                                            Taluks</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-hover table-striped projects">
                                <thead>
                                    <tr>
                                        <th width="10%">Sl. No </th>
                                        <th width="20%">District Name</th>
                                        <th width="20%">Taluk Name</th>
                                        <th width="20%">Vernacular Taluk Name</th>
                                        <!-- <th>Status</th> -->
                                        <th width="15%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; foreach ($taluks as $taluk) : ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>

                                        <td>
                                            <?php 
                                                $district_name = $this->admin_model->get_field_value('district_name', 'districts', 'district_id',$taluk['district_id']); 
                                                echo ($district_name) ? $district_name : "--";
                                            ?>
                                        </td>
                                        <td><?php echo $taluk['taluk_name']; ?></td>
                                        <td><?php echo $taluk['taluk_name_vernacular']; ?></td>
                                        <!-- <td><?php echo $taluk['status']; ?></td> -->
                                        <td>
                                            <a href="<?php echo base_url('admin/edittaluks/' . $taluk['taluk_id']); ?>"
                                                class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Edit</a>
                                            <a href="<?php echo base_url('admin/deletetaluks/' . $taluk['taluk_id']); ?>"
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure you want to delete this taluk?')"><i
                                                    class="fas fa-trash"></i> Delete</a>
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