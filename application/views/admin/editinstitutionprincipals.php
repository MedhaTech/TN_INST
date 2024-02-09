<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Institution Principal</h1>
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



                            <?php echo validation_errors(); ?>
                            <?php echo form_open('admin/editinstitutionprincipals/'. $institutionprincipal['institution_principal_id']); ?>
                            <div class="card-body">
                                                        
                                <div class="form-group">
                                <label for="status">Institution Name:</label>
                                <select name="institution_id" id="institution_id" class="form-control input-lg">
                                <option value="">Select Institution Name</option>
                                <?php
                                foreach($institutions as $row)
                                {
                                    echo '<option value="'.$row["institution_id"].'">'.$row["institution_name"].'</option>';
                                }
                                ?>
                                </select>
                                </div>
                                <div class="form-group">
                                    <label for="principal_name">Principal Name:</label>
                                    <input type="text" class="form-control" name="principal_name" id="principal_name" value="<?php echo set_value('principal_name', $institutionprincipal['principal_name']); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="principal_name_vernacular">Vernacular Principal Name:</label>
                                    <input type="text" class="form-control" name="principal_name_vernacular" id="principal_name_vernacular" value="<?php echo set_value('principal_name_vernacular', $institutionprincipal['principal_name_vernacular']); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="principal_email">Principal Email</label>
                                    <input type="text" class="form-control" name="principal_email" id="principal_email" value="<?php echo set_value('principal_email', $institutionprincipal['principal_email']); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="principal_mobile">Principal Mobile</label>
                                    <input type="text" class="form-control" name="principal_mobile" id="principal_mobile" value="<?php echo set_value('principal_mobile', $institutionprincipal['principal_mobile']); ?>">
                                </div>
                                <div class="form-group">
                                    <label for="status">Status:</label>
                                    <select class="form-control" name="status" id="status">
                                        <option value="ACTIVE" <?php echo ($institutionprincipal['status'] == 'ACTIVE') ? 'selected' : ''; ?>>Active</option>
                                        <option value="INACTIVE" <?php echo ($institutionprincipal['status'] == 'INACTIVE') ? 'selected' : ''; ?>>Inactive</option>
                                        <option value="DELETED" <?php echo ($institutionprincipal['status'] == 'DELETED') ? 'selected' : ''; ?>>Deleted</option>
                                    </select>
                                </div>
                               
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
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