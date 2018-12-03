
<div class="box">
    <div class="box-header">
        <div class='btn btn-warning col-md-12'><?php echo "<h5>TAHUN AKADEMIK ".$tahun_akademik->tahun_akademik." SEMESTER ".$tahun_akademik->semester_aktif."</h5>"; ?></div>
    </div>
    <div class="box-body">
        <table	id='example1' class="table table-striped table-bordered table-responsive table-hover table-full-width">
            <thead>
                <tr>
                    <th class="text-center">NO.</th>
                    <th class="text-center">ROMBONGAN BELAJAR</th>
                    <th class="text-center">JURUSAN</th>
                    <th class="text-center">KELAS</th>
                    <th class="text-center">NAMA WALIKELAS</th>
                </tr>
            </thead>
            <tbody>
                    <?php
                        $no=1;
                        foreach ($data as $row) {
                            echo 
                            '<tr>
                            <td class="text-center">'.$no++.'</td>
                            <td class="text-center">'.$row->nama_rombel.'</td>
                            <td class="text-center">'.$row->nama_jurusan.'</td>
                            <td class="text-center">'.$row->kelas.'</td>
                            <td class="text-center">'.cmb_dinamis('guru', 'tbl_guru', 'nama_guru', 'nuptk', $row->nuptk, 'id="guru" class="form-control" onchange="update_guru('.$row->id_walikelas.')"').'</td>
                            </tr>';
                        }
                    ?>
            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript">
    function update_guru(id_walikelas){
        var id_guru	     = $('#guru').val();
        $.ajax({
            type   : 'GET',
            url    : '<?php echo base_url("walikelas/update_walikelas"); ?>',
            data   : 'id_walikelas='+id_walikelas+'&id_guru='+id_guru
        });
    }
</script>