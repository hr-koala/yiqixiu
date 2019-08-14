/*jquery.asScrollable.all.min.js*/
/*! jQuery asScrollable - v0.3.1 - 2015-06-15
* https://github.com/amazingSurge/jquery-asScrollable
* Copyright (c) 2015 amazingSurge; Licensed GPL */
!function(a,b,c,d){"use strict";function e(){return"undefined"!=typeof a.performance&&a.performance.now?a.performance.now():Date.now()}function f(a){return"string"==typeof a&&-1!=a.indexOf("%")}function g(a){return parseFloat(a.slice(0,-1)/100,10)}function h(a){return a&&"matrix"==a.substr(0,6)?a.replace(/^.*\((.*)\)$/g,"$1").replace(/px/g,"").split(/, +/):!1}var i="asScrollbar";Date.now||(Date.now=function(){return(new Date).getTime()});for(var j=["webkit","moz"],k=0;k<j.length&&!a.requestAnimationFrame;++k){var l=j[k];a.requestAnimationFrame=a[l+"RequestAnimationFrame"],a.cancelAnimationFrame=a[l+"CancelAnimationFrame"]||a[l+"CancelRequestAnimationFrame"]}if(/iP(ad|hone|od).*OS (6|7|8)/.test(a.navigator.userAgent)||!a.requestAnimationFrame||!a.cancelAnimationFrame){var m=0;a.requestAnimationFrame=function(a){var b=e(),c=Math.max(m+16,b);return setTimeout(function(){a(m=c)},c-b)},a.cancelAnimationFrame=clearTimeout}var n=c[i]=function(a,b){this.$bar=c(b),a=this.options=c.extend({},n.defaults,a||{},this.$bar.data("options")||{}),b.direction=this.options.direction,this.classes={directionClass:a.namespace+"-"+a.direction,barClass:a.barClass?a.barClass:a.namespace,handleClass:a.handleClass?a.handleClass:a.namespace+"-handle"},"vertical"===this.options.direction?this.attributes={axis:"Y",position:"top",length:"height",clientLength:"clientHeight"}:"horizontal"===this.options.direction&&(this.attributes={axis:"X",position:"left",length:"width",clientLength:"clientWidth"}),this._states={},this._drag={time:null,pointer:null},this._frameId=null,this.handlePosition=0,this.easing=n.easing[this.options.easing]||n.easing.ease,this.init()};n.defaults={namespace:"asScrollbar",skin:null,handleSelector:null,handleTemplate:'<div class="{{handle}}"></div>',barClass:null,handleClass:null,disabledClass:"is-disabled",draggingClass:"is-dragging",hoveringClass:"is-hovering",direction:"vertical",barLength:null,handleLength:null,minHandleLength:30,maxHandleLength:null,mouseDrag:!0,touchDrag:!0,pointerDrag:!0,clickMove:!0,clickMoveStep:.3,mousewheel:!0,mousewheelSpeed:50,keyboard:!0,useCssTransforms3d:!0,useCssTransforms:!0,useCssTransitions:!0,duration:"500",easing:"ease"};var o={};n.support=o,function(e){function f(a,b){var e=!1,f=a.charAt(0).toUpperCase()+a.slice(1);return h[a]!==d&&(e=a),e||c.each(i,function(a,b){return h[b+f]!==d?(e="-"+b.toLowerCase()+"-"+f,!1):void 0}),b?e:e?!0:!1}function g(a){return f(a,!0)}var h=c("<support>").get(0).style,i=["webkit","Moz","O","ms"],j={transition:{end:{WebkitTransition:"webkitTransitionEnd",MozTransition:"transitionend",OTransition:"oTransitionEnd",transition:"transitionend"}},animation:{end:{WebkitAnimation:"webkitAnimationEnd",MozAnimation:"animationend",OAnimation:"oAnimationEnd",animation:"animationend"}}},k={csstransforms:function(){return!!f("transform")},csstransforms3d:function(){return!!f("perspective")},csstransitions:function(){return!!f("transition")},cssanimations:function(){return!!f("animation")}};k.csstransitions()&&(e.transition=new String(g("transition")),e.transition.end=j.transition.end[e.transition]),k.cssanimations()&&(e.animation=new String(g("animation")),e.animation.end=j.animation.end[e.animation]),k.csstransforms()&&(e.transform=new String(g("transform")),e.transform3d=k.csstransforms3d()),e.touch="ontouchstart"in a||a.DocumentTouch&&b instanceof a.DocumentTouch?!0:!1,e.pointer=a.PointerEvent||a.MSPointerEvent?!0:!1,e.prefixPointerEvent=function(b){return a.MSPointerEvent?"MSPointer"+b.charAt(9).toUpperCase()+b.substr(10):b}}(o);var p=function(a,b,c,d){function e(a,b){return 1-3*b+3*a}function f(a,b){return 3*b-6*a}function g(a){return 3*a}function h(a,b,c){return((e(b,c)*a+f(b,c))*a+g(b))*a}function i(a,b,c){return 3*e(b,c)*a*a+2*f(b,c)*a+g(b)}function j(b){for(var d=b,e=0;4>e;++e){var f=i(d,a,c);if(0===f)return d;var g=h(d,a,c)-b;d-=g/f}return d}return a===b&&c===d?{css:"linear",fn:function(a){return a}}:{css:"cubic-bezier("+a+","+b+","+c+","+d+")",fn:function(a){return h(j(a),b,d)}}};c.extend(n.easing={},{ease:p(.25,.1,.25,1),linear:p(0,0,1,1),"ease-in":p(.42,0,1,1),"ease-out":p(0,0,.58,1),"ease-in-out":p(.42,0,.58,1)}),n.prototype={constructor:n,init:function(){var a=this.options;this.$handle=this.$bar.find(this.options.handleSelector),0===this.$handle.length?this.$handle=c(a.handleTemplate.replace(/\{\{handle\}\}/g,this.classes.handleClass)).appendTo(this.$bar):this.$handle.addClass(this.classes.handleClass),this.$bar.addClass(this.classes.barClass).addClass(this.classes.directionClass).attr("draggable",!1),a.skin&&this.$bar.addClass(a.skin),null!==a.barLength&&this.setBarLength(a.barLength),null!==a.handleLength&&this.setHandleLength(a.handleLength),this.updateLength(),this.bindEvents()},trigger:function(a){var b=Array.prototype.slice.call(arguments,1),c=[this].concat(b);this.$bar.trigger(i+"::"+a,c),a=a.replace(/\b\w+\b/g,function(a){return a.substring(0,1).toUpperCase()+a.substring(1)});var d="on"+a;"function"==typeof this.options[d]&&this.options[d].apply(this,b)},is:function(a){return this._states[a]&&this._states[a]>0},enter:function(a){this._states[a]===d&&(this._states[a]=0),this._states[a]++},leave:function(a){this._states[a]--},eventName:function(a){if("string"!=typeof a||""===a)return"."+this.options.namespace;a=a.split(" ");for(var b=a.length,c=0;b>c;c++)a[c]=a[c]+"."+this.options.namespace;return a.join(" ")},bindEvents:function(){var a=this;this.options.mouseDrag&&(this.$handle.on(this.eventName("mousedown"),c.proxy(this.onDragStart,this)),this.$handle.on(this.eventName("dragstart selectstart"),function(){return!1})),this.options.touchDrag&&o.touch&&(this.$handle.on(this.eventName("touchstart"),c.proxy(this.onDragStart,this)),this.$handle.on(this.eventName("touchcancel"),c.proxy(this.onDragEnd,this))),this.options.pointerDrag&&o.pointer&&(this.$handle.on(this.eventName(o.prefixPointerEvent("pointerdown")),c.proxy(this.onDragStart,this)),this.$handle.on(this.eventName(o.prefixPointerEvent("pointercancel")),c.proxy(this.onDragEnd,this))),this.options.clickMove&&this.$bar.on(this.eventName("mousedown"),c.proxy(this.onClick,this)),this.options.mousewheel&&this.$bar.on(this.eventName("mousewheel"),function(b,c){var d=a.getHandlePosition();return 0>=d&&c>0?!0:d>=a.barLength&&0>c?!0:(d-=a.options.mousewheelSpeed*c,a.move(d,!0),!1)}),this.$bar.on(this.eventName("mouseenter"),function(){a.$bar.addClass(a.options.hoveringClass),a.enter("hovering"),a.trigger("hover")}),this.$bar.on(this.eventName("mouseleave"),function(){a.$bar.removeClass(a.options.hoveringClass),a.is("hovering")&&(a.leave("hovering"),a.trigger("hovered"))}),this.options.keyboard&&c(b).on(this.eventName("keydown"),function(d){if((!d.isDefaultPrevented||!d.isDefaultPrevented())&&a.is("hovering")){for(var e=b.activeElement;e.shadowRoot;)e=e.shadowRoot.activeElement;if(!c(e).is(":input,select,option,[contenteditable]")){var f=0,g=null;switch(d.which){case 37:case 63232:f=-30;break;case 38:case 63233:f=-30;break;case 39:case 63234:f=30;break;case 40:case 63235:f=30;break;case 33:case 63276:f=-90;break;case 32:case 34:case 63277:f=-90;break;case 35:case 63275:g="100%";break;case 36:case 63273:g=0;break;default:return}(f||null!==g)&&(f?a.moveBy(f,!0):null!==g&&a.moveTo(g,!0),d.preventDefault())}}})},onClick:function(a){if(3!==a.which&&a.target!==this.$handle[0]){this._drag.time=(new Date).getTime(),this._drag.pointer=this.pointer(a);var b=this.$handle.offset(),c=this.distance({x:b.left,y:b.top},this._drag.pointer),d=1;c>0?c-=this.handleLength:(c=Math.abs(c),d=-1),c>this.barLength*this.options.clickMoveStep&&(c=this.barLength*this.options.clickMoveStep),this.moveBy(d*c,!0)}},onDragStart:function(a){var d=this;if(3!==a.which){this.$bar.addClass(this.options.draggingClass),this._drag.time=(new Date).getTime(),this._drag.pointer=this.pointer(a);var e=function(){d.enter("dragging"),d.trigger("drag")};this.options.mouseDrag&&(c(b).on(d.eventName("mouseup"),c.proxy(this.onDragEnd,this)),c(b).one(d.eventName("mousemove"),c.proxy(function(){c(b).on(d.eventName("mousemove"),c.proxy(this.onDragMove,this)),e()},this))),this.options.touchDrag&&o.touch&&(c(b).on(d.eventName("touchend"),c.proxy(this.onDragEnd,this)),c(b).one(d.eventName("touchmove"),c.proxy(function(){c(b).on(d.eventName("touchmove"),c.proxy(this.onDragMove,this)),e()},this))),this.options.pointerDrag&&o.pointer&&(c(b).on(d.eventName(o.prefixPointerEvent("pointerup")),c.proxy(this.onDragEnd,this)),c(b).one(d.eventName(o.prefixPointerEvent("pointermove")),c.proxy(function(){c(b).on(d.eventName(o.prefixPointerEvent("pointermove")),c.proxy(this.onDragMove,this)),e()},this))),c(b).on(d.eventName("blur"),c.proxy(this.onDragEnd,this))}},onDragMove:function(a){var b=this.distance(this._drag.pointer,this.pointer(a));this.is("dragging")&&(a.preventDefault(),this.moveBy(b,!0))},onDragEnd:function(){c(b).off(this.eventName("mousemove mouseup touchmove touchend pointermove pointerup MSPointerMove MSPointerUp blur")),this.$bar.removeClass(this.options.draggingClass),this.handlePosition=this.getHandlePosition(),this.is("dragging")&&(this.leave("dragging"),this.trigger("dragged"))},pointer:function(b){var c={x:null,y:null};return b=b.originalEvent||b||a.event,b=b.touches&&b.touches.length?b.touches[0]:b.changedTouches&&b.changedTouches.length?b.changedTouches[0]:b,b.pageX?(c.x=b.pageX,c.y=b.pageY):(c.x=b.clientX,c.y=b.clientY),c},distance:function(a,b){return"vertical"===this.options.direction?b.y-a.y:b.x-a.x},setBarLength:function(a,b){"undefined"!=typeof a&&this.$bar.css(this.attributes.length,a),b!==!1&&this.updateLength()},setHandleLength:function(a,b){"undefined"!=typeof a&&(a<this.options.minHandleLength?a=this.options.minHandleLength:this.options.maxHandleLength&&a>this.options.maxHandleLength&&(a=this.options.maxHandleLength),this.$handle.css(this.attributes.length,a),b!==!1&&this.updateLength(a))},updateLength:function(a,b){this.handleLength="undefined"!=typeof a?a:this.getHandleLenght(),this.barLength="undefined"!=typeof b?b:this.getBarLength()},getBarLength:function(){return this.$bar[0][this.attributes.clientLength]},getHandleLenght:function(){return this.$handle[0][this.attributes.clientLength]},getHandlePosition:function(){var a;if(this.options.useCssTransforms&&o.transform){if(a=h(this.$handle.css(o.transform)),!a)return 0;a="X"===this.attributes.axis?a[12]||a[4]:a[13]||a[5]}else a=this.$handle.css(this.attributes.position);return parseFloat(a.replace("px",""))},makeHandlePositionStyle:function(a){var b,c="0",d="0";this.options.useCssTransforms&&o.transform?("X"===this.attributes.axis?c=a+"px":d=a+"px",b=o.transform.toString(),a=this.options.useCssTransforms3d&&o.transform3d?"translate3d("+c+","+d+",0)":"translate("+c+","+d+")"):b=this.attributes.position;var e={};return e[b]=a,e},setHandlePosition:function(a){var b=this.makeHandlePositionStyle(a);this.$handle.css(b),this.is("dragging")||(this.handlePosition=parseFloat(a))},moveTo:function(a,b,c){var d=typeof a;"string"===d&&(f(a)&&(a=g(a)*(this.barLength-this.handleLength)),a=parseFloat(a),d="number"),"number"===d&&this.move(a,b,c)},moveBy:function(a,b,c){var d=typeof a;"string"===d&&(f(a)&&(a=g(a)*(this.barLength-this.handleLength)),a=parseFloat(a),d="number"),"number"===d&&this.move(this.handlePosition+a,b,c)},move:function(a,b,c){"number"!=typeof a||this.is("disabled")||(0>a?a=0:a+this.handleLength>this.barLength&&(a=this.barLength-this.handleLength),this.is("dragging")||c===!0?(this.setHandlePosition(a),b&&this.trigger("change",a/(this.barLength-this.handleLength))):this.doMove(a,this.options.duration,this.options.easing,b))},doMove:function(b,c,d,f){this.enter("moving"),c=c?c:this.options.duration,d=d?d:this.options.easing;var g=this,h=this.makeHandlePositionStyle(b);for(var i in h)break;if(this.options.useCssTransitions&&o.transition)g.enter("transition"),this.prepareTransition(i,c,d),this.$handle.one(o.transition.end,function(){g.$handle.css(o.transition,""),f&&g.trigger("change",b/(g.barLength-g.handleLength)),g.leave("transition"),g.leave("moving")}),g.setHandlePosition(b);else{g.enter("animating");var j=e(),k=g.getHandlePosition(),l=b,m=function(b){var c=(b-j)/g.options.duration;c>1&&(c=1),c=g.easing.fn(c);var d=parseFloat(k+c*(l-k),10);g.setHandlePosition(d),f&&g.trigger("change",d/(g.barLength-g.handleLength)),1===c?(a.cancelAnimationFrame(g._frameId),g._frameId=null,g.leave("animating"),g.leave("moving")):g._frameId=a.requestAnimationFrame(m)};g._frameId=a.requestAnimationFrame(m)}},prepareTransition:function(a,b,d,e){var f=[];a&&f.push(a),b&&(c.isNumeric(b)&&(b+="ms"),f.push(b)),f.push(d?d:this.easing.css),e&&f.push(e),this.$handle.css(o.transition,f.join(" "))},enable:function(){this._states.disabled=0,this.$bar.removeClass(this.options.disabledClass)},disable:function(){this._states.disabled=1,this.$bar.addClass(this.options.disabledClass)},destory:function(){this.$bar.on(this.eventName())}},c.fn[i]=function(a){if("string"!=typeof a)return this.each(function(){c(this).data(i)||c(this).data(i,new n(a,this))});var b=Array.prototype.slice.call(arguments,1);this.each(function(){var d=c(this).data(i);return d&&c.isFunction(d[a])&&"_"!==a.charAt(0)?void d[a].apply(d,b):!1})}}(window,document,jQuery,void 0),function(a,b,c,d,e){"use strict";function f(){return"undefined"!=typeof a.performance&&a.performance.now?a.performance.now():Date.now()}function g(a){return"string"==typeof a&&-1!=a.indexOf("%")}function h(a){return 0>a?a=0:a>1&&(a=1),100*parseFloat(a).toFixed(4)+"%"}function i(a){return parseFloat(a.slice(0,-1)/100,10)}var j="asScrollable",k=0,l=function(){var b,c,d;return c=a.navigator.userAgent,(b=/(?=.+Mac OS X)(?=.+Firefox)/.test(c))?(d=/Firefox\/\d{2}\./.exec(c),d&&(d=d[0].replace(/\D+/g,"")),b&&+d>23):!1}(),m=c[j]=function(a,b){this.$element=c(b),a=this.options=c.extend({},m.defaults,a||{},this.$element.data("options")||{}),this.classes={wrap:a.namespace,content:a.namespace+"-content",container:a.namespace+"-container",bar:a.namespace+"-bar",barHide:a.namespace+"-bar-hide",skin:a.skin},this.attributes={vertical:{axis:"Y",overflow:"overflow-y",scroll:"scrollTop",scrollLength:"scrollHeight",pageOffset:"pageYOffset",ffPadding:"padding-right",length:"height",clientLength:"clientHeight",offset:"offsetHeight",crossLength:"width",crossClientLength:"clientWidth",crossOffset:"offsetWidth"},horizontal:{axis:"X",overflow:"overflow-x",scroll:"scrollLeft",scrollLength:"scrollWidth",pageOffset:"pageXOffset",ffPadding:"padding-bottom",length:"width",clientLength:"clientWidth",offset:"offsetWidth",crossLength:"height",crossClientLength:"clientHeight",crossOffset:"offsetHeight"}},this._states={},this.horizontal=null,this.vertical=null,this.$bar=null,this._frameId=null,this._timeoutId=null,this.instanceId=++k,this.easing=d.easing[this.options.easing]||d.easing.ease;var e=this.$element.css("position");this.options.containerSelector?(this.$container=this.$element.find(this.options.containerSelector),this.$wrap=this.$element,"static"==e&&this.$wrap.css("position","relative")):(this.$container=this.$element.wrap("<div>"),this.$wrap=this.$container.parent(),this.$wrap.height(this.$element.height()),"static"!==e?this.$wrap.css("position",e):this.$wrap.css("position","relative")),this.options.contentSelector?this.$content=this.$container.find(this.options.contentSelector):(this.$content=this.$container.wrap("<div>"),this.$container=this.$content.parent()),this.init()};m.defaults={namespace:j,skin:null,contentSelector:null,containerSelector:null,enabledClass:"is-enabled",disabledClass:"is-disabled",draggingClass:"is-dragging",hoveringClass:"is-hovering",scrollingClass:"is-scrolling",direction:"vertical",showOnHover:!0,showOnBarHover:!1,duration:500,easing:"ease-in",responsive:!0,throttle:20,scrollbar:{}},m.prototype={constructor:m,init:function(){switch(this.options.direction){case"vertical":this.vertical=!0;break;case"horizontal":this.horizontal=!0;break;case"both":this.horizontal=!0,this.vertical=!0;break;case"auto":var a=this.$element.css("overflow-x"),b=this.$element.css("overflow-y");("scroll"===a||"auto"===a)&&(this.horizontal=!0),("scroll"===b||"auto"===b)&&(this.vertical=!0)}(this.vertical||this.horizontal)&&(this.$wrap.addClass(this.classes.wrap),this.$container.addClass(this.classes.container),this.$content.addClass(this.classes.content),this.options.skin&&this.$wrap.addClass(this.classes.skin),this.$wrap.addClass(this.options.enabledClass),this.vertical&&(this.$wrap.addClass(this.classes.wrap+"-vertical"),this.initLayout("vertical"),this.createBar("vertical")),this.horizontal&&(this.$wrap.addClass(this.classes.wrap+"-horizontal"),this.initLayout("horizontal"),this.createBar("horizontal")),this.bindEvents())},bindEvents:function(){var b=this,d=this.options;d.responsive&&(c(a).on(this.eventNameWithId("orientationchange"),function(){b.update.call(b)}),c(a).on(this.eventNameWithId("resize"),this.throttle(function(){b.update.call(b)},d.throttle))),(this.horizontal||this.vertical)&&(this.$wrap.on(this.eventName("mouseenter"),function(){b.$wrap.addClass(b.options.hoveringClass),b.enter("hovering"),b.trigger("hover")}),this.$wrap.on(this.eventName("mouseleave"),function(){b.$wrap.removeClass(b.options.hoveringClass),b.is("hovering")&&(b.leave("hovering"),b.trigger("hovered"))}),d.showOnHover&&(d.showOnBarHover?this.$bar.on("asScrollbar::hover",function(){b.showBar(this.direction)}).on("asScrollbar::hovered",function(){b.hideBar(this.direction)}):(this.$element.on(j+"::hover",c.proxy(this.showBar,this)),this.$element.on(j+"::hovered",c.proxy(this.hideBar,this)))),this.$container.on(this.eventName("scroll"),function(){if(b.horizontal){var a=b.offsetLeft;b.offsetLeft=b.getOffset("horizontal"),a!==b.offsetLeft&&(b.trigger("scroll",b.getPercentOffset("horizontal"),"horizontal"),0===b.offsetLeft&&b.trigger("scrolltop","horizontal"),b.offsetLeft===b.getScrollLength("horizontal")&&b.trigger("scrollend","horizontal"))}if(b.vertical){var c=b.offsetTop;b.offsetTop=b.getOffset("vertical"),c!==b.offsetTop&&(b.trigger("scroll",b.getPercentOffset("vertical"),"vertical"),0===b.offsetTop&&b.trigger("scrolltop","vertical"),b.offsetTop===b.getScrollLength("vertical")&&b.trigger("scrollend","vertical"))}}),this.$element.on(j+"::scroll",function(a,c,d,e){b.is("scrolling")||(b.enter("scrolling"),b.$wrap.addClass(b.options.scrollingClass));var f=c.getBarApi(e);f.moveTo(h(d),!1,!0),clearTimeout(b._timeoutId),b._timeoutId=setTimeout(function(){b.$wrap.removeClass(b.options.scrollingClass),b.leave("scrolling")},200)}),this.$bar.on("asScrollbar::change",function(a,c,d){b.scrollTo(this.direction,h(d),!1,!0)}),this.$bar.on("asScrollbar::drag",function(){b.$wrap.addClass(b.options.draggingClass)}).on("asScrollbar::dragged",function(){b.$wrap.removeClass(b.options.draggingClass)}))},unbindEvents:function(){this.$wrap.off(this.eventName()),this.$element.off(j+"::scroll").off(j+"::hover").off(j+"::hovered"),this.$container.off(this.eventName()),c(a).off(this.eventNameWithId())},initLayout:function(a){"vertical"===a&&this.$container.css("height",this.$wrap.height());var b=this.attributes[a],c=this.$container[0],d=this.getBrowserScrollbarWidth(a),e=c.parentNode[b.crossClientLength];this.$content.css(b.crossLength,e+"px"),this.$container.css(b.crossLength,d+e+"px"),0===d&&l&&this.$container.css(b.ffPadding,16)},createBar:function(a){var b=c.extend(this.options.scrollbar,{namespace:this.classes.bar,direction:a,useCssTransitions:!1,keyboard:!1}),d=c("<div>");d.asScrollbar(b),this.options.showOnHover&&d.addClass(this.classes.barHide),d.appendTo(this.$wrap),this["$"+a]=d,this.$bar=null===this.$bar?d:this.$bar.add(d),this.updateBarHandle(a)},trigger:function(a){var b=Array.prototype.slice.call(arguments,1),c=[this].concat(b);this.$element.trigger(j+"::"+a,c),a=a.replace(/\b\w+\b/g,function(a){return a.substring(0,1).toUpperCase()+a.substring(1)});var d="on"+a;"function"==typeof this.options[d]&&this.options[d].apply(this,b)},is:function(a){return this._states[a]&&this._states[a]>0},enter:function(a){this._states[a]===e&&(this._states[a]=0),this._states[a]++},leave:function(a){this._states[a]--},eventName:function(a){if("string"!=typeof a||""===a)return"."+this.options.namespace;a=a.split(" ");for(var b=a.length,c=0;b>c;c++)a[c]=a[c]+"."+this.options.namespace;return a.join(" ")},eventNameWithId:function(a){if("string"!=typeof a||""===a)return this.options.namespace+"-"+this.instanceId;a=a.split(" ");for(var b=a.length,c=0;b>c;c++)a[c]=a[c]+"."+this.options.namespace+"-"+this.instanceId;return a.join(" ")},throttle:function(a,b){var c,d,e,f=Date.now||function(){return(new Date).getTime()},g=null,h=0,i=function(){h=f(),g=null,e=a.apply(c,d),c=d=null};return function(){var j=f(),k=b-(j-h);return c=this,d=arguments,0>=k?(clearTimeout(g),g=null,h=j,e=a.apply(c,d),c=d=null):g||(g=setTimeout(i,k)),e}},getBrowserScrollbarWidth:function(a){var c,d,e=this.attributes[a];return e.scrollbarWidth?e.scrollbarWidth:(c=b.createElement("div"),d=c.style,d.position="absolute",d.width="100px",d.height="100px",d.overflow="scroll",d.top="-9999px",b.body.appendChild(c),e.scrollbarWidth=c[e.offset]-c[e.clientLength],b.body.removeChild(c),e.scrollbarWidth)},getOffset:function(a){var b=this.attributes[a],c=this.$container[0];return c[b.pageOffset]||c[b.scroll]},getPercentOffset:function(a){return this.getOffset(a)/this.getScrollLength(a)},getContainerLength:function(a){return this.$container[0][this.attributes[a].clientLength]},getScrollLength:function(a){var b=this.$content[0][this.attributes[a].scrollLength];return b-this.getContainerLength(a)},scrollTo:function(a,b,c,d){var e=typeof b;"string"===e&&(g(b)&&(b=i(b)*this.getScrollLength(a)),b=parseFloat(b),e="number"),"number"===e&&this.move(a,b,c,d)},scrollBy:function(a,b,c,d){var e=typeof b;"string"===e&&(g(b)&&(b=i(b)*this.getScrollLength(a)),b=parseFloat(b),e="number"),"number"===e&&this.move(a,this.getOffset(a)+b,c,d)},move:function(b,c,d,e){if(this[b]===!0&&"number"==typeof c){var g=this;this.enter("moving"),0>c?c=0:c>this.getScrollLength(b)&&(c=this.getScrollLength(b));var h=this.attributes[b],i=function(){g.leave("moving")};if(e)this.$container[0][h.scroll]=c,d!==!1&&this.trigger("change",c/this.getScrollLength(b)),i();else{g.enter("animating");var j=f(),k=g.getOffset(b),l=c,m=function(e){var f=(e-j)/g.options.duration;f>1&&(f=1),f=g.easing.fn(f);var n=parseFloat(k+f*(l-k),10);g.$container[0][h.scroll]=n,d!==!1&&g.trigger("change",c/g.getScrollLength(b)),1===f?(a.cancelAnimationFrame(g._frameId),g._frameId=null,g.leave("animating"),i()):g._frameId=a.requestAnimationFrame(m)};g._frameId=a.requestAnimationFrame(m)}}},scrollXto:function(a,b,c){return this.scrollTo("horizontal",a,b,c)},scrollYto:function(a,b,c){return this.scrollTo("vertical",a,b,c)},scrollXby:function(a,b,c){return this.scrollBy("horizontal",a,b,c)},scrollYby:function(a,b,c){return this.scrollBy("vertical",a,b,c)},getBar:function(a){return a&&this["$"+a]?this["$"+a]:this.$bar},getBarApi:function(a){return this.getBar(a).data("asScrollbar")},getBarX:function(){return this.getBar("horizontal")},getBarY:function(){return this.getBar("vertical")},showBar:function(a){this.getBar(a).removeClass(this.classes.barHide)},hideBar:function(a){this.getBar(a).addClass(this.classes.barHide)},updateBarHandle:function(a){var b=this.getBarApi(a),c=this.getScrollLength(a),d=this.getContainerLength(a);c>0?(b.is("disabled")&&b.enable(),b.setHandleLength(b.getBarLength()*d/(c+d),!0)):b.disable()},disable:function(){this.is("disabled")||(this.enter("disabled"),this.$wrap.addClass(this.options.disabledClass).removeClass(this.options.enabledClass),this.unbindEvents(),this.unStyle())},enable:function(){this.is("disabled")&&(this.leave("disabled"),this.$wrap.addClass(this.options.enabledClass).removeClass(this.options.disabledClass),this.bindEvents(),this.update())},update:function(){this.is("disabled")||(this.vertical&&(this.initLayout("vertical"),this.updateBarHandle("vertical")),this.horizontal&&(this.initLayout("horizontal"),this.updateBarHandle("horizontal")))},unStyle:function(){this.horizontal&&(this.$container.css({height:"","padding-bottom":""}),this.$content.css({height:""})),this.vertical&&(this.$container.css({width:"",height:"","padding-right":""}),this.$content.css({width:""})),this.options.containerSelector||this.$wrap.css({height:""})},destory:function(){this.$wrap.removeClass(this.classes.wrap+"-vertical").removeClass(this.classes.wrap+"-horizontal").removeClass(this.classes.wrap).removeClass(this.options.enabledClass).removeClass(this.classes.disabledClass),this.unStyle(),this.$bar&&this.$bar.remove(),this.unbindEvents(),this.options.containerSelector?this.$container.removeClass(this.classes.container):this.$container.unwrap(),this.options.contentSelector||this.$content.unwrap(),this.$content.removeClass(this.classes.content),this.$element.data(j,null)}},c.fn[j]=function(a){if("string"!=typeof a)return this.each(function(){c(this).data(j)?c(this).data(j).update():c(this).data(j,new m(a,this))});var b=a,d=Array.prototype.slice.call(arguments,1);if(/^\_/.test(b))return!1;if(!/^(get)/.test(b))return this.each(function(){var a=c.data(this,j);a&&"function"==typeof a[b]&&a[b].apply(a,d)});var e=this.first().data(j);return e&&"function"==typeof e[b]?e[b].apply(e,d):this}}(window,document,jQuery,function(a){"use strict";return void 0===a.asScrollbar?!1:a.asScrollbar}(jQuery));
/*jquery-asScroll.min.js*/
/*! jQuery asScroll - v0.1.1 - 2015-05-11
* https://github.com/amazingSurge/jquery-asScroll
* Copyright (c) 2015 amazingSurge; Licensed GPL */
!function(a,b,c,d){"use strict";var e=0,f=function(){return"undefined"!=typeof a.performance&&a.performance.now?a.performance.now():Date.now()},g=function(a){return"string"==typeof a&&-1!==a.indexOf("%")},h=function(a){return parseFloat(a.slice(0,-1)/100,10)},i=function(){return a.requestAnimationFrame||a.webkitRequestAnimationFrame||a.mozRequestAnimationFrame||function(b){a.setTimeout(b,1e3/60)}}(),j=function(){return a.cancelAnimationFrame||a.webkitCancelAnimationFrame||a.mozCancelAnimationFrame||function(b){a.clearTimeout(b)}}(),k=function(a,b,c,d){function e(a,b){return 1-3*b+3*a}function f(a,b){return 3*b-6*a}function g(a){return 3*a}function h(a,b,c){return((e(b,c)*a+f(b,c))*a+g(b))*a}function i(a,b,c){return 3*e(b,c)*a*a+2*f(b,c)*a+g(b)}function j(b){for(var d=b,e=0;4>e;++e){var f=i(d,a,c);if(0===f)return d;var g=h(d,a,c)-b;d-=g/f}return d}return a===b&&c===d?{css:"linear",fn:function(a){return a}}:{css:"cubic-bezier("+a+","+b+","+c+","+d+")",fn:function(a){return h(j(a),b,d)}}},l=function(d,f){this.element=d,this.$element=c(d),this.options=c.extend(!0,{},l.defaults,f),this.options.containerSelector?this.$container=c(this.options.containerSelector):this.$container=this.$element.is(b.body)?c(a):this.$element.parent(),1===this.$container.length&&(this.namespace=this.options.namespace,this.attributes={vertical:{axis:"Y",overflow:"overflow-y",scroll:"scrollTop",scrollLength:"scrollHeight",pageOffset:"pageYOffset",ffPadding:"padding-right",length:"height",clientLength:"clientHeight",offsetLength:"offsetHeight",offset:"top",crossOffset:"left",crossLength:"width",crossClientLength:"clientWidth",crossOffsetLength:"offsetWidth"},horizontal:{axis:"X",overflow:"overflow-x",scroll:"scrollLeft",scrollLength:"scrollWidth",pageOffset:"pageXOffset",ffPadding:"padding-bottom",length:"width",clientLength:"clientWidth",offsetLength:"offsetWidth",offset:"left",crossOffset:"top",crossLength:"height",crossClientLength:"clientHeight",crossOffsetLength:"offsetHeight"}},this.classes={},this.easing=l.easing[this.options.easing]||l.easing.ease,this.duration=this.options.duration,this._frameId=null,this._states={},this.instanceId=++e,this.vertical=!1,this.horizontal=!1,this.init())};c.extend(l.easing={},{ease:k(.25,.1,.25,1),linear:k(0,0,1,1),"ease-in":k(.42,0,1,1),"ease-out":k(0,0,.58,1),"ease-in-out":k(.42,0,.58,1)}),l.prototype={constructor:l,getActiveTarget:function(a){if(this[a]){var b=this.getOffset(a),d=this.attributes[a],e=null,f=this.getContainerLength(a);return c.each(this.lists,function(a,c){var g=c.offset[d.offset],h=c.$el[d.length]();return g===b?(e=a,!1):g>b&&b+f>g?(e=a,!1):b>g&&g+h>b?(e=a,!0):g>b+f?!1:void 0}),e}},init:function(){var a=this;this.$targets=this.$element.find("[data-scroll-target]"),this.lists={},this.getScrollLength("vertical")>0&&(this.vertical=!0),this.getScrollLength("horizontal")>0&&(this.horizontal=!0),this.$targets.each(function(){var b=c(this);a.lists[b.data("scrollTarget")]={$el:b,offset:b.offset()}}),this.bindEvents()},bindEvents:function(){var b=this;c(a).on(this.eventNameWithId("resize"),function(){c(a).width()<b.options.mobile.width&&(b.duration=b.options.duration,b.easing=l.easing[b.options.easing]||l.easing.ease)}),c(a).on(this.eventNameWithId("orientationchange"),function(){c(a).width()<b.options.mobile.width&&(b.duration=b.options.duration,b.easing=l.easing[b.options.easing]||l.easing.ease)}),(this.horizontal||this.vertical)&&this.$container.on(this.eventName("scroll"),function(){b.vertical&&b.trigger(b.eventName("active"),["vertical",b.getActiveTarget("vertical")]),b.horizontal&&b.trigger(b.eventName("active"),["horizontal",b.getActiveTarget("horizontal")])})},eventName:function(a){if("string"!=typeof a||""===a)return"."+this.options.namespace;a=a.split(" ");for(var b=a.length,c=0;b>c;c++)a[c]=a[c]+"."+this.options.namespace;return a.join(" ")},eventNameWithId:function(a){if("string"!=typeof a||""===a)return this.options.namespace+"-"+this.instanceId;a=a.split(" ");for(var b=a.length,c=0;b>c;c++)a[c]=a[c]+"."+this.options.namespace+"-"+this.instanceId;return a.join(" ")},trigger:function(a){var b=Array.prototype.slice.call(arguments,1),c=[this].concat(b);this.$element.trigger("AsScroll::"+a,c),a=a.replace(/\b\w+\b/g,function(a){return a.substring(0,1).toUpperCase()+a.substring(1)});var d="on"+a;"function"==typeof this.options[d]&&this.options[d].apply(this,b)},is:function(a){return this._states[a]&&this._states[a]>0},enter:function(a){this._states[a]===d&&(this._states[a]=0),this._states[a]++},leave:function(a){this._states[a]--},getOffset:function(a){var b=this.attributes[a],c=this.$element[0];return c[b.pageOffset]||c[b.scroll]},getPercentOffset:function(a){return this.getOffset(a)/this.getScrollLength(a)},getContainerLength:function(b){return this.$container[0]===a?this.$container[this.attributes[b].length]():this.$container[0][this.attributes[b].clientLength]},getScrollLength:function(a){var b=this.$element[0][this.attributes[a].scrollLength];return b-this.getContainerLength(a)},scrollToTarget:function(a,b,c,d){if("undefined"!=typeof this.lists[b]){b=this.lists[b];var e=this.attributes[a],f=b.offset[e.offset];this.scrollTo(a,f,c,d)}},scrollTo:function(a,b,c,d){var e=typeof b;"string"===e&&(g(b)&&(b=h(b)*this.getScrollLength(a)),b=parseFloat(b),e="number"),"number"===e&&this.move(a,b,c,d)},scrollBy:function(a,b,c,d){var e=typeof b;"string"===e&&(g(b)&&(b=h(b)*this.getScrollLength(a)),b=parseFloat(b),e="number"),"number"===e&&this.move(a,this.getOffset(a)+b,c,d)},move:function(a,b,c,d){if(this[a]&&"number"==typeof b){var e=this;this.enter("moving"),0>b?b=0:b>this.getScrollLength(a)&&(b=this.getScrollLength(a));var g=this.attributes[a],h=function(){e.leave("moving")};if(d)this.$element[0][g.scroll]=b,c!==!1&&this.trigger("change",b/this.getScrollLength(a)),h();else{e.enter("animating");var k=f(),l=e.getOffset(a),m=b,n=function(d){var f=(d-k)/e.duration;f>1&&(f=1),f=e.easing.fn(f);var o=parseFloat(l+f*(m-l),10);e.$element[0][g.scroll]=o,c!==!1&&e.trigger("change",b/e.getScrollLength(a)),1===f?(j(e._frameId),e._frameId=null,e.leave("animating"),h()):e._frameId=i(n)};e._frameId=i(n)}}},scrollXto:function(a,b,c){return this.scrollTo("horizontal",a,b,c)},scrollYto:function(a,b,c){return this.scrollTo("vertical",a,b,c)},scrollXby:function(a,b,c){return this.scrollBy("horizontal",a,b,c)},scrollYby:function(a,b,c){return this.scrollBy("vertical",a,b,c)},scrollXToTarget:function(a,b,c){return this.scrollToTarget("horizontal",a,b,c)},scrollYToTarget:function(a,b,c){return this.scrollToTarget("vertical",a,b,c)}},l.defaults={duration:800,easing:"ease",namespace:"asScroll",offsetTop:50,mobile:{width:768,duration:500,easing:"ease"}},c.fn.asScroll=function(a){if("string"==typeof a){var b=a,d=Array.prototype.slice.call(arguments,1);return this.each(function(){var a=c.data(this,"asScroll");a&&"function"==typeof a[b]&&a[b].apply(a,d)})}return this.each(function(){var b=c.data(this,"asScroll");b||(b=new l(this,a),c.data(this,"asScroll",b))})}}(window,document,jQuery);
/*asscrollable.min.js*/
/*!
 * remark (http://getbootstrapadmin.com/remark)
 * Copyright 2015 amazingsurge
 * Licensed under the Themeforest Standard Licenses
 */
$.components.register("scrollable", {
  mode: "init",
  defaults: {
    namespace: "scrollable",
    contentSelector: "> [data-role='content']",
    containerSelector: "> [data-role='container']"
  },
  init: function(context) {
    if (!$.fn.asScrollable) return;
    var defaults = $.components.getDefaults("scrollable");

    $('[data-plugin="scrollable"]', context).each(function() {
      var options = $.extend({}, defaults, $(this).data());

      $(this).asScrollable(options);
    });
  }
});

/*jquery-slidePanel.min.js*/
/*! jQuery slidePanel - v0.2.2 - 2015-10-14
* https://github.com/amazingSurge/jquery-slidePanel
* Copyright (c) 2015 amazingSurge; Licensed GPL */
!function(a,b,c,d){"use strict";function e(){return"undefined"!=typeof c.performance&&c.performance.now?c.performance.now():Date.now()}function f(a){return"string"==typeof a&&-1!=a.indexOf("%")}function g(a){return"string"==typeof a&&-1!=a.indexOf("px")}function h(a){return a&&"matrix"==a.substr(0,6)?a.replace(/^.*\((.*)\)$/g,"$1").replace(/px/g,"").split(/, +/):!1}function i(a){"string"!=typeof a&&(a=JSON.stringify(a));var b,c,d,e=0;if(0===a.length)return e;for(b=0,d=a.length;d>b;b++)c=a.charCodeAt(b),e=(e<<5)-e+c,e|=0;return e}function j(a,b,c,d){function e(a,b){return 1-3*b+3*a}function f(a,b){return 3*b-6*a}function g(a){return 3*a}function h(a,b,c){return((e(b,c)*a+f(b,c))*a+g(b))*a}function i(a,b,c){return 3*e(b,c)*a*a+2*f(b,c)*a+g(b)}function j(b){for(var d=b,e=0;4>e;++e){var f=i(d,a,c);if(0===f)return d;var g=h(d,a,c)-b;d-=g/f}return d}return a===b&&c===d?{css:"linear",fn:function(a){return a}}:{css:"cubic-bezier("+a+","+b+","+c+","+d+")",fn:function(a){return h(j(a),b,d)}}}function k(){return this.initialize.apply(this,Array.prototype.slice.call(arguments))}function l(){return this.initialize.apply(this,Array.prototype.slice.call(arguments))}function m(){return this.initialize.apply(this,Array.prototype.slice.call(arguments))}function n(){return this.initialize.apply(this,Array.prototype.slice.call(arguments))}var o=a.slidePanel=function(){o.show.apply(this,arguments)};Date.now||(Date.now=function(){return(new Date).getTime()});for(var p=["webkit","moz"],q=0;q<p.length&&!c.requestAnimationFrame;++q){var r=p[q];c.requestAnimationFrame=c[r+"RequestAnimationFrame"],c.cancelAnimationFrame=c[r+"CancelAnimationFrame"]||c[r+"CancelRequestAnimationFrame"]}if(/iP(ad|hone|od).*OS (6|7|8)/.test(c.navigator.userAgent)||!c.requestAnimationFrame||!c.cancelAnimationFrame){var s=0;c.requestAnimationFrame=function(a){var b=e(),c=Math.max(s+16,b);return setTimeout(function(){a(s=c)},c-b)},c.cancelAnimationFrame=clearTimeout}var t=function(){function e(b,c){var e=!1,f=b.charAt(0).toUpperCase()+b.slice(1);return g[b]!==d&&(e=b),e||a.each(h,function(a,b){return g[b+f]!==d?(e="-"+b.toLowerCase()+"-"+f,!1):void 0}),c?e:e?!0:!1}function f(a){return e(a,!0)}var g=a("<support>").get(0).style,h=["webkit","Moz","O","ms"],i={transition:{end:{WebkitTransition:"webkitTransitionEnd",MozTransition:"transitionend",OTransition:"oTransitionEnd",transition:"transitionend"}},animation:{end:{WebkitAnimation:"webkitAnimationEnd",MozAnimation:"animationend",OAnimation:"oAnimationEnd",animation:"animationend"}}},j={csstransforms:function(){return!!e("transform")},csstransforms3d:function(){return!!e("perspective")},csstransitions:function(){return!!e("transition")},cssanimations:function(){return!!e("animation")}},k={};return j.csstransitions()&&(k.transition=new String(f("transition")),k.transition.end=i.transition.end[k.transition]),j.cssanimations()&&(k.animation=new String(f("animation")),k.animation.end=i.animation.end[k.animation]),j.csstransforms()&&(k.transform=new String(f("transform")),k.transform3d=j.csstransforms3d()),k.touch="ontouchstart"in c||c.DocumentTouch&&b instanceof c.DocumentTouch?!0:!1,k.pointer=c.PointerEvent||c.MSPointerEvent?!0:!1,k.prefixPointerEvent=function(a){return c.MSPointerEvent?"MSPointer"+a.charAt(9).toUpperCase()+a.substr(10):a},k}(),u={ease:j(.25,.1,.25,1),linear:j(0,0,1,1),"ease-in":j(.42,0,1,1),"ease-out":j(0,0,.58,1),"ease-in-out":j(.42,0,.58,1)};o.options={skin:null,classes:{base:"slidePanel",show:"slidePanel-show",loading:"slidePanel-loading",content:"slidePanel-content",dragging:"slidePanel-dragging",willClose:"slidePanel-will-close"},closeSelector:null,template:function(a){return'<div class="'+a.classes.base+" "+a.classes.base+"-"+a.direction+'"><div class="'+a.classes.content+'"></div></div>'},loading:{appendTo:"panel",template:function(a){return'<div class="'+a.classes.loading+'"></div>'},showCallback:function(a){this.$el.addClass(a.classes.loading+"-show")},hideCallback:function(a){this.$el.removeClass(a.classes.loading+"-show")}},contentFilter:function(a){return a},useCssTransforms3d:!0,useCssTransforms:!0,useCssTransitions:!0,dragTolerance:150,mouseDragHandler:null,mouseDrag:!0,touchDrag:!0,pointerDrag:!0,direction:"right",duration:"500",easing:"ease",beforeLoad:a.noop,afterLoad:a.noop,beforeShow:a.noop,afterShow:a.noop,onChange:a.noop,beforeChange:a.noop,beforeHide:a.noop,afterHide:a.noop,beforeDrag:a.noop,afterDrag:a.noop},a.extend(k.prototype,{initialize:function(a){this.options=a,this._instance=null,this._showed=!1,this._isLoading=!1,this.build()},setLength:function(){switch(this.options.direction){case"top":case"bottom":this._length=this.$panel.outerHeight();break;case"left":case"right":this._length=this.$panel.outerWidth()}},build:function(){if(!this._builded){var b=this.options,c=b.template.call(this,b),d=this;this.$panel=a(c).appendTo("body"),b.skin&&this.$panel.addClass(b.skin),this.$content=this.$panel.find("."+this.options.classes.content),b.closeSelector&&this.$panel.on("click",b.closeSelector,function(){return d.hide(),!1}),this.loading=new l(this),this.setLength(),this.setPosition(this.getHidePosition()),(b.mouseDrag||b.touchDrag||b.pointerDrag)&&(this.drag=new m(this)),this._builded=!0}},getHidePosition:function(){var b=this.options;if(b.useCssTransforms||b.useCssTransforms3d)switch(b.direction){case"top":case"left":return"-100";case"bottom":case"right":return"100"}else switch(b.direction){case"top":case"bottom":return parseFloat(100*-(this._length/a(c).height()),10);case"left":case"right":return parseFloat(100*-(this._length/a(c).width()),10)}},empty:function(){this._instance=null,this.$content.empty()},load:function(b){function c(a){a=e.contentFilter.call(this,a,b),d.$content.html(a),d.hideLoading(),d._instance=b,w.trigger(d,"afterLoad",b)}{var d=this,e=b.options;this._instance}w.trigger(this,"beforeLoad",b),this.empty(),b.content?c(b.content):b.url?(this.showLoading(),a.ajax(b.url,b.settings||{}).done(function(a){c(a)})):c("")},showLoading:function(){var a=this;this.loading.show(function(){a._isLoading=!0})},hideLoading:function(){var a=this;this.loading.hide(function(){a._isLoading=!1})},show:function(b){this.build(),w.enter("show"),w.trigger(this,"beforeShow"),a("html").addClass(this.options.classes.base+"-html"),this.$panel.addClass(this.options.classes.show);var c=this;v["do"](this,0,function(){c._showed=!0,w.trigger(c,"afterShow"),a.isFunction(b)&&b.call(c)})},change:function(a){w.trigger(this,"beforeShow"),w.trigger(this,"onChange",a,this._instance),this.load(a),w.trigger(this,"afterShow")},revert:function(b){var c=this;v["do"](this,0,function(){a.isFunction(b)&&b.call(c)})},hide:function(b){w.leave("show"),w.trigger(this,"beforeHide");var c=this;v["do"](this,this.getHidePosition(),function(){c.$panel.removeClass(c.options.classes.show),c._showed=!1,c._instance=null,w._current===c&&(w._current=null),w.is("show")||a("html").removeClass(c.options.classes.base+"-html"),a.isFunction(b)&&b.call(c),w.trigger(c,"afterHide")})},makePositionStyle:function(a){var b,c="0",d="0";f(a)||g(a)||(a+="%"),this.options.useCssTransforms&&t.transform?("left"===this.options.direction||"right"===this.options.direction?c=a:d=a,b=t.transform.toString(),a=this.options.useCssTransforms3d&&t.transform3d?"translate3d("+c+","+d+",0)":"translate("+c+","+d+")"):b=this.options.direction;var e={};return e[b]=a,e},getPosition:function(a){var b;if(this.options.useCssTransforms&&t.transform){if(b=h(this.$panel.css(t.transform)),!b)return 0;b="left"===this.options.direction||"right"===this.options.direction?b[12]||b[4]:b[13]||b[5]}else b=this.$panel.css(this.options.direction),b=parseFloat(b.replace("px",""));return a!==!0&&(b=b/this._length*100),parseFloat(b,10)},setPosition:function(a){var b=this.makePositionStyle(a);this.$panel.css(b)}}),a.extend(l.prototype,{initialize:function(a){this._view=a,this.build()},build:function(){if(!this._builded){var b=this._view.options,c=b.loading.template.call(this,b);switch(this.$el=a(c),b.loading.appendTo){case"panel":this.$el.appendTo(this._view.$panel);break;case"body":this.$el.appendTo("body");break;default:this.$el.appendTo(b.loading.appendTo)}this._builded=!0}},show:function(b){this.build();var c=this._view.options;c.loading.showCallback.call(this,c),a.isFunction(b)&&b.call(this)},hide:function(b){var c=this._view.options;c.loading.hideCallback.call(this,c),a.isFunction(b)&&b.call(this)}});var v={prepareTransition:function(b,c,d,e,f){var g=[];c&&g.push(c),d&&(a.isNumeric(d)&&(d+="ms"),g.push(d)),g.push(e?e:this.easing.css),f&&g.push(f),b.css(t.transition,g.join(" "))},"do":function(b,d,f){w.enter("animating");var g=b.options.duration,h=b.options.easing||"ease",i=this,j=b.makePositionStyle(d);for(var k in j)break;if(b.options.useCssTransitions&&t.transition)setTimeout(function(){i.prepareTransition(b.$panel,k,g,h)},20),b.$panel.one(t.transition.end,function(){a.isFunction(f)&&f(),b.$panel.css(t.transition,""),w.leave("animating")}),setTimeout(function(){b.setPosition(d)},20);else{var l=e(),m=b.getPosition(),n=d,o=function(d){var e=(d-l)/b.options.duration;e>1&&(e=1),e=u[h].fn(e);var g=parseFloat(m+e*(n-m),10);b.setPosition(g),1===e?(c.cancelAnimationFrame(i._frameId),i._frameId=null,a.isFunction(f)&&f(),w.leave("animating")):i._frameId=c.requestAnimationFrame(o)};i._frameId=c.requestAnimationFrame(o)}}};a.extend(m.prototype,{initialize:function(a){this._view=a,this.options=a.options,this._drag={time:null,pointer:null},this.bindEvents()},bindEvents:function(){var b=this.options,c=this._view.$panel;b.mouseDrag&&(c.on(w.eventName("mousedown"),a.proxy(this.onDragStart,this)),c.on(w.eventName("dragstart selectstart"),function(){return!b.mouseDragHandler||a(event.target).is(b.mouseDragHandler)||a(event.target).parents(b.mouseDragHandler).length>0?!1:void 0})),b.touchDrag&&t.touch&&(c.on(w.eventName("touchstart"),a.proxy(this.onDragStart,this)),c.on(w.eventName("touchcancel"),a.proxy(this.onDragEnd,this))),b.pointerDrag&&t.pointer&&(c.on(w.eventName(t.prefixPointerEvent("pointerdown")),a.proxy(this.onDragStart,this)),c.on(w.eventName(t.prefixPointerEvent("pointercancel")),a.proxy(this.onDragEnd,this)))},onDragStart:function(c){var d=this;if(3!==c.which){var e=this.options;this._view.$panel.addClass(this.options.classes.dragging),this._position=this._view.getPosition(!0),this._drag.time=(new Date).getTime(),this._drag.pointer=this.pointer(c);var f=function(){w.enter("dragging"),w.trigger(d._view,"beforeDrag")};if(e.mouseDrag){if(e.mouseDragHandler&&!(a(c.target).is(e.mouseDragHandler)||a(c.target).parents(e.mouseDragHandler).length>0))return;a(b).on(w.eventName("mouseup"),a.proxy(this.onDragEnd,this)),a(b).one(w.eventName("mousemove"),a.proxy(function(){a(b).on(w.eventName("mousemove"),a.proxy(this.onDragMove,this)),f()},this))}e.touchDrag&&t.touch&&(a(b).on(w.eventName("touchend"),a.proxy(this.onDragEnd,this)),a(b).one(w.eventName("touchmove"),a.proxy(function(){a(b).on(w.eventName("touchmove"),a.proxy(this.onDragMove,this)),f()},this))),e.pointerDrag&&t.pointer&&(a(b).on(w.eventName(t.prefixPointerEvent("pointerup")),a.proxy(this.onDragEnd,this)),a(b).one(w.eventName(t.prefixPointerEvent("pointermove")),a.proxy(function(){a(b).on(w.eventName(t.prefixPointerEvent("pointermove")),a.proxy(this.onDragMove,this)),f()},this))),a(b).on(w.eventName("blur"),a.proxy(this.onDragEnd,this)),c.preventDefault()}},onDragMove:function(a){var b=this.distance(this._drag.pointer,this.pointer(a));w.is("dragging")&&(Math.abs(b)>this.options.dragTolerance?this._willClose!==!0&&(this._willClose=!0,this._view.$panel.addClass(this.options.classes.willClose)):this._willClose!==!1&&(this._willClose=!1,this._view.$panel.removeClass(this.options.classes.willClose)),w.is("dragging")&&(a.preventDefault(),this.move(b)))},onDragEnd:function(c){var d=this.distance(this._drag.pointer,this.pointer(c));a(b).off(w.eventName("mousemove mouseup touchmove touchend pointermove pointerup MSPointerMove MSPointerUp blur")),this._view.$panel.removeClass(this.options.classes.dragging),this._willClose===!0&&(this._willClose=!1,this._view.$panel.removeClass(this.options.classes.willClose)),w.is("dragging")&&(w.leave("dragging"),w.trigger(this._view,"afterDrag"),Math.abs(d)<this.options.dragTolerance?this._view.revert():w.hide())},pointer:function(a){var b={x:null,y:null};return a=a.originalEvent||a||c.event,a=a.touches&&a.touches.length?a.touches[0]:a.changedTouches&&a.changedTouches.length?a.changedTouches[0]:a,a.pageX?(b.x=a.pageX,b.y=a.pageY):(b.x=a.clientX,b.y=a.clientY),b},distance:function(a,b){var c=this.options.direction;return"left"===c||"right"===c?b.x-a.x:b.y-a.y},move:function(a){var b=this._position+a;if("right"===this.options.direction||"bottom"===this.options.direction){if(0>b)return}else if(b>0)return;this.options.useCssTransforms||this.options.useCssTransforms3d||("right"===this.options.direction||"bottom"===this.options.direction)&&(b=-b),this._view.setPosition(b+"px")}}),a.extend(n.prototype,{initialize:function(b){var c=arguments[1]||{};if("string"==typeof b)b={url:b};else if(b&&1==b.nodeType){var d=a(b);b={url:d.attr("href"),settings:d.data("settings")||{},options:d.data()||{}}}return b.options=b&&b.options?a.extend(!0,c,b.options):c,b.options=a.extend(!0,{},o.options,b.options),a.extend(this,b),this}});var w={_states:{},_views:{},_current:null,is:function(a){return this._states[a]&&this._states[a]>0},enter:function(a){this._states[a]===d&&(this._states[a]=0),this._states[a]++},leave:function(a){this._states[a]--},trigger:function(c,d){var e=Array.prototype.slice.call(arguments,2),f=[c].concat(e);a(b).trigger("slidePanel::"+d,f),a.isFunction(c.options[d])&&c.options[d].apply(c,e)},eventName:function(a){if("string"!=typeof a||""===a)return".slidepanel";a=a.split(" ");for(var b=a.length,c=0;b>c;c++)a[c]=a[c]+".slidepanel";return a.join(" ")},show:function(a){if(!(a instanceof n))switch(arguments.length){case 0:a=new n;break;case 1:a=new n(arguments[0]);break;case 2:a=new n(arguments[0],arguments[1])}var b=this.getView(a.options),c=this,d=function(){b.show(),b.load(a),c._current=b};null!==this._current?b===this._current?this._current.change(a):this._current.hide(d):d()},getView:function(a){var b=i(a);return this._views.hasOwnProperty(b)?this._views[b]:this._views[b]=new k(a)},hide:function(a){if(a){var b=this.getView(a.options);b.hide()}else if(null!==this._current){this._current.hide()}}};a.extend(o,{is:function(a){return w.is(a)},show:function(){return w.show.apply(w,arguments),this},hide:function(){return w.hide.apply(w,arguments),this}}),a.fn.slidePanel=function(b){if("string"==typeof b){var c=b,d=Array.prototype.slice.call(arguments,1);return this.each(function(){var b=a.data(this,"slidePanel");switch(b instanceof n||(b=new n(this,d),a.data(this,"slidePanel",b)),c){case"hide":w.hide(b);break;case"show":w.show(b)}})}return this.each(function(){a.data(this,"slidePanel")||(a.data(this,"slidePanel",new n(this,b)),a(this).on("click",function(b){var c=a.data(this,"slidePanel");w.show(c),b.preventDefault(),b.stopPropagation()}))})}}(jQuery,document,window);
/*slidepanel.min.js*/
/*!
 * remark (http://getbootstrapadmin.com/remark)
 * Copyright 2015 amazingsurge
 * Licensed under the Themeforest Standard Licenses
 */
$.components.register("slidePanel",{mode:"manual",defaults:{closeSelector:".slidePanel-close",mouseDragHandler:".slidePanel-handler",loading:{template:function(options){return'<div class="'+options.classes.loading+'"><div class="loader loader-default"></div></div>'},showCallback:function(options){this.$el.addClass(options.classes.loading+"-show")},hideCallback:function(options){this.$el.removeClass(options.classes.loading+"-show")}}}});
/*formValidation.min.js*/
/*!
 * FormValidation (http://formvalidation.io)
 * The best jQuery plugin to validate form fields. Support Bootstrap, Foundation, Pure, SemanticUI, UIKit and custom frameworks
 *
 * @version     v0.6.2-dev, built on 2015-03-13 8:15:45 AM
 * @author      https://twitter.com/nghuuphuoc
 * @copyright   (c) 2013 - 2015 Nguyen Huu Phuoc
 * @license     http://formvalidation.io/license/
 */
if(window.FormValidation={AddOn:{},Framework:{},I18n:{},Validator:{}},"undefined"==typeof jQuery)throw new Error("FormValidation requires jQuery");!function(a){var b=a.fn.jquery.split(" ")[0].split(".");if(+b[0]<2&&+b[1]<9||1===+b[0]&&9===+b[1]&&+b[2]<1)throw new Error("FormValidation requires jQuery version 1.9.1 or higher")}(jQuery),function(a){FormValidation.Base=function(b,c,d){this.$form=a(b),this.options=a.extend({},a.fn.formValidation.DEFAULT_OPTIONS,c),this._namespace=d||"fv",this.$invalidFields=a([]),this.$submitButton=null,this.$hiddenButton=null,this.STATUS_NOT_VALIDATED="NOT_VALIDATED",this.STATUS_VALIDATING="VALIDATING",this.STATUS_INVALID="INVALID",this.STATUS_VALID="VALID",this.STATUS_IGNORED="IGNORED";var e=function(){for(var a=3,b=document.createElement("div"),c=b.all||[];b.innerHTML="<!--[if gt IE "+ ++a+"]><br><![endif]-->",c[0];);return a>4?a:!a}(),f=document.createElement("div");this._changeEvent=9!==e&&"oninput"in f?"input":"keyup",this._submitIfValid=null,this._cacheFields={},this._init()},FormValidation.Base.prototype={constructor:FormValidation.Base,_exceedThreshold:function(b){var c=this._namespace,d=b.attr("data-"+c+"-field"),e=this.options.fields[d].threshold||this.options.threshold;if(!e)return!0;var f=-1!==a.inArray(b.attr("type"),["button","checkbox","file","hidden","image","radio","reset","submit"]);return f||b.val().length>=e},_init:function(){var b=this,c=this._namespace,d={addOns:{},autoFocus:this.$form.attr("data-"+c+"-autofocus"),button:{selector:this.$form.attr("data-"+c+"-button-selector")||this.$form.attr("data-"+c+"-submitbuttons"),disabled:this.$form.attr("data-"+c+"-button-disabled")},control:{valid:this.$form.attr("data-"+c+"-control-valid"),invalid:this.$form.attr("data-"+c+"-control-invalid")},err:{clazz:this.$form.attr("data-"+c+"-err-clazz"),container:this.$form.attr("data-"+c+"-err-container")||this.$form.attr("data-"+c+"-container"),parent:this.$form.attr("data-"+c+"-err-parent")},events:{formInit:this.$form.attr("data-"+c+"-events-form-init"),formError:this.$form.attr("data-"+c+"-events-form-error"),formSuccess:this.$form.attr("data-"+c+"-events-form-success"),fieldAdded:this.$form.attr("data-"+c+"-events-field-added"),fieldRemoved:this.$form.attr("data-"+c+"-events-field-removed"),fieldInit:this.$form.attr("data-"+c+"-events-field-init"),fieldError:this.$form.attr("data-"+c+"-events-field-error"),fieldSuccess:this.$form.attr("data-"+c+"-events-field-success"),fieldStatus:this.$form.attr("data-"+c+"-events-field-status"),localeChanged:this.$form.attr("data-"+c+"-events-locale-changed"),validatorError:this.$form.attr("data-"+c+"-events-validator-error"),validatorSuccess:this.$form.attr("data-"+c+"-events-validator-success"),validatorIgnored:this.$form.attr("data-"+c+"-events-validator-ignored")},excluded:this.$form.attr("data-"+c+"-excluded"),icon:{valid:this.$form.attr("data-"+c+"-icon-valid")||this.$form.attr("data-"+c+"-feedbackicons-valid"),invalid:this.$form.attr("data-"+c+"-icon-invalid")||this.$form.attr("data-"+c+"-feedbackicons-invalid"),validating:this.$form.attr("data-"+c+"-icon-validating")||this.$form.attr("data-"+c+"-feedbackicons-validating"),feedback:this.$form.attr("data-"+c+"-icon-feedback")},live:this.$form.attr("data-"+c+"-live"),locale:this.$form.attr("data-"+c+"-locale"),message:this.$form.attr("data-"+c+"-message"),onError:this.$form.attr("data-"+c+"-onerror"),onSuccess:this.$form.attr("data-"+c+"-onsuccess"),row:{selector:this.$form.attr("data-"+c+"-row-selector")||this.$form.attr("data-"+c+"-group"),valid:this.$form.attr("data-"+c+"-row-valid"),invalid:this.$form.attr("data-"+c+"-row-invalid"),feedback:this.$form.attr("data-"+c+"-row-feedback")},threshold:this.$form.attr("data-"+c+"-threshold"),trigger:this.$form.attr("data-"+c+"-trigger"),verbose:this.$form.attr("data-"+c+"-verbose"),fields:{}};this.$form.attr("novalidate","novalidate").addClass(this.options.elementClass).on("submit."+c,function(a){a.preventDefault(),b.validate()}).on("click."+c,this.options.button.selector,function(){b.$submitButton=a(this),b._submitIfValid=!0}),(this.options.declarative===!0||"true"===this.options.declarative)&&this.$form.find("[name], [data-"+c+"-field]").each(function(){var e=a(this),f=e.attr("name")||e.attr("data-"+c+"-field"),g=b._parseOptions(e);g&&(e.attr("data-"+c+"-field",f),d.fields[f]=a.extend({},g,d.fields[f]))}),this.options=a.extend(!0,this.options,d),"string"==typeof this.options.err.parent&&(this.options.err.parent=new RegExp(this.options.err.parent)),this.options.container&&(this.options.err.container=this.options.container,delete this.options.container),this.options.feedbackIcons&&(this.options.icon=a.extend(!0,this.options.icon,this.options.feedbackIcons),delete this.options.feedbackIcons),this.options.group&&(this.options.row.selector=this.options.group,delete this.options.group),this.options.submitButtons&&(this.options.button.selector=this.options.submitButtons,delete this.options.submitButtons),FormValidation.I18n[this.options.locale]||(this.options.locale=a.fn.formValidation.DEFAULT_OPTIONS.locale),(this.options.declarative===!0||"true"===this.options.declarative)&&(this.options=a.extend(!0,this.options,{addOns:this._parseAddOnOptions()})),this.$hiddenButton=a("<button/>").attr("type","submit").prependTo(this.$form).addClass("fv-hidden-submit").css({display:"none",width:0,height:0}),this.$form.on("click."+this._namespace,'[type="submit"]',function(c){if(!c.isDefaultPrevented()){var d=a(c.target),e=d.is('[type="submit"]')?d.eq(0):d.parent('[type="submit"]').eq(0);!b.options.button.selector||e.is(b.options.button.selector)||e.is(b.$hiddenButton)||b.$form.off("submit."+b._namespace).submit()}});for(var e in this.options.fields)this._initField(e);for(var f in this.options.addOns)"function"==typeof FormValidation.AddOn[f].init&&FormValidation.AddOn[f].init(this,this.options.addOns[f]);this.$form.trigger(a.Event(this.options.events.formInit),{bv:this,fv:this,options:this.options}),this.options.onSuccess&&this.$form.on(this.options.events.formSuccess,function(a){FormValidation.Helper.call(b.options.onSuccess,[a])}),this.options.onError&&this.$form.on(this.options.events.formError,function(a){FormValidation.Helper.call(b.options.onError,[a])})},_initField:function(b){var c=this._namespace,d=a([]);switch(typeof b){case"object":d=b,b=b.attr("data-"+c+"-field");break;case"string":d=this.getFieldElements(b),d.attr("data-"+c+"-field",b)}if(0!==d.length&&null!==this.options.fields[b]&&null!==this.options.fields[b].validators){var e;for(e in this.options.fields[b].validators)FormValidation.Validator[e]||delete this.options.fields[b].validators[e];null===this.options.fields[b].enabled&&(this.options.fields[b].enabled=!0);for(var f=this,g=d.length,h=d.attr("type"),i=1===g||"radio"===h||"checkbox"===h,j=this._getFieldTrigger(d.eq(0)),k=a.map(j,function(a){return a+".update."+c}).join(" "),l=0;g>l;l++){var m=d.eq(l),n=this.options.fields[b].row||this.options.row.selector,o=m.closest(n),p="function"==typeof(this.options.fields[b].container||this.options.fields[b].err||this.options.err.container)?(this.options.fields[b].container||this.options.fields[b].err||this.options.err.container).call(this,m,this):this.options.fields[b].container||this.options.fields[b].err||this.options.err.container,q=p&&"tooltip"!==p&&"popover"!==p?a(p):this._getMessageContainer(m,n);p&&"tooltip"!==p&&"popover"!==p&&q.addClass(this.options.err.clazz),q.find("."+this.options.err.clazz.split(" ").join(".")+"[data-"+c+"-validator][data-"+c+'-for="'+b+'"]').remove(),o.find("i[data-"+c+'-icon-for="'+b+'"]').remove(),m.off(k).on(k,function(){f.updateStatus(a(this),f.STATUS_NOT_VALIDATED)}),m.data(c+".messages",q);for(e in this.options.fields[b].validators)m.data(c+".result."+e,this.STATUS_NOT_VALIDATED),i&&l!==g-1||a("<small/>").css("display","none").addClass(this.options.err.clazz).attr("data-"+c+"-validator",e).attr("data-"+c+"-for",b).attr("data-"+c+"-result",this.STATUS_NOT_VALIDATED).html(this._getMessage(b,e)).appendTo(q),"function"==typeof FormValidation.Validator[e].init&&FormValidation.Validator[e].init(this,m,this.options.fields[b].validators[e]);if(this.options.fields[b].icon!==!1&&"false"!==this.options.fields[b].icon&&this.options.icon&&this.options.icon.valid&&this.options.icon.invalid&&this.options.icon.validating&&(!i||l===g-1)){o.addClass(this.options.row.feedback);var r=a("<i/>").css("display","none").addClass(this.options.icon.feedback).attr("data-"+c+"-icon-for",b).insertAfter(m);(i?d:m).data(c+".icon",r),("tooltip"===p||"popover"===p)&&((i?d:m).on(this.options.events.fieldError,function(){o.addClass("fv-has-tooltip")}).on(this.options.events.fieldSuccess,function(){o.removeClass("fv-has-tooltip")}),m.off("focus.container."+c).on("focus.container."+c,function(){f._showTooltip(m,p)}).off("blur.container."+c).on("blur.container."+c,function(){f._hideTooltip(m,p)})),"string"==typeof this.options.fields[b].icon&&"true"!==this.options.fields[b].icon?r.appendTo(a(this.options.fields[b].icon)):this._fixIcon(m,r)}}d.on(this.options.events.fieldSuccess,function(a,b){var c=f.getOptions(b.field,null,"onSuccess");c&&FormValidation.Helper.call(c,[a,b])}).on(this.options.events.fieldError,function(a,b){var c=f.getOptions(b.field,null,"onError");c&&FormValidation.Helper.call(c,[a,b])}).on(this.options.events.fieldStatus,function(a,b){var c=f.getOptions(b.field,null,"onStatus");c&&FormValidation.Helper.call(c,[a,b])}).on(this.options.events.validatorError,function(a,b){var c=f.getOptions(b.field,b.validator,"onError");c&&FormValidation.Helper.call(c,[a,b])}).on(this.options.events.validatorSuccess,function(a,b){var c=f.getOptions(b.field,b.validator,"onSuccess");c&&FormValidation.Helper.call(c,[a,b])}),this.onLiveChange(d,"live",function(){f._exceedThreshold(a(this))&&f.validateField(a(this))}),d.trigger(a.Event(this.options.events.fieldInit),{bv:this,fv:this,field:b,element:d})}},_isExcluded:function(b){var c=this._namespace,d=b.attr("data-"+c+"-excluded"),e=b.attr("data-"+c+"-field")||b.attr("name");switch(!0){case!!e&&this.options.fields&&this.options.fields[e]&&("true"===this.options.fields[e].excluded||this.options.fields[e].excluded===!0):case"true"===d:case""===d:return!0;case!!e&&this.options.fields&&this.options.fields[e]&&("false"===this.options.fields[e].excluded||this.options.fields[e].excluded===!1):case"false"===d:return!1;case!!e&&this.options.fields&&this.options.fields[e]&&"function"==typeof this.options.fields[e].excluded:return this.options.fields[e].excluded.call(this,b,this);case!!e&&this.options.fields&&this.options.fields[e]&&"string"==typeof this.options.fields[e].excluded:case d:return FormValidation.Helper.call(this.options.fields[e].excluded,[b,this]);default:if(this.options.excluded){"string"==typeof this.options.excluded&&(this.options.excluded=a.map(this.options.excluded.split(","),function(b){return a.trim(b)}));for(var f=this.options.excluded.length,g=0;f>g;g++)if("string"==typeof this.options.excluded[g]&&b.is(this.options.excluded[g])||"function"==typeof this.options.excluded[g]&&this.options.excluded[g].call(this,b,this)===!0)return!0}return!1}},_getFieldTrigger:function(a){var b=this._namespace,c=a.data(b+".trigger");if(c)return c;var d=a.attr("type"),e=a.attr("data-"+b+"-field"),f="radio"===d||"checkbox"===d||"file"===d||"SELECT"===a.get(0).tagName?"change":this._changeEvent;return c=((this.options.fields[e]?this.options.fields[e].trigger:null)||this.options.trigger||f).split(" "),a.data(b+".trigger",c),c},_getMessage:function(a,b){if(!(this.options.fields[a]&&FormValidation.Validator[b]&&this.options.fields[a].validators&&this.options.fields[a].validators[b]))return"";switch(!0){case!!this.options.fields[a].validators[b].message:return this.options.fields[a].validators[b].message;case!!this.options.fields[a].message:return this.options.fields[a].message;case!!FormValidation.I18n[this.options.locale]&&!!FormValidation.I18n[this.options.locale][b]&&!!FormValidation.I18n[this.options.locale][b]["default"]:return FormValidation.I18n[this.options.locale][b]["default"];default:return this.options.message}},_getMessageContainer:function(a,b){if(!this.options.err.parent)throw new Error("The err.parent option is not defined");var c=a.parent();if(c.is(b))return c;var d=c.attr("class");return d&&this.options.err.parent.test(d)?c:this._getMessageContainer(c,b)},_parseAddOnOptions:function(){var a=this._namespace,b=this.$form.attr("data-"+a+"-addons"),c=this.options.addOns||{};if(b){b=b.replace(/\s/g,"").split(",");for(var d=0;d<b.length;d++)c[b[d]]||(c[b[d]]={})}var e,f,g,h;for(e in c)if(FormValidation.AddOn[e]){if(f=FormValidation.AddOn[e].html5Attributes)for(g in f)h=this.$form.attr("data-"+a+"-addons-"+e.toLowerCase()+"-"+g.toLowerCase()),h&&(c[e][f[g]]=h)}else delete c[e];return c},_parseOptions:function(b){var c,d,e,f,g,h,i,j,k,l=this._namespace,m=b.attr("name")||b.attr("data-"+l+"-field"),n={};for(d in FormValidation.Validator)if(c=FormValidation.Validator[d],e="data-"+l+"-"+d.toLowerCase(),f=b.attr(e)+"",k="function"==typeof c.enableByHtml5?c.enableByHtml5(b):null,k&&"false"!==f||k!==!0&&(""===f||"true"===f||e===f.toLowerCase())){c.html5Attributes=a.extend({},{message:"message",onerror:"onError",onsuccess:"onSuccess",transformer:"transformer"},c.html5Attributes),n[d]=a.extend({},k===!0?{}:k,n[d]);for(j in c.html5Attributes)g=c.html5Attributes[j],h="data-"+l+"-"+d.toLowerCase()+"-"+j,i=b.attr(h),i&&("true"===i||h===i.toLowerCase()?i=!0:"false"===i&&(i=!1),n[d][g]=i)}var o={autoFocus:b.attr("data-"+l+"-autofocus"),err:b.attr("data-"+l+"-err-container")||b.attr("data-"+l+"-container"),excluded:b.attr("data-"+l+"-excluded"),icon:b.attr("data-"+l+"-icon")||b.attr("data-"+l+"-feedbackicons")||(this.options.fields&&this.options.fields[m]?this.options.fields[m].feedbackIcons:null),message:b.attr("data-"+l+"-message"),onError:b.attr("data-"+l+"-onerror"),onStatus:b.attr("data-"+l+"-onstatus"),onSuccess:b.attr("data-"+l+"-onsuccess"),row:b.attr("data-"+l+"-row")||b.attr("data-"+l+"-group")||(this.options.fields&&this.options.fields[m]?this.options.fields[m].group:null),selector:b.attr("data-"+l+"-selector"),threshold:b.attr("data-"+l+"-threshold"),transformer:b.attr("data-"+l+"-transformer"),trigger:b.attr("data-"+l+"-trigger"),verbose:b.attr("data-"+l+"-verbose"),validators:n},p=a.isEmptyObject(o),q=a.isEmptyObject(n);return!q||!p&&this.options.fields&&this.options.fields[m]?(o.validators=n,o):null},_submit:function(){var b=this.isValid();if(null!==b){var c=b?this.options.events.formSuccess:this.options.events.formError,d=a.Event(c);this.$form.trigger(d),this.$submitButton&&(b?this._onSuccess(d):this._onError(d))}},_onError:function(b){if(!b.isDefaultPrevented()){if("submitted"===this.options.live){this.options.live="enabled";var c=this;for(var d in this.options.fields)!function(b){var d=c.getFieldElements(b);d.length&&c.onLiveChange(d,"live",function(){c._exceedThreshold(a(this))&&c.validateField(a(this))})}(d)}for(var e=this._namespace,f=0;f<this.$invalidFields.length;f++){var g=this.$invalidFields.eq(f),h=this.isOptionEnabled(g.attr("data-"+e+"-field"),"autoFocus");if(h){g.focus();break}}}},_onFieldValidated:function(b,c){var d=this._namespace,e=b.attr("data-"+d+"-field"),f=this.options.fields[e].validators,g={},h=0,i={bv:this,fv:this,field:e,element:b,validator:c,result:b.data(d+".response."+c)};if(c)switch(b.data(d+".result."+c)){case this.STATUS_INVALID:b.trigger(a.Event(this.options.events.validatorError),i);break;case this.STATUS_VALID:b.trigger(a.Event(this.options.events.validatorSuccess),i);break;case this.STATUS_IGNORED:b.trigger(a.Event(this.options.events.validatorIgnored),i)}g[this.STATUS_NOT_VALIDATED]=0,g[this.STATUS_VALIDATING]=0,g[this.STATUS_INVALID]=0,g[this.STATUS_VALID]=0,g[this.STATUS_IGNORED]=0;for(var j in f)if(f[j].enabled!==!1){h++;var k=b.data(d+".result."+j);k&&g[k]++}g[this.STATUS_VALID]+g[this.STATUS_IGNORED]===h?(this.$invalidFields=this.$invalidFields.not(b),b.trigger(a.Event(this.options.events.fieldSuccess),i)):(0===g[this.STATUS_NOT_VALIDATED]||!this.isOptionEnabled(e,"verbose"))&&0===g[this.STATUS_VALIDATING]&&g[this.STATUS_INVALID]>0&&(this.$invalidFields=this.$invalidFields.add(b),b.trigger(a.Event(this.options.events.fieldError),i))},_onSuccess:function(a){a.isDefaultPrevented()||this.disableSubmitButtons(!0).defaultSubmit()},_fixIcon:function(){},_createTooltip:function(){},_destroyTooltip:function(){},_hideTooltip:function(){},_showTooltip:function(){},defaultSubmit:function(){var b=this._namespace;this.$submitButton&&a("<input/>").attr({type:"hidden",name:this.$submitButton.attr("name")}).attr("data-"+b+"-submit-hidden","").val(this.$submitButton.val()).appendTo(this.$form),this.$form.off("submit."+b).submit()},disableSubmitButtons:function(a){return a?"disabled"!==this.options.live&&this.$form.find(this.options.button.selector).attr("disabled","disabled").addClass(this.options.button.disabled):this.$form.find(this.options.button.selector).removeAttr("disabled").removeClass(this.options.button.disabled),this},getFieldElements:function(b){if(!this._cacheFields[b])if(this.options.fields[b]&&this.options.fields[b].selector){var c=this.$form.find(this.options.fields[b].selector);this._cacheFields[b]=c.length?c:a(this.options.fields[b].selector)}else this._cacheFields[b]=this.$form.find('[name="'+b+'"]');return this._cacheFields[b]},getFieldValue:function(a,b){var c,d=this._namespace;if("string"==typeof a){if(c=this.getFieldElements(a),0===c.length)return null}else c=a,a=c.attr("data-"+d+"-field");if(!a||!this.options.fields[a])return c.val();var e=(this.options.fields[a].validators&&this.options.fields[a].validators[b]?this.options.fields[a].validators[b].transformer:null)||this.options.fields[a].transformer;return e?FormValidation.Helper.call(e,[c,b,this]):c.val()},getNamespace:function(){return this._namespace},getOptions:function(a,b,c){var d=this._namespace;if(!a)return c?this.options[c]:this.options;if("object"==typeof a&&(a=a.attr("data-"+d+"-field")),!this.options.fields[a])return null;var e=this.options.fields[a];return b?e.validators&&e.validators[b]?c?e.validators[b][c]:e.validators[b]:null:c?e[c]:e},getStatus:function(a,b){var c=this._namespace;switch(typeof a){case"object":return a.data(c+".result."+b);case"string":default:return this.getFieldElements(a).eq(0).data(c+".result."+b)}},isOptionEnabled:function(a,b){return!this.options.fields[a]||"true"!==this.options.fields[a][b]&&this.options.fields[a][b]!==!0?!this.options.fields[a]||"false"!==this.options.fields[a][b]&&this.options.fields[a][b]!==!1?"true"===this.options[b]||this.options[b]===!0:!1:!0},isValid:function(){for(var a in this.options.fields){var b=this.isValidField(a);if(null===b)return null;if(b===!1)return!1}return!0},isValidContainer:function(b){var c=this,d=this._namespace,e=[],f="string"==typeof b?a(b):b;if(0===f.length)return!0;f.find("[data-"+d+"-field]").each(function(){var b=a(this);c._isExcluded(b)||e.push(b)});for(var g=e.length,h=0;g>h;h++){var i=e[h],j=i.attr("data-"+d+"-field"),k=i.data(d+".messages").find("."+this.options.err.clazz.split(" ").join(".")+"[data-"+d+"-validator][data-"+d+'-for="'+j+'"]');if(k.filter("[data-"+d+'-result="'+this.STATUS_INVALID+'"]').length>0)return!1;if(k.filter("[data-"+d+'-result="'+this.STATUS_NOT_VALIDATED+'"]').length>0||k.filter("[data-"+d+'-result="'+this.STATUS_VALIDATING+'"]').length>0)return null}return!0},isValidField:function(b){var c=this._namespace,d=a([]);switch(typeof b){case"object":d=b,b=b.attr("data-"+c+"-field");break;case"string":d=this.getFieldElements(b)}if(0===d.length||!this.options.fields[b]||this.options.fields[b].enabled===!1)return!0;for(var e,f,g,h=d.attr("type"),i="radio"===h||"checkbox"===h?1:d.length,j=0;i>j;j++)if(e=d.eq(j),!this._isExcluded(e))for(f in this.options.fields[b].validators)if(this.options.fields[b].validators[f].enabled!==!1){if(g=e.data(c+".result."+f),g===this.STATUS_VALIDATING||g===this.STATUS_NOT_VALIDATED)return null;if(g===this.STATUS_INVALID)return!1}return!0},offLiveChange:function(b,c){if(null===b||0===b.length)return this;var d=this._namespace,e=this._getFieldTrigger(b.eq(0)),f=a.map(e,function(a){return a+"."+c+"."+d}).join(" ");return b.off(f),this},onLiveChange:function(b,c,d){if(null===b||0===b.length)return this;var e=this._namespace,f=this._getFieldTrigger(b.eq(0)),g=a.map(f,function(a){return a+"."+c+"."+e}).join(" ");switch(this.options.live){case"submitted":break;case"disabled":b.off(g);break;case"enabled":default:b.off(g).on(g,function(){d.apply(this,arguments)})}return this},updateMessage:function(b,c,d){var e=this,f=this._namespace,g=a([]);switch(typeof b){case"object":g=b,b=b.attr("data-"+f+"-field");break;case"string":g=this.getFieldElements(b)}return g.each(function(){a(this).data(f+".messages").find("."+e.options.err.clazz+"[data-"+f+'-validator="'+c+'"][data-'+f+'-for="'+b+'"]').html(d)}),this},updateStatus:function(b,c,d){var e=this._namespace,f=a([]);switch(typeof b){case"object":f=b,b=b.attr("data-"+e+"-field");break;case"string":f=this.getFieldElements(b)}if(!b||!this.options.fields[b])return this;c===this.STATUS_NOT_VALIDATED&&(this._submitIfValid=!1);for(var g=this,h=f.attr("type"),i=this.options.fields[b].row||this.options.row.selector,j="radio"===h||"checkbox"===h?1:f.length,k=0;j>k;k++){var l=f.eq(k);if(!this._isExcluded(l)){var m,n,o=l.closest(i),p=l.data(e+".messages"),q=p.find("."+this.options.err.clazz.split(" ").join(".")+"[data-"+e+"-validator][data-"+e+'-for="'+b+'"]'),r=d?q.filter("[data-"+e+'-validator="'+d+'"]'):q,s=l.data(e+".icon"),t="function"==typeof(this.options.fields[b].container||this.options.fields[b].err||this.options.err.container)?(this.options.fields[b].container||this.options.fields[b].err||this.options.err.container).call(this,l,this):this.options.fields[b].container||this.options.fields[b].err||this.options.err.container,u=null;if(d)l.data(e+".result."+d,c);else for(var v in this.options.fields[b].validators)l.data(e+".result."+v,c);switch(r.attr("data-"+e+"-result",c),c){case this.STATUS_VALIDATING:u=null,this.disableSubmitButtons(!0),l.removeClass(this.options.control.valid).removeClass(this.options.control.invalid),o.removeClass(this.options.row.valid).removeClass(this.options.row.invalid),s&&s.removeClass(this.options.icon.valid).removeClass(this.options.icon.invalid).addClass(this.options.icon.validating).show();break;case this.STATUS_INVALID:u=!1,this.disableSubmitButtons(!0),l.removeClass(this.options.control.valid).addClass(this.options.control.invalid),o.removeClass(this.options.row.valid).addClass(this.options.row.invalid),s&&s.removeClass(this.options.icon.valid).removeClass(this.options.icon.validating).addClass(this.options.icon.invalid).show();break;case this.STATUS_VALID:case this.STATUS_IGNORED:m=q.filter("[data-"+e+'-result="'+this.STATUS_VALIDATING+'"]').length>0,n=q.filter("[data-"+e+'-result="'+this.STATUS_NOT_VALIDATED+'"]').length>0,u=m||n?null:q.filter("[data-"+e+'-result="'+this.STATUS_VALID+'"]').length+q.filter("[data-"+e+'-result="'+this.STATUS_IGNORED+'"]').length===q.length,l.removeClass(this.options.control.valid).removeClass(this.options.control.invalid),u===!0?(this.disableSubmitButtons(this.isValid()===!1),c===this.STATUS_VALID&&l.addClass(this.options.control.valid)):u===!1&&(this.disableSubmitButtons(!0),c===this.STATUS_VALID&&l.addClass(this.options.control.invalid)),s&&(s.removeClass(this.options.icon.invalid).removeClass(this.options.icon.validating).removeClass(this.options.icon.valid),c===this.STATUS_VALID&&s.addClass(null===u?"":u?this.options.icon.valid:m?this.options.icon.validating:this.options.icon.invalid).show());var w=this.isValidContainer(o);null!==w&&(o.removeClass(this.options.row.valid).removeClass(this.options.row.invalid),(c===this.STATUS_VALID||q.length>1)&&o.addClass(w?this.options.row.valid:this.options.row.invalid));break;case this.STATUS_NOT_VALIDATED:default:u=null,this.disableSubmitButtons(!1),l.removeClass(this.options.control.valid).removeClass(this.options.control.invalid),o.removeClass(this.options.row.valid).removeClass(this.options.row.invalid),s&&s.removeClass(this.options.icon.valid).removeClass(this.options.icon.invalid).removeClass(this.options.icon.validating).hide()}!s||"tooltip"!==t&&"popover"!==t?c===this.STATUS_INVALID?r.show():r.hide():u===!1?this._createTooltip(l,q.filter("[data-"+e+'-result="'+g.STATUS_INVALID+'"]').eq(0).html(),t):this._destroyTooltip(l,t),l.trigger(a.Event(this.options.events.fieldStatus),{bv:this,fv:this,field:b,element:l,status:c}),this._onFieldValidated(l,d)}}return this},validate:function(){if(a.isEmptyObject(this.options.fields))return this._submit(),this;this.disableSubmitButtons(!0),this._submitIfValid=!1;for(var b in this.options.fields)this.validateField(b);return this._submit(),this._submitIfValid=!0,this},validateField:function(b){var c=this._namespace,d=a([]);switch(typeof b){case"object":d=b,b=b.attr("data-"+c+"-field");break;case"string":d=this.getFieldElements(b)}if(0===d.length||!this.options.fields[b]||this.options.fields[b].enabled===!1)return this;for(var e,f,g=this,h=d.attr("type"),i="radio"===h||"checkbox"===h?1:d.length,j="radio"===h||"checkbox"===h,k=this.options.fields[b].validators,l=this.isOptionEnabled(b,"verbose"),m=0;i>m;m++){var n=d.eq(m);if(!this._isExcluded(n)){var o=!1;for(e in k){if(n.data(c+".dfs."+e)&&n.data(c+".dfs."+e).reject(),o)break;var p=n.data(c+".result."+e);if(p!==this.STATUS_VALID&&p!==this.STATUS_INVALID)if(k[e].enabled!==!1)if(n.data(c+".result."+e,this.STATUS_VALIDATING),f=FormValidation.Validator[e].validate(this,n,k[e]),"object"==typeof f&&f.resolve)this.updateStatus(j?b:n,this.STATUS_VALIDATING,e),n.data(c+".dfs."+e,f),f.done(function(a,b,d){a.removeData(c+".dfs."+b).data(c+".response."+b,d),d.message&&g.updateMessage(a,b,d.message),g.updateStatus(j?a.attr("data-"+c+"-field"):a,d.valid===!0?g.STATUS_VALID:d.valid===!1?g.STATUS_INVALID:g.STATUS_IGNORED,b),d.valid&&g._submitIfValid===!0?g._submit():d.valid!==!1||l||(o=!0)});else if("object"==typeof f&&void 0!==f.valid){if(n.data(c+".response."+e,f),f.message&&this.updateMessage(j?b:n,e,f.message),this.updateStatus(j?b:n,f.valid===!0?this.STATUS_VALID:f.valid===!1?this.STATUS_INVALID:this.STATUS_IGNORED,e),f.valid===!1&&!l)break}else if("boolean"==typeof f){if(n.data(c+".response."+e,f),this.updateStatus(j?b:n,f?this.STATUS_VALID:this.STATUS_INVALID,e),!f&&!l)break}else(null===f||void 0===f)&&(n.data(c+".response."+e,f),this.updateStatus(j?b:n,this.STATUS_IGNORED,e));else this.updateStatus(j?b:n,this.STATUS_VALID,e);else this._onFieldValidated(n,e)}}}return this},addField:function(b,c){var d=this._namespace,e=a([]);switch(typeof b){case"object":e=b,b=b.attr("data-"+d+"-field")||b.attr("name");break;case"string":delete this._cacheFields[b],e=this.getFieldElements(b)}e.attr("data-"+d+"-field",b);for(var f=e.attr("type"),g="radio"===f||"checkbox"===f?1:e.length,h=0;g>h;h++){var i=e.eq(h),j=this._parseOptions(i);j=null===j?c:a.extend(!0,j,c),this.options.fields[b]=a.extend(!0,this.options.fields[b],j),this._cacheFields[b]=this._cacheFields[b]?this._cacheFields[b].add(i):i,this._initField("checkbox"===f||"radio"===f?b:i)}return this.disableSubmitButtons(!1),this.$form.trigger(a.Event(this.options.events.fieldAdded),{field:b,element:e,options:this.options.fields[b]}),this},destroy:function(){var a,b,c,d,e,f,g,h=this._namespace;for(b in this.options.fields)for(c=this.getFieldElements(b),a=0;a<c.length;a++){d=c.eq(a);for(e in this.options.fields[b].validators)d.data(h+".dfs."+e)&&d.data(h+".dfs."+e).reject(),d.removeData(h+".result."+e).removeData(h+".response."+e).removeData(h+".dfs."+e),"function"==typeof FormValidation.Validator[e].destroy&&FormValidation.Validator[e].destroy(this,d,this.options.fields[b].validators[e])}for(b in this.options.fields)for(c=this.getFieldElements(b),g=this.options.fields[b].row||this.options.row.selector,a=0;a<c.length;a++){d=c.eq(a),d.data(h+".messages").find("."+this.options.err.clazz.split(" ").join(".")+"[data-"+h+"-validator][data-"+h+'-for="'+b+'"]').remove().end().end().removeData(h+".messages").closest(g).removeClass(this.options.row.valid).removeClass(this.options.row.invalid).removeClass(this.options.row.feedback).end().off("."+h).removeAttr("data-"+h+"-field");var i="function"==typeof(this.options.fields[b].container||this.options.fields[b].err||this.options.err.container)?(this.options.fields[b].container||this.options.fields[b].err||this.options.err.container).call(this,d,this):this.options.fields[b].container||this.options.fields[b].err||this.options.err.container;("tooltip"===i||"popover"===i)&&this._destroyTooltip(d,i),f=d.data(h+".icon"),f&&f.remove(),d.removeData(h+".icon").removeData(h+".trigger")}for(var j in this.options.addOns)"function"==typeof FormValidation.AddOn[j].destroy&&FormValidation.AddOn[j].destroy(this,this.options.addOns[j]);this.disableSubmitButtons(!1),this.$hiddenButton.remove(),this.$form.removeClass(this.options.elementClass).off("."+h).removeData("bootstrapValidator").removeData("formValidation").find("[data-"+h+"-submit-hidden]").remove().end().find('[type="submit"]').off("click."+h)},enableFieldValidators:function(a,b,c){var d=this.options.fields[a].validators;if(c&&d&&d[c]&&d[c].enabled!==b)this.options.fields[a].validators[c].enabled=b,this.updateStatus(a,this.STATUS_NOT_VALIDATED,c);else if(!c&&this.options.fields[a].enabled!==b){this.options.fields[a].enabled=b;for(var e in d)this.enableFieldValidators(a,b,e)}return this},getDynamicOption:function(a,b){var c="string"==typeof a?this.getFieldElements(a):a,d=c.val();if("function"==typeof b)return FormValidation.Helper.call(b,[d,this,c]);if("string"==typeof b){var e=this.getFieldElements(b);return e.length?e.val():FormValidation.Helper.call(b,[d,this,c])||b}return null},getForm:function(){return this.$form},getInvalidFields:function(){return this.$invalidFields},getLocale:function(){return this.options.locale},getMessages:function(b,c){var d=this,e=this._namespace,f=[],g=a([]);switch(!0){case b&&"object"==typeof b:g=b;break;case b&&"string"==typeof b:var h=this.getFieldElements(b);if(h.length>0){var i=h.attr("type");g="radio"===i||"checkbox"===i?h.eq(0):h}break;default:g=this.$invalidFields}var j=c?"[data-"+e+'-validator="'+c+'"]':"";return g.each(function(){f=f.concat(a(this).data(e+".messages").find("."+d.options.err.clazz+"[data-"+e+'-for="'+a(this).attr("data-"+e+"-field")+'"][data-'+e+'-result="'+d.STATUS_INVALID+'"]'+j).map(function(){var b=a(this).attr("data-"+e+"-validator"),c=a(this).attr("data-"+e+"-for");return d.options.fields[c].validators[b].enabled===!1?"":a(this).html()}).get())}),f},getSubmitButton:function(){return this.$submitButton},removeField:function(b){var c=this._namespace,d=a([]);switch(typeof b){case"object":d=b,b=b.attr("data-"+c+"-field")||b.attr("name"),d.attr("data-"+c+"-field",b);break;case"string":d=this.getFieldElements(b)}if(0===d.length)return this;for(var e=d.attr("type"),f="radio"===e||"checkbox"===e?1:d.length,g=0;f>g;g++){var h=d.eq(g);this.$invalidFields=this.$invalidFields.not(h),this._cacheFields[b]=this._cacheFields[b].not(h)}return this._cacheFields[b]&&0!==this._cacheFields[b].length||delete this.options.fields[b],("checkbox"===e||"radio"===e)&&this._initField(b),this.disableSubmitButtons(!1),this.$form.trigger(a.Event(this.options.events.fieldRemoved),{field:b,element:d}),this},resetField:function(b,c){var d=this._namespace,e=a([]);switch(typeof b){case"object":e=b,b=b.attr("data-"+d+"-field");break;case"string":e=this.getFieldElements(b)}var f=e.length;if(this.options.fields[b])for(var g=0;f>g;g++)for(var h in this.options.fields[b].validators)e.eq(g).removeData(d+".dfs."+h);if(c){var i=e.attr("type");"radio"===i||"checkbox"===i?e.prop("checked",!1).removeAttr("selected"):e.val("")}return this.updateStatus(b,this.STATUS_NOT_VALIDATED),this},resetForm:function(b){for(var c in this.options.fields)this.resetField(c,b);return this.$invalidFields=a([]),this.$submitButton=null,this.disableSubmitButtons(!1),this
},revalidateField:function(a){return this.updateStatus(a,this.STATUS_NOT_VALIDATED).validateField(a),this},setLocale:function(b){return this.options.locale=b,this.$form.trigger(a.Event(this.options.events.localeChanged),{locale:b,bv:this,fv:this}),this},updateOption:function(a,b,c,d){var e=this._namespace;return"object"==typeof a&&(a=a.attr("data-"+e+"-field")),this.options.fields[a]&&this.options.fields[a].validators[b]&&(this.options.fields[a].validators[b][c]=d,this.updateStatus(a,this.STATUS_NOT_VALIDATED,b)),this},validateContainer:function(b){var c=this,d=this._namespace,e=[],f="string"==typeof b?a(b):b;if(0===f.length)return this;f.find("[data-"+d+"-field]").each(function(){var b=a(this);c._isExcluded(b)||e.push(b)});for(var g=e.length,h=0;g>h;h++)this.validateField(e[h]);return this}},a.fn.formValidation=function(b){var c=arguments;return this.each(function(){var d=a(this),e=d.data("formValidation"),f="object"==typeof b&&b;if(!e){var g=(f.framework||d.attr("data-fv-framework")||"bootstrap").toLowerCase(),h=g.substr(0,1).toUpperCase()+g.substr(1);if("undefined"==typeof FormValidation.Framework[h])throw new Error("The class FormValidation.Framework."+h+" is not implemented");e=new FormValidation.Framework[h](this,f),d.addClass("fv-form-"+g).data("formValidation",e)}"string"==typeof b&&e[b].apply(e,Array.prototype.slice.call(c,1))})},a.fn.formValidation.Constructor=FormValidation.Base,a.fn.formValidation.DEFAULT_OPTIONS={autoFocus:!0,declarative:!0,elementClass:"fv-form",events:{formInit:"init.form.fv",formError:"err.form.fv",formSuccess:"success.form.fv",fieldAdded:"added.field.fv",fieldRemoved:"removed.field.fv",fieldInit:"init.field.fv",fieldError:"err.field.fv",fieldSuccess:"success.field.fv",fieldStatus:"status.field.fv",localeChanged:"changed.locale.fv",validatorError:"err.validator.fv",validatorSuccess:"success.validator.fv",validatorIgnored:"ignored.validator.fv"},excluded:[":disabled",":hidden",":not(:visible)"],fields:null,live:"enabled",locale:"en_US",message:"This value is not valid",threshold:null,verbose:!0,button:{selector:'[type="submit"]',disabled:""},control:{valid:"",invalid:""},err:{clazz:"",container:null,parent:null},icon:{valid:null,invalid:null,validating:null,feedback:""},row:{selector:null,valid:"",invalid:"",feedback:""}}}(jQuery),function(a){FormValidation.Helper={call:function(a,b){if("function"==typeof a)return a.apply(this,b);if("string"==typeof a){"()"===a.substring(a.length-2)&&(a=a.substring(0,a.length-2));for(var c=a.split("."),d=c.pop(),e=window,f=0;f<c.length;f++)e=e[c[f]];return"undefined"==typeof e[d]?null:e[d].apply(this,b)}},date:function(a,b,c,d){if(isNaN(a)||isNaN(b)||isNaN(c))return!1;if(c.length>2||b.length>2||a.length>4)return!1;if(c=parseInt(c,10),b=parseInt(b,10),a=parseInt(a,10),1e3>a||a>9999||0>=b||b>12)return!1;var e=[31,28,31,30,31,30,31,31,30,31,30,31];if((a%400===0||a%100!==0&&a%4===0)&&(e[1]=29),0>=c||c>e[b-1])return!1;if(d===!0){var f=new Date,g=f.getFullYear(),h=f.getMonth(),i=f.getDate();return g>a||a===g&&h>b-1||a===g&&b-1===h&&i>c}return!0},format:function(b,c){a.isArray(c)||(c=[c]);for(var d in c)b=b.replace("%s",c[d]);return b},luhn:function(a){for(var b=a.length,c=0,d=[[0,1,2,3,4,5,6,7,8,9],[0,2,4,6,8,1,3,5,7,9]],e=0;b--;)e+=d[c][parseInt(a.charAt(b),10)],c^=1;return e%10===0&&e>0},mod11And10:function(a){for(var b=5,c=a.length,d=0;c>d;d++)b=(2*(b||10)%11+parseInt(a.charAt(d),10))%10;return 1===b},mod37And36:function(a,b){b=b||"0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";for(var c=b.length,d=a.length,e=Math.floor(c/2),f=0;d>f;f++)e=(2*(e||c)%(c+1)+b.indexOf(a.charAt(f)))%c;return 1===e}}}(jQuery),function(a){FormValidation.I18n=a.extend(!0,FormValidation.I18n||{},{en_US:{base64:{"default":"Please enter a valid base 64 encoded"}}}),FormValidation.Validator.base64={validate:function(a,b){var c=a.getFieldValue(b,"base64");return""===c?!0:/^(?:[A-Za-z0-9+/]{4})*(?:[A-Za-z0-9+/]{2}==|[A-Za-z0-9+/]{3}=|[A-Za-z0-9+/]{4})$/.test(c)}}}(jQuery),function(a){FormValidation.I18n=a.extend(!0,FormValidation.I18n||{},{en_US:{between:{"default":"Please enter a value between %s and %s",notInclusive:"Please enter a value between %s and %s strictly"}}}),FormValidation.Validator.between={html5Attributes:{message:"message",min:"min",max:"max",inclusive:"inclusive"},enableByHtml5:function(a){return"range"===a.attr("type")?{min:a.attr("min"),max:a.attr("max")}:!1},validate:function(b,c,d){var e=b.getFieldValue(c,"between");if(""===e)return!0;if(e=this._format(e),!a.isNumeric(e))return!1;var f=b.getLocale(),g=a.isNumeric(d.min)?d.min:b.getDynamicOption(c,d.min),h=a.isNumeric(d.max)?d.max:b.getDynamicOption(c,d.max),i=this._format(g),j=this._format(h);return e=parseFloat(e),d.inclusive===!0||void 0===d.inclusive?{valid:e>=i&&j>=e,message:FormValidation.Helper.format(d.message||FormValidation.I18n[f].between["default"],[g,h])}:{valid:e>i&&j>e,message:FormValidation.Helper.format(d.message||FormValidation.I18n[f].between.notInclusive,[g,h])}},_format:function(a){return(a+"").replace(",",".")}}}(jQuery),function(a){FormValidation.I18n=a.extend(!0,FormValidation.I18n||{},{en_US:{bic:{"default":"Please enter a valid BIC number"}}}),FormValidation.Validator.bic={validate:function(a,b){var c=a.getFieldValue(b,"bic");return""===c?!0:/^[a-zA-Z]{6}[a-zA-Z0-9]{2}([a-zA-Z0-9]{3})?$/.test(c)}}}(jQuery),function(){FormValidation.Validator.blank={validate:function(){return!0}}}(jQuery),function(a){FormValidation.I18n=a.extend(!0,FormValidation.I18n||{},{en_US:{callback:{"default":"Please enter a valid value"}}}),FormValidation.Validator.callback={html5Attributes:{message:"message",callback:"callback"},validate:function(b,c,d){var e=b.getFieldValue(c,"callback"),f=new a.Deferred,g={valid:!0};if(d.callback){var h=FormValidation.Helper.call(d.callback,[e,b,c]);g="boolean"==typeof h||null===h?{valid:h}:h}return f.resolve(c,"callback",g),f}}}(jQuery),function(a){FormValidation.I18n=a.extend(!0,FormValidation.I18n||{},{en_US:{choice:{"default":"Please enter a valid value",less:"Please choose %s options at minimum",more:"Please choose %s options at maximum",between:"Please choose %s - %s options"}}}),FormValidation.Validator.choice={html5Attributes:{message:"message",min:"min",max:"max"},validate:function(b,c,d){var e=b.getLocale(),f=b.getNamespace(),g=c.is("select")?b.getFieldElements(c.attr("data-"+f+"-field")).find("option").filter(":selected").length:b.getFieldElements(c.attr("data-"+f+"-field")).filter(":checked").length,h=d.min?a.isNumeric(d.min)?d.min:b.getDynamicOption(c,d.min):null,i=d.max?a.isNumeric(d.max)?d.max:b.getDynamicOption(c,d.max):null,j=!0,k=d.message||FormValidation.I18n[e].choice["default"];switch((h&&g<parseInt(h,10)||i&&g>parseInt(i,10))&&(j=!1),!0){case!!h&&!!i:k=FormValidation.Helper.format(d.message||FormValidation.I18n[e].choice.between,[parseInt(h,10),parseInt(i,10)]);break;case!!h:k=FormValidation.Helper.format(d.message||FormValidation.I18n[e].choice.less,parseInt(h,10));break;case!!i:k=FormValidation.Helper.format(d.message||FormValidation.I18n[e].choice.more,parseInt(i,10))}return{valid:j,message:k}}}}(jQuery),function(a){FormValidation.I18n=a.extend(!0,FormValidation.I18n||{},{en_US:{color:{"default":"Please enter a valid color"}}}),FormValidation.Validator.color={html5Attributes:{message:"message",type:"type"},enableByHtml5:function(a){return"color"===a.attr("type")},SUPPORTED_TYPES:["hex","rgb","rgba","hsl","hsla","keyword"],KEYWORD_COLORS:["aliceblue","antiquewhite","aqua","aquamarine","azure","beige","bisque","black","blanchedalmond","blue","blueviolet","brown","burlywood","cadetblue","chartreuse","chocolate","coral","cornflowerblue","cornsilk","crimson","cyan","darkblue","darkcyan","darkgoldenrod","darkgray","darkgreen","darkgrey","darkkhaki","darkmagenta","darkolivegreen","darkorange","darkorchid","darkred","darksalmon","darkseagreen","darkslateblue","darkslategray","darkslategrey","darkturquoise","darkviolet","deeppink","deepskyblue","dimgray","dimgrey","dodgerblue","firebrick","floralwhite","forestgreen","fuchsia","gainsboro","ghostwhite","gold","goldenrod","gray","green","greenyellow","grey","honeydew","hotpink","indianred","indigo","ivory","khaki","lavender","lavenderblush","lawngreen","lemonchiffon","lightblue","lightcoral","lightcyan","lightgoldenrodyellow","lightgray","lightgreen","lightgrey","lightpink","lightsalmon","lightseagreen","lightskyblue","lightslategray","lightslategrey","lightsteelblue","lightyellow","lime","limegreen","linen","magenta","maroon","mediumaquamarine","mediumblue","mediumorchid","mediumpurple","mediumseagreen","mediumslateblue","mediumspringgreen","mediumturquoise","mediumvioletred","midnightblue","mintcream","mistyrose","moccasin","navajowhite","navy","oldlace","olive","olivedrab","orange","orangered","orchid","palegoldenrod","palegreen","paleturquoise","palevioletred","papayawhip","peachpuff","peru","pink","plum","powderblue","purple","red","rosybrown","royalblue","saddlebrown","salmon","sandybrown","seagreen","seashell","sienna","silver","skyblue","slateblue","slategray","slategrey","snow","springgreen","steelblue","tan","teal","thistle","tomato","transparent","turquoise","violet","wheat","white","whitesmoke","yellow","yellowgreen"],validate:function(b,c,d){var e=b.getFieldValue(c,"color");if(""===e)return!0;if(this.enableByHtml5(c))return/^#[0-9A-F]{6}$/i.test(e);var f=d.type||this.SUPPORTED_TYPES;a.isArray(f)||(f=f.replace(/s/g,"").split(","));for(var g,h,i=!1,j=0;j<f.length;j++)if(h=f[j],g="_"+h.toLowerCase(),i=i||this[g](e))return!0;return!1},_hex:function(a){return/(^#[0-9A-F]{6}$)|(^#[0-9A-F]{3}$)/i.test(a)},_hsl:function(a){return/^hsl\((\s*(-?\d+)\s*,)(\s*(\b(0?\d{1,2}|100)\b%)\s*,)(\s*(\b(0?\d{1,2}|100)\b%)\s*)\)$/.test(a)},_hsla:function(a){return/^hsla\((\s*(-?\d+)\s*,)(\s*(\b(0?\d{1,2}|100)\b%)\s*,){2}(\s*(0?(\.\d+)?|1(\.0+)?)\s*)\)$/.test(a)},_keyword:function(b){return a.inArray(b,this.KEYWORD_COLORS)>=0},_rgb:function(a){var b=/^rgb\((\s*(\b([01]?\d{1,2}|2[0-4]\d|25[0-5])\b)\s*,){2}(\s*(\b([01]?\d{1,2}|2[0-4]\d|25[0-5])\b)\s*)\)$/,c=/^rgb\((\s*(\b(0?\d{1,2}|100)\b%)\s*,){2}(\s*(\b(0?\d{1,2}|100)\b%)\s*)\)$/;return b.test(a)||c.test(a)},_rgba:function(a){var b=/^rgba\((\s*(\b([01]?\d{1,2}|2[0-4]\d|25[0-5])\b)\s*,){3}(\s*(0?(\.\d+)?|1(\.0+)?)\s*)\)$/,c=/^rgba\((\s*(\b(0?\d{1,2}|100)\b%)\s*,){3}(\s*(0?(\.\d+)?|1(\.0+)?)\s*)\)$/;return b.test(a)||c.test(a)}}}(jQuery),function(a){FormValidation.I18n=a.extend(!0,FormValidation.I18n||{},{en_US:{creditCard:{"default":"Please enter a valid credit card number"}}}),FormValidation.Validator.creditCard={validate:function(b,c){var d=b.getFieldValue(c,"creditCard");if(""===d)return!0;if(/[^0-9-\s]+/.test(d))return!1;if(d=d.replace(/\D/g,""),!FormValidation.Helper.luhn(d))return!1;var e,f,g={AMERICAN_EXPRESS:{length:[15],prefix:["34","37"]},DINERS_CLUB:{length:[14],prefix:["300","301","302","303","304","305","36"]},DINERS_CLUB_US:{length:[16],prefix:["54","55"]},DISCOVER:{length:[16],prefix:["6011","622126","622127","622128","622129","62213","62214","62215","62216","62217","62218","62219","6222","6223","6224","6225","6226","6227","6228","62290","62291","622920","622921","622922","622923","622924","622925","644","645","646","647","648","649","65"]},JCB:{length:[16],prefix:["3528","3529","353","354","355","356","357","358"]},LASER:{length:[16,17,18,19],prefix:["6304","6706","6771","6709"]},MAESTRO:{length:[12,13,14,15,16,17,18,19],prefix:["5018","5020","5038","6304","6759","6761","6762","6763","6764","6765","6766"]},MASTERCARD:{length:[16],prefix:["51","52","53","54","55"]},SOLO:{length:[16,18,19],prefix:["6334","6767"]},UNIONPAY:{length:[16,17,18,19],prefix:["622126","622127","622128","622129","62213","62214","62215","62216","62217","62218","62219","6222","6223","6224","6225","6226","6227","6228","62290","62291","622920","622921","622922","622923","622924","622925"]},VISA:{length:[16],prefix:["4"]}};for(e in g)for(f in g[e].prefix)if(d.substr(0,g[e].prefix[f].length)===g[e].prefix[f]&&-1!==a.inArray(d.length,g[e].length))return{valid:!0,type:e};return!1}}}(jQuery),function(a){FormValidation.I18n=a.extend(!0,FormValidation.I18n||{},{en_US:{cusip:{"default":"Please enter a valid CUSIP number"}}}),FormValidation.Validator.cusip={validate:function(b,c){var d=b.getFieldValue(c,"cusip");if(""===d)return!0;if(d=d.toUpperCase(),!/^[0-9A-Z]{9}$/.test(d))return!1;for(var e=a.map(d.split(""),function(a){var b=a.charCodeAt(0);return b>="A".charCodeAt(0)&&b<="Z".charCodeAt(0)?b-"A".charCodeAt(0)+10:a}),f=e.length,g=0,h=0;f-1>h;h++){var i=parseInt(e[h],10);h%2!==0&&(i*=2),i>9&&(i-=9),g+=i}return g=(10-g%10)%10,g===parseInt(e[f-1],10)}}}(jQuery),function(a){FormValidation.I18n=a.extend(!0,FormValidation.I18n||{},{en_US:{cvv:{"default":"Please enter a valid CVV number"}}}),FormValidation.Validator.cvv={html5Attributes:{message:"message",ccfield:"creditCardField"},init:function(a,b,c){if(c.creditCardField){var d=a.getFieldElements(c.creditCardField);a.onLiveChange(d,"live_cvv",function(){var c=a.getStatus(b,"cvv");c!==a.STATUS_NOT_VALIDATED&&a.revalidateField(b)})}},destroy:function(a,b,c){if(c.creditCardField){var d=a.getFieldElements(c.creditCardField);a.offLiveChange(d,"live_cvv")}},validate:function(b,c,d){var e=b.getFieldValue(c,"cvv");if(""===e)return!0;if(!/^[0-9]{3,4}$/.test(e))return!1;if(!d.creditCardField)return!0;var f=b.getFieldElements(d.creditCardField).val();if(""===f)return!0;f=f.replace(/\D/g,"");var g,h,i={AMERICAN_EXPRESS:{length:[15],prefix:["34","37"]},DINERS_CLUB:{length:[14],prefix:["300","301","302","303","304","305","36"]},DINERS_CLUB_US:{length:[16],prefix:["54","55"]},DISCOVER:{length:[16],prefix:["6011","622126","622127","622128","622129","62213","62214","62215","62216","62217","62218","62219","6222","6223","6224","6225","6226","6227","6228","62290","62291","622920","622921","622922","622923","622924","622925","644","645","646","647","648","649","65"]},JCB:{length:[16],prefix:["3528","3529","353","354","355","356","357","358"]},LASER:{length:[16,17,18,19],prefix:["6304","6706","6771","6709"]},MAESTRO:{length:[12,13,14,15,16,17,18,19],prefix:["5018","5020","5038","6304","6759","6761","6762","6763","6764","6765","6766"]},MASTERCARD:{length:[16],prefix:["51","52","53","54","55"]},SOLO:{length:[16,18,19],prefix:["6334","6767"]},UNIONPAY:{length:[16,17,18,19],prefix:["622126","622127","622128","622129","62213","62214","62215","62216","62217","62218","62219","6222","6223","6224","6225","6226","6227","6228","62290","62291","622920","622921","622922","622923","622924","622925"]},VISA:{length:[16],prefix:["4"]}},j=null;for(g in i)for(h in i[g].prefix)if(f.substr(0,i[g].prefix[h].length)===i[g].prefix[h]&&-1!==a.inArray(f.length,i[g].length)){j=g;break}return null===j?!1:"AMERICAN_EXPRESS"===j?4===e.length:3===e.length}}}(jQuery),function(a){FormValidation.I18n=a.extend(!0,FormValidation.I18n||{},{en_US:{date:{"default":"Please enter a valid date",min:"Please enter a date after %s",max:"Please enter a date before %s",range:"Please enter a date in the range %s - %s"}}}),FormValidation.Validator.date={html5Attributes:{message:"message",format:"format",min:"min",max:"max",separator:"separator"},validate:function(b,c,d){var e=b.getFieldValue(c,"date");if(""===e)return!0;d.format=d.format||"MM/DD/YYYY","date"===c.attr("type")&&(d.format="YYYY-MM-DD");var f=b.getLocale(),g=d.message||FormValidation.I18n[f].date["default"],h=d.format.split(" "),i=h[0],j=h.length>1?h[1]:null,k=h.length>2?h[2]:null,l=e.split(" "),m=l[0],n=l.length>1?l[1]:null;if(h.length!==l.length)return{valid:!1,message:g};var o=d.separator;if(o||(o=-1!==m.indexOf("/")?"/":-1!==m.indexOf("-")?"-":-1!==m.indexOf(".")?".":null),null===o||-1===m.indexOf(o))return{valid:!1,message:g};if(m=m.split(o),i=i.split(o),m.length!==i.length)return{valid:!1,message:g};var p=m[a.inArray("YYYY",i)],q=m[a.inArray("MM",i)],r=m[a.inArray("DD",i)];if(!p||!q||!r||4!==p.length)return{valid:!1,message:g};var s=null,t=null,u=null;if(j){if(j=j.split(":"),n=n.split(":"),j.length!==n.length)return{valid:!1,message:g};if(t=n.length>0?n[0]:null,s=n.length>1?n[1]:null,u=n.length>2?n[2]:null,""===t||""===s||""===u)return{valid:!1,message:g};if(u){if(isNaN(u)||u.length>2)return{valid:!1,message:g};if(u=parseInt(u,10),0>u||u>60)return{valid:!1,message:g}}if(t){if(isNaN(t)||t.length>2)return{valid:!1,message:g};if(t=parseInt(t,10),0>t||t>=24||k&&t>12)return{valid:!1,message:g}}if(s){if(isNaN(s)||s.length>2)return{valid:!1,message:g};if(s=parseInt(s,10),0>s||s>59)return{valid:!1,message:g}}}var v=FormValidation.Helper.date(p,q,r),w=null,x=null,y=d.min,z=d.max;switch(y&&(isNaN(Date.parse(y))&&(y=b.getDynamicOption(c,y)),w=y instanceof Date?y:this._parseDate(y,i,o),y=y instanceof Date?this._formatDate(y,d.format):y),z&&(isNaN(Date.parse(z))&&(z=b.getDynamicOption(c,z)),x=z instanceof Date?z:this._parseDate(z,i,o),z=z instanceof Date?this._formatDate(z,d.format):z),m=new Date(p,q-1,r,t,s,u),!0){case y&&!z&&v:v=m.getTime()>=w.getTime(),g=d.message||FormValidation.Helper.format(FormValidation.I18n[f].date.min,y);break;case z&&!y&&v:v=m.getTime()<=x.getTime(),g=d.message||FormValidation.Helper.format(FormValidation.I18n[f].date.max,z);break;case z&&y&&v:v=m.getTime()<=x.getTime()&&m.getTime()>=w.getTime(),g=d.message||FormValidation.Helper.format(FormValidation.I18n[f].date.range,[y,z])}return{valid:v,message:g}},_parseDate:function(b,c,d){var e=0,f=0,g=0,h=b.split(" "),i=h[0],j=h.length>1?h[1]:null;i=i.split(d);var k=i[a.inArray("YYYY",c)],l=i[a.inArray("MM",c)],m=i[a.inArray("DD",c)];return j&&(j=j.split(":"),f=j.length>0?j[0]:null,e=j.length>1?j[1]:null,g=j.length>2?j[2]:null),new Date(k,l-1,m,f,e,g)},_formatDate:function(a,b){b=b.replace(/Y/g,"y").replace(/M/g,"m").replace(/D/g,"d").replace(/:m/g,":M").replace(/:mm/g,":MM").replace(/:S/,":s").replace(/:SS/,":ss");var c={d:function(a){return a.getDate()},dd:function(a){var b=a.getDate();return 10>b?"0"+b:b},m:function(a){return a.getMonth()+1},mm:function(a){var b=a.getMonth()+1;return 10>b?"0"+b:b},yy:function(a){return(""+a.getFullYear()).substr(2)},yyyy:function(a){return a.getFullYear()},h:function(a){return a.getHours()%12||12},hh:function(a){var b=a.getHours()%12||12;return 10>b?"0"+b:b},H:function(a){return a.getHours()},HH:function(a){var b=a.getHours();return 10>b?"0"+b:b},M:function(a){return a.getMinutes()},MM:function(a){var b=a.getMinutes();return 10>b?"0"+b:b},s:function(a){return a.getSeconds()},ss:function(a){var b=a.getSeconds();return 10>b?"0"+b:b}};return b.replace(/d{1,4}|m{1,4}|yy(?:yy)?|([HhMs])\1?|"[^"]*"|'[^']*'/g,function(b){return c[b]?c[b](a):b.slice(1,b.length-1)})}}}(jQuery),function(a){FormValidation.I18n=a.extend(!0,FormValidation.I18n||{},{en_US:{different:{"default":"Please enter a different value"}}}),FormValidation.Validator.different={html5Attributes:{message:"message",field:"field"},init:function(a,b,c){for(var d=c.field.split(","),e=0;e<d.length;e++){var f=a.getFieldElements(d[e]);a.onLiveChange(f,"live_different",function(){var c=a.getStatus(b,"different");c!==a.STATUS_NOT_VALIDATED&&a.revalidateField(b)})}},destroy:function(a,b,c){for(var d=c.field.split(","),e=0;e<d.length;e++){var f=a.getFieldElements(d[e]);a.offLiveChange(f,"live_different")}},validate:function(a,b,c){var d=a.getFieldValue(b,"different");if(""===d)return!0;for(var e=c.field.split(","),f=!0,g=0;g<e.length;g++){var h=a.getFieldElements(e[g]);if(null!=h&&0!==h.length){var i=a.getFieldValue(h,"different");d===i?f=!1:""!==i&&a.updateStatus(h,a.STATUS_VALID,"different")}}return f}}}(jQuery),function(a){FormValidation.I18n=a.extend(!0,FormValidation.I18n||{},{en_US:{digits:{"default":"Please enter only digits"}}}),FormValidation.Validator.digits={validate:function(a,b){var c=a.getFieldValue(b,"digits");return""===c?!0:/^\d+$/.test(c)}}}(jQuery),function(a){FormValidation.I18n=a.extend(!0,FormValidation.I18n||{},{en_US:{ean:{"default":"Please enter a valid EAN number"}}}),FormValidation.Validator.ean={validate:function(a,b){var c=a.getFieldValue(b,"ean");if(""===c)return!0;if(!/^(\d{8}|\d{12}|\d{13})$/.test(c))return!1;for(var d=c.length,e=0,f=8===d?[3,1]:[1,3],g=0;d-1>g;g++)e+=parseInt(c.charAt(g),10)*f[g%2];return e=(10-e%10)%10,e+""===c.charAt(d-1)}}}(jQuery),function(a){FormValidation.I18n=a.extend(!0,FormValidation.I18n||{},{en_US:{ein:{"default":"Please enter a valid EIN number"}}}),FormValidation.Validator.ein={CAMPUS:{ANDOVER:["10","12"],ATLANTA:["60","67"],AUSTIN:["50","53"],BROOKHAVEN:["01","02","03","04","05","06","11","13","14","16","21","22","23","25","34","51","52","54","55","56","57","58","59","65"],CINCINNATI:["30","32","35","36","37","38","61"],FRESNO:["15","24"],KANSAS_CITY:["40","44"],MEMPHIS:["94","95"],OGDEN:["80","90"],PHILADELPHIA:["33","39","41","42","43","46","48","62","63","64","66","68","71","72","73","74","75","76","77","81","82","83","84","85","86","87","88","91","92","93","98","99"],INTERNET:["20","26","27","45","46"],SMALL_BUSINESS_ADMINISTRATION:["31"]},validate:function(b,c){var d=b.getFieldValue(c,"ein");if(""===d)return!0;if(!/^[0-9]{2}-?[0-9]{7}$/.test(d))return!1;var e=d.substr(0,2)+"";for(var f in this.CAMPUS)if(-1!==a.inArray(e,this.CAMPUS[f]))return{valid:!0,campus:f};return!1}}}(jQuery),function(a){FormValidation.I18n=a.extend(!0,FormValidation.I18n||{},{en_US:{emailAddress:{"default":"Please enter a valid email address"}}}),FormValidation.Validator.emailAddress={html5Attributes:{message:"message",multiple:"multiple",separator:"separator"},enableByHtml5:function(a){return"email"===a.attr("type")},validate:function(a,b,c){var d=a.getFieldValue(b,"emailAddress");if(""===d)return!0;var e=/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/,f=c.multiple===!0||"true"===c.multiple;if(f){for(var g=c.separator||/[,;]/,h=this._splitEmailAddresses(d,g),i=0;i<h.length;i++)if(!e.test(h[i]))return!1;return!0}return e.test(d)},_splitEmailAddresses:function(a,b){for(var c=a.split(/"/),d=c.length,e=[],f="",g=0;d>g;g++)if(g%2===0){var h=c[g].split(b),i=h.length;if(1===i)f+=h[0];else{e.push(f+h[0]);for(var j=1;i-1>j;j++)e.push(h[j]);f=h[i-1]}}else f+='"'+c[g],d-1>g&&(f+='"');return e.push(f),e}}}(jQuery),function(a){FormValidation.I18n=a.extend(!0,FormValidation.I18n||{},{en_US:{file:{"default":"Please choose a valid file"}}}),FormValidation.Validator.file={html5Attributes:{extension:"extension",maxfiles:"maxFiles",minfiles:"minFiles",maxsize:"maxSize",minsize:"minSize",maxtotalsize:"maxTotalSize",mintotalsize:"minTotalSize",message:"message",type:"type"},validate:function(b,c,d){var e=b.getFieldValue(c,"file");if(""===e)return!0;var f,g=d.extension?d.extension.toLowerCase().split(","):null,h=d.type?d.type.toLowerCase().split(","):null,i=window.File&&window.FileList&&window.FileReader;if(i){var j=c.get(0).files,k=j.length,l=0;if(d.maxFiles&&k>parseInt(d.maxFiles,10)||d.minFiles&&k<parseInt(d.minFiles,10))return!1;for(var m=0;k>m;m++)if(l+=j[m].size,f=j[m].name.substr(j[m].name.lastIndexOf(".")+1),d.minSize&&j[m].size<parseInt(d.minSize,10)||d.maxSize&&j[m].size>parseInt(d.maxSize,10)||g&&-1===a.inArray(f.toLowerCase(),g)||j[m].type&&h&&-1===a.inArray(j[m].type.toLowerCase(),h))return!1;if(d.maxTotalSize&&l>parseInt(d.maxTotalSize,10)||d.minTotalSize&&l<parseInt(d.minTotalSize,10))return!1}else if(f=e.substr(e.lastIndexOf(".")+1),g&&-1===a.inArray(f.toLowerCase(),g))return!1;return!0}}}(jQuery),function(a){FormValidation.I18n=a.extend(!0,FormValidation.I18n||{},{en_US:{greaterThan:{"default":"Please enter a value greater than or equal to %s",notInclusive:"Please enter a value greater than %s"}}}),FormValidation.Validator.greaterThan={html5Attributes:{message:"message",value:"value",inclusive:"inclusive"},enableByHtml5:function(a){var b=a.attr("type"),c=a.attr("min");return c&&"date"!==b?{value:c}:!1},validate:function(b,c,d){var e=b.getFieldValue(c,"greaterThan");if(""===e)return!0;if(e=this._format(e),!a.isNumeric(e))return!1;var f=b.getLocale(),g=a.isNumeric(d.value)?d.value:b.getDynamicOption(c,d.value),h=this._format(g);return e=parseFloat(e),d.inclusive===!0||void 0===d.inclusive?{valid:e>=h,message:FormValidation.Helper.format(d.message||FormValidation.I18n[f].greaterThan["default"],g)}:{valid:e>h,message:FormValidation.Helper.format(d.message||FormValidation.I18n[f].greaterThan.notInclusive,g)}},_format:function(a){return(a+"").replace(",",".")}}}(jQuery),function(a){FormValidation.I18n=a.extend(!0,FormValidation.I18n||{},{en_US:{grid:{"default":"Please enter a valid GRId number"}}}),FormValidation.Validator.grid={validate:function(a,b){var c=a.getFieldValue(b,"grid");return""===c?!0:(c=c.toUpperCase(),/^[GRID:]*([0-9A-Z]{2})[-\s]*([0-9A-Z]{5})[-\s]*([0-9A-Z]{10})[-\s]*([0-9A-Z]{1})$/g.test(c)?(c=c.replace(/\s/g,"").replace(/-/g,""),"GRID:"===c.substr(0,5)&&(c=c.substr(5)),FormValidation.Helper.mod37And36(c)):!1)}}}(jQuery),function(a){FormValidation.I18n=a.extend(!0,FormValidation.I18n||{},{en_US:{hex:{"default":"Please enter a valid hexadecimal number"}}}),FormValidation.Validator.hex={validate:function(a,b){var c=a.getFieldValue(b,"hex");return""===c?!0:/^[0-9a-fA-F]+$/.test(c)}}}(jQuery),function(a){FormValidation.I18n=a.extend(!0,FormValidation.I18n||{},{en_US:{iban:{"default":"Please enter a valid IBAN number",country:"Please enter a valid IBAN number in %s",countries:{AD:"Andorra",AE:"United Arab Emirates",AL:"Albania",AO:"Angola",AT:"Austria",AZ:"Azerbaijan",BA:"Bosnia and Herzegovina",BE:"Belgium",BF:"Burkina Faso",BG:"Bulgaria",BH:"Bahrain",BI:"Burundi",BJ:"Benin",BR:"Brazil",CH:"Switzerland",CI:"Ivory Coast",CM:"Cameroon",CR:"Costa Rica",CV:"Cape Verde",CY:"Cyprus",CZ:"Czech Republic",DE:"Germany",DK:"Denmark",DO:"Dominican Republic",DZ:"Algeria",EE:"Estonia",ES:"Spain",FI:"Finland",FO:"Faroe Islands",FR:"France",GB:"United Kingdom",GE:"Georgia",GI:"Gibraltar",GL:"Greenland",GR:"Greece",GT:"Guatemala",HR:"Croatia",HU:"Hungary",IE:"Ireland",IL:"Israel",IR:"Iran",IS:"Iceland",IT:"Italy",JO:"Jordan",KW:"Kuwait",KZ:"Kazakhstan",LB:"Lebanon",LI:"Liechtenstein",LT:"Lithuania",LU:"Luxembourg",LV:"Latvia",MC:"Monaco",MD:"Moldova",ME:"Montenegro",MG:"Madagascar",MK:"Macedonia",ML:"Mali",MR:"Mauritania",MT:"Malta",MU:"Mauritius",MZ:"Mozambique",NL:"Netherlands",NO:"Norway",PK:"Pakistan",PL:"Poland",PS:"Palestine",PT:"Portugal",QA:"Qatar",RO:"Romania",RS:"Serbia",SA:"Saudi Arabia",SE:"Sweden",SI:"Slovenia",SK:"Slovakia",SM:"San Marino",SN:"Senegal",TN:"Tunisia",TR:"Turkey",VG:"Virgin Islands, British"}}}}),FormValidation.Validator.iban={html5Attributes:{message:"message",country:"country"},REGEX:{AD:"AD[0-9]{2}[0-9]{4}[0-9]{4}[A-Z0-9]{12}",AE:"AE[0-9]{2}[0-9]{3}[0-9]{16}",AL:"AL[0-9]{2}[0-9]{8}[A-Z0-9]{16}",AO:"AO[0-9]{2}[0-9]{21}",AT:"AT[0-9]{2}[0-9]{5}[0-9]{11}",AZ:"AZ[0-9]{2}[A-Z]{4}[A-Z0-9]{20}",BA:"BA[0-9]{2}[0-9]{3}[0-9]{3}[0-9]{8}[0-9]{2}",BE:"BE[0-9]{2}[0-9]{3}[0-9]{7}[0-9]{2}",BF:"BF[0-9]{2}[0-9]{23}",BG:"BG[0-9]{2}[A-Z]{4}[0-9]{4}[0-9]{2}[A-Z0-9]{8}",BH:"BH[0-9]{2}[A-Z]{4}[A-Z0-9]{14}",BI:"BI[0-9]{2}[0-9]{12}",BJ:"BJ[0-9]{2}[A-Z]{1}[0-9]{23}",BR:"BR[0-9]{2}[0-9]{8}[0-9]{5}[0-9]{10}[A-Z][A-Z0-9]",CH:"CH[0-9]{2}[0-9]{5}[A-Z0-9]{12}",CI:"CI[0-9]{2}[A-Z]{1}[0-9]{23}",CM:"CM[0-9]{2}[0-9]{23}",CR:"CR[0-9]{2}[0-9]{3}[0-9]{14}",CV:"CV[0-9]{2}[0-9]{21}",CY:"CY[0-9]{2}[0-9]{3}[0-9]{5}[A-Z0-9]{16}",CZ:"CZ[0-9]{2}[0-9]{20}",DE:"DE[0-9]{2}[0-9]{8}[0-9]{10}",DK:"DK[0-9]{2}[0-9]{14}",DO:"DO[0-9]{2}[A-Z0-9]{4}[0-9]{20}",DZ:"DZ[0-9]{2}[0-9]{20}",EE:"EE[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{11}[0-9]{1}",ES:"ES[0-9]{2}[0-9]{4}[0-9]{4}[0-9]{1}[0-9]{1}[0-9]{10}",FI:"FI[0-9]{2}[0-9]{6}[0-9]{7}[0-9]{1}",FO:"FO[0-9]{2}[0-9]{4}[0-9]{9}[0-9]{1}",FR:"FR[0-9]{2}[0-9]{5}[0-9]{5}[A-Z0-9]{11}[0-9]{2}",GB:"GB[0-9]{2}[A-Z]{4}[0-9]{6}[0-9]{8}",GE:"GE[0-9]{2}[A-Z]{2}[0-9]{16}",GI:"GI[0-9]{2}[A-Z]{4}[A-Z0-9]{15}",GL:"GL[0-9]{2}[0-9]{4}[0-9]{9}[0-9]{1}",GR:"GR[0-9]{2}[0-9]{3}[0-9]{4}[A-Z0-9]{16}",GT:"GT[0-9]{2}[A-Z0-9]{4}[A-Z0-9]{20}",HR:"HR[0-9]{2}[0-9]{7}[0-9]{10}",HU:"HU[0-9]{2}[0-9]{3}[0-9]{4}[0-9]{1}[0-9]{15}[0-9]{1}",IE:"IE[0-9]{2}[A-Z]{4}[0-9]{6}[0-9]{8}",IL:"IL[0-9]{2}[0-9]{3}[0-9]{3}[0-9]{13}",IR:"IR[0-9]{2}[0-9]{22}",IS:"IS[0-9]{2}[0-9]{4}[0-9]{2}[0-9]{6}[0-9]{10}",IT:"IT[0-9]{2}[A-Z]{1}[0-9]{5}[0-9]{5}[A-Z0-9]{12}",JO:"JO[0-9]{2}[A-Z]{4}[0-9]{4}[0]{8}[A-Z0-9]{10}",KW:"KW[0-9]{2}[A-Z]{4}[0-9]{22}",KZ:"KZ[0-9]{2}[0-9]{3}[A-Z0-9]{13}",LB:"LB[0-9]{2}[0-9]{4}[A-Z0-9]{20}",LI:"LI[0-9]{2}[0-9]{5}[A-Z0-9]{12}",LT:"LT[0-9]{2}[0-9]{5}[0-9]{11}",LU:"LU[0-9]{2}[0-9]{3}[A-Z0-9]{13}",LV:"LV[0-9]{2}[A-Z]{4}[A-Z0-9]{13}",MC:"MC[0-9]{2}[0-9]{5}[0-9]{5}[A-Z0-9]{11}[0-9]{2}",MD:"MD[0-9]{2}[A-Z0-9]{20}",ME:"ME[0-9]{2}[0-9]{3}[0-9]{13}[0-9]{2}",MG:"MG[0-9]{2}[0-9]{23}",MK:"MK[0-9]{2}[0-9]{3}[A-Z0-9]{10}[0-9]{2}",ML:"ML[0-9]{2}[A-Z]{1}[0-9]{23}",MR:"MR13[0-9]{5}[0-9]{5}[0-9]{11}[0-9]{2}",MT:"MT[0-9]{2}[A-Z]{4}[0-9]{5}[A-Z0-9]{18}",MU:"MU[0-9]{2}[A-Z]{4}[0-9]{2}[0-9]{2}[0-9]{12}[0-9]{3}[A-Z]{3}",MZ:"MZ[0-9]{2}[0-9]{21}",NL:"NL[0-9]{2}[A-Z]{4}[0-9]{10}",NO:"NO[0-9]{2}[0-9]{4}[0-9]{6}[0-9]{1}",PK:"PK[0-9]{2}[A-Z]{4}[A-Z0-9]{16}",PL:"PL[0-9]{2}[0-9]{8}[0-9]{16}",PS:"PS[0-9]{2}[A-Z]{4}[A-Z0-9]{21}",PT:"PT[0-9]{2}[0-9]{4}[0-9]{4}[0-9]{11}[0-9]{2}",QA:"QA[0-9]{2}[A-Z]{4}[A-Z0-9]{21}",RO:"RO[0-9]{2}[A-Z]{4}[A-Z0-9]{16}",RS:"RS[0-9]{2}[0-9]{3}[0-9]{13}[0-9]{2}",SA:"SA[0-9]{2}[0-9]{2}[A-Z0-9]{18}",SE:"SE[0-9]{2}[0-9]{3}[0-9]{16}[0-9]{1}",SI:"SI[0-9]{2}[0-9]{5}[0-9]{8}[0-9]{2}",SK:"SK[0-9]{2}[0-9]{4}[0-9]{6}[0-9]{10}",SM:"SM[0-9]{2}[A-Z]{1}[0-9]{5}[0-9]{5}[A-Z0-9]{12}",SN:"SN[0-9]{2}[A-Z]{1}[0-9]{23}",TN:"TN59[0-9]{2}[0-9]{3}[0-9]{13}[0-9]{2}",TR:"TR[0-9]{2}[0-9]{5}[A-Z0-9]{1}[A-Z0-9]{16}",VG:"VG[0-9]{2}[A-Z]{4}[0-9]{16}"},validate:function(b,c,d){var e=b.getFieldValue(c,"iban");if(""===e)return!0;e=e.replace(/[^a-zA-Z0-9]/g,"").toUpperCase();var f=d.country;f?"string"==typeof f&&this.REGEX[f]||(f=b.getDynamicOption(c,f)):f=e.substr(0,2);var g=b.getLocale();if(!this.REGEX[f])return!0;if(!new RegExp("^"+this.REGEX[f]+"$").test(e))return{valid:!1,message:FormValidation.Helper.format(d.message||FormValidation.I18n[g].iban.country,FormValidation.I18n[g].iban.countries[f])};e=e.substr(4)+e.substr(0,4),e=a.map(e.split(""),function(a){var b=a.charCodeAt(0);return b>="A".charCodeAt(0)&&b<="Z".charCodeAt(0)?b-"A".charCodeAt(0)+10:a}),e=e.join("");for(var h=parseInt(e.substr(0,1),10),i=e.length,j=1;i>j;++j)h=(10*h+parseInt(e.substr(j,1),10))%97;return{valid:1===h,message:FormValidation.Helper.format(d.message||FormValidation.I18n[g].iban.country,FormValidation.I18n[g].iban.countries[f])}}}}(jQuery),function(a){FormValidation.I18n=a.extend(!0,FormValidation.I18n||{},{en_US:{id:{"default":"Please enter a valid identification number",country:"Please enter a valid identification number in %s",countries:{BA:"Bosnia and Herzegovina",BG:"Bulgaria",BR:"Brazil",CH:"Switzerland",CL:"Chile",CN:"China",CZ:"Czech Republic",DK:"Denmark",EE:"Estonia",ES:"Spain",FI:"Finland",HR:"Croatia",IE:"Ireland",IS:"Iceland",LT:"Lithuania",LV:"Latvia",ME:"Montenegro",MK:"Macedonia",NL:"Netherlands",PL:"Poland",RO:"Romania",RS:"Serbia",SE:"Sweden",SI:"Slovenia",SK:"Slovakia",SM:"San Marino",TH:"Thailand",ZA:"South Africa"}}}}),FormValidation.Validator.id={html5Attributes:{message:"message",country:"country"},COUNTRY_CODES:["BA","BG","BR","CH","CL","CN","CZ","DK","EE","ES","FI","HR","IE","IS","LT","LV","ME","MK","NL","PL","RO","RS","SE","SI","SK","SM","TH","ZA"],validate:function(b,c,d){var e=b.getFieldValue(c,"id");if(""===e)return!0;var f=b.getLocale(),g=d.country;if(g?("string"!=typeof g||-1===a.inArray(g.toUpperCase(),this.COUNTRY_CODES))&&(g=b.getDynamicOption(c,g)):g=e.substr(0,2),-1===a.inArray(g,this.COUNTRY_CODES))return!0;var h=["_",g.toLowerCase()].join("");return this[h](e)?!0:{valid:!1,message:FormValidation.Helper.format(d.message||FormValidation.I18n[f].id.country,FormValidation.I18n[f].id.countries[g.toUpperCase()])}},_validateJMBG:function(a,b){if(!/^\d{13}$/.test(a))return!1;var c=parseInt(a.substr(0,2),10),d=parseInt(a.substr(2,2),10),e=(parseInt(a.substr(4,3),10),parseInt(a.substr(7,2),10)),f=parseInt(a.substr(12,1),10);
if(c>31||d>12)return!1;for(var g=0,h=0;6>h;h++)g+=(7-h)*(parseInt(a.charAt(h),10)+parseInt(a.charAt(h+6),10));if(g=11-g%11,(10===g||11===g)&&(g=0),g!==f)return!1;switch(b.toUpperCase()){case"BA":return e>=10&&19>=e;case"MK":return e>=41&&49>=e;case"ME":return e>=20&&29>=e;case"RS":return e>=70&&99>=e;case"SI":return e>=50&&59>=e;default:return!0}},_ba:function(a){return this._validateJMBG(a,"BA")},_mk:function(a){return this._validateJMBG(a,"MK")},_me:function(a){return this._validateJMBG(a,"ME")},_rs:function(a){return this._validateJMBG(a,"RS")},_si:function(a){return this._validateJMBG(a,"SI")},_bg:function(a){if(!/^\d{10}$/.test(a)&&!/^\d{6}\s\d{3}\s\d{1}$/.test(a))return!1;a=a.replace(/\s/g,"");var b=parseInt(a.substr(0,2),10)+1900,c=parseInt(a.substr(2,2),10),d=parseInt(a.substr(4,2),10);if(c>40?(b+=100,c-=40):c>20&&(b-=100,c-=20),!FormValidation.Helper.date(b,c,d))return!1;for(var e=0,f=[2,4,8,5,10,9,7,3,6],g=0;9>g;g++)e+=parseInt(a.charAt(g),10)*f[g];return e=e%11%10,e+""===a.substr(9,1)},_br:function(a){if(a=a.replace(/\D/g,""),!/^\d{11}$/.test(a)||/^1{11}|2{11}|3{11}|4{11}|5{11}|6{11}|7{11}|8{11}|9{11}|0{11}$/.test(a))return!1;for(var b=0,c=0;9>c;c++)b+=(10-c)*parseInt(a.charAt(c),10);if(b=11-b%11,(10===b||11===b)&&(b=0),b+""!==a.charAt(9))return!1;var d=0;for(c=0;10>c;c++)d+=(11-c)*parseInt(a.charAt(c),10);return d=11-d%11,(10===d||11===d)&&(d=0),d+""===a.charAt(10)},_ch:function(a){if(!/^756[\.]{0,1}[0-9]{4}[\.]{0,1}[0-9]{4}[\.]{0,1}[0-9]{2}$/.test(a))return!1;a=a.replace(/\D/g,"").substr(3);for(var b=a.length,c=0,d=8===b?[3,1]:[1,3],e=0;b-1>e;e++)c+=parseInt(a.charAt(e),10)*d[e%2];return c=10-c%10,c+""===a.charAt(b-1)},_cl:function(a){if(!/^\d{7,8}[-]{0,1}[0-9K]$/i.test(a))return!1;for(a=a.replace(/\-/g,"");a.length<9;)a="0"+a;for(var b=0,c=[3,2,7,6,5,4,3,2],d=0;8>d;d++)b+=parseInt(a.charAt(d),10)*c[d];return b=11-b%11,11===b?b=0:10===b&&(b="K"),b+""===a.charAt(8).toUpperCase()},_cn:function(b){if(b=b.trim(),!/^\d{15}$/.test(b)&&!/^\d{17}[\dXx]{1}$/.test(b))return!1;var c={11:{0:[0],1:[[0,9],[11,17]],2:[0,28,29]},12:{0:[0],1:[[0,16]],2:[0,21,23,25]},13:{0:[0],1:[[0,5],7,8,21,[23,33],[81,85]],2:[[0,5],[7,9],[23,25],27,29,30,81,83],3:[[0,4],[21,24]],4:[[0,4],6,21,[23,35],81],5:[[0,3],[21,35],81,82],6:[[0,4],[21,38],[81,84]],7:[[0,3],5,6,[21,33]],8:[[0,4],[21,28]],9:[[0,3],[21,30],[81,84]],10:[[0,3],[22,26],28,81,82],11:[[0,2],[21,28],81,82]},14:{0:[0],1:[0,1,[5,10],[21,23],81],2:[[0,3],11,12,[21,27]],3:[[0,3],11,21,22],4:[[0,2],11,21,[23,31],81],5:[[0,2],21,22,24,25,81],6:[[0,3],[21,24]],7:[[0,2],[21,29],81],8:[[0,2],[21,30],81,82],9:[[0,2],[21,32],81],10:[[0,2],[21,34],81,82],11:[[0,2],[21,30],81,82],23:[[0,3],22,23,[25,30],32,33]},15:{0:[0],1:[[0,5],[21,25]],2:[[0,7],[21,23]],3:[[0,4]],4:[[0,4],[21,26],[28,30]],5:[[0,2],[21,26],81],6:[[0,2],[21,27]],7:[[0,3],[21,27],[81,85]],8:[[0,2],[21,26]],9:[[0,2],[21,29],81],22:[[0,2],[21,24]],25:[[0,2],[22,31]],26:[[0,2],[24,27],[29,32],34],28:[0,1,[22,27]],29:[0,[21,23]]},21:{0:[0],1:[[0,6],[11,14],[22,24],81],2:[[0,4],[11,13],24,[81,83]],3:[[0,4],11,21,23,81],4:[[0,4],11,[21,23]],5:[[0,5],21,22],6:[[0,4],24,81,82],7:[[0,3],11,26,27,81,82],8:[[0,4],11,81,82],9:[[0,5],11,21,22],10:[[0,5],11,21,81],11:[[0,3],21,22],12:[[0,2],4,21,23,24,81,82],13:[[0,3],21,22,24,81,82],14:[[0,4],21,22,81]},22:{0:[0],1:[[0,6],12,22,[81,83]],2:[[0,4],11,21,[81,84]],3:[[0,3],22,23,81,82],4:[[0,3],21,22],5:[[0,3],21,23,24,81,82],6:[[0,2],4,5,[21,23],25,81],7:[[0,2],[21,24],81],8:[[0,2],21,22,81,82],24:[[0,6],24,26]},23:{0:[0],1:[[0,12],21,[23,29],[81,84]],2:[[0,8],21,[23,25],27,[29,31],81],3:[[0,7],21,81,82],4:[[0,7],21,22],5:[[0,3],5,6,[21,24]],6:[[0,6],[21,24]],7:[[0,16],22,81],8:[[0,5],11,22,26,28,33,81,82],9:[[0,4],21],10:[[0,5],24,25,81,[83,85]],11:[[0,2],21,23,24,81,82],12:[[0,2],[21,26],[81,83]],27:[[0,4],[21,23]]},31:{0:[0],1:[0,1,[3,10],[12,20]],2:[0,30]},32:{0:[0],1:[[0,7],11,[13,18],24,25],2:[[0,6],11,81,82],3:[[0,5],11,12,[21,24],81,82],4:[[0,2],4,5,11,12,81,82],5:[[0,9],[81,85]],6:[[0,2],11,12,21,23,[81,84]],7:[0,1,3,5,6,[21,24]],8:[[0,4],11,26,[29,31]],9:[[0,3],[21,25],28,81,82],10:[[0,3],11,12,23,81,84,88],11:[[0,2],11,12,[81,83]],12:[[0,4],[81,84]],13:[[0,2],11,[21,24]]},33:{0:[0],1:[[0,6],[8,10],22,27,82,83,85],2:[0,1,[3,6],11,12,25,26,[81,83]],3:[[0,4],22,24,[26,29],81,82],4:[[0,2],11,21,24,[81,83]],5:[[0,3],[21,23]],6:[[0,2],21,24,[81,83]],7:[[0,3],23,26,27,[81,84]],8:[[0,3],22,24,25,81],9:[[0,3],21,22],10:[[0,4],[21,24],81,82],11:[[0,2],[21,27],81]},34:{0:[0],1:[[0,4],11,[21,24],81],2:[[0,4],7,8,[21,23],25],3:[[0,4],11,[21,23]],4:[[0,6],21],5:[[0,4],6,[21,23]],6:[[0,4],21],7:[[0,3],11,21],8:[[0,3],11,[22,28],81],10:[[0,4],[21,24]],11:[[0,3],22,[24,26],81,82],12:[[0,4],21,22,25,26,82],13:[[0,2],[21,24]],14:[[0,2],[21,24]],15:[[0,3],[21,25]],16:[[0,2],[21,23]],17:[[0,2],[21,23]],18:[[0,2],[21,25],81]},35:{0:[0],1:[[0,5],11,[21,25],28,81,82],2:[[0,6],[11,13]],3:[[0,5],22],4:[[0,3],21,[23,30],81],5:[[0,5],21,[24,27],[81,83]],6:[[0,3],[22,29],81],7:[[0,2],[21,25],[81,84]],8:[[0,2],[21,25],81],9:[[0,2],[21,26],81,82]},36:{0:[0],1:[[0,5],11,[21,24]],2:[[0,3],22,81],3:[[0,2],13,[21,23]],4:[[0,3],21,[23,30],81,82],5:[[0,2],21],6:[[0,2],22,81],7:[[0,2],[21,35],81,82],8:[[0,3],[21,30],81],9:[[0,2],[21,26],[81,83]],10:[[0,2],[21,30]],11:[[0,2],[21,30],81]},37:{0:[0],1:[[0,5],12,13,[24,26],81],2:[[0,3],5,[11,14],[81,85]],3:[[0,6],[21,23]],4:[[0,6],81],5:[[0,3],[21,23]],6:[[0,2],[11,13],34,[81,87]],7:[[0,5],24,25,[81,86]],8:[[0,2],11,[26,32],[81,83]],9:[[0,3],11,21,23,82,83],10:[[0,2],[81,83]],11:[[0,3],21,22],12:[[0,3]],13:[[0,2],11,12,[21,29]],14:[[0,2],[21,28],81,82],15:[[0,2],[21,26],81],16:[[0,2],[21,26]],17:[[0,2],[21,28]]},41:{0:[0],1:[[0,6],8,22,[81,85]],2:[[0,5],11,[21,25]],3:[[0,7],11,[22,29],81],4:[[0,4],11,[21,23],25,81,82],5:[[0,3],5,6,22,23,26,27,81],6:[[0,3],11,21,22],7:[[0,4],11,21,[24,28],81,82],8:[[0,4],11,[21,23],25,[81,83]],9:[[0,2],22,23,[26,28]],10:[[0,2],[23,25],81,82],11:[[0,4],[21,23]],12:[[0,2],21,22,24,81,82],13:[[0,3],[21,30],81],14:[[0,3],[21,26],81],15:[[0,3],[21,28]],16:[[0,2],[21,28],81],17:[[0,2],[21,29]],90:[0,1]},42:{0:[0],1:[[0,7],[11,17]],2:[[0,5],22,81],3:[[0,3],[21,25],81],5:[[0,6],[25,29],[81,83]],6:[[0,2],6,7,[24,26],[82,84]],7:[[0,4]],8:[[0,2],4,21,22,81],9:[[0,2],[21,23],81,82,84],10:[[0,3],[22,24],81,83,87],11:[[0,2],[21,27],81,82],12:[[0,2],[21,24],81],13:[[0,3],21,81],28:[[0,2],22,23,[25,28]],90:[0,[4,6],21]},43:{0:[0],1:[[0,5],11,12,21,22,24,81],2:[[0,4],11,21,[23,25],81],3:[[0,2],4,21,81,82],4:[0,1,[5,8],12,[21,24],26,81,82],5:[[0,3],11,[21,25],[27,29],81],6:[[0,3],11,21,23,24,26,81,82],7:[[0,3],[21,26],81],8:[[0,2],11,21,22],9:[[0,3],[21,23],81],10:[[0,3],[21,28],81],11:[[0,3],[21,29]],12:[[0,2],[21,30],81],13:[[0,2],21,22,81,82],31:[0,1,[22,27],30]},44:{0:[0],1:[[0,7],[11,16],83,84],2:[[0,5],21,22,24,29,32,33,81,82],3:[0,1,[3,8]],4:[[0,4]],5:[0,1,[6,15],23,82,83],6:[0,1,[4,8]],7:[0,1,[3,5],81,[83,85]],8:[[0,4],11,23,25,[81,83]],9:[[0,3],23,[81,83]],12:[[0,3],[23,26],83,84],13:[[0,3],[22,24],81],14:[[0,2],[21,24],26,27,81],15:[[0,2],21,23,81],16:[[0,2],[21,25]],17:[[0,2],21,23,81],18:[[0,3],21,23,[25,27],81,82],19:[0],20:[0],51:[[0,3],21,22],52:[[0,3],21,22,24,81],53:[[0,2],[21,23],81]},45:{0:[0],1:[[0,9],[21,27]],2:[[0,5],[21,26]],3:[[0,5],11,12,[21,32]],4:[0,1,[3,6],11,[21,23],81],5:[[0,3],12,21],6:[[0,3],21,81],7:[[0,3],21,22],8:[[0,4],21,81],9:[[0,3],[21,24],81],10:[[0,2],[21,31]],11:[[0,2],[21,23]],12:[[0,2],[21,29],81],13:[[0,2],[21,24],81],14:[[0,2],[21,25],81]},46:{0:[0],1:[0,1,[5,8]],2:[0,1],3:[0,[21,23]],90:[[0,3],[5,7],[21,39]]},50:{0:[0],1:[[0,19]],2:[0,[22,38],[40,43]],3:[0,[81,84]]},51:{0:[0],1:[0,1,[4,8],[12,15],[21,24],29,31,32,[81,84]],3:[[0,4],11,21,22],4:[[0,3],11,21,22],5:[[0,4],21,22,24,25],6:[0,1,3,23,26,[81,83]],7:[0,1,3,4,[22,27],81],8:[[0,2],11,12,[21,24]],9:[[0,4],[21,23]],10:[[0,2],11,24,25,28],11:[[0,2],[11,13],23,24,26,29,32,33,81],13:[[0,4],[21,25],81],14:[[0,2],[21,25]],15:[[0,3],[21,29]],16:[[0,3],[21,23],81],17:[[0,3],[21,25],81],18:[[0,3],[21,27]],19:[[0,3],[21,23]],20:[[0,2],21,22,81],32:[0,[21,33]],33:[0,[21,38]],34:[0,1,[22,37]]},52:{0:[0],1:[[0,3],[11,15],[21,23],81],2:[0,1,3,21,22],3:[[0,3],[21,30],81,82],4:[[0,2],[21,25]],5:[[0,2],[21,27]],6:[[0,3],[21,28]],22:[0,1,[22,30]],23:[0,1,[22,28]],24:[0,1,[22,28]],26:[0,1,[22,36]],27:[[0,2],22,23,[25,32]]},53:{0:[0],1:[[0,3],[11,14],21,22,[24,29],81],3:[[0,2],[21,26],28,81],4:[[0,2],[21,28]],5:[[0,2],[21,24]],6:[[0,2],[21,30]],7:[[0,2],[21,24]],8:[[0,2],[21,29]],9:[[0,2],[21,27]],23:[0,1,[22,29],31],25:[[0,4],[22,32]],26:[0,1,[21,28]],27:[0,1,[22,30]],28:[0,1,22,23],29:[0,1,[22,32]],31:[0,2,3,[22,24]],34:[0,[21,23]],33:[0,21,[23,25]],35:[0,[21,28]]},54:{0:[0],1:[[0,2],[21,27]],21:[0,[21,29],32,33],22:[0,[21,29],[31,33]],23:[0,1,[22,38]],24:[0,[21,31]],25:[0,[21,27]],26:[0,[21,27]]},61:{0:[0],1:[[0,4],[11,16],22,[24,26]],2:[[0,4],22],3:[[0,4],[21,24],[26,31]],4:[[0,4],[22,31],81],5:[[0,2],[21,28],81,82],6:[[0,2],[21,32]],7:[[0,2],[21,30]],8:[[0,2],[21,31]],9:[[0,2],[21,29]],10:[[0,2],[21,26]]},62:{0:[0],1:[[0,5],11,[21,23]],2:[0,1],3:[[0,2],21],4:[[0,3],[21,23]],5:[[0,3],[21,25]],6:[[0,2],[21,23]],7:[[0,2],[21,25]],8:[[0,2],[21,26]],9:[[0,2],[21,24],81,82],10:[[0,2],[21,27]],11:[[0,2],[21,26]],12:[[0,2],[21,28]],24:[0,21,[24,29]],26:[0,21,[23,30]],29:[0,1,[21,27]],30:[0,1,[21,27]]},63:{0:[0],1:[[0,5],[21,23]],2:[0,2,[21,25]],21:[0,[21,23],[26,28]],22:[0,[21,24]],23:[0,[21,24]],25:[0,[21,25]],26:[0,[21,26]],27:[0,1,[21,26]],28:[[0,2],[21,23]]},64:{0:[0],1:[0,1,[4,6],21,22,81],2:[[0,3],5,[21,23]],3:[[0,3],[21,24],81],4:[[0,2],[21,25]],5:[[0,2],21,22]},65:{0:[0],1:[[0,9],21],2:[[0,5]],21:[0,1,22,23],22:[0,1,22,23],23:[[0,3],[23,25],27,28],28:[0,1,[22,29]],29:[0,1,[22,29]],30:[0,1,[22,24]],31:[0,1,[21,31]],32:[0,1,[21,27]],40:[0,2,3,[21,28]],42:[[0,2],21,[23,26]],43:[0,1,[21,26]],90:[[0,4]],27:[[0,2],22,23]},71:{0:[0]},81:{0:[0]},82:{0:[0]}},d=parseInt(b.substr(0,2),10),e=parseInt(b.substr(2,2),10),f=parseInt(b.substr(4,2),10);if(!c[d]||!c[d][e])return!1;for(var g=!1,h=c[d][e],i=0;i<h.length;i++)if(a.isArray(h[i])&&h[i][0]<=f&&f<=h[i][1]||!a.isArray(h[i])&&f===h[i]){g=!0;break}if(!g)return!1;var j;j=18===b.length?b.substr(6,8):"19"+b.substr(6,6);var k=parseInt(j.substr(0,4),10),l=parseInt(j.substr(4,2),10),m=parseInt(j.substr(6,2),10);if(!FormValidation.Helper.date(k,l,m))return!1;if(18===b.length){var n=0,o=[7,9,10,5,8,4,2,1,6,3,7,9,10,5,8,4,2];for(i=0;17>i;i++)n+=parseInt(b.charAt(i),10)*o[i];n=(12-n%11)%11;var p="X"!==b.charAt(17).toUpperCase()?parseInt(b.charAt(17),10):10;return p===n}return!0},_cz:function(a){if(!/^\d{9,10}$/.test(a))return!1;var b=1900+parseInt(a.substr(0,2),10),c=parseInt(a.substr(2,2),10)%50%20,d=parseInt(a.substr(4,2),10);if(9===a.length){if(b>=1980&&(b-=100),b>1953)return!1}else 1954>b&&(b+=100);if(!FormValidation.Helper.date(b,c,d))return!1;if(10===a.length){var e=parseInt(a.substr(0,9),10)%11;return 1985>b&&(e%=10),e+""===a.substr(9,1)}return!0},_dk:function(a){if(!/^[0-9]{6}[-]{0,1}[0-9]{4}$/.test(a))return!1;a=a.replace(/-/g,"");var b=parseInt(a.substr(0,2),10),c=parseInt(a.substr(2,2),10),d=parseInt(a.substr(4,2),10);switch(!0){case-1!=="5678".indexOf(a.charAt(6))&&d>=58:d+=1800;break;case-1!=="0123".indexOf(a.charAt(6)):case-1!=="49".indexOf(a.charAt(6))&&d>=37:d+=1900;break;default:d+=2e3}return FormValidation.Helper.date(d,c,b)},_ee:function(a){return this._lt(a)},_es:function(a){var b=/^[0-9]{8}[-]{0,1}[A-HJ-NP-TV-Z]$/.test(a),c=/^[XYZ][-]{0,1}[0-9]{7}[-]{0,1}[A-HJ-NP-TV-Z]$/.test(a),d=/^[A-HNPQS][-]{0,1}[0-9]{7}[-]{0,1}[0-9A-J]$/.test(a);if(!b&&!c&&!d)return!1;a=a.replace(/-/g,"");var e;if(b||c){var f="XYZ".indexOf(a.charAt(0));return-1!==f&&(a=f+a.substr(1)+""),e=parseInt(a.substr(0,8),10),e="TRWAGMYFPDXBNJZSQVHLCKE"[e%23],e===a.substr(8,1)}e=a.substr(1,7);for(var g=a[0],h=a.substr(-1),i=0,j=0;j<e.length;j++)if(j%2!==0)i+=parseInt(e[j],10);else{var k=""+2*parseInt(e[j],10);i+=parseInt(k[0],10),2===k.length&&(i+=parseInt(k[1],10))}var l=i-10*Math.floor(i/10);return 0!==l&&(l=10-l),-1!=="KQS".indexOf(g)?h==="JABCDEFGHI"[l]:-1!=="ABEH".indexOf(g)?h===""+l:h===""+l||h==="JABCDEFGHI"[l]},_fi:function(a){if(!/^[0-9]{6}[-+A][0-9]{3}[0-9ABCDEFHJKLMNPRSTUVWXY]$/.test(a))return!1;var b=parseInt(a.substr(0,2),10),c=parseInt(a.substr(2,2),10),d=parseInt(a.substr(4,2),10),e={"+":1800,"-":1900,A:2e3};if(d=e[a.charAt(6)]+d,!FormValidation.Helper.date(d,c,b))return!1;var f=parseInt(a.substr(7,3),10);if(2>f)return!1;var g=a.substr(0,6)+a.substr(7,3)+"";return g=parseInt(g,10),"0123456789ABCDEFHJKLMNPRSTUVWXY".charAt(g%31)===a.charAt(10)},_hr:function(a){return/^[0-9]{11}$/.test(a)?FormValidation.Helper.mod11And10(a):!1},_ie:function(a){if(!/^\d{7}[A-W][AHWTX]?$/.test(a))return!1;var b=function(a){for(;a.length<7;)a="0"+a;for(var b="WABCDEFGHIJKLMNOPQRSTUV",c=0,d=0;7>d;d++)c+=parseInt(a.charAt(d),10)*(8-d);return c+=9*b.indexOf(a.substr(7)),b[c%23]};return 9!==a.length||"A"!==a.charAt(8)&&"H"!==a.charAt(8)?a.charAt(7)===b(a.substr(0,7)):a.charAt(7)===b(a.substr(0,7)+a.substr(8)+"")},_is:function(a){if(!/^[0-9]{6}[-]{0,1}[0-9]{4}$/.test(a))return!1;a=a.replace(/-/g,"");var b=parseInt(a.substr(0,2),10),c=parseInt(a.substr(2,2),10),d=parseInt(a.substr(4,2),10),e=parseInt(a.charAt(9),10);if(d=9===e?1900+d:100*(20+e)+d,!FormValidation.Helper.date(d,c,b,!0))return!1;for(var f=0,g=[3,2,7,6,5,4,3,2],h=0;8>h;h++)f+=parseInt(a.charAt(h),10)*g[h];return f=11-f%11,f+""===a.charAt(8)},_lt:function(a){if(!/^[0-9]{11}$/.test(a))return!1;var b=parseInt(a.charAt(0),10),c=parseInt(a.substr(1,2),10),d=parseInt(a.substr(3,2),10),e=parseInt(a.substr(5,2),10),f=b%2===0?17+b/2:17+(b+1)/2;if(c=100*f+c,!FormValidation.Helper.date(c,d,e,!0))return!1;for(var g=0,h=[1,2,3,4,5,6,7,8,9,1],i=0;10>i;i++)g+=parseInt(a.charAt(i),10)*h[i];if(g%=11,10!==g)return g+""===a.charAt(10);for(g=0,h=[3,4,5,6,7,8,9,1,2,3],i=0;10>i;i++)g+=parseInt(a.charAt(i),10)*h[i];return g%=11,10===g&&(g=0),g+""===a.charAt(10)},_lv:function(a){if(!/^[0-9]{6}[-]{0,1}[0-9]{5}$/.test(a))return!1;a=a.replace(/\D/g,"");var b=parseInt(a.substr(0,2),10),c=parseInt(a.substr(2,2),10),d=parseInt(a.substr(4,2),10);if(d=d+1800+100*parseInt(a.charAt(6),10),!FormValidation.Helper.date(d,c,b,!0))return!1;for(var e=0,f=[10,5,8,4,2,1,6,3,7,9],g=0;10>g;g++)e+=parseInt(a.charAt(g),10)*f[g];return e=(e+1)%11%10,e+""===a.charAt(10)},_nl:function(a){for(;a.length<9;)a="0"+a;if(!/^[0-9]{4}[.]{0,1}[0-9]{2}[.]{0,1}[0-9]{3}$/.test(a))return!1;if(a=a.replace(/\./g,""),0===parseInt(a,10))return!1;for(var b=0,c=a.length,d=0;c-1>d;d++)b+=(9-d)*parseInt(a.charAt(d),10);return b%=11,10===b&&(b=0),b+""===a.charAt(c-1)},_pl:function(a){if(!/^[0-9]{11}$/.test(a))return!1;for(var b=0,c=a.length,d=[1,3,7,9,1,3,7,9,1,3,7],e=0;c-1>e;e++)b+=d[e]*parseInt(a.charAt(e),10);return b%=10,0===b&&(b=10),b=10-b,b+""===a.charAt(c-1)},_ro:function(a){if(!/^[0-9]{13}$/.test(a))return!1;var b=parseInt(a.charAt(0),10);if(0===b||7===b||8===b)return!1;var c=parseInt(a.substr(1,2),10),d=parseInt(a.substr(3,2),10),e=parseInt(a.substr(5,2),10),f={1:1900,2:1900,3:1800,4:1800,5:2e3,6:2e3};if(e>31&&d>12)return!1;if(9!==b&&(c=f[b+""]+c,!FormValidation.Helper.date(c,d,e)))return!1;for(var g=0,h=[2,7,9,1,4,6,3,5,8,2,7,9],i=a.length,j=0;i-1>j;j++)g+=parseInt(a.charAt(j),10)*h[j];return g%=11,10===g&&(g=1),g+""===a.charAt(i-1)},_se:function(a){if(!/^[0-9]{10}$/.test(a)&&!/^[0-9]{6}[-|+][0-9]{4}$/.test(a))return!1;a=a.replace(/[^0-9]/g,"");var b=parseInt(a.substr(0,2),10)+1900,c=parseInt(a.substr(2,2),10),d=parseInt(a.substr(4,2),10);return FormValidation.Helper.date(b,c,d)?FormValidation.Helper.luhn(a):!1},_sk:function(a){return this._cz(a)},_sm:function(a){return/^\d{5}$/.test(a)},_th:function(a){if(13!==a.length)return!1;for(var b=0,c=0;12>c;c++)b+=parseInt(a.charAt(c),10)*(13-c);return(11-b%11)%10===parseInt(a.charAt(12),10)},_za:function(a){if(!/^[0-9]{10}[0|1][8|9][0-9]$/.test(a))return!1;var b=parseInt(a.substr(0,2),10),c=(new Date).getFullYear()%100,d=parseInt(a.substr(2,2),10),e=parseInt(a.substr(4,2),10);return b=b>=c?b+1900:b+2e3,FormValidation.Helper.date(b,d,e)?FormValidation.Helper.luhn(a):!1}}}(jQuery),function(a){FormValidation.I18n=a.extend(!0,FormValidation.I18n||{},{en_US:{identical:{"default":"Please enter the same value"}}}),FormValidation.Validator.identical={html5Attributes:{message:"message",field:"field"},init:function(a,b,c){var d=a.getFieldElements(c.field);a.onLiveChange(d,"live_identical",function(){var c=a.getStatus(b,"identical");c!==a.STATUS_NOT_VALIDATED&&a.revalidateField(b)})},destroy:function(a,b,c){var d=a.getFieldElements(c.field);a.offLiveChange(d,"live_identical")},validate:function(a,b,c){var d=a.getFieldValue(b,"identical"),e=a.getFieldElements(c.field);if(null===e||0===e.length)return!0;var f=a.getFieldValue(e,"identical");return d===f?(a.updateStatus(e,a.STATUS_VALID,"identical"),!0):!1}}}(jQuery),function(a){FormValidation.I18n=a.extend(!0,FormValidation.I18n||{},{en_US:{imei:{"default":"Please enter a valid IMEI number"}}}),FormValidation.Validator.imei={validate:function(a,b){var c=a.getFieldValue(b,"imei");if(""===c)return!0;switch(!0){case/^\d{15}$/.test(c):case/^\d{2}-\d{6}-\d{6}-\d{1}$/.test(c):case/^\d{2}\s\d{6}\s\d{6}\s\d{1}$/.test(c):return c=c.replace(/[^0-9]/g,""),FormValidation.Helper.luhn(c);case/^\d{14}$/.test(c):case/^\d{16}$/.test(c):case/^\d{2}-\d{6}-\d{6}(|-\d{2})$/.test(c):case/^\d{2}\s\d{6}\s\d{6}(|\s\d{2})$/.test(c):return!0;default:return!1}}}}(jQuery),function(a){FormValidation.I18n=a.extend(!0,FormValidation.I18n||{},{en_US:{imo:{"default":"Please enter a valid IMO number"}}}),FormValidation.Validator.imo={validate:function(a,b){var c=a.getFieldValue(b,"imo");if(""===c)return!0;if(!/^IMO \d{7}$/i.test(c))return!1;for(var d=0,e=c.replace(/^.*(\d{7})$/,"$1"),f=6;f>=1;f--)d+=e.slice(6-f,-f)*(f+1);return d%10===parseInt(e.charAt(6),10)}}}(jQuery),function(a){FormValidation.I18n=a.extend(!0,FormValidation.I18n||{},{en_US:{integer:{"default":"Please enter a valid number"}}}),FormValidation.Validator.integer={enableByHtml5:function(a){return"number"===a.attr("type")&&(void 0===a.attr("step")||a.attr("step")%1===0)},validate:function(a,b){if(this.enableByHtml5(b)&&b.get(0).validity&&b.get(0).validity.badInput===!0)return!1;var c=a.getFieldValue(b,"integer");return""===c?!0:/^(?:-?(?:0|[1-9][0-9]*))$/.test(c)}}}(jQuery),function(a){FormValidation.I18n=a.extend(!0,FormValidation.I18n||{},{en_US:{ip:{"default":"Please enter a valid IP address",ipv4:"Please enter a valid IPv4 address",ipv6:"Please enter a valid IPv6 address"}}}),FormValidation.Validator.ip={html5Attributes:{message:"message",ipv4:"ipv4",ipv6:"ipv6"},validate:function(b,c,d){var e=b.getFieldValue(c,"ip");if(""===e)return!0;d=a.extend({},{ipv4:!0,ipv6:!0},d);var f,g=b.getLocale(),h=/^(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/,i=/^\s*((([0-9A-Fa-f]{1,4}:){7}([0-9A-Fa-f]{1,4}|:))|(([0-9A-Fa-f]{1,4}:){6}(:[0-9A-Fa-f]{1,4}|((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3})|:))|(([0-9A-Fa-f]{1,4}:){5}(((:[0-9A-Fa-f]{1,4}){1,2})|:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3})|:))|(([0-9A-Fa-f]{1,4}:){4}(((:[0-9A-Fa-f]{1,4}){1,3})|((:[0-9A-Fa-f]{1,4})?:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:))|(([0-9A-Fa-f]{1,4}:){3}(((:[0-9A-Fa-f]{1,4}){1,4})|((:[0-9A-Fa-f]{1,4}){0,2}:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:))|(([0-9A-Fa-f]{1,4}:){2}(((:[0-9A-Fa-f]{1,4}){1,5})|((:[0-9A-Fa-f]{1,4}){0,3}:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:))|(([0-9A-Fa-f]{1,4}:){1}(((:[0-9A-Fa-f]{1,4}){1,6})|((:[0-9A-Fa-f]{1,4}){0,4}:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:))|(:(((:[0-9A-Fa-f]{1,4}){1,7})|((:[0-9A-Fa-f]{1,4}){0,5}:((25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)(\.(25[0-5]|2[0-4]\d|1\d\d|[1-9]?\d)){3}))|:)))(%.+)?\s*$/,j=!1;switch(!0){case d.ipv4&&!d.ipv6:j=h.test(e),f=d.message||FormValidation.I18n[g].ip.ipv4;break;case!d.ipv4&&d.ipv6:j=i.test(e),f=d.message||FormValidation.I18n[g].ip.ipv6;break;case d.ipv4&&d.ipv6:default:j=h.test(e)||i.test(e),f=d.message||FormValidation.I18n[g].ip["default"]}return{valid:j,message:f}}}}(jQuery),function(a){FormValidation.I18n=a.extend(!0,FormValidation.I18n||{},{en_US:{isbn:{"default":"Please enter a valid ISBN number"}}}),FormValidation.Validator.isbn={validate:function(a,b){var c=a.getFieldValue(b,"isbn");if(""===c)return!0;var d;switch(!0){case/^\d{9}[\dX]$/.test(c):case 13===c.length&&/^(\d+)-(\d+)-(\d+)-([\dX])$/.test(c):case 13===c.length&&/^(\d+)\s(\d+)\s(\d+)\s([\dX])$/.test(c):d="ISBN10";break;case/^(978|979)\d{9}[\dX]$/.test(c):case 17===c.length&&/^(978|979)-(\d+)-(\d+)-(\d+)-([\dX])$/.test(c):case 17===c.length&&/^(978|979)\s(\d+)\s(\d+)\s(\d+)\s([\dX])$/.test(c):d="ISBN13";break;default:return!1}c=c.replace(/[^0-9X]/gi,"");var e,f,g=c.split(""),h=g.length,i=0;switch(d){case"ISBN10":for(i=0,e=0;h-1>e;e++)i+=parseInt(g[e],10)*(10-e);return f=11-i%11,11===f?f=0:10===f&&(f="X"),f+""===g[h-1];case"ISBN13":for(i=0,e=0;h-1>e;e++)i+=e%2===0?parseInt(g[e],10):3*parseInt(g[e],10);return f=10-i%10,10===f&&(f="0"),f+""===g[h-1];default:return!1}}}}(jQuery),function(a){FormValidation.I18n=a.extend(!0,FormValidation.I18n||{},{en_US:{isin:{"default":"Please enter a valid ISIN number"}}}),FormValidation.Validator.isin={COUNTRY_CODES:"AF|AX|AL|DZ|AS|AD|AO|AI|AQ|AG|AR|AM|AW|AU|AT|AZ|BS|BH|BD|BB|BY|BE|BZ|BJ|BM|BT|BO|BQ|BA|BW|BV|BR|IO|BN|BG|BF|BI|KH|CM|CA|CV|KY|CF|TD|CL|CN|CX|CC|CO|KM|CG|CD|CK|CR|CI|HR|CU|CW|CY|CZ|DK|DJ|DM|DO|EC|EG|SV|GQ|ER|EE|ET|FK|FO|FJ|FI|FR|GF|PF|TF|GA|GM|GE|DE|GH|GI|GR|GL|GD|GP|GU|GT|GG|GN|GW|GY|HT|HM|VA|HN|HK|HU|IS|IN|ID|IR|IQ|IE|IM|IL|IT|JM|JP|JE|JO|KZ|KE|KI|KP|KR|KW|KG|LA|LV|LB|LS|LR|LY|LI|LT|LU|MO|MK|MG|MW|MY|MV|ML|MT|MH|MQ|MR|MU|YT|MX|FM|MD|MC|MN|ME|MS|MA|MZ|MM|NA|NR|NP|NL|NC|NZ|NI|NE|NG|NU|NF|MP|NO|OM|PK|PW|PS|PA|PG|PY|PE|PH|PN|PL|PT|PR|QA|RE|RO|RU|RW|BL|SH|KN|LC|MF|PM|VC|WS|SM|ST|SA|SN|RS|SC|SL|SG|SX|SK|SI|SB|SO|ZA|GS|SS|ES|LK|SD|SR|SJ|SZ|SE|CH|SY|TW|TJ|TZ|TH|TL|TG|TK|TO|TT|TN|TR|TM|TC|TV|UG|UA|AE|GB|US|UM|UY|UZ|VU|VE|VN|VG|VI|WF|EH|YE|ZM|ZW",validate:function(a,b){var c=a.getFieldValue(b,"isin");if(""===c)return!0;c=c.toUpperCase();var d=new RegExp("^("+this.COUNTRY_CODES+")[0-9A-Z]{10}$");if(!d.test(c))return!1;for(var e="",f=c.length,g=0;f-1>g;g++){var h=c.charCodeAt(g);e+=h>57?(h-55).toString():c.charAt(g)}var i="",j=e.length,k=j%2!==0?0:1;for(g=0;j>g;g++)i+=parseInt(e[g],10)*(g%2===k?2:1)+"";var l=0;for(g=0;g<i.length;g++)l+=parseInt(i.charAt(g),10);return l=(10-l%10)%10,l+""===c.charAt(f-1)}}}(jQuery),function(a){FormValidation.I18n=a.extend(!0,FormValidation.I18n||{},{en_US:{ismn:{"default":"Please enter a valid ISMN number"}}}),FormValidation.Validator.ismn={validate:function(a,b){var c=a.getFieldValue(b,"ismn");if(""===c)return!0;var d;switch(!0){case/^M\d{9}$/.test(c):case/^M-\d{4}-\d{4}-\d{1}$/.test(c):case/^M\s\d{4}\s\d{4}\s\d{1}$/.test(c):d="ISMN10";break;case/^9790\d{9}$/.test(c):case/^979-0-\d{4}-\d{4}-\d{1}$/.test(c):case/^979\s0\s\d{4}\s\d{4}\s\d{1}$/.test(c):d="ISMN13";break;default:return!1}"ISMN10"===d&&(c="9790"+c.substr(1)),c=c.replace(/[^0-9]/gi,"");for(var e=c.length,f=0,g=[1,3],h=0;e-1>h;h++)f+=parseInt(c.charAt(h),10)*g[h%2];return f=10-f%10,f+""===c.charAt(e-1)}}}(jQuery),function(a){FormValidation.I18n=a.extend(!0,FormValidation.I18n||{},{en_US:{issn:{"default":"Please enter a valid ISSN number"}}}),FormValidation.Validator.issn={validate:function(a,b){var c=a.getFieldValue(b,"issn");if(""===c)return!0;if(!/^\d{4}\-\d{3}[\dX]$/.test(c))return!1;c=c.replace(/[^0-9X]/gi,"");var d=c.split(""),e=d.length,f=0;"X"===d[7]&&(d[7]=10);for(var g=0;e>g;g++)f+=parseInt(d[g],10)*(8-g);return f%11===0}}}(jQuery),function(a){FormValidation.I18n=a.extend(!0,FormValidation.I18n||{},{en_US:{lessThan:{"default":"Please enter a value less than or equal to %s",notInclusive:"Please enter a value less than %s"}}}),FormValidation.Validator.lessThan={html5Attributes:{message:"message",value:"value",inclusive:"inclusive"},enableByHtml5:function(a){var b=a.attr("type"),c=a.attr("max");return c&&"date"!==b?{value:c}:!1},validate:function(b,c,d){var e=b.getFieldValue(c,"lessThan");if(""===e)return!0;if(e=this._format(e),!a.isNumeric(e))return!1;var f=b.getLocale(),g=a.isNumeric(d.value)?d.value:b.getDynamicOption(c,d.value),h=this._format(g);return e=parseFloat(e),d.inclusive===!0||void 0===d.inclusive?{valid:h>=e,message:FormValidation.Helper.format(d.message||FormValidation.I18n[f].lessThan["default"],g)}:{valid:h>e,message:FormValidation.Helper.format(d.message||FormValidation.I18n[f].lessThan.notInclusive,g)}},_format:function(a){return(a+"").replace(",",".")}}}(jQuery),function(a){FormValidation.I18n=a.extend(!0,FormValidation.I18n||{},{en_US:{mac:{"default":"Please enter a valid MAC address"}}}),FormValidation.Validator.mac={validate:function(a,b){var c=a.getFieldValue(b,"mac");return""===c?!0:/^([0-9A-F]{2}[:-]){5}([0-9A-F]{2})$/.test(c)}}}(jQuery),function(a){FormValidation.I18n=a.extend(!0,FormValidation.I18n||{},{en_US:{meid:{"default":"Please enter a valid MEID number"}}}),FormValidation.Validator.meid={validate:function(a,b){var c=a.getFieldValue(b,"meid");if(""===c)return!0;switch(!0){case/^[0-9A-F]{15}$/i.test(c):case/^[0-9A-F]{2}[- ][0-9A-F]{6}[- ][0-9A-F]{6}[- ][0-9A-F]$/i.test(c):case/^\d{19}$/.test(c):case/^\d{5}[- ]\d{5}[- ]\d{4}[- ]\d{4}[- ]\d$/.test(c):var d=c.charAt(c.length-1);if(c=c.replace(/[- ]/g,""),c.match(/^\d*$/i))return FormValidation.Helper.luhn(c);c=c.slice(0,-1);for(var e="",f=1;13>=f;f+=2)e+=(2*parseInt(c.charAt(f),16)).toString(16);var g=0;for(f=0;f<e.length;f++)g+=parseInt(e.charAt(f),16);return g%10===0?"0"===d:d===(2*(10*Math.floor((g+10)/10)-g)).toString(16);case/^[0-9A-F]{14}$/i.test(c):case/^[0-9A-F]{2}[- ][0-9A-F]{6}[- ][0-9A-F]{6}$/i.test(c):case/^\d{18}$/.test(c):case/^\d{5}[- ]\d{5}[- ]\d{4}[- ]\d{4}$/.test(c):return!0;default:return!1}}}}(jQuery),function(a){FormValidation.I18n=a.extend(!0,FormValidation.I18n||{},{en_US:{notEmpty:{"default":"Please enter a value"}}}),FormValidation.Validator.notEmpty={enableByHtml5:function(a){var b=a.attr("required")+"";return"required"===b||"true"===b},validate:function(b,c){var d=c.attr("type");if("radio"===d||"checkbox"===d){var e=b.getNamespace();return b.getFieldElements(c.attr("data-"+e+"-field")).filter(":checked").length>0}if("number"===d&&c.get(0).validity&&c.get(0).validity.badInput===!0)return!0;var f=b.getFieldValue(c,"notEmpty");return""!==a.trim(f)}}}(jQuery),function(a){FormValidation.I18n=a.extend(!0,FormValidation.I18n||{},{en_US:{numeric:{"default":"Please enter a valid float number"}}}),FormValidation.Validator.numeric={html5Attributes:{message:"message",separator:"separator"},enableByHtml5:function(a){return"number"===a.attr("type")&&void 0!==a.attr("step")&&a.attr("step")%1!==0},validate:function(a,b,c){if(this.enableByHtml5(b)&&b.get(0).validity&&b.get(0).validity.badInput===!0)return!1;var d=a.getFieldValue(b,"numeric");if(""===d)return!0;var e=c.separator||".";return"."!==e&&(d=d.replace(e,".")),!isNaN(parseFloat(d))&&isFinite(d)}}}(jQuery),function(a){FormValidation.I18n=a.extend(!0,FormValidation.I18n||{},{en_US:{phone:{"default":"Please enter a valid phone number",country:"Please enter a valid phone number in %s",countries:{AE:"United Arab Emirates",BG:"Bulgaria",BR:"Brazil",CN:"China",CZ:"Czech Republic",DE:"Germany",DK:"Denmark",ES:"Spain",FR:"France",GB:"United Kingdom",IN:"India",MA:"Morocco",NL:"Netherlands",PK:"Pakistan",RO:"Romania",RU:"Russia",SK:"Slovakia",TH:"Thailand",US:"USA",VE:"Venezuela"}}}}),FormValidation.Validator.phone={html5Attributes:{message:"message",country:"country"},COUNTRY_CODES:["AE","BG","BR","CN","CZ","DE","DK","ES","FR","GB","IN","MA","NL","PK","RO","RU","SK","TH","US","VE"],validate:function(b,c,d){var e=b.getFieldValue(c,"phone");if(""===e)return!0;var f=b.getLocale(),g=d.country;if(("string"!=typeof g||-1===a.inArray(g,this.COUNTRY_CODES))&&(g=b.getDynamicOption(c,g)),!g||-1===a.inArray(g.toUpperCase(),this.COUNTRY_CODES))return!0;var h=!0;switch(g.toUpperCase()){case"AE":e=a.trim(e),h=/^(((\+|00)?971[\s\.-]?(\(0\)[\s\.-]?)?|0)(\(5(0|2|5|6)\)|5(0|2|5|6)|2|3|4|6|7|9)|60)([\s\.-]?[0-9]){7}$/.test(e);break;case"BG":e=e.replace(/\+|\s|-|\/|\(|\)/gi,""),h=/^(0|359|00)(((700|900)[0-9]{5}|((800)[0-9]{5}|(800)[0-9]{4}))|(87|88|89)([0-9]{7})|((2[0-9]{7})|(([3-9][0-9])(([0-9]{6})|([0-9]{5})))))$/.test(e);break;case"BR":e=a.trim(e),h=/^(([\d]{4}[-.\s]{1}[\d]{2,3}[-.\s]{1}[\d]{2}[-.\s]{1}[\d]{2})|([\d]{4}[-.\s]{1}[\d]{3}[-.\s]{1}[\d]{4})|((\(?\+?[0-9]{2}\)?\s?)?(\(?\d{2}\)?\s?)?\d{4,5}[-.\s]?\d{4}))$/.test(e);break;case"CN":e=a.trim(e),h=/^((00|\+)?(86(?:-| )))?((\d{11})|(\d{3}[- ]{1}\d{4}[- ]{1}\d{4})|((\d{2,4}[- ]){1}(\d{7,8}|(\d{3,4}[- ]{1}\d{4}))([- ]{1}\d{1,4})?))$/.test(e);break;case"CZ":h=/^(((00)([- ]?)|\+)(420)([- ]?))?((\d{3})([- ]?)){2}(\d{3})$/.test(e);break;case"DE":e=a.trim(e),h=/^(((((((00|\+)49[ \-/]?)|0)[1-9][0-9]{1,4})[ \-/]?)|((((00|\+)49\()|\(0)[1-9][0-9]{1,4}\)[ \-/]?))[0-9]{1,7}([ \-/]?[0-9]{1,5})?)$/.test(e);break;case"DK":e=a.trim(e),h=/^(\+45|0045|\(45\))?\s?[2-9](\s?\d){7}$/.test(e);break;case"ES":e=a.trim(e),h=/^(?:(?:(?:\+|00)34\D?))?(?:5|6|7|8|9)(?:\d\D?){8}$/.test(e);break;case"FR":e=a.trim(e),h=/^(?:(?:(?:\+|00)33[ ]?(?:\(0\)[ ]?)?)|0){1}[1-9]{1}([ .-]?)(?:\d{2}\1?){3}\d{2}$/.test(e);break;case"GB":e=a.trim(e),h=/^\(?(?:(?:0(?:0|11)\)?[\s-]?\(?|\+)44\)?[\s-]?\(?(?:0\)?[\s-]?\(?)?|0)(?:\d{2}\)?[\s-]?\d{4}[\s-]?\d{4}|\d{3}\)?[\s-]?\d{3}[\s-]?\d{3,4}|\d{4}\)?[\s-]?(?:\d{5}|\d{3}[\s-]?\d{3})|\d{5}\)?[\s-]?\d{4,5}|8(?:00[\s-]?11[\s-]?11|45[\s-]?46[\s-]?4\d))(?:(?:[\s-]?(?:x|ext\.?\s?|\#)\d+)?)$/.test(e);break;case"IN":e=a.trim(e),h=/((\+?)((0[ -]+)*|(91 )*)(\d{12}|\d{10}))|\d{5}([- ]*)\d{6}/.test(e);break;case"MA":e=a.trim(e),h=/^(?:(?:(?:\+|00)212[\s]?(?:[\s]?\(0\)[\s]?)?)|0){1}(?:5[\s.-]?[2-3]|6[\s.-]?[13-9]){1}[0-9]{1}(?:[\s.-]?\d{2}){3}$/.test(e);break;case"NL":e=a.trim(e),h=/^((\+|00(\s|\s?\-\s?)?)31(\s|\s?\-\s?)?(\(0\)[\-\s]?)?|0)[1-9]((\s|\s?\-\s?)?[0-9])((\s|\s?-\s?)?[0-9])((\s|\s?-\s?)?[0-9])\s?[0-9]\s?[0-9]\s?[0-9]\s?[0-9]\s?[0-9]$/gm.test(e);break;case"PK":e=a.trim(e),h=/^0?3[0-9]{2}[0-9]{7}$/.test(e);break;case"RO":h=/^(\+4|)?(07[0-8]{1}[0-9]{1}|02[0-9]{2}|03[0-9]{2}){1}?(\s|\.|\-)?([0-9]{3}(\s|\.|\-|)){2}$/g.test(e);break;case"RU":h=/^((8|\+7|007)[\-\.\/ ]?)?([\(\/\.]?\d{3}[\)\/\.]?[\-\.\/ ]?)?[\d\-\.\/ ]{7,10}$/g.test(e);break;case"SK":h=/^(((00)([- ]?)|\+)(421)([- ]?))?((\d{3})([- ]?)){2}(\d{3})$/.test(e);break;case"TH":h=/^0\(?([6|8-9]{2})*-([0-9]{3})*-([0-9]{4})$/.test(e);break;case"VE":e=a.trim(e),h=/^0(?:2(?:12|4[0-9]|5[1-9]|6[0-9]|7[0-8]|8[1-35-8]|9[1-5]|3[45789])|4(?:1[246]|2[46]))\d{7}$/.test(e);break;case"US":default:h=/^(?:(1\-?)|(\+1 ?))?\(?(\d{3})[\)\-\.]?(\d{3})[\-\.]?(\d{4})$/.test(e)}return{valid:h,message:FormValidation.Helper.format(d.message||FormValidation.I18n[f].phone.country,FormValidation.I18n[f].phone.countries[g])}}}}(jQuery),function(a){FormValidation.I18n=a.extend(!0,FormValidation.I18n||{},{en_US:{regexp:{"default":"Please enter a value matching the pattern"}}}),FormValidation.Validator.regexp={html5Attributes:{message:"message",regexp:"regexp"},enableByHtml5:function(a){var b=a.attr("pattern");return b?{regexp:b}:!1},validate:function(a,b,c){var d=a.getFieldValue(b,"regexp");if(""===d)return!0;var e="string"==typeof c.regexp?new RegExp(c.regexp):c.regexp;return e.test(d)}}}(jQuery),function(a){FormValidation.I18n=a.extend(!0,FormValidation.I18n||{},{en_US:{remote:{"default":"Please enter a valid value"}}}),FormValidation.Validator.remote={html5Attributes:{crossdomain:"crossDomain",data:"data",datatype:"dataType",delay:"delay",message:"message",name:"name",type:"type",url:"url",validkey:"validKey"},destroy:function(a,b){var c=a.getNamespace(),d=b.data(c+".remote.timer");d&&(clearTimeout(d),b.removeData(c+".remote.timer"))},validate:function(b,c,d){function e(){var b=a.ajax(m);return b.success(function(a){a.valid=a[l]===!0||"true"===a[l]?!0:a[l]===!1||"false"===a[l]?!1:null,h.resolve(c,"remote",a)
}).error(function(){h.resolve(c,"remote",{valid:!1})}),h.fail(function(){b.abort()}),h}var f=b.getNamespace(),g=b.getFieldValue(c,"remote"),h=new a.Deferred;if(""===g)return h.resolve(c,"remote",{valid:!0}),h;var i=c.attr("data-"+f+"-field"),j=d.data||{},k=d.url,l=d.validKey||"valid";"function"==typeof j&&(j=j.call(this,b)),"string"==typeof j&&(j=JSON.parse(j)),"function"==typeof k&&(k=k.call(this,b)),j[d.name||i]=g;var m={data:j,dataType:d.dataType||"json",headers:d.headers||{},type:d.type||"GET",url:k};return null!==d.crossDomain&&(m.crossDomain=d.crossDomain===!0||"true"===d.crossDomain),d.delay?(c.data(f+".remote.timer")&&clearTimeout(c.data(f+".remote.timer")),c.data(f+".remote.timer",setTimeout(e,d.delay)),h):e()}}}(jQuery),function(a){FormValidation.I18n=a.extend(!0,FormValidation.I18n||{},{en_US:{rtn:{"default":"Please enter a valid RTN number"}}}),FormValidation.Validator.rtn={validate:function(a,b){var c=a.getFieldValue(b,"rtn");if(""===c)return!0;if(!/^\d{9}$/.test(c))return!1;for(var d=0,e=0;e<c.length;e+=3)d+=3*parseInt(c.charAt(e),10)+7*parseInt(c.charAt(e+1),10)+parseInt(c.charAt(e+2),10);return 0!==d&&d%10===0}}}(jQuery),function(a){FormValidation.I18n=a.extend(!0,FormValidation.I18n||{},{en_US:{sedol:{"default":"Please enter a valid SEDOL number"}}}),FormValidation.Validator.sedol={validate:function(a,b){var c=a.getFieldValue(b,"sedol");if(""===c)return!0;if(c=c.toUpperCase(),!/^[0-9A-Z]{7}$/.test(c))return!1;for(var d=0,e=[1,3,1,7,3,9,1],f=c.length,g=0;f-1>g;g++)d+=e[g]*parseInt(c.charAt(g),36);return d=(10-d%10)%10,d+""===c.charAt(f-1)}}}(jQuery),function(a){FormValidation.I18n=a.extend(!0,FormValidation.I18n||{},{en_US:{siren:{"default":"Please enter a valid SIREN number"}}}),FormValidation.Validator.siren={validate:function(a,b){var c=a.getFieldValue(b,"siren");return""===c?!0:/^\d{9}$/.test(c)?FormValidation.Helper.luhn(c):!1}}}(jQuery),function(a){FormValidation.I18n=a.extend(!0,FormValidation.I18n||{},{en_US:{siret:{"default":"Please enter a valid SIRET number"}}}),FormValidation.Validator.siret={validate:function(a,b){var c=a.getFieldValue(b,"siret");if(""===c)return!0;for(var d,e=0,f=c.length,g=0;f>g;g++)d=parseInt(c.charAt(g),10),g%2===0&&(d=2*d,d>9&&(d-=9)),e+=d;return e%10===0}}}(jQuery),function(a){FormValidation.I18n=a.extend(!0,FormValidation.I18n||{},{en_US:{step:{"default":"Please enter a valid step of %s"}}}),FormValidation.Validator.step={html5Attributes:{message:"message",base:"baseValue",step:"step"},validate:function(b,c,d){var e=b.getFieldValue(c,"step");if(""===e)return!0;if(d=a.extend({},{baseValue:0,step:1},d),e=parseFloat(e),!a.isNumeric(e))return!1;var f=function(a,b){var c=Math.pow(10,b);a*=c;var d=a>0|-(0>a),e=a%1===.5*d;return e?(Math.floor(a)+(d>0))/c:Math.round(a)/c},g=function(a,b){if(0===b)return 1;var c=(a+"").split("."),d=(b+"").split("."),e=(1===c.length?0:c[1].length)+(1===d.length?0:d[1].length);return f(a-b*Math.floor(a/b),e)},h=b.getLocale(),i=g(e-d.baseValue,d.step);return{valid:0===i||i===d.step,message:FormValidation.Helper.format(d.message||FormValidation.I18n[h].step["default"],[d.step])}}}}(jQuery),function(a){FormValidation.I18n=a.extend(!0,FormValidation.I18n||{},{en_US:{stringCase:{"default":"Please enter only lowercase characters",upper:"Please enter only uppercase characters"}}}),FormValidation.Validator.stringCase={html5Attributes:{message:"message","case":"case"},validate:function(a,b,c){var d=a.getFieldValue(b,"stringCase");if(""===d)return!0;var e=a.getLocale(),f=(c["case"]||"lower").toLowerCase();return{valid:"upper"===f?d===d.toUpperCase():d===d.toLowerCase(),message:c.message||("upper"===f?FormValidation.I18n[e].stringCase.upper:FormValidation.I18n[e].stringCase["default"])}}}}(jQuery),function(a){FormValidation.I18n=a.extend(!0,FormValidation.I18n||{},{en_US:{stringLength:{"default":"Please enter a value with valid length",less:"Please enter less than %s characters",more:"Please enter more than %s characters",between:"Please enter value between %s and %s characters long"}}}),FormValidation.Validator.stringLength={html5Attributes:{message:"message",min:"min",max:"max",trim:"trim",utf8bytes:"utf8Bytes"},enableByHtml5:function(b){var c={},d=b.attr("maxlength"),e=b.attr("minlength");return d&&(c.max=parseInt(d,10)),e&&(c.min=parseInt(e,10)),a.isEmptyObject(c)?!1:c},validate:function(b,c,d){var e=b.getFieldValue(c,"stringLength");if((d.trim===!0||"true"===d.trim)&&(e=a.trim(e)),""===e)return!0;var f=b.getLocale(),g=a.isNumeric(d.min)?d.min:b.getDynamicOption(c,d.min),h=a.isNumeric(d.max)?d.max:b.getDynamicOption(c,d.max),i=function(a){for(var b=a.length,c=a.length-1;c>=0;c--){var d=a.charCodeAt(c);d>127&&2047>=d?b++:d>2047&&65535>=d&&(b+=2),d>=56320&&57343>=d&&c--}return b},j=d.utf8Bytes?i(e):e.length,k=!0,l=d.message||FormValidation.I18n[f].stringLength["default"];switch((g&&j<parseInt(g,10)||h&&j>parseInt(h,10))&&(k=!1),!0){case!!g&&!!h:l=FormValidation.Helper.format(d.message||FormValidation.I18n[f].stringLength.between,[parseInt(g,10),parseInt(h,10)]);break;case!!g:l=FormValidation.Helper.format(d.message||FormValidation.I18n[f].stringLength.more,parseInt(g,10));break;case!!h:l=FormValidation.Helper.format(d.message||FormValidation.I18n[f].stringLength.less,parseInt(h,10))}return{valid:k,message:l}}}}(jQuery),function(a){FormValidation.I18n=a.extend(!0,FormValidation.I18n||{},{en_US:{uri:{"default":"Please enter a valid URI"}}}),FormValidation.Validator.uri={html5Attributes:{message:"message",allowlocal:"allowLocal",allowemptyprotocol:"allowEmptyProtocol",protocol:"protocol"},enableByHtml5:function(a){return"url"===a.attr("type")},validate:function(a,b,c){var d=a.getFieldValue(b,"uri");if(""===d)return!0;var e=c.allowLocal===!0||"true"===c.allowLocal,f=c.allowEmptyProtocol===!0||"true"===c.allowEmptyProtocol,g=(c.protocol||"http, https, ftp").split(",").join("|").replace(/\s/g,""),h=new RegExp("^(?:(?:"+g+")://)"+(f?"?":"")+"(?:\\S+(?::\\S*)?@)?(?:"+(e?"":"(?!(?:10|127)(?:\\.\\d{1,3}){3})(?!(?:169\\.254|192\\.168)(?:\\.\\d{1,3}){2})(?!172\\.(?:1[6-9]|2\\d|3[0-1])(?:\\.\\d{1,3}){2})")+"(?:[1-9]\\d?|1\\d\\d|2[01]\\d|22[0-3])(?:\\.(?:1?\\d{1,2}|2[0-4]\\d|25[0-5])){2}(?:\\.(?:[1-9]\\d?|1\\d\\d|2[0-4]\\d|25[0-4]))|(?:(?:[a-z\\u00a1-\\uffff0-9]-?)*[a-z\\u00a1-\\uffff0-9]+)(?:\\.(?:[a-z\\u00a1-\\uffff0-9]-?)*[a-z\\u00a1-\\uffff0-9])*(?:\\.(?:[a-z\\u00a1-\\uffff]{2,}))"+(e?"?":"")+")(?::\\d{2,5})?(?:/[^\\s]*)?$","i");return h.test(d)}}}(jQuery),function(a){FormValidation.I18n=a.extend(!0,FormValidation.I18n||{},{en_US:{uuid:{"default":"Please enter a valid UUID number",version:"Please enter a valid UUID version %s number"}}}),FormValidation.Validator.uuid={html5Attributes:{message:"message",version:"version"},validate:function(a,b,c){var d=a.getFieldValue(b,"uuid");if(""===d)return!0;var e=a.getLocale(),f={3:/^[0-9A-F]{8}-[0-9A-F]{4}-3[0-9A-F]{3}-[0-9A-F]{4}-[0-9A-F]{12}$/i,4:/^[0-9A-F]{8}-[0-9A-F]{4}-4[0-9A-F]{3}-[89AB][0-9A-F]{3}-[0-9A-F]{12}$/i,5:/^[0-9A-F]{8}-[0-9A-F]{4}-5[0-9A-F]{3}-[89AB][0-9A-F]{3}-[0-9A-F]{12}$/i,all:/^[0-9A-F]{8}-[0-9A-F]{4}-[0-9A-F]{4}-[0-9A-F]{4}-[0-9A-F]{12}$/i},g=c.version?c.version+"":"all";return{valid:null===f[g]?!0:f[g].test(d),message:c.version?FormValidation.Helper.format(c.message||FormValidation.I18n[e].uuid.version,c.version):c.message||FormValidation.I18n[e].uuid["default"]}}}}(jQuery),function(a){FormValidation.I18n=a.extend(!0,FormValidation.I18n||{},{en_US:{vat:{"default":"Please enter a valid VAT number",country:"Please enter a valid VAT number in %s",countries:{AT:"Austria",BE:"Belgium",BG:"Bulgaria",BR:"Brazil",CH:"Switzerland",CY:"Cyprus",CZ:"Czech Republic",DE:"Germany",DK:"Denmark",EE:"Estonia",ES:"Spain",FI:"Finland",FR:"France",GB:"United Kingdom",GR:"Greek",EL:"Greek",HU:"Hungary",HR:"Croatia",IE:"Ireland",IS:"Iceland",IT:"Italy",LT:"Lithuania",LU:"Luxembourg",LV:"Latvia",MT:"Malta",NL:"Netherlands",NO:"Norway",PL:"Poland",PT:"Portugal",RO:"Romania",RU:"Russia",RS:"Serbia",SE:"Sweden",SI:"Slovenia",SK:"Slovakia",VE:"Venezuela",ZA:"South Africa"}}}}),FormValidation.Validator.vat={html5Attributes:{message:"message",country:"country"},COUNTRY_CODES:["AT","BE","BG","BR","CH","CY","CZ","DE","DK","EE","EL","ES","FI","FR","GB","GR","HR","HU","IE","IS","IT","LT","LU","LV","MT","NL","NO","PL","PT","RO","RU","RS","SE","SK","SI","VE","ZA"],validate:function(b,c,d){var e=b.getFieldValue(c,"vat");if(""===e)return!0;var f=b.getLocale(),g=d.country;if(g?("string"!=typeof g||-1===a.inArray(g.toUpperCase(),this.COUNTRY_CODES))&&(g=b.getDynamicOption(c,g)):g=e.substr(0,2),-1===a.inArray(g,this.COUNTRY_CODES))return!0;var h=["_",g.toLowerCase()].join("");return this[h](e)?!0:{valid:!1,message:FormValidation.Helper.format(d.message||FormValidation.I18n[f].vat.country,FormValidation.I18n[f].vat.countries[g.toUpperCase()])}},_at:function(a){if(/^ATU[0-9]{8}$/.test(a)&&(a=a.substr(2)),!/^U[0-9]{8}$/.test(a))return!1;a=a.substr(1);for(var b=0,c=[1,2,1,2,1,2,1],d=0,e=0;7>e;e++)d=parseInt(a.charAt(e),10)*c[e],d>9&&(d=Math.floor(d/10)+d%10),b+=d;return b=10-(b+4)%10,10===b&&(b=0),b+""===a.substr(7,1)},_be:function(a){if(/^BE[0]{0,1}[0-9]{9}$/.test(a)&&(a=a.substr(2)),!/^[0]{0,1}[0-9]{9}$/.test(a))return!1;if(9===a.length&&(a="0"+a),"0"===a.substr(1,1))return!1;var b=parseInt(a.substr(0,8),10)+parseInt(a.substr(8,2),10);return b%97===0},_bg:function(a){if(/^BG[0-9]{9,10}$/.test(a)&&(a=a.substr(2)),!/^[0-9]{9,10}$/.test(a))return!1;var b=0,c=0;if(9===a.length){for(c=0;8>c;c++)b+=parseInt(a.charAt(c),10)*(c+1);if(b%=11,10===b)for(b=0,c=0;8>c;c++)b+=parseInt(a.charAt(c),10)*(c+3);return b%=10,b+""===a.substr(8)}if(10===a.length){var d=function(a){var b=parseInt(a.substr(0,2),10)+1900,c=parseInt(a.substr(2,2),10),d=parseInt(a.substr(4,2),10);if(c>40?(b+=100,c-=40):c>20&&(b-=100,c-=20),!FormValidation.Helper.date(b,c,d))return!1;for(var e=0,f=[2,4,8,5,10,9,7,3,6],g=0;9>g;g++)e+=parseInt(a.charAt(g),10)*f[g];return e=e%11%10,e+""===a.substr(9,1)},e=function(a){for(var b=0,c=[21,19,17,13,11,9,7,3,1],d=0;9>d;d++)b+=parseInt(a.charAt(d),10)*c[d];return b%=10,b+""===a.substr(9,1)},f=function(a){for(var b=0,c=[4,3,2,7,6,5,4,3,2],d=0;9>d;d++)b+=parseInt(a.charAt(d),10)*c[d];return b=11-b%11,10===b?!1:(11===b&&(b=0),b+""===a.substr(9,1))};return d(a)||e(a)||f(a)}return!1},_br:function(a){if(""===a)return!0;var b=a.replace(/[^\d]+/g,"");if(""===b||14!==b.length)return!1;if("00000000000000"===b||"11111111111111"===b||"22222222222222"===b||"33333333333333"===b||"44444444444444"===b||"55555555555555"===b||"66666666666666"===b||"77777777777777"===b||"88888888888888"===b||"99999999999999"===b)return!1;for(var c=b.length-2,d=b.substring(0,c),e=b.substring(c),f=0,g=c-7,h=c;h>=1;h--)f+=parseInt(d.charAt(c-h),10)*g--,2>g&&(g=9);var i=2>f%11?0:11-f%11;if(i!==parseInt(e.charAt(0),10))return!1;for(c+=1,d=b.substring(0,c),f=0,g=c-7,h=c;h>=1;h--)f+=parseInt(d.charAt(c-h),10)*g--,2>g&&(g=9);return i=2>f%11?0:11-f%11,i===parseInt(e.charAt(1),10)},_ch:function(a){if(/^CHE[0-9]{9}(MWST)?$/.test(a)&&(a=a.substr(2)),!/^E[0-9]{9}(MWST)?$/.test(a))return!1;a=a.substr(1);for(var b=0,c=[5,4,3,2,7,6,5,4],d=0;8>d;d++)b+=parseInt(a.charAt(d),10)*c[d];return b=11-b%11,10===b?!1:(11===b&&(b=0),b+""===a.substr(8,1))},_cy:function(a){if(/^CY[0-5|9]{1}[0-9]{7}[A-Z]{1}$/.test(a)&&(a=a.substr(2)),!/^[0-5|9]{1}[0-9]{7}[A-Z]{1}$/.test(a))return!1;if("12"===a.substr(0,2))return!1;for(var b=0,c={0:1,1:0,2:5,3:7,4:9,5:13,6:15,7:17,8:19,9:21},d=0;8>d;d++){var e=parseInt(a.charAt(d),10);d%2===0&&(e=c[e+""]),b+=e}return b="ABCDEFGHIJKLMNOPQRSTUVWXYZ"[b%26],b+""===a.substr(8,1)},_cz:function(a){if(/^CZ[0-9]{8,10}$/.test(a)&&(a=a.substr(2)),!/^[0-9]{8,10}$/.test(a))return!1;var b=0,c=0;if(8===a.length){if(a.charAt(0)+""=="9")return!1;for(b=0,c=0;7>c;c++)b+=parseInt(a.charAt(c),10)*(8-c);return b=11-b%11,10===b&&(b=0),11===b&&(b=1),b+""===a.substr(7,1)}if(9===a.length&&a.charAt(0)+""=="6"){for(b=0,c=0;7>c;c++)b+=parseInt(a.charAt(c+1),10)*(8-c);return b=11-b%11,10===b&&(b=0),11===b&&(b=1),b=[8,7,6,5,4,3,2,1,0,9,10][b-1],b+""===a.substr(8,1)}if(9===a.length||10===a.length){var d=1900+parseInt(a.substr(0,2),10),e=parseInt(a.substr(2,2),10)%50%20,f=parseInt(a.substr(4,2),10);if(9===a.length){if(d>=1980&&(d-=100),d>1953)return!1}else 1954>d&&(d+=100);if(!FormValidation.Helper.date(d,e,f))return!1;if(10===a.length){var g=parseInt(a.substr(0,9),10)%11;return 1985>d&&(g%=10),g+""===a.substr(9,1)}return!0}return!1},_de:function(a){return/^DE[0-9]{9}$/.test(a)&&(a=a.substr(2)),/^[0-9]{9}$/.test(a)?FormValidation.Helper.mod11And10(a):!1},_dk:function(a){if(/^DK[0-9]{8}$/.test(a)&&(a=a.substr(2)),!/^[0-9]{8}$/.test(a))return!1;for(var b=0,c=[2,7,6,5,4,3,2,1],d=0;8>d;d++)b+=parseInt(a.charAt(d),10)*c[d];return b%11===0},_ee:function(a){if(/^EE[0-9]{9}$/.test(a)&&(a=a.substr(2)),!/^[0-9]{9}$/.test(a))return!1;for(var b=0,c=[3,7,1,3,7,1,3,7,1],d=0;9>d;d++)b+=parseInt(a.charAt(d),10)*c[d];return b%10===0},_es:function(a){if(/^ES[0-9A-Z][0-9]{7}[0-9A-Z]$/.test(a)&&(a=a.substr(2)),!/^[0-9A-Z][0-9]{7}[0-9A-Z]$/.test(a))return!1;var b=function(a){var b=parseInt(a.substr(0,8),10);return b="TRWAGMYFPDXBNJZSQVHLCKE"[b%23],b+""===a.substr(8,1)},c=function(a){var b=["XYZ".indexOf(a.charAt(0)),a.substr(1)].join("");return b=parseInt(b,10),b="TRWAGMYFPDXBNJZSQVHLCKE"[b%23],b+""===a.substr(8,1)},d=function(a){var b,c=a.charAt(0);if(-1!=="KLM".indexOf(c))return b=parseInt(a.substr(1,8),10),b="TRWAGMYFPDXBNJZSQVHLCKE"[b%23],b+""===a.substr(8,1);if(-1!=="ABCDEFGHJNPQRSUVW".indexOf(c)){for(var d=0,e=[2,1,2,1,2,1,2],f=0,g=0;7>g;g++)f=parseInt(a.charAt(g+1),10)*e[g],f>9&&(f=Math.floor(f/10)+f%10),d+=f;return d=10-d%10,10===d&&(d=0),d+""===a.substr(8,1)||"JABCDEFGHI"[d]===a.substr(8,1)}return!1},e=a.charAt(0);return/^[0-9]$/.test(e)?b(a):/^[XYZ]$/.test(e)?c(a):d(a)},_fi:function(a){if(/^FI[0-9]{8}$/.test(a)&&(a=a.substr(2)),!/^[0-9]{8}$/.test(a))return!1;for(var b=0,c=[7,9,10,5,8,4,2,1],d=0;8>d;d++)b+=parseInt(a.charAt(d),10)*c[d];return b%11===0},_fr:function(a){if(/^FR[0-9A-Z]{2}[0-9]{9}$/.test(a)&&(a=a.substr(2)),!/^[0-9A-Z]{2}[0-9]{9}$/.test(a))return!1;if(!FormValidation.Helper.luhn(a.substr(2)))return!1;if(/^[0-9]{2}$/.test(a.substr(0,2)))return a.substr(0,2)===parseInt(a.substr(2)+"12",10)%97+"";var b,c="0123456789ABCDEFGHJKLMNPQRSTUVWXYZ";return b=/^[0-9]{1}$/.test(a.charAt(0))?24*c.indexOf(a.charAt(0))+c.indexOf(a.charAt(1))-10:34*c.indexOf(a.charAt(0))+c.indexOf(a.charAt(1))-100,(parseInt(a.substr(2),10)+1+Math.floor(b/11))%11===b%11},_gb:function(a){if((/^GB[0-9]{9}$/.test(a)||/^GB[0-9]{12}$/.test(a)||/^GBGD[0-9]{3}$/.test(a)||/^GBHA[0-9]{3}$/.test(a)||/^GB(GD|HA)8888[0-9]{5}$/.test(a))&&(a=a.substr(2)),!(/^[0-9]{9}$/.test(a)||/^[0-9]{12}$/.test(a)||/^GD[0-9]{3}$/.test(a)||/^HA[0-9]{3}$/.test(a)||/^(GD|HA)8888[0-9]{5}$/.test(a)))return!1;var b=a.length;if(5===b){var c=a.substr(0,2),d=parseInt(a.substr(2),10);return"GD"===c&&500>d||"HA"===c&&d>=500}if(11===b&&("GD8888"===a.substr(0,6)||"HA8888"===a.substr(0,6)))return"GD"===a.substr(0,2)&&parseInt(a.substr(6,3),10)>=500||"HA"===a.substr(0,2)&&parseInt(a.substr(6,3),10)<500?!1:parseInt(a.substr(6,3),10)%97===parseInt(a.substr(9,2),10);if(9===b||12===b){for(var e=0,f=[8,7,6,5,4,3,2,10,1],g=0;9>g;g++)e+=parseInt(a.charAt(g),10)*f[g];return e%=97,parseInt(a.substr(0,3),10)>=100?0===e||42===e||55===e:0===e}return!0},_gr:function(a){if(/^(GR|EL)[0-9]{9}$/.test(a)&&(a=a.substr(2)),!/^[0-9]{9}$/.test(a))return!1;8===a.length&&(a="0"+a);for(var b=0,c=[256,128,64,32,16,8,4,2],d=0;8>d;d++)b+=parseInt(a.charAt(d),10)*c[d];return b=b%11%10,b+""===a.substr(8,1)},_el:function(a){return this._gr(a)},_hu:function(a){if(/^HU[0-9]{8}$/.test(a)&&(a=a.substr(2)),!/^[0-9]{8}$/.test(a))return!1;for(var b=0,c=[9,7,3,1,9,7,3,1],d=0;8>d;d++)b+=parseInt(a.charAt(d),10)*c[d];return b%10===0},_hr:function(a){return/^HR[0-9]{11}$/.test(a)&&(a=a.substr(2)),/^[0-9]{11}$/.test(a)?FormValidation.Helper.mod11And10(a):!1},_ie:function(a){if(/^IE[0-9]{1}[0-9A-Z\*\+]{1}[0-9]{5}[A-Z]{1,2}$/.test(a)&&(a=a.substr(2)),!/^[0-9]{1}[0-9A-Z\*\+]{1}[0-9]{5}[A-Z]{1,2}$/.test(a))return!1;var b=function(a){for(;a.length<7;)a="0"+a;for(var b="WABCDEFGHIJKLMNOPQRSTUV",c=0,d=0;7>d;d++)c+=parseInt(a.charAt(d),10)*(8-d);return c+=9*b.indexOf(a.substr(7)),b[c%23]};return/^[0-9]+$/.test(a.substr(0,7))?a.charAt(7)===b(a.substr(0,7)+a.substr(8)+""):-1!=="ABCDEFGHIJKLMNOPQRSTUVWXYZ+*".indexOf(a.charAt(1))?a.charAt(7)===b(a.substr(2,5)+a.substr(0,1)+""):!0},_is:function(a){return/^IS[0-9]{5,6}$/.test(a)&&(a=a.substr(2)),/^[0-9]{5,6}$/.test(a)},_it:function(a){if(/^IT[0-9]{11}$/.test(a)&&(a=a.substr(2)),!/^[0-9]{11}$/.test(a))return!1;if(0===parseInt(a.substr(0,7),10))return!1;var b=parseInt(a.substr(7,3),10);return 1>b||b>201&&999!==b&&888!==b?!1:FormValidation.Helper.luhn(a)},_lt:function(a){if(/^LT([0-9]{7}1[0-9]{1}|[0-9]{10}1[0-9]{1})$/.test(a)&&(a=a.substr(2)),!/^([0-9]{7}1[0-9]{1}|[0-9]{10}1[0-9]{1})$/.test(a))return!1;var b,c=a.length,d=0;for(b=0;c-1>b;b++)d+=parseInt(a.charAt(b),10)*(1+b%9);var e=d%11;if(10===e)for(d=0,b=0;c-1>b;b++)d+=parseInt(a.charAt(b),10)*(1+(b+2)%9);return e=e%11%10,e+""===a.charAt(c-1)},_lu:function(a){return/^LU[0-9]{8}$/.test(a)&&(a=a.substr(2)),/^[0-9]{8}$/.test(a)?parseInt(a.substr(0,6),10)%89+""===a.substr(6,2):!1},_lv:function(a){if(/^LV[0-9]{11}$/.test(a)&&(a=a.substr(2)),!/^[0-9]{11}$/.test(a))return!1;var b,c=parseInt(a.charAt(0),10),d=0,e=[],f=a.length;if(c>3){for(d=0,e=[9,1,4,8,3,10,2,5,7,6,1],b=0;f>b;b++)d+=parseInt(a.charAt(b),10)*e[b];return d%=11,3===d}var g=parseInt(a.substr(0,2),10),h=parseInt(a.substr(2,2),10),i=parseInt(a.substr(4,2),10);if(i=i+1800+100*parseInt(a.charAt(6),10),!FormValidation.Helper.date(i,h,g))return!1;for(d=0,e=[10,5,8,4,2,1,6,3,7,9],b=0;f-1>b;b++)d+=parseInt(a.charAt(b),10)*e[b];return d=(d+1)%11%10,d+""===a.charAt(f-1)},_mt:function(a){if(/^MT[0-9]{8}$/.test(a)&&(a=a.substr(2)),!/^[0-9]{8}$/.test(a))return!1;for(var b=0,c=[3,4,6,7,8,9,10,1],d=0;8>d;d++)b+=parseInt(a.charAt(d),10)*c[d];return b%37===0},_nl:function(a){if(/^NL[0-9]{9}B[0-9]{2}$/.test(a)&&(a=a.substr(2)),!/^[0-9]{9}B[0-9]{2}$/.test(a))return!1;for(var b=0,c=[9,8,7,6,5,4,3,2],d=0;8>d;d++)b+=parseInt(a.charAt(d),10)*c[d];return b%=11,b>9&&(b=0),b+""===a.substr(8,1)},_no:function(a){if(/^NO[0-9]{9}$/.test(a)&&(a=a.substr(2)),!/^[0-9]{9}$/.test(a))return!1;for(var b=0,c=[3,2,7,6,5,4,3,2],d=0;8>d;d++)b+=parseInt(a.charAt(d),10)*c[d];return b=11-b%11,11===b&&(b=0),b+""===a.substr(8,1)},_pl:function(a){if(/^PL[0-9]{10}$/.test(a)&&(a=a.substr(2)),!/^[0-9]{10}$/.test(a))return!1;for(var b=0,c=[6,5,7,2,3,4,5,6,7,-1],d=0;10>d;d++)b+=parseInt(a.charAt(d),10)*c[d];return b%11===0},_pt:function(a){if(/^PT[0-9]{9}$/.test(a)&&(a=a.substr(2)),!/^[0-9]{9}$/.test(a))return!1;for(var b=0,c=[9,8,7,6,5,4,3,2],d=0;8>d;d++)b+=parseInt(a.charAt(d),10)*c[d];return b=11-b%11,b>9&&(b=0),b+""===a.substr(8,1)},_ro:function(a){if(/^RO[1-9][0-9]{1,9}$/.test(a)&&(a=a.substr(2)),!/^[1-9][0-9]{1,9}$/.test(a))return!1;for(var b=a.length,c=[7,5,3,2,1,7,5,3,2].slice(10-b),d=0,e=0;b-1>e;e++)d+=parseInt(a.charAt(e),10)*c[e];return d=10*d%11%10,d+""===a.substr(b-1,1)},_ru:function(a){if(/^RU([0-9]{10}|[0-9]{12})$/.test(a)&&(a=a.substr(2)),!/^([0-9]{10}|[0-9]{12})$/.test(a))return!1;var b=0;if(10===a.length){var c=0,d=[2,4,10,3,5,9,4,6,8,0];for(b=0;10>b;b++)c+=parseInt(a.charAt(b),10)*d[b];return c%=11,c>9&&(c%=10),c+""===a.substr(9,1)}if(12===a.length){var e=0,f=[7,2,4,10,3,5,9,4,6,8,0],g=0,h=[3,7,2,4,10,3,5,9,4,6,8,0];for(b=0;11>b;b++)e+=parseInt(a.charAt(b),10)*f[b],g+=parseInt(a.charAt(b),10)*h[b];return e%=11,e>9&&(e%=10),g%=11,g>9&&(g%=10),e+""===a.substr(10,1)&&g+""===a.substr(11,1)}return!1},_rs:function(a){if(/^RS[0-9]{9}$/.test(a)&&(a=a.substr(2)),!/^[0-9]{9}$/.test(a))return!1;for(var b=10,c=0,d=0;8>d;d++)c=(parseInt(a.charAt(d),10)+b)%10,0===c&&(c=10),b=2*c%11;return(b+parseInt(a.substr(8,1),10))%10===1},_se:function(a){return/^SE[0-9]{10}01$/.test(a)&&(a=a.substr(2)),/^[0-9]{10}01$/.test(a)?(a=a.substr(0,10),FormValidation.Helper.luhn(a)):!1},_si:function(a){var b=a.match(/^(SI)?([1-9][0-9]{7})$/);if(!b)return!1;b[1]&&(a=a.substr(2));for(var c=0,d=[8,7,6,5,4,3,2],e=0;7>e;e++)c+=parseInt(a.charAt(e),10)*d[e];return c=11-c%11,10===c&&(c=0),c+""===a.substr(7,1)},_sk:function(a){return/^SK[1-9][0-9][(2-4)|(6-9)][0-9]{7}$/.test(a)&&(a=a.substr(2)),/^[1-9][0-9][(2-4)|(6-9)][0-9]{7}$/.test(a)?parseInt(a,10)%11===0:!1},_ve:function(a){if(/^VE[VEJPG][0-9]{9}$/.test(a)&&(a=a.substr(2)),!/^[VEJPG][0-9]{9}$/.test(a))return!1;for(var b={V:4,E:8,J:12,P:16,G:20},c=b[a.charAt(0)],d=[3,2,7,6,5,4,3,2],e=0;8>e;e++)c+=parseInt(a.charAt(e+1),10)*d[e];return c=11-c%11,(11===c||10===c)&&(c=0),c+""===a.substr(9,1)},_za:function(a){return/^ZA4[0-9]{9}$/.test(a)&&(a=a.substr(2)),/^4[0-9]{9}$/.test(a)}}}(jQuery),function(a){FormValidation.I18n=a.extend(!0,FormValidation.I18n||{},{en_US:{vin:{"default":"Please enter a valid VIN number"}}}),FormValidation.Validator.vin={validate:function(a,b){var c=a.getFieldValue(b,"vin");if(""===c)return!0;if(!/^[a-hj-npr-z0-9]{8}[0-9xX][a-hj-npr-z0-9]{8}$/i.test(c))return!1;c=c.toUpperCase();for(var d={A:1,B:2,C:3,D:4,E:5,F:6,G:7,H:8,J:1,K:2,L:3,M:4,N:5,P:7,R:9,S:2,T:3,U:4,V:5,W:6,X:7,Y:8,Z:9,1:1,2:2,3:3,4:4,5:5,6:6,7:7,8:8,9:9,0:0},e=[8,7,6,5,4,3,2,10,0,9,8,7,6,5,4,3,2],f=0,g=c.length,h=0;g>h;h++)f+=d[c.charAt(h)+""]*e[h];var i=f%11;return 10===i&&(i="X"),i+""===c.charAt(8)}}}(jQuery),function(a){FormValidation.I18n=a.extend(!0,FormValidation.I18n||{},{en_US:{zipCode:{"default":"Please enter a valid postal code",country:"Please enter a valid postal code in %s",countries:{AT:"Austria",BG:"Bulgaria",BR:"Brazil",CA:"Canada",CH:"Switzerland",CZ:"Czech Republic",DE:"Germany",DK:"Denmark",ES:"Spain",FR:"France",GB:"United Kingdom",IE:"Ireland",IN:"India",IT:"Italy",MA:"Morocco",NL:"Netherlands",PL:"Poland",PT:"Portugal",RO:"Romania",RU:"Russia",SE:"Sweden",SG:"Singapore",SK:"Slovakia",US:"USA"}}}}),FormValidation.Validator.zipCode={html5Attributes:{message:"message",country:"country"},COUNTRY_CODES:["AT","BG","BR","CA","CH","CZ","DE","DK","ES","FR","GB","IE","IN","IT","MA","NL","PL","PT","RO","RU","SE","SG","SK","US"],validate:function(b,c,d){var e=b.getFieldValue(c,"zipCode");if(""===e||!d.country)return!0;var f=b.getLocale(),g=d.country;if(("string"!=typeof g||-1===a.inArray(g,this.COUNTRY_CODES))&&(g=b.getDynamicOption(c,g)),!g||-1===a.inArray(g.toUpperCase(),this.COUNTRY_CODES))return!0;var h=!1;switch(g=g.toUpperCase()){case"AT":h=/^([1-9]{1})(\d{3})$/.test(e);break;case"BG":h=/^([1-9]{1}[0-9]{3})$/.test(a.trim(e));break;case"BR":h=/^(\d{2})([\.]?)(\d{3})([\-]?)(\d{3})$/.test(e);break;case"CA":h=/^(?:A|B|C|E|G|H|J|K|L|M|N|P|R|S|T|V|X|Y){1}[0-9]{1}(?:A|B|C|E|G|H|J|K|L|M|N|P|R|S|T|V|W|X|Y|Z){1}\s?[0-9]{1}(?:A|B|C|E|G|H|J|K|L|M|N|P|R|S|T|V|W|X|Y|Z){1}[0-9]{1}$/i.test(e);break;case"CH":h=/^([1-9]{1})(\d{3})$/.test(e);break;case"CZ":h=/^(\d{3})([ ]?)(\d{2})$/.test(e);break;case"DE":h=/^(?!01000|99999)(0[1-9]\d{3}|[1-9]\d{4})$/.test(e);break;case"DK":h=/^(DK(-|\s)?)?\d{4}$/i.test(e);break;case"ES":h=/^(?:0[1-9]|[1-4][0-9]|5[0-2])\d{3}$/.test(e);break;case"FR":h=/^[0-9]{5}$/i.test(e);break;case"GB":h=this._gb(e);break;case"IN":h=/^\d{3}\s?\d{3}$/.test(e);break;case"IE":h=/^(D6W|[ACDEFHKNPRTVWXY]\d{2})\s[0-9ACDEFHKNPRTVWXY]{4}$/.test(e);break;case"IT":h=/^(I-|IT-)?\d{5}$/i.test(e);break;case"MA":h=/^[1-9][0-9]{4}$/i.test(e);break;case"NL":h=/^[1-9][0-9]{3} ?(?!sa|sd|ss)[a-z]{2}$/i.test(e);break;case"PL":h=/^[0-9]{2}\-[0-9]{3}$/.test(e);break;case"PT":h=/^[1-9]\d{3}-\d{3}$/.test(e);break;case"RO":h=/^(0[1-8]{1}|[1-9]{1}[0-5]{1})?[0-9]{4}$/i.test(e);break;case"RU":h=/^[0-9]{6}$/i.test(e);break;case"SE":h=/^(S-)?\d{3}\s?\d{2}$/i.test(e);break;case"SG":h=/^([0][1-9]|[1-6][0-9]|[7]([0-3]|[5-9])|[8][0-2])(\d{4})$/i.test(e);break;case"SK":h=/^(\d{3})([ ]?)(\d{2})$/.test(e);break;case"US":default:h=/^\d{4,5}([\-]?\d{4})?$/.test(e)}return{valid:h,message:FormValidation.Helper.format(d.message||FormValidation.I18n[f].zipCode.country,FormValidation.I18n[f].zipCode.countries[g])}},_gb:function(a){for(var b="[ABCDEFGHIJKLMNOPRSTUWYZ]",c="[ABCDEFGHKLMNOPQRSTUVWXY]",d="[ABCDEFGHJKPMNRSTUVWXY]",e="[ABEHMNPRVWXY]",f="[ABDEFGHJLNPQRSTUWXYZ]",g=[new RegExp("^("+b+"{1}"+c+"?[0-9]{1,2})(\\s*)([0-9]{1}"+f+"{2})$","i"),new RegExp("^("+b+"{1}[0-9]{1}"+d+"{1})(\\s*)([0-9]{1}"+f+"{2})$","i"),new RegExp("^("+b+"{1}"+c+"{1}?[0-9]{1}"+e+"{1})(\\s*)([0-9]{1}"+f+"{2})$","i"),new RegExp("^(BF1)(\\s*)([0-6]{1}[ABDEFGHJLNPQRST]{1}[ABDEFGHJLNPQRSTUWZYZ]{1})$","i"),/^(GIR)(\s*)(0AA)$/i,/^(BFPO)(\s*)([0-9]{1,4})$/i,/^(BFPO)(\s*)(c\/o\s*[0-9]{1,3})$/i,/^([A-Z]{4})(\s*)(1ZZ)$/i,/^(AI-2640)$/i],h=0;h<g.length;h++)if(g[h].test(a))return!0;return!1}}}(jQuery);
/*zh_CN.js*/
(function ($) {
    /**
     * Simplified Chinese language package
     * Translated by @shamiao
     */
    FormValidation.I18n = $.extend(true, FormValidation.I18n, {
        'zh_CN': {
            base64: {
                'default': '请输入有效的Base64编码'
            },
            between: {
                'default': '请输入在 %s 和 %s 之间的数值',
                notInclusive: '请输入在 %s 和 %s 之间(不含两端)的数值'
            },
            bic: {
                'default': '请输入有效的BIC商品编码'
            },
            callback: {
                'default': '请输入有效的值'
            },
            choice: {
                'default': '请输入有效的值',
                less: '请至少选中 %s 个选项',
                more: '最多只能选中 %s 个选项',
                between: '请选择 %s 至 %s 个选项'
            },
            color: {
                'default': '请输入有效的颜色值'
            },
            creditCard: {
                'default': '请输入有效的信用卡号码'
            },
            cusip: {
                'default': '请输入有效的美国CUSIP代码'
            },
            cvv: {
                'default': '请输入有效的CVV代码'
            },
            date: {
                'default': '请输入有效的日期',
                min: '请输入 %s 或之后的日期',
                max: '请输入 %s 或以前的日期',
                range: '请输入 %s 和 %s 之间的日期'
            },
            different: {
                'default': '请输入不同的值'
            },
            digits: {
                'default': '请输入有效的数字'
            },
            ean: {
                'default': '请输入有效的EAN商品编码'
            },
            ein: {
                'default': '请输入有效的EIN商品编码'
            },
            emailAddress: {
                'default': '请输入有效的邮件地址'
            },
            file: {
                'default': '请选择有效的文件'
            },
            greaterThan: {
                'default': '请输入大于等于 %s 的数值',
                notInclusive: '请输入大于 %s 的数值'
            },
            grid: {
                'default': '请输入有效的GRId编码'
            },
            hex: {
                'default': '请输入有效的16进制数'
            },
            iban: {
                'default': '请输入有效的IBAN(国际银行账户)号码',
                country: '请输入有效的 %s 国家或地区的IBAN(国际银行账户)号码',
                countries: {
                    AD: '安道​​尔',
                    AE: '阿联酋',
                    AL: '阿尔巴尼亚',
                    AO: '安哥拉',
                    AT: '奥地利',
                    AZ: '阿塞拜疆',
                    BA: '波斯尼亚和黑塞哥维那',
                    BE: '比利时',
                    BF: '布基纳法索',
                    BG: '保加利亚',
                    BH: '巴林',
                    BI: '布隆迪',
                    BJ: '贝宁',
                    BR: '巴西',
                    CH: '瑞士',
                    CI: '科特迪瓦',
                    CM: '喀麦隆',
                    CR: '哥斯达黎加',
                    CV: '佛得角',
                    CY: '塞浦路斯',
                    CZ: '捷克共和国',
                    DE: '德国',
                    DK: '丹麦',
                    DO: '多米尼加共和国',
                    DZ: '阿尔及利亚',
                    EE: '爱沙尼亚',
                    ES: '西班牙',
                    FI: '芬兰',
                    FO: '法罗群岛',
                    FR: '法国',
                    GB: '英国',
                    GE: '格鲁吉亚',
                    GI: '直布罗陀',
                    GL: '格陵兰岛',
                    GR: '希腊',
                    GT: '危地马拉',
                    HR: '克罗地亚',
                    HU: '匈牙利',
                    IE: '爱尔兰',
                    IL: '以色列',
                    IR: '伊朗',
                    IS: '冰岛',
                    IT: '意大利',
                    JO: '约旦',
                    KW: '科威特',
                    KZ: '哈萨克斯坦',
                    LB: '黎巴嫩',
                    LI: '列支敦士登',
                    LT: '立陶宛',
                    LU: '卢森堡',
                    LV: '拉脱维亚',
                    MC: '摩纳哥',
                    MD: '摩尔多瓦',
                    ME: '黑山',
                    MG: '马达加斯加',
                    MK: '马其顿',
                    ML: '马里',
                    MR: '毛里塔尼亚',
                    MT: '马耳他',
                    MU: '毛里求斯',
                    MZ: '莫桑比克',
                    NL: '荷兰',
                    NO: '挪威',
                    PK: '巴基斯坦',
                    PL: '波兰',
                    PS: '巴勒斯坦',
                    PT: '葡萄牙',
                    QA: '卡塔尔',
                    RO: '罗马尼亚',
                    RS: '塞尔维亚',
                    SA: '沙特阿拉伯',
                    SE: '瑞典',
                    SI: '斯洛文尼亚',
                    SK: '斯洛伐克',
                    SM: '圣马力诺',
                    SN: '塞内加尔',
                    TL: '东帝汶',
                    TN: '突尼斯',
                    TR: '土耳其',
                    VG: '英属维尔京群岛',
                    XK: '科索沃共和国'
                }
            },
            id: {
                'default': '请输入有效的身份证件号码',
                country: '请输入有效的 %s 国家或地区的身份证件号码',
                countries: {
                    BA: '波黑',
                    BG: '保加利亚',
                    BR: '巴西',
                    CH: '瑞士',
                    CL: '智利',
                    CN: '中国',
                    CZ: '捷克共和国',
                    DK: '丹麦',
                    EE: '爱沙尼亚',
                    ES: '西班牙',
                    FI: '芬兰',
                    HR: '克罗地亚',
                    IE: '爱尔兰',
                    IS: '冰岛',
                    LT: '立陶宛',
                    LV: '拉脱维亚',
                    ME: '黑山',
                    MK: '马其顿',
                    NL: '荷兰',
                    PL: '波兰',
                    RO: '罗马尼亚',
                    RS: '塞尔维亚',
                    SE: '瑞典',
                    SI: '斯洛文尼亚',
                    SK: '斯洛伐克',
                    SM: '圣马力诺',
                    TH: '泰国',
                    TR: '土耳其',
                    ZA: '南非'
                }
            },
            identical: {
                'default': '请输入相同的值'
            },
            imei: {
                'default': '请输入有效的IMEI(手机串号)'
            },
            imo: {
                'default': '请输入有效的国际海事组织(IMO)号码'
            },
            integer: {
                'default': '请输入有效的整数值'
            },
            ip: {
                'default': '请输入有效的IP地址',
                ipv4: '请输入有效的IPv4地址',
                ipv6: '请输入有效的IPv6地址'
            },
            isbn: {
                'default': '请输入有效的ISBN(国际标准书号)'
            },
            isin: {
                'default': '请输入有效的ISIN(国际证券编码)'
            },
            ismn: {
                'default': '请输入有效的ISMN(印刷音乐作品编码)'
            },
            issn: {
                'default': '请输入有效的ISSN(国际标准杂志书号)'
            },
            lessThan: {
                'default': '请输入小于等于 %s 的数值',
                notInclusive: '请输入小于 %s 的数值'
            },
            mac: {
                'default': '请输入有效的MAC物理地址'
            },
            meid: {
                'default': '请输入有效的MEID(移动设备识别码)'
            },
            notEmpty: {
                'default': '请填写必填项目'
            },
            numeric: {
                'default': '请输入有效的数值，允许小数'
            },
            phone: {
                'default': '请输入有效的电话号码',
                country: '请输入有效的 %s 国家或地区的电话号码',
                countries: {
                    AE: '阿联酋',
                    BG: '保加利亚',
                    BR: '巴西',
                    CN: '中国',
                    CZ: '捷克共和国',
                    DE: '德国',
                    DK: '丹麦',
                    ES: '西班牙',
                    FR: '法国',
                    GB: '英国',
                    IN: '印度',
                    MA: '摩洛哥',
                    NL: '荷兰',
                    PK: '巴基斯坦',
                    RO: '罗马尼亚',
                    RU: '俄罗斯',
                    SK: '斯洛伐克',
                    TH: '泰国',
                    US: '美国',
                    VE: '委内瑞拉'
                }
            },
            promise: {
                'default': '请输入有效的值'
            },
            regexp: {
                'default': '请输入符合正则表达式限制的值'
            },
            remote: {
                'default': '请输入有效的值'
            },
            rtn: {
                'default': '请输入有效的RTN号码'
            },
            sedol: {
                'default': '请输入有效的SEDOL代码'
            },
            siren: {
                'default': '请输入有效的SIREN号码'
            },
            siret: {
                'default': '请输入有效的SIRET号码'
            },
            step: {
                'default': '请输入在基础值上，增加 %s 的整数倍的数值'
            },
            stringCase: {
                'default': '只能输入小写字母',
                upper: '只能输入大写字母'
            },
            stringLength: {
                'default': '请输入符合长度限制的值',
                less: '最多只能输入 %s 个字符',
                more: '需要输入至少 %s 个字符',
                between: '请输入 %s 至 %s 个字符'
            },
            uri: {
                'default': '请输入一个有效的URL地址'
            },
            uuid: {
                'default': '请输入有效的UUID',
                version: '请输入版本 %s 的UUID'
            },
            vat: {
                'default': '请输入有效的VAT(税号)',
                country: '请输入有效的 %s 国家或地区的VAT(税号)',
                countries: {
                    AT: '奥地利',
                    BE: '比利时',
                    BG: '保加利亚',
                    BR: '巴西',
                    CH: '瑞士',
                    CY: '塞浦路斯',
                    CZ: '捷克共和国',
                    DE: '德国',
                    DK: '丹麦',
                    EE: '爱沙尼亚',
                    ES: '西班牙',
                    FI: '芬兰',
                    FR: '法语',
                    GB: '英国',
                    GR: '希腊',
                    EL: '希腊',
                    HU: '匈牙利',
                    HR: '克罗地亚',
                    IE: '爱尔兰',
                    IS: '冰岛',
                    IT: '意大利',
                    LT: '立陶宛',
                    LU: '卢森堡',
                    LV: '拉脱维亚',
                    MT: '马耳他',
                    NL: '荷兰',
                    NO: '挪威',
                    PL: '波兰',
                    PT: '葡萄牙',
                    RO: '罗马尼亚',
                    RU: '俄罗斯',
                    RS: '塞尔维亚',
                    SE: '瑞典',
                    SI: '斯洛文尼亚',
                    SK: '斯洛伐克',
                    VE: '委内瑞拉',
                    ZA: '南非'
                }
            },
            vin: {
                'default': '请输入有效的VIN(美国车辆识别号码)'
            },
            zipCode: {
                'default': '请输入有效的邮政编码',
                country: '请输入有效的 %s 国家或地区的邮政编码',
                countries: {
                    AT: '奥地利',
                    BG: '保加利亚',
                    BR: '巴西',
                    CA: '加拿大',
                    CH: '瑞士',
                    CZ: '捷克共和国',
                    DE: '德国',
                    DK: '丹麦',
                    ES: '西班牙',
                    FR: '法国',
                    GB: '英国',
                    IE: '爱尔兰',
                    IN: '印度',
                    IT: '意大利',
                    MA: '摩洛哥',
                    NL: '荷兰',
                    PL: '波兰',
                    PT: '葡萄牙',
                    RO: '罗马尼亚',
                    RU: '俄罗斯',
                    SE: '瑞典',
                    SG: '新加坡',
                    SK: '斯洛伐克',
                    US: '美国'
                }
            }
        }
    });
}(jQuery));

/*bootstrap.min.js*/
/*!
 * FormValidation (http://formvalidation.io)
 * The best jQuery plugin to validate form fields. Support Bootstrap, Foundation, Pure, SemanticUI, UIKit and custom frameworks
 *
 * @version     v0.6.2-dev, built on 2015-03-13 8:15:46 AM
 * @author      https://twitter.com/nghuuphuoc
 * @copyright   (c) 2013 - 2015 Nguyen Huu Phuoc
 * @license     http://formvalidation.io/license/
 */
!function(a){FormValidation.Framework.Bootstrap=function(b,c,d){c=a.extend(!0,{button:{selector:'[type="submit"]',disabled:"disabled"},err:{clazz:"help-block",parent:"^(.*)col-(xs|sm|md|lg)-(offset-){0,1}[0-9]+(.*)$"},icon:{valid:null,invalid:null,validating:null,feedback:"form-control-feedback"},row:{selector:".form-group",valid:"has-success",invalid:"has-error",feedback:"has-feedback"}},c),FormValidation.Base.apply(this,[b,c,d])},FormValidation.Framework.Bootstrap.prototype=a.extend({},FormValidation.Base.prototype,{_fixIcon:function(a,b){var c=this._namespace,d=a.attr("type"),e=a.attr("data-"+c+"-field"),f=this.options.fields[e].row||this.options.row.selector,g=a.closest(f);if("checkbox"===d||"radio"===d){var h=a.parent();h.hasClass(d)?b.insertAfter(h):h.parent().hasClass(d)&&b.insertAfter(h.parent())}0===g.find("label").length&&b.addClass("fv-icon-no-label"),0!==g.find(".input-group").length&&b.addClass("fv-bootstrap-icon-input-group").insertAfter(g.find(".input-group").eq(0))},_createTooltip:function(a,b,c){var d=this._namespace,e=a.data(d+".icon");if(e)switch(c){case"popover":e.css({cursor:"pointer","pointer-events":"auto"}).popover("destroy").popover({container:"body",content:b,html:!0,placement:"auto top",trigger:"hover click"});break;case"tooltip":default:e.css({cursor:"pointer","pointer-events":"auto"}).tooltip("destroy").tooltip({container:"body",html:!0,placement:"auto top",title:b})}},_destroyTooltip:function(a,b){var c=this._namespace,d=a.data(c+".icon");if(d)switch(b){case"popover":d.css({cursor:"","pointer-events":"none"}).popover("destroy");break;case"tooltip":default:d.css({cursor:"","pointer-events":"none"}).tooltip("destroy")}},_hideTooltip:function(a,b){var c=this._namespace,d=a.data(c+".icon");if(d)switch(b){case"popover":d.popover("hide");break;case"tooltip":default:d.tooltip("hide")}},_showTooltip:function(a,b){var c=this._namespace,d=a.data(c+".icon");if(d)switch(b){case"popover":d.popover("show");break;case"tooltip":default:d.tooltip("show")}}}),a.fn.bootstrapValidator=function(b){var c=arguments;return this.each(function(){var d=a(this),e=d.data("formValidation")||d.data("bootstrapValidator"),f="object"==typeof b&&b;e||(e=new FormValidation.Framework.Bootstrap(this,a.extend({},{events:{formInit:"init.form.bv",formError:"error.form.bv",formSuccess:"success.form.bv",fieldAdded:"added.field.bv",fieldRemoved:"removed.field.bv",fieldInit:"init.field.bv",fieldError:"error.field.bv",fieldSuccess:"success.field.bv",fieldStatus:"status.field.bv",localeChanged:"changed.locale.bv",validatorError:"error.validator.bv",validatorSuccess:"success.validator.bv"}},f),"bv"),d.addClass("fv-form-bootstrap").data("formValidation",e).data("bootstrapValidator",e)),"string"==typeof b&&e[b].apply(e,Array.prototype.slice.call(c,1))})},a.fn.bootstrapValidator.Constructor=FormValidation.Framework.Bootstrap}(jQuery);
/*alertify.js*/
(function() {

    "use strict";

    var TRANSITION_FALLBACK_DURATION = 500;
    var hideElement = function(el) {

        if (! el) {
            return;
        }

        var removeThis = function() {
            if (el && el.parentNode) {
                el.parentNode.removeChild(el);
            }
        };

        el.classList.remove("show");
        el.classList.add("hide");
        el.addEventListener("transitionend", removeThis);

        // Fallback for no transitions.
        setTimeout(removeThis, TRANSITION_FALLBACK_DURATION);

    };

    function Alertify() {

        /**
         * Alertify private object
         * @type {Object}
         */
        var _alertify = {

            version: "1.0.8",
            defaultOkLabel: "Ok",
            okLabel: "Ok",
            defaultCancelLabel: "Cancel",
            cancelLabel: "Cancel",
            defaultMaxLogItems: 2,
            maxLogItems: 2,
            promptValue: "",
            promptPlaceholder: "",
            closeLogOnClick: false,
            closeLogOnClickDefault: false,
            delay: 5000,
            defaultDelay: 5000,
            logContainerClass: "alertify-logs",
            logContainerDefaultClass: "alertify-logs",
            dialogs: {
                buttons: {
                    holder: "<nav>{{buttons}}</nav>",
                    ok: "<button class='ok' tabindex='1'>{{ok}}</button>",
                    cancel: "<button class='cancel' tabindex='2'>{{cancel}}</button>"
                },
                input: "<input type='text'>",
                message: "<p class='msg'>{{message}}</p>",
                log: "<div class='{{class}}'>{{message}}</div>"
            },

            defaultDialogs: {
                buttons: {
                    holder: "<nav>{{buttons}}</nav>",
                    ok: "<button class='ok' tabindex='1'>{{ok}}</button>",
                    cancel: "<button class='cancel' tabindex='2'>{{cancel}}</button>"
                },
                input: "<input type='text'>",
                message: "<p class='msg'>{{message}}</p>",
                log: "<div class='{{class}}'>{{message}}</div>"
            },

            /**
             * Build the proper message box
             *
             * @param  {Object} item    Current object in the queue
             *
             * @return {String}         An HTML string of the message box
             */
            build: function(item) {

                var btnTxt = this.dialogs.buttons.ok;
                var html = "<div class='dialog'>" + "<div>" + this.dialogs.message.replace("{{message}}", item.message);

                if(item.type === "confirm" || item.type === "prompt") {
                    btnTxt = this.dialogs.buttons.cancel + this.dialogs.buttons.ok;
                }

                if (item.type === "prompt") {
                    html += this.dialogs.input;
                }

                html = (html + this.dialogs.buttons.holder + "</div>" + "</div>")
                  .replace("{{buttons}}", btnTxt)
                  .replace("{{ok}}", this.okLabel)
                  .replace("{{cancel}}", this.cancelLabel);

                return html;

            },

            setCloseLogOnClick: function(bool) {
                this.closeLogOnClick = !! bool;
            },

            /**
             * Close the log messages
             *
             * @param  {Object} elem    HTML Element of log message to close
             * @param  {Number} wait    [optional] Time (in ms) to wait before automatically hiding the message, if 0 never hide
             *
             * @return {undefined}
             */
            close: function(elem, wait) {

                if (this.closeLogOnClick) {
                    elem.addEventListener("click", function(ev) {
                        hideElement(ev.srcElement);
                    });
                }

                wait = wait && !isNaN(+wait) ? +wait : this.delay;

                if (wait < 0) {
                    hideElement(elem);
                } else if(wait > 0) {
                    setTimeout(function() {
                        hideElement(elem);
                    }, wait);
                }

            },

            /**
             * Create a dialog box
             *
             * @param  {String}   message      The message passed from the callee
             * @param  {String}   type         Type of dialog to create
             * @param  {Function} onOkay       [Optional] Callback function when clicked okay.
             * @param  {Function} onCancel     [Optional] Callback function when cancelled.
             *
             * @return {Object}
             */
            dialog: function(message, type, onOkay, onCancel) {
                return this.setup({
                    type: type,
                    message: message,
                    onOkay: onOkay,
                    onCancel: onCancel
                });
            },

            /**
             * Show a new log message box
             *
             * @param  {String} message    The message passed from the callee
             * @param  {String} type       [Optional] Optional type of log message
             * @param  {Number} wait       [Optional] Time (in ms) to wait before auto-hiding the log
             *
             * @return {Object}
             */
            log: function(message, type, click) {

                var existing = document.querySelectorAll(".alertify-logs > div");
                if (existing) {
                    var diff = existing.length - this.maxLogItems;
                    if (diff >= 0) {
                        for (var i = 0, _i = diff + 1; i < _i; i++) {
                            this.close(existing[i], -1);
                        }
                    }
                }

                this.notify(message, type, click);
            },

            setLogPosition: function(str) {
                this.logContainerClass = "alertify-logs " + str;
            },

            setupLogContainer: function() {

                var elLog = document.querySelector(".alertify-logs");
                var className = this.logContainerClass;
                if (! elLog) {
                    elLog = document.createElement("div");
                    elLog.className = className;
                    document.body.appendChild(elLog);
                }

                // Make sure it's positioned properly.
                if (elLog.className !== className) {
                    elLog.className = className;
                }

                return elLog;

            },

            /**
             * Add new log message
             * If a type is passed, a class name "{type}" will get added.
             * This allows for custom look and feel for various types of notifications.
             *
             * @param  {String} message    The message passed from the callee
             * @param  {String} type       [Optional] Type of log message
             * @param  {Number} wait       [Optional] Time (in ms) to wait before auto-hiding
             *
             * @return {undefined}
             */
            notify: function(message, type, click) {

                var elLog = this.setupLogContainer();
                var log = document.createElement("div");

                log.className = (type || "default");
                if (_alertify.logTemplateMethod) {
                    log.innerHTML = _alertify.logTemplateMethod(message);
                } else {
                    log.innerHTML = message;
                }

                // Add the click handler, if specified.
                if ("function" === typeof click) {
                    log.addEventListener("click", click);
                }

                elLog.appendChild(log);
                setTimeout(function() {
                    log.className += " show";
                }, 10);

                this.close(log, this.delay);

            },

            /**
             * Initiate all the required pieces for the dialog box
             *
             * @return {undefined}
             */
            setup: function(item) {

                var el = document.createElement("div");
                el.className = "alertify hide";
                el.innerHTML = this.build(item);

                var btnOK = el.querySelector(".ok");
                var btnCancel = el.querySelector(".cancel");
                var input = el.querySelector("input");
                var label = el.querySelector("label");

                // Set default value/placeholder of input
                if (input) {
                    if (typeof this.promptPlaceholder === "string") {
                        // Set the label, if available, for MDL, etc.
                        if (label) {
                            label.textContent = this.promptPlaceholder;
                        } else {
                            input.placeholder = this.promptPlaceholder;
                        }
                    }
                    if (typeof this.promptValue === "string") {
                        input.value = this.promptValue;
                    }
                }

                function setupHandlers(resolve) {
                    if ("function" !== typeof resolve) {
                        // promises are not available so resolve is a no-op
                        resolve = function () {};
                    }

                    if (btnOK) {
                        btnOK.addEventListener("click", function(ev) {
                            if (item.onOkay && "function" === typeof item.onOkay) {
                                if (input) {
                                    item.onOkay(input.value, ev);
                                } else {
                                    item.onOkay(ev);
                                }
                            }

                            if (input) {
                                resolve({
                                    buttonClicked: "ok",
                                    inputValue: input.value,
                                    event: ev
                                });
                            } else {
                                resolve({
                                    buttonClicked: "ok",
                                    event: ev
                                });
                            }

                            hideElement(el);
                        });
                    }

                    if (btnCancel) {
                        btnCancel.addEventListener("click", function(ev) {
                            if (item.onCancel && "function" === typeof item.onCancel) {
                                item.onCancel(ev);
                            }

                            resolve({
                                buttonClicked: "cancel",
                                event: ev
                            });

                            hideElement(el);
                        });
                    }
                }

                var promise;

                if (typeof Promise === "function") {
                    promise = new Promise(setupHandlers);
                } else {
                    setupHandlers();
                }

                document.body.appendChild(el);
                setTimeout(function() {
                    el.classList.remove("hide");
                    if(input && item.type && item.type === "prompt") {
                        input.select();
                        input.focus();
                    } else {
                        if (btnOK) {
                            btnOK.focus();
                        }
                    }
                }, 100);

                return promise;
            },

            okBtn: function(label) {
                this.okLabel = label;
                return this;
            },

            setDelay: function(time) {
                var dur = parseInt(time || 0, 10);
                this.delay = isNaN(dur) ? this.defultDelay : time;
                return this;
            },

            cancelBtn: function(str) {
                this.cancelLabel = str;
                return this;
            },

            setMaxLogItems: function(num) {
                this.maxLogItems = parseInt(num || this.defaultMaxLogItems);
            },

            theme: function(themeStr) {
                switch(themeStr.toLowerCase()) {
                case "bootstrap":
                    this.dialogs.buttons.ok = "<button class='ok btn btn-primary' tabindex='1'>{{ok}}</button>";
                    this.dialogs.buttons.cancel = "<button class='cancel btn btn-default' tabindex='2'>{{cancel}}</button>";
                    this.dialogs.input = "<input type='text' class='form-control'>";
                    break;
                case "purecss":
                    this.dialogs.buttons.ok = "<button class='ok pure-button' tabindex='1'>{{ok}}</button>";
                    this.dialogs.buttons.cancel = "<button class='cancel pure-button' tabindex='2'>{{cancel}}</button>";
                    break;
                case "mdl":
                case "material-design-light":
                    this.dialogs.buttons.ok = "<button class='ok mdl-button mdl-js-button mdl-js-ripple-effect'  tabindex='1'>{{ok}}</button>";
                    this.dialogs.buttons.cancel = "<button class='cancel mdl-button mdl-js-button mdl-js-ripple-effect' tabindex='2'>{{cancel}}</button>";
                    this.dialogs.input = "<div class='mdl-textfield mdl-js-textfield'><input class='mdl-textfield__input'><label class='md-textfield__label'></label></div>";
                    break;
                case "angular-material":
                    this.dialogs.buttons.ok = "<button class='ok md-primary md-button' tabindex='1'>{{ok}}</button>";
                    this.dialogs.buttons.cancel = "<button class='cancel md-button' tabindex='2'>{{cancel}}</button>";
                    this.dialogs.input = "<div layout='column'><md-input-container md-no-float><input type='text'></md-input-container></div>";
                    break;
                case "default":
                default:
                    this.dialogs.buttons.ok = this.defaultDialogs.buttons.ok;
                    this.dialogs.buttons.cancel = this.defaultDialogs.buttons.cancel;
                    this.dialogs.input = this.defaultDialogs.input;
                    break;
                }
            },

            reset: function() {
                this.theme("default");
                this.okBtn(this.defaultOkLabel);
                this.cancelBtn(this.defaultCancelLabel);
                this.setMaxLogItems();
                this.promptValue = "";
                this.promptPlaceholder = "";
                this.delay = this.defaultDelay;
                this.setCloseLogOnClick(this.closeLogOnClickDefault);
                this.setLogPosition("bottom left");
                this.logTemplateMethod = null;
            },

            injectCSS: function() {
                if (!document.querySelector("#alertifyCSS")) {
                    var head = document.getElementsByTagName("head")[0];
                    var css = document.createElement("style");
                    css.type = "text/css";
                    css.id = "alertifyCSS";
                    css.innerHTML = "/* style.css */";
                    head.insertBefore(css, head.firstChild);
                }
            },

            removeCSS: function() {
                var css = document.querySelector("#alertifyCSS");
                if (css && css.parentNode) {
                    css.parentNode.removeChild(css);
                }
            }

        };

        _alertify.injectCSS();

        return {
            _$$alertify: _alertify,
            reset: function() {
                _alertify.reset();
                return this;
            },
            alert: function(message, onOkay, onCancel) {
                return _alertify.dialog(message, "alert", onOkay, onCancel) || this;
            },
            confirm: function(message, onOkay, onCancel) {
                return _alertify.dialog(message, "confirm", onOkay, onCancel) || this;
            },
            prompt: function(message, onOkay, onCancel) {
                return _alertify.dialog(message, "prompt", onOkay, onCancel) || this;
            },
            log: function(message, click) {
                _alertify.log(message, "default", click);
                return this;
            },
            theme: function(themeStr) {
                _alertify.theme(themeStr);
                return this;
            },
            success: function(message, click) {
                _alertify.log(message, "success", click);
                return this;
            },
            error: function(message, click) {
                _alertify.log(message, "error", click);
                return this;
            },
            cancelBtn: function(label) {
                _alertify.cancelBtn(label);
                return this;
            },
            okBtn: function(label) {
                _alertify.okBtn(label);
                return this;
            },
            delay: function(time) {
                _alertify.setDelay(time);
                return this;
            },
            placeholder: function(str) {
                _alertify.promptPlaceholder = str;
                return this;
            },
            defaultValue: function(str) {
                _alertify.promptValue = str;
                return this;
            },
            maxLogItems: function(num) {
                _alertify.setMaxLogItems(num);
                return this;
            },
            closeLogOnClick: function(bool) {
                _alertify.setCloseLogOnClick(!! bool);
                return this;
            },
            logPosition: function(str) {
                _alertify.setLogPosition(str || "");
                return this;
            },
            setLogTemplate: function(templateMethod) {
                _alertify.logTemplateMethod = templateMethod;
                return this;
            },
            clearLogs: function() {
                _alertify.setupLogContainer().innerHTML = "";
                return this;
            },
            version: _alertify.version
        };
    }

    // AMD, window, and NPM support
    if ("undefined" !== typeof module && !! module && !! module.exports) {
        // Preserve backwards compatibility
        module.exports = function() {
            return new Alertify();
        };
        var obj = new Alertify();
        for (var key in obj) {
            module.exports[key] = obj[key];
        }
    } else if (typeof define === "function" && define.amd) {
        define(function() {
            return new Alertify();
        });
    } else {
        window.alertify = new Alertify();
    }

}());

/*jquery.multi-select.js*/
/*
* MultiSelect v0.9.12
* Copyright (c) 2012 Louis Cuny
*
* This program is free software. It comes without any warranty, to
* the extent permitted by applicable law. You can redistribute it
* and/or modify it under the terms of the Do What The Fuck You Want
* To Public License, Version 2, as published by Sam Hocevar. See
* http://sam.zoy.org/wtfpl/COPYING for more details.
*/

!function ($) {

  "use strict";


 /* MULTISELECT CLASS DEFINITION
  * ====================== */

  var MultiSelect = function (element, options) {
    this.options = options;
    this.$element = $(element);
    this.$container = $('<div/>', { 'class': "ms-container" });
    this.$selectableContainer = $('<div/>', { 'class': 'ms-selectable' });
    this.$selectionContainer = $('<div/>', { 'class': 'ms-selection' });
    this.$selectableUl = $('<ul/>', { 'class': "ms-list", 'tabindex' : '-1' });
    this.$selectionUl = $('<ul/>', { 'class': "ms-list", 'tabindex' : '-1' });
    this.scrollTo = 0;
    this.elemsSelector = 'li:visible:not(.ms-optgroup-label,.ms-optgroup-container,.'+options.disabledClass+')';
  };

  MultiSelect.prototype = {
    constructor: MultiSelect,

    init: function(){
      var that = this,
          ms = this.$element;

      if (ms.next('.ms-container').length === 0){
        ms.css({ position: 'absolute', left: '-9999px' });
        ms.attr('id', ms.attr('id') ? ms.attr('id') : Math.ceil(Math.random()*1000)+'multiselect');
        this.$container.attr('id', 'ms-'+ms.attr('id'));
        this.$container.addClass(that.options.cssClass);
        ms.find('option').each(function(){
          that.generateLisFromOption(this);
        });

        this.$selectionUl.find('.ms-optgroup-label').hide();

        if (that.options.selectableHeader){
          that.$selectableContainer.append(that.options.selectableHeader);
        }
        that.$selectableContainer.append(that.$selectableUl);
        if (that.options.selectableFooter){
          that.$selectableContainer.append(that.options.selectableFooter);
        }

        if (that.options.selectionHeader){
          that.$selectionContainer.append(that.options.selectionHeader);
        }
        that.$selectionContainer.append(that.$selectionUl);
        if (that.options.selectionFooter){
          that.$selectionContainer.append(that.options.selectionFooter);
        }

        that.$container.append(that.$selectableContainer);
        that.$container.append(that.$selectionContainer);
        ms.after(that.$container);

        that.activeMouse(that.$selectableUl);
        that.activeKeyboard(that.$selectableUl);

        var action = that.options.dblClick ? 'dblclick' : 'click';

        that.$selectableUl.on(action, '.ms-elem-selectable', function(){
          that.select($(this).data('ms-value'));
        });
        that.$selectionUl.on(action, '.ms-elem-selection', function(){
          that.deselect($(this).data('ms-value'));
        });

        that.activeMouse(that.$selectionUl);
        that.activeKeyboard(that.$selectionUl);

        ms.on('focus', function(){
          that.$selectableUl.focus();
        })
      }

      var selectedValues = ms.find('option:selected').map(function(){ return $(this).val(); }).get();
      that.select(selectedValues, 'init');

      if (typeof that.options.afterInit === 'function') {
        that.options.afterInit.call(this, this.$container);
      }
    },

    'generateLisFromOption' : function(option, index, $container){
      var that = this,
          ms = that.$element,
          attributes = "",
          $option = $(option);

      for (var cpt = 0; cpt < option.attributes.length; cpt++){
        var attr = option.attributes[cpt];

        if(attr.name !== 'value' && attr.name !== 'disabled'){
          attributes += attr.name+'="'+attr.value+'" ';
        }
      }
      var selectableLi = $('<li '+attributes+'><span>'+that.escapeHTML($option.text())+'</span></li>'),
          selectedLi = selectableLi.clone(),
          value = $option.val(),
          elementId = that.sanitize(value);

      selectableLi
        .data('ms-value', value)
        .addClass('ms-elem-selectable')
        .attr('id', elementId+'-selectable');

      selectedLi
        .data('ms-value', value)
        .addClass('ms-elem-selection')
        .attr('id', elementId+'-selection')
        .hide();

      if ($option.prop('disabled') || ms.prop('disabled')){
        selectedLi.addClass(that.options.disabledClass);
        selectableLi.addClass(that.options.disabledClass);
      }

      var $optgroup = $option.parent('optgroup');

      if ($optgroup.length > 0){
        var optgroupLabel = $optgroup.attr('label'),
            optgroupId = that.sanitize(optgroupLabel),
            $selectableOptgroup = that.$selectableUl.find('#optgroup-selectable-'+optgroupId),
            $selectionOptgroup = that.$selectionUl.find('#optgroup-selection-'+optgroupId);

        if ($selectableOptgroup.length === 0){
          var optgroupContainerTpl = '<li class="ms-optgroup-container"></li>',
              optgroupTpl = '<ul class="ms-optgroup"><li class="ms-optgroup-label"><span>'+optgroupLabel+'</span></li></ul>';

          $selectableOptgroup = $(optgroupContainerTpl);
          $selectionOptgroup = $(optgroupContainerTpl);
          $selectableOptgroup.attr('id', 'optgroup-selectable-'+optgroupId);
          $selectionOptgroup.attr('id', 'optgroup-selection-'+optgroupId);
          $selectableOptgroup.append($(optgroupTpl));
          $selectionOptgroup.append($(optgroupTpl));
          if (that.options.selectableOptgroup){
            $selectableOptgroup.find('.ms-optgroup-label').on('click', function(){
              var values = $optgroup.children(':not(:selected, :disabled)').map(function(){ return $(this).val() }).get();
              that.select(values);
            });
            $selectionOptgroup.find('.ms-optgroup-label').on('click', function(){
              var values = $optgroup.children(':selected:not(:disabled)').map(function(){ return $(this).val() }).get();
              that.deselect(values);
            });
          }
          that.$selectableUl.append($selectableOptgroup);
          that.$selectionUl.append($selectionOptgroup);
        }
        index = index == undefined ? $selectableOptgroup.find('ul').children().length : index + 1;
        selectableLi.insertAt(index, $selectableOptgroup.children());
        selectedLi.insertAt(index, $selectionOptgroup.children());
      } else {
        index = index == undefined ? that.$selectableUl.children().length : index;

        selectableLi.insertAt(index, that.$selectableUl);
        selectedLi.insertAt(index, that.$selectionUl);
      }
    },

    'addOption' : function(options){
      var that = this;

      if (options.value !== undefined && options.value !== null){
        options = [options];
      } 
      $.each(options, function(index, option){
        if (option.value !== undefined && option.value !== null &&
            that.$element.find("option[value='"+option.value+"']").length === 0){
          var $option = $('<option value="'+option.value+'">'+option.text+'</option>'),
              index = parseInt((typeof option.index === 'undefined' ? that.$element.children().length : option.index)),
              $container = option.nested == undefined ? that.$element : $("optgroup[label='"+option.nested+"']")

          $option.insertAt(index, $container);
          that.generateLisFromOption($option.get(0), index, option.nested);
        }
      })
    },

    'escapeHTML' : function(text){
      return $("<div>").text(text).html();
    },

    'activeKeyboard' : function($list){
      var that = this;

      $list.on('focus', function(){
        $(this).addClass('ms-focus');
      })
      .on('blur', function(){
        $(this).removeClass('ms-focus');
      })
      .on('keydown', function(e){
        switch (e.which) {
          case 40:
          case 38:
            e.preventDefault();
            e.stopPropagation();
            that.moveHighlight($(this), (e.which === 38) ? -1 : 1);
            return;
          case 37:
          case 39:
            e.preventDefault();
            e.stopPropagation();
            that.switchList($list);
            return;
          case 9:
            if(that.$element.is('[tabindex]')){
              e.preventDefault();
              var tabindex = parseInt(that.$element.attr('tabindex'), 10);
              tabindex = (e.shiftKey) ? tabindex-1 : tabindex+1;
              $('[tabindex="'+(tabindex)+'"]').focus();
              return;
            }else{
              if(e.shiftKey){
                that.$element.trigger('focus');
              }
            }
        }
        if($.inArray(e.which, that.options.keySelect) > -1){
          e.preventDefault();
          e.stopPropagation();
          that.selectHighlighted($list);
          return;
        }
      });
    },

    'moveHighlight': function($list, direction){
      var $elems = $list.find(this.elemsSelector),
          $currElem = $elems.filter('.ms-hover'),
          $nextElem = null,
          elemHeight = $elems.first().outerHeight(),
          containerHeight = $list.height(),
          containerSelector = '#'+this.$container.prop('id');

      $elems.removeClass('ms-hover');
      if (direction === 1){ // DOWN

        $nextElem = $currElem.nextAll(this.elemsSelector).first();
        if ($nextElem.length === 0){
          var $optgroupUl = $currElem.parent();

          if ($optgroupUl.hasClass('ms-optgroup')){
            var $optgroupLi = $optgroupUl.parent(),
                $nextOptgroupLi = $optgroupLi.next(':visible');

            if ($nextOptgroupLi.length > 0){
              $nextElem = $nextOptgroupLi.find(this.elemsSelector).first();
            } else {
              $nextElem = $elems.first();
            }
          } else {
            $nextElem = $elems.first();
          }
        }
      } else if (direction === -1){ // UP

        $nextElem = $currElem.prevAll(this.elemsSelector).first();
        if ($nextElem.length === 0){
          var $optgroupUl = $currElem.parent();

          if ($optgroupUl.hasClass('ms-optgroup')){
            var $optgroupLi = $optgroupUl.parent(),
                $prevOptgroupLi = $optgroupLi.prev(':visible');

            if ($prevOptgroupLi.length > 0){
              $nextElem = $prevOptgroupLi.find(this.elemsSelector).last();
            } else {
              $nextElem = $elems.last();
            }
          } else {
            $nextElem = $elems.last();
          }
        }
      }
      if ($nextElem.length > 0){
        $nextElem.addClass('ms-hover');
        var scrollTo = $list.scrollTop() + $nextElem.position().top - 
                       containerHeight / 2 + elemHeight / 2;

        $list.scrollTop(scrollTo);
      }
    },

    'selectHighlighted' : function($list){
      var $elems = $list.find(this.elemsSelector),
          $highlightedElem = $elems.filter('.ms-hover').first();

      if ($highlightedElem.length > 0){
        if ($list.parent().hasClass('ms-selectable')){
          this.select($highlightedElem.data('ms-value'));
        } else {
          this.deselect($highlightedElem.data('ms-value'));
        }
        $elems.removeClass('ms-hover');
      }
    },

    'switchList' : function($list){
      $list.blur();
      this.$container.find(this.elemsSelector).removeClass('ms-hover');
      if ($list.parent().hasClass('ms-selectable')){
        this.$selectionUl.focus();
      } else {
        this.$selectableUl.focus();
      }
    },

    'activeMouse' : function($list){
      var that = this;

      this.$container.on('mouseenter', that.elemsSelector, function(){
        $(this).parents('.ms-container').find(that.elemsSelector).removeClass('ms-hover');
        $(this).addClass('ms-hover');
      });

      this.$container.on('mouseleave', that.elemsSelector, function () {
        $(this).parents('.ms-container').find(that.elemsSelector).removeClass('ms-hover');;
      });
    },

    'refresh' : function() {
      this.destroy();
      this.$element.multiSelect(this.options);
    },

    'destroy' : function(){
      $("#ms-"+this.$element.attr("id")).remove();
      this.$element.css('position', '').css('left', '')
      this.$element.removeData('multiselect');
    },

    'select' : function(value, method){
      if (typeof value === 'string'){ value = [value]; }

      var that = this,
          ms = this.$element,
          msIds = $.map(value, function(val){ return(that.sanitize(val)); }),
          selectables = this.$selectableUl.find('#' + msIds.join('-selectable, #')+'-selectable').filter(':not(.'+that.options.disabledClass+')'),
          selections = this.$selectionUl.find('#' + msIds.join('-selection, #') + '-selection').filter(':not(.'+that.options.disabledClass+')'),
          options = ms.find('option:not(:disabled)').filter(function(){ return($.inArray(this.value, value) > -1); });

      if (method === 'init'){
        selectables = this.$selectableUl.find('#' + msIds.join('-selectable, #')+'-selectable'),
        selections = this.$selectionUl.find('#' + msIds.join('-selection, #') + '-selection');
      }

      if (selectables.length > 0){
        selectables.addClass('ms-selected').hide();
        selections.addClass('ms-selected').show();

        options.prop('selected', true);

        that.$container.find(that.elemsSelector).removeClass('ms-hover');

        var selectableOptgroups = that.$selectableUl.children('.ms-optgroup-container');
        if (selectableOptgroups.length > 0){
          selectableOptgroups.each(function(){
            var selectablesLi = $(this).find('.ms-elem-selectable');
            if (selectablesLi.length === selectablesLi.filter('.ms-selected').length){
              $(this).find('.ms-optgroup-label').hide();
            }
          });

          var selectionOptgroups = that.$selectionUl.children('.ms-optgroup-container');
          selectionOptgroups.each(function(){
            var selectionsLi = $(this).find('.ms-elem-selection');
            if (selectionsLi.filter('.ms-selected').length > 0){
              $(this).find('.ms-optgroup-label').show();
            }
          });
        } else {
          if (that.options.keepOrder && method !== 'init'){
            var selectionLiLast = that.$selectionUl.find('.ms-selected');
            if((selectionLiLast.length > 1) && (selectionLiLast.last().get(0) != selections.get(0))) {
              selections.insertAfter(selectionLiLast.last());
            }
          }
        }
        if (method !== 'init'){
          ms.trigger('change');
          if (typeof that.options.afterSelect === 'function') {
            that.options.afterSelect.call(this, value);
          }
        }
      }
    },

    'deselect' : function(value){
      if (typeof value === 'string'){ value = [value]; }

      var that = this,
          ms = this.$element,
          msIds = $.map(value, function(val){ return(that.sanitize(val)); }),
          selectables = this.$selectableUl.find('#' + msIds.join('-selectable, #')+'-selectable'),
          selections = this.$selectionUl.find('#' + msIds.join('-selection, #')+'-selection').filter('.ms-selected').filter(':not(.'+that.options.disabledClass+')'),
          options = ms.find('option').filter(function(){ return($.inArray(this.value, value) > -1); });

      if (selections.length > 0){
        selectables.removeClass('ms-selected').show();
        selections.removeClass('ms-selected').hide();
        options.prop('selected', false);

        that.$container.find(that.elemsSelector).removeClass('ms-hover');

        var selectableOptgroups = that.$selectableUl.children('.ms-optgroup-container');
        if (selectableOptgroups.length > 0){
          selectableOptgroups.each(function(){
            var selectablesLi = $(this).find('.ms-elem-selectable');
            if (selectablesLi.filter(':not(.ms-selected)').length > 0){
              $(this).find('.ms-optgroup-label').show();
            }
          });

          var selectionOptgroups = that.$selectionUl.children('.ms-optgroup-container');
          selectionOptgroups.each(function(){
            var selectionsLi = $(this).find('.ms-elem-selection');
            if (selectionsLi.filter('.ms-selected').length === 0){
              $(this).find('.ms-optgroup-label').hide();
            }
          });
        }
        ms.trigger('change');
        if (typeof that.options.afterDeselect === 'function') {
          that.options.afterDeselect.call(this, value);
        }
      }
    },

    'select_all' : function(){
      var ms = this.$element,
          values = ms.val();

      ms.find('option:not(":disabled")').prop('selected', true);
      this.$selectableUl.find('.ms-elem-selectable').filter(':not(.'+this.options.disabledClass+')').addClass('ms-selected').hide();
      this.$selectionUl.find('.ms-optgroup-label').show();
      this.$selectableUl.find('.ms-optgroup-label').hide();
      this.$selectionUl.find('.ms-elem-selection').filter(':not(.'+this.options.disabledClass+')').addClass('ms-selected').show();
      this.$selectionUl.focus();
      ms.trigger('change');
      if (typeof this.options.afterSelect === 'function') {
        var selectedValues = $.grep(ms.val(), function(item){
          return $.inArray(item, values) < 0;
        });
        this.options.afterSelect.call(this, selectedValues);
      }
    },

    'deselect_all' : function(){
      var ms = this.$element,
          values = ms.val();

      ms.find('option').prop('selected', false);
      this.$selectableUl.find('.ms-elem-selectable').removeClass('ms-selected').show();
      this.$selectionUl.find('.ms-optgroup-label').hide();
      this.$selectableUl.find('.ms-optgroup-label').show();
      this.$selectionUl.find('.ms-elem-selection').removeClass('ms-selected').hide();
      this.$selectableUl.focus();
      ms.trigger('change');
      if (typeof this.options.afterDeselect === 'function') {
        this.options.afterDeselect.call(this, values);
      }
    },

    sanitize: function(value){
      var hash = 0, i, character;
      if (value.length == 0) return hash;
      var ls = 0;
      for (i = 0, ls = value.length; i < ls; i++) {
        character  = value.charCodeAt(i);
        hash  = ((hash<<5)-hash)+character;
        hash |= 0; // Convert to 32bit integer
      }
      return hash;
    }
  };

  /* MULTISELECT PLUGIN DEFINITION
   * ======================= */

  $.fn.multiSelect = function () {
    var option = arguments[0],
        args = arguments;

    return this.each(function () {
      var $this = $(this),
          data = $this.data('multiselect'),
          options = $.extend({}, $.fn.multiSelect.defaults, $this.data(), typeof option === 'object' && option);

      if (!data){ $this.data('multiselect', (data = new MultiSelect(this, options))); }

      if (typeof option === 'string'){
        data[option](args[1]);
      } else {
        data.init();
      }
    });
  };

  $.fn.multiSelect.defaults = {
    keySelect: [32],
    selectableOptgroup: false,
    disabledClass : 'disabled',
    dblClick : false,
    keepOrder: false,
    cssClass: ''
  };

  $.fn.multiSelect.Constructor = MultiSelect;

  $.fn.insertAt = function(index, $parent) {
    return this.each(function() {
      if (index === 0) {
        $parent.prepend(this);
      } else {
        $parent.children().eq(index - 1).after(this);
      }
    });
}

}(window.jQuery);

/*multi-select.min.js*/
/*!
 * remark (http://getbootstrapadmin.com/remark)
 * Copyright 2015 amazingsurge
 * Licensed under the Themeforest Standard Licenses
 */
$.components.register("multiSelect",{mode:"default",defaults:{}});
/*freight.js*/
$(document).ready(function() {

/*面板初始化*/
	var defaults = $.components.getDefaults("slidePanel");
	var options = $.extend({}, defaults, {
		template: function(options) {
			return '<div class="' + options.classes.base + ' ' + options.classes.base + '-' + options.direction + '">' +
			'<div class="' + options.classes.base + '-scrollable"><div>' +
			'<div class="' + options.classes.content + '"></div>' +
			'</div></div>' +
			'<div class="' + options.classes.base + '-handler"></div>' +
			'</div>';
		},
		afterLoad: function() {//加载完成执行
			//滚轴
			this.$panel.find('.' + this.options.classes.base + '-scrollable').asScrollable({
				namespace: 'scrollable',
				contentSelector: '>',
				containerSelector: '>'
			});
			//编辑事件
			freight_edit(options);
		}
	});
	
	//新增运费模板
	$(document).on('click', '#freight_id', function(e) {
		loadPanel(options,own_form + 'a=docheck');
	});
	
	//编辑
	$(document).on('click', 'a.freight-edit', function(e) {
		e.preventDefault();
		loadPanel(options,own_form + 'a=docheck&id='+$(this).data('id'));
	});
	
	//删除
	$(document).on('click', 'a.freight-del', function(e) {
		e.preventDefault();
		var id = $(this).data('id');
		alertify.theme('bootstrap').okBtn("确定").cancelBtn("取消").confirm("确定要删除运费模板?", function (ev) {
			ev.preventDefault();
			$.ajax({
				url: own_form + 'a=dodel&id='+id,
				type: 'POST',
				dataType:'json',
				success: function(result) {
					if(result.error){
						alertify.error(result.error);
					}else if(result.success){
						alertify.success(result.success);
						show_freight_list();
					}
				}
			});
		}, function(ev) {
			ev.preventDefault();
		});
	});
	
	//展开列表
	$(document).on('show.bs.collapse', '.freight_list .collapse', function(e) {
		var collapse = $(e.target),id = collapse.data('id');
		if(!collapse.data('zone')){
			collapse.find("tbody").html('<div class="loader loader-default"></div>');
			load_zone_list(id,function(json){
				var html = '';
				$.each(json, function(i, item){ 
					html += regionhtml(item.zone,item.first,item.freight,item.addp,item.renew);
				}); 
				collapse.find("tbody").html('').append(html);
				collapse.attr("data-zone","true");
			});
		}
	});
	
	show_freight_list();
	
});

/*配送区域增删改查*/
$(document).ready(function() {
	//新增
	$(document).on('click', '#newquyuselect', function(e) {
		addselectoption();
	});
	//全选
	$(document).on('click', '#selectall', function(e) {
		$('#multiselect_zone').multiSelect('select_all');
	});
	//清除
	$(document).on('click', '#deselectall', function(e) {
		$('#multiselect_zone').multiSelect('deselect_all');
	});
	//保存
	$('#quyuselect-form').formValidation({
		locale:'zh_CN',
		framework: "bootstrap"
	}).on('success.form.fv', function(e, data) {
		e.preventDefault();
		var zone = $('#multiselect_zone').val();
		if(zone!=''&&zone!=null){
			if($('input[name="zoneid"]').val()!=''){
				var put = $("#editor_region tbody td input[data-id='"+$('input[name="zoneid"]').val()+"']");
					put.val(zone);
					put.prev('span').html(''+zone+'');
			}else{
				addregion(zone,1,0,1,0);
			}
			$("#quyuselect").modal('hide');
		}
	});
	//选择器
	$('[data-plugin="multiSelect"]').multiSelect({
		selectableHeader:'<p>可选择</p>',
		selectionHeader:'<p>已选择</p>',
		selectableFooter:'<a href="javascript:void(0)" class="btn btn-squared btn-block btn-primary" id="selectall">全选</a>',
		selectionFooter:'<a href="javascript:void(0)" class="btn btn-squared btn-block btn-primary" id="deselectall">清除</a>'
	});
	//编辑
	$(document).on('click', '#editor_region .region-edit', function(e) {
		var put= $(this).parents('td').find('input.zoneinput'),
			id = put.data('id'),
			op = put.val();
		$("#quyuselect").modal('show');
		addselectoption(id,op);
	});
	//删除
	$(document).on('click', '#editor_region .region-del', function(e) {
		var tr = $(this).parents('tr');
		alertify.theme('bootstrap').okBtn("确定").cancelBtn("取消").confirm("确定要删除?", function (ev) {
			ev.preventDefault();
			tr.remove();
		}, function(ev) {
			ev.preventDefault();
		});
	});
});
//新增区域
function addregion(zone,first,freight,addp,renew){
	if(typeof(regionnum) == "undefined")window.regionnum = 0;
	var zone = edit_zone(zone),
		first = edit_first(first),
		freight = edit_freight(freight),
		addp = edit_addp(addp),
		renew = edit_renew(renew);
		$("#editor_region tbody").append(regionhtml(zone,first,freight,addp,renew));
		regionnum ++ ;
}
//可编辑的
function edit_zone(zone){
	return '<div class="pull-right"><a href="javascript:void(0)" class="icon wb-edit region-edit margin-left-10"></a>'+'<a href="javascript:void(0)" class="icon wb-close region-del margin-left-10"></a></div>'+'<span>'+zone+'</span><input type="hidden" name="zone[]" data-id="'+regionnum+'" class="form-control zoneinput" value="'+zone+'">';
}
function edit_first(first){
	return '<input type="text" name="first[]" class="form-control" value="'+first+'">';
}
function edit_freight(freight){
	return '<input type="text" name="freight[]" class="form-control" value="'+freight+'">';
}
function edit_addp(addp){
	return '<input type="text" name="addp[]" class="form-control" value="'+addp+'">';
}
function edit_renew(renew){
	return '<input type="text" name="renew[]" class="form-control" value="'+renew+'">';
}
//获取区域选项
function addselectoption(id,op){
	var st = $('#multiselect_zone');
	st.find('option').remove();
	var zone = {"中国":["北京","天津","河北","山西","内蒙古","辽宁","吉林","黑龙江","上海","江苏","浙江","安徽","福建","江西","山东","河南","湖北","湖南","广东","广西","海南","重庆","四川","贵州","云南","西藏","陕西","甘肃","青海","宁夏","新疆","台湾省","香港","澳门"]};
	var nozone = '';
		$("#editor_region tbody input.zoneinput").each(function(){
			if($(this).data('id')!=id)nozone+=nozone==''?$(this).val():','+$(this).val();
		});
		if(nozone!='')nozone = nozone.split(',');
	var html = '';
	$.each(zone, function(i, item){
		html+='<optgroup label="'+i+'">';
		$.each(item, function(p, m){
			var mok = true;
			if(nozone.length>0){
				for (var l = 0; l < nozone.length; l++) {
					if (nozone[l]==m) {
						mok = false;
					}
				}
			}
			if(mok)html+='<option value="'+m+'">'+m+'</option>';
		})
        html+='</optgroup>';
	});
	st.html(html);
	if(html.indexOf('option')==-1){
		alertify.error('已无可选区域');
		$("#quyuselect").modal('hide');
	}else{
		st.multiSelect('refresh');
		$("#quyuselect-form input[name='zoneid']").val('');
		if(op){
			$("#quyuselect-form input[name='zoneid']").val(id);
			op = op.split(',');
			st.multiSelect('select', op);
		}
	}
}
//区域html
function regionhtml(zone,first,freight,addp,renew){
	return '<tr>'+
	'<td>'+zone+'</td>'+
	'<td>'+first+'</td>'+
	'<td>'+freight+'</td>'+
	'<td>'+addp+'</td>'+
	'<td>'+renew+'</td>'+'</tr>';
}



/*编辑页*/
function freight_edit(options){
	//载入区域列表
	var id = $("#zone_from input[name='id']").val();
	if(id!=''){
		$("#editor_region tbody").html('<div class="loader loader-default"></div>');
		load_zone_list(id,function(json){
			$("#editor_region tbody").html('');
			$.each(json, function(i, item){ 
				addregion(item.zone,item.first,item.freight,item.addp,item.renew);
			}); 
		});
	}
	//保存运费模板
	$('#zone_from').formValidation({
		locale:'zh_CN',
		framework: "bootstrap"
	}).on('success.form.fv', function(e, data) {
		e.preventDefault();
		if($("input[name='zone[]']").length){
			var $form    = $(e.target),
				formData = new FormData(),
				params   = $form.serializeArray();
			$.each(params, function(i, val) {
				formData.append(val.name, val.value);
			});
			$.ajax({
				url: $form.attr('action'),
				data: formData,
				cache: false,
				contentType: false,
				processData: false,
				type: 'POST',
				dataType:'json',
				success: function(result) {
					if(result.error){
						alertify.error(result.error);
					}else if(result.success){
						alertify.success(result.success);
						show_freight_list();
						$.slidePanel.hide();
					}
				}
			});
		}else{
			alertify.error('请设置配送区域');
			$(".editor_btn").removeAttr("disabled").removeClass("disabled");
		}
	});
}

/*共用方法*/
//加载面板
function loadPanel(options,url){
	var url = url;
	$.slidePanel.show({
		url: url,
		settings: {
			cache: false
		}
	}, options);
}

//刷新运费列表
function show_freight_list(){
	$(".freight_list").html('<div class="loader loader-default"></div>');
	load_freight_list(function(json){
			var html = '';
			$.each(json, function(i, item){ 
				html += '<li class="list-group-item">'+
							'<div class="freight-action">'+
								'<a class="icon wb-edit freight-edit" data-id="'+item.id+'"></a>'+
								'<a class="icon wb-close freight-del" data-id="'+item.id+'"></a>'+
							'</div>'+
							'<h3 class="list-title bg-blue-grey-100" data-toggle="collapse" onselectstart="return false;" style="-moz-user-select:none;" data-target="#freight_'+item.id+'">'+
							item.name+
							'</h3>'+
							'<div class="collapse" id="freight_'+item.id+'" data-id="'+item.id+'">'+
								'<div class="well">'+
									'<div class="table-responsive">'+
										'<table class="table">'+
											'<thead><tr>'+
											'<th>可配送区域</th><th>首件（个）</th><th>运费</th><th>续件（个）</th><th>续费</th>'+
											'</tr></thead>'+
											'<tbody></tbody>'+
										'</table>'+
									'</div>'+
								'</div>'+
							'</div>'+
						'</li>';
			}); 
			$(".freight_list").html(html);
	});
}

//运费数据
function load_freight_list(func){
	$.ajax({
		url: own_form + 'a=dojson_freight_list',
		cache: false,
		type: 'POST',
		dataType:'json',
		success: function(json) {
			func(json);
		}
	});
}

//规则数据
function load_zone_list(id,func){
	$.ajax({
		url: own_form + 'a=dojson_zone_list&id='+id,
		cache: false,
		type: 'POST',
		dataType:'json',
		success: function(json) {
			func(json);
		}
	});
}
