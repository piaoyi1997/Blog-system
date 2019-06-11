
		<style type="text/css">
			.container{
				margin-top: 20px;
			}
			.gr_xx{
				display: inline-block;
				width: 70px;
				border-right: 1px #c7a2a2 solid;
				text-decoration: none;
				color: black;
				font-size: 16px;
				margin-left: 10px;
			}
			.sixin{
				border-top: 1px #c7a2a2 solid;
			}
			#img2{
				float: left;
			}
			#content{
				float: left;
			}
		</style>
		<div class="container" id="app2">
			<div class="col-md-7 col-md-offset-1">
			   <div class="row">
			   		<img src="<?php echo base_url('static')?>/img/<?php echo $img;?>.jpg" class="img-circle" id='img2'>
			   		<div id="content">
				   		<h1><?php echo $username=$this->session->userdata('username');?></h1>
				   		<a href="#" class="gr_xx" @click="flag3=true;flag4=false;flag5=false;">文章数{{wz_num}}>></a>
				   		<a href="#" class="gr_xx" @click="flag3=false;flag4=true;flag5=false;">收件箱{{sj_num}}>></a>
				   		<a href="#" class="gr_xx" @click="flag3=false;flag4=false;flag5=true;">粉丝数{{fensi_num}}>></a>
				   		<a href="#" class="gr_xx" style="border-right: none;">评论数{{pl_num}}>></a>
			   		</div>
			   </div>
			   <div v-if='flag3'>	
			   		<h3 style="color:rgb(117, 115, 191);border-bottom: 1px #000 solid;">文章</h3>
				   <div v-if='flag2'>
				   		<div class="list-group" v-for='item in List'>
							<div href="#" class="list-group-item active">
								<h4 class="list-group-item-heading">
									<strong>文章标题：</strong>{{item.title}}
									<span class="glyphicon glyphicon-trash" style="color: #000;margin-left: 80px;" @click='del(item.wenzhangId)'></span>
								</h4>
							</div>
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
			   	<!-- <div v-if='!flag3'>
						<h3>您还没有发表过文章，可以在后上角去发布哦！！！</h3>
				</div>	 -->			
			</div>
			<div class="col-md-7 col-md-offset-1" v-if='flag4'>
				<h3>全部私信</h3>
				<div class="sixin" v-for='item2 in List2'>
					<h4>{{item2.fs_username}}<span style="margin-left: 90px;">发送时间：{{item2.fs_time}}</span></h4>
					<span class="text-info">{{item2.fs_content}}</span>
				</div>
			</div>
			<div class="col-md-7 col-md-offset-1" v-if='flag5'>
				<h3>全部粉丝</h3>
				<div class="sixin" v-for='item3 in List3'>
					<h4>{{item3.gz_username}}<span style="margin-left: 90px;">关注时间：{{item3.gz_time}}</span></h4>
					<span class="text-info"></span>
				</div>
			</div>    
		</div>
	</div>

<script type="text/javascript">
	new Vue({
	    el: '#app2',
	  	data:{
	  		List:'',
	  		flag2:'',
	  		wz_num:0,
	  		sj_num:0,
	  		pl_num:0,
	  		List2:'',
	  		flag3:true,
	  		flag4:false,
	  		flag5:false,
	  		fensi_num:0,
	  		bz_num:'',
	  		List3:''
	  	},
	  	created(){
	  		this.gr_view();
	  		this.wz_num_view();
	  		this.sj_num_view();
	  		this.pl_num_view();
	  		this.get_pl_view();
	  		this.fens_num();
	  		this.gr_fs_view();
	  	},
	  	methods:{
	  		gr_view:function(){
	  			this.$http.get('<?php echo site_url()?>/MainController/gr_view').then(function(res){
	  				this.List=res.body;
	  				if (this.List=='') {
	  					this.flag2=false;
	  				}else{
	  					this.flag2=true;
	  				}
	            },function(){
	                console.log('请求失败处理');
	            });
	  		},
	  		gr_fs_view:function(){
	  			this.$http.get('<?php echo site_url()?>/MainController/gr_fs_view').then(function(res){
	  				this.List3=res.body;
	  				
	            },function(){
	                console.log('请求失败处理');
	            });
	  		},
	  		//文章数
	  		wz_num_view:function(){
	  			this.$http.get('<?php echo site_url()?>/MainController/wz_num').then(function(res){
	  				// this.List=res.body;
	  				this.wz_num=res.body;
	            },function(){
	                console.log('请求失败处理');
	            });
	  		},
	  		//收件数
	  		sj_num_view:function(){
	  			this.$http.get('<?php echo site_url()?>/MainController/sj_num').then(function(res){
	  				this.sj_num=res.body;
	            },function(){
	                console.log('请求失败处理');
	            });
	  		},
	  		//评论数
	  		pl_num_view:function(){
	  			this.$http.get('<?php echo site_url()?>/MainController/pl_num').then(function(res){
	  				this.pl_num=res.body;
	            },function(){
	                console.log('请求失败处理');
	            });
	  		},
	  		del:function(wenzhangId){
	  			// alert(wenjiId);
	  			var r=confirm("你确定要删除吗？")
				  if (r==true)
				    {
				    	this.$http.post('<?php echo site_url()?>/WriteController/delwenzhang',{wenzhangId:wenzhangId},{emulateJSON:true}).then(function(res){
	                    // alert(res.body);
	                    this.gr_view();
	                    this.wz_num_view();    
	                	},function(res){
	                   	 	console.log(res.status);
	                	});	
				    }
	  		},
	  		get_pl_view:function(){
	  			this.$http.get('<?php echo site_url()?>/MainController/get_pl_view').then(function(res){
	  					this.List2=res.body;	                 
	                    // this.wenzhang_view(this.wzindex,true);     
	                	},function(res){
	                   	 	console.log(res.status);
	                	});
	  		},
	  		fens_num:function(){
	  			this.$http.get('<?php echo site_url()?>/MainController/fens_num').then(function(res){
	  				this.fensi_num=res.body;
	            },function(){
	                console.log('请求失败处理');
	            });
	  		},
	  		get_dz_num:function(){
	  			this.$http.get('<?php echo site_url()?>/MainController/get_dz_num').then(function(res){
	  				this.bz_num=res.body;	  				
	            },function(){
	                console.log('请求失败处理');
	            });
	  		}	  			  			  		
	  	}
	});
</script>
</body>
</html>