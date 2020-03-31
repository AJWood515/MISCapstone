<!DOCTYPE HTML>
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
  <script>
    function myFunction() {
      var checkBox = document.getElementById("myCheck");
      var text = document.getElementById("text");
      if (checkBox.checked == true) {
        text.style.display = "block";
      } else {
        text.style.display = "none";
      }
    }
  </script>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">


      <a class="navbar-brand" href="/">Non Organization</a>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">

          <li class="nav-item">
            <a class="nav-link" href="">Home </a>
          </li>

        </ul>
      </div>
    </div>
  </nav>
  <?php
  // define variables and set to empty values
  $nameErr = $emailErr = $genderErr = $websiteErr = "";
  $name = $email = $gender = $comment = $website = "";
  $introduction = $what = $who = $need = $date = "";
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
      $nameErr = "Name is required";
    } else {
      $name = test_input($_POST["name"]);
      // check if name only contains letters and whitespace
      if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
        $nameErr = "Only letters and white space allowed";
      }
    }

    if (empty($_POST["email"])) {
      $emailErr = "Email is required";
    } else {
      $email = test_input($_POST["email"]);
      // check if e-mail address is well-formed
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
      }
    }

    if (empty($_POST["website"])) {
      $website = "";
    } else {
      $website = test_input($_POST["website"]);
      // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
      if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $website)) {
        $websiteErr = "Invalid URL";
      }
    }

    if (empty($_POST["comment"])) {
      $comment = "";
    } else {
      $comment = test_input($_POST["comment"]);
    }

    if (empty($_POST["gender"])) {
      $genderErr = "Gender is required";
    } else {
      $gender = test_input($_POST["gender"]);
    }
  }

  function test_input($data)
  {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  ?>
  <main class="container">
    <header class="jumbotron my-4">
      <h2>PHP Form Validation Example</h2>
      <p><span class="error">* required field</span></p>
    </header>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      <div class="form-group">
        <label for="introduction">Introduction:</label>
        <textarea class="form-control" name="introduction" rows="5"><?php echo $introduction; ?></textarea>
      </div>
      <div class="form-group">
        <label for="what">What We Do:</label>
        <textarea class="form-control" name="what" rows="5"><?php echo $what; ?></textarea>
      </div>
      <div class="form-group">
        <label for="who">Who We Help:</label>
        <textarea class="form-control" name="who" rows="5" cols="40"><?php echo $who; ?></textarea>
      </div>
      <div class="form-group">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" name="myCheck" id="myCheck" onclick="myFunction()">
          <label class="form-check-label" for="myCheck">
            Check box to add your need
          </label>
        </div>
      </div>
      <div id="text" style="display:none">

        <div class="form-group">
          <label for="name"> Nonprofit Name:</label>
          <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
          <span class="error">* <?php echo $nameErr; ?></span>
        </div>
        <div class="form-group">
          <label for="what">Need:</label>
          <textarea name="what" class="form-control" rows="5"><?php echo $need; ?></textarea>
        </div>
        <div class="form-group">
          <label for="name">When help is needed:</label>
          <input type="text" name="name" class="form-control" value="<?php echo $date; ?>">
          <span class="error">* <?php echo $nameErr; ?></span>
        </div>
      </div>
      <div class="form-group">
        <label for="email">E-mail:</label>
        <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
        <span class="error">* <?php echo $emailErr; ?></span>
      </div>
      <div class="form-group">
        <label for="website">Website:</label>
        <input type="text" name="website" class="form-control" value="<?php echo $website; ?>">
        <span class="error"><?php echo $websiteErr; ?></span>
      </div>
      <button type="submit" class="btn btn-primary">Sign in</button>
    </form>
    <?php
    echo "<h2>Your Input:</h2>";
    echo $name;
    echo "<br>";
    echo $email;
    echo "<br>";
    echo $website;
    echo "<br>";
    echo $comment;
    echo "<br>";
    echo $gender;
    ?>
  </main>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>