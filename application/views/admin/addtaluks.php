<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add Taluk</h1>
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
                            <h3 class="card-title text-uppercase">ADD TALUK</h3>
                        </div>
                            <?php echo form_open('admin/addtaluks'); ?>
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
                                <label for="status">Block Name:</label>
                                <select name="block_id" id="block_id" class="form-control input-lg select2">
                               
                                </select>
                                <?=form_error('block_name','<div class="text-danger">','</div>');?>
                                </div>
                                <div class="form-group">
                                    <label for="taluk_name">Taluk Name</label>
                                    <input type="text" class="form-control" name="taluk_name" id="taluk_name" value="<?php echo set_value('taluk_name'); ?>">
                                    <?=form_error('taluk_name','<div class="text-danger">','</div>');?>
                                </div>
                                <div class="form-group">
                                    <label for="taluk_name_vernacular">Vernacular Taluk Name:</label>
                                    <input type="text" class="form-control" name="taluk_name_vernacular" id="taluk_name_vernacular" value="<?php echo set_value('taluk_name_vernacular'); ?>">
                                    <?=form_error('taluk_name_vernacular','<div class="text-danger">','</div>');?>
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
                                <button type="submit" class="btn btn-success btn-sm">Add</button>
                                <a href="<?=base_url();?>admin/taluks" class="btn btn-dark btn-sm float-right" role="button">Cancel</a>
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
				'data':{'district_id':district_id,'flag':""},
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
    });
</script>