<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AppView
 *
 * @author Daniel Cerverizzo
 */

namespace app\view\app;

class AppView extends \core\mvc\view\HtmlPage {

    public function __construct(\app\model\AppModel $model = null) {
        is_null($model) ? $this->model = new \app\model\AppModel() : $this->model = $model;
    }

    public function show() {
        //  $this->drawTop();
        require_once 'app.php';
        //$this->drawBottom();        
    }

//put your code here
}
