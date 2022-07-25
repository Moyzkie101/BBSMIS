<?php include 'server/server.php' ?>
<?php 
	$query = "SELECT * FROM tbldocument_request";
    $result = $conn->query($query);

    $resident = array();
	while($row = $result->fetch_assoc()){
		$resident[] = $row; 
	}
    
    // testttttttttttttttt

    $query1 = "SELECT * FROM tblpurok ORDER BY `name`";
    $result1 = $conn->query($query1);

    $purok = array();
	while($row = $result1->fetch_assoc()){
		$purok[] = $row; 
	}
//     SELECT tbldocument_request.id AS No, tbldocument_request.request_date AS Date, tblresident.firstname + `, ` + tblresident.middlename + `, ` +  tblresident.lastname AS Name, tbldocument_request.request_service AS Services, tbldocument_request.request_purpose AS Purpose, tbldocument_request.request_payment_method AS PaymentMethod, tbldocument_request.request_ref_no AS ReferenceNumber, tbldocument_request.request_status AS Status
// FROM tbldocument_request
// RIGHT JOIN tblresident ON tbldocument_request.resident_id = tblresident.id
// ORDER BY tbldocument_request.id;
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'templates/header.php' ?>
	<title>Requested Documents -  Barangay Management System</title>
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
					</div>
				</div>
				<div class="page-inner">
					<div class="row mt--2">
						<div class="col-md-12">

                            <?php if(isset($_SESSION['message'])): ?>
                                <div class="alert alert-<?php echo $_SESSION['success']; ?> <?= $_SESSION['success']=='danger' ? 'bg-danger text-light' : null ?>" role="alert">
                                    <?php echo $_SESSION['message']; ?>
                                </div>
                            <?php unset($_SESSION['message']); ?>
                            <?php endif ?>

                            <div class="card">
								<div class="card-header">
									<div class="card-head-row">
										<div class="card-title">Requested Documents</div>
                                        <?php if(isset($_SESSION['username'])):?>
										<div class="card-tools">
                                            <a href="model/export_resident_csv.php" class="btn btn-danger btn-border btn-round btn-sm">
												<i class="fa fa-file"></i>
												Export CSV
											</a>
										</div>
                                        <?php endif ?>
									</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="residenttable" class="display table table-striped">
											<thead>
												<tr>
													<th scope="col">No.</th>
                                                    <th scope="col">Date</th>
													<th scope="col">Name</th>
													<th scope="col">Services</th>
													<th scope="col">Purpose</th>
													<th scope="col">Payment Method</th>
                                                    <th scope="col">Ref.No</th>
													<th scope="col">Status</th>
                                                    <?php if(isset($_SESSION['username'])):?>
                                                        <?php if($_SESSION['role']=='administrator' || $_SESSION['role']=='staff'):?>
													<th scope="col">Action</th>
                                                    <?php endif ?>
                                                    <?php endif ?>
												</tr>
											</thead>
											<tbody>
												<?php if(!empty($resident)): ?>
													<?php $no=1; foreach($resident as $row): ?>
													<tr>
                                                        <td><?= $row['id'] ?></td>
														<td><?= $row['request_date'] ?></td>
														<td><?= $row['resident_id'] ?></td>
														<td><?= $row['request_service'] ?></td>
                                                        <td><?= $row['request_purpose'] ?></td>
                                                        <td><?= $row['request_payment_method'] ?></td>
                                                        <td><?= $row['request_ref_no'] ?></td>
                                                        <td>
                                                            <select class="form-select" aria-label="Default select example">
                                                              <option selected>Received</option>
                                                              <option value="1">Pending</option>
                                                              <option value="2">Ready for Pickup</option>
                                                              <option value="3">Cancelled</option>
                                                            </select>
                                                        </td>
                                                        <?php if(isset($_SESSION['username'])):?>
                                                            <?php if($_SESSION['role']=='administrator' || $_SESSION['role']=='staff'):?>
														<td>
															<div class="form-button-action">
                                                                <a type="button" data-toggle="tooltip" href="model/remove_resident.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this resident?');" class="btn btn-link btn-danger" data-original-title="Remove">
																	<i class="fa fa-times"></i>
																</a>
															</div>
														</td>
                                                            <?php endif ?>
                                                        <?php endif ?>
														
													</tr>
													<?php $no++; endforeach ?>
												<?php endif ?>
											</tbody>
											<tfoot>
												<tr>
                                                    <th scope="col">No.</th>
                                                    <th scope="col">Date</th>
													<th scope="col">Name</th>
													<th scope="col">Services</th>
													<th scope="col">Purpose</th>
													<th scope="col">Payment Method</th>
                                                    <th scope="col">Ref.No</th>
													<th scope="col">Status</th>
                                                    <?php if(isset($_SESSION['username'])):?>
                                                        <?php if($_SESSION['role']=='administrator' || $_SESSION['role']=='staff'):?>
													<th scope="col">Action</th>
                                                    <?php endif ?>
                                                    <?php endif ?>
												</tr>
											</tfoot>
										</table>
									</div>
								</div>
							</div>
						</div>
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
            $('#residenttable').DataTable();
        });
    </script>
</body>
</html>