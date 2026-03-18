<?php
include('header.php');
include('sidebar.php');
?>

<main class="col-md-10 ms-sm-auto px-4">

    <div class="container-fluid mt-4">
        <div class="card">
            <div class="card-body">

                <h3 class="mb-3">Edit Package</h3>

                <form method="post">

                    <!-- CATEGORY -->
                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <select name="category_id" class="form-control" required>
                            <option value="">-- Select Category --</option>
                            <?php foreach($cate_arr as $cat) { ?>
                                <option value="<?= $cat->category_id ?>"
                                    <?php if($cat->category_id == $package->category_id) echo "selected"; ?>>
                                    <?= $cat->category_name ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <!-- PACKAGE NAME -->
                    <div class="mb-3">
                        <label class="form-label">Package Name</label>
                        <input type="text" name="package_name"
                               value="<?= htmlspecialchars($package->package_name) ?>"
                               class="form-control" required>
                    </div>

                    <!-- PRICE -->
                    <div class="mb-3">
                        <label class="form-label">Price</label>
                        <input type="number" name="price"
                               value="<?= $package->price ?>"
                               class="form-control" required>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Duration (Hours)</label>
                            <input type="number" name="hours" value="<?= $package->hours ?>" class="form-control">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Edited Photos</label>
                            <input type="number" name="photos_count" value="<?= $package->photos_count ?>" class="form-control">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Album Included?</label>
                            <select name="album_included" class="form-control">
                                <option value="0" <?= ($package->album_included == 0) ? 'selected' : '' ?>>No</option>
                                <option value="1" <?= ($package->album_included == 1) ? 'selected' : '' ?>>Yes</option>
                            </select>
                        </div>
                    </div>

                    <!-- DESCRIPTION -->
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" required><?= htmlspecialchars($package->description) ?></textarea>
                    </div>

                    <!-- BUTTONS -->
                    <button type="submit" name="update" class="btn btn-primary">
                        Update Package
                    </button>

                    <a href="package_management" class="btn btn-secondary">
                        Cancel
                    </a>

                </form>

            </div>
        </div>
    </div>

</main>
