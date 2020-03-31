<<!DOCTYPE HTML>
<html>

<head>
  <style>
    .error {
      color: #FF0000;
    }
  </style>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <title>Welcome to our company</title>
  <!-- <script src="https://code.jquery.com/jquery-1.11.3.js"></script> -->
  <?php
  include "PHP_Database_Connections.php";
  $query = "SELECT * FROM nonprofits.nonprofitdata";


  $stmt = $conn -> prepare("SELECT * FROM nonprofitdata order by Identity");
  $stmt -> bindParam('event_id', $event_id);
  $stmt -> execute();

  while($result = $stmt-> fetch(PDO::FETCH_ASSOC))
 {
      $Identity = $stmt['Identity'];
      $name = $stmt['ContactName'];
      $organization = ['Organization'];
      $email = $stmt['Email'];
      $PhoneNumber = $stmt['PhoneNumber'];
      $ProjectDesc = $stmt['ProjectDesc'];
      $website = $stmt['Website'];
      $PMEmailAssigned = $stmt['PMEmailAssigned'];
      $DateUploaded = $stmt['DateUploaded'];
      $Notes = $stmt['Notes'];
  }
    $stmt->close();

  ?>
</head>

<body>
