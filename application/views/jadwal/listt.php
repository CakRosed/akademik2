<div class="row">
  <div class="col-md-12">
    <div class="box">
      <!-- /.box-header -->
      <div class="box-body">
        <table class="table table-bordered" style="width:100%">
          <tr>
            <td>JURUSAN</td>
            <td><?php echo cmb_dinamis('jurusan', 'tbl_jurusan', 'nama_jurusan', 'kd_jurusan',null, 'id="jurusan" onChange="loadRombel()"'); ?></td>
          </tr>
          <tr>
            <td>KELAS</td>
            <td>
              <select class="form-control" name="kelas" id="kelas" onchange="loadRombel()">
                <?php 
                  for ($i=1; $i <= $info->jumlah_kelas ; $i++) { 
                    echo "<option value='$i'>KELAS $i</option>";
                  }
                 ?>
              </select>
            </td>
          </tr>
          <tr>
            <td>ROMBONGAN BELAJAR</td>
            <td><div id="showRombel"></div></td>
          </tr>
          <tr>
            <td colspan="2">
              <!-- Button trigger modal -->
              <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">
                <i class="fa fa-cogs"></i> Generate Jadwal
              </button>
            </td>
          </tr>
       </table>
      </div> <!-- /.box-body -->
    </div> <!-- endbox -->
  </div> <!-- end col -->

  <div class="col-md-12">
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
    loadRombel();
  });
</script>

<script>
  function loadRombel(){
    var kelas   = $('#kelas').val();
    var jurusan = $('#jurusan').val();
    $.ajax({
      type  : 'GET',
      url   : '<?php echo base_url("jadwal/showRombel"); ?>',
      data  : 'kelas='+kelas+'&jurusan='+jurusan,
      success:function(html){
        $('#showRombel').html(html);
        loadPelajaran();
      }
    });
  }

  function loadPelajaran(){
    var jurusan   = $('#jurusan').val();
    var kelas     = $('#kelas').val();
    var rombel    = $('#rombel').val();
    $.ajax({
      type:'GET',
      url : '<?php echo base_url("jadwal/dataJadwal"); ?>',
      data: 'jurusan='+jurusan+'&rombel='+rombel+'&kelas='+kelas,
      success:function(html){
        $("#tabel").html(html);
      }
    })
  }

  function updateGuru(id){
    var guru  = $('#guru'+id).val();
    $.ajax({
      type  : 'GET',
      url   : '<?php echo base_url("jadwal/updateGuru"); ?>',
      data  : 'id_guru='+guru+'&id_jadwal='+id,
      success:function(html){
        $('#table').html(html);
      }
    });
  }

  function updateRuangan(id){
    var ruangan = $('#ruangan'+id).val();
    $.ajax({
      type  : 'GET',
      url   : '<?php echo base_url("jadwal/updateRuangan"); ?>',
      data  : 'kd_ruangan='+ruangan+'&id_jadwal='+id,
      success:function(html){
        $('#table').html(html);
      }
    });
  }

  function updateHari(id){
    var hari  = $('#hari'+id).val();
    $.ajax({
      type  : 'GET', 
      url   : '<?php echo base_url("jadwal/updateHari"); ?>',
      data  : 'hari='+hari+'&id_jadwal='+id,
      success:function(html){
        $('#table').html(html);
      }
    });
  }

  function updateJamMulai(id){
    var jamMulai  = $('#jamMulai'+id).val();
    $.ajax({
      type  : 'GET',
      url   : '<?php echo base_url("jadwal/updateJamMulai"); ?>',
      data  : 'jamMulai='+jamMulai+'&id_jadwal='+id,
      success:function(html){
        $('#table').html(html);
      }
    });
  }

  function updateJamSelesai(id){
    var jamSelesai  = $('#jamSelesai'+id).val();
    $.ajax({
      type  : 'GET',
      url   : '<?php echo base_url("jadwal/updateJamSelesai"); ?>',
      data  : 'jamSelesai='+jamSelesai+'&id_jadwal='+id,
      success:function(html){
        $('#table').html(html);
      }
    });
  }

  function filterData(){
    loadData();
  }
</script>


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
     <?php echo form_open('jadwal/generateJadwal'); ?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Generate Jadwal</h4>
      </div>
      <div class="modal-body">
        <table class="table table-bordered ">
          <tr>
            <td>KURIKULUM</td>
            <td><?php echo cmb_dinamis('kurikulum', 'tbl_kurikulum', 'nama_kurikulum', 'id_kurikulum'); ?></td>
          </tr>
          <tr>
            <td>SEMESTER</td>
            <td><?php echo form_dropdown('semester',  array('1'=>'SEMESTER 1', '2'=>'SEMESTER 2'), null, 'CLASS="form-control"'); ?></td>
          </tr>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" name="submit" class="btn btn-primary">SIMPAN</button>
      </div>
     </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal --> 