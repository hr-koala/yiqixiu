<!--<?php
defined('IN_MET') or exit('No permission');	//所有文件都是已这句话开头，保证系统单入口。
if($_YW['c']['webstyle'] || $_M['form']['a'] == 'doqrcode' || $_M['form']['a'] == 'doweixin') require $this->template('own/head');
echo <<<EOT
-->
<div class="yun_table_info" {$this->infowidth}>
    <div class="yun_fwyz_info">
        {$this->html}
    </div>
</div>
<!--
EOT;
if($_YW['c']['webstyle'] || $_M['form']['a'] == 'doqrcode' || $_M['form']['a'] == 'doweixin') require $this->template('own/foot');
?>