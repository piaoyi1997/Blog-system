
		<style type="text/css">
			.container{
				margin-top: 30px;
				}
			.wenzhang{
				border-bottom: 1px #bda1a1 solid;
				margin-bottom: 30px;
			}
			.lead{
				white-space: nowrap;
				overflow: hidden;
				text-overflow: ellipsis;
				font-size: 16px;
				font-weight: 10px;
			}
		</style>
		<div class="container" id="app2">
		   <div class="row">
		      	<div class="col-md-7 col-md-offset-1">
		      		<div id="myCarousel" class="carousel slide">
					    <!-- 轮播（Carousel）指标 -->
					    <ol class="carousel-indicators">
					        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
					        <li data-target="#myCarousel" data-slide-to="1"></li>
					        <li data-target="#myCarousel" data-slide-to="2"></li>
					    </ol>   
					    <!-- 轮播（Carousel）项目 -->
					    <div class="carousel-inner">
					        <div class="item active">
					            <img src="<?php echo base_url('static');?>/img/1.png" alt="First slide">
					        </div>
					        <div class="item">
					            <img src="<?php echo base_url('static');?>/img/2.png" alt="Second slide">
					        </div>
					        <div class="item">
					            <img src="<?php echo base_url('static');?>/img/3.png" alt="Third slide">
					        </div>
					    </div>
					    <!-- 轮播（Carousel）导航 -->
					    <a class="carousel-control left" href="#myCarousel" 
					       data-slide="prev"> <span _ngcontent-c3="" aria-hidden="true" class="glyphicon glyphicon-chevron-right"></span></a>
					    <a class="carousel-control right" href="#myCarousel" 
					       data-slide="next">&rsaquo;</a>
					</div>


					<div v-for='item in List' class="wenzhang">
						<h3><a style="color: #8a5151;" :href="'<?php echo site_url()?>/MainController/huifu/?id='+item.wenzhangId">{{item.title}}</a></h3>
						<p>作者：<span style="font-size: 18px;">{{item.username}}</span><span style="margin-left: 300px;">{{item.time}}</span></p>
						<div class="lead" style="font-size: 16px;margin-bottom: 5px;">{{item.content}}</div>
						<div style="margin-left: 100px;"><a style="color: #d2506d" :href="'<?php echo site_url()?>/MainController/huifu/?id='+item.wenzhangId">评论数: <span class="glyphicon glyphicon-comment"></span>{{item.ly_num}}</a><a style="color: #d2506d;margin-left: 10px;" :href="'<?php echo site_url()?>/MainController/huifu/?id='+item.wenzhangId">点赞数: <span class="glyphicon glyphicon-heart"></span>{{item.dz_num}}</a>
							<a style="color: #d2506d;margin-left: 10px;" :href="'<?php echo site_url()?>/MainController/huifu/?id='+item.wenzhangId">浏览次数: <span class="glyphicon glyphicon-eye-open"></span>{{item.ll_num}}</a>
							<a style="color: #d2506d;margin-left: 10px;" :href="'<?php echo site_url()?>/MainController/huifu/?id='+item.wenzhangId"><span style="font-weight: 10px;color: black;font-size: 18px;">热度: </span><span class="glyphicon glyphicon-fire"></span>{{item.redu}}</a>
						</div>
					</div>

		    	</div>
			    <div class="col-md-3">
			    	<button type="button" class="btn btn-default btn-lg btn-block">简书会员</button>
			    	<button type="button" class="btn btn-default btn-lg btn-block">优先连载</button>
			    	<button type="button" class="btn btn-default btn-lg btn-block">简书版权</button>
			    	<button type="button" class="btn btn-default btn-lg btn-block">简书大学堂</button>
			    </div>
		    </div>
		</div>
	</div>

<script type="text/javascript">
	new Vue({
	    el: '#app2',
	  	data:{
	  		List:'',
	  		wenzhangId:''
	  	},
	  	created(){
	  		this.all_view();
	  	},
	  	methods:{
	  		all_view:function(){
	  			this.$http.get('<?php echo site_url()?>/MainController/all_view').then(function(res){
                	this.List=res.body;  
	            },function(){
	                console.log('请求失败处理');
	            });
	  		}
	  	}
	});
</script>
</body>
</html>