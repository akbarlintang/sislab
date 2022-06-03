
<?php
$tgl_sertifikat = date("d-M-Y", strtotime($data_pelanggan[0]['tgl_sertifikat']));
$tgl_berakhir   = date("d-M-Y", strtotime($data_pelanggan[0]['tgl_berakhir']));

error_reporting(0);

$timezone = "Asia/Jakarta";
if(function_exists(date_default_timezone_set)) date_default_timezone_set($timezone);

$ttd_rgp = ttd_rgp.'.png';
$logokkp = logokkp.'.png';
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
        font-size:14px;
        font-family:"Times New Roman", Times, serif;    
    }
    
    table{
        border-style:none;
        border-width:thin;
        border-spacing:inherit;
    }
    hr.new1 {
  border-top: 4px solid black;
}
        
    </style>
    
    </head>
    <body>
    <table width="100%" cellspacing="0" border="0" colspan="2">
    <tr> <td rowspan="9"> <img src='.$logokkp.'  width="120px" height="120px" ></img></td>
    <tr><td  align=center style="font-size:18px;font-weight:bold;" "font-weight:bold;"   font color="blue" >KEMENTERIAN KELAUTAN DAN PERIKANAN
    </td>
    </tr>
    
    <tr><td align=center style="font-size:16px;font-weight:bold;" font color="blue">BADAN KARANTINA IKAN, PENGENDALIAN MUTU  
    </td></tr>
    
    <tr><td align=center style="font-size:16px;font-weight:bold;"font color="blue">DAN KEAMANAN HASIL PERIKANAN</td></tr>
    
    <tr><td align=center style="font-size:14px;font-weight:bold;"font color="blue">BALAI KARANTINA IKAN, PENGENDALIAN MUTU </td></tr>
    <tr><td align=center style="font-size:14px;font-weight:bold;"font color="blue">DAN KEAMANAN HASIL PERIKANAN SEMARANG</td></tr>
    <tr><td align=center style="font-size:12px;">Jl. Dr. Suratmo Nomor 28 Kelurahan Kembangarum Semarang 50183</td></tr>
    <tr><td align=center style="font-size:12px;">Telepon : 024 76671020 (LACAK) Fax : 024 76671020</td></tr>
    <tr><td align=center style="font-size:12px;">Pos Elektronik: lapor.bkipmsemarang@kkp.go.id LAMAN: www.kkp.go.id/bkipmsemarang</td></tr>
   
    
    </table>
    <hr class="new1">
    <br>
 
  
   
    


 
    
  <table width=100%>
<tr>
    <td align="center"><h2  align=center>SURAT KETERANGAN HASIL SURVEILAN</h2></td>
</tr> 
<tr>
    <td align="center"><h3  align=center>Nomor :'.$data_pelanggan[0]['no_skhs'].'</h3></td>
    </tr> 
<tr><td align="center"><h4  align=center>Diberikan Kepada:</h4></td></tr> 
<tr><td align="center"><h4  align=center></h4>'.$data_pelanggan[0]['nm_upi'].'</td></tr> 
<tr><td align="center"><h4  align=center></h4>'.$data_pelanggan[0]['al_upi'].'</td></tr> 


</table>


      <br>
       
      <br>
     
      <br>
       <table width="100%" border="0">
    <tr><td align=center style="font-size:14px;">Dinyatakan memenuhi persyaratan sesuai Laporan Hasil Surveilan yang mencakup penerapan GMP,SSOP dan HACCP serta berhak mendapatkan pelayanan <i> health Certificate </i> (HC) untuk jenis produk:</td></tr> 
    </table>
    
         
    <br>
    




<table border="1" cellpadding="3" cellspacing="3" repeat_header=1 width=100% style="margin-top:10px; margin-left:70px;">
<thead>
<tr>
<th style="text-align:center; font-weight:bold;">No</td>
<th style="text-align:center; font-weight:bold;">Ruang Lingkup</td>

</tr>
</thead>';

$no = 1;

foreach ($ruanglingkup as $row) {
                       
    echo '<tr>
    <td align=right>'.$no.'</td>
    <td>'.$row->nm_lokal.' <br></td>
    </tr>';
    $no++;
};



echo '
</table>

    <br>
   
    
   <table border=0  width="100%" cellspacing="0" cellpadding="2" 
              style="font-family:Times New Roman ;font-size:14px;" >
     <tr><td valign="top" width="60px"> </td><td valign="top">:</td> <td valign="top">1.</td>

     <td valign="top" text-align="justify">Sertifikat ini berlaku selama '.$data_pelanggan[0]['masa_berlaku'].' ('.$kata_bulan.'), bulan, dari tanggal '.$tgl_sertifikat.' s/d '.$tgl_berakhir.'</td>
     </tr>
     <tr></tr>
     <tr></tr>
     <tr></tr>
     <tr></tr>
     <tr></tr>
     <tr></tr>
            <tr><td> </td><td></td><td valign="top">2.</td>
            <td valign="top" text-align="justify"> Pelaksanaan Surveilan berikutnya dijadwalkan tanggal '.$tgl_berakhir.' </td></tr>

    

    </table>
    <br>
        <br>
            <br>
   <table width=100%>
  <tr>
    <td width="30%">
    </td>

    <td width="30%">

    </td>
     <td >
      
        <table>
            <tr><td width="200px">Semarang,  '.$tgl_sertifikat.'</td></tr>
            <tr><td width="60px">Kepala UPT KIPM</td></tr>
            <tr><td><img src='.$ttd_rgp.'  width="140px" height="60px" ></img></td></tr>
             
          
        </table><br>
        <left>

           '.$setting_skhs[0]['nm_penandatangan'].'<br>
         <br>
         </left>
    </td>
  </tr>
</table> 


  <table width=100%>
  <tr>

     <td >
        
    
         <table width="60%" cellspacing="0" >
    <tr><td rowspan="6" width="15%" align=center><img src='.$filename.'  width="60px" height="60px" ></img></td>
      
    
    <tr><td align=left style="font-size:9px;font-weight:bold; ">Untuk Perhatian:</td></tr>
     <tr><td align=left style="font-size:9px;font-weight:bold;">Dilarang memberikan sesuatu</td></tr>
     <tr><td align=left style="font-size:9px;font-weight:bold;">yang dapat menimbulkan GRATIFIKASI</td></tr>
    
    </table>
     
    </td>
  </tr>
</table>    
    
   
   
    </body></html>';

$html   = ob_get_contents();
ob_end_clean();
$mpdf = new mPDF('utf-8','A4');

$mpdf->setFooter('Page {PAGENO} of {nb} DP/5.5.21/BKIPM-SMG');
$mpdf->WriteHTML(utf8_encode($html));
$mpdf->Output($nama_dokumen.".pdf",'I');
exit;
?>

