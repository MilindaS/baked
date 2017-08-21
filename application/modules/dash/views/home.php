<div class="wrapper">

  <?php echo modules::run('common/headBarMain'); ?>
  <!-- Left side column. contains the logo and sidebar -->
  <?php echo modules::run('common/navigationBarMain'); ?>

  <?php

    




  ?>

  <?php 
  //echo $bytes . '<br />';
  // echo sprintf('%1.2f' , $bytes / pow($base,$class)) . ' ' . $si_prefix[$class];

  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="min-height:auto">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-dashboard"></i>&nbsp;&nbsp;&nbsp;Dashboard 
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      

    </section>
    <!-- /.content-wrapper -->

    <!-- /.content -->
  </div>
    <?php echo modules::run('common/footBarMain'); ?>

</div>
<!-- ./wrapper -->

