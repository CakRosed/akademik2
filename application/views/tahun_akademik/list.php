<div class="box">
            <div class="box-header">
              <div class="col-md-3">                
              <a href="<?php echo base_url('tahun_akademik/add'); ?>" type="button" class="btn btn-block btn-success btn-flat"><i class="fa fa-plus"></i> DAFTAR TAHUN AKADEMIK</a>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              

              <table id="example1" class="table table-striped table-bordered" style="width:100%">
                <thead>
                  <tr>
                    <th class="text-center">NO</th>
                    <!-- <th class="text-center">KODE TAHUN AKADEMIK</th> -->
                    <th class="text-center">TAHUN AKADEMIK</th>
                    <th class="text-center">TAHUN AKADEMIK AKTIF</th>
                    <!-- <th class="text-center">SEMESTER AKTIF</th> -->
                    <th class="text-center">MENU</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    $no = 1; //deklarasi nomor
                    foreach ($tahun_akademik as $row): ?>
                    <tr>
                      <td class="text-center"><?php echo $no ++?></td>
                      <td class="text-center"><?php echo $row->tahun_akademik; ?></td>
                      <td class="text-center"><?php echo $row->is_aktif=='y'?'AKTIF':'TIDAK AKTIF'; ?></td>
                      <!-- <td class="text-center"><?php echo $row->semester_aktif; ?></td> -->
                      <td class="text-center">
                        <!-- <a class="btn btn-xs btn-info tooltips btn-fla t" data placement="top" data-original-title="detail" href="<?php echo site_url('tahun_akademik/detail/'.$row->kd_tahun_akademik); ?>"><i class="fa fa-eye"></i></a> --> 
                        <a class="btn btn-xs btn-warning tooltips btn-flat" data placement="top" data-original-title="edit" href="<?php echo site_url('tahun_akademik/edit/'.$row->kd_tahun_akademik); ?>"><i class="fa fa-pencil-square-o"></i></a>
                        <a class="btn btn-xs btn-danger tooltips btn-flat" data placement="top" data-original-title="delete" href="<?php echo site_url('tahun_akademik/delete/'.$row->kd_tahun_akademik); ?>" title="Hapus Data" onclick = "return confirm('ANDA YAKIN INGIN MENHAPUS DATA INI?')"><i class="fa fa-trash"></i></a>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
             </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

