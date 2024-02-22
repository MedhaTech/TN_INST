<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Places</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                        <a href="<?php echo base_url('admin/addplaces/');?>"><button type="button"
                         class="btn btn-block btn-sm btn-outline-primary"><i class="fas fa-plus"></i> Add Places</button></a>
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
                                            <th width="10%">No </th>
                                            <th width="14%">Taluk Name</th>
                                            <th width="15%">Place Type</th>
                                            <th width="15%">Place Name</th>
                                            <th width="14%">Vernacular Place Name</th>
                                            <th width="14%">Pincode</th>
                                            <!-- <th>Status</th> -->
                                            <th width="28%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=1; foreach ($places as $place) : ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $this->admin_model->get_field_value('taluk_name', 'taluks', 'taluk_id',$place['taluk_id']); ?></td>
                                                <td><?php echo $place['place_type']; ?></td>
                                                <td><?php echo $place['place_name']; ?></td>
                                                <td><?php echo $place['place_name_vernacular']; ?></td>
                                                <td><?php echo $place['pincode']; ?></td>
                                                <!-- <td><?php echo $place['status']; ?></td> -->
                                                <td>
                                                    <a href="<?php echo base_url('admin/editplaces/' . $place['place_id']); ?>"class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Edit</a>
                                                    <a href="<?php echo base_url('admin/deleteplaces/' . $place['place_id']); ?>" 
                                                    class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure you want to delete this place?')"><i class="fas fa-trash"></i> Delete</a>
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