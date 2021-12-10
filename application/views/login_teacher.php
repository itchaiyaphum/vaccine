<html>
    <head>
        <title>Login Page</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="fontawesome/css/all.min.css"/>
        <script src="<?= base_url('assets/js/sweetalert2.all.min.js') ?>"></script>
        <style>
            body {   
                background: url(<?= base_url('assets/bg.jpg') ?>) no-repeat center;
                background-size: cover; 
                display: flex;
                align-items: center;
                justify-content: center;
                font-family: "Ubuntu",sans-serif;
            }
            .pic img{   
                width: 100px;
                height: 100px;
                border-radius:50%;
             }
             .name {
                color: #f2f2f2;
                font-size: 28px;
                font-weight: 600;
                margin:10px 0;
            }
            .dep{
                    font-size: 18px;
                    color: #ffffff;
            }
            .sm{
                display: flex;
                justify-content: center;
                margin: 20px;
            }
            .sm a{
                color: #f2f2f2;
                width:56px;
                font-size:22px;    
                transition: .3s linear;   
            }
            .sm a:hover {
                color: #e66767;
            }
            input[type=submit] {    
                    background-color: Transparent;         
                    cursor: pointer;                   
                    font-size:22px;    
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
    if (isset($login_error)) {
    ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Login Failed',
                html: "<?= $login_error ?>",
            })
        </script>
    <?php
    }
    ?>
         <!-- select users_student -->

  
       <div class="profile-card" style="width: 400px;width: 400px;
            text-align: center;
            border-radius: 8px; 
            overflow: hidden; margin-top:50px; ">
        <div class="card bg-info text-white" style=" padding: 60px 40px;">
               <div class="pic">
                    <img src="<?= base_url('assets/images/vaccine.jpg') ?>">
               </div>
            <div class="card-body">
            <div class="name"> IT CTC </div>
                <div class="dep">ตรวจสอบแบบฟอร์มแจ้งความประสงค์<br>ของผู้ปกครองในการฉีดวัคซีน</div>
                <div class="sm">
                    <a href="#" class="fab fa-facebook-f"></a>
                    <a href="#" class="fab fa-twitter"></a>
                    <a href="#" class="fab fa-github"></a>
                    <a href="#" class="fab fa-youtube"></a>
                </div>
                <form method="post">
                    <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">@</span>
                    </div>
                    <input type="email" class="form-control" placeholder="Email" value="<?= set_value('email') ?>"  name="email">
                    </div>   
                    
                    <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">@</span>
                    </div>
                    <input type="password" class="form-control" placeholder="Password" value="<?= set_value('pass') ?>"  name="pass">
                    </div>   
                    
                                    
                    <p style="color:#ffffff;font-size:14px;">** Email และ รหัสผ่าน ให้ใช้ข้อมูลในระบบครูที่ปรึกษา</p>
                    <input type="submit" value="Submit" name="btn_ok">
                    
                </form>    
                
                </div>
        </div>
                     
    </body>
</html>