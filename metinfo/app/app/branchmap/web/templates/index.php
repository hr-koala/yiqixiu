<!--<?php
defined('IN_MET') or exit('No permission');
$container  = array(
    'container',
    'container-fluid',
    is_number($_YW['c']['maxwidth']) && $_YW['c']['maxwidth'] <= 1170 ?'container':'container-fluid'
);
echo <<<EOT
-->
<div class="yunwang-metinfo">
    <div class="yunbranchmap {$container[$_YW['c']['radio']]}" data-url="{$_M['url']['site']}" data-m_name="{$this->m_name}" data-tems="{$_M['url']['own']}">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-heading ftype_select-linkage">
                    <div class="fbox form-inline mapinputselect">
<!--
EOT;
if($_YW['c']['typeon']) {
foreach (stringto_array($_YW['c']['type'],'|') as $val) {
    $option[]   = '<option value="'.$val.'">'.$val.'</option>';
}
$hop    = arrayto_string($option,'');
echo <<<EOT
-->
            <label class="control-label">{$_YW['t']['yw063']}：</label>
            <select name="type" class="type form-control">
                <option value="">{$_YW['t']['yw009']}</option>
                {$hop}
            </select>
<!--
EOT;
}
echo <<<EOT
-->
                        <label class="control-label">{$_YW['t']['yw036']}：</label>
                        <select name="select1" class="prov form-control"></select>  
                        <select name="select2" class="city form-control"></select>
                        <select name="select3" class="dist form-control"></select>
                        {$num}
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-4 col-sm-12 namelist">
                        <div class="listgroup">
                            <div class="list-group">
                                {$info}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 col-sm-12">
                        <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak={$_YW['c']['apikey']}"></script>
                        <div id="allmap" name="allmap" class="panel panel-default" ></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--
EOT;
?>