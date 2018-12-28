<?php 
    class Jadwal extends CI_Controller{
        function __construct(){
            parent::__construct();
            $this->load->model('Model_jadwal', 'model');
            check_akses_modul();
        }

        function index(){
            if($this->session->userdata('id_level_user')==3){
                $sql = "SELECT tj.id_jadwal,tj.kelas,tm.nama_mapel,tj.jam,tr.nama_ruangan,tj.hari,tj.semester 
                        FROM tbl_jadwal as tj, tbl_ruangan as tr, tbl_mapel as tm 
                        WHERE tj.kd_mapel=tm.kd_mapel and tj.kd_ruangan=tr.kd_ruangan and tj.id_guru=".$this->session->userdata('id_guru'); 
                
                $data = array(
                'icon'          => 'fa fa-search',
                'title'         => 'DETAIL JADWAL',
                'parent'        => 'JADWAL',
                'child'         => 'PENGATURAN',
                'info'          => $this->db->query($sql)->result(),
                );
                $this->template->load('template', 'jadwal/jadwal_ajar', $data);
            }else{
                $info_sekolah = "SELECT js.jumlah_kelas
                                FROM tbl_jenjang_sekolah as js, tbl_sekolah_info as si
                                WHERE js.kd_jenjang = si.kd_jenjang_sekolah";

                $data = array(
                'icon'          => 'fa fa-search',
                'title'         => 'DETAIL JADWAL',
                'parent'        => 'JADWAL',
                'child'         => 'PENGATURAN',
                'info'          => $this->db->query($info_sekolah)->row()
                );
                $this->template->load('template', 'jadwal/list', $data);
            }
        }
        
        function generateJadwal(){
            if(isset($_POST['submit'])){
                $this->model->generateJadwal();
            }else{ 
                redirecr('jadwal');
            }
        } //end generate

        function ressetJadwal(){
            $delete = $this->db->empty_table('tbl_jadwal');
            if ($delete) {
                redirect('jadwal');
            }
        }

        function dataJadwal(){
            $kelas          = strip_tags(trim($this->input->get('kelas'))); 
            $rombel         = strip_tags(trim($this->input->get('rombel'))); 
            // echo $rombel;die;
            $sql    = "SELECT tm.nama_mapel, tg.nama_guru, tr.nama_ruangan, tj.hari, tj.jam, tj.kd_ruangan, tj.id_guru, tj.id_jadwal
                        FROM tbl_jadwal as tj, tbl_mapel as tm, tbl_ruangan as tr, tbl_guru as tg, tbl_rombel as tb 
                        WHERE tj.kd_mapel=tm.kd_mapel and tj.kd_ruangan=tr.kd_ruangan and tj.id_guru=tg.nuptk and tj.kelas='$kelas'
                        and tj.id_rombel=tb.kd_rombel and tj.id_rombel=$rombel";
            $jadwal = $this->db->query($sql)->result();
            $jam    = $this->model->getJamPelajaran();
            $hari   = array(
                'SENIN'=>'SENIN',
                'SELASA'=>'SELASA',
                'RABU'=>'RABU',
                'KAMIS'=>'KAMIS',
                'JUMAT'=>'JUMAT',
                'SABTU'=>'SABTU',
                'MINGGU'=>'MINGGU'
            );

            echo '<table id="example1" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                        <th class="text-center">NO</th>
                        <th class="text-center">NAMA MATA PELAJARAN</th>
                        <th class="text-center">GURU</th>
                        <th class="text-center">RUANGAN</th>
                        <th class="text-center">HARI</th>
                        <th class="text-center">JAM</th>
                        <th class="text-center"></th>
                    </tr>
                    </thead>
                    <tbody>'; 
                    
                    $no     = 1;
                    foreach ($jadwal as $row) {
                        echo "<tr>
                                <td  class='text-center'>".$no++."</td>
                                <td>".$row->nama_mapel."</td>
                                <td  class='text-center'>".cmb_dinamis('guru', 'tbl_guru', 'nama_guru', 'nuptk', $row->id_guru, 'class="form-control" id="guru'.$row->id_jadwal.'" onchange="updateGuru('.$row->id_jadwal.')"')."</td>

                                <td  class='text-center'>".cmb_dinamis('ruangan', 'tbl_ruangan', 'nama_ruangan', 'kd_ruangan', $row->kd_ruangan, 'class="form-control" id="ruangan'.$row->id_jadwal.'" onchange="updateRuangan('.$row->id_jadwal.')"')."</td>

                                <td  class='text-center'>".form_dropdown('hari', $hari, $row->hari,"class='form-control' id='hari".$row->id_jadwal."' onchange='updateHari(".$row->id_jadwal.")'")."</td>

                                <td  class='text-center'>".form_dropdown('jam', $jam, $row->jam,"class='form-control' id='jam".$row->id_jadwal."' onchange='updateJam(".$row->id_jadwal.")'")."</td>

                                <td  class='text-center'>".anchor('jadwal/deleteJadwal/'.$row->id_jadwal,'<i class="fa fa-trash"></i>', 'class="btn btn-xs btn-danger tooltips btn-flat" onconfirm')."</td>
                                </tr>";
                    }
                echo '</tbody>
                </table>';
        } //end dataJadwal

        function updateGuru(){
            $id_guru    = strip_tags(trim($this->input->get('id_guru')));
            $id_jadwal  = strip_tags(trim($this->input->get('id_jadwal')));
            $this->db->where('id_jadwal', $id_jadwal); 
            $update = $this->db->update('tbl_jadwal', array('id_guru'=>$id_guru));
            if($update){
                echo "<script>alert('Sukses Merubah Data);</script>";
            }else{
                echo "<script>alert('Gagal Merubah Data!);</script>";
            }
        } //end updateGuru

        function updateRuangan(){
            $kd_ruangan = strip_tags(trim($this->input->get('kd_ruangan')));
            $id_jadwal  = strip_tags(trim($this->input->get('id_jadwal')));
            $this->db->where('id_jadwal', $id_jadwal);
            $update = $this->db->update('tbl_jadwal', array('kd_ruangan' => $kd_ruangan));
            if($update){
                echo "<script>alert('Sukses Merubah Data);</script>";
            }else{
                echo "<script>alert('Gagal Merubah Data!);</script>";
            }
        } //updateRuangan
        
        function updateHari(){
            $hari       = strip_tags(trim($this->input->get('hari')));
            $id_jadwal  = strip_tags(trim($this->input->get('id_jadwal')));
            $this->db->where('id_jadwal', $id_jadwal);
            $update     = $this->db->update('tbl_jadwal', array('hari'=>$hari));
            if($update){
                echo "<script>alert('Sukses Merubah Data);</script>";
            }else{
                echo "<script>alert('Gagal Merubah Data!);</script>";
            }
        } //end updateHari
        
        function updateJam(){
            $jam        = strip_tags($this->input->get('jam'));
            $id_jadwal  = strip_tags($this->input->get('id_jadwal'));
            $this->db->where('id_jadwal', $id_jadwal);
            $update     = $this->db->update('tbl_jadwal', array('jam'=>$jam)); 
            if($update){
                echo "<script>alert('Sukses Merubah Data);</script>";
            }else{
                echo "<script>alert('Gagal Merubah Data!);</script>";
            }
        } //end updateJamMulai
        

        function deleteJadwal(){
            $id_jadwal = $this->uri->segment(3);
            if (!empty($id_jadwal)) {
                $this->db->where('id_jadwal', $id_jadwal);
                $delete = $this->db->delete('tbl_jadwal');
                if ($delete) {
                    echo "<script>alert('Sukses Menghapus Data');</script>";
                    redirect('jadwal');
                }else{
                    echo "<script>alert('Gagal Menghapus Data!');</script>";
                }
            }
        } //end deleteJadwal

        function showRombel(){
            echo "<select id='rombel' name='rombel' class='form-control' onchange='loadPelajaran()'>";
                $kelas  = strip_tags(trim($this->input->get('kelas')));
                $rombel = $this->db->get_where('tbl_rombel', array('kelas' => $kelas));
                foreach($rombel->result() as $row){
                    echo "<option value='$row->kd_rombel'>$row->nama_rombel</option>";
                }
            echo "</select>"; 
        } //end showRombel

        function cetak_jadwal(){
            $rombel = $this->input->post('rombel');
            $this->load->library('CFPDF');
            $pdf = new FPDF('L', 'mm', 'A4');
            $pdf->AddPage();
            $pdf->SetFont('Arial','',10);
            $pdf->Cell(270,10,'JADWAL PELAJARAN', '0', '1', 'C');
            $pdf->Cell(15,10,'NO.',1,0,'C');
            $pdf->Cell(32,10,'WAKTU',1,0,'C');
            // forach di kolom judul
            $days       = $this->model->getHari();
            foreach ($days as $day) {
                $pdf->Cell(32,10,$day,1,0,'C');
            }
            $pdf->Cell(32,10,'',0,1,'C'); //untuk enter

            $jam_ajar   = $this->model->getJamPelajaran();
            $no = 1;
            foreach ($jam_ajar as $jam) {
                $pdf->Cell(15,10,$no,1,0,'C');
                $pdf->Cell(32,10,$jam,1,0,'L');
                //foreach hari di kolom jadwal
                foreach ($days as $day){
                    $where_select   = array();
                    $pelajaran = $this->db->get_where('tbl_mapel as tm, tbl_jadwal as tj, tbl'); $this->model->get_data('tj.*, tm.nama_mapel', 'tbl_mapel as tm, tbl_jadwal as tj', 'tj.kd_mapel=tm.kd_mapel and tj.hari="'.$day.'" and tj.jam="'.$jam.'" and id_rombel='.$rombel);
                    if ($pelajaran->num_rows()>0) {
                        foreach ($pelajaran->result() as $mapel) {
                            $pdf->SetFont('Arial','',8);
                            $pdf->Cell(32,10,$mapel->nama_mapel,1,0,'L');
                        }
                    }else{
                            $pdf->Cell(32,10,'-',1,0,'L');
                        }
                    $pdf->SetFont('Arial','',10);
                }
                $pdf->Cell(32,10,'',0,1,'C'); //untuk enter
                $no++;
            }
            $pdf->Output();
        } //end cetak_jadwal               
    } //end class
?>