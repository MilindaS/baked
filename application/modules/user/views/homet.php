<?php
$loggedinuser = $this->session->userdata ( 'logged_in');
$user = modules::run('user/getUser',$loggedinuser['id'])
?>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-12">
    <div id="wrapper">
        <?php echo modules::run('common/navigationBarMain'); ?>
        

        <div id="page-wrapper">

            <div class="container-fluid" >

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Account Settings <small>( <?php echo ($user[0]['fullname']); ?> )</small>
                        </h1>
                    </div>
                </div>
                
                <div class="row" style="padding:80px 0px;">
                    <div class="col-md-4 col-md-offset-1" style="background:#91BED4;">
                        <!-- <div style="width:100%;height:340px;background:#FFF;"></div> -->
                        <h3>General Details</h3>
                        <br>
                        <form class="form-general-details" action="/user/changeGenDetails" method="POST">
                        <div class="form-group">
                            <label for="firstname">Full Name</label>
                            <input type="text" id="fullname" name="fullname" class="form-control" placeholder="Full name" value="<?php echo ($user[0]['fullname']); ?>">
                        </div>
                        <div class="form-group">
                            <label for="lastname">Username</label>
                            <input type="text" id="username" name="username" class="form-control" placeholder="Username" value="<?php echo ($user[0]['username']); ?>">
                        </div>
                        <button class="btn btn-lg btn-primary btn-block" type="submit">Update</button>
                      </form>
                    </div>
                    <div class="col-md-offset-1 col-md-4" style="background:#D9D1C7">
                        <h3>Change Password</h3>
                        <br>
                      <form class="form-change-password" action="/user/changePwd" method="POST">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                        </div>
                        <div class="form-group">
                            <label for="passwordre">Re Password</label>
                            <input type="password" id="passwordre" name="passwordre" class="form-control" placeholder="Re Password" required>
                        </div>
                        <button class="btn btn-lg btn-primary btn-block" type="submit">Update</button>
                      </form>

                    </div> <!-- /container -->
                </div>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    </div>
    </div>
    </div>
    <!-- /#wrapper -->


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
</script>