<?php
//echo("finally!!");

require_once 'config/config.php';
include 'includes/header.php';
?>

<!DOCTYPE html>
<html lang="en">
	
<head>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" />
		<!-- styles -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" href="assets/CSS/stylesheet.css" /> 
		<title>Homepage</title> 
  </head>
  
  <body style ="overflow-x:hidden;">

  <!----First div with timeline intro ----->
   
  <div class="containerf">
    <div class="row">  
      <div class= "col-md-6 overlaylanding-text" style = "url('(https://github.com/sowmyamovva/NOTL-Museum-Interactive-Timeline/blob/main/Images/paper.jpg?raw=true') !important;">
        Explore our new Interactive Timeline
        and experience Niagara's rich history
        <br>
        <a href="timeline.php">
        <button type="button" class="btn btn-primary btn-lg">Visit Now</button></a></div>
      <div class="col-md-6">
            
        <img src="https://github.com/sowmyamovva/NOTL-Museum-Interactive-Timeline/blob/main/Images/Frame%202.png?raw=true" style=" position: relative;  z-index: 20;     ">
    
      </div>
  </div>

<!--New Section with Events-->
<div class="row-circa">
  <div class="col-lg-4">
    <img class="rounded-circle" src="https://github.com/sowmyamovva/NOTL-Museum-Interactive-Timeline/blob/main/Images/Indigenous%20copy.jpg?raw=true" alt="IndigNiagara" width="140" height="140">
    <h2>Indigenous</h2>
    <p>Indigenous people have been in Niagara for over 11,000 years. One of the earliest known inhabitants who are an important peice of Niagara's History </p>
    <p>
      <a class="btn btn-secondary" href="#" role="button">View details »</a>
    </p>
  </div>
  <div class="col-lg-4">
    <img class="rounded-circle" src="https://github.com/sowmyamovva/NOTL-Museum-Interactive-Timeline/blob/main/Images/AfricanCanadian.jpeg?raw=true" alt="AfriNiagara" width="140" height="140">
    <h2>African Canadians</h2>
    <p>At the outbreak of war, there were many people of African descent living in Upper Canada and when the call came, they volunteered for service in their militia units.</p>
    <p>
      <a class="btn btn-secondary" href="#" role="button">View details »</a>
    </p>
  </div>
  <div class="col-lg-4">
    <img class="rounded-circle" src="https://github.com/sowmyamovva/NOTL-Museum-Interactive-Timeline/blob/main/Images/Colonialist.jpeg?raw=true" alt="EurNiagara" width="140" height="140">
    <h2>European Colonialists</h2>
    <p>The British regular army, volunteers often recruited from the lowest class of British society, were extremely well-trained and well-prepared.</p>
    <p>
      <a class="btn btn-secondary" href="#" role="button">View details »</a>
    </p>
  </div>
</div>

<hr class= "divider">
<div class = "row-divider">
    <div class="col-lg-12">
      <h1 class="event-header">Upcoming War of 1812 Anniversary Event</h1>
      <p class="divider-text">The war of 1812 was part of a global conflict. Britain and her allies were in a death-struggle with the French under Napoleon 
        Bonaparte, trying to prevent the French from dominating Europe and the far-flung European colonies throughout the world. 
        Britain's army was fully committed to stopping the French empire when the United States declared war. Join us on April 3rd to learn more.</p>
      <img class= "imgevent" src="https://github.com/sowmyamovva/NOTL-Museum-Interactive-Timeline/blob/main/Images/Picture1.jpg?raw=true" alt="Imageevent" class="img-fluid">
    </div>
</div>
</div>



    <?php 
include 'footer.php'; 
?>
  </body>

</html>


