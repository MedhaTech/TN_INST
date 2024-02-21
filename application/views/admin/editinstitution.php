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

                            <div class="form-group">
                                <label for="institution_code">Institution Code:</label>
                                <input type="text" class="form-control" name="institution_code" id="institution_code"
                                    value="<?php echo set_value('institution_code', $institution['institution_code']); ?>">
                            </div>
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
                                <input type="text" class="form-control" name="principal_whatsapp_mobile" id="principal_whatsapp_mobile"
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
                                <select name="district_id" id="district_id" class="form-control input-lg select2">
                                    <option value="">Select Districts</option>
                                    <?php
                                $talu=$this->admin_model->getDetailsbyfield($institution['place_id'],'place_id',"places")->result(); 
                                $taluk_id=$talu[0]->taluk_id;

                                $bloc=$this->admin_model->getDetailsbyfield($taluk_id,'taluk_id',"taluks")->result(); 
                                $block_id=$bloc[0]->block_id;

                                $dist=$this->admin_model->getDetailsbyfield( $block_id,'block_id',"blocks")->result();
                                $district_id=$dist[0]->district_id;
                                foreach($districts as $row)
                                {
                                    $active=($district_id == $row['district_id']) ? "selected" :"";
                                    echo '<option '.$active.' value="'.$row["district_id"].'">'.$row["district_name"].'</option>';
                                }
                                ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status">Block Name:</label>
                                <select name="block_id" id="block_id" class="form-control input-lg select2">
                                    <option value="">Select Block</option>
                                <?php
                                foreach($blocks as $row)
                                {
                                    $active=( $block_id == $row["block_id"]) ? "selected" :"";
                                    echo '<option '.$active.' value="'.$row["block_id"].'">'.$row["block_name"].'</option>';
                                }
                                ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status">Taluk Name:</label>
                                <select name="taluk_id" id="taluk_id" class="form-control input-lg select2">
                                    <option value="">Select Taluk</option>
                                <?php
                                foreach($taluks as $row)
                                {
                                    $active=( $taluk_id == $row["taluk_id"]) ? "selected" :"";
                                    echo '<option '.$active.' value="'.$row["taluk_id"].'">'.$row["taluk_name"].'</option>';
                                }
                                ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="status">Place Name:</label>
                                <select name="place_id" id="place_id" class="form-control input-lg select2">
                                    <option value="">Select Place</option>
                                    <?php
                                foreach($places as $row)
                                {
                                    $active=($institution['place_id'] == $row['place_id']) ? "selected" :"";
                                    echo '<option '.$active.' value="'.$row["place_id"].'">'.$row["place_name"].'</option>';
                                }
                                ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status">Status:</label>
                                <select class="form-control" name="status" id="status">
                                    <option value="ACTIVE"
                                        <?php echo ($institution['status'] == 'ACTIVE') ? 'selected' : ''; ?>>Active
                                    </option>
                                    <option value="INACTIVE"
                                        <?php echo ($institution['status'] == 'INACTIVE') ? 'selected' : ''; ?>>Inactive
                                    </option>
                                    <option value="DELETED"
                                        <?php echo ($institution['status'] == 'DELETED') ? 'selected' : ''; ?>>Deleted
                                    </option>
                                </select>
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
                'url': base_url + 'admin/TalukList',
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
                'url': base_url + 'admin/PlaceList',
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