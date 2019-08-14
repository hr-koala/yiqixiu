//兼容V1模板（不含最新模板UI）
var tems = document.querySelector('div[data-tems]').getAttribute('data-tems'),
    page_type = 'profile_index';
document.addEventListener('DOMContentLoaded',function(){
    seajs.config({
      paths: {
        'tems': tems.substring(0,tems.length-1)
      },
      alias: {}
    });
    seajs.use("tems/web/templates/js/own"); //载入入口模块
},false);