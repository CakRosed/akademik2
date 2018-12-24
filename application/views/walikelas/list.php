
<div class="box">
    <div class="box-header">
        <div class="col-md-2"><h5>TAHUN AKADEMIK : </h5></div>
        <div class="col-md-3">
            <?php echo cmb_dinamis('tahun_akademik', 'tbl_tahun_akademik', 'tahun_akademik', 'kd_tahun_akademik', get_tahun_akademik_aktif('kd_tahun_akademik'), 'class="form-control" id="tahun_akademik" onchange="loadWalikelas()"'); ?>
        </div>
        <div class="col-md-3">                
            <a href="<?php echo base_url('walikelas/add'); ?>" type="button" class="btn btn-block btn-success btn-flat"><i class="fa fa-plus"></i> INPUT DATA WALIKELAS</a>
        </div> 
    </div>
    <div class="box-body">
        <div id="table"></div>
    </div>
</div>

<script type='text/javascript'>
    $(document).ready(function(){
        loadWalikelas();
    });
</script>

<script>
    function loadWalikelas(){
        var tahun_akademik  = $('#tahun_akademik').val();
        $.ajax({
            type : 'GET',
            url  : '<?php echo base_url("walikelas/loadData"); ?>',
            data : 'tahun_akademik='+tahun_akademik,
            success:function(html){
                $('#table').html(html);
            }
        });
    }
</script>
