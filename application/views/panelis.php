<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-users"></i>Panelis
            <small>Tambah, Ubah, Hapus</small>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>tambahPanelis"><i class="fa fa-plus"></i> Tambah </a>
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
                        <h3 class="box-title">Daftar Panelis</h3>
                        <div class="box-tools">
                            <!--form action="<?php echo base_url() ?>daftarPanelis" method="POST" id="searchList">
                                <div class="input-group">
                                    <input type="text" name="searchText" value="<?php echo $searchText; ?>" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search" />
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-default searchList"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </form-->
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <tr>
                                <!--th width="1%">Panelis</th-->
                                <th width="1%">NIP Baru</th>
                                <th width="1%">NIP</th>
                                <th width="5%">Nama</th>
                                <th width="10%">Alamat</th>
                                <th width="5%">ID Jabatan</th>
                                <th width="5%">ID Jenjang</th>
                                <th width="5%">Kode Gol</th>
                                <th width="5%">Kode UPT</th>
                                <th width="7%">Pangkat TMT</th>
                                <th width="7%">Periode Ak TMT</th>
                                <th width="5%">Awal Ak</th>
                                <th width="5%">Tempat Lahir</th>
                                <th width="7%">Tanggal Lahir</th>
                                <th width="7%">Tanggal Berlaku</th>
                                <!-- <th>Created On</th> -->
                                <th width="5%" class="text-center">Aksi</th>
                            </tr>
                            <?php
                            if (!empty($userRecords)) {
                                foreach ($userRecords as $record) {
                            ?>
                                    <tr>
                                        <!--td><?php echo $record->panelis ?></td-->
                                        <td><?php echo $record->nip_baru ?></td>
                                        <td><?php echo $record->nip ?></td>
                                        <td><?php echo $record->nama ?></td>
                                        <td><?php echo $record->alamat ?></td>
                                        <td><?php echo $record->id_jabatan ?></td>
                                        <td><?php echo $record->id_jenjang ?></td>
                                        <td><?php echo $record->kd_gol ?></td>
                                        <td><?php echo $record->kd_upt ?></td>
                                        <td><?php echo date("d-m-Y", strtotime($record->pangkat_tmt)) ?></td>
                                        <td><?php echo date("d-m-Y", strtotime($record->periode_ak_tmt)) ?></td>
                                        <td><?php echo $record->awal_ak ?></td>
                                        <td><?php echo $record->tplhr ?></td>
                                        <td><?php echo date("d-m-Y", strtotime($record->tglhr)) ?></td>
                                        <td><?php echo date("d-m-Y", strtotime($record->tgl_berlaku)) ?></td>
                                        <!-- <td><?php echo date("d-m-Y", strtotime($record->createdDtm)) ?></td> -->
                                        <td class="text-center">
                                            <!-- <a class="btn btn-sm btn-primary" href="<?= base_url() . 'login-history/' . $record->nip_baru; ?>" title="Login history"><i class="fa fa-history"></i></a> | -->
                                            <form action="<?php echo base_url() . 'deletePanelis/' . $record->nip_baru; ?>" method="POST">
                                                <a class="btn btn-sm btn-info" href="<?php echo base_url() . 'editPanelisLama/' . $record->nip_baru; ?>" title="Ubah"><i class="fa fa-pencil"></i></a>
                                                <input type="hidden" name="nip_baru" value="<?php echo $record->nip_baru ?>">
                                                <button class="btn btn-sm btn-danger" onclick="return confirm ('Apakah anda yakin menghapus data panelis?')" href="#" title="Hapus">
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
            jQuery("#searchList").attr("action", baseURL + "daftarPanelis/" + value);
            jQuery("#searchList").submit();
        });
    });
</script>