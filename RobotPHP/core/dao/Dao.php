<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace core\dao;

/**
 * Classe que abstrai métodos de acesso ao banco de dados.
 *
 * @author jlgre_000
 */
abstract class Dao {

    /**
     * O modelo que será manipulado pelo Dao.
     * @var core\mvc\Model 
     */
    protected $model;

    /**
     * O objeto PDO para fazer a conexão com o BD
     * @var \PDO
     */
    protected $connection;

    /**
     * Um array contendo o nome das colunas da tabela
     * @var array 
     */
    protected $columns;

    /**
     * O Nome da Tabela
     * @var string 
     */
    protected $tableName;

    /**
     * O Nome do campo que armazena o ID na tabela.
     * @var string 
     */
    protected $tableId;

    /**
     * Construtor
     * @param \core\mvc\Model $model O modelo que o DAO irá manipular.
     */
    public function __construct(\core\mvc\Model $model = null) {
        $this->connection = Connection::getConnection();
        if ($model) {
            $this->model = $model;
            $this->setColumns();
        }
    }

    /**
     * Atribui o objeto Model
     * @param \core\mvc\Model $model O modelo que o DAO irá manipular.
     */
    public function setModel(\core\mvc\Model $model) {
        $this->model = $model;
        $this->setColumns();
    }

    /**
     * Retorna o modelo associado ao Dao
     * @return \core\mvc\Model
     */
    public function getModel() {
        return $this->model;
    }

    /**
     * Retorna um array contendo o os nomes dos campos da tabela.
     * @return array 
     */
    public function getColumns() {
        return $this->columns;
    }

    /**
     * Retorna o nome do campo que define o id
     * @return string 
     */
    public function getTableId() {
        return $this->tableId;
    }

    protected abstract function setColumns();

    /**
     * Persiste o modelo no banco de dados.
     * @throws \Exception
     */
    public function insertUpdate($returnId = null) {
        try {
            //..cria um novo objeto SQLObject
            $sqlObj = new SqlObject($this->connection);
            //..se tiver id, então é inserção
            if (!$this->model->getId())
                if ($returnId)
                    return $sqlObj->insert($this->tableName, $this->columns, $returnId);
                else
                    $sqlObj->insert($this->tableName, $this->columns);
            else //..senão, é atualização
                $sqlObj->update($this->tableName, $this->columns, $this->tableId . " = {$this->model->getId()}");
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    /**
     * Exclui um objeto do banco de dados.
     * @param int $id O id do objeto a ser excluído.
     * @throws \Exception
     */
    public function delete($id) {
        try {
            //..cria um novo objeto SQLObject
            $sqlObj = new SqlObject($this->connection);
            //..exclui um registro
            $sqlObj->delete($this->tableName, $this->tableId . " = $id");
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    /**
     * Método abstrato para localizar um objeto no Banco de dados
     * @param int $id O id do objeto a ser excluído.
     */
    public abstract function findById($id);

    /**
     * Método abstrato para listar objetos do banco de dados.
     * @param string $criteria O critério para exclusão. Ex.: "'id' = $id";
     * @param string $orderBy Campo ou campos separados por vírgula que serão usados como critério de ordenação.
     * @param string $groupBy Campo ou campos separados por vírgula que serão usados como critério de agrupamento.
     * @param int $limit Define um limite para a qtde de dados que serão retornados pela consulta SQL.
     */
    public abstract function selectAll($criteria = null, $orderBy = null, $groupBy = null, $limit = null);
}
