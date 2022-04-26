<fieldset>
	<legend>Importar CSV</legend>
	<form action="/gelopar/php/teste.php" method="POST" enctype="multipart/form-data">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<input type="file" name="arquivo" id="arquivo" class="arquivo" onchange="pegaCSV(this)" />
		<label>
			<input type="file" name="file" id="inputCSV" onchange="pegaCSV(this)"> </label>
		<button type="submit" class="importar" name="file">Importar</button>
		<div id="CSVsaida"></div>		
	</form>
</fieldset>

<script>
window.onload = function() {
	var lista = document.getElementById("consulta-lista");
	lista.onchange = function() {
		window.location = "?op=consultas&consulta_slc=" + lista.value;
	};
}
var leitorDeCSV = new FileReader();
window.onload = function init() {
	leitorDeCSV.onload = leCSV;
}

function pegaCSV(inputFile) {
	var file = inputFile.files[0];
	leitorDeCSV.readAsText(file);
}

function leCSV(evt) {
	var fileArr = evt.target.result.split('\n');
	var strDiv = '<table>';
	for(var i = 0; i < fileArr.length; i++) {
		strDiv += '<tr>';
		var fileLine = fileArr[i].split(',');
		for(var j = 0; j < fileLine.length; j++) {
			strDiv += '<td>' + fileLine[j].trim() + '</td>';
		}
		strDiv += '</tr>';
	}
	strDiv += '</table>';
	var CSVsaida = document.getElementById('CSVsaida');
	CSVsaida.innerHTML = strDiv;
}
$('.btn').on('click', function() {
	$('.arquivo').trigger('click');
});
$('.arquivo').on('change', function() {
	var fileName = $(this)[0].files[0].name;
	$('#file').val(fileName);
});
</script>