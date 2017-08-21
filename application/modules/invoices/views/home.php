<div id="wrapper">
        <?php echo modules::run('common/headBarMain'); ?>
        <?php echo modules::run('common/navigationBarMain'); ?>



      <div class="content-wrapper" style="min-height:auto">

      <section class="content-header">
        <h1>
          Payment Tracker
          <small>Table view</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Payment Tracker Table</li>
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
                                <th>ID</th>
                                <th>Invoice Number</th>
                                <th>Date</th>
                                <th>Invoice Amount</th>
                                <th>Paid Amount</th>
                                <th>Payment Details</th>
                                <th>Payment Date</th>
                                <th>Payment Type</th>
                                <th>Pending Amount</th>
                                <th>Remarks</th>
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
                    <label for="refNo" class="col-sm-4 control-label">Invoice Number</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" name="invoice_no" id="invoice_no">
                      <div class="help-block with-errors"></div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="date" class="col-sm-4 control-label">Date (M/D/Y)</label>
                    <div class="col-sm-8">
                        <div class='input-group date' id='date'>
                            <input type='text' class="form-control" required name="date" value="<?php echo date('m/d/Y'); ?>"/>
                            <div class="help-block with-errors"></div>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="contactName" class="col-sm-4 control-label">Invoice Amount</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="invoice_amount" name="invoice_amount">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="contactName" class="col-sm-4 control-label">Paid Amount</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="paid_amount" name="paid_amount">
                    </div>
                  </div>

                  <div class="form-group" >
                    <label for="reportName" class="col-sm-4 control-label">Payment Details</label>
                    <div class="col-sm-8">
                      <textarea class="form-control" id="payment_details" name="payment_details" required ></textarea>
                      <div class="help-block with-errors"></div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="payment_date" class="col-sm-4 control-label">Payment Date (M/D/Y)</label>
                    <div class="col-sm-8">
                        <div class='input-group date' id='payment_date'>
                            <input type='text' class="form-control" required name="payment_date" value="<?php echo date('m/d/Y'); ?>"/>
                            <div class="help-block with-errors"></div>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="payment_type" class="col-sm-4 control-label">Payment Type</label>
                    <div class="col-sm-8">
                      <select class="form-control" name="payment_type" id="payment_type">
                        <option value="1">General</option>
                        <option value="2">Monthly</option>
                        <option value="3">Weekly</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="pending_amount" class="col-sm-4 control-label">Pending Amount</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="pending_amount" name="pending_amount">
                    </div>
                  </div>


                 <div class="form-group" >
                    <label for="remarks" class="col-sm-4 control-label">Remarks</label>
                    <div class="col-sm-8">
                      <textarea class="form-control" id="remarks" name="remarks" required ></textarea>
                      <div class="help-block with-errors"></div>
                    </div>
                  </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-default">Add Record</button>
      </div>
    </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->












<div class="modal fade creativeAddRecordModal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel" id="editRecordModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="gridSystemModalLabel">&nbsp;Modify Record</h4>
      </div>
    <form class="form-horizontal" role="form" data-toggle="validator" id="myFormE" method="POST">
      <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                  <input type="text" name="idE" id="idE" />
                  <div class="form-group">
                    <label for="invoice_noE" class="col-sm-4 control-label">Invoice Number</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" name="invoice_noE" id="invoice_noE">
                      <div class="help-block with-errors"></div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="dateE" class="col-sm-4 control-label">Date (M/D/Y)</label>
                    <div class="col-sm-8">
                        <div class='input-group date' id='dateE'>
                            <input type='text' class="form-control" required name="dateE" value="<?php echo date('m/d/Y'); ?>"/>
                            <div class="help-block with-errors"></div>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="invoice_amountE" class="col-sm-4 control-label">Invoice Amount</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="invoice_amountE" name="invoice_amountE">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="paid_amountE" class="col-sm-4 control-label">Paid Amount</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="paid_amountE" name="paid_amountE">
                    </div>
                  </div>

                  <div class="form-group" >
                    <label for="payment_detailsE" class="col-sm-4 control-label">Payment Details</label>
                    <div class="col-sm-8">
                      <textarea class="form-control" id="payment_detailsE" name="payment_detailsE" required ></textarea>
                      <div class="help-block with-errors"></div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="payment_dateE" class="col-sm-4 control-label">Payment Date (M/D/Y)</label>
                    <div class="col-sm-8">
                        <div class='input-group date' id='payment_dateE'>
                            <input type='text' class="form-control" required name="payment_dateE" value="<?php echo date('m/d/Y'); ?>"/>
                            <div class="help-block with-errors"></div>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="payment_typeE" class="col-sm-4 control-label">Payment Type</label>
                    <div class="col-sm-8">
                      <select class="form-control" name="payment_typeE" id="payment_typeE">
                        <option value="1">General</option>
                        <option value="2">Monthly</option>
                        <option value="3">Weekly</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="pending_amountE" class="col-sm-4 control-label">Pending Amount</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" id="pending_amountE" name="pending_amountE">
                    </div>
                  </div>


                 <div class="form-group" >
                    <label for="remarksE" class="col-sm-4 control-label">Remarks</label>
                    <div class="col-sm-8">
                      <textarea class="form-control" id="remarksE" name="remarksE" required ></textarea>
                      <div class="help-block with-errors"></div>
                    </div>
                  </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Update Record</button>
      </div>
    </form>
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
    var sort = 9;
    var record_id = 1;
    var record_to_edit = 0;
    var htmlOut = '';
    var soft_file_id = '';
    var soft_file_path = '';
    $(document).ready(function() {
        var table = $('#dataTables-example').DataTable({
                          "processing": true,
                          "serverSide": true,
                          "ajax": "/invoices/getInvoices/"+sort,
                          "paging":         true,
                          "order": [[ 1, "desc" ]],
                          "aoColumns": [
                                      { "sWidth": "0%" },
                                      { "sWidth": "1%" },
                                      { "sWidth": "5%" },
                                      { "sWidth": "7%" },
                                      { "sWidth": "28%" },
                                      { "sWidth": "25%" },
                                      { "sWidth": "10%" },
                                      { "sWidth": "10%" },
                                      { "sWidth": "4%" },
                                      { "sWidth": "4%" },
                                      { "sWidth": "2%" }
                                      ],
                          
                  });

      
        $('#date').datetimepicker({
          format: 'L'
        });
        $('#payment_date').datetimepicker({
            useCurrent: false, //Important! See issue #1075,
            format: 'L'
        });


        <?php if(isset($_GET['record'])){ ?>
                table.column(0).every( function (e) {
                    this.search(<?php echo $_GET['record'];?>).draw();
                } );
        <?php } else{}?>


        
      
        


        $('#myForm').validator().on('submit', function (e) {
          if (e.isDefaultPrevented()) {
            // handle the invalid form...
          } else {
            // everything looks good!
            var data = $('#myForm').serialize();
            $.ajax({
              method: "POST",
              url: "/invoices/addInvoice",
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
              url: "/invoices/addInvoice",
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
        url: "/invoices/deleteInvoice",
        data: data
      }).done(function(msg) {
          window.location.reload(true);
      });
    });




    

    $(document).on('click','.btn-addRecord',function(){
      $.ajax({
            method: "POST",
            url: "/invoices/getNextRefNo",
            data: {'id':''},
            dataType:'json'
        }).done(function(data) {
            $('#refNo').val(data);
            $('#addRecordModal').modal('show');
        });
    });

    


    $(document).on('click','.pt-opt-edit',function(){

        record_to_edit = $(this).data('record_id');
        // console.log(record_to_edit);
        // return false;
        var data = {id:record_to_edit};

        $.ajax({
            method: "POST",
            url: "/invoices/loadRecord",
            data: data,
            dataType:'json'
        }).done(function(data) {

            // console.log(data);
            // return false;
            $('#idE').val(data.id);
            $('#invoice_noE').val(data.invoice_no);
            $('#dateE').val(data.date);
            $('#invoice_amountE').val(data.invoice_amount);
            $('#paid_amountE').val(data.paid_amount);
            $('#payment_detailsE').val(data.payment_details);
            $('#payment_dateE').val(data.payment_date);
            $('#payment_typeE').val(data.payment_type);
            $('#pending_amountE').val(data.pending_amount);
            $('#remarksE').val(data.remarks);

          
            $('#editRecordModal').modal('show');

            
        });
      return false;
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