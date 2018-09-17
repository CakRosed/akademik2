

<!-- SELECT2 EXAMPLE -->
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">INPUT DATA SISWA</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>

      
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
            
              <?php 
                echo form_open_multipart('siswa/add', 'role="from"');
               ?>

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
                      'value'         => set_value('nisn') 
                      )); 
                    ?>
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->

              <!-- nis -->
              <div class="form-group">
                <label>NIS</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-id-card"></i>
                  </div>
                  <?php echo form_input(array(
                    'type'        =>'text', 
                    'placeholder' =>'ex. 0000007888', 
                    'name'        =>'nis', 
                    'id'          =>'nis', 
                    'class'       =>'form-control', 
                    'required'    =>'required', 
                    'value'       => set_value('nis') 
                    )); 
                  ?>
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->

              <!-- nama siswa -->
              <div class="form-group">
                <label>NAMA SISWA</label>

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
                    'value'       => set_value('nama') 
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
                    'value'       => set_value('tempat_lahir') 
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
                      'value'       =>set_value('tanggal_lahir'),
                      'data-mask'
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
                    'value'       => set_value('nama_wali') 
                    )); 
                  ?>  
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->

               <!-- nomor ortu -->
              <div class="form-group">
                <label>NO. HANDPHONE WALI</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-mobile"></i>
                  </div>
                  <?php echo form_input(array(
                    'type'        =>'text', 
                    'placeholder' =>'ex. 089580446626', 
                    'name'        =>'hp_wali', 
                    'id'          =>'hp', 
                    'class'       =>'form-control', 
                    'value'       => set_value('hp'),
                    )); 
                  ?> 
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
            </div>
            <!-- /.col -->

            <div class="col-md-6">

             <div class="form-group">
                <label>JENIS KELAMIN</label>
                <select name="gender" class="form-control select2" style="width: 100%;">
                  <option selected="selected">Select..</option>
                  <option value="L">LAKI-LAKI</option>
                  <option value="P">PEREMPUAN</option>
                </select>
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label>AGAMA</label>
                <select name="agama" class="form-control select2" style="width: 100%;">
                  <option selected="selected">Select..</option>
                  <option value="01">ISLAM</option>
                  <option value="02">KRISTEN</option>
                  <option value="03">KATHOLIK</option>
                  <option value="04">HINDU</option>
                  <option value="05">BUDHA</option>
                  <option value="06">KONGHUCU</option>
                </select>
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
                    'value'       => set_value('alamat'),
                    'date-mask' 
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
                        <div class="fileupload-new thumbnail" style="width: 150px; height: 125px;"><img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA?text=no+image" alt="">
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
                <p>anda telah menyetujui data dengan menekan tombol <span style="font-weight: bold">daftar </span><i class="fa fa-check"></i></p>

                  <?php echo form_input(array(
                    'type'=>'submit', 
                    'name'=>'submit',  
                    'class'=>'btn btn-block btn-success btn-flat',
                    'value'=> 'DAFTAR' 
                    )); 
                  ?>

              <?php echo form_close(); ?>

                <button type="button" class="btn btn-block btn-warning btn-flat">BATAL</button>
              </div>
            </div>
            <!-- /.row -->


            </div>
            <!-- / .col -->
          </div>
          <!-- /.row -->
        </div>
