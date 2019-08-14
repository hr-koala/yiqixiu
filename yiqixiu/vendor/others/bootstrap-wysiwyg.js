/* http://github.com/mindmup/bootstrap-wysiwyg */
/*global jQuery, $, FileReader*/
/*jslint browser:true*/
(function ($) {
	'use strict';	
	var readFileIntoDataUrl = function (fileInfo) {
		var loader = $.Deferred(),
			fReader = new FileReader();
		fReader.onload = function (e) {
			loader.resolve(e.target.result);
		};
		fReader.onerror = loader.reject;
		fReader.onprogress = loader.notify;
		fReader.readAsDataURL(fileInfo);
		return loader.promise();
	};
	$.fn.cleanHtml = function () {
		var html = $(this).html();
		return html && html.replace(/(<br>|\s|<div><br><\/div>|&nbsp;)*$/, '');
	};
	$.fn.wysiwyg_destroy = function(userOptions) {
	    var editor, options, toolbar, toolbarBtnSelector;
	    editor = this;
	    options = $.extend({}, $.fn.wysiwyg.defaults, userOptions);
	    toolbarBtnSelector = "a[data-" + options.commandRole + "],button[data-" + options.commandRole + "],input[type=button][data-" + options.commandRole + "]";
	    editor.off("." + options.eventNamespace);
	    editor.off("paste");
	    $(window).off("." + options.eventNamespace);
	    toolbar = $(options.toolbarSelector);
	    toolbar.find(toolbarBtnSelector).off("." + options.eventNamespace);
	    toolbar.find("[data-toggle=dropdown]").off("." + options.eventNamespace);
	    toolbar.find("input[type=text][data-" + options.commandRole + "]").off("." + options.eventNamespace);
	    toolbar.find("input[type=file][data-" + options.commandRole + "]").off("." + options.eventNamespace);
	    return this;
	};
	$.fn.wysiwyg = function (userOptions) {		
		var editor = this,
			selectedRange,
			options,
			toolbarBtnSelector,
			startContainer,
			startOffset,
			endContainer,
			endOffset,
			updateToolbar = function () {
				if (options.activeToolbarClass) {
					$(options.toolbarSelector).find(toolbarBtnSelector).each(function () {
						var command = $(this).data(options.commandRole);
						if (document.queryCommandState(command)) {
							$(this).addClass(options.activeToolbarClass);
						} else {
							$(this).removeClass(options.activeToolbarClass);
						}
					});
				}
			},
			execCommand = function (commandWithArgs, valueArg) {
				var commandArr = commandWithArgs.split(' '),
					command = commandArr.shift(),
					args = commandArr.join(' ') + (valueArg || '');
				/*if(command == 'unlink') {
					$('#btn-toolbar input[type=text][data-edit]').val('');
					$('#btn-toolbar select[data-edit]').val(0);
				}*/
				if(command == 'createLink') {
					//EQ-179恢复选区
					var selection = window.getSelection();
					// 构造新的 Range
					var newRange = document.createRange(); // 注意，此处必须创建一个新的选区，在原来的 range 上修改无效
					newRange.setStart(startContainer, startOffset);
					newRange.setEnd(endContainer, endOffset);

					// 恢复选区
					selection.removeAllRanges();
					selection.addRange(newRange);
					
					//document.execCommand('insertHTML', false, '<a href="' + args + '" target="_blank">' + window.getSelection() + '</a>');
					//document.execCommand(command, true, args);
					//没有选中
					if(window.getSelection().isCollapsed ) {
						updateToolbar();
						return;
					}
					if(valueArg[0] == 'external') {
						var newLink = document.execCommand(command, 0	, PREFIX_S1_URL + 'eqs/link?id=' + valueArg[2] + '&url=' + encodeURIComponent(valueArg[1]));
						var el = window.getSelection().focusNode;
						while (el && el.parentNode) {
							el = el.parentNode;
							if (el.tagName && el.tagName.toLowerCase() == 'a') {
								el.target = '_blank';
								$(el).removeAttr('data');
								break;
							}
						}
						var el2 = window.getSelection().anchorNode;
						while (el2 && el2.parentNode) {
							el2 = el2.parentNode;
							if (el2.tagName && el2.tagName.toLowerCase() == 'a') {
								el2.target = '_blank';
								$(el2).removeAttr('data');
								break;
							}
						}
					} else if(valueArg[0] == 'internal') {
						var newLink = document.execCommand(command, 0 , args.split(',')[1]);
						var el = window.getSelection().focusNode;
						while (el && el.parentNode) {
							el = el.parentNode;
							if (el.tagName && el.tagName.toLowerCase() == 'a') {
								$(el).attr('data', args.split(',')[1]);
								break;
							}
						}
						var el2 = window.getSelection().anchorNode;
						while (el2 && el2.parentNode) {
							el2 = el2.parentNode;
							if (el2.tagName && el2.tagName.toLowerCase() == 'a') {
								$(el2).attr('data', args.split(',')[1]);
								break;
							}
						}
					}
				} else {
					
					if(command==='fontSize' && args.indexOf('px')>-1){
						if(!selectedRange)
						{
							saveSelection();
						}
						
						document.execCommand(command, 0, args);
						var el3 = window.getSelection().focusNode;
						if(selectedRange.commonAncestorContainer.contains(window.getSelection().focusNode.parentNode))
						{
							el3 = selectedRange.commonAncestorContainer;
							if(el3.nodeName.toLowerCase() == 'div')
							{
								el3 = $(el3).find('[style*="font-size: -webkit-xxx-large"]');
							}
						}
						else
						{
							if(el3.nodeName.toLowerCase() == '#text')
							{
								el3 = el3.parentNode;
							}
						}

						$(el3).css({'fontSize':args});
						if($(el3).find('span').length>0)
						{
							$(el3).find('span').css({'fontSize':args});
						}
						return;
					}

					document.execCommand(command, 0, args);

					if(command == 'fontName') {
						$('.font-dropdown').find('.dropdown-toggle').trigger('click');
					}
				}				
				updateToolbar();
			},
			bindHotkeys = function (hotKeys) {
				$.each(hotKeys, function (hotkey, command) {
					editor.keydown(hotkey, function (e) {
						if (editor.attr('contenteditable') && editor.is(':visible')) {
							e.preventDefault();
							e.stopPropagation();
							execCommand(command);
						}
					}).keyup(hotkey, function (e) {
						if (editor.attr('contenteditable') && editor.is(':visible')) {
							e.preventDefault();
							e.stopPropagation();
						}
					});
				});
			},
			getCurrentRange = function () {
				var sel = window.getSelection();
				if (sel.getRangeAt && sel.rangeCount) {
					return sel.getRangeAt(0);
				}
			},
			saveSelection = function () {
				selectedRange = getCurrentRange();
			},
			restoreSelection = function () {
				var selection = window.getSelection();
				if (selectedRange) {
					try {
						selection.removeAllRanges();
					} catch (ex) {
						document.body.createTextRange().select();
						document.selection.empty();
					}

					selection.addRange(selectedRange);
				}
			},
			insertFiles = function (files) {
				editor.focus();
				$.each(files, function (idx, fileInfo) {
					if (/^image\//.test(fileInfo.type)) {
						$.when(readFileIntoDataUrl(fileInfo)).done(function (dataUrl) {
							execCommand('insertimage', dataUrl);
						}).fail(function (e) {
							options.fileUploadError("file-reader", e);
						});
					} else {
						options.fileUploadError("unsupported-file-type", fileInfo.type);
					}
				});
			},
			markSelection = function (input, color) {
				restoreSelection();
				if (document.queryCommandSupported('hiliteColor')) {
					document.execCommand('hiliteColor', 0, color || 'transparent');
				}
				saveSelection();
				input.data(options.selectionMarker, color);
			},
			bindToolbar = function (toolbar, options) {
				toolbar.find(toolbarBtnSelector).click(function () {
					restoreSelection();
					editor.focus();
					execCommand($(this).data(options.commandRole));
					saveSelection();
				});
				toolbar.find('.btn-group').click(function(e) {
					var el = window.getSelection().focusNode;
					while (el && el.parentNode) {
						el = el.parentNode;
						if (el.style && el.style.fontFamily) {
							break;
						} else {
							if(el && /editable\-text/.test(el.className)) {
								break;
							}
						}
					}

					var lis, $anchor;
					if($('.size-menu:visible').length) {
						lis = $('.size-menu').find('li');
						if(/editable\-text/.test(el.className)) {
							$.each(lis, function(index, value) {
								$anchor = $(value).find('a');
								$anchor.removeClass('selected-size');
								if($(el).find('span').length==0)
								{
									var size = $(el).css('font-size');
									if($anchor.attr('data-edit') == 'fontSize '+size) {
										$anchor.addClass('selected-size');
									}
								}
								else
								{
									var size = $(el).find('span').css('font-size');
									if($anchor.attr('data-edit') == 'fontSize ' + size) {
										$anchor.addClass('selected-size');
									}
								}
							});
						} else {
							$.each(lis, function(index, value) {
								$anchor = $(value).find('a');
								$anchor.removeClass('selected-size');
								if($(el).css('font-size'))
								{
									var size = $(el).css('font-size')
									if($anchor.attr('data-edit') == 'fontSize '+size) {
										$anchor.addClass('selected-size');
									}
								}
								else
								{
									if($anchor.attr('data-edit') == 'fontSize 24px') {
										$anchor.addClass('selected-size');
									}
								}
							});
						}	
					} else if($('.color-menu:visible').length) {
						lis = $('.color-menu').find('li');
						$.each(lis, function(index, value) {
							$anchor = $(value).find('a');
							var color;
							$anchor.removeClass('selected-color selected-blue-color').empty();
							if(el.style && el.style.color) {
								color = el.style.color;
							} else {
								if($(el).find('a').get(0) && $(el).find('a').get(0).style.color) {
									color = $(el).find('a').get(0).style.color;
								} else if($(el).parent('a').get(0) && $(el).parent('a').get(0).style.color) {
									color = $(el).parent('a').get(0).style.color;
								} else if($(el).find('span').get(0) && $(el).find('span').get(0).style.color) {
									color = $(el).find('span').get(0).style.color;
								}
							}
							color = rgb2hex(color);
							if($anchor.attr('data-edit') == 'foreColor ' + color)
							{
								$anchor.addClass('selected-color').append('<span class="eqf-right4"></span>');
								if($anchor.attr('data-edit') == 'foreColor #23a3d3') 
								{
									$anchor.addClass('selected-blue-color');
								}
							}
							// if($anchor.attr('data-edit') == 'foreColor ' + el.color) {
							// 	$anchor.addClass('selected-color').append('<span class="eqf-right4"></span>');
							// 	if($anchor.attr('data-edit') == 'foreColor #23a3d3') {
							// 		$anchor.addClass('selected-blue-color');								}
							// }
						});
					} else if($('.bgcolor-menu:visible').length) {
						var bgColor;
						lis = $('.bgcolor-menu').find('li');
						$.each(lis, function(index, value) {
							$anchor = $(value).find('a');
							$anchor.removeClass('selected-color').empty();
							if(el.style && el.style.backgroundColor) {
								bgColor = el.style.backgroundColor;
							} else {
								if($(el).find('a').get(0) && $(el).find('a').get(0).style.backgroundColor) {
									bgColor = $(el).find('a').get(0).style.backgroundColor;
								} else if($(el).parent('a').get(0) && $(el).parent('a').get(0).style.backgroundColor) {
									bgColor = $(el).parent('a').get(0).style.backgroundColor;
								} else if($(el).find('span').get(0) && $(el).find('span').get(0).style.backgroundColor) {
									bgColor = $(el).find('span').get(0).style.backgroundColor;
								}
							}
							var color1 = rgb2hex($anchor.get(0).style.backgroundColor);
							bgColor = rgb2hex(bgColor);
							if(color1 == bgColor) {
								$anchor.addClass('selected-color').append('<span style="" class="eqf-right4"></span>');
							}
						});
					} else if($('.fontname-menu:visible').length) {
						lis = $('.fontname-menu').find('li');
						var $n, src, blueSrc;
						$.each(lis, function(i, n) {
							var className = n.className.split(' ');
							src = utilFont.getFontName(className[0]).src;
							blueSrc = utilFont.getFontName(className[0]).blueSrc;
							$n = $(n);
							if($n.hasClass('selected-font')) {
								$n.removeClass('selected-font');
								$n.css({
									backgroundColor: '#fff'
								});
								$n.find('img').attr('src', CLIENT_CDN + blueSrc);
							}
							if(n.className == el.style.fontFamily) {
								$n.addClass('selected-font').css({
									backgroundColor: '#08a1ef'
								});
								$n.find('img').attr('src', CLIENT_CDN + src);
							}
						});
						if(!el.style.fontFamily || !el.style) {
							src = utilFont.getFontName('weiruanyahei').src;
							$('.weiruanyahei').addClass('selected-font').css({
								backgroundColor: '#08a1ef'
							}).find('img').attr('src', CLIENT_CDN + src);
						}
					}
					
				});

				function rgb2hex(rgb){
					if(!rgb) {
						return;
					}
				 	rgb = rgb.match(/^rgba?[\s+]?\([\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?,[\s+]?(\d+)[\s+]?/i);
				 	return (rgb && rgb.length === 4) ? "#" +
				  	("0" + parseInt(rgb[1],10).toString(16)).slice(-2) +
				  	("0" + parseInt(rgb[2],10).toString(16)).slice(-2) +
				  	("0" + parseInt(rgb[3],10).toString(16)).slice(-2) : '';
				}

				toolbar.find('[data-toggle=dropdown]').click(restoreSelection);
				var radioValue, elementid;
				toolbar.find('.createLink[data-toggle=dropdown]').click(function() {
					//$('.selected-text').html(getCurrentRange().endContainer.data.substring(getCurrentRange().startOffset, getCurrentRange().endOffset));
					var input;
					var parent = $(getSelection().focusNode).parent();
					elementid = $(parent).closest('.element').attr('id');
					$('#btn-toolbar input[type=text][data-edit]').attr('id', 'input_' + elementid);
					$('#btn-toolbar select[data-edit]').attr('id', 'select_' + elementid);
					$('#btn-toolbar input[name=external]').attr('id', 'external_' + elementid);
					$('#btn-toolbar input[name=internal]').attr('id', 'internal_' + elementid);
					if(isNaN($('#select_'+ elementid).find('option')[0].value)) {
						$($('#select_'+ elementid).find('option')[0]).remove();
					}
					if(parent.is('a')) {
						if(parent.attr('href') && isNaN(parent.attr('href'))) {
							input = $('#btn-toolbar #input_' + elementid);
							input.val(decodeURIComponent(parent.attr('href').split('url=')[1]));
							$('#btn-toolbar #select_' + elementid).val(0).attr('disabled', true);
							$('#btn-toolbar #external_' + elementid).attr('checked', true);
							$('#btn-toolbar #internal_' + elementid).attr('checked', false);
							radioValue = 'external';
						} else if(parent.attr('data') || !isNaN(parent.attr('href'))) {
							input = $('#btn-toolbar #select_' + elementid);
							var url = PREFIX_URL + 'm/scene/pageList/' + input.attr('sceneid') + '?date=' + new Date().getTime();
							$.ajax({
								method: 'GET',
								url: url,
								xhrFields: {
									withCredentials: true
								},
								crossDomain: true
							}).then(function(res) {
								var list = res.list;
								if(res.success) {
									for(var i = 0; i < list.length; i++) {
										if(list[i].id == parent.attr('data')) {
											input.val(list[i].num - 1);
										}
									}
								}
							});
							//input.val(parent.attr('data')-1);
							$('#btn-toolbar #input_' + elementid).val('http://').attr('disabled', true);
							$('#btn-toolbar #internal_' + elementid).attr('checked', true);
							$('#btn-toolbar #external_' + elementid).attr('checked', false);
							radioValue = 'internal';
						}
						/*input.val(decodeURIComponent(parent.attr('href').split('url=')[1]));*/
					} else {
						$('#btn-toolbar #input_' + elementid).val('http://');
						$('#btn-toolbar #select_' + elementid).val(0).attr('disabled', true);
						$('#btn-toolbar #internal_' + elementid).attr('checked', false);
						$('#btn-toolbar #external_' + elementid).attr('checked', true);
						radioValue = 'external';
					}

					//EQ-179解决鼠标光标focus在文本区后丢失选区问题。
					var selection = window.getSelection();
					var range = selection.getRangeAt(0);

					// 保存所有 Range 的属性
					startContainer = range.startContainer;
					startOffset = range.startOffset;
					endContainer = range.endContainer;
					endOffset = range.endOffset;
				});

				$('#btn-toolbar input[name=external]').change(function() {
					radioValue = this.value;
					$('#btn-toolbar #select_' + elementid).val(0).attr('disabled', true);
					$('#btn-toolbar #input_' + elementid).removeAttr('disabled');
					$('#btn-toolbar #internal_' + elementid).attr('checked', false);
				});
				$('#btn-toolbar input[name=internal]').change(function() {
					radioValue = this.value;
					$('#btn-toolbar #input_' + elementid).val('http://').attr('disabled', true);
					$('#btn-toolbar #select_' + elementid).removeAttr('disabled');
					$('#btn-toolbar #external_' + elementid).attr('checked', false);
				});

				$('a[dropdown-toggle]').click(function() {
					if(radioValue == 'external') {
						var elem = toolbar.find('input[type=text][data-' + options.commandRole + ']');
						var newValue = $(elem).val(); /* ugly but prevents fake double-calls due to selection restoration */
						$(elem).val('');
						var sceneId = $(elem).attr('sceneid');
						restoreSelection();
						var prefix = 'http://';
						if (!/^http:|^https:/.test(newValue))
						{
							newValue = prefix + newValue;
						}
						if (newValue && newValue != prefix) {
							editor.focus();
							execCommand($(elem).data(options.commandRole), [radioValue, newValue, sceneId]);
						}
						saveSelection();
					} else if(radioValue == 'internal') {
						//alert(789);
						var elem = toolbar.find('select[data-' + options.commandRole + ']');
						//var newValue = $(elem).val(); /* ugly but prevents fake double-calls due to selection restoration */
						var newValue = $(elem).attr('pageid');
						$(elem).val('');
						var sceneId = $(elem).attr('sceneid');
						restoreSelection();
						if (newValue) {
							editor.focus();
							execCommand($(elem).data(options.commandRole), [radioValue, parseInt(newValue), sceneId]);
						}
					}
				});
				toolbar.find('input[type=file][data-' + options.commandRole + ']').change(function () {
					restoreSelection();
					if (this.type === 'file' && this.files && this.files.length > 0) {
						insertFiles(this.files);
					}
					saveSelection();
					this.value = '';
				});
			},
			initFileDrops = function () {
				editor.on('dragenter dragover', false)
					.on('drop', function (e) {
						var dataTransfer = e.originalEvent.dataTransfer;
						e.stopPropagation();
						e.preventDefault();
						if (dataTransfer && dataTransfer.files && dataTransfer.files.length > 0) {
							insertFiles(dataTransfer.files);
						}
					});
			};
		options = $.extend({}, $.fn.wysiwyg.defaults, userOptions);
		toolbarBtnSelector = 'a[data-' + options.commandRole + '],button[data-' + options.commandRole + '],input[type=button][data-' + options.commandRole + ']';
		bindHotkeys(options.hotKeys);
		if (options.dragAndDropImages) {
			initFileDrops();
		}
		try{
			document.execCommand('styleWithCSS',0,true);
		}catch(e){
		}
		bindToolbar($(options.toolbarSelector), options);
		editor.attr('contenteditable', true).on('mouseup keyup mouseout', function () {
				saveSelection();
				updateToolbar();
			});
		editor.on('paste',function(e) {
		    e.preventDefault();
		    var text = (e.originalEvent || e).clipboardData.getData('text/plain') || prompt('Paste something..');
		    document.execCommand('insertText', false, text);
		});
		$(window).bind('touchend', function (e) {
			var isInside = (editor.is(e.target) || editor.has(e.target).length > 0),
				currentRange = getCurrentRange(),
				clear = currentRange && (currentRange.startContainer === currentRange.endContainer && currentRange.startOffset === currentRange.endOffset);
			if (!clear || isInside) {
				saveSelection();
				updateToolbar();
			}
		});
		return this;
	};
	$.fn.wysiwyg.defaults = {
		hotKeys: {
			'ctrl+b meta+b': 'bold',
			'ctrl+i meta+i': 'italic',
			'ctrl+u meta+u': 'underline',
			'ctrl+z meta+z': 'undo',
			'ctrl+y meta+y meta+shift+z': 'redo',
			'ctrl+l meta+l': 'justifyleft',
			'ctrl+r meta+r': 'justifyright',
			'ctrl+e meta+e': 'justifycenter',
			'ctrl+j meta+j': 'justifyfull',
			'shift+tab': 'outdent',
			'tab': 'indent'
		},
		toolbarSelector: '[data-role=editor-toolbar]',
		commandRole: 'edit',
		activeToolbarClass: 'btn-info',
		selectionMarker: 'edit-focus-marker',
		selectionColor: 'darkgrey',
		dragAndDropImages: true,
		fileUploadError: function (reason, detail) { console.log("File upload error", reason, detail); }
	};
}(window.jQuery));
