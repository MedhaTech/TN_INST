<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12 text-center">
                    <h4 class="text-danger">Input the courses run by your institution using this page</h4>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <div class="card">
                    <div class="card-body">
                            <div class="form-group mb-0">
                                <div class="row">
                                    <div class="col-md-4">
                                        <p class="institution_code text-sm">Institution Code :
                                            <b class="d-block"><?php echo $institution['institution_code']; ?> </b>
                                        </p>
                                    </div>
                                    <div class="col-md-8">
                                    <p class="institution_name text-sm">Institution Name :
                                    <b class="d-block"><?php echo $institution['institution_name']; ?> </b>
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

                             
                            </div>
                        </div>
                    </div>
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title text-uppercase">Add Course</h3>
                        </div>
                        <div class="card-body">
                            <?php echo form_open('institution/managecourses/'.$institution_id); ?>
                            <div class="row">

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="status" class="text-sm">Institution Type :</label>
                                        <select name="institution_type_id" id="institution_type_id"
                                            class="form-control form-control-sm">
                                            <option value="">Select</option>
                                            <?php foreach($institution_types as $row) {
                                                echo '<option value="'.$row["institution_type_id"].'">'.$row["institution_type"].'</option>';

                                            } ?>
                                        </select>
                                        <?=form_error('institution_type_id','<div class="text-danger">','</div>');?>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="stream_id" class="text-sm">Stream :</label>
                                        <select name="stream_id" id="stream_id" class="form-control form-control-sm">
                                            <option value="">Select</option>
                                            <?php foreach($streams as $row) {
                                                echo '<option value="'.$row["stream_id"].'">'.$row["stream_name"].'</option>';

                                            } ?>
                                        </select>
                                        <?=form_error('stream_id','<div class="text-danger">','</div>');?>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="program_id" class="text-sm">Program :</label>
                                        <select name="program_id" id="program_id" class="form-control form-control-sm">
                                            <option value="">Select</option>
                                            <?php foreach($programs as $row) {
                                                echo '<option value="'.$row["program_id"].'">'.$row["program_name"].'</option>';

                                            } ?>
                                        </select>
                                        <?=form_error('program_id','<div class="text-danger">','</div>');?>
                                    </div>
                                </div>

                                <div class="col-md-3 text-right">
                                    <button type="submit" class="btn btn-success btn-sm mt-4">ADD COURSE</button>
                                    <a href="<?=base_url();?>institution/institutions" class="btn btn-dark btn-sm mt-4"
                                        role="button">CANCEL</a>
                                </div>


                            </div>
                            <?php echo form_close(); ?>
                        </div>

                    </div>
                    <div class="card card-dark">
                        <div class="card-header text-uppercase">
                            List of Assigned Courses
                        </div>
                        <div class="card-body">
                            <table class="table table-hover table-striped table-sm projects">
                                <thead>
                                    <tr>
                                        <th width="5%">No </th>
                                        <th width="15%">Institution Type</th>
                                        <th width="25%">Stream Name</th>
                                        <th width="45%">Program Name</th>
                                        <th width="10%">Action</th>
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
                                        <td>
                                            <a href="<?php echo base_url('institution/deletecourses/'.$institution_courses1->institution_course_id.'/'.$institution_courses1->institution_id); ?>"
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure you want to delete course details?')"><i
                                                    class="fas fa-trash">
                                                </i> Delete</a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>

                        </div>
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
    var base_url = '<?php echo base_url(); ?>';


    $("#district_id").change(function() {
        event.preventDefault();


        var district_id = $("#district_id").val();

        if (district_id == ' ') {
            alert("Please Select District");
        } else {
            $.ajax({
                'type': 'POST',
                'url': base_url + 'institution/BlockList',
                'data': {
                    'district_id': district_id,
                },
                'dataType': 'text',
                'cache': false,
                'success': function(data) {
                    $('select[name="block_id"]').empty();
                    $('select[name="block_id"]').append(data);
                    $('select[name="block_id"]').removeAttr("disabled");
                }
            });

        }
    });
    $("#block_id").change(function() {
        event.preventDefault();


        var block_id = $("#block_id").val();

        if (block_id == ' ') {
            alert("Please Select Blocks");
        } else {
            $.ajax({
                'type': 'POST',
                'url': base_url + 'institution/TalukList',
                'data': {
                    'block_id': block_id,
                },
                'dataType': 'text',
                'cache': false,
                'success': function(data) {
                    $('select[name="taluk_id"]').empty();
                    $('select[name="taluk_id"]').append(data);
                    $('select[name="taluk_id"]').removeAttr("disabled");
                }
            });

        }
    });
    $("#taluk_id").change(function() {
        event.preventDefault();


        var taluk_id = $("#taluk_id").val();

        if (taluk_id == ' ') {
            alert("Please Select Taluks");
        } else {
            $.ajax({
                'type': 'POST',
                'url': base_url + 'institution/PlaceList',
                'data': {
                    'taluk_id': taluk_id,
                },
                'dataType': 'text',
                'cache': false,
                'success': function(data) {
                    $('select[name="place_id"]').empty();
                    $('select[name="place_id"]').append(data);
                    $('select[name="place_id"]').removeAttr("disabled");
                }
            });

        }
    });
});
</script>