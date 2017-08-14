<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
   
       <meta charset="utf-8">
       <meta http-equiv="X-UA-Compatible" content="IE=edge">
       <meta name="viewport" content="width=device-width, initial-scale=1">
       <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
       <title>Bootstrap 101 Template</title>

       <!-- Bootstrap -->
       <link href="./Public/Home/static/bootstrap/css/bootstrap.min.css" rel="stylesheet">
       <link href="./Public/Home/static/css/style.css" rel="stylesheet">

       <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
       <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
       <!--[if lt IE 9]>
       <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
       <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
       <![endif]-->
       <style>
           .main{margin-bottom: 60px;}
           .indexLabel{padding: 10px 0; margin: 10px 0 0; color: #fff;}
       </style>
   
    
</head>
<body>
<div class="main">
    <!--导航部分-->
    
    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$property): $mod = ($i % 2 );++$i;?><div class="container-fluid">
            <div class="row noticeList">
                <a href="<?php echo U('notice/detail');?>">
                    <div class="col-xs-2">
                        <img class="noticeImg" src="./Public/Home/static/image/1.png" />
                        <!--<img class="noticeImg" src="<?php echo ($u); ?>" />-->
                    </div>
                    <div class="col-xs-10">
                        <p class="title"><?php echo ($property["title"]); ?></p>
                        <p class="intro">经过几年的摸索,XXX小区的业主委会员已经</p>
                        <p class="info"><?php echo ($property["view"]); ?><span class="pull-right"><?php echo (date("Y-m-d H:i:s",$property["create_time"])); ?></span> </p>
                    </div>
                </a>
            </div>
        </div><?php endforeach; endif; else: echo "" ;endif; ?>

    <!--导航结束-->

   

   
</div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="./Public/Home/static/jquery-1.11.2.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="./Public/Home/static/bootstrap/js/bootstrap.min.js"></script>


</body>
</html>