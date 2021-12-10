<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายงานการฉีดวัคซีน</title>

    <link rel="stylesheet" href="<?= base_url('assets/font/font.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/reset.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/print.css') ?>">

    <script src="<?= base_url('assets/js/jquery-3.6.0.min.js') ?>"></script>
    <!-- <script src="<?= base_url('assets/js/print.js') ?>"></script> -->
</head>

<body>
    <!-- <pre>
    <?php // var_dump($group) 
    ?>
    </pre> -->
    <div class="pagebreak">
        <img src="<?= base_url('assets/img/245167299.jpg') ?>" class="header-img">
        <p class="header">
            <?php $class = strtoupper($group->group_name)[0]; ?>
            ระดับชั้น <?= $class == 'D' || $class == 'E' ? 'ปวส.' : 'ปวช.'  ?> กลุ่มการเรียน <?= $group->group_name ?>
            <br>
            ครูที่ปรึกษา <?= $group->firstname . ' ' . $group->lastname ?>
        </p>
        <table class="table-std">
            <thead>
                <th style="width: 4em">ลำดับที่</th>
                <th style="width: 7em">รหัสนักศึกษา</th>
                <th>ชื่อ - นามสกุล</th>
                <th>สถานะ</th>
                <th>อาการหลังฉีดวัคซีน</th>
            </thead>
            <tbody>
                <?php
                $i = 0;
                $x = 0;
                $y = 0;
                foreach ($group->student as $std) {
                ?>
                    <tr>
                        <td class="text-center"><?= ++$i ?></td>
                        <td class="text-center"><?= $std->student_id ?></td>
                        <td><?= $std->firstname . ' ' . $std->lastname ?></td>
                        <td class="text-center">
                            <?php
                            if (isset($std->time)) {
                                echo 'ฉีด';
                                $x++;
                            } else {
                                echo '<span style="color: #f00">ไม่ฉีด</span>';
                                $y++;
                            }
                            ?>
                        </td>
                        <td><?= $std->symptom ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        
        <p style="margin-top: 2em;">
            รวมจำนวนที่ได้รับวัคซีน <?= $x ?> คน ยังไม่ได้รับวัคซีน <?= $y ?> คน รวม <?= $x+$y ?> คน
        <p>
    </div>
</body>

</html>