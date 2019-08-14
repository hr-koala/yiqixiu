<!--<?php
defined('IN_MET') or exit('No permission');
require $this->template('ui/head');
echo <<<EOT
-->
<style>
.mapinputselect select.form-control{ margin-bottom:10px;}
a.modalmap{margin-top:10px;}
#allmap{width:600px; height:200px;}
.modal-body{height: 500px;overflow: hidden;margin:0;}
#allmap2{width:100%; height:100%;}
</style>
<form method="POST" class="ui-from" name="myform" action="{$this->action}" target="_self">
    <div class="v52fmbx">
        <dl>
            <dt>{$_YW['t']['yw001']}</dt>
            <dd class="ftype_input">
                <div class="fbox">
                    <input type="text" name="name" class="form-control" value="{$info['name']}" data-required="1">
                </div>
            </dd>
        </dl>
        {$html}
        <dl>
            <dt>{$_YW['t']['yw002']}</dt>
            <dd class="ftype_input  mapinputselect">
                <div class="fbox">
                    <div class="form-inline">
                        <select name="select1" class="prov form-control" data-required="1" data-checked="{$info['province']}"></select>  
                        <select name="select2" class="city form-control" data-required="1" data-checked="{$info['city']}"></select>
                        <select name="select3" class="dist form-control" data-required="1" data-checked="{$info['district']}"></select>
                    </div>
                    <input type="text" name="address" value="{$info['address']}" placeholder="{$_YW['t']['yw002']}" data-required="1" class="form-control">
                </div>
            </dd>
        </dl>
        <dl>
            <dt>{$_YW['t']['yw012']}</dt>
            <dd>  
                <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak={$_YW['c']['apikey']}"></script>
                <div id="allmap"></div>
                <a readonly="readonly" class="btn btn-primary btn-sm modalmap" data-toggle="modal" data-target="#myModal">{$_YW['t']['yw013']}</a>
            </dd>
        </dl>
        <dl>
            <dt>{$_YW['t']['yw014']}</dt>
            <dd class="ftype_input">
                <div class="fbox">
                    <input type="text" name="lnglat" value="{$info['lnglat']}" data-required="1" class="form-control" data-toggle="modal" data-target="#myModal" readonly="readonly">
                </div>
                <span class="tips">{$_YW['t']['yw015']}</span>
            </dd>
        </dl>
        <dl>
            <dt>{$_YW['t']['yw003']}</dt>
            <dd class="ftype_input">
                <div class="fbox">
                    <input type="text" name="region" class="form-control" value="{$info['region']}" data-required="1">
                </div>
            </dd>
        </dl>
        <dl>
            <dt>{$_YW['t']['yw043']}</dt>
            <dd class="ftype_input">
                <div class="fbox">
                    <input type="text" name="tel" class="form-control" value="{$info['tel']}" data-mobile="1">
                </div>
                <span class="tips">{$_YW['t']['yw044']}</span>
            </dd>
        </dl>
        <dl>
            <dt>{$_YW['t']['yw065']}</dt>
            <dd class="ftype_input">
                <div class="fbox">
                    <input type="text" name="fixedtel" class="form-control" value="{$info['fixedtel']}" >
                </div>
                <span class="tips">{$_YW['t']['yw044']}</span>
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
                    
                    
                    
                    
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" infoid="{$info['id']}">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel"></h4>
      </div>
      <div class="modal-body"><div id="allmap2"></div></div>
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