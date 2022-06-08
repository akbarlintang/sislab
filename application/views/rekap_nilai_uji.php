<!DOCTYPE html>
<html lang="en">
    <head>        
        <!-- META SECTION -->
        <title>Surat Tugas Online</title>    
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        
        <!-- END META SECTION -->
        
        <!-- CSS INCLUDE -->        
        <link rel="stylesheet" type="text/css" id="theme" href="<?php echo base_url();?>assets/css/theme-red.css"/>
        
            <!-- bootstrap datepicker -->
        <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
            <!-- bootstrap datepicker -->
        <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/select2/dist/css/select2.min.css">
        <!-- EOF CSS INCLUDE -->          
    </head>
    <body>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <!-- <i class="fa fa-users"></i> Deskripsi Sampel/Contoh Uji
        <small>Deskripsi Contoh Uji Hasil Uji</small> -->
        <i class="fa fa-users"></i> Rekap Penilaian Hasil Uji
        <!-- <small>Deskripsi Contoh Uji Hasil Uji</small> -->
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
                <div class="box box-primary" style="padding: 30px 0;">
                    <div class="box-header text-center">
                        <h3 class="box-title text-bold"><?php echo set_value('fdeskripsicth'); ?> LAPORAN HASIL UJI SEMENTARA (LHUS)</h3>
                        <h4 class="text-bold">No : <?php echo($detail[0]->no_fppc) ?></h4>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                      <div class="pull-right" style="margin: 10px 0;">
                        <a class="btn btn-warning" href="<?php echo base_url() . 'Penilaian/printrekap/' . $row_id . '/' . $id_kd_lokal; ?>" data-userid="<?php echo $row_id; ?>" title="Print Rekap">Cetak <i class="fa fa-print"></i></a>
                      </div>

                      <?php
                        if ($penilaian) {
                      ?>
                        <div>
                          <table class="table table-bordered table-hover">
                            <thead>
                              <tr>
                                <th rowspan="2" class="text-center">No.</th>
                                <th rowspan="2" class="text-center">Nama Panelis</th>
                                <th colspan="6" class="text-center">Parameter</th>
                                <th rowspan="2" class="text-center">Jumlah (SX)</th>
                                <th rowspan="2" class="text-center">Rata-rata (X)</th>
                                <th rowspan="2" class="text-center">X - Xi</th>
                                <th rowspan="2" class="text-center">(X - Xi)2</th>
                              </tr>
                              <tr>
                                <th class="text-center">Mata</th>
                                <th class="text-center">Insang</th>
                                <th class="text-center">Lendir</th>
                                <th class="text-center">Daging</th>
                                <th class="text-center">Bau</th>
                                <th class="text-center">Tekstur</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                                $totalAvg = 0;
                                $totalXxi2 = 0;
                                $loop = 0;
                                foreach ($penilaian as $index=>$nilai) {
                              ?>
                                <tr>
                                  <td><?php echo($index+1) ?></td>
                                  <td><?php echo($nilai->nama) ?></td>
                                  <td><?php echo($nilai->mata) ?></td>
                                  <td><?php echo($nilai->insang) ?></td>
                                  <td><?php echo($nilai->lendir) ?></td>
                                  <td><?php echo($nilai->daging) ?></td>
                                  <td><?php echo($nilai->bau) ?></td>
                                  <td><?php echo($nilai->tekstur) ?></td>

                                  <!-- Perhitungan -->
                                  <?php 
                                    $x = count($penilaian);
                                    $xxi = number_format((float)($avg_val[$index] - $total_rata), 2, '.', '');
                                    $xxi2 = number_format((float)(($xxi) * ($xxi)), 2, '.', '');

                                    $totalXxi2 += $xxi2;
                                    $s = number_format((float)($totalXxi2 / $x), 2, '.', '');
                                    $sd = number_format((float)(sqrt($s)), 2, '.', '');
                                  ?>

                                  <td><?php echo($sum_val[$index]) ?></td>
                                  <td><?php echo($avg_val[$index]) ?></td>
                                  <td><?php echo($xxi) ?></td>
                                  <td><?php echo($xxi2) ?></td>
                                </tr>
                              <?php } ?>

                              <tr>
                                <td colspan="9"></td>
                                <td><?php echo(array_sum($avg_val)) ?></td>
                                <th>Rata-rata</th>
                                <td><?php echo($totalXxi2) ?></td>
                              </tr>

                              <tr>
                                <td colspan="8"></td>
                                <th>Xi</th>
                                <td><?php echo($total_rata) ?></td>
                                <th>S</th>
                                <td><?php echo($s) ?></td>
                              </tr>

                              <tr>
                                <td colspan="10"></td>
                                <th>SD</th>
                                <td><?php echo($sd) ?></td>
                              </tr>
                            </tbody>
                          </table>

                          <!-- Hitung P -->
                          <?php
                            $pmin = number_format((float)($total_rata - ((1.96 * $sd) / (sqrt(9)))), 2, '.', '');;
                            $pmax = number_format((float)($total_rata + ((1.96 * $sd) / (sqrt(9)))), 2, '.', '');;
                          ?>

                          <div>
                            <table style="width: 100%;">
                              <tr>
                                <td style="width: 9%;">Hasil Akhir</td>
                                <td style="width: 1%;">:</td>
                                <td>P (<?php echo($pmin) ?> < u < <?php echo($pmax) ?>)</td>
                              </tr>
                              <tr>
                                <td>Kesimpulan</td>
                                <td>:</td>
                                <td>Nilai skor organoleptik <strong><?php echo($total_rata) ?></strong></td>
                              </tr>
                              <tr>
                                <td></td>
                                <td></td>
                                <?php
                                  if ($total_rata < 7) {
                                    echo('<td>Tidak Memenuhi Standar Interval Mutu Kesegaran</td>');
                                  } else {
                                    echo('<td>Memenuhi Standar Interval Mutu Kesegaran</td>');
                                  }
                                ?>
                              </tr>
                            </table>
                          </div>
                        </div>
                      <?php } ?>
                      
                      <div class="row">
                          <div class="col-md-6">
                              
                          </div>
                          <div class="col-md-6">
                              
                          </div>    
                      </div>
                    </div><!-- /.box-body -->

                    <!-- <div class="box-footer">
                      <input type="submit" class="btn btn-primary" value="Simpan" />
                      <input type="reset" class="btn btn-default" value="Reset" />
                    </div> -->
                </div>
            </div>
            <div class="col-md-4">
                <?php
                    $this->load->helper('form');
                    $error = $this->session->flashdata('error');
                    if($error)
                    {
                ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('error'); ?>                    
                </div>
                <?php } ?>
                <?php  
                    $success = $this->session->flashdata('success');
                    if($success)
                    {
                ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
                <?php } ?>
                
                <div class="row">
                    <div class="col-md-12">
                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                    </div>
                </div>
            </div>
        </div>    
    </section>
    
</div>
</body>
</html>

 <script type="text/javascript" src="<?php echo base_url();?>assets/bower_components/jquery/dist/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/js/plugins/jquery/jquery-ui.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/js/plugins/bootstrap/bootstrap.min.js"></script>                
        <!-- END PLUGINS -->
        <script src="<?php echo base_url();?>assets/bower_components/select2/dist/js/select2.full.min.js"></script>
        <script src="<?php echo base_url();?>assets/plugins/input-mask/jquery.inputmask.js"></script>
        <script src="<?php echo base_url();?>assets/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
        <script src="<?php echo base_url();?>assets/plugins/input-mask/jquery.inputmask.extensions.js"></script>
        <!-- date-range-picker -->
        <script src="<?php echo base_url();?>assets/bower_components/moment/min/moment.min.js"></script>
        <script src="<?php echo base_url();?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
        <!-- bootstrap color picker -->
        <script src="<?php echo base_url();?>assets/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
        <!-- bootstrap time picker -->
        <script src="<?php echo base_url();?>assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
        <!-- Select2 -->
        <script src="<?php echo base_url();?>assets/bower_components/select2/dist/js/select2.full.min.js"></script>
        <!-- FastClick -->
        <script src="<?php echo base_url();?>assets/bower_components/fastclick/lib/fastclick.js"></script>

        <script src="<?php echo base_url();?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <!-- THIS PAGE PLUGINS -->    
        <script type='text/javascript' src='<?php echo base_url();?>assets/js/plugins/icheck/icheck.min.js'></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
        
        <script type="text/javascript" src="<?php echo base_url();?>assets/js/plugins/datatables/jquery.dataTables.min.js"></script>
        
        <script type='text/javascript' src='<?php echo base_url();?>assets/js/plugins/noty/jquery.noty.js'></script>
        <script type='text/javascript' src='<?php echo base_url();?>assets/js/plugins/noty/layouts/topCenter.js'></script>
        <script type='text/javascript' src='<?php echo base_url();?>assets/js/plugins/noty/layouts/topLeft.js'></script>
        <script type='text/javascript' src='<?php echo base_url();?>assets/js/plugins/noty/layouts/topRight.js'></script>             
        <script type='text/javascript' src='<?php echo base_url();?>assets/js/plugins/noty/themes/default.js'></script>   

        <script type="text/javascript" src="<?php echo base_url();?>assets/js/plugins/bootstrap/bootstrap-datepicker.js"></script>                
        <script type="text/javascript" src="<?php echo base_url();?>assets/js/plugins/bootstrap/bootstrap-file-input.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/js/plugins/bootstrap/bootstrap-select.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/js/plugins/tagsinput/jquery.tagsinput.min.js"></script>      
<script src="<?php echo base_url(); ?>assets/js/addUser.js" type="text/javascript"></script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })
       $('#datepicker2').datepicker({
      autoclose: true
    })

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })
</script>