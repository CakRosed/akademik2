

<!-- SELECT2 EXAMPLE -->
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">EDIT DATA GURU</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
      
        <?php echo validation_errors(); ?>
      
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
            
              <?php 
                echo form_open_multipart('guru/add', 'role="from"');
                echo form_hidden('nuptk', $guru->nuptk);
               ?>

                <!-- nisn -->
                <div class="form-group">
                  <label>NUPTK</label>

                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-id-card-o"></i>
                    </div>
                    <?php echo form_input(array(
                      'type'          =>'number', 
                      'placeholder'   =>'ex. 0015067888', 
                      'name'          =>'nuptk', 
                      'id'            =>'nuptk', 
                      'class'         =>'form-control', 
                      'required'      =>'required', 
                      'value'         => $guru->nuptk,
                      'redonly'      => 'readonly' 
                      )); 
                    ?>
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->

              <!-- nama  -->
              <div class="form-group">
                <label>NAMA GURU</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-user-o"></i>
                  </div>
                  <?php echo form_input(array(
                    'type'        =>'text', 
                    'placeholder' =>'ex. M.AUNUR ROSIDIN', 
                    'name'        =>'nama', 
                    'id'          =>'nama', 
                    'class'       =>'form-control', 
                    'required'    =>'required', 
                    'value'       => $guru->nama_guru 
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
                    <i class="fa fa-address-card-o"></i>
                  </div>
                  <?php echo form_input(array(
                    'type'        =>'text', 
                    'placeholder' =>'ex. SIDOARJO', 
                    'name'        =>'tempat_lahir', 
                    'id'          =>'tempat_lahir', 
                    'class'       =>'form-control', 
                    'required'    =>'required', 
                    'value'       => $guru->tempat_lahir 
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
                    <i class="fa fa-address-card"></i>
                  </div>
                  <?php 
                    echo form_input(array(
                      'type'        =>'text',
                      'placeholder' =>'ex. 08/10/1996',
                      'name'        =>'tanggal_lahir',
                      'id'          =>'datemask',
                      'class'       =>'form-control',
                      'value'       => $guru->tanggal_lahir 
                    ));
                   ?>
               </div>
                <!-- /.input group --> 
              </div>
              <!-- /.form group -->


              <!-- nama wali -->
              <div class="form-group">
                <label>NOMOR HANPHONE</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-mobile"></i>
                  </div>
                  <?php echo form_input(array(
                    'type'        =>'number', 
                    'placeholder' =>'ex. 0895804266260', 
                    'name'        =>'nomor', 
                    'id'          =>'nomor', 
                    'class'       =>'form-control', 
                    'required'    =>'required', 
                    'value'       => $guru->nomor
                    )); 
                  ?>  
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->

               <!-- email -->
              <div class="form-group">
                <label>EMAIL</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-envelope"></i>
                  </div>
                  <?php echo form_input(array(
                    'type'        =>'email', 
                    'placeholder' =>'ex. aunur.rosidin@gmail.com', 
                    'name'        =>'email', 
                    'id'          =>'email', 
                    'class'       =>'form-control', 
                    'value'       => $guru->email
                    )); 
                  ?> 
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->

              <div class="form-group">
                <label>PENDIDIKAN TERAKHIR</label>
                <?php echo form_dropdown('pendidikan terakhir',
                  array(
                    '01' => 'SMA Sedrajat',
                    '02' => 'S1',
                    '03' => 'S2',
                    '04' => 'S3'
                  ), $guru->pendidikan_terakhir, 'class="form-control"'); ?>                
              </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->

            <div class="col-md-6">

               <div class="form-group">
                <label>JENIS KELAMIN</label>
                <?php echo form_dropdown('gender', 
                array(
                  'L'=>'LAKI-LAKI', 
                  'P'=>'PEREMPUAN'), $guru->gender, 'class="form-control"'); ?>
              </div>
              <!-- /.form-group -->

              <div class="form-group">
                <label>AGAMA</label>
                <?php echo cmb_dinamis('agama', 'tbl_agama', 'nama_agama', 'kd_agama', $guru->kd_agama); ?>
              </div>
              <!-- /.form-group -->

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
                    'style'       =>'margin:0px 74.5px 0px 0px; height: 75px; width: 485px',
                    'row'         =>'3', 
                    'value'       => $guru->alamat
                    )); 
                  ?>
               </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->

            <div class="row">              
              <div class="col-md-4 col-sm-12">
                <div class="form-group">
                    <label>
                        PILIH GAMBAR
                    </label>
                    <div class="fileupload fileupload-new" data-provides="fileupload"><input type="hidden">
                        <div class="fileupload-new thumbnail" style="width: 150px; height: 125px;"><img src="<?php echo base_url('upload/guru/'.$guru->foto); ?>" alt="">
                        </div>
                        <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 150px; max-height: 125px; line-height: 10px;"></div><br>
                        <div class="col-md-11 col-sm-8">
                            <span class="btn btn-xs btn-block btn-default btn-flat btn-file"><span class="fileupload-new"><i class="fa fa-picture-o"></i> Select</span><span class="fileupload-exists"><i class="fa fa-picture-o"></i> Change</span>
                                <input type="file" name="userfile">
                            </span>
                            <a href="#" class="btn btn btn-xs btn-block btn-danger btn-flat fileupload-exists" data-dismiss="fileupload">
                                <i class="fa fa-times"></i> Remove
                            </a>
                        </div>
                    </div>
                </div>
              </div>
              <!-- /.col -->
              <div class="col-md-6"><br>
                <p>anda telah menyetujui data dengan menekan tombol <span style="font-weight: bold">edit </span><i class="fa fa-check"></i></p>

                  <?php echo form_input(array(
                    'type'=>'submit', 
                    'name'=>'submit',  
                    'class'=>'btn btn-block btn-success btn-flat',
                    'value'=> 'EDIT' 
                    )); 
                  ?>

              <?php echo form_close(); ?>

                <a href="<?php echo base_url('guru'); ?>" type="button" class="btn btn-block btn-warning btn-flat">BATAL</a>
              </div>
            </div>
            <!-- /.row -->


            </div>
            <!-- / .col -->
          </div>
          <!-- /.row -->
        </div>
