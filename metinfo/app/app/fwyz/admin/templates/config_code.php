<!--<?php
defined('IN_MET') or exit('No permission');
echo <<<EOT
-->
<form method="POST" class="ui-from" name="myform" action="{$this->action}" target="_self">
    <div class="v52fmbx" style="margin-top: 2px;">
        <h3 class="v52fmbx_hr">{$_YW['t']['yw230']}</h3>
        <dl>
            <dt>{$_YW['t']['yw231']}</dt>
            <dd class="ftype_radio ftype_transverse {$configtips}">
                <div class="fbox">
                    <label><input name="space" type="radio" value="0" data-checked="{$_YW['c']['space']}" data-required="1" data-showhide="space_1">{$_YW['t']['yw232']}</label>
                    <label><input name="space" type="radio" value="1" >{$_YW['t']['yw233']}</label>
                    <label><input name="space" type="radio" value="2" >【 - 】{$_YW['t']['yw234']}</label>
                </div>
            </dd>
        </dl>
        <dl class="space_1 none">
            <dt>{$_YW['t']['yw235']}</dt>
            <dd class="ftype_checkbox">
                <div class="fbox">
                    <label><input name="olddata" type="checkbox" value="1" data-checked="{$_YW['c']['olddata']}">{$_YW['t']['yw236']}</label>
                </div>
                <span class="tips">
                    {$_YW['t']['yw237']}
                </span>
            </dd>
        </dl>
        <dl>
            <dt>{$_YW['t']['yw243']}</dt>
            <dd class="ftype_checkbox ftype_transverse {$configtips}">
                <div class="fbox">
                    <label><input name="open" type="checkbox" value="1" data-required="1" data-checked="{$_YW['c']['open']}" data-showhide="open_1" >{$_YW['t']['yw238']}</label>
                    <label><input name="open" type="checkbox" value="2" data-showhide="open_2" >{$_YW['t']['yw239']}</label>
                    <label><input name="open" type="checkbox" value="3" data-showhide="open_3" >{$_YW['t']['yw240']}</label>
                    <label><input name="open" type="checkbox" value="4" data-showhide="open_4" >{$_YW['t']['yw241']}</label>
                    <label><input name="open" type="checkbox" value="5" data-showhide="open_5" >{$_YW['t']['yw242']}</label>
                </div>
                <span class="tips">{$_YW['t']['yw244']}：XXXX-XXXX-XXXX-XXXX-XXXX</span>
            </dd>
        </dl>
                    
                    
                    
        <div class="open_1 none" data-open="1">
            <h3 class="v52fmbx_hr">{$_YW['t']['yw245']}</h3>
            <dl>
                <dt>{$_YW['t']['yw238']}</dt>
                <dd class="ftype_input">
                    <div class="fbox fwinput">
                        {$_YW['t']['yw247']}
                        <input name="fwlength_1" value="{$_YW['c']['fwlength_1']}" type="text" placeholder="{$_YW['t']['yw247']}" class="{$configtips}">
                        {$_YW['t']['yw246']}
                        <input name="fwqian_1" value="{$_YW['c']['fwqian_1']}" type="text" placeholder="{$_YW['t']['yw246']}">
                        {$_YW['t']['yw248']}
                        <input name="fwhou_1" value="{$_YW['c']['fwhou_1']}" type="text" placeholder="{$_YW['t']['yw248']}">
                    </div>
                    <span class="tips"></span>
                </dd>
            </dl>
            <dl>
                <dt>{$_YW['t']['yw249']}</dt>
                <dd class="ftype_radio ftype_transverse">
                    <div class="fbox">
                        <label><input name="fwtype_1" type="radio" value="0" data-required="1" data-checked="{$_YW['c']['fwtype_1']}">{$_YW['t']['yw250']}</label>
                        <label><input name="fwtype_1" type="radio" value="1">{$_YW['t']['yw251']}</label>
                        <label><input name="fwtype_1" type="radio" value="2">{$_YW['t']['yw252']}</label>
                        <label><input name="fwtype_1" type="radio" value="3">{$_YW['t']['yw253']}</label>
                        <label><input name="fwtype_1" type="radio" value="4">{$_YW['t']['yw254']}</label>
                        <label><input name="fwtype_1" type="radio" value="5">{$_YW['t']['yw255']}</label>
                        <label><input name="fwtype_1" type="radio" value="6">{$_YW['t']['yw256']}</label>
                    </div>
                </dd>
            </dl>
        </div>

        <div class="open_2 none" data-open="2">
            <h3 class="v52fmbx_hr">{$_YW['t']['yw257']}</h3>
            <dl>
                <dt>{$_YW['t']['yw239']}</dt>
                <dd class="ftype_input">
                    <div class="fbox fwinput">
                        {$_YW['t']['yw247']}
                        <input name="fwlength_2" value="{$_YW['c']['fwlength_2']}" type="text" placeholder="{$_YW['t']['yw247']}" class="{$configtips}">
                        {$_YW['t']['yw246']}
                        <input name="fwqian_2" value="{$_YW['c']['fwqian_2']}" type="text" placeholder="{$_YW['t']['yw246']}">
                        {$_YW['t']['yw248']}
                        <input name="fwhou_2" value="{$_YW['c']['fwhou_2']}" type="text" placeholder="{$_YW['t']['yw248']}">
                    </div>
                    <span class="tips"></span>
                </dd>
            </dl>
            <dl>
                <dt>{$_YW['t']['yw249']}</dt>
                <dd class="ftype_radio ftype_transverse">
                    <div class="fbox">
                        <label><input name="fwtype_2" type="radio" value="0" data-required="1" data-checked="{$_YW['c']['fwtype_2']}">{$_YW['t']['yw250']}</label>
                        <label><input name="fwtype_2" type="radio" value="1">{$_YW['t']['yw251']}</label>
                        <label><input name="fwtype_2" type="radio" value="2">{$_YW['t']['yw252']}</label>
                        <label><input name="fwtype_2" type="radio" value="3">{$_YW['t']['yw253']}</label>
                        <label><input name="fwtype_2" type="radio" value="4">{$_YW['t']['yw254']}</label>
                        <label><input name="fwtype_2" type="radio" value="5">{$_YW['t']['yw255']}</label>
                        <label><input name="fwtype_2" type="radio" value="6">{$_YW['t']['yw256']}</label>
                    </div>
                </dd>
            </dl>
        </div>
                        
                        
        <div class="open_3 none" data-open="3">
            <h3 class="v52fmbx_hr">{$_YW['t']['yw258']}</h3>
            <dl>
                <dt>{$_YW['t']['yw240']}</dt>
                <dd class="ftype_input">
                    <div class="fbox fwinput">
                        {$_YW['t']['yw247']}
                        <input name="fwlength_3" value="{$_YW['c']['fwlength_3']}" type="text" placeholder="{$_YW['t']['yw247']}" class="{$configtips}">
                        {$_YW['t']['yw246']}
                        <input name="fwqian_3" value="{$_YW['c']['fwqian_3']}" type="text" placeholder="{$_YW['t']['yw246']}">
                        {$_YW['t']['yw248']}
                        <input name="fwhou_3" value="{$_YW['c']['fwhou_3']}" type="text" placeholder="{$_YW['t']['yw248']}">
                    </div>
                    <span class="tips"></span>
                </dd>
            </dl>
            <dl>
                <dt>{$_YW['t']['yw249']}</dt>
                <dd class="ftype_radio ftype_transverse">
                    <div class="fbox">
                        <label><input name="fwtype_3" type="radio" value="0" data-required="1" data-checked="{$_YW['c']['fwtype_3']}">{$_YW['t']['yw250']}</label>
                        <label><input name="fwtype_3" type="radio" value="1">{$_YW['t']['yw251']}</label>
                        <label><input name="fwtype_3" type="radio" value="2">{$_YW['t']['yw252']}</label>
                        <label><input name="fwtype_3" type="radio" value="3">{$_YW['t']['yw253']}</label>
                        <label><input name="fwtype_3" type="radio" value="4">{$_YW['t']['yw254']}</label>
                        <label><input name="fwtype_3" type="radio" value="5">{$_YW['t']['yw255']}</label>
                        <label><input name="fwtype_3" type="radio" value="6">{$_YW['t']['yw256']}</label>
                    </div>
                </dd>
            </dl>
        </div>

        <div class="open_4 none" data-open="4">
            <h3 class="v52fmbx_hr">{$_YW['t']['yw259']}</h3>
            <dl>
                <dt>{$_YW['t']['yw241']}</dt>
                <dd class="ftype_input">
                    <div class="fbox fwinput">
                        {$_YW['t']['yw247']}
                        <input name="fwlength_4" value="{$_YW['c']['fwlength_4']}" type="text" placeholder="{$_YW['t']['yw247']}" class="{$configtips}">
                        {$_YW['t']['yw246']}
                        <input name="fwqian_4" value="{$_YW['c']['fwqian_4']}" type="text" placeholder="{$_YW['t']['yw246']}">
                        {$_YW['t']['yw248']}
                        <input name="fwhou_4" value="{$_YW['c']['fwhou_4']}" type="text" placeholder="{$_YW['t']['yw248']}">
                    </div>
                    <span class="tips"></span>
                </dd>
            </dl>
            <dl>
                <dt>{$_YW['t']['yw249']}</dt>
                <dd class="ftype_radio ftype_transverse">
                    <div class="fbox">
                        <label><input name="fwtype_4" type="radio" value="0" data-required="1" data-checked="{$_YW['c']['fwtype_4']}">{$_YW['t']['yw250']}</label>
                        <label><input name="fwtype_4" type="radio" value="1">{$_YW['t']['yw251']}</label>
                        <label><input name="fwtype_4" type="radio" value="2">{$_YW['t']['yw252']}</label>
                        <label><input name="fwtype_4" type="radio" value="3">{$_YW['t']['yw253']}</label>
                        <label><input name="fwtype_4" type="radio" value="4">{$_YW['t']['yw254']}</label>
                        <label><input name="fwtype_4" type="radio" value="5">{$_YW['t']['yw255']}</label>
                        <label><input name="fwtype_4" type="radio" value="6">{$_YW['t']['yw256']}</label>
                    </div>
                </dd>
            </dl>
        </div>

        <div class="open_5 none" data-open="5">
            <h3 class="v52fmbx_hr">{$_YW['t']['yw260']}</h3>
            <dl>
                <dt>{$_YW['t']['yw242']}</dt>
                <dd class="ftype_input">
                    <div class="fbox fwinput">
                        {$_YW['t']['yw247']}
                        <input name="fwlength_5" value="{$_YW['c']['fwlength_5']}" type="text" placeholder="{$_YW['t']['yw247']}" class="{$configtips}">
                        {$_YW['t']['yw246']}
                        <input name="fwqian_5" value="{$_YW['c']['fwqian_5']}" type="text" placeholder="{$_YW['t']['yw246']}">
                        {$_YW['t']['yw248']}
                        <input name="fwhou_5" value="{$_YW['c']['fwhou_5']}" type="text" placeholder="{$_YW['t']['yw248']}">
                    </div>
                    <span class="tips"></span>
                </dd>
            </dl>
            <dl>
                <dt>{$_YW['t']['yw249']}</dt>
                <dd class="ftype_radio ftype_transverse">
                    <div class="fbox">
                        <label><input name="fwtype_5" type="radio" value="0" data-required="1" data-checked="{$_YW['c']['fwtype_5']}">{$_YW['t']['yw250']}</label>
                        <label><input name="fwtype_5" type="radio" value="1">{$_YW['t']['yw251']}</label>
                        <label><input name="fwtype_5" type="radio" value="2">{$_YW['t']['yw252']}</label>
                        <label><input name="fwtype_5" type="radio" value="3">{$_YW['t']['yw253']}</label>
                        <label><input name="fwtype_5" type="radio" value="4">{$_YW['t']['yw254']}</label>
                        <label><input name="fwtype_5" type="radio" value="5">{$_YW['t']['yw255']}</label>
                        <label><input name="fwtype_5" type="radio" value="6">{$_YW['t']['yw256']}</label>
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