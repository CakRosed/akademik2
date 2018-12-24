<div class="row">
  <div class="col-md-4">
    <div class="box">
      <!-- /.box-header -->
      <div class="box-body">
        <table class="table table-bordered" style="width:100%">
          <tr>
            <td>KELAS</td>
            <td>
              <select class="form-control" name="kelas" id="kelas" onchange="loadData()">
                <option value="semua_kelas">SEMUA KELAS</option>
                <?php 
                  for ($i=1; $i <= $info->jumlah_kelas ; $i++) { 
                    echo "<option value='$i'>KELAS $i</option>";
                  }
                ?>
              </select>
            </td>
          </tr>
          <tr>
            <td colspan="2">
              <a href="<?php echo base_url('kurikulum/adddetail/'.$this->uri->segment(3)); ?>" type="button" class="btn btn-block btn-success btn-flat"><i class="fa fa-plus"></i> TAMBAH DETAIL</a>
            </td>
          </tr>
        </table>
      </div> <!-- /.box-body -->
    </div> <!-- endbox -->
  </div> <!-- end col 4-->

  <div class="col-md-8">
    <div class="box">
      <!-- /.box-header -->
      <div class="box-body">
        <div id="tabel"></div>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div> <!-- end col 8 -->
</div> <!-- end row -->

<script type="text/javascript">
  $(document).ready(function(){
    loadData();
  });
</script>

<script>
  function loadData(){
    var kelas     = $('#kelas').val();
    var kd_jurusan= <?php echo $this->uri->segment(3); ?> 
    $.ajax({
      type:'GET',
      url : '<?php echo base_url() ?>kurikulum/dataKurikulumDetail/<?php echo $this->uri->segment(3) ?>',
      data: 'kelas='+kelas,
      success:function(html){
        $("#tabel").html(html);
        $('#example1').dataTable({
          'paging'      : true,
          'lengthChange': true,
          'searching'   : true,
          'ordering'    : true,
          'info'        : true,
          'autoWidth'   : true
        });
      }
    })
  }

  function filterData(){
    loadData();
  }
</script>