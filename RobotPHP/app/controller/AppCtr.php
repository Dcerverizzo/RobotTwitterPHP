<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\controller;

/**
 * Description of appCtr
 *
 * @author Daniel Cerverizzo
 */
class AppCtr extends \core\mvc\Controller {

    public function __construct() {
        parent::__construct();
        $this->view = new \app\view\app\AppView();
        $this->model = new \app\model\AppModel();
        $this->dao = new \app\dao\AppDao();
    }

    public function showList() {
        echo 'YOU SHALL NOT PASS';
    }

    public function viewToModel() {
        $this->model = new \app\model\AppModel($this->post['idapp'], $this->post['consumerKey'], $this->post['consumerSecret'], $this->post['acessToken'], $this->post['acessTokenSecret']);
    }

//put your code here
}
