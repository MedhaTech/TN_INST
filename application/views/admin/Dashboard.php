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
    <div class="col-md-6">
    <div class="row">
    <div class="col-md-6">
            <div class="small-box bg-info">
              <div class="inner">
                 <h3>38</h3>
                 <p style="font-size: 20px">Districts</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">  </a>
            </div>
         </div>

        <div class="col-md-6">
            <div class="small-box bg-success">
              <div class="inner">
                 <h3>458</h3>
                 <p style="font-size: 20px">Blocks</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">  </a>
            </div>
         </div>

         <div class="col-md-6">
            <div class="small-box bg-warning">
              <div class="inner">
                 <h3>590</h3>
                 <p style="font-size: 20px">Taluks</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">  </a>
            </div>
         </div>

           <div class="col-md-6">
            <div class="small-box bg-danger">
              <div class="inner">
                 <h3>1340</h3>
                 <p style="font-size: 20px">Places</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">  </a>
            </div>
         </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="small-box bg-info">
              <div class="inner">
                 <h3>9</h3>
                 <p style="font-size: 20px">Institution Types</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">  </a>
            </div>
         </div>

         <div class="col-md-6">
            <div class="small-box bg-success">
              <div class="inner">
                 <h3>1097</h3>
                 <p style="font-size: 20px">Institutions</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">  </a>
            </div>
         </div>
    </div>
 </div>

    <div class="col-md-6">
        <div class="card card-primary">



                            
<?php echo form_open('admin/addinstitutions'); ?>
<div class="card-body">
    <div class="form-group">
        <label for="institution_code">Institution Code:</label>
        <input type="text" class="form-control" name="institution_code" id="institution_code" value="<?php echo set_value('institution_code'); ?>">
        <?=form_error('institution_code','<div class="text-danger">','</div>');?>
    </div>
    <div class="form-group">
        <label for="institution_name">Institution Name:</label>
        <input type="text" class="form-control" name="institution_name" id="institution_name" value="<?php echo set_value('institution_name'); ?>">
        <?=form_error('institution_name','<div class="text-danger">','</div>');?>
    </div>
    <div class="form-group">
        <label for="institution_name_vernacular">Vernacular Institution Name:</label>
        <input type="text" class="form-control" name="institution_name_vernacular" id="institution_name_vernacular" value="<?php echo set_value('institution_name_vernacular'); ?>">
        <?=form_error('institution_name_vernacular','<div class="text-danger">','</div>');?>
    </div>
    <div class="form-group">
    <label for="status">Institution Type:</label>
    <select name="institution_type_id" id="institution_type_id" class="form-control input-lg select2">
    <option value="">Select Institution Type</option>
    <?php
    foreach($institution_types as $row)
    {
        echo '<option value="'.$row["institution_type_id"].'">'.$row["institution_type"].'</option>';
    }
    ?>
    </select>
    </div>
    <div class="form-group">
    <label for="status">Place Name:</label>
    <select name="place_id" id="place_id" class="form-control input-lg select2">
    <option value="">Select Place</option>
    <?php
    foreach($places as $row)
    {
        echo '<option value="'.$row["place_id"].'">'.$row["place_name"].'</option>';
    }
    ?>
    </select>
    </div>
    <div class="form-group">
        <label for="status">Status:</label>
        <select class="form-control" name="status" id="status">
            <option value="ACTIVE">Active</option>
            <option value="INACTIVE">Inactive</option>
            <option value="DELETED">Deleted</option>
        </select>
    </div>
   
</div>

<div class="card-footer">
    <button type="submit" class="btn btn-primary">Add</button>
    <a href="<?=base_url();?>admin/institutions" class="btn btn-primary float-right" role="button">Cancel</a>
</div>
<?php echo form_close(); ?>
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