<!--<?php
$shop_sp=1;
require_once $this->template('tem/shop_head'); 
echo <<<EOT
-->
<script>
	var ax  = '{$met_productdetail_x}',
		ay = '{$met_productdetail_y}';
	var stockjson = {$stockjson};
</script>
<div class="page">
	<div class="container">
	<div class="page-content">
		<div class="panel">
			<div class="panel-body">
				<div class="row">
					<div class="col-md-6 animsition">
<div id="gallery" class="ad-gallery"> 
	<div class="ad-image-wrapper"></div> 
	<div class="ad-controls"></div> 
	<div class="ad-nav"> 
		<div class="ad-thumbs"> 
			<ul class="ad-thumb-list" id="lightgallery"> 
				<li data-src="{$product[imgurl]}">
					<a href="{$thumb_src}dir={$product[imgurl]}&x={$met_productdetail_x}&y={$met_productdetail_y}"> 
						<img src="{$thumb_src}dir={$product[imgurl]}&x=64&y=64" class="img-responsive" alt="{$product[title]}" />
					</a> 
				</li> 
<!--
EOT;
foreach($displaylist as $key=>$val){
echo <<<EOT
-->
				<li data-src="{$val[imgurl]}">
					<a href="{$thumb_src}dir={$val[imgurl]}&x={$met_productdetail_x}&y={$met_productdetail_x}"> 
						<img src="{$thumb_src}dir={$val[imgurl]}&x=64&y=64" class="img-responsive" alt="{$val[title]}" />
					</a> 
				</li> 
<!--
EOT;
}
if($goods['original']){
	$goods['original_html'] = "<del>{$_M['word']['app_shop_original']}{$goods['original_str']}</del>";
}
$shopmax = $goods['stock'];
if($goods['stock_show']){
	$goods['stock_html'] = "{$_M['word']['app_shop_stock']} {$goods['stock']} {$_M['word']['app_shop_piece']}";
}
if($goods['purchase']){
	$goods['purchase_html'] = "<span class=\"badge badge-radius badge-default\">{$_M['word']['app_shop_purchase']} {$goods['purchase']} {$_M['word']['app_shop_piece']}</span></del>";
	$shopmax = $goods['purchase'];
}
echo <<<EOT
-->
			</ul> 
		</div> 
	</div> 
</div>
					</div>
					<div class="visible-xs-block visible-sm-block height-20"></div>
					<div class="col-md-6 product-intro">
						<h1>{$product[title]}</h1>
						<p class="description">{$product[description]}</p>
						<div class="text-default">
							<span id="price">{$goods['price_str']}</span>{$goods['original_html']}
						</div>
<!--
EOT;
foreach($goods['selectpara'] as $keyselect=>$valselect){
echo <<<EOT
-->	
						<div class="form-group margin-top-15">
							<label class="control-label font-weight-unset">{$valselect['name']}</label>
							<div class="selectpara-body">
<!--
EOT;
	$i = 0;
	foreach($valselect['value'] as $keyvalue=>$valvalue){
		$class = '';
		if($i == 0)$class = "btn-danger";
		$i++;
echo <<<EOT
-->	
								<a href="javascript:;" data-val="{$valvalue}" class="selectpara btn btn-squared btn-outline btn-default {$class} margin-right-10">{$valvalue}</a>
<!--
EOT;
	}
echo <<<EOT
-->
							</div>
						</div>
<!--
EOT;
}
echo <<<EOT
-->	
						<div class="form-group margin-top-15">
							<label class="control-label font-weight-unset">{$_M['word']['app_shop_number']}</label>
							<div class="width-150">
								<input type="text" class="form-control text-center" data-min="1" data-max="{$shopmax}" data-plugin="touchSpin" name="buynum" id="buynum" autocomplete="off" value="1">
							</div>
							<p>{$goods['stock_html']}{$goods['purchase_html']}</p>
						</div>
						<div class="form-group margin-top-30 purchase-btn">
							<a href="{$_M['url']['shop_tocart_now']}&pid={$goods['pid']}" class="btn btn-lg btn-squared btn-warning margin-right-20 product-buynow">{$_M['word']['app_shop_buyimmediately']}</a>
							<div class="visible-xs-block height-10"></div>
							<a href="{$_M['url']['shop_tocart']}&pid={$goods['pid']}" class="btn btn-lg btn-squared btn-danger product-tocart"><i class="icon fa-cart-plus font-size-20" aria-hidden="true"></i>{$_M['word']['app_shop_tocart']}</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		
<!--
EOT;
$paraok = count($product_paralist)?true:false;
for($i=1;$i<=($met_productTabok-1);$i++){
	$met_productTabname = 'met_productTabname_'.$i;
	$productTablist[$i]['title']   = $$met_productTabname;
	$productTablist[$i]['content'] = $product['content'.$i];
}
echo <<<EOT
-->
		<div class="product-content">
			<div class="row">
				<div class="col-md-9 product-right">
					<div class="panel product-detail">
						<div class="panel-body">
<!--固定顶部-->
<div class="affix-fixed hide">
	<div class="container">
		<div class="row">
			<div class="col-md-3 animation-fade">
				<div class="media">
					<div class="media-left">
						<a class="avatar text-middle" href="{$product[url]}">
							<img class="img-responsive" src="{$thumb_src}dir={$product[imgurl]}&x=60&y=60" alt="{$product[title]}">
						</a>
					</div>
					<div class="media-body">
						<h4 class="media-heading margin-top-10 font-weight-unset">{$product[title]}</h4>
						<p>{$goods['price_str']}</p>
					</div>
				</div>
			</div>
			<div class="col-md-7">
				<ul class="nav nav-tabs nav-tabs-line margin-left-30">
					<li class="active"><a data-toggle="tab" href="#product-details" data-get="product-details">{$_M['word']['app_shop_details']}</a></li>
<!--
EOT;
foreach($productTablist as $key=>$val){
echo <<<EOT
-->
					<li><a data-toggle="tab" href="#product-content{$key}" data-get="product-content{$key}">{$val['title']}</a></li>
<!--
EOT;
}
echo <<<EOT
-->
				</ul>
			</div>
			<div class="col-md-2 text-right animation-fade">
				<a href="{$_M['url']['shop_tocart_now']}&pid={$goods['pid']}" class="btn btn-squared btn-danger margin-top-10 product-tocart"><i class="icon fa-cart-plus font-size-16" aria-hidden="true"></i>{$_M['word']['app_shop_tocart']}</a>
			</div>
		</div>
	</div>
</div>
							<ul class="nav nav-tabs nav-tabs-line affix-nav">
								<li class="active"><a data-toggle="tab" href="#product-details" data-get="product-details">{$_M['word']['app_shop_details']}</a></li>
<!--
EOT;
foreach($productTablist as $key=>$val){
echo <<<EOT
-->
								<li><a data-toggle="tab" href="#product-content{$key}" data-get="product-content{$key}">{$val['title']}</a></li>
<!--
EOT;
}
echo <<<EOT
-->
							</ul>
							<div class="tab-content">
								<div class="tab-pane met-editor clearfix animation-fade active" id="product-details">
<!--
EOT;
if($paraok){
echo <<<EOT
-->
									<div class="row margin-bottom-10">
<!--
EOT;
foreach($product_paralist as $key=>$val){
	if($product[$val[para]]){
echo <<<EOT
-->						
										<div class="col-md-4 margin-bottom-10 blue-grey-500">
											{$val[name]} : 
											{$product[$val[para]]}
										</div>
<!--
EOT;
	}
}
echo <<<EOT
-->	
									</div>
<!--
EOT;
}
echo <<<EOT
-->	
									{$product[content]}
								</div>
<!--
EOT;
foreach($productTablist as $key=>$val){
echo <<<EOT
-->
								<div class="tab-pane met-editor clearfix animation-fade" id="product-content{$key}">
									{$val[content]}
								</div>
<!--
EOT;
}
echo <<<EOT
-->
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="panel product-hot">
						<div class="ribbon ribbon-clip ribbon-danger margin-top-5">
							<span class="ribbon-inner">{$_M['word']['app_shop_recommend']}</span>
						</div>
						<div class="panel-body padding-top-70">
<div class="row">
<!--
EOT;
$metlist_array=methtml_getarray('','com','','product',5);
foreach($metlist_array as $key=>$val){
$val['imgurl']="{$thumb_src}dir={$val[imgurl]}&x=250&y=250";
$val['shopinfo'] = get_goods($val['id']);
echo <<<EOT
-->
<div class="product-hot-list col-md-12 col-sm-4 col-xs-6 text-center margin-bottom-10">
	<a href="{$val[url]}" target="_blank" class="img" title="{$val[title]}"><img src="{$val[imgurl]}" class="img-responsive" alt="{$val[title]}"></a>
	<a href="{$val[url]}" target="_blank" class="txt" title="{$val[title]}">{$val[title]}</a>
	<p>{$val['shopinfo']['price_str']}</p>
</div>
<!--
EOT;
}
echo <<<EOT
-->
</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
</div>
<!--
EOT;
require_once $this->template('tem/shop_foot'); 
echo <<<EOT
-->
<!--touchspin-->
<link rel="stylesheet" href="{$uipath}vendor/bootstrap-touchspin/bootstrap-touchspin.min.css">
<script src="{$uipath}vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
<!--ad-gallery-->
<script src="{$webpath}js/jquery.ad-gallery.pack.js"></script>
<!--animsition-->
<script src="{$uipath}vendor/animsition/animsition.min.js"></script>
<script src="{$uipath}js/components/animsition.min.js"></script>
<!--lightgallery-->
<link rel="stylesheet" type="text/css" href="{$webpath}js/LightBox/css/lightgallery.css" />
<script src="{$webpath}js/LightBox/js/lightgallery.min.js"></script>
<script src="{$webpath}js/LightBox/js/lg-zoom.min.js"></script>
<!--showproduct-->
<script src="{$webpath}js/showproduct.js"></script>
<script src="{$webpath}js/own.js"></script>  
</body>
</html>
<!--
EOT;
?>-->