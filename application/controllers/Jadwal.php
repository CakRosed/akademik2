<?php 
    class Jadwal extends CI_Controller{
        function __construct(){
            parent::__construct();
            $this->load->model('Model_global', 'model');
            $this->load->model('Model_jadwal', 'mjadwal');
        }

        function index(){
            // join query database antara tbl_info_sekolah dan tbl_jenjang_sekolah untuk mengambil jumlah kelas sesuai jenjang yang terdaftar pada tbl_sekolah_info 
            $info_sekolah = "SELECT js.jumlah_kelas
                             FROM tbl_jenjang_sekolah as js, tbl_sekolah_info as si
                             WHERE js.kd_jenjang = si.kd_jenjang_sekolah";

            $data = array(
            'icon'          => 'fa fa-search',
            'title'         => 'DETAIL JADWAL',
            'parent'        => 'JADWAL',
            'child'         => 'PENGATURAN',
            'info'          => $this->db->query($info_sekolah)->row(),
            );
            $this->template->load('template', 'jadwal/listt', $data);
        }
        
        function generateJadwal(){
            if(isset($_POST['submit'])){
                $this->mjadwal->generateJadwal();
            }else{ 
                redirecr('jadwal');
            }
        }

        function dataJadwal(){
            $kd_jurusan     = strip_tags(trim($this->input->get('jurusan')));
            $kelas          = strip_tags(trim($this->input->get('kelas'))); 
            $rombel         = strip_tags(trim($this->input->get('rombel'))); 
            // echo $rombel;die;
             echo '<table class="table table-striped table-bordered" style="width:100%">
                    <tr>
                      <th class="text-center">NO</th>
                      <th class="text-center">NAMA MATA PELAJARAN</th>
                      <th class="text-center">GURU</th>
                      <th class="text-center">RUANGAN</th>
                      <th class="text-center">HARI</th>
                      <th class="text-center">JAM MULAI</th>
                      <th class="text-center">JAM SELESAI</th>
                      <th class="text-center"></th>
                    </tr>'; 
    
                    $sql    = "SELECT tm.nama_mapel, tg.nama_guru, tr.nama_ruangan, tj.hari, tj.jam_mulai, tj.jam_selesai, tj.kd_ruangan, tj.id_guru, tj.id_jadwal
                                FROM tbl_jadwal as tj, tbl_mapel as tm, tbl_ruangan as tr, tbl_guru as tg, tbl_rombel as tb 
                                WHERE tj.kd_mapel=tm.kd_mapel and tj.kd_ruangan=tr.kd_ruangan and tj.id_guru=tg.nuptk and tj.kelas='$kelas'
                                and tj.kd_jurusan='$kd_jurusan' and tj.id_rombel=tb.kd_rombel and tj.id_rombel=$rombel";
                    $jadwal = $this->db->query($sql)->result();
                    $jam    = $this->mjadwal->getJamPelajaran();
                    $hari   = array(
                        'SENIN'=>'SENIN',
                        'SELASA'=>'SELASA',
                        'RABU'=>'RABU',
                        'KAMIS'=>'KAMIS',
                        'JUMAT'=>'JUMAT',
                        'SABTU'=>'SABTU',
                        'MINGGU'=>'MINGGU'
                    );
                    $no     = 1;
                    foreach ($jadwal as $row) {
                        echo "<tr>
                                <td  class='text-center'>".$no++."</td>
                                <td>".$row->nama_mapel."</td>
                                <td  class='text-center'>".cmb_dinamis('guru', 'tbl_guru', 'nama_guru', 'nuptk', $row->id_guru, 'class="form-control" id="guru'.$row->id_jadwal.'" onchange="updateGuru('.$row->id_jadwal.')"')."</td>
                                <td  class='text-center'>".cmb_dinamis('ruangan', 'tbl_ruangan', 'nama_ruangan', 'kd_ruangan', $row->kd_ruangan, 'class="form-control" id="ruangan'.$row->id_jadwal.'" onchange="updateRuangan('.$row->id_jadwal.')"')."</td>
                                <td  class='text-center'>".form_dropdown('hari', $hari, $row->hari,"class='form-control' id='hari".$row->id_jadwal."' onchange='updateHari(".$row->id_jadwal.")'")."</td>
                                <td  class='text-center'>".form_dropdown('jamMulai', $jam, $row->jam_mulai,"class='form-control' id='jamMulai".$row->id_jadwal."' onchange='updateJamMulai(".$row->id_jadwal.")'")."</td>
                                <td  class='text-center'>".form_dropdown('jamSelesai', $jam, $row->jam_selesai,"class='form-control' id='jamSelesai".$row->id_jadwal."' onchange='updateJamSelesai(".$row->id_jadwal.")'")."</td>
                                <td  class='text-center'>".anchor('jadwal/deleteJadwal/'.$row->id_jadwal,'<i class="fa fa-trash"></i>', 'class="btn btn-xs btn-danger tooltips btn-flat" onconfirm')."</td>
                                </tr>";
                    }
              echo '</table>';
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
        
        function updateJamMulai(){
            $jamMulai   = strip_tags(trim($this->input->get('jamMulai')));
            $id_jadwal  = strip_tags(trim($this->input->get('id_jadwal')));
            $this->db->where('id_jadwal', $id_jadwal);
            $update     = $this->db->update('tbl_jadwal', array('jam_mulai'=>$jamMulai)); 
            if($update){
                echo "<script>alert('Sukses Merubah Data);</script>";
            }else{
                echo "<script>alert('Gagal Merubah Data!);</script>";
            }
        } //end updateJamMulai
        
        function updateJamSelesai(){
            $jamSelesai = strip_tags(trim($this->input->get('jamSelesai')));
            $id_jadwal  = strip_tags(trim($this->input->get('id_jadwal')));
            $this->db->where('id_jadwal', $id_jadwal);
            $update     = $this->db->update('tbl_jadwal', array('jam_selesai'=>$jamSelesai)); 
            if($update){
                echo "<script>alert('Sukses Merubah Data);</script>";
            }else{
                echo "<script>alert('Gagal Merubah Data!);</script>";
            }
        } //end updateJamSelesai

        function deleteJadwal(){
            $id_jadwal = $this->uri->segment(3);
            if (!empty($id_jadwal)) {
                $delete = $this->model->delete_data($id_jadwal, 'id_jadwal', 'tbl_jadwal');
                if ($delete) {
                    echo "<script>alert('Sukses Menghapus Data');</script>";
                    redirect('jadwal');
                }else{
                    echo "<script>alert('Gagal Menghapus Data!');</script>";
                }
            }
        } //end deleteJadwal

        function showRombel(){
            echo "<select id='rombel' class='form-control' onchange='loadPelajaran()'>";
                $select = array(
                    'kelas'      => strip_tags(trim($this->input->get('kelas'))), 
                    'kd_jurusan' => strip_tags(trim($this->input->get('jurusan')))
                );
                $rombel = $this->model->get_data('*', 'tbl_rombel', $select);
                foreach($rombel->result() as $row){
                    echo "<option value='$row->kd_rombel'>$row->nama_rombel</option>";
                }
           echo "</select>"; 
        }
    } //end class
?>