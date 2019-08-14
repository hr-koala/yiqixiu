<!--<?php
defined('IN_MET') or exit('No permission');
echo <<<EOT
-->
<form method="POST" class="ui-from" name="myform" action="{$this->action}" target="_self">
    <div class="v52fmbx" style="margin-top: 2px;">
        <dl>
            <dt>{$_YW['t']['yw217']}</dt>
            <dd class="ftype_radio ftype_transverse">
                <div class="fbox">
                    <label><input name="fwdel" type="radio" value="1" data-required="1" data-checked="{$_YW['c']['fwdel']}">{$_YW['t']['yw218']}</label>
                    <label><input name="fwdel" type="radio" value="0">{$_YW['t']['yw219']}</label>
                </div>
                <span class="tips">
                    {$_YW['t']['yw220']}
                </span>
            </dd>
        </dl>
        <dl>
            <dt>{$_YW['t']['yw057']}</dt>
            <dd class="ftype_input">
                <div class="fbox">
                    <input name="fwlb" value="{$_YW['c']['fwlb']}" type="text">
                </div>
                <span class="tips">{$_YW['t']['yw058']}</span>
            </dd>
        </dl>
        <dl>
            <dt>{$_YW['t']['yw221']}</dt>
            <dd class="ftype_input">
                <div class="fbox">
                    <input name="fwmakenum" value="{$_YW['c']['fwmakenum']}" type="text">
                </div>
                <span class="tips">{$_YW['t']['yw222']}</span>
            </dd>
        </dl>
        <dl>
            <dt>{$_YW['t']['yw015']}</dt>
            <dd class="ftype_radio ftype_transverse">
                <div class="fbox">
                    <label><input name="numonoff" type="radio" value="1" data-required="1" data-checked="{$_YW['c']['numonoff']}">{$_YW['t']['yw261']}</label>
                    <label><input name="numonoff" type="radio" value="0">{$_YW['t']['yw177']}</label>
                </div>
            </dd>
        </dl>
      
        <dl>
            <dt>{$_YW['t']['yw088']}</dt>
            <dd class="ftype_checkbox ftype_transverse">
                <div class="fbox">
                    <label><input name="additional" type="checkbox" value="0" disabled checked data-checked="{$_YW['c']['additional']}">{$_YW['t']['yw095']}</label>
                    <label><input name="additional" type="checkbox" value="1" data-showhide="additional_1">{$_YW['t']['yw096']}</label>
                    <label><input name="additional" type="checkbox" value="2" data-showhide="additional_2">{$_YW['t']['yw097']}</label>
                </div>
            </dd>
        </dl>
        <dl class="additional_2 none">
            <dd class="ftype_description">
                {$_YW['t']['yw098']}
            </dd>
        </dl>
        <dl class="additional_2 none">
            <dt>{$_YW['t']['yw099']}</dt>
            <dd class="ftype_tags">
                <div class="fbox">
                    <input name="word" type="hidden" data-label="|" value="{$_YW['c']['word']}">
                </div>
                <span class="tips">{$_YW['t']['yw100']}</span>
            </dd>
        </dl>
        
        <dl class="additional_2 none">
            <dt>{$_YW['t']['yw101']}</dt>
            <dd class="ftype_upload">
                <div class="fbox">
                    <input 
                        name="picurl" 
                        type="text" 
                        data-upload-type="doupimg"
                        value="{$_YW['c']['picurl']}" 
                    />
                </div>
                <span class="tips">{$_YW['t']['yw102']}</span>
            </dd>
        </dl>
        <dl class="additional_2 none">
            <dt>{$_YW['t']['yw124']}</dt>
            <dd class="ftype_input">
                <div class="fbox">
                    <input type="text" name="description" value="{$_YW['c']['description']}">
                </div>
            </dd>
        </dl>
     
        <h3 class="v52fmbx_hr">{$_YW['t']['yw223']}</h3>
        
        <dl>
            <dd class="ftype_description">
                {$_YW['t']['yw009']}
            </dd>
        </dl>
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