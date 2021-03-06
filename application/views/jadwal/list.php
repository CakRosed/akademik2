<div class="row">
  <div class="col-md-10">
    <div class="box box-success">
      <!-- /.box-header -->
      <div class="box-body">
        <?php echo form_open('jadwal/cetak_jadwal'); ?>
        <table class="table table-bordered" style="width:100%">
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
              <button target="blank" class="btn btn-flat btn-success  btn-sm" name="export_jadwal"  type="submit"><i class="fa fa-print"> Cetak Jadwal</i></button>
            </td>
          </tr>
        </form>
        </table>
      </div> <!-- /.box-body -->
    </div> <!-- endbox -->
  </div> <!-- end col -->

  <div class="col-md-2">
    <div class="box box-danger">
      <div style="margin-left:5px; padding-bottom:19px; padding-top:19px;" class="box-body">
        <!-- Button trigger modal -->
        <div style="margin-left:15px; margin-bottom:15px;">
          <i class="fa fa-cogs fa-5x"></i><br>
        </div>
        <button class="btn btn-block btn-primary btn-sm btn-flat" data-toggle="modal" data-target="#myModal">
          Generate Jadwal
        </button>
        
          <a href="<?php echo base_url('jadwal/ressetJadwal'); ?>" class="btn btn-danger btn-flat btn-block btn-sm">
            Resset Jadwal
          </a>
        
      </div>
    </div>
  </div>

  <div class="col-md-12">
    <div class="box box-danger">
      <!-- /.box-header -->
      <div class="box-body">
        <div id="tabel"></div>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div> <!-- end col 10 -->
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
      data  : 'kelas='+kelas, 
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
      data: 'rombel='+rombel+'&kelas='+kelas,
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

  function updateJam(id){
    var jam  = $('#jam'+id).val();
    $.ajax({
      type  : 'GET',
      url   : '<?php echo base_url("jadwal/updateJam"); ?>',
      data  : 'jam='+jam+'&id_jadwal='+id,
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