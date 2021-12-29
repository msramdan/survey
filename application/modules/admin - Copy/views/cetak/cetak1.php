   <!DOCTYPE html>
   <html>
   <head>
     <title>Cetak</title>
   </head>
   <body>
    <?php 
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename= SURVEY_KEPUASAN_MASYARAKAT_PER_RESPONDEN.xls");
    ?>
    <div class="table-responsive">
      <table class="table" border="1" style="border-collapse: collapse;" >
        <thead>
          <tr>
            <th class="text-center" rowspan="2" style="vertical-align: middle;">No</th>
            <th class="text-center" width="50%" rowspan="2" style="vertical-align: middle;">Unsur Pelayanan</th>
            <th class="text-center" rowspan="1" colspan="4">Jumlah Responden Yang Menjawab (orang)</th>
            <th class="text-center" rowspan="2" style="vertical-align: middle;">Nilai Rata2</th>
            <th class="text-center" rowspan="2" style="vertical-align: middle;">Kategori Mutu</th>
            <th class="text-center" rowspan="2" style="vertical-align: middle;">Prioritas</th>
          </tr>
          <tr>
           <th class="text-center" width="10%" style="vertical-align: middle;">Sangat Puas</th>
           <th class="text-center" width="10%" style="vertical-align: middle;" >Puas</th>
           <th class="text-center" width="10%" style="vertical-align: middle;">Kurang Puas</th>
           <th class="text-center" width="10%" style="vertical-align: middle;" >Kecewa</th>
         </tr>
       </thead>
       <tbody>
        <?php 
        $no = 1;
        foreach ($rekap as $data): 
          $kepuasan = $data['kepuasan'];
          if ($kepuasan >= 1 && $kepuasan <= 2.5996 ) {
            $index = 'D';
          }else if($kepuasan >= 2.60 && $kepuasan <= 3.064){
            $index = 'C';
          }else if($kepuasan >= 3.0644 && $kepuasan < 3.532){
            $index = 'B';
          } else if($kepuasan >= 3.5324 && $kepuasan <= 4){
            $index = 'A';
          } else {
            $index = null;
          }
          ?>
          <tr>
            <td class="text-center" style="font-weight: bold;"><?php echo $data['id_soal'] ?></td>
            <td  style="font-weight: bold;"><?php echo $data['kategori'] ?></td>
            <td style="text-align: center;"><?php echo $data['sp'] != null ? '<strong>'.$data['sp'].'</strong>' : '-' ?></td>
            <td style="text-align: center;"><?php echo $data['p'] != null ? '<strong>'.$data['p'].'</strong>' : '-' ?></td>
            <td style="text-align: center;"><?php echo $data['tp'] != null ? '<strong>'.$data['tp'].'</strong>' : '-' ?></td>
            <td style="text-align: center;"><?php echo $data['kec'] != null ? '<strong>'.$data['kec'].'</strong>' : '-' ?></td>
            <td class="text-center" style="font-weight: bold;"><?php echo $data['kepuasan'] ?></td>
            <td  class="text-center" style="font-weight: bold;text-align: center;"><?php echo $index ?></td>
            <td class="text-center" style="font-weight: bold;text-align: center;"><?php echo $data['prioritas'] ?></td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>
</body>
</html>

