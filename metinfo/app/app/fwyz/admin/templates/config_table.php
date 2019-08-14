<!--<?php
defined('IN_MET') or exit('No permission');
echo <<<EOT
-->
<form method="POST" class="ui-from" name="myform" action="{$this->action}" target="_self">
    <div class="v52fmbx" style="margin-top: 2px;">
        <dl>
            <dt>{$_YW['t']['yw063']}</dt>
            <dd class="ftype_radio ftype_transverse">
                <div class="fbox">
                    <label><input name="celan" type="radio" value="0" data-checked="{$_YW['c']['celan']}" data-required="1">{$_YW['t']['yw064']}</label>
                    <label><input name="celan" type="radio" value="1">{$_YW['t']['yw065']}</label>
                    <label><input name="celan" type="radio" value="2">{$_YW['t']['yw066']}</label>
                </div>
                <span class="tips">{$_YW['t']['yw067']}</span>
            </dd>
        </dl>
        <h3 class="v52fmbx_hr">{$_YW['t']['yw072']}</h3>
        <dl>
            <dt>{$_YW['t']['yw074']}</dt>
            <dd class="ftype_input">
                <div class="fbox">
                    <input name="sstop" value="{$_YW['c']['sstop']}" type="text">
                </div>
                <span class="tips">{$_YW['t']['yw075']}</span>
            </dd>
        </dl>
        <dl>
            <dt>{$_YW['t']['yw078']}</dt>
            <dd class="ftype_upload">
                <div class="fbox">
                    <input name="ssbjt" data-upload-type="doupimg" class="text" value="{$_YW['c']['ssbjt']}" type="text">
                </div>
                <span class="tips">{$_YW['t']['yw079']}</span>
            </dd>
        </dl>

        <dl>
            <dt>{$_YW['t']['yw080']}</dt>
            <dd class="ftype_color">
                <div class="fbox">
                    <input name="color" value="{$_YW['c']['color']}" type="text">
                </div>
                <span class="tips">{$_YW['t']['yw081']}</span>
            </dd>
        </dl>
        <dl>
            <dt>{$_YW['t']['yw082']}</dt>
            <dd class="ftype_color">
                <div class="fbox">
                    <input name="scolor" value="{$_YW['c']['scolor']}" type="text">
                    <input name="hoverscolor" value="{$_YW['c']['hoverscolor']}" type="text">
                </div>
                <span class="tips">{$_YW['t']['yw083']}</span>
            </dd>
        </dl>
        <dl>
            <dt>{$_YW['t']['yw084']}</dt>
            <dd class="ftype_input">
                <div class="fbox">
                    <input name="sstopjl" value="{$_YW['c']['sstopjl']}" type="text">
                </div>
                <span class="tips">{$_YW['t']['yw085']}</span>
            </dd>
        </dl>
        <dl>
            <dt>{$_YW['t']['yw076']}</dt>
            <dd class="ftype_ckeditor">
                <div class="fbox">
                    <textarea name="ssbottom" data-ckeditor-type="1">{$_YW['c']['ssbottom']}</textarea>
                </div>
                <span class="tips">{$_YW['t']['yw077']}</span>
            </dd>
        </dl>
        <h3 class="v52fmbx_hr">{$_YW['t']['yw086']}</h3>
        
        <dl>
            <dt>{$_YW['t']['yw275']}</dt>
            <dd class="ftype_radio ftype_transverse">
                <div class="fbox">
                    <label><input name="css" type="radio" value="0" data-checked="{$_YW['c']['css']}" data-showhide="css_1">{$_YW['t']['yw276']}</label>
                    <label><input name="css" type="radio" value="1" data-showhide="css_2">{$_YW['t']['yw277']}</label>
                </div>
            </dd>
        </dl>
        <div class="none css_2">         
            <dl>
                <dt>{$_YW['t']['yw103']}</dt>
                <dd class="ftype_input">
                    <div class="fbox">
                        <input name="jdzpjg" value="{$_YW['c']['jdzpjg']}" type="text">
                    </div>
                    <span class="tips">{$_YW['t']['yw104']}</span>
                </dd>
            </dl>
            <dl>
                <dt>{$_YW['t']['yw105']}</dt>
                <dd class="ftype_input">
                    <div class="fbox">
                        <input name="jdjmwl" value="{$_YW['c']['jdjmwl']}" type="text">
                    </div>
                    <span class="tips">{$_YW['t']['yw106']}</span>
                </dd>
            </dl>
        </div>
        
        <div class="none css_1">
            <dl>
                <dt>{$_YW['t']['yw089']}</dt>
                <dd class="ftype_input">
                    <div class="fbox">
                        <input name="cxwidth" value="{$_YW['c']['cxwidth']}" type="text">
                    </div>
                    <span class="tips">{$_YW['t']['yw090']}</span>
                </dd>
            </dl>
            <dl>
                <dt>{$_YW['t']['yw091']}</dt>
                <dd class="ftype_color">
                    <div class="fbox">
                        <input name="cxcolor" value="{$_YW['c']['cxcolor']}" type="text">
                    </div>
                    <span class="tips">{$_YW['t']['yw092']}</span>
                </dd>
            </dl>
            <dl>
                <dt>{$_YW['t']['yw093']}</dt>
                <dd class="ftype_color">
                    <div class="fbox">
                        <input name="cxcolor5" value="{$_YW['c']['cxcolor5']}" type="text">
                    </div>
                    <span class="tips">{$_YW['t']['yw094']}</span>
                </dd>
            </dl>
        </div>
        <h3 class="v52fmbx_hr">DIY CSS</h3>
        <dl>
            <dd class="ftype_textarea">
                <div class="fbox">
                    <textarea name="t_css" placeholder="DIY CSS" style="width: 100%; height:300px;">{$_YW['c']['t_css']}</textarea>
                </div>
                <span class="tips">{$_YW['t']['yw278']}</span>
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