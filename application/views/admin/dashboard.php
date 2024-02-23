<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard </li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3><?php echo $this->admin_model->statistic_count('districts')?></h3>
                                    <p>Districts</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-pie-graph"></i>
                                </div>
                                <a href="#" class="small-box-footer"> </a>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3><?php echo $this->admin_model->statistic_count('blocks')?></h3>
                                    <p>Blocks</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-pie-graph"></i>
                                </div>
                                <a href="#" class="small-box-footer"> </a>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3><?php echo $this->admin_model->statistic_count('taluks')?></h3>
                                    <p>Taluks</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-pie-graph"></i>
                                </div>
                                <a href="#" class="small-box-footer"> </a>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3><?php echo $this->admin_model->statistic_count('places')?></h3>
                                    <p>Places</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-pie-graph"></i>
                                </div>
                                <a href="#" class="small-box-footer"> </a>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3><?php echo $this->admin_model->statistic_count('institution_types')?></h3>
                                    <p>Institution Types</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <a href="#" class="small-box-footer"> </a>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3><?php echo $this->admin_model->statistic_count('institutions')?></h3>
                                    <p>Institutions</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <a href="#" class="small-box-footer"> </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">

                </div>
            </div>
        </div>
</div>

</div>
<!-- /.row -->
</div>
<!-- /.container-fluid -->
</section>

</div>
<!-- /.content-wrapper -->