<?php
include ('header.php');
include ('sidebar.php');
?>





  

	  
	  
	  
	  
<main class="col-md-10 ms-sm-auto px-4">
  <div class="d-flex justify-content-between align-items-center mt-3">
    <h1 class="h3">Manage Feedback</h1>
	
  </div>
				  <div class="table-responsive mt-3">
				<table class="table table-bordered text-center">
					        <thead>
								<tr style="text-align:center">
									<th>Feedback_ID</th>
									<th>Booking_ID</th>
									<th>Rating</th>
									<th>Comment</th>
									<th>Created at</th>
									
								</tr>
							</thead>

					  
					  <tbody>
					  
					  <?php
					  foreach($feed_arr as $value)
					  {
					  ?>
					  
						<tr style="text-align:center">
						  <td scope="col" class="px-0"><?php echo $value->feedback_id?></td>

						  
						  <td scope="col" class="px-0"><?php echo $value->booking_id?>
						 
						</td>
						  
						 

						  <td scope="col" class="px-0">
							<?php echo $value->rating?>
						  </td>

						  <td scope="col" class="px-0">
							<?php echo $value->comment?>
						  </td>

						  
						  <td scope="col" class="px-0">
							<?php echo $value->created_at?>
						  </td>
	
						  
						</tr>
					<?php
					  }
					?>	
					  </tbody>
					</table>
				  </div>
				
	  
	   </div>
 </div>
					</main>
  <script src="./assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="./assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="./assets/js/sidebarmenu.js"></script>
  <script src="./assets/js/app.min.js"></script>
  <script src="./assets/libs/simplebar/dist/simplebar.js"></script>
  <!-- solar icons -->
  <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>



