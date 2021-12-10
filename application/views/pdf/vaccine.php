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
    </style>
</head>

<body>
    <?php
    if ($page == 2) {
    ?>
        <div class="absolute" style="top: 122mm; left: 60mm; width: 50mm;"><?= isset($vaccine->parent_name) ? $vaccine->parent_name : '' ?>  <?= isset($vaccine->parent_name) ? $vaccine->parent_lname : '' ?></div>
        <div class="absolute" style="top: 122mm; left: 147mm; width: 30mm;"><?= isset($vaccine->parent_tel) ? $vaccine->parent_tel : '' ?></div>
        <div class="absolute" style="top: 127.5mm; left: 50mm;  width: 60mm;"><?= $users_std->firstname . ' ' . $users_std->lastname ?></div>
        <div class="absolute" style="top: 127.5mm; left: 140mm; width: 35mm;"><?= isset($vaccine->relation) ? $vaccine->relation : '' ?></div>
        <div class="absolute" style="top: 133mm; left: 40mm; width: 65mm;"><?= isset($vaccine->add_number_parent) ? $vaccine->add_number_parent : '' ?></div>
        <div class="absolute" style="top: 133mm; left: 115mm; width: 20mm;"><?= isset($vaccine->group_parent) ? $vaccine->group_parent : '' ?></div>
        <div class="absolute" style="top: 133mm; left: 140mm; width: 35mm;"><?= isset($vaccine->roard_parent) ? $vaccine->roard_parent : '' ?></div>
        <div class="absolute" style="top: 138.6mm; left: 46mm; width: 35mm;"><?= isset($vaccine->sub_distric_parent) ? $vaccine->sub_distric_parent : '' ?></div>
        <div class="absolute" style="top: 138.6mm; left: 92mm; width: 35mm;"><?= isset($vaccine->district_parent) ? $vaccine->district_parent : '' ?></div>
        <div class="absolute" style="top: 138.6mm; left: 140mm; width: 35mm;"><?= isset($vaccine->province_parent) ? $vaccine->province_parent : '' ?></div>
        <div class="absolute" style="top: 144.5mm; left: 65mm; width: 50mm;"><?= isset($vaccine->std_tel) ? $vaccine->std_tel : '' ?></div>

        <div class="absolute" style="top: 156mm; left: 60mm; width: 50mm;"><?= $users_std->firstname . ' ' . $users_std->lastname ?></div>
        <div class="absolute" style="top: 156mm; left: 123mm; width: 8mm;"><?= isset($vaccine->age_std) ? $vaccine->age_std : '' ?></div>
        <div class="absolute" style="top: 156mm; left: 157mm; width: 25mm;"><?= isset($vaccine->birthday_std) ? $this->tothai->toThaiDateTime($vaccine->birthday_std, '%d/%m/%y', true) : '' ?></div>
        <div class="absolute" style="top: 161.6mm; left: 115mm; width: 35mm;"><?= isset($vaccine->card_no_std) ? $vaccine->card_no_std : '' ?></div>
        <div class="absolute" style="top: 161.6mm; left: 158mm; width: 20mm;"><?= isset($vaccine->nationality_std) ? $vaccine->nationality_std : '' ?></div>
        <div class="absolute" style="top: 167mm; left: 49mm; width: 50mm;">วิทยาลัยเทคนิคชัยภูมิ</div>
        <div class="absolute" style="top: 167mm; left: 115mm; width: 35mm;"><?= $users_std->group_level ?></div>
        <div class="absolute" style="top: 167mm; left: 160mm; width: 20mm;"><?= $users_std->group_data[0]->group_name ?></div>

        <?php if (isset($vaccine->consent)) { ?>
        <?php if ($vaccine->consent == 1) { ?>
            <div class="absolute icon font-18" style="top: 187.5mm; left: 49.6mm;"><span>&#10003;</span></div>
        <?php } else { ?>
            <div class="absolute icon font-18" style="top: 193.5mm; left: 49mm;"><span>&#10003;</span></div>
        <?php }} ?>

        <div class="absolute" style="top: 196mm; left: 120mm; width: 60mm;"><?= isset($vaccine->cause) ? $vaccine->cause : '' ?></div>

        <?php if (isset($vaccine->signature_parent)) { ?>
        <div class="absolute signature" style="top: 207mm; left: 80mm; width: 50mm; height: 10mm">
            <img src="<?= base_url('storages/signatures/' . $vaccine->signature_parent) ?>">
        </div>
        <?php } ?>
        <div class="absolute text-center" style="top: 218.5mm; left: 77mm; width: 56mm;"><?= isset($vaccine->parent_name) ? $vaccine->parent_name : '' ?>  <?= isset($vaccine->parent_name) ? $vaccine->parent_lname : '' ?></div>
        <?php if (isset($vaccine->updated_at)) { ?>
        <div class="absolute text-center" style="top: 224mm; left: 81mm; width: 10mm;"><?= $this->tothai->toThaiDateTime($vaccine->updated_at, '%d', true) ?></div>
        <div class="absolute text-center" style="top: 224mm; left: 92mm; width: 18mm;"><?= $this->tothai->toThaiDateTime($vaccine->updated_at, '%m', true) ?></div>
        <div class="absolute text-center" style="top: 224mm; left: 110mm; width: 15mm;"><?= $this->tothai->toThaiDateTime($vaccine->updated_at, '%y', true) ?></div>
        <?php } ?> 

    <?php
    } elseif ($page == 3) {
    ?>
        <!-- n1 -->
        <?php if (isset($vaccine->vaccine_check->check1)) { ?>
        <?php if ($vaccine->vaccine_check->check1 == 1) { ?>
            <div class="absolute icon font-18" style="top: 72mm; left: 151mm;"><span>&#10003;</span></div>
        <?php } elseif ($vaccine->vaccine_check->check1 == 0) { ?>
            <div class="absolute icon font-18" style="top: 72mm; left: 164.5mm;"><span>&#10003;</span></div>
        <?php }} ?>

        <!-- n2 -->
        <?php if (isset($vaccine->vaccine_check->check2)) { ?>
        <?php if ($vaccine->vaccine_check->check2 == 1) { ?>
            <div class="absolute icon font-18" style="top: 84.5mm; left: 151mm;"><span>&#10003;</span></div>
        <?php } elseif ($vaccine->vaccine_check->check2 == 0) { ?>
            <div class="absolute icon font-18" style="top: 84.5mm; left: 164.5mm;"><span>&#10003;</span></div>
        <?php }} ?>

        <!-- n3 -->
        <?php if (isset($vaccine->vaccine_check->check3)) { ?>
        <?php if ($vaccine->vaccine_check->check3 == 1) { ?>
            <div class="absolute icon font-18" style="top: 97mm; left: 151mm;"><span>&#10003;</span></div>
        <?php } elseif ($vaccine->vaccine_check->check3 == 0) { ?>
            <div class="absolute icon font-18" style="top: 97mm; left: 164.5mm;"><span>&#10003;</span></div>
        <?php }} ?>

        <!-- n4 -->
        <?php if (isset($vaccine->vaccine_check->check4)) { ?>
        <?php if ($vaccine->vaccine_check->check4 == 1) { ?>
            <div class="absolute icon font-18" style="top: 112mm; left: 151mm;"><span>&#10003;</span></div>
        <?php } elseif ($vaccine->vaccine_check->check4 == 0) { ?>
            <div class="absolute icon font-18" style="top: 112mm; left: 164.5mm;"><span>&#10003;</span></div>
        <?php }} ?>

        <!-- n5 -->
        <?php if (isset($vaccine->vaccine_check->check5)) { ?>
        <?php if ($vaccine->vaccine_check->check5 == 1) { ?>
            <div class="absolute icon font-18" style="top: 127.7mm; left: 151mm;"><span>&#10003;</span></div>
        <?php } elseif ($vaccine->vaccine_check->check5 == 0) { ?>
            <div class="absolute icon font-18" style="top: 127.7mm; left: 164.5mm;"><span>&#10003;</span></div>
        <?php }} ?>

        <!-- n6 -->
        <?php if (isset($vaccine->vaccine_check->check6)) { ?>
        <?php if ($vaccine->vaccine_check->check6 == 1) { ?>
            <div class="absolute icon font-18" style="top: 137mm; left: 151mm;"><span>&#10003;</span></div>
        <?php } elseif ($vaccine->vaccine_check->check6 == 0) { ?>
            <div class="absolute icon font-18" style="top: 137mm; left: 164.5mm;"><span>&#10003;</span></div>
        <?php }} ?>

        <!-- n7 -->
        <?php if (isset($vaccine->vaccine_check->check7)) { ?>
        <?php if ($vaccine->vaccine_check->check7 == 1) { ?>
            <div class="absolute icon font-18" style="top: 146.4mm; left: 151mm;"><span>&#10003;</span></div>
        <?php } elseif ($vaccine->vaccine_check->check7 == 0) { ?>
            <div class="absolute icon font-18" style="top: 146.4mm; left: 164.5mm;"><span>&#10003;</span></div>
        <?php }} ?>

        <!-- n8 -->
        <?php if (isset($vaccine->vaccine_check->check8)) { ?>
        <?php if ($vaccine->vaccine_check->check8 == 1) { ?>
            <div class="absolute icon font-18" style="top: 153mm; left: 151mm;"><span>&#10003;</span></div>
        <?php } elseif ($vaccine->vaccine_check->check8 == 0) { ?>
            <div class="absolute icon font-18" style="top: 153mm; left: 164.5mm;"><span>&#10003;</span></div>
        <?php }} ?>

        <!-- n9 -->
        <?php if (isset($vaccine->vaccine_check->check9)) { ?>
        <?php if ($vaccine->vaccine_check->check9 == 1) { ?>
            <div class="absolute icon font-18" style="top: 159mm; left: 151mm;"><span>&#10003;</span></div>
        <?php } elseif ($vaccine->vaccine_check->check9 == 0) { ?>
            <div class="absolute icon font-18" style="top: 159mm; left: 164.5mm;"><span>&#10003;</span></div>
        <?php }} ?>

        <?php if (isset($vaccine->signature_parent)) { ?>
        <div class="absolute signature" style="top: 198mm; left: 76.5mm; width: 58mm; height: 11mm">
            <img src="<?= base_url('storages/signatures/' . $vaccine->signature_parent) ?>">
        </div>
        <?php } ?>
        <div class="absolute text-center font-16" style="top: 211.5mm; left: 73mm; width: 65mm;"><?= isset($vaccine->parent_name) ? $vaccine->parent_name : '' ?>  <?= isset($vaccine->parent_name) ? $vaccine->parent_lname : '' ?></div>
        <?php if (isset($vaccine->updated_at)) { ?>
        <div class="absolute text-center font-16" style="top: 218.5mm; left: 88mm; width: 10mm;"><?= $this->tothai->toThaiDateTime($vaccine->updated_at, '%d', true) ?></div>
        <div class="absolute text-center font-16" style="top: 218.5mm; left: 100mm; width: 20mm;"><?= $this->tothai->toThaiDateTime($vaccine->updated_at, '%m', true) ?></div>
        <div class="absolute text-center font-16" style="top: 218.5mm; left: 123mm; width: 15mm;"><?= $this->tothai->toThaiDateTime($vaccine->updated_at, '%y', true) ?></div>
        <?php } ?>
    <?php
    }
    ?>
</body>

</html>