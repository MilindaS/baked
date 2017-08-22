<div class="login-box ">
  <div class="login-logo">
    <a href="#" style="color:#FFF;"><i class="glyphicon glyphicon-fire" style="color:#607F8D;font-size:26px;"></i>&nbsp;&nbsp;<b>Hendricks </b>Dashboard</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body" style="background:rgba(0,0,0,0.3);box-shadow:0px -2px 10px 1px rgba(0,0,0,0.3) inset;border-bottom:1px solid rgba(255,255,255,0.3);">
    <p class="login-box-msg" style="color:#EEE;">Sign in to start your session</p>

    <form role="form" data-toggle="validator" id="myLForm">
      <div class="form-group has-feedback">
        <input class="form-control" placeholder="Username" name="username" autofocus="" type="text">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input class="form-control" placeholder="Password" name="password" value="" type="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        
        <!-- /.col -->
        <div class="col-xs-offset-8 col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat pull-right">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

   

  </div>
  <!-- /.login-box-body -->
</div>



<script>
    $(document).ready(function(){
        $('#myLForm').validator().on('submit', function (e) {
          if (e.isDefaultPrevented()) {
            // handle the invalid form...
          } else {
            // everything looks good!
            var data = $('#myLForm').serialize();
            $.ajax({
              method: "POST",
              url: "/auth/login",
              data: data,
              dataType:'json'
            }).done(function(data) {
                
                
                if(data.type=='success'){
                  // if(data.data[0].authority==9){
                  //    window.location = '<?php echo BASEURL;?>ocdb/repgen';
                  // }else{
                        window.location = '<?php echo BASEURL;?>invoices/home';
                  // }
                  
                  }else{
                    $.growl.error({title:'', message: data.msg ,location:'br'});
                  }
            });
          }
          return false;
        })
    });
</script>