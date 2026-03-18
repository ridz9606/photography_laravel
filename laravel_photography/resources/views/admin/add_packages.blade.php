<?php
include('header.php');
include('sidebar.php');
?>

<main class="col-md-10 ms-sm-auto px-4">

    <div class="container-fluid mt-4">
        <div class="card">
            <div class="card-body">

                <h3 class="mb-3">Add Package</h3>

                <form method="post">
  <div class="mb-3">
        <label class="form-label">Select Category</label>
        <select name="category_id" class="form-control" required>
            <option value="">-- Select Category --</option>

            <?php foreach($cate_arr as $cat) { ?>
                <option value="<?= $cat->category_id ?>">
                    <?= $cat->category_name ?>
                </option>
            <?php } ?>
        </select>
    </div>

                    <div class="mb-3">
                        <label class="form-label">Package Name</label>
                        <input type="text" name="package_name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Price</label>
                        <input type="number" name="price" class="form-control" required>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Duration (Hours)</label>
                            <input type="number" name="hours" class="form-control" placeholder="e.g. 2">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Edited Photos</label>
                            <input type="number" name="photos_count" class="form-control" placeholder="e.g. 15">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Album Included?</label>
                            <select name="album_included" class="form-control">
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" required></textarea>
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary">
                        Add Package
                    </button>

                    <a href="package_management" class="btn btn-secondary">
                        Cancel
                    </a>

                </form>

            </div>
        </div>
    </div>

</main>
