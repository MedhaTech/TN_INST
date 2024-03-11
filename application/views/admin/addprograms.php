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
                            <h3 class="card-title text-uppercase">ADD PROGRAM</h3>
                        </div>
                        <?php echo form_open('admin/addprograms'); ?>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="program_name">Program Name:</label>
                                <input type="text" class="form-control" name="program_name" id="program_name"
                                    value="<?php echo set_value('program_name'); ?>">
                                <?=form_error('program_name','<div class="text-danger">','</div>');?>
                            </div>
                            <div class="form-group">
                                <label for="program_short_name">Program Short Name:</label>
                                <input type="text" class="form-control" name="program_short_name"
                                    id="program_short_name" value="<?php echo set_value('program_short_name'); ?>">
                                <?=form_error('program_short_name','<div class="text-danger">','</div>');?>
                            </div>
                            <div class="form-group">
                                <label for="no_of_years">Number of Years:</label>
                                <select class="form-control" name="no_of_years" id="no_of_years">
                                    <option value="">Select</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                </select>
                                <?=form_error('no_of_years','<div class="text-danger">','</div>');?>
                            </div>
                            <div class="form-group">
                                <label for="program_type">Program Type:</label>
                                <select class="form-control" name="program_type" id="program_type">
                                    <option value="">Select</option>
                                    <option value="UG">UG</option>
                                    <option value="PG">PG</option>
                                    <option value="DIPLOMA">DIPLOMA</option>
                                </select>
                                <?=form_error('program_type','<div class="text-danger">','</div>');?>
                            </div>
                            <div class="form-group">
                                <label for="stream_short_form">Sort Order:</label>
                                <input type="number" min="1" class="form-control" name="sort_order" id="sort_order"
                                    value="<?php echo set_value('sort_order'); ?>">
                                <?=form_error('sort_order','<div class="text-danger">','</div>');?>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-success btn-sm">Add</button>
                            <a href="<?=base_url();?>admin/programs" class="btn btn-dark btn-sm float-right"
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
});
</script>