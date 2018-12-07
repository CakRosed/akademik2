<div class="box">
    <div class="box-header">
        <div class="row">
            <div class="col-md-4">
                <?php echo cmb_dinamis('level', 'tbl_level_user', 'nama_level', 'id_level_user', null, 'onchange="loadData()" id="level" class="form-control"'); ?>
            </div>
            <div class="col-md-12">
                <div id="table"></div>
            </div>
        </div> 
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        loadData();
    });
</script>

<script type="text/javascript">
    function loadData(){
        var level = $('#level').val();
        $.ajax({
            type: 'GET',
            url : '<?php echo base_url("users/loadData"); ?>',
            data: 'level='+level,
            success:function(html){
                $("#table").html(html);
                $('#example1').dataTable({
                    'paging'      : true,
                    'lengthChange': true,
                    'searching'   : true,
                    'ordering'    : true,
                    'info'        : true,
                    'autoWidth'   : true
                });
            }
        })
    }

    function addRule(id_modul){
        var id_level_user = $('#level').val();
        $.ajax({
            type   : 'GET',
            url    : '<?php echo base_url("users/add_rule"); ?>',
            data   : 'id_level_user='+id_level_user+'&id_modul='+id_modul,
            success:function(html){
                
            }
        });
    }
</script>