<nav class="navbar navbar-default">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand arabic-font" href="dashboard.php"><i class="fa logo fa-free-code-camp"></i> Report System</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
      <?php 
          include('conf.php');
          $query = $con->prepare("SELECT * FROM department WHERE deparment_ID = ?");
      
          $query->execute(array($depID));
          
          $data = $query->fetch(); 
      ?>
       <li class="username-view "><?php echo $data['deparment_Username'];?></li>

        <li class="date"><i class="fa fa-calendar-check-o" aria-hidden="true"></i>
 <?php echo date("y/m/d");?>  </li>
      </ul>
   
      <ul class="nav navbar-nav navbar-right">
 


        <li><a href="logout.php"><i class="fa fa-power-off" aria-hidden="true"></i>
</a></li>
     
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>