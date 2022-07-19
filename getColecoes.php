<?php
include "mysql_connect.php";

$url = "C:\wamp64\www\GetPriceLigamagic\colecoes.php";
$content = file_get_contents($url);

$contentBreak = explode('value="', $content);

foreach($contentBreak as $key => $value){
    $newContent = strstr($value, '"', true);
    if(strlen($newContent<10)){
        echo "$newContent";
        echo "<br>";
        $sql = "SELECT * FROM `colecoes` WHERE `nome_reduzido`='$newContent'";
        $rs = mysqli_query($GLOBALS["conn"], $sql);
        if($rs->num_rows > 0){
            echo "ERRO: Nome ja Existe";
        } else {
            $sql = "INSERT INTO `colecoes`(`nome_reduzido`) VALUES ('$newContent')";
            $rs = mysqli_query($GLOBALS["conn"], $sql);
            echo "$newContent foi inserido no banco de dados";
        }
    }
}

// script utilizado para colocar todos os nomes de colecoes no banco de dados
?>