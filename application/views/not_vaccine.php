<html>
    <head>
    <title>Check Vaccine</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .card {
        margin: 0 auto; /* Added */
        margin-top:50px;
        float: none; /* Added */
        margin-bottom: 10px; /* Added */
        width:500px;
        }
    </style>
    </head>
<body>  
<?php
	$submit = $this->session->flashdata('submit');
	if (isset($submit)) {
		if ($submit->status === 1) {
	?>
			<script>
				Swal.fire({
					icon: 'success',
					title: 'Success',
					html: "<?= $submit->message ?>",
				})
			</script>
		<?php
		} else if ($submit->status === 0) {
		?>
			<script>
				Swal.fire({
					icon: 'error',
					title: 'Failed',
					html: "<?= $submit->message ?>",
				})
			</script>
	<?php
		}
	}
	?>
	<script>
		function logoutConfirm() {
			Swal.fire({
				icon: 'warning',
				title: 'Logout',
				text: 'คุณต้องออกจากระบบหรือไม่',
				showCancelButton: true,
				confirmButtonText: 'ตกลง',
				cancelButtonText: 'ยกเลิก',
			}).then((result) => {
				if (result.isConfirmed) {
					window.location.replace("<?= site_url('auth/login') ?>");
				}
			})
		}
	</script>
    <div class="container">
        <div class="card shadow p-3 mb-5 bg-white rounded ">
            <div class="card-header bg-info text-white">
            ยังไม่ได้รับวัคซีน
			<a class="float-right btn btn-sm btn-info" onclick="logoutConfirm()">Logout</a>
            </div>
            <div class="card-body">
				<form action="<?= site_url('status_vac/not_vaccine') ?>" method="post">
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text">สาเหตุ</span>
						</div>
						<input type="text" class="form-control" name="cause" placeholder="สาเหตุที่ไม่ได้รับวัคซีน" required>
					</div>
					<button class="btn btn-info mt-3 mx-auto d-block" type="submit" name="submit">บันทึกข้อมูล</button>
				</form>
				<?php
				if (isset($not_vaccine->cause) && empty($status_vac)) {
					echo '<div class="alert alert-danger mt-3" role="alert">
							<h5 class="text-center">สาเหตุที่ไม่ได้รับวัคซีน</h5>
							<p class="text-center">' . $not_vaccine->cause . '</p>
						</div>';
				}
				?>
            </div>
        </div>    
    </div>

</body>
</html>
