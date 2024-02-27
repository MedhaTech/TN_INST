<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EDII-TN</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="<?php echo base_url();?>assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/jqvmap/jqvmap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/select2/css/select2.min.css">
    <link rel="stylesheet"
        href="<?php echo base_url();?>assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet"
        href="<?php echo base_url();?>assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/summernote/summernote-bs4.min.css">
    <link rel="stylesheet"
        href="<?php echo base_url();?>assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet"
        href="<?php echo base_url();?>assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet"
        href="<?php echo base_url();?>assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <script src="<?php echo base_url();?>assets/plugins/jquery/jquery.min.js"></script>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="<?php echo base_url();?>admin/dashboard" class="nav-link">Home</a>
                </li>

            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>

                </li>


                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#"
                        role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="<?php echo base_url();?>admin/dashboard" class="brand-link">

                <span class="brand-text font-weight-light">EDII-TN</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->



                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
                        <li class="nav-item menu-open">
                            <a href="<?php echo base_url();?>admin/dashboard"
                                class="nav-link <?php echo ($pageTitle=="Dashboard") ? "active":"";?>">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard

                                </p>
                            </a>

                        </li>

                        <li class="nav-item">
                            <!-- <a href="#" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
            <p>
              Master Data
              <i class="fas fa-angle-left right"></i>
             
            </p>
          </a> -->
                            <ul class="nav">
                                <li class="nav-item">
                                    <a href="<?php echo base_url('admin/states/');?>"
                                        class="nav-link <?php echo ($pageTitle=="States") ? "active":"";?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>States</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo base_url('admin/districts/');?>"
                                        class="nav-link <?php echo ($pageTitle=="Districts") ? "active":"";?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Districts</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo base_url('admin/blocks/');?>"
                                        class="nav-link <?php echo ($pageTitle=="Blocks") ? "active":"";?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Blocks</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo base_url('admin/taluks/');?>"
                                        class="nav-link <?php echo ($pageTitle=="Taluks") ? "active":"";?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Taluks</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo base_url('admin/places/');?>"
                                        class="nav-link <?php echo ($pageTitle=="Places") ? "active":"";?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Places</p>
                                    </a>
                                </li>
                                <!-- <li class="nav-item">
              <a href="" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Financial Years</p>
              </a>
            </li> -->
                                <li class="nav-item">
                                    <a href="<?php echo base_url('admin/streams/');?>"
                                        class="nav-link <?php echo ($pageTitle=="Streams") ? "active":"";?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Streams</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo base_url('admin/institution_types/');?>"
                                        class="nav-link <?php echo ($pageTitle=="Institutiontypes") ? "active":"";?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>InstitutionTypes</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo base_url('admin/programs/');?>"
                                        class="nav-link <?php echo ($pageTitle=="Programs") ? "active":"";?>">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Programs</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo base_url('admin/institutions/');?>"
                                        class="nav-link <?php echo ($pageTitle=="Institutions") ? "active":"";?>">
                                        <i class="nav-icon fas fa-university"></i>
                                        <p>Institutions</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo base_url('admin/themesproblems/');?>"
                                        class="nav-link  <?php echo ($pageTitle=="Themeproblems") ? "active":"";?>">
                                        <i class="far fa-lightbulb nav-icon"></i>
                                        <p>Themes and Problems</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="https://wa.me/9445327750" target="_blank" class="nav-link">
                                        <i class="nav-icon fab fa-whatsapp text-success"></i>
                                        <p>
                                            Support
                                        </p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo base_url('admin/logout');?>" class="nav-link">
                                        <i class="nav-icon fas fa-sign-out-alt"></i>
                                        <p>Logout</p>
                                    </a>
                                </li>
                                <!-- <li class="nav-item">
              <a href="<?php echo base_url('admin/institutionprincipals/');?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Institution Principals</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Course Branches</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Courses  (inst_courses)</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url('admin/institutioncourses/');?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Institutional Courses</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Themes Problems</p>
              </a>
            </li> -->

                            </ul>
                        </li>



                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>