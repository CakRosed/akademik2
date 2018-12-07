

<!-- SELECT2 EXAMPLE -->
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">INPUT DATA PENGGUNA SISTEM</h3>

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
                echo form_open_multipart('users/add', 'role="from"');
              ?>

                <!-- nisn -->
                <div class="form-group">
                  <label>NUPTK/USERNAME</label>

                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-id-card-o"></i>
                    </div>
                    <?php echo form_input(array(
                      'type'          =>'text', 
                      'placeholder'   =>'ex. AUNUR123', 
                      'name'          =>'username', 
                      'id'            =>'username', 
                      'class'         =>'form-control', 
                      'required'      =>'required', 
                      'value'         => set_value('username') 
                      )); 
                    ?>
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->

              <!-- nama  -->
              <div class="form-group">
                <label>NAMA LENGKAP PENGGUNA</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-user"></i>
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
              
              
              <div class="form-group">
                <label>PASSWORD</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-user"></i>
                  </div>
                  <?php echo form_input(array(
                    'type'        =>'password', 
                    'placeholder' =>'ex. AuNur135', 
                    'name'        =>'password', 
                    'id'          =>'password', 
                    'class'       =>'form-control', 
                    'required'    =>'required', 
                    'value'       => set_value('password') 
                    )); 
                  ?>  
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
              <div class="form-group">
                <label>KONFIRMASI PASSWORD</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-user"></i>
                  </div>
                  <?php echo form_input(array(
                    'type'        =>'password', 
                    'placeholder' =>'ex. AuNur135', 
                    'name'        =>'password2', 
                    'id'          =>'password2', 
                    'class'       =>'form-control', 
                    'required'    =>'required', 
                    'value'       => set_value('password2') 
                    )); 
                  ?>  
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
            </div>

            <div class="col-md-6">
              <!-- hak akses  -->
              <div class="form-group">
                <label>HAK AKSES</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-user"></i>
                  </div>
                  <?php echo cmb_dinamis('level', 'tbl_level_user', 'nama_level', 'id_level_user', null, 'class="form-control"'); ?>
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

                  <a href="<?php echo base_url('users'); ?>" type="button" class="btn btn-block btn-warning btn-flat">BATAL</a>
                </div>
              </div>
              <!-- /.row -->

            </div>
            <!-- / .col -->
          </div>
          <!-- /.row -->
        </div>
