<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="<?= base_url('assets/fontawesome/css/all.min.css') ?>" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/mystyle2.css') ?>">
    <script src="<?= base_url('assets/js/sweetalert2.all.min.js') ?>"></script>
    <style>
        input[type=text],
        select {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type=submit] {
            background-color: Transparent;
            cursor: pointer;
            font-size: 22px;
            display: inline-block;
            padding: 12px 50px;
            color: #e66767;
            border: 2px solid #e66767;
            border-radius: 6px;
            margin-top: 16px;
            transition: .3s linear;
        }

        input[type=submit]:hover {
            background-color: #e66767;
            color: #f2f2f2;
        }
    </style>
    

</head>

<body>
    <?php
    if (!empty(validation_errors())) {
    ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Login Failed',
                html: "<?= form_error('student_id') ?>",
            })
        </script>
    <?php
    }
    ?>
    <div class="profile-card">
        <div class="card-header">
            <div class="pic">
                <img src="<?= base_url('assets/images/vaccine.jpg') ?>">
            </div>
            <div class="name"> IT CTC </div>
            <div class="dep">
				ระบบสำรวจการรับวัคซีน นักเรียน นักศึกษา
				<br>วิทยาลัยเทคนิคชัยภูมิ
			</div>
            <div class="sm">
                <a href="#" class="fab fa-facebook-f"></a>
                <a href="#" class="fab fa-twitter"></a>
                <a href="#" class="fab fa-github"></a>
                <a href="#" class="fab fa-youtube"></a>
            </div>
            <form method="post" action="">
                <input type="text" name="student_id" value="<?= set_value('student_id') ?>" placeholder="ป้อนรหัสนักศึกษา">

                <input type="submit" value="Submit" name="btn_ok"><br><br>
            </form>

            <hr>
            <a href="<?= site_url('auth/advisor') ?>" class="sm" style="color:white;" >
                <i class="fas fa-chalkboard-teacher"></i>&nbsp;&nbsp;สำหรับครูที่ปรึกษา 
            </a>

        </div> <!-- //div card-header  -->

</body>

</html>
