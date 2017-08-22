<div id="wrapper">
        <?php echo modules::run('common/headBarMain'); ?>
        <?php echo modules::run('common/navigationBarMain'); ?>



      <div class="content-wrapper" style="min-height:auto">

      <section class="content-header">
        <h1>
          Users
          <small>Table view</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Users</li>
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
                                <th>Full Name</th>
                                <th>Company</th>
                                <th>Email</th>
                                <th>Contact No</th>
                                <th>Type</th>
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
                    <label for="fullname" class="col-sm-4 control-label">Full Name</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" name="fullname" id="fullname">
                      <div class="help-block with-errors"></div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="company" class="col-sm-4 control-label">Company</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" name="company" id="company">
                      <div class="help-block with-errors"></div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="phone" class="col-sm-4 control-label">Phone</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" name="phone" id="phone">
                      <div class="help-block with-errors"></div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="address" class="col-sm-4 control-label">Address</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" name="address" id="address">
                      <div class="help-block with-errors"></div>
                    </div>
                  </div>


                  <div class="form-group">
                    <label for="email" class="col-sm-4 control-label">Email</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" name="email" id="email">
                      <div class="help-block with-errors"></div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="type" class="col-sm-4 control-label">Type</label>
                    <div class="col-sm-8">
                      <select class="form-control" name="type" id="type">
                        <option value="1">Agent</option>
                        <option value="2">Non Agent</option>
                      </select>
                    </div>
                  </div>


                  <div class="form-group">
                    <label for="username" class="col-sm-4 control-label">Username</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" name="username" id="username">
                      <div class="help-block with-errors"></div>
                    </div>
                  </div>


                  <div class="form-group">
                    <label for="tpassword" class="col-sm-4 control-label">Temporary Password</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" name="tpassword" id="tpassword">
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
        <h4 class="modal-title" id="gridSystemModalLabel">&nbsp;Modify the Record </h4>
      </div>
    <form class="form-horizontal" role="form" data-toggle="validator" id="myFormE" method="POST">
      <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                  <input type="hidden" class="form-control" name="idE" id="idE">
                  <div class="form-group">
                    <label for="fullnameE" class="col-sm-4 control-label">Full Name</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" name="fullnameE" id="fullnameE">
                      <div class="help-block with-errors"></div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="companyE" class="col-sm-4 control-label">Company</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" name="companyE" id="companyE">
                      <div class="help-block with-errors"></div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="phoneE" class="col-sm-4 control-label">Phone</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" name="phoneE" id="phoneE">
                      <div class="help-block with-errors"></div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="addressE" class="col-sm-4 control-label">Address</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" name="addressE" id="addressE">
                      <div class="help-block with-errors"></div>
                    </div>
                  </div>


                  <div class="form-group">
                    <label for="emailE" class="col-sm-4 control-label">Email</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" name="emailE" id="emailE">
                      <div class="help-block with-errors"></div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="typeE" class="col-sm-4 control-label">Type</label>
                    <div class="col-sm-8">
                      <select class="form-control" name="typeE" id="typeE">
                        <option value="1">Agent</option>
                        <option value="2">Non Agent</option>
                      </select>
                    </div>
                  </div>


                  <div class="form-group">
                    <label for="usernameE" class="col-sm-4 control-label">Username</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" name="usernameE" id="usernameE">
                      <div class="help-block with-errors"></div>
                    </div>
                  </div>


                  <div class="form-group">
                    <label for="tpasswordE" class="col-sm-4 control-label">Temporary Password</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" name="tpasswordE" id="tpasswordE">
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
                          "ajax": "/users/getUsers/"+sort,
                          "paging":         true,
                          "order": [[ 1, "desc" ]],
                          "aoColumns": [
                                      { "sWidth": "0%" },
                                      { "sWidth": "20%" },
                                      { "sWidth": "10%" },
                                      { "sWidth": "20%" },
                                      { "sWidth": "20%" },
                                      { "sWidth": "20%" },
                                      { "sWidth": "10%" }
                                     
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
              url: "/users/addUser",
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
              url: "/users/addUser",
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
        url: "/users/deleteUser",
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
            url: "/users/loadRecord",
            data: data,
            dataType:'json'
        }).done(function(data) {

            // console.log(data);
            // return false;
            $('#idE').val(data.id);
            $('#fullnameE').val(data.fullname);
            $('#companyE').val(data.company);
            $('#phoneE').val(data.phone);
            $('#addressE').val(data.address);
            $('#emailE').val(data.email);
            $('#typeE').val(data.type);
            $('#usernameE').val(data.username);

          
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