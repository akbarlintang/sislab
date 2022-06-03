<?php
$id_kd_lokal = $infoIkan->id_kd_lokal;
$nm_lokal = $infoIkan->nm_lokal;
$nm_umum = $infoIkan->nm_umum;
$nm_latin = $infoIkan->nm_latin;
$kd_ikan = $infoIkan->kd_ikan;
$id_ikan = $infoIkan->id_ikan;
$id_kel_ikan = $infoIkan->id_kel_ikan;
$kd_jenis_kel = $infoIkan->kd_jenis_kel;
$kd_tarif = $infoIkan->kd_tarif;
$kelas = $infoIkan->kelas;
$kelompok = $infoIkan->kelompok;
$konsumsi = $infoIkan->konsumsi;
$tawar = $infoIkan->tawar;
$hidup = $infoIkan->hidup;
$bentuk = $infoIkan->bentuk;
$hias = $infoIkan->hias;
$pelagis = $infoIkan->pelagis;
$status = $infoIkan->status;
$hscode = $infoIkan->hscode;
$no_urut_hs = $infoIkan->no_urut_hs;
$aktif = $infoIkan->aktif;
$kd_ikan_lokal_ol = $infoIkan->kd_ikan_lokal_ol;
$nilai = $infoIkan->nilai;
$id_satuan = $infoIkan->id_satuan;

// $roleId = $infoIkan->roleId;
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-users"></i> Ubah Ikan
        </h1>
    </section>

    <section class="content">

        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
                <!-- general form elements -->



                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Masukkan Detail Ikan</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->

                    <form role="form" action="<?php echo base_url() ?>editIkan" method="post" id="editIkan" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nm_lokal">Nama Lokal</label>
                                        <input type="text" class="form-control" id="nm_lokal" placeholder="nama lokal" name="nm_lokal" value="<?php echo $nm_lokal; ?>" maxlength="128">
                                        <input type="hidden" value="<?php echo $id_kd_lokal; ?>" name="id_kd_lokal" id="id_kd_lokal" />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nm_umum">Nama Umum</label>
                                        <input type="text" class="form-control" id="nm_umum" placeholder="nama umum" name="nm_umum" value="<?php echo $nm_umum; ?>" maxlength="128">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nm_latin">Nama Latin</label>
                                        <input type="text" class="form-control" id="nm_latin" placeholder="nama latin" name="nm_latin" value="<?php echo $nm_latin; ?>" maxlength="128">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="kd_ikan">Kode Ikan</label>
                                        <input type="text" class="form-control" id="kd_ikan" placeholder="kode ikan" name="kd_ikan" value="<?php echo $kd_ikan; ?>" maxlength="128">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="id_ikan">ID Ikan</label>
                                        <input type="text" class="form-control" id="id_ikan" placeholder="id ikan" name="id_ikan" value="<?php echo $id_ikan; ?>" maxlength="128">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="id_kel_ikan">ID Kel Ikan</label>
                                        <input type="text" class="form-control" id="id_kel_ikan" placeholder="id kel ikan" name="id_kel_ikan" value="<?php echo $id_kel_ikan; ?>" maxlength="128">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="kd_jenis_kel">Kode Jenis Kel</label>
                                        <input type="text" class="form-control" id="kd_jenis_kel" placeholder="kd_jenis_kel" name="kd_jenis_kel" value="<?php echo $kd_jenis_kel; ?>" maxlength="128">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="kd_tarif">Kode Tarif</label>
                                        <input type="text" class="form-control" id="kd_tarif" placeholder="kd_tarif" name="kd_tarif" value="<?php echo $kd_tarif; ?>" maxlength="128">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="kelas">Kelas</label>
                                        <input type="text" class="form-control" id="kelas" placeholder="kelas" name="kelas" value="<?php echo $kelas; ?>" maxlength="128">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="kelompok">Kelompok</label>
                                        <input type="text" class="form-control" id="kelompok" placeholder="kelompok" name="kelompok" value="<?php echo $kelompok; ?>" maxlength="128">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="konsumsi">Konsumsi</label>
                                        <input type="text" class="form-control" id="konsumsi" placeholder="konsumsi" name="konsumsi" value="<?php echo $konsumsi; ?>" maxlength="128">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tawar">Tawar</label>
                                        <input type="text" class="form-control" id="tawar" placeholder="tawar" name="tawar" value="<?php echo $tawar; ?>" maxlength="128">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="hidup">Hidup</label>
                                        <input type="text" class="form-control" id="hidup" placeholder="hidup" name="hidup" value="<?php echo $hidup; ?>" maxlength="128">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="bentuk">Bentuk</label>
                                        <input type="text" class="form-control" id="bentuk" placeholder="bentuk" name="bentuk" value="<?php echo $bentuk; ?>" maxlength="128">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="hias">Hias</label>
                                        <input type="text" class="form-control" id="hias" placeholder="hias" name="hias" value="<?php echo $hias; ?>" maxlength="128">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pelagis">Pelagis</label>
                                        <input type="text" class="form-control" id="pelagis" placeholder="pelagis" name="pelagis" value="<?php echo $pelagis; ?>" maxlength="128">
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
                                        <label for="hscode">hscode</label>
                                        <input type="text" class="form-control" id="hscode" placeholder="hscode" name="hscode" value="<?php echo $hscode; ?>" maxlength="128">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="no_urut_hs">No urut hs</label>
                                        <input type="text" class="form-control" id="no_urut_hs" placeholder="no_urut_hs" name="no_urut_hs" value="<?php echo $no_urut_hs; ?>" maxlength="128">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="aktif">Aktif</label>
                                        <input type="text" class="form-control" id="aktif" placeholder="aktif" name="aktif" value="<?php echo $aktif; ?>" maxlength="128">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="kd_ikan_lokal_ol">Kode Ikan Lokal ol</label>
                                        <input type="text" class="form-control" id="kd_ikan_lokal_ol" placeholder="kd_ikan_lokal_ol" name="kd_ikan_lokal_ol" value="<?php echo $kd_ikan_lokal_ol; ?>" maxlength="128">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nilai">Nilai</label>
                                        <input type="text" class="form-control" id="nilai" placeholder="nilai" name="nilai" value="<?php echo $nilai; ?>" maxlength="128">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="id_satuan">ID Satuan</label>
                                        <input type="text" class="form-control" id="id_satuan" placeholder="id_satuan" name="id_satuan" value="<?php echo $id_satuan; ?>" maxlength="128">
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" id="password" placeholder="Password" name="password" maxlength="20">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cpassword">Confirm Password</label>
                                        <input type="password" class="form-control" id="cpassword" placeholder="Confirm Password" name="cpassword" maxlength="20">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nm_latin">nm_latin Number</label>
                                        <input type="text" class="form-control" id="nm_latin" placeholder="nm_latin Number" name="nm_latin" value="<?php echo $nm_latin; ?>" maxlength="10">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="role">Role</label>
                                        <select class="form-control" id="role" name="role">
                                            <option value="0">Select Role</option>
                                            <?php
                                            if (!empty($roles)) {
                                                foreach ($roles as $rl) {
                                            ?>
                                                    <option value="<?php echo $rl->roleId; ?>" <?php if ($rl->roleId == $roleId) {
                                                                                                    echo "selected=selected";
                                                                                                } ?>><?php echo $rl->role ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div> -->
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