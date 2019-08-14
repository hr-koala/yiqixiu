<!--<?php
defined('IN_MET') or exit('No permission');
require $this->template('ui/head');
echo <<<EOT
-->
<style>
    body{background: #f7f7f7;}
    /*导航条*/
    .stat_list{background: #f7f7f7; width: 100%;}
    .yun{display: none;}
</style>
<div class="v52fmbx addup yun">
    <div class="container-fluid">
        <div class="row statistic">
            <div class="col-md-3 col-sm-3">
                <div class="panel panel-info area arec">
                    <div class="panel-heading">
                        <h3 class="panel-title">{$_YW['t']['yw191']}</h3>
                    </div>
                    <div class="panel-body">
                        <p>{$_YW['t']['yw192']}：<a href="{$_M['url']['own_name']}c=table_on&a=dorecord"><span>{$addup['record']}</span></a></p>
                        <!--<p>{$_YW['t']['yw194']}：<span>{$addup['month']}</span></p>-->
                        <p>{$_YW['t']['yw193']}：<span>{$addup['day']}</span></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-3">
                <div class="panel panel-info area arec">
                    <div class="panel-heading">
                        <h3 class="panel-title">{$_YW['t']['yw195']}</h3>
                    </div>
                    <div class="panel-body">
                        <p>{$_YW['t']['yw196']}：<span>{$addup['code']}</span></p>
                        <!--<p>{$_YW['t']['yw197']}：<span>{$addup['codea']}</span></p>-->
                        <p>{$_YW['t']['yw198']}：<span>{$addup['codeb']}</span></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-3">
                <div class="panel panel-info area arec">
                    <div class="panel-heading">
                        <h3 class="panel-title">{$_YW['t']['yw199']}</h3>
                    </div>
                    <div class="panel-body">
                        <p>{$_YW['t']['yw200']}：<span>{$addup['info']}</span></p>
                        <p>{$_YW['t']['yw201']}：<span>{$addup['infoa']}</span></p>
                        <!--<p>{$_YW['t']['yw197']}：<span>{$addup['infob']}</span></p>-->
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-3">
                <div class="panel panel-info area arec">
                    <div class="panel-heading">
                        <h3 class="panel-title">{$_YW['t']['yw202']}</h3>
                    </div>
                    <div class="panel-body">
                        <p>{$_YW['t']['yw014']}：<span>{$addup['codea']}</span></p>
                        <p>{$_YW['t']['yw200']}：<span>{$addup['infob']}</span></p>
                    </div>
                </div>
            </div>


            <div class="col-md-12 col-sm-12" style="margin-top:10px;">
                <div class="panel panel-danger  area areb">
                    <div class="panel-heading">

                        <div class="btn-group">
                            <button type="button" class="btn btn-group-xs btn-info btn-danger" data-button-addup="date" >{$_YW['t']['yw203']}</button>
                        </div>
                        <div class="btn-group" >
                            <button type="button" class="btn btn-group-xs btn-info" data-button-addup="week">{$_YW['t']['yw204']}</button>
                        </div>
                        <div class="btn-group" >
                            <button type="button" class="btn btn-group-xs btn-info" data-button-addup="day">{$_YW['t']['yw205']}</button>
                        </div>


                    </div>
                    <div class="panel-body" id="addup" style="height:400px;">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{$_M[url][own] }admin/templates/js/echarts.min.js"></script>
<!--
EOT;
require $this->template('ui/foot');
?>