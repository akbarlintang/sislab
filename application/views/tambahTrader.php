<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-users"></i>Trader
            <small>Tambah Trader</small>
        </h1>
    </section>

    <section class="content">

        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
                <!-- general form elements -->



                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Masukkan Detail Trader</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <?php $this->load->helper("form"); ?>
                    <form role="form" id="tambahTrader" action="<?php echo base_url() ?>tambahTraderBaru" method="post" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama">Nama Trader</label>
                                        <input type="text" class="form-control" id="nm_trader" placeholder="Nama Trader" name="nm_trader" value="<?php echo set_value('nm_trader'); ?>" maxlength="100">
                                        <!-- <input type="hidden" value="<?php echo $id_trader; ?>" name="id_trader" id="id_trader" /> -->
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama">Alamat Trader</label>
                                        <input type="text" class="form-control" id="al_trader" placeholder="Alamat Trader" name="al_trader" value="<?php echo set_value('al_trader'); ?>" maxlength="400">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama">Kota Trader</label>
                                        <input type="text" class="form-control" id="kt_trader" placeholder="Kota Trader" name="kt_trader" value="<?php echo set_value('kt_trader'); ?>" maxlength="4">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama">Kode Negara</label>
                                        <input type="text" class="form-control" id="kd_negara" placeholder="Kode Negara" name="kd_negara" value="<?php echo set_value('kd_trader'); ?>" maxlength="3">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama">NPWP</label>
                                        <input type="text" class="form-control" id="npwp" placeholder="NPWP" name="npwp" value="<?php echo set_value('npwp'); ?>" maxlength="20">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama">Nomor KTP</label>
                                        <input type="text" class="form-control" id="no_ktp" placeholder="Nomor KTP" name="no_ktp" value="<?php echo set_value('no_ktp'); ?>" maxlength="20">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama">PH Trader</label>
                                        <input type="text" class="form-control" id="ph_trader" placeholder="PH Trader" name="ph_trader" value="<?php echo set_value('ph_trader'); ?>" maxlength="20">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama">FX Trader</label>
                                        <input type="text" class="form-control" id="fx_trader" placeholder="FX Trader" name="fx_trader" value="<?php echo set_value('fx_trader'); ?>" maxlength="20">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama">IM Trader</label>
                                        <input type="text" class="form-control" id="im_trader" placeholder="IM Trader" name="im_trader" value="<?php echo set_value('im_trader'); ?>" maxlength="20">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama">No Izin</label>
                                        <input type="text" class="form-control" id="no_izin" placeholder="No Izin" name="no_izin" value="<?php echo set_value('no_izin'); ?>" maxlength="20">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" placeholder="email" name="email" value="<?php echo set_value('email'); ?>" maxlength="128">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama">Homepage</label>
                                        <input type="text" class="form-control" id="homepage" placeholder="Homepage" name="homepage" value="<?php echo set_value('homepage'); ?>" maxlength="20">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama">Id Kel Trader</label>
                                        <input type="text" class="form-control" id="id_kel_trader" placeholder="Id Kel Trader" name="id_kel_trader" value="<?php echo set_value('id_kel_trader'); ?>" maxlength="20">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama">Keterangan</label>
                                        <input type="text" class="form-control" id="keterangan" placeholder="Keterangan" name="keterangan" value="<?php echo set_value('keterangan'); ?>" maxlength="20">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama">Status</label>
                                        <input type="text" class="form-control" id="status" placeholder="Status" name="status" value="<?php echo set_value('status'); ?>" maxlength="20">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama">Ili</label>
                                        <input type="text" class="form-control" id="ili" placeholder="Ili" name="ili" value="<?php echo set_value('ili'); ?>" maxlength="20">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama">Aktif</label>
                                        <input type="text" class="form-control" id="aktif" placeholder="Aktif" name="aktif" value="<?php echo set_value('aktif'); ?>" maxlength="20">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama">Kd Trader Ol</label>
                                        <input type="text" class="form-control" id="kd_trader_ol" placeholder="Kd Trader Ol" name="kd_trader_ol" value="<?php echo set_value('kd_trader_ol'); ?>" maxlength="20">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama">Jenis Id</label>
                                        <input type="text" class="form-control" id="jns_id" placeholder="Jenis Id" name="jns_id" value="<?php echo set_value('jns_id'); ?>" maxlength="20">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama">Kode POS</label>
                                        <input type="text" class="form-control" id="kodepos" placeholder="Kode POS" name="kodepos" value="<?php echo set_value('kodepos'); ?>" maxlength="20">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email PJB</label>
                                        <input type="email" class="form-control" id="email_pjb" placeholder="Email PJB" name="email_pjb" value="<?php echo set_value('email_pjb'); ?>" maxlength="128">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="text">Kode NIKI</label>
                                        <input type="text" class="form-control" id="kd_niki" placeholder="Kode NIKI" name="kd_niki" value="<?php echo set_value('kd_niki'); ?>" maxlength="128">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama">NIKI</label>
                                        <input type="text" class="form-control" id="niki" placeholder="NIKI" name="niki" value="<?php echo set_value('niki'); ?>" maxlength="20">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="pth">PTH</label>
                                        <input type="text" class="form-control" id="pth" placeholder="PTH" name="pth" value="<?php echo set_value('pth'); ?>" maxlength="20">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama">Tanggal PTH</label>
                                        <input type="date" class="form-control" id="date_pth" placeholder="Tanggal PTH" name="date_pth" value="<?php echo set_value('date_pth'); ?>" maxlength="20">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nama">Badan Usaha</label>
                                        <input type="text" class="form-control" id="bdn_usaha" placeholder="Badan Usaha" name="bdn_usaha" value="<?php echo set_value('bdn_usaha'); ?>" maxlength="20">
                                    </div>
                                </div>
                            </div>

                            <!-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="role">Role</label>
                                        <select class="form-control required" id="role" name="role">
                                            <option value="0">Select Role</option>
                                            <?php
                                            if (!empty($roles)) {
                                                foreach ($roles as $rl) {
                                            ?>
                                                    <option value="<?php echo $rl->roleId ?>" <?php if ($rl->roleId == set_value('role')) {
                                                                                                    echo "selected=selected";
                                                                                                } ?>><?php echo $rl->role ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div> -->
                            <!-- </div> -->
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