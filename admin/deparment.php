<?php 
session_start();
if(isset($_SESSION['userid']))
{
    include('include/temp/header.php');
    include('include/temp/navbar.php');
            ## Start  Include Database file   ##

            include('conf.php');
            
              ## End  Include Database file   ##
    ?> 
    <?php
     if(isset($_GET['action']) && $_GET['action'] =="manage")
    { ?>
            <div class="container">
                <h3 class="text-center arabic-font">الاقسام</h3>
                <!--Start the deprment  -->
                <div class="row text-center">

                <!--Start the view all deprment   -->
            <a href="deparment.php?action=viewAll">  
                <div class="col-xs-6 deparment-sub"> 
                        <div>
                            <p class="arabic-font"> الاقسام</p>
                        </div>
                    </div>
                </a>
            <!--End the view all deprment   -->

                <!--Start the add deprment   -->
                <a href="deparment.php?action=add"> 
                <div class="col-xs-6 deparment-sub"> 
                    <div>
                        <p class="arabic-font"> اضافة قسم </p>
                    </div>
                </div> 
                </a>
            <!--End the add deprment   -->
        
                
        <!--end the main Row for all the page -->
                </div>
            <!--end the main container for all the page -->
            </div>
        
            <?php 
            # End if the [action== manage] 

    } 
  # start if the [action== add]
    else if (isset($_GET['action']) && $_GET['action'] == "add")
    {  ?>
 <!--Start   container  -->
 <div class ="container adddeparment">
     <!--End   Row  -->
    <div class ="row">
    <h3 class="text-center arabic-font">اضافة قسم </h3>
       <!--End   Row  -->
    </div>
    <div class ="col-sm-8 col-md-offset-2">
           <!--Start   Main form  -->

    <form  class="form-horizontal" method = "POST" action="deparment.php?action=insert">
            <!--Start   form group  -->
        <div class="form-group">  
            <!--Start Label for input [deparment name ]  form group  -->

            <label class="control-label text-center   arabic-font"> اسم القسم</label>

             <!--End Label for input [deparment name ]  form group  -->
              <!--Start div for input [deparment name ]  form group  -->

            <div >

                <input  type="text" name="depname" class="form-control" >

             </div>
              <!--End div for input [deparment name ]  form group  -->
              
                <!--  
                    ####### Start anther Input ######
                -->
                          <!--Start Label for input [deparment name ]  form group  -->

             <label class="control-label text-center  arabic-font"> وصف القسم</label>

             <!--End Label for input [deparment desc ]  form group  -->
                           <!--Start div for input [deparment name ]  form group  -->

            <div >

                <input  type="text" name="depdesc" class="form-control" >

             </div>
              <!--End div for input [deparment desc ]  form group  -->
         
            <!--Start Label for input [deparment username ]  form group  -->

             <label class="control-label text-center  arabic-font"> اسم المستخدم </label>

             <!--End Label for input [deparment username ]  form group  -->
                           <!--Start div for input [deparment name ]  form group  -->

            <div >

                <input  type="text" name="depusername" class="form-control" >

             </div>
              <!--End div for input [deparment desusername ]  form group  -->
              <!--Start Label for input [deparment password ]  form group  -->

             <label class="control-label text-center  arabic-font">كلمة المرور </label>

             <!--End Label for input [deparment username ]  form group  -->
                           <!--Start div for input [deparment name ]  form group  -->

            <div >

                <input  type="text" name="deppassword" class="form-control" >

             </div>
              <!--End div for input [deparment password ]  form group  -->
               <!--  
                    ####### Start anther Input ######
                -->            
           <!--End   form group  -->    
        </div>
        <input type="submit" class="arabic-font col-sm-2 col-sm-offset-4 btn btn-primary" value="اضافة">
     </form>
               <!--End   Main form  -->
    </div>
   <!--End   container  -->
    </div >    
   <?php 
    }
 # End if the [action== add]
  # Start if the [action== insert]

  else if(isset($_GET['action']) && $_GET['action'] == "insert")
 {
    if($_SERVER['REQUEST_METHOD']=="POST")
    {
        ## Start  Value OF The Input  ##
        $depName =  $_POST['depname'];
        $depdesc =  $_POST['depdesc'];
        $depusername = $_POST['depusername'];
        $deppassword = $_POST['deppassword'];
            
        
        ## End  Value OF The Input  ##

         ## Start  Check Deparment Name from  Database before add it    ##

         $query  = $con->prepare("SELECT deparment_Name FROM department WHERE deparment_Name = ?");
         $query->execute(array($depName));
         $result = $query->rowCount();
          
         # if the the $result = 1 that means the deparment is in our database else you can add it 
               if($result <=0)
               {
                   # Deparment it's Not in our database So you can add it :)
                       #Start if is Empty 
                       $formerror = array ();

                   if(empty($depdesc))
                   { $formerror [] = " وصف القسم لا يمكن ان يكون فارغ  "; }
                   if(empty($depName))
                   {$formerror [] = " اسم القسم لا يمكن ان يكون فارغ  ";   }
                   if(strlen($depName) < 4)
                   { $formerror [] = " اسم القسم لا يمكن ان يكون اقل من 4 احرف  ";  }
                   if(strlen($depdesc) < 10)
                   {  $formerror [] = " وصف القسم لا يمكن ان يكون اقل من 10 احرف  ";}
                   if(empty($depusername))
                   { $formerror [] = " اسم مستخدم القسم لا يمكن ان يكون فارغ ";}
                   if(empty($deppassword))
                   { $formerror [] = " كلمة مرور مستخدم القسم لا يمكن ان تكون فارغة ";}
                   if(strlen($depusername) < 4)
                   { $formerror [] = " اسم مستخدم القسم لا يمكن ان يكون اقل من 4 احرف  ";  }
                   if(strlen($deppassword) < 4)
                   { $formerror [] = " كلمة مرور مستخدم  القسم لا يمكن ان تكون اقل من 4 احرف";  }
 
             # Start if there's error in the form 
                 if(!empty($formerror))
                 {    
                       #if there is error loop  
                         foreach($formerror as $error)
                    {
                        echo "<div class='container'>";
                        echo "<p class='text-center arabic-font alert alert-danger'>".$error."</p>";
                        echo "</div>";  
                        header("Refresh:2;url=deparment.php?action=add");            
                    }
                 }
                 else
                 {
                     $query=$con->prepare("INSERT INTO department  (deparment_Name,deparment_description,deparment_adddate,deparment_Username,deparment_Password) VALUES (?,?,NOW(),?,?)");
                     $query->execute(array($depName,$depdesc,$depusername,$deppassword));
                     
                   if($query->rowCount() == 1 )
                   {
                       echo "<div class='container'>";
                       echo "<p class='text-center arabic-font alert alert-success'>تم اضافة القسم بنجاح</p>";
                       echo '</div>';
                       header("location:");
                    }
                 }
         # End if there's error in the form         
                     #End  if is Empty 
               }
               else
               {
                   # Deparment it's in our database So you can't add it Sorry :( 
                    echo "<div class='container'>";
                    echo "<p class='text-center arabic-font alert alert-danger'> القسم موجود</p>";
                    echo "</div>"; 
                   header("Refresh:2;url=deparment.php?action=add");
               }
        ## END  Check Deparment Name from  Database before add it    ##
            }
            else
            {
                #if The come direct to this page 
                header("location:deparment.php?action=manage");
            } 
    }
   # End if the [action== add]
   # Start if the [action== viewAll]
   else if(isset($_GET['action']) && $_GET['action'] == "viewAll")
   {
       $allData = $con->prepare("SELECT * FROM department");
       $allData->execute();
      $result = $allData->fetchAll();

       echo "<div class='container'>";
           echo "<h3 class='text-center arabic-font'>كل الاقسام</h3>";
           echo "<table class='text-center table table-responsive table-bordered arabic-font table-hover'>";
                echo '<tr>';
                   echo '<td>ID</td>';  
                    echo '<td>اسم القسم </td>'; 
                    echo '<td>اسم مستخدم القسم </td>';   
                     echo '<td>وصف القسم </td>';                 
                    echo '<td>تاريخ اضافة القسم </td>';   
                    echo '<td>   التحكم </td>';                    
                echo'</tr>';

                foreach($result As $resultdata)
                {
                    echo '<tr>';
                       
                    echo '<td>'.$resultdata['deparment_ID'].'</td>';  
                    echo '<td>'.$resultdata['deparment_Name'].'</td>';  
                    echo '<td>'.$resultdata['deparment_Username'].'</td>';                      
                    echo '<td>'.$resultdata['deparment_description'].'</td>';                  
                    echo '<td>'.$resultdata['deparment_adddate'].'</td>';  
                    echo '<td class="control-icon"><a href="deparment.php?action=edit&depID='.$resultdata['deparment_ID'].'"><i class="fa fa-edit"></i></a> ';
                    echo '<a href="deparment.php?action=drop&depid='.$resultdata['deparment_ID'].'"><i class="fa fa-times"></a>';
                    echo '</td>';   
                    echo'</tr>';
                }
           
           echo "</table>"; 
           echo "<a class='btn btn-info' href='deparment.php?action=add'>اضافة قسم</a>";
       echo "</div>";
   }
      # End   if the [action== viewAll]

         # Start if the [action== edit]
         else if(isset($_GET['action']) && $_GET['action'] == 'edit' )
    {
        if(isset($_GET['depID']) && is_numeric ($_GET['depID']))
        {   
            $depID= $_GET['depID'];
            #GET DATA FROM MY DATABASE ABOUT DEPARMENT BY ID IT WILL GAVE ME ONLY ONE ID 

            $query =$con->prepare("SELECT * FROM department WHERE  deparment_ID = ?");
            $query->execute(array($depID));
            $depinfo = $query->fetch();
                if($query->rowCount() == 1)
                { 
            ?>
           <div class="container">
            <div class="col-sm-6 col-sm-offset-3">
                <h3 class="arabic-font text-center">تعديل القسم</h3>
    <form  class="form-horizontal" method = "POST" action="deparment.php?action=update">
            <!--Start   form group  -->
        <div class="form-group">  
            <!--Start Label for input [deparment name ]  form group  -->

            <label class="control-label text-center  arabic-font"> اسم القسم</label>

             <!--End Label for input [deparment name ]  form group  -->
              <!--Start div for input [deparment name ]  form group  -->

            <div >

                <input  type="text" name="depname" value="<?php echo $depinfo['deparment_Name']?>" class="form-control" >

             </div>
              <!--End div for input [deparment name ]  form group  -->
              
                <!--  
                    ####### Start anther Input ######
                -->
                          <!--Start Label for input [deparment name ]  form group  -->

             <label class="control-label text-center  arabic-font"> وصف القسم</label>

             <!--End Label for input [deparment name ]  form group  -->
                           <!--Start div for input [deparment name ]  form group  -->

            <div >
            <input  type="hidden" name="depId"   value="<?php echo $depinfo['deparment_ID']?>"  class="form-control" >

                <input  type="text" name="depdesc" value="<?php echo $depinfo['deparment_description']?>" class="form-control" >

             </div>
              <!--End div for input [deparment name ]  form group  -->
                          <!--Start Label for input [deparment username ]  form group  -->

             <label class="control-label text-center  arabic-font"> اسم المستخدم </label>

             <!--End Label for input [deparment username ]  form group  -->
             <!--Start div for input [deparment name ]  form group  -->

            <div >

                <input  type="text" name="depusername" class="form-control" value="<?php echo $depinfo['deparment_Username']?>" >

             </div>
              <!--End div for input [deparment desusername ]  form group  -->
              <!--Start Label for input [deparment password ]  form group  -->

             <label class="control-label text-center  arabic-font">كلمة المرور </label>

             <!--End Label for input [deparment username ]  form group  -->
                           <!--Start div for input [deparment name ]  form group  -->

            <div >

                <input  type="text" name="deppassword" value="<?php echo $depinfo['deparment_Password']?>" class="form-control" >

             </div>
              <!--End div for input [deparment password ]  form group  -->
               <!--  
                    ####### Start anther Input ######
                -->            
            <!--End   form group  -->
            
             </div>
            <input type="submit" class="arabic-font col-sm-2 col-sm-offset-4 btn btn-success" value="حفظ">

         </form>
               <!--End   Main form  -->
            </div>
           </div>
       <?php 
                }
                else 
                {
                     #if edit ID Not IN OUR DATABASE 
                    echo "<div class='container'>";
                    echo '<p class=" alert alert-danger text-center arabic-font"> خطا فى الطلب </p>';
                    echo '</div>';
           }
        }
        else 
        {
             #if edit ID Not NUMBER
            echo "<div class='container'>";
            echo '<p class=" alert alert-danger text-center arabic-font"> خطا فى الطلب </p>';
            echo '</div>';
        }         
    } 
    #End edit Page 

    #Start action = update

    else if(isset($_GET['action']) && $_GET['action'] == "update")
    {
        if($_SERVER['REQUEST_METHOD'] == "POST")
        { 
            $depId = $_POST['depId'];       
            $depName =  $_POST['depname'];   
            $depdesc = $_POST['depdesc'];
            $depusername = $_POST['depusername'];
            $deppassword = $_POST['deppassword'];
            $formerror = array();
            if(empty($depdesc))
            #Aarray all Error In One echo 
            { $formerror [] = " وصف القسم لا يمكن ان يكون فارغ  ";}
            if(empty($depName))
            { $formerror [] = " اسم القسم لا يمكن ان يكون فارغ  ";}
            if(strlen($depName) < 4)
            { $formerror [] = " اسم القسم لا يمكن ان يكون اقل من 4 احرف  ";}
            if(strlen($depdesc) < 10)
            {$formerror [] = " وصف القسم لا يمكن ان يكون اقل من 10 احرف  ";}
            if(empty($depusername))
            { $formerror [] = " اسم مستخدم القسم لا يمكن ان يكون فارغ ";}
            if(empty($deppassword))
            { $formerror [] = " كلمة مرور مستخدم القسم لا يمكن ان تكون فارغة ";}
            if(strlen($depusername) < 4)
            { $formerror [] = " اسم مستخدم القسم لا يمكن ان يكون اقل من 4 احرف  ";  }
            if(strlen($deppassword) < 4)
            { $formerror [] = " كلمة مرور مستخدم  القسم لا يمكن ان تكون اقل من 4 احرف";  }
            
            if(!empty($formerror))
            {
                foreach($formerror as $error)
                { #Echo all errors 
                    echo "<div class='container'>";
                    echo "<p class='text-center arabic-font alert alert-danger'>".$error."</p>";
                    echo "</div>";  
                    header("Refresh:2;url=deparment.php?action=edit&depID=$depId");   
                }
            }
            if(empty($formerror))
            {
                    #if the $formerror  is empty 
                    $query = $con->prepare("UPDATE department SET deparment_Name = ? , deparment_description =? , deparment_Username = ?, deparment_Password=? WHERE deparment_ID =?");

                    $query ->execute(array($depName,$depdesc,$depusername,$deppassword,$depId));
                    $result = $query->rowCount();
                    echo $result;
                    if($result == 1 )
                    { 
                    echo "<div class='container'>";
                    echo '<p class=" alert alert-success text-center arabic-font"> تم تحديث البيانات</p>';
                    echo '</div>';
                    header("refresh:2 ;url=http://localhost/reportSystem/admin/deparment.php?action=viewAll");
                }
                else 
                {
                    echo "<div class='container'>";
                    echo '<p class=" alert alert-success text-center arabic-font"> لا يوجد  اي تحديث البيانات</p>';
                    echo '</div>';
                    header("refresh:2 ;url=http://localhost/reportSystem/admin/deparment.php?action=viewAll");
                }
            }
        }
    }
     # End action = update

        #Start action = drop
        else if(isset($_GET['action']) && $_GET['action'] == "drop")
        {
            if(isset($_GET['depid']) && is_numeric($_GET['depid']))
            {
               $depid = $_GET['depid'];
                $getdata=$con->prepare("SELECT * FROM department WHERE deparment_ID = ? ");
                $getdata->execute(array($depid));
                if($getdata->rowCount() > 0)
                { 
                
                $query = $con->prepare('DELETE  from department WHERE deparment_ID=?');
                $query->execute(array($depid));
                header("refresh:2 ;url=http://localhost/reportSystem/admin/deparment.php?action=viewAll");
                
                }
                else
                {
                    echo "<div class='container'>";
                    echo '<p class=" alert alert-danger text-center arabic-font"> خطا فى الطلب </p>';
                    echo '</div>';
                    header("refresh:2 ;url=http://localhost/reportSystem/admin/deparment.php?action=viewAll");
                    
                }
            } 
        }
          #End action = drop

  # Start if edit Not set 
    else 
    {
            #if edit Not set 
            echo "<div class='container'>";
            echo '<p class=" alert alert-danger text-center arabic-font"> خطا فى الطلب </p>';
            echo '</div>';
    } 
     #if edit Not set 
?>


  <?php 
     
    include('include/temp/footer.php');
}
else
{
    header("location:login.php");   
}

?>