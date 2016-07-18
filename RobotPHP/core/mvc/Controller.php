<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace core\mvc;

/**
 * Controlador genérico. Recebe as requisições do cliente.
 *
 * @author jlgre_000
 */
abstract class Controller {

    protected $view;


    /**
     * O modelo que o controller manipulará
     * @var core\mvc\Model
     */
    protected $model;
    /**
     * O objeto DAO que será usado.
     * @var core\dao\Dao 
     */
    protected $dao;
    
    /**
     * O array GET
     * @var $_GET
     */
    protected $get;
    /**
     * o array POST
     * @var $_POST
     */
    protected $post;

    /**
     * Construtor
     */
    public function __construct() {
        $this->post = $_POST;
        $this->get = $_GET;
    }

    /**
     * Pega os dados da model e alimenta a View - abstrato, pois será implementados nos herdeiros.
     */
    public abstract function viewToModel();

    /**
     * Pega os dados da view e insere no Banco de Dados.
     */
    public function insertUpdate() {
        try {
            //..alimenta o model com os dados da View
            $this->viewToModel();
            //..seta o modelo atualizado no objeto DAO
            $this->dao->setModel($this->model);
            //..invoca o método insertUpdate para persistir o Model
            $this->dao->insertUpdate();
            //..cria uma view com mensagem de scuesso.
            $msg = new \core\mvc\view\Message(\core\Application::MSG_SUCCESS);
        } catch (\Exception $ex) {
            //..caso ocorra algum erro, cria uma view com mensagem de erro
            $msg = new \core\mvc\view\Message(\core\Application::MSG_ERROR .  "\n{$ex->getMessage()}");
        } finally {
            //..mostra a view criada
            $msg->show();
        }
    }

    /**
     * Exclui um objeto do banco de dados mediante um id
     */
    public function delete() {
        try {
            //..alimenta o model com os dados da view
            $this->viewToModel();
            //..invoca o método delete passando por parâmetro o id do modelo
            $this->dao->delete($this->model->getId());
            //..cria uma view de suecesso
            $msg = new \core\mvc\view\Message(\core\Application::MSG_SUCCESS);
        } catch (\Exception $ex) {
            //..caso ocorra algum erro, cria uma view de erro
            $msg = new \core\mvc\view\Message(\core\Application::MSG_ERROR);
        } finally {
            //..exibie a view criada.
            $msg->show();
        }
    }

    /**
     * Exibe a view.
     */
    public function showView() {
        try {
            //..verifica se tem alguma coisa no get
            if ($this->get) {
                if (isset($this->get['id'])) { //..verifica se existe uma variável id no get
                    $id = $this->get['id']; //..pega o id 
                    //..recupera o modelo fazendo uma consulta no bando por id
                    $this->model = $this->dao->findById($id);
                }
            }                        
            //..se recuperou um model, então...
            if ($this->model){
                //..verifica qual é a view com o método get_class;
                $viewClass = get_class($this->view);            
                //..instancia uma nova view
                $view = new $viewClass;
                //..seta o model da view
                $view->setModel($this->model);                
            }
            else
                //..senão cria a view com mensagem de não encontrado
                $view = new \core\mvc\view\Message(\core\Application::MSG_NOT_FOUND);
        } catch (\Exception $ex) {
            //..se acontecer algum problema, cria uma view com mensagem de erro
            $view = new \core\mvc\view\Message(\core\Application::MSG_ERROR);
        } finally {
            //..exibe a view criada.
            $view->show();
        }
    }

    /**
     * O método run é executado sempre que uma requisição for feita via post. Verifica-se o parâmetro passado e toma-se a decisão:
     */
    public function run() {
        //..pega o valor da variável comando que vem por post.
        $comando = strtolower($this->post['comando']);
        //..verifica o valor e invoca os métodos corretos.
        switch ($comando) {
            case 'salvar':
                $this->insertUpdate();
                break;
            case 'excluir':
                $this->delete();
                break;
            case 'novo':
                $this->showView();
                break;
            case 'listar':
                $this->showList();
                break;
            default:
                break;
        }
    }

    /**
     * Exibe a view de listagem (ou pesquisa)
     */
    public abstract function showList();
        
    

}
