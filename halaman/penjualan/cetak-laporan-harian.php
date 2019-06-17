<?php
  session_start();
  require("../../vendor/autoload.php");
  require "../../pengaturan/pengaturan.php";
  require("../../pengaturan/helper.php");
  require("../../pengaturan/database.php");
  use Dompdf\Dompdf;
  
  $waktu = date("Y-m-d");
  if(isset($_GET['waktu']))
  {
    if(empty($_GET['waktu']) == FALSE)
    {
      $waktu = $_GET['waktu'];
    }
  }
  
  $daftar_penjualan = $db->query("SELECT a.*, (SELECT SUM(bb.hrg_jual) FROM detail_transaksi aa JOIN barang bb ON aa.kd_barang = bb.kd_barang WHERE aa.kd_transaksi = a.kd_transaksi) + b.ongkir AS total_bayar FROM transaksi a JOIN ongkir b ON a.id_ongkir = b.id_ongkir JOIN jasa_pengiriman c ON b.id_jasa = c.id_jasa JOIN kota d ON b.id_kota = d.id_kota JOIN pengguna e ON a.kd_pelanggan = e.kd_pengguna WHERE a.tgl_transaksi = DATE(:waktu) AND a.status_transaksi = 'Barang Akan Dikirimkan'", ['waktu' => $waktu])->fetchAll(PDO::FETCH_ASSOC); 
  ob_start();
?>
<html>
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
      Laporan Penjualan Harian <br/> Tanggal <?=tanggal_indo($waktu)?> 
    </div>
    <br/>
      <table id="tabel" class="tabel_laporan">
        <thead>
          <tr>
            <th>No</th>
            <th>Kode Transaksi</th>
            <th>Total Harga (Rp)</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $no = 1;
            $total = 0;
            foreach($daftar_penjualan as $i=>$d):
              $total += $d['total_bayar'];
          ?>
            <tr>
              <td><?=$no?></td>
              <td><?=$d['kd_transaksi']?></td>
              <td><?=rupiah($d['total_bayar'], "")?></td>
            </tr>
          <?php
            $no++;
            endforeach;
          ?>
          <tr>
            <td class="text-right" colspan="2"><b>Total</b></td>
            <td><?=rupiah($total, "")?></td>
          </tr>
        </tbody>
      </table>
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

$dompdf->stream("laporan-barang.pdf", array("Attachment" => false));
exit(0);

?>
