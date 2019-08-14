<!--<?php
$met_title = $_M['word']['app_shop_tocart'];
require_once $this->template('tem/shop_head');
$tocrat['para_str'] = str_replace(","," ",$tocrat['para_str']); 
echo <<<EOT
-->
<div class="page">
	<div class="container">
	<div class="page-content">
		<div class="panel">
			<div class="panel-body tocar-info">
				<div class="visible-xs-block height-10"></div>
				<div class="row">
					<div class="col-sm-6">
						<div class="media">
						  <div class="media-left">
							  <img class="media-object" src="{$tocrat[img]}" alt="{$tocrat[name]}">
						  </div>
						  <div class="media-body">
							<h4 class="media-heading font-size-16">{$tocrat[name]} {$tocrat['para_str']}</h4>
							<p class="font-size-20 green-800 margin-bottom-0">{$_M['word']['app_shop_tocartok']}</p>
						  </div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="text-right tocar-btn-body">
							<a class="btn btn-default btn-lg btn-squared margin-right-20" href="javascript:window.history.back()">{$_M['word']['app_shop_continue']}</a>
							<div class="visible-xs-block height-10"></div>
							<a class="btn btn-danger btn-lg btn-squared" href="{$_M['url']['shop_cart']}">{$_M['word']['app_shop_gosettlement']}</a>
						</div>
					</div>
				</div>
			</div>
		</div>
<!--
EOT;
require_once $this->template('tem/shop_moregoods'); 
echo <<<EOT
-->
	</div>
	</div>
</div>
<!--
EOT;
require_once $this->template('tem/shop_foot'); 
echo <<<EOT
-->
<script src="{$uipath}vendor/jquery-appear/jquery.appear.js"></script>
<script src="{$webpath}js/appear.js"></script>
<script src="{$webpath}js/own.js"></script>  
</body>
</html>
<!--
EOT;
?>-->