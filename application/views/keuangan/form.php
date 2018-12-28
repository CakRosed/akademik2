<div class="row">
    <!-- star col-8 -->
    <div class="col-md-8">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">FORM DATA SISWA</h3>

                <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                </div>
            </div>
            <!-- /.box-header -->

            <div class="box-body">
                <?php echo form_open_multipart('keuangan/form', 'role="from"'); ?> 
                <div class="row">
                    <div class="col-md-6">
                        <!-- nis -->
                        <div class="form-group">
                            <label>NIS</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                <i class="fa fa-id-card-o"></i>
                                </div>
                                <?php echo form_input(array(
                                'type'          =>'text', 
                                'placeholder'   =>'ex. 0015067888', 
                                'name'          =>'nis', 
                                'id'            =>'nis', 
                                'class'         =>'form-control', 
                                'required'      =>'required',
                                'onkeyup'       =>'auto_complete()'
                                )); 
                                ?>
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->

                        <!-- nisn -->
                        <div class="form-group">
                            <label>NISN</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                <i class="fa fa-id-card-o"></i>
                                </div>
                                <?php echo form_input(array(
                                'type'          =>'text', 
                                'placeholder'   =>'ex. 0015067888', 
                                'name'          =>'nisn', 
                                'id'            =>'nisn', 
                                'class'         =>'form-control', 
                                'required'      =>'required',
                                'readonly'      =>'readonly'
                                )); 
                                ?>
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->

                        <!-- nama -->
                        <div class="form-group">
                            <label>NAMA SISWA</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                <i class="fa fa-user-o"></i>
                                </div>
                                <?php echo form_input(array(
                                'type'          =>'text', 
                                'placeholder'   =>'ex. 0015067888', 
                                'name'          =>'nama', 
                                'id'            =>'nama', 
                                'class'         =>'form-control', 
                                'required'      =>'required',
                                'readonly'      =>'readonly'
                                )); 
                                ?>
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->

                        <!-- nama wali -->
                        <div class="form-group">
                            <label>NAMA WALI</label>

                            <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-user"></i>
                            </div>
                            <?php echo form_input(array(
                                'type'        =>'text', 
                                'placeholder' =>'ex. SUPARMAN', 
                                'name'        =>'nama_wali', 
                                'id'          =>'nama_wali', 
                                'class'       =>'form-control', 
                                'required'    =>'required',
                                'readonly'      =>'readonly'
                                )); 
                            ?>  
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->
                        
                        <!-- tempat lahir -->
                        <div class="form-group">
                            <label>TEMPAT LAHIR</label>

                            <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-address-card"></i>
                            </div>
                            <?php echo form_input(array(
                                'type'        =>'text', 
                                'placeholder' =>'ex. SIDOARJO', 
                                'name'        =>'tempat_lahir', 
                                'id'          =>'tempat_lahir', 
                                'class'       =>'form-control', 
                                'required'    =>'required',
                                'readonly'      =>'readonly' 
                                )); 
                            ?>
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->

                        <!-- tanggal lahir -->
                        <div class="form-group">
                            <label>TANGGAL LAHIR</label>

                            <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar-o"></i>
                            </div>
                            <?php 
                                echo form_input(array(
                                'type'        =>'text',
                                'placeholder' =>'ex. 08/10/1996',
                                'name'        =>'tanggal_lahir',
                                'id'          =>'tanggal_lahir',
                                'class'       =>'form-control',
                                'readonly'      =>'readonly'
                                ));
                            ?>
                        </div>
                            <!-- /.input group --> 
                        </div>
                        <!-- /.form group -->
                    </div>
                    <!-- end col-6.1 -->

                    <div class="col-md-6">
                        <!-- nomor ortu -->
                        <div class="form-group">
                            <label>NO. HANDPHONE WALI</label>

                            <div class="input-group">
                                <div class="input-group-addon">
                                <i class="fa fa-phone"></i>
                                </div>
                                <?php echo form_input(array(
                                'type'        =>'text', 
                                'placeholder' =>'ex. 089580446626', 
                                'name'        =>'hp_wali', 
                                'id'          =>'hp_wali', 
                                'class'       =>'form-control', 
                                'required'    =>'required',
                                'readonly'      =>'readonly'
                                )); 
                                ?> 
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->

                        <!-- /.form-group -->
                        <div class="form-group">
                            <label>ROMBONGAN BELAJAR</label>
                            <?php
                            // ($name, $table, $field, $pk, $selected)
                            echo cmb_dinamis('id_rombel', 'tbl_rombel', 'nama_rombel', 'kd_rombel', null, 'class="form-control" id="id_rombel" readonly="readonly"');
                            ?>
                        </div>
                        <!-- /.form-group -->

                        <!-- form-group -->
                        <div class="form-group">
                            <label>AGAMA</label>
                            <?php
                            // ($name, $table, $field, $pk, $selected)
                            echo cmb_dinamis('agama', 'tbl_agama', 'nama_agama', 'kd_agama', null, 'class="form-control" id="kd_agama" readonly="readonly"');
                            ?>
                        </div>
                        <!-- /.form-group -->
                        
                        <div class="form-group">
                            <label>JENIS KELAMIN</label>
                            <?php
                            echo form_dropdown('gender', array('L' => 'LAKI LAKI', 'P' => 'PEREMPUAN'), null, "class='form-control' id='gender' readonly='readonly'");
                            ?>
                        </div>

                        <!-- alamat -->
                        <div class="form-group">
                            <label>ALAMAT</label>
                            <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-map-marker"></i>
                            </div>
                                <?php echo form_textarea(array(
                                'type'        =>'text', 
                                'placeholder' =>'ex. ds.rejeni rt.08 rw.04 kec.krembung kab.sidoarjo', 
                                'name'        =>'alamat', 
                                'id'          =>'alamat', 
                                'class'       =>'form-control',
                                'style'       =>'margin:0px 74.5px 0px 0px; height: 110px; width:100%',
                                'row'         =>'3',
                                'readonly'    =>'readonly'  
                                )); 
                            ?>
                        </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->
                    </div>
                    <!-- end col-4.2 -->
                </div>
                <!-- end row -->
            </div>
        </div>
        <!-- end box 1 -->
    </div>
    <!-- end col-8 -->

    <!-- start col-4 -->
    <div class="col-md-4">
        <!-- start box 2 -->
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">FORM PEMBAYARAN</h3>
                <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                </div>
            </div>
            <!-- /.box-header -->

            <div class="box-body">
                <!-- jenis_pembayaran -->
                <div class="form-group">
                    <label>JENIS PEMBAYARAN</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-credit-card"></i>
                        </div>
                        <?php echo cmb_dinamis('jenis_pembayaran', 'tbl_jenis_pembayaran', 'nama_jenis_pembayaran', 'id_jenis_pembayaran', null, 'class="form-control jenis_pembayaran" id="jenis_pembayaran" onchange="complete_pembayaran()"');
                        ?>
                    </div>
                    <!-- /.input group -->
                </div>
                <!-- /.form group -->

                <!-- tanggal -->
                <div class="form-group">
                    <label>TANGGAL PEMBAYARAN</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                        </div>
                        <?php echo form_input(array(
                        'type'          =>'text', 
                        'placeholder'   =>'ex. 09/10/2013', 
                        'name'          =>'tanggal', 
                        'id'            =>'tanggal', 
                        'class'         =>'form-control', 
                        'required'      =>'required'
                        )); 
                        ?>
                    </div>
                    <!-- /.input group -->
                </div>
                <!-- /.form group -->


                <div class="row">
                    <div class="col-md-6">
                        <!-- jumlah -->
                        <div class="form-group">
                            <label>TELAH DIBAYAR</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                <i class="fa fa-money"></i>
                                </div>
                                <?php echo form_input(array(
                                'type'          =>'text', 
                                'placeholder'   =>'0,-', 
                                'name'          =>'jumlah_pembayaran', 
                                'id'            =>'jumlah_pembayaran', 
                                'class'         =>'form-control', 
                                'required'      =>'required',
                                'readonly'      =>'readonly'
                                )); 
                                ?>
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->
                    </div>
                    <!-- end col-6.1 -->
                    <div class="col-md-6">
                        <!-- jumlah -->
                        <div class="form-group">
                            <label>AKAN DITAMBAHKAN</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                <i class="fa fa-money"></i>
                                </div>
                                <?php echo form_input(array(
                                'type'          =>'text', 
                                'placeholder'   =>'ex. 95000', 
                                'name'          =>'akan_dibayar', 
                                'id'            =>'akan_dibayar', 
                                'class'         =>'form-control', 
                                'required'      =>'required'
                                )); 
                                ?>
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->
                    </div>
                    <!-- end col-6.2 -->
                </div>
                <!-- end row -->
                
                
                <!-- alamat -->
                <div class="form-group">
                    <label>KETERANGAN</label>
                    <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-pencil"></i>
                    </div>
                        <?php echo form_textarea(array(
                        'type'        =>'text', 
                        'placeholder' =>'ex. terlambat pembayaran selama 6 hari', 
                        'name'        =>'keterangan', 
                        'id'          =>'keterangan', 
                        'class'       =>'form-control',
                        'style'       =>'margin:0px 74.5px 0px 0px; height: 150px; width:100%',
                        'row'         =>'3'
                        )); 
                    ?>
                    </div>
                    <!-- /.input group -->
                </div>
                <!-- /.form group -->

                <?php echo form_input(array(
                    'type'=>'submit', 
                    'name'=>'submit',  
                    'class'=>'btn btn-block btn-success btn-flat',
                    'value'=> 'SUBMIT' 
                    )); 
                ?>
            <?php echo form_close(); ?>
            </div>
            <!-- end box-body -->
        </div>
        <!-- end box 2 -->
    </div> 
    <!-- end col-4 -->
</div>
<!-- end row -->


<script type='text/javascript'>
    function auto_complete(){
        var nis = $('#nis').val();
        $.ajax({
            type  : 'GET',
            url   : '<?php echo base_url("keuangan/auto_complete"); ?>',
            data  : 'nis='+nis,
            success:function(data){
                var json = data,
                obj = JSON.parse(json);
                $('#nisn').val(obj.nisn);
                $('#nama').val(obj.nama);
                $('#nama_wali').val(obj.nama_wali);
                $('#tempat_lahir').val(obj.tempat_lahir);
                $('#tanggal_lahir').val(obj.tanggal_lahir);
                $('#id_rombel').val(obj.id_rombel);
                $('#kd_agama').val(obj.kd_agama);
                $('#hp_wali').val(obj.hp_wali);
                $('#gender').val(obj.gender);
                $('#alamat').val(obj.alamat);
                complete_pembayaran();
            }
        });
    }

    function complete_pembayaran(){
        var jenis_pembayaran = $('#jenis_pembayaran').val();
        var nisn = $('#nisn').val();
        $.ajax({
            type  : 'GET',
            url   : '<?php echo base_url("keuangan/auto_pembayaran"); ?>',
            data  : 'jenis_pembayaran='+jenis_pembayaran+'&nisn='+nisn,
            success:function(data){
                var json = data,
                obj = JSON.parse(json);
                $('#tanggal').val(obj.tanggal);
                $('#jumlah_pembayaran').val(obj.jumlah);
                $('#keterangan').val(obj.keterangan);
            }
        });
    }
</script>


