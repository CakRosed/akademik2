

<!-- SELECT2 EXAMPLE -->
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">INPUT KURIKULUM</h3>

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
                echo form_open_multipart('kurikulum/add', 'role="from"');
               ?>

                <!-- nisn -->
                <div class="form-group">
                  <label>KURIKULUM</label>

                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar-o"></i>
                    </div>
                    <?php echo form_input(array(
                      'type'          =>'text', 
                      'placeholder'   =>'KURIKULUM 2019', 
                      'name'          =>'nama_kurikulum', 
                      'id'            =>'nama_kurikulum', 
                      'class'         =>'form-control', 
                      'required'      =>'required', 
                      'value'         => set_value('nama_kurikulum') 
                      )); 
                    ?>
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->

              <!-- nama  -->
              <div class="form-group">
                <label>KURIKULUM AKTIF</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-check-square-o"></i>
                  </div>
                  <?php echo form_dropdown('is_aktif', array('y'=>'AKTIF', 'n'=>'TIDAK AKTIF'), null, 'class="form-control"') ?>
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

                <a href="<?php echo base_url('kurikulum'); ?>" type="button" class="btn btn-block btn-warning btn-flat">BATAL</a>
              </div>
            </div>
            <!-- /.row -->


            </div>
            <!-- / .col -->
          </div>
          <!-- /.row -->
        </div>
