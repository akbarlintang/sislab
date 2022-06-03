
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css"/>

 <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Setting LHU
        <small>---------------</small>
      </h1>
    </section>
    <section class="content">
       
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Setting LHU</h3>
                    
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table id="book-table" class="display">
                       <thead>
                 <tr>
                      <th width="5%">No</th>
                      <th width="5%">Nm Penandatangan</th>
                      <th width="5%">Jabatan</th>
                      <th width="5%">NIP</th>
                      <th width="5%">Action</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                    <?php       
                    
                    foreach ($settinglhu  as $row) {

                    ?>
                   <tr>   
                      <td> <?php echo $row->no ?></td>
                      <td> <?php echo $row->nm_penandatangan ?></td>
                      <td> <?php echo $row->pj_penandatangan ?></td>
                      <td> <?php echo $row->nip ?></td>
                      <td class="text-center">
                        <a class="btn btn-sm btn-warning" href="<?php echo base_url().'Settinglhu/update/'.$row->no; ?>" title="Ubah"><i class="fa fa-edit"></i></a>
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



