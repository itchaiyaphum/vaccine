<!DOCTYPE html>
<html lang="th">
  <head>
  <meta charset="UTF-8">  
    <title>Admin Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

</head>
<body>


    <!-- MENU -->
    <nav class="navbar navbar-expand-md bg-dark navbar-dark">
            <!-- Brand -->
            <!-- <a class="navbar-brand" href="#">Navbar</a> -->

            <!-- Toggler/collapsibe Button -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar links -->
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav mla">
                    <li class="nav-item">
                        <a class="nav-link btn btn-warning btn-sm text-dark" href="#logout" data-toggle="modal">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </li>
                    <li class="nav-item" style="color:white;">                        
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?= $user->firstname."    ".$user->lastname;?>                     
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Logout -->
        <div class="modal fade" id="logout">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h3><strong>ออกจากระบบ</strong></h3>
					<button class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<div class="alert alert-danger text-center">
						<h5><strong>คุณต้องการออกจากระบบหรือไม่</strong></h5>
					</div>
				</div>
				<div class="modal-footer">
				    <a href="<?= site_url('auth/login') ?>" class="btn btn-warning form-control" type="submit" name="login">ออกจากระบบ</a>
				</div>
			</div>
		</div>
	</div>


    

    <div class="container">
        <?php foreach ($group as $group_r) { ?>
        <h2>นักเรียน นักศึกษา กลุ่ม <?= $group_r->group_name ?>   แผนกวิชา <?= $group_r->major_name ?> </h2>
		<a href="<?= site_url('advisor/report_vac') ?>?group_id=<?= $group_r->group_id ?>" target="_blank" 
		class="btn btn-warning btn-sm float-right">
            รายงานการฉีดวัคซีน
        </a>
        <!-- <a href="<?= site_url('advisor/not_vac') ?>?group_id=<?= $group_r->group_id ?>" target="_blank">
            <button type="button" class="btn btn-warning btn-sm float-right">รายงานการฉีดวัคซีน</button>
        </a> -->
        <!-- <a href="<?= site_url('advisor/std_vac') ?>?time=2&group_id=<?= $group_r->group_id ?>" target="_blank">
            <button type="button" class="btn btn-info btn-sm float-right mr-2">รายงานเข็มที่ 2</button>
        </a>
        <a href="<?= site_url('advisor/std_vac') ?>?time=1&group_id=<?= $group_r->group_id ?>" target="_blank">
            <button type="button" class="btn btn-info btn-sm float-right mr-2">รายงานเข็มที่ 1</button> -->
        </a>
        <p>
            <!-- ข้อมูลเอกสารแสดงความประสงค์ของผู้ปกครองให้บุตรหลานฉีดวัคซีนไฟเซอร์:  -->
            <br>ทั้งหมด <?= $group_r->all ?> คน  ฉีด <?= $group_r->c1 ?> คน ไม่ฉีด <?= $group_r->c0 ?> คน ยังไม่กรอกข้อมูล <?= $group_r->c ?> คน
			<br>ยังไม่ฉีดเข็มที่2 <?= $group_r->c1-$group_r->c2 ?> คน
        </p>            
        <table class="table table-hover text-center">
            <thead>
            <tr class="table-dark text-dark">
              
                <th>รหัสนักศึกษา</th>
                <th>ชือ</th>
                <th>นามสกุล</th>
                <th>ฉีดเข็มที่1</th>
                <th>ฉีดเข็มที่2</th>
                <!-- <th colspan="2">การฉีดวัคซีน</th> -->
                <?php if ($this->session->is_it === true) { ?>
                <th>การฉีดวัคซีน</th>
                <th style="text-align:center;">เอกสารแสดงความประสงค์ของผู้ปกครอง</th>
                <?php } ?>
				<th class="text-center">รายละเอียด</th>
            </tr>
            </thead>
   

            <tbody>
            <?php foreach ($group_r->std as $std_r) { ?>
            <tr>
              
                <td><?= $std_r->student_id ?></td>
                <td><?= $std_r->firstname ?></td>
                <td><?= $std_r->lastname ?></td>
				<?php if ($std_r->vaccinated !== null) { ?>
                <td>
                <?php if (isset($std_r->time1)) { ?>
                    <i class="fas fa-check text-success"></i>
                <?php } else { ?>
                    <i class="fas fa-times text-danger"></i>
                <?php } ?>
                </td>
                <td>
                <?php if (isset($std_r->time2)) { ?>
                    <i class="fas fa-check text-success"></i>
                <?php } else { ?>
                    <i class="fas fa-times text-danger"></i>
                <?php } ?>
                </td>
				<?php } else { ?>
				<td colspan="2" class="text-secondary">ยังไม่กรอกข้อมูล</td>
				<?php } ?>
                <?php if ($this->session->is_it === true) { ?>
                <td>
                    <?php
                    if (!empty($std_r->vaccine)) {
                        if ($std_r->vaccine[0]->consent === '1') {
                            echo '<span class="text-success"><i class="fas fa-syringe mr-2"></i>ฉีด</span>';
                        } elseif ($std_r->vaccine[0]->consent === '0') {
                            echo '<span class="text-warning">ไม่ฉีด</span>';
                        }
                    } else {
                        echo '<span class="text-danger">ยังไม่กรอกข้อมูล</span>';
                    }
                    ?>
                </td>
                <td style="text-align:center;"> <a href="<?= site_url('form/pdf') ?>?std_id=<?= $std_r->user_id ?>" target="_blank"><i class="fas fa-file-download" style="color:red;font-size:22px;"></i>  pdf </a> </td>
                <?php } ?>

				<td class="text-center"> <a href="#detail<?= $std_r->user_id ?>" class="btn btn-sm btn-warning" data-toggle="modal"><i class="fas fa-eye"></i></a> </td>
				<div class="modal fade" id="detail<?= $std_r->user_id ?>">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">รายละเอียด</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<div class="container-fluid">
									<ul style="list-style-type: none;">
										<li>รหัสนักศึกษา : <?= $std_r->student_id ?></li>
										<li>ชือ-นามสกุล : <?= $std_r->firstname.' '.$std_r->lastname ?></li>
										<?php if ($std_r->vaccinated === false) { ?>
											<div class="alert alert-danger">
												<div class="text-center">สาเหตุที่ไม่ได้รับวัคซีน</div>
												<p class="text-center"><?= $std_r->not_vaccine->cause ?></p>
											</div>
										<?php } ?>
										<li>ฉีดเข็มที่1
											<?php 
											if (isset($std_r->time1)) { 
												$time1_status = '<span class="text-success">ได้รับวัคซีนแล้ว</span>'; 
											} else { 
												$time1_status = '<span class="text-danger">ยังไม่ได้รับวัคซีน</span>'; 
											} 
											?>
											<ul style="list-style-type: none;">
												<li>สถานะ : <?= $time1_status ?></li>
												<li>วันที่ฉีด : 
													<?= isset($std_r->time1->date) ? $this->tothai->toThaiDateTime($std_r->time1->date, '%d %m %y') : '' ?>
												</li>
												<li>ยี่ห้อวัคซีน : 
													<?= isset($std_r->time1->vaccine_brand) ? $std_r->time1->vaccine_brand : '' ?>
												</li>
												<li>หลักฐานการฉีดวัคซีน : 
													<ul style="list-style-type: none;">
														<li>
															<?php if (isset($std_r->time1->img)) { ?>
															<img src="<?= base_url('storages/vaccine_status/'.$std_r->time1->img) ?>" alt="" style="max-height: 150px; max-white: 150px;">
															<?php } else {echo "-";} ?>
														</li>
													</ul>
												</li>
											</ul>
										</li>
										<li>ฉีดเข็มที่2</li>
										<li>
										<?php 
											if (isset($std_r->time2)) { 
												$time2_status = '<span class="text-success">ได้รับวัคซีนแล้ว</span>'; 
											} else { 
												$time2_status = '<span class="text-danger">ยังไม่ได้รับวัคซีน</span>'; 
											} 
											?>
											<ul style="list-style-type: none;">
												<li>สถานะ : <?= $time2_status ?></li>
												<li>วันที่ฉีด : 
													<?= isset($std_r->time2->date) ? $this->tothai->toThaiDateTime($std_r->time2->date, '%d %m %y') : '' ?>
												</li>
												<li>ยี่ห้อวัคซีน : 
													<?= isset($std_r->time2->vaccine_brand) ? $std_r->time2->vaccine_brand : '' ?>
												</li>
												<li>หลักฐานการฉีดวัคซีน : 
													<ul style="list-style-type: none;">
														<li>
															<?php if (isset($std_r->time2->img)) { ?>
															<img src="<?= base_url('storages/vaccine_status/'.$std_r->time2->img) ?>" alt="" style="max-height: 150px; max-white: 150px;">
															<?php } else {echo "-";} ?>
														</li>
													</ul>
												</li>
											</ul>
										</li>
									</ul>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>
            </tr>    
            <?php } ?>        
            </tbody>
            

        </table>
        <?php } ?>
    </div>
   
</body>

</html>
<?php
// echo '<pre>';
// var_dump($group);
// echo '</pre>';
?>
