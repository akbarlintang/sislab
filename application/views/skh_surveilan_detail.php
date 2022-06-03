
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css"/>

 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> <?php echo $profil_upi[0]->nm_upi ?>
        <small><?php echo $profil_upi[0]->al_upi ?> </small>
      </h1>
    </section>
    <section class="content">
      
        <div class="row">
            <div class="col-xs-12 text-right">
                 <div class="form-group">
                    <a class="btn btn-primary" href="<?php echo base_url().'SKHS/add_skhs/'.$profil_upi[0]->id_upi; ?>" title="SKHS"<i class="fa fa-edit"></i> Add New</a>
                 </div>
                  
              </div>
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title"> </h3>
                    
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table id="book-table" class="display">
                       <thead>
                 <tr>
                      <th width="1%">Id SKHS</th>
                      <th width="5%">No SKHS</th>
                      <th width="5%">Tanggal Sertifikat</th>
                      <th width="5%">Tanggal Berakhir</th>
                      
                      <th width="5%">Masa Berlaku <br>(Bulan)</th>
                      <th width="5%">Ruang Lingkup</th>
                      <th width="5%">Update</th>
                      <th width="5%">Print</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php       
                    
                    foreach ($data_pelanggan  as $row) {
                    ?>
                   <tr>   
                      <td> <?php echo $row->id_skhs ?></td>
                      <td> <?php echo $row->no_skhs ?></td>
                      <td> <?php echo $row->tgl_sertifikat ?></td>
                      <td> <?php echo $row->tgl_berakhir ?></td>
                      
                      <td> <?php echo $row->masa_berlaku ?></td>
                      <td><?php
                          if (EMPTY($row->id_skhs)) {
                                echo "---";
                          } else {
                      $data['ruanglingkup'] =$this->db->query("SELECT tbl_dtl_skhs.id_skhs,tbl_dtl_skhs.id_kd_lokal, tb_r_ikan_lokal.nm_lokal FROM tbl_dtl_skhs LEFT JOIN tb_r_ikan_lokal ON tbl_dtl_skhs.id_kd_lokal = tb_r_ikan_lokal.id_kd_lokal WHERE id_skhs=".$row->id_skhs."")->result_object();
                            foreach ($data['ruanglingkup']  as $rec) { ?>
                                 <?php echo $rec->nm_lokal ?><br>
                      <?php       
                             } 
                      }                      
                    ?>
                      </td>  
                      <td class="text-center">
                             <a class="btn btn-sm btn-warning" href="<?php echo base_url().'SKHS/edit_skhs/'.$row->id_upi.'/'.$row->id_skhs; ?>" title="SKHS"><i class="fa fa-edit"></i></a>
                      </td>
                      <td class="text-center">
                             <a class="btn btn-sm btn-warning" href="<?php echo base_url().'SKHS/printskhs/'.$row->id_skhs; ?>" title="SKHS"><i class="fa fa-print"></i></a>
                      </td>
                      
                    <?php     
                        }
                    ?>            
            
                   </tr>
                  
                  </tbody>
                </table>
                </div><!-- /.box-body -->
                
              </div><!-- /.box -->
            </div>
        </div>
    </section>
</div>
    


<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/common.js" charset="utf-8"></script>
<script src="<?php echo base_url(); ?>assets/plugins/jquery/jQuery-2.1.4.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url(); ?>assets/assets/bootstrap/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="<?php echo base_url(); ?>assets/plugins/select2/dist/js/select2.full.min.js"></script>

<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>         
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
 </script>   
<script type="text/javascript">
$(document).ready(function() {
    $('#book-table').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );
</script>
<script>
 window.onload = function() {

  //
 
 
var chart2 = new CanvasJS.Chart("komoditi_akhir", {
    animationEnabled: true,
    theme: "light2",
    title:{
        text: "Domestik Masuk Komoditi"
    },
    axisY: {
        title: "Total Nilai Rupiah"
    },
    data: [{
        type: "column",
       // yValueFormatString: "#,##0.## Rupiah",
        yValueFormatString: "_-Rp* #.##0_-;-Rp* #.##0_-;_-Rp* "-"_-;_-@_-",
        
        dataPoints: <?php echo json_encode($dm_komoditi, JSON_NUMERIC_CHECK); ?>
    }]
});
chart2.render();
}
</script>



