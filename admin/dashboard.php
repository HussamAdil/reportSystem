<?php 
session_start();
if(isset($_SESSION['userid']))
{
    include('include/temp/header.php');
    include('include/temp/navbar.php');
    ?>
 
 
        <!--Start Main text for the container -->

          <h3 class="text-center arabic-font ">لوحة التحكم </h3>  
        <!--End  Main text for the container -->

          
<div class="container">
      
        <div class="row">
             <!--Start Row For all container  -->
             
           <!--Start dashboard-tab  -->

             <!--Start dashboard-tab add deparment -->

           <a href="deparment.php?action=manage"> 
               <div class="col-md-6 col-xs-6 dashboard-tab col-sm-6">
                <div class="col-md-4 icon add-deparment">
              <p>  <i class="fa fa-bars fa-4x" aria-hidden="true"></i></p>
                
                </div>
                <div class="text-center arabic-font info">
                <h4 >85</h4>

                <h4>    الاقسام</h4>
                </div>
            </div> </a>
             <!--End dashboard-tab  add deparment-->
             <!--Start dashboard-tab report -->
            <a href="report.php">
            <div class="col-md-6 col-xs-6 dashboard-tab col-sm-6">
                <div class="col-md-4 icon report">
              <p>  <i class="fa fa-bullhorn fa-4x" aria-hidden="true"></i></p>
                
                </div>
                <div class="text-center arabic-font info">
                <h4 >150</h4>

                <h4>البلاغات</h4>
                </div>
            </div>
                </a>
             <!--End dashboard-tab report -->
 
    </div>
    </div>
 <?php 
    include('include/temp/footer.php');
}
else
{
    header("location:login.php");   
}

?>