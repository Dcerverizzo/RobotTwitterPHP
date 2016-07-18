<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\model;

/**
 * Description of TweetModel
 *
 * @author Daniel Cerverizzo
 */
class TweetModel extends \core\mvc\Model {

    private $tweet;

    function __construct($id = null, $tweet = null) {
        parent::__construct($id);
        $this->tweet = $tweet;
    }

    public function show() {
        echo "<h1>Dados do Tweet</h1>";
        echo "<p><b>Counteudo Tweet: </b>{$this->tweet->getTweet()}</p>";
    }

    function getTweet() {
        return $this->tweet;
    }

    function setTweet($tweet) {
        $this->tweet = $tweet;
    }

//put your code here
}
