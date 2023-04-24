<?php
require_once '/home/vol4_4/epizy.com/epiz_33561013/htdocs/public_html/models/ContentModel.php';

class ContentController {
    private $model;

    public function __construct() {
        $this->model = new ContentModel();
    }

    public function getEvents() {
        $events = $this->model->getAllEvents();
        return $events;
        
    }
    public function getSubEvents() {
        $sub_events = $this->model->getAllSubEvents();
        return $sub_events;
    }
}
