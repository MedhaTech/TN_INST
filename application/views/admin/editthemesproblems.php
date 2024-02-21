<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Themes Problems</h1>
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
                            <h3 class="card-title text-uppercase">EDIT THEME AND PROBLEM</h3>
                        </div>
                            
                        <?php echo form_open('admin/editthemesproblems/' . $themesproblem['theme_problem_id']); ?>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="theme_name">Theme Name:</label>
                                    <input type="text" class="form-control" name="theme_name" id="theme_name" value="<?php echo set_value('theme_name', $themesproblem['theme_name']); ?>">
                                    <?=form_error('theme_name','<div class="text-danger">','</div>');?>
                                </div>
                                <div class="form-group">
                                    <label for="problem_statement">Problem Statement:</label>
                                    <textarea type="text" class="form-control" name="problem_statement" id="problem_statement" value=""><?php echo set_value('problem_statement', $themesproblem['problem_statement']); ?></textarea>
                                    <?=form_error('problem_statement','<div class="text-danger">','</div>');?>
                                </div>
                                <div class="form-group">
                                    <label for="problem_statement_description">Problem Statement Description:</label>
                                    <textarea type="text" class="form-control" name="problem_statement_description" id="problem_statement_description" value=""><?php echo set_value('problem_statement_description', $themesproblem['problem_statement_description']); ?></textarea>
                                    <?=form_error('problem_statement_description','<div class="text-danger">','</div>');?>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status:</label>
                                    <select class="form-control" name="status" id="status">
                                        <option value="ACTIVE" <?php echo ($themesproblem['status'] == 'ACTIVE') ? 'selected' : ''; ?>>Active</option>
                                        <option value="INACTIVE" <?php echo ($themesproblem['status'] == 'INACTIVE') ? 'selected' : ''; ?>>Inactive</option>
                                        <option value="DELETED" <?php echo ($themesproblem['status'] == 'DELETED') ? 'selected' : ''; ?>>Deleted</option>
                                    </select>
                                </div>

                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-success btn-sm">Update</button>
                                <a href="<?=base_url();?>admin/themesproblems" class="btn btn-dark btn-sm float-right" role="button">Cancel</a>
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