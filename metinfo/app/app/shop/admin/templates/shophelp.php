<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');
$active['6'] = 'active';
$path['web-icons'] = 1;
require $this->template('own/head');
echo <<<EOT
-->
<div class="page-content">
	<div class="panel">
		<div class="panel-body container-fluid">
			<div class="row">
				<div class="col-sm-12">
<div class="nav-tabs-horizontal">
	<ul class="nav nav-tabs nav-tabs-line" data-plugin="nav-tabs" role="tablist">
		<li class="active" role="presentation">
			<a data-toggle="tab" href="#exampleTabsLineOne" aria-controls="exampleTabsLineOne" role="tab" aria-expanded="true">常见问题</a>
		</li>
		<li role="presentation" class="">
			<a data-toggle="tab" href="#exampleTabsLineTwo" aria-controls="exampleTabsLineTwo" role="tab" aria-expanded="false">开发说明</a>
		</li>
	</ul>
	<div class="tab-content padding-top-20">
		<div class="tab-pane active" id="exampleTabsLineOne" role="tabpanel">
			<div class="panel-group panel-group-simple panel-group-continuous" id="accordion1" aria-multiselectable="true" role="tablist">
				<div class="panel">
					<div class="panel-heading" id="question-1" role="tab">
						<a class="panel-title" aria-controls="answer-1" aria-expanded="true" data-toggle="collapse" href="#answer-1" data-parent="#accordion1">
							如何管理商品？
						</a>
					</div>
					<div class="panel-collapse collapse in" id="answer-1" aria-labelledby="question-1" role="tabpanel">
						<div class="panel-body">
							商城模块调用的是已有产品，请先到栏目设置中添加产品模块栏目，然后在内容管理中进行管理。
						</div>
					</div>
				</div>
				<div class="panel">
					<div class="panel-heading" id="question-2" role="tab">
						<a class="panel-title" aria-controls="answer-2" aria-expanded="false" data-toggle="collapse" href="#answer-2" data-parent="#accordion1">
							如何设置商品价格、库存、自定义选项？
						</a>
					</div>
					<div class="panel-collapse collapse" id="answer-2" aria-labelledby="question-2" role="tabpanel">
						<div class="panel-body">
							在内容管理中可以对商品进行设置（安装商城模块应用后原产品编辑会自动增加商品属性的编辑）。
						</div>
					</div>
				</div>
				<div class="panel">
					<div class="panel-heading" id="question-3" role="tab">
						<a class="panel-title" aria-controls="answer-3" aria-expanded="false" data-toggle="collapse" href="#answer-3" data-parent="#accordion1">
							怎样设置成不用国家的货币符号？
						</a>
					</div>
					<div class="panel-collapse collapse" id="answer-3" aria-labelledby="question-3" role="tabpanel">
						<div class="panel-body">
							可以在商品模块的设置里找到货币符号设置，可以设置成任何国家的货币符号。
						</div>
					</div>
				</div>
				<div class="panel">
					<div class="panel-heading" id="question-4" role="tab">
						<a class="panel-title" aria-controls="answer-4" aria-expanded="false" data-toggle="collapse" href="#answer-4" data-parent="#accordion1">
							目前支持哪些支付方式？
						</a>
					</div>
					<div class="panel-collapse collapse" id="answer-4" aria-labelledby="question-4" role="tabpanel">
						<div class="panel-body">
							目前支持支付宝即时到帐、微信支付、微信扫码支付、中国银联支付、账户余额支付，且在不同终端（电脑、手机）上都有非常好的支付体验。
						</div>
					</div>
				</div>
				<div class="panel">
					<div class="panel-heading" id="question-5" role="tab">
						<a class="panel-title" aria-controls="answer-5" aria-expanded="false" data-toggle="collapse" href="#answer-5" data-parent="#accordion1">
							如何申请支付接口？
						</a>
					</div>
					<div class="panel-collapse collapse" id="answer-5" aria-labelledby="question-5" role="tabpanel">
						<div class="panel-body">
							<p>微信支付需要申请“公众号支付”、“扫描支付”接口。<a href="https://pay.weixin.qq.com/wxzf_guide/index.shtml" target="_blank">教程</a></p>
							<p>支付宝需要申请“即时到账”接口。<a href="https://app.alipay.com/market/document.htm?name=qianyueditu" target="_blank">教程</a></p>
							<p>银联需要申请“网关支付”接口。<a href="https://merchant.unionpay.com/join/help/director" target="_blank">教程</a></p>
							<p>目前个人无法申请任何支付接口，必须企业才能够申请。</p>
						</div>
					</div>
				</div>
				<div class="panel">
					<div class="panel-heading" id="question-6" role="tab">
						<a class="panel-title" aria-controls="answer-6" aria-expanded="false" data-toggle="collapse" href="#answer-6" data-parent="#accordion1">
							为什么启用商城模块后前台产品详情页界面变样了？
						</a>
					</div>
					<div class="panel-collapse collapse" id="answer-6" aria-labelledby="question-6" role="tabpanel">
						<div class="panel-body">
							<p>考虑到前台的体验以及不同模板的兼容问题，新版商城模块并没有往产品详情页插入购物车按钮，而是单独制作了一套商城模块风格。如果觉得前台风格与商城模块产品详情页完全不搭，可以进行模板修改（请看开发说明）来实现您的网站与商城模块风格统一。</p>
							<p>未来我也将推出更多整站风格统一的商城模板。</p>
						</div>
					</div>
				</div>
				<div class="panel">
					<div class="panel-heading" id="question-7" role="tab">
						<a class="panel-title" aria-controls="answer-7" aria-expanded="false" data-toggle="collapse" href="#answer-7" data-parent="#accordion1">
							怎样实现微商城？
						</a>
					</div>
					<div class="panel-collapse collapse" id="answer-7" aria-labelledby="question-7" role="tabpanel">
						<div class="panel-body">
							<ol>
								<li>应用商店安装「微信公众号管理系统」或者用别的微信公众号管理工具都可以。</li>
								<li>设置自定义菜单，将链接指向您的网站网址即可。</li>
								<li>最后，建议设置会员支持微信登录，这样体验更好。（后台-用户-会员-社会化登录）</li>
							</ol>
							<p>新版商城模块全面支持响应式（自适应不同终端），因此不用担心在手机上或者平板电脑上的购物体验。</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="tab-pane" id="exampleTabsLineTwo" role="tabpanel">
			<div class="panel-group panel-group-simple panel-group-continuous" id="accordion2" aria-multiselectable="true" role="tablist">
				<div class="panel">
					<div class="panel-heading" id="question-101" role="tab">
						<a class="panel-title" aria-controls="answer-101" aria-expanded="true" data-toggle="collapse" href="#answer-101" data-parent="#accordion2">
							如何自定义商城模块风格？
						</a>
					</div>
					<div class="panel-collapse collapse in" id="answer-101" aria-labelledby="question-101" role="tabpanel">
						<div class="panel-body">
							<p>商城模块包括产品详情页、购买流程、订单中心的相应页面，而默认这些页面都是单独的风格，很有可能与您网站的风格不一致，这里简单说明如何自定义商城模块风格。（不懂源码的用户请不要尝试操作）</p>
							<p>与做模板的思路一致（完全不会做模板请先到官网学习模板制作），简单调试就可以实现整站风格统一。</p>
							<p>首先，找到商城模块默认风格目录：<code>网站根目录/app/app/shop/web/templates/met/</code></p>
							<p>然后，把需要修改的页面文件复制到你的模板文件夹下进行修改即可，与做模板的方式一样，就这么简单。</p>
							<p><code>shop_head_custom.php</code> 头部</p>
							<p><code>shop_foot_custom.php</code> 底部</p>
							<p><code>shop_showproduct.php</code> 产品详情页（自定义选项部分与JS配合紧密，因此修改请谨慎）</p>
							<p><code>shop_moregoods.php</code> 加入购物车、购物车底部推荐产品</p>
							<p>其它页面文件与整个商城模块融合太紧密，不建议修改</p>
							<p>推荐方式：只需要修改 <code>shop_head_custom.php</code> 和 <code>shop_foot_custom.php</code> 就能够实现整站风格统一</p>
							<p>需要注意的是，修改前端页面时需采用响应式设计。</p>
							<p>全站通用的可调用标签：</p>
							<p><code>get_goods(id)</code> 传递产品id进去，可以取到商品价格、库存、销量等属性（可以用 dump 打印查看）<code>shop_showproduct.php</code> 里有示例代码，可以参考</p>
							<p><code>\$_M['url']['shop_cart_jsonlist']</code> 可以通过 Ajax 请求该地址返回购物车 json 数据，<code>\$_M['url']</code> 这个数组里面 shop_ 开头的都是商城模块可用 URL ，可以根据需要使用。</p>
							<p>更多模板标签支持，请至官方论坛提交建议，我们会及时更新。</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
				</div>
				<div class="col-md-12">
				</div>
			</div>
		</div>
	</div>
</div>
<!--
EOT;
require $this->template('own/foot');
echo <<<EOT
-->
</body>
</html>
<!--
EOT;
?>-->