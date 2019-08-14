define(function (require, exports, module) {

    var common = require('common'); //加载公共函数文件（语言文字获取等）
    var langtxt = common.langtxt(); //获取语言文字

    //css
    if ($(".yun").length > 0) {//判断元素，按需加载CSS
        require.async('own/admin/templates/css/yfwyz.css');
        $(".yun").show();
    }

    //获取自定义语言参数（全局使用需要放顶部）
    var cl;
    $.ajax({
        type: "POST",
        url: own_name + 'c=ajax&a=doajaxcl',
        dataType: "json",
        async: false,
        success: function (data) {
            cl = data;
        },
        error: function (jqXHR, textStatus, errorMsg) {
            alert(jqXHR+textStatus+errorMsg);
        }
    });

    //导入
    if ($("#fileupload").length > 0) {
        var ress    = $('#dcdl .progress');
        var bar     = $('#dcdl .progress-bar');
        var msg     = $("#dcdl #msg");            //有错误的时候显示的提示文字
        var btn     = $("#dcdl .mycsv span");
        var file    = $("#fileupload");     //input 按钮
        ress.hide();
        $("#dcdl").show();

        file.click(function () {
            var furl = own_name + 'c=inout&a=doaddcvsajax';//获取ajaxURL
            ress.hide();          //初始化隐藏进度条
            progress('1');         //初始化进度条为1
            msg.html('');           //清除错误提示
            if (!$("#myupload").length > 0) {
                file.wrap("<form id='myupload' action='" + furl + "' method='post' enctype='multipart/form-data'></form>");
            }
            file.unbind('change');
            file.change(function () {
                var csvhs = $("input[name='csvhs']").val();
                require.async('own/admin/templates/js/jquery.form', function () {
                    $("#myupload").ajaxSubmit({
                        //target: '#output',                //把服务器返回的内容放入id为output的元素中
                        data: {"csvhs": csvhs},
                        dataType: 'json', //html(默认), xml, script, json...接受服务端返回的类型
                        clearForm: true, //成功提交后，清除所有表单元素的值
                        //url: url,                         //默认是form的action， 如果申明，则会覆盖  
                        //type: type,                       //默认是form的method（get or post），如果申明，则会覆盖
                        //resetForm: true,                  //成功提交后，重置所有表单元素的值  
                        //timeout: 3000                     //限制请求的时间，当请求大于3秒后，跳出请求  
                        beforeSend: function () {           //提交前的回调函数  
                            btn.html(cl.t.yw143).removeClass('btn-danger').addClass('btn-warning');
                        },
                        success: function (data) {
                            if (data.qstate == "0") {
                                btn.html(cl.t.yw144).addClass('btn-danger');
                                alert(data.content);
                                return false;
                            } else {
                                scys();                         //删除外层的form表单
                                file.attr("disabled", true);     //让按钮不可以点击
                                btn.html(cl.t.yw145);
                                ress.show();                  //显示进度条
                                ajaxzx(data);
                            }
                        },
                        error: function (xhr) {
                            //上传失败 
                            alert(xhr.responseText);
                            btn.html(cl.t.yw144);
                            return false;
                        }
                    });
                });
            });
        });

        //ajax循环执行
        function ajaxzx(dataa) {
            progress(dataa.baifen);        //修改进度条的位置
            if (dataa.state == '2') {
                drajax(dataa);
            } else {
                btn.html(cl.t.yw120).removeClass('btn-warning');
                file.removeAttr("disabled");    //还原按钮功能
                if (dataa.error != 0) {
                    msg.html('<a href="' + siteurl + '/app/app/fwyz/lang/error.csv" target="_blank">' + cl.t.yw146 + '</a>');       //输出错误链接地址
                    return false;
                }
            }
        }

        //修改进度条的位置
        function progress(a) {
            bar.attr('aria-valuenow',a);
            bar.css({width: a + "%"});
            bar.text(a + "%");
        }

        //ajax循环调用百分比
        function drajax(dataa) {
            $.ajax({
                type: "POST",
//                timeout : 60000, 
                url: own_name + 'c=inout&a=doaddajax',
                data: dataa,
                dataType: "json",
                success: function (json) {
                    ajaxzx(json);
                },
                error: function (jqXHR, textStatus, errorMsg) {
                    alert(cl.t.yw147 + errorMsg);
                }
            });
        }

        //删除元素
        function scys() {
            if ($("#myupload").length > 0) {
                file.unwrap();  //去掉父级元素
            }
        }
    }

    //侧栏
    if ($(".con2").length > 0) {
        
        $(document).ready(function(e) {
            $(".con2").css({width: $(".con2").width() + 'px'});
            var float = $('#float');
            var t = float.offset().top;
            var mh = $('.con10').outerHeight();
            var fh = float.outerHeight();
            $(window).scroll(function(e){
                var s = $(document).scrollTop();
                if(s > t - 10){
                    float.css('position','fixed');
//                    if(s + fh > mh){
//                            float.css('top',mh-s-fh+'px');	
//                    }				
                }else{
                    float.css('position','');
                }
            })
        });
    }
    
    //防伪码
    if ($('input[name="open"]').length > 0) {
        //防伪码实例
        $(document).ready(function () {
            tipsinfo();
        })
        
        //选择分区后
        $(document).on('click', 'input[name="open"]', function () {
            tipsinfo();
        })
        
        //前缀后缀的实例
        $(document).on('blur', 'input[name^="fwlength_"], input[name^="fwqian_"], input[name^="fwhou_"],input[name="open"]', function () {
            tipsinfo();
        })

        //生成准备
        function info(my){
            var id          = my.parents("[class^='open_']").data('open');
            var fwlength    = $('input[name="fwlength_' + id + '"]').val();
            if(!fwlength.length){
                fwlength = 4;
            }
            var fwqian      = $('input[name="fwqian_' + id + '"]').val();
            var fwhou       = $('input[name="fwhou_' + id + '"]').val();
            var num         = fwlength - fwqian.length - fwhou.length,inputinfo = '';
            if(num < 0){
                inputinfo   = '<B><i><font style="color:#FF0000">'+cl.t.yw039+'</font></i></B>';
            }else{
                inputinfo   = numxxx(num,fwqian,fwhou);
            }
            return inputinfo;
        }
        
        //生成
        function numxxx(num,fwqian,fwhou){
            var fwinfo = '';
            if(fwqian.length){
                fwinfo += '<font style="color:#FF0000">'+ fwqian +'</font>';
            }
            
            for($i=0;$i<num;$i++){
                fwinfo += '*';
            }
            
            if(fwhou.length){
                fwinfo += '<font style="color:#FF0000">'+ fwhou +'</font>';
            }
            
            return fwinfo;
        }
        
        //全局
        function tipsinfo(){
            var my,infotips = cl.t.yw040,openids   = [],open = [],json    = {0:'',1:'  ',2:'-'}, space   = $('input[name="space"]:checked').val();
            $('input[name="open"]:checked').each(function () {
                openids.push($(this).val());
            });
            $.each(openids,function(i,val) {
                my  = $('input[name="fwlength_' + val + '"]');
                open.push(info(my));
            });
            infotips    += open.join(json[space]);
            $.each(openids,function(i,val) {
                my  = $('input[name="fwlength_' + val + '"]');
                my.parent().next('.tips').html(infotips);
            });
            
        }
        
        
        
    }

    //ajax防伪码生成
    if ($(".codeinfo").length > 0) {
        $(".codenum button").click(function () {
            var num = $("input[name='codenum']").val();
            $.ajax({
                type: "POST",
                url: own_name + 'c=ajax&a=dofwcode',
                data: {'num': num},
                dataType: "json",
                success: function (data) {
                    $(".codeinfo").empty();
                    $.each(data, function (i, val) {
                        $(".codeinfo").append('<div class="divcode">' + val + '<i class="fa fa-times"></i></div>');
                    })
                },
                error: function (jqXHR, textStatus, errorMsg) {
                    alert(cl.t.yw147 + errorMsg);
                }
            });
        })

        $(document).on('dblclick', '.divcode', function () {
            var my = $(this), txt = my.text(), input = $('<input type="text" value="' + txt + '" /><i class="fa fa-times"></i><span></span>');
            my.removeClass('divcode').addClass('bspan');
            my.html(input);
            input.trigger("focus");
        })
        
        $(document).on('click', '.bspan input', function () {
            return false;
        })
        
        $(document).on('blur', '.bspan input,.redspan input', function () {
            var my = $(this),mydiv = my.parent('div'),code = my.val();
            my.find('i').click(function(){
                delcode(my);
                return false;
            })
            
            mydiv.removeClass('bspan').addClass('divcode');
            $.ajax({
                url: own_name + 'c=ajax&a=dofwyz&code=' + code,
                success: function (data) {
                    var arr = data.split('|');
                    if (arr[0] != 1) {
                        mydiv.addClass('redspan').find("span").text(arr[1]);
                    } else {
                        if (diveach(code)) {
                            mydiv.html(code + '<i class="fa fa-times"></i>').removeClass('redspan');
                        } else {
                            mydiv.addClass('redspan').find("span").text(cl.t.yw050);
                        }
                    }
                }
            });
        })

        //防伪码进行对比
        function diveach(code) {
            var arr = codeeach(), str = false;
            if ($.inArray(code, arr) == -1) {
                str = true;
            }
            return str;
        }
        
        //防伪码删除按钮
        $(document).on('click', '.codeinfo div i', function () {
            delcode($(this));
        })
        
        //删除方法
        function delcode(my){
            my.parent('div').remove();
            $('.code').css({height:'auto'});
        }

        //获取防伪码数组
        function codeeach() {
            var arr = [];
            $(".codeinfo div").each(function () {
                arr.push($(this).text());
            })
            return arr;
        }

        //保存时提前保存防伪码
        $('.ui-from.yuncode').submit(function () {
            var code = '';
            $(".codeinfo div").each(function () {
                code += $(this).text() + '$$$$';
            })
            $("input[name='code']").val(code);
        })
    }

    //数据统计表
    if ($(".addup").length > 0) {
        metHeight($("div.arec"));
        var myChart = echarts.init(document.getElementById("addup"), 'macarons');
        macarons(myChart, 'date')
        // 异步加载数据
        $(document).on('click', '.areb .panel-heading button', function () {
            var my = $(this), addup = my.data('button-addup');
            $(".areb .panel-heading button").removeClass('btn-danger');
            my.addClass('btn-danger');
            macarons(myChart, addup);
        });

        window.onresize = function () {
            myChart.resize();
        }

        function macarons(myChart, addup) {
            //loading
            myChart.showLoading();
            $.getJSON(own_name + "c=ajax&a=doecharts&addup=" + addup).done(function (json) {
                // 填入数据
                myChart.setOption(json);
                //loading
                myChart.hideLoading();
            });
        }

        $(document).on('mouseover', '.arec', function () {
            $(this).removeClass('panel-info').addClass('panel-danger');
        });

        $(document).on('mouseleave', '.arec', function () {
            $(this).removeClass('panel-danger').addClass('panel-info');
        });
    }


    //等高
    function metHeight(group) {
        tallest = 0;
        group.each(function () {
            thisHeight = $(this).height();
            if (thisHeight > tallest) {
                tallest = thisHeight;
            }
        });
        group.height(tallest);
    }
    
    //对全部数据操作的处理
    $(document).on('click', '.submit.yun_right', function () {
        $(".ui-from").submit(function(){
            $('input[name="id"]').attr({checked:true});//全部选中，这样给予后面的程序提交可以不用拦截，方便进行一键操作类的使用
        });
    })
    
    //控制防伪码存在数据后的操作
    if($(".configtips").length > 0){
        $('.configtips input').each(function () {
            $(this).attr("disabled",true); readonly="readonly"
            $(this).css({background:"#f7f7f7"});
        });
        
        $('input.configtips').each(function () {
            $(this).attr("readonly",true);
            $(this).css({background:"#f7f7f7"});
        });
        
        $(document).on('click', '.configtips label,input.configtips', function (event) {
            event.preventDefault();
            common.metalert({
                html:cl.t.yw190,
                type:'alert',
            });
        });
    }
    
    if($('input[name="dir_name"]').length){
        $('input[name="dir_name"]').blur(function(event){
            var my = $(this);
            event.preventDefault();
            common.metalert({
                html:cl.t.yw053+'<br /><font color="#f00">'+cl.t.yw059+'</font>',
                type:'confirm',
                callback:function(buer){
                    if(!buer){
                        my.val(cl.c.column.foldername);
                    }
                }
            });
        })
    }
    
    
    $(document).on('click', '.addqrcode', function (event) {
        event.preventDefault();
        common.metalert({
            html:cl.t.yw227, 
        });
    })

    //二维码弹窗展示(JS 无文件缓存)
    $(document).on('click', '.qrcode', function (event) {
        event.preventDefault();
        var title= $(this).attr('title'),code= $(this).data('code');
        common.metalert({
            html:'<div class="v52fmbx"><h3 class="v52fmbx_hr">'+title+'</h3><div id="qrcode" style="padding:10px;"></div></div>',
            type:'window',
        });
        require.async('own/admin/templates/js/qrcode.min',function(){
            $.post(own_name + "c=ajax&a=doqrcode&code=" + code, function(data){
                var qrcode = new QRCode(document.getElementById("qrcode"), {
//                    text: '任意内容。',
                    width: 380,
                    height: 380,
//                    colorDark : '#000000',  //	前景色
//                    colorLight : '#ffffff', //背景色
                    correctLevel : QRCode.CorrectLevel.H
                });
                qrcode.clear();
                qrcode.makeCode(data);
            }); 
        });
    });
    
    if($('.backup').length){
        //点击后
        $(document).on('click','[data-toggle="popover"]',function(){
            return false;
        });

        //取消
        $(document).on('click','a.listdeleteno',function(){
            $(this).parents(".popover:eq(0)").prev().popover('hide');
        });
        
        var href = '';
        $('a[data-toggle="popover"]').on('show.bs.popover', function () {
            href = $(this).attr('href');
        })
        
        //底部按钮
        $('a[data-toggle="popover"]').popover({
            content:function(){
                    return '<a href="'+ href +'&tname=code" target="_blank" class="btn btn-primary btn-sm" style="margin-right:5px;" data-confirm="'+cl.t.yw215+'">'+cl.t.yw142+'</a><a href="'+ href +'&tname=info" target="_blank" class="btn btn-danger btn-sm" style="margin-right:5px;" data-confirm="'+cl.t.yw216+'">'+cl.t.yw228+'</a><a class="btn btn-default btn-sm listdeleteno" role="button" href="javascript:;">'+cl.t.yw229+'</a>';
            },
            html:true,
            placement:'top'
        });
    }
    if($('.orderby-link').length){
        function orderby(my,type){
            $("a.orderby-link").find(".orderby-arrow").remove();
            $("a.orderby-link").next().val('');
            my.append('<span class="orderby-arrow '+type+'"></span>');
            my.next().val(type);
            var table = $('.dataTable').DataTable();
            table.ajax.reload();
        }
        $("a.orderby-link").click(function(){
            if($(this).find(".orderby-arrow").length){
                if($(this).find(".desc").length){
                    orderby($(this),'asc');
                }else{
                    orderby($(this),'desc');
                }
            }else{
                orderby($(this),'desc');
            }
        });
    }
});
