 <?php
      session_start();
     include('include/temp/header.php');
    include('include/temp/navbar.php');
    include('conf.php');

    ?>

<br><br>
<div class="container arabic-font">
    <div class="alert alert-success h4 text-center">شكرا لبلاغك سوف  يتم حل المشكلة فى اقرب وقت </div>


<?php


      $reports_formPhone = $_POST['reports_formPhone'];
      $reports_location = $_POST['reports_location'];
      $reports_fromDeparment = $_POST['reports_fromDeparment'];
      $reports_toDeparment = $_POST['reports_toDeparment'];
      $reports_details = $_POST['reports_details'];
      $userID = $_SESSION['userid'];
      include'conf.php';

$query = $con->prepare("INSERT INTO reports

	(reports_formPhone,
	reports_location,
	reports_fromDeparment,
	reports_toDeparment,
	reports_details,
	reports_date,
  userID 
	) 

	VALUES (?,?,?,?,?,NOW(),?) ");
$query->execute(array($reports_formPhone,$reports_location,$reports_fromDeparment,$reports_toDeparment,$reports_details,$userID));
  header('Refresh:3;url=index.php');
  

  ?>
