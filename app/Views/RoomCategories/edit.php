<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <title>Rooms - update data</title>
  </head>
  <body>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <?php if(isset($validation)) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $validation->listErrors() ?>
                    </div>
                <?php } ?>
                <div class="card">
                    <div class="card-body">
                        <form action="<?php echo base_url('rooms/update/'.$room['id']) ?>" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Room Category ID</label>
                                <input type="text" class="form-control" name="room_category_id" value="<?php echo $room['room_category_id'] ?>" placeholder="Masukkan room_category_id">
                            </div>
                            <div class="form-group">
                                <label>Amenity ID</label>
                                <input type="text" class="form-control" name="amenity_id" value="<?php echo $room['amenity_id'] ?>" placeholder="Masukkan room_category_id">
                            </div>
                            <div class="form-group">
                                <label>Bed Type ID</label>
                                <input type="text" class="form-control" name="bed_type_id" value="<?php echo $room['bed_type_id'] ?>" placeholder="Masukkan room_category_id">
                            </div>
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" value="<?php echo $room['name'] ?>" placeholder="Masukkan name">
                            </div>
                            <div class="form-group">
                                <label>IMAGE</label>
                                <input type="file" class="form-control" name="image">
                            </div>
                            <div class="form-group">
                                <label>Type</label>
                                <input type="text" class="form-control" name="type" value="<?php echo $room['type'] ?>" placeholder="Masukkan type">
                            </div>
                            <button type="submit" class="btn btn-primary">UPDATE</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  </body>
</html>