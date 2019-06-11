
		<style type="text/css">
			.container{
				margin-top: 30px;
			}
			.zz_xx{
				display: inline-block;
				width: 60px;
				border-right: 1px #c7a2a2 solid;
				text-decoration: none;
				color: black;
				font-size: 16px;
				margin-left: 10px;
			}
		</style>
		<div class="container" id="app2">
			<div class="col-md-7 col-md-offset-1">
			   <div class="row">
			   		<!-- <div class="row"> -->
			   			<img src="<?php echo base_url('static')?>/img/<?php echo $img;?>.jpg" class="img-circle col-md-3" id='img2'>
			   		<!-- </div> -->
			   		<div class="col-md-9">
			   			<h2><?php echo $_GET['username'];?>的主页</h2>
			   			<!-- 按钮触发模态框 -->
				   		<a href="#" class="zz_xx">文章数{{wz_num}}>></a>
				   		<a href="#" class="zz_xx">粉丝数{{fs_num}}>></a>
				   		<a href="#" style="border-right: none;" class="zz_xx">评论数{{pl_num}}>></a>

			   		</div>
			   		
			   		<button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal2" style="margin-left: 60px;">发私信</button>
			   		
			   		<h3 style="margin-left: 20px;color:rgb(117, 115, 191);border-bottom: 1px #000 solid;">文章</h3>
			   </div>

			   <!-- 模态框（Modal） -->
				<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				    <div class="modal-dialog">
				        <div class="modal-content">
				            <div class="modal-header">
				                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                <h4 class="modal-title" id="myModalLabel">发送私信</h4>
				            </div>
				            <div class="modal-body">
				            	<form role="form">
									<div class="form-group">
										<label for="name">发件人</label>
										<input type="text" class="form-control" v-model='fs_username' disabled>
									</div>
									<div class="form-group">
										<label for="name">收件人</label>
										<input type="text" class="form-control" v-model='sj_username' disabled>
									</div>
									<div class="form-group">
										<label for="name">发送内容</label>
										<textarea class="form-control" placeholder="请输入发送内容" v-model='fs_content'></textarea>
									</div>
								</form>


				            </div>
				            <div class="modal-footer">
				                <button type="button" class="btn btn-default" data-dismiss="modal" id="quxiao">取消</button>
				                <a type="button" class="btn btn-primary" @click='sixin'>发送</a>
				            </div>
				        </div><!-- /.modal-content -->
				    </div><!-- /.modal -->
				</div>



			   <div>
			   		<div class="list-group" v-for='item in List'>
						<a href="#" class="list-group-item active" style="background: #668daf;">
							<h4 class="list-group-item-heading">
								<strong>文章标题：</strong>{{item.title}}
							</h4>
						</a>
						<a href="#" class="list-group-item">
							<h4 class="list-group-item-heading">
								<strong>发帖人：</strong>{{item.username}}---{{item.wenjiId}}<span style="margin-left: 150px;"><strong>发布时间:</strong></span>{{item.time}}
							</h4>
							<p class="list-group-item-text">
								
							</p>
						</a>
						<a href="#" class="list-group-item">
							<h4 class="list-group-item-heading">
								<strong>文章内容：</strong>{{item.content}}
							</h4>
							<p class="list-group-item-text">
							</p>
						</a>
					</div>
			   </div>
			</div>   
		</div>
	</div>

<script type="text/javascript">
	new Vue({
	    el: '#app2',
	  	data:{
	  		List:'',
	  		fs_content:'',
	  		fs_username:'<?php echo $username=$this->session->userdata('username');?>',
	  		sj_username:'<?php echo $_GET['username'];?>',
	  		wz_num:0,
	  		pl_num:0,
	  		fs_num:0
	  	},
	  	created(){
	  		this.zuozhe_View();
	  		this.zuozhe_wz_num();
	  		this.zuozhe_pl_num();
	  		this.zz_fens_num();
	  	},
	  	methods:{
	  		zuozhe_View:function(){
	  			var username='<?php echo $_GET['username'];?>';
	  			this.$http.post('<?php echo site_url()?>/MainController/zuozhe_View',{username:username},{emulateJSON:true}).then(function(res){
	                    // document.write(res.body);
					this.List=res.body;   
	                },function(res){
	                    console.log(res.status);
	                });
	  		},
	  		sixin:function(){
		  		if (this.fs_content=='') {
		  			alert('发送内容不能为空！！！');
		  		}else{
		  			this.$http.post('<?php echo site_url()?>/MainController/sixinList',{fs_content:this.fs_content,fs_username:this.fs_username,sj_username:this.sj_username},{emulateJSON:true}).then(function(res){
		                    // document.write(res.body);
							alert(res.body);  
							document.getElementById("quxiao").click(); 
		                },function(res){
		                    console.log(res.status);
		                });
		  		}
		  	},
		  	zuozhe_wz_num:function(){
	  			var username='<?php echo $_GET['username'];?>';
	  			this.$http.post('<?php echo site_url()?>/MainController/zuozhe_wz_num',{username:username},{emulateJSON:true}).then(function(res){
	                    // document.write(res.body);
					this.wz_num=res.body;   
	                },function(res){
	                    console.log(res.status);
	                });
	  		},
	  		zuozhe_pl_num:function(){
	  			var username='<?php echo $_GET['username'];?>';
	  			this.$http.post('<?php echo site_url()?>/MainController/zuozhe_pl_num',{username:username},{emulateJSON:true}).then(function(res){
	                    // document.write(res.body);
					this.pl_num=res.body;   
	                },function(res){
	                    console.log(res.status);
	                });
	  		},
	  		zz_fens_num:function(){
	  			var username='<?php echo $_GET['username'];?>';
	  			this.$http.post('<?php echo site_url()?>/MainController/zz_fens_num',{username:username},{emulateJSON:true}).then(function(res){
	                    // document.write(res.body);
					this.fs_num=res.body;   
	                },function(res){
	                    console.log(res.status);
	                });
	  		}
	  	}
	});
</script>
</body>
</html>