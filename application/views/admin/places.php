<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header ui-sortable-handle" style="cursor: move;">
                            <h3 class="card-title">
                                <i class="fas fa-server mr-1"></i>
                                <?=$pageTitle;?>
                            </h3>
                            <div class="card-tools">
                                <ul class="nav nav-pills ml-auto">
                                    <li class="nav-item">
                                        <a class="btn btn-block btn-sm btn-outline-primary"
                                            href="<?php echo base_url('admin/addplaces/');?>"><i
                                                class="fas fa-plus"></i> Add
                                            Places</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-hover table-striped projects">
                                <thead>
                                    <tr>
                                        <th width="5%">No </th>
                                        <th width="10%">District Name</th>
                                        <th width="10%">Block Name</th>
                                        <th width="10%">Taluk Name</th>
                                        <th width="10%">Place Type</th>
                                        <th width="20%">Place Name</th>
                                        <th width="15%">Vernacular Place Name</th>
                                        <th width="10%">Pincode</th>
                                        <th width="15%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; foreach ($places as $place) : ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td>
                                            <?php 
                                                $districts =  $this->admin_model->get_district($place['block_id'])->row(); 
                                                if($districts){
                                                    echo ($districts->district_name) ? $districts->district_name : "--";
                                                }else{
                                                    echo "--";
                                                }
                                                
                                            ?>
                                        </td>
                                        <td>
                                            <?php 
                                                $block_name =  $this->admin_model->get_field_value('block_name', 'blocks', 'block_id',$place['block_id']); 
                                                echo ($block_name) ? $block_name : "--";
                                            ?>
                                        </td>
                                        <td>
                                            <?php 
                                                $taluk_name =  $this->admin_model->get_field_value('taluk_name', 'taluks', 'taluk_id',$place['taluk_id']); 
                                                echo ($taluk_name) ? $taluk_name : "--";
                                            ?>
                                        </td>

                                        <td><?php echo $place['place_type']; ?></td>
                                        <td><?php echo $place['place_name']; ?></td>
                                        <td><?php echo $place['place_name_vernacular']; ?></td>
                                        <td><?php echo $place['pincode']; ?></td>
                                        <td>
                                            <a href="<?php echo base_url('admin/editplaces/' . $place['place_id']); ?>"
                                                class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i> Edit</a>
                                            <a href="<?php echo base_url('admin/deleteplaces/' . $place['place_id']); ?>"
                                                class="btn btn-danger btn-sm mt-1 mb-1"
                                                onclick="return confirm('Are you sure you want to delete this place?')"><i
                                                    class="fas fa-trash"></i> Delete</a>
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