

<!-- SELECT2 EXAMPLE -->
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">UBAH DATA RUANG KELAS</h3>

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
                echo form_open_multipart('ruangan/edit', 'role="from"');
                echo form_hidden('kd_ruangan', $ruangan->kd_ruangan);
               ?>

                <!-- nisn -->
                <div class="form-group">
                  <label>KODE RUANG KELAS</label>

                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-id-card-o"></i>
                    </div>
                    <?php echo form_input(array(
                      'type'          =>'text', 
                      'placeholder'   =>'ex. BIND11081', 
                      'name'          =>'kd_ruangan', 
                      'id'            =>'kd_ruangan', 
                      'class'         =>'form-control', 
                      'required'      =>'required', 
                      'value'         => $ruangan->kd_ruangan,
                      'readonly'      => 'readonly' 
                      )); 
                    ?>
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->

              <!-- nama  -->
              <div class="form-group">
                <label>NAMA RUANG KELAS</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-building"></i>
                  </div>
                  <?php echo form_input(array(
                    'type'        =>'text', 
                    'placeholder' =>'ex. BAHASA INDONESIA', 
                    'name'        =>'nama_ruangan', 
                    'id'          =>'nama_ruangan', 
                    'class'       =>'form-control', 
                    'required'    =>'required', 
                    'value'       => $ruangan->nama_ruangan 
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

                <a href="<?php echo base_url('ruangan'); ?>" type="button" class="btn btn-block btn-warning btn-flat">BATAL</a>
              </div>
            </div>
            <!-- /.row -->


            </div>
            <!-- / .col -->
          </div>
          <!-- /.row -->
        </div>
