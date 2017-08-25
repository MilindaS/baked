<div id="wrapper">
        <?php echo modules::run('common/headBarMain'); ?>
        <?php echo modules::run('common/navigationBarMain'); ?>



      <div class="content-wrapper" style="min-height:auto">

      <section class="content-header">
        <h1>
          Reports Table
          <small>Hi</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Reports Table</li>
        </ol>
      </section>


      <section class="content">
        <div class="row">
          <div class="col-lg-12 col-xs-12">
            <div class="panel panel-default">
            <div class="panel-heading">
                Records <a class="btn btn-xs btn-primary pull-right btn-addRecord">Add Record</a>
            </div>
            <div class="panel-body">
            <div  class="perspective">
              <div class="x-inner">
                <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Ref No</th>
                                <th>Rcv Date</th>
                                <th>Company / Branch / Institute</th>
                                <th>Report Name</th>
                                <th>Contact Person</th>
                                <th>Undertaken by</th>
                                <!-- <th>Contact No</th> -->
                                <th>Priority</th>
                                <th>Status</th>
                                <th>Cmplt</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                       
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


<div class="modal fade creativeAddRecordModal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel" id="addRecordModal">
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
                      <input type="number" class="form-control" name="refNo" id="refNo" data-remote-error="This reference no already taken" data-remote="/reports/checkValidRefNo" required autofocus >
                      <div class="help-block with-errors"></div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="reportName" class="col-sm-4 control-label">Report Type</label>
                    <div class="col-sm-8">
                      <select class="form-control" name="reportType" id="reportType">
                        <option value="0">General</option>
                        <option value="1">Monthly</option>
                        <option value="2">Weekly</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group " id="rept_name_mw" style="display:none;">
                    <label for="compName" class="col-sm-4 control-label">Report Name</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="repMonName" name="repMonName" required data-provide="typehead" style="width:365px !important;">
                      <div class="help-block with-errors"></div>
                    </div>
                  </div>
                  <div class="form-group">
                      <label for="compName" class="col-sm-4 control-label">Company / Branch / Institute</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" id="compName" name="compName" required data-provide="typehead" style="width:365px !important;" data-remote-error="This company NDA has Expired" data-remote="/reports/checkNDA">
                        <div class="help-block with-errors"></div>
                      </div>
                    </div>



                 
                  
                  <div id="monthlyReportsDiv" style="display:none" >
                    
                    <div class="form-group">
                      <label for="recvDate" class="col-sm-4 control-label">Effective Month</label>
                      <div class="col-sm-8">
                          <div class='input-group date' id='effMonth'>
                              <input type='text' class="form-control" required name="effMonth" value=""/>
                              <div class="help-block with-errors"></div>
                              <span class="input-group-addon">
                                  <span class="glyphicon glyphicon-calendar"></span>
                              </span>
                          </div>
                      </div>
                    </div>
                  </div>

                  
                  <div id="weeklyReportsDiv" style="display:none" >
                    <div class="form-group">
                      <label for="effWeek" class="col-sm-4 control-label">Week From</label>
                      <div class="col-sm-8">
                          <div class='input-group date' id='datetimepicker6'>
                            <input type='text' class="form-control" name="fromDate"/>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="effWeek" class="col-sm-4 control-label">Week To</label>
                      <div class="col-sm-8">
                          <div class='input-group date' id='datetimepicker7' >
                              <input type='text' class="form-control" name="toDate" />
                              <span class="input-group-addon">
                                  <span class="glyphicon glyphicon-calendar"></span>
                              </span>
                          </div>
                      </div>
                    </div>
                  </div>














                  <div id="generalReportsDiv" >
                     <div class="form-group">
                      <label for="recvDate" class="col-sm-4 control-label">Recieved Date</label>
                      <div class="col-sm-8">
                          <div class='input-group date' id='recvDate'>
                              <input type='text' class="form-control" required name="recvDate" value="<?php echo date('m/d/Y'); ?>"/>
                              <div class="help-block with-errors"></div>
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
                    <div class="form-group" >
                      <label for="reportName" class="col-sm-4 control-label">Report Name</label>
                      <div class="col-sm-8">
                        <textarea class="form-control" id="reportName" name="reportName" required ></textarea>
                        <div class="help-block with-errors"></div>
                      </div>
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
                    <label for="reportName" class="col-sm-4 control-label">Report Undertaken by</label>
                    <div class="col-sm-8">
                      <select class="form-control" name="reportUnderTaken" id="reportUnderTaken" required>
                        <option value="">-</option>
                        <?php foreach ($users as $user): ?>
                          <option value="<?php echo $user['id']; ?>"><?php echo $user['username']; ?></option>
                        <?php endforeach ?>
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
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Add Record</button>
      </div>
    </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->





<div class="modal fade bs-example-modal-lg creativeAddRecordModal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel" id="editRecordModal">
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
                      <div class="help-block with-errors"></div>
                      <input type="hidden" class="form-control" name="refIdE" id="refIdE" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="reportName" class="col-sm-4 control-label">Report Type</label>
                    <div class="col-sm-8">
                      <select class="form-control" name="reportTypeE" id="reportTypeE">
                        <option value="0">General</option>
                        <option value="1">Monthly</option>
                        <option value="2">Weekly</option>
                      </select>
                    </div>
                  </div>
                  
                  <div class="form-group" id="rept_name_mwE" style="display:none;">
                    <label for="compName" class="col-sm-4 control-label">Report Name</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="repMonNameE" name="repMonNameE" required data-provide="typehead" style="width:365px !important;">
                      <div class="help-block with-errors"></div>
                    </div>
                  </div>

                  <div class="form-group">
                      <label for="compName" class="col-sm-4 control-label">Company / Branch / Institute</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" id="compNameE" name="compNameE" required  data-provide="typehead" style="width:365px !important;">
                        <div class="help-block with-errors"></div>
                      </div>
                    </div>




                  <div id="monthlyReportsDivE" style="display:none" >
                    
                    <div class="form-group">
                      <label for="recvDate" class="col-sm-4 control-label">Effective Month</label>
                      <div class="col-sm-8">
                          <div class='input-group date' id='effMonthE'>
                              <input type='text' class="form-control" required name="effMonthE" value=""/>
                              <div class="help-block with-errors"></div>
                              <span class="input-group-addon">
                                  <span class="glyphicon glyphicon-calendar"></span>
                              </span>
                          </div>
                      </div>
                    </div>
                  </div>
                  
                  <div id="weeklyReportsDivE" style="display:none" >
                    <div class="form-group">
                        <label for="effWeek" class="col-sm-4 control-label">Week From</label>
                        <div class="col-sm-8">
                            <div class='input-group date' id='datetimepicker6E'>
                              <input type='text' class="form-control" name="fromDateE" id="fromDateE"/>
                              <span class="input-group-addon">
                                  <span class="glyphicon glyphicon-calendar"></span>
                              </span>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="effWeek" class="col-sm-4 control-label">Week To</label>
                        <div class="col-sm-8">
                            <div class='input-group date' id='datetimepicker7E' >
                                <input type='text' class="form-control" name="toDateE"  id="toDateE"/>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                      </div>
                    </div>





                  <div id="generalReportsDivE" >
                    <div class="form-group">
                      <label for="recvDate" class="col-sm-4 control-label">Recieved Date</label>
                      <div class="col-sm-8">
                          <div class='input-group date' id='recvDate'>
                              <input type='text' class="form-control" required name="recvDateE" id="recvDateE" />
                              <div class="help-block with-errors"></div>
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
                      <label for="reportName" class="col-sm-4 control-label">Report Name</label>
                      <div class="col-sm-8">
                        <textarea class="form-control" id="reportNameE" name="reportNameE" required></textarea>
                        <div class="help-block with-errors"></div>
                        <!-- <input type="text" class="form-control"  placeholder="Lets see what you need..."  name="search_doc_title" id="search_doc_title" placeholder="Search" data-provide="typehead"> -->
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="contactNo" class="col-sm-4 control-label">Recipt No</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" id="reciptNo" name="reciptNo">
                      </div>
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
                    <label for="reportName" class="col-sm-4 control-label">Report Undertaken by</label>
                    <div class="col-sm-8">
                      <select class="form-control" name="reportUnderTakenE" id="reportUnderTakenE" required>
                        <option value="">-</option>
                        <?php foreach ($users as $user): ?>
                          <option value="<?php echo $user['id']; ?>"><?php echo $user['username']; ?></option>
                        <?php endforeach ?>
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
                  <h4 style="text-align:center;font-weight:bold;">Upload Request</h4>
                  
                  <br>
                  <form  class="dropzone" id="dropzonexR"> <input type="hidden" name="record_id_r" id="record_id_r"></form>
                  <div id="uploadedFilesR"></div>
                  <!-- <a><i class="fa fa-file-excel-o" style="font-size:30px;"></i></a> -->
                  
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">
                  <h4 style="text-align:center;font-weight:bold;">Upload Completed File</h4>
                  <h4 style="text-align:center;font-weight:bold;">Or</h4>
                  <p>
                    <div class="form-group">
                      <center>
                      <input type="checkbox" style="margin-top:10px;" class="cusdecinput" name="cusdecinput">
                      <span style="text-align:center;font-weight:bold;position:relative;top:-2px;">&nbsp;&nbsp;CusDec, Assesment or Other
                      </span></center>
                    </div>
                  </p>
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
<div class="modal fade creativeAddRecordModal" id="deleteRecordModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
    var sort = "<?php if(isset($_GET['sort'])){if($_GET['sort']=='Pending'){echo 0;}elseif($_GET['sort']=='Completed'){echo 1;} elseif($_GET['sort']=='Issued'){echo 2;} }else{echo 9;}?>";
    var record_id = 1;
    var record_to_edit = 0;
    var htmlOut = '';
    var soft_file_id = '';
    var soft_file_path = '';
    $(document).ready(function() {
        // var table = $('#dataTables-example').DataTable({
        //                   "aProcessing": true,
        //                   "aServerSide": true,
        //                   "ajax": "/reports/getReports",
        //                   "scrollY":        "500px",
        //                   "scrollCollapse": true,
        //                   "paging":         false,
        //                   "order": [[ 0, "desc" ]],
        //                   "aoColumns": [
        //                               { "sWidth": "3%" },
        //                               { "sWidth": "7%" },
        //                               { "sWidth": "30%" },
        //                               { "sWidth": "25%" },
        //                               { "sWidth": "10%" },
        //                               { "sWidth": "10%" },
        //                               { "sWidth": "4%" },
        //                               { "sWidth": "4%" },
        //                               { "sWidth": "5%" },
        //                               { "sWidth": "2%", "sClass": "center", "bSortable": false },
        //                               ],
        //           });
      
      var table = $('#dataTables-example').DataTable({
                          "processing": true,
                          "serverSide": true,
                          "ajax": "/reports/getReports/"+sort,
                          "paging":         true,
                          "order": [[ 1, "desc" ]],
                          "aoColumns": [
                                      { "sWidth": "0%" },
                                      { "sWidth": "5%" },
                                      { "sWidth": "7%" },
                                      { "sWidth": "28%" },
                                      { "sWidth": "25%" },
                                      { "sWidth": "10%" },
                                      { "sWidth": "10%" },
                                      { "sWidth": "4%" },
                                      { "sWidth": "4%" },
                                      { "sWidth": "5%" },
                                      { "sWidth": "2%", "sClass": "center", "bSortable": false },
                                      ],
                          
                  });

      
        $('#datetimepicker6').datetimepicker({
          format: 'L'
        });
        $('#datetimepicker7').datetimepicker({
            useCurrent: false, //Important! See issue #1075,
            format: 'L'
        });
        $("#datetimepicker6").on("dp.change", function (e) {
            $('#datetimepicker7').data("DateTimePicker").minDate(e.date);
        });
        $("#datetimepicker7").on("dp.change", function (e) {
            $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
        });


        $('#datetimepicker6E').datetimepicker({
          format: 'L'
        });
        $('#datetimepicker7E').datetimepicker({
            useCurrent: false, //Important! See issue #1075,
            format: 'L'
        });
        $("#datetimepicker6E").on("dp.change", function (e) {
            $('#datetimepicker7E').data("DateTimePicker").minDate(e.date);
        });
        $("#datetimepicker7E").on("dp.change", function (e) {
            $('#datetimepicker6E').data("DateTimePicker").maxDate(e.date);
        });


        <?php if(isset($_GET['record'])){ ?>
                table.column(0).every( function (e) {
                    this.search(<?php echo $_GET['record'];?>).draw();
                } );
        <?php } else{}?>


        $('#dataTables-example tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
                $(this).removeClass('selected');

                
            }
            else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
                var id = $(this).data('id_row');
                // $.ajax({
                //   method: "POST",
                //   url: "/reports/loadRecord",
                //   data: {id:id}
                // }).done(function(msg) {
                //     console.log(msg);
                // });
                // $('.x-inner').addClass('pers-inner');
                // setTimeout($('.perspective').addClass('widthFix'),1000);
                // $('#page-wrapper').css({
                //   'background': 'rgba(0,0,0,0.9) !important',
                //   'box-shadow': '0px 0px 20px 1px black'
                // });
                return false;
            }
        });


      
        $('#effMonth').datetimepicker({
            format: 'MMM-GGGG'
        });
        $('#effMonthE').datetimepicker({
            format: 'MMM-GGGG'
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
            return false;
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
            return false;
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


    Dropzone.options.dropzonex = {
        url:"/reports/uploadFile/",
        init: function() {



          this.on("success", function(file) {
            this.removeFile(file);

            var data = {id:record_to_edit};
            htmlOut = '';
            // console.log('--'+record_to_edit);
            $.ajax({
                method: "POST",
                url: "/reports/loadFiles",
                data: data,
                dataType:'json'
            }).done(function(data) {
                console.log(data);
                for(x in data){
                  htmlOut += '';

                  // htmlOut += '<div class="row">'+
                  //               '<div class="col-md-12">'+
                  //                 '<a href="'+data[x].soft_file_link+'" target="_blank"><i class="fa fa-file-excel-o" style="font-size:50px;"></i>&nbsp;&nbsp;'+file.name.substring(0,20)+'..</a>'+
                  //                 '<button class="btn btn-danger btn-xs js-remove-file" data-file_path="'+data[x].soft_file_path+'" data-file_id="'+data[x].report_soft_id+'" style="position:relative;top:-29px;z-index:9999;left:-33%;"><i class="glyphicon glyphicon-remove"></i></button>'+
                  //               '</div>'+
                  //             '</div><br />';
                  htmlOut += getHtmlOutDZ(data[x].soft_file_link,data[x].report_name.substring(0,20),data[x].soft_file_path,data[x].report_soft_id);
                }
                $('#uploadedFiles').html(htmlOut);
            });


          });
        }
    };



    Dropzone.options.dropzonexR = {
        url:"/reports/uploadFileR",
        init: function() {


          this.on("success", function(file) {
            this.removeFile(file);

            var data = {id:record_to_edit};
            htmlOut = '';

            $.ajax({
                method: "POST",
                url: "/reports/loadFilesR",
                data: data,
                dataType:'json'
            }).done(function(data) {
                console.log(data);
                for(x in data){
                  htmlOut += '';

                  // htmlOut += '<div class="row">'+
                  //               '<div class="col-md-12">'+
                  //                 '<a href="'+data[x].soft_file_link+'" target="_blank"><i class="fa fa-file-excel-o" style="font-size:50px;"></i>&nbsp;&nbsp;'+file.name.substring(0,20)+'..</a>'+
                  //                 '<button class="btn btn-danger btn-xs js-remove-file" data-file_path="'+data[x].soft_file_path+'" data-file_id="'+data[x].report_soft_id+'" style="position:relative;top:-29px;z-index:9999;left:-33%;"><i class="glyphicon glyphicon-remove"></i></button>'+
                  //               '</div>'+
                  //             '</div><br />';
                  htmlOut += getHtmlOutDZ(data[x].soft_file_link,data[x].report_name.substring(0,20),data[x].soft_file_path,data[x].report_soft_id,true);
                }
                $('#uploadedFilesR').html(htmlOut);
            });


          });
        }
    };

    $(document).on('click','.js-remove-file',function(){
      soft_file_path = $(this).data('file_path');
      soft_file_id = $(this).data('file_id');

      var data = {soft_file_path:soft_file_path,id:soft_file_id};

      $.ajax({
        method: "POST",
        url: "/reports/deleteFile",
        data: data,
        dataType:'json'
      }).done(function(data) {
          $.growl.error({title:'', message: data.msg ,location:'br'});
            var data = {id:record_to_edit};
            htmlOut = '';

            $.ajax({
                method: "POST",
                url: "/reports/loadFiles",
                data: data,
                dataType:'json'
            }).done(function(data) {
                htmlOut = '';
                for(x in data){
                  htmlOut += getHtmlOutDZ(data[x].soft_file_link,data[x].report_name.substring(0,20),data[x].soft_file_path,data[x].report_soft_id);
                }
                $('#uploadedFiles').html(htmlOut);
            });

      });
      return false;
    });

  $(document).on('click','.js-remove-file-request',function(){
      soft_file_path = $(this).data('file_path');
      soft_file_id = $(this).data('file_id');

      var data = {soft_file_path:soft_file_path,id:soft_file_id};

      $.ajax({
        method: "POST",
        url: "/reports/deleteFileR",
        data: data,
        dataType:'json'
      }).done(function(data) {
          $.growl.error({title:'', message: data.msg ,location:'br'});
            var data = {id:record_to_edit};
            htmlOut = '';

            $.ajax({
                method: "POST",
                url: "/reports/loadFilesR",
                data: data,
                dataType:'json'
            }).done(function(data) {
                htmlOut = '';
                for(x in data){
                  htmlOut += getHtmlOutDZ(data[x].soft_file_link,data[x].report_name.substring(0,20),data[x].soft_file_path,data[x].report_soft_id,true);
                }
                $('#uploadedFilesR').html(htmlOut);
            });

      });
      return false;
    });
    

    $(document).on('click','.btn-addRecord',function(){
      $.ajax({
            method: "POST",
            url: "/common/getNextRefNo",
            data: {'id':''},
            dataType:'json'
        }).done(function(data) {
            $('#refNo').val(data);
            $('#addRecordModal').modal('show');
        });
    });

    $(document).on('change','#reportType',function(){
      if($(this).val()==1){
        $('#monthlyReportsDiv').show();
        $('#rept_name_mw').show();
        $('#generalReportsDiv').hide();
        $('#weeklyReportsDiv').hide();
      }else if($(this).val()==2){
        $('#weeklyReportsDiv').show();
        $('#rept_name_mw').show();
        $('#monthlyReportsDiv').hide();
        $('#generalReportsDiv').hide();
      }else{
        $('#generalReportsDiv').show();
        $('#monthlyReportsDiv').hide();
        $('#weeklyReportsDiv').hide();
        $('#rept_name_mw').hide();
      }
    });

    $(document).on('change','#reportTypeE',function(){
      if($(this).val()==1){
        $('#monthlyReportsDivE').show();
        $('#rept_name_mwE').show();
        $('#generalReportsDivE').hide();
        $('#weeklyReportsDivE').hide();
      }else if($(this).val()==2){
        $('#weeklyReportsDivE').show();
        $('#rept_name_mwE').show();
        $('#monthlyReportsDivE').hide();
        $('#generalReportsDivE').hide();
      }else{
        $('#generalReportsDivE').show();
        $('#monthlyReportsDivE').hide();
        $('#weeklyReportsDivE').hide();
        $('#rept_name_mwE').hide();
      }
    });
  
    $('#editRecordModal').on('hidden.bs.modal', function (e) {
      window.location.reload(true);
    });

    $(document).on('click','.pt-opt-edit',function(){

        record_to_edit = $(this).data('record_id');
        var data = {id:record_to_edit};

        $.ajax({
            method: "POST",
            url: "/reports/loadFiles",
            data: data,
            dataType:'json'
        }).done(function(data) {
            htmlOut = '';
            for(x in data){
              htmlOut += getHtmlOutDZ(data[x].soft_file_link,data[x].report_name.substring(0,20),data[x].soft_file_path,data[x].report_soft_id);
            }
            $('#uploadedFiles').html(htmlOut);
        });

         $.ajax({
            method: "POST",
            url: "/reports/loadFilesR",
            data: data,
            dataType:'json'
        }).done(function(data) {
            htmlOut = '';
            for(x in data){
              htmlOut += getHtmlOutDZ(data[x].soft_file_link,data[x].report_name.substring(0,20),data[x].soft_file_path,data[x].report_soft_id,true);
            }
            $('#uploadedFilesR').html(htmlOut);
        });



        $.ajax({
            method: "POST",
            url: "/reports/loadRecord",
            data: data,
            dataType:'json'
        }).done(function(data) {

            months = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];
            console.log(data);
            $('#refIdE').val(data.id);
            $('#record_id').val(data.id);
            $('#record_id_r').val(data.id);
            $('#refNoE').val(data.ref_no);
            $('#recvDateE').val(data.recv_date);
            $('#compNameE').val(data.comp_name);
            $('#reportNameE').val(data.report_name);
            $('#contactNameE').val(data.contact_name);
            $('#contactNoE').val(data.contact_no);
            $('#reptCost').val(data.file_cost);
            $('#remarks').val(data.remarks);
            $('#reciptNo').val(data.recipt_no);
            $('#repMonNameE').val(data.report_name);
            $('#fromDateE').val(data.week_start_on);
            $('#toDateE').val(data.week_ends_on);

            if(data.report_format==1){
              $('.cusdecinput').attr('checked','checked');
              console.log(data.report_format);
              $('#dropzonex').hide();
            }else{
              $('.cusdecinput').removeAttr('checked');
              console.log(data.report_format);


            }
            // $('#fromDateE').remove();
            // $('#effMonthE').val(months[data.month]+'-'+data.year);
            $('#editRecordModal').modal('show');

            // console.log($('#effMonthE').val());

            $('#effMonthE').data("DateTimePicker").date(months[data.month-1]+'-'+data.year);
            
            if(data.report_type==1){
              $('#monthlyReportsDivE').show();
              $('#rept_name_mwE').show();
              $('#generalReportsDivE').hide();
              $('#weeklyReportsDivE').hide();
            }else if(data.report_type==2){
              $('#monthlyReportsDivE').hide();
              $('#weeklyReportsDivE').show();
              $('#rept_name_mwE').show();
              $('#generalReportsDivE').hide();
            }else{
              $('#monthlyReportsDivE').hide();
              $('#generalReportsDivE').show();
              $('#weeklyReportsDivE').hide();
              $('#rept_name_mwE').hide();
            }

            $('#effWeekE').find('option').each(function(e){
              if(data.week==e){
                console.log(data.week+'-'+e);
                $(this).attr('selected','selected');
              }
            });

            $('#entityType').find('option').each(function(e){
              if(data.entity_type==e){
                $(this).attr('selected','selected');
              }
            });

            $('#reportTypeE').find('option').each(function(e){
              if(data.report_type==e){
                $(this).attr('selected','selected');
              }
            });

            $('#reportUnderTakenE').find('option').each(function(e){
              if(data.report_at==e){
                $(this).attr('selected','selected');
              }
            });

            $('#priorityE').find('option').each(function(e){
              if(data.priority==e){
                $(this).attr('selected','selected');
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
        });
      return false;
    });


$('#repMonName').typeahead(
      {
        highlight: true
      },
      {
        source: function(query,process){
          $.ajax({
            url:'/reports/searchMonthlyRepName',
            type:'POST',
            data:{'monRepName':query,'reportTypeX':$('#reportType').val()},
            dataType:'json',
            success:function(data){
              // console.log(data);
              process(data);
            }
          })
        }
    }).on('typeahead:selected', function (obj, datum) {
        console.log(1);
    });

    $('#repMonNameE').typeahead(
      {
        highlight: true
      },
      {
        source: function(query,process){
          $.ajax({
            url:'/reports/searchMonthlyRepName',
            type:'POST',
            data:{'monRepName':query,'reportTypeX':$('#reportTypeE').val()},
            dataType:'json',
            success:function(data){
              // console.log(data);
              process(data);
            }
          })
        }
    }).on('typeahead:selected', function (obj, datum) {
        console.log(1);
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


    $('.cusdecinput').change(function(){
        if(this.checked){
          $('#dropzonex').hide();
          $.ajax({
            url:'/reports/updateReportToCusdecFormat',
            type:'POST',
            data:{id:record_to_edit,value:1},
            dataType:'json',
            success:function(data){
              // process(data);
            }
          })

        }else{
          $('#dropzonex').show();
          $.ajax({
            url:'/reports/updateReportToCusdecFormat',
            type:'POST',
            data:{id:record_to_edit,value:0},
            dataType:'json',
            success:function(data){
              // process(data);
            }
          })
        }
    });
});

function getHtmlOutDZ(soft_file_link,report_name,soft_file_path,report_soft_id,request){
  res = soft_file_link.split("/");
  x = '<div class="row">'+
        '<div class="col-md-12">'+
          '<a href="'+soft_file_link+'" target="_blank" style="float:left;"><i class="fa fa-file-excel-o" style="font-size:18px;"></i>&nbsp;&nbsp;'+res[res.length-1].substr(0,25)+'</a>'+
          '<button class="btn btn-danger btn-xs js-remove-file'+((request) ? '-request' :'')+'" data-file_path="'+soft_file_path+'" data-file_id="'+report_soft_id+'" style="float:right;"><i class="glyphicon glyphicon-remove"></i></button>'+
        '</div>'+
      '</div><br />';
  return x;
}







  









</script>