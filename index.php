 <?php
session_start();
     include('include/temp/header.php');
    include('include/temp/navbar.php');
    include('conf.php');

    ?>

<?php
         
        $query=$con->prepare("SELECT User_View_Name FROM users where User_ID = ?");

 
        $viewName =  $query->fetch();
        
            
         
?>
<div class="container arabic-font">
    <h3 class="text-center"> الصفحة الرئيسية  </h3>
 
        <div class="row">
            <div class="col-md-4"> 
                    <a href="newreport.php">
                        <button class="btn btn-info" > بلاغ جديد</button>
                    </a>

            </div>
            <div class="col-md-4">
                <a href="myreport.php">
                    <button class="btn btn-info">بلاغاتي</button>
                 </a>   
              </div>
        </div>

<?php
    include('include/temp/footer.php');
?>