<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script type="text/javascript" src="<?php echo base_url('static');?>/js/vue.js"></script>
	<script src="<?php echo base_url('static');?>/js/vue-resource.js"></script>
	 <link href="<?php echo base_url('static');?>/css/bootstrap.min.css" rel="stylesheet">
	 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<style type="text/css">
	body,html{
		margin: 0;
		padding: 0;
		width: 100%;
		height: 100%;
	}
	.content{
		background:url(<?php echo base_url('static');?>/img/login4.jpg);
		height: 100%;
		width: 100%;
		position: absolute;
		/*opacity: 0.9;*/
	}
	#top{
		margin-top: 40px;
		margin-bottom: 20px;
	}
	.form-horizontal{
		margin-top: 110px;
	}
	a{
		display: block;
		width: 50px;
		height: 30px;
	}
</style>
<body>
<div style="">
	<!-- <h1 style="margin-left: 20px;">飘逸</h1> -->
	<div class="content" id="app">
		<div style="border:1px rgb(232,166,166,1) solid;width: 700px;height: 450px;margin: 80px auto;background: rgb(255,255,255,0.1);border-radius: 10px;">
			<div class="col-sm-8 col-sm-offset-4" id="top">
				<label class="radio-inline" @click="dl">
					<input type="radio" name="optionsRadiosinline" id="optionsRadios3" value="option1" checked> 登录
				</label>
				<label class="radio-inline" @click='zc'>
					<input type="radio" name="optionsRadiosinline" id="optionsRadios4"  value="option2"> 注册
				</label>
			</div>	
			<form class="form-horizontal" role="form" v-show="flag">
				<div class="form-group">
					<label for="firstname" class="col-sm-2 col-sm-offset-1 control-label">用户名</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" id="firstname" placeholder="请输入用户名" v-model='username'>
					</div>
				</div>
				<div class="form-group">
					<label for="lastname" class="col-sm-2 col-sm-offset-1 control-label">密码</label>
					<div class="col-sm-6">
						<input type="password" class="form-control" id="lastname" placeholder="请输入密码" v-model='password'>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-5 col-sm-10">
						<button type="submit" class="btn btn-default" @click.prevent='Login'>登录</button>
					</div>
				</div>	
			</form>
			<form class="form-horizontal" role="form" v-show="flag2">
				<div class="form-group">
					<label for="username" class="col-sm-2 col-sm-offset-1 control-label">用户名</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" id="username" placeholder="请填写账号" v-model='username2' required>
					</div>
				</div>
				<div class="form-group">
					<div>
						<label class="col-sm-2 col-sm-offset-1 control-label">性别</label>
						<label class="radio-inline col-sm-offset-1">
							<input type="radio" value="男" v-model='sex'> 男
						</label>
						<label class="radio-inline">
							<input type="radio" value="女" v-model='sex'> 女
						</label>
					</div>
				</div>
				<div class="form-group">
					<label for="password" class="col-sm-2 col-sm-offset-1 control-label">密码</label>
					<div class="col-sm-6">
						<input type="password" class="form-control" id="password" placeholder="请填写密码" v-model='password2' required>
					</div>
				</div>
				<div class="form-group">
					<label for="password3" class="col-sm-2 col-sm-offset-1 control-label">确认密码</label>
					<div class="col-sm-6">
						<input type="password" class="form-control" id="password3" placeholder="请确认密码" v-model='password3'>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-5 col-sm-10">
						<button type="submit" class="btn btn-default" @click.prevent='Register'>注册</button>
					</div>
				</div>	
			</form>
		</div>
	</div>
</div>		
<script type="text/javascript">
	new Vue({
	  el: '#app',
	  data: {
	    flag: true,
	    flag2:false,
	    username:'',
	    password:'',
	    username2:'',
	    password2:'',
	    password3:'',
	    sex:'男'
	  },
	  methods:{
	  	dl:function(){
	  		this.flag=true,
	  		this.flag2=false
	  	},
	  	zc:function(){
	  		this.flag=false,
	  		this.flag2=true
	  	},
	  	Login:function(){
                //发送 post 请求
                this.$http.post('<?php echo site_url()?>/LoginController/loginList',{username:this.username,password:this.password},{emulateJSON:true}).then(function(res){
                    // document.write(res.body);
                    // alert(res.body);   
                    if (res.body==1) {
                    	window.location.href='<?php echo site_url()?>/MainController';
                    }else{
                    	alert('登陆失败');
                    } 
                });
	  	},
	  	Register:function(){
	  		if (this.username2=='' || this.password2=='' || this.password3=='') {
	  			alert("字段不能为空！！！");
	  		}else if(this.password2!=this.password3){
	  			alert("两次密码不一致！！！");
	  		}else{
	  			this.$http.post('<?php echo site_url()?>/LoginController/Register',{username:this.username2,sex:this.sex,password:this.password2},{emulateJSON:true}).then(function(res){
                    // document.write(res.body);
                    alert(res.body);    
                },function(res){
                    console.log(res.status);
                });
	  		}  		
	  	}
	  }
	})
</script>
</body>
</html>