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
                    <!-- <ol class="breadcrumb float-sm-right">
                        <a href="<?php echo base_url('admin/addblocks/');?>"><button type="button"
                         class="btn btn-block btn-sm btn-outline-primary"><i class="fas fa-plus"></i> Add Blocks</button></a>
                        </ol> -->
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
                            <h3 class="card-title">List of Reports</h3>
                        </div>

                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th width="5%">#</th>
                                        <th width="75%">Reports</th>
                                        <th width="20%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1;?>
                                    <tr>
                                        <td><?=$i++;?></td>
                                        <td>Courses Not Mapped - Institutions List</td>
                                        <td>
                                            <?php echo anchor('admin/report1','VIEW REPORT <i class="fas fa-angle-double-right"></i> ','class="btn btn-danger btn-sm"'); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><?=$i++;?></td>
                                        <td>Address Missing - Institutions List</td>
                                        <td>
                                            <?php echo anchor('admin/report2','VIEW REPORT <i class="fas fa-angle-double-right"></i> ','class="btn btn-danger btn-sm"'); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><?=$i++;?></td>
                                        <td>Principal Details Not Updated - Institutions List</td>
                                        <td>
                                            <?php echo anchor('admin/report3','VIEW REPORT <i class="fas fa-angle-double-right"></i> ','class="btn btn-danger btn-sm"'); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><?=$i++;?></td>
                                        <td>Tamil Nadu Geographical Regions</td>
                                        <td>
                                            <?php echo anchor('admin/geographical_regions','VIEW REPORT <i class="fas fa-angle-double-right"></i> ','class="btn btn-danger btn-sm"'); ?>
                                        </td>
                                    </tr>
                                    <!-- <tr>
                                        <td><?=$i++;?></td>
                                        <td>Institutions and Courses</td>
                                        <td>
                                            <?php echo anchor('','VIEW REPORT <i class="fas fa-angle-double-right"></i> ','class="btn btn-danger btn-sm"'); ?>
                                        </td>
                                    </tr> -->
                                    <tr>
                                        <td><?=$i++;?></td>
                                        <td>Institutions List</td>
                                        <td>
                                            <?php echo anchor('admin/institutionsList','VIEW REPORT <i class="fas fa-angle-double-right"></i> ','class="btn btn-danger btn-sm"'); ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
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