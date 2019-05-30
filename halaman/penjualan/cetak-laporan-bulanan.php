<?php
  session_start();
  require("../../vendor/autoload.php");
  require "../../pengaturan/pengaturan.php";
  require("../../pengaturan/helper.php");
  require("../../pengaturan/database.php");
  use Dompdf\Dompdf;
  
  $judul = "Laporan Penjualan Barang";  
  $ket_waktu = "";
  $waktu = date("Y-m-d");
  if(isset($_GET['waktu']))
  {
    if(empty($_GET['waktu']) == FALSE)
    {
      $waktu = $_GET['waktu'];
    }
  }
  
  $ket_waktu_tmp = explode(" ", tanggal_indo($waktu));
  $ket_waktu = $ket_waktu_tmp[1]." ".$ket_waktu_tmp[2];
  
  $daftar_penjualan = $db->query("SELECT DAY(a.tgl_transaksi) AS tgl, 
                                    SUM(b.ongkir) AS ongkir,
                                    SUM(c.jumlah) AS jumlah,
                                    SUM((c.jumlah * d.hrg_jual)) AS total   
                                     FROM transaksi a 
                                    JOIN ongkir b ON a.id_ongkir = b.id_ongkir 
                                    JOIN detail_transaksi c ON a.kd_transaksi = c.kd_transaksi 
                                    JOIN barang d ON c.kd_barang = d.kd_barang 
                                    WHERE a.status_transaksi = 'Barang Akan Dikirimkan' AND 
                                    MONTH(a.tgl_transaksi) = MONTH(:waktu) AND YEAR(a.tgl_transaksi) = YEAR(:waktu) GROUP BY DAY(a.tgl_transaksi)", ['waktu' => $waktu])->fetchAll(PDO::FETCH_ASSOC);  
  ob_start();
?>

<html>
  
  <!-- Bagian head -->
  <head>
    <link rel="stylesheet" type="text/css" href="<?=$alamat_web?>/assets/css/css-tabel-laporan.css">
  </head>
  
  <body>
    <div class="judul">
      <?=$nama_perusahaan?>
    </div>
    <div class="sub-judul">
      <?=$alamat_perusahaan?> 
    </div>
    <div class="sub-judul">
      Laporan Penjualan Bulanan <br/> <?=$ket_waktu?> 
    </div>
    <br/>
    <table id="tabel" class="tabel_laporan">
      <thead>
        <tr>
          <th>No</th>
          <th>Tanggal</th>
          <th>Jumlah</th>
          <th>Total Harga (Rp)</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $no = 1;
          $jml = 0;
          $total_hrg = 0;
          foreach($daftar_penjualan as $i=>$d):
            $jml += $d['jumlah'];
            $total_hrg += $d['total']+$d['ongkir'];
        ?>
            <tr>
              <td><?=$no?></td>
              <td><?=$d['tgl']?></td>
              <td><?=$d['jumlah']?></td>
              <td><?=rupiah(($d['total']+$d['ongkir']), "")?></td>
            </tr>
        <?php
          $no++;
          endforeach;
        ?>
        <tr>
          <td class="text-right" colspan="2"><b>Total</b></td>
          <td><?=$jml?></td>
          <td><?=rupiah($total_hrg, "")?></td>
        </tr>
      </tbody>
    </table>
    <!-- Akhir dari Bagian tabel -->
    <div style="width: 300px;margin-top: 50px;margin-right: -50px; float: right;text-align: center;">
      <?=$kota_perusahaan?>, <?=date("d/m/Y")?> <br/> <br/> <br/> <br/> <?=$nama_pimpinan?> 
    </div>
  </body>
</html>
<?php
  $content = ob_get_clean();
  // instantiate and use the dompdf class
  $dompdf = new Dompdf();
  $dompdf->loadHtml($content);
  
  // (Optional) Setup the paper size and orientation
  $dompdf->setPaper('A4', 'portrait');
  
  // Render the HTML as PDF
  $dompdf->render();
  
  $dompdf->stream("laporan-bulanan.pdf", array("Attachment" => false));
  exit(0);

?>
