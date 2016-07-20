<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?php echo ($item["item_name"]); ?> ShowDoc</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
    @charset "utf-8";
	body {
		font:14px/1.5 "Microsoft Yahei","微软雅黑",Tahoma,Arial,Helvetica,STHeiti;
	}
    </style>
      <script type="text/javascript">
      var DocConfig = {
          host: window.location.origin,
          app: "<?php echo U('/');?>",
          pubile:"/Public",
      }

      DocConfig.hostUrl = DocConfig.host + "/" + DocConfig.app;
      </script>
      <script src="/Public/js/lang.<?php echo LANG_SET;?>.js"></script>
  </head>
  <body>
<link rel="stylesheet" href="/Public/css/login.css" />

    <div class="container">

      <form class="form-signin" method="post">
        <h3 class="form-signin-heading"><?php echo (L("login")); ?></h3>
        <input type="text" class="input-block-level"  name="username" placeholder="<?php echo (L("username")); ?>">
        <input type="password" class="input-block-level" name="password" placeholder="<?php echo (L("password")); ?>">
        <?php if($CloseVerify != 1): ?><input type="text" class="input-block-level"  name="v_code" placeholder="<?php echo (L("verification_code")); ?>">
        <div class="control-group">
          <div class="controls">
            <img src="#" id="v_code_img">
          </div>
        </div><?php endif; ?>
        <button class="btn btn-large btn-primary" type="submit"><?php echo (L("login")); ?></button>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="?s=/home/user/register"><?php echo (L("no_account")); ?></a>
      </form>

    </div> <!-- /container -->


    
	<script src="/Public/js/common/jquery.min.js"></script>
    <script src="/Public/bootstrap/js/bootstrap.min.js"></script>
    <script src="/Public/js/common/showdoc.js"></script>
    <div style="display:none">
    	<?php echo C("STATS_CODE");?>
    </div>
  </body>
</html> 


 <script type="text/javascript">
 $(function(){
    $("#v_code_img").attr("src" , DocConfig.pubile+'/verifyCode.php');
    $("#v_code_img").click(function(){
      var v_code_img = $("#v_code_img").attr("src");
      $("#v_code_img").attr('src' ,v_code_img+'?'+Date.parse(new Date()) );
    }); 
 });
</script>