<script>
	window.onload = function()
	{
		var lista = document.getElementById("contato-lista");
		lista.onchange = selecionarContato;

		function selecionarContato()
		{
			window.location="?op=config&contato_slc="+lista.value
		}
	}
</script>
<form id="config-contato" name="config_frm" action="php/editar-contato.php" method="post" enctype="multipart/form-data">
	<fieldset>
		<legend>Editar Contatos</legend>
		<div>
			<label for="contacto-lista">Contato: </label>
			<select id="contato-lista" class="cambio" name="contato_slc" required>
				<option value="">- - -</option>
				<?php include("select-email.php"); ?>
			</select>
		</div>
		<?php 
			if($_GET["contato_slc"]!=null){
				$conexao2 = conectar();
				$contato = $_GET["contato_slc"];
				$consulta_contato = "SELECT * FROM tb_contatos WHERE email='$contato'";
				//echo $consulta_contato;
				
				$executar_consulta_contato = $conexao2->query($consulta_contato);
				$registro_contato = $executar_consulta_contato->fetch_assoc();
				
				include("php/config-form.php");
				
				}
				
				include("php/mensagens.php");
		?>
		
	</fieldset>
</form>