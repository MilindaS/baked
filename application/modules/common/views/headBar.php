<?php $url = explode('/',uri_string()); 
$loggedinuser=$this->session->userdata ( 'logged_in');
$user_details = Modules::run('user/getUser',$loggedinuser['id']);
?>
<header class="main-header">
    <a href="/dash/home" class="logo">
      <span class="logo-mini"><b>HENDRICKS</b></span>
      <span class="logo-lg"><b>HENDRICKS</b></span>
    </a>
    <nav class="navbar navbar-static-top">
      <!-- <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a> -->

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          
          <!-- User Account: style can be found in dropdown.less -->
          
         

          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php if($user_details[0]['file_link']!=null){ echo $user_details[0]['file_link'];}else{ echo base_url().'public/images/profile_user.png'; } ?>" alt="" class="user-image"> 
              <!-- <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image"> -->
              <span class="hidden-xs"><?php echo $loggedinuser['username']; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php if($user_details[0]['file_link']!=null){ echo $user_details[0]['file_link'];}else{ echo base_url().'public/images/profile_user.png'; } ?>" alt="" class="img-circle"> 

                <p>
                  <?php echo $loggedinuser['username']; ?> - Administrator
                  <small>Member since <?php echo $user_details[0]['modified_date']; ?></small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="/user/home" class="btn btn-default"> <i class="fa fa-suitcase"></i> &nbsp;&nbsp;Profile</a>
                </div>
                <div class="pull-right">
                  <a  href="/auth/logout" class="btn btn-default"><i class="fa fa-sign-out"></i>&nbsp;&nbsp;Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>





