<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\dao;

/**
 * Description of AppDao
 *
 * @author Daniel Cerverizzo
 */
class AppDao extends \core\dao\Dao {

    const TB_ID_APP = 'id_app';
    const TB_KEY = 'consumer_key ';
    const TB_SECRET = 'secret';
    const TB_TOKEN = 'token';
    const TB_TOKEN_SECRET = 'token_secret';

    function __construct(\app\model\AppModel $model = null) {
        parent::__construct($model);
        $this->tableName = 'app';
        $this->tableId = 'id_app';
    }

    protected function setColumns() {
        $this->columns = array(
            self::TB_KEY => $this->model->getKey(),
            self::TB_SECRET => $this->model->getSecret(),
            self::TB_TOKEN => $this->model->getToken(),
            self::TB_TOKEN_SECRET => $this->model->getTokenSecret(),
        );
    }

    public function findById($id) {
        echo 'not supported yet';
    }

    public function selectAll($criteria = null, $orderBy = null, $groupBy = null, $limit = null) {
        echo 'not supported yet';
    }

//put your code here
}
