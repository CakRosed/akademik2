
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">EDIT DATA JENIS PEMBAYARAN</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
        </div>
      
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-6">
            
              <?php echo form_open_multipart('jenis_pembayaran/edit', 'role="from"');?>

              <?php echo form_hidden('id_jenis', $info->id_jenis_pembayaran);?>

                <!-- nisn -->
                <div class="form-group">
                  <label>NAMA JENIS PEMBAYARAN</label>

                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-id-card-o"></i>
                    </div>
                    <?php echo form_input(array(
                      'type'          =>'text', 
                      'placeholder'   =>'ex. SPP', 
                      'name'          =>'nama_jenis', 
                      'id'            =>'nama_jeniss', 
                      'class'         =>'form-control', 
                      'required'      =>'required', 
                      'value'         => $info->nama_jenis_pembayaran 
                      )); 
                    ?>
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
                    'value'=> 'EDIT' 
                    )); 
                  ?>

              <?php echo form_close(); ?>

                <a href="<?php echo base_url('jenis_pembayaran'); ?>" type="button" class="btn btn-block btn-warning btn-flat">BATAL</a>
              </div>
            </div>
            <!-- /.row -->


            </div>
            <!-- / .col -->
          </div>
          <!-- /.row -->
        </div>
