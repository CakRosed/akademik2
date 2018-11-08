

<!-- SELECT2 EXAMPLE -->
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">UBAH DATA TAHUN AKADEMIK</h3>

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
                echo form_open_multipart('tahun_akademik/edit', 'role="from"');
                echo form_hidden('kd_tahun_akademik', $tahun_akademik->kd_tahun_akademik);
               ?>

                <!-- nisn -->
                <div class="form-group">
                  <label>TAHUN AKADEMIK</label>

                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar-o"></i>
                    </div>
                    <?php echo form_input(array(
                      'type'          =>'text', 
                      'name'          =>'tahun_akademik', 
                      'id'            =>'tahun_akademik', 
                      'class'         =>'form-control', 
                      'required'      =>'required', 
                      'value'         => $tahun_akademik->tahun_akademik,
                      'readonly'      => 'readonly' 
                      )); 
                    ?>
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->

              <!-- nama  -->
              <div class="form-group">
                <label>TAHUN AKADEMIK AKTIF</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-check-square-o"></i>
                  </div>
                  <?php echo form_dropdown('is_aktif', array('y'=>'AKTIF', 'n'=>'TIDAK AKTIF'), $tahun_akademik->is_aktif, 'class="form-control"'); ?>  
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

                <a href="<?php echo base_url('tahun_akademik'); ?>" type="button" class="btn btn-block btn-warning btn-flat">BATAL</a>
              </div>
            </div>
            <!-- /.row -->


            </div>
            <!-- / .col -->
          </div>
          <!-- /.row -->
        </div>
