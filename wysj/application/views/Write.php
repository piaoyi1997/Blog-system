
<!DOCTYPE html>
<html>
<head>
	<title>发文章</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	 <!-- <script type="text/javascript" src=" https://cdn.staticfile.org/vue/2.2.2/vue.min.js"></script> -->
	 <script type="text/javascript" src="<?php echo base_url('static');?>/js/vue.js"></script>
      <!-- 引入 Bootstrap -->
      <script src="<?php echo base_url('static');?>/js/jquery.min.js"></script>
      <script src="<?php echo base_url('static');?>/js/vue-resource.js"></script>
      <link href="<?php echo base_url('static');?>/css/bootstrap.min.css" rel="stylesheet">
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
</head>
<style type="text/css">
	body,html{
		height: 100%;
		width: 100%;
	}
	.d{
		display: flex;
	}
	.dd{
		width: 20%;
		height: 655px;
		border: 1px #000 solid;
		border-left: none;
	}
	.dd2{
		width: 80%;
		height: 655px;
		border: 1px #000 solid;
		border-left: none;
	}
/*	.dd3{
		width: 50%;
		height: 655px;
		border: 1px #000 solid;
	}*/
	#btn{
		width: 70%;
		margin-left: 15%;
		margin-top: 20px;
		border-radius: 50px;
	}
	#panel{
		margin-top: 20px;
		text-align: center;
	}
	button,#ipt{
		margin-top: 10px;
		margin-left: 20px;
	}
	.list-group-item{
		display: inline-block;
		width: 100%;
		height: 100%;
	}
	.list-group-item:hover{
		background:skyblue;
	}
	.active{
		display: block;
		background: skyblue;
		width: 100%;
	}
	.alert{
		margin-top: 40px;
		color: black;
	}
	/*#form{
		width: 500px;
	}*/
</style>
<body>
	<div class="d" id="app">
		<div class="dd">
			<a type="button" class="btn btn-default btn-lg" id="btn" href="<?php echo site_url()?>/MainController">回首页</a>
		    <div class="panel panel-default" id="panel">
		        <div class="panel-heading">
		            <h4 class="panel-title">
		                <a data-toggle="collapse" data-parent="#accordion" 
		                href="#collapseOne">新建文集</a>
		            </h4>
		        </div>
		        <div id="collapseOne" class="panel-collapse collapse in">
		            <div class="panel-body">
		                <input type="text" class="form-control" id="name" placeholder="请输入文集名" v-model='wenjiname'/>
		                <div class="alert alert-warning" v-show='flag'>
							<a href="#" class="close" data-dismiss="alert">
								&times;
							</a>							
							<strong>文集名不能为空。</strong>
						</div>
		                <!-- <button type="submit" class="btn btn-default" @click.prevent='tj'>提交</button>{{wenjiname}} -->
		                <button type="submit" class="btn btn-default" @click='wenjitj'>保存</button>
						<!-- <input type="button" name="" class="btn btn-default" value="取消" id="ipt" @click.prevent='tj'/> -->
		            </div>
		        </div>
		        <div>
		        	<ul class="list-group">
					    <li class="list-group-item" v-for='item in List'>
					    	<a href="#" @click='wenzhang_view(item.wenjiId,true)'>{{item.wenjiname}}</a>
					    </li>
					</ul>
		        </div>
			</div>
		</div>
		<div class="dd2">
			<div class="alert alert-warning" v-if='flag3'>
			    <a href="#" class="close" data-dismiss="alert">
			        &times;
			    </a>
			    <strong>温馨提示</strong>您还没有创建任何一个文集和文章,请在左侧创建。
			</div>
			<div class="panel panel-default" v-if='flag2'>
			    <div class="panel-heading">
			        <h3 class="panel-title">
			            新建文章
			        </h3>
			    </div>
			    <div class="panel-body">
			        <div id="form">
			        	<form role='form' class="form-inline">
			        		<div class="form-group">
							    <label for="name">类别：</label>
							    <input type="text" class="form-control" disabled v-model='wzindex'>
							</div>
			        		<div class="form-group">
							    <label for="name">名称：</label>
							    <input type="text" class="form-control" id="name" placeholder="请文章名称" v-model='title'>
							</div>
							<div class="form-group">
							    <label for="name">内容：</label>
							    <textarea class="form-control" placeholder="请输入文章内容" v-model='content'></textarea>
							</div>
							<button type="submit" class="btn btn-default" @click.prevent='wenzhangtj'>提交</button>
			        	</form>
			        </div>
			    </div>
			</div>
			<!-- {{wzList}} -->
			<div class="list-group" v-for='item2 in wzList'>
				<a href="#" class="list-group-item active" style="background: #668daf;">
					<h4 class="list-group-item-heading">
						<strong>文章标题：</strong>{{item2.title}}
						<span class="glyphicon glyphicon-trash" style="color: #000;margin-left: 80px;" @click='del(item2.wenzhangId)'></span>
					</h4>
				</a>
				<a href="#" class="list-group-item">
					<h4 class="list-group-item-heading">
						<strong>发帖人：</strong>{{item2.username}}---{{item2.wenjiId}}<span style="margin-left: 150px;"><strong>发布时间:</strong></span>{{item2.time}}
					</h4>
					<p class="list-group-item-text">
						
					</p>
				</a>
				<a href="#" class="list-group-item">
					<h4 class="list-group-item-heading">
						<strong>文章内容：</strong>{{item2.content}}
					</h4>
					<p class="list-group-item-text">
					</p>
				</a>
			</div>
		</div>
<!-- 		<div class="dd3">
			回首页
		</div> -->
	</div>
</body>	
<script type="text/javascript">
	new Vue({
	    el: '#app',
	  	data:{
	  		wenjiname:'',
	  		List:'',
	  		wzList:'',
	  		flag:false,
	  		flag2:false,
	  		flag3:false,
	  		title:'',
	  		content:'',
	  		wzindex:''
	  	},
	  	created(){
	  		this.isLogin();
	  		this.isFabiao();
		  	this.wenji_view();
		  	this.wenzhang_view();
		  },
	  	methods:{
	  		isLogin:function(){
	  			this.$http.get('<?php echo site_url()?>/WriteController/isLogin').then(function(res){
                	if (res.body!=1) {
                		alert('您还没有登录,请登录');
                		window.location.href='<?php echo site_url()?>/LoginController';
                	}
	            },function(){
	                console.log('请求失败处理');
	            });
	  		},
	  		isFabiao:function(){
	  			this.$http.get('<?php echo site_url()?>/WriteController/isFabiao').then(function(res){
                	if (res.body==0) {
                		this.flag3=true;
                	}else{
                		this.flag3=false;
                	}
	            },function(){
	                console.log('请求失败处理');
	            });
	  		},


	  		wenjitj:function(){
	  			if (this.wenjiname!='') {
		  			this.$http.post('<?php echo site_url()?>/WriteController/wenjilist',{wenjiname:this.wenjiname},{emulateJSON:true}).then(function(res){
	                    // document.write(res.body);
	                    this.wenji_view();
	                    alert(res.body);
	                    this.wenjiname='';
	                    this.flag3=false;	         
	                },function(res){
	                    console.log(res.status);
	                });
	  			}else{
	  				this.flag=true;
	  			}
	  		},
	  		wenji_view:function(){
	  			this.$http.get('<?php echo site_url()?>/WriteController/wenji_view').then(function(res){
                	this.List=res.body;  
	            },function(){
	                console.log('请求失败处理');
	            });
	  		},
	  		wenzhangtj:function(){
	  			this.$http.post('<?php echo site_url()?>/WriteController/wenzhanglist',{title:this.title,content:this.content,wzindex:this.wzindex},{emulateJSON:true}).then(function(res){
	                    alert(res.body);
	                    this.wenzhang_view(this.wzindex,true);//此处有点小问题'',true！！！！！！！！
	                    this.title='';
	                    this.content=''	         
	                },function(res){
	                    console.log(res.status);
	                });
	  		},
	  		wenzhang_view:function(index='',Boolean2=''){
	  			this.flag2=Boolean2;
	  			this.wzindex=index;
	  			this.$http.post('<?php echo site_url()?>/WriteController/wenzhang_view',{wenjiId:index},{emulateJSON:true}).then(function(res){
	                    this.wzList=res.body;      
	                },function(res){
	                    console.log(res.status);
	                });
	  		},
	  		del:function(wenzhangId){
	  			// alert(wenjiId);
	  			  var r=confirm("你确定要删除吗？")
				  if (r==true)
				    {
				    	this.$http.post('<?php echo site_url()?>/WriteController/delwenzhang',{wenzhangId:wenzhangId},{emulateJSON:true}).then(function(res){
	                    // alert(res.body);
	                    this.wenzhang_view(this.wzindex,true);     
	                	},function(res){
	                   	 	console.log(res.status);
	                	});	
				    }
	  			
	  		}
	  	}
	});
</script>
</html>