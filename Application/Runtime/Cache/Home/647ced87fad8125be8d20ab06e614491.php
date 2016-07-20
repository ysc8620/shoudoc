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
<link rel="stylesheet" href="/Public/css/page/edit.css?1.1third" />
<link rel="stylesheet" href="/Public/editor.md/css/editormd.css" />
<style type="text/css">

</style>
<div id="layout">
    <!-- 顶部条 -->
    <header class="row">
        <div class="head-left  pull-left">
            <ul class="inline">
                <li>
                    <input type="text" name="page_title" id="page_title" placeholder="<?php echo (L("input_page_title")); ?>" value="<?php echo ($page["page_title"]); ?>" tabindex="1">
                </li>
                <li>
                    <?php echo (L("level_2_directory")); ?>：
                    <select name="cat_id" id="cat_id" tabindex="2"></select>
                </li>
                <li id="li_parent_cat">
                    <?php echo (L("level_3_directory")); ?>：
                    <select name="parent_cat_id" id="parent_cat_id" ></select>
                </li>
                <li>
                    <input type="text" name="s_number" id="s_number" value="<?php echo ($page["s_number"]); ?>" placeholder="<?php echo (L("s_number_explain")); ?>" title="<?php echo (L("s_number_explain")); ?>"  tabindex="3" >
                </li>
                <li>
                    <!-- 首次添加没有历史版本，不显示 -->
                    <?php if($page["page_id"] > 0): ?><a href="?s=home/page/history&page_id=<?php echo ($page["page_id"]); ?>"><?php echo (L("history_version")); ?></a>
                        <?php else: endif; ?>
                </li>
            </ul>
        </div>
        <div class="head-right pull-right">
            <a href="#" class="btn btn-primary " id="save"><?php echo (L("save")); ?></a>
            <a href="?s=home/item/show&item_id=<?php echo ($item_id); ?>&page_id=<?php echo ($page["page_id"]); ?>" class="btn cancel"><?php echo (L("cancel")); ?></a>
        </div>
    </header>
    <br>
    <!-- 插入模板的按钮组 -->
    <div class="btns">
        <button id="api-doc" tabindex="4" ><?php echo (L("inser_apidoc_template")); ?></button>
        <button id="database-doc" tabindex="5" ><?php echo (L("inser_database_doc_template")); ?></button>
        <button id="jsons" tabindex="7" ><?php echo (L("json_to_table")); ?></button>
        <a href="<?php echo U('Home/page/http_api');?>" target="_blank" class="btn" ><?php echo (L("http_test_api")); ?></a>
    </div>
    <div id="editormd">
        <textarea id="page_content" style="display:none;" tabindex="6" ><?php echo ($page["page_content"]); ?></textarea>
    </div>
    <input type="hidden" id="item_id" value="<?php echo ($item_id); ?>">
    <input type="hidden" id="page_id" value="<?php echo ($page["page_id"]); ?>">
    <input type="hidden" id="default_second_cat_id" value="<?php echo ($default_second_cat_id); ?>">
    <input type="hidden" id="default_child_cat_id" value="<?php echo ($default_child_cat_id); ?>">
</div>
<!-- 模板存放的地方 -->
<div id="api-doc-templ" style="display:none">
    
**简要描述：** 

- 用户注册接口

**请求URL：** 
- ` http://xx.com/api/user/register `
  
**请求方式：**
- POST 

**参数：** 

|参数名|必选|类型|说明|
|:----    |:---|:----- |-----   |
|username |是  |string |用户名   |
|password |是  |string | 密码    |
|name     |否  |string | 昵称    |

 **返回示例**

``` 
  {
    "error_code": 0,
    "data": {
      "uid": "1",
      "username": "12154545",
      "name": "吴系挂",
      "groupid": 2 ,
      "reg_time": "1436864169",
      "last_login_time": "0",
    }
  }
```

 **返回参数说明** 

|参数名|类型|说明|
|:-----  |:-----|-----                           |
|groupid |int   |用户组id，1：超级管理员；2：普通用户  |

 **备注** 

- 更多返回错误代码请看首页的错误代码描述


</div>
<div id="database-doc-templ" style="display:none">
    
-  用户表，储存用户信息

|字段|类型|空|默认|注释|
|:----    |:-------    |:--- |-- -|------      |
|uid	  |int(10)     |否	|	 |	           |
|username |varchar(20) |否	|    |	 用户名	|
|password |varchar(50) |否   |    |	 密码		 |
|name     |varchar(15) |是   |    |    昵称     |
|reg_time |int(11)     |否   | 0  |   注册时间  |

- 备注：无


</div>

<div id="json-templ" class="editormd-dialog editormd-preformatted-text-dialog" style="width: 780px; height: 540px;">

    <div style="cursor: move;" class="editormd-dialog-header">
        <strong class="editormd-dialog-title"><?php echo (L("json_to_table")); ?></strong>
    </div>
    <a class="fa fa-close editormd-dialog-close" href="javascript:closeDiv('#json-templ');"></a>
    <div class="editormd-dialog-container">
        <textarea id="jsons_add" class="jsons" placeholder="<?php echo (L("json_to_table_description")); ?>"></textarea>
        
        <div class="editormd-dialog-footer">
            <button class="editormd-btn editormd-enter-btn"><?php echo (L("confirm")); ?></button>
            <button class="editormd-btn editormd-cancel-btn" onclick="closeDiv('#json-templ')"><?php echo (L("cancel")); ?></button>
        </div>
    </div>
    <div class="editormd-dialog-mask editormd-dialog-mask-bg"></div><div class="editormd-dialog-mask editormd-dialog-mask-con"></div>
</div>


   
	<script src="/Public/js/common/jquery.min.js"></script>
    <script src="/Public/bootstrap/js/bootstrap.min.js"></script>
    <script src="/Public/js/common/showdoc.js"></script>
    <div style="display:none">
    	<?php echo C("STATS_CODE");?>
    </div>
  </body>
</html> 

<script src="/Public/js/jquery.bootstrap-growl.min.js"></script>
<script src="/Public/js/jquery.hotkeys.js"></script>
<script src="/Public/editor.md/editormd.min.js"></script>
<script src="/Public/editor.md/plugins/image-dialog/image-dialog.js"></script>
<script src="/Public/editor.md/plugins/link-dialog/link-dialog.js"></script>
<script src="/Public/editor.md/plugins/preformatted-text-dialog/preformatted-text-dialog.js"></script>
<script src="/Public/editor.md/plugins/code-block-dialog/code-block-dialog.js"></script>
<script src="/Public/editor.md/plugins/html-entities-dialog/html-entities-dialog.js"></script>
<script src="/Public/editor.md/plugins/goto-line-dialog/goto-line-dialog.js"></script>
<script src="/Public/editor.md/plugins/table-dialog/table-dialog.js"></script>
<script src="/Public/editor.md/plugins/reference-link-dialog/reference-link-dialog.js"></script>

<script src="/Public/js/page/edit.js?v=1.1.2thirdonm"></script>
<?php if(LANG_SET=='en-us'): ?><script src="/Public/editor.md/languages/en.js"></script><?php endif; ?>