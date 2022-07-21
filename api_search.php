<?php

include "mysql_connect.php";
include "var.php";

// DO NOT TELETE THIS! -> CREATE TABLE IF NOT EXISTS `ixalan` (`id` int(3) NOT NULL AUTO_INCREMENT,`COL 1` varchar(5) DEFAULT NULL,`COL 2` varchar(6) DEFAULT NULL,`COL 3` varchar(5) DEFAULT NULL,`COL 4` varchar(35) DEFAULT NULL,`COL 5` varchar(27) DEFAULT NULL,`COL 6` varchar(5) DEFAULT NULL,`COL 7` varchar(5) DEFAULT NULL,`COL 8` varchar(5) DEFAULT NULL,`COL 9` varchar(5) DEFAULT NULL,`COL 10` varchar(6) DEFAULT NULL,`COL 11` varchar(6) DEFAULT NULL,`COL 12` varchar(6) DEFAULT NULL,`COL 13` varchar(6) DEFAULT NULL,`COL 14` varchar(10) DEFAULT NULL,`COL 15` varchar(10) DEFAULT NULL,`COL 16` varchar(10) DEFAULT NULL,PRIMARY KEY (`id`)) ENGINE=MyISAM AUTO_INCREMENT=301 DEFAULT CHARSET=utf8;

function fixAcento($string) {
    // til ; cedilha
    $stringfix = str_replace('&ccedil;', "ç", $string);
    $stringfix = str_replace('&atilde;', "ã", $string);
    $stringfix = str_replace('&otilde;', "õ", $string);
    // agudos
    $stringfix = str_replace('&aacute;', "á", $string);
    $stringfix = str_replace('&eacute;', "é", $string);
    $stringfix = str_replace('&iacute;', "í", $string);
    $stringfix = str_replace('&oacute;', "ó", $string);
    $stringfix = str_replace('&uacute;', "ú", $string);
    // circunflexos
    $stringfix = str_replace('&acirc;', "â", $string);
    $stringfix = str_replace('&ecirc;', "ê", $string);
    $stringfix = str_replace('&icirc;', "î", $string);
    $stringfix = str_replace('&ocirc;', "ô", $string);
    $stringfix = str_replace('&ucirc;', "û", $string);
    return $stringfix;
}

function getPrecoBanco($nome_colecao_red) {
    $sql = "SHOW TABLES LIKE '$nome_colecao_red'";
    $rs_cartas = mysqli_query($GLOBALS["conn"],$sql);
    if ($rs_cartas->num_rows !== 1){
        $createTable = "CREATE TABLE IF NOT EXISTS `$nome_colecao_red` (`id` int NOT NULL AUTO_INCREMENT,`COL 1` varchar(50) DEFAULT NULL,`COL 2` varchar(100) DEFAULT NULL,`COL 3` varchar(10) DEFAULT NULL,`COL 4` varchar(50) DEFAULT NULL,`COL 5` varchar(50) DEFAULT NULL,`COL 6` varchar(5) DEFAULT NULL,`COL 7` varchar(5) DEFAULT NULL,`COL 8` varchar(5) DEFAULT NULL,`COL 9` varchar(5) DEFAULT NULL,`COL 10` varchar(6) DEFAULT NULL,`COL 11` varchar(6) DEFAULT NULL,`COL 12` varchar(6) DEFAULT NULL,`COL 13` varchar(6) DEFAULT NULL,`COL 14` varchar(10) DEFAULT NULL,`COL 15` varchar(10) DEFAULT NULL,`COL 16` varchar(10) DEFAULT NULL,PRIMARY KEY (`id`)) ENGINE=MyISAM DEFAULT CHARSET=utf8;";
        $rs_createTable = mysqli_query($GLOBALS["conn"], $createTable);
    }
    $quota = '"';
    $url = "https://www.ligamagic.com.br/?view=cards%2Fsearch&card=ed%3D$nome_colecao_red+searchprod%3D0&tipo=1";
    $conteudoLigaMagic = file_get_contents($url);
    $inicioJSON = strstr($conteudoLigaMagic, 'var cardsjson = ');
    $inicioJSON = str_replace('var cardsjson = ', "", $inicioJSON);
    $inicioJSON = str_replace(';', "", $inicioJSON);
    $finalJSON = strstr($inicioJSON, 'edc.edicao = ', true);
    $obj = json_decode($finalJSON);
    foreach($obj as $e){
        $sqlEdicao = "UPDATE `colecoes` SET `ide_edicao`='$e->IDE_Edicao' WHERE `nome_reduzido`='$nome_colecao_red'";
        $rsGetIDE_Edicao = mysqli_query($GLOBALS["conn"], $sqlEdicao);
        $checkIfExists = "SELECT * FROM `$nome_colecao_red` WHERE `COL 5`=$quota$e->sNomeIngles$quota";
        $rs_checkIfExists = mysqli_query($GLOBALS["conn"], $checkIfExists);
        if ($rs_checkIfExists->num_rows > 0){
            $update = "UPDATE `$nome_colecao_red` SET `COL 14`='$e->precoMenor', `COL 15`='$e->precoMedio', `COL 16`='$e->precoMaior' WHERE `COL 5`= $quota$e->sNomeIngles$quota ";
            $rs_update = mysqli_query($GLOBALS["conn"], $update);
        } else {
            $insert = "INSERT INTO `$nome_colecao_red`(`COL 1`,`COL 3`, `COL 4`, `COL 5`, `COL 14`, `COL 15`, `COL 16`) VALUES ($quota$e->IDE_Edicao$quota, $quota$nome_colecao_red$quota, $quota$e->sNomePortugues$quota,$quota$e->sNomeIngles$quota, $quota$e->precoMenor$quota, $quota$e->precoMedio$quota, $quota$e->precoMaior$quota)";
            $rs_insert = mysqli_query($GLOBALS["conn"], $insert);
        }
    }
}

function makeTable($nome_colecao_red){
    $sql = "SELECT * FROM $nome_colecao_red";
    $rs = mysqli_query($GLOBALS["conn"], $sql);
    while($row = $rs->fetch_assoc()) {
        echo "            <tr> \n";
        echo "                <th scope='row'>"; echo $row["id"]; echo "</th>  \n";
        echo "                <td>"; echo $row["COL 4"]; echo "</td>  \n";
        echo "                <td>"; echo $row["COL 5"]; echo "</td> \n";
        echo "                <td>R$ "; echo $row["COL 14"]; echo "</td> \n";
        //echo "                <td>R$ "; echo $row["COL 15"]; echo "</td> \n";
        echo "                <td>R$ "; echo $row["COL 16"]; echo "</td> \n";
        echo "            </tr>\n";
    }
}
?>