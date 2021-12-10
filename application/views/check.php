<html>
    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Vaccine</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <style>
        .card {
        margin: 0 auto; /* Added */
        margin-top:50px;
        float: none; /* Added */
        margin-bottom: 10px; /* Added */
        width:500px;
        }
		@media only screen and (max-width: 576px) {
			.card {
			width: auto;
			}
		}
    </style>
    </head>
<body>  
    <div class="container-md">
        <div class="card shadow p-3 mb-5 bg-white rounded ">
            <div class="card-header bg-info text-white">
            คุณได้รับการฉีดวัคซีนมาแล้วหรือไม่ ?
            </div>
            <div class="card-body">
                <form action="" method="post" name="form1">     
                     <div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input" id="customRadio1" name="vacine" value="1">
                        <label class="custom-control-label" for="customRadio1">ได้ฉีดวัคซีน</label>
                    </div> 
                    <div class="custom-control custom-radio">
                        <input type="radio" class="custom-control-input" id="customRadio2" name="vacine" value="2">
                        <label class="custom-control-label" for="customRadio2">ไม่ได้ฉีดวัคซีน</label>
                    </div>    
                      <br>
                    <input name="btnSubmit" type="submit" value="ตกลง" class="btn btn-secondary btn-block" onclick="return sendSuccess();">
                </form>
            </div>
        </div>    
    </div>

<script>
    function sendSuccess() {
        var vacines = document.getElementsByName("vacine");
                if (vacines[0].checked == true) {
                    var ch1 = confirm("คุณได้รับการฉีดวัคซีนแล้ว");
                    if (ch1 == true) {
                        window.open('<?= site_url('form') ?>','_self');
                    } 
                } else if (vacines[1].checked == true) {
                    var ch2 = confirm("คุณยังไม่ได้รับการฉีดวัคซีน");
                    if (ch2 == true) {
                        window.open('<?= site_url('form/not_vaccine') ?>','_self');
                        // alert("ไปเพิ่มสาเหตุการไม่รับวัคซีน");
                    }
                } else {
                alert("กรุณาเลือกรายการ ในการเข้ารับวัคซีน Covid 19");
                }
        return false;
    }
</script>

</body>
</html>
