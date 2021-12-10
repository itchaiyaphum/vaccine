<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Pfizer Form</title>
    <style>
        body {
            font-family: "thsarabunnew", "sans-serif";
            font-size: 14pt;
            color: #000000;
        }

        .box {
            background-color: rgba(255, 255, 0, 0.2);
            color: red;
        }

        .absolute {
            position: absolute;
            display: inline;
        }

        .font-18 {
            font-size: 18pt;
        }

        .font-16 {
            font-size: 16pt;
        }

        .icon {
            font-family: "sans-serif";
        }

        .signature {
            text-align: center;
        }

        .text-center {
            text-align: center;
        }
        .red {
            color: #f00;
        }
    </style>
</head>

<body>
    <?php
    if ($page == 1) {
    ?>
        <div class="absolute" style="top: 50.5mm; left: 60mm; width: 50mm;"><?= $users_std->firstname . '&nbsp;&nbsp;&nbsp;&nbsp;' . $users_std->lastname ?></div>
        <div class="absolute" style="top: 50.5mm; left: 128mm; width: 8mm;"><?= isset($vaccine->age_std) ? $vaccine->age_std : '' ?></div>
        <div class="absolute" style="top: 50.5mm; left: 163mm; width: 22mm;"><?= isset($vaccine->birthday_std) ? $this->tothai->toThaiDateTime($vaccine->birthday_std, '%d/%m/%y', true) : '' ?></div>

        <div class="absolute" style="top: 56.5mm; left: 60mm; width: 70mm;"><?= isset($vaccine->card_no_std) ? $vaccine->card_no_std : '' ?></div>
        <div class="absolute" style="top: 56.5mm; left: 145mm; width: 40mm;"><?= isset($vaccine->nationality_std) ? $vaccine->nationality_std : '' ?></div>

        <div class="absolute" style="top: 62.6mm; left: 49mm; width: 60mm;">วิทยาลัยเทคนิคชัยภูมิ</div>
        <div class="absolute" style="top: 62.6mm; left: 120mm; width: 35mm;"><?= $users_std->group_level ?></div>
        <div class="absolute" style="top: 62.6mm; left: 167mm; width: 15mm;"><?= $users_std->group_data[0]->group_name ?></div>

        <div class="absolute" style="top: 68.8mm; left: 35mm; width: 65mm;"><?= isset($vaccine->add_number_parent) ? $vaccine->add_number_parent : '' ?></div>
        <div class="absolute" style="top: 68.8mm; left: 115mm; width: 18mm;"><?= isset($vaccine->group_parent) ? $vaccine->group_parent : '' ?></div>
        <div class="absolute" style="top: 68.8mm; left: 142mm; width: 40mm;"><?= isset($vaccine->roard_parent) ? $vaccine->roard_parent : '' ?></div>

        <div class="absolute" style="top: 75mm; left: 42mm; width: 35mm;"><?= isset($vaccine->sub_distric_parent) ? $vaccine->sub_distric_parent : '' ?></div>
        <div class="absolute" style="top: 75mm; left: 93mm; width: 35mm;"><?= isset($vaccine->district_parent) ? $vaccine->district_parent : '' ?></div>
        <div class="absolute" style="top: 75mm; left: 144mm; width: 35mm;"><?= isset($vaccine->province_parent) ? $vaccine->province_parent : '' ?></div>

        <div class="absolute" style="top: 81.3mm; left: 65mm; width: 50mm;"><?= isset($vaccine->std_tel) ? $vaccine->std_tel : '' ?></div>


        <div class="absolute" style="top: 192mm; left: 58mm; width: 53mm;"><?= isset($vaccine->parent_name) ? $vaccine->parent_name : '' ?>&nbsp;&nbsp;&nbsp;&nbsp;<?= isset($vaccine->parent_name) ? $vaccine->parent_lname : '' ?></div>
        <div class="absolute" style="top: 192mm; left: 153mm; width: 30mm;"><?= isset($vaccine->parent_tel) ? $vaccine->parent_tel : '' ?></div>

        <div class="absolute" style="top: 198mm; left: 45mm; width: 60mm;"><?= $users_std->firstname . ' ' . $users_std->lastname ?></div>
        <div class="absolute" style="top: 198mm; left: 143mm; width: 35mm;"><?= isset($vaccine->relation) ? $vaccine->relation : '' ?></div>


        <?php if (isset($vaccine2->consent)) { ?>
        <?php if ($vaccine2->consent == 1) { ?>
            <div class="absolute icon font-18 red" style="top: 215mm; left: 46.5mm;"><span>&#10003;</span></div>
        <?php } elseif ($vaccine2->consent == 0) { ?>
            <div class="absolute icon font-18 red" style="top: 221mm; left: 46mm;"><span>&#10003;</span></div>
        <?php }} ?>
        <div class="absolute" style="top: 223.2mm; left: 80mm; width: 100mm;"><?= isset($vaccine2->cause) ? $vaccine2->cause : '' ?></div>


        <div class="absolute text-center" style="top: 247.8mm; left: 75mm; width: 64mm;"><?= isset($vaccine->parent_name) ? $vaccine->parent_name : '' ?>&nbsp;&nbsp;&nbsp;&nbsp;<?= isset($vaccine->parent_name) ? $vaccine->parent_lname : '' ?></div>

        <div class="absolute text-center" style="top: 253.8mm; left: 80mm; width: 10.5mm;"><?= $this->tothai->toThaiDateTime($vaccine2->updated_at, '%d', true) ?></div>
        <div class="absolute text-center" style="top: 253.8mm; left: 92mm; width: 20mm;"><?= $this->tothai->toThaiDateTime($vaccine2->updated_at, '%m', true) ?></div>
        <div class="absolute text-center" style="top: 253.8mm; left: 113.5mm; width: 15mm;"><?= $this->tothai->toThaiDateTime($vaccine2->updated_at, '%y', true) ?></div>

    <?php
    } elseif ($page == 2) {
    ?>

        <!-- n1 -->
        <?php if (isset($vaccine2->vaccine_check2->check1)) { ?>
        <?php if ($vaccine2->vaccine_check2->check1 == 1) { ?>
            <div class="absolute icon font-18 red" style="top: 72mm; left: 157.3mm;"><span>&#10003;</span></div>
        <?php } elseif ($vaccine2->vaccine_check2->check1 == 0) { ?>
            <div class="absolute icon font-18 red" style="top: 72mm; left: 172.3mm;"><span>&#10003;</span></div>
        <?php }} ?>

        <!-- n2 -->
        <?php if (isset($vaccine2->vaccine_check2->check2)) { ?>
        <?php if ($vaccine2->vaccine_check2->check2 == 1) { ?>
            <div class="absolute icon font-18 red" style="top: 87mm; left: 157.3mm;"><span>&#10003;</span></div>
        <?php } elseif ($vaccine2->vaccine_check2->check2 == 0) { ?>
            <div class="absolute icon font-18 red" style="top: 87mm; left: 172.3mm;"><span>&#10003;</span></div>
        <?php }} ?>

        <!-- n3 -->
        <?php if (isset($vaccine2->vaccine_check2->check3)) { ?>
        <?php if ($vaccine2->vaccine_check2->check3 == 1) { ?>
            <div class="absolute icon font-18 red" style="top: 102mm; left: 157.3mm;"><span>&#10003;</span></div>
        <?php } elseif ($vaccine2->vaccine_check2->check3 == 0) { ?>
            <div class="absolute icon font-18 red" style="top: 102mm; left: 172.3mm;"><span>&#10003;</span></div>
        <?php }} ?>

        <!-- n4 -->
        <?php if (isset($vaccine2->vaccine_check2->check4)) { ?>
        <?php if ($vaccine2->vaccine_check2->check4 == 1) { ?>
            <div class="absolute icon font-18 red" style="top: 121mm; left: 157.3mm;"><span>&#10003;</span></div>
        <?php } elseif ($vaccine2->vaccine_check2->check4 == 0) { ?>
            <div class="absolute icon font-18 red" style="top: 121mm; left: 172.3mm;"><span>&#10003;</span></div>
        <?php }} ?>

        <!-- n5 -->
        <?php if (isset($vaccine2->vaccine_check2->check5)) { ?>
        <?php if ($vaccine2->vaccine_check2->check5 == 1) { ?>
            <div class="absolute icon font-18 red" style="top: 140mm; left: 157.3mm;"><span>&#10003;</span></div>
        <?php } elseif ($vaccine2->vaccine_check2->check5 == 0) { ?>
            <div class="absolute icon font-18 red" style="top: 140mm; left: 172.3mm;"><span>&#10003;</span></div>
        <?php }} ?>

        <!-- n6 -->
        <?php if (isset($vaccine2->vaccine_check2->check6)) { ?>
        <?php if ($vaccine2->vaccine_check2->check6 == 1) { ?>
            <div class="absolute icon font-18 red" style="top: 151.6mm; left: 157.3mm;"><span>&#10003;</span></div>
        <?php } elseif ($vaccine2->vaccine_check2->check6 == 0) { ?>
            <div class="absolute icon font-18 red" style="top: 151.6mm; left: 172.3mm;"><span>&#10003;</span></div>
        <?php }} ?>

        <!-- n7 -->
        <?php if (isset($vaccine2->vaccine_check2->check7)) { ?>
        <?php if ($vaccine2->vaccine_check2->check7 == 1) { ?>
            <div class="absolute icon font-18 red" style="top: 163mm; left: 157.3mm;"><span>&#10003;</span></div>
        <?php } elseif ($vaccine2->vaccine_check2->check7 == 0) { ?>
            <div class="absolute icon font-18 red" style="top: 163mm; left: 172.3mm;"><span>&#10003;</span></div>
        <?php }} ?>

        <!-- n8 -->
        <?php if (isset($vaccine2->vaccine_check2->check8)) { ?>
        <?php if ($vaccine2->vaccine_check2->check8 == 1) { ?>
            <div class="absolute icon font-18 red" style="top: 170.6mm; left: 157.3mm;"><span>&#10003;</span></div>
        <?php } elseif ($vaccine2->vaccine_check2->check8 == 0) { ?>
            <div class="absolute icon font-18 red" style="top: 170.6mm; left: 172.3mm;"><span>&#10003;</span></div>
        <?php }} ?>

        <!-- n9 -->
        <?php if (isset($vaccine2->vaccine_check2->check9)) { ?>
        <?php if ($vaccine2->vaccine_check2->check9 == 1) { ?>
            <div class="absolute icon font-18 red" style="top: 178.3mm; left: 157.3mm;"><span>&#10003;</span></div>
        <?php } elseif ($vaccine2->vaccine_check2->check9 == 0) { ?>
            <div class="absolute icon font-18 red" style="top: 178.3mm; left: 172.3mm;"><span>&#10003;</span></div>
        <?php }} ?>
        


        <div class="absolute text-center" style="top: 254mm; left: 75mm; width: 64mm;"><?= isset($vaccine->parent_name) ? $vaccine->parent_name : '' ?>&nbsp;&nbsp;&nbsp;&nbsp;<?= isset($vaccine->parent_name) ? $vaccine->parent_lname : '' ?></div>

        <div class="absolute text-center" style="top: 261.3mm; left: 88mm; width: 12mm;"><?= $this->tothai->toThaiDateTime($vaccine2->updated_at, '%d', true) ?></div>
        <div class="absolute text-center" style="top: 261.3mm; left: 101.5mm; width: 22.5mm;"><?= $this->tothai->toThaiDateTime($vaccine2->updated_at, '%m', true) ?></div>
        <div class="absolute text-center" style="top: 261.3mm; left: 126mm; width: 15mm;"><?= $this->tothai->toThaiDateTime($vaccine2->updated_at, '%y', true) ?></div>
    <?php
    }
    ?>
</body>

</html>