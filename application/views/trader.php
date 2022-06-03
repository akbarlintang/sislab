<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-users"></i> Trader
            <small>Tambah, Ubah, Hapus</small>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>tambahTrader"><i class="fa fa-plus"></i> Tambah</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php
                $this->load->helper('form');
                $error = $this->session->flashdata('error');
                if ($error) {
                ?>
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php echo $this->session->flashdata('error'); ?>
                    </div>
                <?php } ?>
                <?php
                $success = $this->session->flashdata('success');
                if ($success) {
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
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Daftar Trader</h3>
                        <div class="box-tools">
                            <form action="<?php echo base_url() ?>daftarTrader" method="POST" id="searchList">
                                <div class="input-group">
                                    <input type="text" name="searchText" value="<?php echo $searchText; ?>" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search" />
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-default searchList"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tr>
                                <th>Nama Trader</th>
                                <th> Alamat Trader </th>
                                <th>Kota Trader </th>
                                <th> Kode Negara</th>
                                <th> NPWP </th>
                                <th>Nomor KTP</th>
                                <th>PH Trader</th>
                                <th>FX Trader</th>
                                <th> IM Trader</th>
                                <th> Nomor Izin </th>
                                <th> Email </th>
                                <th> Home Page </th>
                                <th> ID Kel Trader</th>
                                <th> Keterangan </th>
                                <th> Status </th>
                                <th> Ili </th>
                                <th> Aktif </th>
                                <th> Kd Trader Ol</th>
                                <th> Jns Id</th>
                                <th> Kodepos </th>
                                <th> Email PJB</th>
                                <th> KD Niki </th>
                                <th> Niki </th>
                                <th> PTH </th>
                                <th> Date PTH</th>
                                <th> Badan Usaha </th>
                                <th class="text-center">Aksi</th>
                            </tr>
                            <?php
                            if (!empty($userRecords)) {
                                foreach ($userRecords as $record) {
                            ?>
                                    <tr>

                                        <td><?php echo $record->nm_trader ?></td>
                                        <td><?php echo $record->al_trader ?></td>
                                        <td><?php echo $record->kt_trader ?></td>
                                        <td><?php echo $record->kd_negara ?></td>
                                        <td><?php echo $record->npwp ?></td>
                                        <td><?php echo $record->no_ktp ?></td>
                                        <td><?php echo $record->ph_trader ?></td>
                                        <td><?php echo $record->fx_trader ?></td>
                                        <td><?php echo $record->im_trader ?></td>
                                        <td><?php echo $record->no_izin ?></td>
                                        <td><?php echo $record->email ?></td>
                                        <td><?php echo $record->homepage ?></td>
                                        <td><?php echo $record->id_kel_trader ?></td>
                                        <td><?php echo $record->keterangan ?></td>
                                        <td><?php echo $record->status ?></td>
                                        <td><?php echo $record->ili ?></td>
                                        <td><?php echo $record->aktif ?></td>
                                        <td><?php echo $record->kd_trader_ol ?></td>
                                        <td><?php echo $record->jns_id ?></td>
                                        <td><?php echo $record->kodepos ?></td>
                                        <td><?php echo $record->email_pjb ?></td>
                                        <td><?php echo $record->kd_niki ?></td>
                                        <td><?php echo $record->niki ?></td>
                                        <td><?php echo $record->pth ?></td>
                                        <td><?php echo date("d-m-Y", strtotime($record->date_pth)) ?></td>
                                        <td><?php echo $record->bdn_usaha ?></td>
                                        <td class="text-center">
                                            <!-- <a class="btn btn-sm btn-primary" href="<?= base_url() . 'login-history/' . $record->id_trader; ?>" title="Login history"><i class="fa fa-history"></i></a> | -->
                                            <form action="<?php echo base_url() . 'deleteTrader/' . $record->id_trader; ?>" method="POST">
                                                <a class="btn btn-sm btn-info" href="<?php echo base_url() . 'editTraderLama/' . $record->id_trader; ?>" title="Ubah"><i class="fa fa-pencil"></i></a>
                                                <input type="hidden" name="id_trader" value="<?php echo $record->id_trader ?>">
                                                <button class="btn btn-sm btn-danger" onclick="return confirm ('Apakah anda yakin menghapus data Trader?')" href="#" title="Hapus">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </table>

                    </div><!-- /.box-body -->
                    <div class="box-footer clearfix">
                        <?php echo $this->pagination->create_links(); ?>
                    </div>
                </div><!-- /.box -->
            </div>
        </div>
    </section>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/common.js" charset="utf-8"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery('ul.pagination li a').click(function(e) {
            e.preventDefault();
            var link = jQuery(this).get(0).href;
            var value = link.substring(link.lastIndexOf('/') + 1);
            jQuery("#searchList").attr("action", baseURL + "daftarTrader/" + value);
            jQuery("#searchList").submit();
        });
    });
</script>