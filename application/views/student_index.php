<!DOCTYPE html>
<html lang="th">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin Page</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
	<link rel="stylesheet" href="<?= base_url('assets/fontawesome/css/all.min.css') ?>" />
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>

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
		$(document).ready(function() {
			bsCustomFileInput.init()
		})
	</script>
	<div class="container">
		<!-- Nav tabs -->
		<ul class="nav nav-tabs" role="tablist">
			<?php if ($this->session->is_it === true) { ?>
				<li class="nav-item">
					<a class="nav-link active" data-toggle="tab" href="#home">ส่วนที่ 1</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-toggle="tab" href="#menu1">ส่วนที่ 2</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-toggle="tab" href="#menu2">ส่วนที่ 3</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-toggle="tab" href="#menu4">เข็มที่ 2</a>
				</li>
				<?php if (!empty($vaccine)) { ?>
					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#menu3">ส่วนที่ 4</a>
					</li>
				<?php } ?>
			<?php } else { ?>
				<li class="nav-item">
					<a class="nav-link active" data-toggle="tab" href="#menu3">ประวัติการฉีดวัคซีน</a>
				</li>
			<?php } ?>

			<li class="nav-item ml-auto">
				<a class="nav-link disabled"><?= $users_std->firstname . ' ' . $users_std->lastname ?></a>
			</li>
			<?php if ($this->session->is_it === true) { ?>
				<li class="nav-item">
					<?php if (!empty($vaccine)) { ?>
						<a class="nav-link text-success" href="<?= site_url('form/pdf') ?>" target="_blank"><i class="fas fa-download mr-2"></i>PDF</a>
					<?php } else { ?>
						<a class="nav-link disabled"><i class="fas fa-download mr-2"></i>PDF</a>
					<?php } ?>
				</li>
				<li class="nav-item">
					<?php if (!empty($vaccine2)) { ?>
						<a class="nav-link text-success" href="<?= site_url('form/pdf2') ?>" target="_blank"><i class="fas fa-download mr-2"></i>PDF2</a>
					<?php } else { ?>
						<a class="nav-link disabled"><i class="fas fa-download mr-2"></i>PDF2</a>
					<?php } ?>
				</li>
			<?php } ?>
			<li class="nav-item">
				<a class="nav-link text-danger" onclick="logoutConfirm()">Logout</a>
			</li>
		</ul>

		<div class="tab-content">
			<?php if ($this->session->is_it === true) { ?>
				<div id="home" class="container tab-pane active"><br>
					<div class="card">
						<div class="card-header bg-info text-white">
							ส่วนที่ 1 : ข้อควรรู้เกี่ยวกับโรคโควิด 19 และวัคซีนโควิด 19
						</div>
						<div class="card-body">
							<pre>
                    &nbsp;&nbsp;&nbsp;โรคโควิด 19 เกิดจากการติดเชื้อไวรัสโคโรนา 2019 ซึ่งการติดเชื้อในเด็กสามารถมีอาการได้หลากหลายตั้งแต่ไม่มี 
                    อาการเลย จนถึงปอดอักเสบรุนแรง หรือเสียชีวิต ร้อยละ 90 ของผู้ป่วยเด็กติดเชื้อมักมีอาการไม่รุนแรง โดยพบอาการเพียง
                    เล็กน้อย เช่น ไข้ ไอ ปวดกล้ามเนื้อ และมีเพียงร้อยละ 5 ของผู้ป่วยเด็กติดเชื้อที่มีอาการรุนแรงหรือวิกฤติ เช่น ปอดอักเสบ 
                    รุนแรง ระบบหายใจหรือระบบไหลเวียนโลหิตล้มเหลว รวมถึงภาวะอักเสบหลายระบบในเด็ก ภาวะแทรกซ้อนมักพบในผู้ป่วย
                    กลุ่มเสี่ยงสูง เช่น เด็กเล็กอายุน้อยกว่า 1 ปี ผู้ป่วยที่มีโรคประจําตัว เช่น โรคหัวใจและหลอดเลือด โรคไต โรคปอดเรื้อรัง 
                    หรือภาวะภูมิคุ้มกันบกพร่อง ในประเทศไทยพบว่าแม้จะมีการติดเชื้อในเด็กอายุน้อยกว่า 18 ปีในสัดส่วนที่สูงขึ้น แต่ผู้ป่วยเด็ก 
                    ที่ติดเชื้อโรคโควิด 19 ส่วนใหญ่มักมีอาการไม่รุนแรงและมีอัตราการเสียชีวิตน้อยมาก</pre>
							<pre>
                    &nbsp;&nbsp;&nbsp;วัคซีนมีประสิทธิภาพในการป้องกันการเจ็บป่วยจากโรคโควิด 19 ได้ในระดับสูง และสามารถช่วยลดความรุนแรงของ 
                    โรคได้ การฉีดวัคซีนอาจป้องกันโรคแบบไม่รุนแรงหรือไม่มีอาการไม่ได้ ดังนั้นผู้ที่ได้รับวัคซีนจึงยังอาจจะติดเชื้อไวรัสโคโรนา 
                    2019 ได้ จึงจําเป็นต้องปฏิบัติตามคําแนะนําและมาตรการอื่น ๆ ตามที่ศูนย์บริหารสถานการณ์แพร่ระบาดของโรคติดเชื้อไวรัสโคโรนา 2019 
                    คณะกรรมการโรคติดต่อจังหวัด/กรุงเทพมหานคร และกระทรวงสาธารณสุขกําหนด เช่น สวมหน้ากากอนามัย เว้น ระยะห่าง หมั่นล้างมือ 
                    ลงทะเบียนเมื่อเข้าไปยังสถานที่ เป็นต้น </pre>
							<pre>
                    &nbsp;&nbsp;&nbsp;สําหรับวัคซีนโควิด 19 ในขณะนี้ (ณ วันที่ 15 กันยายน 2564) ที่ได้รับการขึ้นทะเบียนกับสํานักงานคณะกรรมการ 
                    อาหารและยาของประเทศไทย ให้ใช้ในผู้ที่มีอายุ 12 ปีขึ้นไป มีเพียงชนิดเดียว ได้แก่ วัคซีนไฟเซอร์ (Pfizer Vaccine) 
                    และได้ ผ่านการเห็นชอบให้ใช้วัคซีนดังกล่าวจากคณะอนุกรรมการสร้างเสริมภูมิคุ้มกันโรค โดยวัคซีนนี้เป็นวัคซีนชนิดเอ็มอาร์เอ็นเอ 
                    (mRNA vaccine) ของบริษัท ไฟเซอร์ ไบโอเอ็นเทค (Pizer-BioNTech) ซึ่งเป็นวัคซีนที่มีประสิทธิภาพสูง สามารถป้องกัน
                    การนอนโรงพยาบาลเนื่องจากป่วยหนักและเสียชีวิตได้ มีข้อบ่งชี้ในการให้วัคซีนในบุคคลอายุ 12 ปีขึ้นไป โดยฉีดเข้ากล้ามเนื้อ 2 ครั้ง 
                    ห่างกัน 3 - 4 สัปดาห์ และมีข้อห้ามในการรับวัคซีนไฟเซอร์ ได้แก่ บุคคลที่มีอาการแพ้อย่างรุนแรงในการฉีดวัคซีนเข็มแรก 
                    บุคคลที่แพ้วัคซีนและสารที่เป็นส่วนประกอบของวัคซีนอย่างรุนแรง ผู้ที่มีอายุน้อยกว่า 12 ปี ผู้ที่มีความเจ็บป่วย เฉียบพลัน 
                    และหญิงตั้งครรภ์ที่มีอายุครรภ์น้อยกว่า 12 สัปดาห์ </pre>

							<pre>
                    &nbsp;&nbsp;&nbsp;ผู้ที่มีความประสงค์รับวัคซีนไฟเซอร์ควรมีการเตรียมตัวก่อนรับวัคซีนไฟเซอร์ได้แก่ ปฏิบัติตัวตามปกติ  วัคซีนมีประสิทธิภาพ
                    ในการป้องกันการเจ็บป่วยจากโรคโควิด 19 ได้ในระดับสูง และสามารถช่วยลดความรุนแรงของ โรคได้ การฉีดวัคซีนอาจป้องกันโรคแบบไม่รุนแรงหรือ
                    ไม่มีอาการไม่ได้ ดังนั้นผู้ที่ได้รับวัคซีนจึงยังอาจจะติดเชื้อไวรัสโคโรนา 2019 ได้ จึงจําเป็นต้องปฏิบัติตามคําแนะนําและมาตรการอื่น ๆ 
                    ตามที่ศูนย์บริหารสถานการณ์แพร่ระบาดของโรคติดเชื้อไวรัสโคโร นา 2019 คณะกรรมการโรคติดต่อจังหวัด/กรุงเทพมหานคร และ
                    กระทรวงสาธารณสุขกําหนด เช่น สวมหน้ากากอนามัย เว้น ระยะห่าง หมั่นล้างมือ ลงทะเบียนเมื่อเข้าไปยังสถานที่ เป็นต้น </pre>
							<pre>
                    &nbsp;&nbsp;&nbsp;สําหรับวัคซีนโควิด 19 ในขณะนี้ (ณ วันที่ 15 กันยายน 2564) ที่ได้รับการขึ้นทะเบียนกับสํานักงานคณะกรรมการ 
                    อาหารและยาของประเทศไทยให้ใช้ในผู้ที่มีอายุ 12 ปีขึ้นไป มีเพียงชนิดเดียว ได้แก่ วัคซีนไฟเซอร์ (Pfizer Vaccine) และได้ผ่านการ
                    เห็นชอบให้ใช้วัคซีนดังกล่าวจากคณะอนุกรรมการสร้างเสริมภูมิคุ้มกันโรค โดยวัคซีนนี้เป็นวัคซีนชนิดเอ็มอาร์เอ็นเอ (mRNA vaccine) ของบริษัทไฟเซอร์ 
                    ไบโอเอ็นเทค (Pizer-BioNTech) ซึ่งเป็นวัคซีนที่มีประสิทธิภาพสูง สามารถป้องกันการ นอนโรงพยาบาลเนื่องจากป่วยหนักและเสียชีวิตได้มี
                    ข้อบ่งชี้ในการให้วัคซีนในบุคคลอายุ 12 ปีขึ้นไป โดยฉีดเข้ากล้ามเนื้อ 2 ครั้ง ห่างกัน 3 - 4 สัปดาห์ และมีข้อห้ามในการรับวัคซีนไฟเซอร์ 
                    ได้แก่ บุคคลที่มีอาการแพ้อย่างรุนแรงในการฉีดวัคซีนเข็ม แรก บุคคลที่แพ้วัคซีนและสารที่เป็นส่วนประกอบของวัคซีนอย่างรุนแรง 
                    ผู้ที่มีอายุน้อยกว่า 12 ปี ผู้ที่มีความเจ็บป่วย เฉียบพลัน และหญิงตั้งครรภ์ที่มีอายุครรภ์น้อยกว่า 12 สัปดาห์ </pre>
							<pre>
                    &nbsp;&nbsp;&nbsp;ผู้ที่มีความประสงค์รับวัคซีนไฟเซอร์ควรมีการเตรียมตัวก่อนรับวัคซีนไฟเซอร์ได้แก่ ปฏิบัติตัวตามปกติ พักผ่อนให้ เพียงพอ 
                    ออกกําลังกายตามปกติ ทําจิตใจให้ไม่เครียดหรือวิตกกังวล หากเจ็บป่วยไม่สบายควรเลื่อนการฉีดออกไปก่อน ผู้ที่มี โรคประจําตัวต่าง ๆ สามารถรับ
                    วัคซีนได้ รับประทานยาประจําได้ตามปกติ ยกเว้นโรคที่มีความเสี่ยงที่อาจอันตรายถึงชีวิต โรค ที่ยังควบคุมไม่ได้ มีอาการกําเริบ หรืออาการยังไม่คงที่ 
                    เช่น โรคหัวใจและหลอดเลือด และโรคทางระบบประสาท เป็นต้น ในผู้ ที่ไม่แน่ใจหรืออาการยังไม่คงที่ ควรให้แพทย์ผู้ดูแลเป็นประจําประเมินก่อนฉีด 
                    และ การมีประจําเดือนไม่เป็นข้อห้ามในการฉีด วัคซีน  </pre>
							<pre>
                    &nbsp;&nbsp;&nbsp;จากการศึกษาผลข้างเคียงของการฉีดวัคซีนไฟเซอร์ในเด็กและวัยรุ่น พบว่ามีความปลอดภัยสูง ไม่แตกต่างกับการฉีด 
                    ในประชากรกลุ่มอายุอื่น ๆ โดยผลข้างเคียงที่พบบ่อย ได้แก่ เจ็บในตําแหน่งที่ฉีด อ่อนเพลีย ปวดศีรษะหรือมีไข้ มักพบ ผลข้างเคียงหลังการฉีด
                    วัคซีนเข็มที่สองมากกว่าหลังการฉีดเข็มแรกเล็กน้อย ส่วนมากอาการไม่รุนแรงและหายไปได้เองใน 1-2 วัน หากพบอาการดังกล่าว แนะนําให้
                    รับประทานยาพาราเซทตามอล และควรงดออกกําลังกายหลังได้รับวัคซีนนาน 1 สัปดาห์ แม้ว่าวัคซีนเหล่านี้จะได้รับการรับรองจากสํานักงานคณะกรรมการ
                    อาหารและยา ว่ามีความปลอดภัยและให้ใช้ได้แล้วก็ตาม แต่ การฉีดวัคซีนนี้ก็ยังสามารถทําให้เกิดอาการแพ้รุนแรง (anaphylaxis) ซึ่งเป็นปฏิกิริยา
                    ภูมิแพ้แบบฉับพลัน โดยมากมักเกิด ภายใน 5-30 นาทีหลังจากฉีดวัคซีน อาการแพ้รุนแรงมักมีอาการทั่วร่างกายหรือมีอาการแสดงหลายระบบ เช่น 
                    หอบเหนื่อย หลอดลมตีบ หมดสติ ความดันโลหิตต่ํา ผื่นลมพิษ ปากบวม หน้าบวม คลื่นไส้ อาเจียน หรืออาจมีความรุนแรงถึงชีวิต จึงจําเป็น
                    ต้องสังเกตอาการหลังการฉีดอย่างน้อย 30 นาทีในสถานพยาบาลหรือสถานที่ฉีดวัคซีนเสมอ </pre>
							<pre>
                    &nbsp;&nbsp;&nbsp;จากข้อมูลของศูนย์ควบคุมและป้องกันโรค ประเทศสหรัฐอเมริกา (US CDC) ณ วันที่ 11 มิถุนายน 2554 พบรายงาน การเกิดภาวะ
                    กล้ามเนื้อหัวใจอักเสบ หรือ เยื่อหุ้มหัวใจอักเสบภายหลังการฉีดวัคซีนชนิดเอ็มอาร์เอ็นเอ ในผู้ที่มีอายุ 12-17 ปี ได้ โดยพบอาการดังกล่าวหลังฉีด
                    เข็มที่สองมากกว่าเข็มที่ 1 และมักพบในเพศชาย (ประมาณ 66.7 รายจากการฉีดวัคซีน 1 ล้านโดส) และเพศหญิง (ประมาณ 9.1 รายจากการ
                    ฉีดวัคซีน 1 ล้านโดส) โดยอาการที่พบ เช่น การเจ็บหน้าอก หายใจไม่อิ่ม หรือ ใจสั่น อย่างไรก็ตาม จากการติดตามผู้ที่ได้รับการวินิจฉัยภาวะกล้ามเนื้อ
                    หัวใจอักเสบ หรือ เยื่อหุ้มหัวใจอักเสบในระยะสั้น พบว่า ส่วนใหญ่สามารถกลับมาใช้ชีวิตเป็นปกติได้ภายหลังการรักษา </pre>
							<pre>
                    &nbsp;&nbsp;&nbsp;หากผู้รับวัคซีนเกิดอาการไม่พึงประสงค์หรือไม่มั่นใจว่าอาการดังกล่าวเกิดจากวัคซีนหรือไม่ ควรแนะนําให้ผู้ปกครอง/ ผู้รับวัคซีนปรึกษา
                    แพทย์เพิ่มเติม โดยเฉพาะอย่างยิ่งหากมีอาการไม่พึงประสงค์ที่รุนแรงและเกิดขึ้นในช่วง 4 สัปดาห์หลังฉีด วัคซีน และหากฉีดวัคซีนแล้วมีปฏิกิริยาแพ้รุนแรง
                    เช่น มีผื่นทั้งตัว หน้าบวม คอบวม หายใจลําบาก ใจสั่น วิงเวียนหรืออ่อน แรง หรือมีอาการแขนขาอ่อนแรง รวมถึงหากมีอาการเจ็บแน่นหน้าอก 
                    หายใจเหนื่อย หรือหายใจไม่อิ่ม ใจสั่น ซึ่งเป็นอาการที่ สงสัยภาวะกล้ามเนื้อหัวใจอักเสบ/เยื่อหุ้มหัวใจอักเสบ ควรรีบไปพบแพทย์ หรือโทร 1669 
                    เพื่อรับบริการทางการแพทย์ฉุกเฉิน</pre>
						</div>
					</div>
				</div>

				<div id="menu1" class="container tab-pane fade"><br>
					<div class="card">
						<div class="card-header bg-info text-white">
							ส่วนที่ 2 เอกสารแสดงความประสงค์ของผู้ปกครองให้บุตรหลานฉีดวัคซีนไฟเซอร์
						</div>
						<div class="card-body">
							<h6 style="color:blue">ข้อมูลผู้ปกครอง</h6>
							<hr>
							<form method="post" action="<?= site_url('form/submit') ?>" enctype="multipart/form-data">
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text">ข้าพเจ้าชื่อ นามสกุล</span>
									</div>
									<input type="text" class="form-control" name="name" value="<?= isset($vaccine->parent_name) ? $vaccine->parent_name : '' ?>" required>
									<input type="text" class="form-control" name="lastname" value="<?= isset($vaccine->parent_lname) ? $vaccine->parent_lname : '' ?>" required>
								</div>

								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text">หมายเลขโทรศัพท์</span>
									</div>
									<input type="text" class="form-control" name="tel_parent" value="<?= isset($vaccine->parent_tel) ? $vaccine->parent_tel : '' ?>" required>
									<div class="input-group-prepend">
										<span class="input-group-text">ผู้ปกครองของ </span>
									</div>
									<input type="text" class="form-control" name="owner" value="<?= $users_std->firstname . ' ' . $users_std->lastname ?>" disabled>
								</div>

								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text">มีความสัมพันธ์เป็น </span>
									</div>
									<input type="text" class="form-control" name="relation" value="<?= isset($vaccine->relation) ? $vaccine->relation : '' ?>" required>
								</div>

								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text">ที่อยู่ </span>
									</div>
									<input type="text" class="form-control" name="address" value="<?= isset($vaccine->add_number_parent) ? $vaccine->add_number_parent : '' ?>" required>

									<div class="input-group-prepend">
										<span class="input-group-text">หมู่ที่ </span>
									</div>
									<input type="text" class="form-control" name="moo" value="<?= isset($vaccine->group_parent) ? $vaccine->group_parent : '' ?>" required>

									<div class="input-group-prepend">
										<span class="input-group-text">ถนน </span>
									</div>
									<input type="text" class="form-control" name="road" value="<?= isset($vaccine->roard_parent) ? $vaccine->roard_parent : '' ?>">
								</div>

								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text">ตำบล/แขวง </span>
									</div>
									<input type="text" class="form-control" name="district" value="<?= isset($vaccine->sub_distric_parent) ? $vaccine->sub_distric_parent : '' ?>" required>

									<div class="input-group-prepend">
										<span class="input-group-text">อำเภอ/เขต </span>
									</div>
									<input type="text" class="form-control" name="district2" value="<?= isset($vaccine->district_parent) ? $vaccine->district_parent : '' ?>" required>

									<div class="input-group-prepend">
										<span class="input-group-text">จังหวัด </span>
									</div>
									<input type="text" class="form-control" name="province" value="<?= isset($vaccine->province_parent) ? $vaccine->province_parent : '' ?>" required>
								</div>

								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text">หมายเลขโทรศัพท์ (นักเรียน) </span>
									</div>
									<input type="text" class="form-control" name="tel_student" value="<?= isset($vaccine->std_tel) ? $vaccine->std_tel : '' ?>" required>
								</div>
								<br>
								<h6 style="color:blue">ข้อมูลนักเรียน / นักศึกษา</h6>
								<hr>
								<br>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text">ชื่อ-นามสกุล (นักเรียน) </span>
									</div>
									<input type="text" class="form-control" name="name_student" value="<?= $users_std->firstname ?>" required>
									<input type="text" class="form-control" name="lname_student" value="<?= $users_std->lastname ?>" required>
								</div>

								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text">อายุ </span>
									</div>
									<input type="text" class="form-control" name="age" value="<?= isset($vaccine->age_std) ? $vaccine->age_std : '' ?>" required>
									<div class="input-group-prepend">
										<span class="input-group-text">วันเดือนปีเกิด </span>
									</div>
									<input type="date" class="form-control" name="dob" value="<?= isset($vaccine->birthday_std) ? $vaccine->birthday_std : '' ?>" required>
								</div>

								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text">เลขประจำตัว 13 หลัก/ หมายเลขหนังสือเดินทาง(กรณีเป็นชาวต่างชาติ) </span>
									</div>
									<input type="text" class="form-control" name="id" value="<?= isset($vaccine->card_no_std) ? $vaccine->card_no_std : '' ?>" required>
									<div class="input-group-prepend">
										<span class="input-group-text">สัญชาติ </span>
									</div>
									<input type="text" class="form-control" name="nation" value="<?= isset($vaccine->nationality_std) ? $vaccine->nationality_std : '' ?>" required>
								</div>

								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text">ชื่อสถานศึกษา</span>
									</div>
									<input type="text" class="form-control" value="วิทยาลัยเทคนิคชัยภูมิ" name="school" disabled>
									<div class="input-group-prepend">
										<span class="input-group-text">ชั้นปี </span>
									</div>
									<input type="text" class="form-control" name="class" value="<?= $users_std->group_level ?>" required>
									<div class="input-group-prepend">
										<span class="input-group-text">ห้องเรียน </span>
									</div>
									<input type="text" class="form-control" name="group" value="<?= $users_std->group_data[0]->group_name ?>" required>
								</div>
								<br><br>
								<span style="font-size:16px;">ทั้งนี้ ข้าพเจ้าได้รับทราบข้อมูลและได้ซักถามรายละเอียดจนเข้าใจเกี่ยวกับวัคซีนไฟเซอร์และอาการไม่พึงประสงค์ของวัคซีนที่อาจเกิดขึ้นเป็นที่เรียบร้อยแล้ว</span>
								<br>
								ข้าพเจ้า <br>
								<div class="form-check-inline">
									<label class="form-check-label" style="padding-left:5.5em">
										<label><input type="radio" class="form-check-input" name="consent" value="1" <?php if (isset($vaccine->consent)) {
																															if ($vaccine->consent == 1) {
																																echo 'checked';
																															}
																														} ?>>ประสงค์ให้บุตรหลาน ฉีดวัคซีนไฟเซอร์โดยสมัครใจ</label><br>
										<label><input type="radio" class="form-check-input" name="consent" value="0" <?php if (isset($vaccine->consent)) {
																															if ($vaccine->consent == 0) {
																																echo 'checked';
																															}
																														} ?>>ไม่ประสงค์ให้บุตรหลาน ฉีดวัคซีนไฟเซอร์โดยสมัครใจ</label>
										<div class="input-group mb-3">
											<div class="input-group-prepend">
												<span class="input-group-text">เหตุผล</span>
											</div>
											<input type="text" class="form-control" name="cause" value="<?= isset($vaccine->cause) ? $vaccine->cause : '' ?>">
										</div>
									</label>
								</div>
								<br><br>
								<center> <a href="#menu2" data-toggle="tab"><button class="btn btn-info">ต่อไป</button></a></center>


						</div>
					</div>
				</div>

				<div id="menu2" class="container tab-pane fade"><br>
					<div class="card">
						<div class="card-header bg-info text-white">
							แบบคัดกรองก่อนรับการบริการฉีดวัคซีนโควิด 19 สำหรับนักเรียน/นักศึกษา ชั้นมัธยมศึกษาปีที่ 1-6 หรือเทียบเท่า
						</div>
						<div class="card-body">
							<p><b>คำชี้แจง</b> ให้ผู้ปกครอง กรุณากรอกข้อมูลโดยคลิกเลือกในช่องว่างตามความจริง เพื่อเจ้าหน้าที่จะได้พิจารณาว่า นักเรียน/นักศึกษา สามารถฉีดวัคซีนได้หรือไม่</p>
							<table class="table">

								<tbody>
									<tr>
										<td>1. นักเรียนมีอายุไม่ถึง 12 ปีบริบูรณ์ </td>
										<td> <label><input type="radio" class="form-check-input" value="1" name="n1" <?php if (isset($vaccine->vaccine_check->check1)) {
																															if ($vaccine->vaccine_check->check1 == 1) {
																																echo 'checked';
																															}
																														} ?>>ใช่</label></td>
										<td> <label><input type="radio" class="form-check-input" value="0" name="n1" <?php if (isset($vaccine->vaccine_check->check1)) {
																															if ($vaccine->vaccine_check->check1 == 0) {
																																echo 'checked';
																															}
																														} ?>>ไม่ใช่</label></td>
									</tr>
									<tr>
										<td>2. นักเรียนเคยมีประวัติแพ้ วัคซีนโควิด 19 หรือส่วนประกอบของวัคซีนโควิด 19 <br>
											หรือมีปฏิกิริยาจากการฉีดครั้งก่อนอย่างรุนแรง (พิจารณาให้วัคซีนโควิด 19 ชนิดอื่นแทน)
										</td>
										<td> <label><input type="radio" class="form-check-input" value="1" name="n2" <?php if (isset($vaccine->vaccine_check->check2)) {
																															if ($vaccine->vaccine_check->check2 == 1) {
																																echo 'checked';
																															}
																														} ?>>ใช่</label></td>
										<td> <label><input type="radio" class="form-check-input" value="0" name="n2" <?php if (isset($vaccine->vaccine_check->check2)) {
																															if ($vaccine->vaccine_check->check2 == 0) {
																																echo 'checked';
																															}
																														} ?>>ไม่ใช่</label></td>
									</tr>
									<tr>
										<td>3. นักเรียนได้ตรวจพบเชื้อ โควิด 19 ภายใน 1 เดือน </td>
										<td> <label><input type="radio" class="form-check-input" value="1" name="n3" <?php if (isset($vaccine->vaccine_check->check3)) {
																															if ($vaccine->vaccine_check->check3 == 1) {
																																echo 'checked';
																															}
																														} ?>>ใช่</label></td>
										<td> <label><input type="radio" class="form-check-input" value="0" name="n3" <?php if (isset($vaccine->vaccine_check->check3)) {
																															if ($vaccine->vaccine_check->check3 == 0) {
																																echo 'checked';
																															}
																														} ?>>ไม่ใช่</label></td>
									</tr>
									<tr>
										<td>4. นักเรียนมีโรคประจำตัวที่รุนแรงที่อาการยังไม่คงที่ ไม่สามารถควบคุมอาการของโรคได้ เช่น <br>
											เช่น โรคหัวใจ โรคทางระบบประสาท และโรคอื่น ๆ ที่เพิ่งจะมีอาการกำเริบ <br>
											ยกเว้นแพทย์ผู้ดูแลเป็นประจำได้ประเมินแล้วว่าให้วัคซีนได้ (ผู้ที่มีโรคประจำตัวเหล่านี้ ควรปรึกษาแพทย์ก่อนรับวัคซีน)
										</td>
										<td> <label><input type="radio" class="form-check-input" value="1" name="n4" <?php if (isset($vaccine->vaccine_check->check4)) {
																															if ($vaccine->vaccine_check->check4 == 1) {
																																echo 'checked';
																															}
																														} ?>>ใช่</label></td>
										<td> <label><input type="radio" class="form-check-input" value="0" name="n4" <?php if (isset($vaccine->vaccine_check->check4)) {
																															if ($vaccine->vaccine_check->check4 == 0) {
																																echo 'checked';
																															}
																														} ?>>ไม่ใช่</label></td>
									</tr>
									<tr>
										<td>5. นักเรียนอยู่ระหว่างตั้งครรภ์ ที่มีอายุครรภ์ น้อยกว่า 12 สัปดาห์ </td>
										<td> <label><input type="radio" class="form-check-input" value="1" name="n5" <?php if (isset($vaccine->vaccine_check->check5)) {
																															if ($vaccine->vaccine_check->check5 == 1) {
																																echo 'checked';
																															}
																														} ?>>ใช่</label></td>
										<td> <label><input type="radio" class="form-check-input" value="0" name="n5" <?php if (isset($vaccine->vaccine_check->check5)) {
																															if ($vaccine->vaccine_check->check5 == 0) {
																																echo 'checked';
																															}
																														} ?>>ไม่ใช่</label></td>
									</tr>
									<tr>
										<td>6. นักเรียนมีความเจ็บป่ายที่ต้องอยู่ในโรงพยาบาลหรือเพิ่งออกจากโรงพยาบาลมาไม่เกิน 14 วัน <br>
											(ยกเว้นแพทย์ให้ความเห็นว่าสามารถรับวัคซีนได้)
										</td>
										<td> <label><input type="radio" class="form-check-input" value="1" name="n6" <?php if (isset($vaccine->vaccine_check->check6)) {
																															if ($vaccine->vaccine_check->check6 == 1) {
																																echo 'checked';
																															}
																														} ?>>ใช่</label></td>
										<td> <label><input type="radio" class="form-check-input" value="0" name="n6" <?php if (isset($vaccine->vaccine_check->check6)) {
																															if ($vaccine->vaccine_check->check6 == 0) {
																																echo 'checked';
																															}
																														} ?>>ไม่ใช่</label></td>
									</tr>
									<tr>
										<td>7. นักเรียนกำลังมีอาการป่วยไม่สบายใด ๆ (ควรรักษาให้หายป่วยก่อน) </td>
										<td> <label><input type="radio" class="form-check-input" value="1" name="n7" <?php if (isset($vaccine->vaccine_check->check7)) {
																															if ($vaccine->vaccine_check->check7 == 1) {
																																echo 'checked';
																															}
																														} ?>>ใช่</label></td>
										<td> <label><input type="radio" class="form-check-input" value="0" name="n7" <?php if (isset($vaccine->vaccine_check->check7)) {
																															if ($vaccine->vaccine_check->check7 == 0) {
																																echo 'checked';
																															}
																														} ?>>ไม่ใช่</label></td>
									</tr>
									<tr>
										<td>8. นักเรียนได้รับวัคซีนใด ๆ มาก่อนในช่วง 14 วันหรือไม่ </td>
										<td> <label><input type="radio" class="form-check-input" value="1" name="n8" <?php if (isset($vaccine->vaccine_check->check8)) {
																															if ($vaccine->vaccine_check->check8 == 1) {
																																echo 'checked';
																															}
																														} ?>>ใช่</label></td>
										<td> <label><input type="radio" class="form-check-input" value="0" name="n8" <?php if (isset($vaccine->vaccine_check->check8)) {
																															if ($vaccine->vaccine_check->check8 == 0) {
																																echo 'checked';
																															}
																														} ?>>ไม่ใช่</label></td>
									</tr>
									<tr>
										<td>9. นักเรียนมีความกังวลใจมากในการรับวัคซีนโควิด 19 <br>
											(ขอให้รับคำปรึกษาจากแพทย์หรือบุคลกรทางการแพทย์ เพื่อทำความเข้าใจและคลายความกังวลก่อนรับวัคซีนโควิด 19)
										</td>
										<td> <label><input type="radio" class="form-check-input" value="1" name="n9" <?php if (isset($vaccine->vaccine_check->check9)) {
																															if ($vaccine->vaccine_check->check9 == 1) {
																																echo 'checked';
																															}
																														} ?>>ใช่</label></td>
										<td> <label><input type="radio" class="form-check-input" value="0" name="n9" <?php if (isset($vaccine->vaccine_check->check9)) {
																															if ($vaccine->vaccine_check->check9 == 0) {
																																echo 'checked';
																															}
																														} ?>>ไม่ใช่</label></td>
									</tr>
									<tr>
										<td col-span="2">
											หมายเหตุ หากนักเรียน/นักศึกษาในสถาบันการศึกษาดังกล่าว มีอายุเกิน 18 ปี ให้รับวัคซีนไฟเซอร์ได้พร้อมกับนักเรียนร่วมสถาบันการศึกษา <br>
											ทั้งนี้ ข้าพเจ้า ขอรับรองว่าข้อมูลดังกล่าวเป็นความจริง
										</td>
									</tr>
									<tr>
										<td col-span="2">
											<lable>แนบรูปภาพลายเซ็นต์ผู้ปกครอง
												<img src="<?= base_url('assets/images/e_e.jpg') ?>" height="60">
												<input type="file" class="form-control-file border" name="signal" accept=".jpg, .jpeg, .png" <?= isset($vaccine->signature_parent) ? '' : 'required' ?>>
											</lable>
											<?php
											if (!empty($vaccine->signature_parent)) {
											?>
												<img src="<?= base_url('storages/signatures/' . $vaccine->signature_parent) ?>" height="150">
											<?php
											}
											?>

										</td>
									</tr>

								</tbody>
							</table>

							<center> <button class="btn btn-info" type="submit" name="btn_ok">บันทึกข้อมูล</button></center>

							</form>
						</div>
					</div>
				</div>
			<?php } ?>
			<?php if (($this->session->is_it === true && !empty($vaccine)) || $this->session->is_it === false) { ?>
				<div id="menu3" class="container tab-pane <?= ($this->session->is_it === true) ? 'fade' : 'active' ?>"><br>
					<div class="card">
						<div class="card-header bg-info text-white">
							ส่วนที่ 4: ประวัติการฉีดวัคซีน
						</div>
						<div class="card-body">
							<form method="post" action="<?= site_url('status_vac/submit') ?>" enctype="multipart/form-data">
								<div class="form-row">
									<div class="input-group col-md mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text">ฉีดครั้งที่</span>
										</div>
										<!-- <input type="number" class="form-control" name="time" min="1" value="" required> -->
										<select class="form-control" name="time" required>
											<option value="">----- เลือก -----</option>
											<option value="1">1</option>
											<option value="2">2</option>
										</select>
									</div>
									<div class="input-group col-md mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text">วันที่ฉีดวัคซีน</span>
										</div>
										<input type="date" class="form-control" name="date" value="" required>
									</div>
								</div>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text">ยี่ห้อวัคซีน</span>
									</div>
									<!-- <input type="number" class="form-control" name="time" min="1" value="" required> -->
									<!-- 'Moderna','Pfizer/BioNTech','Janssen (Johnson & Johnson)','Oxford/AstraZeneca','Sinopharm (Beijing)','Sinovac' -->
									<select class="form-control" name="vaccine_brand" required>
										<option value="">----- เลือก -----</option>
										<option value="Moderna">Moderna</option>
										<option value="Pfizer">Pfizer</option>
										<option value="Johnson & Johnson">Johnson & Johnson</option>
										<option value="AstraZeneca">AstraZeneca</option>
										<option value="Sinopharm">Sinopharm</option>
										<option value="Sinovac">Sinovac</option>
									</select>
								</div>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text">อาการหลังฉีดวัคซีน</span>
									</div>
									<textarea class="form-control" rows="1" name="symptom"></textarea>
								</div>
								<!-- <div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text">หลักฐานการฉีดวัคซีน</span>
									</div>
									<input type="file" name="img" class="form-control p-1" accept=".jpg, .jpeg, .png" required>
								</div> -->
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text">หลักฐานการฉีดวัคซีน</span>
									</div>
									<div class="custom-file">
										<input type="file" name="img" class="custom-file-input" id="in_file" accept=".jpg, .jpeg, .png" required>
										<label class="custom-file-label" for="in_file">Choose file</label>
									</div>
								</div>
								<button class="btn btn-info mx-auto d-block" type="submit" name="submit">บันทึกข้อมูล</button>
							</form>
							<br>
							<?php if (isset($status_vac)) { ?>
								<table class="table table-hover mt-5 table-responsive">
									<thead>
										<tr>
											<th scope="col">ฉีดครั้งที่</th>
											<th scope="col">วันที่ฉีดวัคซีน</th>
											<th scope="col">ยี่ห้อวัคซีน</th>
											<th scope="col">อาการหลังฉีดวัคซีน</th>
											<th scope="col">หลักฐานการฉีดวัคซีน</th>
											<th scope="col"></th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($status_vac as $vac) { ?>
											<tr>
												<td><?= $vac->time ?></td>
												<td><?= $vac->date ?></td>
												<td><?= $vac->vaccine_brand ?></td>
												<td><?= $vac->symptom ?></td>
												<td><a href="#img<?= $vac->id ?>" data-toggle="modal"><img src="<?= base_url('storages/vaccine_status/') . $vac->img ?>" height="100"></a></td>
												<td><a href="#edit<?= $vac->id ?>" data-toggle="modal" class="btn btn-sm btn-warning"><i class="fas fa-edit mr-2"></i>แก้ไข</a></td>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							<?php } ?>
						</div>
					</div>

					<?php foreach ($status_vac as $vac) { ?>
						<!-- Modal -->
						<div class="modal fade" id="edit<?= $vac->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content">
									<form method="post" action="<?= site_url('status_vac/edit') ?>" enctype="multipart/form-data">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLongTitle">แก้ไข ฉีดวัคซีนครั้งที่ <?= $vac->time ?></h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<input type="number" class="form-control" name="time" value="<?= $vac->time ?>" style="display: none">
											<div class="input-group mb-3">
												<div class="input-group-prepend">
													<span class="input-group-text">วันที่ฉีดวัคซีน</span>
												</div>
												<input type="date" class="form-control" name="date" value="<?= $vac->date ?>">
											</div>
											<div class="input-group mb-3">
												<div class="input-group-prepend">
													<span class="input-group-text">ยี่ห้อวัคซีน</span>
												</div>
												<!-- <input type="number" class="form-control" name="time" min="1" value="" required> -->
												<!-- 'Moderna','Pfizer/BioNTech','Janssen (Johnson & Johnson)','Oxford/AstraZeneca','Sinopharm (Beijing)','Sinovac' -->
												<select class="form-control" name="vaccine_brand" required>
													<option value="<?= $vac->vaccine_brand ?>"><?= $vac->vaccine_brand ?></option>
													<option value="Moderna">Moderna</option>
													<option value="Pfizer">Pfizer</option>
													<option value="Johnson & Johnson">Johnson & Johnson</option>
													<option value="AstraZeneca">AstraZeneca</option>
													<option value="Sinopharm">Sinopharm</option>
													<option value="Sinovac">Sinovac</option>
												</select>
											</div>
											<div class="input-group mb-3">
												<div class="input-group-prepend">
													<span class="input-group-text">อาการหลังฉีดวัคซีน</span>
												</div>
												<textarea class="form-control" rows="1" name="symptom"><?= $vac->symptom ?></textarea>
											</div>
											<div class="input-group mb-3">
												<div class="input-group-prepend">
													<span class="input-group-text">หลักฐานการฉีดวัคซีน</span>
												</div>
												<!-- <input type="file" name="img" class="form-control p-1" accept=".jpg, .jpeg, .png"> -->
												<div class="custom-file">
													<input type="file" name="img" class="custom-file-input" id="up_file<?= $vac->id ?>" accept=".jpg, .jpeg, .png">
													<label class="custom-file-label" for="up_file<?= $vac->id ?>">Choose file</label>
												</div>
											</div>
											<div class="row justify-content-center">
												<img src="<?= base_url('storages/vaccine_status/') . $vac->img ?>" alt="" style="max-height: 150px; max-white: 150px;">
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
											<button type="submit" class="btn btn-primary" name="edit">Save</button>
										</div>
									</form>
								</div>
							</div>
						</div>

						<div class="modal fade" id="img<?= $vac->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content border-0">
									<div class="modal-body p-0">
										<button type="button" class="close" data-dismiss="modal" style="position: absolute; top: 0.5rem; right:1rem;" aria-label="Close">
											<span aria-hidden="true" style="color: #fff; text-shadow: 0 0 5px #000; font-size:1.5em;">&times;</span>
										</button>
										<div style="width: 100%;">
											<img src="<?= base_url('storages/vaccine_status/') . $vac->img ?>" alt="" class="rounded" style="width: 100%;">
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php } ?>

				</div>
			<?php } ?>
			<?php if ($this->session->is_it === true) { ?>

				<div id="menu4" class="container tab-pane fade"><br>
					<form method="post" action="<?= site_url('form/submit2') ?>" enctype="multipart/form-data">
						<div class="card">
							<div class="card-header bg-info text-white">
								แบบคัดกรองก่อนรับการบริการฉีดวัคซีนโควิด 19 สำหรับนักเรียน/นักศึกษา เข็มที่ 2
							</div>
							<div class="card-body">
								<p><b>คำชี้แจง</b> ให้ผู้ปกครอง กรุณากรอกข้อมูลโดยคลิกเลือกในช่องว่างตามความจริง เพื่อเจ้าหน้าที่จะได้พิจารณาว่า นักเรียน/นักศึกษา สามารถฉีดวัคซีนได้หรือไม่</p>
								<table class="table">

									<tbody>
										<tr>
											<td>1. นักเรียนมีอายุไม่ถึง 12 ปีบริบูรณ์ </td>
											<td> <label><input type="radio" class="form-check-input" value="1" name="n1" <?php if (isset($vaccine2->vaccine_check2->check1)) {
																																if ($vaccine2->vaccine_check2->check1 == 1) {
																																	echo 'checked';
																																}
																															} ?>>ใช่</label></td>
											<td> <label><input type="radio" class="form-check-input" value="0" name="n1" <?php if (isset($vaccine2->vaccine_check2->check1)) {
																																if ($vaccine2->vaccine_check2->check1 == 0) {
																																	echo 'checked';
																																}
																															} ?>>ไม่ใช่</label></td>
										</tr>
										<tr>
											<td>2. นักเรียนเคยมีประวัติแพ้ วัคซีนโควิด 19 หรือส่วนประกอบของวัคซีนโควิด 19 <br>
												หรือมีปฏิกิริยาจากการฉีดครั้งก่อนอย่างรุนแรง (พิจารณาให้วัคซีนโควิด 19 ชนิดอื่นแทน)
											</td>
											<td> <label><input type="radio" class="form-check-input" value="1" name="n2" <?php if (isset($vaccine2->vaccine_check2->check2)) {
																																if ($vaccine2->vaccine_check2->check2 == 1) {
																																	echo 'checked';
																																}
																															} ?>>ใช่</label></td>
											<td> <label><input type="radio" class="form-check-input" value="0" name="n2" <?php if (isset($vaccine2->vaccine_check2->check2)) {
																																if ($vaccine2->vaccine_check2->check2 == 0) {
																																	echo 'checked';
																																}
																															} ?>>ไม่ใช่</label></td>
										</tr>
										<tr>
											<td>3. นักเรียนได้ตรวจพบเชื้อ โควิด 19 ภายใน 1 เดือน </td>
											<td> <label><input type="radio" class="form-check-input" value="1" name="n3" <?php if (isset($vaccine2->vaccine_check2->check3)) {
																																if ($vaccine2->vaccine_check2->check3 == 1) {
																																	echo 'checked';
																																}
																															} ?>>ใช่</label></td>
											<td> <label><input type="radio" class="form-check-input" value="0" name="n3" <?php if (isset($vaccine2->vaccine_check2->check3)) {
																																if ($vaccine2->vaccine_check2->check3 == 0) {
																																	echo 'checked';
																																}
																															} ?>>ไม่ใช่</label></td>
										</tr>
										<tr>
											<td>4. นักเรียนมีโรคประจำตัวที่รุนแรงที่อาการยังไม่คงที่ ไม่สามารถควบคุมอาการของโรคได้ เช่น <br>
												เช่น โรคหัวใจ โรคทางระบบประสาท และโรคอื่น ๆ ที่เพิ่งจะมีอาการกำเริบ <br>
												ยกเว้นแพทย์ผู้ดูแลเป็นประจำได้ประเมินแล้วว่าให้วัคซีนได้ (ผู้ที่มีโรคประจำตัวเหล่านี้ ควรปรึกษาแพทย์ก่อนรับวัคซีน)
											</td>
											<td> <label><input type="radio" class="form-check-input" value="1" name="n4" <?php if (isset($vaccine2->vaccine_check2->check4)) {
																																if ($vaccine2->vaccine_check2->check4 == 1) {
																																	echo 'checked';
																																}
																															} ?>>ใช่</label></td>
											<td> <label><input type="radio" class="form-check-input" value="0" name="n4" <?php if (isset($vaccine2->vaccine_check2->check4)) {
																																if ($vaccine2->vaccine_check2->check4 == 0) {
																																	echo 'checked';
																																}
																															} ?>>ไม่ใช่</label></td>
										</tr>
										<tr>
											<td>5. นักเรียนอยู่ระหว่างตั้งครรภ์ ที่มีอายุครรภ์ น้อยกว่า 12 สัปดาห์ </td>
											<td> <label><input type="radio" class="form-check-input" value="1" name="n5" <?php if (isset($vaccine2->vaccine_check2->check5)) {
																																if ($vaccine2->vaccine_check2->check5 == 1) {
																																	echo 'checked';
																																}
																															} ?>>ใช่</label></td>
											<td> <label><input type="radio" class="form-check-input" value="0" name="n5" <?php if (isset($vaccine2->vaccine_check2->check5)) {
																																if ($vaccine2->vaccine_check2->check5 == 0) {
																																	echo 'checked';
																																}
																															} ?>>ไม่ใช่</label></td>
										</tr>
										<tr>
											<td>6. นักเรียนมีความเจ็บป่ายที่ต้องอยู่ในโรงพยาบาลหรือเพิ่งออกจากโรงพยาบาลมาไม่เกิน 14 วัน <br>
												(ยกเว้นแพทย์ให้ความเห็นว่าสามารถรับวัคซีนได้)
											</td>
											<td> <label><input type="radio" class="form-check-input" value="1" name="n6" <?php if (isset($vaccine2->vaccine_check2->check6)) {
																																if ($vaccine2->vaccine_check2->check6 == 1) {
																																	echo 'checked';
																																}
																															} ?>>ใช่</label></td>
											<td> <label><input type="radio" class="form-check-input" value="0" name="n6" <?php if (isset($vaccine2->vaccine_check2->check6)) {
																																if ($vaccine2->vaccine_check2->check6 == 0) {
																																	echo 'checked';
																																}
																															} ?>>ไม่ใช่</label></td>
										</tr>
										<tr>
											<td>7. นักเรียนกำลังมีอาการป่วยไม่สบายใด ๆ (ควรรักษาให้หายป่วยก่อน) </td>
											<td> <label><input type="radio" class="form-check-input" value="1" name="n7" <?php if (isset($vaccine2->vaccine_check2->check7)) {
																																if ($vaccine2->vaccine_check2->check7 == 1) {
																																	echo 'checked';
																																}
																															} ?>>ใช่</label></td>
											<td> <label><input type="radio" class="form-check-input" value="0" name="n7" <?php if (isset($vaccine2->vaccine_check2->check7)) {
																																if ($vaccine2->vaccine_check2->check7 == 0) {
																																	echo 'checked';
																																}
																															} ?>>ไม่ใช่</label></td>
										</tr>
										<tr>
											<td>8. นักเรียนได้รับวัคซีนใด ๆ มาก่อนในช่วง 14 วันหรือไม่ </td>
											<td> <label><input type="radio" class="form-check-input" value="1" name="n8" <?php if (isset($vaccine2->vaccine_check2->check8)) {
																																if ($vaccine2->vaccine_check2->check8 == 1) {
																																	echo 'checked';
																																}
																															} ?>>ใช่</label></td>
											<td> <label><input type="radio" class="form-check-input" value="0" name="n8" <?php if (isset($vaccine2->vaccine_check2->check8)) {
																																if ($vaccine2->vaccine_check2->check8 == 0) {
																																	echo 'checked';
																																}
																															} ?>>ไม่ใช่</label></td>
										</tr>
										<tr>
											<td>9. นักเรียนมีความกังวลใจมากในการรับวัคซีนโควิด 19 <br>
												(ขอให้รับคำปรึกษาจากแพทย์หรือบุคลกรทางการแพทย์ เพื่อทำความเข้าใจและคลายความกังวลก่อนรับวัคซีนโควิด 19)
											</td>
											<td> <label><input type="radio" class="form-check-input" value="1" name="n9" <?php if (isset($vaccine2->vaccine_check2->check9)) {
																																if ($vaccine2->vaccine_check2->check9 == 1) {
																																	echo 'checked';
																																}
																															} ?>>ใช่</label></td>
											<td> <label><input type="radio" class="form-check-input" value="0" name="n9" <?php if (isset($vaccine2->vaccine_check2->check9)) {
																																if ($vaccine2->vaccine_check2->check9 == 0) {
																																	echo 'checked';
																																}
																															} ?>>ไม่ใช่</label></td>
										</tr>
										<tr>
											<td col-span="2">
												หมายเหตุ หากนักเรียน/นักศึกษาในสถาบันการศึกษาดังกล่าว มีอายุเกิน 18 ปี ให้รับวัคซีนไฟเซอร์ได้พร้อมกับนักเรียนร่วมสถาบันการศึกษา <br>
												ทั้งนี้ ข้าพเจ้า ขอรับรองว่าข้อมูลดังกล่าวเป็นความจริง
											</td>
										</tr>

									</tbody>
								</table>

							</div>
						</div>

						<div class="card mt-4">
							<div class="card-header bg-info text-white">
								เอกสารแสดงความประสงค์ของผู้ปกครองให้บุตรหลานฉีดวัคซีนไฟเซอร์ เข็มที่ 2
							</div>
							<div class="card-body">
								<div class="form-check-inline">
									<label class="form-check-label" style="padding-left:5.5em">
										<label><input type="radio" class="form-check-input" name="consent" value="1" <?php if (isset($vaccine2->consent)) {
																															if ($vaccine2->consent == 1) {
																																echo 'checked';
																															}
																														} ?>>ประสงค์ให้บุตรหลาน ฉีดวัคซีนไฟเซอร์โดยสมัครใจ</label><br>
										<label><input type="radio" class="form-check-input" name="consent" value="0" <?php if (isset($vaccine2->consent)) {
																															if ($vaccine2->consent == 0) {
																																echo 'checked';
																															}
																														} ?>>ไม่ประสงค์ให้บุตรหลาน ฉีดวัคซีนไฟเซอร์โดยสมัครใจ</label>
										<div class="input-group mb-3">
											<div class="input-group-prepend">
												<span class="input-group-text">เหตุผล</span>
											</div>
											<input type="text" class="form-control" name="cause" value="<?= isset($vaccine2->cause) ? $vaccine2->cause : '' ?>">
										</div>
									</label>
								</div>
								<br><br>
								<center> <button class="btn btn-info" type="submit" name="btn_ok">บันทึกข้อมูล</button></center>


							</div>
						</div>
					</form>
				</div>
			<?php } ?>
		</div>
	</div>

</body>

</html>
