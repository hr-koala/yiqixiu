<!--<?php
defined('IN_MET') or exit('No permission');
require $this->template('ui/head');
echo <<<EOT
-->
<form method="POST" class="ui-from" name="myform" action="{$_M['url']['own_form']}a=doconfig" target="_self">
    <div class="v52fmbx">
        <h3 class="v52fmbx_hr">{$_YW['t']['yw019']}</h3>
        <dl>
            <dt>{$_YW['t']['yw020']}</dt>
            <dd class="ftype_input">
                <div class="fbox">
                    <input type="text" name="apikey" value="{$_YW['c']['apikey']}" data-required="1" class="form-control">
                </div>
                <span class="tips">{$_YW['t']['yw021']}：<a href="http://lbsyun.baidu.com/apiconsole/key" target="_blank">http://lbsyun.baidu.com/apiconsole/key</a></span>
            </dd>
        </dl>
        <dl class="city">
            <dt>{$_YW['t']['yw022']}</dt>
            <dd class="ftype_input">
                <div class="fbox">
                    <input type="text" name="city" value="{$_YW['c']['city']}" data-required="1" class="form-control">
                </div>
                <span class="tips">{$_YW['t']['yw023']}</span>
            </dd>
        </dl>
        <dl>
            <dt>{$_YW['t']['yw060']}</dt>
            <dd class="ftype_radio ftype_transverse">
                <div class="fbox">
                    <label><input name="typeon" type="radio" value="1" data-required="1"data-showhide="typeon_0" data-checked="{$_YW['c']['typeon']}">{$_YW['t']['yw061']}</label>
                    <label><input name="typeon" type="radio" value="0">{$_YW['t']['yw062']}</label>
                </div>
            </dd>
        </dl>
        <dl class="typeon_0 none">
            <dt>{$_YW['t']['yw063']}</dt>
            <dd class="ftype_tags">
                <div class="fbox">
                    <input name="type" type="hidden" data-label="|" value="{$_YW['c']['type']}">
                </div>
                <span class="tips">{$_YW['t']['yw064']}</span>
            </dd>
        </dl>
        <h3 class="v52fmbx_hr">{$_YW['t']['yw024']}</h3>
        <dl>
            <dt>{$_YW['t']['yw025']}</dt>
            <dd class="ftype_radio ftype_transverse">
                <div class="fbox">
                    <label><input name="radio" type="radio" value="0" data-checked="{$_YW['c']['radio']}">{$_YW['t']['yw026']}</label>
                    <label><input name="radio" type="radio" value="1">{$_YW['t']['yw027']}</label>
                    <label><input name="radio" type="radio" value="2" data-showhide="radio_1">{$_YW['t']['yw028']}</label>
                </div>
            </dd>
        </dl>
        <dl class="radio_1 none">
            <dt>{$_YW['t']['yw028']}</dt>
            <dd class="ftype_input">
                <div class="fbox">
                    <input name="maxwidth" value="{$_YW['c']['maxwidth']}" type="text" class="form-control">
                </div>
                <span class="tips">{$_YW['t']['yw029']}</span>
            </dd>
        </dl>
        <dl>
            <dt>{$_YW['t']['yw045']}</dt>
            <dd class="ftype_radio ftype_transverse">
                <div class="fbox">
                    <label><input name="state" type="radio" value="0" data-checked="{$_YW['c']['state']}" data-required="1" data-showhide="state_0">{$_YW['t']['yw046']}</label>
                    <label><input name="state" type="radio" value="1" data-showhide="state_1">{$_YW['t']['yw003']}</label>
                    <label><input name="state" type="radio" value="2" data-showhide="state_2">{$_YW['t']['yw047']}</label>
                </div>
            </dd>
        </dl>
        <h3 class="v52fmbx_hr state_0 none">{$_YW['t']['yw030']}<span class="tips">{$_YW['t']['yw031']}</span></h3>
        <dl class="state_0 none">
            <dd class="ftype_ckeditor">
                <div class="fbox">
                    <textarea name="webtext1">{$_YW['c']['webtext1']}</textarea>
                </div>
                
            </dd>
        </dl>
        <dl class="state_1 none">
            <dt>{$_YW['t']['yw003']}</dt>
            <dd class="configftype_select">
                <div class="fbox form-inline">
                    <select name="select1" class="prov form-control" data-checked="{$_YW['c']['select1']}"></select>  
                    <select name="select2" class="city form-control" data-checked="{$_YW['c']['select2']}"></select>
                    <select name="select3" class="dist form-control" data-checked="{$_YW['c']['select3']}"></select>
                </div>
            </dd>
        </dl>
        <dl class="state_2 none">
            <dt>{$_YW['t']['yw048']}</dt>
            <dd class="ftype_input">
                <div class="fbox">
                    <input name="corporatename" value="{$_YW['c']['corporatename']}" type="text" class="form-control">
                </div>
            </dd>
        </dl>
        <dl class="state_2 none">
            <dt>{$_YW['t']['yw047']}</dt>
            <dd class="configcity">
                <div class="fbox form-inline">
                    <select name="city1" class="prov form-control" data-checked="{$_YW['c']['city1']}"></select>  
                    <select name="city2" class="city form-control" data-checked="{$_YW['c']['city2']}"></select>
                    <select name="city3" class="dist form-control" data-checked="{$_YW['c']['city3']}"></select>
                    <input type="text" name="city4" value="{$_YW['c']['city4']}" placeholder="{$_YW['t']['yw002']}" class="form-control">
                </div>
            </dd>
        </dl>
        <dl class="state_2 none">
            <dt>{$_YW['t']['yw049']}</dt>
            <dd class="ftype_input">
                <div class="fbox">
                    <input type="text" name="lnglat" value="{$_YW['c']['lnglat']}" class="form-control" data-toggle="modal" data-target="#myModal" readonly="readonly">
                </div>
                <span class="tips">{$_YW['t']['yw050']}</span>
            </dd>
        </dl>
        <dl class="state_2 none">
            <dt>{$_YW['t']['yw051']}</dt>
            <dd class="ftype_textarea">
                <div class="fbox">
                    <textarea name="about" class="form-control" placeholder="{$_YW['t']['yw052']}">{$_YW['c']['about']}</textarea>
                </div>
            </dd>
        </dl>        
        <h3 class="v52fmbx_hr">{$_YW['t']['yw030']}<span class="tips">{$_YW['t']['yw032']}</span></h3>
        <dl>
            <dd class="ftype_ckeditor">
                <div class="fbox">
                    <textarea name="webtext2">{$_YW['c']['webtext2']}</textarea>
                </div>
            </dd>
        </dl>
        <h3 class="v52fmbx_hr">DIY CSS</h3>
        <dl>
            <dd class="ftype_textarea">
                <div class="fbox">
                    <textarea name="diycss" placeholder="DIY CSS" class="form-control" style="width: 99%; height:300px;">{$_YW['c']['diycss']}</textarea>
                </div>
                <span class="tips">{$_YW['t']['yw033']}</span>
            </dd>
        </dl>
        <dl class="noborder">
                <dt> </dt>
                <dd>
                    <input type="submit" name="submit" value="{$_YW['t']['yw016']}" class="submit">
                </dd>
        </dl>
    </div>
</form>
                    
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" id="myModalLabel"></h4>
        </div>
        <div class="modal-body">
            <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak={$_YW['c']['apikey']}"></script>
            <div id="allmap3" style="width:100%; height:500px; "></div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">{$_YW['t']['yw017']}</button>
            <button type="button" class="btn btn-primary button">{$_YW['t']['yw018']}</button>
        </div>
    </div>
  </div>
</div>
<!--
EOT;
require $this->template('ui/foot');
?>