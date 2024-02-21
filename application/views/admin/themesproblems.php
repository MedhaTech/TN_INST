<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Themes and Problems</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                        <a href="<?php echo base_url('admin/addthemesproblems/');?>"><button type="button"
                         class="btn btn-block btn-sm btn-outline-primary"><i class="fas fa-plus"></i>Add Themes and Problems</button></a>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"></h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example2" class="table table-hover table-striped projects">
                                    <thead>
                                        <tr>
                                            <th width="5%">No </th>
                                            <th width="15%">Theme Name</th>
                                            <th width="25%">Problem Statement</th>
                                            <th width="25%">Problem Statement Description</th>
                                             <!-- <th>Status</th> -->
                                            <th width="20%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=1; foreach ($themes_problems as $themesproblem) : ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $themesproblem['theme_name']; ?></td>
                                                <td><?php echo $themesproblem['problem_statement']; ?></td>
                                                <td><?php echo $themesproblem['problem_statement_description']; ?></td>
                                                <!-- <td><?php echo $themesproblem['status']; ?></td> -->
                                                <td>
                                                    <a href="<?php echo base_url('admin/editthemesproblems/' . $themesproblem['theme_problem_id']); ?>"class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Edit</a>
                                                    <a href="<?php echo base_url('admin/deletethemesproblems/' . $themesproblem['theme_problem_id']); ?>" 
                                                    class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure you want to delete this themesproblems?')"><i class="fas fa-trash"></i> Delete</a>
                                                </td>
                                            </tr>
                                        <?php $i++; endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>