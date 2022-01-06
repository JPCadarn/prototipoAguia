<?php

class AgendamentoService{
	public static function renderCardsAgendamentoAgrupado($groupAgendamento){
        $conexao = new Conexao();

        echo "<div class='row collapsible-row'>";
        foreach($groupAgendamento as $agendamento){
			$imagem = $conexao->executarQuery("SELECT imagem FROM imagens_pontes WHERE ponte_id = {$agendamento['ponte_id']} ORDER BY id ASC LIMIT 1");
			if(isset($imagem[0]['imagem'])){
				$imagem = $imagem[0]['imagem'];
			}else{
				$imagem = '';
			}
			echo "<div class='col s12 m4'>";
			echo "<div class='card medium'>";
			echo "<div class='card-image'>";
			echo "<img src='assets/fotos/$imagem'>";
			echo "</a>";
			echo "<span class='card-title'>{$agendamento['nome']}</span>";
			echo "</div>";
			echo "<div class='card-content'>";
			echo "<p>{$agendamento['detalhes']}</p>";
			echo "<p>".Utils::formataData($agendamento['data'])." - ".$agendamento['horario']." - ID ".$agendamento['id']."</p>";
			// echo "<p><b>Status: </b>{$agendamento['descrica']}</p>";
			echo "</div>";
			echo "</div>";
			echo "</div>";
		}
        echo "</div>";
    }
}

?>