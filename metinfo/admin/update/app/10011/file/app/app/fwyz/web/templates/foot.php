<!--<?php
defined('IN_MET') or exit('No permission');//保持入口文件，每个应用模板都要添加
echo <<<EOT
-->
{$_YW['foot_script']}
<script>
    //var mobile = {$this->mobile}, code = {$this->formcode};   //废弃变量
    if(!{$this->mobile} && !{$this->formcode}){
        var divheight = $("div.yun_fwyz").height(),bodyheight  = $(window).height(),sstopjl = {$_YW['c']['sstopjl']}*2;
        $("div.yun_fwyz").css({position:'relative',top:(bodyheight-divheight-sstopjl)/2 + 'px'});
    }
</script>

</body>
</html>
<!--
EOT;
?>-->