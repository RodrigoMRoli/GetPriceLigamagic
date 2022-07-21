<?php
include "mysql_connect.php";

$url = "C:\wamp64\www\GetPriceLigamagic\colecoes.php";
$content = file_get_contents($url);

$getNomeReduzido = explode('value="', $content);
$getNome = explode('">', $content);

foreach($getNomeReduzido as $key => $value){
    $nomeEdicaoReduzida = strstr($value, '"', true);
    if(strlen($nomeEdicaoReduzida<10)){
        $tempNome = strstr($getNome[$key], '</option>', true);
        $sql = "INSERT INTO `colecoes`(`nome_reduzido`, `nome`) VALUES ('$nomeEdicaoReduzida', '$tempNome')";
        $rs = mysqli_query($GLOBALS["conn"], $sql);
        echo "<br>";
        echo "<br>";
        echo "DEGUB:";
        echo "<br>";
        echo "$nomeEdicaoReduzida || $tempNome";
        echo "<br>";
        echo "<br>";
    }
}
// script utilizado para colocar todos os nomes de colecoes no banco de dados
?>