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
  
    <?php 
    $stem = $con->prepare("SELECT reports.* , department.* FROM reports  INNER JOIN department ON reports_toDeparment = ?");
     $stem->execute(array($depID));
    $result=$stem->fetchAll();

         foreach($result as $row)
          echo  "<tr>";
         {
          
             echo "<td>".$row['reports_id']."</td> ";
             echo "<td>".$row['reports_details']."</td> ";
             echo "<td>".$row['reports_location']."</td> ";
             
                 if($row['reports_status'] == 0)
              {
                  echo  '<td class="col-lg-2 arabic-font" style="">'.'<span style="border-right: 9px solid #cf8d15;
                  margin-left: 19px;
                  border-radius: 10px;"></span>جاري العمل عليه ...' .'</td>';

              }
             elseif($row['reports_status'] == 1)
              {
                 echo  '<td class="col-lg-2 arabic-font" >'.'<span style="border-right: 9px solid green;
                  margin-left: 19px;
                  border-radius: 10px;"></span> تم انجاز البلاغ' .'</td>';

              }
            
     }
echo  "<tr>";
    ?>
             </table>
    </div>
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