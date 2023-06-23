<?php
	require ('db.class.php');

	// Instanciação da classe do banco de dados
	$db = new db();

	// Chamada da função de insert
	$db->insert($_REQUEST);

	// Redirecionamento para a página inicial
	header("Location: ./index.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>DentalUni</title>
		<link rel="stylesheet" type="text/css" href="./style.css">
	</head>
	<body>
		<h1>Inserido com sucesso!</h1>
		<a href="./index.php" style="font-size: 30px;">Se a página não atualizar, clique para voltar</a>
	</body>
</html>