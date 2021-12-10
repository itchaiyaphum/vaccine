<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สรุปข้อมูล</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

</head>

<body>
    <div class="container">
		<h2>สรุปข้อมูลการฉีดวัคซีน</h2>
        <h3>กลุ่ม <?= $info->group_name ?> สาขาวิชา <?= $info->major_name ?> </h3>
        <p>
			ทั้งหมด <?= $count->all ?> คน  ฉีดเข็มแรก <?= $count->c1 ?> คน ฉีดเข็มที่สอง <?= $count->c2 ?> คน ยังไม่ได้รับวัคซีน <?= $count->c0 ?> คน 
			<br>ยังไม่กรอกข้อมูล <?= $count->c ?> คน
        </p>
        <table class="table table-hover text-center">
            <thead>
            <tr class="table-dark text-dark">
              
                <th>รหัสนักศึกษา</th>
                <th>ชือ</th>
                <th>นามสกุล</th>
                <th>ฉีดเข็มที่1</th>
                <th>ฉีดเข็มที่2</th>
				<th class="text-center">รายละเอียด</th>
            </tr>
            </thead>
   

            <tbody>
            <?php foreach ($std as $std_r) { ?>
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
    </div>
</body>

</html>
