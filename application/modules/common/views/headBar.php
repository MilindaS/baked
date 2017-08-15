<?php $url = explode('/',uri_string()); 
$loggedinuser=$this->session->userdata ( 'logged_in');
$user_details = Modules::run('user/getUser',$loggedinuser['id']);
?>
<header class="main-header">
    <a href="/dash/home" class="logo">
      <span class="logo-mini"><b>Stat</b></span>
      <span class="logo-lg"><b>Statistic</b></span>
    </a>
    <nav class="navbar navbar-static-top">
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          
          <!-- User Account: style can be found in dropdown.less -->
          <?php
                $arr = Modules::run('common/getNotifications');
                
              ?>
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" id="notifiToggle" data-toggle="dropdown" aria-expanded="true" style="height:10px;">
              <i class="fa fa-envelope-o" style="font-size:18px;"></i>
              
              <iframe width="20px" height="15px" style="z-index:99999;background:none;padding:0px;display:block;margin:0px;border:none;position:relative;top:-25px;left:10px;" frameBorder="0" src="http://10.2.16.50:3000/notification?username_lg=<?php echo $loggedinuser['username']; ?>&userid_lg=<?php echo $loggedinuser['id']; ?>" scrolling="no"></iframe>
              <?php //echo count($arr); ?>
            </a>
            <ul class="dropdown-menu" style="margin-top:20px;">
              <li class="header">You have <span id="numberOfMsgs"></span> messages</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <div class="slimScrollDiv" style="position: relative; overflow-y: scroll; width: auto; height: 200px;"><ul class="menu" style="overflow-y: scroll; width: 100%; height: 200px;">
                 
               
                </ul><div class="slimScrollBar" style="width: 3px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 131.148px; background: rgb(0, 0, 0);"></div><div class="slimScrollRail" style="width: 3px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; opacity: 0.2; z-index: 90; right: 1px; background: rgb(51, 51, 51);"></div></div>
              </li>
              <li class="footer"><a href="#">See All Messages</a></li>
            </ul>
            
          </li>

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
                  <?php echo $loggedinuser['username']; ?> - Statitian
                  <small>Member since Nov. 2016</small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="/user/home" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a  href="/auth/logout" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>






  <script>
  $(document).ready(function(){
      // $('.slimScrollDiv').slimScroll({
      //   alwaysVisible: true,
      //   size: '3px',
      //   height: '205px'
      // });
      $('#notifiToggle').click(function(){
        $.ajax({
          method: "POST",
          url: "/common/getNotifications",
          data: {},
          dataType : 'JSON'
        }).done(function(msg) {
            console.log(msg);
            $('#numberOfMsgs').html(msg.length);
            var html = '';
            for(x in msg){
              html += '<li style="font-size:11px;width:100%;float:left;">'+
                        '<a href="/wall/home#'+msg[x]._id.$id+'" id="'+msg[x]._id.$id+'" class="notificA">'+

                          '<div class="row" style="margin:5px 0px;">'+
                            '<div class="col-md-2" style="padding-left:10px;"><img src="'+msg[x].user_a_profpic+'" class="img-circle pull-left" alt="User Image" style="width:40px;height:40px;"></div>'+
                            '<div class="col-md-10">'+
                              '<div class="row" style="margin-top:2px;">'+
                                '<div class="col-md-8"><span style="font-size:15px;">'+msg[x].user_a_username+'</span></div>'+
                                '<div class="col-md-4"><small class="pull-right"><i class="fa fa-clock-o"></i> 5 mins</small></div>'+
                              '</div>'+
                              '<div class="row" style="margin-top:2px;">'+
                                '<div class="col-md-12"><p>'+msg[x].action+' '+((msg[x].action=='added')? 'a': msg[x].user_p_username )+' message</p></div>'+
                              '</div>'+
                            '</div>'+
                          '</div>'+
                        '</a>'+
                      '</li>';
            }
            $('.slimScrollDiv').html(html);


        });
      });




// $(document).on('click',".notificA",function(e) { 
//     e.preventDefault(); 
//     // console.log($(this).attr('id'));    
//     goToByScroll(this.id);       
// });

});


  // This is a functions that scrolls to #{blah}link
function goToByScroll(id){
      // Remove "link" from the ID
    id = id.replace("link", "");
      // Scroll
    $('iframe,html,body').animate({
        scrollTop: $("#"+id).offset().top},
        'slow');
}
  </script>