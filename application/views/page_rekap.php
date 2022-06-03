
<?php

error_reporting(0);

$timezone = "Asia/Jakarta";
if (function_exists(date_default_timezone_set)) date_default_timezone_set($timezone);

$tanggalttd = $tr_mst_fppc[0]['tgl_lhu'];
$tanggalttd = date("d M Y", strtotime($tanggalttd));

$tanggalfppc = $tr_mst_fppc[0]['tgl_fppc'];
$tanggalfppc = date("d M Y", strtotime($tanggalfppc));
//$filename = ttd_rgp.'.png';

$baseurl = base_url();
ob_start();

echo '  
    <html>
    <head>
        <title></title>
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
        <div>
            <div style="width: 15%; float: left;">
                <div align="center"><img src="' . $baseurl . 'assets/kkp.png" width="120px"></div>
            </div>
            <div style="width: 85%; float: left; text-align: center;">
                <div>
                    <div style="font-size: 14px;">KEMENTRIAN KELAUTAN DAN PERIKANAN</div>
                    <div style="font-size: 12px;">BADAN KARANTINA IKAN, PENGENDALIAN MUTU DAN KEAMANAN HASIL PERIKANAN</div>
                </div>
                <div>
                    <div style="font-size: 18px; font-weight: bold;">BALAI KARANTINA IKAN, PENGENDALIAN MUTU</div>
                    <div style="font-size: 18px; font-weight: bold;">DAN KEAMANAN HASIL PERIKANAN JAKARTA I</div>
                </div>
                <div>
                    <div style="font-size: 10px;">LABORATORIUM BANDARA SOEKARNO-HATTA. TELEPON (021)55915059</div>
                    <div style="font-size: 10px;">POS ELEKTRONIK : labjakarta1@gmail.com</div>
                </div>
            </div>
        </div>
        <br>
        <hr width="50%" align="center" border-style="double">
        <br>

        <div align="right" style="font-size: 10px">'. $tr_mst_fppc[0]['no_fppc'] .'</div>
        <div align=center style="font-size: 14px; font-weight: bold;"><u>LAPORAN HASIL UJI SEMENTARA (LHUS)</u></div>
        <div align=center style="font-size: 14px; font-weight: bold;">No : '. $tr_mst_fppc[0]['no_lhu'] .'</div>
        <br>

        <table border=0  width="100%" cellspacing="0" cellpadding="6" >
            <tr>
                <td valign="top" width="20%">Bidang Pengujian</td>
                <td valign="top"width="10%">: Organoleptik</td>
            </tr>
            <tr>
                <td valign="top" width="20%">No. Contoh Uji</td>
                <td valign="top"width="10%">: '. $tr_mst_fppc[0]['no_lhu'] .'</td>
            </tr>
            <tr>
                <td valign="top" width="20%">Tanggal Pengujian</td>
                <td valign="top"width="10%">: '. $tanggalttd .'</td>
            </tr>
            <tr>
                <td valign="top" width="20%">Hasil Pengujian</td>
                <td valign="top"width="10%">: </td>
            </tr>
        </table>

        <table border="1" cellpadding="3" cellspacing="3" repeat_header=1 width=100% style="margin-top:10px; margin-left:0px;">
            <thead>
                <tr>
                    <th colspan="1" rowspan="2">No</th> 
                    <th colspan="1" rowspan="2">Nama Panelis</th> 
                    <th colspan="6">Parameter</th> 
                    <th colspan="1" rowspan="2">Jumlah (SX)</th>
                    <th colspan="1" rowspan="2">Rata-rata (X)</th>
                    <th colspan="1" rowspan="2">X - Xi</th>
                    <th colspan="1" rowspan="2">(X - Xi)2</th>
                </tr> 
                <tr>
                    <th>Mata</th>
                    <th>Insang</th>
                    <th>Lendir</th>
                    <th>Daging</th>
                    <th>Bau</th>
                    <th>Tekstur</th>
                </tr> 
            </thead>';
                $no = 1;
                $totalAvg = 0;
                $loop = 0;

                foreach ($penilaian as $nilai) {
                    $x = count($penilaian);
                    $xxi = number_format((float)($avg_val[$no-1] - $total_rata), 2, '.', '');
                    $xxi2 = number_format((float)(($xxi) * ($xxi)), 2, '.', '');
                    $totalXxi2 += $xxi2;
                    $s = number_format((float)($totalXxi2 / $x), 2, '.', '');
                    $sd = number_format((float)(sqrt($s)), 2, '.', '');

                    echo '
                    <tr>
                        <td align=center>' . $no . '</td>
                        <td>'. $nilai->nama .'</td>
                        <td align=center>' . $nilai->mata . '</td>
                        <td align=center>' . $nilai->insang . '</td>
                        <td align=center>' . $nilai->lendir . '</td>
                        <td align=center>' . $nilai->daging . '</td>
                        <td align=center>' . $nilai->bau . '</td>
                        <td align=center>' . $nilai->tekstur . '</td>

                        <td align=center>' . $sum_val[$no-1] . '</td>
                        <td align=center>' . $avg_val[$no-1] . '</td>
                        <td align=right>' . $xxi . '</td>
                        <td align=right>' . $xxi2 . '</td>
                    </tr>
                    ';
                    $no++;
                };



            echo '
                <tr>
                    <td colspan="9"></td>
                    <td align=center>'. array_sum($avg_val) .'</td>
                    <th>Rata-rata</th>
                    <td align=right>'. $totalXxi2 .'</td>
                </tr>
                <tr>
                    <td colspan="8"></td>
                    <th>Xi</th>
                    <td align=center>'. $total_rata .'</td>
                    <th>S</th>
                    <td align=right>'. $s .'</td>
                </tr>
                <tr>
                    <td colspan="10"></td>
                    <th>SD</th>
                    <td align=right>'. $s .'</td>
                </tr>
            </table>
            
            ';

            $pmin = number_format((float)($total_rata - ((1.96 * $sd) / (sqrt(9)))), 2, '.', '');;
            $pmax = number_format((float)($total_rata + ((1.96 * $sd) / (sqrt(9)))), 2, '.', '');;

            echo '
            <div style="margin: 20px 0;">
                <table style="width: 100%;">
                        <tr>
                        <td style="width: 9%;">Hasil Akhir</td>
                        <td style="width: 1%;">:</td>
                        <td>P ('. $pmin .' < u < '. $pmax .')</td>
                    </tr>
                    <!-- <tr>
                        <td>Kesimpulan</td>
                        <td>:</td>
                        <td>Nilai skor organoleptik 8,0</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>Memenuhi Standar Interval Mutu Kesegaran</td>
                    </tr> -->
                </table>
            </div>

            <div>
                <table style="width: 100%;">
                    <tr>
                        <td style="width: 25%"></td>
                        <td style="width: 50%;"></td>
                        <td style="width: 25%">Jakarta,  ' . $tanggalttd . '</td>
                    </tr>
                    <tr>
                        <td>' . $tr_setting[0]['pj_penandatangan'] . '</td>
                        <td></td>
                        <td>' . $tr_setting[1]['pj_penandatangan'] . '</td>
                    </tr>
                    <tr>
                        <td style="height: 100px;"></td>
                    </tr>
                    <tr>
                        <td>' . $tr_setting[0]['nm_penandatangan'] . '</td>
                        <td></td>
                        <td>' . $tr_setting[1]['nm_penandatangan'] . '</td>
                    </tr>
                    <tr>
                        <td>NIP. ' . $tr_setting[0]['nip'] . '</td>
                        <td></td>
                        <td>NIP. ' . $tr_setting[1]['nip'] . '</td>
                    </tr>
                </table>
            </div>
    </body>
    </html>';

$html   = ob_get_contents();
ob_end_clean();
$mpdf = new mPDF('utf-8', 'A4-L');

$mpdf->setFooter('Page {PAGENO} of {nb} DP/5.10.4/Balai KIPM JKT I;Rev 4;25 Januari 2019');
$mpdf->WriteHTML(utf8_encode($html));
$mpdf->Output("rekap_penilaian.pdf", 'I');
exit;

?>

