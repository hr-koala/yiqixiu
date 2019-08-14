<!--<?php
defined('IN_MET') or exit('No permission');
echo <<<EOT
-->
<div class="ui-float-left">
<!--
EOT;
if ($recycle) {
if($this->tname == 'code') $navon = 'navacross on';
echo <<<EOT
-->
                <a href="{$_M['url']['own_name']}c=info_on&a=doeditorinfo" class="ui-addlist ui-table-addlist"><i class="fa fa-plus-circle"></i>{$_YW['t']['yw017']}</a>
                <a href="{$_M['url']['own_name']}c=inout&a=doaddcsvdr" class="ui-addlist ui-table-addlist"><i class="fa fa-plus-circle"></i>{$_YW['t']['yw018']}</a>
                <a href="{$_M['url']['own_name']}c=qrcodes&a=doqrcode" class="ui-addlist ui-table-addlist addqrcode"><i class="fa fa-plus-circle"></i>{$_YW['t']['yw213']}</a>
                
<!--
EOT;
} else {//保证搜索框的位置始终一致
echo <<<EOT
-->
        {$this->navacross}
<!--
EOT;
}
echo <<<EOT
-->

</div>
<!--
EOT;
?>