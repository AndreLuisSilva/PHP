<?php 
error_reporting(E_ALL ^ E_NOTICE);
$op = $_GET["op"];
switch($op){
	
	case "importarCSV":
		$conteudo = "php/importarCSV.php";
		$titulo = "Importa CSV";
		break;
		
	default	:
		$conteudo = "php/home.php";
		$titulo = "Sistema PHP";
		break;
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8" />
<title><?php echo $titulo; ?> </title>
<link rel="stylesheet" href="css/meu-contato.css" />
<link rel="stylesheet" href="css/jquery-ui.css" />

<script src="js/jquery.js"> </script>	
<script src="js/jquery-ui.js"> </script>
<script src="js/traducao.js"> </script>
<script src="js/meu-contato.js"> </script>

</head>

<body>
<section id="conteudo">
<nav>
<ul>
<a class="config" href="index.php"><li> Home </li></a>
<a class="config" href="?op=importarCSV"><li> Importar CSV </li></a>
<img src="img/logo_sebem.png" class="imagem"/>
</ul>

</nav>
<section id="principal">
<?php include($conteudo); ?>
</section>

</section>

</body>
</html>