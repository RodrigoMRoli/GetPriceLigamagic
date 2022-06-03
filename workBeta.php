<?php
error_reporting(0);
include "mysql_connect.php";
$ne = 60;
$nomedacarta = $_GET["nomecarta"];

$select = "SELECT nome FROM cartas WHERE nome = '$nomedacarta'";
$rs_pedido = mysqli_query($conn,$select);
$resultado = mysqli_num_rows($rs_pedido);
echo $resultado.'<br>';
if ($resultado > 0){
	echo "Carta já registrada, atualizando o preço";
}else{
	$query="INSERT INTO `cartas` (`ID`, `nome`, `edicao`, `edicaored`, `extra0`, `extra1`, `extra2`, `extra3`, `extra4`, `extra5`, `extra6`, `extra7`, `extra8`, `extra9`, `extra10`, `extra11`, `extra12`) VALUES (NULL, '$nomedacarta', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');";
	$rs = mysqli_query($conn,$query);
	echo "$nomedacarta";
	echo " inserida com sucesso";
	}

	$nomedacarta = str_replace(' ', '%20', $nomedacarta);
	$nomedacarta = str_replace('+', '%20', $nomedacarta);
	$url = "https://www.ligamagic.com.br/?view=cards/card&card=$nomedacarta";
	$content = file_get_contents($url);
	$nomedacarta = str_replace('%20', ' ', $nomedacarta);

	for ($x = 0; $x < $ne; $x++){
	$first_step = explode( "<td id='omoPrimeMenor_$x' class='menor-preco' width='74' align='center'>" , $content );
	$second_step = explode(" </td>", $first_step[1]);
	$final = $second_step[0];
	$c = strlen($final);
    print_r($final)
	if ($c >= 1 && $c <= 10){
		$a = "UPDATE cartas SET extra$x = '$final' WHERE nome = '$nomedacarta'";
		$b = mysqli_query($conn,$a);
		var_dump($final);
	}else if ($c >= 11){
		$first_step = explode( "<td id='omoPrimeMenor_$x' class='menor-preco' width='74' align='center'>" , $content );
		$second_step = explode(" <a href=", $first_step[1]);
		$final = str_replace('-', 'NULL', $second_step[0]);
		$a = "UPDATE cartas SET extra$x = '$final' WHERE nome = '$nomedacarta'";
		$b = mysqli_query($conn,$a);
		var_dump($final);
	}else{
		$x = $ne;
	}
}
?>