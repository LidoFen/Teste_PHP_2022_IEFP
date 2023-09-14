<?php

require_once '../model/modelVinha.php';

$vinha = new Vinha();

if ($_POST['op'] == 1) {

    $res = $vinha -> getAnos($_POST['idVinha']);

    echo ($res);

}else if ($_POST['op'] == 2) {

    $res = $vinha -> getCastas();

    echo ($res);
}else if ($_POST['op'] == 3) {

    $res = $vinha->registaVinha(
        $_POST['descricaoVinha'],
        $_POST['hectaresVinha'],
        $_POST['dataPlantacaoVinha'],
        $_POST['anoPrimeiraColheitaVinha'],
        $_FILES,
        $_POST['castas']

    );

    echo ($res);
}else if($_POST['op'] == 4){

    $res = $vinha -> getListaVinhas();
    echo($res);

}else if($_POST['op'] == 5){

    $res = $vinha -> removerVinha($_POST['id']);

    echo($res);

}else if($_POST['op'] == 6){

    $res = $vinha -> getDadosVinha($_POST['id']);
    echo($res);

}else if($_POST['op'] == 7){

    $res = $vinha->guardaEditVinha(
        $_POST['id'],
        $_POST['descricao'],
        $_POST['hectares'],
        $_POST['dataPlantacao'],
        $_POST['anoPrimeiraColheita'],
        $_FILES,
        $_POST['castas']
    );

    echo($res);

}else if($_POST['op'] == 8){

    $res = $vinha -> getDadosCastas($_POST['id']);
    
    echo($res);

}else if($_POST['op'] == 9){

    $res = $vinha -> getVinhasSelect();
    echo($res);

}else if ($_POST['op'] == 10) {
    $novoAnoVindima = isset($_POST['novoAnoVindima']) ? intval($_POST['novoAnoVindima']) : null;

    $res = $vinha->registaVindima(
        $_POST['idVinha'],
        $_POST['idFuncionario'],
        $_POST['kg'],
        $_POST['dataHora'],
        $_POST['anoVindima'],
        $novoAnoVindima

    );

    echo ($res);
}else if($_POST['op'] == 11){

    $res = $vinha -> getListaVindimas();
    echo($res);

}else if ($_POST['op'] == 12) {

    $res = $vinha -> getStock();

    echo ($res);
}else if ($_POST['op'] == 13) {

    $res = $vinha -> abaterGarrafa($_POST['idVinho'], $_POST['quantidade']);

    echo ($res);
}else if ($_POST['op'] == 14) {

    $res = $vinha -> getAnos1();

    echo ($res);
}else if ($_POST['op'] == 15) {

    $res = $vinha -> filtraVinhoAno($_POST['idAno']);

    echo ($res);
}else if($_POST['op'] == 16){

    $res = $vinha -> removerVindima($_POST['id']);

    echo($res);

}



?>