<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace core\mvc\view;

/**
 * Página HTML para exibir mensagens ao usuário.
 *
 * @author jlgre_000
 */
class Message extends HtmlPage {
    
    /**
     * A mensagem que será exibida
     * @var string 
     */
    private $message;
    
    /**
     * Construtor
     * @param string $message A mensagem que será exibida. Recomenda-se usar as constantes definidas em \core\Application.
     */
    function __construct($message) {
        $this->message = $message;
    }

    public function getMessage() {
        return $this->message;
    }

    public function setMessage($message) {
        $this->message = $message;
    }
        
    /**
     * Exibibe a página ao usuário.
     */
    public function show() {
        $this->drawTop();
        require_once 'message.phtml';
        $this->drawBottom();
    }

//put your code here
}
