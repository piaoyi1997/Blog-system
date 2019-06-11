<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
	<title>主页</title>
	<script type="text/javascript" src="<?php echo base_url('static');?>/js/vue.js"></script>
	<script src="<?php echo base_url('static');?>/js/vue-resource.js"></script>
	<script src="<?php echo base_url('static');?>/js/jquery.min.js"></script>
	<link href="<?php echo base_url('static');?>/css/bootstrap.min.css" rel="stylesheet">
	<script src="<?php echo base_url('static');?>/css/bootstrap.min.js"></script>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<style type="text/css">
	body,html{
		margin: 0;padding: 0;
	}
	#head{
		height: 55px;
		position: relative;
		border-bottom:1px #dab8b8 solid;
	}
	#btn{
		position: absolute;
		left: 830px;
		top: 3px;
	}
	#btn2{
		position: absolute;
		left: 900px;
		top: 3px;
	}
	#btn4{
		position: absolute;
		left: 910px;
		top: 3px;
		text-align: center;
	}
	#btn3{
		position: absolute;
		left: 1100px;
		top: 3px;
		background:#e27474;
	}
	#a1{
		position: absolute;
		display: inline-block;
		/*border: 1px #000 solid;*/
		height: 55px;
		line-height: 55px;
		width: 80px;
		text-align: center;
		left: 200px;
		font-size: 25px;
		text-decoration:none;
		color: #d2506d;
	}
	#a1:hover{
		background: #eee;
	}
	#img1{
		margin: -6px;
		height: 49px;
		width: 49px;
	}
</style>
<body>
	<div>
		<div id="head">
			<b style="font-size: 28px;line-height: 55px;margin-left: 20px;color: #c12c4e;">繁书</b>
			<a href="<?php echo site_url()?>/MainController" id="a1">首页</a>
			<div id="app">
				<div v-if='flag'>
					<a class="btn btn-default btn-lg" id="btn" href="<?php echo site_url()?>/LoginController">登录</a>
					<a type="button" class="btn btn-default btn-lg" id="btn2" href="<?php echo site_url()?>/LoginController">注册</a>
				</div>
				<div v-else>
					
					<div class="btn-group" id="btn4">
						<!-- 设置头像 -->
					    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" style="height: 50px;width: 70px;font-size: 18px;">
					    	<img src="<?php echo base_url('static')?>/img/<?php echo $img;?>.jpg" class="img-circle" id='img1'>
					    	<span class="caret"></span>
					    </button>
					    <ul class="dropdown-menu" role="menu">
					        <li>
					        	<span class="glyphicon glyphicon-user" style="margin-left: 30px;">
					            <a style="color: black;font-size: 16px;" href="<?php echo site_url()?>/MainController/gr_Main">我的首页</a>
					        </li>
					        <li class="divider"></li>
					        <li>
					        	<span class="glyphicon glyphicon-lock" style="margin-left: 30px;">
					            <a style="color: black;font-size: 16px;" href="" data-toggle="modal" data-target="#myModal">修改密码</a>
					        </li>
					        <li class="divider"></li>
					        <li>
					        	<span class="glyphicon glyphicon-log-out" style="margin-left: 30px;font-size: 16px;">
					            <a style="color: black;" href="<?php echo site_url()?>/MainController/zhuxiao">注销账号</a>
					        </li>
					    </ul>
					</div>
				</div>

				<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				    <div class="modal-dialog">
				        <div class="modal-content">
				            <div class="modal-header">
				                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                <h4 class="modal-title" id="myModalLabel">修改密码</h4>
				            </div>
				            <div class="modal-body">
				            	<form class="form-horizontal" role="form">
								  <div class="form-group">
								    <label for="jiu_password" class="col-sm-2 control-label">名字</label>
								    <div class="col-sm-8">
								      <input type="text" class="form-control" id="jiu_password" placeholder="请输入旧密码" required v-model='jiu_password'>
								    </div>
								  </div>
								  <div class="form-group">
								    <label for="xin_password" class="col-sm-2 control-label">名字</label>
								    <div class="col-sm-8">
								      <input type="password" class="form-control" id="xin_password" placeholder="请输入新密码" required v-model='xin_password'>
								    </div>
								  </div>
								  <div class="form-group">
								    <label for="xin_password2" class="col-sm-2 control-label">名字</label>
								    <div class="col-sm-8">
								      <input type="password" class="form-control" id="xin_password2" placeholder="再次输入新密码" required v-model='xin_password2'>
								    </div>
								  </div>
								</form>  
				            </div>
				            <div class="modal-footer">
				                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
				                <button type="button" class="btn btn-primary" @click='change_MM'>提交更改</button>
				            </div>
				        </div><!-- /.modal-content -->
				    </div><!-- /.modal -->
				</div>
			</div>
			<a type="button" class="btn btn-default btn-lg" id="btn3" href="<?php echo site_url()?>/WriteController"> <span class="glyphicon glyphicon-pencil"></span>写文章</a>
		</div>
	<script type="text/javascript">
		new Vue({
	    el: '#app',
	  	data:{
	  		flag:false,
	  		jiu_password:'',
	  		xin_password:'',
	  		xin_password2:''
	  	},
	  	created(){
	  		this.isLogin();
	  	},
	  	methods:{
	  		isLogin:function(){
	  			this.$http.get('<?php echo site_url()?>/MainController/isLogin').then(function(res){
	  				// alert(res.body);
                	if (res.body==1) {
                		this.flag=false;
                		// alert(res.body);
                	}else{
                		this.flag=true;
                	}  
	            },function(){
	                console.log('请求失败处理');
	            });
	  		},
	  		change_MM:function(){
	  			if (this.jiu_password=='' || this.xin_password=='' || this.xin_password2=='') {
	  				alert('不能有空值！！！');
	  			}else if(this.xin_password2!=this.xin_password){
	  				alert('两次密码不一致！！！');
	  			}else{
	  				this.$http.post('<?php echo site_url()?>/LoginController/change_MM',{jiu_password:this.jiu_password,xin_password:this.xin_password},{emulateJSON:true}).then(function(res){
	                    	alert(res.body);
	                    		if (res.body=="密码修改成功") {
	                    			window.location.href="<?php echo site_url()?>/LoginController";
	                    		}
	                    	},function(res){
	                   	 	console.log(res.status);
	                	});	
	  			}
	  		}
	  	}
	});
	</script>