<!--<?php
defined('IN_MET') or exit('No permission');
echo <<<EOT
-->
<form method="POST" class="ui-from" name="myform" action="{$this->action}" target="_self">
    <div class="v52fmbx" style="margin-top: 2px;">
        <dl>
            <dt>{$_YW['t']['yw054']}</dt>
            <dd class="ftype_input">
                <div class="fbox">
                    {$_M['url']['site']}
                    <input name="dir_name" value="{$_YW['c']['column']['foldername']}" type="text" style="width:55px">
                </div>
                <span class="tips">
                    {$fanwen}
                </span>
            </dd>
        </dl>
        <dl>
            <dt>{$_YW['t']['yw055']}(title)</dt>
            <dd class="ftype_input">
                <div class="fbox">
                    <input name="ctitle" value="{$_YW['c']['column']['ctitle']}" type="text" style="text-transform:uppercase">
                </div>
            </dd>
        </dl>
        <dl>
            <dd class="ftype_description">
            {$_YW['t']['yw056']}{$lanmu}
            </dd>
        </dl>
        <h3 class="v52fmbx_hr">{$_YW['t']['yw262']}</h3>
         <dl>
            <dt>{$_YW['t']['yw263']}</dt>
            <dd class="ftype_radio ftype_transverse">
                <div class="fbox">
                    <label><input name="template" type="radio" value="table" data-required="1" data-checked="{$_YW['c']['template']}">{$_YW['t']['yw264']}</label>
                    <label><input name="template" type="radio" value="section">{$_YW['t']['yw265']}</label>
                </div>
            </dd>
        </dl>   
        <dl>
            <dt>{$_YW['t']['yw266']}</dt>
            <dd class="ftype_radio ftype_transverse">
                <div class="fbox">
                    <label><input name="webstyle" type="radio" value="0" data-required="1" data-checked="{$_YW['c']['webstyle']}">{$_YW['t']['yw267']}</label>
                    <label><input name="webstyle" type="radio" value="1" data-showhide="webstyle_1">{$_YW['t']['yw268']}</label>
                </div>
            </dd>
        </dl>
        <div class="webstyle_1 none">
            <dl>
                <dt>{$_YW['t']['yw269']}</dt>
                <dd class="ftype_color">
                    <div class="fbox">
                        <input type="text" name="bodycolor" value="{$_YW['c']['bodycolor']}">
                    </div>
                    <span class="tips">{$_YW['t']['yw270']}</span>
                </dd>
            </dl>
            <dl>
                <dt>{$_YW['t']['yw271']}</dt>
                <dd class="ftype_upload">
                    <div class="fbox">
                        <input 
                                name="bodyimg" 
                                type="text" 
                                data-upload-type="doupimg"
                                value="{$_YW['c']['bodyimg']}" 
                        />
                    </div>
                    <span class="tips">{$_YW['t']['yw272']}</span>
                </dd>
            </dl>
            <dl>
                <dt>{$_YW['t']['yw271']}</dt>
                <dd class="ftype_radio ftype_transverse ">
                    <div class="fbox">
                        <label><input name="bodyrepeat" type="radio" value="0" data-checked="{$_YW['c']['bodyrepeat']}">{$_YW['t']['yw273']}</label>
                        <label><input name="bodyrepeat" type="radio" value="3">{$_YW['t']['yw274']}</label>
                    </div>
                </dd>
            </dl>
        </div>
        <dl class="noborder">
            <dt></dt>
            <dd>
                <input name="submit" value="{$_YW['t']['yw006']}" class="submit" type="submit">
            </dd>
        </dl>
    </div>
</form>
<!--
EOT;
?>