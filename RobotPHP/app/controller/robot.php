<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('TwitterBot.php');

if (isset($_POST['tweet'])) {
    $tweet = $_POST['tweet'];
}

$key = 'ZGCs0eDtoSG11IcehixVYkScx';
$secret = 'WiSSD5bCxarFhAuCR15dp8GkHKBJwzeTv3ocaRGKbTNKX0Mo4L';
$token = '753877611835785216-xO1dpIIzfUvYkvukk2rKNZcyHCYc5cg';
$token_secret = 'Tk263qn24riU5k7XvRO6eqmGfK3jRy7Y7SuP1i1sy7zl3';

try {
    $robot = new TwitterBot($key, $secret, $token, $token_secret);
    $robot->post($tweet);
    $follow = ( isset($_POST['follow']) ) ? true : null;
    $unfollow = ( isset($_POST['unfollow']) ) ? true : null;

    if ($follow == true) {
        $robot->autoFollow();
    }if ($unfollow == true) {
        $robot->autoUnfollow();
    }
# Visualizando os dados
    var_dump($follow, $unfollow);


    /*  if (isset($_POST['follow'])) {
      $follow = $_POST['follow'];
      var_dump($follow);
      $robot->autoFollow();
      }
      if (isset($_POST['unfollow']) && $_POST['unfollow'] == true) {
      $robot->autoUnfollow();
      } */
//$robot->autoUnfollow();
//$robot->postTweets();

    $query = array(
        "q" => "twitterbot",
        "count" => 10,
        "result_type" => "recent",
    );
//se você quiser seguidores pelos resultados
// if you want follow users from search results
    $results = $robot->search($query);
    foreach ($results->statuses as $result) {
        // echo $result->text . "\n";  
    }

// if you want follow users from search results
    foreach ($results->statuses as $result) {
        $users_id[] = $result->user->id;
    }

    $users_id = array_unique($users_id);

    $new_followings = $robot->autoFollow($users_id);

    header('Location: http://localhost/GitHub/RobotPHP/index.php');
} catch (Exception $exc) {
    echo $exc->getTraceAsString();
} finally {
    
}



//"Got ". $new_followings ." new following(s)";
