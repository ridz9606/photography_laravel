<?php include_once('header.php'); ?>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white text-center">
                    <h5 class="mb-0">Edit Profile</h5>
                </div>

                <form method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <?php if($user->profile_photo) { ?>
                                <img src="img/users/<?= $user->profile_photo ?>" class="rounded-circle shadow" style="width:120px; height:120px; object-fit:cover;">
                            <?php } else { ?>
                                <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center shadow-sm" style="width:120px; height:120px;">
                                    <i class="bi bi-person text-muted display-4"></i>
                                </div>
                            <?php } ?>
                        </div>

                        <div class="mb-3">
                            <label class="fw-bold small">Change Profile Photo</label>
                            <input type="file" name="profile_photo" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="fw-bold">Full Name</label>
                            <input type="text" name="name"
                                   value="<?= htmlspecialchars($user->name); ?>"
                                   class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="fw-bold">Email (Readonly)</label>
                            <input type="email"
                                   value="<?= htmlspecialchars($user->email); ?>"
                                   class="form-control" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="fw-bold">Mobile Number</label>
                            <input type="text" name="phone"
                                   value="<?= htmlspecialchars($user->phone); ?>"
                                   class="form-control" required>
                        </div>

                    </div>

                    <div class="card-footer text-center">
                        <button type="submit" name="update" class="btn btn-primary px-4">
                            Update Profile
                        </button>

                        <a href="profile" class="btn btn-secondary px-4">
                            Cancel
                        </a>
                    </div>

                </form>

            </div>

        </div>
    </div>
</div>
