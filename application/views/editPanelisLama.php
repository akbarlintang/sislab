<?php
$nip_baru = $infoPanelis->nip_baru;
$nip = $infoPanelis->nip;
$nama = $infoPanelis->nama;
$panelis = $infoPanelis->panelis;
$alamat = $infoPanelis->alamat;
$id_jabatan = $infoPanelis->id_jabatan;
$id_jenjang = $infoPanelis->id_jenjang;
$kd_gol = $infoPanelis->kd_gol;
$kd_upt = $infoPanelis->kd_upt;
$keterangan = $infoPanelis->keterangan;
$st_panelis = $infoPanelis->st_panelis;
$pangkat_tmt = $infoPanelis->pangkat_tmt;
$periode_ak_tmt = $infoPanelis->periode_ak_tmt;
$awal_ak = $infoPanelis->awal_ak;
$tplhr = $infoPanelis->tplhr;
$tglhr = $infoPanelis->tglhr;
$tgl_berlaku = $infoPanelis->tgl_berlaku;
$status = $infoPanelis->status;
$sts_sync = $infoPanelis->sts_sync;
// $roleId = $infoPanelis->roleId;
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-users"></i>Panelis
            <small>Ubah Panelis</small>
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

                    <form role="form" action="<?php echo base_url() ?>editPanelis" method="post" id="editPanelis" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nip_baru">NIP Baru</label>
                                        <input type="text" class="form-control" id="nip_baru" placeholder="NIP Baru" name="nip_baru" value="<?php echo $nip_baru; ?>" maxlength="128">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nip">NIP</label>
                                        <input type="text" class="form-control" id="nip" placeholder="NIP" name="nip" value="<?php echo $nip; ?>" maxlength="128">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="nama" placeholder="nama" name="nama" value="<?php echo $nama; ?>" maxlength="128">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="panelis">Status Panelis</label>
                                        <input type="text" class="form-control" id="panelis" placeholder="Ya atau Tidak" name="panelis" value="<?php echo $panelis; ?>" maxlength="128">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="alamat">Alamat</label>
                                        <input type="text" class="form-control" id="alamat" placeholder="alamat" name="alamat" value="<?php echo $alamat; ?>" maxlength="128">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="id_jabatan">Id Jabatan</label>
                                        <input type="text" class="form-control" id="id_jabatan" placeholder="id_jabatan" name="id_jabatan" value="<?php echo $id_jabatan; ?>" maxlength="128">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="id_jenjang">Id Jenjang</label>
                                        <input type="text" class="form-control" id="id_jenjang" placeholder="id_jenjang" name="id_jenjang" value="<?php echo $id_jenjang; ?>" maxlength="128">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="kd_gol">Kd Gol</label>
                                        <input type="text" class="form-control" id="kd_gol" placeholder="kd_gol" name="kd_gol" value="<?php echo $kd_gol; ?>" maxlength="128">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="kd_upt">Kd UPT</label>
                                        <input type="text" class="form-control" id="kd_upt" placeholder="kd_upt" name="kd_upt" value="<?php echo $kd_upt; ?>" maxlength="128">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="keterangan">Keterangan</label>
                                        <input type="text" class="form-control" id="keterangan" placeholder="keterangan" name="keterangan" value="<?php echo $keterangan; ?>" maxlength="128">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="st_panelis">St Pegawai</label>
                                        <input type="text" class="form-control" id="st_panelis" placeholder="st_pegawai" name="st_panelis" value="<?php echo $st_panelis; ?>" maxlength="128">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pangkat_tmt">Pangkat tmt</label>
                                        <input type="date" class="form-control" id="pangkat_tmt" placeholder="pangkat_tmt" name="pangkat_tmt" value="<?php echo $pangkat_tmt; ?>" maxlength="128">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="periode_ak_tmt">Periode ak tmt</label>
                                        <input type="date" class="form-control" id="periode_ak_tmt" placeholder="periode_ak_tmt" name="periode_ak_tmt" value="<?php echo $periode_ak_tmt; ?>" maxlength="128">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="awal_ak">Awal ak</label>
                                        <input type="text" class="form-control" id="awal_ak" placeholder="awal_ak" name="awal_ak" value="<?php echo $awal_ak; ?>" maxlength="128">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tplhr">Tplhr</label>
                                        <input type="text" class="form-control" id="tplhr" placeholder="tplhr" name="tplhr" value="<?php echo $tplhr; ?>" maxlength="128">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tglhr">Tglhr</label>
                                        <input type="date" class="form-control" id="tglhr" placeholder="tglhr" name="tglhr" value="<?php echo $tglhr; ?>" maxlength="128">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tgl_berlaku">Tanggal Berlaku</label>
                                        <input type="date" class="form-control" id="tgl_berlaku" placeholder="tgl_berlaku" name="tgl_berlaku" value="<?php echo $tgl_berlaku; ?>" maxlength="128">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <input type="text" class="form-control" id="status" placeholder="status" name="status" value="<?php echo $status; ?>" maxlength="128">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="sts_sync">Sts Sync</label>
                                        <input type="text" class="form-control" id="sts_sync" placeholder="sts_sync" name="sts_sync" value="<?php echo $sts_sync; ?>" maxlength="128">
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

<script src="<?php echo base_url(); ?>assets/js/editUser.js" type="text/javascript"></script>