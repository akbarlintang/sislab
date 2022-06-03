<?php
$kode_uji = $infoPermintaan_uji->kode_uji;
$jenis_parameter = $infoPermintaan_uji->jenis_parameter;
$no_ikm = $infoPermintaan_uji->no_ikm;
$keterangan_uji = $infoPermintaan_uji->keterangan_uji;
$standar_uji = $infoPermintaan_uji->standar_uji;
// $roleId = $infoPermintaan_uji->roleId;
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-users"></i> Permintaan Uji
            <small>Ubah Permintaan Uji</small>
        </h1>
    </section>

    <section class="content">

        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
                <!-- general form elements -->



                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Masukkan Detail Permintaan Uji</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->

                    <form role="form" action="<?php echo base_url() ?>editPermintaan_uji" method="post" id="editPermintaan_uji" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="jenis_parameter">Jenis Parameter</label>
                                        <input type="text" class="form-control" id="jenis_parameter" placeholder="jenis_parameter" name="jenis_parameter" value="<?php echo $jenis_parameter; ?>" maxlength="128">
                                        <input type="hidden" value="<?php echo $kode_uji; ?>" name="kode_uji" id="kode_uji" />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="no_ikm">No IKM</label>
                                        <input type="no_ikm" class="form-control" id="no_ikm" placeholder="no_ikm" name="no_ikm" value="<?php echo $no_ikm; ?>" maxlength="128">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="keterangan_uji">Keterangan Uji</label>
                                        <input type="text" class="form-control" id="keterangan_uji" placeholder="keterangan_uji" name="keterangan_uji" value="<?php echo $keterangan_uji; ?>" maxlength="128">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="standar_uji">Standar Uji</label>
                                        <input type="text" class="form-control" id="standar_uji" placeholder="standar_uji" name="standar_uji" value="<?php echo $standar_uji; ?>" maxlength="128">
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
                                        <label for="keterangan_uji">keterangan_uji Number</label>
                                        <input type="text" class="form-control" id="keterangan_uji" placeholder="keterangan_uji Number" name="keterangan_uji" value="<?php echo $keterangan_uji; ?>" maxlength="10">
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