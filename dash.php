<?php
	require_once('conexao.php');
	require_once('utils.php');
	require_once('RankeamentoService.php');
	require_once('SessionService.php');
	SessionService::validarLoginFeito();
	$conexao = new Conexao();
	
	$inspecoes = $conexao->executarQuery('
			SELECT 
				i.*,
				p.nome AS ponte_nome
			FROM inspecoes i
			INNER JOIN pontes p ON i.ponte_id = p.id
			LEFT JOIN usuarios ON p.id_usuario = usuarios.id 
			LEFT JOIN clientes ON usuarios.id_cliente = clientes.id
			WHERE clientes.id = '.SessionService::getIdCliente());
	$rankeamento = new RankeamentoService($inspecoes);
	Utils::navBar();
?>
<!DOCTYPE html>
<html>
	<head>
		<!--Import Google Icon Font-->
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<!--Import materialize.css-->
		<link type="text/css" rel="stylesheet" href="assets/materialize/css/materialize.min.css"  media="screen,projection"/>
		<link rel="stylesheet" href="assets/css/main.css">
		<!--Let browser know website is optimized for mobile-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js"></script>
		<script type="text/javascript" src="assets/js/PieChartDash.js"></script>
		<link rel="icon" href="assets/Logo/logo_novo_clean.png" type="image/x-icon">
		<title>Infrasil - O portal da infraestrutura brasileira</title>
	</head>
	<body>
		<div class="row container">
			<div class="col s12 m5">
				<?php
					if(count($inspecoes)){
						$rankeamento->renderRankeamentos();
					}
				?>
			</div>
			<div class="col s12 m5 offset-m2">
				<canvas id="myChart"></canvas>
				<?php
					if(count($inspecoes)){
						$rankeamento->renderGrafico();
					}
				?>
			</div>
		</div>
		
		<!--JavaScript at end of body for optimized loading-->
		<script type="text/javascript" src="assets/js/jquery-3.4.1.js"></script>
		<script type="text/javascript" src="assets/materialize/js/materialize.min.js"></script>
		<script type="text/javascript" src="assets/js/main.js"></script>
	</body>
</html>