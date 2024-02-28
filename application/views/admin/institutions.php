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
                        <a href="<?php echo base_url('admin/addinstitutions/');?>"><button type="button"
                                class="btn btn-block btn-sm btn-outline-primary"><i class="fas fa-plus"></i> Add
                                Institutions</button></a>
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
                                                href="<?php echo base_url('admin/viewinstitution/' . $institution['institution_id']); ?>"><?php echo "#".$institution['institution_code']; ?></a>
                                        </td>
                                        <!-- <td><?php echo $institution['institution_name_vernacular']; ?></td> -->
                                        <td>
                                            <?php 
                                                $place_name = $this->admin_model->get_field_value('place_name', 'places', 'place_id',$institution['place_id']); 
                                                echo ($place_name) ? $place_name : "<span class='text-danger'>-- MISSING --</span>";
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
                                            <a href="<?php echo base_url('admin/managecourses/' . $institution['institution_id']); ?>"
                                                class="btn btn-success btn-sm"><i class="fas fa-book"></i> Courses</a>
                                            <a href="<?php echo base_url('admin/editinstitution/' . $institution['institution_id']); ?>"
                                                class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Edit</a>
                                            <a href="<?php echo base_url('admin/deleteinstitution/' . $institution['institution_id']); ?>"
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure you want to delete this institution?')"><i
                                                    class="fas fa-trash">
                                                </i> Delete</a>
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