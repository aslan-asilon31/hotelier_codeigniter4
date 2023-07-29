<?= $this->extend('layouts/backend') ?>

<?= $this->section('content') ?>
<div class="content-wrapper">
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
                                <label>Room Category</label>
                                <select class="form-control" name="room_category_id">
                                    <?php if (isset($roomCategories)) : ?>
                                        <?php foreach ($roomCategories as $roomCategory) : ?>
                                            <option value="<?= $roomCategory['id']; ?>" <?= ($room['room_category_id'] == $roomCategory['id']) ? 'selected' : ''; ?>>
                                                <?= $roomCategory['name']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Amenity</label>
                                <select class="form-control" name="amenity_id">
                                    <?php if (isset($amenities)) : ?>
                                        <?php foreach ($amenities as $amenity): ?>
                                            <option value="<?= $amenity['id'] ?>" <?= ($room['amenity_id'] == $amenity['id']) ? 'selected' : ''; ?>>
                                                <?= $amenity['name'] ?>
                                            </option>
                                        <?php endforeach ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Bed Type</label>
                                <select class="form-control" name="bed_type_id">
                                    <?php if (isset($amenities)) : ?>
                                        <?php foreach ($bedTypes as $bedType): ?>
                                            <option value="<?= $bedType['id'] ?>" <?= ($room['bed_type_id'] == $bedType['id']) ? 'selected' : '' ?>>
                                                <?= $bedType['name'] ?>
                                            </option>
                                        <?php endforeach ?>
                                    <?php endif; ?>
                                </select>
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
<?= $this->endSection() ?>