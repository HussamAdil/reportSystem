<?php
session_start();
include('include/temp/header.php');
include('conf.php');

?>
<body class="login-body">
<div class="container">
    <div class="row>">
    <div class="login col-md-5 col-md-push-3">
     <h3 class="text-center arabic-font ">جامعة أفريقيا العالمية </h3>  
     <h3 class="text-center arabic-font "><i class="fa fa-free-code-camp" aria-hidden="true"></i>
</i>

  نظام البلاغات <i class="fa fa-free-code-camp" aria-hidden="true"></i>
</h3>  

    <h3 class="text-center arabic-font">تسجيل الدخول </h3>
    <hr class="hr-login">
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>" class=" arabic-font"> 
        <input type="text" name="Username" class="form-control" placeholder="ادخل اسم المستخدم">
        <input type="password" name="Password"class="form-control" placeholder=" ادخل كلمة المرور    ">
        <input type="submit" value ="دخول"> 
    </form>
    </div>
</div>
</div>
 
</body>

<?php 
 if($_SERVER['REQUEST_METHOD']=="POST")
 {
     $Username = $_POST['Username'];
     $password = $_POST['Password'];
    

     #check the data in the database 
     $query = $con->prepare("SELECT * FROM Users WHERE User_Name = ? And User_Password = ? And User_Role=1 ");
     $query->execute(array($Username,$password));
     $rows = $query->fetch();
      $result = $query->rowCount();
     if($result >0)
     {
        // if the User In Our database 
         $_SESSION['userid'] = $rows['User_ID'];
         $_SESSION['user_view_name'] = $rows['User_View_Name'];
         header("location:dashboard.php");
         
         
     }
     else
     {
       $error = "<h4 class='col-md-5 col-md-push-3 text-center arabic-lable alert alert-danger'>اسم المستخدم او كلمة المرور غير صحيحة</h4 >";
       echo $error;
     }
  }


?>