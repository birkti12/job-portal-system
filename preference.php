
<?php

//To Handle Session Variables on This Page
session_start();

//If user Not logged in then redirect them back to homepage. 
if(empty($_SESSION['id_user'])) {
  header("Location: ../index.php");
  exit();
}

require_once("./db.php");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Job Portal</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../css/AdminLTE.min.css">
  <link rel="stylesheet" href="../css/_all-skins.min.css">
  <!-- Custom -->
  <link rel="stylesheet" href="../css/custom.css">
  <link rel="stylesheet" href="../css/style3.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        
</head>
<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">

  <header class="main-header">

    <!-- Logo -->
    <a href="index.php" class="logo logo-bg">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>J</b>P</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Job</b> Portal</span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li>
            <a href="../jobs.php">Jobs</a>
          </li>          
        </ul>
      </div>
  </nav>
  </header>
<body>
  <!-- Content Wrapper. Contains page content -->
   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper" style="margin-left: 0px;">


<section id="candidates" class="content-header">
  <div class="container">
    <div class="row">
      <div class="col-md-3">
        <div class="box box-solid">
          <div class="box-header with-border">
            <h3 class="box-title">Welcome <b><?php echo $_SESSION['name']; ?></b></h3>
          </div>
          <div class="box-body no-padding">
            <ul class="nav nav-pills nav-stacked">
              <li class="active"><a href="edit-profile.php"><i class="fa fa-user"></i> Edit Profile</a></li>
              <li><a href="index.php"><i class="fa fa-address-card-o"></i> My Applications</a></li>
              <li><a href="../jobs.php"><i class="fa fa-list-ul"></i> Jobs</a></li>
              <li><a href="mailbox.php"><i class="fa fa-envelope"></i> Mailbox</a></li>
              <li><a href="cv.php"><i class="fas fa-envelope fa-lg"></i> Build your cv</a></li>
                  <li><a href="Reference.php"><i class="fa fa-sign-out"></i> Reference</a></li>
              <li><a href="settings.php"><i class="fa fa-gear"></i> Settings</a></li>
              <li><a href="../logout.php"><i class="fa fa-arrow-circle-o-right"></i> Logout</a></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-md-9 bg-white padding-2">
      <form method="post" id="registerPreference" action="addpreference.php" enctype="multipart/form-data">
      <div class="form-group">
                <input class="form-control input-lg" type="text" id="email" name="email" placeholder="email" required>
              </div>
      <div class="form-group">
                <select class="form-control input-lg" type="text" id="qualification" name="qualification"  required>
                <option>PhD</option>
                <option>BSc</option>
                <option>MSc</option>
                <option>Deploma</option>
  </select>
              </div>
              <div class="form-group">
            <label for="companyname">Company:</label>
        
                <select class="form-control  input-lg" id="company" name="company" required>
                <option selected="" value="">company</option>
            <?php
                  $sql="SELECT * FROM company";
                  $result=$conn->query($sql);

                  if($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                      echo "<option value='".$row['name']."' data-id='".$row['id']."'>".$row['name']."</option>";
                    }
                  }
                ?>
                </form>
            
</select>
</div>  
<div class="form-group">
                <select class="form-control  input-lg" id="country" name="country" required>
                <option selected="" value="">Select Country</option>
                <?php
                  $sql="SELECT * FROM countries";
                  $result=$conn->query($sql);

if($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                      echo "<option value='".$row['name']."' data-id='".$row['id']."'>".$row['name']."</option>";
                    }
                  }
                ?>
                  
                </select>
              </div>  
<div id="stateDiv" class="form-group" style="display: none;">
                <select class="form-control  input-lg" id="state" name="state" required>
                  <option value="" selected="">Select State</option>
                </select>
              </div>   
              <div id="cityDiv" class="form-group" style="display: none;">
                <select class="form-control  input-lg" id="city" name="city" required>
                  <option selected="">Select City</option>
                </select>
              </div>
              <div class="form-group">
                <input class="form-control input-lg" type="text" id="job_title" name="job_title" placeholder="job_title" required>
              </div>
              <div class="form-group">
                <input class="form-control input-lg" rows="4" type="text" id="job_description" name="job_description" placeholder="Job Description" required>
              </div>
            
              <div class="form-group">
                <button class="btn btn-flat btn-success">save</button>
                

              </div>
              
  </form>
  <a href="preference.php">View your preference</a>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="js/adminlte.min.js"></script>
  <script>
  $("#country").on("change", function() {
    var id = $(this).find(':selected').attr("data-id");
    $("#state").find('option:not(:first)').remove();
    if(id != '') {
      $.post("state.php", {id: id}).done(function(data) {
        $("#state").append(data);
      });
      $('#stateDiv').show();
    } else {
      $('#stateDiv').hide();
      $('#cityDiv').hide();
    }
  });
</script>

<script>
  $("#state").on("change", function() {
    var id = $(this).find(':selected').attr("data-id");
    $("#city").find('option:not(:first)').remove();
    if(id != '') {
      $.post("city.php", {id: id}).done(function(data) {
        $("#city").append(data);
      });
      $('#cityDiv').show();
    } else {
      $('#cityDiv').hide();
    }
  });
</script>
  </body>
  </html>