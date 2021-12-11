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
        <h3>กลุ่ม <?= $group->group_name ?> 
		/ <a href="/report/minor?i=<?php echo $group->minor_id;?>">สาขางาน<?= $group->minor_name ?></a>
		/ <a href="/report/major?i=<?php echo $group->major_id;?>">สาขาวิชา<?= $group->major_name ?></a> 
		</h3>
        <p>
			ทั้งหมด <?= number_format( $group->stats->dose1+$group->stats->no_vaccine ) ?> คน 
			/ ฉีดเข็มแรก <?= number_format($group->stats->dose1) ?> คน 
			/ ฉีดเข็มที่สอง <?= number_format($group->stats->dose2) ?> คน 
			/ ยังไม่ได้รับวัคซีน <?= number_format($group->stats->no_vaccine) ?> คน
			/ ยังไม่กรอกข้อมูล <?= number_format($group->stats->no_data) ?> คน
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
			<?php 
			foreach ($group->students as $student) { 
				$dose1_status = false;
				$dose2_status = false;
			?>
            <tr>
              
                <td><?= $student->student_id ?></td>
                <td><?= $student->firstname ?></td>
                <td><?= $student->lastname ?></td>

				<!-- if has vaccine -->
				<?php if ($student->vaccine_status == 1) { ?>
				<!-- dose1 -->
                <td>
				<?php
				$dose1_text = '<i class="fas fa-times text-danger"></i>';
				foreach($student->vaccine_status_items as $vaccine_status_item){
					if($vaccine_status_item->time==1){
						$dose1_status 			= true;
						$dose1_date 			= $vaccine_status_item->date;
						$dose1_img 				= $vaccine_status_item->img;
						$dose1_vaccine_brand 	= $vaccine_status_item->vaccine_brand;
						$dose1_text 			= '<i class="fas fa-check text-success"></i>';
					}
				}
				echo $dose1_text;
				?>
                </td>
				<!-- dose2 -->
                <td>
				<?php
				$dose2_text = '<i class="fas fa-times text-danger"></i>';
				foreach($student->vaccine_status_items as $vaccine_status_item){
					if($vaccine_status_item->time==2){
						$dose2_status 			= true;
						$dose2_date 			= $vaccine_status_item->date;
						$dose2_img 				= $vaccine_status_item->img;
						$dose2_vaccine_brand 	= $vaccine_status_item->vaccine_brand;
						$dose2_text 			= '<i class="fas fa-check text-success"></i>';
					}
				}
				echo $dose2_text;
				?>
                </td>

				<?php } else { ?>
				<td colspan="2" class="text-secondary">ยังไม่กรอกข้อมูล</td>
				<?php } ?>

				<td class="text-center"> <a href="#detail<?= $student->user_id ?>" class="btn btn-sm btn-warning" data-toggle="modal"><i class="fas fa-eye"></i></a> </td>
				<div class="modal fade" id="detail<?= $student->user_id ?>">
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
										<li>รหัสนักศึกษา : <?= $student->student_id ?></li>
										<li>ชือ-นามสกุล : <?= $student->firstname.' '.$student->lastname ?></li>
										<?php if ($student->vaccine_status == 0) { ?>
											<div class="alert alert-danger">
												<div class="text-center">สาเหตุที่ไม่ได้รับวัคซีน</div>
												<p class="text-center"><?= $student->vaccine_status_remark->cause ?></p>
											</div>
										<?php } ?>
										<li>ฉีดเข็มที่1
											<?php 
											$dose1_status_text = '<span class="text-danger">ยังไม่ได้รับวัคซีน</span>'; 
											if ($dose1_status) { 
												$dose1_status_text = '<span class="text-success">ได้รับวัคซีนแล้ว</span>'; 
											}
											?>
											<ul style="list-style-type: none;">
												<li>สถานะ : <?= $dose1_status_text ?></li>
												<li>วันที่ฉีด : 
													<?= ($dose1_status) ? $this->tothai->toThaiDateTime($dose1_date, '%d %m %y') : '-' ?>
												</li>
												<li>ยี่ห้อวัคซีน : 
													<?= ($dose1_status) ? $dose1_vaccine_brand : '-' ?>
												</li>
												<li>หลักฐานการฉีดวัคซีน : 
													<ul style="list-style-type: none;">
														<li>
															<?php if ($dose1_status) { ?>
															<img src="<?= base_url('storages/vaccine_status/'.$dose1_img) ?>" alt="" style="max-height: 150px; max-white: 150px;">
															<?php } else {echo "-";} ?>
														</li>
													</ul>
												</li>
											</ul>
										</li>
										<li>ฉีดเข็มที่2</li>
										<li>
										<?php 
											$dose2_status_text = '<span class="text-danger">ยังไม่ได้รับวัคซีน</span>'; 
											if ($dose2_status) { 
												$dose2_status_text = '<span class="text-success">ได้รับวัคซีนแล้ว</span>'; 
											}
											?>
											<ul style="list-style-type: none;">
												<li>สถานะ : <?= $dose2_status_text ?></li>
												<li>วันที่ฉีด : 
													<?= ($dose2_status) ? $this->tothai->toThaiDateTime($dose2_date, '%d %m %y') : '-' ?>
												</li>
												<li>ยี่ห้อวัคซีน : 
													<?= ($dose2_status) ? $dose2_vaccine_brand : '-' ?>
												</li>
												<li>หลักฐานการฉีดวัคซีน : 
													<ul style="list-style-type: none;">
														<li>
															<?php if ($dose2_status) { ?>
															<img src="<?= base_url('storages/vaccine_status/'.$dose2_img) ?>" alt="" style="max-height: 150px; max-white: 150px;">
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
