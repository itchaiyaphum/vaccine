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
        .signature img {
            height: 100%;
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
        <div class="absolute" style="top: 122mm; left: 60mm; width: 50mm;">นางประภา มะลิทอง</div>
        <div class="absolute" style="top: 122mm; left: 147mm; width: 30mm;">0878806466</div>
        <div class="absolute" style="top: 127.5mm; left: 50mm;  width: 60mm;">นายพันธกิจ มะลิทอง</div>
        <div class="absolute" style="top: 127.5mm; left: 140mm; width: 35mm;">มารดา</div>
        <div class="absolute" style="top: 133mm; left: 40mm; width: 65mm;">122</div>
        <div class="absolute" style="top: 133mm; left: 115mm; width: 20mm;">2</div>
        <div class="absolute" style="top: 133mm; left: 140mm; width: 35mm;">Test</div>
        <div class="absolute" style="top: 138.6mm; left: 46mm; width: 35mm;">รอบเมือง</div>
        <div class="absolute" style="top: 138.6mm; left: 92mm; width: 35mm;">เมือง</div>
        <div class="absolute" style="top: 138.6mm; left: 140mm; width: 35mm;">ชัยภูมิ</div>
        <div class="absolute" style="top: 144.5mm; left: 65mm; width: 50mm;">0984133202</div>

        <div class="absolute" style="top: 156mm; left: 60mm; width: 50mm;">นายพันธกิจ มะลิทอง</div>
        <div class="absolute" style="top: 156mm; left: 123mm; width: 8mm;">18</div>
        <div class="absolute" style="top: 156mm; left: 157mm; width: 20mm;">1/ก.ย./2546</div>
        <div class="absolute" style="top: 161.6mm; left: 115mm; width: 35mm;">1369900634875</div>
        <div class="absolute" style="top: 161.6mm; left: 158mm; width: 20mm;">ไทย</div>
        <div class="absolute" style="top: 167mm; left: 49mm; width: 50mm;">วิทยาลัยเทคนิคชัยภูมิ</div>
        <div class="absolute" style="top: 167mm; left: 115mm; width: 35mm;">ปวช.3</div>
        <div class="absolute" style="top: 167mm; left: 160mm; width: 20mm;">C1</div>

        <div class="absolute icon font-18" style="top: 187.5mm; left: 49.6mm;"><span>&#10003;</span></div>
        <div class="absolute icon font-18" style="top: 193.5mm; left: 49mm;"><span>&#10003;</span></div>
        <div class="absolute" style="top: 196mm; left: 120mm; width: 60mm;">สาเหตุ</div>

        <div class="absolute signature" style="top: 207mm; left: 80mm; width: 50mm; height: 10mm">
            <img src="<?= base_url('assets/images/e.jpg') ?>">
        </div>
        <div class="absolute text-center" style="top: 218.5mm; left: 77mm;  width: 56mm;">นางประภา มะลิทอง</div>
        <div class="absolute text-center" style="top: 224mm; left: 81mm; width: 10mm;">30</div>
        <div class="absolute text-center" style="top: 224mm; left: 92mm; width: 18mm;">ก.ย.</div>
        <div class="absolute text-center" style="top: 224mm; left: 110mm; width: 15mm;">2564</div>

    <?php
    } elseif ($page == 3) {
    ?>
        <!-- n1 -->
        <div class="absolute icon font-18" style="top: 72mm; left: 151mm;"><span>&#10003;</span></div>
        <div class="absolute icon font-18" style="top: 72mm; left: 164.5mm;"><span>&#10003;</span></div>
        <!-- n2 -->
        <div class="absolute icon font-18" style="top: 84.5mm; left: 151mm;"><span>&#10003;</span></div>
        <div class="absolute icon font-18" style="top: 84.5mm; left: 164.5mm;"><span>&#10003;</span></div>
        <!-- n3 -->
        <div class="absolute icon font-18" style="top: 97mm; left: 151mm;"><span>&#10003;</span></div>
        <div class="absolute icon font-18" style="top: 97mm; left: 164.5mm;"><span>&#10003;</span></div>
        <!-- n4 -->
        <div class="absolute icon font-18" style="top: 112mm; left: 151mm;"><span>&#10003;</span></div>
        <div class="absolute icon font-18" style="top: 112mm; left: 164.5mm;"><span>&#10003;</span></div>
        <!-- n5 -->
        <div class="absolute icon font-18" style="top: 127.7mm; left: 151mm;"><span>&#10003;</span></div>
        <div class="absolute icon font-18" style="top: 127.7mm; left: 164.5mm;"><span>&#10003;</span></div>
        <!-- n6 -->
        <div class="absolute icon font-18" style="top: 137mm; left: 151mm;"><span>&#10003;</span></div>
        <div class="absolute icon font-18" style="top: 137mm; left: 164.5mm;"><span>&#10003;</span></div>
        <!-- n7 -->
        <div class="absolute icon font-18" style="top: 146.4mm; left: 151mm;"><span>&#10003;</span></div>
        <div class="absolute icon font-18" style="top: 146.4mm; left: 164.5mm;"><span>&#10003;</span></div>
        <!-- n8 -->
        <div class="absolute icon font-18" style="top: 153mm; left: 151mm;"><span>&#10003;</span></div>
        <div class="absolute icon font-18" style="top: 153mm; left: 164.5mm;"><span>&#10003;</span></div>
        <!-- n9 -->
        <div class="absolute icon font-18" style="top: 159mm; left: 151mm;"><span>&#10003;</span></div>
        <div class="absolute icon font-18" style="top: 159mm; left: 164.5mm;"><span>&#10003;</span></div>
        
        <div class="absolute signature" style="top: 198mm; left: 76.5mm; width: 58mm; height: 11mm">
            <img src="<?= base_url('assets/images/e.jpg') ?>">
        </div>
        <div class="absolute text-center font-16" style="top: 211.5mm; left: 73mm; width: 65mm;">นางประภา มะลิทอง</div>
        <div class="absolute text-center font-16" style="top: 218.5mm; left: 88mm; width: 10mm;">30</div>
        <div class="absolute text-center font-16" style="top: 218.5mm; left: 100mm; width: 20mm;">ก.ย.</div>
        <div class="absolute text-center font-16" style="top: 218.5mm; left: 123mm; width: 15mm;">2564</div>
    <?php
    }
    ?>
</body>

</html>