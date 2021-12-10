<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายงานการฉีดวัคซีน</title>

    <link rel="stylesheet" href="<?= base_url('assets/font/font.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/reset.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/vaccine_print.css') ?>">

    <script src="<?= base_url('assets/js/jquery-3.6.0.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/print.js') ?>"></script>
</head>
<body>
<?php foreach ($group as $group_r) { ?>
	<div class="pagebreak">
		<img src="<?= base_url('assets/images/logo.png') ?>" class="logo">

		<div class="header">
			แบบสรุปการฉีดวัคซีนของนักเรียน/นักศึกษา
			<br>กลุ่ม <?= $group_r->group_name ?>  แผนกวิชา <?= $group_r->major_name ?> วันที่ <?= $this->tothai->toThaiDateTime(date("d M Y"), '%d %m %y')  ?>
			<br>ทั้งหมด <?= $group_r->all ?> คน  ฉีด <?= $group_r->c1 ?> คน ไม่ฉีด <?= $group_r->c0 ?> คน 
			ยังไม่กรอกข้อมูล <?= $group_r->c ?> คน 
        </div>
		<table class="table-content">
			<thead>
				<tr>
					<th rowspan="2">ลำดับ</th>
					<th rowspan="2">รหัสนักศึกษา</th>
					<th rowspan="2" colspan="2">ชื่อ-สกุล</th>
					<th colspan="2">เข็มที่1</th>
					<th colspan="2">เข็มที่2</th>
					<th rowspan="2">หมายเหตุ</th>
				</tr>
				<tr>
					<th>ฉีด</th>
					<th>ยี่ห้อ</th>
					<th>ฉีด</th>
					<th>ยี่ห้อ</th>
				</tr>
			</thead>
			<tbody>
				<?php $i = 1; foreach ($group_r->std as $std_r) { ?>
				<tr>
					<td><?= $i ?></td>
					<td><?= $std_r->student_id ?></td>
					<td><?= $std_r->firstname ?></td>
					<td><?= $std_r->lastname ?></td>
					<td><?= $std_r->time1re ?></td>
					<td><?= isset($std_r->time1->vaccine_brand) ? $std_r->time1->vaccine_brand : '-' ?></td>
					<td><?= $std_r->time2re ?></td>
					<td><?= isset($std_r->time2->vaccine_brand) ? $std_r->time2->vaccine_brand : '-' ?></td>
					<td>
						<?= $std_r->vaccinated === false ? $std_r->not_vaccine->cause : '' ?>
						<?= $std_r->vaccinated === null ? 'ไม่พบข้อมูล' : '' ?>
					</td>
				</tr> 
				<?php $i++; } ?>
		</table>

	</div>
<?php } ?>
</body>
</html>
