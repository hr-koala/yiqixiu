<!--<?php
# MetInfo Enterprise Content Management System 
# Copyright (C) MetInfo Co.,Ltd (http://www.metinfo.cn). All rights reserved. 

defined('IN_MET') or exit('No permission');
$pearl[1] = 'current';
$pearl[2] = 'current';
$pearl[3] = 'current';
$pearl[4] = 'current';//disabled
if($order['state']==1){
	$pearl[4] = 'disabled';
	$pearl[3] = 'disabled';
	$pearl[2] = 'disabled';
}
if($order['state']==2){
	$pearl[4] = 'disabled';
	$pearl[3] = 'disabled';
}
if($order['state']==3){
	$pearl[4] = 'disabled';
}
echo <<<EOT
-->
<header class="slidePanel-header overlay metshop_oder_header {$hbg}">
	<button type="button" class="btn btn-pure slidePanel-close icon wb-close metshop_oder_close" aria-hidden="true"></button>
<!--
EOT;
if($order['state']>0){
echo <<<EOT
-->	
	<div class="pearls row">
		<div class="pearl {$pearl[1]} col-xs-3">
			<div class="pearl-icon"><i class="icon wb-clipboard" aria-hidden="true"></i></div>
			<span class="pearl-title">下单<p>{$order['rtime_str']}</p></span>
		</div>
		<div class="pearl {$pearl[2]} col-xs-3">
			<div class="pearl-icon"><i class="icon wb-payment" aria-hidden="true"></i></div>
			<span class="pearl-title">付款<p>{$order['ptime_str']}</p></span>
		</div>
		<div class="pearl {$pearl[3]} col-xs-3">
			<div class="pearl-icon"><i class="icon wb-map" aria-hidden="true"></i></div>
			<span class="pearl-title">发货<p>{$order['stime_str']}</p></span>
		</div>
		<div class="pearl {$pearl[4]} col-xs-3">
			<div class="pearl-icon"><i class="icon wb-check" aria-hidden="true"></i></div>
			<span class="pearl-title">完成</span>
		</div>
	</div>
<!--
EOT;
}else{
echo <<<EOT
-->	
		<h1 class="text-center">{$order['state_txt']}</h1>
<!--
EOT;
}
echo <<<EOT
-->	
</header>
<div class="page metshop_oder_page">
	<div class="page-content">
		<div class="panel">
			<div class="panel-body container-fluid">
<!--
EOT;
if($order['state']==3){
$wuliuinfo = $order['cinfo']?"{$order['cinfo']} {$order['oinfo']}":'无需物流';
echo <<<EOT
-->
				<div class="row text-success padding-bottom-10">
					<div class="col-md-2">物流信息 : </div>
					<div class="col-md-10">
						{$wuliuinfo}
					</div>
				</div>	
				<hr />
<!--
EOT;
}
echo <<<EOT
-->
				<div class="row padding-bottom-10">
					<div class="col-md-2">订单编号 : </div>
					<div class="col-md-10">{$order['orderid']}</div>
				</div>
				<div class="row padding-bottom-10">
					<div class="col-md-2">付款方式 : </div>
					<div class="col-md-10">{$order['paytype_str']}</div>
				</div>
				<div class="row padding-bottom-10">
					<div class="col-md-2">买家 : </div>
					<div class="col-md-10">{$order['username']}</div>
				</div>
				<hr />
				<div class="row padding-bottom-10">
					<div class="col-md-2">配送方式 : </div>
					<div class="col-md-10">快递配送</div>
				</div>
				<div class="row padding-bottom-10">
					<div class="col-md-2">收货信息 : </div>
					<div class="col-md-10">{$order['address_str']}</div>
				</div>
<!--
EOT;
if($order['invoice']){
echo <<<EOT
-->
				<div class="row padding-bottom-10">
					<div class="col-md-2">发票信息 : </div>
					<div class="col-md-10">{$order[invoice_info][0]} {$order['invoice_info'][1]} {$order['invoice_info'][2]}</div>
				</div>
<!--
EOT;
}
echo <<<EOT
-->
				<hr />
				<div class="row padding-bottom-10">
					<div class="col-md-2">买家留言 : </div>
					<div class="col-md-10">{$order['message']}</div>
				</div>	
				<div class="row">
					<div class="col-md-2">商家备注 : </div>
					<div class="col-md-10">
						<span id="edit_remark" data-url="{$_M[url][own_form]}a=doeditorsave_remark&id={$order['id']}" data-rows="3">{$order['remark']}</span>
						<button type="button" class="btn btn-floating btn-success btn-xs" id="edit_remark_btn"><i class="icon wb-pencil" aria-hidden="true"></i></button>
					</div>
				</div>	
<!--
EOT;
if($order['countdown']&&$order['state']==1){
echo <<<EOT
-->
				<hr class="margin-top-20" />
				<div class="row">
					<div class="col-md-12">该订单将在 <span class="red-600">{$order['countdown']}</span> 后自动关闭</div>
				</div>			
<!--
EOT;
}
echo <<<EOT
-->
			</div>
		</div>
		<div class="panel">
			<div class="panel-body container-fluid">
				<div class="table-responsive">
					<table class="table table-striped margin-bottom-0">
                    <thead>
                      <tr>
                        <th width="300">商品名称</th>
                        <th class="text-center">单价</th>
                        <th class="text-center">数量</th>
                        <th class="text-center">运费</th>
                        <th class="text-center">小计</th>
                      </tr>
                    </thead>
                    <tbody>
<!--
EOT;
foreach($goods as $key=>$val){
echo <<<EOT
-->						
						<tr>
							<td>
								<div class="media">
									<div class="media-left">
									  <a target="_blank" href="{$val['url']}" title="查看商品详情">
										<img src="{$val['img']}" class="media-object" />
									  </a>
									</div>
									<div class="media-body">
									  <h4 class="media-heading">
										<a target="_blank" href="{$val['url']}" title="查看商品详情">{$val['pname']}</a>
									  </h4>
									  <div>{$val['para']} {$val['message']}</div>
									</div>
								</div>
							</td>
							<td class="text-center">{$val['puprice']}</td>
							<td class="text-center">{$val['pamount']}</td>
							<td class="text-center">{$val['freight']}</td>
							<td class="text-center">{$val['price']}</td>
						</tr>

<!--
EOT;
}
echo <<<EOT
-->
                    </tbody>
                  </table>
				</div>
			</div>
		</div>
		<div class="panel">
			<div class="panel-body container-fluid">
				<div class="table-responsive">
					<table class="table table-striped margin-bottom-0">
						<thead>
							<tr>
								<th class="text-center">订单金额</th>
								<th class="text-center"></th>
								<th class="text-center">运费</th>
								<th class="text-center"></th>
								<th class="text-center">优惠</th>
								<th class="text-center"></th>
								<th class="text-center">涨价/减免</th>
								<th class="text-center"></th>
								<th class="text-center">实付金额</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="text-center"><span class="label label-default">{$order['price_str']}</span></td>
								<td class="text-center">+</td>
								<td class="text-center"><span class="label label-default">{$order['freight_str']}</span></td>
								<td class="text-center">+</td>
								<td class="text-center"><span class="label label-default">{$order['discount_str']}{$order['discount_info']}</span></td>
								<td class="text-center">+</td>
								<td class="text-center"><span class="label label-default"><span id="edit_price" data-url="{$_M[url][own_form]}a=doeditorsave_price&id={$order['id']}">{$order['cprice_str']}</span></span></td>
								<td class="text-center">=</td>
								<td class="text-center"><span class="label label-default">{$order['tprice_str']}</span></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
<!--
EOT;
if($order['state']==2){
echo <<<EOT
-->
		<div class="panel">
			<div class="panel-body container-fluid">
			<form action="{$_M[url][own_form]}a=doeditorsave_send&id={$order['id']}" id="edit_send">
				<div class="form-group">
					<div>
						<div class="radio-custom radio-primary radio-inline">
							<input type="radio" id="inputBasicMale" name="is_wuliu" value="1" {$d_user_c[1]}>
							<label for="inputBasicMale">需要物流</label>
						</div>
						<div class="radio-custom radio-primary radio-inline">
							<input type="radio" id="inputBasicFemale" name="is_wuliu" value="0" {$d_user_c[0]}>
							<label for="inputBasicFemale">无需物流</label>
						</div>
					</div>
				</div>
				<div class="collapse" id="send-info-body">
				<div class="well margin-bottom-20">
				<div class="form-group">
					<label class="control-label">收货地址</label>
					<div>{$order['address_str']}</div>
				</div>
				<div class="form-group">
					<label class="control-label">物流公司</label>
					  <select class="form-control" data-plugin="select2" name="cinfo" data-fv-notempty="true" data-placeholder="{$order['cinfo_str']}">
						<option></option>
						<optgroup label="常用">
							<option value="顺丰速运">顺丰速运</option>
							<option value="申通快递">申通快递</option>
							<option value="圆通快递">圆通快递</option>
							<option value="韵达速运">韵达速运</option>
							<option value="EMS快递">EMS快递</option>
							<option value="中通快递">中通快递</option>
							<option value="汇通快递">汇通快递</option>
							<option value="天天快递">天天快递</option>
							<option value="宅急送快递">宅急送快递</option>
							<option value="全峰快递">全峰快递</option>
							<option value="德邦快递">德邦快递</option>
							<option value="中国邮政">中国邮政</option>
						</optgroup>
						<optgroup label="A">
							<option value="AAE快递">AAE快递</option>
							<option value="安信达快递">安信达快递</option>
							<option value="安捷快递">安捷快递</option>
							<option value="Aramex">Aramex</option>
							<option value="爱彼西快递">爱彼西快递</option>
							<option value="安迅物流">安迅物流</option>
							<option value="安得物流">安得物流</option>
							<option value="AOL快递">AOL快递</option>
						</optgroup>
						<optgroup label="B">
							<option value="百福东方快递">百福东方快递</option>
							<option value="宝通达物流">宝通达物流</option>
							<option value="百千诚国际物流">百千诚国际物流</option>
							<option value="贝邮宝">贝邮宝</option>
						</optgroup>
						<optgroup label="C">
							<option value="程光快递">程光快递</option>
							<option value="长通物流">长通物流</option>
							<option value="传喜快递">传喜快递</option>
							<option value="传志快递">传志快递</option><option value="COE快递">COE快递</option>
							<option value="CCES快递">CCES快递</option>
							<option value="城市之星">城市之星</option>
							<option value="城市100快递">城市100快递</option>
							<option value="成都立即送快递">成都立即送快递</option>
							<option value="出口易">出口易</option>

						</optgroup>
						<optgroup label="D">
							<option value="DHL快递">DHL快递</option>
							<option value="D速快递">D速快递</option>
							<option value="大田物流">大田物流</option>
							<option value="DPEX快递">DPEX快递</option>
							<option value="递四方物流">递四方物流</option>
							<option value="东方快递">东方快递</option>
							<option value="大洋物流快递">大洋物流快递</option>
							<option value="递达快递">递达快递</option>
							<option value="店通快递">店通快递</option>
							<option value="大金物流">大金物流</option>
							<option value="大达物流">大达物流</option>
							<option value="大顺物流">大顺物流</option>
						</optgroup>
						<optgroup label="E">
							<option value="EMS">EMS</option>
							<option value="EES">EES</option>
							<option value="E邮宝">E邮宝</option>
						</optgroup>
						<optgroup label="F">
							<option value="Fedex(国际)">Fedex(国际)</option>
							<option value="Fedex(国内)">Fedex(国内)</option>
							<option value="飞康达快递">飞康达快递</option>
							<option value="丰达快递">丰达快递</option>
							<option value="飞豹快递">飞豹快递</option>
							<option value="飞邦物流">飞邦物流</option>
							<option value="飞远物流">飞远物流</option>
							<option value="飞狐快递">飞狐快递</option>
							<option value="凡宇快递">凡宇快递</option>
							<option value="飞特物流">飞特物流</option>
							<option value="飞洋快递">飞洋快递</option>
							<option value="方方达物流">方方达物流</option>
						</optgroup>
						<optgroup label="G">
							<option value="国通快递">国通快递</option>
							<option value="港中能达快递">港中能达快递</option>
							<option value="挂号信">挂号信</option>
							<option value="共速达物流">共速达物流</option>
							<option value="港快速递">港快速递</option>
						</optgroup>
						<optgroup label="H">
							<option value="华宇物流">华宇物流</option>
							<option value="华诚物流">华诚物流</option>
							<option value="汇强快递">汇强快递</option>
							<option value="华企快递">华企快递</option>
							<option value="河北建华物流">河北建华物流</option>
							<option value="昊盛物流">昊盛物流</option>
							<option value="华夏龙物流">华夏龙物流</option>
							<option value="海盟速递">海盟速递</option>
							<option value="华翰物流">华翰物流</option>
							<option value="海尔日日顺物流">海尔日日顺物流</option>
							<option value="恒宇运通">恒宇运通</option>
							<option value="华航快递">华航快递</option>
							<option value="好来运快递">好来运快递</option>
							<option value="合众速递">合众速递</option>
						</optgroup>
						<optgroup label="J">
							<option value="佳怡物流">佳怡物流</option>
							<option value="加运美物流">加运美物流</option>
							<option value="佳吉物流">佳吉物流</option>
							<option value="晋越快递">晋越快递</option>
							<option value="嘉里大通">嘉里大通</option>
							<option value="京广速递">京广速递</option>
							<option value="急先达物流">急先达物流</option>
							<option value="京东快递">京东快递</option>
							<option value="佳惠尔快递">佳惠尔快递</option>
							<option value="久易快递">久易快递</option>
							<option value="捷特快递">捷特快递</option>
							<option value="京世物流">京世物流</option>
						</optgroup>
						<optgroup label="K">
							<option value="快捷快递">快捷快递</option>
							<option value="KKE快递">KKE快递</option>
							<option value="跨越快递">跨越快递</option>
							<option value="宽容物流">宽容物流</option>
							<option value="快淘快递">快淘快递</option>
						</optgroup>
						<optgroup label="L">
							<option value="乐捷递">乐捷递</option>
							<option value="龙邦物流">龙邦物流</option>
							<option value="联昊通快递">联昊通快递</option>
							<option value="蓝镖快递">蓝镖快递</option>
							<option value="立即送快递">立即送快递</option>
						</optgroup>
						<optgroup label="M">
							<option value="民航快递">民航快递</option>
							<option value="明亮物流">明亮物流</option>
							<option value="民邦速递">民邦速递</option>
							<option value="闽盛物流">闽盛物流</option>
							<option value="蒙速快递">蒙速快递</option>
						</optgroup>
						<optgroup label="N">
							<option value="能达快递">能达快递</option>
							<option value="尼尔快递">尼尔快递</option>
							<option value="南北快递">南北快递</option>
						</optgroup>
						<optgroup label="O">
							<option value="OCS国际快递">OCS国际快递</option>
						</optgroup>
						<optgroup label="P">
							<option value="平邮包裹">平邮包裹</option>
							<option value="平安达快递">平安达快递</option>
							<option value="陪行物流">陪行物流</option>
						</optgroup>
						<optgroup label="Q">
							<option value="全晨快递">全晨快递</option>
							<option value="全际通快递">全际通快递</option>
							<option value="全日通快递">全日通快递</option>
							<option value="全一快递">全一快递</option>
						</optgroup>
						<optgroup label="R">
							<option value="如风达快递">如风达快递</option>
							<option value="RPX保时达">RPX保时达</option>
							<option value="日日顺物流">日日顺物流</option>
							<option value="瑞丰速递">瑞丰速递</option>
							<option value="日本邮政">日本邮政</option>
							<option value="日昱物流">日昱物流</option>
							<option value="荣庆物流">荣庆物流</option>
						</optgroup>
						<optgroup label="S">
							<option value="速尔快递">速尔快递</option>
							<option value="盛丰物流">盛丰物流</option>
							<option value="盛辉物流">盛辉物流</option>
							<option value="三态速递">三态速递</option>
							<option value="申通E物流">申通E物流</option>
							<option value="SCS快递">SCS快递</option>
							<option value="穗佳物流">穗佳物流</option>
							<option value="赛澳递">赛澳递</option>
							<option value="圣安物流">圣安物流</option>
							<option value="山东海红快递">山东海红快递</option>
							<option value="速通物流">速通物流</option>
							<option value="思迈快递">思迈快递</option>
							<option value="速腾快递">速腾快递</option>
							<option value="晟邦物流">晟邦物流</option>
							<option value="速呈宅配">速呈宅配</option>
						</optgroup>
						<optgroup label="T">
							<option value="天地华宇物流">天地华宇物流</option>
							<option value="TNT快递">TNT快递</option>
							<option value="通成物流">通成物流</option>
							<option value="通和天下物流">通和天下物流</option>
						</optgroup>
						<optgroup label="U">
							<option value="UPS快递">UPS快递</option>
							<option value="USPS快递">USPS快递</option>
						</optgroup>
						<optgroup label="W">
							<option value="万家物流">万家物流</option>
							<option value="万象物流">万象物流</option>
							<option value="伟邦快递">伟邦快递</option>
							<option value="万博快递">万博快递</option>
							<option value="五环速递">五环速递</option>
						</optgroup>
						<optgroup label="X">
							<option value="信丰快递">信丰快递</option>
							<option value="新邦物流">新邦物流</option>
							<option value="小包">小包</option>
							<option value="星程宅配">星程宅配</option>
							<option value="新加坡邮政">新加坡邮政</option>
							<option value="香港邮政">香港邮政</option>
						</optgroup>
						<optgroup label="Y">
							<option value="优速快递">优速快递</option>
							<option value="一邦快递">一邦快递</option>
							<option value="源伟丰快递">源伟丰快递</option>
							<option value="原飞航快递">原飞航快递</option>
							<option value="元智捷诚快递">元智捷诚快递</option>
							<option value="亚风快递">亚风快递</option>
							<option value="远成物流">远成物流</option>
							<option value="越丰快递">越丰快递</option>
							<option value="一统飞鸿快递">一统飞鸿快递</option>
							<option value="源安达快递">源安达快递</option>
							<option value="银捷快递">银捷快递</option>
							<option value="邮政小包">邮政小包</option>
							<option value="誉美捷快递">誉美捷快递</option>
							<option value="音素快递">音素快递</option>
							<option value="音速快递">音速快递</option>
							<option value="燕文物流">燕文物流</option>
						</optgroup>
						<optgroup label="Z">
							<option value="中邮物流">中邮物流</option>
							<option value="中铁快运">中铁快运</option>
							<option value="中信达快递">中信达快递</option>
							<option value="芝麻开门">芝麻开门</option>
							<option value="中天快运">中天快运</option>
							<option value="增益快递">增益快递</option>
							<option value="佐川急便">佐川急便</option>
							<option value="纵行物流">纵行物流</option>
						</optgroup>
					  </select>
					  
				</div>
				<div class="form-group">
					<label class="control-label">物流单号</label>
					<input type="text" class="form-control" id="danhao" name="oinfo" data-fv-notempty="true" placeholder="物流单号" autocomplete="off">
				</div>
				</div>
				</div>
				<div class="form-group">
					<button type="submit" id="edit_send_submit" class="btn btn-primary">发货</button>
				</div>
			</form>
			</div>
		</div>
<!--
EOT;
}
echo <<<EOT
-->
		<div class="text-center metshop_oder_page_btn" data-gourl="{$_M['url']['own_form']}&a=docheck&id={$order[id]}">
<!--
EOT;
if($order['state']==1){
echo <<<EOT
-->
			<button type="button" class="btn btn-primary" id="edit_price_btn">修改价格</button>
<!--
EOT;
}
echo <<<EOT
-->
<!--
EOT;
if($order['state']==1||$order['state']<0){
echo <<<EOT
-->
			<button type="button" class="btn btn-danger" id="edit_close_btn" data-url="{$_M['url']['own_form']}a=doeditor_close&id={$order[id]}">关闭订单</button>
<!--
EOT;
}
echo <<<EOT
-->
<!--
EOT;
if($order['state']==3){
echo <<<EOT
-->
			<button type="button" class="btn btn-success" id="complete_btn" data-url="{$_M['url']['own_form']}a=docomplete_order&id={$order[id]}">订单完成</button>
<!--
EOT;
}
echo <<<EOT
-->
		</div>
	</div>
</div>
<!--
EOT;
# This program is an open source system, commercial use, please consciously to purchase commercial license.
# Copyright (C) MetInfo Co., Ltd. (http://www.metinfo.cn). All rights reserved.
?>-->