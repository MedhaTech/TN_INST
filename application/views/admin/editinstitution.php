<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Institution</h1>
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


                <div class="col-md-6 offset-3">

                    <div class="card card-dark">
                        <div class="card-header">
                            <h3 class="card-title text-uppercase">Edit Institution</h3>
                        </div>
                        <?php echo form_open('admin/editinstitution/' . $institution['institution_id']); ?>
                        <div class="card-body">

                            <!-- <div class="form-group">
                                <label for="institution_code">Institution Code:</label>
                                <input type="text" class="form-control" name="institution_code" id="institution_code"
                                    value="<?php echo set_value('institution_code', $institution['institution_code']); ?>">
                                <?=form_error('institution_code','<div class="text-danger">','</div>');?>
                            </div> -->
                            <div class="form-group">
                                <label for="institution_name">Institution Name:</label>
                                <input type="text" class="form-control" name="institution_name" id="institution_name"
                                    value="<?php echo set_value('institution_name', $institution['institution_name']); ?>">
                                <?=form_error('institution_name','<div class="text-danger">','</div>');?>
                            </div>
                            <div class="form-group">
                                <label for="institution_name_vernacular">Vernacular Institution Name:</label>
                                <input type="text" class="form-control" name="institution_name_vernacular"
                                    id="institution_name_vernacular"
                                    value="<?php echo set_value('institution_name_vernacular', $institution['institution_name_vernacular']); ?>">
                                <?=form_error('institution_name_vernacular','<div class="text-danger">','</div>');?>
                            </div>
                            <div class="form-group">
                                <label for="principal_name">Principal Name:</label>
                                <input type="text" class="form-control" name="principal_name" id="principal_name"
                                    value="<?php echo set_value('principal_name', $institution['principal_name']); ?>">
                                <?=form_error('principal_name','<div class="text-danger">','</div>');?>
                            </div>
                            <div class="form-group">
                                <label for="principal_mobile">Principal Mobile:</label>
                                <input type="text" class="form-control" name="principal_mobile" id="principal_mobile"
                                    value="<?php echo set_value('principal_mobile', $institution['principal_mobile']); ?>">
                                <?=form_error('principal_mobile','<div class="text-danger">','</div>');?>
                            </div>
                            <div class="form-group">
                                <label for="principal_whatsapp_mobile">Principal Watsapp Mobile:</label>
                                <input type="text" class="form-control" name="principal_whatsapp_mobile"
                                    id="principal_whatsapp_mobile"
                                    value="<?php echo set_value('principal_whatsapp_mobile', $institution['principal_whatsapp_mobile']); ?>">
                                <?=form_error('principal_whatsapp_mobile','<div class="text-danger">','</div>');?>
                            </div>
                            <div class="form-group">
                                <label for="principal_email">Principal Email:</label>
                                <input type="text" class="form-control" name="principal_email" id="principal_email"
                                    value="<?php echo set_value('principal_email', $institution['principal_email']); ?>">
                                <?=form_error('principal_email','<div class="text-danger">','</div>');?>
                            </div>
                            <div class="form-group">
                                <label for="status">District Name:</label>
                                <?php echo form_dropdown('district_id', $districts, (set_value('district_id'))?set_value('district_id'):$district_id, 'class="form-control input-xs" id="district_id"'); ?>
                                <?=form_error('district_id','<div class="text-danger">','</div>');?>
                            </div>
                            <div class="form-group">
                                <label for="status">Block Name:</label>
                                <?php echo form_dropdown('block_id', $blocksArray, (set_value('block_id'))?set_value('block_id'):$block_id, 'class="form-control input-xs" id="block_id"'); ?>
                                <?=form_error('block_id','<div class="text-danger">','</div>');?>
                            </div>

                            <div class="form-group">
                                <label for="status">Taluk Name</label>
                                <?php echo form_dropdown('taluk_id', $taluksArray, (set_value('taluk_id'))?set_value('taluk_id'):$taluk_id, 'class="form-control input-xs" id="taluk_id"'); ?>
                                <?=form_error('taluk_id','<div class="text-danger">','</div>');?>
                            </div>

                            <div class="form-group">
                                <label for="status">Place Name</label>
                                <?php echo form_dropdown('place_id', $placesArray, (set_value('place_id'))?set_value('place_id'):$place_id, 'class="form-control input-xs" id="place_id"'); ?>
                                <?=form_error('place_id','<div class="text-danger">','</div>');?>
                            </div>


                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-success btn-sm">Update</button>
                            <a href="<?=base_url();?>admin/institutions" class="btn btn-dark btn-sm float-right"
                                role="button">Cancel</a>
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
    var base_url = '<?php echo base_url(); ?>';


    $("#district_id").change(function() {
        event.preventDefault();


        var district_id = $("#district_id").val();

        if (district_id == ' ') {
            alert("Please Select District");
        } else {
            $.ajax({
                'type': 'POST',
                'url': base_url + 'admin/BlockList',
                'data': {
                    'district_id': district_id,
                    'flag': ""
                },
                'dataType': 'text',
                'cache': false,
                'success': function(data) {
                    $('select[name="block_id"]').empty();
                    $('select[name="block_id"]').append(data);
                    $('select[name="block_id"]').removeAttr("disabled");
                }
            });
            $.ajax({
                'type': 'POST',
                'url': base_url + 'admin/TalukList',
                'data': {
                    'district_id': district_id,
                    'flag': ""
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
    $("#block_id").change(function() {
        event.preventDefault();


        var block_id = $("#block_id").val();

        if (block_id == ' ') {
            alert("Please Select Blocks");
        } else {
            $.ajax({
                'type': 'POST',
                'url': base_url + 'admin/PlaceList',
                'data': {
                    'block_id': block_id,
                    'flag': ""
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