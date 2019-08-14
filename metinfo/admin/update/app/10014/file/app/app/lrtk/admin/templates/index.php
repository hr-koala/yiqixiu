<!--<?php
defined('IN_MET') or exit('No permission');
require $this->template('ui/head');
echo <<<EOT
-->
<form method="POST" class="ui-from" name="myform" action="{$_M['url']['own_form']}a=doeditorpz" target="_self">
    <div class="v52fmbx">
        <h3 class="v52fmbx_hr">{$_M['word']['yw_lrtk_cjpz']}<span class="tips"></span></h3>
        <dl>
            <dt>{$_M['word']['yw_lrtk_kg']}</dt>
            <dd class="ftype_transverse">
                <div class="fbox">
                    <label><input name="radio1" value="1" type="radio" data-checked="{$con['radio1']}">{$_M['word']['yw_lrtk_kga']}</label>
                    <label><input name="radio1" value="2" type="radio">{$_M['word']['yw_lrtk_kgb']}</label>
                </div>
                <span class="tips">{$_M['word']['yw_lrtk_kgsm']}</span>
            </dd>
        </dl>
        <h3 class="v52fmbx_hr">{$_M['word']['yw_lrtk_gnpz']}<span class="tips"></span></h3>
        <dl>
            <dt>{$_M['word']['yw_lrtk_gnxz']}</dt>
            <dd class="ftype_transverse">
		<div class="fbox">
                    <label><input name="checkbox" type="checkbox" value="0" data-showhide="radio_0" data-checked="{$con['checkbox']}">{$_M['word']['yw_lrtk_gnxza']}</label>
                    <label><input name="checkbox" type="checkbox" value="1" data-showhide="radio_1">{$_M['word']['yw_lrtk_gnxzb']}</label>
                    <label><input name="checkbox" type="checkbox" value="2" data-showhide="radio_2">{$_M['word']['yw_lrtk_gnxzc']}</label>
                    <label><input name="checkbox" type="checkbox" value="3" data-showhide="radio_3">{$_M['word']['yw_lrtk_gnxzd']}</label>
                    <label><input name="checkbox" type="checkbox" value="4" data-showhide="radio_4">{$_M['word']['yw_lrtk_gnxze']}</label>
                    <label><input name="checkbox" type="checkbox" value="5" data-showhide="radio_5">{$_M['word']['yw_lrtk_gnxzf']}</label>
		</div>
		<span class="tips">{$_M['word']['yw_lrtk_gnxzsm']}</span>
            </dd>
        </dl>
        <dl class="radio_1 none">
            <dt>{$_M['word']['yw_lrtk_gnxzb']}</dt>
            <dd class="ftype_input">
                <div class="fbox">
                    <input type="text" name="textjdn1" value="{$con['textjdn1']}" />
                </div>
                <span class="tips">{$_M['word']['yw_lrtk_gnxzbsm']}</span>
            </dd>
        </dl>
        <dl class="radio_2 none">
            <dt>{$_M['word']['yw_lrtk_gnxzc']}</dt>
            <dd class="ftype_upload" style="display: inline-block;   padding-right: 40px;">
		<div class="fbox">
                    <input 
                        name="textjdn2" 
                        type="text" 
                        data-upload-type="doupimg"
                        value="{$con['textjdn2']}" 
                    />
		</div>
                <span class="tips">{$_M['word']['yw_lrtk_gnxzcsm']}</span>        
            </dd>
            <dd class="ftype_input">
                <div class="fbox" style="overflow: hidden; clear: both;">
                    {$_M['word']['yw_lrtk_wxwzk']}&nbsp;<input type="text" name="wxwzk" value="{$con['wxwzk']}" style="width:35px">&nbsp;PX，&nbsp;&nbsp;&nbsp;&nbsp;
                    {$_M['word']['yw_lrtk_wxwzh']}&nbsp;<input type="text" name="wxwzh" value="{$con['wxwzh']}" style="width:35px">&nbsp;PX
                </div>
            </dd>
        </dl>
        <dl class="radio_3 none">
            <dt>{$_M['word']['yw_lrtk_gnxzd']}</dt>
            <dd class="ftype_input">
                <div class="fbox">
                    <input type="text" name="textjdn3" value="{$con['textjdn3']}" />
                </div>
                <span class="tips">{$_M['word']['yw_lrtk_gnxzdsm']}</span>
            </dd>
        </dl>
        <dl class="radio_4 none">
            <dt>{$_M['word']['yw_lrtk_gnxze']}</dt>
            <dd class="ftype_input">
                <div class="fbox">
                    <input type="text" name="textjdn4" value="{$con['textjdn4']}" />
                </div>
                <span class="tips">{$_M['word']['yw_lrtk_gnxzesm']}</span>
            </dd>
        </dl>
        <dl class="radio_5 none">
            <dt>{$_M['word']['yw_lrtk_gnxzf']}</dt>
            <dd class="ftype_input">
                <div class="fbox">
                    <input type="text" name="textjdn5" value="{$con['textjdn5']}" />
                </div>
                <span class="tips">{$_M['word']['yw_lrtk_gnxzesm']}</span>
            </dd>
        </dl>
        <h3 class="v52fmbx_hr">{$_M['word']['yw_lrtk_wzsz']}<span class="tips"></span></h3>
        <dl>
            <dt>{$_M['word']['yw_lrtk_xswz']}</dt>
            <dd class="ftype_input">
                <div class="fbox">
                    {$_M['word']['yw_lrtk_xswza']}&nbsp;<input type="text" name="bottom" value="{$con['bottom']}" style="width:35px">&nbsp;PX，&nbsp;&nbsp;&nbsp;&nbsp;
                    {$_M['word']['yw_lrtk_xswzb']}&nbsp;<input type="text" name="right" value="{$con['right']}" style="width:35px">&nbsp;PX
                </div>
                <span class="tips">{$_M['word']['yw_lrtk_xswzsm']}</span>
            </dd>
        </dl>
        <dl class="radio_2 none">
            <dt>{$_M['word']['yw_lrtk_wxwz']}</dt>
            <dd class="ftype_input">
                <div class="fbox" style="overflow: hidden; clear: both;">
                    {$_M['word']['yw_lrtk_xswza']}&nbsp;<input type="text" name="wxwz" value="{$con['wxwz']}" style="width:35px">&nbsp;PX，&nbsp;&nbsp;&nbsp;&nbsp;
                    {$_M['word']['yw_lrtk_xswzb']}&nbsp;<input type="text" name="wxwzz" value="{$con['wxwzz']}" style="width:35px">&nbsp;PX
                </div>
                <span class="tips">{$_M['word']['yw_lrtk_wxwzsm']}</span>
            </dd>
        </dl>
        <script src="{$url}js/jquery1.8.2.js" type="text/javascript"></script>
        <script src="{$url}js/jquery-list-dragsort.js" type="text/javascript"></script>
        <style type="text/css">
            .hymr{ line-height: 34px; padding: 0px 20px; display: block; border: 0 none;}
            .tuodong{clear: both; padding-bottom:10px;   overflow: hidden;}
            .dragsort{list-style-type:none;margin:0px;}
            .dragsort li{float:left;padding-right:15px; width:75px;height:75px;}
            .dragsort div{cursor: pointer; width:73px;height:73px;border:solid 1px #ddd; text-align:center;}
            .placeHolder div{background-color:white!important;border:dashed 1px gray!important;}
        </style>
        <dl>
            <dt>{$_M['word']['yw_lrtk_tbpx']}</dt>
            <dd>
                <div class="tuodong">
                    <ul data-listidx="0" class="dragsort" id="list1">
                        {$list}
                    </ul>
                    <input value="{$con['orderlist']}" name="orderlist" type="hidden" id="orderlist">
                    <script type="text/javascript">
                        $("#list1").dragsort({
                            dragSelector: "div", 
                            dragBetween: true, 
                            dragEnd: saveOrder, 
                            placeHolderTemplate: "<li class='placeHolder'><div></div></li>",
                            scrollSpeed: 5
                        });
                        function saveOrder() {
                            var new_order = [];
                            $("#list1 li").children("div").each(function() {
                                new_order.push(this.title);
                                //alert(this.title);
                            });
                            var newid = new_order.join(',');
                            $("#orderlist").val(newid);
                        };   
                </script>
                </div>
                <span class="tips clear" >{$_M['word']['yw_lrtk_tbpxsm']}</span>
            </dd>
        </dl>
        <dl class="noborder">
            <dt><a href="{$_M['url']['own_form']}a=doeditormrpz" class="hymr" data-confirm="{$_M['word']['yw_lrtk_hymrsm']}">{$_M['word']['yw_lrtk_hymr']}</a></dt>
            <dd>
                
                <input name="submit" value="{$_M['word']['yw_lrtk_submit']}" class="submit" type="submit">
            </dd>
        </dl>
    </div>
</form>
<!--
EOT;
require $this->template('ui/foot');
?>