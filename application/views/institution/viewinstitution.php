<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <!-- <h1>View Institution Details</h1> -->
                </div>
                <div class="col-sm-6">
                    <!-- <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">DataTables</li>
                        </ol> -->
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">


                <div class="col-md-10 offset-md-1">

                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">Institution Details</h3>
                        </div>
                        <?php echo form_open('institution/viewinstitution/' . $institution['institution_id']); ?>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-8">
                                        <p class="institution_code text-sm">Institution Code :
                                            <b class="d-block"><?php echo $institution['institution_code']; ?> </b>
                                        </p>
                                    </div>
                                    <div class="col-md-4">
                                        <p class="staus text-sm">Status :
                                            <b class="d-block"><?php echo $institution['status']; ?></b>
                                        </p>
                                    </div>
                                </div>

                                <p class="institution_name text-sm">Institution Name :
                                    <b class="d-block"><?php echo $institution['institution_name']; ?> </b>
                                </p>
                                <p class="institution_name_vernacular text-sm">Vernacular Institution Name :
                                    <b class="d-block"><?php echo ($institution['institution_name_vernacular']) ? $institution['institution_name_vernacular'] : "--"; ?>
                                    </b>
                                </p>
                                <div class="row">
                                    <div class="col-md-3">
                                        <p class="place_id text-sm">Principal Name :
                                            <b class="d-block"><?php echo ($institution['institution_name_vernacular']) ? $institution['institution_name_vernacular'] : "--"; ?>
                                            </b>
                                        </p>
                                    </div>
                                    <div class="col-md-3">
                                        <p class="principal_name text-sm">Principal Mobile :
                                            <b class="d-block"><?php echo ($institution['principal_name']) ? $institution['principal_name'] : "--"; ?>
                                            </b>
                                        </p>
                                    </div>
                                    <div class="col-md-3">
                                        <p class="principal_whatsapp_mobile text-sm">Principal Whatsapp :
                                            <b class="d-block"><?php echo ($institution['principal_whatsapp_mobile']) ? $institution['principal_whatsapp_mobile'] : "--"; ?>
                                            </b>
                                        </p>
                                    </div>
                                    <div class="col-md-3">
                                        <p class="principal_email text-sm">Principal Email :
                                            <b class="d-block"><?php echo ($institution['principal_email']) ? $institution['principal_email'] : "--"; ?>
                                            </b>
                                        </p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <p class="place_id text-sm">Place Name :
                                            <b class="d-block"><?php echo $geos['place_name']; ?></b>
                                        </p>
                                    </div>
                                    <div class="col-md-3">
                                        <p class="taluk_name text-sm">Taluk Name :
                                            <b class="d-block"><?php echo $geos['taluk_name']; ?></b>
                                        </p>
                                    </div>
                                    <div class="col-md-3">
                                        <p class="block_name text-sm">Block Name :
                                            <b class="d-block"><?php echo $geos['block_name']; ?></b>
                                        </p>
                                    </div>
                                    <div class="col-md-3">
                                        <p class="district_name text-sm">District Name :
                                            <b class="d-block"><?php echo $geos['district_name']; ?></b>
                                        </p>
                                    </div>
                                </div>

                                <div class="row pt-2">
                                    <div class="col-md-12">
                                        <?php if($institution_courses){ ?>
                                        <h5 class="text-md text-uppercase text-bold">List of Courses</h5>
                                        <table class="table table-hover text-sm projects">
                                            <thead>
                                                <tr>
                                                    <th width="5%">No </th>
                                                    <th width="15%">Institution Type</th>
                                                    <th width="25%">Stream Name</th>
                                                    <th width="45%">Program Name</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i=1; foreach($institution_courses as $institution_courses1) { ?>
                                                <tr>
                                                    <td><?php echo $i++; ?></td>
                                                    <td><?php echo $institution_courses1->institution_type; ?></td>
                                                    <td><?php echo $institution_courses1->stream_name; ?></td>
                                                    <td><?php echo $institution_courses1->program_name.' ['.$institution_courses1->program_type.' - '.$institution_courses1->no_of_years.' Years]'; ?>
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                        <?php } else {
                                            echo '<h5 class="text-md text-center pt-5 text-danger text-bold"> Courses have not yet been mapped. <br/> Please '.anchor("institution/managecourses/".$institution['institution_id'],"click here").' to initiate the mapping process. </h5>';
                                        } ?>

                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md-8">
                                    <a href="<?php echo base_url('institution/managecourses/' . $institution['institution_id']); ?>"
                                        class="btn btn-success btn-sm"><i class="fas fa-book"></i> Courses</a>
                                    <a href="<?php echo base_url('institution/editinstitution/' . $institution['institution_id']); ?>"
                                        class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Edit</a>
                                </div>
                                <div class="col-md-4">
                                    <a href="<?=base_url();?>institution/institutions"
                                        class="btn btn-dark btn-sm float-right" role="button"><i
                                            class="fas fa-arrow-left"></i> Back to List</a>
                                </div>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>


                </div>



            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
</div>
<!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>