

<!-- SELECT2 EXAMPLE --> 
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">EDIT DATA MAPEL</h3>

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
                echo form_open_multipart('rombel/edit/'.$this->uri->segment(3), 'role="from"');
               ?>
     
                <!-- nama -->
                <div class="form-group">
                  <label>NAMA ROMBONGAN BELAJR</label>

                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-users"></i>
                    </div>
                    <?php echo form_input(array(
                      'type'          =>'text', 
                      'placeholder'   =>'xEINSTEIN', 
                      'name'          =>'nama_rombel', 
                      'id'            =>'nama_rombel', 
                      'class'         =>'form-control', 
                      'required'      =>'required', 
                      'value'         => $rombel->nama_rombel 
                      )); 
                    ?>
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->

              <!-- kelas  -->
              <div class="form-group">
                <label>KELAS</label>
                <!-- stuck broooooooooooooooooooooooooooooooooooooooooo -->
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-building"></i>
                  </div>
                  <select name="kelas" id="kelas" class="form-control" >
                    <?php for ($i=1; $i <= $kelas->jumlah_kelas; $i++) { 
                      echo "<option value='$i'>KELAS $i</option>";
                    } ?>
                  </select>
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->

              <!-- jurusan -->
                <div class="form-group">
                  <label>JURUSAN</label>

                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-sitemap"></i>
                    </div>
                    <?php echo cmb_dinamis('jurusan','tbl_jurusan', 'nama_jurusan', 'kd_jurusan', $rombel->kd_jurusan); ?>
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->

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

                <a href="<?php echo base_url('rombel'); ?>" type="button" class="btn btn-block btn-warning btn-flat">BATAL</a>
              </div>
            </div>
            <!-- /.row -->


            </div>
            <!-- / .col -->
          </div>
          <!-- /.row -->
        </div>
