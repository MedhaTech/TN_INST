<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Place</h1>
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
                                <h3 class="card-title text-uppercase">EDIT PLACE</h3>
                            </div>
                            <?php echo form_open('admin/editplaces/' . $place['place_id']); ?>
                            <div class="card-body">
                                                 
                                <div class="form-group">
                                <label for="status">District Name:</label>
                                <select name="district_id" id="district_id" class="form-control input-lg select2">
                                <option value="">Select District</option>
                                <?php

                                $bloc=$this->admin_model->getDetailsbyfield($place['taluk_id'],'taluk_id',"taluks")->result(); 
                               
                                $block_id=$bloc[0]->block_id;
                                $dist=$this->admin_model->getDetailsbyfield( $block_id,'block_id',"blocks")->result();
                                $district_id=$dist[0]->district_id;
                                foreach($districts as $row)
                                {
                                    $active=( $district_id == $row["district_id"]) ? "selected" :"";
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
                                    $active=($place['taluk_id'] == $row['taluk_id']) ? "selected" :"";
                                    echo '<option '.$active.' value="'.$row["taluk_id"].'">'.$row["taluk_name"].'</option>';
                                }
                                ?>
                                </select>
                                </div>
                                <div class="form-group">
                                    <label for="place_type">Place Type:</label>
                                    <select class="form-control" name="place_type" id="place_type">
                                        <option value="METRO" <?php echo ($place['place_type'] == 'METRO') ? 'selected' : ''; ?>>Metro</option>
                                        <option value="URBAN" <?php echo ($place['place_type'] == 'URBAN') ? 'selected' : ''; ?>> Urban</option>
                                        <option value="SEMI-URBAN" <?php echo ($place['place_type'] == 'SEMI-URBAN') ? 'selected' : ''; ?>>Semi-urban</option>
                                        <option value="RURAL" <?php echo ($place['place_type'] == 'RURAL') ? 'selected' : ''; ?>> Rural</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="place_name">Place Name:</label>
                                    <input type="text" class="form-control" name="place_name" id="place_name" value="<?php echo set_value('place_name', $place['place_name']); ?>">
                                    <?=form_error('place_name','<div class="text-danger">','</div>');?>
                                </div>
                                <div class="form-group">
                                    <label for="place_name_vernacular">Vernacular Place Name:</label>
                                    <input type="text" class="form-control" name="place_name_vernacular" id="place_name_vernacular" value="<?php echo set_value('block_name_vernacular', $place['place_name_vernacular']); ?>">
                                    <?=form_error('place_name_vernacular','<div class="text-danger">','</div>');?>
                                </div>
                                <div class="form-group">
                                    <label for="pincode">Pincode</label>
                                    <input type="text" class="form-control" name="pincode" id="pincode" value="<?php echo set_value('block_name_vernacular', $place['pincode']); ?>">
                                    <?=form_error('pincoe','<div class="text-danger">','</div>');?>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status:</label>
                                    <select class="form-control" name="status" id="status">
                                        <option value="ACTIVE" <?php echo ($place['status'] == 'ACTIVE') ? 'selected' : ''; ?>>Active</option>
                                        <option value="INACTIVE" <?php echo ($place['status'] == 'INACTIVE') ? 'selected' : ''; ?>>Inactive</option>
                                        <option value="DELETED" <?php echo ($place['status'] == 'DELETED') ? 'selected' : ''; ?>>Deleted</option>
                                    </select>
                                </div>
                               
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-success btn-sm">Update</button>
                                <a href="<?=base_url();?>admin/places" class="btn btn-dark btn-sm float-right" role="button">Cancel</a>
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
$(document).ready(function(){
		var base_url = '<?php echo base_url(); ?>';
		

$("#district_id").change(function(){
			event.preventDefault();
	            	
			
			var district_id = $("#district_id").val();
			
			if(district_id == ' ' ){
			   alert("Please Select District");
			}else{
			  $.ajax({'type':'POST',
				'url':base_url+'admin/BlockList',
				'data':{'district_id':district_id,},
				'dataType':'text',
				'cache':false,
				'success':function(data){
					$('select[name="block_id"]').empty();
					$('select[name="block_id"]').append(data);
					$('select[name="block_id"]').removeAttr("disabled");
				}
			  });
			  
			}
		});
        $("#block_id").change(function(){
			event.preventDefault();
	            	
			
			var block_id = $("#block_id").val();
			
			if(block_id == ' ' ){
			   alert("Please Select Blocks");
			}else{
			  $.ajax({'type':'POST',
				'url':base_url+'admin/TalukList',
				'data':{'block_id':block_id},
				'dataType':'text',
				'cache':false,
				'success':function(data){
					$('select[name="taluk_id"]').empty();
					$('select[name="taluk_id"]').append(data);
					$('select[name="taluk_id"]').removeAttr("disabled");
				}
			  });
			  
			}
		});
    });
</script>