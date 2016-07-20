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
<style type="text/css">
	input{
		width: 100%;
	}
</style>
<div id="layout" style="width: 70%;margin: auto;">
	<form class="form-horizontal">
		<h2 style="text-align: center;"><?php echo (L("api_test_title")); ?></h2>
        <div class="control-group">
          <div class="controls">
            <select style="width: 100px;" id="method" >
            	<option value="post">POST</option>
            	<option value="get">GET</option>
            </select>
          </div>
        </div>
        <div class="control-group">
          <div class="controls">
          	<label ><?php echo (L("api_address_description")); ?></label>
            <input type="text" id="url"  placeholder="<?php echo (L("api_address")); ?>" >
          </div>
        </div>
        <div class="control-group">
          <div class="controls">
          	<label ><?php echo (L("params_description")); ?>)</label>
            <input type="text" id="params" placeholder="<?php echo (L("params")); ?>" >
          </div>
        </div>
        <div class="control-group">
          <div class="controls">
            <button type="button" class="btn btn-primary" id="http-submit"><?php echo (L("submit")); ?></button>
            <button type="reset"  class="btn btn-link" ><?php echo (L("clear")); ?></button>
          </div>
        </div>
        <div class="control-group">
          <div class="controls">
          	<label ><?php echo (L("result")); ?></label>
			<textarea style="width: 100%;height: 300px;" id="http-response"></textarea>
          </div>
        </div>
      </form>
</div>
   
	<script src="/Public/js/common/jquery.min.js"></script>
    <script src="/Public/bootstrap/js/bootstrap.min.js"></script>
    <script src="/Public/js/common/showdoc.js"></script>
    <div style="display:none">
    	<?php echo C("STATS_CODE");?>
    </div>
  </body>
</html> 

<script type="text/javascript">
	$(function () {
		//格式化json数据
		function dump(arr,level) { 
			 var dumped_text = ""; 
			 if(!level) level = 0; 
			 
			 //The padding given at the beginning of the line. 
			 var level_padding = ""; 
			 for(var j=0;j<level+1;j++) level_padding += "     "; 
			 if(typeof(arr) == 'object') { //Array/Hashes/Objects 
			 	 var i=0;
				 for(var item in arr) { 
					 var value = arr[item]; 
					 if(typeof(value) == 'object') { //If it is an array, 
						 dumped_text += level_padding + "\"" + item + "\" : \{ \n"; 
						 dumped_text += dump(value,level+1); 
					 	 dumped_text +=level_padding +"\}";
					 } else { 
					 	dumped_text += level_padding + "\"" + item + "\" : \"" + value + "\""; 
					 } 
					 if(i<Object.getOwnPropertyNames(arr).length-1){
					 	dumped_text+=", \n";
					 }else{
					 	dumped_text+=" \n";
					 }
					 i++;
				 } 
			 } else { //Stings/Chars/Numbers etc. 
			 	dumped_text = "===>"+arr+"<===("+typeof(arr)+")"; 
			 } 
			 return dumped_text; 
		} 
		$("#http-submit").on('click',function () {
			$.post("?s=home/page/ajaxHttpApi",{
				url:$("#url").val(),
				method:$("#method").val(),
				params:$("#params").val()
			},function (data) {
				try{
					var text="\{ \n"+dump(JSON.parse(data))+" \}";//整体加个大括号
					$("#http-response").val(text);
				}catch(e){
					//非json数据直接显示
					$("#http-response").val(data);
				}
			});
		});
	});
</script>