<?php
include "mysql_connect.php";

define("pl", "<br>");
echo pl;echo pl;echo pl;


$sql = "SELECT * FROM `ixalan` ORDER BY `ixalan`.`COL 4` ASC ";
$rs_cartas = mysqli_query($conn,$sql);
$numTotalCartas = 0;
$contPage = 0;
$numPage = 1;

echo pl;
echo pl;
echo "< --- pagina --- $numPage &#10507; >";
echo pl;
$id_colecao = 6197; // futuramente fazer a tabela no banco para cada colecao e trazer a que procurou dinamicamente
$nome_colecao = "ixalan"; // futuramente fazer a tabela no banco para cada colecao e trazer a que procurou dinamicamente
$nome_colecao_red = "xln";
$url = "https://www.ligamagic.com.br/?view=colecao/colecao&id=$id_colecao&page=$numPage&orderBy=1";
$conteudoLigaMagic = file_get_contents($url);
foreach($rs_cartas as $arrNomeCartas){
    // print_r($arrNomeCartas); // gps pra caso voce se perca
    echo pl;echo pl;echo pl;
    $contPage++;
    $numTotalCartas++;
    echo "$contPage. ";
    $nomeDaCartaEN = $arrNomeCartas['COL 5'];
    $nomeDaCartaBR = $arrNomeCartas['COL 4'];
    echo "EN => $nomeDaCartaEN | ";
    echo "BR => $nomeDaCartaBR";
    
    $conteudoParteUm = "<td class='col-pcompra'>R$ ";
    $conteudoParteDois = "</td>";
    
    $parteUm = explode( $conteudoParteUm , $conteudoLigaMagic );
    $parteDois = explode( $conteudoParteDois , $parteUm[$contPage]);
    echo pl;
    echo "Pagina $numPage Passo $contPage Total de Cartas $numTotalCartas ===> Preco:";
    print_r("$parteDois[0]");

    $sql2 = "UPDATE `ixalan` SET `COL 14`='$parteDois[0]' WHERE `COL 4`= '$nomeDaCartaBR' ";
    $rs2 = mysqli_query($conn,$sql2);

    if ($contPage % 80 == 0){
        $numPage++;
        echo pl;echo pl;
        echo "< --- pagina $numPage --- &#10507; >";
        echo pl;
        $contPage = 0;
        // nada abaixo desse linha do for
        $url = "https://www.ligamagic.com.br/?view=colecao/colecao&id=$id_colecao&page=$numPage&orderBy=1";
        $conteudoLigaMagic = file_get_contents($url);
    }

}
echo pl; echo pl;
echo $numTotalCartas;






// link referencia: https://www.ligamagic.com.br/?view=colecao/colecao&id=6197&page=1&orderBy=3  ->  ordem em en A-Z
// link referencia: https://www.ligamagic.com.br/?view=colecao/colecao&id=6197&page=1&orderBy=1  ->  ordem em BR A-Z
?>