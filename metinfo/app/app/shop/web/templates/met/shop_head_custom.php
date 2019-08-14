<!--<?php
echo <<<EOT
-->
</head>
<body>
         <nav class="navbar navbar-default margin-bottom-0" role="navigation">
            <div class="container">
              <div class="navbar-header">
                <button type="button" class="navbar-toggle hamburger hamburger-close collapsed"
                data-target="#example-navbar-default-collapse" data-toggle="collapse">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="hamburger-bar"></span>
                </button>
				<a class="navbar-brand navbar-logo" href="{$index_url}index.php?lang={$lang}" title="{$met_webname}">
					<img src="{$met_logo}" title="{$met_webname}">
				</a>
              </div>
              <div class="collapse navbar-collapse navbar-collapse-group" style="overflow:visible;" id="example-navbar-default-collapse">
<!--
EOT;
$metinfo_member_name = get_met_cookie('metinfo_member_name');
if(!$metinfo_member_name){
echo <<<EOT
-->
				<a href="{$_M['url'][shop_member_reg]}" class="btn btn-squared btn-primary navbar-right navbar-btn">{$_M['word']['app_shop_register']}</a>
				<a href="{$_M['url'][shop_member_login]}" class="btn btn-squared btn-primary navbar-right navbar-btn margin-right-10">{$_M['word']['app_shop_login']}</a>
<!--
EOT;
}else{
echo <<<EOT
-->
                <ul class="nav navbar-toolbar navbar-right navbar-toolbar-right">
                  <li class="dropdown">
                    <a class="navbar-avatar dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                      <span class="avatar avatar-online text-middle margin-right-5">
                        <img src="{$_M['user'][head]}" alt="{$_M['user'][username]}">
                      </span>
					  {$_M['user'][username]}
					  <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu bullet dropdown-menu-right" role="menu">
                      <li role="presentation">
                        <a href="{$_M['url']['shop_profile']}" role="menuitem"><i class="icon wb-user" aria-hidden="true"></i> {$_M['word']['app_shop_personal']}</a>
                      </li>
                      <li role="presentation">
                        <a href="{$_M['url']['shop_order']}" role="menuitem"><i class="icon wb-order" aria-hidden="true"></i> {$_M['word']['app_shop_myorder']}</a>
                      </li>
                      <li role="presentation">
                        <a href="{$_M['url']['shop_member_base']}&nojump=1" target="_blank" role="menuitem"><i class="icon wb-settings" aria-hidden="true"></i> {$_M['word']['app_shop_settings']}</a>
                      </li>
                      <li class="divider" role="presentation"></li>
                      <li role="presentation">
                        <a href="{$_M['url']['shop_member_login_out']}" role="menuitem"><i class="icon wb-power" aria-hidden="true"></i> {$_M['word']['app_shop_out']}</a>
                      </li>
                    </ul>
                  </li>
                  <li class="dropdown">
                    <a data-toggle="dropdown" href="javascript:void(0)" title="{$_M['word']['app_shop_cart']}" aria-expanded="false"
                    data-animation="slide-bottom" role="button">
                      <i class="icon wb-shopping-cart" aria-hidden="true"></i>
                      <span class="badge badge-danger up hide topcart-goodnum"></span>
                    </a>
                    <ul class="dropdown-menu bullet dropdown-menu-right dropdown-menu-media topcartremove" role="menu">
                      <li class="dropdown-menu-header">
                        <h5>{$_M['word']['app_shop_cart']}</h5>
                        <span class="label label-round label-danger">{$_M['word']['app_shop_intotal']} <span class="topcart-goodnum"></span> {$_M['word']['app_shop_piece']}{$_M['word']['app_shop_commodity']}</span>
                      </li>
                      <li class="list-group dropdown-scrollable" role="presentation">
                        <div data-role="container">
                          <div data-role="content" id="topcart-body">
							
                          </div>
                        </div>
                      </li>
                      <li class="dropdown-menu-footer" role="presentation">
						<div class="dropdown-menu-footer-btn">
							<a href="{$_M['url']['shop_cart']}" class="btn btn-squared btn-danger margin-bottom-5 margin-right-10">{$_M['word']['app_shop_gosettlement']}</a>
						</div>
                        <span class="red-600 font-size-18 topcarttotal"></span>
                      </li>
                    </ul>
                  </li>
                </ul>
<!--
EOT;
}
echo <<<EOT
-->
              </div>
            </div>
          </nav>
<!--
EOT;
?>