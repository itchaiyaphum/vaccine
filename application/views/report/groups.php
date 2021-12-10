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
        <h2>สาขาวิชา <?= $info->major_name ?> </h2>
        <p>
			ทั้งหมด <?= $count->all ?> คน  ฉีดเข็มแรก <?= $count->c1 ?> คน ฉีดเข็มที่สอง <?= $count->c2 ?> คน ยังไม่ได้รับวัคซีน <?= $count->c0 ?> คน 
			<br>ยังไม่กรอกข้อมูล <?= $count->c ?> คน
        </p>
        <table class="table table-hover text-center">
            <thead>
                <tr class="table-dark text-dark">
					<th>กลุ่ม</th>
					<th>สาขางาน</th>
                    <th>ฉีดเข็มที่1</th>
                	<th>ฉีดเข็มที่2</th>
					<th>ยังไม่ได้รับวัคซีน</th>
                    <th>ยังไม่กรอกข้อมูล</th>
                    <th>รวม</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($groups as $group) { ?>
                    <tr>
                        <td>
                            <a href="<?= site_url('report/std') . '?i=' . $group->id ?>">
                                <?= $group->group_name ?>
                            </a>
                        </td>
                        <td><?= $group->minor_name ?></td>
                        <td><?= $group->count->c1.' ('.$group->count->c1.'%)' ?></td>
                        <td><?= $group->count->c2.' ('.$group->count->c2.'%)' ?></td>
                        <td><?= $group->count->c0.' ('.$group->count->c0.'%)' ?></td>
                        <td><?= $group->count->c.' ('.$group->count->c.'%)' ?></td>
                        <td><?= $group->count->all ?></td>
                    </tr>
                <?php } ?>
            </tbody>
            <tfoot style="color: darkred;">
                <td colspan="2">รวม</td>
                <td><?= $count->c1.' ('.$per->c1.'%)' ?></td>
                <td><?= $count->c2.' ('.$per->c2.'%)' ?></td>
                <td><?= $count->c0.' ('.$per->c0.'%)' ?></td>
                <td><?= $count->c.' ('.$per->c.'%)' ?></td>
                <td><?= $count->all ?></td>
            </tfoot>
        </table>
    </div>
</body>

</html>
