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

    <!--特殊JS CSS 放这里重写-->
    
</head>
<body>
<div class="main">
    
        <!--导航部分-->
        <nav class="navbar navbar-default navbar-fixed-bottom">
            <div class="container-fluid text-center">
                <div class="col-xs-3">
                    <p class="navbar-text"><a href="index.html" class="navbar-link">首页</a></p>
                </div>
                <div class="col-xs-3">
                    <p class="navbar-text"><a href="fuwu.html" class="navbar-link">服务</a></p>
                </div>
                <div class="col-xs-3">
                    <p class="navbar-text"><a href="faxian.html" class="navbar-link">发现</a></p>
                </div>
                <div class="col-xs-3">
                    <p class="navbar-text"><a href="my.html" class="navbar-link">我的</a></p>
                </div>
            </div>
        </nav>
        <!--导航结束-->
    


    <div class="container-fluid">
        <form action="<?php echo U();?>" method="post" class="form-horizontal">
            <div class="form-group">
                <label>您的姓名(必填):</label>
                <input type="text" class="form-control" required name="name"/>
            </div>
            <div class="form-group">
                <label>您的电话(必填):</label>
                <input type="text" class="form-control" required name="tel" />
            </div>
            <div class="form-group">
                <label>您的地址(必填):</label>
                <input type="text" class="form-control" required name="address" />
            </div>
            <div class="form-group">
                <label>内容(详细描述需要报修的内容):</label>
                <textarea type="text" class="form-control" required name="problem" ></textarea>
            </div>
            <div class="form-group">
                <!--<button class="btn btn-primary onlineBtn">确认提交</button>-->
                <button class="btn submit-btn ajax-post" id="submit" type="submit" target-form="form-horizontal">确 定</button>
            </div>
        </form>
    </div>

</div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="./Public/Home/static/jquery-1.11.2.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="./Public/Home/static/bootstrap/js/bootstrap.min.js"></script>


    <script type="text/javascript" charset="utf-8">
        //导航高亮
        highlight_subnav('<?php echo U('index');?>');
        //ajax post submit请求
        $('.ajax-post').click(function(){
            var target,query,form;
            var target_form = $(this).attr('target-form');
            var that = this;
            var nead_confirm=false;
            if( ($(this).attr('type')=='submit') || (target = $(this).attr('href')) || (target = $(this).attr('url')) ){
                form = $('.'+target_form);

                if ($(this).attr('hide-data') === 'true')else if (form.get(0)==undefined){
                    return false;
                }else if ( form.get(0).nodeName=='FORM' ){
                    if ( $(this).hasClass('confirm') ) {
                        if(!confirm('确认要执行该操作吗?')){
                            return false;
                        }
                    }
                    if($(this).attr('url') !== undefined){
                        target = $(this).attr('url');
                    }else{
                        target = form.get(0).action;
                    }
                    query = form.serialize();
                }else if( form.get(0).nodeName=='INPUT' || form.get(0).nodeName=='SELECT' || form.get(0).nodeName=='TEXTAREA') {
                    form.each(function(k,v){
                        if(v.type=='checkbox' && v.checked==true){
                            nead_confirm = true;
                        }
                    })
                    if ( nead_confirm && $(this).hasClass('confirm') ) {
                        if(!confirm('确认要执行该操作吗?')){
                            return false;
                        }
                    }
                    query = form.serialize();
                }else{
                    if ( $(this).hasClass('confirm') ) {
                        if(!confirm('确认要执行该操作吗?')){
                            return false;
                        }
                    }
                    query = form.find('input,select,textarea').serialize();
                }
                $(that).addClass('disabled').attr('autocomplete','off').prop('disabled',true);
                $.post(target,query).success(function(data){
                    if (data.status==1) {
                        if (data.url) {
                            updateAlert(data.info + ' 页面即将自动跳转~','alert-success');
                        }else{
                            updateAlert(data.info ,'alert-success');
                        }
                        setTimeout(function(){
                            if (data.url) {
                                location.href=data.url;
                            }else if( $(that).hasClass('no-refresh')){
                                $('#top-alert').find('button').click();
                                $(that).removeClass('disabled').prop('disabled',false);
                            }else{
                                location.reload();
                            }
                        },1500);
                    }else{
                        updateAlert(data.info);
                        setTimeout(function(){
                            if (data.url) {
                                location.href=data.url;
                            }else{
                                $('#top-alert').find('button').click();
                                $(that).removeClass('disabled').prop('disabled',false);
                            }
                        },1500);
                    }
                });
            }
            return false;
        });
    </script>

</body>
</html>