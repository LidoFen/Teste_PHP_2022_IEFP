<?php

require_once '../model/modelFuncionario.php';

$funcionario = new Funcionario();

if ($_POST['op'] == 1) {

    $res = $funcionario -> getEstados();

    echo ($res);

}else if ($_POST['op'] == 2) {

    $res = $funcionario->registaFuncionario(
        $_POST['bi'],
        $_POST['nome'],
        $_POST['morada'],
        $_POST['telefone'],
        $_POST['email'],
        $_POST['salario'],
        $_POST['estado'],
        $_POST['ipRegisto']
    );

    echo ($res);
}else if($_POST['op'] == 3){

    $res = $funcionario -> getListaFuncionariosInativos();

    echo($res);

}else if($_POST['op'] == 4){

    $res = $funcionario -> mudarEstado($_POST['bi']);
    
    echo($res);

}else if($_POST['op'] == 5){

    $res = $funcionario -> getListaFuncionariosAtivos();

    echo($res);

}else if($_POST['op'] == 6){

    $res = $funcionario -> getListaFuncionarios();

    echo($res);

}else if($_POST['op'] == 7){

    $res = $funcionario -> apresentaBotao($_POST['biFuncionario']);

    echo($res);

}

?>