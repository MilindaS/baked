<?php $url = explode('/',uri_string()); 
$loggedinuser=$this->session->userdata ( 'logged_in');
$user_details = Modules::run('user/getUser',$loggedinuser['id']);
?>
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php if($user_details[0]['file_link']!=null){ echo $user_details[0]['file_link'];}else{ echo base_url().'public/images/profile_user.png'; } ?>" alt="" class="img-circle"> 
        </div>
        <div class="pull-left info">
          <p><a href="/user/profile/<?php echo $loggedinuser['id']; ?>" href="#"><?php echo $loggedinuser['username']; ?></a></p>
          <a href="#"><i class="fa fa-circle text-green gastro"></i> Online</a>
        </div>
      </div>
      
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li <?php if($url[0]=="dash"){echo 'class="active"';} ?> >
          <a href="/dash/home">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span> 
          </a>
        </li>
      </ul>
    </section>
    
  </aside>