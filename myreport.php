
<?php 
session_start();
if(isset($_SESSION['userid']))
{
    include('include/temp/header.php');
    include('include/temp/navbar.php');
        include('conf.php');

    ?>
 
 <?php
 $userid = $_SESSION['userid'];
 $depquery;
 $query=$con->prepare("SELECT * FROM reports where userID = ? ");
 $query->execute(array($userid));
 $result= $query->fetchAll();
 
 ?>

<!--Start Main text for the container -->
          <h3 class="text-center arabic-font "> تقرير عن بلاغاتي </h3>  
        <!--End  Main text for the container -->
  <table class="table table-bordered  text-center">
    <thead>
      <tr>
          <th class="text-center">رقم البلاغ </th>
        <th class="text-center">تاريخ </th>
        <th class="text-center">تفاصيل البلاغ </th>
        <th class="text-center">مكان البلاغ</th>
        <th class="text-center">حال البلاغ</th>

      </tr>
    </thead>
    <tbody>
      

         <?php 
         foreach($result as $row)
         {
          echo "<tr>";
             echo "<td>".$row[0]."</td> ";
             echo "<td>".$row[8]."</td> ";
             echo "<td>".$row[6]."</td> ";
             echo "<td>".$row[3]."</td> ";
              if($row[7] == 0)
              {
                  echo  '<td class="col-lg-2 arabic-font" style="">'.'<span style="border-right: 9px solid #cf8d15;
                  margin-left: 19px;
                  border-radius: 10px;"></span>جاري العمل عليه ...' .'</td>';

              }
              else
              {
                 echo  '<td class="col-lg-2 arabic-font" >'.'<span style="border-right: 9px solid green;
                  margin-left: 19px;
                  border-radius: 10px;"></span> تم انجاز البلاغ' .'</td>';

              }
         }
             ?>

          
       
  
      </tr>
       
    </tbody>
  </table>



  <?php 
    include('include/temp/footer.php');
}
else
{
    header("location:login.php");   
}

?>