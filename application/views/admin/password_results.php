<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <!-- <h1>Edit Block</h1> -->
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
                            <h3 class="card-title text-uppercase"><?=$pageTitle;?></h3>
                        </div>
                        <div class="card-body">
                            <?php if($msg == "1"){ ?>
                            <div class="text-center">
                                <i class="far fa-check-circle fa-5x text-success"></i>
                                <h3>Password Changed ! </h3>
                                <h6>Your Password has been changed successfully.</h6>
                            </div>
                            <?php } ?>
                            <?php if($msg == "3"){ ?>
                            <div class="text-center">
                                <i class="fas fa-exclamation-circle fa-5x text-danger"></i>
                                <h3>Oops! Something went wrong. </h3>
                                <h6>Please go back to the previous page and try again.</h6>
                                <?php echo anchor('admin/changePassword','Try Again','class="btn btn-outline-danger btn-square btn-sm"');?>
                            </div>
                            <?php } ?>

                            <?php if($msg == "2"){ ?>
                            <div class="text-center">
                                <i class="fas fa-exclamation-circle fa-5x text-danger"></i>
                                <h3>Password Change Error. </h3>
                                <h6>Your New Password cannot be the same as your Old Password.</h6>
                                <?php echo anchor('admin/changePassword','Try Again','class="btn btn-outline-danger btn-square btn-sm"');?>
                            </div>
                            <?php } ?>
                        </div>
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