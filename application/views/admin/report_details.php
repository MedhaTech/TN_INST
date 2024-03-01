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

                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title font-weight-bold"><?=$pageTitle;?></h3>
                    <div class="card-tools">
                        <?php echo anchor($download_btn,'<i class="fa fa-download"></i> Download','class="btn btn-danger btn-sm"'); ?>
                        <?php echo anchor('admin/reports','<i class="fa fa-arrow-left"></i> Back to List','class="btn btn-dark btn-sm"'); ?>
                    </div>
                    <!-- <div class="card-tools">
                        <ul class="nav nav-pills ml-auto">
                            <li class="nav-item">
                                <?php echo anchor('admin/reports','<i class="fa fa-download"></i> Download','class="btn btn-danger btn-sm"'); ?>
                            </li>
                            <li class="nav-item">
                                <?php echo anchor('admin/reports','<i class="fa fa-arrow-left"></i> Back to List','class="btn btn-dark btn-sm"'); ?>
                            </li>
                        </ul>
                    </div> -->
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <?=$detailsTable;?>
                    </div>

                </div>
            </div>

            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<script>
$(document).ready(function() {
    var base_url = '<?php echo base_url(); ?>';


});
</script>