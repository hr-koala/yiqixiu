<!--<?php
defined('IN_MET') or exit('No permission');
require $this->template('ui/head');
echo <<<EOT
-->
<style>
    .stat_list{background: #f7f7f7; width: 100%;}
    .yun{display: none;}
</style>
<div class="v52fmbx yun">
    <h3 class="v52fmbx_hr">{$_YW['t']['yw113']}</h3>
    <dl>
        <dd class="ftype_input">
            <div class="fbox">
                <a href="{$_M['url']['own_name']}c=inout&a=doaddupcvs&csv=drdc" class="btn btn-info" target="_blank" >{$_YW['t']['yw114']}</a>
            </div>
            <span class="tips">{$_YW['t']['yw115']}</span>
        </dd>
    </dl>
    <dl>
        <dd class="ftype_input">
            <span class="tips">{$_YW['t']['yw116']}</span>
        </dd>
    </dl>
    <h3 class="v52fmbx_hr">{$_YW['t']['yw117']}</h3>
    <dl>
	<dd class="ftype_input">
            <span class="tips">{$_YW['t']['yw118']}</span>
            <div class="fbox">
                <input type="text" name="csvhs" value="1000" style="width:50px;margin-left:8px;" data-required="1">
            </div>
            <span class="tips">{$_YW['t']['yw119']}</span>
	</dd>
    </dl>

    <dl style="display:none;" id="dcdl">
        <dd>
             <div class="mycsv yw_tips">
                <span class="btn btn-info">{$_YW['t']['yw120']}</span>
                <input id="fileupload" type="file" name="mycsv" style="opacity: 0;filter:alpha(opacity=0);">
             </div>
            <!-- 进度条 -->   
            <div class="yw_tips yw_tipsleft">
                <div class="progress yw_tipsleft">
                    <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="1" aria-valuemin="0" aria-valuemax="100" style="width: 1%; min-width: 2em;">1%</div>
                </div>
                <div id="msg" class="yw_tipsleft"></div>

                
            </div>
        </dd>
    </dl>
</div>
<!--
EOT;
require $this->template('ui/foot');
?>