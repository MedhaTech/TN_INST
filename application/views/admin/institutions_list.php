<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <!-- <h1>Blocks</h1> -->
                </div>
                <div class="col-sm-6">
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="card">

                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="status">District Name:</label>
                                    <select name="district_id" id="district_id" class="form-control form-control-sm">
                                        <option value="all">All Districts</option>
                                        <?php foreach($districts as $row) {
                                            echo '<option value="'.$row["district_id"].'">'.$row["district_name"].'</option>';
                                            }
                                        ?>
                                    </select>
                                    <?=form_error('district_id','<div class="text-danger">','</div>');?>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="status">Block Name:</label>
                                    <?php $blocks_options = array('all' => 'All Blocks');
                                        echo form_dropdown('block_id', $blocks_options, 'all','class="form-control form-control-sm" id="block_id" disabled');
                                    ?>
                                    <?=form_error('block_id','<div class="text-danger">','</div>');?>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="status">Taluk Name:</label>
                                    <?php $taluks_options = array('all' => 'All Taluks');
                                        echo form_dropdown('taluk_id', $taluks_options, 'all','class="form-control form-control-sm" id="taluk_id" disabled');
                                    ?>
                                    <?=form_error('taluk_id','<div class="text-danger">','</div>');?>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="status" class="h6">Place Name:</label>
                                    <?php $places_options = array('all' => 'All Places');
                                        echo form_dropdown('place_id', $places_options, 'all','class="form-control form-control-sm" id="place_id" disabled');
                                    ?>
                                    <?=form_error('place_id','<div class="text-danger">','</div>');?>
                                </div>
                                <div class="form-group col-md-12">
                                    <button class="btn btn-danger btn-sm mt-4">Get Details</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-body">
                            Two
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title font-weight-bold"><?=$pageTitle;?></h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-2">
                            <label for="status">District Name:</label>
                            <select name="district_id" id="district_id" class="form-control form-control-sm">
                                <option value="all">All Districts</option>
                                <?php foreach($districts as $row) {
                                            echo '<option value="'.$row["district_id"].'">'.$row["district_name"].'</option>';
                                            }
                                        ?>
                            </select>
                            <?=form_error('district_id','<div class="text-danger">','</div>');?>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="status">Block Name:</label>
                            <?php $blocks_options = array('all' => 'All Blocks');
                                        echo form_dropdown('block_id', $blocks_options, 'all','class="form-control form-control-sm" id="block_id" disabled');
                                    ?>
                            <?=form_error('block_id','<div class="text-danger">','</div>');?>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="status" class="h6">Place Name:</label>
                            <?php $places_options = array('all' => 'All Places');
                                        echo form_dropdown('place_id', $places_options, 'all','class="form-control form-control-sm" id="place_id" disabled');
                                    ?>
                            <?=form_error('place_id','<div class="text-danger">','</div>');?>
                        </div>
                        <div class="form-group col-md-4">
                            <button class="btn btn-primary btn-square btn-sm mt-4" id="filter"><i
                                    class="fa fa-filter"></i> Filter</button>
                            <button class="btn btn-warning btn-square btn-sm mt-4" id="download" disabled> <i
                                    class="fa fa-download"></i> Download </button>
                            <?php echo anchor('admin/reports','<i class="fa fa-arrow-left"></i> Back to List','class="btn btn-dark btn-sm mt-4"'); ?>
                        </div>
                    </div>
                    <div class="table-responsive my-5" id="res">

                    </div>
                    <div class="col-md-12 text-center" id="process" style="display: none;">
                        <?='<img src="'.base_url().'assets/img/Processing.gif"/>'; ?>
                    </div>
                </div>
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

    var date = new Date();
    var year = date.getFullYear();

    var month = (date.getMonth() + 1).toString().padStart(2, '0');
    var day = date.getDate().toString().padStart(2, '0');

    var hour = date.getHours().toString().padStart(2, '0');
    var minutes = date.getMinutes().toString().padStart(2, '0');
    var secconds = date.getSeconds().toString().padStart(2, '0');

    var seedatetime = day + '' + month + '' + year + '' + hour + '' + minutes + '' + secconds;

    $("#district_id").change(function() {
        event.preventDefault();


        var district_id = $("#district_id").val();

        if (district_id == ' ') {
            alert("Please Select District");
        } else if (district_id == "all") {
            $('select[name="block_id"]').empty();
            $('#block_id').append(`<option value="all">All Blocks</option>`);
            $('#block_id').attr('disabled', true);

            $('select[name="place_id"]').empty();
            $('#place_id').append(`<option value="all">All Places</option>`);
            $('#place_id').attr('disabled', true);
        } else {
            $.ajax({
                'type': 'POST',
                'url': base_url + 'admin/BlockList',
                'data': {
                    'district_id': district_id,
                    'flag': "A"
                },
                'dataType': 'text',
                'cache': false,
                'success': function(data) {
                    $('select[name="block_id"]').empty();
                    $('select[name="block_id"]').append(data);
                    $('select[name="block_id"]').removeAttr("disabled");

                    $('select[name="place_id"]').empty();
                    $('#place_id').append(`<option value="all">All Places</option>`);
                    $('#place_id').attr('disabled', true);
                }
            });
        }
    });

    $("#block_id").change(function() {
        event.preventDefault();


        var block_id = $("#block_id").val();

        if (block_id == ' ') {
            alert("Please Select Blocks");
        } else if (block_id == "all") {
            $('select[name="place_id"]').empty();
            $('#place_id').append(`<option value="all">All Places</option>`);
            $('#place_id').attr('disabled', true);
        } else {
            $.ajax({
                'type': 'POST',
                'url': base_url + 'admin/PlaceList',
                'data': {
                    'block_id': block_id,
                    'flag': "A"
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

    $("#district_id1").change(function() {
        event.preventDefault();

        var district_id = $("#district_id").val();
        if (district_id == ' ') {
            alert("Please Select District");
        } else {
            if (district_id == "all") {
                $('select[name="block_id"]').empty();
                $('#block_id').append(`<option value="all">All Blocks</option>`);
                $('#block_id').attr('disabled', true);

                $('select[name="taluk_id"]').empty();
                $('#taluk_id').append(`<option value="all">All Taluks</option>`);
                $('#taluk_id').attr('disabled', true);

                $('select[name="place_id"]').empty();
                $('#place_id').append(`<option value="all">All Places</option>`);
                $('#place_id').attr('disabled', true);
            } else {
                $.ajax({
                    'type': 'POST',
                    'url': base_url + 'admin/BlockList',
                    'data': {
                        'district_id': district_id,
                        'flag': "A"
                    },
                    'dataType': 'text',
                    'cache': false,
                    'success': function(data) {
                        $('select[name="block_id"]').empty();
                        $('select[name="block_id"]').append(data);
                        $('select[name="block_id"]').removeAttr("disabled");

                        $('select[name="taluk_id"]').empty();
                        $('#taluk_id').append(`<option value="all">All Taluks</option>`);
                        $('#taluk_id').attr('disabled', true);

                        $('select[name="place_id"]').empty();
                        $('#place_id').append(`<option value="all">All Places</option>`);
                        $('#place_id').attr('disabled', true);
                    }
                });

            }

        }
    });

    $("#block_id1").change(function() {
        event.preventDefault();


        var block_id = $("#block_id").val();

        if (block_id == ' ') {
            alert("Please Select Blocks");
        } else {
            if (block_id == "all") {
                $('select[name="taluk_id"]').empty();
                $('#taluk_id').append(`<option value="all">All Taluks</option>`);
                $('#taluk_id').attr('disabled', true);

                $('select[name="place_id"]').empty();
                $('#place_id').append(`<option value="all">All Places</option>`);
                $('#place_id').attr('disabled', true);
            } else {
                $.ajax({
                    'type': 'POST',
                    'url': base_url + 'admin/TalukList',
                    'data': {
                        'block_id': block_id,
                        'flag': "A"
                    },
                    'dataType': 'text',
                    'cache': false,
                    'success': function(data) {
                        $('select[name="taluk_id"]').empty();
                        $('select[name="taluk_id"]').append(data);
                        $('select[name="taluk_id"]').removeAttr("disabled");

                        $('select[name="place_id"]').empty();
                        $('#place_id').append(`<option value="all">All Places</option>`);
                        $('#place_id').attr('disabled', true);
                    }
                });
            }


        }
    });
    $("#taluk_id1").change(function() {
        event.preventDefault();


        var taluk_id = $("#taluk_id").val();

        if (taluk_id == ' ') {
            alert("Please Select Taluks");
        } else {
            if (taluk_id == "all") {
                $('select[name="place_id"]').empty();
                $('#place_id').append(`<option value="all">All Places</option>`);
                $('#place_id').attr('disabled', true);
            } else {
                $.ajax({
                    'type': 'POST',
                    'url': base_url + 'admin/PlaceList',
                    'data': {
                        'taluk_id': taluk_id,
                        'flag': "A"
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


        }
    });

    $("#filter").click(function() {
        event.preventDefault();
        $("#res").hide();
        $("#process").show();

        var district_id = $("#district_id").val();
        var block_id = $("#block_id").val();
        var taluk_id = $("#taluk_id").val();
        var place_id = $("#place_id").val();

        $.ajax({
            'type': 'POST',
            'url': base_url + 'admin/getInstitutionsList',
            'data': {
                'district_id': district_id,
                'block_id': block_id,
                'taluk_id': taluk_id,
                'place_id': place_id,
                'download': '0'
            },
            'dataType': 'text',
            'cache': false,
            'success': function(data) {
                $("#process").hide();
                $("#res").show();
                $("#res").html(data);
                // $('#js-dataTable-full').DataTable({
                //     destroy: true,
                //     lengthMenu: [
                //         [10, 25, 50, 100, -1],
                //         [10, 25, 50, 100, "All"]
                //     ],
                //     language: {
                //         searchPlaceholder: 'Search...',
                //         sSearch: '',
                //         lengthMenu: '_MENU_ items/page',
                //     }
                // });
                $("#download").removeAttr("disabled");
            }
        });
    });

    $("#download").click(function() {
        event.preventDefault();

        // $("#res").hide();
        // $("#process").show();

        var district_id = $("#district_id").val();
        var block_id = $("#block_id").val();
        var taluk_id = $("#taluk_id").val();
        var place_id = $("#place_id").val();

        $("#download").html(
            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Downloading...'
        );
        $("#download").prop('disabled', true);

        $.ajax({
            'type': 'POST',
            'url': base_url + 'admin/getInstitutionsList',
            'data': {
                'district_id': district_id,
                'block_id': block_id,
                'taluk_id': taluk_id,
                'place_id': place_id,
                'download': '1'
            },
            'dataType': 'json',
            'cache': false,
            'success': function(data) {
                var filename = "Institutions List " + seedatetime + ".xls";
                var $a = $("<a>");
                $a.attr("href", data.file);
                $("body").append($a);
                $a.attr("download", filename);
                $a[0].click();
                $a.remove();
                $("#download").html('<i class="fa fa-download"></i> Download');
                $("#download").prop('disabled', false);
            }
        });
    });
});
</script>