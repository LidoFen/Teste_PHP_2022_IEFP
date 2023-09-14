<?php

require_once 'connection.php';


class Funcionario {

    function getEstados() {

        global $conn;
        $msg = "<option value='-1' disabled selected>Escolha uma opção</option>";

        $sql = "SELECT id, descr FROM estado_funcionario";
        $result = $conn->query($sql);

        

        if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $msg .= "<option value='".$row['id']."'>".$row['descr']."</option>";
        }
        } else {
            $msg = "<option value='-1' disabled>Sem Estados Registados</option>";
        }

        $conn->close();

        return ($msg);
    }

    function registaFuncionario($bi, $nome, $morada, $telefone, $email, $salario, $estado, $ipRegisto){

        global $conn;
        $msg = "";
        $flag = true;
    
        $sql = "INSERT INTO funcionarios (bi, nome, morada, telefone, email, salario, id_estado) VALUES ('".$bi."', '".$nome."', '".$morada."', '".$telefone."', '".$email."', '".$salario."', '".$estado."')";
        $sql1 = "INSERT INTO registolocalizacao (ip, id_funcionario, data) VALUES ('".$ipRegisto."', '".$bi."', NOW());";
        if ($conn->query($sql) === TRUE && $conn->query($sql1)) {
    
            $msg = "Funcionário registado com sucesso";

        } else {
            $flag = false;
            $msg = "Erro: " . $sql . "<br>" . $conn->error;
        }
    
        $resp = json_encode(array(
            "flag" => $flag,
            "msg" => $msg
        ));
    
        return ($resp);    
    }

    function getListaFuncionariosInativos() {


        global $conn;
        $msg = "";
        

        $sql = "SELECT funcionarios.bi, funcionarios.nome, funcionarios.morada, funcionarios.telefone, funcionarios.email, funcionarios.salario, estado_funcionario.descr FROM funcionarios, estado_funcionario WHERE funcionarios.id_estado = estado_funcionario.id AND estado_funcionario.descr LIKE 'Inativo'";
        $result = $conn->query($sql);



        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $msg .= "<tr>";
                $msg .= "<td>".$row['bi']."</td>";
                $msg .= "<td>".$row['nome']."</td>";
                $msg .= "<td>".$row['morada']."</td>";
                $msg .= "<td>".$row['telefone']."</td>";
                $msg .= "<td>".$row['email']."</td>";
                $msg .= "<td>".$row['salario']."</td>";
                $msg .= "<td>".$row['descr']."</td>";
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

    function mudarEstado($bi) {

        global $conn;
        $flag = true;

        $sql1 = "SELECT funcionarios.id_estado FROM funcionarios WHERE funcionarios.bi =".$bi;
        $result1 = $conn->query($sql1);

        if ($result1->num_rows > 0) {
            while($row = $result1->fetch_assoc()) {
            
                if($row['id_estado'] == 1) {
                    $sql = "UPDATE funcionarios
                    SET id_estado = 2
                    WHERE bi = '".$bi."'";
                    $result = $conn->query($sql);
                    if ($conn->query($sql) === TRUE) {
        
        
                        $msg = "Estado alterado com sucesso";
            
                    } else {
                        $flag = false;
                        $msg = "Erro: " . $sql . "<br>" . $conn->error;
                    }
                } else {
                    $sql = "UPDATE funcionarios
                    SET id_estado = 1
                    WHERE bi = '".$bi."'";
                    $result = $conn->query($sql);
                    if ($conn->query($sql) === TRUE) {
        
        
                        $msg = "Estado alterado com sucesso";
            
                    } else {
                        $flag = false;
                        $msg = "Erro: " . $sql . "<br>" . $conn->error;
                    }
                }
            }

        }
    
        $resp = json_encode(array(
            "flag" => $flag,
            "msg" => $msg
        ));

        return ($resp); 

    }

    function getListaFuncionariosAtivos() {


        global $conn;
        $msg = "<option value='-1' disabled selected>Escolha uma opção</option>";
        

        $sql = "SELECT funcionarios.bi, funcionarios.nome, funcionarios.morada, funcionarios.telefone, funcionarios.email, funcionarios.salario, estado_funcionario.descr FROM funcionarios, estado_funcionario WHERE funcionarios.id_estado = estado_funcionario.id AND estado_funcionario.descr LIKE 'Ativo'";
        $result = $conn->query($sql);



        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $msg .= "<option value='".$row['bi']."'>".$row['nome']."</option>";

            }
        } else {
            $msg = "<option value='-1' disabled>Sem Funcionários Ativos</option>";
        }

        $conn->close();
    
        return ($msg);
    }

    function getListaFuncionarios() {


        global $conn;
        $msg = "<option value='-1' disabled selected>Escolha uma opção</option>";
        

        $sql = "SELECT funcionarios.bi, funcionarios.nome, funcionarios.morada, funcionarios.telefone, funcionarios.email, funcionarios.salario, estado_funcionario.descr FROM funcionarios, estado_funcionario WHERE funcionarios.id_estado = estado_funcionario.id";
        $result = $conn->query($sql);



        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $msg .= "<option value='".$row['bi']."'>".$row['nome']."</option>";

            }
        } else {
            $msg = "<option value='-1' disabled>Sem Funcionários Registados</option>";
        }

        $conn->close();
    
        return ($msg);
    }

    function apresentaBotao($biFuncionario) {

        global $conn;
        $msg = "";


        $sql = "SELECT * 
        FROM funcionarios WHERE bi =".$biFuncionario;
        $result = $conn->query($sql);
        

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                if($row['id_estado'] == 2) {
                    $msg = "<button class='btn btn-success ms-3' onclick='mudarEstado(".$row['bi'].")'>Ativar</button>";  
                } else if($row['id_estado'] == 1) {
                    $msg = "<button class='btn btn-danger ms-3' onclick='mudarEstado(".$row['bi'].")'>Desativar</button>";  
                }

            }
        } else {
            $msg = "<button class='btn btn-light' onclick='mudarEstado()'>Erro</button>";
        }

        $conn->close();
    
        return ($msg);
    
    
    }


}
?>