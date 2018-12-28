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
                    <td>MATA PELAJARAN</td>
                    <td><?php echo $info->nama_mapel; ?></td>
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
                    <?php 
                        $no=1;
                        foreach ($siswa as $row) {
                            echo 
                            "<tr>
                                <td width=50 class='text-center'>".$no++."</td>
                                <td class='text-center'>".$row->nis."</td>
                                <td>".$row->nama."</td>
                                <td width=100 class='text-center'>
                                    <input type='int' class='form-control' onkeyup='updateNilai(\"$row->nisn\")' id='nilai".$row->nisn."' value='".check_nilai($row->nisn, $this->uri->segment(3))."'>
                                </td>
                            </tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- end box body -->
</div>

<script type="text/javascript">
    
    function updateNilai(nisn){
    var nilai = $('#nilai'+nisn).val();
        $.ajax({
            type   : 'GET',
            url    : '<?php echo base_url("nilai/update") ?>',
            data   : 'nisn='+nisn+'&id_jadwal='+<?php echo $this->uri->segment(3) ?>+'&nilai='+nilai,
            success:function(html){
            }
        });
    }
</script>
