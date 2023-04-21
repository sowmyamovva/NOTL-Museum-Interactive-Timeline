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

<!DOCTYPE html>
<html>
<head>
    <title>Edit Content</title>
</head>
<body>
    <h1>Edit Content</h1>
    <?php
    // Load database configuration
    // require_once('/home/vol4_4/epizy.com/epiz_33561013/htdocs/public_html/config/config.php');

    // // Retrieve all dates from the events table
    // $config = new Config();
    // $connection = $config->getConnection();
    $query = "SELECT DISTINCT date FROM events";
    $result = mysqli_query($connection, $query);
    ?>
    <div>
        <?php while($row1 = $result->fetch_assoc()): ?>
            <form method="post" action="">
                <input type="hidden" name="date" value="<?php echo $row1['date']; ?>">
                <button class="date-btn" type="submit"><?php echo $row1['date']; ?></button>
            </form>
        <?php endwhile; ?>
        <form method="post" action="">
            <input type="hidden" name="date" value="">
            <button id="add-btn" type="submit">Add Event</button>
        </form>
    </div>
    <br>
    <div id="form-container">
        <?php if(isset($flag)){?>
        <form action = "save.php" method="post" enctype="multipart/form-data">
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
                <span>Previously uploaded file: <?php echo  $default_image_front; ?></span>
                <img src="https://badger-timeline.infinityfreeapp.com/public_html/assets/images/<?php echo $row['image_front']; ?>" width="100" required><br>
                <input type="hidden" name="current_image_front" value="<?php echo $row['image_front']; ?>">
             <?php else: ?> 
             <input type="file" name="image_front" required><br> 
             <?php endif; ?>


            <label>Back Image:</label>
            <?php if (!empty($row['image_back'])): 
                $default_image_back = '/home/vol4_4/epizy.com/epiz_33561013/htdocs/public_html/assets/images/'.$row['image_back'];
            ?>
                <input type="file" name="image_back" value = "<?php echo $row['image_back']; ?>"><br>
                 <span>Previously uploaded file: <?php echo  $default_image_back; ?></span>
                <img src="https://badger-timeline.infinityfreeapp.com/public_html/assets/images/<?php echo $row['image_back']; ?>" width="100" required><br>
                <input type="hidden" name="current_image_back" value="<?php echo $row['image_back']; ?>">
            <?php else: ?> 
            <input type="file" name="image_back" required><br> 
            <?php endif; ?>


            <label>Information:</label>
            <textarea name="information"><?php echo $row['information']; ?></textarea><br>
            <label>More Information:</label>
            <textarea name="more_information"><?php echo $row['more_information']; ?></textarea><br>
            <label>Date Marker:</label>
            <input type="text" name="date_marker" value="<?php echo $row['date_marker']; ?>"><br>

            <label>Sub-events:</label>
            <input type="text" name="sub_events" value="<?php echo $row['sub_events']; ?>"><br>

            <?php $sub_event_index = 0; if ( $row['sub_events'] == 1): ?>
            <h2>Sub-Events:</h2>
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
            
              
            </div>
              <button type="button" onclick="addSubEvent()" id="add_sub_event_button">Add Sub-Events</button>
            <br>
            <!--<button type="submit">Update Event</button>-->
            <?php if ($add_button==0):?>
            <input type="submit" name="Update" value="Update">
            <?php else:?>
            <input type="submit" name="Add" value="Add_event">
            <?php endif;?>
        </form>
        <?php } ?>
    </div>
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

    </script>
</body>
</html>


