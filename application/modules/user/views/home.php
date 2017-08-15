<?php
$loggedinuser = $this->session->userdata ( 'logged_in');
$user = modules::run('user/getUser',$loggedinuser['id'])
?>

<div id="wrapper">
        <?php echo modules::run('common/headBarMain'); ?>
        <?php echo modules::run('common/navigationBarMain'); ?>



      <div class="content-wrapper" style="min-height:auto !important">

      <section class="content-header">
        <h1>
          Account Settings 
          <small>( <?php echo ($user[0]['fullname']); ?> ) </small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Account Settings </li>
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
                    <img class="img-circle avatar-upload" style="cursor:pointer" src="<?php if($user[0]['file_link']!=null){ echo $user[0]['file_link'];}else{ echo base_url().'public/images/profile_user.png'; } ?>" alt="User Avatar">
                  </div>
                  <div class="box-footer">
                    
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
                        <div style="width:100%;height:440px;background:#FFF;border-radius:6px;padding-top:0px;">
                            <div>


                          <div class="nav-tabs-custom">
                          <ul class="nav nav-tabs">
                            <li class="active"><a href="#activity" data-toggle="tab">Activity</a></li>
                            <li><a href="#general" data-toggle="tab">General</a></li>
                            <li><a href="#passwords" data-toggle="tab">Passwords</a></li>
                          </ul>
                          <div class="tab-content">
                            <div class="active tab-pane" id="activity">
                                <section class="col-lg-12 connectedSortable">
                                  <div class="box box-primary">
                                    <div class="box-header">
                                      <i class="ion ion-clipboard"></i>
                                      <h3 class="box-title">Activity Timeline</h3>
                                    </div>

                                    
                                    <div class="box-body">
                                      <section class="content">
                                      <div class="row">
                                      </div>
                            </section>
                            </div>
                            <div class="box-footer clearfix no-border">
                              <a href="/logs/home" class="btn btn-default pull-right"><i class="fa fa-plus"></i> View All</a>
                            </div>
                          </div>
                        </section>
                            </div>
                            <div class="tab-pane" id="general">
                              <div class="row">
                                <div class="col-md-6 col-md-offset-3">
                                <form class="form-general-details" action="/user/changeGenDetails" method="POST">
                                    <div class="form-group">
                                        <label for="firstname">Full Name</label>
                                        <input type="text" id="fullname" name="fullname" class="form-control" placeholder="Full name" value="<?php echo ($user[0]['fullname']); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="lastname">Username</label>
                                        <input type="text" id="username" name="username" class="form-control" placeholder="Username" value="<?php echo ($user[0]['username']); ?>">
                                    </div>
                                    <button class="btn btn-primary pull-right" type="submit">Update</button>
                                  </form>
                               </div>
                            </div>
                            </div>
                            <div class="tab-pane" id="passwords">
                              <div class="row">
                                  <div class="col-md-6 col-md-offset-3">
                                <form class="form-change-password" action="/user/changePwd" method="POST">
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="passwordre">Re Password</label>
                                        <input type="password" id="passwordre" name="passwordre" class="form-control" placeholder="Re Password" required>
                                    </div>
                                    <button class="btn btn-primary pull-right" type="submit">Update</button>
                                  </form>
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

  $('.avatar-upload').click(function(){
    $('#uploadProfPicModal').modal('show');
  });

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