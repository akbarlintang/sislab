 <!DOCTYPE html>
<html lang="en">
    <head>        
        <!-- META SECTION -->
        <title>FPPC FORM Detail</title>    
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
        <i class="fa fa-users"></i> Penilaian Sampel/Contoh Uji
        <small>Penilaian Contoh Uji yang diajukan</small>
      </h1>
    </section>
    
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
              <?php
                foreach ($Detail_Permohonan as $record) {
              ?>

                <div class="box box-primary">
                    <!-- form start -->
                    <?php $this->load->helper("form"); ?>
                    <form role="form" id="" action="<?php echo base_url() ?>Penilaian/tambah_nilai/<?php echo $row_id; ?>/<?php echo $id_kd_lokal; ?>" method="post" role="form">
                        <div class="box-body">
                          <h4>Hasil Uji</h4>
                          <div class="row">
                              <div class="col-md-6">    
                                <div class="form-group">
                                  <label for="fname">No ID</label>
                                  <input type="text" class="form-control required" value="<?php echo set_value('frow_id',$row_id); ?>" id="frow_id" name="frow_id" maxlength="128" disabled>
                                </div>   
                                <div class="form-group">
                                    <label for="fkodesampel">Kode Sampel</label>
                                    <input type="text" class="form-control required" value="<?php echo set_value('fkodesampel', $record->kode_sampel); ?>" id="fkodesampel" name="fkodesampel" maxlength="128" disabled>
                                </div>
                                <div class="form-group">
                                  <label for="fname">Jumlah Contoh</label>
                                  <input type="text" class="form-control required" value="<?php echo set_value('fjumlahcth', $record->jumlah_contoh); ?>" id="fjumlahcth" name="fjumlahcth" maxlength="128" disabled>
                                </div>
                                <div class="form-group">
                                  <label for="fname">Packing</label>
                                  <input type="text" class="form-control required" value="<?php echo set_value('fpacking', $record->wadah); ?>" id="fpacking" name="fpacking" maxlength="128" disabled>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="fname">Kode Ikan</label>
                                  <input type="text" class="form-control required" value="<?php echo set_value('fdata_ikan',$id_kd_lokal); ?>" id="fdata_ikan" name="fdata_ikan" maxlength="128" disabled>
                                </div>
                                <div class="form-group">
                                  <label for="fname">Deskripsi Contoh</label>
                                  <input type="text" class="form-control required" value="<?php echo set_value('fdeskripsicth', $record->Deskripsi_contoh); ?>" id="fdeskripsicth" name="fdeskripsicth" maxlength="128" disabled>
                                </div>
                                <div class="form-group">
                                  <label for="fname">Bentuk</label>
                                  <input type="text" class="form-control required" value="<?php echo set_value('fbentuk', $record->bentuk); ?>" id="fbentuk" name="fbentuk" maxlength="128" disabled>
                                </div>
                              </div>
                          </div>

                          <h4>Penilaian Hasil Uji</h4>
                          <div class="row">
                              <div class="col-md-12">
                                <table class="table table-bordered table-hover">
                                  <thead>
                                    <tr>
                                      <th>Deskripsi</th>
                                      <th>Nilai</th>
                                      <th>Sesuai</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <!-- Kenampakan -->
                                      <tr>
                                        <td colspan="3"><strong>A. Kenampakan</strong></td>
                                      </tr>
                                      <!-- Mata -->
                                        <tr>
                                          <td colspan="3"><strong>1. Mata</strong></td>
                                        </tr>
                                        <?php
                                          foreach ($organoleptik as $org) {
                                        ?>
                                          <?php
                                            if ($org->organ_diperiksa == "Mata") {
                                          ?>
                                            <tr>
                                              <td><?php echo($org->gejala_klinis) ?></td>
                                              <td class="text-center"><?php echo($org->nilai) ?></td>
                                              <td class="text-center"><input type="radio" name="mata" value="<?php echo($org->nilai) ?>" <?php echo(isset($penilaian[0]->mata) ? ($org->nilai == $penilaian[0]->mata ? 'checked' : '') : '') ?>></td>
                                            </tr>
                                          <?php } ?>
                                        <?php } ?>
                                      <!-- End mata -->

                                      <!-- Insang -->
                                        <tr>
                                          <td colspan="3"><strong>2. Insang</strong></td>
                                        </tr>
                                        <?php
                                          foreach ($organoleptik as $org) {
                                        ?>
                                          <?php
                                            if ($org->organ_diperiksa == "Insang") {
                                          ?>
                                            <tr>
                                              <td><?php echo($org->gejala_klinis) ?></td>
                                              <td class="text-center"><?php echo($org->nilai) ?></td>
                                              <td class="text-center"><input type="radio" name="insang" value="<?php echo($org->nilai) ?>" <?php echo(isset($penilaian[0]->insang) ? ($org->nilai == $penilaian[0]->insang ? 'checked' : '') : '') ?>></td>
                                            </tr>
                                          <?php } ?>
                                        <?php } ?>
                                      <!-- End insang -->

                                      <!-- Lendir Permukaan Badan -->
                                      <tr>
                                          <td colspan="3"><strong>3. Lendir Permukaan Badan</strong></td>
                                        </tr>
                                        <?php
                                          foreach ($organoleptik as $org) {
                                        ?>
                                          <?php
                                            if ($org->organ_diperiksa == "Lendir Permukaan Badan") {
                                          ?>
                                            <tr>
                                              <td><?php echo($org->gejala_klinis) ?></td>
                                              <td class="text-center"><?php echo($org->nilai) ?></td>
                                              <td class="text-center"><input type="radio" name="lendir" value="<?php echo($org->nilai) ?>" <?php echo(isset($penilaian[0]->lendir) ? ($org->nilai == $penilaian[0]->lendir ? 'checked' : '') : '') ?>></td>
                                            </tr>
                                          <?php } ?>
                                        <?php } ?>
                                      <!-- End lendir permukaan badan -->
                                    <!-- End kenampakan -->

                                    <!-- Jenis Daging -->
                                      <tr>
                                        <td colspan="3"><strong>B. Daging</strong></td>
                                      </tr>
                                      <!-- Daging -->
                                        <tr>
                                          <td colspan="3"><strong>1. Daging</strong></td>
                                        </tr>
                                        <?php
                                          foreach ($organoleptik as $org) {
                                        ?>
                                          <?php
                                            if ($org->organ_diperiksa == "Daging") {
                                          ?>
                                            <tr>
                                              <td><?php echo($org->gejala_klinis) ?></td>
                                              <td class="text-center"><?php echo($org->nilai) ?></td>
                                              <td class="text-center"><input type="radio" name="daging" value="<?php echo($org->nilai) ?>" <?php echo(isset($penilaian[0]->daging) ? ($org->nilai == $penilaian[0]->daging ? 'checked' : '') : '') ?>></td>
                                            </tr>
                                          <?php } ?>
                                        <?php } ?>
                                      <!-- End daging -->
                                    <!-- End jenis daging -->

                                    <!-- Jenis Bau -->
                                    <tr>
                                        <td colspan="3"><strong>C. Bau</strong></td>
                                      </tr>
                                      <!-- Bau -->
                                        <tr>
                                          <td colspan="3"><strong>1. Bau</strong></td>
                                        </tr>
                                        <?php
                                          foreach ($organoleptik as $org) {
                                        ?>
                                          <?php
                                            if ($org->organ_diperiksa == "Bau") {
                                          ?>
                                            <tr>
                                              <td><?php echo($org->gejala_klinis) ?></td>
                                              <td class="text-center"><?php echo($org->nilai) ?></td>
                                              <td class="text-center"><input type="radio" name="bau" value="<?php echo($org->nilai) ?>" <?php echo(isset($penilaian[0]->bau) ? ($org->nilai == $penilaian[0]->bau ? 'checked' : '') : '') ?>></td>
                                            </tr>
                                          <?php } ?>
                                        <?php } ?>
                                      <!-- End bau -->
                                    <!-- End jenis bau -->

                                    <!-- Jenis Tekstur -->
                                    <tr>
                                        <td colspan="3"><strong>D. Tekstur</strong></td>
                                      </tr>
                                      <!-- Tekstur -->
                                        <tr>
                                          <td colspan="3"><strong>1. Tekstur</strong></td>
                                        </tr>
                                        <?php
                                          foreach ($organoleptik as $org) {
                                        ?>
                                          <?php
                                            if ($org->organ_diperiksa == "Tekstur") {
                                          ?>
                                            <tr>
                                              <td><?php echo($org->gejala_klinis) ?></td>
                                              <td class="text-center"><?php echo($org->nilai) ?></td>
                                              <td class="text-center"><input type="radio" name="tekstur" value="<?php echo($org->nilai) ?>" <?php echo(isset($penilaian[0]->tekstur) ? ($org->nilai == $penilaian[0]->tekstur ? 'checked' : '') : '') ?>></td>
                                            </tr>
                                          <?php } ?>
                                        <?php } ?>
                                      <!-- End tekstur -->
                                    <!-- End jenis tekstur -->
                                  </tbody>
                                </table>
                              </div>
                          </div>
                        </div><!-- /.box-body -->
    
                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Simpan" />
                            <input type="reset" class="btn btn-default" value="Reset" />
                        </div>
                    </form>
                </div>

              <?php
                }
              ?>
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