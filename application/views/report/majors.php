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
		<h2>สรุปข้อมูลการฉีดวัคซีน วิทยาลัยเทคนิคชัยภูมิ</h2>
		
		<p>
			ทั้งหมด <?= number_format( $majors['major_stats']->dose1+$majors['major_stats']->no_vaccine ) ?> คน 
			/ ฉีดเข็มแรก <?= number_format($majors['major_stats']->dose1) ?> คน 
			/ ฉีดเข็มที่สอง <?= number_format($majors['major_stats']->dose2) ?> คน 
			/ ยังไม่ได้รับวัคซีน <?= number_format($majors['major_stats']->no_vaccine) ?> คน
			/ ยังไม่กรอกข้อมูล <?= number_format($majors['major_stats']->no_data) ?> คน
		</p>
		
		<table class="table table-hover text-center">
			<thead>
				<tr class="table-dark text-dark">
					<th>สาขาวิชา</th>
					<th>ฉีดเข็มที่1</th>
                	<th>ฉีดเข็มที่2</th>
					<th>ยังไม่ได้รับวัคซีน</th>
                    <th>ยังไม่กรอกข้อมูล</th>
                    <th>รวม</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					foreach ($majors['major_items'] as $major) { 
						$dose1 				= $major->stats->dose1;
						$dose2 				= $major->stats->dose2;
						$no_vaccine 		= $major->stats->no_vaccine;
						$no_data 			= $major->stats->no_data;
						$total 				= $dose1+$no_vaccine+$no_data;
				?>
					<tr>
						<td>
							<a href="<?= site_url('report/major') . '?i=' . $major->major_id ?>">
								<?= $major->major_name ?>
							</a>
						</td>
						<td><?= number_format($dose1).' ('.numbers_percent($dose1,$total).'%)' ?></td>
                        <td><?= number_format($dose2).' ('.numbers_percent($dose2,$total).'%)' ?></td>
                        <td><?= number_format($no_vaccine).' ('.numbers_percent($no_vaccine,$total).'%)' ?></td>
                        <td><?= number_format($no_data).' ('.numbers_percent($no_data,$total).'%)' ?></td>
                        <td><?= number_format($total) ?></td>
					</tr>
				<?php } ?>
			</tbody>
			<tfoot style="color: darkred;">
				<?php
					$total_dose1 = $majors['major_stats']->dose1;
					$total_dose2 = $majors['major_stats']->dose2;
					$total_no_vaccine = $majors['major_stats']->no_vaccine;
					$total_no_data = $majors['major_stats']->no_data;
					$total_all 	= $total_dose1+$total_no_vaccine+$total_no_data;
				?>
				<td>รวม</td>
				<td><?= number_format($total_dose1).' ('.numbers_percent($total_dose1,$total_all).'%)' ?></td>
                <td><?= number_format($total_dose2).' ('.numbers_percent($total_dose2,$total_all).'%)' ?></td>
                <td><?= number_format($total_no_vaccine).' ('.numbers_percent($total_no_vaccine,$total_all).'%)' ?></td>
                <td><?= number_format($total_no_data).' ('.numbers_percent($total_no_data,$total_all).'%)' ?></td>
                <td><?= number_format($total_all) ?></td>
			</tfoot>
		</table>
		<div>
</body>

</html>
