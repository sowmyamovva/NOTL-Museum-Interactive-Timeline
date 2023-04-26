<style>
.form-grid{
    display:grid;
    grid-template-columns: 1fr 0fr 1fr;
    justify-items: center;
    width: 75%;
    margin: 3% auto;
    align-items: center;
    grid-gap: 20px;
}
#page-heading{
        background: #808080b8;
    color: white;
    width: 75%;
    margin: 3%auto;
    padding: 2%;
    text-align: center;
}
.date-btn{
    border: none;
    border-radius: 30px;
    padding: 3%;
    width: -webkit-fill-available;
}
#add-btn{
    border: none;
    border-radius: 40px;
    padding: 4% 0%;
    width: 75%;
    background: #a4a4a4;
    color: white;
    margin: 4%;
}
#ver-line{
    border-left: 2px solid #a4a4a4;
    height: -webkit-fill-available;
}
.newadd{
    background: #efefef;
    /* padding: 20%; */
    width: 100%;
    padding: 10%;
    text-align: center;
}
.alreadyadded{
    text-align: center;
}
#form-container{
    position: fixed;
    background: #f5f4f4;
    padding: 3%;
    width: 56%;
    margin: 5% auto;
    top: 5%;
    right: 0;
    left: 0;
    bottom: 0;
    overflow: scroll;
    box-shadow: 0 4px 40px 0 rgb(0 0 0 / 9%), 0 6px 20px 0 rgb(0 0 0 / 17%);
}
input, textarea, select{
    border-radius: 20px;
    border: none;
    padding: 1%;
    margin: 1% !important;
}
.previous{
    background:#e4e4e4;
    padding:1%;
    
}
#remove-event{
        border: none;
    border-radius: 40px;
    padding: 2%;
    /* width: 75%; */
    background: #a4a4a4;
    color: white;
    margin: 4%;
}
.subevent{
        background: white;
    padding: 4%;
    margin: 1%;
    margin: auto;
}
input[type=submit] {
         border: none;
    border-radius: 40px;
    padding: 2%;
    /* width: 75%; */
    background: #a4a4a4;
    color: white;
    margin: 4%;
}
#add_sub_event_button{
border: none;
    border-radius: 30px;
    padding: 3%;
    width: -webkit-fill-available;
}

#category{
    width:50%;
}
#crosssvg{
  width: 40px;
    /* right: 0; */
    float: right;
   

}
#crosssvg:hover{
    cursor:pointer;
}

</style>
<?php
    // start session
    session_start();
    // check if user is logged in
    if (isset($_SESSION["user_id"])) {
        $user_id = $_SESSION["user_id"];
        require_once '/home/vol4_4/epizy.com/epiz_33561013/htdocs/public_html/models/UserModel.php';
        $model = new UserModel(0,0, 0,0,0);
        $user = $model->findById($user_id);
        $user_role = $user['user_role_id'];
        session_write_close();
        if( $user_role != 1)
        {
            $url = "https://badger-timeline.infinityfreeapp.com/public_html";
            header("Location: $url");
        }
    } 
    else
    {
        $url = "https://badger-timeline.infinityfreeapp.com/public_html";
        header("Location: $url");
    }
    include '/home/vol4_4/epizy.com/epiz_33561013/htdocs/public_html/includes/header.php';
?>
<?php
// Load database configuration
error_reporting(E_ALL);
ini_set('display_errors', '1');
// echo "we are here";
// require('/home/vol4_4/epizy.com/epiz_33561013/htdocs/public_html/config/config.php');
$db = new Config();
$connection = $db->getConnection();
// Check if date is set
 $row = array("id" => "", "image_front" => "", "image_back" => "", "date" => "", "date_marker" => "","date_title" => "", "sub_events" => "", "information" => "", "more_information" => "",);
if (isset($_POST['date'])) {
    // Escape the date and retrieve data from the database
    
    $date = mysqli_real_escape_string($connection, $_POST['date']);
    $sql = "SELECT * FROM events WHERE date = '$date'";
    $result = mysqli_query($connection, $sql);
    $flag = "set";
    $add_button = 1;
    while($r = $result->fetch_assoc()) {
        $row["id"]= $r["id"];
        $row["image_front"] = $r["image_front"];
        $row["image_back"] = $r["image_back"];
        $row["date"] = $r["date"];
        $row["date_marker"] = $r["date_marker"];
        $row["date_title"] = $r["date_title"];
        $row["sub_events"] = $r["sub_events"];
        $row["information"] = $r["information"];
        $row["more_information"] = $r["more_information"];
        $row["event_title"] = $r["event_title"];
        $row["category"] = $r["category"];
        $add_button = 0;
    }

     if ($row['sub_events'] == 1)
     {
        $event_id = $row['id'];
        $sub_events = mysqli_query($connection, "SELECT * FROM sub_events WHERE event_id = '$event_id'");$sql = "SELECT * FROM sub_events WHERE event_id = $event_id AND status = 1";
        $sub_event_result = mysqli_query($connection, $sql);
        $sub_events = mysqli_fetch_all($sub_event_result, MYSQLI_ASSOC);
     }
}

// Close database connection
// mysqli_close($connection);
?>

<head>
    <title>Edit Content</title>
</head>

<?php
// get the current page URL
$current_url = $_SERVER['REQUEST_URI'];
?>

<?php if ((strpos($current_url, 'timeline') !== false || strpos($current_url, 'edit_content') !== false)&& !$guest && $user_header['user_role_id'] == 1): ?>
<style>
.tabs_button_container {
  margin-top: 20px;
  display: flex;
}

.view_button_un, .edit_button_un {
  background-color: #d3d3d3;
  border: none;
  color: #fff;
  padding: 10px;
  font-size: 16px;
  cursor: pointer;
  margin-right: 10px;
}

.edit_button_un {
  background-color: #adadad;
}

.view_button_un.active, .edit_button_un.active {
  opacity: 0.7;
  cursor: default;
  pointer-events: none;
}

.view_button_un:hover, .edit_button_un:hover {
  opacity: 0.8;
}

</style>
<div class="tabs_button_container">
  <button class="view_button_un <?php echo (strpos($current_url, 'timeline') !== false) ? 'active' : ''; ?>">View</button>
  <button class="edit_button_un <?php echo (strpos($current_url, 'edit_content') !== false) ? 'active' : ''; ?>">Edit</button>
</div>
<script>
const viewButton = document.querySelector('.view_button_un');
const editButton = document.querySelector('.edit_button_un');

viewButton.addEventListener('click', function() {
  if (!viewButton.classList.contains('active')) {
    window.location.href = 'https://badger-timeline.infinityfreeapp.com/public_html/views/pages/timeline';
  }
});

editButton.addEventListener('click', function() {
  if (!editButton.classList.contains('active')) {
    window.location.href = 'https://badger-timeline.infinityfreeapp.com/public_html/views/pages/edit_content';
  }
});
</script>
<?php endif; ?>
<body>
    <h1 id="page-heading">Edit Content</h1>
    <?php
    // Load database configuration
    // require_once('/home/vol4_4/epizy.com/epiz_33561013/htdocs/public_html/config/config.php');

    // // Retrieve all dates from the events table
    // $config = new Config();
    // $connection = $config->getConnection();
    $query = "SELECT DISTINCT date FROM events";
    $result = mysqli_query($connection, $query);
    ?>
    <div class="form-grid">
        <div class="alreadyadded">
        <h2>Already Added Timeline Dates</h2>
        <p>Click on the date you want to edit</p>
        <?php while($row1 = $result->fetch_assoc()): ?>
            <form method="post" action="">
                <input type="hidden" name="date" value="<?php echo $row1['date']; ?>">
                <button class="date-btn" type="submit"><?php echo $row1['date']; ?></button>
            </form>
        <?php endwhile; ?>
        </div>
        <div id="ver-line"></div>
        <div class="newadd">
        <h2>Add a new Date</h2>
        <form method="post" action="">
            <input type="hidden" name="date" value="">
            <button id="add-btn" type="submit">Add Event</button>
        </form>
        </div>
    </div>
    <br>
     <?php if(isset($flag)){?>
    <div id="form-container">
    
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" onclick="closeform()" id="crosssvg"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/></svg>
       
       
        <form action = "save.php" method="post" enctype="multipart/form-data">
        <h3>Edit date:<?php echo $row['date']; ?></h3>
        <hr>
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <label>Date:</label>
            <input type="text" name="date" value="<?php echo $row['date']; ?>" required><br>
            <label>Title:</label>
            <input type="text" name="date_title" value="<?php echo $row['date_title']; ?>" required><br>
            <label>Front Image:</label>
            <?php if (!empty($row['image_front'])): 
                $default_image_front = '/home/vol4_4/epizy.com/epiz_33561013/htdocs/public_html/assets/images/'.$row['image_front'];
             ?>
                <input type="file" name="image_front" value = "<?php echo $row['image_front']; ?>"><br>
                <div class="previous">
                <span>Previously uploaded file: </span>
                <br>
                <img src="https://badger-timeline.infinityfreeapp.com/public_html/assets/images/<?php echo $row['image_front']; ?>" width="100" required><br>
                <input type="hidden" name="current_image_front" value="<?php echo $row['image_front']; ?>">
                </div>
             <?php else: ?> 
             <input type="file" name="image_front" required><br> 
             <?php endif; ?>


            <label>Back Image:</label>
            <?php if (!empty($row['image_back'])): 
                $default_image_back = '/home/vol4_4/epizy.com/epiz_33561013/htdocs/public_html/assets/images/'.$row['image_back'];
            ?>
                <input type="file" name="image_back" value = "<?php echo $row['image_back']; ?>"><br>
                <div class="previous">
                 <span>Previously uploaded file: </span>
                 <br>
                <img src="https://badger-timeline.infinityfreeapp.com/public_html/assets/images/<?php echo $row['image_back']; ?>" width="100" required><br>
                <input type="hidden" name="current_image_back" value="<?php echo $row['image_back']; ?>">
                </div>
            <?php else: ?> 
            <input type="file" name="image_back" required><br> 
            <?php endif; ?>


            <label>Information:</label>
            <textarea name="information"><?php echo $row['information']; ?></textarea><br>
            <label>More Information:</label>
            <textarea name="more_information"><?php echo $row['more_information']; ?></textarea><br>
            <label>Date Marker:</label>
            <input type="text" name="date_marker" value="<?php echo $row['date_marker']; ?>"><br>

            <label>Sub-events(Mark as 0 if you don't want the sub  events to show up for this event.):</label>
            <input type="text" name="sub_events" value="<?php echo $row['sub_events']; ?>"><br>
            <label>event_title:</label>
            <input type="text" name="event_title" value="<?php echo $row['event_title']; ?>" required><br>
            <label for="category">Select the category:</label>
            <select id="category" name="category">
            <option value="Indigenous_History" <?php if($row['category'] == "Indigenous_History"){echo" selected";} ?>>Indigenous History</option>
            <option value="European_Settlers" <?php if($row['category'] == "European_Settlers"){echo" selected";} ?>>European Settlers</option>
            <option value="War" <?php if($row['category'] == "War"){echo" selected";} ?>>War</option>
            <option value="Transportation" <?php if($row['category'] == "Transportation"){echo" selected";} ?>>Transportation</option>
            <option value="Fishing" <?php if($row['category'] == "Fishing"){echo" selected";} ?>>Fishing</option>
            <option value="Historical_Figures" <?php if($row['category'] == "Historical_Figures"){echo" selected";} ?>>Historical Figures</option>
            </select><br>
            <input type="submit" name="remove_event" value="Remove Event" id="remove-event">
            <hr>
            <?php $sub_event_index = 0; if ( $row['sub_events'] == 1): ?>
            <h2 id="sub-heading">Sub-Events:</h2>
            <div id = "sub_events">
            <?php foreach ($sub_events as $index => $sub_event):  $sub_event_index = $index+1;?>
                <div class="sub_event" id="sub_event_<?php echo $index ;?>">
                    <input type="hidden" name="sub_event_id[]" value="<?php echo $sub_event['id']; ?>">
                    <label for="image_front_<?php echo $sub_event['id']; ?>">Front Image:</label>
                    <input type="file" name="sub_image_front[]" onchange="showFileName(this)">
                    <input type="hidden" name="current_sub_image_front_<?php echo $index ;?>" value="<?php echo $sub_event['image_front']; ?>">
                    <span class="file_name"><?php echo $sub_event['image_front']; ?></span>
                    <label for="image_back_<?php echo $sub_event['id']; ?>">Back Image:</label>
                    <input type="file" name="sub_image_back[]" onchange="showFileName(this)">
                    <input type="hidden" name="current_sub_image_back_<?php echo $index ;?>" value="<?php echo $sub_event['image_back']; ?>">
                    <span class="file_name"><?php echo $sub_event['image_back']; ?></span><br>
                    <button type="button" class="remove_sub_event_button" onclick="removeSubEvent(<?php echo $index; ?>)">Remove</button>
                </div>
            <?php endforeach; ?>
            <?php else: ?>
            <h2>No Sub-Events</h2>
            <p>This event does not have any sub-events yet.</p>
            
            <div id = "sub_events">
            </div>
            <?php endif; ?>
            
              
            
              <button type="button" onclick="addSubEvent()" id="add_sub_event_button">Add Sub-Events</button>
              <hr>
            <br>
            <!--<button type="submit">Update Event</button>-->
            <?php if ($add_button==0):?>
            <input type="submit" name="Update" value="Update">
            <?php else:?>
            <input type="submit" name="Add" value="Add_event">
            <?php endif;?>
            
        </form>
        
    </div>
    <?php } ?>
     <script>
    var sub_event_index = <?php echo json_encode($sub_event_index) ; ?>;


    function addSubEvent() {
        var subEventTemplate = `
            <div class="sub_event" id="sub_event_`+sub_event_index+`">
                <input type="hidden" name="sub_event_id[]" value=-1>
                <label for="image_front">Front Image:</label>
                <input type="file" name="sub_image_front[]" onchange="showFileName(this)">
                <span class="file_name"></span>
                <label for="image_back">Back Image:</label>
                <input type="file" name="sub_image_back[]" onchange="showFileName(this)">
                <span class="file_name"></span>
                <button type="button" class="remove_sub_event_button" onclick="removeSubEvent(`+sub_event_index+`)">Remove</button>
            </div>
        `;
        sub_event_index++;
        var subEventsContainer = document.querySelector('#sub_events');
        subEventsContainer.insertAdjacentHTML('beforeend', subEventTemplate);
    }

    function removeSubEvent(index) {
        var id = "sub_event_"+index;
        var subEvent = document.getElementById(id);
        subEvent.remove();
    }

    function showFileName(input) {
        var fileName = input.value.split('\\').pop();
        var fileSpan = input.parentNode.querySelector('.file_name');
        fileSpan.textContent = fileName;
    }
    function refreshPageWithoutPostData() {
    location.reload(true);
    }
    function closeform(){
        document.querySelector("#form-container").style.display = "none";
    }
    </script>
</body>
</html>


