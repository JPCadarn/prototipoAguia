<?php
    require_once('conexao.php');
    require_once('utils.php');
    require_once('SessionService.php');

    if(!isset($_POST['estado']) && !isset($_POST['cidade'])){
        header('Location: index.php');
    }

	SessionService::setVisitante(true);
    $conexao = new Conexao();
    $pontes = $conexao->executarQuery("SELECT * FROM pontes WHERE estado = '".$_POST['estado']."' AND cidade ='".$_POST['cidade']."'");
?>
<!DOCTYPE html>
<html>
	<?php
		Utils::tagHead();
	?>
	<body>
		<?php
			Utils::navBar();
			echo "<div class='row'>";
			if(count($pontes)){
				foreach($pontes as $ponte){
					$imagem = $conexao->executarQuery("SELECT imagem FROM imagens_pontes WHERE ponte_id = {$ponte['id']} ORDER BY id ASC LIMIT 1");
					if(isset($imagem[0]['imagem'])){
						$imagem = $imagem[0]['imagem'];
					}else{
						$imagem = '';
					}
					echo "
							<div class='col s12 m3'>
								<div class='card medium'>
									<div class='card-image'>
										<img src='assets/fotos/$imagem'>
									</div>
									<div>
										<div class='card-content'>
											<span class='card-title'>{$ponte['nome']}</span>
											<p>{$ponte['resumo']}</p>
										</div>
										<div class='card-action center'>
											<a href='ponteDetalhes.php?id={$ponte['id']}'><i class='material-icons tooltipped indigo-text text-darken-4' data-position='bottom' data-tooltip='Detalhes'>info</i></a>
											<a target='_blank' href='pontesRelatorio.php?id={$ponte['id']}'><i class='material-icons tooltipped indigo-text text-darken-4' data-position='bottom' data-tooltip='Relatório'>print</i></a>
										</div>
									</div>
								</div>
							</div>
					";
				}
			}else{
				echo "<h6 class='centralizar'>Nenhuma ponte cadastrada";
			}
		?>
		</div>  
		
		<?php
		Utils::scriptsJs();
		?>
		<script type='text/javascript' src='assets/js/cidades.js'></script>
	</body>
</html>