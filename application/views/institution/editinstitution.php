<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <!-- <h1>Edit Institution</h1> -->
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
                        <?php echo form_open('institution/editinstitution/' . $institution['institution_id']); ?>
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
                                <label for="status">District Name:</label>
                                <select name="district_id" id="district_id" class="form-control input-lg select2">
                                    <option value="">Select Districts</option>
                                    <?php
                                foreach($districts as $row)
                                {
                                    echo '<option value="'.$row["district_id"].'">'.$row["district_name"].'</option>';
                                }
                                ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status">Block Name:</label>
                                <select name="block_id" id="block_id" class="form-control input-lg select2">
                                    <!-- <option value="">Select Block</option>
                                <?php
                                foreach($blocks as $row)
                                {
                                    echo '<option value="'.$row["block_id"].'">'.$row["block_name"].'</option>';
                                }
                                ?> -->
                                </select>
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
                                <label for="status">Place Name:</label>
                                <select name="place_id" id="place_id" class="form-control input-lg select2">
                                    <!-- <option value="">Select Place</option>
                                <?php
                                foreach($places as $row)
                                {
                                    echo '<option value="'.$row["place_id"].'">'.$row["place_name"].'</option>';
                                }
                                ?> -->
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
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="<?=base_url();?>institution/institutions" class="btn btn-primary float-right"
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