<?php

require_once 'database.php';

class Core extends Database {
    
    /// INSERT
    // $value = array(
    //     "'Rodrigo'",
    //     "'email@email.com'",
    //     "'1234'"
    // );

    // $column = array(
    //     'nome'=>$value[0],
    //     'email'=>$value[1],
    //     'senha'=>$value[2],
    // );

/// UPDATE

//////////////////////////////// Apenas código /////////////////////////

function call_crud($tipo = null, $value = null, $coluna = null, $tabela = null, $where = null){

    $tabela = 'user';
    $value = array (
        'nome'=>'José');
    $coluna = array(
        'nome'=>$value
    );
    $where = array(
        'id'=>2
    );

    $db = new Database();

    $db->type = $tipo;
    $db->value = $value;
    $db->column = $coluna;
    $db->table = $tabela;
    $db->where = $where;

    if($db->crud()){
        echo "Deu tudo certo !";
    }else{
        echo "Deu ruim";
    }
}

}



    
 

