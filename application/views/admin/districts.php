<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Districts</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                        <a href="<?php echo base_url('admin/adddistricts/');?>">
                        <button type="button"
                         class="btn btn-block btn-sm btn-outline-primary"><i class="fas fa-plus"></i> Add District</button></a>
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
                                            <th width="5%">No </th>
                                          
                                            <th width="12%">lgd Code</th>
                                            <th width="12%">District Name</th>
                                            <th width="15%">Vernacular District Name</th>
                                            <th width="12%">District Short Form</th>
                                            <th width="12%">District Headquarters</th>
                                            <th width="18%">Vernacular District Headquarters</th>
                                            <!-- <th>Status</th> -->
                                            <th width="15%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=1; foreach ($districts as $district) : ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                
                                                <td><?php echo $district['lgd_code']; ?></td>
                                                <td><?php echo $district['district_name']; ?></td>
                                                <td><?php echo $district['district_name_vernacular']; ?></td>
                                                <td><?php echo $district['district_short_form']; ?></td>
                                                <td><?php echo $district['district_headquarters']; ?></td>
                                                <td><?php echo $district['district_headquarters_vernacular']; ?></td>
                                                <!-- <td><?php echo $district['status']; ?></td> -->
                                                <td>
                                                    <a href="<?php echo base_url('admin/editdistrict/' . $district['district_id']); ?>"class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i>Edit</a>
                                                    <a href="<?php echo base_url('admin/deletedistrict/' . $district['district_id']); ?>" 
                                                    class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure you want to delete this districts?')"><i class="fas fa-trash"></i>Delete</a>
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