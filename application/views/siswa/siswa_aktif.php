<div class="row">
  <div class="col-md-12">
    <div class="box">
      <!-- /.box-header -->
      <div class="box-body">
        <?php echo form_open('siswa/exportExcel'); ?>
        <?php
          $rombel = $this->uri->segment(3);
          $jurusan= $this->uri->segment(4);
          if (!empty($rombel) && !empty($jurusan)) {
            $kd_rombel = $rombel;
            $kd_jurusan= $jurusan; 
          }else{
            $kd_rombel = null;
            $kd_jurusan= null;
          }
        ?>
        <table class="table table-bordered" style="width:100%">
          <tr>
            <td>JURUSAN</td>
            <td><?php echo cmb_dinamis('jurusan', 'tbl_jurusan', 'nama_jurusan', 'kd_jurusan',$kd_jurusan, 'id="jurusan" onchange="loadRombel()"'); ?></td>
          </tr>
            <td>ROMBONGAN BELAJAR</td>
            <td><div id="showRombel"></div></td>
          </tr>
          <tr>
            <td colspan="2">
              <button target="blank" class="btn btn-danger  btn-sm" name="exportJadwal"  type="submit"><i class="fa fa-file-excel-o"> Export Excel</i></button>
            </td>
          </tr>
        </form>
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
  </div> <!-- end col 10 -->
</div> <!-- end row -->

<script type="text/javascript">
  $(document).ready(function(){
    loadRombel();
  });
</script>

<script>
  function loadRombel(){
    var jurusan = $('#jurusan').val();
    var rombel  = '<?php $selected=$this->uri->segment(3); if(!empty($selected)){echo $selected;}else{echo "";} ?>';
    $.ajax({
      type   : 'GET',
      url    : '<?php echo base_url("siswa/showRombel/"); ?>',
      data   : 'jurusan='+jurusan+'&rombel='+rombel,
      success:function(html){
        $('#showRombel').html(html);
        loadData();
      }
    });
  } //end loadRombel

  function loadData(){
    var jurusan = $('#jurusan').val();
    var rombel  = $('#rombel').val();
    $.ajax({
      type   : 'GET',
      url    : '<?php echo base_url("siswa/loadData"); ?>',
      data   : 'jurusan='+jurusan+'&rombel='+rombel,
      success:function(html){
        $('#tabel').html(html);
        $('#example1').dataTable({
        'paging'      : true,
        'lengthChange': true,
        'searching'   : true,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : true
      });
      }
    });
  }

</script>

