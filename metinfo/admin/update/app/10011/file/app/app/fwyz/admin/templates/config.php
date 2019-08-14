<!--<?php
defined('IN_MET') or exit('No permission');
require $this->template('ui/head');
echo <<<EOT
-->
<style>
    body{background: #f7f7f7;}
    .stat_list{background: #f7f7f7; width: 100%;}
    .yun{display: none;}
</style>
<div class="container-fluid yuncon yun">
    <div class="row" id="box">
        <div class="col-md-2 col-sm-2">
            <div class="con2" id="float">
                {$this->nav}
            </div>
        </div>
        <div class="col-md-10 col-sm-10 con10">
<!--
EOT;
require $this->template('own/config_'.$this->navsign);
echo <<<EOT
-->
        </div>
    </div>
</div>
<!--
EOT;
require $this->template('ui/foot');
?>