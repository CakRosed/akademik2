<div class="box">
            <div class="box-header">
              <div class="col-md-3">                
              <a href="<?php echo base_url('mapel/add'); ?>" type="button" class="btn btn-block btn-success btn-flat"><i class="fa fa-plus"></i> DAFTAR MATA PELAJARAN</a>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              

              <table id="example1" class="table table-striped table-bordered" style="width:100%">
                <thead>
                  <tr>
                    <th class="text-center">NO</th>
                    <th class="text-center">KODE MATA PELAJARAN</th>
                    <th class="text-center">NAMA MATA PELAJARAN</th>
                    <th class="text-center">MENU</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    $no = 1; //deklarasi nomor
                    foreach ($mapel as $row): ?>
                    <tr>
                      <td class="text-center"><?php echo $no ++?></td>
                      <td class="text-center"><?php echo $row->kd_mapel; ?></td>
                      <td><?php echo $row->nama_mapel; ?></td>
                      <td class="text-center">
                        <!-- <a class="btn btn-xs btn-info tooltips btn-fla t" data placement="top" data-original-title="detail" href="<?php echo site_url('mapel/detail/'.$row->kd_mapel); ?>"><i class="fa fa-eye"></i></a> --> 
                        <a class="btn btn-xs btn-warning tooltips btn-flat" data placement="top" data-original-title="edit" href="<?php echo site_url('mapel/edit/'.$row->kd_mapel); ?>"><i class="fa fa-pencil-square-o"></i></a>
                        <a class="btn btn-xs btn-danger tooltips btn-flat" data placement="top" data-original-title="delete" href="<?php echo site_url('mapel/delete/'.$row->kd_mapel); ?>" title="Hapus Data" onclick = "return confirm('ANDA YAKIN INGIN MENHAPUS DATA INI?')"><i class="fa fa-trash"></i></a>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
             </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

