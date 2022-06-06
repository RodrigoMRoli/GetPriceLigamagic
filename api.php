<?php
include "mysql_connect.php";
include "var.php";


$sql = "SELECT * FROM `$nome_colecao` ORDER BY `$nome_colecao`.`COL 4` ASC ";
$rs_cartas = mysqli_query($conn,$sql);
$conteudoLigaMagic = file_get_contents($url);
foreach($rs_cartas as $arrNomeCartas){
    echo $arrNomeCartas["id"]; echo " | ";
    echo $arrNomeCartas["COL 2"]; echo " | ";
    echo $arrNomeCartas["COL 3"]; echo " | ";
    echo $arrNomeCartas["COL 4"]; echo " | ";
    echo $arrNomeCartas["COL 5"]; echo " | ";
    echo $arrNomeCartas["COL 9"]; echo " | ";
    echo $arrNomeCartas["COL 10"]; echo " | ";
    echo $arrNomeCartas["COL 14"]; echo " | ";
    echo pl;
    echo pl;
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