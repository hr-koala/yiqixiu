<!--<?php
$met_foot_nav = methtml_footnav();//底部导航标签（次导航）
$met_foot_txt = metlabel_foot();//底部信息标签
$foot_menu=wap_foot_menu();
echo <<<EOT
-->
<footer class="tem_footer">
	<section class="tem_inner">
		<div class="tem_footer_nav">{$met_foot_nav}</div>
		<div class="tem_footer_text">
		{$met_foot_txt}
		</div>
	</section>
</footer>
<div class="powered_by_metinfo">&#25628;&#34382;&#31934;&#21697;&#31038;&#21306;&#119;&#119;&#119;&#46;&#115;&#111;&#117;&#104;&#111;&#46;&#110;&#101;&#116;&#25552;&#20379;&#26412;&#28304;&#30721;
</div>
{$foot_menu}
<script src="{$navurl}public/ui/v1/js/sea.js" type="text/javascript"></script>
</body>
</html>
<!--
EOT;
?>-->