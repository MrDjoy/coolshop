<?php 
require_once 'include.php';
$cates=getAllcate();
if(!($cates && is_array($cates))){
	alertMes("不好意思，网站维护中!!!", "http://www.imooc.com");
}

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>首页</title>
<link type="text/css" rel="stylesheet" href="styles/reset.css">
<link type="text/css" rel="stylesheet" href="styles/main.css">
<!--[if IE 6]>
<script type="text/javascript" src="js/DD_belatedPNG_0.0.8a-min.js"></script>
<script type="text/javascript" src="js/ie6Fixpng.js"></script>
<![endif]-->
</head>
<body>
<div class="headerBar">
	<div class="topBar">
		<div class="comWidth">
			<div class="leftArea">
				<a href="#" class="collection">收藏衣范网</a>
			</div>
			<div class="rightArea">
				您好！
				<!-- 登录后显示 -->
				<?php if($_SESSION['loginFlag']):?>
				<span>欢迎您</span><?php echo $_SESSION['username'];?>
				<a href="doAction.php?act=userOut">[退出]</a>
				<!-- 未登录显示 -->
				<?php else:?>
				<a href="login.php">[登录]</a><a href="reg.php">[免费注册]</a>
				<?php endif;?>
			</div>
		</div>
	</div>
	<div class="logoBar">
		<div class="comWidth">
			<div class="logo fl">
				<a href="#"><img src="images/logo.jpg" alt="衣范网"></a>
			</div>
			<div class="search_box fl">
				<input type="text" class="search_text fl">
				<input type="button" value="搜 索" class="search_btn fr">
			</div>
			<div class="shopCar fr">
				<span class="shopText fl">购物车</span>
				<span class="shopNum fl">0</span>
			</div>
		</div>
	</div>
	<div class="navBox">
		<div class="comWidth clearfix">
			<div class="shopClass fl">
				<h3>全部商品分类<i class="shopClass_icon"></i></h3>
				<div class="shopClass_show">
					<dl class="shopClass_item">
						<dt><a href="#" class="b">男装</a> <a href="#" class="b">西服</a> <a href="#" class="b">韩版</a> <a href="#" class="aLink">休闲</a></dt>
						<dd><a href="#">学院</a> <a href="#">痞雅</a> <a href="#">配饰</a></dd>
					</dl>
					<dl class="shopClass_item">
						<dt><a href="#" class="b">男装</a> <a href="#" class="b">西服</a> <a href="#" class="b">韩版</a><a href="#" class="aLink">休闲</a></dt>
						<dd><a href="#">学院</a> <a href="#">痞雅</a> <a href="#">配饰</a></dd>
					</dl>
					<dl class="shopClass_item">
						<dt><a href="#" class="b">男装</a> <a href="#" class="b">西服</a> <a href="#" class="b">韩版</a><a href="#" class="aLink">休闲</a></dt>
						<dd><a href="#">学院</a> <a href="#">痞雅</a> <a href="#">配饰</a></dd>
					</dl>
					<dl class="shopClass_item">
						<dt><a href="#" class="b">男装</a> <a href="#" class="b">西服</a> <a href="#" class="b">韩版</a><a href="#" class="aLink">休闲</a></dt>
						<dd><a href="#">学院</a> <a href="#">痞雅</a> <a href="#">配饰</a></dd>
					</dl>
					<dl class="shopClass_item">
						<dt><a href="#" class="b">男装</a> <a href="#" class="b">西服</a> <a href="#" class="b">韩版</a><a href="#" class="aLink">休闲</a></dt>
						<dd><a href="#">学院</a> <a href="#">痞雅</a> <a href="#">配饰</a></dd>
					</dl>
				</div>
				<div class="shopClass_list hide">
					<div class="shopClass_cont">
						<dl class="shopList_item">
							<dt>电脑装机</dt>
							<dd>
								<a href="#">文字啊</a><a href="#">文字字啊</a><a href="#">文字字字啊</a><a href="#">文字啊</a><a href="#">文字</a><a href="#">文字啊</a>
							</dd>
						</dl>
						<dl class="shopList_item">
							<dt>电脑装机</dt>
							<dd>
								<a href="#">文字啊</a><a href="#">文字字啊</a><a href="#">文字字字啊</a><a href="#">文字啊</a><a href="#">文字</a><a href="#">文字啊</a><a href="#">文字啊</a><a href="#">文字字啊</a><a href="#">文字字字啊</a><a href="#">文字啊</a><a href="#">文字</a><a href="#">文字啊</a><a href="#">文字啊</a>
							</dd>
						</dl>
						<dl class="shopList_item">
							<dt>电脑装机</dt>
							<dd>
								<a href="#">文字啊</a><a href="#">文字字啊</a><a href="#">文字字字啊</a><a href="#">文字啊</a><a href="#">文字</a><a href="#">文字啊</a><a href="#">文字啊</a><a href="#">文字字啊</a><a href="#">文字字字啊</a><a href="#">文字啊</a><a href="#">文字</a><a href="#">文字啊</a><a href="#">文字啊</a>
							</dd>
						</dl>
						<dl class="shopList_item">
							<dt>电脑装机</dt>
							<dd>
								<a href="#">文字啊</a><a href="#">文字字啊</a><a href="#">文字字字啊</a><a href="#">文字啊</a><a href="#">文字</a><a href="#">文字啊</a><a href="#">文字啊</a><a href="#">文字字啊</a><a href="#">文字字字啊</a><a href="#">文字啊</a><a href="#">文字</a><a href="#">文字啊</a><a href="#">文字啊</a>
							</dd>
						</dl>
						<dl class="shopList_item">
							<dt>电脑装机</dt>
							<dd>
								<a href="#">文字啊</a><a href="#">文字字啊</a><a href="#">文字字字啊</a><a href="#">文字啊</a><a href="#">文字</a><a href="#">文字啊</a><a href="#">文字啊</a><a href="#">文字字啊</a><a href="#">文字字字啊</a><a href="#">文字啊</a><a href="#">文字</a><a href="#">文字啊</a><a href="#">文字啊</a>
							</dd>
						</dl>
						<div class="shopList_links">
							<a href="#">文字测试内容等等<span></span></a><a href="#">文字容等等<span></span></a>
						</div>
					</div>
				</div>
			</div>
			<ul class="nav fl">
				<li><a href="#" class="active">数码城</a></li>
				<li><a href="#">天黑黑</a></li>
				<li><a href="#">团购</a></li>
				<li><a href="#">发现</a></li>
				<li><a href="#">二手特卖</a></li>
				<li><a href="#">名品会</a></li>
			</ul>
		</div>
	</div>
</div>
<div class="banner comWidth clearfix">
	<div class="banner_bar banner_big">
		<ul class="imgBox">
			<li><a href="#"><img src="images/banner/banner_01.jpg" alt="banner"></a></li>
			<li><a href="#"><img src="images/banner/banner_02.jpg" alt="banner"></a></li>
		</ul>
		<div class="imgNum">
			<a href="#" class="active"></a><a href="#"></a><a href="#"></a><a href="#"></a>
		</div>
	</div>
</div>
<!-- 读后台分类信息 -->
<?php foreach($cates as $cate):?>
<div class="shopTit comWidth">
	<span class="icon"></span><h3><?php echo $cate['cName'];?></h3>
	<a href="#" class="more">更多&gt;&gt;</a>
</div>
<div class="shopList comWidth clearfix">
	<div class="leftArea">
		<div class="banner_bar banner_sm">
			<ul class="imgBox">
				<li><a href="#"><img src="images/banner/banner_sm_01.jpg" alt="banner"></a></li>
				<li><a href="#"><img src="images/banner/banner_sm_02.jpg" alt="banner"></a></li>
			</ul>
			<div class="imgNum">
				<a href="#" class="active"></a><a href="#"></a><a href="#"></a><a href="#"></a>
			</div>
		</div>
	</div>
	<div class="rightArea">
		<div class="shopList_top clearfix">
		<?php 
			$pros=getProsByCid($cate['id']);//通过商品分类ID得到4个商品
			if($pros &&is_array($pros))://HTML和PHP混合页面中流程控制的替代语法
			//左花括号（{）换成冒号（:），把右花括号（}）分别换成 endif;，endwhile;，endfor;，endforeach; 以及 endswitch; 
			foreach($pros as $pro):
			$proImg=getProImgById($pro['id']);//通过商品ID获取商品图片
		?>
			<div class="shop_item">
				<div class="shop_img">
					<a href="proDetails.php?id=<?php echo $pro['id'];?>" target="_blank"><img height="200" width="187" src="image_220/<?php echo $proImg['albumPath'];?>" alt=""></a><!-- 通过图片链接跳转到商品详情页面-->
				</div>
				<h6><?php echo $pro['pName'];?></h6>
				<p><?php echo $pro['iPrice'];?>元</p>
			</div>
			<?php 
			endforeach;
			endif;
			?>
			
		</div>
		<div class="shopList_sm clearfix">
		<?php 
			$prosSmall=getSmallProsByCid($cate['id']);//通过商品分类id获取接下来4个商品
			if($prosSmall &&is_array($prosSmall)):
			foreach($prosSmall as $proSmall):
			$proSmallImg=getProImgById($proSmall['id']);
		?>
			<div class="shopItem_sm">
				<div class="shopItem_smImg">
					<a href="proDetails.php?id=<?php echo $proSmall['id'];?>" target="_blank"><img width="95" height="95" src="image_220/<?php echo $proSmallImg['albumPath'];?>" alt=""></a><!-- 通过图片链接跳转商品详情页面 -->
				</div>
				<div class="shopItem_text">
					<p><?php echo $proSmall['pName'];?></p>
					<h3>￥<?php echo $proSmall['iPrice'];?>	</h3>
				</div>
			</div>
			<?php 
			endforeach;
			endif;
			?>
		</div>
	</div>
</div>
<?php endforeach;?>
<div class="hr_25"></div>
<div class="footer">
	<p><a href="#">衣范简介</a><i>|</i><a href="#">衣范公告</a><i>|</i> <a href="#">招纳贤士</a><i>|</i><a href="#">联系我们</a><i>|</i>客服热线：400-675-1234</p>
	<p>Copyright &copy; 2006 - 2014 衣范版权所有&nbsp;&nbsp;&nbsp;京ICP备09037834号&nbsp;&nbsp;&nbsp;京ICP证B1034-8373号&nbsp;&nbsp;&nbsp;某市公安局XX分局备案编号：123456789123</p>
	<p class="web"><a href="#"><img src="images/webLogo.jpg" alt="logo"></a><a href="#"><img src="images/webLogo.jpg" alt="logo"></a><a href="#"><img src="images/webLogo.jpg" alt="logo"></a><a href="#"><img src="images/webLogo.jpg" alt="logo"></a></p>
</div>
</body>
</html>
