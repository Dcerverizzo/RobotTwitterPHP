# RobotTwitterPHP
==========

Simples Twitter bot feito em PHP

##Novas Funcionalidades
------------
* Auto seguir
* Lista de Seguidores
* Lista de quem está Seguindo


###Funcionalidades
--------
* Envio de Tweet
* Auto-Follow
* Auto-unfollow
* procura de perfil por palavra chave

-----
Como usar
-----
 
  
   Parametros da função TwitterBot devem estar cadastrados no banco que deverá ser criado
   com o sql disponibilizado no projeto
   -----
   
```php
require_once('TwitterBot.php');

if (isset($_POST['tweet'])) {
    $tweet = $_POST['tweet'];
    
}

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
    ```
