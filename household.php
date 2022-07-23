<?php include 'server/server.php' ?>
<?php 
	$query = "SELECT * FROM tblhousehold";
    $result = $conn->query($query);

    $household = array();
	while($row = $result->fetch_assoc()){
		$household[] = $row; 
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>Households Information -  Barangay Management System</title>
</head>
<body>
<?php include 'templates/loading_screen.php' ?>
	<div class="wrapper">
		<!-- Main Header -->
		<?php include 'templates/main-header.php' ?>
		<!-- End Main Header -->

		<!-- Sidebar -->
		<?php include 'templates/sidebar.php' ?>
		<!-- End Sidebar -->

		<div class="main-panel">
			<div class="content">
				<div class="panel-header bg-primary-gradient">
					<div class="page-inner">
						<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
							<div>
								<h2 class="text-white fw-bold">Households Information</h2>
							</div>
						</div>
					</div>
				</div>
				<div class="page-inner">
				<?php if(isset($_SESSION['message'])): ?>
							<div class="alert alert-<?php echo $_SESSION['success']; ?> <?= $_SESSION['success']=='danger' ? 'bg-danger text-light' : null ?>" role="alert">
								<?php echo $_SESSION['message']; ?>
							</div>
						<?php unset($_SESSION['message']); ?>
						<?php endif ?>
					<div class="row mt--2">
						<div class="col-md-9">
							<div class="card">
								<div class="card-header">
									<div class="card-head-row">
										<?php if(isset($_SESSION['username'])):?>
											<div class="card-tools">
												
											</div>
										<?php endif?>
									</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="tblhousehold" class="display table table-striped">
											<thead>
												<tr>
													<th scope="col">House No.</th>
													<th scope="col">Details</th>
													<?php if(isset($_SESSION['username'])):?>
													<th scope="col">Action</th>
													<?php endif ?>
												</tr>
											</thead>
											<tbody>
												<?php if(!empty($household)): ?>
													<?php foreach($household as $row): ?>
													<tr>
														<td><?= ucwords($row['household_no']) ?></td>
														<td><?= ucwords($row['household_details']) ?></td>
														

														<?php if(isset($_SESSION['username'])):?>
														<td>
															
															<a type="button" data-toggle="tooltip" href="generate_blotter_report.php?id=<?= $row['id'] ?>" class="btn btn-link btn-primary" data-original-title="Generate Report">
																	<i class="fas fa-file-alt"></i>
																</a>
															<?php if(isset($_SESSION['username']) && $_SESSION['role']=='administrator'):?>
															<a type="button" data-toggle="tooltip" href="model/remove_blotter.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this blotter?');" class="btn btn-link btn-danger" data-original-title="Remove">
																<i class="fa fa-times"></i>
															</a>
															<?php endif ?>
														</td>
														<?php endif ?>
													</tr>
													<?php endforeach ?>
												<?php endif ?>
											</tbody>
											<tfoot>
											<tr>
													<th scope="col">House No.</th>
													<th scope="col">Details</th>
													<?php if(isset($_SESSION['username'])):?>
													<th scope="col">Action</th>
													<?php endif ?>
												</tr>
											</tfoot>
										</table>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="card card-stats card-danger card-round">
								<div class="card-body">
									<div class="row">
										<div class="col-3">
											<div class="icon-big text-center">
												<i class="flaticon-users"></i>
											</div>
										</div>
										
										<div class="col-3 col-stats">
											<div class="numbers">
												<p class="card-category">Total Houses</p>
												<h4 class="card-title"><?= number_format($active) ?></h4>
											</div>
										</div>
									</div>
								</div>
								
			</div>
			
			 <!-- Modal -->
			 <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Manage Blotter</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/save_blotter.php" >
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Complainant</label>
											<input type="text" class="form-control" placeholder="Enter Complainant Name" name="complainant" required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Respondent</label>
											<input type="text" class="form-control" placeholder="Enter Respondent Name" name="respondent" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Victim(s)</label>
											<input type="text" class="form-control" placeholder="Enter Victim(s) Name" name="victim" required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Type</label>
											<select class="form-control" name="type">
												<option disabled selected>Select Blotter Type</option>
												<option value="Amicable">Amicable</option>
												<option value="Incident">Incident</option>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Location</label>
											<input type="text" class="form-control" placeholder="Enter Location" name="location" required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Date</label>
											<input type="date" class="form-control" name="date" value="<?= date('Y-m-d'); ?>" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Time</label>
											<input type="time" class="form-control" name="time" required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Status</label>
											<select class="form-control" name="status">
												<option disabled selected>Select Blotter Status</option>
												<option value="Active">Active</option>
												<option value="Settled">Settled</option>
												<option value="Scheduled">Scheduled</option>
											</select>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label>Details</label>
									<textarea class="form-control" placeholder="Enter Blotter or Incident here..." name="details" required></textarea>
								</div>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

			<!-- Modal -->
			<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Household Number</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="model/edit_blotter.php" >
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Household Number</label>
											<input type="text" class="form-control" placeholder="Enter Complainant Name" id="complainant" name="complainant" required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Household Details</label>
											<input type="text" class="form-control" placeholder="Enter Respondent Name" id="respondent" name="respondent" required>
										</div>
									</div>
								</div>
								
                            
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" id="household_id" name="id">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<?php if(isset($_SESSION['username'])):?>
                            <button type="submit" class="btn btn-primary">Update</button>
							<?php endif ?>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
			<!-- Main Footer -->
			<?php include 'templates/main-footer.php' ?>
			<!-- End Main Footer -->
			
		</div>
		
	</div>
	<?php include 'templates/footer.php' ?>
	<script src="assets/js/plugin/datatables/datatables.min.js"></script>
    <script>
        $(document).ready(function() {
            var oTable = $('#blottertable').DataTable({
				"order": [[ 4, "asc" ]]
            });

			$("#activeCase").click(function(){
				var textSelected = 'Active';
				oTable.columns(4).search(textSelected).draw();
			});
			$("#settledCase").click(function(){
				var textSelected = 'Settled';
				oTable.columns(4).search(textSelected).draw();
			});
			$("#scheduledCase").click(function(){
				var textSelected = 'Scheduled';
				oTable.columns(4).search(textSelected).draw();
			});
        });
    </script>
</body>
</html>