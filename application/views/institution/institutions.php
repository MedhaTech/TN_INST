<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12 text-center">
                    <h4 class="text-danger">Choose your institution and enter the programmes run by your institution
                        currently</h4>
                    <h6 class="text-primary">If you do not find your institution listed here, please send a whatsapp
                        message to
                        Thiru.Shunmugaraj, +91-9445327750</h6>
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
                                        <!-- <th>Institution Code</th> -->
                                        <th width="30%">Institution Name</th>
                                        <th width="30%">Vernacular Institution Name</th>
                                        <th width="10%">Place</th>
                                        <!-- <th>Status</th> -->
                                        <th width="25%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; foreach ($institutions as $institution) : ?>
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo $institution['institution_name']; ?> <br />
                                            <a
                                                href="<?php echo base_url('institution/viewinstitution/' . $institution['institution_id']); ?>"><?php echo "#".$institution['institution_code']; ?></a>
                                        </td>
                                        <td><?php echo $institution['institution_name_vernacular']; ?></td>
                                        <td><?php echo $this->admin_model->get_field_value('place_name', 'places', 'place_id',$institution['place_id']); ?>
                                        </td>
                                        <!-- <td><?php echo $institution['status']; ?></td> -->
                                        <td class="text-right">
                                            <a href="<?php echo base_url('institution/viewinstitution/' . $institution['institution_id']); ?>"
                                                class="btn btn-warning btn-sm"><i class="fas fa-eye"></i> View</a>
                                            <a href="<?php echo base_url('institution/managecourses/' . $institution['institution_id']); ?>"
                                                class="btn btn-success btn-sm"><i class="fas fa-book"></i> Courses</a>
                                            <a href="<?php echo base_url('institution/editinstitution/' . $institution['institution_id']); ?>"
                                                class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Edit</a>
                                        </td>
                                    </tr>
                                    <?php  endforeach; ?>
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