<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12 text-center">
                    <h5 class="text-danger">Please make note of the Institution Code for future Mentor Registration and
                        access to the Institution Panel.</h5>
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


                <div class="col-md-10 offset-md-1">

                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">Institution Details</h3>
                        </div>
                        <?php echo form_open('institution/viewinstitution/' . $institution['institution_id']); ?>
                        <div class="card-body">
                            <div class="ribbon-wrapper ribbon-xl">
                                <div class="ribbon bg-warning text-lg">
                                    <?php echo $institution['institution_code']; ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-8">
                                        <p class="institution_code text-md">Institution Code :
                                            <b class="d-block"><span class="bg-warning"
                                                    id="text-to-copy"><?php echo $institution['institution_code']; ?>
                                                </span> <a href="#"><i class="far fa-copy pl-3"
                                                        id="copy-button"></i></a></b>
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
                                            <b class="d-block"><?php echo ($institution['principal_name']) ? $institution['principal_name'] : "--"; ?>
                                            </b>
                                        </p>
                                    </div>
                                    <div class="col-md-3">
                                        <p class="principal_name text-sm">Principal Mobile :
                                            <b class="d-block"><?php echo ($institution['principal_mobile']) ? $institution['principal_mobile'] : "--"; ?>
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
                                            <b
                                                class="d-block"><?php echo ($geos['place_name']) ? $geos['place_name'] : "<span style='color:red;'>--</span>"; ?></b>
                                        </p>
                                    </div>
                                    <div class="col-md-3">
                                        <p class="taluk_name text-sm">Taluk Name :
                                            <b
                                                class="d-block"><?php echo ($geos['taluk_name']) ? $geos['taluk_name'] : "<span style='color:red;'>--</span>"; ?></b>
                                        </p>
                                    </div>
                                    <div class="col-md-3">
                                        <p class="block_name text-sm">Block Name :
                                            <b
                                                class="d-block"><?php echo ($geos['block_name']) ? $geos['block_name'] : "<span style='color:red;'>--</span>"; ?></b>
                                        </p>
                                    </div>
                                    <div class="col-md-3">
                                        <p class="district_name text-sm">District Name :
                                            <b
                                                class="d-block"><?php echo ($geos['district_name']) ? $geos['district_name'] : "<span style='color:red;'>--</span>"; ?></b>
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
                                                    <th width="25%">Institution Type</th>
                                                    <th width="30%">Stream Name</th>
                                                    <th width="40%">Program Name</th>
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

<script>
$(document).ready(function() {
    $('#copy-button').click(function() {
        var textToCopy = $('#text-to-copy').text();
        var tempTextarea = $('<textarea>');
        $('body').append(tempTextarea);
        tempTextarea.val(textToCopy).select();
        document.execCommand('copy');
        tempTextarea.remove();
        alert("Copied");
    });
});
</script>