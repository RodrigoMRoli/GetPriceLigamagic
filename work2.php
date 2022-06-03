<?php
//error_reporting(0);
include "mysql_connect.php";
$nomedacarta = $_GET["nomecarta"];

$query_cartas= "SELECT id,nome FROM  `nomecarta` ";
$rs_cartas = mysqli_query($conn,$query_cartas);
while($campo_cartas == mysqli_fetch_array($rs_cartas)){
$id_carta  = $campo_cartas['id'];		
$nomedacarta  = $campo_cartas['nome'];		



	////////////////////////// SCRIPT PARTE 1 ///////////////////////////////
	
	$nomedacarta = str_replace(' ', '%20', $nomedacarta);
	$nomedacarta = str_replace('+', '%20', $nomedacarta);
	$url = "https://www.ligamagic.com.br/?view=cards/card&card=$nomedacarta";
	$content = file_get_contents($url);
	$nomedacarta = str_replace('%20', ' ', $nomedacarta);
	$cont = 0;
	$c = 1;
	while($c != 0){
		$first_step = explode( "vetPorEdicao[$cont]=" , $content );
		$second_step = explode(";", $first_step[1]);
		$final = $second_step[0];
		$newPrice["doc$cont"] = "$final";
		$cont++;
		$c=strlen($final);
	}
	echo "<br>";
	
	
	/////////////////////////////// SCRIPT PARTE 2
	
	
	extract($newPrice);  //extract é usado para pegar os valores da array e transformar em variáveis
	unset ($newPrice);	// Pra economizar espaço no processamento do server
	$x = 0;
	while(${"doc$x"} != ""){
	$aspa='"';
	list($n,$n0,$autor,$pa,$pm,$pb,$edred,$imged,$n1,$n2,$n3,$ed,$n4) = explode("$aspa,$aspa", ${"doc$x"});
	echo "$nomedacarta<br>";
	echo "Edição: $ed <br>";
	echo "Edição Reduzida: $edred <br>";
	echo "Autor: $autor <br>";
	if ($pb == ""){
		$pb = "Carta Fora de Estoque";
	}if ($pm == ""){
		$pm = "Carta Fora de Estoque";
	}if ($pa == ""){
		$pa = "Carta Fora de Estoque";
	}
	echo "Preço Alto: $pa <br>";
	echo "Preço Médio: $pm <br>";
	echo "Preço Baixo: $pb <br>";
	echo "<br>";
	
	///////////   Conexão com Banco   ////////////
	
	$select = "SELECT * FROM cartas WHERE nome = '$nomedacarta' AND edred = '$edred'";
	$rs_pedido = mysqli_query($conn,$select);
	$resultado = mysqli_num_rows($rs_pedido);
	if ($resultado > 0){
		$queryUpdate="UPDATE `cartas` SET pa = '$pa', pm = '$pm', pb = '$pb' WHERE nome = '$nomedacarta' AND edred = '$edred'";
		$rs = mysqli_query($conn,$queryUpdate);
	}else{
		$query="INSERT INTO `cartas` ( `nome`, `ed`, `edred`, `autor`, `pa`, `pm`, `pb`) VALUES ('$nomedacarta', '$ed', '$edred', '$autor', '$pa', '$pm', '$pb');";
		$rs = mysqli_query($conn,$query);
	}
	$x++;
	}
	
	
}
?>

https://www.ligamagic.com.br/?view=colecao%2Fcolecao&orderBy=3&modoExibicao=&modoPrecos=&pgA=299&pgB=299&
pgC=802.16&pgD=1347.19&pgE=2860.12&pgF=277.33&pgG=414.54&pgH=537.48&id=6197&txtIdiomaValue=&txtEdicaoValue=&
txt_qualid=&txt_raridade=&txt_extra=&txt_carta=&txt_preco_de=&txt_preco_ate=&txt_formato=&txt_tipo=

https://www.ligamagic.com.br/?view=colecao/colecao&id=6197
https://www.ligamagic.com.br/?view=colecao/colecao&id=6197&page=2
https://www.ligamagic.com.br/?view=colecao/colecao&id=6197&page=3
https://www.ligamagic.com.br/?view=colecao/colecao&id=6197&page=4

num de paginas == numero de cards / 80
