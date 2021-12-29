<section style="background-color: #192965; color: white; padding: 15px;" >
	<div class="container">
		<div class="row content">
			<div class="col-md-6 order-1 order-md-2" data-aos="fade-left" style="background-color: white; border-radius: 5px;">
				<div id="pie">
				</div>
			</div>
			<div class="col-md-6 pt-5 order-2 order-md-1" data-aos="fade-up">
				<h3>Presentase Kepuasan</h3>
				<p class="font-italic">
					Ini merupakan Rangkuman presentase Berdasarkan Jawaban Responden,
				</p>
				<p>
					Jawaban terdiri dari 
					<ul>
						<li>Sangat Puas, dengan point <strong>4</strong></li>
						<li>Puas, dengan point <strong>3</strong></li>
						<li>Tidak Puas, dengan point <strong>2</strong></li>
						<li>Mengecewakan, dengan point <strong>1</strong></li>
					</ul>
				</p>
			</div>
		</div>
	</div>
</section>

<?php 
//data pie
if ($hasil) {
	$h = 1;
	foreach ($hasil as $hasil) {
		$dt[$h] = [
			'nilai' => $hasil['y'],
			'label' => $hasil['name']
		];
		$h++;
	}
	$nilai_pie  = array_column($dt, 'nilai');
	$label      = array_column($dt, 'label');
}


?>

<script>
	/*pie chart*/
	var options = {
		series: <?php echo $nilai_pie == true ?  json_encode($nilai_pie) : [] ?>,
		chart: {
			width: "100%",
			type: 'pie',
		},
		labels: <?php echo $label == true ?  json_encode($label) : [] ?>,
		responsive: [{
			breakpoint: undefined,
			options: {
				chart: {
					width: 200
				},
				legend: {
					position: 'bottom'
				}
			}
		}]
	};

	var chart = new ApexCharts(document.querySelector("#pie"), options);
	chart.render();
</script>