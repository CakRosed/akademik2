<div class="row">
    <!-- star col-8 -->
    <div class="col-md-8">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">FORM DATA SISWA</h3>

                <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                </div>
            </div>
            <!-- /.box-header -->

            <div class="box-body">
                <div id="table"></div>
            </div>
        </div>
        <!-- end box 1 -->
    </div>
    <!-- end col-8 -->

    <!-- start col-4 -->
    <div class="col-md-4">
        <!-- start box 2 -->
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">FORM PEMBAYARAN</h3>
                <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
                </div>
            </div>
            <!-- /.box-header -->

            <div class="box-body">
                <!-- tahun akademik -->
                <div class="form-group">
                    <label>TAHUN AKADEMIK</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-calendar-o"></i>
                        </div>
                        <?php echo cmb_dinamis('tahun_akademik', 'tbl_tahun_akademik', 'tahun_akademik', 'kd_tahun_akademik', get_tahun_akademik_aktif('kd_tahun_akademik'), 'class="form-control" id="tahun_akademik" onchange="loadData()"'); ?>
                    </div>
                    <!-- /.input group -->
                </div>
                <!-- /.form group -->
            
                <!-- kelas -->
                <div class="form-group">
                    <label>KELAS</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-sitemap"></i>
                        </div>
                        <?php echo cmb_kelas('loadRombel()'); ?>
                    </div>
                    <!-- /.input group -->
                </div>
                <!-- /.form group -->
                
                <!-- rombel -->
                <div class="form-group">
                    <label>ROMBONGAN BELAJAR</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-users"></i>
                        </div>
                        <div id="rombel"></div>
                    </div>
                    <!-- /.input group -->
                </div>
                <!-- /.form group -->
                
                <!-- jenis pembayaran -->
                <div class="form-group">
                    <label>JENIS PEMBAYARAN</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                        <i class="fa fa-money"></i>
                        </div>
                        <?php echo cmb_dinamis('jenis_pembayaran', 'tbl_jenis_pembayaran', 'nama_jenis_pembayaran', 'id_jenis_pembayaran', null, 'class="form_control" id="jenis_pembayaran" onchange="loadData()"'); ?>
                    </div>
                    <!-- /.input group -->
                </div>
                <!-- /.form group -->
                
                <button class='btn btn-block btn-danger btn-flat btn-sm'>
                    CETAK LAPORAN <i class='fa fa-file-excel-o'></i>
                </button>
            </div>
            <!-- end box-body -->
        </div>
        <!-- end box 2 -->
    </div> 
    <!-- end col-4 -->
</div>
<!-- end row -->

<script type="text/javascript">
    $(document).ready(function(){
        loadRombel();
    });
</script>

<script type='text/javascript'>
    function loadRombel(){
        var kelas = $('#kelas').val();
        $.ajax({
            type  : 'GET',
            url   : '<?php echo base_url("keuangan/showRombel"); ?>',
            data  : 'kelas='+kelas,
            success:function(html){
                $('#rombel').html(html);
                loadData();
            }
        });
    }

    function loadData(){
        var id_rombel       = $('#id_rombel').val();
        var tahun_akademik  = $('#tahun_akademik').val();
        var jenis_pembayaran= $('#jenis_pembayaran').val();
        $.ajax({
            type  : 'GET',
            url   : '<?php echo base_url("keuangan/loadData"); ?>',
            data  : 'tahun_akademik='+tahun_akademik+'&id_rombel='+id_rombel+'&jenis_pembayaran='+jenis_pembayaran,
            success:function(html){
                $('#table').html(html);
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


