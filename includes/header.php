<?php
  require_once 'core/init.php';
?>
<!DOCTYPE html>
<html>
	<head>
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <link rel="stylesheet" href="css/bootstrap.css">
  </head>

  <body>
      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
      <script type="text/javascript" src="js/materialize.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

      <script> 
        $('.dropdown-toggle').dropdown(); 

          $(document).ready(function(){
            refreshTable();
          });

          function refreshTable(){
            $('#tableHolder').load('getTable.php', function(){
              setTimeout(refreshTable, 1000);
          });
        }
      </script>

  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">

      </div>

      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li><a href="index.php">Home</a></li>
        </ul>

        <ul class="nav navbar-nav navbar-right">
          <?php
              $user = new User();
              if($user->isLoggedIn()) {
                  
                  echo "<li class='dropdown'>
                          <a class='dropdown-toggle' data-toggle='dropdown' href='#' aria-expanded='false'>
                            " . escape($user->data()->username) . "<span class='caret'></span>
                          </a>
                          <ul class='dropdown-menu'>
                            <li><a href='informatie.php'><span class='glyphicon glyphicon-info-sign'></span> Informatie</a>
                            <li class='divider'></li>
                            <li><a href='logout.php'><span class='glyphicon glyphicon-log-out' aria-hidden='true'></span> Logout</a></li>
                            <li><a href='update.php'><span class='glyphicon glyphicon-cog' aria-hidden='true'></span> Account Settings</a></li>
                            <li><a href='changepassword.php'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span> Change password</a></li>
                          </ul>";
                  
                  // if($user->hasPermission('admin')) {
                  //   echo '<p>U bent een administrator</p>';
                //}        
              } else {
                  echo "
                  <li><a href='register.php'>Register</a></li>
                  <li><a href='login.php'>Login</a></li>";
              }
          ?>
        </ul>
      </div>
    </div>
  </nav>
