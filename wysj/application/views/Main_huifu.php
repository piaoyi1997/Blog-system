

		<div class="container" id="app2" style="margin-top: 30px;">
			<div class="col-md-6 col-md-offset-2">
				<?php foreach ($data as $datas): ?>
				    <h1><?php echo $datas['title']; ?></h1>
				    <p><h4><strong>「转载文章」首先需要征得作者同意。作者同意授权后，转载文章发布时必须有一个转载的规范样式。</strong></h4></p>
				    <p>
				    	<h4>转载的规范样式引用自简书用户<a href="<?php echo site_url();?>/	MainController/zuozhe/?username=<?php echo $datas['username'];?>"><?php echo $datas['username'];?></a>
				    		<button class="btn btn-default" v-if='flag3' style="background: #e04e4e;" @click="guanzhu">
				    			<span class="glyphicon glyphicon-plus"></span><span>关注</span>
				    		</button>
				    		<button class="btn btn-default" v-if='!flag3' style="background: #e04e4e;" @click='qx_guanzhu'>		
				    			<span class="glyphicon glyphicon-minus"></span><span>取消关注</span>
				    		</button>的文章：
				    	</h4>
					</p>
				    <div style="margin-top: 40px;font-size: 17px;">
				        <?php echo $datas['content'];?>
				    </div>

				     <div style="margin-left: 100px;" v-for='item2 in List2' v-if='flag2'>
				     	<a style="color: #d2506d" href="#">评论数: <span class="glyphicon glyphicon-comment"></span>{{item2.ly_num}}</a>
				     	<a style="color: #d2506d;margin-left: 10px;" href="#" @click='dianzan' v-if='!flag4'><span style="font-weight: 10px;color: black;font-size: 18px;">点赞数:</span><span class="glyphicon glyphicon-thumbs-up"></span>{{item2.dz_num}}</a>
				     	<a style="color: #d2506d;margin-left: 10px;" href="#" v-if='flag4'  @click='qxdianzan'><span style="font-weight: 10px;color: black;font-size: 18px;">点赞数:</span> <span class="glyphicon glyphicon-thumbs-down"></span>{{item2.dz_num}}</a>
						<a style="color: #d2506d;margin-left: 10px;" href="#">浏览次数: <span class="glyphicon glyphicon-eye-open"></span>{{item2.ll_num}}</a>
						<a style="color: #d2506d;margin-left: 10px;" href="#"><span style="font-weight: 10px;color: black;font-size: 18px;">热度: </span><span class="glyphicon glyphicon-fire"></span>{{item2.redu}}</a>
			  		</div>

					<textarea class="form-control" placeholder="请输入回复的内容" style="margin-top: 20px;" v-model='hf_content' v-if='flag2'></textarea>
					 <button type="submit" class="btn btn-default col-md-offset-4" @click="liuyan(<?php echo $datas['wenzhangId'];?>)" v-if='flag2'>发送</button>

				<?php endforeach; ?>
				
			 


			</div>
			<h2 class="col-md-6 col-md-offset-2">评论区</h2>
			<div v-for='item in List' class="col-md-6 col-md-offset-2" style="border-top: 1px rgb(228,182,182) solid;margin-top: 10px;">
				<h4>{{item.username}}<span style="margin-left: 50px;">{{item.hf_time}}</span>
				</h4>
				<p>{{item.hf_content}}</p>
			</div>
		</div>
	</div>

<script type="text/javascript">
	new Vue({
	    el: '#app2',
	  	data:{
	  		hf_content:'',
	  		List:'',
	  		flag2:false,
	  		username:'<?php echo $datas['username'];?>',
	  		flag3:'',
	  		List2:'',
	  		flag4:'',
	  		gz_username:'<?php echo $this->session->has_userdata('username');?>'
	  	},
	  	created(){
	  		this.hf_view();
	  		this.isLogin();
	  		this.ifGuanzhu();
	  		this.redu_view();
	  		this.ifDianzan();
	  	},
	  	methods:{
	  		liuyan:function(wenzhangId){
	  			if (this.hf_content=='') {
	  				alert("回复内容不能为空！！！");
	  			}else{
	  				this.$http.post('<?php echo site_url()?>/MainController/liuyan',{hf_content:this.hf_content,wenzhangId:wenzhangId},{emulateJSON:true}).then(function(res){
	                    // document.write(res.body);
	                    this.hf_content='';
	                    this.hf_view();
	                    this.redu_view();
	                    alert(res.body);         
	                },function(res){
	                    console.log(res.status);
	                });
	  			}
	  		},
	  		hf_view:function(){
	  			var wenzhangId=<?php echo $_GET['id'];?>;
	  				this.$http.post('<?php echo site_url()?>/MainController/hf_view',{wenzhangId:wenzhangId},{emulateJSON:true}).then(function(res){
	                    this.List=res.body;
	                },function(res){
	                    console.log(res.status);
	                });
	  		},
	  		isLogin:function(){
	  			this.$http.get('<?php echo site_url()?>/MainController/isLogin').then(function(res){
                	if (res.body==1) {
                		this.flag2=true;
                	}else{
                		this.flag2=false;
                	}  
	            },function(){
	                console.log('请求失败处理');
	            });
	  		},
	  		guanzhu:function(){
	  			// alert(this.username);
	  			if (this.gz_username!=1) {
	  				alert('请先登录！！！');
	  			}else{
	  				this.$http.post('<?php echo site_url()?>/MainController/guanzhu',{bgz_username:this.username},{emulateJSON:true}).then(function(res){
	                    // this.List=res.body;
	                    this.ifGuanzhu();
	                    alert(res.body);
	                },function(res){
	                    console.log(res.status);
	                });
	  			}
	  			
	  		},
	  		qx_guanzhu:function(){
	  			if (this.gz_username!=1) {
	  				alert('请先登录！！！');
	  			}else{
		  			this.$http.post('<?php echo site_url()?>/MainController/qx_guanzhu',{bgz_username:this.username},{emulateJSON:true}).then(function(res){
		                    // this.List=res.body;
		                    this.ifGuanzhu();
		                    alert(res.body);
		                },function(res){
		                    console.log(res.status);
		                });
		  		}
	  		},
	  		ifGuanzhu:function(){
	  			this.$http.post('<?php echo site_url()?>/MainController/ifGuanzhu',{bgz_username:this.username},{emulateJSON:true}).then(function(res){
	                    // this.List=res.body;
	                    if (res.body==1) {
	                    	this.flag3=false;
	                    }else{
	                    	this.flag3=true;
	                    }                    
	                },function(res){
	                    console.log(res.status);
	                });
	  		},
	  		redu_view:function(){
	  			var wenzhangId=<?php echo $_GET['id'];?>;
	  			this.$http.post('<?php echo site_url()?>/MainController/redu_view',{wenzhangId:wenzhangId},{emulateJSON:true}).then(function(res){
                	this.List2=res.body;  
	            },function(){
	                console.log('请求失败处理');
	            });
	  		},
	  		dianzan:function(){
	  			var wenzhangId=<?php echo $_GET['id'];?>;
	  			this.$http.post('<?php echo site_url()?>/MainController/dianzan',{wenzhangId:wenzhangId},{emulateJSON:true}).then(function(res){
                	this.ifDianzan();
                	this.redu_view();
	            },function(){
	                console.log('请求失败处理');
	            });
	  		},
	  		qxdianzan:function(){
	  			var wenzhangId=<?php echo $_GET['id'];?>;
	  			this.$http.post('<?php echo site_url()?>/MainController/qxdianzan',{wenzhangId:wenzhangId},{emulateJSON:true}).then(function(res){
                	this.ifDianzan();
                	this.redu_view();
	            },function(){
	                console.log('请求失败处理');
	            });
	  		},
	  		ifDianzan:function(){
	  			var wenzhangId=<?php echo $_GET['id'];?>;
	  			this.$http.post('<?php echo site_url()?>/MainController/ifDianzan',{wenzhangId:wenzhangId},{emulateJSON:true}).then(function(res){
                	if (res.body==1) {
                		this.flag4=true;
                	}else{
                		this.flag4=false;
                	}  
	            },function(){
	                console.log('请求失败处理');
	            });
	  		}
	  	}
	});
</script>
</body>
</html>