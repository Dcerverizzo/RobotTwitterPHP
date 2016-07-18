<?php

/**
 * Classe que concentra todas as requisições - PageController
 */
class Request {

    /**
     * Trata uma requisição de um cliente. 
     */
    static function getRequest() {        
        //..se existir alguma coisa no $_GET, então...
        if ($_GET) {           
            //..pega a classe (se existir)
            $class = isset($_GET['class']) ? $_GET['class'] : NULL;            
            //..pega o método (se existir)
            $method = isset($_GET['method']) ? $_GET['method'] : NULL;
            //..se foi informada uma classe, então...
            if ($class) {                
                //..instancia um novo objeto da classe informada.
                $object = new $class;                
                //..se o método existir no objeto, então...
                if (method_exists($object, $method)) {     
                    //..invoca o método.
                    call_user_func(array($object, $method));
                }
            }            
            else if (function_exists($method)) {
                call_user_func($method, $GET);
            }
        }
    }
}

//..inclui o autoload
require_once 'autoload.php';
//..trata a requisição
Request::getRequest();



