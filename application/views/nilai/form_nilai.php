<div class="box">
    <div class="box-header">
        <div class="col-md-12">
            <table class="table table-bordered table-striped table-hover">
                <tr>
                    <td>TAHUN AKADEMIK</td>
                    <td><?php echo get_tahun_akademik_aktif('tahun_akademik'); ?></td>
                </tr>
                <tr>
                    <td>SEMESTER</td>
                    <td><?php echo get_tahun_akademik_aktif('semester_aktif'); ?></td>
                </tr>
                <tr>
                    <td>JURUSAN</td>
                    <td><?php echo $info->kd_jurusan; ?></td>
                </tr>
                <tr>
                    <td>ROMBONGAN BELAJAR</td>
                    <td><?php echo $info->nama_rombel; ?></td>
                </tr>
            </table>
        </div>    
    </div> 
    <!-- end box header -->
    <div class="box-body">
        <div class="col-md12">
            <table id="example1" class="table table-bordered table-hover table-responsive">
                <thead>
                    <tr>
                    <th class="text-center">NO.</th>
                    <th class="text-center">NIS</th>
                    <th class="text-center">NAMA SISWA</th>
                    <th class="text-center">NILAI</th>
                </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
        </div>
    </div>
    <!-- end box body -->
</div>

<script type="text/javascript">
    var nilai = $('#nilai'+nim).val();
    function updateNilai(nim){
        $.ajax({
            type   : 'GET',
            url    : '<?php echo base_url("nilai/edit") ?>',
            data   : 'nim='+nim+'&id_jadwal='+<?php echo $this->uri->segment(3) ?>+'&nilai='+nilai,
            success:function(html){

            }
        });
    }
</script>
