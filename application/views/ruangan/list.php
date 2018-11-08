<div class="box">
            <div class="box-header">
              <div class="col-md-3">                
              <a href="<?php echo base_url('ruangan/add'); ?>" type="button" class="btn btn-block btn-success btn-flat"><i class="fa fa-plus"></i> DAFTAR RUANG KELAS</a>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              

              <table id="example1" class="table table-striped table-bordered" style="width:100%">
                <thead>
                  <tr>
                    <th class="text-center">NO</th>
                    <th class="text-center">KODE RUANG KELAS</th>
                    <th class="text-center">NAMA RUANG KELAS</th>
                    <th class="text-center">MENU</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    $no = 1; //deklarasi nomor
                    foreach ($ruangan as $row): ?>
                    <tr>
                      <td class="text-center"><?php echo $no ++?></td>
                      <td class="text-center"><?php echo $row->kd_ruangan; ?></td>
                      <td><?php echo $row->nama_ruangan; ?></td>
                      <td class="text-center">
                        <!-- <a class="btn btn-xs btn-info tooltips btn-fla t" data placement="top" data-original-title="detail" href="<?php echo site_url('ruangan/detail/'.$row->kd_ruangan); ?>"><i class="fa fa-eye"></i></a> --> 
                        <a class="btn btn-xs btn-warning tooltips btn-flat" data placement="top" data-original-title="edit" href="<?php echo site_url('ruangan/edit/'.$row->kd_ruangan); ?>"><i class="fa fa-pencil-square-o"></i></a>
                        <a class="btn btn-xs btn-danger tooltips btn-flat" data placement="top" data-original-title="delete" href="<?php echo site_url('ruangan/delete/'.$row->kd_ruangan); ?>" title="Hapus Data" onclick = "return confirm('ANDA YAKIN INGIN MENHAPUS DATA INI?')"><i class="fa fa-trash"></i></a>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
             </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

