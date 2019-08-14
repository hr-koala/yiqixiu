/*!
 * remark (http://getbootstrapadmin.com/remark)
 * Copyright 2015 amazingsurge
 * Licensed under the Themeforest Standard Licenses
 */
(function(document, window, $) {
  'use strict';

  window.AppTaskboard = App.extend({
		
	jumpadmin: function() { //跳转页面
		//alert(1111);
	},
	
	formValidation: function($id) { //跳转页面
	  $.each($id, function(n, info) {
		$(this).formValidation({
		  locale:'zh_CN',
		  framework: "bootstrap"
		});
		
	  });
	},
	
	alertify: function($str) { //跳转页面
	  if($str){
	    alertify.success($str);
	  }else{
	    alertify.success('操作成功');
	  }
	},
	
    //TPL
    stageTpl: function(name, id) {//搜索项HTML
      return '<li class="taskboard-stage" data-id="'+id+'">' +
        '<header class="taskboard-stage-header">' +
        '<div class="taskboard-stage-actions pull-right">' +
        '<div class="dropdown">' +
        '<a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false"><i class="icon wb-chevron-down" aria-hidden="true"></i></a>' +
        '<ul class="dropdown-menu bullet" role="menu">' +
        '<li role="presentation" class="taskboard-stage-rename"><a href="javascript:void(0)" role="menuitem"><i class="icon wb-pencil" aria-hidden="true"></i>编辑</a></li>' +
        '<li role="presentation" class="taskboard-stage-delete" data-url="'+site_admin+'index.php?n=shop&c=searchlist_admin&a=dodel_searchlist&id='+id+'&lang='+lang+'"><a href="javascript:void(0)" role="menuitem"><i class="icon wb-trash" aria-hidden="true"></i>删除</a></li>' +
        '<li class="taskboard-stage-rename-wrap">' +
		'<form>' +
        '<div class="form-group">' +
        '<label><input class="form-control taskboard-stage-rename-input" autocomplete="off" data-fv-notempty="true" type="text" value="' + name + '" name="name"></label>' +
        '</div>' +
        '<button type="sbumit" class="btn btn-primary btn-block taskboard-stage-rename-save" data-url="'+site_admin+'index.php?n=shop&c=searchlist_admin&a=doeditor_searchlist_name&id='+id+'&lang='+lang+'" type="button">保存</button>' +
        '</form>' +
		'</li>' +
        '</ul>' +
        '</div>' +
        '</div>' +
        '<h5 class="taskboard-stage-title">' + name + '</h5>' +
        '</header>' +
        '<div class="taskboard-stage-content">' +
        '<ul class="list-group taskboard-list">' +
        '</ul>' +
        '<div class="action-wrap">' +
        '<a class="add-item-toggle" href="#"><i class="icon wb-plus" aria-hidden="true"></i></a>' +
        '<div class="add-item-wrap">' +
        '<form class="add-item" role="form" method="post" action="#">' +
        '<div class="form-group">' +
        '<input class="form-control" type="text" autocomplete="off" data-fv-notempty="true" placeholder="" name="name">' +
        '</div>' +
        '<div class="form-group text-right">' +
        '<a class="btn btn-sm btn-white add-item-cancel">取消</a>' +
        '<button type="sbumit" class="btn btn-primary add-item-add" data-url="'+site_admin+'index.php?n=shop&c=searchlist_admin&a=doadd_searchlist_tag&sid='+id+'&lang='+lang+'">确认</button>' +
        '</div>' +
        '</form>' +
        '</div>' +
        '</div>' +
        '</div>' +
        '</li>';
    },

    taskTpl: function(data) {//搜索字段html
      return '<li class="list-group-item" data-taskboard="slidePanel" data-url="'+site_admin+'index.php?n=shop&c=searchlist_admin&a=doeditor_searchlist_tag&id='+data.id+'&lang='+lang+'" data-id="'+data.id+'">' +
        '<span class="task-title">' + data.name + '</span>' +
        '<span class="task-editor pull-right taskboard-task-delete" data-url="'+site_admin+'index.php?n=shop&c=searchlist_admin&a=dodel_searchlist_tag&id='+data.id+'&lang='+lang+'"><i class="icon wb-trash" aria-hidden="true"></i>'+	
        '</span>' +
		
        '</li>';
		
    },

    badgesTpl: function(type, content) {//可删除
      var html = '';
      switch (type) {
        case 'duedate':
          html = '<span class="task-badge task-badge-subtask icon wb-calendar">' + content + '</span>';
          break;
        case 'subtasks':
          html = '<span class="task-badge task-badge-subtask icon wb-list-bulleted">' + content + '</span>';
          break;
        case 'attachments':
          html = '<span class="task-badge task-badge-attachments icon wb-paperclip">' + content + '</span>';
          break;
        case 'comments':
          html = '<span class="task-badge task-badge-comments icon wb-chat">' + content + '</span>';
          break;
      }
      return html;
    },

    membersTpl: function(src) {//可删除
      return '<li><img class="avatar avatar-sm" src="' + src + '"></li>';
    },

    subtaskTpl: function(data) {
      return '<li class="list-group-item subtask">' +
        '<div class="checkbox-custom checkbox-primary">' +
        '<input type="checkbox" ' + (data.complete ? 'checked="checked"' : '') + ' name="checkbox">' +
        '<label class="title">' + data.title + '</label>' +
        '</div>' +
        '<div class="subtask-editor">' +
        '<form>' +
        '<div class="form-group">' +
        '<input class="form-control subtask-title" type="text" name="title">' +
        '</div>' +
        '<div class="form-group">' +
        '<button class="btn btn-primary subtask-editor-save" type="button">Save</button>' +
        '<a class="btn btn-sm btn-white subtask-editor-delete" href="javascript:void(0)">Delete</a>' +
        '</div>' +
        '</form>' +
        '</div>' +
        '</li>';
    },

    attachmentTpl: function(data) {
      return '<li class="list-group-item">' +
        '<div class="meida">' +
        '<div class="media-left">' +
        '<div class="attachments-image">' +
        '<img src="' + data.src + '">' +
        '</div>' +
        '</div>' +
        '<div class="media-body">' +
        '<p><span class="name">' + data.title + '</span><span</p>' +
        '<p>' +
        '<span class="size">' + data.size + '</span>' +
        '<span class="attachments-actions">' +
        '<button class="btn btn-icon btn-pure" type="button">' +
        '<i class="icon wb-download" aria-hidden="true"></i>' +
        '</button>' +
        '<button class="btn btn-icon btn-pure" type="button">' +
        '<i class="icon wb-trash" aria-hidden="true"></i>' +
        '</button>' +
        '</span>' +
        '</p>' +
        '</div>' +
        '</div>' +
        '</li>';
    },

    commentTpl: function(src, user, time, content) {
      return '<div class="comment media">' +
        '<div class="media-left">' +
        '<a class="avatar avatar-lg" href="javascript:void(0)">' +
        '<img src="' + src + '" alt="...">' +
        '</a>' +
        '</div>' +
        '<div class="media-body">' +
        '<div class="comment-body">' +
        '<a class="comment-author" href="javascript:void(0)">' + user + '</a>' +
        '<div class="comment-meta">' +
        '<span class="date">' + time + '</span>' +
        '</div>' +
        '<div class="comment-content"><p>' + content + '</p></div>' +
        '</div>' +
        '</div>' +
        '</div>';
    },

    dataTpl: function() {
      var data = {
        "status": false,
        "title": "",
        "description": "",
        "priority": "normal",
        "duedate": "",
        "members": [],
        "subtasks": [],
        "attachments": [],
        "comments": []
      };
      return data;
    },

    //Init Page 页面标签初始化
    init: function() {
      var self = this;
      $.getJSON(site_admin+'index.php?n=shop&c=searchlist_admin&a=dojson_searchlist_list&lang='+lang, function(data) {
        var $wrap = $('#taskboard-stages');
        self.buildStage($wrap, data);
        self.initSortable();
      });
    },

    buildStage: function($wrap, data) {
      if (data.length === 0) return;

      var self = this;
      $.each(data, function(n, info) {
        var $stage = $(self.stageTpl(info.name, info.id));
		var form = $('form', $stage);
        self.buildTask($stage, info.tag);
        $wrap.append($stage);
		self.formValidation(form);
      });
    },

    buildTask: function($wrap, data, once) {
      if (data.length === 0) return;
      var self = this,
        $container = $('.taskboard-list', $wrap);
      if (once) {
        var $task = $(self.taskTpl(data));
        //self.buildBadges($task, data);
        $task.data('taskInfo', data);
        $wrap.append($task);
      } else {
        $.each(data, function(n, info) {
          var $task = $(self.taskTpl(info));
          //self.buildBadges($task, info);
		  //self.buildMembers($task, info.members);
          $task.data('taskInfo', info);
          $container.append($task);
        });
      }
    },

    buildBadges: function($wrap, data) {//可删除
      var self = this,
        html = '',
        duedate = data.duedate,
        subtasks = data.subtasks,
        attachments = data.attachments,
        comments = data.comments;

      if (duedate.length > 0) {
        html += self.badgesTpl('duedate', duedate.split(/\//, 2).join("/"));
      }

      if (subtasks.length > 0) {
        var num = 0;
        $.each(subtasks, function(n, i) {
          if (i.complete) num++;
        });

        html += self.badgesTpl('subtasks', num + '/' + subtasks.length);
      }

      if (attachments.length > 0) {
        html += self.badgesTpl('attachments', attachments.length);
      }

      if (comments.length > 0) {
        html += self.badgesTpl('comments', comments.length);
      }

      $wrap.find('.task-badges').html(html);
    },

    buildMembers: function($wrap, data) {//可删除
      var self = this,
        html = '';
      if (data.length === 0) return;
      $.each(data, function(i, n) {
        html += self.membersTpl(n.img);
      });
      $wrap.find('.task-members').html(html);
    },

    //Sortable 滚动插件
    initSortable: function() {
	  var self = this;
      $('.taskboard-stages').sortable({
        handle: ".taskboard-stage-header",
		update: function( event, ui ) {
		  self.Order();
		}
      });
      $('.taskboard-stage .list-group').sortable({
        connectWith: ".taskboard-stage .list-group",
		update: function( event, ui ) {
		  self.Order();
		}
      });
    },
	
	Order: function() {
	  var idlist = '';
	  $.each($('.taskboard-stage'), function(){
	    idlist += $(this).data('id')+'-';
		$.each($('.list-group-item', $(this)), function(){
		  idlist += $(this).data('id')+',';
		});
		idlist += $(this).data('id')+'|';
	  });
	  $.getJSON($('.taskboard-stages').data('url')+"&idlist="+idlist , function(data) {
		if(data.msg != 'suc'){
		  self.jumpadmin();
		}else{
		  self.alertify(data.suc);
		}
	  });
	},
	
    //Stage 搜索项新增/删除
    handleAddStage: function() {
      var self = this;

      $(document).on('click', '.site-floataction', function() {
        var $model = $('#addStageFrom');

        $('input', $model).val('');
        $('option:first', $('select', $model)).prop("selected", 'selected');
      });

      $(document).on('click', '#taskboard-stage-creat', function() {
        var $this = $(this),
          $model = $('#addStageFrom'),
          $name = $('[name="name"]', $model);
		  
		$.getJSON($this.data('url')+"&name="+$name.val() , function(data) {
		  if(data.msg != 'suc'){
			self.jumpadmin();
		  }else{
			var $stage = $(self.stageTpl($name.val(), data.id));
			var form = $('form', $stage);
			$('.taskboard-stages').append($stage);
			self.formValidation(form);
			self.initSortable();
			self.alertify(data.suc);
		  }
		});
		

      });
    },

    handleDeleteStage: function() {
      $(document).on('click', '.taskboard-stage-delete', function() {
        var $this = $(this);
        bootbox.dialog({
          message: "是否确认删除此搜索？",
          buttons: {
            success: {
              label: "删除",
              className: "btn-danger",
              callback: function() {
				$this.closest('.taskboard-stage').remove();
			    $.getJSON($this.data('url') , function(data) {
				  if(data.msg != 'suc'){
				    self.jumpadmin();
				  }else{
					self.alertify(data.suc);
				  }
			  });
              }
            }
          }
        });
      });
    },

    getStage: function($task) {
      return $task.closest('.taskboard-stage');
    },

    //Stage Dropdown //点击搜索项的下拉
    initStageDropdown: function() {
      $(document).on('click', '.taskboard-stage-actions .dropdown-toggle', function() {
        $(this).next('.dropdown-menu').removeClass('is-edit');

        //judge dropdown side
      });
    },

    handleStageRename: function() { //重命名搜索列
	  var self = this;
      $(document).on('click', '.taskboard-stage-rename', function(e) {
        var $header = $(this).closest('.taskboard-stage-header'),
          $menu = $(this).closest('.dropdown-menu'),
          $input = $('.taskboard-stage-rename-input', $menu),
          $title = $('.taskboard-stage-title', $header);

        $menu.toggleClass('is-edit');
        $input.val('').focus().val($title.html());
        e.stopPropagation();
      });

      $(document).on('click', '.taskboard-stage-rename-save', function() {
		var $header = $(this).closest('.taskboard-stage-header'),
		$input = $('.taskboard-stage-rename-input', $header),
		$title = $('.taskboard-stage-title', $header),
		value = $input.val();
		
		if (value.length === 0) return;
		
		$title.html(value);
			
		$.getJSON($(this).data('url')+'&name='+value , function(data) {
		  if(data.msg != 'suc'){
			self.jumpadmin();
		  }else{
		    self.alertify(data.suc);
		  }
		});  //
		$(this).closest('.dropdown').removeClass('open');
      });
    },
	
    //Task 搜索字段操作
    handleAddTask: function() {
      var self = this;

      $(document).on('click', '.add-item-toggle, .add-item-add, .add-item-cancel', function() {
        var $this = $(this),
          $wrap = $this.closest('.action-wrap'),
          $input = $('[name="name"]', $wrap);

        $wrap.toggleClass('action-open');
        if ($this.hasClass('add-item-toggle')) {
          $input.val('');
        }

        if ($this.hasClass('add-item-toggle')) {
          $(document).on('click.add-item', function(e) {
            var $target = $(e.target);
            if ($target.closest('.add-item-wrap').length === 0) {
                $wrap.removeClass('action-open');
                $(document).off('click.add-item');			  
            }
          });
        } else {
			$(document).off('click.add-item');
        }
      });

      $(document).on('click', '.add-item-add', function() {
        var $this = $(this),
          $wrap = $this.closest('.action-wrap'),
          $input = $('[name="name"]', $wrap),
          $list = $('.taskboard-list', $this.closest('.taskboard-stage-content')),
          hdata = self.dataTpl();
		
		$wrap.toggleClass('action-open');
		
        if ($input.val().length === 0) {
          return;
        }
		hdata.name = $input.val();
		
		$.getJSON($this.data('url')+"&name="+hdata.name , function(data) {
		  if(data.msg != 'suc'){
			self.jumpadmin();
		  }else{
			hdata.id = data.id;
			self.buildTask($list, hdata, true);
			$wrap.removeClass('action-open');
			$(document).off('click.add-item');
			self.alertify(data.suc);
		  }
		});
		
      });
    },

    handleDeleteTask: function() {
      $(document).on('click', '.taskboard-task-delete', function() {
        var $this = $(this);
        bootbox.dialog({
          message: "是否删除搜索字段",
          buttons: {
            success: {
              label: "删除",
              className: "btn-danger",
              callback: function() {
				$.getJSON($this.data('url'), function(data) {
				  if(data.msg != 'suc'){
					self.jumpadmin();
				  }else{
				    self.alertify(data.suc);
				  }
				});
                $this.closest('.list-group-item').remove();
              }
            }
          }
        });
      });
    },

    handleTaskInput: function() {
      var self = this;
      $(document).on('click', '.taskboard-list .checkbox-custom input', function(e) {
        var $this = $(this),
          $target = $this.closest('.list-group-item');

        self.dataChange($target, 'complete', $this.prop("checked"));
        e.stopPropagation();
      });
    },

    //Init SlidePanel //初始化搜索字段编辑页面
    handlSlidePanelPlugin: function() {
      if (typeof $.slidePanel === 'undefined') return;
      var self = this;
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
        afterLoad: function(object) {
		   var _this = this,
            $target = $(object.target),
            info = $target.data('taskInfo');
		   this.$panel.data('slidePanel', object);
        },
        afterShow: function() {
          var self = this;
          $(document).on('click.slidePanelShow', function(e) {
            if ($(e.target).closest('.slidePanel').length === 0 && $(e.target).closest('body').length === 1) {
              self.hide();
            }
          });
        },
        afterHide: function() {
          $(document).off('click.slidePanelShow');
          $(document).off('click.slidePanelDatepicker');
        },
        contentFilter: function(data, object) {
		
          var $target = $(object.target),
            info = $target.data('taskInfo'),
            $panel = $(data),
            $checked;

			$('.stage-name', $panel).html($('.taskboard-stage-title', self.getStage($target)).html());

          return $panel;
		 
        }
		
      });

      $(document).on('click', '[data-taskboard="slidePanel"]', function(e) {
		if($(e.target).html() == ''){
			return ;
		}
        var $target = $(e.target).closest('.list-group-item');
        $.slidePanel.show({
          url: $(this).data('url'),
          target: $target
        }, options);

        e.stopPropagation();
      });

      $(document).on('click', '#fileuploadToggle', function() {
        $('#fileupload').trigger('click');
      });
    },

    //SlidePanel Section Handle

    handleEditor: function() {
      var self = this;
      $(document).on('click', '.task-main-editor-save', function() {
	  
        var $this = $(this),
          $target = $this.closest('.slidePanel').data('slidePanel').target,
          data = $target.data('taskInfo'),
		  value = $('#task-name', $this.closest('.slidePanel')).val(),
		  $form = $('form', $this.closest('.slidePanel'));  
		$('.task-title', $target).html(value);
		$('.slidePanel-close').trigger('click');
		$.getJSON($form.attr('action') , $form.serialize(), function(data) {
		  if(data.msg != 'suc'){
			self.jumpadmin();
		  }else{
		    self.alertify(data.suc);
		  }
		});
      });
    },
	
    run: function(next) {
      var self = this;

      this.init();

      this.handleAddStage();
      this.handleDeleteStage();

      this.handleAddTask();
      this.handleDeleteTask();

      this.handleTaskInput();

      this.initStageDropdown();
      this.handleStageRename();

      //this.handleDatepicker();
      this.handlSlidePanelPlugin();

      this.handleEditor();
      //this.handleSubtasks();
      //this.handlePriority();


      next();
    }
  });

  $(document).ready(function() {
    AppTaskboard.run();
  });
})(document, window, jQuery);

