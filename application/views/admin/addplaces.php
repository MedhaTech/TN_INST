<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add Place</h1>
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


                    <div class="col-md-6">

                        <div class="card card-primary">



                           
                            <?php echo form_open('admin/addplaces'); ?>
                            <div class="card-body">
                               <div class="form-group">
                                <label for="status">District Name:</label>
                                <select name="district_id" id="district_id" class="form-control input-lg select2">
                                <option value="">Select District</option>
                                <?php
                                foreach($districts as $row)
                                {
                                    echo '<option value="'.$row["district_id"].'">'.$row["district_name"].'</option>';
                                }
                                ?>
                                </select>
                                <?=form_error('district_name','<div class="text-danger">','</div>');?>
                                </div>
                                <div class="form-group">
                                <label for="status">block Name:</label>
                                <select name="block_id" id="block_id" class="form-control input-lg select2">
                                
                                </select>
                                <?=form_error('block_name','<div class="text-danger">','</div>');?>
                                </div>
                              <div class="form-group">
                                <label for="status">Taluk Name:</label>
                                <select name="taluk_id" id="taluk_id" class="form-control input-lg select2">
                                <!-- <option value="">Select Taluk</option>
                                <?php
                                foreach($taluks as $row)
                                {
                                    echo '<option value="'.$row["taluk_id"].'">'.$row["taluk_name"].'</option>';
                                }
                                ?> -->
                                </select>
                                </div>
                                <div class="form-group">
                                    <label for="place_type">Place Type:</label>
                                    <select class="form-control" name="place_type" id="place_type">
                                        <option value="METRO">Metro</option>
                                        <option value="URBAN">Urban</option>
                                        <option value="SEMI-URBAN">Semi-Urban</option>
                                        <option value="RURAL">Rural</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="place_name">Place Name:</label>
                                    <input type="text" class="form-control" name="place_name" id="place_name" value="<?php echo set_value('place_name'); ?>">
                                    <?=form_error('place_name','<div class="text-danger">','</div>');?>
                                </div>
                                <div class="form-group">
                                    <label for="place_name_vernacular">Vernacular Place Name:</label>
                                    <input type="text" class="form-control" name="place_name_vernacular" id="place_name_vernacular" value="<?php echo set_value('place_name_vernacular'); ?>">
                                    <?=form_error('place_name_vernacular','<div class="text-danger">','</div>');?>
                                </div>
                                <div class="form-group">
                                    <label for="pincode">Pincode</label>
                                    <input type="text" class="form-control" name="pincode" id="pincode" value="<?php echo set_value('pincode'); ?>">
                                    <?=form_error('pincode','<div class="text-danger">','</div>');?>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status:</label>
                                    <select class="form-control" name="status" id="status">
                                        <option value="ACTIVE">Active</option>
                                        <option value="INACTIVE">Inactive</option>
                                        <option value="DELETED">Deleted</option>
                                    </select>
                                </div>
                               
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Add</button>
                                <a href="<?=base_url();?>admin/places" class="btn btn-primary float-right" role="button">cancel</a>
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
				'data':{'block_id':block_id,},
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