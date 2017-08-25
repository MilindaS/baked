<div id="wrapper">
        <?php echo modules::run('common/headBarMain'); ?>
        <?php echo modules::run('common/navigationBarMain'); ?>



      <div class="content-wrapper" style="min-height:auto !important">

      <section class="content-header">
        <h1>
          Reports Table
          <small>( Deleted ) </small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Activity Log Table</li>
        </ol>
      </section>


      <section class="content">
        <div class="row">
          <div class="col-lg-12 col-xs-12">
            <div class="panel panel-default">
            <div class="panel-body">
            <div  class="perspective">
              <div class="x-inner">
                <div class="dataTable_wrapper">
                   <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Ref No</th>
                                            <th>Rcv Date</th>
                                            <th>Company / Branch / Institute</th>
                                            <th>Report Name</th>
                                            <th>Contact Person</th>
                                            <!-- <th>Contact No</th> -->
                                            <th>Priority</th>
                                            <th>Status</th>
                                            <th>Completed Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($dreports as $report): ?>

                                        <tr class="odd gradeX">
                                            <td><?php echo $report['ref_no']; ?></td>
                                            <td><?php echo $report['recv_date']; ?></td>
                                            <td><?php echo substr($report['comp_name'],0,40); ?></td>
                                            <td><?php echo substr($report['report_name'],0,40); ?></td>
                                            <td><?php echo $report['contact_name']; ?></td>
                                            <td><?php echo ($report['priority']==1) ? '<i class="glyphicon glyphicon-fire" style="color:#D95100;"></i>&nbsp;&nbsp;High' : '<i class="glyphicon glyphicon-tint" style="color:#448AC8;"></i>&nbsp;&nbsp;Low'; ?></td>
                                            <!-- <td><?php //echo $report['contact_no']; ?></td> -->
                                            <td><?php if($report['status']==0){echo 'Pending';}elseif($report['status']==1){echo 'Completed';}elseif($report['status']==2){ echo '<i class="glyphicon glyphicon-ok-sign" style="color:#709E00;"></i>&nbsp;&nbsp;Issued';} ?></td>
                                            <td><?php echo $report['complt_date']; ?></td>
                                            <td>
                                              <!-- <a data-record_id="<?php echo $report['id']; ?>" class="btn btn-xs btn-primary pt-opt-restore"><i class="fa fa-refresh"></i></a> -->
                                              <a data-toggle="modal" data-record_id="<?php echo $report['id']; ?>" data-target="#restoreRecordModal" class="js-restore-record btn btn-xs btn-primary"><i class="fa fa-refresh"></i></a>
                                              <a data-toggle="modal" data-record_id="<?php echo $report['id']; ?>" data-target="#deleteRecordModal" class="js-delete-record btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
                                            </td>

                                        </tr>

                                    <?php endforeach ?>
                                    </tbody>
                                </table>
                    </div></div>
                </div>
                </div>
                </div>

          </div>
        </div>
      </section>

      </div>
      <?php echo modules::run('common/footBarMain'); ?>
</div>









<?php $max_ref_no = Modules::run('common/getNextRefNo');?>





<!-- Modal -->
<div class="modal fade" id="deleteRecordModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Are you sure ?</h4>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this record ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">No</button>
        <button type="button" class="btn btn-danger btn-sm js-deletepost">Yes! Delete it</button>
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="restoreRecordModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Are you sure ?</h4>
      </div>
      <div class="modal-body">
        Are you sure you want to restore this record ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">No</button>
        <button type="button" class="btn btn-success btn-sm js-restore">Yes! Restore it</button>
      </div>
    </div>
  </div>
</div>


    <script>
    var record_id = 1;
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true,
                "order": [[ 6, "desc" ],[ 1, "asc" ]]
        });
        $('#recvDate').datetimepicker({
            format: 'L'
        });
        $('#complDate').datetimepicker({
            format: 'L'
        });

        $('#recvDateE').datetimepicker({
            format: 'L'
        });


    var delete_record_id = 0;
    $(document).on('click','.js-delete-record',function(){
      delete_record_id = $(this).data('record_id');
    });

    var restore_record_id = 0;
    $(document).on('click','.js-restore-record',function(){
      restore_record_id = $(this).data('record_id');
    });

    $(document).on('click','.js-deletepost',function(){
      var data = {delete_record_id:delete_record_id};
      $.ajax({
        method: "POST",
        url: "/reports/deleteReportPermanant",
        data: data
      }).done(function(msg) {
          window.location.reload(true);
      });
    });

     $(document).on('click','.js-restore',function(){
      var data = {restore_record_id:restore_record_id};
      $.ajax({
        method: "POST",
        url: "/reports/restoreReport",
        data: data
      }).done(function(msg) {
          window.location.reload(true);
      });
    });

    $('#compNameE').typeahead(
      {
        highlight: true
      },
      {
        source: function(query,process){
          $.ajax({
            url:'/reports/searchConsignee',
            type:'POST',
            data:{'compNameE':query},
            dataType:'json',
            success:function(data){
              process(data);
            }
          })
        }
    }).on('typeahead:selected', function (obj, datum) {
        console.log(1);
    });


    $('#compName').typeahead(
      {
        highlight: true
      },
      {
        source: function(query,process){
          $.ajax({
            url:'/reports/searchConsignee',
            type:'POST',
            data:{'compNameE':query},
            dataType:'json',
            success:function(data){
              process(data);
            }
          })
        }
    }).on('typeahead:selected', function (obj, datum) {
        console.log(1);
    });
});
</script>