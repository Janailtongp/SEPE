<?php

namespace app\models;

use Yii;
use yii\base\model;

class FormAlunos extends model {

    public $id_aluno;
    public $nome;
    public $sobrenome;
    public $turma;
    public $nota_final;

    public function rules() {
        return [
            ['id_aluno','integer', 'message'=>'ID incorreto.'],
            ['nome', 'required', 'message' => 'Campo obrigatório.'],
            ['nome', 'match', 'pattern' => "/^.{3,50}$/", 'message' => 'Tamanho entre 3 e 50 caracteres.'],
            ['nome', 'match', 'pattern' => "/^[a-záéíóúñâêôûãõ]+$/i", 'message' => 'Apenas letras.'],
            ['sobrenome', 'required', 'message' => 'Campo obrigatório.'],
            ['sobrenome', 'match', 'pattern' => "/^.{3,50}$/", 'message' => 'Tamanho entre 3 e 50 caracteres.'],
            ['sobrenome', 'match', 'pattern' => "/^[a-záéíóúñâêôûãõ ]+$/i", 'message' => 'Apenas letras.'],
            ['turma', 'required', 'message' => 'Campo obrigatório.'],
            ['turma', 'match', 'pattern' => "/^.{3,50}$/", 'message' => 'Tamanho entre 3 e 50 caracteres.'],
            ['turma', 'match', 'pattern' => "/^[0-9]+$/i", 'message' => 'Apenas números.'],
            ['nota_final', 'required', 'message' => 'Campo obrigatório.'],
            ['nota_final', 'match', 'pattern' => "/^.{1,4}$/", 'message' => 'Tamanho entre 1 e 4 caracteres.'],
            ['nota_final', 'match', 'pattern' => "/^[0-9,]+$/i", 'message' => 'Apenas números.'],

            
//            ['email', 'required', 'message' => 'Campo obrigatório.'],
//            ['email', 'match', 'pattern' => "/^.{5,80}$/", 'message' => 'Tamanho entre 5 e 80 caracteres.'],
//            ['email', 'email', 'message' => 'Formato de Email inválido.'],
        ];
    }

    public function attributeLabels() {
        return array( 
            'nome' => 'Nome:',
            'sobrenome' => 'Sobrenome:',
            'turma' => 'Turma:',
            'nota_final' => 'Nota Final:',
            );
    }

}

