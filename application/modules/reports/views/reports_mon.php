<div id="wrapper">
        <?php echo modules::run('common/headBarMain'); ?>
        <?php echo modules::run('common/navigationBarMain'); 
        $report_names = Modules::run('reports/getMonthlyReportNames'); 
        $week_reports = Modules::run('reports/getWeeklyReports');
        ?>




      <div class="content-wrapper" style="min-height:auto">

      <section class="content-header">
        <h1>
          Reports Table 
          <small>( Monthly / Weekly ) </small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Reports Table ( Monthly / Weekly )</li>
        </ol>
      </section>


      <section class="content">
        <div class="row">
          <div class="col-lg-12 col-xs-12">
            <div class="panel panel-default">
              <div class="panel-body">
                <ul class="nav nav-tabs" role="tablist">
                  <li role="presentation" class="active"><a href="#monthly" aria-controls="monthly" role="tab" data-toggle="tab">Monthly</a></li>
                  <li role="presentation"><a href="#weekly" aria-controls="weekly" role="tab" data-toggle="tab">Weekly</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                  <div role="tabpanel" class="tab-pane active" id="monthly">
                    
                    <div class="row">
                      <div class="col-md-6"> <!-- required for floating -->
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs tabs-left report_names_list"><!-- 'tabs-right' for right tabs -->
                          <?php $x = 0; foreach ($report_names as $report): ?>
                            <li><a href="#monthly_report_<?php echo $report['id'];?>" data-report_name="<?php echo $report['report_name'];?>" data-toggle="tab"><?php echo $report['report_name']; ?></a></li>
                          <?php $x++; endforeach ?>
                        </ul>
                      </div>
                      <div class="col-md-6">
                          <!-- Tab panes -->
                          <div class="tab-content">
                            <div class="tab-pane active" id="ch27_central_bank">
                              <div id="monthlyViewPanel">
                            
                              </div>
                            </div>
                            <div class="tab-pane" id="profile">Profile Tab</div>
                          </div>
                      </div>
                    </div>
                          
                          
                  </div>
                  <div role="tabpanel" class="tab-pane" id="weekly">
                      <div class="row"><br></div>
                      <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                          <div id='calendar'></div>  
                        </div>
                      </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </section>

      </div>
      <?php echo modules::run('common/footBarMain'); ?>
</div>


























<div class="modal fade bs-example-modal-lg creativeAddRecordModal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel" id="editRecordModal">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="gridSystemModalLabel">&nbsp;View Record</h4>
        </div>
    <div class="row">
      <div class="col-md-8" style="border-right:1px solid #e5e5e5;">
      <form class="form-horizontal" role="form" data-toggle="validator" id="myFormE" method="POST">
      <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                  <h4 style="text-align:center;font-weight:bold;">View Record</h4>
                  <br>
                  <div class="form-group">
                    <label for="refNo" class="col-sm-4 control-label">Reference No</label>
                    <div class="col-sm-8">
                      <input type="number" class="form-control" name="refNoE" id="refNoE" disabled="disabled">
                    </div>
                  </div>
                  
                  <div id="monthlyReportsDivE" style="display:none" >
                    <div class="form-group">
                      <label for="compName" class="col-sm-4 control-label">Report Name</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" id="repMonNameE" name="repMonNameE"  disabled="disabled">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="recvDate" class="col-sm-4 control-label">Effective Month</label>
                      <div class="col-sm-8">
                          <input type="text" name="effMonth" id="effMonth"  class="form-control"  disabled="disabled">
                      </div>
                    </div>
                  </div>
                  
                  <div id="weeklyReportsDivE" style="display:none" >
                    <div class="form-group">
                      <label for="recvDate" class="col-sm-4 control-label">Week From</label>
                      <div class="col-sm-8">
                          <input type="text" name="fromDateE" id="fromDateE"  class="form-control"  disabled="disabled">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="effWeekE" class="col-sm-4 control-label">Week To</label>
                      <div class="col-sm-8">
                          <input type="text" name="toDateE" id="toDateE" class="form-control" disabled="disabled" >
                      </div>
                    </div>
                  </div>

                  <div id="generalReportsDivE" >
                    <div class="form-group">
                      <label for="reportName" class="col-sm-4 control-label">Report Name</label>
                      <div class="col-sm-8">
                        <textarea class="form-control" id="reportNameE" name="reportNameE"  disabled="disabled"></textarea>
                      </div>
                    </div>
                  </div>

                   
                  <div class="form-group">
                    <label for="compName" class="col-sm-4 control-label">Remarks</label>
                    <div class="col-sm-8">
                      <textarea class="form-control" id="remarks" name="remarks"  disabled="disabled"></textarea>
                    </div>
                  </div>

            </div>
        </div>
      </div>
      <div class="modal-footer">
        <!-- <button type="submit" class="btn btn-primary">Update Record</button> -->
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






<script>

$(function () {

    // console.log((14*374140));

    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!

    var yyyy = today.getFullYear();
    if(dd<10){
        dd='0'+dd
    } 
    if(mm<10){
        mm='0'+mm
    } 
  var today = yyyy+'-'+mm+'-'+dd;
  
  $('#calendar').fullCalendar({
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,basicWeek,basicDay'
      },
      defaultDate: today,
      editable: false,
      eventLimit: true, // allow "more" link when too many events
      events: [
        <?php foreach($week_reports as $report){ ?>
        {
          title: '<?php echo $report["report_name"]; ?>',
          dataid: '<?php echo $report["id"]; ?>',
          start: '<?php echo date("Y-m-d",strtotime($report["week_start_on"])); ?>',
          end: '<?php echo date("Y-m-d",strtotime($report["week_ends_on"])); ?>',
          backgroundColor: '#374140',
          borderColor: '<?php if($report["report_type"]=="1"){echo "#3a87ad";}elseif($report["report_type"]=="2"){echo "#374140";}; ?>',

        },
        <?php } ?>

      ],
      eventClick: function(calEvent, jsEvent, view) {
        var record_to_edit = calEvent.dataid;
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
            $('#refNoE').val(data.ref_no);
            $('#recvDateE').val(data.recv_date);
            $('#compNameE').val(data.comp_name);
            $('#reportNameE').val(data.report_name);
            $('#contactNameE').val(data.contact_name);
            $('#contactNoE').val(data.contact_no);
            $('#reptCost').val(data.file_cost);
            $('#fromDateE').val(data.week_start_on);
            $('#toDateE').val(data.week_ends_on);

            $('#remarks').val(data.remarks);
            $('#repMonNameE').val(data.report_name);
            // $('#effMonthE').val(months[data.month]+'-'+data.year);
            $('#editRecordModal').modal('show');

            // console.log($('#effMonthE').val());

            // $('#effMonthE').data("DateTimePicker").date(months[data.month-1]+'-'+data.year);
            
            if(data.report_type==1){
              $('#monthlyReportsDivE').show();
              $('#generalReportsDivE').hide();
              $('#weeklyReportsDivE').hide();
            }else if(data.report_type==2){
              $('#monthlyReportsDivE').show();
              $('#weeklyReportsDivE').show();
              $('#generalReportsDivE').hide();
            }else{
              $('#monthlyReportsDivE').hide();
              $('#generalReportsDivE').show();
              $('#weeklyReportsDivE').hide();
            }

           

        });
        // $('#editRecordModal').modal();
      }
    });
});


  
var MONTHS = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];

$(function () {
  


  $('.report_names_list').find('li').each(function(){
    var list_n = $(this);
    $(this).click(function(e){
      var datax = {report_name : list_n.find('a').data('report_name')};
      $.ajax({
        method: "POST",
        url: "/reports/getMonthlyReportsByName",
        data: datax,
        dataType:'json'
      }).done(function(data){
        // console.log(datax.report_name);
        // console.log(data);

        startMonth = 7;
        startYear = 2016
        endMonth = 8;
        endYear = 2016;
        // fiscalMonth = 7;
        if(startMonth < 10)
          startDate = parseInt("" + startYear + '0' + startMonth + "");
        else
          startDate = parseInt("" + startYear  + startMonth + "");
        if(endMonth < 10)
          endDate = parseInt("" + endYear + '0' + endMonth + "");
        else
          endDate = parseInt("" + endYear + endMonth + "");
        
        content = '<div class="row mpr-calendarholder">';
        calendarCount = endYear - startYear;
        if(calendarCount == 0)
          calendarCount++;
        var d = new Date();
        for(y = 0; y < 1; y++){
          content += '<div class="col-md-12" ><div class="mpr-calendar row" id="mpr-calendar-' + (y+1) + '">'
                   + '<h5 class="col-md-12"><i class="mpr-yeardown fa fa-chevron-circle-left"></i><span>' + (startYear + y).toString() + '</span><i class="mpr-yearup fa fa-chevron-circle-right"></i></h5><div class="mpr-monthsContainer"><div class="mpr-MonthsWrapper">';
          for(m=0; m < 12; m++){
            var monthval;
            if((m+1) < 10)
              monthval = "0" + (m+1);
            else
              monthval = "" + (m+1);
              content += '<span data-month="' + monthval + '" class="col-md-3 mpr-month">' + MONTHS[m] + '</span>';

          }
          content += '</div></div></div></div>';
        }
        content += '</div>';

        $('#monthlyViewPanel').html(content);
        paintMonths(data);

        $(document).on('click','.mpr-yearup',function(e){
              e.stopPropagation();
              var year = parseInt($(this).prev().html());
              year++;
              $(this).prev().html(""+year);
              console.log(year);
              $(this).parents('.mpr-calendar').find('.mpr-MonthsWrapper').fadeOut(175,function(){
              paintMonths(data);
              $(this).parents('.mpr-calendar').find('.mpr-MonthsWrapper').fadeIn(175);
            });
              return false;
        });
        
        $(document).on('click','.mpr-yeardown',function(e){
              e.stopPropagation();
              var year = parseInt($(this).next().html());
              year--;
              $(this).next().html(""+year);
              console.log(year);
              //paintMonths();
              $(this).parents('.mpr-calendar').find('.mpr-MonthsWrapper').fadeOut(175,function(){
                paintMonths(data);
                $(this).parents('.mpr-calendar').find('.mpr-MonthsWrapper').fadeIn(175);
              });
              return false;
        });
        
        $(document).on('click','.mpr-calendarholder',function(e){
          e.preventDefault();
          e.stopPropagation();
        });

        $(document).on("click",".mrp-container",function(e){
          if(mprVisible){
            e.preventDefault();
            e.stopPropagation();
            mprVisible = false;
          }
        });
          
        



        });

      });
    });
    
  


    $(document).on('click','.mpr-selected',function(e){
        var record_to_edit = $(this).data('report_id');
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
            $('#refNoE').val(data.ref_no);
            $('#recvDateE').val(data.recv_date);
            $('#compNameE').val(data.comp_name);
            $('#reportNameE').val(data.report_name);
            $('#contactNameE').val(data.contact_name);
            $('#contactNoE').val(data.contact_no);
            $('#reptCost').val(data.file_cost);
            $('#effWeekE').val(data.week);

            $('#remarks').val(data.remarks);
            $('#repMonNameE').val(data.report_name);
            $('#effMonth').val(months[data.month-1]+'-'+data.year);
            $('#editRecordModal').modal('show');

            // console.log($('#effMonthE').val());

            // $('#effMonthE').data("DateTimePicker").date(months[data.month-1]+'-'+data.year);
            
            if(data.report_type==1){
              $('#monthlyReportsDivE').show();
              $('#generalReportsDivE').hide();
              $('#weeklyReportsDivE').hide();
            }else if(data.report_type==2){
              $('#monthlyReportsDivE').show();
              $('#weeklyReportsDivE').show();
              $('#generalReportsDivE').hide();
            }else{
              $('#monthlyReportsDivE').hide();
              $('#generalReportsDivE').show();
              $('#weeklyReportsDivE').hide();
            }

           

        });

    });

  });


function setViewToCurrentYears(){
    var startyear = parseInt(startDate / 100);
    var endyear = parseInt(endDate / 100);
    $('.mpr-calendar h5 span').eq(0).html(startyear);
    $('.mpr-calendar h5 span').eq(1).html(endyear);
}

function paintMonths(data){
    // console.log(data);
    var datamontharr = [];

    $('.mpr-calendar').each(function(){
        var $cal = $(this);
        var year = $('h5 span',$cal).html();
      
        for(x in data){
          datamontharr.push(data[x].year+'-'+data[x].month);
        }
        $('.mpr-month',$cal).each(function(i){
          // console.log(year+'-'+(i+1));
          if(datamontharr.indexOf(year+'-'+(i+1))>-1){
            $(this).addClass('mpr-selected');
            $(this).attr('data-report_id',data[datamontharr.indexOf(year+'-'+(i+1))].id);
          }else{
            $(this).removeClass('mpr-selected');
          }
        });

    });
  $('.mpr-calendar .mpr-month').css("background","");
    //Write Text
    var startyear = parseInt(startDate / 100);
    var startmonth = parseInt(safeRound((startDate / 100 - startyear)) * 100);
    var endyear = parseInt(endDate / 100);
    var endmonth = parseInt(safeRound((endDate / 100 - endyear)) * 100);
    $('.mrp-monthdisplay .mrp-lowerMonth').html(MONTHS[startmonth - 1] + " " + startyear);
    $('.mrp-monthdisplay .mrp-upperMonth').html(MONTHS[endmonth - 1] + " " + endyear);
    $('.mpr-lowerDate').val(startDate);
    $('.mpr-upperDate').val(endDate);
    if(startyear == parseInt($('.mpr-calendar:first h5 span').html()))
      $('.mpr-calendar:first .mpr-selected:first').css("background","#40667A");
    if(endyear == parseInt($('.mpr-calendar:last h5 span').html()))
      $('.mpr-calendar:last .mpr-selected:last').css("background","#40667A");
  }

  function safeRound(val){
    return Math.round(((val)+ 0.00001) * 100) / 100;
  }

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