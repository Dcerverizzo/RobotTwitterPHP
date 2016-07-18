<?php

namespace core\mvc;

/**
 * Classe abstrata (não pode ser instanciada) para ser a base de todos os Models do framework.
 */
abstract class Model {
    
    /**
     * O id do objeto
     * @var int
     */
    protected $id;
    
    /**
     * Construtor
     * @param type int O valor do id do objeto.
     */
    public function __construct($id = null) {
        $this->id = $id;
    }
    
    /**
     * Retorna o id do objeto
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Atribui o id do objeto
     * @param int $id
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * exibe o modelo (abstrato, pois cada herdeiro terá uma implementação diferente)
     */
    public abstract function show();
    
}
