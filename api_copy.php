<?php
include "mysql_connect.php";
include "var.php";


function tipoSQL($tipoTabela, $nome_colecao) {
    switch ($tipoTabela) {
        case 0: // ordem por ID
            $sql = "SELECT * FROM `$nome_colecao` ORDER BY `$nome_colecao`.`COL 1` ASC ";
            break;
        case 1: // ordem alfabetica PT-BR
            $sql = "SELECT * FROM `$nome_colecao` ORDER BY `$nome_colecao`.`COL 4` ASC ";
            break;
        case 2: // ordem alfabetica EN
            $sql = "SELECT * FROM `$nome_colecao` ORDER BY `$nome_colecao`.`COL 5` ASC ";
            break;
        case 3: // ordem por Raridade
            $sql = "SELECT * FROM `$nome_colecao` ORDER BY `$nome_colecao`.`COL 9` ASC ";
            break;
        case 4: // ordem por Cor
            $sql = "SELECT * FROM `$nome_colecao` ORDER BY `$nome_colecao`.`COL 10` ASC ";
            break;
        case 5: // ordem por Preco
            $sql = "SELECT * FROM `$nome_colecao` ORDER BY `$nome_colecao`.`COL 10` ASC ";
            break;
    }
    return $sql;
}

function getPrecoBanco() {
    $contPage = 0; $numTotalCartas = 0; $numPage = 1; $qtComum = 0; $qtIncomum = 0; $qtRara = 0; $qtMitica = 0;
    $sql = tipoSQL(1, 'ixalan');
    $rs_cartas = mysqli_query($GLOBALS["conn"],$sql);
    $url = $GLOBALS["url"];
    $conteudoLigaMagic = file_get_contents($url);
    foreach($rs_cartas as $arrNomeCartas){
        $contPage++;
        $numTotalCartas++;
        $nomeDaCartaBR = $arrNomeCartas['COL 4'];
        $nome_colecao = $arrNomeCartas['COL 2'];
        $conteudoParteUm = "<td class='col-pcompra'>R$ ";
        $conteudoParteDois = "</td>";
        $parteUm = explode($conteudoParteUm, $conteudoLigaMagic );
        $parteDois = explode($conteudoParteDois, $parteUm[$contPage]);
        $sql2 = "UPDATE `$nome_colecao` SET `COL 14`='$parteDois[0]' WHERE `COL 4`= '$nomeDaCartaBR' ";
        $rs2 = mysqli_query($GLOBALS["conn"],$sql2);
        switch ($arrNomeCartas['COL 9']){
            case "C":
                $qtComum++;
                break;
            case "U":
                $qtIncomum++;
                break;
            case "R":
                $qtRara++;
                break;
            case "M":
                $qtMitica++;
                break;
        }
        echo "            <tr> \n";
        echo "                <td>"; echo $arrNomeCartas["id"]; echo "</td>  \n";
        echo "                <td>"; echo $arrNomeCartas["COL 4"]; echo "</td>  \n";
        echo "                <td>"; echo $arrNomeCartas["COL 5"]; echo "</td> \n";
        echo "                <td>"; echo $arrNomeCartas["COL 9"]; echo "</td> \n";
        echo "                <td>"; echo $arrNomeCartas["COL 10"]; echo "</td> \n";
        echo "                <td>R$ "; echo "$parteDois[0]"; echo "</td> \n";
        echo "            </tr>\n";

        if ($contPage % 80 == 0){
            $numPage++;
            $contPage = 0;
            $id_colecao = $GLOBALS["id_colecao"];
            $url = "https://www.ligamagic.com.br/?view=colecao/colecao&id=$id_colecao&page=$numPage&orderBy=1&modoPrecos=5";
            $conteudoLigaMagic = file_get_contents($url);
        }
    }
    $sql3 = "UPDATE `colecoes` SET `qtcomum`='$qtComum', `qtincomum`='$qtIncomum', `qtrara`='$qtRara', `qtmitica`='$qtMitica' WHERE `nomecolecao`= 'ixalan' ";
    $rs3 = mysqli_query($GLOBALS["conn"],$sql3);
}

?>