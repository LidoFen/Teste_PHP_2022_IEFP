<?php

require_once 'connection.php';


class Vinha {

    function getAnos($idVinha) {
        global $conn;
        $msg = "<option value='-1' disabled selected>Escolha uma opção</option>";
    
        
        $sql1 = "SELECT ano_p_colheita FROM vinha WHERE id = " . $idVinha;
        $result1 = $conn->query($sql1);
    
        if ($result1->num_rows > 0) {
            $row1 = $result1->fetch_assoc();
            $ano_p_colheita = $row1['ano_p_colheita'];
    
            
            $sql = "SELECT id, descricao FROM ano WHERE descricao >= $ano_p_colheita ORDER BY descricao ASC";
            $result = $conn->query($sql);
    
            if ($result->num_rows > 0) {
                
                while ($row = $result->fetch_assoc()) {
                    $msg .= "<option value='" . $row['id'] . "'>" . $row['descricao'] . "</option>";
                }
            } else {
                $msg = "<option value='-1' disabled>Sem Tipos Registados</option>";
            }
        } else {
            $msg = "<option value='-1' disabled>Ano de colheita não encontrado</option>";
        }
    
        $conn->close();

        $resp = json_encode(array("msg" => $msg, "ano" => $ano_p_colheita));
    
        return ($resp);
    }  

    function getCastas() {

        global $conn;
        $msg = "";
        $msg1 = "";

        $sql = "SELECT id, descricao FROM castas";
        $result = $conn->query($sql);


        

        if ($result->num_rows > 0) {
        // output data of each row
            while($row = $result->fetch_assoc()) {
                $msg .= "<div class='form-check'>
                        <input class='form-check-input' type='checkbox' value='".$row['id']."' id='casta".$row['id']."'>
                        <label class='form-check-label' for=''>
                            ".$row['descricao']." 
                        </label>
                        </div>";
            }
        } else {
            $msg = "Sem tipos de Castas registados!";
        }



        $sql1 = "SELECT id, descricao FROM castas";
        $result1 = $conn->query($sql1);



        if ($result1->num_rows > 0) {
            // output data of each row
            while($row = $result1->fetch_assoc()) {
                $msg1 .= "<div class='form-check'>
                        <input class='form-check-input' type='checkbox' value='".$row['id']."' id='castaEdit".$row['id']."'>
                        <label class='form-check-label' for=''>
                            ".$row['descricao']." 
                        </label>
                        </div>";
            }
        } else {
            $msg1 = "Sem tipos de Castas registados!";
        }

        $conn->close();

        $resp = json_encode(array("msg" => $msg, "msg1" => $msg1));

        return ($resp);
    }

    function uploads($foto, $descricaoVinha){


        $dir = "../fotoVinhas/".$descricaoVinha."/";
        $dir1 = "fotoVinhas/".$descricaoVinha."/";
        $flag = false;
        $targetBD = "";
    
        if(!is_dir($dir)){
            if(!mkdir($dir, 0777, TRUE)){
                die ("Erro, não é possivel criar o diretório");
            }
        }
      if(array_key_exists('fotoVinha', $foto)){
        if(is_array($foto)){
          if(is_uploaded_file($foto['fotoVinha']['tmp_name'])){
            $fonte = $foto['fotoVinha']['tmp_name'];
            $ficheiro = $foto['fotoVinha']['name'];
            $end = explode(".",$ficheiro);
            $extensao = end($end);
    
            $newName = "foto_".$descricaoVinha."_dataEnv_".date("Ymd_H_i_s").".".$extensao;
    
            $target = $dir.$newName;
            $targetBD = $dir1.$newName;
    
            $flag = move_uploaded_file($fonte, $target);
            
          } 
        }
      }
        return (json_encode(array(
            "flag" => $flag,
            "target" => $targetBD
        )));
    
    
    }

    function updateVinhaImg($diretorio, $lastInsertedId){

        global $conn;
        $msg = "";
        $flag = true;

        $sql = "UPDATE vinha SET foto = '".$diretorio."' WHERE id =".$lastInsertedId;

        if ($conn->query($sql) === TRUE) {
            $msg = "Foto adicionada com sucesso";
        } else {
            $flag = false;
            $msg = "Error: " . $sql . "<br>" . $conn->error;
        }
          

        $resp = json_encode(array(
            "flag" => $flag,
            "msg" => $msg
        ));

        return ($resp);
    }

    function registaVinha($descricaoVinha, $hectaresVinha, $dataPlantacaoVinha, $anoPrimeiraColheitaVinha, $foto, $castas){

        global $conn;
        $msg = "";
        $flag = true;

    
        $sql = "INSERT INTO vinha (descricao, ha, data_plantacao, ano_p_colheita) VALUES ('".$descricaoVinha."', '".$hectaresVinha."', '".$dataPlantacaoVinha."', '".$anoPrimeiraColheitaVinha."')";
        

        if ($conn->query($sql) === TRUE) {


            $ultimoID = mysqli_insert_id($conn);

    
    
            $msg = "Vinha registada com sucesso";
            $resp = $this->uploads($foto, $descricaoVinha);
    
            $res = json_decode($resp, TRUE);
    
            if($res['flag']){
                $this->updateVinhaImg($res['target'], $ultimoID);
            }

        } else {
            $flag = false;
            $msg = "Erro: " . $sql . "<br>" . $conn->error;
        }

        $castas1 = json_decode($castas);

        foreach ($castas1 as $casta) {
            $sql1 = "INSERT INTO vinhas_castas (id_vinha, id_casta) VALUES ('".$ultimoID."', '".$casta."')";
            if ($conn->query($sql1) !== TRUE) {
                $flag = false;
                $msg .= "Erro: " . $sql1 . "<br>" . $conn->error;
            }
        }
    
        $resp = json_encode(array(
            "flag" => $flag,
            "msg" => $msg
        ));
    
        return ($resp);    
    }
    
    function getListaVinhas() {


        global $conn;
        $msg = "";
        

        $sql = "SELECT id, descricao, ha, data_plantacao, ano_p_colheita, foto FROM vinha";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $msg .= "<tr>";
                $msg .= "<td><img src='".$row['foto']."' width='200px' height='150px' style='border: 2px solid #333333; border-radius: 10px;'></td>";
                $msg .= "<td>".$row['id']."</td>";
                $msg .= "<td>".$row['descricao']."</td>";
                $msg .= "<td>".$row['ha']."</td>";
                $msg .= "<td>".$row['data_plantacao']."</td>";
                $msg .= "<td>".$row['ano_p_colheita']."</td>";
                $msg .= "<td><button class='btn btn-primary' onclick='getDadosCastas(".$row['id'].")'>+</td>";
                $msg .= "<td><button class='btn btn-warning' onclick = 'getDadosVinha(".$row['id'].")'><i class='bi bi-pencil-fill'></i></button></td>";
                $msg .= "<td><button class='btn btn-danger' onclick = 'removerVinha(".$row['id'].")'><i class='bi bi-trash-fill'></i></button></td>";
                $msg .= "<tr>";

            }
        } else {
            $msg .= "<tr>";
            $msg .= "<td></td>";
            $msg .= "<td></td>";
            $msg .= "<td></td>";
            $msg .= "<td></td>";
            $msg .= "<td>Sem Resultados!</td>";
            $msg .= "<td></td>";
            $msg .= "<td></td>";
            $msg .= "<td></td>";
            $msg .= "<td></td>";
            $msg .= "</tr>";
        }

        $conn->close();
    
        return ($msg);
    }

    function removerVinha($id) {
        global $conn;
        $msg = "";
        $flag = true;
    
        
        $sql = "SELECT id_vinha FROM vindima WHERE id_vinha = " . $id;
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
            $flag = false;
            $msg = "Não é possível remover a vinha porque está associada a vindimas.";
        } else {
            $sql = "DELETE FROM vinha WHERE id = " . $id;
    
            if ($conn->query($sql) === TRUE) {
                $msg = "Vinha removida com sucesso";
            } else {
                $flag = false;
                $msg = "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    
        $conn->close();
    
        $res = json_encode(array(
            "flag" => $flag,
            "msg" => $msg
        ));
    
        return ($res);
    }

    function getDadosVinha($id){
    
        global $conn;

        $conn->set_charset("utf8");
        
        $row = "";
        $msg = "";

    
        $sql = "SELECT * FROM vinha WHERE id = ".$id;
        $result = $conn->query($sql);

       
    
        if ($result->num_rows > 0) {
            // output data of each row
            $row = $result->fetch_assoc();
    
        }
    
        $conn->close();
    
        $result = array('dadosVinha' => $row);
    
        return json_encode($result);
    }

    function guardaEditVinha($idVinha, $descricaoVinha, $hectaresVinha, $dataPlantacaoVinha, $anoPrimeiraColheitaVinha, $foto, $castas) {
        global $conn;
        $msg = "";
        $flag = true;
    
        $sql = "UPDATE vinha SET descricao = '".$descricaoVinha."',
            ha = '".$hectaresVinha."',
            data_plantacao = '".$dataPlantacaoVinha."',
            ano_p_colheita = '".$anoPrimeiraColheitaVinha."'
        WHERE id = '".$idVinha."'";
    
        if ($conn->query($sql) === TRUE) {
            $msg = "Vinha modificada com sucesso";
            $resp = $this->uploads($foto, $descricaoVinha);
            $res = json_decode($resp, TRUE);
    
            if ($res['flag']) {
                $this->updateVinhaImg($res['target'], $idVinha);
            }
        } else {
            $flag = false;
            $msg = "Erro: " . $sql . "<br>" . $conn->error;
        }

        $castas1 = json_decode($castas);
    
        
        $sqlApagar = "DELETE FROM vinhas_castas WHERE id_vinha = '".$idVinha."'";
        if ($conn->query($sqlApagar) !== TRUE) {
            $flag = false;
            $msg .= "Erro: " . $sqlApagar . "<br>" . $conn->error;
        }
    
        
        foreach ($castas1 as $casta) {
            $sqlInserir = "INSERT INTO vinhas_castas (id_vinha, id_casta) VALUES ('".$idVinha."', '".$casta."')";
            if ($conn->query($sqlInserir) !== TRUE) {
                $flag = false;
                $msg .= "Erro: " . $sqlInserir . "<br>" . $conn->error;
            }
        }
    
        $resp = json_encode(array(
            "flag" => $flag,
            "msg" => $msg
        ));

        $conn->close();
    
        return $resp;
    }

    function getDadosCastas($id) {
        

        
        global $conn;
        $row = "";
        $msg = "";


    
    
        $sql = "SELECT vinhas_castas.id_casta, castas.descricao FROM vinhas_castas INNER JOIN castas ON vinhas_castas.id_casta = castas.id WHERE vinhas_castas.id_vinha = ".$id;
    
        $result = $conn->query($sql);
    

    
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $msg .= "<tr>";
                $msg .= "<td>".$row['id_casta']."</td>";
                $msg .= "<td>".$row['descricao']."</td>";
                $msg .= "</tr>";
            }
        } else {
            $msg .= "<tr>";
            $msg .= "<td>SEM DADOS</td>";
            $msg .= "<td></td>";
            $msg .= "</tr>";
        }
    
        $conn->close();
    
        return $msg;
    }

    function getVinhasSelect(){
    
        global $conn;

        $conn->set_charset("utf8");
        
        $msg = "<option value='-1' selected disabled>Escolha uma opção</option>";

    
        $sql = "SELECT id, descricao FROM vinha";
        $result = $conn->query($sql);

       
    
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $msg .= "<option value='".$row['id']."'>".$row['descricao']."</option>";
            }
            } else {
                $msg = "<option value='-1' disabled>Sem Tipos Registados</option>";
            }
    
        $conn->close();
    
        
    
        return ($msg);
    }

    function registaVindima($idVinha, $idFuncionario, $kg, $dataHora, $anoVindima, $novoAnoVindima) {

        global $conn;
        $msg = "";
        $flag = true;
        $nome = "";
    
        $total = floor($kg / 2);
    
        
        if ($novoAnoVindima !== null && $novoAnoVindima !== 0) {
            
            $sqlInsertAno = "INSERT INTO ano (descricao) VALUES ('".$novoAnoVindima."')";
            if ($conn->query($sqlInsertAno) === TRUE) {
                
                $anoVindima = $conn->insert_id;
            } else {
                $flag = false;
                $msg = "Erro ao adicionar o ano: " . $conn->error;
            }
        }
    
        $sql1 = "SELECT descricao FROM vinha WHERE id = ".$idVinha;
        $result = $conn->query($sql1);
    
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $descricaoVinha = $row['descricao'];
    
            $sql2 = "SELECT descricao FROM ano WHERE id = ".$anoVindima;
            $result2 = $conn->query($sql2);
    
            if ($result2->num_rows == 1) {
                $row2 = $result2->fetch_assoc();
                $anoDescricao = $row2['descricao'];
    
                $nome = $descricaoVinha . " " . $anoDescricao;
    
                $sql = "INSERT INTO vindima (id_vinha, id_funcionario, kg, dth, id_ano) VALUES ('".$idVinha."', '".$idFuncionario."', '".$kg."', '".$dataHora."', '".$anoVindima."')";
    
                if ($conn->query($sql) === TRUE) {
                    $sql = "INSERT INTO vinhos (total, id_vindima, nome) VALUES ('".$total."', LAST_INSERT_ID(), '".$nome."')";
    
                    if ($conn->query($sql) === TRUE) {
                        $msg = "Vindima e vinho adicionados com sucesso";
                    } else {
                        $flag = false;
                        $msg = "Erro ao adicionar o vinho: " . $conn->error;
                    }
                } else {
                    $flag = false;
                    $msg = "Erro ao adicionar a vindima: " . $conn->error;
                }
            } else {
                $flag = false;
                $msg = "Ano não encontrado ou mais de um ano com o mesmo ID.";
            }
        } else {
            $flag = false;
            $msg = "Vinha não encontrada ou mais de uma vinha com o mesmo ID.";
        }
    
        $resp = json_encode(array(
            "flag" => $flag,
            "msg" => $msg
        ));
    
        return ($resp);
    }
    
    function getListaVindimas() {

        global $conn;
        $msg = "";
        

        $sql = "SELECT
        vinha.foto AS foto,
        vindima.id AS idVindima,
        vinha.descricao AS nomeVinha,
        funcionarios.nome AS nomeFuncionario,
        vindima.kg,
        vindima.dth AS dataHora,
        ano.descricao AS ano,
        estado_funcionario.id AS idEstado
        FROM
        vinha INNER JOIN vindima ON vinha.id = vindima.id_vinha
        INNER JOIN funcionarios ON vindima.id_funcionario = funcionarios.bi
        INNER JOIN ano ON vindima.id_ano = ano.id
		INNER JOIN estado_funcionario ON funcionarios.id_estado = estado_funcionario.id ORDER BY idVindima ASC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $msg .= "<tr>";
                $msg .= "<td><img src='".$row['foto']."' width='200px' height='150px' style='border: 1px solid #444444; border-radius: 10px;'></td>";
                $msg .= "<td>".$row['idVindima']."</td>";
                $msg .= "<td>".$row['nomeVinha']."</td>";
                $msg .= "<td>".$row['nomeFuncionario']."</td>";
                $msg .= "<td>".$row['kg']."</td>";
                $msg .= "<td>".$row['dataHora']."</td>";
                $msg .= "<td>".$row['ano']."</td>";
                if($row['idEstado'] == 2) {
                    $msg .= "<td><button class='btn btn-danger' onclick = 'removerVindima(".$row['idVindima'].")'><i class='bi bi-trash-fill'></i></button></td>";
                } else {
                    $msg .= "<td></td>";
                }
                $msg .= "<tr>";

            }
        } else {
            $msg .= "<tr>";
            $msg .= "<td></td>";
            $msg .= "<td></td>";
            $msg .= "<td></td>";
            $msg .= "<td></td>";
            $msg .= "<td>Sem Resultados!</td>";
            $msg .= "<td></td>";
            $msg .= "<td></td>";
            $msg .= "</tr>";
        }

        $conn->close();
    
        return ($msg);

    }
    
    function getStock() {

        global $conn;
        $msg = "";
        

        $sql = "SELECT vinhos.id AS id_vinho, vinhos.total, vinha.id AS id_vinha, vinhos.nome FROM vinhos INNER JOIN vindima ON vinhos.id_vindima = vindima.id INNER JOIN vinha ON vindima.id_vinha = vinha.id ORDER BY id_vinho ASC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $msg .= "<tr>";
                $msg .= "<td>".$row['id_vinho']."</td>";
                $msg .= "<td>".$row['nome']."</td>";
                $msg .= "<td>".$row['total']." garrafas</td>";;
                $msg .= "<td><button class='btn btn-primary' onclick='getDadosCastas(".$row['id_vinha'].")'>+</button></td>";
                $msg .= "<td>
                            <div class='col-md-6'>
                                <div class='input-group'>
                                    <span class='input-group-btn'>
                                        <button class='btn btn-dark' type='button' onclick='decrementarValor(".$row['id_vinho'].")'>-</button>
                                    </span>
                                    <input type='number' class='form-control' value='0' id='quantidadeVendaGarrafas".$row['id_vinho']."'>
                                        <button class='btn btn-dark' type='button' onclick='incrementarValor(".$row['id_vinho'].")'>+</button>
                                        <button class='btn btn-success mp-3' onclick='abaterGarrafa(".$row['id_vinho'].")'>Abater</button>
                                    </span>
                                </div>
                            </div>
                        </td>
                        <td>
                            
                        </td>";
                $msg .= "<tr>";

            }
        } else {
            $msg .= "<tr>";
            $msg .= "<td></td>";
            $msg .= "<td></td>";
            $msg .= "<td></td>";
            $msg .= "<td></td>";
            $msg .= "</tr>";
        }

        $conn->close();
    
        return ($msg);

    }

    function abaterGarrafa($idVinho, $quantidade) {

        global $conn;
        $msg = "";
        $flag = true;

        $quantidadeKG = $quantidade * 2;

        $sql = "UPDATE vinhos
        SET total = total - ".$quantidade."
        WHERE id = ".$idVinho;

        $sql1 = "UPDATE vindima
        SET kg = kg - ".$quantidadeKG."
        WHERE id = ".$idVinho;
    
        if ($conn->query($sql) === TRUE) {
            $msg = "Stock abatido com sucesso";
        } else {
            $flag = false;
            $msg = "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    
        $res = json_encode(array(
            "flag" => $flag,
            "msg" => $msg
        ));
    
        return ($res);


    }

    function getAnos1() {

        global $conn;
        $msg = "<option value='-1' selected disabled>Escolha uma opção</option>";

        $sql = "SELECT id, descricao FROM ano";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
                while($row = $result->fetch_assoc()) {
                    $msg .= "<option value='".$row['id']."'>".$row['descricao']."</option>";
                }
        } else {
            $msg = "Sem Anos registados!";
        }


        $conn->close();


        return ($msg);

    }

    function filtraVinhoAno($idAno) {

        global $conn;
        $msg = "";
        

        $sql = "SELECT ano.id AS idAno, vinhos.id AS id_vinho, vinhos.total, vinha.id AS id_vinha, vinhos.nome FROM vinhos INNER JOIN vindima ON vinhos.id_vindima = vindima.id INNER JOIN vinha ON vindima.id_vinha = vinha.id INNER JOIN ano ON vindima.id_ano = ano.id WHERE ano.id =".$idAno;
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $msg .= "<tr>";
                $msg .= "<td>".$row['id_vinho']."</td>";
                $msg .= "<td>".$row['nome']."</td>";
                $msg .= "<td>".$row['total']." garrafas</td>";;
                $msg .= "<td><button class='btn btn-primary' onclick='getDadosCastas(".$row['id_vinha'].")'>+</td>";
                $msg .= "<td>
                            <div class='col-md-6'>
                                <div class='input-group'>
                                    <span class='input-group-btn'>
                                        <button class='btn btn-dark' type='button' onclick='decrementarValor(".$row['id_vinho'].")'>-</button>
                                    </span>
                                    <input type='number' class='form-control' value='0' id='quantidadeVendaGarrafas".$row['id_vinho']."'>
                                        <button class='btn btn-dark' type='button' onclick='incrementarValor(".$row['id_vinho'].")'>+</button>
                                        <button class='btn btn-success mp-3' onclick='abaterGarrafa(".$row['id_vinho'].")'>Abater</button>
                                    </span>
                                </div>
                            </div>
                        </td>
                        <td>
                            
                        </td>";
                $msg .= "<tr>";

            }
        } else {
            $msg .= "<tr>";
            $msg .= "<td colspan='5' class='error-cell'>";
            $msg .= "<div class='centered-text'>Não foi possível encontrar resultados.</div>";
            $msg .= "</td>";
            $msg .= "</tr>";
        }

        $conn->close();
    
        return ($msg);

    }

    function removerVindima($id) {
        global $conn;
        $msg = "";
        $flag = true;

        $sql = "DELETE FROM vindima WHERE id = " . $id;
    
        if ($conn->query($sql) === TRUE) {
                $msg = "Vindima removida com sucesso";
        } else {
                $flag = false;
                $msg = "Error: " . $sql . "<br>" . $conn->error;
        }
        
    
        $conn->close();
    
        $res = json_encode(array(
            "flag" => $flag,
            "msg" => $msg
        ));
    
        return ($res);
    }

}




?>

