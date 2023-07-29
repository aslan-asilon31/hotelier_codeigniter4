<?= $this->extend('layouts/backend') ?>

<?= $this->section('content') ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Rooms create</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="/rooms">Rooms</a></li>
              <li class="breadcrumb-item active">Room Create</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">
          <?php if(!empty(session()->getFlashdata('message'))) : ?>

            <div class="alert alert-success">
                <?php echo session()->getFlashdata('message');?>
            </div>
                
          <?php endif ?>
          </h3>

        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <?php if(isset($validation)) { ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $validation->listErrors() ?>
                        </div>
                    <?php } ?>
                    <div class="card">
                        <div class="card-body">
                            <form action="<?php echo base_url('rooms/store') ?>" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="room_category_id">Room Category</label>
                                    <select class="form-control" name="room_category_id" id="room_category_id">
                                        <option value="">Select Room Category</option>
                                        <?php foreach ($roomCategories as $roomCategory) : ?>
                                            <option value="<?= $roomCategory['id']; ?>"><?= $roomCategory['name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Amenity</label>
                                    <select class="form-control" name="room_category_id" id="room_category_id">
                                        <option value="">Select Amenity</option>
                                        <?php foreach ($amenities as $amenity) : ?>
                                            <option value="<?= $amenity['id']; ?>"><?= $amenity['name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Bed Type</label>
                                    <select class="form-control" name="bed_type_id" id="bed_type_id">
                                        <option value="">Select Bed Type</option>
                                        <?php foreach ($bedTypes as $bedType) : ?>
                                            <option value="<?= $bedType['id']; ?>"><?= $bedType['name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                               
                                <div class="form-group">
                                    <label>Image</label>
                                    <input type="file" name="image" class="form-control-file">
                                </div>
                                <div class="form-group">
                                    <label>Type</label>
                                    <input type="text" class="form-control" name="type" placeholder="Masukkan Type">
                                </div>
                                <button type="submit" class="btn btn-primary">SIMPAN</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
<?= $this->endSection() ?>
