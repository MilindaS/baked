
<div id="wrapper">
        <?php echo modules::run('common/headBarMain'); ?>
        <?php echo modules::run('common/navigationBarMain'); ?>



      <div class="content-wrapper" style="min-height:auto !important">

      <section class="content-header">
        <h1>Account Settings
          <small>( <?php echo ($user[0]['fullname']); ?> ) </small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Account Settings</li>
        </ol>
      </section>


      <section class="content">
        <div class="row">
          <div class="col-lg-12 col-xs-12">
            <div class="panel panel-default">
            <div class="panel-body">
            <div class="col-md-3">
            
            <div class="box box-widget widget-user">
                  <!-- Add the bg color to the header using any of the bg-* classes -->
                  <div class="widget-user-header bg-black" style="background: url('<?php  echo BASEURL;?>public/AdminLTE-master/dist/img/photo1.png') center center;">
                    <h3 class="widget-user-username"><?php echo ($user[0]['fullname']); ?></h3>
                    <h5 class="widget-user-desc">Statistician</h5>
                  </div>
                  <div class="widget-user-image">
                    <img class="img-circle avatar-upload" style="max-width:100px;height:100xp !important;" src="<?php if($user[0]['file_link']!=null){ echo $user[0]['file_link'];}else{ echo base_url().'public/images/profile_user.png'; } ?>" alt="User Avatar">
                  </div>
                  <div class="box-footer">
                    <div class="row">
                      <div class="col-sm-4 border-right">
                        <div class="description-block">
                          <h5 class="description-header"><?php echo (Modules::run('common/getStatusReportCount',2,$user[0]['id'])); ?></h5>
                          <span class="description-text">Issued</span>
                        </div>
                        <!-- /.description-block -->
                      </div>
                      <!-- /.col -->
                      <div class="col-sm-4 border-right">
                        <div class="description-block">
                          <h5 class="description-header"><?php echo (Modules::run('common/getStatusReportCount',1,$user[0]['id'])); ?></h5>
                          <span class="description-text">Completed</span>
                        </div>
                        <!-- /.description-block -->
                      </div>
                      <!-- /.col -->
                      <div class="col-sm-4">
                        <div class="description-block">
                          <h5 class="description-header"><?php echo (Modules::run('common/getStatusReportCount',0,$user[0]['id'])); ?></h5>
                          <span class="description-text">Pending</span>
                        </div>
                        <!-- /.description-block -->
                      </div>
                      <!-- /.col -->
                    </div>
                    <div class="row">
                                <div class="col-md-12">
                                    <ul class="up-list" style="margin-right:10px;margin-left:-25px;">
                                        <li><span class="up-list-li">Status</span><span class="label label-success">Active</span></li>
                                        <li><span class="up-list-li">User Rating</span><img class="rating-star" src="<?php echo base_url();?>public/images/star_full.png" alt=""><img class="rating-star" src="<?php echo base_url();?>public/images/star_full.png" alt=""><img class="rating-star" src="<?php echo base_url();?>public/images/star_full.png" alt=""><img class="rating-star" src="<?php echo base_url();?>public/images/star_full.png" alt=""><img class="rating-star" src="<?php echo base_url();?>public/images/star_half.png" alt=""></li>
                                        <li><span class="up-list-li">Joinded Since</span>18 Feb 2016</li>
                                    </ul>
                                </div>
                            </div>
                    <!-- /.row -->
                  </div>
                </div>
                   </div>

                <div class="col-md-9">
                    <div style="width:100%;height:440px;background:#FFF;border-radius:6px;padding-top:0px;"><div>


                          <div class="nav-tabs-custom">
                          <ul class="nav nav-tabs">
                            <li class="active"><a href="#activity" data-toggle="tab">Activity</a></li>
                          </ul>
                          <div class="tab-content">
                            <div class="active tab-pane" id="activity">
                                
                                <section class="col-lg-12 connectedSortable">
                                  <div class="box box-primary">
                                    <div class="box-header">
                                      <i class="ion ion-clipboard"></i>
                                      <h3 class="box-title">Activity Timeline</h3>
                                    </div>

                                    <?php 
                                        $logs = Modules::run('common/getUserLog',$user[0]['id']);
                                    ?>
                                    <div class="box-body">
                                      <section class="content">
                                      <div class="row">
                                        <div class="col-md-12">
                                          <ul class="timeline" >
                                            <?php $n = 0;
                                            $length = count($logs);
                                            foreach ($logs as $log): 
                                                if($n==0){
                                            ?>
                                              <li class="time-label">
                                                    <span class="bg-green ">
                                                      <i class="fa  fa-calendar"></i> &nbsp;
                                                      <?php echo date('Y-M-d',strtotime($logs[$n]['action_effected_date'])); ?>&nbsp;
                                                    </span>
                                              </li>

                                            <?php }if( ($n<$length-1) && (date('d-m-Y',strtotime($logs[$n]['action_effected_date'])) != date('d-m-Y',strtotime($logs[$n+1]['action_effected_date'])))){ ?>
                                                <li class="time-label">
                                                      <span class="bg-red disabled">
                                                      <i class="fa  fa-calendar"></i> &nbsp;
                                                        <?php echo date('Y-M-d',strtotime($logs[$n+1]['action_effected_date'])); ?>&nbsp;
                                                      </span>
                                                </li>
                                            <?php } ?>
                                              
                                              <li >
                                                <?php 
                                                if( trim($log['action']) == trim("File Uploaded") ){ 
                                                  ?> 
                                                  <i class="fa fa-folder-open " style="background:#EAA63B;color:#FFF;"></i>
                                                <?php }
                                                elseif( trim($log['action']) == trim("New Record Added") ){ ?>
                                                  <i class="fa  fa-file" style="background:#0072B5;color:#FFF;"></i>
                                                <?php }
                                                elseif( trim($log['action']) == trim("Record Modified") ){ ?>
                                                  <i class="fa  fa-edit" style="background:#2BAAB1;color:#FFF;"></i>
                                                <?php }
                                                elseif( trim($log['action']) == trim("Record Removed") ){ ?>
                                                  <i class="fa  fa-trash" style="background:#E36159;color:#FFF;"></i>
                                                <?php }
                                                else{ ?>
                                                  <i class="fa fa-edit" style="background:#3B4E57;color:#FFF;"></i>
                                                <?php } ?>
                                                

                                                <div class="timeline-item">
                                                  <span class="time"><i class="fa fa-clock-o"></i>&nbsp;&nbsp;<?php echo date('H:i:s',strtotime($log['action_effected_date'])); ?></span>

                                                  <h3 class="timeline-header no-border" style="font-size:90%;"> <?php echo $log['action']; ?> for <b><?php echo $log['comp_name'].' - '.substr($log['report_name'],0,50); ?></b> by <a href="/user/profile/<?php echo $log['user_id']; ?>" style="text-decoration:none;"><img src="<?php if($log['file_link']!=null){ echo $log['file_link'];}else{ echo base_url().'public/images/profile_user.png'; } ?>" alt="" class="prof-pic-dash" ></a> <a href="#"><?php echo $log['username'] ?></a></h3>
                                                </div>
                                              </li>
                                            <?php $n++;
                                            endforeach 
                                            ?>
                                          </ul>
                                        </div>
                                      </div>
                            </section>
                            </div>
                            <div class="box-footer clearfix no-border">
                              <a href="/logs/home" class="btn btn-default pull-right"><i class="fa fa-plus"></i> View All</a>
                            </div>
                          </div>
                        </section>
                            </div>
                            
                           
                          </div>
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



















<!-- Modal -->
<div class="modal fade" id="uploadProfPicModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Upload Profile Picture</h4>
      </div>
      <div class="modal-body">
        <form  class="dropzone" id="dropzonex"> <input type="hidden" name="record_id" id="record_id"></form>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function(){
        var password = document.getElementById("password")
  , confirm_password = document.getElementById("passwordre");

function validatePassword(){
  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Passwords Don't Match");
  } else {
    confirm_password.setCustomValidity('');
  }
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;
});



Dropzone.options.dropzonex = {
        url:"/user/uploadProfPic/"+<?php echo $user[0]['id'];?>,
        init: function() {
        }
    };
</script>