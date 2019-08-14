/**
 * eqShow - v3.1.5 - 2015-04-24
 *
 *
 * Copyright (c) 2015
 * Licensed MIT <>
 */
$.ajax({
	type: "GET",
	url: PREFIX_S2_URL + "?c=ad&a=logo",
	xhrFields: {
		withCredentials: !0
	},
	crossDomain: !0,
	success: function(a) {
		$("#bg").attr("src", a)
	},
	error: function() {
		$("#bg").attr("src", CLIENT_CDN + "images/index_08.gif")
	}
}), $.ajax({
	type: "GET",
	url: PREFIX_S1_URL + "?c=Sj&a=promotion&time=" + (new Date).getTime(),
	xhrFields: {
		withCredentials: !0
	},
	crossDomain: !0,
	dataType: "json",
	success: function(a) {
		var b = a.list,
			c = document.body.offsetWidth;
		$(b).each(function(a) {
			var c = $('<div class="list"/>'),
				d = $('<a target="_blank" href="' + PREFIX_S1_URL + "v-" + this.code + '" id="img_' + this.code + '"/>'),
				e = $('<div class="name" />').html(b[a].name);
			d.appendTo(c), e.appendTo(c), c.appendTo("#slider"), d.css("background-image", "url(" + PREFIX_FILE_HOST + this.image.imgSrc + ")")
		}), $(".list").css("float", "left"), $(".name").css("width", c / 2 - 20), $(".list a").css("display", "block"), $(".list a").css("width", c / 2 - 20), $(".list a").css("height", c / 2 - 20), $(".list a").css("background-size", "cover")
	}
}), $("nav img").click(function() {
	$("div.nav_list").toggle(), $("div.nav_list a").click(function() {
		$(".nav_list").hide()
	})
}), $(".login_register").click(function() {
	$(".login_contain").show(), $(".register_contain").hide()
}), $(".register_login").click(function() {
	$(".login_contain").hide(), $(".register_contain").show()
}), $("#create").click(function() {
	window.location.href = PREFIX_CLIENT_HOST + "/m/#/activity/singleScene/create"
});
var registering = !1;
$("#regBtn").click(function() {
	if ("" == $("#email").val().trim()) return alert("邮件不能为空！"), $("#email").focus(), !1;
	if ("" == $("#password").val().trim()) return alert("密码不能为空！"), $("#password").focus(), !1;
	var a = /^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/,
		b = $("#email").val();
	return a.test(b) ? /[A-Z]/g.test(b) ? ($("#email").val(b.toLowerCase()), alert("请用小写字母邮箱注册，已将邮箱中的大写字母自动转换成小写"), !1) : void(registering || (registering = !0, $.ajax({
		type: "POST",
		data: {
			email: $("#email").val(),
			password: $("#password").val()
		},
		url: PREFIX_SERVER_HOST + "?c=Sj&a=register",
		xhrFields: {
			withCredentials: !0
		},
		crossDomain: !0,
		dataType: "json",
		success: function(a) {
			registering = !1, a.success === !0 ? (sessionStorage.setItem("user", JSON.stringify(a)), window.location.href = "#") : alert(a.msg)
		}
	}))) : (alert("邮件格式不正确，请重新输入！"), $("#email").focus(), !1)
}), $("#logBtn").click(function() {
	if ("" == $("#log_email").val().trim()) return alert("请输入您的邮箱地址"), $("#log_email").focus(), !1;
	if ("" == $("#log_password").val().trim()) return alert("请输入密码"), $("#log_password").focus(), !1;
	var a = /^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/,
		b = $("#log_email").val();
	return a.test(b) ? void $.ajax({
		type: "POST",
		data: {
			username: $("#log_email").val(),
			password: $("#log_password").val()
		},
		url: PREFIX_SERVER_HOST + "?c=Sj&a=login",
		xhrFields: {
			withCredentials: !0
		},
		crossDomain: !0,
		dataType: "json",
		success: function(a) {
			a.success ? (alert("登录成功"), sessionStorage.setItem("user", JSON.stringify(a)), window.location.href = "#") : alert(a.msg)
		}
	}) : (alert("邮件格式不正确，请重新输入！"), $("#log_email").focus(), !1)
});