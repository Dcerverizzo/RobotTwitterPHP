<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace core\mvc\view;

/**
 * Classe base para a criação de todos as páginas HTML do sistema.
 *
 * @author jlgre_000
 */
abstract class HtmlPage {
    
    /**
     * 
     * @var core\mvc\Model
     */
    protected $model;
    
    /**
     * Método para desenhar o topo da página - definido pelo arquivo top.phtml.
     */
    protected function drawTop(){
        require_once 'top.phtml';
    }
    
    /**
     * Método para desenhar o rodapé da página - definido pelo arquivo bottom.phtml.
     */
    protected function drawBottom(){
        require_once 'bottom.phtml';
    }
    
    /**
     * Método abstrato para exibir a view.
     */
    public abstract function show();
    
    function getModel() {
        return $this->model;
    }

    function setModel($model) {
        $this->model = $model;
    }
       
    

  
    
}
