<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-users"></i>Organoleptik
            <small>Tambah, Ubah, Hapus</small>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>Organoleptik/tambahOrganoleptik"><i class="fa fa-plus"></i> Tambah </a>
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
                        <h3 class="box-title">Daftar Organoleptik</h3>
                        <div class="box-tools">
                            <form action="<?php echo base_url() ?>daftarOrganoleptik" method="POST" id="searchList">
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
                                <th>No</th>
                                <th>Kode</th>
                                <th>Jenis Pemeriksaan</th>
                                <th>Organ Diperiksa</th>
                                <th>Gejala Klinis</th>
                                <th>Nilai</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                            <?php
                            if (!empty($userRecords)) {
                                $count = 0;
                                foreach ($userRecords as $record) {
                                    $count = $count + 1;

                            ?>
                                    <tr>
                                        <td><?php echo $count ?></td>
                                        <td><?php echo $record->kode ?></td>
                                        <td><?php echo $record->jenis_pemeriksaan ?></td>
                                        <td><?php echo $record->organ_diperiksa ?></td>
                                        <td><?php echo $record->gejala_klinis ?></td>
                                        <td><?php echo $record->nilai ?></td>
                                        <!-- <td><?php echo date("d-m-Y", strtotime($record->createdDtm)) ?></td> -->
                                        <td class="text-center">
                                            <form action="<?php echo base_url() . 'Organoleptik/deleteOrganoleptik/' . $record->id; ?>" method="POST">
                                                <a class="btn btn-sm btn-info" href="<?php echo base_url() . 'Organoleptik/editOrganoleptikLama/' . $record->id; ?>" title="Ubah"><i class="fa fa-pencil"></i></a>
                                                <input type="hidden" name="id" value="<?php echo $record->id ?>">
                                                <button class="btn btn-sm btn-danger" onclick="return confirm ('Apakah anda yakin menghapus data organoleptik?')" href="#" title="Hapus">
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
            jQuery("#searchList").attr("action", baseURL + "daftarOrganoleptik/" + value);
            jQuery("#searchList").submit();
        });
    });
</script>