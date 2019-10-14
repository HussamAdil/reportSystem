<?php 
session_start();
if(isset($_SESSION['department_id']))
{
    $depID =$_SESSION['department_id'] ; 
    include('include/temp/header.php');
    include('include/temp/navbar.php');
    include('conf.php');
    $query = $con->prepare("SELECT * FROM department WHERE deparment_ID = ?");

    $query->execute(array($depID));
    
    $data = $query->fetch(); 
    ?>
 
 
        <!--Start Main text for the container -->
          <h3 class="text-center arabic-font "> قسم  <?php echo $data['deparment_Name']?></h3>  
        <!--End  Main text for the container -->
<div class="container">
      
        <div class="row">
             <!--Start Row For all container  -->

           <table class="table table-bordered">
               <tr>
                   <td>رقم البلاغ </td>
                   <td> تفاصيل البلاغ   </td>
                   <td> موقع البلاغ </td>
                   <td> حال البلاغ </td>
               </tr>
           </table>
    </div>
    </div>
    </div>
<?php 
    include('include/temp/footer.php');
}
else
{
    header("location:index.php");   
}

?>