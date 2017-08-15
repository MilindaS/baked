<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 3.2//EN">
<html lang="en">
  <head>
    <meta charset="utf-8">
	<title>Customs Statistics</title>
	<meta name="description" content="Description" />
    <meta name="keywords" content="keywords" />
	
    <meta name="viewport" content="width=device-width">

    
	<?php
		if(isset($meta_array) && !empty($meta_array)){
			foreach($meta_array AS $item){
				echo '<meta name="'.$item['name'].'" content="'.$item['content'].'" />';
				}
		}
	?>
	<?php
		if(isset($meta_og_array) && !empty($meta_og_array)){
			foreach($meta_og_array AS $item){
				echo '<meta property="'.$item['property'].'" content="'.$item['content'].'" />';
				}
		}
	?>


    <link rel="stylesheet" href="<?php	echo BASEURL;?>public/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php	echo BASEURL;?>public/vendor/AdminLTE-master/dist/css/AdminLTE.min.css">
	<link rel="stylesheet" href="<?php	echo BASEURL;?>public/vendor/AdminLTE-master/dist/css/skins/_all-skins.min.css">
	<link rel="stylesheet" href="<?php	echo BASEURL;?>public/vendor/AdminLTE-master/plugins/iCheck/flat/blue.css">
	<link rel="stylesheet" href="<?php	echo BASEURL;?>public/vendor/AdminLTE-master/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

	<link rel="stylesheet" href="<?php	echo BASEURL;?>public/css/style.css">
	<link rel="stylesheet" href="<?php	echo BASEURL;?>public/vendor/AdminLTE-master/plugins/ionicons-2.0.1/css/ionicons.min.css">
	<link rel="stylesheet" href="<?php	echo BASEURL;?>public/vendor/AdminLTE-master/plugins/iCheck/all.css">
	<link rel="stylesheet" href="<?php	echo BASEURL;?>public/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php	echo BASEURL;?>public/css/pill.css">
	<link rel="stylesheet" href="<?php	echo BASEURL;?>public/css/jquery.growl.css">
	<link rel="stylesheet" href="<?php	echo BASEURL;?>public/css/calc.css">

<!-- <link href="http://netdna.bootstrapcdn.com/font-awesome/3.0.2/css/font-awesome.css" rel="stylesheet"> -->

	
<link href="<?php	echo BASEURL;?>public/vendor/bootstrap-wysiwyg-master/external/google-code-prettify/prettify.css" rel="stylesheet">
<link href="<?php	echo BASEURL;?>public/vendor/bootstrap-wysiwyg-master/index.css" rel="stylesheet">
    
    
		
    
		










	<style>
	.layer1_class { position: absolute; z-index: 1; top: 100px; left: 0px; visibility: visible;width:100%; background: black;}
      .layer2_class { position: absolute; z-index: 2; top: 10px; left: 10px; visibility: hidden;height:100%;background: black; }</style>
	<?php

		if(isset($css_array) && !empty($css_array)){

			foreach($css_array AS $item){
					echo '<link rel="stylesheet" href="'.BASEURL.'public/css/'.$item.'" type="text/css" />'."\n";
				}

		}

	?>

	<script src="<?php	echo BASEURL;?>public/js/jquery-1.11.0.min.js"></script>
	<script src="<?php	echo BASEURL;?>public/js/bootstrap.min.js"></script>
	<script src="<?php	echo BASEURL;?>public/js/jquery.scrollUp.min.js"></script>
	<script src="<?php	echo BASEURL;?>public/js/jquery.growl.js"></script>
	<script src="<?php	echo BASEURL;?>public/js/jquery.slimscroll.min.js"></script>
	
	<script src="<?php	echo BASEURL;?>public/vendor/datatables/media/js/jquery.dataTables.min.js"></script>
	<script src="<?php	echo BASEURL;?>public/vendor/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
	
	
	<script src="<?php	echo BASEURL;?>public/vendor/bootstrap-wysiwyg-master/external/jquery.hotkeys.js"></script>
    

    <script src="<?php	echo BASEURL;?>public/vendor/bootstrap-wysiwyg-master/external/google-code-prettify/prettify.js"></script>
		
    <script src="<?php	echo BASEURL;?>public/vendor/bootstrap-wysiwyg-master/bootstrap-wysiwyg.js"></script>
    <script src="<?php	echo BASEURL;?>public/js/d3.min.js"></script>
    <script src="<?php	echo BASEURL;?>public/vendor/AdminLTE-master/plugins/iCheck/icheck.min.js"></script>
	<script src="<?php	echo BASEURL;?>public/vendor/AdminLTE-master/dist/js/app.min.js"></script>
	<?php

	if(isset($js_array) && !empty($js_array))
	{
		foreach($js_array AS $item){
				echo  '<script type="text/javascript"  src="'.BASEURL.'public/js/'.$item.'"  ></script>'."\n";

		}

	}

	?>
  </head>
  <body class="hold-transition skin-blue sidebar-mini" style="background:#1B1E24;">

  
	<?php
	//$loggedinuser=$this->session->userdata ( 'logged_in');
	 //print_r($loggedinuser); ?>
	<!-- <div style="position:absolute;width:auto;height:auto;background:red;bottom:0px;left:0px;float:left;z-index:9999;margin:20px;"> -->
	   	
	   	<div class="collapse" id="collapseExample">
		   	<div id="calculator"></div>
    	</div>

<!-- 
    	
		<div class="collapse" id="collapseExample">
		  <div class="well">
		    ...
		  </div>
		</div> -->
	<!-- </div> -->

	
	
	<script src="<?php	echo BASEURL;?>public/js/bigInteger.js"></script>
	<script src="<?php	echo BASEURL;?>public/js/calcAdv.js"></script>
<script>
// document.addEventListener('DOMContentLoaded', function () {
//   particleground(document.getElementById('particles'), {
//     dotColor: '#555',
//     lineColor: '#444'
//   });
//   var intro = document.getElementById('intro');
//   intro.style.marginTop = - intro.offsetHeight / 2 + 'px';
// }, false);
</script>