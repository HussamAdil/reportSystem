 <?php
 session_start();
     include('include/temp/header.php');
    include('include/temp/navbar.php');
    include('conf.php');

    ?>


<div class="container arabic-font">
    <h3 class="text-center">بلاغ جديد</h3>
        <form action="process.php" method="POST">
            <div class="col-md-6 col-md-offset-3">
            <input required="required" type="text" name="reports_formPhone" placeholder="رقم الهاتف لمتابعة البلاغ  " class="form-control">

            <input required="required" type="text" name="reports_location" placeholder="موقع البلاغ" class="form-control"><br>

        <label>القسم</label>
        <select  name="reports_fromDeparment" class="form-control input-lg">
            <option>العلاقات الخارجية</option>
            <option>قسم الموارد البشرية</option>
            <option>تقانة المعلومات</option>
        </select><br>
          <label>البلاغ الى قسم </label>
           <?php
                $data = $con->prepare("SELECT * FROM department") ;
                $data->execute();
                $rows=$data->fetchAll();
                ?>
        <select name="reports_toDeparment" class="form-control input-lg">
            <?php 
                foreach($rows as $row )
                {
                echo  " <option value='$row[0]'>".$row[1]."</option>";  
                }
            ?>

         
 
        </select> <br>
                         <label>تفاصيل البلاغ</label>

        <textarea required="required" type="" name="reports_details" placeholder="وصف البلاغ"  class="form-control"> </textarea>
        <input type="submit" name="" value="ارسال البلاغ" class="btn btn-info">
        </form>
</div>

<?php
    include('include/temp/footer.php');
?>
