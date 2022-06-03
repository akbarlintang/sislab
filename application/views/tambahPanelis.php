<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-users"></i>Panelis
            <small>Tambah Panelis</small>
        </h1>
    </section>

    <section class="content">

        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
                <!-- general form elements -->



                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Masukkan Detail Panelis</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <?php $this->load->helper("form"); ?>
                    <form role="form" id="tambahPanelis" action="<?php echo base_url() ?>tambahPanelisBaru" method="post" role="form">
                        <div class="box-body">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nip_baru">NIP Baru</label>
                                        <input type="text" class="form-control" id="nip_baru" placeholder="NIP Baru" name="nip_baru" value="<?php echo set_value('nip_baru'); ?>" maxlength="128">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nip">NIP</label>
                                        <input type="text" class="form-control" id="nip" placeholder="NIP" name="nip" value="<?php echo set_value('nip'); ?>" maxlength="128">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="nama" placeholder="Nama" name="nama" value="<?php echo set_value('nama'); ?>" maxlength="128">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="panelis">Status Panelis</label>
                                        <input type="text" class="form-control" id="panelis" placeholder="Ya atau Tidak" name="panelis" value="<?php echo set_value('panelis'); ?>" maxlength="128">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control" id="email" placeholder="Email" name="email" value="<?php echo set_value('email'); ?>" maxlength="128">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="no_telp">Nomor Telepon</label>
                                        <input type="text" class="form-control" id="no_telp" placeholder="Nomor Telepon" name="no_telp" value="<?php echo set_value('no_telp'); ?>" maxlength="128">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <input type="text" class="form-control" id="alamat" placeholder="Alamat" name="alamat" value="<?php echo set_value('alamat'); ?>" maxlength="128">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="id_jabatan">Id Jabatan</label>
                                        <input type="text" class="form-control" id="id_jabatan" placeholder="ID Jabatan" name="id_jabatan" value="<?php echo set_value('id_jabatan'); ?>" maxlength="128">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="id_jenjang">Id Jenjang</label>
                                        <input type="text" class="form-control" id="id_jenjang" placeholder="ID Jenjang" name="id_jenjang" value="<?php echo set_value('id_jenjang'); ?>" maxlength="128">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="kd_gol">Kd Gol</label>
                                        <input type="text" class="form-control" id="kd_gol" placeholder="Kode Golongan" name="kd_gol" value="<?php echo set_value('kd_gol'); ?>" maxlength="128">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="kd_upt">Kd UPT</label>
                                        <input type="text" class="form-control" id="kd_upt" placeholder="Kode UPT" name="kd_upt" value="<?php echo set_value('kd_upt'); ?>" maxlength="128">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="keterangan">Keterangan</label>
                                        <input type="text" class="form-control" id="keterangan" placeholder="keterangan" name="keterangan" value="<?php echo set_value('keterangan'); ?>" maxlength="128">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="st_panelis">St Panelis</label>
                                        <input type="text" class="form-control" id="st_panelis" placeholder="st_panelis" name="st_panelis" value="<?php echo set_value('st_panelis'); ?>" maxlength="128">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pangkat_tmt">Pangkat tmt</label>
                                        <input type="date" class="form-control" id="pangkat_tmt" placeholder="pangkat_tmt" name="pangkat_tmt" value="<?php echo set_value('pangkat_tmt'); ?>" maxlength="128">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="periode_ak_tmt">Periode ak tmt</label>
                                        <input type="date" class="form-control" id="periode_ak_tmt" placeholder="periode_ak_tmt" name="periode_ak_tmt" value="<?php echo set_value('periode_ak_tmt'); ?>" maxlength="128">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="awal_ak">Awal ak</label>
                                        <input type="text" class="form-control" id="awal_ak" placeholder="awal_ak" name="awal_ak" value="<?php echo set_value('awal_ak'); ?>" maxlength="128">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tplhr">Tplhr</label>
                                        <input type="text" class="form-control" id="tplhr" placeholder="tplhr" name="tplhr" value="<?php echo set_value('tplhr'); ?>" maxlength="128">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tglhr">Tglhr</label>
                                        <input type="date" class="form-control" id="tglhr" placeholder="tglhr" name="tglhr" value="<?php echo set_value('tglhr'); ?>" maxlength="128">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tgl_berlaku">Tanggal Berlaku</label>
                                        <input type="date" class="form-control" id="tgl_berlaku" placeholder="tgl_berlaku" name="tgl_berlaku" value="<?php echo set_value('tgl_berlaku'); ?>" maxlength="128">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <input type="text" class="form-control" id="status" placeholder="status" name="status" value="<?php echo set_value('status'); ?>" maxlength="128">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="sts_sync">Sts Sync</label>
                                        <input type="text" class="form-control" id="sts_sync" placeholder="sts_sync" name="sts_sync" value="<?php echo set_value('sts_sync'); ?>" maxlength="128">
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Simpan" />
                            <input type="reset" class="btn btn-default" value="Reset" />
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
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
    </section>

</div>
<script src="<?php echo base_url(); ?>assets/js/addUser.js" type="text/javascript"></script>