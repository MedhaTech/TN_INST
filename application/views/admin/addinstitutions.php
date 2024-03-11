<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">

    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">


                <div class="col-md-6 offset-3">

                    <div class="card card-dark">
                        <div class="card-header">
                            <h3 class="card-title text-uppercase">Add Institution</h3>
                        </div>
                        <?php echo form_open('admin/addinstitutions'); ?>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="institution_name">Institution Name <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" name="institution_name" id="institution_name"
                                    value="<?php echo (set_value('institution_name'))?set_value('institution_name'):'';?>">
                                <?=form_error('institution_name','<div class="text-danger">','</div>');?>
                            </div>
                            <div class="form-group">
                                <label for="institution_name_vernacular">Vernacular Institution Name </label>
                                <input type="text" class="form-control" name="institution_name_vernacular"
                                    id="institution_name_vernacular"
                                    value="<?php echo (set_value('institution_name_vernacular'))?set_value('institution_name_vernacular'):'';?>">
                                <?=form_error('institution_name_vernacular','<div class="text-danger">','</div>');?>
                            </div>
                            <div class="form-group">
                                <label for="principal_name">Principal Name </label>
                                <input type="text" class="form-control" name="principal_name" id="principal_name"
                                    value="<?php echo (set_value('principal_name'))?set_value('principal_name'):'';?>">
                                <?=form_error('principal_name','<div class="text-danger">','</div>');?>
                            </div>
                            <div class="form-group">
                                <label for="principal_mobile">Principal Mobile Number </label>
                                <input type="text" class="form-control" name="principal_mobile" id="principal_mobile"
                                    value="<?php echo (set_value('principal_mobile'))?set_value('principal_mobile'):'';?>">
                                <?=form_error('principal_mobile','<div class="text-danger">','</div>');?>
                            </div>
                            <div class="form-group">
                                <label for="principal_whatsapp_mobile">Principal Watsapp Mobile Number </label>
                                <input type="text" class="form-control" name="principal_whatsapp_mobile"
                                    id="principal_whatsapp_mobile"
                                    value="<?php echo (set_value('principal_whatsapp_mobile'))?set_value('principal_whatsapp_mobile'):'';?>">
                                <?=form_error('principal_whatsapp_mobile','<div class="text-danger">','</div>');?>
                            </div>
                            <div class="form-group">
                                <label for="principal_email">Principal Email </label>
                                <input type="text" class="form-control" name="principal_email" id="principal_email"
                                    value="<?php echo (set_value('principal_email'))?set_value('principal_email'):'';?>">
                                <?=form_error('principal_email','<div class="text-danger">','</div>');?>
                            </div>
                            <div class="form-group">
                                <label for="status">District Name <span class="text-danger">*</span> </label>
                                <?php 
                                    // $districtsData = array(" " => "Select Districts");
                                        //  foreach($districts as $row) {
                                        //     $districtsData[$row["district_id"]] = $row["district_name"];
                                        // }
                                    ?>
                                <?php echo form_dropdown('district_id', $districts, (set_value('district_id'))?set_value('district_id'):'', 'class="form-control input-xs" id="district_id"'); ?>
                                <?=form_error('district_id','<div class="text-danger">','</div>');?>
                            </div>
                            <div class="form-group">
                                <label for="status">Block Name <span class="text-danger">*</span></label>
                                <select name="block_id" id="block_id" class="form-control input-lg">
                                    <option value="">Select Block</option>
                                </select>
                                <?=form_error('block_id','<div class="text-danger">','</div>');?>
                            </div>
                            <div class="form-group">
                                <label for="status">Taluk Name:</label>
                                <select name="taluk_id" id="taluk_id" class="form-control input-lg">
                                    <option value="">Select Taluk</option>
                                </select>
                                <?=form_error('taluk_id','<div class="text-danger">','</div>');?>
                            </div>
                            <div class="form-group">
                                <label for="status">Place Name:</label>
                                <select name="place_id" id="place_id" class="form-control input-lg">
                                    <option value="">Select Place</option>
                                </select>
                                <?=form_error('place_id','<div class="text-danger">','</div>');?>
                            </div>

                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-success btn-sm">Add</button>
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
    $("#taluk_id1").change(function() {
        event.preventDefault();


        var taluk_id = $("#taluk_id").val();

        if (taluk_id == ' ') {
            alert("Please Select Taluks");
        } else {
            $.ajax({
                'type': 'POST',
                'url': base_url + 'admin/PlaceList',
                'data': {
                    'taluk_id': taluk_id,
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