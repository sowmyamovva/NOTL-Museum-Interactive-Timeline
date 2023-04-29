<!DOCTYPE html>
<html>

<head>

 <meta charset="UTF-8" />

 <meta name="viewport" content="width=device-width, initial-scale=1.0" />

 <!-- font-awesome -->

 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" />

 <!-- styles -->

<link rel="stylesheet" href="https://badger-timeline.infinityfreeapp.com/public_html/assets/CSS/fhstyle.css" /> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>


<style>
#suggestions{
 position: absolute;
   
    padding: 1%;
    top: 15%;
    z-index:99;
    font-size:13px;
}
.suggestion2{
    /*background:black;*/
}
   .suggestion2::before {
    content: '';
    position: absolute;
    display: block;
    width: 0;
    z-index: 1;
    border-style: solid;
    border-color: #000000 transparent;
    border-width: 0 20px 20px;
    top: -20px;
    left: 50%;
    margin-left: -20px;
}
li.dropdown {
  display: inline-block;
      padding: 0 6%;
}

.dropdown-content {
    display:none;
    position: fixed;
    background-color: #242424;
    min-width: 148px;
    box-shadow: 0px 8px 16px 0px rgb(0 0 0 / 20%);
    z-index: 1;
    /* TOP: 10%; */
}
/* .dropdown-content::before{
    content: '';
    position: absolute;
    display: block;
    width: 0;
    z-index: 1;
    border-style: solid;
    border-color: #000000 transparent;
    border-width: 0 10px 10px;
    top: -10px;
    left: 50%;
    margin-left: -20px;
} */
.dropdown-content a {
  color: white;
  padding: 12px 16px !important;
  text-decoration: none;
  display: block;
  text-align: left;
}

.dropdown-content a:hover {background-color: #f1f1f1;}

.dropdown:hover .dropdown-content {
  display: block;
}
.dropdown-item{
    color:white !important;
    padding:0 !important;
}
.dropdown-item:focus, .dropdown-item:hover {
    color: #948888 !important;
    text-decoration: none;
    background-color: black !important;
}
.suggestion{
    border-bottom: 1px solid white;
    padding: 1%;
}
</style>
<?php
    // start session
     $guest = true;
    if (session_status() == PHP_SESSION_NONE) 
    {
        session_start();
    }
    if (isset($_POST['logout'])) 
    {
        require_once '/home/vol4_4/epizy.com/epiz_33561013/htdocs/public_html/controllers/UserController.php';
        $controller = new UserController();
        $controller->logout();
        // $url = "https://badger-timeline.infinityfreeapp.com/public_html";
        // header("Location: $url");
    }
    $url = "https://badger-timeline.infinityfreeapp.com/public_html";
    // header("Location: $url");
    // check if user is logged in
    if (isset($_SESSION["user_id"])) {
        $user_id = $_SESSION["user_id"];
        require_once '/home/vol4_4/epizy.com/epiz_33561013/htdocs/public_html/models/UserModel.php';
        $model = new UserModel(0,0, 0,0,0);
        $user_header = $model->findById($user_id);
        $user_name = $user_header['username'];
        $guest = false;
        // session_write_close();
    } else {
        $guest = true;
        $user_name = "Guest";
        // session_write_close();
    }
?>

<nav style = "background-color: #242424;">

 <div class="nav-center">

 <!-- nav header -->

 <div class="nav-header">
<!-- 
 <h2>NOTL</h2> -->

 <img src="http://badger-timeline.infinityfreeapp.com/public_html/assets/images/logo.jpg" style="height:5.5vh; margin-left:10px; min-width:32px;" class="logo" alt="logo" />

 <button class="nav-toggle"> <i class="fas fa-bars"></i> </button>
 </div>

 <!-- links -->

 <ul class="links">

 <li> <a href="http://badger-timeline.infinityfreeapp.com/public_html/">Home</a> </li>

 <li> <a href="about.html">Services</a> </li>
<!-- 
 <li> <a href="Login.html">Login</a> </li> -->
  <?php if ($guest) { ?>
             <li> <a href="https://badger-timeline.infinityfreeapp.com/public_html/views/user/account" >Log In</a>
                </li>
            <?php }
            
             else{ 
                
                ?>
                <li class="dropdown">
                    <a class="dropbtn" href="https://badger-timeline.infinityfreeapp.com/public_html/views/user/profile"><span class="glyphicon glyphicon-user"></span></a>
                    <div class="dropdown-content">
                        <a href="https://badger-timeline.infinityfreeapp.com/public_html/views/user/profile">Profile</a>
                        <a href="#"><form method='POST'>
                                <input type='submit' name='logout' class='dropdown-item' value='Log Out'>
                            </form></a>
                    </div>
                </li>
            <?php } ?>

 </ul>

 <!----Searchbar goes here ----->


 <form action="https://badger-timeline.infinityfreeapp.com/public_html/views/pages/timeline" method="get" class="SearchBar">
                <input type="text" name="search" placeholder="Search"  list="suggestions" id="search">
                <div id="suggestions" onclick>
                <!-- JavaScrip-populate options here -->
                </div>
                 <button style="position: relative; right: 15%" type="submit"><svg height="20" viewBox="0 0 512 512" width="20" xmlns="http://www.w3.org/2000/svg"><title/><path d="M221.09,64A157.09,157.09,0,1,0,378.18,221.09,157.1,157.1,0,0,0,221.09,64Z" style="fill:none;stroke:#000;stroke-miterlimit:10;stroke-width:32px"/><line style="fill:none;stroke:#000;stroke-linecap:round;stroke-miterlimit:10;stroke-width:32px" x1="338.29" x2="448" y1="338.29" y2="448"/></svg></button>
            </form>

 </div>

</nav>

<?php
require_once '/home/vol4_4/epizy.com/epiz_33561013/htdocs/public_html/controllers/ContentController.php';
$controller = new ContentController();
$events = $controller->getEvents();
?>
<script id ="search">
 var trial_events =  <?php echo json_encode($events); ?>;
  
  // var datalist = document.querySelector('#suggestions');
  // trial_events.forEach(function(event) {
  //   var option = document.createElement('p');
  //   option.innerHTML =event.date_title+" "+event.event_title;
  //   option.addEventListener("click", searchfill("1938"));
  //   datalist.appendChild(option);
  // });

  // function searchfill(elem){
  //     document.querySelector('#search').value = elem;
  // }
  const list = trial_events.map((item) => `${item['date_title']} | ${item['event_title']} (${item['category']})`);
const searchInput = document.getElementById("search");
const suggestionContainer = document.getElementById("suggestions");

searchInput.addEventListener("input", function() {
  suggestionContainer.innerHTML = "";

  if (this.value) {
      suggestionContainer.classList.add("suggestion2");
    const matchingItems = list.filter(item => item.toLowerCase().includes(this.value.toLowerCase()));
    matchingItems.forEach(function(item) {
      const suggestion = document.createElement("div");
      suggestion.textContent = item;
      suggestion.classList.add("suggestion"); 
      suggestionContainer.appendChild(suggestion);
    });
  }
  else{
      suggestionContainer.classList.remove("suggestion2");
  }
});

suggestionContainer.addEventListener("click", function(e) {
  if (e.target.classList.contains("suggestion")) {
    searchInput.value = e.target.textContent;
    suggestionContainer.innerHTML = "";
    suggestionContainer.classList.remove("suggestion2");
  }
});

</script>
