<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\model;

/**
 * Description of App
 *
 * @author Daniel Cerverizzo
 */
class AppModel extends \core\mvc\Model {

    private $key;
    private $secret;
    private $token;
    private $tokenSecret;

    function __construct($id = null, $key = null, $secret = null, $token = null, $tokenSecret = null) {
        parent::__construct($id);
        $this->key = $key;
        $this->secret = $secret;
        $this->token = $token;
        $this->tokenSecret = $tokenSecret;
    }

    public function show() {
        echo "<h1>Dados do App</h1>";
        echo "<p><b>Consumer key: </b>{$this->app->getKey()}</p>";
        echo "<p><b>Consumer secret: </b>{$this->app->getSecret()}</p>";
        echo "<p><b>Access token: </b>{$this->app->getToken()}</p>";
        echo "<p><b>Access token secret: </b>{$this->app->getTokenSecret()}</p>";
    }

    function getKey() {
        return $this->key;
    }

    function getSecret() {
        return $this->secret;
    }

    function getToken() {
        return $this->token;
    }

    function getTokenSecret() {
        return $this->tokenSecret;
    }

    function setKey($key) {
        $this->key = $key;
    }

    function setSecret($secret) {
        $this->secret = $secret;
    }

    function setToken($token) {
        $this->token = $token;
    }

    function setTokenSecret($tokenSecret) {
        $this->tokenSecret = $tokenSecret;
    }

//put your code here
}
