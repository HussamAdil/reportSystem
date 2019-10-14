 <!--Start   container  -->
    <div class ="container adddeparment">
     <!--End   Row  -->
    <div class ="row">
    <h3 class="text-center arabic-font">اضافة قسم </h3>
       <!--End   Row  -->
    </div>
    <div class ="col-md-10 col-md-offset-2">
           <!--Start   Main form  -->

    <form  class="form-horizontal" method = "POST" action="<?PHP echo $_SERVER["PHP_SELF"]?>">
            <!--Start   form group  -->
        <div class="form-group">  
            <!--Start Label for input [deparment name ]  form group  -->

            <label class="control-label text-center col-sm-2 arabic-font"> اسم القسم</label>

             <!--End Label for input [deparment name ]  form group  -->
              <!--Start div for input [deparment name ]  form group  -->

            <div class="col-sm-10">

                <input  type="text" name="depname" class="form-control" >

             </div>
              <!--End div for input [deparment name ]  form group  -->

              
              
                <!--  
                    ####### Start anther Input ######
                -->
                          <!--Start Label for input [deparment name ]  form group  -->

             <label class="control-label text-center col-sm-2 arabic-font"> وصف القسم</label>

             <!--End Label for input [deparment name ]  form group  -->
                           <!--Start div for input [deparment name ]  form group  -->

            <div class="col-sm-10">

                <input  type="text" name="depdesc" class="form-control" >

             </div>
              <!--End div for input [deparment name ]  form group  -->

    

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
     if($_SERVER['REQUEST_METHOD']=="POST")
     {
         ## Start  Value OF The Input  ##
         $depName =  $_POST['depname'];
         $depdesc =  $_POST['depdesc'];
         ## End  Value OF The Input  ##

         ## Start  Include Database file   ##

          include('con.php');
        
          ## End  Include Database file   ##
          
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
                    {
                        $formerror [] = " وصف القسم لا يمكن ان يكون فارغ  ";
                    }
                    if(empty($depName))
                    {
                        $formerror [] = " اسم القسم لا يمكن ان يكون فارغ  ";  
                    }
                    if(strlen($depName) < 4)
                    {
                        $formerror [] = " اسم القسم لا يمكن ان يكون اقل من 4 احرف  "; 
                    }
                    if(strlen($depdesc) < 10)
                    {
                        $formerror [] = " وصف القسم لا يمكن ان يكون اقل من 10 احرف  "; 
                    }
              # Start if there's error in the form 
                  if(!empty($formerror))
                  {
                    
                        #if there is error loop  
                          foreach($formerror as $error)
                     {
                         echo "<div class='container'>";
                         echo "<p class='text-center arabic-font alert alert-danger'>".$error."</p>";
                         echo "</div>";    
                     }
                  }

          # End if there's error in the form         
            

                      #End  if is Empty 
                }
                else
                {
                    # Deparment it's in our database So you can't add it Sorry :( 
                    
                }


         ## END  Check Deparment Name from  Database before add it    ##


 