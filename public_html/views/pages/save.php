<?php
// Load database configuration
require_once('/home/vol4_4/epizy.com/epiz_33561013/htdocs/public_html/config/config.php');
$config = new Config();
$connection = $config->getConnection();
// Check if form data is set
if (isset($_POST['id']) && isset($_POST['date']) && isset($_POST['date_title']) && (isset($_POST['current_image_front']) || isset($_FILES['image_front'])) && (isset($_POST['current_image_back']) || isset($_FILES['image_back']))) 
{
    // Escape form data and update the database
    print("kg");
    
    $id = mysqli_real_escape_string($connection, $_POST['id']);
    $date = mysqli_real_escape_string($connection, $_POST['date']);
    $date_title = mysqli_real_escape_string($connection, $_POST['date_title']);


    $file_name_front = $_FILES['image_front']['name'];
    $file_size_front = $_FILES['image_front']['size'];
    $file_tmp_front = $_FILES['image_front']['tmp_name'];
    $file_type_front = $_FILES['image_front']['type'];
    
    // Get back image info
    $file_name_back = $_FILES['image_back']['name'];
    $file_size_back = $_FILES['image_back']['size'];
    $file_tmp_back = $_FILES['image_back']['tmp_name'];
    $file_type_back = $_FILES['image_back']['type'];
    if(isset($_POST['Add']))
    {
      
        $sql1 = "INSERT INTO events (date, date_title";
        $sql2 = "('$date','$date_title'";
    }
    else if ($_POST['Update'])
    {        
         $sql = "UPDATE events SET date = '$date', date_title = '$date_title'";
    }
    if(isset($_POST['Add']))
    {

    }
    else if ($_POST['Update'])
    {
    }
    print("<pre>");
    print_r($_FILES);
    print("</pre>");


    // Create folder if it doesn't exist
    if (!file_exists('/home/vol4_4/epizy.com/epiz_33561013/htdocs/public_html/assets/images')) 
    {
        mkdir('/home/vol4_4/epizy.com/epiz_33561013/htdocs/public_html/assets/images', 0777, true);
    }
    
    // Move front image to uploads folder
    if(isset($file_name_front) && $file_name_front!= "" && $_FILES['image_front']['error'] == 0)
    {
       
        if(isset($_POST['Add']))
        {
            $sql1 = $sql1.", image_front";
            $sql2 =  $sql2.", '$file_name_front'";
        }
        else if ($_POST['Update'])
        {
            $sql = $sql.", image_front = '$file_name_front'";
        }
        move_uploaded_file($file_tmp_front, "/home/vol4_4/epizy.com/epiz_33561013/htdocs/public_html/assets/images/" . $file_name_front);
    }
   
    
    // Move back image to uploads folder
    if(isset($file_name_back) && $file_name_back!= "" && $_FILES['image_back']['error'] == 0)
    {
        if(isset($_POST['Add']))
        {
            $sql1 = $sql1.", image_back";
            $sql2 =  $sql2.", '$file_name_back'";
        }
        else if ($_POST['Update'])
        {
            $sql = $sql.", image_back = '$file_name_back'";
        }
        
        move_uploaded_file($file_tmp_back, "/home/vol4_4/epizy.com/epiz_33561013/htdocs/public_html/assets/images/" . $file_name_back);
    }

   
    $date_marker = mysqli_real_escape_string($connection, $_POST['date_marker']);
    if(isset($date_marker) && $date_marker!="")
    {
        if(isset($_POST['Add']))
        {
            $sql1 = $sql1.", date_marker";
            $sql2 =  $sql2.", '$date_marker'";
        }
        else if ($_POST['Update'])
        {
            $sql = $sql.", date_marker = '$date_marker'";
        }
        
    }
    // $image_front = mysqli_real_escape_string($connection, $_POST['image_front']);
    // $image_back = mysqli_real_escape_string($connection, $_POST['image_back']);
    $sub_events = mysqli_real_escape_string($connection, $_POST['sub_events']);
    if(isset($sub_events) && $sub_events!= "")
    {
        if(isset($_POST['Add']))
        {
            $sql1 = $sql1.", sub_events";
            $sql2 =  $sql2.", '$sub_events'";
        }
        else if ($_POST['Update'])
        {
            $sql = $sql.", sub_events = '$sub_events'";
        }
         
    }
    $information = mysqli_real_escape_string($connection, $_POST['information']);
    if(isset($information) && $information!="")
    {
        if(isset($_POST['Add']))
        {
            $sql1 = $sql1.", information";
            $sql2 =  $sql2.", '$information'";
        }
        else if ($_POST['Update'])
        {
            $sql = $sql.", information = '$information'";
        }
         
    }
    $more_information = mysqli_real_escape_string($connection, $_POST['more_information']);
    if(isset($more_information) && $more_information!="")
    {
        if(isset($_POST['Add']))
        {
            $sql1 = $sql1.", more_information";
            $sql2 =  $sql2.", '$more_information'";
        }
        else if ($_POST['Update'])
        {
            $sql = $sql.", more_information   = '$more_information'";
        }
         
    }
    if(isset($_POST['Add']))
    {
          // INSERT INTO sub_events (id, event_id, image_front, image_back) VALUES ('$sub_event_id', '$id', '$image_front', '$image_back')
        $sql=$sql1.") VALUES ".$sql2.")";
    }
    else if ($_POST['Update'])
    {
        $sql = $sql." WHERE id = '$id'";
    }
    echo( $sql);
    mysqli_query($connection, $sql);

    $sql = "SELECT * FROM events WHERE date_title = '$date_title'";
    $result = mysqli_query($connection, $sql);
   
    while($r = $result->fetch_assoc()) {
        $id= $r["id"];
        }
    
    print("<pre>ID: ");
    print($id);
    print("</pre>");
    if(isset($_POST['sub_event_id']))
    {
        $sub_event_ids = $_POST['sub_event_id'];
        if (is_array($sub_event_ids) && count($sub_event_ids) > 0)
        {
            print("<pre>sub_event_ids : ");
            print_r($_POST['sub_event_id']);
            print("</pre>");
            $sql_sub_events_check = "SELECT * FROM sub_events WHERE event_id = '$id'";
            $result_sub_events_check = mysqli_query($connection, $sql_sub_events_check);

            $existing_sub_event_ids = array();
            while ($sub_event = mysqli_fetch_assoc($result_sub_events_check)) 
            {
                $existing_sub_event_ids[] = $sub_event['id'];
                // Remove sub-event if not present in the submitted data
                if (!in_array($sub_event['id'], $sub_event_ids)) 
                {
                    $sub_event_id = $sub_event['id'];

                    // Delete sub-event images from uploads folder if they exist
                    if ($sub_event['image_front'] != "" && file_exists("/home/vol4_4/epizy.com/epiz_33561013/htdocs/public_html/assets/images/" . $sub_event['image_front'])) 
                    {
                        unlink("/home/vol4_4/epizy.com/epiz_33561013/htdocs/public_html/assets/images/" . $sub_event['image_front']);
                    }

                    if ($sub_event['image_back'] != "" && file_exists("/home/vol4_4/epizy.com/epiz_33561013/htdocs/public_html/assets/images/" . $sub_event['image_back'])) 
                    {
                        unlink("/home/vol4_4/epizy.com/epiz_33561013/htdocs/public_html/assets/images/" . $sub_event['image_back']);
                    }

                    // Delete sub-event from the database
                    $sql_sub_event_delete = "Update sub_events SET status= 0 WHERE id = '$sub_event_id'";
                    mysqli_query($connection, $sql_sub_event_delete);
                }
            }
            foreach ($sub_event_ids as $index => $sub_event_id) 
            {
                $image_front = "";
                $image_back = "";
                $front_image_default = "current_sub_image_front_".$index;
                $back_image_default = "current_sub_image_back_".$index;
                print("<pre> front: ");
                print($front_image_default);
                print("</pre>");
                print("<pre>back: ");
                print($back_image_default);
                print("</pre>");
                $flag = 0;
                // Check if front image is set
                if (isset($_FILES['sub_image_front']['name'][$index]) && $_FILES['sub_image_front']['name'][$index] != "") 
                {
                    $image_front = $_FILES['sub_image_front']['name'][$index];
                }
                else if(isset($_POST[$front_image_default]))
                {
                    $image_front = $_POST[$front_image_default];
                    $flag = 1;
                }

                // Check if back image is set
                if (isset($_FILES['sub_image_back']['name'][$index]) && $_FILES['sub_image_back']['name'][$index] != "") 
                {
                    $image_back = $_FILES['sub_image_back']['name'][$index];
                }
                else if($_POST[$back_image_default])
                {
                    $image_front = $_POST[$back_image_default];
                    $flag = 1;
                }

                // Check if sub-event ID already exists in the database
                if (in_array($sub_event_id, $existing_sub_event_ids)) 
                {
                    // Update sub-event images in the database and uploads folder if they are set
                    if($flag ==0)
                    {
                        $sql_sub_event_update = "UPDATE sub_events SET image_front = '$image_front', image_back = '$image_back' WHERE id = '$sub_event_id'";
                        mysqli_query($connection, $sql_sub_event_update);

                        if ($image_front != "" && file_exists("/home/vol4_4/epizy.com/epiz_33561013/htdocs/public_html/assets/images/" . $sub_event_id . "/" . $sub_event_id . "_front.jpg")) 
                        {
                            unlink("/home/vol4_4/epizy.com/epiz_33561013/htdocs/public_html/assets/images/" . $sub_event_id . "/" . $sub_event_id . "_front.jpg");
                            move_uploaded_file($_FILES['sub_image_front']['tmp_name'][$index], "/home/vol4_4/epizy.com/epiz_33561013/htdocs/public_html/assets/images/" . $sub_event_id . "/" . $sub_event_id . "_front.jpg");
                        }

                        if ($image_back != "" && file_exists("/home/vol4_4/epizy.com/epiz_33561013/htdocs/public_html/assets/images/" . $sub_event_id . "/" . $sub_event_id . "_back.jpg")) 
                        {
                            unlink("/home/vol4_4/epizy.com/epiz_33561013/htdocs/public_html/assets/images/" . $sub_event_id . "/" . $sub_event_id . "_back.jpg");
                            move_uploaded_file($_FILES['sub_image_back']['tmp_name'][$index], "/home/vol4_4/epizy.com/epiz_33561013/htdocs/public_html/assets/images/" . $sub_event_id . "/" . $sub_event_id . "_back.jpg");
                        }
                    }
                } 
                else if($sub_event_ids[$index] == -1)
                {
                    print("<pre> in insert: </pre>");
                    // If sub-event is not present in the database, insert it
                    $sql_sub_event_insert = "INSERT INTO sub_events (event_id, image_front, image_back) VALUES ( '$id', '$image_front', '$image_back')";
                    $sql_event_update = "UPDATE events SET sub_events = 1 WHERE id = '$id'";
                    mysqli_query($connection, $sql_sub_event_insert);
                    // Move front image to uploads folder
                    if(isset($image_front) && $image_front != "") 
                    {
                        move_uploaded_file($_FILES['sub_image_front']['tmp_name'][$index], "/home/vol4_4/epizy.com/epiz_33561013/htdocs/public_html/assets/images/" . $image_front);
                    }
                    if(isset($image_back) && $image_back != "") 
                    {
                        move_uploaded_file($_FILES['sub_image_back']['tmp_name'][$index], "/home/vol4_4/epizy.com/epiz_33561013/htdocs/public_html/assets/images/" . $image_back);
                    }
                }
            }
        }
        else
        {
            // Update events if it has no sub events
            $sql_event_delete = "Update events SET sub_events= 0 WHERE id = '$id'";
            mysqli_query($connection, $sql_event_delete);

        }
    }



            // Update the main event
            // $sql = "UPDATE events SET date = '$date', date_title = '$date_title', sub_events = '$sub_events', image_front = '$file_name_front', image_back = '$file_name_back', information = '$information', more_information   = '$more_information', date_marker = '$date_marker' WHERE id = '$id'";

}
$url = "https://badger-timeline.infinityfreeapp.com/public_html/views/pages/edit_content";
header("Location: $url");
// Close database connection
// mysqli_close($connection);
?>
