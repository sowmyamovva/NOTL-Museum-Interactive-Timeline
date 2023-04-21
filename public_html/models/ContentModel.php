<?php
require_once '/home/vol4_4/epizy.com/epiz_33561013/htdocs/public_html/config/config.php';

class ContentModel {

    public function __construct() {
       
    }

    public function getAllEvents() {
        $db = new Config();
        $conn = $db->getConnection();
        $query = "SELECT id, image_front, image_back, date,date_title,date_marker,sub_events FROM events";
        $result = mysqli_query($conn, $query);
        $events = array();
        $cnt = 0;
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) 
            {
                $events[$cnt++] = $row;
            }
        }
        return $events;
    }

    public function getAllSubEvents() {
        $db = new Config();
        $conn = $db->getConnection();
        $query = "SELECT id, image_front, image_back, event_id FROM sub_events WHERE status = 1";
        $result = mysqli_query($conn, $query);
        $subEvents = array();
        $eventIds = array();
        $cnt = 0;
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) 
            {
                $subEvents[$cnt++] = $row;
            }
        }
        return $subEvents;
    }
}
