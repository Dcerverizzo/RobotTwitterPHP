<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\dao;

/**
 * Description of VendaDao
 *
 * @author jlgregorio81
 */
class VendaDao extends \core\dao\Dao {

    //..campos da tabela venda
    const TB_ID_PESSOA = 'id_pessoa';
    const TB_TIPO_PESSOA = 'tipo_pessoa';
    const TB_DATA = 'data';
    const TB_TOTAL_PRODUTOS = 'total_produtos';
    const TB_DESCONTO = 'desconto';
    const TB_TOTAL_VENDA = 'total_venda';
    //..tabela item_venda    
    const TB_ITEM_ID = 'id_item_venda';
    const TB_ITEM_PRODUTO = 'id_produto';
    const TB_ITEM_QTDE = 'qtde';
    const TB_ITEM_VALOR = 'valor';

    public function __construct(\app\model\VendaModel $model = null) {
        parent::__construct($model);
        $this->tableName = 'venda';
        $this->tableId = 'id_venda';
    }

    protected function setColumns() {
        $this->columns = array(self::TB_ID_PESSOA => $this->model->getCliente()->getId(),
            self::TB_TIPO_PESSOA => $this->model->getTipoPessoa(),
            self::TB_DATA => $this->model->getData(),
            self::TB_TOTAL_PRODUTOS => $this->model->getTotalProdutos(),
            self::TB_DESCONTO => $this->model->getDesconto(),
            self::TB_TOTAL_VENDA => $this->model->getTotalVenda()
        );
        
        
    }

    public function findById($id) {
        try {
            $sqlObj = new \core\dao\SqlObject($this->connection);
            $dados = $sqlObj->select($this->tableName, '*', "{$this->tableId}  = {$id}");
            if ($dados) {
                $dados = $dados[0];
                $pessoaDao = null;
                if ($dados[self::TB_TIPO_PESSOA] == 'f') {
                    $pessoaDao = new PessoaFisicaDao ();
                } else {
                    //$pessoaDao = new PessoaJuridicaDao();
                }
                //..recupera o objeto clinte associado à venda
                $cliente = $pessoaDao->findById($dados[self::TB_ID_PESSOA]);
                //..seleciona os itens da venda
                $itensVenda = $this->selectAllItens($dados[$this->tableId]);
                //..cria uma nova VendaModel baseado nos dados recuperados do BD - mapeamento relacional-objeto
                $vendaModel = new \app\model\VendaModel($dados[$this->tableId], $dados[self::TB_TIPO_PESSOA], $cliente, $dados[self::TB_DATA], $dados[self::TB_TOTAL_PRODUTOS], $dados[self::TB_DESCONTO], $dados[self::TB_TOTAL_VENDA], $itensVenda);
                //..retorna a venda.
                return $vendaModel;
            } else {
                return NULL;
            }
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    public function insertUpdate($returnId = null) {
        try {
            //..inicia a transação
            $this->connection->beginTransaction();
            //..insere na venda e pega o id de retorno
            $idVenda = parent::insertUpdate('seq_venda');

            //..se for atualização, então o retorno é nulo e deve pegar o id que já vem no model
            if (is_null($idVenda)) {
                $idVenda = $this->model->getId();
            }
            //..deleta todos os itens que por ventura estão cadastrados no item venda.
            //..isso é feito porque é muito complexo controlar atualizações em entidades fracas, isto é, que dependam de outras entidades pra existir.
            $sqlObj = new \core\dao\SqlObject($this->connection);
            $sqlObj->delete('item_venda', "id_venda = {$idVenda}");
            //.insere ou reinsere os itens da tabela de item_venda
            foreach ($this->model->getItensVenda() as $item) {
                //..cria um novo sqlobj
                $sqlObj = new \core\dao\SqlObject($this->connection);
                //..seta os dados de inserção em um array
                $dados = array('id_venda' => $idVenda,
                    'id_produto' => $item->getProduto()->getId(),
                    'qtde' => $item->getQtde(),
                    'valor' => $item->getValor(),
                );
                //..insere na tabela item_venda
                $sqlObj->insert('item_venda', $dados);
            }
            //..confirmar a transação
            $this->connection->commit();
        } catch (\Exception $ex) {
            //..desfas as alterações da transação
            $this->connection->rollBack();
            //..lança a exceção
            throw $ex;
        }
    }

    //..seleciona todos os itens de uma venda mediante um id
    public function selectAllItens($idVenda) {
        $sqlObj = new \core\dao\SqlObject($this->connection);
        $dados = $sqlObj->select('item_venda', '*', "{$this->tableId} = {$idVenda}");
        if ($dados) {
            $itens = null;
            foreach ($dados as $item) {
                //..recupera o produto
                $produtoDao = new ProdutoDao();
                $produto = $produtoDao->findById($item[self::TB_ITEM_PRODUTO]);
                $itemVenda = new \app\model\ItemVendaModel($item[self::TB_ITEM_ID], $produto, $item[self::TB_ITEM_QTDE], $item[self::TB_ITEM_VALOR]);
                $itens[] = $itemVenda;
            }
            return $itens;
        } else {
            return NULL;
        }
    }

    public function selectAll($criteria = null, $orderBy = null, $groupBy = null, $limit = null) {
        try {
            $sqlObj = new \core\dao\SqlObject($this->connection);
            $dados = $sqlObj->select($this->tableName, '*', $criteria, $orderBy, $groupBy, $limit);
            if ($dados) {
                $pessoaDao = null;
                $vendas = null;
                foreach ($dados as $dado) {
                    if ($dado[self::TB_TIPO_PESSOA] == 'f') {
                        $pessoaDao = new PessoaFisicaDao ();
                    } else {
                        //$pessoaDao = new PessoaJuridicaDao();
                    }
                    //..recupera o objeto clinte associado à venda
                    $cliente = $pessoaDao->findById($dado[self::TB_ID_PESSOA]);
                    //..seleciona os itens da venda
                    $itensVenda = $this->selectAllItens($dado[$this->tableId]);
                    //..cria uma nova VendaModel baseado nos dados recuperados do BD - mapeamento relacional-objeto
                    $vendaModel = new \app\model\VendaModel($dado[$this->tableId], $dado[self::TB_TIPO_PESSOA], $cliente, $dado[self::TB_DATA], $dado[self::TB_TOTAL_PRODUTOS], $dado[self::TB_DESCONTO], $dado[self::TB_TOTAL_VENDA], $itensVenda);
                    //..adiciona no vetor de vendas
                    $vendas[] = $vendaModel;
                }
                return $vendas;
            } else {
                return NULL;
            }
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

    

//put your code here
}
