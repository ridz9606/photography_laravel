<?php
include('header.php');
include('sidebar.php');
?>

<main class="col-md-10 ms-sm-auto px-4">
  <h1 class="h3 mt-3">Edit Gallery</h1>

<?php
if (isset($_REQUEST['edit_gallery'])) {

    $gallery_id = $_REQUEST['edit_gallery'];

    $where = array("gallery_id" => $gallery_id);
    $gallery = $this->select_where('gallery', $where);
    $value = $gallery[0];
}
?>

<form method="post" enctype="multipart/form-data">

    <input type="hidden" name="gallery_id" value="<?php echo $value->gallery_id; ?>">

    <div class="mb-3">
        <label>Catalogue ID</label>
        <input type="text" name="catalogue_id" value="<?php echo $value->catalogue_id; ?>" class="form-control">
    </div>

    <div class="mb-3">
        <label>Category ID</label>
        <input type="text" name="category_id" value="<?php echo $value->category_id; ?>" class="form-control">
    </div>

    <div class="mb-3">
        <label>Image Title</label>
        <input type="text" name="image_title" value="<?php echo $value->image_title; ?>" class="form-control">
    </div>

    <div class="mb-3">
        <label>Current Image</label><br>
        <img src="assets/images/gallery/<?php echo $value->image; ?>" width="120">
    </div>

    <div class="mb-3">
        <label>Change Image (optional)</label>
        <input type="file" name="image" class="form-control">
    </div>

    <div class="mb-3">
        <label>Description</label>
        <textarea name="description" class="form-control"><?php echo $value->description; ?></textarea>
    </div>

    <div class="mb-3">
        <label>Status</label>
        <select name="status" class="form-control">
            <option value="Active" <?php if($value->status=="Active") echo "selected"; ?>>Active</option>
            <option value="Inactive" <?php if($value->status=="Inactive") echo "selected"; ?>>Inactive</option>
        </select>
    </div>

    <button type="submit" name="update_gallery" class="btn btn-success">
        Update Gallery
    </button>

</form>
</main>
