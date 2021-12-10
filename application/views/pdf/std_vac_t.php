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

    <div class="pagebreak">
        <img src="<?= base_url('assets/img/245167299.jpg') ?>" class="header-img">
        <p class="header">
            ระดับชั้น .......................................................... กลุ่มการเรียน ..............................
            <br>
            ครูที่ปรึกษา .........................................................................................
            <br>
            ครั้งที่ ............. วันที่ ....................................................
        </p>
        <table class="table-std">
            <thead>
                <th style="width: 4em">ลำดับที่</th>
                <th style="width: 7em">รหัสนักศึกษา</th>
                <th>ชื่อ - นามสกุล</th>
                <th>อาการหลังฉีดวัคซีน</th>
            </thead>
            <tbody>
                <?php for ($i = 1; $i <= 20; $i++) { ?>
                    <tr>
                        <td class="text-center"><?= $i ?></td>
                        <td class="text-center"></td>
                        <td></td>
                        <td></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <div class="sign">
            ลงชื่อ ...............................................................
            <br>
            ( ....................................................... )
            <br>
            ครูที่ปรึกษากลุ่ม ...............
        </div>
    </div>
</body>

</html>