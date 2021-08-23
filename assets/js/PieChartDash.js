function renderChart(type, dados){
	var dadosGrafico = tratarDadosGrafico(dados);
	var ctx = document.getElementById('myChart').getContext('2d');
	var myChart = new Chart(ctx, {
		type: type,
		data: dadosGrafico
	});
}

function tratarDadosGrafico(dados){
	console.log(dados);
	return {
		labels: ['0-19', '20-39', '40-59', '60-79', '80-100'],
		datasets: [{
			label: 'Índice de Manutenção Prioritária',
			data: [dados.countUm, dados.countDois, dados.countTres, dados.countQuatro, dados.countCinco],
			backgroundColor: [
				'#16f5f1',
				'#10de21',
				'#e1e810',
				'#e08610',
				'#ed2009'
			]
		}]
	};
}

function renderChartExemplo(){
	var dadosGrafico = {
		labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
		datasets: [{
			label: '# of Votes',
			data: [10, 19, 3, 5, 2, 3],
			backgroundColor: [
				'rgba(255, 99, 132)',
				'rgba(54, 162, 235)',
				'rgba(255, 206, 86)',
				'rgba(75, 192, 192)',
				'rgba(153, 102, 255)',
				'rgba(255, 159, 64)'
			],
			borderColor: [
				'rgba(255, 99, 132, 1)',
				'rgba(54, 162, 235, 1)',
				'rgba(255, 206, 86, 1)',
				'rgba(75, 192, 192, 1)',
				'rgba(153, 102, 255, 1)',
				'rgba(255, 159, 64, 1)'
			],
			borderWidth: 1
		}]
	};
	var opcoes = {
		scales: {
			y: {
				beginAtZero: true
			}
		}
	};
	
	var myChart = new Chart(ctx, {
		type: 'pie',
		data: dadosGrafico,
		options: opcoes
	});
}