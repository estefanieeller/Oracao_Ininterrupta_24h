<?php
require_once("conexao.php");
$dados = selecionarLista("oracao");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Oração Ininterrupta 24H</title>
	<style type="text/css">
		* {
			box-sizing: border-box;
			font-family: sans-serif;
			font-size: 10px;
			outline: none;
		}
		body {
			padding: 120px 0px;
		}

		header {
			text-align: center;
		}
		header h1, header h2 {
			font-size: 13px;
		}

		table {
			border-collapse: collapse;
			width: 100%;
			max-width: 800px;
			margin: auto;
		}
		table td {
			padding: 0px;
		}
		table thead td {
			font-weight: bold;
			background-color: #cecece;
			height: 30px;
			text-align: center;
		}
		table td.hour {
			text-align: center;
		}
		table td input {
			width: 100%;
			padding: 2px;
			border-radius: 0;
			border: none;
		}

		#success {
			display: none;
		}
		#success-box {
			position: fixed;
			z-index: 999999999;
			top: 10px;
			right: 10px;
			width: 130px;
			background-color: green;
			display: flex;
			flex-direction: row;
			justify-content: center;
			align-items: center;
			gap: 10px;
			color: #FFFFFF;
			padding: 10px;
			border-radius: 10px;
		}
	</style>
</head>
<body>

	<header>
		<h1>Período de Oração Ininterrupta 24H</h1>
		<h2>Igreja Cristã Maranata - Campinas - São José/SC</h2>
	</header>

	<table border="1">
		<thead>
			<tr>
				<td>Horário</td>
				<td>Nome</td>
				<td>Horário</td>
				<td>Nome</td>
			</tr>
		</thead>
		<tbody>
			<?php
			for ($i=0; $i < count($dados); $i++) {
				if ($i == 0) { echo "<tr>"; }
				if ($linha == 2) { echo "</tr><tr>"; $linha = 0; }
			?>
				<td class="hour"><?= $dados[$i]['horario']; ?></td>
				<td><input class="name-prayer" type="text" data-uid="<?= $dados[$i]['codigo']; ?>" value="<?= $dados[$i]['nome']; ?>"></td>
			<?php
				$linha++;
			}
			?>
		</tbody>
	</table>

	<div id="success">
	<div id="success-box">
		<div>
			<svg width="20px" viewBox="0 0 24 24" fill="none">
				<path fill-rule="evenodd" clip-rule="evenodd" d="M2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12ZM15.7071 9.29289C16.0976 9.68342 16.0976 10.3166 15.7071 10.7071L12.0243 14.3899C11.4586 14.9556 10.5414 14.9556 9.97568 14.3899L8.29289 12.7071C7.90237 12.3166 7.90237 11.6834 8.29289 11.2929C8.68342 10.9024 9.31658 10.9024 9.70711 11.2929L11 12.5858L14.2929 9.29289C14.6834 8.90237 15.3166 8.90237 15.7071 9.29289Z" fill="currentColor"/>
			</svg>
		</div>
		<div>Nome gravado!</div>
	</div>
	</div>

	<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
	<script>
		function handleNamePrayer() {
			let s_ID = $(this).attr("data-uid");
			let s_Name = $(this).val();
			$.ajax({
				type: "GET",
				dataType: "json",
				cache: false,
				url: "save.php",
				data: { id: s_ID, name: s_Name },
				success: function(data) {
					if (data.nome == s_Name) {
						$("#success").show();
						setTimeout(function(){ $("#success").hide(); }, 2000);
					}
				},
				error: function(e) {
					alert("Houve um erro! Tente novamente.");
				}
			});
		}
		$(".name-prayer").on("change keyup", handleNamePrayer);
	</script>

</body>
</html>
