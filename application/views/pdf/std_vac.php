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
    <script src="<?= base_url('assets/js/print.js') ?>"></script>
</head>

<body>
    <!-- <pre>
    <?php var_dump($group) ?>
    </pre> -->
    <div class="pagebreak">
        <img src="<?= base_url('assets/img/245167299.jpg') ?>" class="header-img">
        <p class="header">
            <?php $class = strtoupper($group->group_name)[0]; ?>
            ระดับชั้น <?= $class == 'D' || $class == 'E' ? 'ปวส.' : 'ปวช.'  ?> กลุ่มการเรียน <?= $group->group_name ?>
            <br>
            ครูที่ปรึกษา <?= $group->firstname . ' ' . $group->lastname ?>
            <br>
            ครั้งที่ <?= $this->input->get('time') ?> วันที่
            <?php
            if ($this->input->get('time') == 1) {
                if ($class == 'A') {
                    echo '13 ตุลาคม 2564';
                } else {
                    echo '18 ตุลาคม 2564';
                }
            } elseif ($this->input->get('time') == 2) {
                echo '8 พฤศจิกายน 2564';
            } ?>
        </p>
        <table class="table-std">
            <thead>
                <th style="width: 4em">ลำดับที่</th>
                <th style="width: 7em">รหัสนักศึกษา</th>
                <th>ชื่อ - นามสกุล</th>
                <th>อาการหลังฉีดวัคซีน</th>
            </thead>
            <tbody>
                <?php
                $i = 0;
                foreach ($group->student as $std) {
                ?>
                    <tr>
                        <td class="text-center"><?= ++$i ?></td>
                        <td class="text-center"><?= $std->student_id ?></td>
                        <td><?= $std->firstname . ' ' . $std->lastname ?></td>
                        <td><?= isset($std->symptom) ? $std->symptom : '' ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <p style="margin-top: 2em;">
            รวมจำนวนที่ได้รับวัคซีน <?= count($group->student) ?> คน
        <p>
        <div class="sign">
            <table class="sign-table">
                <tr>
                    <td>
                        <div class="signature" style="transform: translate(23mm, -10mm);">
                            <img src="http://activity64.itchaiyaphum.com/<?= $group->signature ?>">
                        </div>
                        ลงชื่อ

                        ...........................................................

                        <div class="sign-name">
                            ( <?= $group->firstname . ' ' . $group->lastname ?> )
                        </div>
                        ครูที่ปรึกษากลุ่ม <?= $group->group_name ?>
                    </td>
                    <td>

                        <div class="signature" style="transform: translate(23mm, -10mm);">
                        <!-- <div class="signature" style="transform: translate(23mm, -10mm);"> -->
                            <img src="http://activity64.itchaiyaphum.com/<?= $group->dpm_signature ?>">
                        </div>
                        ลงชื่อ

                        ...........................................................

                        <div class="sign-name">
                            ( <?= $group->dpm_firstname . ' ' . $group->dpm_lastname ?> )
                        </div>
                        หัวหน้าแผนก <?= $group->major_name ?>
                    </td>

                <tr>
            </table>
        </div>
    </div>
</body>

</html>