<?= $this->extend('layouts/backend') ?>

<?= $this->section('content') ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Rooms</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Blank Page</li>
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

          <div class="card-tools">
            <a href="<?php echo base_url('rooms/create') ?>" class="btn btn-md btn-success mb-3">TAMBAH DATA</a>
            <button hidden type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button hidden type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Room Category</th>
                        <th>Amenity</th>
                        <th>Bed Type</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Type</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($rooms as $key => $room) : ?>

                        <tr>
                            <td><?php echo $room['room_category_id'] ?></td>
                            <td><?php echo $room['amenity_id'] ?></td>
                            <td><?php echo $room['bed_type_id'] ?></td>
                            <td><?php echo $room['name'] ?></td>
                            <td>
                                <?php if ($room['image']) : ?>
                                    <img src="<?php echo base_url('uploads/rooms/' . $room['image']) ?>" alt="Post Image" width="100">
                                <?php else : ?>
                                    No Image
                                <?php endif; ?>
                            </td>
                            <td><?php echo $room['type'] ?></td>
                            <td class="text-center">
                                <a href="<?php echo base_url('rooms/edit/'.$room['id']) ?>" class="btn btn-sm btn-primary"> <i class=""></i> </a>
                                <form action="<?= base_url('rooms/delete/' . $room['id']) ?>" method="post">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <?php echo $pager->links('product', 'bootstrap_pagination') ?>
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
<?= $this->endSection() ?>
