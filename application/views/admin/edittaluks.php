<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Taluk</h1>
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
                            <h3 class="card-title text-uppercase">Edit TALUK</h3>
                        </div>
                            <?php echo form_open('admin/edittaluks/' . $taluk['taluk_id']); ?>
                            <div class="card-body">
                            <div class="form-group">
                                <label for="status">District Name:</label>
                                <select name="district_id" id="district_id" class="form-control input-lg select2">
                                <option value="">Select District</option>
                                <?php

                                $dist=$this->admin_model->getDetailsbyfield($taluk['block_id'],'block_id',"blocks")->result();
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
                                    $active=($taluk['block_id'] == $row['block_id']) ? "selected" :"";
                                    echo '<option '.$active.' value="'.$row["block_id"].'">'.$row["block_name"].'</option>';
                                }
                                ?>
                                </select>
                                </div>
                                <div class="form-group">
                                    <label for="taluk_name">Taluk Name:</label>
                                    <input type="text" class="form-control" name="taluk_name" id="taluk_name" value="<?php echo set_value('taluk_name', $taluk['taluk_name']); ?>">
                                    <?=form_error('taluk_name','<div class="text-danger">','</div>');?>
                                </div>
                                <div class="form-group">
                                    <label for="taluk_name_vernacular">Vernacular Taluk Name:</label>
                                    <input type="text" class="form-control" name="taluk_name_vernacular" id="taluk_name_vernacular" value="<?php echo set_value('taluk_name_vernacular', $taluk['taluk_name_vernacular']); ?>">
                                    <?=form_error('taluk_name_vernacular','<div class="text-danger">','</div>');?>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status:</label>
                                    <select class="form-control" name="status" id="status">
                                        <option value="ACTIVE" <?php echo ($taluk['status'] == 'ACTIVE') ? 'selected' : ''; ?>>Active</option>
                                        <option value="INACTIVE" <?php echo ($taluk['status'] == 'INACTIVE') ? 'selected' : ''; ?>>Inactive</option>
                                        <option value="DELETED" <?php echo ($taluk['status'] == 'DELETED') ? 'selected' : ''; ?>>Deleted</option>
                                    </select>
                                </div>

                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-success btn-sm">Update</button>
                                <a href="<?=base_url();?>admin/taluks" class="btn btn-dark btn-dark float-right" role="button">Cancel</a>
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
    });
</script>