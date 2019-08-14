<!--<?php
defined('IN_MET') or exit('No permission');
echo <<<EOT
-->
<form method="POST" class="ui-from" name="myform" action="{$this->action}" target="_self">
    <div class="v52fmbx" style="margin-top: 2px;">
        <dl>
            <dt>{$_YW['t']['yw279']}</dt>
            <dd class="ftype_input">
                <div class="fbox">
                    <input type="text" name="s_width" value="{$_YW['c']['s_width']}" data-required="1">
                </div>
                <span class="tips">{$_YW['t']['yw090']}</span>
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
            <dt>{$_YW['t']['yw013']}</dt>
            <dd class="ftype_radio ftype_transverse">
                <div class="fbox">
                    <label><input name="subsection" type="radio" value="1" data-checked="{$_YW['c']['subsection']}" data-required="1">{$_YW['t']['yw022']}</label>
                    <label><input name="subsection" type="radio" value="0">{$_YW['t']['yw023']}</label>
                </div>
                <span class="tips">{$_YW['t']['yw038']}</span>
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
            <dt>{$_YW['t']['yw280']}</dt>
            <dd class="ftype_upload">
                <div class="fbox">
                    <input name="s_logo" data-upload-type="doupimg" class="text" value="{$_YW['c']['s_logo']}" type="text">
                </div>
                <span class="tips">{$_YW['t']['yw281']}</span>
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
            <dt>{$_YW['t']['yw282']}</dt>
            <dd class="ftype_input">
                <div class="fbox">
                    <input name="s_ctitle" value="{$_YW['c']['s_ctitle']}" type="text">
                </div>
                <span class="tips">{$_YW['t']['yw283']}</span>
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
        <h3 class="v52fmbx_hr">DIY CSS</h3>
        <dl>
            <dd class="ftype_textarea">
                <div class="fbox">
                    <textarea name="s_css" placeholder="DIY CSS" style="width: 100%; height:300px;">{$_YW['c']['s_css']}</textarea>
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