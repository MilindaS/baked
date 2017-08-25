<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">

    <div id="wrapper">
        <?php echo modules::run('common/navigationBarMain'); ?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Reports Table</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Records <a href="" class="btn btn-xs btn-primary pull-right" data-toggle="modal" data-target="#addRecordModal">Add Record</a>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
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
                                    <?php foreach ($reports as $report): ?>

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
                                              <a data-record_id="<?php echo $report['id']; ?>" class="btn btn-xs btn-primary pt-opt-edit"><i class="fa fa-pencil-square-o"></i></a>
                                              <!-- <a href="" class="btn btn-xs btn-success"><i class="fa fa-file"></i></a> -->
                                              <a data-toggle="modal" data-record_id="<?php echo $report['id']; ?>" data-target="#deleteRecordModal" class="js-delete-record btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
                                              </td>

                                        </tr>

                                    <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->

                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>


  </div>
</div>
</div>




<?php $max_ref_no = Modules::run('common/getNextRefNo');?>


<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel" id="addRecordModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="gridSystemModalLabel">&nbsp;Add New Record </h4>
      </div>
    <form class="form-horizontal" role="form" data-toggle="validator" id="myForm" method="POST">
      <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                  <div class="form-group">
                    <label for="refNo" class="col-sm-4 control-label">Reference No</label>
                    <div class="col-sm-8">
                      <input type="number" class="form-control" name="refNo" id="refNo" required autofocus value="<?php echo $max_ref_no[0]['MRF']+1; ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="recvDate" class="col-sm-4 control-label">Recieved Date</label>
                    <div class="col-sm-8">
                        <div class='input-group date' id='recvDate'>
                            <input type='text' class="form-control" required name="recvDate" value="<?php echo date('m/d/Y'); ?>"/>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="reportName" class="col-sm-4 control-label">Entity Type</label>
                    <div class="col-sm-8">
                      <select class="form-control" name="entityType" id="entityType">
                        <option value="0">Internal</option>
                        <option value="1">External (Govn)</option>
                        <option value="2">External (Non Govn)</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="compName" class="col-sm-4 control-label">Company / Branch / Institute</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="compName" name="compName" required data-provide="typehead" style="width:365px !important;">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="reportName" class="col-sm-4 control-label">Report Name</label>
                    <div class="col-sm-8">
                      <textarea class="form-control" id="reportName" name="reportName" required ></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="reportName" class="col-sm-4 control-label">Priority</label>
                    <div class="col-sm-8">
                      <select class="form-control" name="priority" id="priority">
                        <option value="0">Low</option>
                        <option value="1">High</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="contactName" class="col-sm-4 control-label">Contact Person</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="contactName" name="contactName">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="contactNo" class="col-sm-4 control-label">Contact No</label>
                    <div class="col-sm-8">
                      <input type="number" class="form-control" id="contactNo" name="contactNo">
                    </div>
                  </div>
                  <!-- <div class="form-group">
                    <label for="recvDate" class="col-sm-4 control-label">Status</label>
                    <div class="col-sm-8">
                      <input type="password" class="form-control" id="recvDate">
                    </div>
                  </div> -->
                  <!-- <div class="form-group">
                    <label for="complDate" class="col-sm-4 control-label">Completed Date</label>
                     <div class="col-sm-8">
                        <div class='input-group date' id='complDate'>
                            <input type='text' class="form-control" />
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                  </div> -->
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
        <button type="submit" class="btn btn-primary">Add Record</button>
      </div>
    </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->





<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel" id="editRecordModal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="gridSystemModalLabel">&nbsp;Modify Record</h4>
        </div>
    <div class="row">
      <div class="col-md-8" style="border-right:1px solid #e5e5e5;">
      <form class="form-horizontal" role="form" data-toggle="validator" id="myFormE" method="POST">
      <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                  <h4 style="text-align:center;font-weight:bold;">Update Record</h4>
                  <br>
                  <div class="form-group">
                    <label for="refNo" class="col-sm-4 control-label">Reference No</label>
                    <div class="col-sm-8">
                      <input type="number" class="form-control" name="refNoE" id="refNoE" required>
                      <input type="hidden" class="form-control" name="refIdE" id="refIdE" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="recvDate" class="col-sm-4 control-label">Recieved Date</label>
                    <div class="col-sm-8">
                        <div class='input-group date' id='recvDate'>
                            <input type='text' class="form-control" required name="recvDateE" id="recvDateE" />
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                  </div>
                   <div class="form-group">
                    <label for="reportName" class="col-sm-4 control-label">Entity Type</label>
                    <div class="col-sm-8">
                      <select class="form-control" name="entityType" id="entityType">
                        <option value="0">Internal</option>
                        <option value="1">External (Govn)</option>
                        <option value="2">External (Non Govn)</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="compName" class="col-sm-4 control-label">Company / Branch / Institute</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="compNameE" name="compNameE" required  data-provide="typehead" style="width:365px !important;">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="reportName" class="col-sm-4 control-label">Report Name</label>
                    <div class="col-sm-8">
                      <textarea class="form-control" id="reportNameE" name="reportNameE" required></textarea>
                      <!-- <input type="text" class="form-control"  placeholder="Lets see what you need..."  name="search_doc_title" id="search_doc_title" placeholder="Search" data-provide="typehead"> -->
                    </div>
                  </div>
                   <div class="form-group">
                    <label for="reportName" class="col-sm-4 control-label">Priority</label>
                    <div class="col-sm-8">
                      <select class="form-control" name="priorityE" id="priorityE">
                        <option value="0">Low</option>
                        <option value="1">High</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="contactName" class="col-sm-4 control-label">Contact Person</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="contactNameE" name="contactNameE">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="contactNo" class="col-sm-4 control-label">Contact No</label>
                    <div class="col-sm-8">
                      <input type="number" class="form-control" id="contactNoE" name="contactNoE">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="contactNo" class="col-sm-4 control-label">Report Cost</label>
                    <div class="col-sm-8">
                      <input type="number" class="form-control" id="reptCost" name="reptCost">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="contactNo" class="col-sm-4 control-label">Status</label>
                    <div class="col-sm-8">
                        <label class="radio-inline"><input type="radio" name="repStatus" id="pendingStatus" value="0">Pending</label>
                        <label class="radio-inline"><input type="radio" name="repStatus" id="compltStatus" value="1">Completed</label>
                        <label class="radio-inline"><input type="radio" name="repStatus" id="compltIssuedStatus" value="2">Completed & Issued</label>
                    </div>
                  </div>
                   <div class="form-group">
                    <label for="compName" class="col-sm-4 control-label">Remarks</label>
                    <div class="col-sm-8">
                      <textarea class="form-control" id="remarks" name="remarks"></textarea>
                    </div>
                  </div>
                  
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Update Record</button>
      </div>
    </form>
    </div>
    <div class="col-md-4">
      <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                  <h4 style="text-align:center;font-weight:bold;">Upload File</h4>
                  <br>
                  <form  class="dropzone" id="dropzonex"> <input type="hidden" name="record_id" id="record_id"></form>
                  <div id="uploadedFiles"></div>
                  <!-- <a><i class="fa fa-file-excel-o" style="font-size:30px;"></i></a> -->
            </div>
        </div>
      </div>
    </div>
    </div><!-- /.modal-content -->
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->






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


        $('#myForm').validator().on('submit', function (e) {
          if (e.isDefaultPrevented()) {
            // handle the invalid form...
          } else {
            // everything looks good!
            var data = $('#myForm').serialize();
            $.ajax({
              method: "POST",
              url: "/reports/addReport",
              data: data
            }).done(function(msg) {
                window.location.reload(true);
            });
          }
        })

        $('#myFormE').validator().on('submit', function (e) {
          if (e.isDefaultPrevented()) {
            // handle the invalid form...
          } else {
            // everything looks good!
            var data = $('#myFormE').serialize();
            $.ajax({
              method: "POST",
              url: "/reports/editReport",
              data: data
            }).done(function(msg) {
                window.location.reload(true);
            });
          }
        })

    var delete_record_id = 0;
    $(document).on('click','.js-delete-record',function(){
      delete_record_id = $(this).data('record_id');
    });

    $(document).on('click','.js-deletepost',function(){
      var data = {delete_record_id:delete_record_id};
      $.ajax({
        method: "POST",
        url: "/reports/deleteReport",
        data: data
      }).done(function(msg) {
          window.location.reload(true);
      });
    });

    //var myDropzone = new Dropzone("form#dropzonex",{ url:"/reports/uploadFile"});

    Dropzone.options.dropzonex = {
        url:"/reports/uploadFile/"+record_id,
        init: function() {


        // thisDropzone = this;
        // $.get('/reports/uploadFile', function(data) {

        //     $.each(data, function(key,value){

        //         var mockFile = { name: value.name, size: value.size };

        //         thisDropzone.options.addedfile.call(thisDropzone, mockFile);

        //         thisDropzone.options.thumbnail.call(thisDropzone, mockFile, "../public/uploads/"+value.name);

        //     });

        // });

        this.on("addedfile", function(file) {

            // Create the remove button
            var removeButton = Dropzone.createElement("<button class='btn btn-danger btn-sm' style='position:relative;top:-119px;z-index:9999;left:70%;'><i class='glyphicon glyphicon-remove'></i></button>");


            // Capture the Dropzone instance as closure.
            var _this = this;

            // Listen to the click event
            removeButton.addEventListener("click", function(e) {
              // Make sure the button click doesn't submit the form:
              e.preventDefault();
              e.stopPropagation();

              // Remove the file preview.
              _this.removeFile(file);
              // If you want to the delete the file on the server as well,
              // you can do the AJAX request here.
                  var data = {file_name:file.name,id:$('#record_id').val()};
                  $.ajax({
                    method: "POST",
                    url: "/reports/deleteFile",
                    data: data,
                    dataType:'json'
                  }).done(function(data) {
                      $.growl.error({title:'', message: data.msg ,location:'br'});
                  });
                  return false;
            });

            // Add the button to the file preview element.
            file.previewElement.appendChild(removeButton);
            // window.location.reload(true);
          });
        }
    };

    $(document).on('click','.pt-opt-edit',function(){

        var data = {id:$(this).data('record_id')};
        var htmlOut = '';

        $.ajax({
            method: "POST",
            url: "/reports/loadFiles",
            data: data,
            dataType:'json'
        }).done(function(data) {
            console.log(data);
            for(x in data){
              htmlOut += '';

              htmlOut += '<div class="row">'+
                            '<div class="col-md-12">'+
                              '<a href="'+data[x].soft_file_link+'" target="_blank"><i class="fa fa-file-excel-o" style="font-size:50px;"></i>&nbsp;&nbsp;'+data[x].report_name.substring(0,20)+'..</a>'+
                              '<button class="btn btn-danger btn-xs" style="position:relative;top:-29px;z-index:9999;left:-33%;"><i class="glyphicon glyphicon-remove"></i></button>'+
                            '</div>'+
                          '</div><br />';
            }
            $('#uploadedFiles').html(htmlOut);
        });



        $.ajax({
            method: "POST",
            url: "/reports/loadRecord",
            data: data,
            dataType:'json'
        }).done(function(data) {
            $('#refIdE').val(data.id);
            $('#record_id').val(data.id);
            $('#refNoE').val(data.ref_no);
            $('#recvDateE').val(data.recv_date);
            $('#compNameE').val(data.comp_name);
            $('#reportNameE').val(data.report_name);
            $('#contactNameE').val(data.contact_name);
            $('#contactNoE').val(data.contact_no);
            $('#reptCost').val(data.file_cost);
            $('#remarks').val(data.remarks);
            $('#editRecordModal').modal('show')

            $('#entityType').find('option').each(function(e){
              if(data.entity_type==e){
                $('#entityType').find('option[value=2]').attr('selected','selected');
              }

            });

            $('#priorityE').find('option').each(function(e){
              if(data.priority==e){
                $('#priorityE').find('option[value=2]').attr('selected','selected');
              }

            });
            

            if(data.status==1){
              $('#compltStatus').attr('checked','checked');
            }else if(data.status==2){
              $('#compltIssuedStatus').attr('checked','checked');
            }
            else{
              $('#pendingStatus').attr('checked','checked');
            }
            //$.growl.error({title:'', message: data.msg ,location:'br'});
        });
      return false;
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
              // console.log(data);
              process(data);
            }
          })
        }
    }).on('typeahead:selected', function (obj, datum) {
        console.log(1);
        // $("#search-form").submit();
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
              // console.log(data);
              process(data);
            }
          })
        }
    }).on('typeahead:selected', function (obj, datum) {
        console.log(1);
        // $("#search-form").submit();
    });
});
</script>