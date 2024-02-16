<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>View Institution Details</h1>
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



                           
                            <?php echo form_open('admin/viewinstitution/' . $institution['institution_id']); ?>
                            <div class="card-body">
                                                    
                                <div class="form-group">
                                    <label for="institution_code">Institution Code:</label>            
                                    <?php echo $institution['institution_code']; ?>
                                </div>
                                <div class="form-group">
                                    <label for="institution_name">Institution Name:</label>
                                    <?php echo $institution['institution_name']; ?>
                                </div>
                                <div class="form-group">
                                    <label for="institution_name_vernacular">Vernacular Institution Name:</label>
                                    <?php echo $institution['institution_name_vernacular']; ?>
                                </div>
                                <div class="form-group">
                                    <label for="institution_type_id">Institution Type:</label>
                                    <?php echo $this->admin_model->get_field_value('institution_type', 'institution_types', 'institution_type_id',$institution['institution_type_id']); ?>
                                </div>
                                <div class="form-group">
                                    <label for="place_id">Place Name:</label>
                                    <?php echo $this->admin_model->get_field_value('place_name', 'places', 'place_id',$institution['place_id']); ?>
                                </div>
                                <div class="form-group">
                                    <label for="taluk_name">Taluk Name:</label>
                                    <?php echo $this->admin_model->get_field_value('taluk_name', 'taluks', 'taluk_id',$institution['institution_type_id']); ?>
                                </div>
                                <div class="form-group">
                                    <label for="block_name">Block Name:</label>
                                    <?php echo $this->admin_model->get_field_value('block_name', 'blocks', 'block_id',$institution['institution_type_id']); ?>
                                </div>
                                <div class="form-group">
                                    <label for="district_name">District Name:</label>
                                    <?php echo $this->admin_model->get_field_value('district_name', 'districts', 'district_id',$institution['institution_type_id']); ?>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status:</label>
                                    <?php echo $institution['status']; ?>
                                </div>
                            </div>

                            <div class="card-footer">
                                <a href="<?=base_url();?>admin/institutions" class="btn btn-primary float-right" role="button">Back</a>
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