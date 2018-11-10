<div class="row">
  <div class="col-md-4">
    <div class="box">
      <!-- /.box-header -->
      <div class="box-body">
        <table class="table table-bordered" style="width:100%">
          <tr>
            <td>JURUSAN</td>
            <td><?php echo cmb_dinamis('jurusan', 'tbl_jurusan', 'nama_jurusan', 'kd_jurusan',null, 'id="jurusan" onChange="loadData()"'); ?></td>
          </tr>
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
    var jurusan = $('#jurusan').val();
    var kelas   = $('#kelas').val();
    $.ajax({
      type:'GET',
      url : '<?php echo base_url() ?>kurikulum/dataKurikulumDetail',
      data: 'jurusan='+jurusan+'&kelas='+kelas,
      success:function(html){
        $("#tabel").html(html);
      }
    })
  }

  function filterData(){
    loadData();
  }
</script>