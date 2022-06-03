
<?php

error_reporting(0);

$timezone = "Asia/Jakarta";
if (function_exists(date_default_timezone_set)) date_default_timezone_set($timezone);

$tanggalttd = $tr_mst_fppc[0]['tgl_lhu'];
$tanggalttd = date("d-m-Y", strtotime($tanggalttd));

$tanggalfppc = $tr_mst_fppc[0]['tgl_fppc'];
$tanggalfppc = date("d-m-Y", strtotime($tanggalfppc));
//$filename = ttd_rgp.'.png';
ob_start();

echo '  
    <html>
    <head><title></title>
        <style type="text/css">
    p{
        text-align:left;
        font-size:7px;
        font-family:"Times New Roman", Times, serif;
        color:#000066;
    }
    body{
        font-size:12px;
        font-family:"Times New Roman", Times, serif;    
    }
    
    table{
        border-style:none;
        border-width:thin;
        border-spacing:inherit;
    }
    hr { 
  display: block;
  margin-top: 0.5em;
  margin-bottom: 0.5em;
  margin-left: auto;
  margin-right: auto;
  border-style: double;
  border-width: 5px;
} 
        
    </style>
    
    </head>
    <body>
    <table border=0 width="100%" cellspacing="0">
    <tr><td >
    </td>
    <td></td>
    <td align=center  style="font-size:14px;"><img src="img/logokkp.jpg" alt="HTML5 Icon" style="width:70px;height:70px;">
</td>
    </tr>
  
    
    <tr><td align=LEFT width="40%" style="font-size:12px ;">Kepada :' . $tr_pelanggan[0]['nm_trader'] . ' 





    </td><td></td><td align=LEFT style="font-size:12px;"font color="red">BALAI KARANTINA IKAN, PENGENDALIAN MUTU</td></tr>
    <tr><td align=LEFT style="font-size:12px;">Issued to :' . $tr_pelanggan[0]['nm_propinsi'] . '</td><td></td><td align=Left style="font-size:12px;"font color="red">DAN KEAMANAN HASIL PERIKANAN Jakarta</td></tr>
    <tr><td></td><td></td><td align=Left style="font-size:12px;"font color="blue">LABORATORIUM PENGUJI</td></tr>
    <tr><td></td><td></td></td><td align=Left style="font-size:10px;">GEDUNG KARANTINA PERTANIAN BANDARA SOEKARNO - HATTA TANGERANG 15126, BANTEN</td></tr>
    <tr><td></td><td></td></td><td align=Left style="font-size:10px;">Telp. (021) 5507932, 55915059, Fax (021) 5506738, email : bbkipmjakarta1@kkp.go.id / bkipmj1@gmail.com</td></tr>
    <tr><td align=Left style="font-size:12px;"></td><td align=Left style="font-size:10px;"></td>website : http://kkp.go.id/bkipmJakarta</tr>
    </table>
    <br>
<hr width="50%" align="center" border-style="double">
    <br>
    <table border=0  width="100%">
        <tr><td align=center style="font-size:14px;"><u>LAPORAN HASIL UJI</u></td></tr>
        <tr><td align=center style="font-size:10px;"><i>Report Of Analysis</i></td></tr>
        <tr> <td align="center" style="font-size:10px;">No:' . $tr_mst_fppc[0]['no_lhu'] . '</td></tr>
    </table>
   

    <br>
    
   
    
 
     <table border=0  width="100%" cellspacing="0" cellpadding="6" >
     <tr><td valign="top" width="20%">Nama Pelanggan <br><i>Customer Name</i> </td>
     <td valign="top"width="10%" style="font-size:10px;">:' . $tr_pelanggan[0]['nm_trader'] . '</td></tr>
    

    
     <tr><td valign="top" width="20%">Personel yang dihubungi<br><i>Contact Person</i> </td>
     <td valign="top"width="30%" style="font-size:10px;">: ' . $tr_pelanggan[0]['nm_trader'] . '</td>
     <td valign="top" width="10%">Alamat <Br><i>Address</i> </td>
     <td valign="top"width="30%" style="font-size:10px;" >:' . $tr_pelanggan[0]['al_trader'] . '</td>
     </tr>
     <tr><td valign="top" width="0%">Jenis Contoh <br><i>Type of sample(s)</i> </td>
     <td valign="top"width="20%" style="font-size:10px;">';


$no = 1;

foreach ($jenis_sampel as $row) {

    echo '
 ' . $no . '.' . $row->nm_lokal . ' 
     <br>';

    $no++;
};

echo '


     </td></tr>
     <tr><td valign="top" width="20%">No FPPC <br><i>FPPC Number</i> </td>
     <td valign="top"width="10%" style="font-size:10px;">:' . $tr_mst_fppc[0]['no_fppc'] . '</td></tr>
     <tr><td valign="top" width="20%">Tanggal Penerimaan <br><i>Received</i> </td>
     <td valign="top"width="10%" style="font-size:10px;">:' . $tanggalfppc . '</td>
     <td valign="top" width="15%" style="font-size:10px;">Tanggal Pengujian <br><i>Date of Analysis</i>  </td>
     <td valign="top"width="10%" style="font-size:10px;" >:' . $tanggalttd . '</td>
     </tr>
    </table>

      





<table border="1" cellpadding="3" cellspacing="3" repeat_header=1 width=100% style="margin-top:10px; margin-left:0px;">
<thead>
 <tr> <th colspan="1" rowspan="2">No</th> 
 <th colspan="1" rowspan="2"><u>PARAMETER</u><br> <i> PARAMETERS</i></th> 
 <th colspan="2"><u>KODE SAMPEL</u><br> <i> CODE OF SAMPLE(S)</i></th> 
 <th colspan="1" rowspan="2"><u>HASIL UJI </u><br> <i>TEST RESULT </i></th>
 <th colspan="1" rowspan="2"><u>STANDAR MUTU </u><br> <i>QUALITY STANDAR </i></th>
 
<th colspan="1" rowspan="2"><u>SPESIFIKASI METODE</u><br> <i>METHOD SPESIFICATION </i></th>
  </tr> 
 <tr> <th><u>PELANGGAN</u> <i> PELANGGAN</i></th> <th><u>LABORATORIUM</u> <i>LABORATORY</i></th>
   </tr> 
  
</thead>';

$no = 1;

foreach ($hasil_uji as $row) {

    echo '<tr>
    <td align=right>' . $no . '</td>

    <td>' . $row->jenis_parameter . '</td>
    <td>' . $row->kode_pelanggan . '</td>
    <td>' . $row->kode_sampel . '</td>
    <td>' . $row->hasil_uji . '<sup>' . $row->hasil_uji_keterangan . '</sup></td>
        <td>' . $row->standar_uji . '</td>
    <td>' . $row->no_ikm . '/ <br> ' . $row->keterangan_uji . '</td>

    
    </tr>';
    $no++;
};



echo '
</table>
 <table border=0  width="200px" cellspacing="0" cellpadding="5" style="font-size:8px;">
    
     <tr>
        <th width="85px"></th>
        <th width="5px"></th>
        <th width="5px"></th>
        <th width="5px"></th>
        <th width="100px"></th>
    </tr>
     <tr><td valign="top" >Catatan </td>
     <td>:</td>
     <td>1.</td>
     <td></td>
     <td valign="top" >Hasil uji berlaku untuk sampel yang diuji
     <br>
     <i>These analytical results are only valid for the tested sample<i>
     </td>
     </tr>
     
      <tr><td valign="top" > </td>
     <td>:</td>
     <td>2.</td>
     <td></td>
     <td valign="top" >Laporan Hasil Uji ini terdiri dari 1(satu) halaman
     <br><i>This report of analysis consists of 1(one) page<i></td>
     </tr>
    
         <tr><td valign="top" > </td>
     <td>:</td>
     <td>3.</td>
     <td></td>
     <td valign="top" >Laporan Hasil Uji ini tidak boleh digandakan,
     <br> kecuali secara lengkap dan seiijin tertulis Laboratorium Penguji Balai KIPM Jakarta

<br><i>This report of analysis shall not be reproduced (copied)
     <Br> expect for the completed one and with the written permisssin from testing laboratory Balai KIPM Jakarta<i></td>
     </td>
     </tr>
  
    </table>

      


    
    
   <table width=100%>
  <tr>
    <td width="30%"></td>
    <td width="30%"> </td>
    <td width="30%"> </td>
   
    <td >
        
        <table>
            <tr><td width="300px">Jakarta,  ' . $tanggalttd . '</td></tr>
            <tr><td width="300px">' . $tr_setting[0]['pj_penandatangan'] . '</td></tr>
          
            <br>
            <br>
            <br>
            <tr><td><img src=' . $filename . '  width="200px" height="100px" ></img></td></tr>
            <br>
            <br>
            <tr><td width="300px">' . $tr_setting[0]['nm_penandatangan'] . '</td></tr>
              
          
        </table><br>
        <left>
          <br><br><br><br>

          ' . $pjttd . '<br>
         <br>
         </left>
    </td>
  </tr>
</table> 


  
    
   
   
    </body></html>';

$html   = ob_get_contents();
ob_end_clean();
$mpdf = new mPDF('utf-8', 'A4');

$mpdf->setFooter('Page {PAGENO} of {nb} DP/5.10.4/Balai KIPM JKT I;Rev 4;25 Januari 2019');
$mpdf->WriteHTML(utf8_encode($html));
$mpdf->Output($nama_dokumen . ".pdf", 'I');
exit;

?>

