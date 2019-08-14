<?php
defined('IN_MET') or exit('No permission'); $select1=''; $lang_column=array(); foreach ($column_list[1] as $colid=>$colval){ $colval['lang']=strtolower($colval['lang']); $lang_column[$colval['lang']][$colval['id']]=$colval; } foreach ($_M['langlist']['web'] as $lang){ $langname=strtolower($lang['lang']); if($lang_column[$langname]){ $select1.='<optgroup label="'.$lang['name'].'">'; foreach ($lang_column[$langname] as $colval){ $select1.="<option value='{$colval[id]}'>{$colval['name']}</option>"; } $select1.='</optgroup>'; } } foreach ($column_list[2] as $bigclass=>$cols){ foreach ($cols as $colid=>$colval){ $column_list[2][$bigclass][$colid]=$colval['name']; } } foreach ($column_list[3] as $bigclass=>$cols){ foreach ($cols as $colid=>$colval){ $column_list[3][$bigclass][$colid]=$colval['name']; } } $column_list2=json_encode($column_list[2]); $column_list3=json_encode($column_list[3]); echo <<<EOF
-->

<script type="text/javascript">

function show_column(parentid,level){

	if(level==2){
		var arr=JSON.parse('{$column_list2}');
		var option0='二级文章栏目';
		var sltid='#selectcolumn2';
		$('#selectcolumn2').empty();
		$('#selectcolumn2').hide();
		$('#selectcolumn3').empty();
		$('#selectcolumn3').hide();
	}else if(level==3){
		var arr=JSON.parse('{$column_list3}');
		var option0='三级文章栏目';
		var sltid='#selectcolumn3';
		$('#selectcolumn3').empty();
		$('#selectcolumn3').hide();
	}
	
	
	
	if(arr&&typeof(arr[parentid])=='object'){
		$(sltid).append('<option value="0">'+option0+'</option>');
		arr2=arr[parentid];
		for(var i in arr2){
			$(sltid).append('<option value="'+i+'">'+arr2[i]+'</option>');
		}
		$(sltid).show();
	}
	
}

$(document).ready(function(){
	var column1='{$column_value[column1]}';
	var column2='{$column_value[column2]}';
	var column3='{$column_value[column3]}';
	if(column1>0){
		$('#selectcolumn1').val(column1);
		show_column(column1,2);
		if(column2>0){
			$('#selectcolumn2').val(column2);
			show_column(column2,3);
			if(column3>0){
				$('#selectcolumn3').val(column3);
			}
		}
	}
})

</script>

	<select name="column1" id="selectcolumn1" class="noselect" onchange="show_column(this.value,2)">
	<option value='0'>一级文章栏目</option>
	{$select1}
	</select>
			
	<select name="column2" id="selectcolumn2" class="noselect" onchange="show_column(this.value,3)" style="display:none;">
			
	</select>
			
	<select name="column3" id="selectcolumn3" class="noselect" onchange="select_column2(this.value)" style="display:none;">
			
	</select>
<!--
EOF;
?>