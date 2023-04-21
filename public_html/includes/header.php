<!DOCTYPE html>
<html>
<head>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-DW5cX/mKzsRbfLb5jb5BVZXOj/Qbsxw1dTXZrxbh8HqpW0bK9g40abDewMvOQ2LWxjN0pm/eSHdncHrZk8Wakg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   
<?php
    // start session
    session_start();
    // check if user is logged in
    if (isset($_SESSION["user_id"])) {
        $user_id = $_SESSION["user_id"];
        require_once '/home/vol4_4/epizy.com/epiz_33561013/htdocs/public_html/models/UserModel.php';
        $model = new UserModel(0,0, 0,0,0);
        $user = $model->findById($user_id);
        $username = $user['username'];
        session_write_close();
    } else {
        $username = "Guest";
    }
?>

   <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" />
    
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- styles -->
  <link rel="stylesheet" href="https://badger-timeline.infinityfreeapp.com/public_html/assets/CSS/stylesheet.css" /> 
   <!-- <title>Homepage</title> -->
    </head>



<nav>
    <div class="nav-center" style = "height:7vh">
        <!-- nav header -->
        <div class="nav-header">
            <!--<h2>NOTL</h2>-->
            <img src="https://github.com/sowmyamovva/NOTL-Museum-Interactive-Timeline/blob/main/Images/MuseumLogo.png?raw=true" class="logo" alt="logo" /> 
            <button class="nav-toggle"> <i class="fas fa-bars"></i> </button>
        </div>
        <!-- links -->
        <ul class="links" style = "width: -webkit-fill-available;">
            <li> <a href="http://badger-timeline.infinityfreeapp.com/public_html/">home</a> </li>
            <li> <a href="about.html">Services</a> </li>
            <li> <a href="projects.html">Visit Us</a> </li>
            <!--<li> <a href="../users/signup.php">Login</a> </li> -->
             <?php if ($username == "Guest") { ?>
                <form class="form-inline my-2 my-lg-0">
                    <a href="https://badger-timeline.infinityfreeapp.com/public_html/views/user/login" class="btn btn-outline-primary my-2 my-sm-0">Log In</a>
                    <a href="https://badger-timeline.infinityfreeapp.com/public_html/views/user/signup" class="btn btn-outline-primary my-2 my-sm-0 ml-2">Sign Up</a>
                </form>
            <?php }
             else{ 
                
                ?>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="oi oi-person"></span>
                            <?php echo $username; ?>
                            
                        </a>
                       <!-- <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Profile</a>
                            <div class="dropdown-divider"></div>
                            <form method='POST'>
                                <input type='submit' name='logout' class='dropdown-item' value='Log Out'>
                            </form>
                        </div>-->
                    </li>
                    
                </ul>
                 <form method='POST'>
                                <input type='submit' name='logout' class='dropdown-item' value='Log Out'>
                            </form>
            <?php } ?>
        </ul>
        <!----Searchbar goes here ----->
        <ul class="container">
           <!-- <form action="" class="SearchBar">
                <input type="text" placeholder="Search" name="notlsearch">
                <button style="position: absolute; right: 12%;" type="submit"><img  src="https://github.com/sowmyamovva/NOTL-Museum-Interactive-Timeline/blob/main/Project_Source_Code/SearchMag.png?raw=true"></button>
            </form>-->
            
            <div class="search-box">
            <form action="https://badger-timeline.infinityfreeapp.com/public_html/views/pages/timeline" method="get">
                <input type="text" name="search" placeholder="Search"  list="suggestions">
                <datalist id="suggestions">
                <!-- JavaScrip-populate options here -->
                </datalist>
                 <button style="position: relative; right: 2%" type="submit">Search</button>
            </form>
            </div>
        </ul>
    </div>
</nav>
<?php
require_once '/home/vol4_4/epizy.com/epiz_33561013/htdocs/public_html/controllers/ContentController.php';
$controller = new ContentController();
$events = $controller->getEvents();
?>
<script id ="search">
 var trial_events =  <?php echo json_encode($events); ?>;
  
  var datalist = document.querySelector('#suggestions');
  trial_events.forEach(function(event) {
    var option = document.createElement('option');
    option.value =event.date_title;
    datalist.appendChild(option);
  });

</script>
<?php
        // handle logout
        if (isset($_POST['logout'])) {
             
            require_once '/home/vol4_4/epizy.com/epiz_33561013/htdocs/public_html/controllers/UserController.php';
            $controller = new UserController();
            $controller->logout();
            // $url = "https://badger-timeline.infinityfreeapp.com/public_html";
            // header("Location: $url");
            exit();
        }
    ?>
