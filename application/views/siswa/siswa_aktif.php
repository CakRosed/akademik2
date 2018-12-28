<div class="row">
  <div class="col-md-12">
    <div class="box">
      <!-- /.box-header -->
      <div class="box-body">
        <?php echo form_open('siswa/exportExcel'); ?>
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
    var kelas = $('#kelas').val();
    var rombel  = '<?php $selected=$this->uri->segment(3); if(!empty($selected)){echo $selected;}else{echo "";} ?>';
    $.ajax({
      type   : 'GET',
      url    : '<?php echo base_url("siswa/showRombel/"); ?>',
      data   : 'kelas='+kelas+'&rombel='+rombel,
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

