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
                    <th class="text-center">KELAS</th>
                    <th class="text-center">MATAPELAJARAN</th>
                    <th class="text-center">HARI</th>
                    <th class="text-center">JAM</th>
                    <th class="text-center">RUANGAN</th>
                </tr>
                </thead>
                <tbody>
                    
                <?php 
                    $no=1;
                    foreach ($info as $row) {
                        echo "<tr>
                            <td class='text-center'>".$no++."</td>
                            <td class='text-center'>".$row->kelas."</td>
                            <td>".$row->nama_mapel."</td>
                            <td class='text-center'>".$row->hari."</td>
                            <td class='text-center'>".$row->jam."</td>
                            <td class='text-center'>".$row->nama_ruangan."</td>
                        </tr>";
                    }
                ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- end box body -->
</div>
