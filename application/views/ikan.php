<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-users"></i>Ikan
            <small>Tambah, Ubah, Hapus</small>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>tambahIkan"><i class="fa fa-plus"></i> Tambah </a>
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
                        <h3 class="box-title">Daftar Ikan</h3>
                        <div class="box-tools">
                            <form action="<?php echo base_url() ?>daftarIkan" method="POST" id="searchList">
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
                                <th>Nama Lokal</th>
                                <th>Nama Umum</th>
                                <th>Nama Latin</th>
                                <th>Kode Ikan</th>
                                <th>ID Ikan</th>
                                <th>ID Kel Ikan</th>
                                <th>Kode Jenis Kel</th>
                                <th>Kode Tarif</th>
                                <th>Kelas</th>
                                <th>Kelompok</th>
                                <th>Konsumsi</th>
                                <th>Tawar</th>
                                <th>Hidup</th>
                                <th>Bentuk</th>
                                <th>Hias</th>
                                <th>Pelagis</th>
                                <th>Status</th>
                                <th>hscode</th>
                                <th>No Urut hs</th>
                                <th>Aktif</th>
                                <th>Kd Ikan Lokal ol</th>
                                <th>Nilai</th>
                                <th>ID Satuan</th>
                                <!-- <th>Created On</th> -->
                                <th class="text-center">Aksi</th>
                            </tr>
                            <?php
                            if (!empty($userRecords)) {
                                foreach ($userRecords as $record) {
                            ?>
                                    <tr>
                                        <td><?php echo $record->nm_lokal ?></td>
                                        <td><?php echo $record->nm_umum ?></td>
                                        <td><?php echo $record->nm_latin ?></td>
                                        <td><?php echo $record->kd_ikan ?></td>
                                        <td><?php echo $record->id_ikan ?></td>
                                        <td><?php echo $record->id_kel_ikan ?></td>
                                        <td><?php echo $record->kd_jenis_kel ?></td>
                                        <td><?php echo $record->kd_tarif ?></td>
                                        <td><?php echo $record->kelas ?></td>
                                        <td><?php echo $record->kelompok ?></td>
                                        <td><?php echo $record->konsumsi ?></td>
                                        <td><?php echo $record->tawar ?></td>
                                        <td><?php echo $record->hidup ?></td>
                                        <td><?php echo $record->bentuk ?></td>
                                        <td><?php echo $record->hias ?></td>
                                        <td><?php echo $record->pelagis ?></td>
                                        <td><?php echo $record->status ?></td>
                                        <td><?php echo $record->hscode ?></td>
                                        <td><?php echo $record->no_urut_hs ?></td>
                                        <td><?php echo $record->aktif ?></td>
                                        <td><?php echo $record->kd_ikan_lokal_ol ?></td>
                                        <td><?php echo $record->nilai ?></td>
                                        <td><?php echo $record->id_satuan ?></td>
                                        <!-- <td><?php echo date("d-m-Y", strtotime($record->createdDtm)) ?></td> -->
                                        <td class="text-center">
                                            <!-- <a class="btn btn-sm btn-primary" href="<?= base_url() . 'login-history/' . $record->id_kd_lokal; ?>" title="Login history"><i class="fa fa-history"></i></a> | -->
                                            <form action="<?php echo base_url() . 'deleteIkan/' . $record->id_kd_lokal; ?>" method="POST">
                                                <a class="btn btn-sm btn-info" href="<?php echo base_url() . 'editIkanLama/' . $record->id_kd_lokal; ?>" title="Ubah"><i class="fa fa-pencil"></i></a>
                                                <input type="hidden" name="id_kd_lokal" value="<?php echo $record->id_kd_lokal ?>">
                                                <button class="btn btn-sm btn-danger" onclick="return confirm ('Apakah anda yakin menghapus data ikan?')" href="#" title="Hapus">
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
            jQuery("#searchList").attr("action", baseURL + "daftarIkan/" + value);
            jQuery("#searchList").submit();
        });
    });
</script>