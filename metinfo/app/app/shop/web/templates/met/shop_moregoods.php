<!--<?php
echo <<<EOT
-->
		<div class="moregoods">
			<div class="moregoods-head">
				<h4 class="moregoods-title">{$_M['word']['app_shop_moregoods']}</h4>
			</div>
			<div class="moregoods-body">
<div class="row">
<!--
EOT;
$thumb_src="{$_M[url][site]}include/thumb.php?";
$metlist_array = methtml_getarray('','com','','product',12);
foreach($metlist_array as $key=>$val){
$val['imgurl']="{$thumb_src}dir={$val[imgurl]}&x=300&y=300";
$val['url'] = load::own_class('web/class/web_goods', 'new')->get_show_product_url($val['id'],$val['class1']);
$val['shopinfo'] = get_goods($val['id']);
echo <<<EOT
-->
<div class="col-md-3 col-sm-4 col-xs-6 moregoods-list" data-plugin="appear" data-animate="fade">
	<div class="text-center box">
		<a href="{$val[url]}" target="_blank" class="img" title="{$val[title]}"><img src="{$val[imgurl]}" class="img-responsive" alt="{$val[title]}"></a>
		<a href="{$val[url]}" target="_blank" class="txt" title="{$val[title]}">{$val[title]}</a>
		<p class="red-600 margin-bottom-0">{$val['shopinfo']['price_str']}</p>
	</div>
</div>
<!--
EOT;
}
echo <<<EOT
-->
</div>
			</div>
		</div>
<!--
EOT;
?>