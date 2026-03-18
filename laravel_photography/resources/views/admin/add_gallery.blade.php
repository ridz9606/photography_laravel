@extends('admin.layout.structure')
@section('content')
	  
      <main class="col-md-10 ms-sm-auto px-4">

      <div class="body-wrapper-inner">
        <div class="container-fluid">
          <div class="card">
            <div class="card-body">
              <h1 class="h3 mt-3">Add Gallery</h1>
              <div class="card">
                <div class="card-body">

				  <form action="{{url('add_gallery')}}" method="post" class="mt-3" enctype="multipart/form-data">
                     

                        <div class="mb-3">
                        <label class="form-label">Category</label>
                        <select name="category_id" class="form-control">
										<option value="">Select Category</option>
										<?php
										foreach($cate_arr as $data)
										{
										?>
											<option value="<?php echo $data->category_id?>">
															<?php echo $data->category_name?>
											</option>
										<?php
										}
										?>
									</select>
                  </div>

                        <div class="mb-3">
                        <label class="form-label">Catalogue</label>
                        <select name="catalogue_id" class="form-control">
										<option value="">Select Catalogue</option>
										<?php
										foreach($catalogue_arr as $data)
										{
										?>
											<option value="<?php echo $data->catalogue_id?>">
															<?php echo $data->catalogue_name?>
											</option>
										<?php
										}
										?>
									</select>
                  </div>

                        <div class="mb-3">
                        <label class="form-label">Image Title</label>
                        <input type="text" name="image_title" class="form-control" >
                        </div>
                        

                        <div class="mb-3">
                        <label class="form-label">Image</label>
                        <input type="file" name="image" class="form-control" >
                        </div>

                        <div class="mb-3">
                        <label class="form-label">Description</label>
                        <input type="text" name="description" class="form-control" >
                        </div>

                    
                    
                   
					
                   
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                  </form>

                  
                
				
				</div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="./assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="./assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="./assets/js/sidebarmenu.js"></script>
  <script src="./assets/js/app.min.js"></script>
  <script src="./assets/libs/simplebar/dist/simplebar.js"></script>
  <!-- solar icons -->
  <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
</body>

</html>

