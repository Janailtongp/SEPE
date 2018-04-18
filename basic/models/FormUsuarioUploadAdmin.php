<?php
namespace app\models;
use Yii;
use yii\base\model;

class FormUsuarioUploadAdmin extends model {

    public $id;
    public $nome;
    public $username;
    public $email;
    public $cpf;
    public $endereco;
    public $instituicao;
    public $role;
    public function rules() {
        return [
            ['id','integer', 'message'=>'ID incorreto.'],
            ['username', 'required', 'message' => 'Campo obrigatório.'],
            ['username', 'match', 'pattern' => "/^.{6,20}$/", 'message' => 'Tamanho entre 6 e 20 caracteres.'],
            ['username', 'match', 'pattern' => "/^[a-z]+$/i", 'message' => 'Apenas letras de A:Z.'],
            ['nome', 'required', 'message' => 'Campo obrigatório.'],
            ['nome', 'match', 'pattern' => "/^.{3,50}$/", 'message' => 'Tamanho entre 3 e 50 caracteres.'],
            ['nome', 'match', 'pattern' => "/^[a-záéíóúñâêôûãõ ]+$/i", 'message' => 'Apenas letras.'],
            ['endereco', 'required', 'message' => 'Campo obrigatório.'],
            ['endereco', 'match', 'pattern' => "/^.{3,100}$/", 'message' => 'Tamanho entre 3 e 100 caracteres.'],
            ['endereco', 'match', 'pattern' => "/^[1-9a-záéíóúñâêôûãõ -°]+$/i", 'message' => 'Apenas letras e números.'],
            ['cpf', 'required', 'message' => 'Campo obrigatório.'],
            ['cpf', 'match', 'pattern' => "/^[1-9.-]+$/i", 'message' => 'Apanas . - e números.'],
            ['cpf', 'match', 'pattern' => "/^.{11,14}$/", 'message' => 'Tamanho entre 11 e 14 caracteres.'],
            ['instituicao', 'required', 'message' => 'Campo obrigatório.'],
            ['instituicao', 'match', 'pattern' => "/^.{3,50}$/", 'message' => 'Tamanho entre 3 e 50 caracteres.'],
            ['instituicao', 'match', 'pattern' => "/^[a-záéíóúñâêôûãõ ]+$/i", 'message' => 'Apenas letras.'],
            ['email', 'required', 'message' => 'Campo obrigatório.'],
            ['email', 'match', 'pattern' => "/^.{5,80}$/", 'message' => 'Tamanho entre 5 e 80 caracteres.'],
            ['email', 'email', 'message' => 'Formato de Email inválido.'],
            ['role', 'required', 'message' => 'Campo obrigatório.'],
        ];
    }

    public function attributeLabels() {
        return array( 
            'nome' => 'Nome Completo:',
            'username' => 'Login no sistema:',
            'cpf' => 'CPF:',
            'email' => 'E-mail:',
            'instituicao' => 'Instituicao:',
            'endereco' => 'Endereço:',
            'role' => 'Nível de acesso:',
            );
    }

   
    
}

