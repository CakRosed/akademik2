<div class="box">
            <div class="box-header">
              <div class="row">
                <div class="col-md-2">                
                  <a href="<?php echo base_url('users/add'); ?>" type="button" class="btn btn-block btn-success btn-flat"><i class="fa fa-plus"></i> TAMBAH</a>
                </div>
                <div class="col-md-2">
                  <a href="<?php echo base_url('users/rule'); ?>" type="button" class="btn btn-block btn-danger btn-flat"><i class="fa fa-cogs"></i> ATURAN</a>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              

              <table id="example1" class="table table-striped table-bordered" style="width:100%">
                <thead>
                  <tr>
                    <th class="text-center">NO</th>
                    <th class="text-center">FOTO</th>
                    <th class="text-center">NAMA USER</th>
                    <th class="text-center">HAK AKSES</th>
                    <th class="text-center">MENU</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    $no = 1; //deklarasi nomor
                    foreach ($user as $row): ?>
                    <tr>
                      <td class="text-center"><?php echo $no ++?></td>
                      <td class="text-center">
                        <img class="img-circle" src="<?php echo base_url('upload/user/'); echo $row->foto; ?>" width="35px;">
                      </td>
                      <td class="text-center"><?php echo strtoupper($row->nama_lengkap); ?></td>
                      <td class="text-center"><?php echo strtoupper($row->nama_level); ?></td>
                      <td class="text-center">
                        <a class="btn btn-xs btn-warning tooltips btn-flat" data placement="top" data-original-title="edit" href="<?php echo site_url('Users/edit/'.$row->id_user); ?>" title="Edit Data"><i class="fa fa-pencil-square-o"></i></a>
                        
                        <a class="btn btn-xs btn-danger tooltips btn-flat" data placement="top" data-original-title="delete" href="<?php echo site_url('Users/delete/'.$row->id_user); ?>" title="Hapus Data" onclick = "return confirm('ANDA YAKIN INGIN MENHAPUS DATA INI?')"><i class="fa fa-trash"></i></a>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
            </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

