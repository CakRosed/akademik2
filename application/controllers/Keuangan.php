<?php 
Class Keuangan extends CI_Controller{
    function __construct(){
        parent::__construct();
        check_akses_modul();
        $this->load->model('Model_keuangan', 'model');
    }

    function index(){
        $data = array(
        'icon'     => 'fa fa-search',
        'title'    => 'KEUANGAN',
        'parent'   => 'KEUANGAN',
        'child'    => 'LIST'
        );
        $this->template->load('template', 'keuangan/list', $data);
    } //end index

    function setup(){
        if (isset($_POST['submit'])) {
            $this->model->update_setup_biaya();
        }else{
            $data = array(
            'icon'     => 'fa fa-search',
            'title'    => 'KEUANGAN',
            'parent'   => 'KEUANGAN',
            'child'    => 'LIST',
            'info'     => $this->db->get('tbl_jenis_pembayaran')->result()
            );
            $this->template->load('template', 'keuangan/setup', $data);
        }
    } //end index


    function form(){
        if (isset($_POST['submit'])) {
            $this->model->add();
        }else{
            $data = array(
                'icon'     => 'fa fa-search',
                'title'    => 'KEUANGAN',
                'parent'   => 'KEUANGAN',
                'child'    => 'FORM PEMBAYARAN'
            );
            $this->template->load('template', 'keuangan/form', $data);
        }
    } //end form

    function auto_complete(){
        $nis    = strip_tags(trim($this->input->get('nis')));
        $tahun  = get_tahun_akademik_aktif('kd_tahun_akademik');

        $sql    =  "SELECT ts.*, tr.nama_rombel, th.id_rombel, th.id_tahun_akademik 
                    FROM tbl_history_kelas as th, tbl_siswa as ts, tbl_rombel as tr
                    WHERE th.nisn=ts.nisn and th.id_rombel=tr.kd_rombel and ts.nis=$nis and th.id_tahun_akademik=$tahun";
        
        $siswa  = $this->db->query($sql); 
        if ($siswa->num_rows() > 0) {
            $row    = $siswa->row();
            $param  = array(
                'nis'           =>  $row->nis,
                'nisn'          =>  $row->nisn,
                'nama'          =>  $row->nama,
                'nama_wali'     =>  $row->nama_wali,
                'tempat_lahir'  =>  $row->tempat_lahir,
                'tanggal_lahir' =>  $row->tanggal_lahir,
                'id_rombel'     =>  $row->id_rombel,
                'kd_agama'      =>  $row->kd_agama,
                'hp_wali'       =>  $row->hp_wali,
                'gender'        =>  $row->gender,
                'alamat'        =>  $row->alamat,
                'foto'          =>  $row->foto,

            );
            echo json_encode($param);
        }else{
            $param  = array(
                'nis'           =>  null,
                'nisn'          =>  null,
                'nama'          =>  null,
                'nama_wali'     =>  null,
                'tempat_lahir'  =>  null,
                'tanggal_lahir' =>  null,
                'id_rombel'     =>  null,
                'kd_agama'      =>  null,
                'hp_wali'       =>  null,
                'gender'        =>  null,
                'alamat'        =>  null,
                'foto'          =>  null);
                echo json_encode($param);
        }
        
    } //end auto complete

    function auto_pembayaran(){
        $where = array(
            'id_jenis_pembayaran'   => strip_tags(trim($this->input->get('jenis_pembayaran'))), 
            'nisn'                  => strip_tags(trim($this->input->get('nisn')))
        );
        $pembayaran = $this->db->get_where('tbl_pembayaran', $where);
        if ($pembayaran->num_rows() > 0) {
            $row    = $pembayaran->row();
            $param  = array(
                'tanggal'       => $row->tanggal, 
                'nisn'          => $row->nisn,
                'jumlah'        => $row->jumlah,
                'keterangan'    => $row->keterangan
            );
            echo json_encode($param);
        }else{
            $param  = array(
                'tanggal'       => null, 
                'nisn'          => null,
                'jumlah'        => null,
                'keterangan'    => null
            );
            echo json_encode($param);
        }
    } //end auto pembayaran

    function showRombel(){
        $kelas 		= strip_tags(trim($this->input->get('kelas')));
        $rombel = $this->db->get_where('tbl_rombel', array('kelas' => $kelas));
        echo "<select class='form-control' id='id_rombel' name='rombel' onchange='loadData()'>";
        foreach ($rombel->result() as $row) {
            echo "<option value='$row->kd_rombel'>$row->nama_rombel</option>";
        }
        echo "</select>";
    } //end showRombel

    function loadData(){
        $tahun_akademik     = strip_tags(trim($this->input->get('tahun_akademik')));
        $id_rombel          = strip_tags(trim($this->input->get('id_rombel')));
        $jenis_pembayaran   = strip_tags(trim($this->input->get('jenis_pembayaran')));
        
        $sql = "SELECT ts.nama, ts.nisn
                FROM tbl_history_kelas as th, tbl_siswa as ts, tbl_rombel as tr
                WHERE th.nisn=ts.nisn and th.id_tahun_akademik=$tahun_akademik and ts.id_rombel=tr.kd_rombel and ts.id_rombel=$id_rombel";
        $siswa = $this->db->query($sql)->result();

        $biaya_jenis = $this->db->get_where('tbl_biaya_sekolah', array('id_jenis_pembayaran'=>$jenis_pembayaran, 'id_tahun_akademik'=>$tahun_akademik))->row(); 
        
        echo 
        "<table class='table tbl-stripped tbl-hover tbl-bordered' id='example1'>
            <thead>
                <th>NO.</th>
                <th>NISN</th>
                <th>NAMA SISWA</th>
                <th>TERBAYAR</th>
                <th>KEKURANGAN</th>
            </thead>
            <tbody>";
                $no = 1;
                foreach ($siswa as $row) {
                    $where = array(
                        'id_jenis_pembayaran'   => $jenis_pembayaran,
                        'nisn'                  => $row->nisn);

                    $biaya = $this->db->get_where('tbl_pembayaran', $where)->row();
                    if (!empty($biaya->jumlah)) {
                        $biaya = $biaya->jumlah;
                    }else{
                        $biaya = "0 ,-";
                    }

                    $total = $biaya - $biaya_jenis->jumlah_biaya;
                    if ($total >= $biaya_jenis->jumlah_biaya) {
                        $kekurangan = '0 ,-';
                    }else{
                        $kekurangan = $total;
                    }

                    echo 
                    "<tr>
                        <td class='text-center'>".$no++."</td>
                        <td class='text-center'>".$row->nisn."</td>
                        <td>".$row->nama."</td>
                        <td class='text-center'>
                            <input type='text' class='form-control' id='biaya' readonly='readonly' value='$biaya'>
                        </td>
                        <td class='text-center'>
                            <input type='text' class='form-control' id='biaya' readonly='readonly' value='$kekurangan'>
                        </td>
                    </tr>";
                }
                echo    
            "</tbody>
        </table>";
    } //end loadData
} //end controller
?> 