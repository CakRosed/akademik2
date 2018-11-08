

<!-- SELECT2 EXAMPLE -->
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">INFORMASI SEKOLAH</h3>

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
                echo form_open_multipart('sekolah', 'role="from"');
                echo form_hidden('kd_sekolah', $sekolah->kd_sekolah);
               ?> 
               
                <!-- nisn -->
                <div class="form-group">
                  <label>NAMA SEKOLAH</label>

                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-building"></i>
                    </div>
                    <?php echo form_input(array(
                      'type'          =>'text', 
                      'placeholder'   =>'Madrasah Tsanawiyah Nurus Sa\'adah', 
                      'name'          =>'nama_sekolah', 
                      'id'            =>'nama_sekolah', 
                      'class'         =>'form-control', 
                      'required'      =>'required', 
                      'value'         => $sekolah->nama_sekolah 
                      )); 
                    ?>
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->


				<!-- email  -->
              <div class="form-group">
                <label>EMAIL</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-envelope"></i>
                  </div>
                  <?php echo form_input(array(
                    'type'        =>'text', 
                    'placeholder' =>'ex. nurus_saadah_mts@yahoo.com', 
                    'name'        =>'email', 
                    'id'          =>'email', 
                    'class'       =>'form-control', 
                    'required'    =>'required', 
                    'value'       => $sekolah->email 
                    )); 
                  ?>  
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->

			<!-- lephone  -->
              <div class="form-group">
                <label>TELPON</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-phone"></i>
                  </div>
                  <?php echo form_input(array(
                    'type'        =>'text', 
                    'placeholder' =>'ex. (031)88580137', 
                    'name'        =>'telpon', 
                    'id'          =>'telpon', 
                    'class'       =>'form-control', 
                    'required'    =>'required', 
                    'value'       => $sekolah->telpon 
                    )); 
                  ?>  
                </div> 
                <!-- /.input group -->
              </div>
              <!-- /.form group -->


              <!-- alamat  -->
              <div class="form-group">
                <label>ALAMAT</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-map-marker"></i>
                  </div>
                  <?php echo form_input(array(
                    'type'        =>'text', 
                    'placeholder' =>'wonomlati RT.16 RW.08 Krembung Sidoarjo(61275)', 
                    'name'        =>'alamat_sekolah', 
                    'id'          =>'alamat_sekolah', 
                    'class'       =>'form-control',
                    'style'       =>'margin:0px 74.5px 0px 0px; height: 75px; width: 485px', 
                    'required'    =>'required', 
                    'value'       => $sekolah->alamat_sekolah 
                    )); 
                  ?>  
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->


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

                <a href="<?php echo base_url('sekolah'); ?>" type="button" class="btn btn-block btn-warning btn-flat">BATAL</a>
              </div>
            </div>
            <!-- /.row -->


            </div>
            <!-- / .col -->
          </div>
          <!-- /.row -->
        </div>
