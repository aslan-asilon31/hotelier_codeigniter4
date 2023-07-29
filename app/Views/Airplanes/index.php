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
              <li class="breadcrumb-item active">Rooms</li>
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
            
            <!-- <a class="btn bg-indigo btn-import-sales mb-3" type="button" id="btn-import" data-toggle="modal" data-target="#information_modal">
                <i class="fas fa-upload"></i> Import Data Rooms
            </a>
            <a href="<?php echo base_url('rooms/create') ?>" class="btn btn-md btn-success mb-3"><i class="fa fa-plus"></i></a>
            <a href="#" class="btn btn-md btn-danger mb-3"><i class="fas fa-file-pdf"></i></a>
            <a href="<?php echo base_url('rooms/export-excel'); ?>" style="color:white;" class="btn btn-md btn-warning mb-3"><i class="fas fa-file-excel"></i></a>
            <a href="#" class="btn btn-md btn-info mb-3"><i class="fas fa-file-csv"></i></a>
            <button hidden type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button hidden type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button> -->
          </div>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Airplane Name</th>
                        <th>Airline</th>
                        <th>FLight Number</th>
                        <th>Departure City</th>
                        <th>Destination City</th>
                        <th>Departure Time</th>
                        <th>Arrival Time</th>
                        <th>Duration</th>
                        <th>Base Price</th>
                        <th>Selling Price</th>
                        <th>Discount</th>
                        <th>Avaliable Seat</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($airplanes as $key => $airplane) : ?>

                        <tr>
                            <td><?php echo $airplane['airplane_name'] ?></td>
                            <td><?php echo $airplane['airline'] ?></td>
                            <td>
                                <?php if ($airplane['image']) : ?>
                                    <img src="<?php echo base_url('uploads/rooms/' . $airplane['image']) ?>" alt="Post Image" width="100">
                                <?php else : ?>
                                    No Image
                                <?php endif; ?>
                            </td>
                            <td><?php echo $airplane['flight_number'] ?></td>
                            <td><?php echo $airplane['departure_city'] ?></td>
                            <td><?php echo $airplane['destination_city'] ?></td>
                            <td><?php echo $airplane['departure_time'] ?></td>
                            <td><?php echo $airplane['arrival_time'] ?></td>
                            <td><?php echo $airplane['duration'] ?></td>
                            <td><?php echo $airplane['base_price'] ?></td>
                            <td><?php echo $airplane['selling_price'] ?></td>
                            <td><?php echo $airplane['discount'] ?></td>
                            <td><?php echo $airplane['available_seats'] ?></td>
                            <!-- <td class="text-center">
                                <a href="" class="btn btn-sm btn-info"> <i class="fa fa-eye"></i> </a>
                                <a href="<?php echo base_url('rooms/edit/'.$airplane['id']) ?>" class="btn btn-sm btn-primary"> <i class="fa fa-edit"></i> </a>
                                <form action="<?= base_url('rooms/delete/' . $airplane['id']) ?>" method="post">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                </form>
                            </td> -->
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


     <!-- left modal -->
    <div class="modal modal_outer right_modal fade" id="information_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" >
        <div class="modal-dialog" role="document">
            <form method="post" action="<?php echo base_url('rooms/import-excel'); ?>" id="sales-import" enctype="multipart/form-data">
                <div class="modal-content ">
                    <!-- <input type="hidden" name="email_e" value="admin@filmscafe.in"> -->
                    <div class="modal-header">
                    <h2 class="modal-title">Import Data Product:</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body get_quote_view_modal_body">

                      <div class="form-group">

                          <label for="">File (.xls, .xlsx)</label>
                          <input type="file" class="form-control file" name="file">
                          <p class="text-danger"></p>
                          <a href="" class="btn btn-info" ><i class="fas fa-download"></i>Download Template Excel</a>
                      </div>

                      <div class="">
                          <p style="font-size:17px;font-weight:bold">Langkah-langkah import data user</p>

                          <ol>
                          <li>Klik tombol <b> Browse</b> dan pilih file excel yang akan di import, <br> perhatikan limit pada saat import data excel maksimal 20.000 baris data </li>
                          <br>
                          <li>Klik tombol <b> Download Template Excel </b>untuk mendownload template excel,<br> template ini digunakan untuk menginput data user secara manual </li>
                          <br>
                          <li>Pada Kolom <b> Tanggal di Template Excel </b>dengan Format <b> Text </b>  </li>
                          <br>
                          </ol> 
                      </div>

                      <span id="data_reference_import"></span>
                      <input id="reference_import" type="hidden" name="reference_import" value="">
                      <input id="type_input" type="hidden" name="type_input" value="import">
                      </div>
                      <div class="modal-footer">
                          <a type="button" class="btn btn-secondary btn-flat" data-dismiss="modal"><i class="fas fa-times"></i> Close</a>
                          <button id="" type="submit" class="btn bg-lime btn-flat"><i class="fas fa-upload"></i> Import</button>
                      </div>

                </div><!-- modal-content -->
            </form>
        </div><!-- modal-dialog -->
    </div>
    <!-- End Left modal -->


  </div>
<?= $this->endSection() ?>
