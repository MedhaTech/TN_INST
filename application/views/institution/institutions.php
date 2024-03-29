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
                        Thiru.Shunmugaraj, <b> <i class="fab fa-whatsapp text-success"></i> <a
                                href="https://wa.me/9445327750" target="_blank" class="text-success"> +91-9445327750</a>
                        </b> </h6>
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
                                        <th width="40%">Institution Name</th>
                                        <th width="15%">Place</th>
                                        <th width="10%">Courses</th>
                                        <!-- <th>Status</th> -->
                                        <th width="25%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; foreach ($institutions as $institution) :
                                        $courses_count = $this->admin_model->row_count('institutional_courses', 'institution_id', $institution['institution_id']);
                                    ?>
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo $institution['institution_name']; ?> <br />
                                            <a
                                                href="<?php echo base_url('institution/viewinstitution/' . $institution['institution_id']); ?>"><?php echo "#".$institution['institution_code']; ?></a>
                                        </td>
                                        <!-- <td><?php echo $institution['institution_name_vernacular']; ?></td> -->

                                        <td>
                                            <?php $place_name =  $this->admin_model->get_field_value('place_name', 'places', 'place_id',$institution['place_id']); 
                                                echo ($place_name) ? $place_name : "<span class='text-danger'>Missing</span>";
                                            ?>
                                        </td>
                                        <td class="text-center">
                                            <?php if($courses_count){
                                                echo '<span class="badge badge-success h2">'.$courses_count.'</span>';
                                            }else{
                                            echo '<span class="badge badge-danger h2">'.$courses_count.'</span>';
                                            }
                                            ?>
                                        </td>
                                        <!-- <td><?php echo $institution['status']; ?></td> -->
                                        <td class="text-right">
                                            <a href="<?php echo base_url('institution/managecourses/' . $institution['institution_id']); ?>"
                                                class="btn btn-success btn-sm"><i class="fas fa-book"></i> Courses</a>
                                            <a href="<?php echo base_url('institution/viewinstitution/' . $institution['institution_id']); ?>"
                                                class="btn btn-warning btn-sm"><i class="fas fa-eye"></i> View</a>
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