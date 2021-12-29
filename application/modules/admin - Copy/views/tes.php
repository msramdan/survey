<?php 
/*$no= 1;
foreach ($rekap as $rekap) {
	$data[$no] = [
		'id_soal'	=> $rekap['id_soal'],
		'kepuasan'	=> number_format($rekap['kepuasan'],2)
	];
	$no++;
}
$kepuasan = array_column($data, 'kepuasan');

$h = 1;
foreach ($hasil as $hasil) {
  $dt[$h] = [
    'nilai' => number_format($hasil['y']),
    'label' => $hasil['name']
  ];
  $h++;
}
$nilai = array_column($dt, 'nilai');
$label  = array_column($dt, 'label');

//data pekerjaan
$l = 1;
foreach ($pendidikan as $p) {
  $pk[$l] = [
    'jumlah'            => number_format($p['jumlah']),
    'pendidikan'        => $p['pendidikan']
  ];
  $l++;
}
$j_pend     = array_column($pk, 'jumlah');
$l_pend     = array_column($pk, 'pendidikan');

echo json_encode($l_pend);*/
$data = count($pendidikan);
echo $data;
?>