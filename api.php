<?php
include "mysql_connect.php";
include "var.php";


$sql = "SELECT * FROM `$nome_colecao` ORDER BY `$nome_colecao`.`COL 4` ASC ";
$rs_cartas = mysqli_query($conn,$sql);
$conteudoLigaMagic = file_get_contents($url);
print_r($rs_cartas);
foreach($rs_cartas as $arrNomeCartas){
    echo "$arrNomeCartas[0] | ";
    echo "$arrNomeCartas[2] | ";
    echo "$arrNomeCartas[3] | ";
    echo "$arrNomeCartas[4] | ";
    echo "$arrNomeCartas[5] | ";
    echo "$arrNomeCartas[9] | ";
    echo "$arrNomeCartas[10] | ";
    echo "$arrNomeCartas[14] | ";
    $contPage++;
    $numTotalCartas++;
    $nomeDaCartaBR = $arrNomeCartas['COL 4'];
    $conteudoParteUm = "<td class='col-pcompra'>R$ ";
    $conteudoParteDois = "</td>";
    $parteUm = explode($conteudoParteUm, $conteudoLigaMagic );
    $parteDois = explode($conteudoParteDois, $parteUm[$contPage]);
    $sql2 = "UPDATE `$nome_colecao` SET `COL 14`='$parteDois[0]' WHERE `COL 4`= '$nomeDaCartaBR' ";
    $rs2 = mysqli_query($conn,$sql2);
    if ($contPage % 80 == 0){
        $numPage++;
        $contPage = 0;
        $url = $url;
        $conteudoLigaMagic = file_get_contents($url);
    }
}
?>