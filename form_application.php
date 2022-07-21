<?php
include "mysql_connect.php";
var_dump($_POST);
$ed = $_POST["option"];
$sql = "SELECT nome FROM colecoes WHERE `nome_reduzido`='$ed'";
$rs = mysqli_query($GLOBALS["conn"], $sql);
var_dump($rs);
while($row = $rs->fetch_assoc()) {
    echo$row["nome"];
}
?>