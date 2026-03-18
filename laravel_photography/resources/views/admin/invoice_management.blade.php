<?php
include ('header.php');
include ('sidebar.php');
?>





  

	  
	  
	  
	  
<main class="col-md-10 ms-sm-auto px-4">
  <div class="d-flex justify-content-between align-items-center mt-3">
    <h1 class="h3">Manage Invoice</h1>
		    	<a href="add_invoice" class="btn btn-primary">Add Invoice</a>

	
  </div>
				  <div class="table-responsive mt-3">
				<table class="table table-bordered text-center">
					        <thead>
								<tr style="text-align:center">
									<th>Invoice ID</th>
									<th>Booking_ID</th>
									<th>Invoice Number</th>
									<th>Invoice Date</th>
									<th>Total Amount</th>
									<th>Created At</th>
									<th> Action </th>
								</tr>
							</thead>

					  
					  <tbody>
					  
					  <?php
					  foreach($inv_arr as $value)
					  {
					  ?>
					  
						<tr style="text-align:center">
						  <td scope="col" class="px-0"><?php echo $value->invoice_id?></td>

						  
						  <td scope="col" class="px-0"><?php echo $value->booking_id?>
						 
						</td>
						  
						  

						  <td scope="col" class="px-0">
							<?php echo $value->invoice_number?>
						  </td>

						  <td scope="col" class="px-0">
							<?php echo $value->invoice_date?>
						  </td>

						  <td scope="col" class="px-0">
							<?php echo $value->total_amount?>
						  </td>

						  
						  <td scope="col" class="px-0">
							<?php echo $value->created_at?>
						  </td>

						  <td class="px-0">
							<a href="edit_invoice?edit_invoice=<?php echo $value->invoice_id;?>" class="btn btn-primary">Edit</a>
							<a href="delete?del_invoice=<?php echo $value->invoice_id?>" class="btn btn-danger">Delete</a>
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



