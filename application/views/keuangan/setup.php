
<div class="box">
    <div class="box-header">
        <div class="col-md-3"><h5>TAHUN AKADEMIK  <?php echo get_tahun_akademik_aktif('tahun_akademik'); ?></h5></div>
    </div>
    <div class="box-body">
    <?php echo form_open('keuangan/setup'); ?>
        <table class="table table-bordered table-hover table-stripped" id="example1">
            <thead>
                <th>NO.</th>
                <th>JENIS PEMBAYARAN</th>
                <th>BIAYA</th>
            </thead>
            <tbody>
            <?php
                $info = $this->db->get('tbl_jenis_pembayaran')->result();
                $no = 1;
                foreach ($info as $row) {
                    echo 
                    "<tr>
                        <td class='text-center'>".$no++."</td>
                        <td class='text-center'>".$row->nama_jenis_pembayaran."</td>
                        <td class='text-center'>
                            <div class='input-group'>
                                <div class='input-group-addon'>
                                Rp.
                                </div>
                                <input type='text' value='".check_biaya($row->id_jenis_pembayaran)."' name='$row->id_jenis_pembayaran' id='biaya' class='form-control' placeholder='masukkan biaya ".strtolower($row->nama_jenis_pembayaran)."'>
                            </div>
                        </td>
                    </tr>";
                }
                ?>
            </tbody> 
        </table>
        <button href='setup' type='submit' name='submit' class='btn btn-success btn-sm btn-flat'>SIMPAN PERUBAHAN</button>
        <?php echo form_close();?>
    </div>
</div>



