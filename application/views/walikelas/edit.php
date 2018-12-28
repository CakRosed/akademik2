<div class="box box-success">
  <div class="box-header">
    <h3 class="box-title">INPUT DATA WALIEKAS</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
    </div>
  </div>
  <!-- end box-header -->

  <div class="box-body">
    <div class="row">
      <div class="col-md-6">
        <?php echo form_open_multipart('walikelas/update', 'role="from"');?> 
        <?php echo form_hidden('id_walikelas', $walikelas->id_walikelas);?>
        <div class="form-group"> 
          <label>KELAS</label> 
          <div class="input-group">
            <div class="input-group-addon">
              <i class="fa fa-id-card-o"></i>
            </div>
            <?php cmb_kelas('loadRombel()', $walikelas->kelas); ?>
          </div>
          <!-- /.input group --> 
        </div>
        <!-- /.form group -->
        
        <!-- rombel -->
        <div class="form-group">
          <label>ROMBONGAN BELAJAR</label>

          <div class="input-group">
            <div class="input-group-addon">
              <i class="fa fa-book"></i>
            </div> 
            <div id="rombel"></div> 
          </div>
          <!-- /.input group -->
        </div>
        <!-- /.form group -->
      </div>
      <!-- end col-6 1 -->

      <div class="col-md-6">
        <!-- nama  -->
        <div class="form-group">
          <label>WALI KELAS</label>

          <div class="input-group">
            <div class="input-group-addon">
              <i class="fa fa-book"></i>
            </div>
            <?php echo cmb_dinamis('guru', 'tbl_guru', 'nama_guru', 'nuptk', $walikelas->id_guru, 'form-control'); 
            ?> 
          </div>
          <!-- /.input group -->
        </div>
        <!-- /.form group -->

        <p>anda telah menyetujui data dengan menekan tombol <span style="font-weight: bold">daftar </span><i class="fa fa-check"></i></p>
        <div class="row">
          <div class="col-md-6">
            <?php echo form_input(array(
              'type'=>'submit', 
              'name'=>'submit',  
              'class'=>'btn btn-block btn-success btn-flat',
              'value'=> 'UPDATE' 
              )); 
            ?>
            <?php echo form_close(); ?>
          </div>
          <!-- end col-6 2.1 -->
          <div class="col-md-6">
            <a href="<?php echo base_url('walikelas'); ?>" type="button" class="btn btn-block btn-warning btn-flat">BATAL</a>
          </div>
          <!-- end col-6 2.2 -->
        </div>
        <!-- end row -->

      </div>
      <!-- end col-6 2 -->
    </div>
    <!-- end row -->
  </div>
  <!-- end box-body -->
</div> 
<!-- end box -->


<script type="text/javascript">
  $(document).ready(function(){
    loadRombel();
  });
</script>

<script>
  function loadRombel(){
    var kelas = $('#kelas').val();
    $.ajax({
      type  : 'GET',
      url   : '<?php echo base_url("walikelas/showRombel"); ?>',
      data  : 'kelas='+kelas,
      success:function(html){
        $('#rombel').html(html);
      }
    });
  }
</script>