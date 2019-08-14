/**
 * promotion - v0.5.16 - 2016-06-13
 *
 *
 * Copyright (c) 2016
 * Licensed MIT <>
 */

function QR8bitByte(a) {
	this.mode = QRMode.MODE_8BIT_BYTE, this.data = a
}
function QRCode(a, b) {
	this.typeNumber = a, this.errorCorrectLevel = b, this.modules = null, this.moduleCount = 0, this.dataCache = null, this.dataList = new Array
}
function QRPolynomial(a, b) {
	if (void 0 == a.length) throw new Error(a.length + "/" + b);
	for (var c = 0; c < a.length && 0 == a[c];) c++;
	this.num = new Array(a.length - c + b);
	for (var d = 0; d < a.length - c; d++) this.num[d] = a[d + c]
}
function QRRSBlock(a, b) {
	this.totalCount = a, this.dataCount = b
}
function QRBitBuffer() {
	this.buffer = new Array, this.length = 0
}
function checkBrower() {
	var a = !0;
	return navigator.userAgent.indexOf("Safari") > 0 && navigator.userAgent.indexOf("Chrome") <= 0 ? a : void 0
}
function mobilecheck() {
	var a = !1;
	return function(b) {
		(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(b) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(b.substr(0, 4))) && (a = !0)
	}(navigator.userAgent || navigator.vendor || window.opera), a
}
function isWeixin() {
	var a = navigator.userAgent.toLowerCase();
	return "micromessenger" == a.match(/MicroMessenger/i) ? !0 : !1
}
function isAndroid() {
	var a = navigator.userAgent,
		b = (navigator.appVersion, a.indexOf("Android") > -1 || a.indexOf("Linux") > -1);
	return b
}
function tabletCheck() {
	var a = /ipad|android|android 3.0|xoom|sch-i800|playbook|tablet|kindle/i.test(navigator.userAgent.toLowerCase());
	return a
}
function countCharacters(a) {
	var b = 0;
	if (!a) return 0;
	for (var c = 0; c < a.length; c++) {
		var d = a.charCodeAt(c);
		d >= 1 && 126 >= d || d >= 65376 && 65439 >= d ? b++ : b += 2
	}
	return b
}!
function(a) {
	a.fn.qrcode = function(b) {
		"string" == typeof b && (b = {
			text: b
		}), b = a.extend({}, {
			render: "canvas",
			width: 256,
			height: 256,
			typeNumber: -1,
			correctLevel: QRErrorCorrectLevel.H,
			background: "#ffffff",
			foreground: "#000000"
		}, b);
		var c = function() {
				var a = new QRCode(b.typeNumber, b.correctLevel);
				a.addData(b.text), a.make();
				var c = document.createElement("canvas");
				c.width = b.width, c.height = b.height;
				for (var d = c.getContext("2d"), e = b.width / a.getModuleCount(), f = b.height / a.getModuleCount(), g = 0; g < a.getModuleCount(); g++) for (var h = 0; h < a.getModuleCount(); h++) {
					d.fillStyle = a.isDark(g, h) ? b.foreground : b.background;
					var i = Math.ceil((h + 1) * e) - Math.floor(h * e),
						j = Math.ceil((g + 1) * e) - Math.floor(g * e);
					d.fillRect(Math.round(h * e), Math.round(g * f), i, j)
				}
				return c
			},
			d = function() {
				var c = new QRCode(b.typeNumber, b.correctLevel);
				c.addData(b.text), c.make();
				for (var d = a("<table></table>").css("width", b.width + "px").css("height", b.height + "px").css("border", "0px").css("border-collapse", "collapse").css("background-color", b.background), e = b.width / c.getModuleCount(), f = b.height / c.getModuleCount(), g = 0; g < c.getModuleCount(); g++) for (var h = a("<tr></tr>").css("height", f + "px").appendTo(d), i = 0; i < c.getModuleCount(); i++) a("<td></td>").css("width", e + "px").css("background-color", c.isDark(g, i) ? b.foreground : b.background).appendTo(h);
				return d
			};
		return this.each(function() {
			var e = "canvas" == b.render ? c() : d();
			a(e).appendTo(this)
		})
	}
}(jQuery), QR8bitByte.prototype = {
	getLength: function(a) {
		return this.data.length
	},
	write: function(a) {
		for (var b = 0; b < this.data.length; b++) a.put(this.data.charCodeAt(b), 8)
	}
}, QRCode.prototype = {
	addData: function(a) {
		var b = new QR8bitByte(a);
		this.dataList.push(b), this.dataCache = null
	},
	isDark: function(a, b) {
		if (0 > a || this.moduleCount <= a || 0 > b || this.moduleCount <= b) throw new Error(a + "," + b);
		return this.modules[a][b]
	},
	getModuleCount: function() {
		return this.moduleCount
	},
	make: function() {
		if (this.typeNumber < 1) {
			var a = 1;
			for (a = 1; 40 > a; a++) {
				for (var b = QRRSBlock.getRSBlocks(a, this.errorCorrectLevel), c = new QRBitBuffer, d = 0, e = 0; e < b.length; e++) d += b[e].dataCount;
				for (var e = 0; e < this.dataList.length; e++) {
					var f = this.dataList[e];
					c.put(f.mode, 4), c.put(f.getLength(), QRUtil.getLengthInBits(f.mode, a)), f.write(c)
				}
				if (c.getLengthInBits() <= 8 * d) break
			}
			this.typeNumber = a
		}
		this.makeImpl(!1, this.getBestMaskPattern())
	},
	makeImpl: function(a, b) {
		this.moduleCount = 4 * this.typeNumber + 17, this.modules = new Array(this.moduleCount);
		for (var c = 0; c < this.moduleCount; c++) {
			this.modules[c] = new Array(this.moduleCount);
			for (var d = 0; d < this.moduleCount; d++) this.modules[c][d] = null
		}
		this.setupPositionProbePattern(0, 0), this.setupPositionProbePattern(this.moduleCount - 7, 0), this.setupPositionProbePattern(0, this.moduleCount - 7), this.setupPositionAdjustPattern(), this.setupTimingPattern(), this.setupTypeInfo(a, b), this.typeNumber >= 7 && this.setupTypeNumber(a), null == this.dataCache && (this.dataCache = QRCode.createData(this.typeNumber, this.errorCorrectLevel, this.dataList)), this.mapData(this.dataCache, b)
	},
	setupPositionProbePattern: function(a, b) {
		for (var c = -1; 7 >= c; c++) if (!(-1 >= a + c || this.moduleCount <= a + c)) for (var d = -1; 7 >= d; d++) - 1 >= b + d || this.moduleCount <= b + d || (c >= 0 && 6 >= c && (0 == d || 6 == d) || d >= 0 && 6 >= d && (0 == c || 6 == c) || c >= 2 && 4 >= c && d >= 2 && 4 >= d ? this.modules[a + c][b + d] = !0 : this.modules[a + c][b + d] = !1)
	},
	getBestMaskPattern: function() {
		for (var a = 0, b = 0, c = 0; 8 > c; c++) {
			this.makeImpl(!0, c);
			var d = QRUtil.getLostPoint(this);
			(0 == c || a > d) && (a = d, b = c)
		}
		return b
	},
	createMovieClip: function(a, b, c) {
		var d = a.createEmptyMovieClip(b, c),
			e = 1;
		this.make();
		for (var f = 0; f < this.modules.length; f++) for (var g = f * e, h = 0; h < this.modules[f].length; h++) {
			var i = h * e,
				j = this.modules[f][h];
			j && (d.beginFill(0, 100), d.moveTo(i, g), d.lineTo(i + e, g), d.lineTo(i + e, g + e), d.lineTo(i, g + e), d.endFill())
		}
		return d
	},
	setupTimingPattern: function() {
		for (var a = 8; a < this.moduleCount - 8; a++) null == this.modules[a][6] && (this.modules[a][6] = a % 2 == 0);
		for (var b = 8; b < this.moduleCount - 8; b++) null == this.modules[6][b] && (this.modules[6][b] = b % 2 == 0)
	},
	setupPositionAdjustPattern: function() {
		for (var a = QRUtil.getPatternPosition(this.typeNumber), b = 0; b < a.length; b++) for (var c = 0; c < a.length; c++) {
			var d = a[b],
				e = a[c];
			if (null == this.modules[d][e]) for (var f = -2; 2 >= f; f++) for (var g = -2; 2 >= g; g++) - 2 == f || 2 == f || -2 == g || 2 == g || 0 == f && 0 == g ? this.modules[d + f][e + g] = !0 : this.modules[d + f][e + g] = !1
		}
	},
	setupTypeNumber: function(a) {
		for (var b = QRUtil.getBCHTypeNumber(this.typeNumber), c = 0; 18 > c; c++) {
			var d = !a && 1 == (b >> c & 1);
			this.modules[Math.floor(c / 3)][c % 3 + this.moduleCount - 8 - 3] = d
		}
		for (var c = 0; 18 > c; c++) {
			var d = !a && 1 == (b >> c & 1);
			this.modules[c % 3 + this.moduleCount - 8 - 3][Math.floor(c / 3)] = d
		}
	},
	setupTypeInfo: function(a, b) {
		for (var c = this.errorCorrectLevel << 3 | b, d = QRUtil.getBCHTypeInfo(c), e = 0; 15 > e; e++) {
			var f = !a && 1 == (d >> e & 1);
			6 > e ? this.modules[e][8] = f : 8 > e ? this.modules[e + 1][8] = f : this.modules[this.moduleCount - 15 + e][8] = f
		}
		for (var e = 0; 15 > e; e++) {
			var f = !a && 1 == (d >> e & 1);
			8 > e ? this.modules[8][this.moduleCount - e - 1] = f : 9 > e ? this.modules[8][15 - e - 1 + 1] = f : this.modules[8][15 - e - 1] = f
		}
		this.modules[this.moduleCount - 8][8] = !a
	},
	mapData: function(a, b) {
		for (var c = -1, d = this.moduleCount - 1, e = 7, f = 0, g = this.moduleCount - 1; g > 0; g -= 2) for (6 == g && g--;;) {
			for (var h = 0; 2 > h; h++) if (null == this.modules[d][g - h]) {
				var i = !1;
				f < a.length && (i = 1 == (a[f] >>> e & 1));
				var j = QRUtil.getMask(b, d, g - h);
				j && (i = !i), this.modules[d][g - h] = i, e--, -1 == e && (f++, e = 7)
			}
			if (d += c, 0 > d || this.moduleCount <= d) {
				d -= c, c = -c;
				break
			}
		}
	}
}, QRCode.PAD0 = 236, QRCode.PAD1 = 17, QRCode.createData = function(a, b, c) {
	for (var d = QRRSBlock.getRSBlocks(a, b), e = new QRBitBuffer, f = 0; f < c.length; f++) {
		var g = c[f];
		e.put(g.mode, 4), e.put(g.getLength(), QRUtil.getLengthInBits(g.mode, a)), g.write(e)
	}
	for (var h = 0, f = 0; f < d.length; f++) h += d[f].dataCount;
	if (e.getLengthInBits() > 8 * h) throw new Error("code length overflow. (" + e.getLengthInBits() + ">" + 8 * h + ")");
	for (e.getLengthInBits() + 4 <= 8 * h && e.put(0, 4); e.getLengthInBits() % 8 != 0;) e.putBit(!1);
	for (;;) {
		if (e.getLengthInBits() >= 8 * h) break;
		if (e.put(QRCode.PAD0, 8), e.getLengthInBits() >= 8 * h) break;
		e.put(QRCode.PAD1, 8)
	}
	return QRCode.createBytes(e, d)
}, QRCode.createBytes = function(a, b) {
	for (var c = 0, d = 0, e = 0, f = new Array(b.length), g = new Array(b.length), h = 0; h < b.length; h++) {
		var i = b[h].dataCount,
			j = b[h].totalCount - i;
		d = Math.max(d, i), e = Math.max(e, j), f[h] = new Array(i);
		for (var k = 0; k < f[h].length; k++) f[h][k] = 255 & a.buffer[k + c];
		c += i;
		var l = QRUtil.getErrorCorrectPolynomial(j),
			m = new QRPolynomial(f[h], l.getLength() - 1),
			n = m.mod(l);
		g[h] = new Array(l.getLength() - 1);
		for (var k = 0; k < g[h].length; k++) {
			var o = k + n.getLength() - g[h].length;
			g[h][k] = o >= 0 ? n.get(o) : 0
		}
	}
	for (var p = 0, k = 0; k < b.length; k++) p += b[k].totalCount;
	for (var q = new Array(p), r = 0, k = 0; d > k; k++) for (var h = 0; h < b.length; h++) k < f[h].length && (q[r++] = f[h][k]);
	for (var k = 0; e > k; k++) for (var h = 0; h < b.length; h++) k < g[h].length && (q[r++] = g[h][k]);
	return q
};
for (var QRMode = {
	MODE_NUMBER: 1,
	MODE_ALPHA_NUM: 2,
	MODE_8BIT_BYTE: 4,
	MODE_KANJI: 8
}, QRErrorCorrectLevel = {
	L: 1,
	M: 0,
	Q: 3,
	H: 2
}, QRMaskPattern = {
	PATTERN000: 0,
	PATTERN001: 1,
	PATTERN010: 2,
	PATTERN011: 3,
	PATTERN100: 4,
	PATTERN101: 5,
	PATTERN110: 6,
	PATTERN111: 7
}, QRUtil = {
	PATTERN_POSITION_TABLE: [
		[],
		[6, 18],
		[6, 22],
		[6, 26],
		[6, 30],
		[6, 34],
		[6, 22, 38],
		[6, 24, 42],
		[6, 26, 46],
		[6, 28, 50],
		[6, 30, 54],
		[6, 32, 58],
		[6, 34, 62],
		[6, 26, 46, 66],
		[6, 26, 48, 70],
		[6, 26, 50, 74],
		[6, 30, 54, 78],
		[6, 30, 56, 82],
		[6, 30, 58, 86],
		[6, 34, 62, 90],
		[6, 28, 50, 72, 94],
		[6, 26, 50, 74, 98],
		[6, 30, 54, 78, 102],
		[6, 28, 54, 80, 106],
		[6, 32, 58, 84, 110],
		[6, 30, 58, 86, 114],
		[6, 34, 62, 90, 118],
		[6, 26, 50, 74, 98, 122],
		[6, 30, 54, 78, 102, 126],
		[6, 26, 52, 78, 104, 130],
		[6, 30, 56, 82, 108, 134],
		[6, 34, 60, 86, 112, 138],
		[6, 30, 58, 86, 114, 142],
		[6, 34, 62, 90, 118, 146],
		[6, 30, 54, 78, 102, 126, 150],
		[6, 24, 50, 76, 102, 128, 154],
		[6, 28, 54, 80, 106, 132, 158],
		[6, 32, 58, 84, 110, 136, 162],
		[6, 26, 54, 82, 110, 138, 166],
		[6, 30, 58, 86, 114, 142, 170]
	],
	G15: 1335,
	G18: 7973,
	G15_MASK: 21522,
	getBCHTypeInfo: function(a) {
		for (var b = a << 10; QRUtil.getBCHDigit(b) - QRUtil.getBCHDigit(QRUtil.G15) >= 0;) b ^= QRUtil.G15 << QRUtil.getBCHDigit(b) - QRUtil.getBCHDigit(QRUtil.G15);
		return (a << 10 | b) ^ QRUtil.G15_MASK
	},
	getBCHTypeNumber: function(a) {
		for (var b = a << 12; QRUtil.getBCHDigit(b) - QRUtil.getBCHDigit(QRUtil.G18) >= 0;) b ^= QRUtil.G18 << QRUtil.getBCHDigit(b) - QRUtil.getBCHDigit(QRUtil.G18);
		return a << 12 | b
	},
	getBCHDigit: function(a) {
		for (var b = 0; 0 != a;) b++, a >>>= 1;
		return b
	},
	getPatternPosition: function(a) {
		return QRUtil.PATTERN_POSITION_TABLE[a - 1]
	},
	getMask: function(a, b, c) {
		switch (a) {
		case QRMaskPattern.PATTERN000:
			return (b + c) % 2 == 0;
		case QRMaskPattern.PATTERN001:
			return b % 2 == 0;
		case QRMaskPattern.PATTERN010:
			return c % 3 == 0;
		case QRMaskPattern.PATTERN011:
			return (b + c) % 3 == 0;
		case QRMaskPattern.PATTERN100:
			return (Math.floor(b / 2) + Math.floor(c / 3)) % 2 == 0;
		case QRMaskPattern.PATTERN101:
			return b * c % 2 + b * c % 3 == 0;
		case QRMaskPattern.PATTERN110:
			return (b * c % 2 + b * c % 3) % 2 == 0;
		case QRMaskPattern.PATTERN111:
			return (b * c % 3 + (b + c) % 2) % 2 == 0;
		default:
			throw new Error("bad maskPattern:" + a)
		}
	},
	getErrorCorrectPolynomial: function(a) {
		for (var b = new QRPolynomial([1], 0), c = 0; a > c; c++) b = b.multiply(new QRPolynomial([1, QRMath.gexp(c)], 0));
		return b
	},
	getLengthInBits: function(a, b) {
		if (b >= 1 && 10 > b) switch (a) {
		case QRMode.MODE_NUMBER:
			return 10;
		case QRMode.MODE_ALPHA_NUM:
			return 9;
		case QRMode.MODE_8BIT_BYTE:
			return 8;
		case QRMode.MODE_KANJI:
			return 8;
		default:
			throw new Error("mode:" + a)
		} else if (27 > b) switch (a) {
		case QRMode.MODE_NUMBER:
			return 12;
		case QRMode.MODE_ALPHA_NUM:
			return 11;
		case QRMode.MODE_8BIT_BYTE:
			return 16;
		case QRMode.MODE_KANJI:
			return 10;
		default:
			throw new Error("mode:" + a)
		} else {
			if (!(41 > b)) throw new Error("type:" + b);
			switch (a) {
			case QRMode.MODE_NUMBER:
				return 14;
			case QRMode.MODE_ALPHA_NUM:
				return 13;
			case QRMode.MODE_8BIT_BYTE:
				return 16;
			case QRMode.MODE_KANJI:
				return 12;
			default:
				throw new Error("mode:" + a)
			}
		}
	},
	getLostPoint: function(a) {
		for (var b = a.getModuleCount(), c = 0, d = 0; b > d; d++) for (var e = 0; b > e; e++) {
			for (var f = 0, g = a.isDark(d, e), h = -1; 1 >= h; h++) if (!(0 > d + h || d + h >= b)) for (var i = -1; 1 >= i; i++) 0 > e + i || e + i >= b || (0 != h || 0 != i) && g == a.isDark(d + h, e + i) && f++;
			f > 5 && (c += 3 + f - 5)
		}
		for (var d = 0; b - 1 > d; d++) for (var e = 0; b - 1 > e; e++) {
			var j = 0;
			a.isDark(d, e) && j++, a.isDark(d + 1, e) && j++, a.isDark(d, e + 1) && j++, a.isDark(d + 1, e + 1) && j++, (0 == j || 4 == j) && (c += 3)
		}
		for (var d = 0; b > d; d++) for (var e = 0; b - 6 > e; e++) a.isDark(d, e) && !a.isDark(d, e + 1) && a.isDark(d, e + 2) && a.isDark(d, e + 3) && a.isDark(d, e + 4) && !a.isDark(d, e + 5) && a.isDark(d, e + 6) && (c += 40);
		for (var e = 0; b > e; e++) for (var d = 0; b - 6 > d; d++) a.isDark(d, e) && !a.isDark(d + 1, e) && a.isDark(d + 2, e) && a.isDark(d + 3, e) && a.isDark(d + 4, e) && !a.isDark(d + 5, e) && a.isDark(d + 6, e) && (c += 40);
		for (var k = 0, e = 0; b > e; e++) for (var d = 0; b > d; d++) a.isDark(d, e) && k++;
		var l = Math.abs(100 * k / b / b - 50) / 5;
		return c += 10 * l
	}
}, QRMath = {
	glog: function(a) {
		if (1 > a) throw new Error("glog(" + a + ")");
		return QRMath.LOG_TABLE[a]
	},
	gexp: function(a) {
		for (; 0 > a;) a += 255;
		for (; a >= 256;) a -= 255;
		return QRMath.EXP_TABLE[a]
	},
	EXP_TABLE: new Array(256),
	LOG_TABLE: new Array(256)
}, i = 0; 8 > i; i++) QRMath.EXP_TABLE[i] = 1 << i;
for (var i = 8; 256 > i; i++) QRMath.EXP_TABLE[i] = QRMath.EXP_TABLE[i - 4] ^ QRMath.EXP_TABLE[i - 5] ^ QRMath.EXP_TABLE[i - 6] ^ QRMath.EXP_TABLE[i - 8];
for (var i = 0; 255 > i; i++) QRMath.LOG_TABLE[QRMath.EXP_TABLE[i]] = i;
QRPolynomial.prototype = {
	get: function(a) {
		return this.num[a]
	},
	getLength: function() {
		return this.num.length
	},
	multiply: function(a) {
		for (var b = new Array(this.getLength() + a.getLength() - 1), c = 0; c < this.getLength(); c++) for (var d = 0; d < a.getLength(); d++) b[c + d] ^= QRMath.gexp(QRMath.glog(this.get(c)) + QRMath.glog(a.get(d)));
		return new QRPolynomial(b, 0)
	},
	mod: function(a) {
		if (this.getLength() - a.getLength() < 0) return this;
		for (var b = QRMath.glog(this.get(0)) - QRMath.glog(a.get(0)), c = new Array(this.getLength()), d = 0; d < this.getLength(); d++) c[d] = this.get(d);
		for (var d = 0; d < a.getLength(); d++) c[d] ^= QRMath.gexp(QRMath.glog(a.get(d)) + b);
		return new QRPolynomial(c, 0).mod(a)
	}
}, QRRSBlock.RS_BLOCK_TABLE = [
	[1, 26, 19],
	[1, 26, 16],
	[1, 26, 13],
	[1, 26, 9],
	[1, 44, 34],
	[1, 44, 28],
	[1, 44, 22],
	[1, 44, 16],
	[1, 70, 55],
	[1, 70, 44],
	[2, 35, 17],
	[2, 35, 13],
	[1, 100, 80],
	[2, 50, 32],
	[2, 50, 24],
	[4, 25, 9],
	[1, 134, 108],
	[2, 67, 43],
	[2, 33, 15, 2, 34, 16],
	[2, 33, 11, 2, 34, 12],
	[2, 86, 68],
	[4, 43, 27],
	[4, 43, 19],
	[4, 43, 15],
	[2, 98, 78],
	[4, 49, 31],
	[2, 32, 14, 4, 33, 15],
	[4, 39, 13, 1, 40, 14],
	[2, 121, 97],
	[2, 60, 38, 2, 61, 39],
	[4, 40, 18, 2, 41, 19],
	[4, 40, 14, 2, 41, 15],
	[2, 146, 116],
	[3, 58, 36, 2, 59, 37],
	[4, 36, 16, 4, 37, 17],
	[4, 36, 12, 4, 37, 13],
	[2, 86, 68, 2, 87, 69],
	[4, 69, 43, 1, 70, 44],
	[6, 43, 19, 2, 44, 20],
	[6, 43, 15, 2, 44, 16],
	[4, 101, 81],
	[1, 80, 50, 4, 81, 51],
	[4, 50, 22, 4, 51, 23],
	[3, 36, 12, 8, 37, 13],
	[2, 116, 92, 2, 117, 93],
	[6, 58, 36, 2, 59, 37],
	[4, 46, 20, 6, 47, 21],
	[7, 42, 14, 4, 43, 15],
	[4, 133, 107],
	[8, 59, 37, 1, 60, 38],
	[8, 44, 20, 4, 45, 21],
	[12, 33, 11, 4, 34, 12],
	[3, 145, 115, 1, 146, 116],
	[4, 64, 40, 5, 65, 41],
	[11, 36, 16, 5, 37, 17],
	[11, 36, 12, 5, 37, 13],
	[5, 109, 87, 1, 110, 88],
	[5, 65, 41, 5, 66, 42],
	[5, 54, 24, 7, 55, 25],
	[11, 36, 12],
	[5, 122, 98, 1, 123, 99],
	[7, 73, 45, 3, 74, 46],
	[15, 43, 19, 2, 44, 20],
	[3, 45, 15, 13, 46, 16],
	[1, 135, 107, 5, 136, 108],
	[10, 74, 46, 1, 75, 47],
	[1, 50, 22, 15, 51, 23],
	[2, 42, 14, 17, 43, 15],
	[5, 150, 120, 1, 151, 121],
	[9, 69, 43, 4, 70, 44],
	[17, 50, 22, 1, 51, 23],
	[2, 42, 14, 19, 43, 15],
	[3, 141, 113, 4, 142, 114],
	[3, 70, 44, 11, 71, 45],
	[17, 47, 21, 4, 48, 22],
	[9, 39, 13, 16, 40, 14],
	[3, 135, 107, 5, 136, 108],
	[3, 67, 41, 13, 68, 42],
	[15, 54, 24, 5, 55, 25],
	[15, 43, 15, 10, 44, 16],
	[4, 144, 116, 4, 145, 117],
	[17, 68, 42],
	[17, 50, 22, 6, 51, 23],
	[19, 46, 16, 6, 47, 17],
	[2, 139, 111, 7, 140, 112],
	[17, 74, 46],
	[7, 54, 24, 16, 55, 25],
	[34, 37, 13],
	[4, 151, 121, 5, 152, 122],
	[4, 75, 47, 14, 76, 48],
	[11, 54, 24, 14, 55, 25],
	[16, 45, 15, 14, 46, 16],
	[6, 147, 117, 4, 148, 118],
	[6, 73, 45, 14, 74, 46],
	[11, 54, 24, 16, 55, 25],
	[30, 46, 16, 2, 47, 17],
	[8, 132, 106, 4, 133, 107],
	[8, 75, 47, 13, 76, 48],
	[7, 54, 24, 22, 55, 25],
	[22, 45, 15, 13, 46, 16],
	[10, 142, 114, 2, 143, 115],
	[19, 74, 46, 4, 75, 47],
	[28, 50, 22, 6, 51, 23],
	[33, 46, 16, 4, 47, 17],
	[8, 152, 122, 4, 153, 123],
	[22, 73, 45, 3, 74, 46],
	[8, 53, 23, 26, 54, 24],
	[12, 45, 15, 28, 46, 16],
	[3, 147, 117, 10, 148, 118],
	[3, 73, 45, 23, 74, 46],
	[4, 54, 24, 31, 55, 25],
	[11, 45, 15, 31, 46, 16],
	[7, 146, 116, 7, 147, 117],
	[21, 73, 45, 7, 74, 46],
	[1, 53, 23, 37, 54, 24],
	[19, 45, 15, 26, 46, 16],
	[5, 145, 115, 10, 146, 116],
	[19, 75, 47, 10, 76, 48],
	[15, 54, 24, 25, 55, 25],
	[23, 45, 15, 25, 46, 16],
	[13, 145, 115, 3, 146, 116],
	[2, 74, 46, 29, 75, 47],
	[42, 54, 24, 1, 55, 25],
	[23, 45, 15, 28, 46, 16],
	[17, 145, 115],
	[10, 74, 46, 23, 75, 47],
	[10, 54, 24, 35, 55, 25],
	[19, 45, 15, 35, 46, 16],
	[17, 145, 115, 1, 146, 116],
	[14, 74, 46, 21, 75, 47],
	[29, 54, 24, 19, 55, 25],
	[11, 45, 15, 46, 46, 16],
	[13, 145, 115, 6, 146, 116],
	[14, 74, 46, 23, 75, 47],
	[44, 54, 24, 7, 55, 25],
	[59, 46, 16, 1, 47, 17],
	[12, 151, 121, 7, 152, 122],
	[12, 75, 47, 26, 76, 48],
	[39, 54, 24, 14, 55, 25],
	[22, 45, 15, 41, 46, 16],
	[6, 151, 121, 14, 152, 122],
	[6, 75, 47, 34, 76, 48],
	[46, 54, 24, 10, 55, 25],
	[2, 45, 15, 64, 46, 16],
	[17, 152, 122, 4, 153, 123],
	[29, 74, 46, 14, 75, 47],
	[49, 54, 24, 10, 55, 25],
	[24, 45, 15, 46, 46, 16],
	[4, 152, 122, 18, 153, 123],
	[13, 74, 46, 32, 75, 47],
	[48, 54, 24, 14, 55, 25],
	[42, 45, 15, 32, 46, 16],
	[20, 147, 117, 4, 148, 118],
	[40, 75, 47, 7, 76, 48],
	[43, 54, 24, 22, 55, 25],
	[10, 45, 15, 67, 46, 16],
	[19, 148, 118, 6, 149, 119],
	[18, 75, 47, 31, 76, 48],
	[34, 54, 24, 34, 55, 25],
	[20, 45, 15, 61, 46, 16]
], QRRSBlock.getRSBlocks = function(a, b) {
	var c = QRRSBlock.getRsBlockTable(a, b);
	if (void 0 == c) throw new Error("bad rs block @ typeNumber:" + a + "/errorCorrectLevel:" + b);
	for (var d = c.length / 3, e = new Array, f = 0; d > f; f++) for (var g = c[3 * f + 0], h = c[3 * f + 1], i = c[3 * f + 2], j = 0; g > j; j++) e.push(new QRRSBlock(h, i));
	return e
}, QRRSBlock.getRsBlockTable = function(a, b) {
	switch (b) {
	case QRErrorCorrectLevel.L:
		return QRRSBlock.RS_BLOCK_TABLE[4 * (a - 1) + 0];
	case QRErrorCorrectLevel.M:
		return QRRSBlock.RS_BLOCK_TABLE[4 * (a - 1) + 1];
	case QRErrorCorrectLevel.Q:
		return QRRSBlock.RS_BLOCK_TABLE[4 * (a - 1) + 2];
	case QRErrorCorrectLevel.H:
		return QRRSBlock.RS_BLOCK_TABLE[4 * (a - 1) + 3];
	default:
		return void 0
	}
}, QRBitBuffer.prototype = {
	get: function(a) {
		var b = Math.floor(a / 8);
		return 1 == (this.buffer[b] >>> 7 - a % 8 & 1)
	},
	put: function(a, b) {
		for (var c = 0; b > c; c++) this.putBit(1 == (a >>> b - c - 1 & 1))
	},
	getLengthInBits: function() {
		return this.length
	},
	putBit: function(a) {
		var b = Math.floor(this.length / 8);
		this.buffer.length <= b && this.buffer.push(0), a && (this.buffer[b] |= 128 >>> this.length % 8), this.length++
	}
};
var tplCount = 0;
angular.module("app", ["ngRoute", "spread", "ui.bootstrap", "ngSanitize", "ui.select", "main.data", "services.i18nNotifications", "services.httpRequestTracker", "services.config", "security.register.company", "security", "templates-app", "templates-common", "ui.sortable", "I18N.MESSAGES", "app.directives.notification", "common.directives.dropDown", "common.directives.scroll", "usercenter", "test", "eqxAuth"]), angular.module("app").config(["$routeProvider", "$locationProvider", "securityAuthorizationProvider", "uiSelectConfig", "$provide", "$httpProvider", "$tooltipProvider", "authServiceProvider", function(a, b, c, d, e, f, g, h) {
	h.setConfig({
		host: LOGIN_AUTH_HOST
	}), g.options({
		placement: "bottom",
		appendToBody: "true"
	}), d.theme = "bootstrap", a.when("/:tab/:sceneId", {
		feedBackUrl: "http://eqxiu.com/v/euMcJX7J",
		templateUrl: "spread/spread.tpl.html",
		controller: "SpreadCtrl",
		reloadOnSearch: !0,
		resolve: {
			authenticatedUser: c.requireAuthenticatedUser
		}
	}).when("/:tab/:sceneId/:subtab", {
		templateUrl: "spread/spread.tpl.html",
		controller: "SpreadCtrl",
		reloadOnSearch: !0,
		resolve: {
			authenticatedUser: c.requireAuthenticatedUser
		}
	}).when("/test", {
		feedBackUrl: "http://eqxiu.com/v/vk2Ucz15",
		templateUrl: "test/test.tpl.html"
	}).when("/404", {
		templateUrl: "test/test-scene.tpl.html",
		controller: "SpreadTestDetailCtrl"
	}).otherwise({
		redirectTo: "/404"
	}), b.html5Mode(!0)
}]), angular.module("app").run(["security", "$rootScope", "configService", function(a, b, c) {
	b.CLIENT_CDN = CLIENT_CDN, b.PREFIX_FILE_HOST = PREFIX_FILE_HOST, b.PREFIX_SERVER_HOST = PREFIX_URL, b.PREFIX_CLIENT_HOST = PREFIX_HOST, b.PREFIX_S3_URL = PREFIX_S3_URL, a.requestCurrentUser(), c.getLogo().then(function(a) {
		try {
			b.logoSrc = a.data
		} catch (c) {
			b.logoSrc = CLIENT_CDN + "assets/images/logo.png"
		}
	}, function() {
		b.logoSrc = CLIENT_CDN + "assets/images/logo.png"
	})
}]), angular.module("app").run(["security", "$rootScope", "configService", "$anchorScroll", "$location", "usercenterService", function(a, b) {
	b.CLIENT_CDN = CLIENT_CDN, b.PREFIX_FILE_HOST = PREFIX_FILE_HOST, b.PREFIX_SERVER_HOST = PREFIX_URL, b.PREFIX_CLIENT_HOST = PREFIX_HOST, b.PREFIX_S3_URL = PREFIX_S3_URL, b.PRINT_HOST_SERVER = PRINT_HOST_SERVER, b.PRINT_HOST_RESOURCE = PRINT_HOST_RESOURCE, b.PREFIX_ANALYSIS_HOST = PREFIX_ANALYSIS_HOST, a.requestCurrentUser();
	var c = $(document);
	b.load2 = function() {
		c.scroll(function() {
			s = c.scrollTop(), s > 100 ? $(".scroll").css("display", "block") : $(".scroll").css("display", "none")
		})
	}, b.appIconDown = !0, b.downApp = function() {
		b.appIconDown = !1
	}, b.closeDown = function() {
		b.appIconDown = !0
	}, b.goTop = function() {
		c.scrollTop(0)
	}, b.$on("$routeChangeSuccess", function(a, c) {
		c.$$route && (b.feedBackUrl = c.$$route.feedBackUrl)
	})
}]), angular.module("app").run(["$route", "$rootScope", "$location", function(a, b, c) {
	b.$on("$locationChangeStart", function() {
		b.branchid && c.search("branchid", b.branchid), $(".modal").remove(), $(".modal-backdrop").remove()
	});
	var d = c.path;
	c.path = function(e, f) {
		if (f === !1) var g = a.current,
			h = b.$on("$locationChangeSuccess", function() {
				a.current = g, h()
			});
		return d.apply(c, [e])
	}
}]), angular.module("app").controller("AppCtrl", ["SpreadService", "$window", "$scope", "$rootScope", "$location", "$route", "$modal", "security", "sceneService", "$routeParams", "$timeout", "i18nNotifications", "usercenterService", "thirdpartyService", "$modalStack", "authService", "$sce", function(a, b, c, d, e, f, g, h, i, j, k, l, m, n, o, p, q) {
	function r() {
		var a = !0;
		return navigator.userAgent.indexOf("Safari") > 0 && navigator.userAgent.indexOf("Chrome") <= 0 ? a : void 0
	}
	function s() {
		return sessionStorage.getItem("sysMsgHasRead")
	}
	function t(a, b, c, e) {
		m.getNewMessage(a, b, c, e).then(function(a) {
			e ? (d.sysMsgs = a.data.list, d.sysNewCount = a.data.map.count) : (d.newMsgs = a.data.list, d.newMsgCount = a.data.map.count > 9 ? "9+" : a.data.map.count)
		})
	}
	var u = "http://api.geetest.com/get.php?callback=initCaptcha&time=" + (new Date).getTime();
	c.validateCodeUrl = q.trustAsResourceUrl(u), r() && (c.isSafari = !0), c.copyUrl = function() {
		alert("该浏览器不支持复制，请手动选中、复制、粘贴")
	}, c.userXd = 0, c.getUserXd = function() {
		m.getUserXd().then(function(a) {
			c.userXd = a.data.obj || 0
		})
	}, c.$on("userXd", function() {
		c.getUserXd()
	}), c.buyXd = function() {
		g.open({
			windowClass: "console",
			templateUrl: "usercenter/buyXd.tpl.html",
			controller: "BuyXdController",
			resolve: {
				getUserXd: function() {
					return function() {
						c.getUserXd(), d.$broadcast("buyXd")
					}
				}
			}
		}).result.then(function() {}, function() {})
	}, d.buyXdQ = c.buyXd, c.openSysMsg = !1, c.openSysMsgDialog = !s(), c.closeSysMsgDialog = function() {
		c.openSysMsgDialog = !c.openSysMsgDialog, sessionStorage.setItem("sysMsgHasRead", "true")
	}, c.notifications = l, c.removeNotification = function(a) {
		l.remove(a)
	}, b.setValue = function(a) {
		c.thirdpartyLoginParam = a, c.$apply()
	}, c.$watch("thirdpartyLoginParam", function(a) {
		a && (a.state && /WECHAT_STATE/.test(a.state) ? n.weiChatLogin(a.code).then(function(a) {
			200 == a.data.code && (e.path("main"), h.setLoginSuccess(!0))
		}) : n.qqLogin(a.access_token, a.expires_in))
	}), c.$on("$locationChangeStart", function() {
		if ("/home/login" != e.path() || h.currentUser ? 0 !== e.path().indexOf("/home/register") || h.currentUser || h.showRegister(v) : h.showLogin(), h.isAuthenticated() && ("/home" == e.path() || "/home/login" == e.path()) && e.path("main"), e.search().resetToken) {
			var a = e.search().resetToken;
			p.showAuth({
				type: "reset",
				resetToken: a
			})
		}
		var b = o.getTop();
		b && o.dismiss(b.key)
	}), c.openLogin = function() {
		e.path("/home/login", !1)
	};
	var v;
	c.openRegister = function(a, b, c) {
		"user" === a && (d.regUserType = "regUser"), "company" === a && (d.regUserType = "companyUser", d.upgradNum = b), v = c, e.path("/home/register", !1)
	}, c.isAuthenticated = h.isAuthenticated, e.search().branchid && (d.branchid = e.search().branchid), d.sysMsgs = [], c.$on("minusCount", function() {
		t(1, 4, !0)
	}), c.$watch(function() {
		return h.currentUser
	}, function(a) {
		a && (c.user = a, d.user = a, c.userProperty = a, c.isEditor = h.isEditor(), d.isEditor = h.isEditor(), c.isAdvancedUser = h.isAdvancedUser(), d.isAdvancedUser = h.isAdvancedUser(), c.isVendorUser = h.isVendorUser(), d.isVendorUser = h.isVendorUser(), c.$broadcast("currentUser", a), h.isAuthenticated() && (("/home" == e.path() || "/home/login" == e.path()) && e.path("main"), c.getUserXd(), t(1, 4, !0, !0), t(1, 4, !0)))
	}, !0), c.showBoardsDropdown = function() {
		c.isProjectsDropdownVisible = !0
	}, c.hideBoardsDropdown = function() {
		c.isProjectsDropdownVisible = !1
	};
	var w = $(document);
	w.scroll(function() {
		var a = w.scrollTop();
		a > 180 ? $(".header-contain", w).addClass("head-shadow") : $(".header-contain", w).removeClass("head-shadow")
	}), c.$watch("branchid", function() {
		c.hideOpea = !! d.branchid
	}), c.openReg = function() {
		g.open({
			windowClass: "request_contain",
			templateUrl: "usercenter/request_reg.tpl.html",
			controller: "UsercenterrequestCtrl",
			resolve: {}
		}).result.then(function() {}, function() {})
	}, c.login = function() {
		h.showLogin()
	}, c.register = function() {
		h.showRegister()
	}, c.showToolBar = function() {
		return e.$$path.indexOf("/scene/create") < 0
	}, c.showPanel = function() {
		$("#helpPanel").stop().animate({
			right: "0"
		}, 500)
	}, c.hidePanel = function() {
		$("#helpPanel").stop().animate({
			right: "-120"
		}, 500)
	}, c.suggestionUrl = "http://bbs.eqxiu.com/forum.php?mod=forumdisplay&fid=45", c.feedbackUrl = "http://bbs.eqxiu.com/forum.php?mod=forumdisplay&fid=46", c.qqChatUrl = "http://shang.qq.com/wpa/qunwpa?idkey=4a2d63670009360b878aa9a1e1437ef4caec132f74a0e2c4df4a686168cc73dc", c.helpUrl = "http://bbs.eqxiu.com/forum.php", c.createSkillUrl = "http://bbs.eqxiu.com/forum.php?gid=37", c.safeApply = function(a) {
		var b = this.$root.$$phase;
		"$apply" == b || "$digest" == b ? a && "function" == typeof a && a() : this.$apply(a)
	}
}]).filter("fixnum", [function() {
	return function(a) {
		var b = a;
		return a >= 1e4 && 1e8 > a ? b = (a / 1e4).toFixed(1) + "万" : a >= 1e8 && (b = (a / 1e8).toFixed(1) + "亿"), b
	}
}]), angular.module("app").run(["$templateCache", function(a) {
	a.put("template/carousel/carousel.html", '<div ng-mouseenter="pause()" ng-mouseleave="play()" class="carousel" ng-swipe-right="prev()" ng-swipe-left="next()">\n    <ol class="carousel-indicators" ng-show="slides.length > 1">\n        <li ng-repeat="slide in slides track by $index" ng-class="{active: isActive(slide)}" ng-click="select(slide)"></li>\n    </ol>\n    <div class="carousel-inner" ng-transclude></div>\n    <a class="prev eqf-chevron-small-left" ng-click="prev()" ng-show="slides.length > 1"></a>\n    <a class="next eqf-chevron-small-right" ng-click="next()" ng-show="slides.length > 1"></a>\n</div>\n')
}]), angular.module("bindemail-dialog", []).controller("BindEmailDialogCtrl", ["$scope", function() {}]), angular.module("confirm-dialog", []).controller("ConfirmDialogCtrl", ["$scope", "confirmObj", function(a, b) {
	a.confirmObj = b, a.ok = function() {
		a.$close()
	}, a.cancel = function() {
		a.$dismiss()
	}
}]), angular.module("message-dialog", []).controller("MessageDialogCtrl", ["$scope", "msgObj", function(a, b) {
	a.msgObj = b, a.close = function() {
		a.$close()
	}, a.cancel = function() {
		a.$dismiss()
	}
}]), angular.module("main.data", []), angular.module("main.data").controller("CustomerCtrl", ["$rootScope", "$scope", "$route", "$location", "$timeout", "dataService", "$modal", "ModalService", "i18nNotifications", "security", function(a, b, c, d, e, f, g, h, i, j) {
	b.PREFIX_URL = PREFIX_URL, b.isActive = "customer", b.select = 0, b.showBranchSelect = !0;
	var k = a.branchid;
	b.toPage = 1, b.model = {}, b.dataShow = "message", f.getCustomDatas(k), b.$on("customDatas", function(a, c) {
		b.customCount = c
	}), b.customer = {
		group: null,
		origin: null
	}, b.branchEdit = !0, b.branchDelete = !0, b.branchExport = !0, e(function() {
		(21 == b.user.type || 51 == b.user.type) && (b.user.extPermi ? (/^([\d,]+,)?1(,[\d,]*)?$/.test(b.user.extPermi) ? b.branchEdit = !0 : b.branchEdit = !1, /^([\d,]+,)?2(,[\d,]*)?$/.test(b.user.extPermi) ? b.branchDelete = !0 : b.branchDelete = !1, /^([\d,]+,)?3(,[\d,]*)?$/.test(b.user.extPermi) ? b.branchExport = !0 : b.branchExport = !1) : (b.branchEdit = !1, b.branchDelete = !1, b.branchExport = !1))
	}, 100), b.downLoad = function(a, b) {
		var c;
		c = PREFIX_S3_URL + "index.php?c=custom&a=exp" + (k ? "?user=" + k : ""), b && (c += (/\?/.test(c) ? "&" : "?") + "origin=" + b), a && (c += (/\?/.test(c) ? "&" : "?") + "groupId=" + a), location.href = c
	}, b.staticFileds = [], b.staticFileds = [{
		id: "name",
		name: "姓名"
	}, {
		id: "mobile",
		name: "手机"
	}, {
		id: "email",
		name: "邮箱"
	}, {
		id: "sex",
		name: "性别"
	}, {
		id: "company",
		name: "公司"
	}, {
		id: "job",
		name: "职位"
	}, {
		id: "address",
		name: "地址"
	}, {
		id: "tel",
		name: "电话"
	}, {
		id: "website",
		name: "个人网站"
	}, {
		id: "qq",
		name: "QQ"
	}, {
		id: "weixin",
		name: "微信"
	}, {
		id: "remark",
		name: "其他"
	}], b.selectScene = function(a, c) {
		b.selectedSceneId = a, f.getSceneField(a).then(function(a) {
			b.fields = a.data.list, b.select = c, $(".list_attribute").html("拖拽到此处")
		})
	}, b.clickScene = function() {
		d.path("main")
	}, b.clickSpread = function() {
		d.path("main/spread")
	}, b.clickCustomer = function() {
		d.path("main/customer")
	}, b.editCustomer = function(a) {
		b.getDataDetail(a.id), b.editData = !0
	}, b.removeCustomer = function(a) {
		h.openConfirmDialog({
			msg: "确定删除此条数据?"
		}, function() {
			f.deleteDataById(a.id).then(function(a) {
				200 == a.data.code && i.pushForCurrentRoute("custom.data.delete", "notify.success"), 1 === b.customerDatas.length && b.model.currentPage > 1 ? b.getDataBySceneId(b.model.currentPage - 1, k, b.groupId, b.origin) : b.getDataBySceneId(b.model.currentPage, k, b.groupId, b.origin), f.getCustomDatas(k)
			})
		})
	}, b.addColor = function(a) {
		b.trIndex = a
	}, b.removeColor = function() {
		b.trIndex = -1
	}, b.totalItems = 0, b.model.currentPage = 0, b.toPage = "", b.pageChanged = function(a, c, d, e) {
		return 1 > a || a > b.totalItems / 10 + 1 ? void alert("此页超出范围") : (b.model.currentPage = a, void b.getDataBySceneId(a, c, d, e))
	}, b.getDataBySceneId = function(a, c, d, e) {
		a || (a = 1), d && (b.groupId = d), e && (b.origin = e), f.getAllData(a, c, d, e).then(function(a) {
			b.customerDatas = a.data.list, b.totalItems = a.data.map.count, b.model.currentPage = a.data.map.pageNo, b.toPage = "", b.totalNum = Math.ceil(b.totalItems / a.data.map.pageSize)
		})
	}, b.getDataBySceneId(1, k, null, null), b.editCustom = function(a) {
		d.path("/main/customer/" + a.id)
	};
	var l = function() {
			f.getDataMessage(k).then(function(a) {
				b.dataMessage = a.data.list
			})
		};
	l(), b.sceneLoad = function(a) {
		var b = PREFIX_S3_URL + "index.php??c=scenedata&a=excel&flag=noheader&id=" + a + (k ? "&user=" + k : "");
		location.href = b
	}, b.importDatas = function() {
		f.getPremergeScenes(k).then(function(a) {
			b.importDatas = a.data.list, a.data.list.length > 0 && b.selectScene(a.data.list[0].ID, 0)
		})
	}, b.associateData = {};
	var m = !0;
	if (b.confirm = function() {
		m ? jQuery.isEmptyObject(b.associateData, {}) ? (alert("请导入数据！"), m = !0) : (f.mergeSceneData(b.selectedSceneId, b.associateData).then(function() {
			alert("你已成功导入客户！"), c.reload()
		}, function() {}), m = !1) : alert("请不要重复提交！")
	}, b.importDatas(), b.isAllowedToAccessGrouping = j.isAllowToAccess(j.accessDef.GROUP_CUSTOMER), b.isAllowedToAccessGrouping) {
		b.allImages = {
			selected: !1
		}, b.selectAll = function() {
			for (var a = 0, c = b.customerDatas.length; c > a; a++) b.customerDatas[a].selected = b.allImages.selected
		}, b.selectCustomer = function(a) {
			a.selected || (b.allImages.selected = !1)
		}, b.groups = [], b.getGroups = function() {
			b.groups.length > 0 || f.getGroups(k).then(function(a) {
				b.groups = a.data.list
			}, function() {})
		}, b.getGroups(), b.getOrigins = function() {
			f.getOrigin(k).then(function(a) {
				b.origins = a.data.list
			}, function() {
				alert("服务器异常")
			})
		}, b.getOrigins(), b.addGroup = function() {
			g.open({
				windowClass: "group-console console",
				templateUrl: "main/console/group.tpl.html",
				controller: "AddGroupCtrl",
				resolve: {
					sceneCreat: function() {
						return {}
					}
				}
			}).result.then(function(a) {
				b.groups.push(a), q(), i.pushForCurrentRoute("group.create.success", "notify.success")
			}, function() {})
		};
		var n = [],
			o = [];
		b.assignGroup = function() {
			n = [], o = [];
			for (var a = 0, c = b.customerDatas.length; c > a; a++) b.customerDatas[a].selected && n.push(b.customerDatas[a].id);
			for (a = 0, c = b.groups.length; c > a; a++) b.groups[a].selected && o.push(b.groups[a].id);
			if (!n.length) return void alert("您还没有选择客户!");
			if (!o.length) return void alert("您还没有选择分组!");
			var d = {
				cIds: n,
				gIds: o
			};
			f.assignGroup(d).then(function(a) {
				a.data.success && (q(), b.allImages.selected = !1, p(), i.pushForCurrentRoute("data.assign.success", "notify.success"))
			}, function() {})
		}, b.deleteCustomer = function(a) {
			n = [];
			var c, d;
			if (a) c = {
				ids: a.id
			}, d = "确定删除此条数据?";
			else {
				for (var e = 0, g = b.customerDatas.length; g > e; e++) b.customerDatas[e].selected && n.push(b.customerDatas[e].id);
				if (!n.length) return void alert("您还没有选择客户!");
				c = {
					ids: n
				}, d = "确定删除此条数据?"
			}
			h.openConfirmDialog({
				msg: d
			}, function() {
				f.deleteCustomer(c).then(function(a) {
					a.data.success && (b.allImages.selected = !1, p(), q(), i.pushForCurrentRoute("data.delete.success", "notify.success"))
				}, function() {
					alert("服务器异常")
				})
			})
		}, b.deleteGroup = function(a, c) {
			h.openConfirmDialog({
				msg: "确定删除此分组?"
			}, function() {
				f.deleteGroup(a.id).then(function(a) {
					a.data.success && (b.groups.splice(c, 1), q(), i.pushForCurrentRoute("group.delete.success", "notify.success"))
				}, function() {
					alert("服务器异常")
				})
			})
		};
		var p = function() {
				1 === b.customerDatas.length && b.model.currentPage > 1 ? b.getDataBySceneId(b.model.currentPage - 1) : b.getDataBySceneId(b.model.currentPage)
			},
			q = function() {
				for (var a = 0, c = b.groups.length; c > a; a++) b.groups[a].selected = !1
			}
	}
	b.createData = function() {
		d.path("main/customer/create")
	}, b.sceneData = function() {
		b.dataShow = "dataIn"
	}, b.$watch("model.currentPage", function(a, c) {
		a && a != c && (b.model.toPage = a)
	}, !0)
}]).filter("propsFilter", function() {
	return function(a, b) {
		var c = [];
		if (angular.isArray(a)) {
			var d = Object.keys(b);
			a.forEach(function(a) {
				for (var e = !1, f = 0; f < d.length; f++) {
					var g = d[f],
						h = b[g].toLowerCase();
					if (-1 !== a[g].toString().toLowerCase().indexOf(h)) {
						e = !0;
						break
					}
				}
				e && c.push(a)
			})
		} else c = [];
		return c
	}
}), angular.module("app.spread.console", []).controller("ApplyConsoleCtrl", ["$scope", "$rootScope", "applyObj", "sceneSettingCache", "SpreadService", "pageTplService", function(a, b, c, d, e, f) {
	a.apply || (a.apply = {}), a.applyObj = c, 2 == c.type ? (a.title = "申请加入秀场", a.description = "申请加入易企秀官方秀场平台，获取更多朋友的关注", f.getTagSysListWithType().then(function(b) {
		var c = b.data.list || [];
		a.$watch("applyObj.sceneType", function(b) {
			b && (a.sceneTags = [], angular.forEach(c, function(c) {
				b == c.bizType && a.sceneTags.push(c)
			}))
		})
	})) : 1 == c.type ? (a.title = "申请成为样例", a.description = "申请易企秀官方推荐，成为其他用户创建场景的原型样例，还可以赚取秀点", 4 == b.user.type && d.sceneTplPricesPromise.then(function(b) {
		a.tplPrices = b.data.list || [], a.apply.tplObj = a.tplPrices[0]
	})) : 3 == c.type ? (a.title = "加入活动", a.description = "与其他高手过招，展示自我深厚的制作功力，有机会获得活动大奖", f.getPageTpls(c.value).then(function(b) {
		a.activityPageTpls = b.data.list || []
	})) : 4 == c.type && (a.title = "申请为企业样例");
	var g, h;
	a.apply = function() {
		if (2 == c.type) {
			if (!a.apply.showObj) return void(a.authError = "请先选择场景类型！");
			g = a.apply.showObj.id
		} else if (1 == c.type) g = 4 == b.user.type ? a.apply.tplObj.value : 0;
		else if (3 == c.type) if (0 === a.activityPageTpls.length) g = c.id;
		else {
			if (!i) return void(a.authError = "请先选择活动尾页！");
			g = c.id + "," + i
		}
		e.applyShareWay(c.sceneId, c.type, g)
	}, a.$on("apply.scene.share", function(b, c) {
		c.success ? a.$close({
			value: g,
			src: h
		}) : (alert(c.msg), a.$dismiss())
	});
	var i;
	a.selectActivePage = function(b) {
		$.each(a.activityPageTpls, function(a, b) {
			b.checked = !1
		}), b.checked = !0, i = b.id, b.properties && b.properties.thumbSrc && (h = b.properties.thumbSrc)
	}, a.cancel = function() {
		a.$dismiss()
	}
}]), angular.module("spread.share.dimainBind.guide", []), angular.module("spread.share.dimainBind.guide").controller("DomainGuideCtrl", ["$rootScope", "$scope", "SpreadService", "usercenterService", "i18nNotifications", function(a, b, c, d, e) {
	b.cancel = function() {
		b.$close()
	}
}]), angular.module("spread.share.guarantee", []), angular.module("spread.share.guarantee").controller("guaranteeApplyCtrl", ["$rootScope", "$scope", "$modal", "SpreadService", "guaranteeObj", "user", "i18nNotifications", "sceneService", "ModalService", function(a, b, c, d, e, f, g, h, i) {
	b.sceneId = e.sceneId, b.modal = {}, b.scene = {}, b.userType = f.type, b.getCurrentScene = function() {
		h.getSceneDetail(b.sceneId).then(function(a) {
			b.scene = a.data.obj
		})
	}, b.getCurrentScene(), b.openGuarantee = function(c, e) {
		e ? d.guaranteeApply(b.sceneId).then(function(c) {
			c.data.success ? (b.modal.status = 1, g.pushForCurrentRoute("spread.share.guaranteeSucc", "notify.success"), b.guaranteeDetail(), b.getCurrentScene(), a.$broadcast("guaranteeAplly")) : i.openMsgDialog({
				msg: c.data.msg
			})
		}) : d.guaranteeClose(b.sceneId).then(function(c) {
			c.data.success ? (b.modal.status = 2, g.pushForCurrentRoute("spread.share.guaranteeClose", "notify.success"), b.guaranteeDetail(), b.getCurrentScene(), a.$broadcast("guaranteeAplly")) : i.openMsgDialog({
				msg: c.data.msg
			})
		})
	}, b.guaranteeDetail = function() {
		d.guaranteeDetail().then(function(a) {
			a.data.success ? (b.modal.days = a.data.map.days || 0, b.modal.daysExt = a.data.map.daysExt || 0, b.modal.amount = a.data.map.amount || 0) : i.openMsgDialog({
				msg: a.data.msg
			})
		})
	}, b.guaranteeDetail(), b.buyGuarantee = function() {
		c.open({
			windowClass: "console six-contain",
			templateUrl: "spread/console/guarantee-buy.tpl.html",
			controller: "guaranteeBuyCtrl",
			scope: b,
			resolve: {}
		}).result.then(function() {
			b.guaranteeDetail()
		}, function() {})
	}, b.$on("buyGuarantee", function() {
		b.guaranteeDetail()
	}), b.$watch("scene", function() {
		0 === b.scene.staticStatus || 1 === b.scene.staticStatus ? b.modal.status = 1 : b.scene.staticStatus && 2 !== b.scene.staticStatus || (b.modal.status = 2)
	}, !0), b.cancel = function() {
		b.$dismiss(b.scene)
	}
}]), angular.module("spread.share.guarantee.buy", ["spread.share.guarantee", "spread.share.socialShare"]), angular.module("spread.share.guarantee.buy").controller("guaranteeBuyCtrl", ["$rootScope", "$scope", "SpreadService", "usercenterService", "i18nNotifications", function(a, b, c, d, e) {
	b.model = {}, b.model.buylay = null, b.userXd = 0, b.getUserXd = function() {
		d.getUserXd().then(function(a) {
			b.userXd = a.data.obj || 0
		})
	}, b.getUserXd(), b.$on("userXd", function() {
		b.getUserXd()
	}), b.guaranteeBuyLays = [{
		value: 1,
		name: "30次/100秀点",
		price: 100
	}, {
		value: 3,
		name: "90次/300秀点",
		price: 300
	}, {
		value: 6,
		name: "180次/600秀点",
		price: 600
	}, {
		value: 9,
		name: "270次/900秀点",
		price: 900
	}, {
		value: 12,
		name: "360次/1200秀点",
		price: 1200
	}], b.guaranteeBuyConfirm = function() {
		c.guaranteeBuy(b.model.buylay.value).then(function(c) {
			c.data.success ? (e.pushForCurrentRoute("spread.share.guaranteeBuyXd", "notify.success"), b.$dismiss(), a.$broadcast("buyGuarantee")) : "130001" == c.data.code && e.pushForCurrentRoute("spread.share.messagebuyxdless", "notify.success")
		})
	}, b.cancel = function() {
		b.$close()
	}
}]), angular.module("spread", ["app.directives.numChangeAnim", "spread.tab", "app.directives.qrcode", "app.directives.switchInput", "app.directives.copyButton", "app.spread.console", "services.i18nNotifications"]), angular.module("spread").controller("SpreadCtrl", ["$scope", "$rootScope", "$location", "$routeParams", "MineService", "sceneService", "dataService", "security", "ModalService", "i18nNotifications", "dataCacheService", "$modal", function(a, b, c, d, e, f, g, h, i, j, k, l) {
	function m() {
		a.sceneDetailPromise = f.getSceneDetail(a.sceneId, p), a.sceneDetailPromise.then(function(b) {
			a.scene = b.data.obj, a.url = a.selectedUrl = n + "/v/" + a.scene.code, a.urlVip = a.selectedUrlVip = o + "s/" + a.scene.code, a.scene.accessCode ? a.sceneStadus = "加密访问" : 1 == a.scene.status ? a.sceneStadus = "开放访问" : a.sceneStadus = "关闭访问", 1 == a.user.type ? a.previewUrl = PREFIX_HOST_ARRAY[Math.floor(11 * Math.random()) % 11] + "/v/" + a.scene.code : 2 != a.user.type && 21 != a.user.type || a.user.memberType ? 3 == a.user.type || 4 == a.user.type ? a.previewUrl = PREFIX_SERVICE_HOST + "/v/" + a.scene.code : 99 == a.user.type ? a.previewUrl = PREFIX_SHOW_HOST + "/v/" + a.scene.code : a.user.expiryTime && a.user.expiryTime < Date.now ? a.previewUrl = PREFIX_HOST_ARRAY[Math.floor(11 * Math.random()) % 11] + "/v/" + a.scene.code : a.previewUrl = PREFIX_COMPANY_HOST_ARRAY[Math.floor(2 * Math.random()) % 2] + "/v/" + a.scene.code : a.previewUrl = PREFIX_HOST_ARRAY[Math.floor(11 * Math.random()) % 11] + "/v/" + a.scene.code
		})
	}
	a.viewControl = {}, a.viewControl.tab = d.tab, a.viewControl.subtab = d.subtab, a.sceneId = d.sceneId;
	var n, o;
	a.scene = {};
	var p = b.branchid;
	a.$watch("user", function(a) {
		a && (b.user && b.user.domain ? (n = "http://" + b.user.domain, o = VIP_HOST) : (n = PREFIX_SHOW_HOST, o = VIP_HOST), m())
	}, !0), a.getMyScene = m, a.editScene = function(a) {
		return 1 == a.isExpedited ? void i.openMsgDialog({
			msg: "该场景已在加急审核中，暂时无法编辑场景，请耐心等待",
			btn: "确认"
		}, function() {}) : void(30 == a.bizType ? l.open({
			windowClass: "seven-contain",
			templateUrl: "main/mobileTansform.tpl.html"
		}).result.then(function() {
			window.open("/#/scene/create/" + a.id + "?pageId=1", "_self")
		}, function() {}) : window.open("/#/scene/create/" + a.id + "?pageId=1", "_self"))
	}, a.sceneSettings = function(a, b) {
		return 1 == b.isExpedited ? void i.openMsgDialog({
			msg: "该场景已在加急审核中，暂时无法设置场景，请耐心等待",
			btn: "确认"
		}, function() {}) : (a && a.stopPropagation(), void(30 == b.bizType ? l.open({
			windowClass: "seven-contain",
			templateUrl: "main/mobileTansform.tpl.html"
		}).result.then(function() {
			window.open("/#/scene/create/" + b.id + "?pageId=1&openSetting=show", "_self")
		}, function() {}) : window.open("/#/scene/create/" + b.id + "?pageId=1&openSetting=show", "_self")))
	}, a.viewScene = function(b) {
		return p ? void window.open(a.selectedUrl) : void(a.scene.publishTime ? a.scene.publishTime && a.scene.updateTime > a.scene.publishTime ? i.openConfirmDialog({
			msg: "场景有更新需要再次发布才能预览最新内容，坚持预览会看到修改之前的场景",
			confirmName: "发布",
			cancelName: "坚持预览"
		}, function() {
			a.publishScene(b, a.scene)
		}, function() {
			b && b.stopPropagation(), window.open(a.selectedUrl)
		}) : (b && b.stopPropagation(), window.open(a.selectedUrl)) : i.openConfirmDialog({
			msg: "尚未发布场景无法预览，请先发布",
			confirmName: "发布",
			cancelName: "取消"
		}, function() {
			a.publishScene(b, a.scene)
		}))
	}, a.publishScene = function(b, c, d) {
		if (b && b.stopPropagation(), !c.name) return void i.openMsgDialog({
			msg: "尚未设置标题，请设置后再执行此操作",
			btn: "去设置"
		}, function() {
			a.sceneSettings(b, c)
		});
		if (!d) var e = window.open();
		1 === c.staticStatus ? i.openConfirmDialog({
			msg: "场景已经静态化,发布后不能及时更新,确定更改吗",
			confirmName: "确定",
			cancelName: "取消"
		}, function() {
			f.publishScene(c.id, d).then(function(b) {
				b.data.success ? (k.clear("sceneList"), c.publishTime = (new Date).getTime(), d ? i.openMsgDialog({
					msg: '该场景已经提交审核，系统会尽快给出审核结果并以系统消息形式给出，请耐心等待<br /><a style="color:#08a1ef;" href="http://bbs.eqxiu.com/forum.php?mod=viewthread&tid=890&extra=page%3D1" target="_blank">了解审核规则</a>',
					btn: "关闭"
				}, function() {
					a.scene.isExpedited = "1", a.scene.status = "1"
				}) : e.location = a.selectedUrl) : d && i.openMsgDialog({
					msg: b.data.msg,
					btn: "关闭"
				})
			})
		}, function() {}) : f.publishScene(c.id, d).then(function(b) {
			b.data.success ? (k.clear("sceneList"), c.publishTime = (new Date).getTime(), d ? i.openMsgDialog({
				msg: '该场景已经提交审核，系统会尽快给出审核结果并以系统消息形式给出，请耐心等待<br /><a style="color:#08a1ef;" href="http://bbs.eqxiu.com/forum.php?mod=viewthread&tid=890&extra=page%3D1" target="_blank">了解审核规则</a>',
				btn: "关闭"
			}, function() {
				a.scene.isExpedited = "1", a.scene.status = "1"
			}) : e.location = a.selectedUrl) : d && i.openMsgDialog({
				msg: b.data.msg,
				btn: "关闭"
			})
		})
	}, a.showShare = function(b) {
		a.viewControl.tab = b, a.viewControl.subtab = "socialShare", c.path("share/" + d.sceneId + "/socialShare", !1)
	}, a.showStatistics = function(b) {
		a.viewControl.tab = b, a.viewControl.subtab = "summeryViewInfo", c.path("statistics/" + d.sceneId + "/summeryViewInfo", !1)
	}, a.dataCollect = function(b) {
		a.viewControl.tab = b, c.path("dataCollect/" + d.sceneId, !1)
	}, a.boardsCollect = function(b) {
		a.viewControl.tab = b, c.path("boardsCollect/" + d.sceneId, !1)
	}, a.openScene = function(b, c) {
		c ? f.openScene(a.scene.id).then(function(b) {
			b.data.success && (a.scene.status = 1)
		}) : f.closeScene(a.scene.id).then(function(b) {
			b.data.success && (a.scene.status = 2)
		})
	}, a.$on("guaranteeAplly", function() {
		m()
	}), a.$watch("scene", function() {
		1 === a.scene.staticStatus ? a.selectOpenUrl = a.selectedUrlVip : a.selectOpenUrl = a.selectedUrl
	})
}]), angular.module("spread.dataCollect", ["spread.dataCollect.serviceApply"]), angular.module("spread.dataCollect").controller("DataCollectCtrl", ["$rootScope", "$scope", "$timeout", "dataService", "ModalService", "i18nNotifications", "$modal", function(a, b, c, d, e, f, g) {
	function h(a, c, f) {
		d.getDataBySceneId(a, c, f, n).then(function(a) {
			if (!a.data.success) return void e.openMsgDialog({
				msg: a.data.msg
			});
			a.data.list.length > 0 && (m = a.data.list.shift().slice(1));
			for (var c = 0; c < a.data.list.length; c++) a.data.list[c].$$id = a.data.list[c][0], a.data.list[c].splice(0, 1);
			if (l.length < 1) for (c = 0; c < m.length; c++) l.push({
				title: m[c],
				selected: !1,
				id: c
			});
			if (b.dataShow.length > 0) for (b.dataShowList.length = 0, c = 0; c < b.dataShow.length; c++) for (var d = 0; d < b.dataHeaders.length; d++) b.dataShow[c].id == b.dataHeaders[d].id && (b.dataHeaders[d].selected = !0);
			else if (l.length > 0 && l.length < 8) for (c = 0; c < l.length; c++) l[c].selected = !0, isTimeColumnSelected = !0;
			else if (l.length > 7) for (var f = 0; 8 > f; f++) l[f].selected = !0;
			b.dataList = a.data.list, b.totalItems = a.data.map.count, b.page.currentPage = a.data.map.pageNo, b.toPage = a.data.map.pageNo, b.dataHeaders = l, k(), b.totalItems < 1e3 ? b.showUp = !1 : (b.showUp = !0, q())
		})
	}
	function j(a, c, e) {
		d.getBoardsBySceneId(a, c, e, n).then(function(a) {
			a.data.list.length > 0 && (m = a.data.list.shift().slice(1));
			for (var c = 0; c < a.data.list.length; c++) a.data.list[c].$$id = a.data.list[c][0], a.data.list[c].splice(0, 1);
			if (l.length < 1) for (c = 0; c < m.length; c++) l.push({
				title: m[c],
				selected: !1,
				id: c
			});
			if (b.dataShow.length > 0) for (b.dataShowList.length = 0, c = 0; c < b.dataShow.length; c++) for (var d = 0; d < b.dataHeaders.length; d++) b.dataShow[c].id == b.dataHeaders[d].id && (b.dataHeaders[d].selected = !0);
			else if (l.length > 0 && l.length < 4) for (c = 0; c < l.length; c++) l[c].selected = !0, isTimeColumnSelected = !0;
			else if (l.length > 3) for (var e = 0; 4 > e; e++) l[e].selected = !0;
			b.dataList = a.data.list, b.totalItems = a.data.map.count, b.page.currentPage = a.data.map.pageNo, b.toPage = a.data.map.pageNo, k(), b.dataHeaders = l, b.totalItems < 1e3 ? b.showUp = !1 : (b.showUp = !0, q())
		})
	}
	function k() {
		b.dataShow.length = 0;
		for (var a = 0; a < l.length; a++) l[a].selected && (b.dataShow.push({
			title: l[a].title,
			selected: !0,
			id: l[a].id
		}), b.dataContain = !0);
		if (b.dataShow.length < 1) b.dataShowList.length = 0;
		else for (var c = 0; c < b.dataList.length; c++) {
			var d = b.dataShowList[c] = [];
			for (d.push(b.dataList[c].$$id), d.$$id = d[0], d.splice(0, 1), a = 0; a < b.dataShow.length; a++) {
				var e = b.dataShow[a].id;
				d.push(b.dataList[c][e])
			}
		}
		0 === b.dataShow.length ? b.dataContain = !1 : 1 == b.dataShow.length ? b.tdW = "100%" : 2 == b.dataShow.length ? b.tdW = "50%" : 3 == b.dataShow.length ? b.tdW = "33.3%" : 4 == b.dataShow.length ? b.tdW = "25%" : 5 == b.dataShow.length ? b.tdW = "20%" : 6 == b.dataShow.length ? b.tdW = "16.5%" : 7 == b.dataShow.length && (b.tdW = "14.5%")
	}
	b.totalItems = 0, b.page = {
		currentPage: 1
	}, b.dataTable = "formData", b.toPage = "", b.dataList = [];
	var l = b.dataHeaders = [],
		m = [];
	b.dataShow = [], b.dataShowList = [];
	var n = a.branchid;
	b.downApp = function() {
		g.open({
			windowClass: "console",
			templateUrl: "main/downApp.tpl.html",
			backdrop: "static"
		}).result.then(function() {})
	}, b.selectHeader = function() {
		k()
	};
	var o = PREFIX_S3_URL + "index.php?c=scenedata&a=excel&flag=noheader&id=" + b.sceneId + (n ? "&user=" + n : ""),
		p = PREFIX_S3_URL + "index.php?c=scenedata&a=excel&id=" + b.sceneId + (n ? "&user=" + n : "");
	b.dataOutNoHeader = function() {
		location.href = o
	}, b.dataOutNoHeaderPage = function(a, c) {
		var d;
		d = o + (/\?/.test(o) ? "&" : "?") + "start=" + a + "&end=" + c, location.href = d, b.dataPageList = !1
	}, b.dataOutDirect = function() {
		location.href = p
	}, b.dataOutPage = function(a, c) {
		var d;
		d = p + (/\?/.test(p) ? "&" : "?") + "start=" + a + "&end=" + c, location.href = d, b.dataPageList = !1
	};
	var q = function() {
			b.dataPageNums = [], b.dataPageobg = {};
			for (var a = Math.ceil(b.totalItems / 10, 16), c = Math.ceil(a / 100, 16), d = 1; c + 1 > d; d++) b.start = 100 * (d - 1) + 1, b.end = 100 * d, d == c && (b.end = a), b.dataPageobg = {
				start: b.start,
				end: b.end
			}, b.dataPageNums.push(b.dataPageobg)
		};
	b.dataDelete = function() {
		var a, c;
		for (selectIds = [], i = 0; i < b.dataShowList.length; i++) b.dataShowList[i].selected && selectIds.push(b.dataShowList[i].$$id);
		return selectIds.length ? (a = {
			ids: selectIds
		}, c = "确认删除选中数据？", void e.openConfirmDialog({
			msg: c
		}, function() {
			"formData" == b.dataTable ? d.deleteDataBySceneId(b.sceneId, a).then(function(a) {
				200 == a.data.code && (f.pushForCurrentRoute("data.delete.success", "notify.success"), b.allSelect.selected = !1, h(b.sceneId, b.page.currentPage, 10))
			}) : d.deleteBoardsBySceneId(b.sceneId, a).then(function(a) {
				200 == a.data.code && (f.pushForCurrentRoute("data.delete.success", "notify.success"), b.allSelect.selected = !1, j(b.sceneId, b.page.currentPage, 10))
			})
		})) : void alert("您还没有选择数据")
	}, b.allSelect = {
		selected: !1
	}, b.selectAll = function() {
		for (var a = 0, c = b.dataShowList.length; c > a; a++) b.dataShowList[a].selected = b.allSelect.selected
	}, b.selectData = function(a) {
		a.selected || (b.allSelect.selected = !1)
	}, b.pageChanged = function(a) {
		return 1 > a || a > b.totalItems / 10 + 1 ? void alert("此页超出范围") : (b.allSelect.selected = !1, b.page.currentPage = a, void("formData" == b.dataTable ? h(b.sceneId, a, 10) : j(b.sceneId, a, 10)))
	}, h(b.sceneId, b.page.currentPage, 10), b.clickDown = function() {
		$(".origin-ul").css({
			height: "auto"
		})
	}, b.getFormData = function() {
		"formData" != b.dataTable && (p = PREFIX_S3_URL + "index.php?c=scenedata&a=excel&id=" + b.sceneId + (n ? "&user=" + n : ""), b.dataTable = "formData", b.page.currentPage = 1, b.dataShow = [], l = [], b.dataShowList = [], h(b.sceneId, b.page.currentPage, 10))
	}, b.getBoardsData = function() {
		if ("boardsData" != b.dataTable) {
			p = PREFIX_S3_URL + "m/scene/msg/excel?sceneId=" + b.sceneId + (n ? "&user=" + n : "");
			PREFIX_S3_URL + "m/scene/msg/excel/noheader?id=" + b.sceneId + (n ? "&user=" + n : "");
			b.dataTable = "boardsData", b.dataShow = [], b.page.currentPage = 1, l = [], b.dataShowList = [], j(b.sceneId, b.page.currentPage, 10)
		}
	}, b.openServiceApply = function() {
		g.open({
			windowClass: "console seven-contain",
			templateUrl: "spread/tab/subtab/other-service-apply.tpl.html",
			controller: "OtherServiceApply",
			scope: b,
			resolve: {
				res: function() {
					return {
						totalItems: b.totalItems,
						sceneInfo: {
							sceneId: b.scene.id,
							sceneName: b.scene.name,
							userId: b.user.id
						}
					}
				}
			}
		}).result.then(function() {}, function() {})
	}
}]), angular.module("spread.share", ["spread.share.subtab"]), angular.module("spread.share").controller("ShareCtrl", ["$rootScope", "$scope", "$routeParams", "$location", "security", function(a, b, c, d, e) {
	b.isDomainAccessable = e.isAllowToAccess(e.accessDef.ACCESS_DOMAIN_BIND), b.showSelectSubTab = function(a) {
		b.viewControl.subtab = a, d.path("share/" + b.sceneId + "/" + a, !1)
	}
}]), angular.module("spread.statistics", ["services.spread", "app.directives.numChangeAnim", "spread.statistics.summery", "spread.statistics.accessInfo", "spread.statistics.expandWebStatistics", "spread.statistics.interactiveStatistics", "spread.statistics.shareStatistics", "spread.statistics.userStatistics", "spread.statistics.pageStatistics", "spread.statistics.textMessageStatistics", "big.data.services", "statistics.test.data", "tencent.mta", "statistic.date.range"]), angular.module("spread.statistics").controller("StatisticsCtrl", ["$scope", "$location", "$routeParams", "sceneService", "SpreadService", "$rootScope", "MineService", "security", "$filter", "$modal", "bigDataService", "$document", "mtaService", "ModalService", "permissionService", "dataStoryService", function(a, b, c, d, e, f, g, h, i, j, k, l, m, n, o, p) {
	function q(a) {
		var b = new Date;
		return b.setDate(b.getDate() - a), i("date")(b, "yyyy-MM-dd")
	}
	a.PREFIX_FILE_HOST = PREFIX_FILE_HOST, a.PREFIX_CLIENT_HOST = PREFIX_HOST, a.PREFIX_SERVER_HOST = PREFIX_URL, a.sceneId = c.sceneId, a.viewControl.subtab || (c.subtab ? a.viewControl.subtab = c.subtab : a.viewControl.subtab = "summeryViewInfo"), a.switchIntoTab = function(c) {
		a.viewControl.subtab = c, b.path("statistics/" + a.sceneId + "/" + c, !1), l.scrollTop(0)
	}, a.navToAd = function() {
		a.viewControl.tab = "share", a.viewControl.subtab = "thirdWeb", b.path("share/" + c.sceneId + "/thirdWeb", !1)
	};
	var r = q(0),
		s = q(1),
		t = null;
	a.dateRange = {
		state: 0,
		type: k.type.SUMMERY,
		startTime: r,
		endTime: r
	}, a.switchToState = function(b, c, d) {
		switch (a.dateRange.state = b, b) {
		case 0:
			a.dateRange.startTime = t || r, a.dateRange.endTime = r;
			break;
		case 1:
			a.dateRange.startTime = a.dateRange.endTime = s;
			break;
		case 2:
			a.dateRange.startTime = q(8), a.dateRange.endTime = s;
			break;
		case 3:
		case 5:
			c || d ? (a.dateRange.startTime = c ? c : a.dateRange.startTime, a.dateRange.endTime = d ? d : a.dateRange.endTime) : (a.dateRange.startTime = q(16), a.dateRange.endTime = s);
			break;
		case 4:
			a.dateRange.startTime = a.dateRange.endTime = c
		}
		a.dateRange.type = b ? k.type.PERIOD : k.type.SUMMERY
	}, a.$watch("scene.createTime", function(b) {
		b && (t = i("date")(new Date(b), "yyyy-MM-dd"), a.dateRange.startTime = t)
	}), a.expandWebs = [], a.totalItems = 0, a.page = {
		currentPage: 1
	}, a.startDay = 0, a.dataPieChart = [], a.downApp = function() {
		j.open({
			windowClass: "console",
			templateUrl: "main/downApp.tpl.html"
		}).result.then(function() {})
	}, a.pageChanged = function(b) {
		return 1 > b || b > a.totalItems / 10 + 1 ? void alert("此页超出范围") : (a.pageData = a.mapOption.data.slice(10 * (b - 1), 10 * b - 1), void(a.currentPage = b))
	};
	var u = f.branchid;
	a.isAllowedToAccessExpandWebsite = h.isAllowToAccess(h.accessDef.EXPAND_WEBSITE), a.viewStyle = "line", a.dataLineChartDataOption = {
		data: [
			[],
			[]
		],
		xAxis: []
	}, a.dataMobileChartOption = {
		data: [
			[],
			[],
			[],
			[]
		],
		xAxis: []
	}, a.contentDataOption = {
		data: [
			[],
			[]
		],
		xAxis: []
	}, a.$on("scene.detail", function(b, c) {
		a.scene = c, a.scene && (101 == a.scene.type ? a.sceneType = "行业" : 102 == a.scene.type ? a.sceneType = "个人" : 103 == a.scene.type ? a.sceneType = "企业" : 104 == a.scene.type ? a.sceneType = "节假" : 105 == a.scene.type && (a.sceneType = "风格"))
	}), a.$on("scene.device", function(b, c) {
		return c ? void(0 === c.sum ? (a.sceneDeviceData = [], a.dataDeviceShow = !1) : (a.sceneDeviceData = c.device, a.dataDeviceShow = !0)) : (a.sceneDeviceData = [], void(a.dataDeviceShow = !1))
	}), a.$on("scene.data", function(b, c, d, e, f, g) {
		a.stats = c
	}), a.getAllStats = function(b, c, d) {
		a.model = {
			startTime: c,
			endTime: d
		}, e.getSceneData(b, c, d, u, a.expandId)
	}, a.$on("webs.update", function() {
		a.expandWebs = e.expandWebs
	}), a.viewExpandDetail = function(b, c) {
		a.selectIndex = c, a.expandId = b, a.model ? a.getAllStats(a.scene.id, a.model.startTime, a.model.endTime) : a.getAllStats(a.scene.id, -6, 1)
	}, c.sceneId && e.getWebList(c.sceneId, !0, u), a.isAllowedToAccessShareStatistic = !o.isCurrentUserAnyOf("个人账号", "服务商", "企业免费"), a.isAllowedToAccessDeviceStatistic = !o.isCurrentUserAnyOf("个人账号", "服务商"), a.isAllowedToAccessUVStatistic = !o.isCurrentUserAnyOf("个人账号", "服务商", "高级账号"), a.isAllowedToPageSpeed = o.isCurrentUserAnyOf("公共账号", "企业体验", "企业基础", "企业标准", "企业高级"), a.isAllowedToUserStatistic = o.isCurrentUserAnyOf("公共账号", "企业基础", "企业标准", "企业高级"), a.isAllowedToUserCompare = o.isCurrentUserAnyOf("公共账号", "企业标准", "企业高级"), a.isAllowedToUserPortrait = o.isCurrentUserAnyOf("公共账号", "企业标准", "企业高级"), a.isAllowedToMTADevice = o.isCurrentUserAnyOf("公共账号", "企业基础", "企业标准", "企业高级"), a.isAllowedToMTAOperator = o.isCurrentUserAnyOf("公共账号", "企业基础", "企业标准", "企业高级"), a.isAllowedToMTABrowser = o.isCurrentUserAnyOf("公共账号", "企业基础", "企业标准", "企业高级"), a.isAllowedToMTAPageDeepth = o.isCurrentUserAnyOf("公共账号", "企业标准", "企业高级"), a.isAllowedToDataStoryShareTrend = o.isCurrentUserAnyOf("公共账号", "企业基础", "企业标准", "企业高级"), a.isAllowedToDataStoryShareTo = o.isCurrentUserAnyOf("公共账号", "企业基础", "企业标准", "企业高级"), a.isAllowedToDataStoryVisitTime = o.isCurrentUserAnyOf("公共账号", "企业高级"), a.isAllowedToDataStoryDevice = o.isCurrentUserAnyOf("公共账号", "企业基础", "企业标准", "企业高级"), a.isAllowedToDataStoryUserPortrait = o.isCurrentUserAnyOf("公共账号", "企业标准", "企业高级"), a.isAllowedToDataStoryShareLevel = o.isCurrentUserAnyOf("公共账号", "企业高级"), a.isAllowdToPageDepth = o.isCurrentUserAnyOf("公共账号", "企业标准", "企业高级"), a.isMTAStatisticEnabled = !1, a.isDataStoryStatisticEnabled = !1, a.$watch("scene.thirdCode", function(b) {
		b = b || "", a.isMTAStatisticEnabled = f.branchid || -1 !== b.indexOf("1"), a.isDataStoryStatisticEnabled = f.branchid || -1 !== b.indexOf("2")
	}), a.enableMTAStatistic = function() {
		m.enableMTAStatistic(a.scene.id).then(function(b) {
			b.data.success ? n.openMsgDialog({
				msg: b.data.msg
			}, function() {
				a.getMyScene()
			}) : n.openMsgDialog({
				msg: b.data.msg
			})
		})
	}, a.enableDataStoryStatistic = function() {
		p.enableDataStoryStatistic(a.scene.id).then(function(b) {
			b.data.success ? n.openMsgDialog({
				msg: b.data.msg
			}, function() {
				a.getMyScene()
			}) : n.openMsgDialog({
				msg: b.data.msg
			})
		})
	}
}]).service("permissionService", ["security", function(a) {
	var b = {
		"个人账号": "个人账号",
		"公共账号": "公共账号",
		"高级账号": "高级账号",
		"服务商": "服务商",
		"企业免费": "企业免费",
		"企业体验": "企业体验",
		"企业基础": "企业基础",
		"企业标准": "企业标准",
		"企业高级": "企业高级"
	},
		c = {
			PERMISSIONS: b
		};
	return c.getCurrentUserType = function() {
		switch (a.currentUser.type) {
		case 1:
			return "个人账号";
		case 2:
		case 21:
			return this.getCurrentUserEnterpriseType();
		case 3:
			return "高级账号";
		case 4:
			return "服务商";
		case 5:
		case 51:
			return "公共账号"
		}
	}, c.getCurrentUserEnterpriseType = function() {
		switch (a.currentUser.memberType) {
		case 6:
			return "企业体验";
		case 7:
			return "企业基础";
		case 8:
			return "企业标准";
		case 9:
			return "企业高级";
		default:
			return "企业免费"
		}
	}, c.isCurrentUserAnyOf = function() {
		for (var a = [], b = 0; b < arguments.length; b++) a.push(arguments[b]);
		return -1 !== a.indexOf(c.getCurrentUserType())
	}, c.isCurrentUserPayed = function() {
		return c.isCurrentUserAnyOf("公共账号", "企业体验", "企业基础", "企业标准", "企业高级")
	}, c
}]).directive("thirdPartyNotEnabled", function() {
	return {
		template: '<div class="not-enabled">\n    <p class="img">\n        <img ng-src="{{noDataImg}}">\n    </p>\n    <p class="tip">尚未开启第三方统计</p>\n</div>',
		controller: ["$scope", function(a) {
			a.noDataImg = CLIENT_CDN + "assets/images/userdata.svg"
		}]
	}
}), angular.module("spread.statistics.accessInfo", ["statistic.scene.pv", "mta.operator.statistic", "mta.browser.statistic", "mta.client", "data.story.stay.time", "data.story.device"]).controller("AccessInfoCtrl", ["$scope", "$element", "$routeParams", "bigDataService", "testData", "dataStoryService", function(a, b, c, d, e, f) {
	a.summeryPVUV = {
		pv: 0,
		uv: 0,
		apv: 0,
		auv: 0,
		mpv: 0,
		muv: 0,
		mapv: 0,
		mauv: 0
	}, a.isAllowedToAccessUVStatistic || angular.extend(a.summeryPVUV, e.testUV), d.getSceneTotalPVUV(a.sceneId).then(function(b) {
		b.data.success && (a.summeryPVUV = b.data.obj, a.isAllowedToAccessUVStatistic || angular.extend(a.summeryPVUV, e.testUV))
	}), a.scenePVUV = [], a.summeryRegion = [], a.summeryDevice = {}, a.top10Device = [], a.$watch("dateRange", function(b) {
		b && (b.state && (1 === b.state || 4 === b.state ? d.getSceneHourList(a.sceneId, b.startTime).then(function(b) {
			b.data.success && (a.scenePVUV = b.data.obj)
		}) : d.getPVUVPeriod(a.sceneId, b.startTime, b.endTime).then(function(b) {
			b.data.success && (a.scenePVUV = b.data.obj)
		})), d.getSceneTotalRegion(a.sceneId, b.type, b.startTime, b.endTime).then(function(b) {
			b.data.success && (a.summeryRegion = b.data.obj)
		}), a.isAllowedToAccessDeviceStatistic ? (d.getSceneTotalPlatform(a.sceneId, b.type, b.startTime, b.endTime).then(function(b) {
			b.data.success && (a.summeryDevice = b.data.obj)
		}), d.getSceneTotalDevice(a.sceneId, b.type, b.startTime, b.endTime).then(function(b) {
			b.data.success && (a.top10Device = b.data.obj)
		})) : (a.summeryDevice = e.testSummeryDevice, a.top10Device = e.testTop10Device))
	}, !0), a.deviceProvider = "eqxiu", f.getDataStoryShareInfo(c.sceneId).then(function(b) {
		b.data.success && (a.dataStoryAccessInfo = b.data.map)
	})
}]).directive("accessInfo", [function() {
	return {
		replace: !0,
		templateUrl: "spread/tab/statistics/access-info.tpl.html",
		controller: "AccessInfoCtrl"
	}
}]), angular.module("data.story.brand", []).directive("storyBrand", [function() {
	return {
		template: '<div class="data-story-brand-chart full-size-chart"></div>',
		controller: ["$scope", "$element", "dataStoryBrandMockDataService", function(a, b, c) {
			function d(a) {
				a = a || {}, angular.forEach(a, function(a) {
					h.data.push(a.name), g.data.push({
						name: a.name,
						value: a.pv_rate,
						pv: a.pv
					})
				}), f.setOption(i)
			}
			var e = b.find(".data-story-brand-chart"),
				f = echarts.init(e.get(0), "eqxiu"),
				g = {
					name: "品牌",
					type: "bar",
					data: []
				},
				h = {
					name: "品牌",
					type: "category",
					data: []
				},
				i = {
					tooltip: {
						trigger: "axis",
						formatter: function(a) {
							return a = a[0], a.name + "：" + a.data.pv
						}
					},
					xAxis: [h],
					yAxis: [{
						name: "百分比%",
						type: "value"
					}],
					series: [g]
				};
			f.setOption(i), a.isAllowedToDataStoryDevice ? a.$watch("dataStoryAccessInfo.mobileBrandDist", function(a) {
				a && d(a)
			}) : d(c.mobileBrandDist)
		}]
	}
}]).service("dataStoryBrandMockDataService", function() {
	return {
		mobileBrandDist: [{
			pv_rate: 70.69,
			name: "苹果",
			total_rate: 31.65,
			pv: 8728
		}, {
			pv_rate: 9.85,
			name: "华为",
			total_rate: 12.14,
			pv: 1216
		}, {
			pv_rate: 6.81,
			name: "小米",
			total_rate: 12.55,
			pv: 841
		}, {
			pv_rate: 4.24,
			name: "三星",
			total_rate: 11.39,
			pv: 523
		}, {
			pv_rate: 1.51,
			name: "魅族",
			total_rate: 1.07,
			pv: 187
		}, {
			pv_rate: .94,
			name: "酷派",
			total_rate: 2.78,
			pv: 116
		}, {
			pv_rate: .78,
			name: "中兴",
			total_rate: 1.31,
			pv: 96
		}, {
			pv_rate: .75,
			name: "Vivo",
			total_rate: 6.14,
			pv: 92
		}, {
			pv_rate: .73,
			name: "佳通",
			total_rate: 1.63,
			pv: 90
		}, {
			pv_rate: .53,
			name: "HTC",
			total_rate: .74,
			pv: 65
		}, {
			pv_rate: 3.18,
			name: "其他",
			total_rate: 9.49,
			pv: 392
		}]
	}
}), angular.module("data.story.device", ["data.story.os", "data.story.brand", "data.story.network"]).directive("storyDevice", [function() {
	return {
		templateUrl: "spread/tab/statistics/components/data-story-device.tpl.html",
		controller: "DataStoryDeviceCtrl"
	}
}]).controller("DataStoryDeviceCtrl", ["$scope", function(a) {
	a.dataStoryDevice = "os"
}]), angular.module("data.story.network", []).directive("storyNetwork", [function() {
	return {
		template: '<div class="data-story-network-chart full-size-chart"></div>',
		controller: ["$scope", "$element", "dataStoryNetworkMockService", function(a, b, c) {
			function d(a) {
				a = a || {}, g.data = [{
					name: "WIFI",
					value: a.wifi || 0
				}, {
					name: "运营商",
					value: a.teleCom || 0
				}], f.setOption(h)
			}
			var e = b.find(".data-story-network-chart"),
				f = echarts.init(e.get(0), "eqxiu"),
				g = {
					name: "网络类型",
					type: "pie",
					radius: "55%",
					center: ["50%", "60%"],
					data: []
				},
				h = {
					tooltip: {
						trigger: "item",
						formatter: "{b} <br/> {c} ({d}%)"
					},
					legend: {
						orient: "vertical",
						x: "center",
						y: "top",
						data: ["WIFI", "运营商"]
					},
					calculable: !0,
					series: [g]
				};
			f.setOption(h), a.isAllowedToDataStoryDevice ? a.$watch("dataStoryAccessInfo.netType2count", function(a) {
				a && d(a)
			}) : d(c.netType2count)
		}]
	}
}]).service("dataStoryNetworkMockService", function() {
	return {
		netType2count: {
			wifi: 9504,
			other: 175,
			teleCom: 3157
		}
	}
}), angular.module("data.story.os", []).directive("storyOs", [function() {
	var a = {
		other: 0,
		pc: 0,
		mobile: 0
	},
		b = {
			other: 0,
			android: 0,
			iphone: 0
		};
	return {
		templateUrl: "spread/tab/statistics/components/data-story-os.tpl.html",
		controller: ["$scope", "dataStoryOsMockDataService", function(c, d) {
			function e(a, b) {
				a = a || {}, b = b || {};
				var d = a.pc || 0,
					e = a.mobile || 0,
					f = a.other || 0,
					g = d + e + f || 1;
				c.pcMobile2count = {
					pc: Math.floor(100 * d / g),
					mobile: Math.floor(100 * e / g)
				}, f = b.other || 0;
				var h = b.android || 0,
					i = b.iphone || 0;
				g = f + h + i || 1, c.terminal2count = {
					other: Math.floor(100 * f / g),
					android: Math.floor(100 * h / g),
					iphone: Math.floor(100 * i / g)
				}
			}
			c.pcMobile2count = a, c.terminal2count = b, c.isAllowedToDataStoryDevice ? c.$watch("dataStoryAccessInfo.pcMobile2count", function(a) {
				a && e(c.dataStoryAccessInfo.pcMobile2count, c.dataStoryAccessInfo.terminal2count)
			}) : e(d.pcMobile2count, d.terminal2count)
		}]
	}
}]).service("dataStoryOsMockDataService", function() {
	return {
		pcMobile2count: {
			other: 0,
			pc: 370,
			mobile: 12836
		},
		terminal2count: {
			other: 322,
			android: 3786,
			iphone: 8728
		}
	}
}), angular.module("data.story.share.channel", []).directive("storyShareChannel", [function() {
	var a = {},
		b = {
			"from=singlemessage": 797,
			none: 782,
			"from=mp": 1726,
			"from=groupmessage": 2666,
			"from=timeline": 6683
		},
		c = {
			other: 0,
			appMessage: 0,
			timeline: 0
		},
		d = {
			other: 0,
			appMessage: 549,
			timeline: 173
		};
	return {
		template: '<section class="data-story-channel-wechat-inner basic-chart"></section>\n<section class="data-story-channel-share-to basic-chart"></section>',
		scope: {
			shareTo: "=",
			fromTo: "=storyShareChannel"
		},
		controller: ["$scope", "$element", function(e, f) {
			e.shareTo = e.shareTo || c, e.fromTo = e.fromTo || a;
			var g = f.find(".data-story-channel-wechat-inner"),
				h = echarts.init(g.get(0), "eqxiu"),
				i = {
					name: "微信内来源",
					type: "pie",
					radius: "55%",
					center: ["50%", "60%"],
					data: []
				},
				j = {
					title: {
						text: "微信内来源",
						left: "center"
					},
					tooltip: {
						trigger: "item",
						formatter: "{b} <br/> {c} ({d}%)"
					},
					calculable: !0,
					legend: {
						orient: "vertical",
						x: "right",
						data: ["单人对话", "朋友圈", "微信群", "公众号文章", "其他"]
					},
					series: [i]
				};
			h.setOption(j), e.$watch("fromTo", function(a) {
				e.$parent.isAllowedToDataStoryShareTo || (a = b), a && (i.data = [{
					name: "单人对话",
					value: parseInt(a["from=singlemessage"] || 0, 10)
				}, {
					name: "朋友圈",
					value: parseInt(a["from=timeline"] || 0, 10)
				}, {
					name: "微信群",
					value: parseInt(a["from=groupmessage"] || 0, 10)
				}, {
					name: "公众号文章",
					value: parseInt(a["from=mp"] || 0, 10)
				}, {
					name: "其他",
					value: parseInt(a.none || 0, 10)
				}], h.clear(), h.setOption(j))
			}, !0);
			var k = f.find(".data-story-channel-share-to"),
				l = echarts.init(k.get(0), "eqxiu"),
				m = {
					name: "微信内分享去向",
					type: "pie",
					radius: "55%",
					center: ["50%", "60%"],
					data: []
				},
				n = {
					title: {
						text: "分享去向",
						left: "center"
					},
					tooltip: {
						trigger: "item",
						formatter: "{b} <br/> {c} ({d}%)"
					},
					calculable: !0,
					legend: {
						orient: "vertical",
						x: "right",
						data: ["对话框", "朋友圈", "其他"]
					},
					series: [m]
				};
			l.setOption(n), e.$watch("shareTo", function(a) {
				e.$parent.isAllowedToDataStoryShareTo || (a = d), a && (m.data = [{
					name: "对话框",
					value: parseInt(a.appMessage || 0, 10)
				}, {
					name: "朋友圈",
					value: parseInt(a.timeline || 0, 10)
				}, {
					name: "其他",
					value: parseInt(a.other || 0, 10)
				}], l.clear(), l.setOption(n))
			}, !0)
		}]
	}
}]), angular.module("data.story.share.level", []).directive("storyShareLevel", [function() {
	var a = {
		stat: {
			size: 0
		}
	},
		b = {
			level_4: {
				share: 171,
				uv: 1254,
				pv: 2503
			},
			level_3: {
				share: 99,
				uv: 1163,
				pv: 2387
			},
			level_6: {
				share: 76,
				uv: 402,
				pv: 839
			},
			level_5: {
				share: 152,
				uv: 754,
				pv: 1456
			},
			level_8: {
				share: 33,
				uv: 180,
				pv: 352
			},
			level_7: {
				share: 52,
				uv: 265,
				pv: 503
			},
			level_9: {
				share: 35,
				uv: 152,
				pv: 304
			},
			level_0: {
				share: 0,
				uv: 386,
				pv: 823
			},
			stat: {
				size: 10
			},
			level_2: {
				share: 79,
				uv: 557,
				pv: 1223
			},
			level_1: {
				share: 28,
				uv: 74,
				pv: 186
			}
		},
		c = ["传播源", "第一层", "第二层", "第三层", "第四层", "第五层", "第六层", "第七层", "第八层", "其他层"];
	return {
		template: '<div class="share-level-chart basic-chart"></div>',
		scope: {
			shareLevels: "=storyShareLevel"
		},
		controller: ["$scope", "$element", function(d, e) {
			d.shareLevels = d.shareLevels || a;
			var f = e.find(".share-level-chart"),
				g = echarts.init(f.get(0), "eqxiu"),
				h = {
					type: "category",
					data: []
				},
				i = {
					name: "PV",
					type: "bar",
					data: []
				},
				j = {
					name: "UV",
					type: "bar",
					data: []
				},
				k = {
					name: "分享",
					type: "bar",
					data: []
				},
				l = {
					tooltip: {
						trigger: "axis"
					},
					legend: {
						data: ["分享", "PV", "UV"]
					},
					xAxis: [h],
					yAxis: [{
						type: "value",
						name: "次数"
					}],
					series: [k, i, j]
				};
			g.setOption(l), d.$watch("shareLevels", function(a) {
				if (d.$parent.isAllowedToDataStoryShareLevel || (a = b), a) {
					var e = 0;
					if (a.stat && a.stat.size) {
						a.stat.size > c.length ? (h.data = c, e = c.length - 1) : (h.data = c.slice(0, a.stat.size), e = a.stat.size - 1), k.data = [], i.data = [], j.data = [];
						var f = /level_(\d+)/;
						angular.forEach(a, function(a, b) {
							if (f.test(b)) {
								var c = parseInt(f.exec(b)[1], 10);
								if (e > c) k.data[c] = a.share, i.data[c] = a.pv, j.data[c] = a.uv;
								else {
									var d = k.data[e] || {
										share: 0,
										pv: 0,
										uv: 0
									};
									k.data[e] = d.share + a.share, i.data[e] = d.pv + a.pv, j.data[e] = d.uv + a.uv
								}
							}
						}), g.clear(), g.setOption(l)
					}
				}
			}, !0)
		}]
	}
}]), angular.module("data.story.share.statistic", ["data.story.service", "data.story.share.level", "data.story.share.channel"]).directive("storyShareTrend", ["dataStoryService", "$routeParams", "mockDataStoryShareService", function(a, b, c) {
	return {
		template: '<div class="data-story-share-trend basic-chart"></div><div class="data-story-total-share">微信总分享次数&nbsp;&nbsp;{{dataStoryShareInfo.uvpvipCount.total[3] || \'0\'}}次</div>',
		controller: ["$scope", "$element", "dateFilter", function(d, e, f) {
			function g(a) {
				k.data = [], j.data = [], angular.forEach(a.shareTrend, function(b, c) {
					k.data.push(b.time), j.data.push({
						name: b.time,
						value: a.shareTrend[c].num
					})
				}), i.setOption(l)
			}
			var h = e.find(".data-story-share-trend"),
				i = echarts.init(h.get(0), "eqxiu"),
				j = {
					name: "分享",
					type: "line",
					data: []
				},
				k = {
					type: "category",
					data: []
				},
				l = {
					tooltip: {
						trigger: "axis"
					},
					legend: {
						data: ["分享"]
					},
					xAxis: [k],
					yAxis: [{
						name: "次数",
						type: "value"
					}],
					series: [j]
				};
			i.setOption(l), d.$watch("dateRange", function(e) {
				if (e) {
					if (!d.isAllowedToDataStoryShareTrend) return void g(1 === e.state ? c.getDataStoryHoursShare() : c.getDataStoryDailyShare(e));
					1 === e.state ? a.getDataStoryDailyShare(b.sceneId, e.startTime.replace(/-/g, "")).then(function(a) {
						a.data.success && "success" === a.data.map.state && g(a.data.map.data)
					}) : a.getDataStoryDailyShare(b.sceneId, e.startTime.replace(/-/g, ""), e.endTime.replace(/-/g, "")).then(function(a) {
						a.data.success && "success" === a.data.map.state && g(a.data.map.data)
					})
				}
			}, !0)
		}]
	}
}]).service("mockDataStoryShareService", ["bigDataService", function(a) {
	function b(b) {
		var c = [];
		return a.dateAxisRange(b.startTime, b.endTime, function(a) {
			c.push({
				num: Math.floor(100 * Math.random() + 10),
				time: a
			})
		}), {
			shareTrend: c
		}
	}
	function c() {
		var b = [];
		return a.hourAxisRange(function(a) {
			b.push({
				num: Math.floor(40 * Math.random() + 10),
				time: a
			})
		}), {
			shareTrend: b
		}
	}
	return {
		getDataStoryDailyShare: b,
		getDataStoryHoursShare: c
	}
}]), angular.module("data.story.stay.time", []).directive("storyVisitTime", [function() {
	return {
		template: '<div class="basic-chart data-story-stay-time-chart"></div>',
		scope: {
			visitTimeDist: "=storyVisitTime"
		},
		controller: "StoryVisitTimeCtrl"
	}
}]).controller("StoryVisitTimeCtrl", ["$scope", "$element", "bigDataService", "dataStoryVisitTimeMockDataService", function(a, b, c, d) {
	function e(a) {
		a = a || {}, h = 0, i.data = [], c.hourAxisRange(function(b) {
			var c = a[b] || 0;
			i.data.push({
				name: b,
				value: c
			}), h += c
		}), h = h || 1, angular.forEach(i.data, function(a) {
			a.count = a.value, a.value = parseFloat((100 * a.value / h).toFixed(2))
		}), g.setOption(k)
	}
	var f = b.find(".data-story-stay-time-chart"),
		g = echarts.init(f.get(0), "eqxiu"),
		h = 0,
		i = {
			name: "小时",
			type: "line",
			data: []
		},
		j = {
			name: "小时",
			type: "category",
			data: c.hourAxisRange()
		},
		k = {
			tooltip: {
				trigger: "axis",
				formatter: function(a) {
					return a = a[0], a.name + "点：" + a.data.count + " 占比：" + a.value + "%"
				}
			},
			legend: {
				data: ["访问时间"]
			},
			xAxis: [j],
			yAxis: [{
				name: "百分比%",
				type: "value"
			}],
			series: [i]
		};
	g.setOption(k), a.$parent.isAllowedToDataStoryVisitTime ? a.$watch("visitTimeDist", function(a) {
		e(a)
	}) : e(d.visitTimeDist)
}]).service("dataStoryVisitTimeMockDataService", [function() {
	return {
		visitTimeDist: {
			"08": 1172,
			"09": 1467,
			19: 372,
			22: 532,
			17: 486,
			"04": 60,
			23: 561,
			18: 395,
			"05": 34,
			"06": 204,
			15: 538,
			"07": 560,
			16: 429,
			"00": 871,
			13: 693,
			"01": 407,
			14: 676,
			11: 965,
			"02": 98,
			"03": 52,
			12: 594,
			21: 407,
			20: 429,
			10: 1201
		}
	}
}]), angular.module("data.story.user.portrait", []).directive("storyUserPortrait", [function() {
	return {
		templateUrl: "spread/tab/statistics/components/data-story-user-portrait.tpl.html",
		controller: "DataStoryUserPortraitCtrl"
	}
}]).controller("DataStoryUserPortraitCtrl", ["$scope", "dataStoryUserPortraitMockDataService", function(a, b) {
	function c(a) {
		d(a);
		var b = {
			0: "assets/images/interests/house.png",
			1: "assets/images/interests/travel.png",
			2: "assets/images/interests/eat.png",
			3: "assets/images/interests/users.png",
			4: "assets/images/interests/it.png",
			5: "assets/images/interests/phone.png",
			6: "assets/images/interests/finance.png",
			7: "assets/images/interests/fly.png",
			8: "assets/images/interests/health.png",
			9: "assets/images/interests/beauty.png",
			10: "assets/images/interests/buy.png",
			11: "assets/images/interests/sofa.png",
			12: "assets/images/interests/car.png",
			13: "assets/images/interests/milk.png",
			14: "assets/images/interests/flower.png",
			15: "assets/images/interests/game.png",
			16: "assets/images/interests/bell.png",
			17: "assets/images/interests/pet.png",
			18: "assets/images/interests/dancer.png",
			19: "assets/images/interests/music.png",
			20: "assets/images/interests/play.png",
			21: "assets/images/interests/sport.png",
			22: "assets/images/interests/camera.png",
			23: "assets/images/interests/stars.png",
			24: "assets/images/interests/book.png"
		},
			c = {
				0: "访客关注房屋装修、室内设计等话题",
				1: "访客关注旅行、酒店宾馆、户外、自驾游等话题",
				2: "访客关注食品、餐饮、酒水等话题",
				3: "访客关注招聘、求职、创业等话题",
				4: "访客关注互联网、软件、编程等话题",
				5: "访客关注手机、相机、电脑、宽带、手机套餐等话题",
				6: "访客关注银行、信用卡、金融投资、股票等话题",
				7: "访客关注ktv、桑拿、棋牌、网咖等话题",
				8: "访客关注养生、保健等话题",
				9: "访客关注整容、整形、美容、美发、美甲、护肤、化妆等话题",
				10: "访客关注促销、购物、网购、减价、折扣等话题",
				11: "访客关注家居、家具、生活日用品等话题",
				12: "访客关注汽车、4s店、汽车养护等话题",
				13: "访客关注母婴、奶粉、孕妇等话题",
				14: "暂未上线",
				15: "访客关注网游、手游、游戏机类等话题",
				16: "暂未上线",
				17: "访客关注宠物、兽医、宠物美容等话题",
				18: "暂未上线",
				19: "访客关注音乐培训、音乐演奏、歌手等话题",
				20: "访客关注电影、综艺节目、卫视等话题",
				21: "访客关注瑜伽、球类、跑步、体育等话题",
				22: "访客关注相机、婚纱摄影、艺术照、写真等话题",
				23: "访客关注星座、风水类话题",
				24: "访客关注书籍、报纸、书店类话题"
			};
		a = a.business;
		var e, f = void 0 === a ? 0 : a.length;
		if (0 !== f) {
			e = {
				chart: {
					type: "line"
				},
				credits: {
					enabled: !1
				},
				legend: {
					enabled: !1
				},
				title: {
					text: "偏向性(TGI)",
					align: "left",
					style: {
						fontSize: "14px"
					}
				},
				tooltip: {
					formatter: function() {
						return "TGI:" + this.point.y + "<br>" + this.x + ":" + c[this.point.no]
					}
				},
				xAxis: {
					categories: [],
					tickWidth: 0
				},
				yAxis: {
					title: {
						text: null
					},
					min: 0,
					plotBands: [{
						from: 0,
						to: 100,
						color: "#FBFBFB"
					}]
				},
				series: [{
					name: "标签",
					data: []
				}]
			};
			for (var g = 0; g < a.length; g++) e.xAxis.categories.push(a[g].cate), Math.round(a[g].weights) < 100 ? e.series[0].data.push({
				no: a[g].no,
				y: Math.round(a[g].weights),
				symbol: b[a[g].no].substring(0, b[a[g].no].length - 4) + "light.png",
				marker: {
					symbol: "url(" + b[a[g].no].substring(0, b[a[g].no].length - 4) + "_light.png)"
				}
			}) : e.series[0].data.push({
				no: a[g].no,
				y: Math.round(a[g].weights),
				symbol: b[a[g].no],
				marker: {
					symbol: "url(" + b[a[g].no] + ")"
				}
			});
			$("#interest_box").highcharts(e)
		} else $("#interest_box").css({
			height: "300px",
			"line-height": "300px"
		}).append('<div class="text-center"><span style="font-size: 16px;">访客信息不足，暂无法分析用户标签</span></div>')
	}
	function d(b) {
		var c = b.visitorSex || {},
			d = c.m || 0,
			e = c.f || 0,
			f = d + e || 1;
		a.visitorSex = {
			male: Math.floor(100 * d / f),
			female: Math.floor(100 * e / f)
		}
	}
	a.isAllowedToDataStoryUserPortrait ? a.$watch("dataStoryAccessInfo.business", function(b) {
		c(b ? a.dataStoryAccessInfo : {
			visitorSex: {},
			business: []
		})
	}) : c(b)
}]), angular.module("statistic.date.range", ["third.party.analysis.config"]).directive("dateRange", ["dateFilter", function(a) {
	return {
		templateUrl: "spread/tab/statistics/components/date-range.tpl.html",
		replace: !0,
		controller: ["$scope", "$element", "$document", function(b, c, d) {
			function e() {
				var a = d.scrollTop(),
					b = $(".sys-contain").height() || 0,
					e = $(".info-show").height() || 0;
				a > b + e + 30 ? c.addClass("fixed") : c.removeClass("fixed")
			}
			b.dateOptions = {
				formatYear: "yy",
				startingDay: 1
			}, b.today = new Date, b.selectedDate = {
				startDate: b.today,
				endDate: b.today
			}, b.open = function(a) {
				a.preventDefault(), a.stopPropagation(), b.dateRange && (b.selectedDate.startDate = b.dateRange.startTime ? new Date(b.dateRange.startTime) : b.today, b.selectedDate.endDate = b.dateRange.endTime ? new Date(b.dateRange.endTime) : b.today), b.opened = !0
			}, b.selectStartDate = function() {
				b.selectedDate.startDate.getTime() <= b.selectedDate.endDate.getTime() && b.switchToState(5, a(b.selectedDate.startDate, "yyyy-MM-dd"), null)
			}, b.selectEndDate = function() {
				b.selectedDate.startDate.getTime() <= b.selectedDate.endDate.getTime() && b.switchToState(5, null, a(b.selectedDate.endDate, "yyyy-MM-dd"))
			}, d.scroll(e), b.$on("$destroy", function() {
				d.unbind("scroll", e)
			})
		}]
	}
}]), angular.module("mta.area.chart", []).directive("mtaAreaChart", ["mtaProvinces", function(a) {
	return {
		controller: ["$scope", "$element", "mtaProvinceConvert", function(b, c, d) {
			var e = echarts.init(c.get(0), "eqxiu"),
				f = {
					name: "访问地域",
					type: "map",
					mapType: "china",
					data: [],
					label: {
						normal: {
							show: !1,
							formatter: "{b}"
						},
						emphasis: {
							show: !1
						}
					},
					itemStyle: {
						normal: {
							areaColor: "rgb(187, 232, 252)",
							borderColor: "#fff",
							borderWidth: 1
						},
						emphasis: {
							areaColor: "rgb(89, 199, 249)"
						}
					},
					zlevel: 1
				},
				g = {
					tooltip: {
						trigger: "item",
						formatter: function(a) {
							return a.name + "<br/>" + (a.value || 0)
						}
					},
					visualMap: {
						show: !1,
						min: 0,
						max: 10,
						x: "50",
						y: "bottom",
						text: ["高", "低"],
						calculable: !0,
						inRange: {
							color: ["rgb(187, 232, 252)", "rgb(2, 119, 189)"]
						}
					},
					series: [f]
				};
			e.setOption(g), b.provinceTableDatas = [], b.provinceChart = [], b.$watch("provinces", function(c) {
				if (c) {
					b.provinceTableDatas = [], b.provinceChart = [];
					var d = 0;
					angular.forEach(c, function(c, e) {
						var g = {
							area_id: e,
							area_name: a[e],
							visitor_speed: 0
						},
							h = 0;
						angular.forEach(c, function(a) {
							g.visitor_speed += parseFloat(a.visitor_speed), h++
						}), h = h || 1, g.visitor_speed = parseFloat((g.visitor_speed / h).toFixed(2)), b.provinceTableDatas.push(g), b.provinceChart.push({
							name: g.area_name,
							value: g.visitor_speed
						}), f.data = b.provinceChart, d = d > g.visitor_speed ? d : g.visitor_speed
					}), g.visualMap.max = d || 1, e.setOption(g)
				}
			})
		}]
	}
}]).directive("mtaAreaDetail", ["$routeParams", "mtaService", "bigDataService", "mtaProvinces", function(a, b, c, d) {
	return function(a, b) {
		var e = echarts.init(b.get(0), "eqxiu"),
			f = d[a.currentProvinceId],
			g = {
				type: "category",
				data: []
			},
			h = {
				name: f + "访问延时",
				type: "line",
				data: []
			},
			i = {
				tooltip: {
					trigger: "axis"
				},
				legend: {
					data: [f + "访问延时"]
				},
				xAxis: [g],
				yAxis: [{
					type: "value",
					name: "延时(秒)"
				}],
				series: [h]
			};
		e.setOption(i), a.$watch("provinces", function(b) {
			var d = b[a.currentProvinceId];
			b && d && (g.data = [], h.data = [], c.dateAxisRange(a.dateRange.startTime, a.dateRange.endTime, function(a) {
				var b = a.replace(/-/g, ""),
					c = d[b];
				c ? (g.data.push(a), h.data.push(parseFloat(c.visitor_speed))) : (g.data.push(a), h.data.push(0))
			}), e.setOption(i))
		})
	}
}]), angular.module("mta.browser.statistic", []).directive("mtaBrowser", function() {
	return {
		templateUrl: "spread/tab/statistics/components/mta-browser.tpl.html",
		controller: ["$routeParams", "$scope", "$element", "mtaService", "mockMTAClientPara", function(a, b, c, d, e) {
			function f(a) {
				b.mtaBrowserDetails = a, angular.forEach(a, function(a) {
					h.data.push(a.client_name), i.data.push(angular.extend({}, a, {
						value: a[b.browserIdx]
					}))
				}), g.clear(), g.setOption(j)
			}
			b.browserIdx = "pv";
			var g = echarts.init(c.find(".mta-operator-container").get(0), "eqxiu"),
				h = {
					type: "category",
					data: []
				},
				i = {
					name: "浏览量",
					type: "bar",
					data: []
				},
				j = {
					tooltip: {
						trigger: "axis"
					},
					legend: {
						data: []
					},
					xAxis: [h],
					yAxis: [{
						type: "value",
						name: "次数"
					}],
					series: [i]
				};
			g.setOption(j), b.mtaBrowserDetails = [], b.$watch("dateRange", function(c) {
				c && (h.data = [], i.data = [], b.mtaBrowserDetails = [], b.isAllowedToMTABrowser ? d.getClientPara(a.sceneId, c.startTime, c.endTime, null).then(function(a) {
					a.data.success && a.data.map && !a.data.map.code && f(a.data.map.data)
				}) : f(e.getClientPara("1")))
			}, !0), b.$watch("browserIdx", function(a) {
				a && j.series.length && (angular.forEach(i.data, function(b) {
					b.value = b[a]
				}), g.setOption(j))
			})
		}]
	}
}), angular.module("mta.client", []).directive("mtaClient", function() {
	return {
		templateUrl: "spread/tab/statistics/components/mta-client.tpl.html",
		controller: ["$routeParams", "$scope", "$element", "mtaService", "mockMTAClientPara", function(a, b, c, d, e) {
			function f() {
				l || (l = !0, b.isAllowedToMTADevice ? d.getClientPara(a.sceneId, b.dateRange.startTime, b.dateRange.endTime, null, b.paraId).then(function(a) {
					a.data.success && a.data.map && !a.data.map.code && g(a.data.map.data), l = !1
				}) : (g(e.getClientPara(b.paraId)), l = !1))
			}
			function g(a) {
				i.data = [], j.data = [], b.mtaClientDetails = a, angular.forEach(a, function(a) {
					i.data.push(a.client_name), j.data.push(angular.extend({}, a, {
						value: a[b.browserIdx]
					}))
				}), h.clear(), h.setOption(k)
			}
			b.browserIdx = "pv", b.paraId = "2";
			var h = echarts.init(c.find(".mta-operator-container").get(0), "eqxiu"),
				i = {
					type: "category",
					data: []
				},
				j = {
					name: "浏览量",
					type: "bar",
					data: []
				},
				k = {
					tooltip: {
						trigger: "axis"
					},
					legend: {
						data: []
					},
					xAxis: [i],
					yAxis: [{
						type: "value",
						name: "次数"
					}],
					series: [j]
				};
			h.setOption(k), b.$watch("browserIdx", function(a) {
				a && k.series.length && (angular.forEach(j.data, function(b) {
					b.value = b[a]
				}), h.setOption(k))
			}), b.$watch("dateRange", function(a) {
				a && b.paraId && f()
			}, !0), b.$watch("paraId", function(a) {
				b.dateRange && a && f()
			});
			var l = !1;
			b.mtaClientDetails = []
		}]
	}
}).service("mockMTAClientPara", function() {
	var a = {
		1: {
			Chrome: {
				pv: 776,
				client: "Chrome",
				client_name: "Chrome",
				uv: 117,
				vv: 445,
				iv: 87
			},
			Gecko: {
				pv: 178,
				client: "Gecko",
				client_name: "Gecko",
				uv: 58,
				vv: 156,
				iv: 28
			},
			QQBrowser: {
				pv: 97,
				client: "QQBrowser",
				client_name: "QQ浏览器",
				uv: 14,
				vv: 93,
				iv: 9
			},
			Safari: {
				pv: 96,
				client: "Safari",
				client_name: "内置浏览器及Safari",
				uv: 20,
				vv: 40,
				iv: 13
			},
			Firefox: {
				pv: 18,
				client: "Firefox",
				client_name: "Firefox",
				uv: 4,
				vv: 9,
				iv: 4
			},
			others: {
				pv: 2,
				client: "others",
				client_name: "others",
				uv: 1,
				vv: 2,
				iv: 1
			}
		},
		2: {
			iOS: {
				pv: 272,
				client: "iOS",
				client_name: "iOS",
				uv: 74,
				vv: 193,
				iv: 35
			},
			Win7: {
				pv: 267,
				client: "Win7",
				client_name: "Win7",
				uv: 32,
				vv: 155,
				iv: 27
			},
			Win10: {
				pv: 246,
				client: "Win10",
				client_name: "Win10",
				uv: 38,
				vv: 119,
				iv: 26
			},
			Android: {
				pv: 186,
				client: "Android",
				client_name: "Android",
				uv: 33,
				vv: 176,
				iv: 23
			},
			MAC: {
				pv: 118,
				client: "MAC",
				client_name: "MAC",
				uv: 23,
				vv: 59,
				iv: 16
			},
			others: {
				pv: 76,
				client: "others",
				client_name: "others",
				uv: 12,
				vv: 44,
				iv: 10
			},
			Symbian: {
				pv: 2,
				client: "Symbian",
				client_name: "Symbian",
				uv: 1,
				vv: 2,
				iv: 1
			}
		},
		4: {
			"1920x1080": {
				pv: 296,
				client: "1920x1080",
				client_name: "1920x1080",
				uv: 40,
				vv: 147,
				iv: 30
			},
			"1366x768": {
				pv: 229,
				client: "1366x768",
				client_name: "1366x768",
				uv: 29,
				vv: 120,
				iv: 28
			},
			"667x375": {
				pv: 137,
				client: "667x375",
				client_name: "667x375",
				uv: 41,
				vv: 99,
				iv: 19
			},
			"736x414": {
				pv: 88,
				client: "736x414",
				client_name: "736x414",
				uv: 23,
				vv: 69,
				iv: 17
			},
			"1440x900": {
				pv: 84,
				client: "1440x900",
				client_name: "1440x900",
				uv: 16,
				vv: 42,
				iv: 10
			},
			"640x360": {
				pv: 72,
				client: "640x360",
				client_name: "640x360",
				uv: 18,
				vv: 69,
				iv: 15
			},
			"604x360": {
				pv: 69,
				client: "604x360",
				client_name: "604x360",
				uv: 9,
				vv: 68,
				iv: 9
			},
			"1280x720": {
				pv: 59,
				client: "1280x720",
				client_name: "1280x720",
				uv: 12,
				vv: 48,
				iv: 8
			},
			"1600x900": {
				pv: 27,
				client: "1600x900",
				client_name: "1600x900",
				uv: 11,
				vv: 16,
				iv: 7
			},
			"699x393": {
				pv: 26,
				client: "699x393",
				client_name: "699x393",
				uv: 4,
				vv: 26,
				iv: 2
			},
			"568x320": {
				pv: 21,
				client: "568x320",
				client_name: "568x320",
				uv: 5,
				vv: 14,
				iv: 5
			},
			"2560x1080": {
				pv: 18,
				client: "2560x1080",
				client_name: "2560x1080",
				uv: 4,
				vv: 12,
				iv: 4
			},
			"1280x1024": {
				pv: 14,
				client: "1280x1024",
				client_name: "1280x1024",
				uv: 2,
				vv: 5,
				iv: 2
			},
			"1280x800": {
				pv: 9,
				client: "1280x800",
				client_name: "1280x800",
				uv: 1,
				vv: 1,
				iv: 1
			},
			"2560x1440": {
				pv: 8,
				client: "2560x1440",
				client_name: "2560x1440",
				uv: 1,
				vv: 8,
				iv: 1
			},
			"536x330": {
				pv: 6,
				client: "536x330",
				client_name: "536x330",
				uv: 1,
				vv: 2,
				iv: 1
			},
			"580x330": {
				pv: 2,
				client: "580x330",
				client_name: "580x330",
				uv: 1,
				vv: 2,
				iv: 1
			},
			"566x400": {
				pv: 2,
				client: "566x400",
				client_name: "566x400",
				uv: 1,
				vv: 1,
				iv: 1
			}
		},
		5: {
			"24-bit": {
				pv: 827,
				client: "24-bit",
				client_name: "24-bit",
				uv: 113,
				vv: 415,
				iv: 78
			},
			"32-bit": {
				pv: 340,
				client: "32-bit",
				client_name: "32-bit",
				uv: 84,
				vv: 316,
				iv: 40
			}
		},
		6: {
			"zh-cn": {
				pv: 1056,
				client: "zh-cn",
				client_name: "中文(简体)",
				uv: 170,
				vv: 663,
				iv: 86
			},
			"en-us": {
				pv: 111,
				client: "en-us",
				client_name: "英语(美国)",
				uv: 27,
				vv: 68,
				iv: 18
			}
		},
		9: {
			"-8.0": {
				pv: 1167,
				client: "-8.0",
				client_name: "北京",
				uv: 197,
				vv: 731,
				iv: 96
			}
		},
		10: {
			windows: {
				pv: 589,
				client: "windows",
				client_name: "windows",
				uv: 82,
				vv: 318,
				iv: 63
			},
			iphone: {
				pv: 272,
				client: "iphone",
				client_name: "iphone",
				uv: 74,
				vv: 193,
				iv: 35
			},
			Android: {
				pv: 186,
				client: "Android",
				client_name: "Android",
				uv: 33,
				vv: 176,
				iv: 23
			},
			mac: {
				pv: 118,
				client: "mac",
				client_name: "mac",
				uv: 23,
				vv: 59,
				iv: 16
			},
			symbian: {
				pv: 2,
				client: "symbian",
				client_name: "symbian",
				uv: 1,
				vv: 2,
				iv: 1
			}
		}
	};
	return a.getClientPara = function(b) {
		return a[b]
	}, a
}), angular.module("mta.depth.chart", []).directive("mtaDepthChart", ["$routeParams", "mtaService", "mockMTADepthService", function(a, b, c) {
	return function(d, e) {
		function f(a) {
			angular.forEach(a, function(a) {
				angular.forEach(a, function(a) {
					i.data[parseInt(a.visitor_depth, 10) - 1] += parseInt(a.visitor_pv, 10)
				})
			}), g.clear(), g.setOption(l)
		}
		for (var g = echarts.init(e.get(0), "eqxiu"), h = {
			type: "category",
			data: []
		}, i = {
			name: "访问深度",
			type: "bar",
			data: []
		}, j = 0, k = d.pages.length; j++ < k;) h.data.push(j + "页"), i.data.push(0);
		var l = {
			tooltip: {
				trigger: "axis"
			},
			legend: {
				data: ["访问深度"]
			},
			xAxis: [h],
			yAxis: [{
				type: "value",
				name: "次数"
			}],
			series: [i]
		};
		g.setOption(l), d.$watch("dateRange", function(e) {
			if (e) {
				for (var g = 0, h = i.data.length; h > g; g++) i.data[g] = 0;
				if (!d.isAllowedToMTAPageDeepth) return void f(c.getDepth());
				b.getDepth(a.sceneId, e.startTime, e.endTime).then(function(a) {
					a.data.success && a.data.map && !a.data.map.code && f(a.data.map.data)
				})
			}
		}, !0)
	}
}]).service("mockMTADepthService", function() {
	return {
		getDepth: function() {
			return {
				mockdata: [{
					visitor_depth: "1",
					visitor_pv: "739"
				}, {
					visitor_depth: "2",
					visitor_pv: "52"
				}]
			}
		}
	}
}), angular.module("mta.operator.statistic", []).directive("mtaOperator", function() {
	return {
		templateUrl: "spread/tab/statistics/components/mta-operator.tpl.html",
		controller: ["$routeParams", "$scope", "$element", "mtaService", "operatorService", "bigDataService", "mockMTAOperatorService", function(a, b, c, d, e, f, g) {
			function h(a, c) {
				f.dateAxisRange(c.startTime, c.endTime, function(a) {
					j.data.push(a)
				}), angular.forEach(a, function(a, d) {
					var g = e[d];
					k.legend.data.push(g);
					var h = {
						pv: 0,
						uv: 0,
						vv: 0,
						iv: 0,
						name: g
					},
						i = {
							name: g,
							type: "line",
							data: []
						};
					k.series.push(i), f.dateAxisRange(c.startTime, c.endTime, function(c) {
						var d = c.replace(/-/g, ""),
							e = a[d];
						e ? (i.data.push(angular.extend({}, e, {
							value: e[b.currentIdx]
						})), h.pv += e.pv, h.uv += e.uv, h.vv += e.vv, h.iv += e.iv) : i.data.push({
							pv: 0,
							uv: 0,
							vv: 0,
							iv: 0,
							value: 0
						})
					}), b.operatorDetails.push(h)
				}), i.clear(), i.setOption(k)
			}
			b.currentIdx = "pv";
			var i = echarts.init(c.find(".mta-operator-container").get(0), "eqxiu"),
				j = {
					type: "category",
					data: []
				},
				k = {
					tooltip: {
						trigger: "axis"
					},
					legend: {
						width: 800,
						left: 65,
						data: []
					},
					grid: {
						top: "70"
					},
					xAxis: [j],
					yAxis: [{
						type: "value",
						name: "次数"
					}],
					series: []
				};
			b.operatorDetails = [], i.setOption(k), b.$watch("dateRange", function(c) {
				c && (j.data = [], k.series = [], k.legend.data = [], b.operatorDetails = [], b.isAllowedToMTAOperator ? d.getOperator(a.sceneId, c.startTime, c.endTime, null).then(function(a) {
					a.data.success && a.data.map && !a.data.map.code && h(a.data.map.data, c)
				}) : h(g.getOperator(), c))
			}, !0), b.$watch("currentIdx", function(a) {
				a && k.series.length && (angular.forEach(k.series, function(b) {
					b.data.length && angular.forEach(b.data, function(b) {
						b.value = b[a]
					})
				}), i.setOption(k))
			})
		}]
	}
}).value("operatorService", {
	1: "电信",
	2: "联通",
	3: "移动",
	4: "长城宽带",
	5: "铁通",
	6: "教育",
	7: "天威",
	8: "电信通",
	9: "网通",
	10: "香港运营商",
	11: "方正",
	12: "歌华有线",
	13: "东方有线",
	0: "其它"
}).service("mockMTAOperatorService", ["bigDataService", "operatorService", function(a, b) {
	var c = a.daysBefore(1, "yyyyMMdd");
	return {
		getOperator: function() {
			var d = {};
			return angular.forEach(b, function(b, e) {
				var f = {};
				"0" === e ? (f[a.daysBefore(0, "yyyyMMdd")] = {
					pv: 38,
					uv: 3,
					vv: 21,
					iv: 8
				}, f[c] = {
					pv: 48,
					uv: 13,
					vv: 31,
					iv: 8
				}, f[a.daysBefore(2, "yyyyMMdd")] = {
					pv: 131,
					uv: 17,
					vv: 50,
					iv: 10
				}, f[a.daysBefore(3, "yyyyMMdd")] = {
					pv: 81,
					uv: 16,
					vv: 49,
					iv: 10
				}, f[a.daysBefore(4, "yyyyMMdd")] = {
					pv: 259,
					uv: 37,
					vv: 173,
					iv: 13
				}, f[a.daysBefore(5, "yyyyMMdd")] = {
					pv: 254,
					uv: 33,
					vv: 151,
					iv: 16
				}, f[a.daysBefore(6, "yyyyMMdd")] = {
					pv: 61,
					uv: 20,
					vv: 49,
					iv: 11
				}, f[a.daysBefore(7, "yyyyMMdd")] = {
					pv: 27,
					uv: 5,
					vv: 20,
					iv: 4
				}, d[e] = f) : (f[c] = {
					pv: 0,
					uv: 0,
					vv: 0,
					iv: 0
				}, d[e] = f)
			}), d
		}
	}
}]), angular.module("mta.page.speed", ["mta.area.chart", "mta.proxy.chart"]).directive("mtaPageSpeed", [function() {
	return {
		templateUrl: "spread/tab/statistics/components/mta-page-speed.tpl.html",
		controller: "MtaPageSpeedCtrl"
	}
}]).controller("MtaPageSpeedCtrl", ["$scope", "$routeParams", "mtaService", "mtaPageSpeedTestData", function(a, b, c, d) {
	a.page_speed_function = "area", a.isViewingDetail = !1, a.currentProvinceId = null, a.viewDetail = function(b) {
		b && (a.currentProvinceId = b || "10", a.isViewingDetail = !0)
	}, a.closeViewingDetail = function() {
		a.isViewingDetail = !1
	}, a.provinces = {}, a.proxies = {}, a.isAllowedToPageSpeed ? a.$watch("dateRange", function(d) {
		d && (c.getPageSpeed(b.sceneId, d.startTime, d.endTime, null, "area", null).then(function(b) {
			b.data.success && b.data.map && !b.data.map.code && (a.provinces = b.data.map.data)
		}), c.getPageSpeed(b.sceneId, d.startTime, d.endTime, null, "proxy", "0,1,2,3,4,5,6,7,8,9,10,11,12,13").then(function(b) {
			b.data.success && b.data.map && !b.data.map.code && (a.proxies = b.data.map.data)
		}))
	}, !0) : (a.provinces = d.area, a.proxies = d.proxy)
}]).value("mtaProvinces", {
	1: "全国",
	10: "北京",
	11: "上海",
	12: "天津",
	13: "重庆",
	14: "香港",
	15: "澳门",
	16: "河北",
	17: "山西",
	18: "内蒙古",
	19: "辽宁",
	20: "吉林",
	21: "黑龙江",
	22: "江苏",
	23: "浙江",
	24: "安徽",
	25: "福建",
	26: "江西",
	27: "山东",
	28: "河南",
	29: "湖北",
	30: "湖南",
	31: "广东",
	32: "广西",
	33: "海南",
	34: "四川",
	35: "贵州",
	36: "云南",
	37: "西藏",
	38: "陕西",
	39: "甘肃",
	40: "青海",
	41: "宁夏",
	42: "新疆",
	43: "台湾"
}).service("mtaProvinceConvert", ["mtaProvinces", function(a) {
	var b = {},
		c = echarts.getMap("china").geoJson.features;
	return c.forEach(function(c) {
		for (var d in a) if (a[d] === c.properties.name) {
			b[d] = {
				name: c.properties.name,
				cp: c.properties.cp
			};
			break
		}
	}), function(a, c) {
		var d = [];
		return a.forEach(function(a) {
			var e, f = b[a.name];
			f && (e = {
				name: f.name
			}, c ? e.value = f.cp.concat(a.value) : e.value = a.value, d.push(e))
		}), d
	}
}]).service("mtaPageSpeedTestData", ["dateFilter", function(a) {
	function b(b) {
		var c = new Date;
		return c.setDate(c.getDate() - b), a(c, "yyyyMMdd")
	}
	for (var c, d = ["0.177", "0.386", "0.172", "0.175", "0.167", "0.172", "0.141"], e = ["0.107", "0.129", "0.122", "0.120", "0.118", "0.110", "0.103"], f = ["0.166", "0.295", "0.169", "0.168", "0.163", "0.170", "0.148"], g = {}, h = 0, i = {}, j = {}; 7 > h;) c = b(h + 1), g[c] = {
		visitor_speed: d[h]
	}, i[c] = {
		visitor_speed: e[h]
	}, j[c] = {
		visitor_speed: f[h]
	}, h++;
	return {
		area: {
			10: g
		},
		proxy: {
			1: i,
			2: j
		}
	}
}]), angular.module("mta.proxy.chart", []).directive("mtaProxyChart", function() {
	return {
		template: '<div class="mta-proxy-chart-container"></div>',
		controller: ["$scope", "$element", "operatorService", function(a, b, c) {
			var d = echarts.init(b.find(".mta-proxy-chart-container").get(0), "eqxiu"),
				e = {
					type: "category",
					data: []
				},
				f = {
					name: "访问延时",
					type: "bar",
					data: []
				},
				g = {
					tooltip: {
						trigger: "axis"
					},
					legend: {
						data: ["访问延时"]
					},
					xAxis: [e],
					yAxis: [{
						type: "value",
						name: "延时(秒)"
					}],
					series: [f]
				};
			d.setOption(g), a.$watch("proxies", function(a) {
				a && (e.data = [], f.data = [], angular.forEach(a, function(a, b) {
					var d = {
						proxy_id: b,
						name: c[b],
						value: 0
					},
						g = 0;
					angular.forEach(a, function(a) {
						d.value += parseFloat(a.visitor_speed), g++
					}), g = g || 1, d.value = parseFloat((d.value / g).toFixed(2)), e.data.push(d.name), f.data.push(d.value)
				}), d.clear(), d.setOption(g))
			})
		}]
	}
}), angular.module("mta.realtime.user", []).directive("mtaRealtimeUser", [function() {
	return {
		templateUrl: "spread/tab/statistics/components/mta-realtime-user.tpl.html",
		controller: "MtaRealtimeUserCtrl"
	}
}]).controller("MtaRealtimeUserCtrl", ["$element", "$scope", "mtaService", "$routeParams", "mtaRealtimeUserTestData", function(a, b, c, d, e) {
	b.online_time = "-1", b.page_range = "-1,99999", b.area = "-1", b.pageIndex = 1, b.realtimeUsers = [], b.isAllowedToUserStatistic ? c.getUserRealTime(d.sceneId, b.pageIndex).then(function(a) {
		a.data.success && a.data.map && !a.data.map.code && (b.realtimeUsers = a.data.map.data)
	}) : b.realtimeUsers = e
}]).service("mtaRealtimeUserTestData", function() {
	return [{
		land_page: "duo.qq.com/h5/_/currency-fast?refer=app",
		area: "--",
		visitor_type: "老访客",
		source_type: "直接访问",
		visitor_time: "<span class='td-arrow' id='realtime_3612405760' data-id='3612405760'></span>11:00:58",
		uid: 3612405760,
		activeTime: "1461121258",
		online_time: "--",
		online_page: 1,
		exit_page: "duo.qq.com/h5/_/currency-fast?refer=app"
	}, {
		land_page: "duo.qq.com/h5/_/currency-fast?refer=app",
		area: "重庆",
		visitor_type: "老访客",
		source_type: "直接访问",
		visitor_time: "<span class='td-arrow' id='realtime_3280403456' data-id='3280403456'></span>10:59:59",
		uid: 3280403456,
		activeTime: "1461121199",
		online_time: "--",
		online_page: 1,
		exit_page: "duo.qq.com/h5/_/currency-fast?refer=app"
	}, {
		land_page: "duo.qq.com/h5/_/index",
		area: "四川省",
		visitor_type: "新访客",
		source_type: "直接访问",
		visitor_time: "<span class='td-arrow' id='realtime_3847561216' data-id='3847561216'></span>10:59:12",
		uid: 3847561216,
		activeTime: "1461121152",
		online_time: "--",
		online_page: 1,
		exit_page: "duo.qq.com/h5/_/index"
	}, {
		land_page: "duo.qq.com/h5/_/currency-fast?refer=app",
		area: "--",
		visitor_type: "老访客",
		source_type: "直接访问",
		visitor_time: "<span class='td-arrow' id='realtime_225273856' data-id='225273856'></span>10:58:45",
		uid: 225273856,
		activeTime: "1461121125",
		online_time: "--",
		online_page: 1,
		exit_page: "duo.qq.com/h5/_/currency-fast?refer=app"
	}, {
		land_page: "duo.qq.com/h5/_/currency-fast?refer=app",
		area: "--",
		visitor_type: "老访客",
		source_type: "直接访问",
		visitor_time: "<span class='td-arrow' id='realtime_4718090240' data-id='4718090240'></span>10:58:39",
		uid: 4718090240,
		activeTime: "1461121119",
		online_time: "--",
		online_page: 1,
		exit_page: "duo.qq.com/h5/_/currency-fast?refer=app"
	}, {
		land_page: "duo.qq.com/h5/_/currency-fast?refer=app",
		area: "辽宁省",
		visitor_type: "老访客",
		source_type: "直接访问",
		visitor_time: "<span class='td-arrow' id='realtime_5950806016' data-id='5950806016'></span>10:58:12",
		uid: 5950806016,
		activeTime: "1461121092",
		online_time: "--",
		online_page: 1,
		exit_page: "duo.qq.com/h5/_/currency-fast?refer=app"
	}, {
		land_page: "duo.qq.com/h5/_/currency-fast?refer=app",
		area: "内蒙古",
		visitor_type: "老访客",
		source_type: "直接访问",
		visitor_time: "<span class='td-arrow' id='realtime_3363963904' data-id='3363963904'></span>10:57:40",
		uid: 3363963904,
		activeTime: "1461121060",
		online_time: "--",
		online_page: 1,
		exit_page: "duo.qq.com/h5/_/currency-fast?refer=app"
	}, {
		land_page: "duo.qq.com/h5/_/currency-fast?refer=app",
		area: "四川省",
		visitor_type: "老访客",
		source_type: "直接访问",
		visitor_time: "<span class='td-arrow' id='realtime_2817753088' data-id='2817753088'></span>10:57:39",
		uid: 2817753088,
		activeTime: "1461121059",
		online_time: "--",
		online_page: 1,
		exit_page: "duo.qq.com/h5/_/currency-fast?refer=app"
	}, {
		land_page: "duo.qq.com/h5/_/currency-fast?refer=app",
		area: "--",
		visitor_type: "老访客",
		source_type: "直接访问",
		visitor_time: "<span class='td-arrow' id='realtime_3380517888' data-id='3380517888'></span>10:57:24",
		uid: 3380517888,
		activeTime: "1461121044",
		online_time: "--",
		online_page: 1,
		exit_page: "duo.qq.com/h5/_/currency-fast?refer=app"
	}, {
		land_page: "duo.qq.com/h5/_/currency-fast?refer=app",
		area: "海南省",
		visitor_type: "老访客",
		source_type: "直接访问",
		visitor_time: "<span class='td-arrow' id='realtime_7540084736' data-id='7540084736'></span>10:55:15",
		uid: 7540084736,
		activeTime: "1461120915",
		online_time: "--",
		online_page: 1,
		exit_page: "duo.qq.com/h5/_/currency-fast?refer=app"
	}, {
		land_page: "duo.qq.com/h5/_/currency-fast?refer=app",
		area: "--",
		visitor_type: "老访客",
		source_type: "直接访问",
		visitor_time: "<span class='td-arrow' id='realtime_5372780544' data-id='5372780544'></span>10:55:10",
		uid: 5372780544,
		activeTime: "1461120910",
		online_time: "--",
		online_page: 1,
		exit_page: "duo.qq.com/h5/_/currency-fast?refer=app"
	}, {
		land_page: "duo.qq.com/h5/_/currency-fast?refer=app",
		area: "贵州省",
		visitor_type: "老访客",
		source_type: "直接访问",
		visitor_time: "<span class='td-arrow' id='realtime_24932352' data-id='24932352'></span>10:54:10",
		uid: 24932352,
		activeTime: "1461120850",
		online_time: "--",
		online_page: 1,
		exit_page: "duo.qq.com/h5/_/currency-fast?refer=app"
	}, {
		land_page: "duo.qq.com/h5/_/currency-fast?refer=app",
		area: "--",
		visitor_type: "老访客",
		source_type: "直接访问",
		visitor_time: "<span class='td-arrow' id='realtime_1806281728' data-id='1806281728'></span>10:53:56",
		uid: 1806281728,
		activeTime: "1461120841",
		online_time: "0分5秒",
		online_page: 2,
		exit_page: "duo.qq.com/h5/_/proxy/calculator"
	}, {
		land_page: "duo.qq.com/h5/_/currency-fast?refer=app",
		area: "--",
		visitor_type: "老访客",
		source_type: "直接访问",
		visitor_time: "<span class='td-arrow' id='realtime_7955542016' data-id='7955542016'></span>10:53:34",
		uid: 7955542016,
		activeTime: "1461120814",
		online_time: "--",
		online_page: 1,
		exit_page: "duo.qq.com/h5/_/currency-fast?refer=app"
	}, {
		land_page: "duo.qq.com/h5/_/currency-fast?refer=app",
		area: "--",
		visitor_type: "老访客",
		source_type: "直接访问",
		visitor_time: "<span class='td-arrow' id='realtime_5184561152' data-id='5184561152'></span>10:52:40",
		uid: 5184561152,
		activeTime: "1461120760",
		online_time: "--",
		online_page: 1,
		exit_page: "duo.qq.com/h5/_/currency-fast?refer=app"
	}]
}), angular.module("mta.user.compare", []).directive("mtaUserCompare", [function() {
	return {
		templateUrl: "spread/tab/statistics/components/mta-user-compare.tpl.html",
		controller: "MtaUserCompareCtrl"
	}
}]).controller("MtaUserCompareCtrl", ["$element", "$scope", "$routeParams", "mtaService", "bigDataService", "mtaUserCompareTestData", function(a, b, c, d, e, f) {
	function g(a, c) {
		j.data = [], k.data = [], l.data = [], b.visitors = {};
		var d = c;
		e.dateAxisRange(a.startTime, a.endTime, function(a) {
			var c = a.replace(/-/g, ""),
				e = d[c],
				f = {};
			e ? (j.data.push(a), k.data.push(e.new_visitor), l.data.push(e.old_visitor), f = e) : (j.data.push(a), k.data.push(0), l.data.push(0), f = {
				new_visitor: 0,
				old_visitor: 0,
				new_visitor_percent: "0%",
				old_visitor_percent: "0%"
			}), b.visitors[a] = f
		}), i.setOption(m)
	}
	var h = a.find(".mta-user-compare-container"),
		i = echarts.init(h.get(0), "eqxiu"),
		j = {
			type: "category",
			data: []
		},
		k = {
			name: "新访客",
			type: "line",
			data: []
		},
		l = {
			name: "老访客",
			type: "line",
			data: []
		},
		m = {
			tooltip: {
				trigger: "axis"
			},
			legend: {
				data: ["新访客", "老访客"]
			},
			xAxis: [j],
			yAxis: [{
				type: "value",
				name: "次数"
			}],
			series: [k, l]
		};
	i.setOption(m), b.visitors = [], b.$watch("dateRange", function(a) {
		a && (b.isAllowedToUserCompare ? d.getCompare(c.sceneId, a.startTime, a.endTime).then(function(b) {
			b.data.success && b.data.map && !b.data.map.code && g(a, b.data.map.data)
		}) : g(a, f))
	}, !0), b.showUserCompareDetail = !1
}]).service("mtaUserCompareTestData", ["dateFilter", function(a) {
	function b(b) {
		var c = new Date;
		return c.setDate(c.getDate() - b), a(c, "yyyyMMdd")
	}
	for (var c = [{
		new_visitor: 252,
		old_visitor: 457,
		new_visitor_percent: "35.54%",
		old_visitor_percent: "64.46%"
	}, {
		new_visitor: 636,
		old_visitor: 1066,
		new_visitor_percent: "37.37%",
		old_visitor_percent: "62.63%"
	}, {
		new_visitor: 521,
		old_visitor: 802,
		new_visitor_percent: "39.38%",
		old_visitor_percent: "60.62%"
	}, {
		new_visitor: 612,
		old_visitor: 1023,
		new_visitor_percent: "37.43%",
		old_visitor_percent: "62.57%"
	}, {
		new_visitor: 530,
		old_visitor: 1042,
		new_visitor_percent: "33.72%",
		old_visitor_percent: "66.28%"
	}, {
		new_visitor: 415,
		old_visitor: 728,
		new_visitor_percent: "36.31%",
		old_visitor_percent: "63.69%"
	}, {
		new_visitor: 148,
		old_visitor: 47,
		new_visitor_percent: "75.90%",
		old_visitor_percent: "24.10%"
	}], d = {}, e = 0; 7 > e;) d[b(e + 1)] = c[e], e++;
	return d
}]), angular.module("mta.user.portrait", []).directive("mtaUserPortrait", [function() {
	return {
		templateUrl: "spread/tab/statistics/components/mta-user-portrait.tpl.html",
		controller: "MtaUserPortraitCtrl"
	}
}]).controller("MtaUserPortraitCtrl", ["$scope", "$routeParams", "mtaService", "mtaUserPortraitTestData", function(a, b, c, d) {
	var e = {
		age: {},
		grade: {},
		profession: {},
		sex: {}
	};
	a.portrait = angular.copy(e), a.$watch("dateRange", function(f) {
		f && (a.isAllowedToUserPortrait ? c.getPortrait(b.sceneId, f.startTime, f.endTime).then(function(b) {
			b.data.success && b.data.map && !b.data.map.code && (0 === b.data.map.data.length ? angular.extend(a.portrait, e) : angular.extend(a.portrait, b.data.map.data))
		}) : angular.extend(a.portrait, d))
	}, !0)
}]).directive("sexChart", [function() {
	return function(a, b) {
		var c = echarts.init(b.get(0), "eqxiu"),
			d = {
				value: 0,
				name: "男"
			},
			e = {
				value: 0,
				name: "女"
			},
			f = {
				value: 0,
				name: "未知"
			},
			g = {
				color: ["#59c7f9", "#ff79a2", "#e6ebed"],
				tooltip: {
					trigger: "item",
					formatter: "{b} {d}%"
				},
				legend: {
					bottom: "bottom",
					data: ["男", "女", "未知"]
				},
				series: [{
					name: "性别比例",
					type: "pie",
					radius: ["40%", "70%"],
					avoidLabelOverlap: !1,
					label: {
						normal: {
							show: !1
						}
					},
					labelLine: {
						normal: {
							show: !1
						}
					},
					data: [d, e, f]
				}]
			};
		c.setOption(g), a.$watch("portrait.sex", function(a) {
			a && (d.value = parseFloat(a["男"] || 0), e.value = parseFloat(a["女"] || 0), f.value = parseFloat(a["未知"] || 0), c.setOption(g))
		}, !0)
	}
}]).directive("compareChart", [function() {
	return {
		scope: !0,
		template: '<ul ng-if="!isEmptyCompare">\n    <li ng-repeat="item in items">\n        <i ng-class="{\'i_unew\': $index < currentIndex, \'i_uold\': $index > currentIndex, \'i_ucurrent\': $index == currentIndex}">\n            <span class="current" ng-if="$index == currentIndex">{{currentPercentage}}%</span>\n        </i>\n    </li>\n</ul>\n<div ng-if="isEmptyCompare" style="height: 100px;" class="no-data small">\n    <p>\n        <img ng-src="{{CLIENT_CDN}}assets/images/userdata.svg" />\n    </p>\n    <p>暂无数据</p>\n</div>',
		controller: ["$scope", function(a) {
			a.items = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9], a.currentIndex = 0, a.currentPercentage = 0, a.isEmptyCompare = !0, a.$watch("visitors", function(b) {
				if (b && !$.isEmptyObject(b)) {
					a.isEmptyCompare = !1;
					var c = 0,
						d = 0,
						e = 0;
					angular.forEach(b, function(a) {
						d += a.new_visitor, e += a.old_visitor, c += a.new_visitor + a.old_visitor
					}), c = c || 1, a.currentPercentage = Math.ceil(d / c * 100), a.currentPercentage > 10 ? a.currentIndex = Math.ceil(a.currentPercentage / 10) - 1 : a.currentIndex = 0
				} else a.isEmptyCompare = !0
			})
		}]
	}
}]).directive("gradeChart", [function() {
	return {
		scope: !0,
		template: "<ul ng-if=\"!isEmptyGrade\">    \n    <li><a><em>{{education['未知']}}%</em><br><i ng-style=\"{width : education['未知']*3 + 'px'}\" class=\"i_education0\"></i></a></li>\n    <li><a><em>{{education['初中']}}%</em><br><i ng-style=\"{width : education['初中']*3 + 'px'}\" class=\"i_education1\"></i></a></li>\n    <li><a><em>{{education['高中']}}%</em><br><i ng-style=\"{width : education['高中']*3 + 'px'}\" class=\"i_education2\"></i></a></li>\n    <li><a><em>{{education['本科']}}%</em><br><i ng-style=\"{width : education['本科']*3 + 'px'}\" class=\"i_education3\"></i></a></li>\n    <li><a><em>{{education['硕士']}}%</em><br><i ng-style=\"{width : education['硕士']*3 + 'px'}\" class=\"i_education4\"></i></a></li>\n    <li><a><em>{{education['博士']}}%</em><br><i ng-style=\"{width : education['博士']*3 + 'px'}\" class=\"i_education5\"></i></a></li>\n</ul>\n<div ng-if=\"isEmptyGrade\" style=\"height: 100px;\" class=\"no-data small\">\n    <p>\n        <img ng-src=\"{{CLIENT_CDN}}assets/images/userdata.svg\" />\n    </p>\n    <p>暂无数据</p>\n</div>",
		controller: ["$scope", function(a) {
			a.isEmptyGrade = !0, a.$watch("portrait.grade", function(b) {
				if (a.education = {
					"未知": 0,
					"初中": 0,
					"高中": 0,
					"本科": 0,
					"硕士": 0,
					"博士": 0
				}, b && !$.isEmptyObject(b)) {
					a.isEmptyGrade = !1;
					var c = 0;
					angular.forEach(b, function(b, d) {
						b = parseInt(b, 10), a.education[d] = b, c += b
					}), c = c || 1, angular.forEach(b, function(b, d) {
						a.education[d] = Math.floor(10 * (b / c * 100).toFixed(2)) / 10
					})
				} else a.isEmptyGrade = !0
			})
		}]
	}
}]).directive("ageChart", [function() {
	return {
		scope: !0,
		template: '<ul>\n    <li><a><span class="vline"><em>{{age[\'未知\']}}%</em><br><i ng-style="calculateHeight(\'未知\')" class="i_pillar"></i></span><span><i class="i_v0"></i><br>未知</span></a></li>\n    <li><a><span class="vline"><em>{{age[\'0-17岁\']}}%</em><br><i ng-style="calculateHeight(\'0-17岁\')" class="i_pillar"></i></span><span><i class="i_v10"></i><br>0-17岁</span></a></li>\n    <li><a><span class="vline"><em>{{age[\'18-24岁\']}}%</em><br><i ng-style="calculateHeight(\'18-24岁\')" class="i_pillar"></i></span><span><i class="i_v20"></i><br>18-24岁</span></a></li>\n    <li><a><span class="vline"><em>{{age[\'25-29岁\']}}%</em><br><i ng-style="calculateHeight(\'25-29岁\')" class="i_pillar"></i></span><span><i class="i_v30"></i><br>25-29岁</span></a></li>\n    <li><a><span class="vline"><em>{{age[\'30-34岁\']}}%</em><br><i ng-style="calculateHeight(\'30-34岁\')" class="i_pillar"></i></span><span><i class="i_v40"></i><br>30-34岁</span></a></li>\n    <li><a><span class="vline"><em>{{age[\'35-39岁\']}}%</em><br><i ng-style="calculateHeight(\'35-39岁\')" class="i_pillar"></i></span><span><i class="i_v50"></i><br>35-39岁</span></a></li>\n    <li><a><span class="vline"><em>{{age[\'40岁以上\']}}%</em><br><i ng-style="calculateHeight(\'40岁以上\')" class="i_pillar"></i></span><span><i class="i_v60"></i><br>40岁以上</span></a></li>\n</ul>',
		controller: ["$scope", function(a) {
			a.maxHeight = 0, a.$watch("portrait.age", function(b) {
				if (a.age = {
					"未知": 0,
					"0-17岁": 0,
					"18-24岁": 0,
					"25-29岁": 0,
					"30-34岁": 0,
					"35-39岁": 0,
					"40岁以上": 0
				}, b) {
					var c = 0;
					a.maxHeight = 0, angular.forEach(b, function(b, d) {
						b = parseInt(b, 10), a.age[d] = b, c += b, a.maxHeight = a.maxHeight < b ? b : a.maxHeight
					}), c = c || 1, a.maxHeight = a.maxHeight || 1, angular.forEach(b, function(b, d) {
						a.age[d] = (b / c * 100).toFixed(2)
					}), a.maxHeight = (a.maxHeight / c * 100).toFixed(2)
				}
			}), a.calculateHeight = function(b) {
				return {
					height: a.age[b] / a.maxHeight * 120 + "px"
				}
			}
		}]
	}
}]).directive("professionChart", [function() {
	return function(a, b) {
		function c(a, b, c, d, f, g, h) {
			var i = ["#59c7f9", "#48d5b2", "#ff79a2", "#ff7e7e", "#4d8ff3", "#8d91ff", "#7cb0ff", "#ffc36d", "#6ee899", "#2a79ff", "#f49f42"];
			g.circle(a, b, c).attr({
				fill: i[e]
			}).add(h);
			e = 9 > e ? e + 1 : 0;
			g.text(d, a - 26, b).css({
				color: "#ffffff",
				font: '14px Tahoma,microsoft yahei,"微软雅黑","宋体"'
			}).add(h);
			g.text(f, a - 18, b + 18).css({
				font: '12px Tahoma,microsoft yahei,"微软雅黑","宋体"',
				color: "#ffffff"
			}).add(h)
		}
		var d = {
			0: [100, 114, 100],
			1: [294, 200, 80],
			2: [780, 80, 70],
			3: [862, 223, 65],
			4: [524, 226, 60],
			5: [673, 234, 45],
			6: [477, 73, 40],
			7: [286, 43, 35],
			8: [608, 111, 35],
			9: [925, 63, 35]
		},
			e = 0;
		a.$watch("portrait.profession", function(a) {
			if (a && !$.isEmptyObject(a)) {
				var f = 0,
					g = [];
				angular.forEach(a, function(a, b) {
					f += parseFloat(a), "0" !== a && g.push({
						AttrValue: b,
						Qv: a
					})
				}), g.sort(function(a, b) {
					return b.Qv - a.Qv
				}), b.css("height", "auto").html("");
				var h = new Highcharts.Renderer(b[0], 1e3, 300);
				e = 0;
				for (var i in g) {
					var j = g[i],
						k = Math.round(j.Qv / f * 1e4) / 100 + "%",
						l = d[i],
						m = h.g().add();
					l && c(l[0], l[1], l[2], j.AttrValue, k, h, m)
				}
			} else b.html("").css("height", "300px").append('<div style="height: 100px;" class="no-data small">\n    <p>\n        <img src="' + CLIENT_CDN + 'assets/images/userdata.svg"/>\n    </p>\n    <p>暂无数据</p>\n</div>')
		})
	}
}]).service("mtaUserPortraitTestData", [function() {
	return {
		sex: {
			"未知": "105",
			"男": "569",
			"女": "182"
		},
		age: {
			"未知": "105",
			"0-17岁": "144",
			"18-24岁": "256",
			"25-29岁": "209",
			"30-34岁": "76",
			"35-39岁": "9",
			"40岁以上": "57"
		},
		grade: {
			"未知": "136",
			"初中": "99",
			"高中": "185",
			"本科": "418",
			"硕士": "18"
		},
		profession: {
			"未知": "711",
			"医疗生化": "7",
			"官员翻译": "3",
			"销售客服": "13",
			"教育科研": "5",
			"媒体艺术": "3",
			"金融保险": "55",
			"服务业": "11",
			"电子网络": "48"
		}
	}
}]), angular.module("statistic.scene.pv", []).directive("scenePv", [function() {
	return {
		scope: {
			scenePv: "=",
			summeryPvUv: "="
		},
		templateUrl: "spread/tab/statistics/components/scene-pv.tpl.html",
		controller: "ScenePVCtrl"
	}
}]).controller("ScenePVCtrl", ["$scope", "$element", "bigDataService", function(a, b, c) {
	var d = b.find(".pv-chart"),
		e = echarts.init(d.get(0), "eqxiu"),
		f = {
			name: "PV",
			type: "line",
			data: []
		},
		g = {
			name: "UV",
			type: "line",
			data: []
		},
		h = {
			type: "category",
			data: []
		},
		i = {
			tooltip: {
				trigger: "axis"
			},
			legend: {
				data: ["PV"]
			},
			xAxis: [h],
			yAxis: [{
				type: "value",
				name: "次数"
			}],
			series: [f]
		};
	a.$parent.$parent.$parent.isAllowedToAccessUVStatistic && (i.legend.data.push("UV"), i.series.push(g)), e.setOption(i), a.$watch("scenePv", function(b) {
		if (b) {
			var d = 0,
				j = b.length,
				k = b[d];
			f.data = [], g.data = [], 1 === a.$parent.dateRange.state || 4 === a.$parent.dateRange.state ? h.data = c.hourAxisRange(function(a) {
				j && k && a === k.hour ? (f.data.push(k.pv || 0), g.data.push(k.uv || 0), k = b[++d]) : (f.data.push(0), g.data.push(0))
			}) : h.data = c.dateAxisRange(a.$parent.dateRange.startTime, a.$parent.dateRange.endTime, function(a) {
				j && k && a === k.name ? (f.data.push(k.pv || 0), g.data.push(k.uv || 0), k = b[++d]) : (f.data.push(0), g.data.push(0))
			});
			var l = 0,
				m = 0,
				n = 0,
				o = 0,
				p = 0,
				q = 0,
				r = 0,
				s = 0;
			f.data.forEach(function(a, b) {
				b ? (m = a > m ? a : m, n = n > a ? a : n) : (m = a, n = a), l += a
			}), o = Math.floor(l / (f.data.length ? f.data.length : 1)), a.$parent.$parent.$parent.isAllowedToAccessUVStatistic ? (g.data.forEach(function(a, b) {
				b ? (q = a > q ? a : q, r = r > a ? a : r) : (q = a, r = a), p += a
			}), s = Math.floor(p / (g.data.length ? g.data.length : 1))) : (p = 0, q = 0, r = 0, s = 0), a.legendPvUv = {
				pv: l,
				mapv: m,
				mpv: n,
				apv: o,
				uv: p,
				mauv: q,
				muv: r,
				auv: s
			}, e.setOption(i)
		}
	})
}]), angular.module("statistic.share.channel", []).controller("ShareChannelCtrl", ["$scope", "$element", function(a, b) {
	var c = b.find(".eqxiu-share-channel-chart"),
		d = echarts.init(c.get(0), "eqxiu"),
		e = {
			name: "分享渠道",
			type: "pie",
			radius: ["50%", "90%"],
			avoidLabelOverlap: !1,
			data: [],
			label: {
				normal: {
					show: !1,
					position: "center"
				},
				emphasis: {
					show: !0,
					textStyle: {
						fontSize: "20",
						fontWeight: "bold"
					}
				}
			},
			labelLine: {
				normal: {
					show: !1
				}
			}
		},
		f = {
			color: ["#48d5b2", "#ffc36d", "#ff79a2", "#59c7f9", "#f9ce49", "#ff7e7e", "#e6ebed", "#80888e", "#2a79ff", "#f49f42"],
			tooltip: {
				trigger: "item",
				formatter: "{b} : {c} ({d}%)"
			},
			legend: {
				orient: "vertical",
				right: "right",
				top: "center",
				itemGap: 26,
				data: ["微信朋友圈", "微信朋友", "微信群", "QQ", "QQ空间", "微博", "其他"]
			},
			series: [e]
		};
	f.legend.data.forEach(function(a, b) {
		6 === b ? e.data.push({
			name: a,
			value: 0,
			itemStyle: {
				normal: {
					color: "#e6ebed"
				},
				emphasis: {
					color: "#e6ebed"
				}
			}
		}) : e.data.push({
			name: a,
			value: 0
		})
	}), d.setOption(f), a.$watch("shareChannel", function(a) {
		a && (e.data = [{
			name: "微信朋友圈",
			value: a.timeline || 0
		}, {
			name: "微信朋友",
			value: a.singlemessage || 0
		}, {
			name: "微信群",
			value: a.groupmessage || 0
		}, {
			name: "QQ",
			value: a.sqq || 0
		}, {
			name: "QQ空间",
			value: a.qzone || 0
		}, {
			name: "微博",
			value: a.tsina || 0
		}, {
			name: "其他",
			value: a.other || 0,
			itemStyle: {
				normal: {
					color: "#8d91ff"
				},
				emphasis: {
					color: "#8d91ff"
				}
			}
		}], d.setOption(f))
	})
}]).directive("shareChannel", [function() {
	return {
		controller: "ShareChannelCtrl",
		scope: {
			shareChannel: "="
		},
		templateUrl: "spread/tab/statistics/components/share-channel.tpl.html"
	}
}]), angular.module("summery.interactive", []).value("interactiveComponents", [{
	name: "电话互动次数",
	nickname: "电话",
	key: "1120602",
	color: "#48d5b2"
}, {
	name: "链接点击次数",
	nickname: "链接",
	key: "1120601",
	color: "#8d91ff"
}, {
	name: "触发点击次数",
	nickname: "触发",
	key: "1120603",
	color: "#ff79a2"
}, {
	name: "品牌联合底标点击次数",
	nickname: "联合底标",
	key: "label",
	color: "#7cb0ff"
}, {
	name: "喜欢点击次数",
	nickname: "喜欢",
	key: "1120605",
	color: "#ff7e7e"
}, {
	name: "顶起点击次数",
	nickname: "顶起",
	key: "1120606",
	color: "#ffc36d"
}, {
	name: "送花点击次数",
	nickname: "送花",
	key: "1120607",
	color: "#4d8ff3"
}, {
	name: "投票数",
	nickname: "投票",
	key: "1120608",
	color: "#6ee899"
}]).controller("SummeryInteractiveCtrl", ["$scope", "interactiveComponents", function(a, b) {
	a.interactiveComponents = b, a.summeryInteractiveComponent = {
		name: "互动总次数",
		nickname: "总次数",
		key: "total",
		color: "#59c7f9"
	}
}]).directive("summeryInteractive", [function() {
	return {
		controller: "SummeryInteractiveCtrl",
		scope: {
			summeryInteractive: "="
		},
		templateUrl: "spread/tab/statistics/components/summery-interactive.tpl.html"
	}
}]).directive("summeryInteractivePieChart", [function() {
	return {
		scope: {
			currentInteractive: "=summeryInteractivePieChart",
			current: "=",
			total: "="
		},
		link: function(a, b, c) {
			var d = echarts.init(b.get(0), "eqxiu"),
				e = {
					name: "互动次数",
					type: "pie",
					radius: ["50%", "70%"],
					avoidLabelOverlap: !1,
					label: {
						normal: {
							show: !1,
							position: "center"
						},
						emphasis: {
							show: !0,
							textStyle: {
								fontSize: "12",
								fontWeight: "bold"
							}
						}
					},
					labelLine: {
						normal: {
							show: !1
						}
					},
					data: []
				},
				f = {
					tooltip: {
						trigger: "item",
						formatter: "{b}: {c} ({d}%)"
					},
					series: [e]
				};
			d.setOption(f), a.$watch("total + current", function() {
				var b = parseInt(a.current, 10) || 0,
					g = parseInt(a.total, 10) || 0;
				e.data.push({
					value: b,
					name: a.currentInteractive.nickname,
					itemStyle: {
						normal: {
							color: a.currentInteractive.color
						},
						emphasis: {
							color: a.currentInteractive.color
						}
					}
				}), angular.isDefined(c.isSummery) || e.data.push({
					value: g - b,
					name: "",
					itemStyle: {
						normal: {
							color: "#e6ebed"
						},
						emphasis: {
							color: "#e6ebed"
						}
					}
				}), d.setOption(f)
			})
		}
	}
}]), angular.module("third.party.analysis.config", []).controller("ThirdPartyAnalysisCtrl", ["$scope", "$http", "$routeParams", "$modal", "ModalService", "permissionService", function(a, b, c, d, e, f) {
	function g(d) {
		b({
			withCredentials: !0,
			method: "POST",
			url: PREFIX_ANALYSIS_HOST + "m/sa/enable",
			headers: {
				"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
			},
			params: {
				sceneId: c.sceneId,
				partner: d,
				enable: 1
			}
		}).then(function(b) {
			b.data.success ? e.openMsgDialog({
				msg: b.data.msg
			}, function() {
				a.getMyScene()
			}) : e.openMsgDialog({
				msg: b.data.msg
			})
		})
	}
	a.enableThirdPartyAnalysis = function() {
		d.open({
			backdrop: "static",
			keyboard: !1,
			backdropClick: !0,
			scope: a,
			windowClass: "third-party-analysis-config-dialog",
			templateUrl: "spread/tab/statistics/components/third-party-analysis-config.tpl.html",
			controller: "ThirdPartyAnalysisConfigurationDialogCtrl"
		}).result.then(g)
	}, a.isCurrentUserAccess = f.isCurrentUserPayed()
}]).controller("ThirdPartyAnalysisConfigurationDialogCtrl", ["$scope", "$rootScope", function(a, b) {
	a.isMTAStatisticEnabled = !1, a.isDataStoryStatisticEnabled = !1, a.originStatus = {}, a.$watch("scene.thirdCode", function(b) {
		b = b || "", a.isMTAStatisticEnabled = -1 !== b.indexOf("1"), a.isDataStoryStatisticEnabled = -1 !== b.indexOf("2"), a.originStatus.isMTAStatisticEnabled = a.isMTAStatisticEnabled, a.originStatus.isDataStoryStatisticEnabled = a.isDataStoryStatisticEnabled
	}), a.enableMTA = function() {
		a.isMTAStatisticEnabled = !a.isMTAStatisticEnabled
	}, a.enableDataStory = function() {
		a.isDataStoryStatisticEnabled = !a.isDataStoryStatisticEnabled
	}, a.confirmToEnable = function() {
		var b = [];
		(a.originStatus.isMTAStatisticEnabled || a.isMTAStatisticEnabled) && b.push("mta"), (a.originStatus.isDataStoryStatisticEnabled || a.isDataStoryStatisticEnabled) && b.push("ds"), a.$close(b.join(","))
	}
}]), angular.module("spread.statistics.expandWebStatistics", []).controller("ExpandWebStatisticsCtrl", ["$scope", "$element", "bigDataService", "testData", function(a, b, c, d) {
	function e() {
		a.selectedExpandWebUrl && a.dateRange && (a.dateRange.state ? 1 === a.dateRange.state || 4 === a.dateRange.state ? c.getSceneHoursQrc(a.sceneId, a.selectedExpandWeb.id, a.dateRange.startTime).then(function(b) {
			b.data.success && (a.expandWebAnalysis = b.data.obj)
		}) : c.getSceneDateQrc(a.sceneId, a.selectedExpandWeb.id, a.dateRange.startTime, a.dateRange.endTime).then(function(b) {
			b.data.success && (a.expandWebAnalysis = b.data.obj)
		}) : c.getSceneTotalQrc(a.sceneId, a.selectedExpandWeb.id).then(function(b) {
			b.data.success && (a.summeryExpandWeb = b.data.obj, a.isAllowedToAccessUVStatistic || angular.extend(a.summeryExpandWeb, d.testUV))
		}))
	}
	a.summeryExpandWeb = {
		pv: 0,
		uv: 0,
		apv: 0,
		auv: 0,
		mpv: 0,
		muv: 0,
		mapv: 0,
		mauv: 0
	}, a.isAllowedToAccessUVStatistic || angular.extend(a.summeryExpandWeb, d.testUV), a.expandWebAnalysis = [], a.selectedExpandWebUrl = "", a.selectedExpandWeb = null, a.selectThisExpandWeb = function(b) {
		a.selectedExpandWeb = b, b ? a.selectedExpandWebUrl = (a.selectedUrl || PREFIX_HOST + "/v/" + a.scene.code) + "?qrc=" + b.id : a.selectedExpandWebUrl = "", e()
	}, a.summeryDevice = {}, a.top10Device = [], a.$watch("dateRange", function() {
		e()
	}, !0)
}]).directive("expandWebStatistics", [function() {
	return {
		replace: !0,
		templateUrl: "spread/tab/statistics/expand-web-statistics.tpl.html",
		controller: "ExpandWebStatisticsCtrl"
	}
}]).controller("SummeryDeviceCtrl", ["$scope", "$element", "$location", "$routeParams", function(a, b, c, d) {
	a.legend = {
		android: "0%",
		androidValue: 0,
		ios: "0%",
		iosValue: 0,
		mobile: "0%",
		mobileValue: 0,
		pc: "0%",
		pcValue: 0
	}, a.$watch("summeryDevice", function(b) {
		if (b) {
			var c = b.Android || 0,
				d = b.IOS || 0,
				e = b.mobile || 0,
				f = b.pc || 0,
				g = c + d + e + f;
			g ? (a.legend.android = Math.round(c / g * 100) + "%", a.legend.androidValue = c, a.legend.ios = Math.round(d / g * 100) + "%", a.legend.iosValue = d, a.legend.mobile = Math.round(e / g * 100) + "%", a.legend.mobileValue = e, a.legend.pc = Math.round(f / g * 100) + "%", a.legend.pcValue = f) : (a.legend.android = "0%", a.legend.androidValue = 0, a.legend.ios = "0%", a.legend.iosValue = 0, a.legend.mobile = "0%", a.legend.mobileValue = 0, a.legend.pc = "0%", a.legend.pcValue = 0)
		}
	}), a.navToAd = function() {
		a.$parent.viewControl.tab = "share", a.$parent.viewControl.subtab = "thirdWeb", c.path("share/" + d.sceneId + "/thirdWeb", !1)
	}
}]).directive("summeryDevice", [function() {
	return {
		controller: "SummeryDeviceCtrl",
		scope: {
			summeryDevice: "=",
			top10Device: "="
		},
		templateUrl: "spread/tab/statistics/components/summery-device.tpl.html"
	}
}]).controller("TopListDeviceCtrl", ["$element", "$scope", function(a, b) {
	b.noDataImg = CLIENT_CDN + "assets/images/userdata.svg";
	var c = {
		type: "bar",
		data: [],
		label: {
			normal: {
				show: !0,
				position: "inside"
			}
		},
		barWidth: 30,
		barMinHeight: 30
	},
		d = {
			title: {
				text: "前10名机型",
				left: "left",
				textStyle: {
					fontSize: 12
				}
			},
			textStyle: {
				color: "#eee"
			},
			tooltip: {
				trigger: "axis"
			},
			grid: {
				left: "3%",
				right: "4%",
				bottom: "3%",
				containLabel: !0
			},
			xAxis: {
				show: !1,
				type: "value"
			},
			yAxis: {
				type: "category",
				data: [],
				axisLine: {
					show: !1
				},
				axisTick: {
					show: !1
				}
			},
			series: [c]
		},
		e = echarts.init(a.get(0), "eqxiu");
	e.setOption(d);
	var f = e._theme.color;
	b.$watch("top10Device", function(a) {
		if (a) {
			var b = c.data = [],
				g = d.yAxis.data = [];
			if (a.forEach(function(a, c) {
				g.unshift(a.name), b.unshift({
					value: a.value,
					name: a.name,
					itemStyle: {
						normal: {
							color: f[c]
						}
					}
				})
			}), a.length > 0 && a.length < 10) for (var h = a.length; 10 > h; h++) g.unshift(""), b.unshift({
				value: 0,
				name: "",
				itemStyle: {
					normal: {
						color: "#e6ebed"
					},
					emphasis: {
						color: "#e6ebed"
					}
				}
			});
			e.setOption(d)
		}
	})
}]).directive("topListDevice", [function() {
	return {
		template: '<div class="top-list-device"></div>',
		controller: "TopListDeviceCtrl",
		replace: !0
	}
}]), angular.module("spread.statistics.interactiveStatistics", ["summery.interactive"]).controller("InteractiveStatisticsCtrl", ["$scope", "bigDataService", "dateFilter", function(a, b, c) {
	a.interactiveAnalysis = [], a.summeryInteractiveDatas = {
		total: 0
	}, b.getSceneInteractionTotal(a.sceneId, c(new Date(a.scene.createTime), "yyyy-MM-dd")).then(function(b) {
		if (b.data.success) {
			var c = b.data.obj || {},
				d = 0;
			angular.forEach(c, function(a) {
				d += parseInt(a, 10) || 0
			}), c.total = d, a.summeryInteractiveDatas = c
		}
	}), a.$watch("dateRange", function(c) {
		c && c.state && b.getSceneInteractionDayHour(a.sceneId, c.startTime, c.endTime).then(function(b) {
			b.data.success && (a.interactiveAnalysis = b.data.obj)
		})
	}, !0)
}]).directive("interactiveStatistics", [function() {
	return {
		replace: !0,
		templateUrl: "spread/tab/statistics/interactive-statistics.tpl.html",
		controller: "InteractiveStatisticsCtrl"
	}
}]).controller("InteractiveAnalysisCtrl", ["$scope", "$element", "bigDataService", "interactiveComponents", function(a, b, c, d) {
	a.interactiveComponents = d;
	var e = b.find(".interactive-analysis"),
		f = echarts.init(e.get(0), "eqxiu"),
		g = {
			type: "category",
			data: []
		},
		h = [],
		i = {
			tooltip: {
				trigger: "axis"
			},
			legend: {
				data: []
			},
			xAxis: [g],
			yAxis: [{
				type: "value",
				name: "次数"
			}],
			series: h
		};
	d.forEach(function(a) {
		i.legend.data.push(a.nickname), h.push({
			name: a.nickname,
			type: "line",
			data: []
		})
	}), f.setOption(i), a.$watch("interactiveAnalysis", function(b) {
		if (b) {
			d.forEach(function(a, b) {
				h[b].data = []
			});
			var e;
			a.$parent.dateRange.state && a.$parent.dateRange.startTime === a.$parent.dateRange.endTime ? g.data = c.hourAxisRange(function(a) {
				e = b[a], e ? d.forEach(function(a, b) {
					h[b].data.push(e[a.key] || 0)
				}) : d.forEach(function(a, b) {
					h[b].data.push(0)
				})
			}) : g.data = c.dateAxisRange(a.$parent.dateRange.startTime, a.$parent.dateRange.endTime, function(a) {
				e = b[a.replace(/-/g, "")], e ? d.forEach(function(a, b) {
					h[b].data.push(e[a.key] || 0)
				}) : d.forEach(function(a, b) {
					h[b].data.push(0)
				})
			}), f.setOption(i)
		}
	})
}]).directive("interactiveAnalysis", [function() {
	return {
		scope: {
			interactiveAnalysis: "=",
			summeryInteractiveDatas: "="
		},
		controller: "InteractiveAnalysisCtrl",
		template: '<div class="summery-interactive" ng-if="$parent.dateRange.state === 0">\n    <div class="summery-interactive-body" summery-interactive="summeryInteractiveDatas"></div>\n</div>\n<div class="interactive-analysis basic-chart"></div>\n<div class="basic-legend" style="left: 200px; bottom: 40px;">\n    <span ng-repeat="component in interactiveComponents">{{component.nickname}}互动次数: {{summeryInteractiveDatas[component.key] || 0}}</span>\n</div>'
	}
}]), angular.module("spread.statistics.pageStatistics", ["mta.page.speed", "mta.depth.chart"]).controller("PageStatisticsCtrl", ["$scope", "$routeParams", "sceneService", function(a, b, c) {
	a.pages = [], c.getPageNames(b.sceneId).then(function(b) {
		b.data.success && (a.pages = b.data.list)
	}), a.pageDeepthProvider = "eqxiu"
}]).directive("pageStatistics", [function() {
	return {
		replace: !0,
		templateUrl: "spread/tab/statistics/page-statistics.tpl.html",
		controller: "PageStatisticsCtrl"
	}
}]).controller("PageBehaviorCtrl", ["$scope", "$element", "bigDataService", function(a, b, c) {
	var d = b.find(".page-behavior"),
		e = echarts.init(d.get(0), "eqxiu"),
		f = {
			type: "category",
			data: []
		},
		g = {
			name: "访问次数",
			type: "bar",
			data: []
		},
		h = {
			name: "访问时长",
			type: "line",
			yAxisIndex: 1,
			data: []
		},
		i = {
			tooltip: {
				trigger: "axis",
				formatter: "{b} <br/>{a0}: {c0}次 <br/>{a1}: {c1}s"
			},
			legend: {
				data: ["访问次数", "访问时长"]
			},
			xAxis: [f],
			yAxis: [{
				type: "value",
				name: "次数"
			}, {
				type: "value",
				name: "时长(秒)"
			}],
			series: [g, h]
		};
	e.setOption(i), a.pageDepthData = {
		access_times: {},
		access_times_avg: 0,
		pv_depth: {},
		pv_depth_avg: 0,
		uv_depth: {},
		uv_depth_avg: 0
	}, a.isAllowdToPageDepth ? a.$watch("dateRange", function(b) {
		b && c.getSceneDepth(a.sceneId, b.startTime, b.endTime).then(function(b) {
			if (b.data.success) {
				a.pageDepthData = b.data.obj, f.data = [], g.data = [], h.data = [];
				var c = b.data.obj;
				a.pages.forEach(function(a, b) {
					var d = b + 1,
						e = 0,
						i = 0;
					f.data.push(d + "页"), c && c.pv_depth && angular.forEach(c.pv_depth, function(a, b) {
						var c = parseInt(a, 10) || 0,
							f = parseInt(b, 10) || 0;
						f >= d && (e += c)
					}), c && c.access_times && (i = parseInt(c.access_times["" + d], 10) || 0), g.data.push(e), h.data.push(i)
				}), e.setOption(i)
			}
		})
	}, !0) : (f.data = ["1页", "2页", "3页", "4页", "5页", "6页", "7页"], g.data = [32, 26, 20, 19, 8, 7, 6], h.data = [6, 4, 3, 1, 1, 1, 1], e.setOption(i))
}]).directive("pageBehavior", [function() {
	return {
		template: '<div class="page-behavior basic-chart"></div>\n<div class="basic-legend page-legend" style="display: none;">\n    <span>平均访问时长: {{pageDepthData.access_times_avg}}秒</span>\n    <span>平均访问深度(PV): {{pageDepthData.pv_depth_avg}}</span>\n    <span>平均访问深度(UV): {{pageDepthData.uv_depth_avg}}</span>\n</div>',
		controller: "PageBehaviorCtrl"
	}
}]).directive("stayTime", [function() {
	return {
		template: '<div class="pages-container">\n    <div class="page">\n        \n    </div>\n</div>',
		controller: "StayTimeCtrl"
	}
}]).controller("StayTimeCtrl", ["$scope", function(a) {}]), angular.module("big.data.services", []).factory("bigDataService", ["$http", "dateFilter", "interactionNameMap", function(a, b, c) {
	var d = b(new Date, "yyyy-MM-dd"),
		e = ["00", "01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23"],
		f = {
			type: {
				SUMMERY: 1,
				PERIOD: 2
			}
		};
	return f.daysBefore = function(a, c) {
		c = c || "yyyy-MM-dd";
		var d = new Date;
		return d.setDate(d.getDate() - a), b(d, c)
	}, f.dateAxisRange = function(a, c, d) {
		var e = [],
			f = new Date(a),
			g = a;
		do d && d(g), e.push(g), f.setDate(f.getDate() + 1), g = b(f, "yyyy-MM-dd");
		while (c >= g);
		return e
	}, f.hourAxisRange = function(a) {
		return a && e.forEach(a), e
	}, f.getPVUVYesterday = function(b, c) {
		var d = BIG_DATA_HOST + "api/eqx/scene/pvtotal/" + b + "/" + c + "/stat.json?ts=" + (new Date).getTime();
		return a({
			withCredentials: !0,
			method: "GET",
			url: d
		})
	}, f.getRegionYesterday = function(b) {
		var c = BIG_DATA_HOST + "api/eqx/scene/region/" + b + "/stat.json?ts=" + (new Date).getTime();
		return a({
			withCredentials: !0,
			method: "GET",
			url: c
		})
	}, f.getPlatformYesterday = function(b) {
		var c = BIG_DATA_HOST + "api/eqx/scene/platform/" + b + "/stat.json?ts=" + (new Date).getTime();
		return a({
			withCredentials: !0,
			method: "GET",
			url: c
		})
	}, f.getPVUVPeriod = function(b, c, e) {
		c = c || d, e = e || d;
		var f = BIG_DATA_HOST + "api/eqx/scene/sceneLists/" + b + "/" + c + "/" + e + "/stat.json?ts=" + (new Date).getTime();
		return a({
			withCredentials: !0,
			method: "GET",
			url: f
		})
	}, f.getPlatformPeriod = function(b, c, e) {
		c = c || d, e = e || d;
		var f = BIG_DATA_HOST + "api/eqx/scene/platformLists/" + b + "/" + c + "/" + e + "/stat.json?ts=" + (new Date).getTime();
		return a({
			withCredentials: !0,
			method: "GET",
			url: f
		})
	}, f.getBrowserPeriod = function(b, c, e) {
		c = c || d, e = e || d;
		var f = BIG_DATA_HOST + "api/eqx/scene/browserLists/" + b + "/" + c + "/" + e + "/stat.json?ts=" + (new Date).getTime();
		return a({
			withCredentials: !0,
			method: "GET",
			url: f
		})
	}, f.getSceneHourList = function(b, c) {
		c = c || d;
		var e = BIG_DATA_HOST + "api/eqx/scene/sceneHourLists/" + b + "/" + c + "/stat.json?ts=" + (new Date).getTime();
		return a({
			withCredentials: !0,
			method: "GET",
			url: e
		})
	}, f.getSceneTotalPVUV = function(b) {
		var c = BIG_DATA_HOST + "api/eqx/scene/total/puv/" + b + "/stat.json?ts=" + (new Date).getTime();
		return a({
			withCredentials: !0,
			method: "GET",
			url: c
		})
	}, f.getSceneTotalPlatform = function(b, c, e, g) {
		c = c || f.type.SUMMERY, e = e || d, g = g || d;
		var h = BIG_DATA_HOST + "api/eqx/scene/total/platform/" + b + "/" + c + "/" + e + "/" + g + "/stat.json?ts=" + (new Date).getTime();
		return a({
			withCredentials: !0,
			method: "GET",
			url: h
		})
	}, f.getSceneTotalRegion = function(b, c, e, g) {
		c = c || f.type.SUMMERY, e = e || d, g = g || d;
		var h = BIG_DATA_HOST + "api/eqx/scene/total/region/" + b + "/" + c + "/" + e + "/" + g + "/stat.json?ts=" + (new Date).getTime();
		return a({
			withCredentials: !0,
			method: "GET",
			url: h
		})
	}, f.getSceneTotalShareType = function(b, c, e, g) {
		c = c || f.type.SUMMERY, e = e || d, g = g || d;
		var h = BIG_DATA_HOST + "api/eqx/scene/total/sharetype/" + b + "/" + c + "/" + e + "/" + g + "/stat.json?ts=" + (new Date).getTime();
		return a({
			withCredentials: !0,
			method: "GET",
			url: h
		})
	}, f.getSceneTotalInteractive = function(b, c, e, g) {
		c = c || f.type.SUMMERY, e = e || d, g = g || d;
		var h = BIG_DATA_HOST + "api/eqx/scene/total/interact/" + b + "/" + c + "/" + e + "/" + g + "/stat.json?ts=" + (new Date).getTime();
		return a({
			withCredentials: !0,
			method: "GET",
			url: h
		})
	}, f.getSceneInteractiveHour = function(b, c) {
		c = c || d;
		var e = BIG_DATA_HOST + "api/eqx/scene/total/interacthour/" + b + "/" + c + "/stat.json?ts=" + (new Date).getTime();
		return a({
			withCredentials: !0,
			method: "GET",
			url: e
		})
	}, f.getSceneInteractionTotal = function(b, c, e) {
		c = c || d, e = e || d;
		var f = BIG_DATA_HOST + "api/eqx/scene/total/interaction/" + b + "/" + c.replace(/-/g, "") + "/" + e.replace(/-/g, "") + "/stat.json?ts=" + (new Date).getTime();
		return a({
			withCredentials: !0,
			method: "GET",
			url: f
		})
	}, f.getSceneInteractionDayHour = function(b, c, e) {
		c = c || d, e = e || d;
		var f = BIG_DATA_HOST + "api/eqx/scene/interaction/" + b + "/" + c.replace(/-/g, "") + "/" + e.replace(/-/g, "") + "/stat.json?ts=" + (new Date).getTime();
		return a({
			withCredentials: !0,
			method: "GET",
			url: f
		})
	}, f.getSceneDepth = function(b, c, e) {
		c = c || d, e = e || d;
		var f = BIG_DATA_HOST + "api/eqx/scene/depth/" + b + "/" + c.replace(/-/g, "") + "/" + e.replace(/-/g, "") + "/stat.json?ts=" + (new Date).getTime();
		return a({
			withCredentials: !0,
			method: "GET",
			url: f
		})
	}, f.getSceneTotalDevice = function(b, c, e, g) {
		c = c || f.type.SUMMERY, e = e || d, g = g || d;
		var h = BIG_DATA_HOST + "api/eqx/scene/total/device/" + b + "/" + c + "/" + e + "/" + g + "/stat.json?ts=" + (new Date).getTime();
		return a({
			withCredentials: !0,
			method: "GET",
			url: h
		})
	}, f.getSceneTotalQrc = function(b, c) {
		var d = BIG_DATA_HOST + "api/eqx/scene/total/qrctotal/" + b + "/" + c + "/stat.json?ts=" + (new Date).getTime();
		return a({
			withCredentials: !0,
			method: "GET",
			url: d
		})
	}, f.getSceneDateQrc = function(b, c, e, f) {
		e = e || d, f = f || d;
		var g = BIG_DATA_HOST + "api/eqx/scene/total/qrcdays/" + b + "/" + c + "/" + e + "/" + f + "/stat.json?ts=" + (new Date).getTime();
		return a({
			withCredentials: !0,
			method: "GET",
			url: g
		})
	}, f.getSceneHoursQrc = function(b, c, d) {
		var e = BIG_DATA_HOST + "api/eqx/scene/total/qrchours/" + b + "/" + c + "/" + d + "/stat.json?ts=" + (new Date).getTime();
		return a({
			withCredentials: !0,
			method: "GET",
			url: e
		})
	}, f
}]).value("interactionNameMap", {
	1120601: "链接",
	1120602: "电话",
	1120603: "触发",
	1120604: "音效",
	1120605: "喜欢",
	1120606: "顶起",
	1120607: "送花",
	1120608: "投票",
	1120609: "自定义",
	1120610: "微信头像",
	1120611: "微信照片",
	1120612: "微信声音",
	11207: "留言板",
	11208: "单选",
	11209: "多选",
	11210: "下拉列表",
	11211: "评分"
}), angular.module("chinaProvince", []).service("chinaProvinceConvert", ["chinaProvinceNameMap", function(a) {
	var b = a,
		c = {},
		d = echarts.getMap("china").geoJson.features;
	return d.forEach(function(a) {
		for (var d in b) if (b[d] === a.properties.name) {
			c[d] = {
				name: a.properties.name,
				cp: a.properties.cp
			};
			break
		}
	}), function(a, b) {
		var d = [];
		return a.forEach(function(a) {
			var e, f = c[a.name];
			f && (e = {
				name: f.name
			}, b ? e.value = f.cp.concat(a.value) : e.value = a.value, d.push(e))
		}), d
	}
}]).value("chinaProvinceNameMap", {
	Guangdong: "广东",
	Shandong: "山东",
	Beijing: "北京",
	Jiangsu: "江苏",
	Henan: "河南",
	Zhejiang: "浙江",
	Hebei: "河北",
	Sichuan: "四川",
	Liaoning: "辽宁",
	Shaanxi: "陕西",
	Heilongjiang: "黑龙江",
	Jilin: "吉林",
	Fujian: "福建",
	Shanghai: "上海",
	Hunan: "湖南",
	Hubei: "湖北",
	"Nei Mongol": "内蒙古",
	Tianjin: "天津",
	Shanxi: "山西",
	Jiangxi: "江西",
	Anhui: "安徽",
	Gansu: "甘肃",
	Chongqing: "重庆",
	Guizhou: "贵州",
	Yunnan: "云南",
	Guangxi: "广西",
	Xinjiang: "新疆",
	Ningxia: "宁夏",
	Qinghai: "青海",
	"T ai-pei": "台北",
	"T ai-wan": "台湾",
	Xizang: "西藏"
}), angular.module("data.story.service", []).service("dataStoryService", ["$http", function(a) {
	var b = {};
	return b.getDataStoryDailyShare = function(b, c, d) {
		var e = {
			sceneId: b,
			startDate: c,
			endDate: d
		};
		return a({
			withCredentials: !0,
			method: "POST",
			url: PREFIX_ANALYSIS_HOST + "m/sa/ds/daily/" + b,
			headers: {
				"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
			},
			params: e
		})
	}, b.getDataStoryShareInfo = function(b) {
		return a({
			withCredentials: !0,
			method: "POST",
			url: PREFIX_ANALYSIS_HOST + "m/sa/ds/" + b,
			headers: {
				"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
			}
		})
	}, b.enableDataStoryStatistic = function(b, c) {
		c = c || "", -1 === c.indexOf("ds") && (c += (c.length ? "," : "") + "ds");
		var d = {
			sceneId: b,
			partner: c,
			enable: 1
		};
		return a({
			withCredentials: !0,
			method: "POST",
			url: PREFIX_ANALYSIS_HOST + "m/sa/enable",
			headers: {
				"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
			},
			params: d
		})
	}, b
}]), angular.module("tencent.mta", []).factory("mtaService", ["$http", "$timeout", "dateFilter", function(a, b, c) {
	var d = (c(new Date, "yyyy-MM-dd"), {});
	return d.getUserRealTime = function(b, c) {
		var d = {
			sceneId: b,
			page: c || 1
		};
		return a({
			withCredentials: !0,
			method: "GET",
			url: PREFIX_ANALYSIS_HOST + "m/sa/mta/realtime",
			headers: {
				"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
			},
			params: d
		})
	}, d.getAreaCity = function(b, c, d, e, f) {
		var g = {
			sceneId: b,
			startDate: c,
			endDate: d,
			idx: e || "pv,uv,vv,iv",
			typeIds: f || "1"
		};
		return a({
			withCredentials: !0,
			method: "POST",
			url: PREFIX_ANALYSIS_HOST + "m/sa/mta/city",
			headers: {
				"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
			},
			params: g
		})
	}, d.getCoreData = function(b, c, d, e) {
		var f = {
			sceneId: b,
			startDate: c,
			endDate: d,
			idx: e || "pv,uv,vv,iv"
		};
		return a({
			withCredentials: !0,
			method: "POST",
			url: PREFIX_ANALYSIS_HOST + "m/sa/mta/coreData",
			headers: {
				"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
			},
			params: f
		})
	}, d.getPageSpeed = function(b, c, d, e, f, g) {
		var h = {
			sceneId: b,
			startDate: c,
			endDate: d,
			idx: e || "visitor_speed",
			type: f || "area",
			typeContents: g || "1"
		};
		return a({
			withCredentials: !0,
			method: "POST",
			url: PREFIX_ANALYSIS_HOST + "m/sa/mta/pageSpeed",
			headers: {
				"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
			},
			params: h
		})
	}, d.getCompare = function(b, c, d) {
		var e = {
			sceneId: b,
			startDate: c,
			endDate: d
		};
		return a({
			withCredentials: !0,
			method: "POST",
			url: PREFIX_ANALYSIS_HOST + "m/sa/mta/compare",
			headers: {
				"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
			},
			params: e
		})
	}, d.getADTag = function(b, c, d, e, f) {
		var g = {
			sceneId: b,
			startDate: c,
			endDate: d,
			idx: e,
			adtags: f
		};
		return a({
			withCredentials: !0,
			method: "POST",
			url: PREFIX_ANALYSIS_HOST + "m/sa/mta/adtag",
			headers: {
				"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
			},
			params: g
		})
	}, d.getPortrait = function(b, c, d, e) {
		var f = {
			sceneId: b,
			startDate: c,
			endDate: d,
			idx: e || "sex,age,grade,profession"
		};
		return a({
			withCredentials: !0,
			method: "POST",
			url: PREFIX_ANALYSIS_HOST + "m/sa/mta/portrait",
			headers: {
				"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
			},
			params: f
		})
	}, d.getAreaProvince = function(b, c, d, e, f) {
		var g = {
			sceneId: b,
			startDate: c,
			endDate: d,
			idx: e || "pv,uv,vv,iv",
			typeIds: f || "1"
		};
		return a({
			withCredentials: !0,
			method: "POST",
			url: PREFIX_ANALYSIS_HOST + "m/sa/mta/province",
			headers: {
				"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
			},
			params: g
		})
	}, d.getClient = function(b, c, d, e, f, g) {
		var h = {
			sceneId: b,
			startDate: c,
			endDate: d,
			idx: e || "pv,uv,vv,iv",
			typeIds: f || "2",
			typeContents: g || "2,4,5,6,9,10"
		};
		return a({
			withCredentials: !0,
			method: "POST",
			url: PREFIX_ANALYSIS_HOST + "m/sa/mta/paraContent",
			headers: {
				"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
			},
			params: h
		})
	}, d.getClientPara = function(b, c, d, e, f) {
		var g = {
			sceneId: b,
			startDate: c,
			endDate: d,
			idx: e || "pv,uv,vv,iv",
			typeId: f || "1"
		};
		return a({
			withCredentials: !0,
			method: "POST",
			url: PREFIX_ANALYSIS_HOST + "m/sa/mta/para",
			headers: {
				"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
			},
			params: g
		})
	}, d.getDepth = function(b, c, d) {
		var e = {
			sceneId: b,
			startDate: c,
			endDate: d
		};
		return a({
			withCredentials: !0,
			method: "POST",
			url: PREFIX_ANALYSIS_HOST + "m/sa/mta/depth",
			headers: {
				"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
			},
			params: e
		})
	}, d.getOperator = function(b, c, d, e, f) {
		var g = {
			sceneId: b,
			startDate: c,
			endDate: d,
			idx: e || "pv,uv,vv,iv",
			typeIds: f
		};
		return a({
			withCredentials: !0,
			method: "POST",
			url: PREFIX_ANALYSIS_HOST + "m/sa/mta/operator",
			headers: {
				"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
			},
			params: g
		})
	}, d.enableMTAStatistic = function(b, c) {
		c = c || "", -1 === c.indexOf("mta") && (c += (c.length ? "," : "") + "mta");
		var d = {
			sceneId: b,
			partner: c,
			enable: 1
		};
		return a({
			withCredentials: !0,
			method: "POST",
			url: PREFIX_ANALYSIS_HOST + "m/sa/enable",
			headers: {
				"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
			},
			params: d
		})
	}, d
}]), angular.module("statistics.test.data", []).service("testData", [function() {
	return {
		testUV: {
			uv: 429,
			auv: 108,
			muv: 1,
			mauv: 201
		},
		testShareChannel: {
			other: 3086,
			groupmessage: 1800,
			qzone: 616,
			tsina: 812,
			timeline: 2e3,
			singlemessage: 121,
			sqq: 566
		},
		testSummeryDevice: {
			mobile: 521,
			pc: 72
		},
		testTop10Device: [{
			name: "MI 4C",
			value: 1046
		}, {
			name: "Samsung GT-I9305",
			value: 1023
		}, {
			name: "R7Plusm",
			value: 623
		}, {
			name: "Coolpad 8712",
			value: 569
		}, {
			name: "vivo Y13L",
			value: 442
		}, {
			name: "MI PAD",
			value: 313
		}, {
			name: "MI 4LTE",
			value: 210
		}, {
			name: "ZHUOMI",
			value: 166
		}, {
			name: "Huawei P7",
			value: 51
		}, {
			name: "Samsung GT-I9300",
			value: 21
		}]
	}
}]), angular.module("spread.statistics.shareStatistics", ["statistic.share.channel", "data.story.share.statistic"]).controller("ShareStatisticsCtrl", ["$scope", "$routeParams", "bigDataService", "testData", "dataStoryService", function(a, b, c, d, e) {
	a.shareChannel = {
		other: 0,
		groupmessage: 0,
		qzone: 0,
		tsina: 0,
		timeline: 0,
		singlemessage: 0,
		sqq: 0
	}, a.isAllowedToAccessShareStatistic ? a.$watch("dateRange", function(d) {
		d && c.getSceneTotalShareType(b.sceneId, d.type, d.startTime, d.endTime).then(function(b) {
			b.data.success && (a.shareChannel = b.data.obj)
		})
	}, !0) : a.shareChannel = d.testShareChannel, a.isCurrentDataStoryShareChannel = !0, a.dataStoryShareInfo = {
		shareLevels: {
			stat: {
				size: 0
			}
		},
		uvpvipCount: {
			total: [0, 0, 0, 0]
		}
	}, e.getDataStoryShareInfo(b.sceneId).then(function(b) {
		b.data.success && (a.dataStoryShareInfo = b.data.map)
	}), a.shareChannelProvider = "eqxiu"
}]).directive("shareStatistics", [function() {
	return {
		replace: !0,
		templateUrl: "spread/tab/statistics/share-statistics.tpl.html",
		controller: "ShareStatisticsCtrl"
	}
}]), angular.module("spread.statistics.summery", ["chinaProvince"]).controller("SummeryViewInfoCtrl", ["$scope", "bigDataService", "testData", "dateFilter", function(a, b, c, d) {
	a.summeryPVUV = {
		pv: 0,
		uv: 0,
		apv: 0,
		auv: 0,
		mpv: 0,
		muv: 0,
		mapv: 0,
		mauv: 0
	}, b.getSceneTotalPVUV(a.sceneId).then(function(b) {
		b.data.success && (a.summeryPVUV = b.data.obj)
	}), a.summeryInteractive = {
		total: 0,
		link: 0,
		tel: 0
	}, b.getSceneInteractionTotal(a.sceneId, d(new Date(a.scene.createTime), "yyyy-MM-dd")).then(function(b) {
		if (b.data.success) {
			var c = b.data.obj || {},
				d = 0;
			a.summeryInteractive.link = c[1120601] || 0, a.summeryInteractive.tel = c[1120602] || 0, angular.forEach(c, function(a, b) {
				d += parseInt(a, 10) || 0
			}), a.summeryInteractive.total = d
		}
	}), a.shareChannel = {
		other: 0,
		groupmessage: 0,
		qzone: 0,
		tsina: 0,
		timeline: 0,
		singlemessage: 0,
		sqq: 0
	}, a.isAllowedToAccessShareStatistic ? b.getSceneTotalShareType(a.sceneId, b.type.SUMMERY).then(function(b) {
		b.data.success && (a.shareChannel = b.data.obj)
	}) : a.shareChannel = c.testShareChannel, a.summeryRegion = [], b.getSceneTotalRegion(a.sceneId, b.type.SUMMERY).then(function(b) {
		b.data.success && (a.summeryRegion = b.data.obj)
	}), a.summeryDevice = {}, a.top10Device = [], a.isAllowedToAccessDeviceStatistic ? (b.getSceneTotalPlatform(a.sceneId, b.type.SUMMERY).then(function(b) {
		b.data.success && (a.summeryDevice = b.data.obj)
	}), b.getSceneTotalDevice(a.sceneId, b.type.SUMMERY).then(function(b) {
		b.data.success && (a.top10Device = b.data.obj)
	})) : (a.summeryDevice = c.testSummeryDevice, a.top10Device = c.testTop10Device)
}]).directive("summeryViewInfo", [function() {
	return {
		replace: !0,
		templateUrl: "spread/tab/statistics/summery.tpl.html",
		controller: "SummeryViewInfoCtrl"
	}
}]).controller("SummeryPVCtrl", ["$scope", function(a) {}]).directive("summeryPv", [function() {
	return {
		controller: "SummeryPVCtrl",
		scope: {
			summeryPv: "="
		},
		template: '<div class="max bigger">\n    <span class="num">{{summeryPv.mapv}}</span>\n    <span class="tip">日最高(PV)</span>\n</div>\n<div class="min bigger">\n    <span class="num">{{summeryPv.mpv}}</span>\n    <span class="tip">日最低(PV)</span>\n</div>\n<div class="average bigger">\n    <span class="num">{{summeryPv.apv}}</span>\n    <span class="tip">平均(PV)</span>\n</div>\n<div class="all-pv bigger">\n    <span class="num">{{summeryPv.pv}}</span>\n    <span class="tip">总浏览次数</span>\n    <span class="emphasis">PV</span>\n</div>\n<div class="rolline">\n    <svg version="1.1" id="图层_1" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="160px" height="160px"\n	 viewBox="0 0 160 160" enable-background="new 0 0 160 160" xml:space="preserve">\n<path fill="#fff" d="M150.078,80.31v-0.62H160v0.62H150.078z M149.784,73.583l9.885-0.864l0.054,0.617l-9.885,0.865\n	L149.784,73.583z M148.959,67.526l9.772-1.723l0.107,0.611l-9.771,1.723L148.959,67.526z M147.609,61.563l9.585-2.568l0.16,0.599\n	l-9.584,2.568L147.609,61.563z M145.745,55.741l9.324-3.394l0.212,0.583l-9.324,3.393L145.745,55.741z M143.381,50.103l8.993-4.193\n	l0.262,0.562l-8.993,4.193L143.381,50.103z M140.534,44.693l8.593-4.962l0.31,0.538l-8.593,4.961L140.534,44.693z M137.226,39.551\n	l8.128-5.691l0.356,0.508l-8.128,5.691L137.226,39.551z M133.483,34.718l7.601-6.379l0.399,0.476l-7.601,6.378L133.483,34.718z\n	 M129.333,30.228l7.016-7.016l0.439,0.439l-7.016,7.016L129.333,30.228z M124.807,26.118l6.378-7.601l0.476,0.399l-6.378,7.601\n	L124.807,26.118z M119.941,22.418l5.691-8.128l0.508,0.356l-5.691,8.128L119.941,22.418z M114.77,19.156l4.961-8.593l0.538,0.31\n	l-4.962,8.593L114.77,19.156z M109.335,143.643l0.562-0.262l4.194,8.993l-0.563,0.262L109.335,143.643z M109.335,16.357l4.193-8.993\n	l0.563,0.262l-4.194,8.993L109.335,16.357z M103.677,145.957l0.582-0.212l3.394,9.324l-0.583,0.212L103.677,145.957z\n	 M103.677,14.043l3.393-9.324l0.583,0.212l-3.394,9.324L103.677,14.043z M97.838,147.77l0.599-0.161l2.568,9.585l-0.599,0.16\n	L97.838,147.77z M97.838,12.23l2.568-9.584l0.599,0.16l-2.568,9.585L97.838,12.23z M91.863,149.067l0.611-0.108l1.723,9.772\n	l-0.611,0.107L91.863,149.067z M91.863,10.933l1.723-9.771l0.611,0.107l-1.723,9.772L91.863,10.933z M85.799,149.838l0.618-0.054\n	l0.864,9.885l-0.617,0.054L85.799,149.838z M85.799,10.162l0.865-9.885l0.617,0.054l-0.864,9.885L85.799,10.162z M79.69,150.078\n	h0.62V160h-0.62V150.078z M79.69,0h0.62v9.922h-0.62V0z M72.719,159.669l0.864-9.885l0.618,0.054l-0.865,9.885L72.719,159.669z\n	 M72.719,0.331l0.617-0.054l0.865,9.885l-0.618,0.054L72.719,0.331z M65.803,158.731l1.723-9.772l0.611,0.108l-1.723,9.771\n	L65.803,158.731z M65.803,1.269l0.611-0.107l1.723,9.771l-0.611,0.108L65.803,1.269z M58.995,157.194l2.568-9.585l0.599,0.161\n	l-2.568,9.584L58.995,157.194z M58.995,2.806l0.599-0.16l2.568,9.584l-0.599,0.161L58.995,2.806z M52.347,155.069l3.394-9.324\n	l0.582,0.212l-3.393,9.324L52.347,155.069z M52.347,4.931l0.583-0.212l3.393,9.324l-0.582,0.212L52.347,4.931z M45.909,152.374\n	l4.194-8.993l0.562,0.262l-4.193,8.993L45.909,152.374z M45.909,7.626l0.563-0.262l4.193,8.993l-0.562,0.262L45.909,7.626z\n	 M39.731,149.127l4.962-8.593l0.537,0.31l-4.961,8.593L39.731,149.127z M39.731,10.873l0.538-0.31l4.961,8.593l-0.537,0.31\n	L39.731,10.873z M39.551,22.774l-5.691-8.128l0.508-0.356l5.691,8.128L39.551,22.774z M34.717,26.517l-6.378-7.601l0.476-0.399\n	l6.378,7.601L34.717,26.517z M30.229,30.667l-7.017-7.016l0.439-0.439l7.016,7.016L30.229,30.667z M26.118,35.193l-7.601-6.378\n	l0.399-0.476l7.601,6.379L26.118,35.193z M22.418,40.059l-8.128-5.691l0.356-0.508l8.128,5.691L22.418,40.059z M19.156,45.23\n	l-8.593-4.961l0.31-0.538l8.593,4.962L19.156,45.23z M16.357,50.665l-8.993-4.193l0.262-0.562l8.993,4.193L16.357,50.665z\n	 M14.043,56.323L4.719,52.93l0.212-0.583l9.324,3.394L14.043,56.323z M12.23,62.162l-9.584-2.568l0.16-0.599l9.585,2.568\n	L12.23,62.162z M10.933,68.137l-9.771-1.723l0.107-0.611l9.772,1.723L10.933,68.137z M10.162,74.201l-9.885-0.865l0.055-0.617\n	l9.884,0.864L10.162,74.201z M9.923,80.31H0v-0.62h9.923V80.31z M10.216,86.417l-9.884,0.864l-0.055-0.617l9.885-0.865\n	L10.216,86.417z M11.041,92.474l-9.772,1.723l-0.107-0.61l9.771-1.724L11.041,92.474z M12.391,98.437l-9.585,2.568l-0.16-0.599\n	l9.584-2.568L12.391,98.437z M14.255,104.259l-9.324,3.394l-0.212-0.583l9.324-3.393L14.255,104.259z M16.619,109.897l-8.993,4.194\n	l-0.262-0.563l8.993-4.193L16.619,109.897z M19.466,115.307l-8.593,4.962l-0.31-0.538l8.593-4.961L19.466,115.307z M22.774,120.449\n	l-8.128,5.691l-0.356-0.508l8.128-5.691L22.774,120.449z M26.517,125.283l-7.601,6.378l-0.399-0.475l7.601-6.379L26.517,125.283z\n	 M30.667,129.772l-7.016,7.016l-0.439-0.439l7.017-7.016L30.667,129.772z M35.193,133.882l-6.378,7.601l-0.476-0.399l6.378-7.601\n	L35.193,133.882z M40.059,137.582l-5.691,8.128l-0.508-0.356l5.691-8.128L40.059,137.582z M120.269,149.127l-0.538,0.31\n	l-4.961-8.593l0.537-0.31L120.269,149.127z M120.449,137.226l5.691,8.128l-0.508,0.356l-5.691-8.128L120.449,137.226z\n	 M125.283,133.483l6.378,7.601l-0.476,0.399l-6.378-7.601L125.283,133.483z M129.772,129.333l7.016,7.016l-0.439,0.439l-7.016-7.016\n	L129.772,129.333z M133.882,124.807l7.601,6.379l-0.399,0.475l-7.601-6.378L133.882,124.807z M137.582,119.941l8.128,5.691\n	l-0.356,0.508l-8.128-5.691L137.582,119.941z M140.844,114.77l8.593,4.961l-0.31,0.538l-8.593-4.962L140.844,114.77z\n	 M143.643,109.335l8.993,4.193l-0.262,0.563l-8.993-4.194L143.643,109.335z M145.957,103.677l9.324,3.393l-0.212,0.583l-9.324-3.394\n	L145.957,103.677z M147.77,97.838l9.584,2.568l-0.16,0.599l-9.585-2.568L147.77,97.838z M149.067,91.863l9.771,1.724l-0.107,0.61\n	l-9.772-1.723L149.067,91.863z M149.838,85.799l9.885,0.865l-0.054,0.617l-9.885-0.864L149.838,85.799z"/>\n</svg>\n</div>'
	}
}]).directive("summeryInteractiveShort", [function() {
	return {
		controller: ["$scope", function(a) {
			a.summeryInteractiveComponent = {
				name: "互动总次数",
				nickname: "总次数",
				key: "total",
				color: "#59c7f9"
			}, a.summeryInteractiveTel = {
				name: "电话互动次数",
				nickname: "电话",
				key: "tel",
				color: "#48d5b2"
			}, a.summeryInteractiveLink = {
				name: "链接点击次数",
				nickname: "链接",
				key: "link",
				color: "#ff79a2"
			}
		}],
		scope: {
			summeryInteractive: "=summeryInteractiveShort"
		},
		template: '<div class="summery-interactive-short">\n    <div class="interactive-chart-group">\n        <div class="interactive-chart" summery-interactive-pie-chart="summeryInteractiveComponent" is-summery total="summeryInteractive.total" current="summeryInteractive.total"></div>\n        <div class="interactive-tip">\n            <span class="num-sm">{{summeryInteractive.total}}</span>\n            <span class="tip">互动总次数</span>\n        </div>\n    </div>\n    <div class="interactive-chart-group">\n        <div class="interactive-chart" summery-interactive-pie-chart="summeryInteractiveTel" total="summeryInteractive.total" current="summeryInteractive.tel"></div>\n        <div class="interactive-tip">\n            <span class="num-sm">{{summeryInteractive.tel}}</span>\n            <span class="tip">电话互动次数</span>\n        </div>\n    </div>\n    <div class="interactive-chart-group">\n        <div class="interactive-chart" summery-interactive-pie-chart="summeryInteractiveLink" total="summeryInteractive.total" current="summeryInteractive.link"></div>\n        <div class="interactive-tip">\n            <span class="num-sm">{{summeryInteractive.link}}</span>\n            <span class="tip">链接点击次数</span>\n        </div>\n    </div>\n</div>\n'
	}
}]).controller("SummeryRegionCtrl", ["$scope", "$element", "chinaProvinceConvert", "$location", "$routeParams", "chinaProvinceNameMap", function(a, b, c, d, e, f) {
	var g = b.find(".region-map"),
		h = echarts.init(g.get(0), "eqxiu"),
		i = {
			name: "访问地域",
			type: "map",
			mapType: "china",
			data: [],
			label: {
				normal: {
					show: !1,
					formatter: "{b}"
				},
				emphasis: {
					show: !1
				}
			},
			itemStyle: {
				normal: {
					areaColor: "rgb(187, 232, 252)",
					borderColor: "#fff",
					borderWidth: 1
				},
				emphasis: {
					areaColor: "rgb(89, 199, 249)"
				}
			},
			zlevel: 1
		},
		j = {
			tooltip: {
				trigger: "item",
				formatter: function(a) {
					return a.name + "<br/>" + (a.value || 0)
				}
			},
			visualMap: {
				show: !1,
				min: 0,
				max: 10,
				x: "50",
				y: "bottom",
				text: ["高", "低"],
				calculable: !0,
				inRange: {
					color: ["rgb(187, 232, 252)", "rgb(2, 119, 189)"]
				}
			},
			series: [i]
		};
	h.setOption(j), a.$watch("summeryRegion", function(a) {
		if (a) {
			var b = [],
				c = 0;
			a.forEach(function(a) {
				var d, e = f[a.name];
				e && (d = {
					name: e,
					value: a.value || 0
				}, b.push(d), c = c > d.value ? c : d.value)
			}), i.data = b, j.visualMap.max = c || 1, h.setOption(j)
		}
	}), a.navToAd = function() {
		a.$parent.viewControl.tab = "share", a.$parent.viewControl.subtab = "thirdWeb", d.path("share/" + e.sceneId + "/thirdWeb", !1)
	}
}]).directive("summeryRegion", [function() {
	return {
		controller: "SummeryRegionCtrl",
		scope: {
			summeryRegion: "="
		},
		template: '<div class="region-map"></div>\n<div class="top-list-region" top-list-region></div>\n<div class="top-list-region top-list-region-mask" ng-hide="summeryRegion.length">\n    <a ng-click="navToAd()">还没有访问量，点击这里试试</a>\n    <p><img style="width: 100px;margin-top: 20px;margin-left: 20px;" ng-src="{{noDataImg}}"></p>\n</div>'
	}
}]).controller("TopListRegionCtrl", ["$element", "$scope", "chinaProvinceConvert", function(a, b, c) {
	b.noDataImg = CLIENT_CDN + "assets/images/userdata.svg";
	var d = {
		type: "bar",
		data: [],
		label: {
			normal: {
				show: !0,
				position: "inside"
			}
		},
		barWidth: 30,
		barMinHeight: 30
	},
		e = {
			title: {
				text: "浏览量最高5个省市",
				left: "left",
				textStyle: {
					fontSize: 12
				}
			},
			textStyle: {
				color: "#eee"
			},
			tooltip: {
				trigger: "axis"
			},
			grid: {
				left: "3%",
				right: "4%",
				bottom: "3%",
				containLabel: !0
			},
			xAxis: {
				show: !1,
				type: "value"
			},
			yAxis: {
				type: "category",
				data: [],
				axisLine: {
					show: !1
				},
				axisTick: {
					show: !1
				}
			},
			series: [d]
		},
		f = echarts.init(a.get(0), "eqxiu");
	f.setOption(e);
	var g = f._theme.color;
	b.$watch("summeryRegion", function(a) {
		if (a) {
			var b = e.yAxis.data = [],
				h = d.data = [],
				i = c(a.slice(0, 5));
			if (i.forEach(function(a, c) {
				b.unshift(a.name), h.unshift({
					value: a.value,
					name: a.name,
					itemStyle: {
						normal: {
							color: g[c]
						}
					}
				})
			}), i.length > 0 && i.length < 5) for (var j = i.length; 5 > j; j++) b.unshift(""), h.unshift({
				value: 0,
				name: "",
				itemStyle: {
					normal: {
						color: "#e6ebed"
					},
					emphasis: {
						color: "#e6ebed"
					}
				}
			});
			f.setOption(e)
		}
	})
}]).directive("topListRegion", [function() {
	return {
		controller: "TopListRegionCtrl",
		template: '<div class="top-list-region"></div>'
	}
}]), angular.module("spread.statistics.textMessageStatistics", []).controller("TextMessageStatisticsCtrl", ["$scope", "$element", function(a, b) {}]).directive("textMessageStatistics", [function() {
	return {
		replace: !0,
		templateUrl: "spread/tab/statistics/text-message-statistics.tpl.html",
		controller: "TextMessageStatisticsCtrl"
	}
}]).controller("TextMessageAnalysisCtrl", ["$scope", "$element", function(a, b) {
	var c = b.find(".text-message-chart"),
		d = echarts.init(c.get(0), "eqxiu"),
		e = {
			tooltip: {
				trigger: "axis"
			},
			legend: {
				data: ["访问次数"]
			},
			xAxis: [{
				type: "category",
				data: ["1点", "2点", "3点", "4点", "5点", "6点", "7点", "8点", "9点", "10点", "11点", "12点"]
			}],
			yAxis: [{
				type: "value",
				name: "次数"
			}],
			series: [{
				name: "访问次数",
				type: "line",
				data: [32, 26, 20, 19, 8, 7, 6, 5, 4, 3, 2, 1]
			}]
		};
	d.setOption(e)
}]).directive("textMessageAnalysis", [function() {
	return {
		controller: "TextMessageAnalysisCtrl",
		template: '<div class="basic-chart text-message-chart"></div>\n<div class="basic-legend text-message-legend"></div>'
	}
}]), angular.module("spread.statistics.userStatistics", ["mta.realtime.user", "mta.user.compare", "mta.user.portrait", "data.story.user.portrait"]).controller("UserStatisticsCtrl", ["$scope", "$routeParams", "dataStoryService", "dataStoryUserPortraitMockDataService", function(a, b, c, d) {
	a.userPortraitProvider = "tencent", a.dataStoryUserInfo = d, c.getDataStoryShareInfo(b.sceneId).then(function(b) {
		b.data.success && (a.dataStoryUserInfo = b.data.map)
	})
}]).directive("userStatistics", [function() {
	return {
		replace: !0,
		templateUrl: "spread/tab/statistics/user-statistics.tpl.html",
		controller: "UserStatisticsCtrl"
	}
}]).service("dataStoryUserPortraitMockDataService", [function() {
	return {
		visitorSex: {
			f: 1356,
			m: 2620
		},
		business: [{
			cate: "购房新人",
			weights: 131.15,
			labels: {
				"客户": .13237546384334564,
				"企业": .13310647010803223,
				"专业": .13313619792461395,
				"公司": .13353639841079712,
				"项目": .1366223841905594,
				"商业": .1254703253507614
			},
			no: 0
		}, {
			cate: "旅行达人",
			weights: 46.76,
			labels: {
				"旅游": .3522144556045532
			},
			no: 1
		}, {
			cate: "吃货一族",
			weights: 218.57,
			labels: {
				"单人": .1344882696866989
			},
			no: 2
		}, {
			cate: "职场新人",
			weights: 121.5,
			labels: {
				"短信平台": .1322401612997055,
				"企业": .21023473143577576,
				"表单": .1668333262205124,
				"公司": .21148908138275146,
				"团队": .14783506095409393,
				"项目": .17149147391319275,
				"参会": .23309801518917084,
				"简历": .42757025361061096,
				"报名": .182511106133461,
				"客户": .1527773141860962,
				"专业": .18802939355373383,
				"单位": .16048233211040497,
				"拓展": .13279567658901215,
				"数字营销": .16303424537181854,
				"方达": .12560002505779266,
				"工作": .20224632322788239,
				"行业": .1787743866443634,
				"创业": .18617784976959229,
				"创业者": .1666150838136673
			},
			no: 3
		}, {
			cate: "IT达人",
			weights: 840.37,
			labels: {
				"企业": .1647150218486786,
				"表单": .19657808542251587,
				"公司": .13286852836608887,
				"技术": .18564924597740173,
				"项目": .13893748819828033,
				"产业联盟": .15121304988861084,
				"厂商": .15286746621131897,
				"大数据": .2968900501728058,
				"阿里云": .17345643043518066,
				"互联网": .20288391411304474,
				"腾讯": .16306480765342712,
				"商业": .1380893439054489,
				"客户": .1274903416633606,
				"平台": .19315160810947418,
				"数据": .13558197021484375,
				"数字营销": .22206933796405792,
				"产品": .14009220898151398,
				"科技": .13089324533939362,
				"主流": .13327336311340332,
				"行业": .15003570914268494,
				"服务": .12917427718639374,
				"创业者": .13698036968708038
			},
			no: 4
		}, {
			cate: "数码一族",
			weights: 123.11,
			labels: {
				"短信平台": .13588054478168488,
				"华为": .13765832781791687,
				"三星": .24358272552490234,
				"联想": .21125461161136627,
				"产业联盟": .13801175355911255,
				"大数据": .14691951870918274,
				"服务": .1371440887451172,
				"厂商": .1613476425409317,
				"互联网": .17495863139629364,
				"手机": .23106367886066437,
				"智能": .13448882102966309
			},
			no: 5
		}, {
			cate: "理财达人",
			weights: 32.76,
			labels: {
				"客户": .19840410351753235,
				"企业": .14429506659507751,
				"单位": .14951109886169434,
				"公司": .18265031278133392
			},
			no: 6
		}, {
			cate: "养生达人",
			weights: 39.19,
			labels: {},
			no: 8
		}, {
			cate: "居家达人",
			weights: 80.56,
			labels: {
				"产品": .1407185196876526,
				"元素": .12630659341812134
			},
			no: 11
		}, {
			cate: "音乐达人",
			weights: 179.09,
			labels: {},
			no: 19
		}, {
			cate: "影视达人",
			weights: 160.74,
			labels: {},
			no: 20
		}, {
			cate: "摄影达人",
			weights: 477.61,
			labels: {
				"单人": .13088342547416687
			},
			no: 22
		}]
	}
}]), angular.module("spread.share.buyerMess", ["spread.share.messagePost"]), angular.module("spread.share.buyerMess").controller("buyMessage", ["$scope", "dataService", "messageNumberFn", "i18nNotifications", function(a, b, c, d) {
	a.messageNumber = c, a.cancel = function() {
		a.$close()
	}, a.getUserXd(), a.getMessModel = function() {
		b.getMessModel(2).then(function(b) {
			a.getMessModels = b.data.list
		})
	}, a.getMessModel(), a.model = {
		layout: ""
	}, a.confirm = function() {
		return a.model.layout ? a.model.layout.price > a.userXd ? void d.pushForCurrentRoute("spread.share.messagebuyxdless", "notify.success") : (a.userXd -= a.model.layout.price, b.buyMess(a.model.layout.id).then(function(b) {
			b.data.success && a.messageNumber()
		}), void a.$close()) : void d.pushForCurrentRoute("spread.share.messagebuylayout", "notify.success")
	}
}]), angular.module("spread.share.checkScene", ["services.usercenter"]), angular.module("spread.share.checkScene").controller("CheckSceneCtrl", ["$scope", "$rootScope", "usercenterService", "ModalService", "$modal", "$timeout", function(a, b, c, d, e, f) {
	function g() {
		d.openConfirmDialog({
			msg: "您的秀点不足抵扣" + a.showPoint + "个秀点，立即购买秀点",
			confirmName: "确定",
			cancelName: "取消"
		}, function() {
			e.open({
				windowClass: "console",
				templateUrl: "usercenter/buyXd.tpl.html",
				controller: "BuyXdController",
				resolve: {
					getUserXd: function() {
						return function() {}
					}
				}
			}).result.then(function() {}, function() {})
		}, function() {})
	}
	a.showPoint = 10;
	var h = function(b) {
			return !a.scene.publishTime || a.scene.publish && a.scene.updateTime <= a.scene.publishTime ? void d.openConfirmDialog({
				msg: a.scene.publish ? "该场景有更新，进行审核时，会保存发布场景" : "该场景未发布，进行审核时，会先发布场景",
				confirmName: "同意",
				cancelName: "不同意"
			}, function() {
				a.publishScene(null, a.scene, b)
			}) : 2 == a.scene.status ? void d.openConfirmDialog({
				msg: "当前场景为不允许访问状态，发布场景将重新对外开放访问 ",
				confirmName: "坚持发布",
				cancelName: "退出"
			}, function() {
				a.publishScene(null, a.scene, b)
			}) : void a.publishScene(null, a.scene, b)
		};
	f(function() {
		!a.scene || (2 != a.user.type && 21 != a.user.type || !a.user.memberType || 3 != a.user.memberType && 4 != a.user.memberType && 7 != a.user.memberType && 8 != a.user.memberType && 9 != a.user.memberType) && 5 != a.user.type ? a.checkQian = !1 : a.checkQian = !0, (2 == a.user.type || 21 == a.user.type) && a.user.memberType && 6 != a.user.memberType || 4 == a.user.type || 5 == a.user.type ? a.checkBo = !0 : a.checkBo = !1
	}, 300), a.checkScene = function(b) {
		if ("1" == a.scene.isExpedited) return void d.openMsgDialog({
			msg: "场景已在加急审核中，请耐心等待",
			btn: "关闭"
		});
		if (-2 == a.scene.status) {
			if ("1" == b) return void d.openMsgDialog({
				msg: "场景审核中不能使用前置审核，如果想要加急，可以使用驳回加急审核",
				btn: "关闭"
			});
			if ("2" == b) return void h(b)
		}
		if (-1 != a.scene.status) return "2" == b ? void d.openMsgDialog({
			msg: "场景未被驳回，暂不能使用",
			btn: "关闭"
		}) : void h(b);
		if ("1" == b) return void d.openMsgDialog({
			msg: "场景被驳回，请使用驳回加急审核",
			btn: "关闭"
		});
		if ("2" == b) {
			if (a.scene.publishTime && a.scene.updateTime <= a.scene.publishTime) return void d.openMsgDialog({
				msg: "您未对已驳回场景做任何修改，无法提交审核",
				btn: "关闭"
			});
			h(b)
		}
	};
	var i = Date.parse(new Date),
		j = function() {
			c.getPhoneMessageTime().then(function(b) {
				b.data.success && (a.dataTime = b.data.obj, a.dataTime && a.dataTime > i ? a.messageTime = !0 : a.messageTime = !1)
			})
		};
	j(), a.messageAction = function() {
		1 != b.user.checkPhone ? d.openConfirmDialog({
			msg: "您未绑定手机号，不能接受短信消息，立即去绑定",
			confirmName: "确定",
			cancelName: "取消"
		}, function() {
			e.open({
				windowClass: "six-contain mobile-contain",
				templateUrl: "usercenter/console/checkMobile.tpl.html",
				controller: "CheckMobileCtrl",
				scope: a,
				resolve: {
					userinfo: function() {
						return {
							title: "绑定手机号",
							phone: ""
						}
					}
				}
			}).result.then(function(a) {
				b.user.phone = a, b.user.checkPhone = 1
			}, function() {})
		}, function() {}) : 9 == b.user.memberType || 7 == b.user.memberType || 8 == b.user.memberType ? k() : (1 == b.user.type ? a.showPoint = 100 : 2 != b.user.type && 21 != b.user.type || b.user.memberType ? a.showPoint = 10 : a.showPoint = 50, a.userXd < a.showPoint ? g() : d.openConfirmDialog({
			msg: "开通消息提醒，需要使用" + a.showPoint + "个秀点",
			confirmName: "确定",
			cancelName: "取消"
		}, function() {
			k()
		}))
	};
	var k = function() {
			c.phoneMessage().then(function(c) {
				c.data.success ? (b.$broadcast("userXd"), d.openMsgDialog({
					msg: "短信接收场景审核消息功能已开通",
					btn: "确定"
				}, function() {
					j()
				})) : 130001 == c.data.code && d.openConfirmDialog({
					msg: "您的秀点不足抵扣" + a.showPoint + "个秀点，立即购买秀点",
					confirmName: "确定",
					cancelName: "取消"
				}, function() {
					e.open({
						windowClass: "console",
						templateUrl: "usercenter/buyXd.tpl.html",
						controller: "BuyXdController",
						resolve: {
							getUserXd: function() {
								return function() {}
							}
						}
					}).result.then(function() {}, function() {})
				}, function() {})
			})
		}
}]), angular.module("spread.share.domainBind", ["services.usercenter", "services.i18nNotifications"]), angular.module("spread.share.domainBind").controller("DomainBindCtrl", ["$scope", "$rootScope", "usercenterService", "i18nNotifications", "security", function(a, b, c, d, e) {
	a.showController = {}, a.userType = e.currentUser.type, a.userMemberType = e.currentUser.memberType, a.goStep = function(b) {
		a.showController.step = b
	}, a.bindDomain = function() {
		a.showController.agreeBind = !0
	}, a.reApply = function() {
		a.isShowBindPanel = !0, a.showController.agreeBind = !1, (1 == a.status || 2 == a.status) && (a.showController.step = 3, a.model.url1 = a.domainInfo.url.split(".")[0], a.model.url2 = a.domainInfo.url.split(".")[1], a.model.url3 = a.domainInfo.url.split(".")[2], a.model.appId = a.domainInfo.appId, a.model.secretId = a.domainInfo.secretId)
	};
	var f = function() {
			c.getDomain().then(function(b) {
				if (b.data.success) if (a.domainInfo = b.data.obj, 1 == a.domainInfo.status || 2 == a.domainInfo.status ? 90 == a.domainInfo.buyTime ? (a.model.day = b.data.obj.typeList[2], a.typeIndex = 2) : 180 == a.domainInfo.buyTime ? (a.model.day = b.data.obj.typeList[1], a.typeIndex = 1) : 360 == a.domainInfo.buyTime && (a.model.day = b.data.obj.typeList[0], a.typeIndex = 0) : (a.model.day = b.data.obj.typeList[0], a.typeIndex = 0), b.data.obj.id) {
					a.isShowBindPanel = !1, a.domainInfo.ipAddress = "202.173.11.90";
					var c = a.status = b.data.obj.status;
					1 === c ? (a.domainMes = "正常使用", a.unbind = !1, a.domainInfo.restTime = Math.floor((a.domainInfo.endDate - a.domainInfo.startDate) / 864e5)) : 2 === c ? (a.domainMes = "审核中", a.unbind = !1) : 3 === c ? (a.domainMes = "审核失败", a.unbind = !0) : 4 === c ? a.domainMes = "停用" : (new Date).getTime() > b.data.obj.endDate && (a.status = 5, a.domainMes = "到期", a.unbind = !0)
				} else a.isShowBindPanel = !0
			})
		};
	f(), a.getUserXd = function() {
		c.getUserXd().then(function(b) {
			b.data.success && (a.xdCounts = b.data.obj)
		})
	}, a.getUserXd(), a.model || (a.model = {});
	var g = a.model;
	a.checkDomainFormat = function(b) {
		return b.url1 ? a.domainFormatErr1 = !1 : a.domainFormatErr1 = !0, b.url2 ? a.domainFormatErr2 = !1 : a.domainFormatErr2 = !0, b.url3 ? a.domainFormatErr3 = !1 : a.domainFormatErr3 = !0, b.appId ? a.domainFormatErr4 = !0 : a.domainFormatErr4 = !0, b.secretId ? a.domainFormatErr5 = !0 : a.domainFormatErr5 = !0, b.url1 && b.url2 && b.url3 && b.appId && b.secretId ? !0 : void 0
	}, a.checkDayFormat = function(b) {
		return b.day ? (a.dayFormatErr = "", !0) : (a.dayFormatErr = "请选择有效期", !1)
	}, a.checkAppIdAndSecret = function(b) {
		return b.appId && !b.secretId ? (a.appIdFormatErr = "请填写您的APPSECRET", !1) : !b.appId && b.secretId ? (a.appSecretErr = "请填写您的APPID", !1) : (a.appIdFormatErr = "", a.appSecretErr = "", !0)
	}, a.submit = function() {
		if (a.model.url = a.model.url1 + "." + a.model.url2 + "." + a.model.url3, a.checkDomainFormat(g) && a.checkDayFormat(g) && a.checkAppIdAndSecret(g)) if (1 == a.status || 2 == a.status) c.repairBindDomain(a.model.url).then(function(b) {
			b.data.success ? (alert("域名绑定申请已经提交"), a.status = 2, a.isShowBindPanel = !1, a.domainInfo.ipAddress = "202.173.11.90", a.domainInfo.url = g.url) : alert(b.data.msg)
		});
		else if (5 == a.userType || 7 == a.userMemberType || 8 == a.userMemberType || 9 == a.userMemberType ? (a.cost = g.day.label = 0, g.day.value = "365") : a.cost = g.day.label, a.xdCounts >= parseInt(a.cost, 10)) {
			var b = {
				url: g.url,
				buyTime: g.day.value,
				appId: g.appId,
				secretId: g.secretId
			};
			c.bindDomain(b).then(function(b) {
				b.data.success ? (alert("域名绑定申请已经提交"), a.status = 2, a.isShowBindPanel = !1, a.domainInfo.ipAddress = "202.173.11.90", a.domainInfo.url = g.url) : alert(b.data.msg)
			}, function() {
				alert("服务器异常")
			})
		} else d.pushForCurrentRoute("xd.insufficient", "notify.success")
	}, a.switchDomainType = function(b) {
		a.typeIndex = b
	}
}]).directive("dotCheck", [function() {
	return {
		require: "ngModel",
		link: function(a, b, c, d) {
			var e = null;
			d.$viewChangeListeners.push(function() {
				var a = d.$viewValue.replace(/[\.]/g, "");
				d.$setViewValue(a), e && clearTimeout(e), e = setTimeout(function() {
					clearTimeout(e), d.$render(), e = null
				}, 100)
			})
		}
	}
}]), angular.module("spread.share.expandWeb", []), angular.module("spread.share.expandWeb").controller("ExpandWebCtrl", ["$rootScope", "$scope", "$routeParams", "SpreadService", "ModalService", function(a, b, c, d, e) {
	var f = a.branchid,
		g = function() {
			d.getWebList(b.sceneId, !0, f)
		};
	g(), b.$on("webs.update", function() {
		b.expandWebs = d.expandWebs || []
	}), b.addExpandWeb = function(c) {
		c.unshift({
			name: b.scene.name + "_扩展" + (c.length + 1),
			url: b.selectedUrl,
			showCount: 0
		}), a.$broadcast("make.input.focus")
	}, b.deleteWeb = function(a, c) {
		e.openConfirmDialog({
			msg: "删除后场景原地址无法访问，相应数据无法查看。"
		}, function() {
			var e = {
				id: c.id,
				index: a
			};
			c.id ? d.deleteWeb(e) : b.expandWebs.splice(a, 1)
		})
	};
	var h;
	b.recordName = function(a) {
		h = a
	}, b.updateName = function(a) {
		var c = {
			sceneId: b.sceneId,
			name: a.name
		};
		if (a.id) {
			if (h == a.name) return;
			c.id = a.id
		}
		d.updateName(c).then(function(c) {
			c.data.success && (a.id || (a.id = c.data.obj.id, a.url = b.selectedUrl + "?qrc=" + a.id))
		}, function() {
			alert("服务器异常！")
		})
	}, b.qrcodeList = [{
		type: 1,
		name: "小（256px）",
		size: 256
	}, {
		type: 2,
		name: "中（512px）",
		size: 512
	}, {
		type: 3,
		name: "大（1024px）",
		size: 1024
	}], b.downloadQrcode = function(a) {
		b.$broadcast("download.canvas", a.size)
	}
}]), angular.module("spread.share.messageCustomer", []), angular.module("spread.share.messageCustomer").controller("messageCustomer", ["$rootScope", "$scope", "dataService", "i18nNotifications", "security", "res", function(a, b, c, d, e, f) {
	var g = {};
	b.select = 0;
	var h = f.customers;
	if (b.model = {}, b.model.toPage = f.toPage, h.length > 0) for (var i = 0; i < h.length; i++) g[h[i].id] = 1;
	var j = a.branchid;
	b.dataShow = "message", b.useMessNum = 0, b.customerDatas = f.res.data.list, b.totalItems = f.res.data.map.count, b.model.currentPage = f.res.data.map.pageNo, b.totalNum = Math.ceil(b.totalItems / f.res.data.map.pageSize), b.customerBFlag = !0;
	for (var k = 0, l = b.customerDatas.length; l > k; k++) for (var m = 0; m < h.length; m++) b.customerDatas[k].id == h[m].id && (b.customerDatas[k].selected = !0);
	b.cancel = function() {
		b.$close(h)
	}, b.$on("customDatas", function(a, c) {
		b.customCount = c
	}), b.customer = {
		group: null,
		origin: null
	}, b.groups = [], b.getGroups = function() {
		b.groups.length > 0 || c.getGroups(j).then(function(a) {
			b.groups = a.data.list
		}, function() {})
	}, b.getGroups(), b.model.currentPage = 0, b.toPage = "", b.pageChanged = function(a, c, d, e) {
		if (1 > a || a > b.totalItems / 10 + 1) return void alert("此页超出范围");
		for (var f = 0, g = b.customerDatas.length; g > f; f++) for (var i = 0; i < h.length; i++) b.customerDatas[f].id == h[i].id && (b.customerDatas[f].selected = !0);
		b.model.currentPage = a, b.getDataBySceneId(a, c, d, e)
	};
	var n = [];
	b.getDataBySceneId = function(a, d, e, f) {
		a || (a = 1), c.getAllData(a, d, e, f).then(function(a) {
			if (a.data.success) {
				b.customerDatas = a.data.list, b.totalItems = a.data.map.count, b.model.currentPage = a.data.map.pageNo, b.totalNum = Math.ceil(b.totalItems / a.data.map.pageSize);
				for (var c = 0, d = b.customerDatas.length; d > c; c++) for (var e = 0; e < h.length; e++) b.customerDatas[c].id == h[e].id && (b.customerDatas[c].selected = !0);
				b.allCheckbox()
			}
		})
	}, b.allCheckbox = function() {
		for (var a = 0, c = 0; c < b.customerDatas.length; c++) b.customerDatas[c].selected && a++;
		a == b.customerDatas.length ? b.allImages.selected = !0 : b.allImages.selected = !1
	}, b.linkMan = function() {
		var a;
		for (a = 0, l = b.customerDatas.length; l > a; a++) b.customerDatas[a].selected && n.push(b.customerDatas[a]);
		for (a = 0; a < n.length; a++) g[n[a].id] || (g[n[a].id] = 1, h.push(n[a]));
		for (a = 0; a < b.customerDatas.length; a++) for (var c = 0; c < h.length; c++) b.customerDatas[a].selected || b.customerDatas[a].id == h[c].id && (delete g[h[c].id], h.splice(c, 1), c--);
		b.allCheckbox(), n = []
	}, b.isAllowedToAccessGrouping = e.isAllowToAccess(e.accessDef.GROUP_CUSTOMER), b.isAllowedToAccessGrouping && (b.allImages = {
		selected: !1
	}, b.selectAll = function() {
		for (var a = 0, c = b.customerDatas.length; c > a; a++) b.customerDatas[a].selected = b.allImages.selected;
		b.linkMan()
	}, b.selectCustomer = function(a) {
		a.selected || (b.allImages.selected = !1), b.linkMan()
	}), b.$watch("model.currentPage", function(a, c) {
		a && a != c && (b.model.toPage = a)
	}, !0), b.confirm = function() {
		b.$close(h)
	}
}]), angular.module("spread.share.messageDetail", []), angular.module("spread.share.messageDetail").controller("messageDetail", ["$scope", "dataService", "datas", "msgid", function(a, b, c, d) {
	a.datas = c, a.msgid = d, a.sendDetails = c.list, a.model.DetailPage = 0, a.detailTotal = 0, a.detailTotal = c.map.count, a.detailTotalPage = Math.ceil(c.map.count / c.map.pageSize), a.model.detailPage = 1, a.DetailChangePage = function(c, d) {
		return 1 > d || d > a.detailTotal / 10 + 1 ? void alert("此页超出范围") : (a.model.DetailPage = d, void b.sendDetail(c, a.model.DetailPage).then(function(b) {
			b.data.success && (a.sendDetails = b.data.list)
		}))
	}, a.$watch("model.DetailPage", function(b, c) {
		b && b != c && (a.model.detailPage = b)
	}, !0), a.cancel = function() {
		a.$close()
	}
}]), angular.module("spread.share.messagePost", []), angular.module("spread.share.messagePost").controller("messagePostCtrl", ["$rootScope", "$scope", "$timeout", "dataService", "$modal", "i18nNotifications", "dataCollectService", function(a, b, c, d, e, f, g) {
	b.select = 0, b.toPage = 1, b.msgsetting = !1, b.openFlg = !1, b.model = {};
	a.branchid;
	if (b.dataShow = "message", b.useMessNum = 0, b.model.bFlag = "messageWrite", b.model.messageContent = "", b.obj = {
		selectedPeople: []
	}, b.model.mobileArr = [], b.model.detailPage = 1, b.detailTotal = 0, b.msgid = 0, b.tabwirte = function(a) {
		b.model.bFlag = a
	}, b.tagTransform = function(a) {
		var b = {
			name: a,
			id: a,
			type: "phone"
		};
		return b
	}, b.modelMessFn = function() {
		d.modelMess(b.sceneId).success(function(a) {
			a.success && (b.messageContents = a.list)
		})
	}, b.messageNumberFn = function() {
		d.messageNumber().then(function(a) {
			a.data.success && (b.messageNumber = a.data.obj || 0)
		})
	}, b.modelMessFn(), b.messageNumberFn(), b.getDataBySceneId = function(a, c, f, g) {
		a || (a = 1), d.getAllData(a, c, f, g).then(function(a) {
			if (a.data.success) {
				var c = [];
				e.open({
					windowClass: "six-contain message-customer",
					templateUrl: "spread/tab/subtab/message-customer.tpl.html",
					controller: "messageCustomer",
					backdrop: "static",
					scope: b,
					resolve: {
						res: function() {
							return {
								res: a,
								customers: $.extend(!0, c, b.obj.selectedPeople),
								toPage: b.toPage
							}
						}
					}
				}).result.then(function(a) {
					for (var c = 0; c < a.length; c++) a[c].id = a[c].id.toString(), a[c].isTag = !1;
					b.obj.selectedPeople = [], $.extend(!0, b.obj.selectedPeople, a), b.mobileFn()
				}, function(a) {
					b.obj.selectedPeople = a
				})
			}
		})
	}, b.buyMess = function() {
		e.open({
			windowClass: "six-contain buy-message",
			templateUrl: "spread/tab/subtab/buy-message.tpl.html",
			controller: "buyMessage",
			scope: b,
			resolve: {
				messageNumberFn: function() {
					return b.messageNumberFn
				}
			}
		}).result.then(function() {}, function() {})
	}, b.sendMess = function() {
		if (0 === b.obj.selectedPeople.length) return void f.pushForCurrentRoute("spread.share.messagecustomer", "notify.success");
		if (!b.model.messageContent && !b.model.settingContent) return void f.pushForCurrentRoute("spread.share.messagecontent", "notify.success");
		if (b.useMessNum > b.messageNumber) return f.pushForCurrentRoute("spread.share.messageless", "notify.success"), void b.buyMess();
		for (var a = [], c = "", e = [], g = "", h = 0; h < b.obj.selectedPeople.length; h++) b.obj.selectedPeople[h].type ? e.push(b.obj.selectedPeople[h].name) : a.push(b.obj.selectedPeople[h].id);
		c = a.join(","), g = e.join(",");
		var i = "";
		b.model.messageContent && (i = b.model.messageContent.id), b.loadingShow = !0, d.sendMess(c, i, g, b.sceneId, b.model.settingContent).then(function(a) {
			b.loadingShow = !1, a.data.success ? (f.pushForCurrentRoute("spread.share.messagesendsuccess", "notify.success"), b.messageNumberFn(), b.tabwirte("messageList"), b.obj.selectedPeople = [], b.model.messageContent = null, b.model.customerName = "", b.sendTatolDetail(1), b.model.settingContent = "") : (alert(a.data.msg), b.messageNumberFn(), b.obj.selectedPeople = [], b.model.messageContent = null, b.model.customerName = "")
		})
	}, b.mobileFn = function() {
		for (var a = 0; a < b.obj.selectedPeople.length; a++) if (b.obj.selectedPeople[a].type) b.model.mobileArr = b.model.mobileArr.concat(b.obj.selectedPeople[a].name.split(" "));
		else {
			if (!b.obj.selectedPeople[a].mobile) continue;
			b.model.mobileArr = b.model.mobileArr.concat(b.obj.selectedPeople[a].mobile.split(","))
		}
		b.useMessNum = b.model.mobileArr.length, b.model.mobileArr = []
	}, b.$watch("obj", function(a, d) {
		var e = /^[0-9]{11}$/;
		b.mobileFn(), 0 !== a.selectedPeople.length && a != d && (a.selectedPeople[a.selectedPeople.length - 1] && a.selectedPeople[a.selectedPeople.length - 1].type ? e.test(a.selectedPeople[a.selectedPeople.length - 1].name) || c(function() {
			a.selectedPeople.pop(), b.mobileFn(), alert("请输入正确的手机号码")
		}) : a.selectedPeople[a.selectedPeople.length - 1] || c(function() {
			a.selectedPeople.pop(), b.mobileFn(), alert("请输入正确的手机号码")
		}), b.mobileFn())
	}, !0), b.$watch("model", function(a, c) {
		a != c && (a.messageContent || b.msgsetting || (b.model.settingContent = ""), a.messageContent != c.messagecontent && (a.messageContent ? (b.msgsetting = !1, b.model.settingContent = a.messageContent.content) : b.model.settingContent = ""))
	}, !0), b.sendSettingMsg = function() {
		b.model.messageContent = null, b.msgsetting = !0, setTimeout(function() {
			$("#msg-description").focus(), setTimeout(function() {
				var a = window.getSelection();
				a.modify("move", "left", "paragraph")
			}, 100)
		}, 0), b.model.settingContent = b.previewUrl + "，"
	}, b.model.sendDetailPage = 0, b.model.messPage = 1, b.sendMessTotal = 0, b.sendDetailChangePage = function(a) {
		return 1 > a || a > b.sendMessTotal / 10 + 1 ? void alert("此页超出范围") : (b.model.sendDetailPage = a, void b.sendTatolDetail(a))
	}, b.$watch("model.sendDetailPage", function(a, c) {
		a && a != c && (b.model.messPage = a)
	}, !0), b.sendTatolDetail = function(a) {
		d.sendTatolDetail(a).then(function(a) {
			a.data.success && (b.sendTatolDetails = a.data.list, b.sendMessTotal = a.data.map.count, b.totalMessNum = Math.ceil(b.sendMessTotal / a.data.map.pageSize))
		})
	}, b.sendTatolDetail(1), b.sendDetail = function(a, c) {
		b.openFlg = !0, d.sendDetail(a, c).then(function(c) {
			c.data.success && (b.msgid = a, b.sendDetails = c.data.list, b.detailTotal = c.data.map.count, b.detailTotalPage = Math.ceil(c.data.map.count / c.data.map.pageSize))
		})
	}, b.usersDetailChangePage = function(a, c) {
		return 1 > c || c > b.detailTotal / 10 + 1 ? void alert("此页超出范围") : (b.model.detailPage = c, void d.sendDetail(a, b.model.detailPage).then(function(a) {
			a.data.success && (b.sendDetails = a.data.list)
		}))
	}, b.closeUsers = function() {
		b.openFlg = !1
	}, g.getMessages()) {
		var h = [];
		b.obj.selectedPeople = g.getMessages(), g.setMessages(h)
	}
}]).directive("showLoading", function() {
	return {
		restrict: "EA",
		template: '<div id="loading" style="display:block;"><div class="loading-con"><img ng-src="{{CLIENT_CDN}}assets/images/puff.svg"><p>发送中，请稍后</p></div><div class="loading-bg"></div></div>'
	}
}), angular.module("spread.dataCollect.serviceApply", []), angular.module("spread.dataCollect.serviceApply").controller("OtherServiceApply", ["$rootScope", "$scope", "$modal", "$location", "i18nNotifications", "security", "res", "dataService", "dataCollectService", function(a, b, c, d, e, f, g, h, i) {
	function j() {
		b.dataServiceList = [], h.getDataBySceneId(b.sceneInfo.sceneId, 1, b.totalItems).then(function(a) {
			a.data.list.length > 0 && (b.dataShow = a.data.list.shift(), b.dataShowList = a.data.list, k())
		})
	}
	function k() {
		b.dataShow && b.dataShow.length > 0 && (b.dataShow.forEach(function(a, c) {
			b.nameReg.test(a) && (b.nameIndex = c), b.telReg.test(a.toLowerCase()) && (b.telIndex = c)
		}), -1 == b.telIndex && (b.tableShow = !1)), b.dataShowList && b.dataShowList.length > 0 && b.dataShowList.forEach(function(a) {
			b.detailList = {
				colName: "",
				colTel: ""
			}, a.forEach(function(a, c) {
				c == b.nameIndex && (b.detailList.colName = a), c == b.telIndex && (b.detailList.colTel = a)
			}), b.detailList.colTel && b.dataServiceList.push(b.detailList)
		})
	}
	b.dataShow = [], b.dataShowList = [], b.totalItems = g.totalItems, b.sceneInfo = g.sceneInfo, b.sceneId = g.sceneInfo.sceneId, b.sceneName = encodeURIComponent(g.sceneInfo.sceneName), b.dataServiceList = [], b.setMessageFlg = "messageMenu", b.telReg = /手机|电话|联系方式|tel/, b.nameReg = /姓名|联系人|昵称/, b.telIndex = -1, b.nameIndex = -1, b.tableShow = !0, b.detailList = {}, b.obj = {}, b.obj.telsList = [], b.cancel = function() {
		b.$close()
	}, b.openServiceMessage = function(a) {
		b.setMessageFlg = a, "postMessage" == a && j()
	}, b.pushTelInfo = function() {
		var a = !1;
		b.dataServiceList.forEach(function(c) {
			c.checked && (a = !1, b.obj.telsList && b.obj.telsList.length > 0 && b.obj.telsList.forEach(function(b) {
				c.colName == b.colName && c.colTel == b.colTel && (a = !0)
			}), !a && c.colTel && b.obj.telsList.push({
				colName: c.colName,
				colTel: c.colTel
			}))
		})
	}, b.allChecked = {
		checked: !1
	}, b.checkAll = function() {
		b.dataServiceList.forEach(function(a) {
			a.checked = b.allChecked.checked
		})
	}, b.checkData = function(a) {
		a.checked || (b.allChecked.checked = !1)
	}, b.deleteData = function(a) {
		b.obj.telsList.forEach(function(c, d) {
			a == d && b.obj.telsList.splice(a, 1)
		})
	}, b.showSelectSubTab = function(a) {
		b.viewControl.tab = "share", b.viewControl.subtab = a, d.path("share/" + b.sceneId + "/" + a, !1)
	}, b.confirm = function() {
		var a = [];
		b.obj.telsList.forEach(function(b) {
			b.colTel && a.push({
				id: b.colTel,
				name: b.colTel,
				type: "phone"
			})
		}), i.setMessages(a), b.$close(), b.showSelectSubTab("messagePost")
	}, b.close = function(a) {
		b.obj.telsList = [], b.allChecked.checked = !1, b.dataServiceList.forEach(function(a) {
			a.checked = !1
		}), b.setMessageFlg = a
	}
}]).service("dataCollectService", function() {
	var a, b = {};
	return b.setMessages = function(b) {
		a = b
	}, b.getMessages = function() {
		return a
	}, b
}), angular.module("spread.share.siteImport", []), angular.module("spread.share.siteImport").controller("SiteImportCtrl", ["$rootScope", "$scope", "$routeParams", "sceneService", function(a, b, c, d) {
	function e() {
		b.contentTexts = [{
			textOne: "以iframe的方式嵌入",
			textTwo: "该嵌入方式不能自适应高度，请谨慎使用。",
			textThree: "点击“复制代码”后，将代码粘贴至网页HTML期望的位置即可",
			url: '<iframe width=322px frameborder=0 height=641px src="' + b.selectedUrl + '"></iframe>',
			title: "在网页中以iFrame的方式嵌入场景"
		}]
	}
	b.$watch("user", function(c) {
		if (c) {
			var f;
			f = a.user && a.user.domain ? "http://" + a.user.domain : a.PREFIX_CLIENT_HOST, d.getSceneDetail(b.sceneId).then(function() {
				b.url = b.selectedUrl = f + "/v/" + b.scene.code, e()
			})
		}
	}, !0)
}]), angular.module("spread.share.socialShare", ["app.directives.disableKeydown", "spread.share.dimainBind.guide"]), angular.module("spread.share.socialShare").controller("SocialShareCtrl", ["$rootScope", "$scope", "$routeParams", "$modal", "i18nNotifications", "sceneSettingCache", "SpreadService", "pageTplService", "sceneService", "ModalService", "usercenterService", function(a, b, c, d, e, f, g, h, i, j, k) {
	function l() {
		d.open({
			windowClass: "console six-contain",
			templateUrl: "spread/console/guarantee-apply.tpl.html",
			controller: "guaranteeApplyCtrl",
			resolve: {
				guaranteeObj: function() {
					return {
						sceneId: b.sceneId
					}
				},
				user: function() {
					return {
						type: b.user.type
					}
				}
			}
		}).result.then(function(a) {
			b.scene = a
		}, function(a) {
			"backdrop click" === a ? b.getCurrentScene() : b.scene = a
		})
	}
	b.obj = {}, b.qrCodeShow = !1, b.qrcodeList = [{
		type: 1,
		name: "小（256px）",
		size: 256
	}, {
		type: 2,
		name: "中（512px）",
		size: 512
	}, {
		type: 3,
		name: "大（1024px）",
		size: 1024
	}], b.$watch("scene.name", function() {
		b.sinaurl = "http://service.weibo.com/share/share.php?url=" + encodeURIComponent(b.previewUrl) + "?from=sina_weibo&title=" + encodeURIComponent(b.scene.name) + "&pic=" + encodeURIComponent(PREFIX_FILE_HOST + b.scene.cover) + "&appkey=3508809852", b.qqurl = "http://connect.qq.com/widget/shareqq/index.html?url=" + encodeURIComponent(b.previewUrl) + "?from=sqq&title=" + b.scene.name + "&site=易企秀http://eqxiu.com&summary=" + (b.scene.description ? b.scene.description : "") + "&pic=" + PREFIX_FILE_HOST + b.scene.cover + "&desc=" + (b.scene.description ? b.scene.description : "") + "&appkey=3508809852", b.qqzoneurl = "http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=" + encodeURIComponent(b.previewUrl) + "?from=qzone&title=" + b.scene.name + "&site=易企秀http://eqxiu.com&summary=" + (b.scene.description ? b.scene.description : "") + "&pic=" + PREFIX_FILE_HOST + b.scene.cover + "&desc=" + (b.scene.description ? b.scene.description : "") + "&appkey=3508809852"
	}), b.shareList = [{
		id: 1,
		type: "sina",
		icon: "eqf-weibo",
		title: "新浪微博",
		"class": "sina"
	}, {
		id: 2,
		type: "tencent",
		icon: "eqf-txweibo",
		title: "腾讯微博",
		"class": "tencent"
	}, {
		id: 3,
		type: "qqzone",
		icon: "eqf-QQzone",
		title: "qq空间",
		"class": "qqzone"
	}, {
		id: 4,
		type: "timeline",
		icon: "eqf-friend",
		title: "微信朋友圈",
		"class": "timeline"
	}, {
		id: 5,
		type: "yixin",
		icon: "eqf-yixin",
		title: "易信",
		"class": "yixin"
	}, {
		id: 6,
		type: "tieba",
		icon: "eqf-tieba",
		title: "百度贴吧",
		"class": "tieba"
	}, {
		id: 7,
		type: "laiwang",
		icon: "eqf-laiwang",
		title: "来往",
		"class": "laiwang"
	}], b.downloadQrcode = function(c) {
		a.$broadcast("download.canvas", c.size), b.qrCodeShow = !1
	}, b.setQrCodeShow = function() {
		b.qrCodeShow = !b.qrCodeShow
	};
	var m = function() {
			g.getShareWayList(b.sceneId)
		};
	m(), b.$on("shareway.update", function(a, c) {
		$.each(b.shareList, function(a, b) {
			$.each(c, function(a, c) {
				c.type == b.id && 1 == c.status && (b.isLighted = !0)
			})
		})
	}), b.activeShareWay = function(a) {
		g.activeShareWay(b.sceneId, a)
	}, b.$on("active.shareway", function(a, c) {
		$.each(b.shareList, function(a, b) {
			c == b.id && (b.isLighted = !0)
		})
	}), b.$watch("scene", function(a) {
		a && !$.isEmptyObject(a) && (-1 == a.status ? b.tip = "审核被拒绝不能申请" : -2 == a.status && (b.tip = "审核中不能申请"), f.activitiesPromise.then(function(c) {
			if (b.activities = c.data.list || [], b.getActivityBanner(), a.promIds) {
				$.each(b.activities, function(c, d) {
					a.promIds == d.id && (b.obj.selectedActivity = d)
				});
				var d = JSON.parse(a.property);
				if (!b.obj.selectedActivity.sceneId) return;
				h.getPageTpls(b.obj.selectedActivity.sceneId).then(function(a) {
					b.activityPageTpls = a.data.list || [], $.each(b.activityPageTpls, function(a, c) {
						d.activityPageId == c.id && c.properties && (b.appliedImgSrc = c.properties.thumbSrc)
					})
				})
			}
		}), a.applyTemplate ? 1 == a.applyTemplate ? b.obj.applySample = !0 : 2 == a.applyTemplate || -1 == a.applyTemplate : b.obj.applySample = !1, b.obj.publishTime = a.publishTime, a.isShow ? 1 == a.isShow ? b.obj.applyShow = !0 : 2 == a.isShow || -1 == a.isShow : b.obj.applyShow = !1, 3 == a.isTpl && (b.obj.applyCompTpl = !0), b.obj.applyShow && h.getTagSysListWithType(a.type).then(function(c) {
			var d = c.data.list || [];
			b.sceneTags = [], angular.forEach(d, function(a) {
				b.sceneTags.push(a)
			}), a.tagId && $.each(b.sceneTags, function(c, d) {
				a.tagId == d.id && (b.obj.sceneTag = d)
			})
		}), f.sceneTplPricesPromise.then(function(c) {
			b.tplPrices = c.data.list || [], $.each(b.tplPrices, function(c, d) {
				a.price == d.value && (b.obj.tplPrice = d)
			})
		}))
	}, !0), b.applyFunc = function(a, c, d, f) {
		if (a) {
			if (2 == c && (1 == b.scene.isShow || 2 == b.scene.isShow)) return e.pushForCurrentRoute("already.apply.discovery", "notify.success"), void $.each(b.sceneTags, function(a, c) {
				b.scene.type == c.id && (b.obj.sceneTag = c)
			});
			if (1 == c && (1 == b.scene.applyTemplate || 2 == b.scene.applyTemplate)) return e.pushForCurrentRoute("already.apply.sample", "notify.success"), void $.each(b.tplPrices, function(a, c) {
				b.scene.price == c.value && (b.obj.tplPrice = c)
			});
			if (3 == c) return -1 == b.scene.status ? void e.pushForCurrentRoute("scene.deny.apply", "notify.success") : -2 == b.scene.status ? void e.pushForCurrentRoute("scene.incheck.apply", "notify.success") : b.scene.accessCode ? void e.pushForCurrentRoute("scene.accessCode.apply", "notify.success") : 2 == b.scene.status ? void e.pushForCurrentRoute("scene.accessClose.apply", "notify.success") : d ? b.scene.promIds ? (e.pushForCurrentRoute("already.apply.activity", "notify.success"), void $.each(b.activities, function(a, c) {
				b.scene.promIds == c.id && (b.obj.selectedActivity = c)
			})) : void(window.localStorage && localStorage.getItem("hideApplyActivityTip") ? n(a, c, d, f) : (b.showApplyTip = !0, b.obj.selectedActivity = {
				sceneId: d,
				id: f
			})) : void g.applyShareWay(b.scene.id, 3, f);
			n(a, c, d, f)
		}
	}, b.switchApplyActivityTip = function(a, b, c, d, e) {
		e && window.localStorage && localStorage.setItem("hideApplyActivityTip", !0), n(a, b, c, d)
	}, b.$on("apply.scene.share", function(a, b) {
		b.success && e.pushForCurrentRoute("scene.apply.success", "notify.success")
	});
	var n = function(a, c, f, g) {
			a && d.open({
				windowClass: "console six-contain",
				templateUrl: "spread/console/apply.tpl.html",
				controller: "ApplyConsoleCtrl",
				resolve: {
					applyObj: function() {
						return {
							sceneId: b.sceneId,
							type: c,
							value: f,
							id: g,
							sceneType: b.scene.type
						}
					}
				}
			}).result.then(function(a) {
				var d = a.value;
				e.pushForCurrentRoute("scene.apply.success", "notify.success"), 2 == c ? (b.scene.tagId = a.value, b.scene.isShow = 1) : 1 == c ? ($.each(b.tplPrices, function(a, c) {
					d == c.value && (b.obj.tplPrice = c)
				}), b.scene.applyTemplate = 1) : 3 == c ? (a.src && (b.appliedImgSrc = a.src), b.scene.promIds = a.value) : 4 == c && (b.scene.isTpl = 3)
			}, function() {
				2 == c ? b.obj.applyShow = !1 : 1 == c ? b.obj.applySample = !1 : 3 == c ? b.obj.selectedActivity = null : 4 == c && (b.obj.applyCompTpl = !1)
			})
		};
	b.applyCompTpl = function(a, c) {
		a && g.applyShareWay(b.sceneId, c)
	}, b.closeActivityModal = function() {
		b.showApplyTip = !1, b.obj.selectedActivity = null
	}, b.applyGuarantee = function() {
		return b.scene.publishTime ? -1 == b.scene.status ? void e.pushForCurrentRoute("spread.share.guaranteeApplyCheck", "notify.success") : -2 == b.scene.status ? void e.pushForCurrentRoute("spread.share.guaranteeApplyUnCheck", "notify.success") : void(b.user.domain ? j.openConfirmDialog({
			msg: "已经参加了域名绑定,如果再参加服务保障,域名会更改",
			confirmName: "确定",
			cancelName: "取消"
		}, function() {
			l()
		}, function() {}) : l()) : void e.pushForCurrentRoute("spread.share.guaranteeApplyUnPublice", "notify.success")
	}, b.getActivityBanner = function() {
		b.activities && b.activities.length > 0 && b.activities.forEach(function(a, b) {
			i.getActivityBanner("ac_" + a.id).success(function(b) {
				b.success && b.list.length > 0 && (a.path = b.list[0].path)
			})
		})
	}, b.openDomainBind = function(a, c) {
		!a && c ? b.showSelectSubTab("domainBind") : d.open({
			windowClass: "console six-contain",
			templateUrl: "spread/console/domainBind-guide.tpl.html",
			controller: "DomainGuideCtrl"
		}).result.then(function() {}, function() {})
	}, b.unbind = !0, a.user && a.user.domain && (b.unbind = !1, b.previewUrl = "http://" + a.user.domain + "/v/" + b.scene.code, b.domainUrl = "http://" + a.user.domain + "/v/" + b.scene.code)
}]), angular.module("spread.share.subtab", ["spread.share.socialShare", "spread.share.guarantee", "spread.share.guarantee.buy", "spread.share.expandWeb", "spread.share.domainBind", "spread.share.siteImport", "spread.share.checkScene", "spread.share.messagePost", "spread.share.buyerMess", "spread.share.messageDetail", "spread.share.messageCustomer", "spread.share.thirdWeb"]), angular.module("spread.share.thirdWeb", []), angular.module("spread.share.thirdWeb").controller("ThirdWebCtrl", ["$window", "$scope", "ModalService", function(a, b, c) {
	b.schemeFlg = "humanSea", b.fansCount = 5e4, b.minCount = 5e3, b.stepCount = 5e3, b.perPrice = .02, b.orderPrice = b.fansCount * b.perPrice, b.tabChange = function(a) {
		b.schemeFlg = a
	}, b.minusFans = function() {
		b.fansCount > b.minCount && (b.fansCount = parseFloat(b.fansCount) - b.stepCount, b.orderPrice = b.fansCount * b.perPrice)
	}, b.addFans = function() {
		b.fansCount = parseFloat(b.fansCount) + b.stepCount, b.orderPrice = b.fansCount * b.perPrice
	}, b.confirmOrder = function() {
		if (!b.scene.publishTime) return void c.openMsgDialog({
			msg: "场景尚未发布，请先发布",
			btn: "关闭"
		});
		if (b.scene.updateTime > b.scene.publishTime) return void c.openMsgDialog({
			msg: "场景有更新需要再次发布",
			btn: "关闭"
		});
		var d = "";
		d = "humanSea" == b.schemeFlg ? PREFIX_ANALYSIS_HOST + "m/p/bingjun?sceneId=" + b.sceneId + "&peoples=" + b.fansCount + "&type=rhzs" : PREFIX_ANALYSIS_HOST + "m/p/bingjun?sceneId=" + b.sceneId + "&type=whzs", d && a.open(d, "_blank")
	}
}]), angular.module("spread.tab", ["spread.share", "spread.statistics", "spread.dataCollect"]), angular.module("test", []).controller("HomeCtrl", ["$scope", function(a) {}]).value("top5RegionTestData", [{
	name: "北京",
	value: 150252
}, {
	name: "上海",
	value: 108625
}, {
	name: "广东",
	value: 107766
}, {
	name: "山东",
	value: 105360
}, {
	name: "西藏",
	value: 83851
}]).directive("regionSummeryAnalysisTest", ["top5RegionTestData", function(a) {
	return function(b, c, d) {
		var e = [],
			f = [],
			g = {
				tooltip: {
					trigger: "axis",
					axisPointer: {
						type: "shadow"
					}
				},
				xAxis: {
					show: !1,
					type: "value"
				},
				yAxis: {
					type: "category",
					data: e
				},
				series: [{
					name: "直接访问",
					type: "bar",
					stack: "总量",
					label: {
						normal: {
							show: !0,
							position: "insideRight"
						}
					},
					data: f
				}]
			},
			h = echarts.init(c.get(0));
		h.setOption(g), a.forEach(function(a) {
			e.push(a.name), f.push(a.value)
		}), h.setOption(g)
	}
}]).value("deviceOverviewTestData", [{
	name: "iOS",
	value: 68
}, {
	name: "Android",
	value: 29
}, {
	name: "PC",
	value: 3
}]).directive("deviceSummeryAnalysisTest", [function() {
	return function(a, b, c) {
		var d = {
			normal: {
				label: {
					show: !1
				},
				labelLine: {
					show: !1
				}
			}
		},
			e = {
				normal: {
					color: "rgba(0,0,0,0)",
					label: {
						show: !1
					},
					labelLine: {
						show: !1
					}
				},
				emphasis: {
					color: "rgba(0,0,0,0)"
				}
			},
			f = {
				title: {
					text: "设备统计",
					x: "center",
					y: "center",
					itemGap: 20,
					textStyle: {
						color: "rgba(30,144,255,0.8)",
						fontFamily: "微软雅黑",
						fontSize: 35,
						fontWeight: "bolder"
					}
				},
				tooltip: {
					show: !0,
					formatter: "{a} <br/>{b} : {c} ({d}%)"
				},
				legend: {
					orient: "vertical",
					x: 160,
					y: 45,
					itemGap: 12,
					data: ["68% iOS", "29% Android", "3% PC"]
				},
				series: [{
					name: "1",
					type: "pie",
					clockWise: !1,
					radius: [125, 150],
					itemStyle: d,
					data: [{
						value: 68,
						name: "68% iOS"
					}, {
						value: 32,
						name: "invisible",
						itemStyle: e
					}]
				}, {
					name: "2",
					type: "pie",
					clockWise: !1,
					radius: [100, 125],
					itemStyle: d,
					data: [{
						value: 29,
						name: "29% Android"
					}, {
						value: 71,
						name: "invisible",
						itemStyle: e
					}]
				}, {
					name: "3",
					type: "pie",
					clockWise: !1,
					radius: [75, 100],
					itemStyle: d,
					data: [{
						value: 3,
						name: "3% PC"
					}, {
						value: 97,
						name: "invisible",
						itemStyle: e
					}]
				}]
			},
			g = echarts.init(b.get(0));
		g.setOption(f)
	}
}]).value("interactiveOverviewTestData", [{
	value: 335,
	name: "直接访问"
}, {
	value: 310,
	name: "微信"
}, {
	value: 234,
	name: "朋友圈"
}, {
	value: 135,
	name: "视频广告"
}, {
	value: 1548,
	name: "搜索引擎"
}]).directive("interactiveSummeryAnalysisTest", ["interactiveOverviewTestData", function(a) {
	return function(b, c, d) {
		var e = [],
			f = {
				title: {
					text: "用户访问来源",
					x: "center"
				},
				tooltip: {
					trigger: "item",
					formatter: "{a} <br/>{b} : {c} ({d}%)"
				},
				legend: {
					orient: "vertical",
					x: "left",
					data: e
				},
				calculable: !0,
				series: [{
					name: "访问来源",
					type: "pie",
					radius: "80%",
					center: ["50%", "50%"],
					data: []
				}]
			},
			g = echarts.init(c.get(0));
		g.setOption(f), a.forEach(function(a) {
			e.push(a.name)
		}), f.series[0].data = a, g.setOption(f)
	}
}]).value("pvUv", [{
	name: "2016-03-14",
	pv: 110,
	uv: 110
}, {
	name: "2016-03-15",
	pv: 80,
	uv: 80
}, {
	name: "2016-03-16",
	pv: 90,
	uv: 90
}, {
	name: "2016-03-17",
	pv: 100,
	uv: 100
}, {
	name: "2016-03-18",
	pv: 110,
	uv: 110
}, {
	name: "2016-03-19",
	pv: 120,
	uv: 110
}, {
	name: "2016-03-20",
	pv: 130,
	uv: 110
}]).directive("viewAnalysisTest", [function() {
	return function(a, b, c) {
		for (var d = +new Date(1968, 9, 3), e = 864e5, f = [], g = [300 * Math.random()], h = 1; 2e4 > h; h++) {
			var i = new Date(d += e);
			f.push([i.getFullYear(), i.getMonth() + 1, i.getDate()].join("-")), g.push(Math.round(20 * (Math.random() - .5) + g[h - 1]))
		}
		option = {
			tooltip: {
				trigger: "axis"
			},
			title: {
				left: "center",
				text: "大数据量折线图"
			},
			legend: {
				top: "bottom",
				data: ["意向"]
			},
			xAxis: {
				type: "category",
				boundaryGap: !1,
				data: f
			},
			yAxis: {
				type: "value",
				boundaryGap: [0, "100%"]
			},
			dataZoom: [{
				type: "inside",
				start: 0,
				end: 10
			}, {
				start: 0,
				end: 10
			}],
			series: [{
				name: "模拟数据",
				type: "line",
				smooth: !0,
				symbol: "none",
				sampling: "average",
				itemStyle: {
					normal: {
						color: "rgb(255, 70, 131)"
					}
				},
				areaStyle: {
					normal: {
						color: new echarts.graphic.LinearGradient(0, 0, 0, 1, [{
							offset: 0,
							color: "rgb(255, 158, 68)"
						}, {
							offset: 1,
							color: "rgb(255, 70, 131)"
						}])
					}
				},
				data: g
			}]
		};
		var j = echarts.init(b.get(0));
		j.setOption(option)
	}
}]).directive("interactiveAnalysisTest", [function() {
	return {
		template: '<div class="main-chart main-pie" style="width:45%; height: 100%;float: left;margin-right:0;padding-right:0;border-right-width:0"></div>\n<div class="main-chart main-bar" style="width:50%; height: 100%;float: left;margin-left:0;padding-left:0;border-left-width:0"></div>',
		link: function(a, b, c) {
			var d = {
				title: {
					text: "某站点用户访问来源",
					subtext: "纯属虚构",
					x: "center"
				},
				tooltip: {
					trigger: "item",
					formatter: "{a} <br/>{b} : {c} ({d}%)"
				},
				legend: {
					orient: "vertical",
					x: "left",
					data: ["直接访问", "邮件营销", "联盟广告", "视频广告", "搜索引擎"]
				},
				calculable: !0,
				series: [{
					name: "访问来源",
					type: "pie",
					radius: "55%",
					center: ["50%", 225],
					data: [{
						value: 335,
						name: "直接访问"
					}, {
						value: 310,
						name: "邮件营销"
					}, {
						value: 234,
						name: "联盟广告"
					}, {
						value: 135,
						name: "视频广告"
					}, {
						value: 1548,
						name: "搜索引擎"
					}]
				}]
			},
				e = echarts.init(b.find(".main-pie").get(0));
			e.setOption(d);
			var f = {
				tooltip: {
					trigger: "axis",
					axisPointer: {
						type: "shadow"
					}
				},
				legend: {
					data: ["直接访问", "邮件营销", "联盟广告", "视频广告", "搜索引擎"]
				},
				calculable: !0,
				xAxis: [{
					type: "category",
					data: ["周一", "周二", "周三", "周四", "周五", "周六", "周日"]
				}],
				yAxis: [{
					type: "value",
					splitArea: {
						show: !0
					}
				}],
				grid: {
					x2: 40
				},
				series: [{
					name: "直接访问",
					type: "bar",
					stack: "总量",
					data: [320, 332, 301, 334, 390, 330, 320]
				}, {
					name: "邮件营销",
					type: "bar",
					stack: "总量",
					data: [120, 132, 101, 134, 90, 230, 210]
				}, {
					name: "联盟广告",
					type: "bar",
					stack: "总量",
					data: [220, 182, 191, 234, 290, 330, 310]
				}, {
					name: "视频广告",
					type: "bar",
					stack: "总量",
					data: [150, 232, 201, 154, 190, 330, 410]
				}, {
					name: "搜索引擎",
					type: "bar",
					stack: "总量",
					data: [820, 932, 901, 934, 1290, 1330, 1320]
				}]
			},
				g = echarts.init(b.find(".main-bar").get(0));
			g.setOption(f), echarts.connect([e, g])
		}
	}
}]).value("channelAnalysis", {
	summery: [{
		value: 335,
		name: "直接访问"
	}, {
		value: 310,
		name: "邮件营销"
	}, {
		value: 234,
		name: "联盟广告"
	}, {
		value: 135,
		name: "视频广告"
	}, {
		value: 1548,
		name: "搜索引擎"
	}],
	dateRange: ["2016-03-14", "2016-03-15", "2016-03-16", "2016-03-17", "2016-03-18", "2016-03-19", "2016-03-20"],
	data: [{
		name: "直接访问",
		data: [320, 332, 301, 334, 390, 330, 320]
	}, {
		name: "邮件营销",
		data: [120, 132, 101, 134, 90, 230, 210]
	}, {
		name: "联盟广告",
		data: [220, 182, 191, 234, 290, 330, 310]
	}, {
		name: "视频广告",
		data: [150, 232, 201, 154, 190, 330, 410]
	}, {
		name: "搜索引擎",
		data: [820, 932, 901, 934, 1290, 1330, 1320]
	}]
}).directive("channelAnalysisTest", [function() {
	return function(a, b, c) {
		var d = {
			tooltip: {
				trigger: "axis"
			},
			calculable: !0,
			legend: {
				data: ["直接访问", "邮件营销", "联盟广告", "视频广告", "搜索引擎", "百度", "谷歌", "必应", "其他"]
			},
			xAxis: [{
				type: "category",
				splitLine: {
					show: !1
				},
				data: ["周一", "周二", "周三", "周四", "周五", "周六", "周日"]
			}],
			yAxis: [{
				type: "value",
				position: "right"
			}],
			series: [{
				name: "邮件营销",
				type: "bar",
				tooltip: {
					trigger: "item"
				},
				stack: "广告",
				data: [120, 132, 101, 134, 90, 230, 210]
			}, {
				name: "联盟广告",
				type: "bar",
				tooltip: {
					trigger: "item"
				},
				stack: "广告",
				data: [220, 182, 191, 234, 290, 330, 310]
			}, {
				name: "视频广告",
				type: "bar",
				tooltip: {
					trigger: "item"
				},
				stack: "广告",
				data: [150, 232, 201, 154, 190, 330, 410]
			}, {
				name: "搜索引擎细分",
				type: "pie",
				tooltip: {
					trigger: "item",
					formatter: "{a} <br/>{b} : {c} ({d}%)"
				},
				center: [160, 130],
				radius: [0, 50],
				itemStyle: {
					normal: {
						labelLine: {
							length: 20
						}
					}
				},
				data: [{
					value: 1048,
					name: "百度"
				}, {
					value: 251,
					name: "谷歌"
				}, {
					value: 147,
					name: "必应"
				}, {
					value: 102,
					name: "其他"
				}]
			}]
		},
			e = echarts.init(b.get(0));
		e.setOption(d)
	}
}]).controller("SpreadTestDetailCtrl", ["$routeParams", "$scope", function(a, b) {
	b.sceneId = a.sceneId || 8549381
}]).directive("pvUvAnalysis", ["$http", function(a) {
	return function(a, b) {}
}]).directive("regionAnalysisTest", [function() {
	return function(a, b) {
		var c = {
			"海门": [121.15, 31.89],
			"鄂尔多斯": [109.781327, 39.608266],
			"招远": [120.38, 37.35],
			"舟山": [122.207216, 29.985295],
			"齐齐哈尔": [123.97, 47.33],
			"盐城": [120.13, 33.38],
			"赤峰": [118.87, 42.28],
			"青岛": [120.33, 36.07],
			"乳山": [121.52, 36.89],
			"金昌": [102.188043, 38.520089],
			"泉州": [118.58, 24.93],
			"莱西": [120.53, 36.86],
			"日照": [119.46, 35.42],
			"胶南": [119.97, 35.88],
			"南通": [121.05, 32.08],
			"拉萨": [91.11, 29.97],
			"云浮": [112.02, 22.93],
			"梅州": [116.1, 24.55],
			"文登": [122.05, 37.2],
			"上海": [121.48, 31.22],
			"攀枝花": [101.718637, 26.582347],
			"威海": [122.1, 37.5],
			"承德": [117.93, 40.97],
			"厦门": [118.1, 24.46],
			"汕尾": [115.375279, 22.786211],
			"潮州": [116.63, 23.68],
			"丹东": [124.37, 40.13],
			"太仓": [121.1, 31.45],
			"曲靖": [103.79, 25.51],
			"烟台": [121.39, 37.52],
			"福州": [119.3, 26.08],
			"瓦房店": [121.979603, 39.627114],
			"即墨": [120.45, 36.38],
			"抚顺": [123.97, 41.97],
			"玉溪": [102.52, 24.35],
			"张家口": [114.87, 40.82],
			"阳泉": [113.57, 37.85],
			"莱州": [119.942327, 37.177017],
			"湖州": [120.1, 30.86],
			"汕头": [116.69, 23.39],
			"昆山": [120.95, 31.39],
			"宁波": [121.56, 29.86],
			"湛江": [110.359377, 21.270708],
			"揭阳": [116.35, 23.55],
			"荣成": [122.41, 37.16],
			"连云港": [119.16, 34.59],
			"葫芦岛": [120.836932, 40.711052],
			"常熟": [120.74, 31.64],
			"东莞": [113.75, 23.04],
			"河源": [114.68, 23.73],
			"淮安": [119.15, 33.5],
			"泰州": [119.9, 32.49],
			"南宁": [108.33, 22.84],
			"营口": [122.18, 40.65],
			"惠州": [114.4, 23.09],
			"江阴": [120.26, 31.91],
			"蓬莱": [120.75, 37.8],
			"韶关": [113.62, 24.84],
			"嘉峪关": [98.289152, 39.77313],
			"广州": [113.23, 23.16],
			"延安": [109.47, 36.6],
			"太原": [112.53, 37.87],
			"清远": [113.01, 23.7],
			"中山": [113.38, 22.52],
			"昆明": [102.73, 25.04],
			"寿光": [118.73, 36.86],
			"盘锦": [122.070714, 41.119997],
			"长治": [113.08, 36.18],
			"深圳": [114.07, 22.62],
			"珠海": [113.52, 22.3],
			"宿迁": [118.3, 33.96],
			"咸阳": [108.72, 34.36],
			"铜川": [109.11, 35.09],
			"平度": [119.97, 36.77],
			"佛山": [113.11, 23.05],
			"海口": [110.35, 20.02],
			"江门": [113.06, 22.61],
			"章丘": [117.53, 36.72],
			"肇庆": [112.44, 23.05],
			"大连": [121.62, 38.92],
			"临汾": [111.5, 36.08],
			"吴江": [120.63, 31.16],
			"石嘴山": [106.39, 39.04],
			"沈阳": [123.38, 41.8],
			"苏州": [120.62, 31.32],
			"茂名": [110.88, 21.68],
			"嘉兴": [120.76, 30.77],
			"长春": [125.35, 43.88],
			"胶州": [120.03336, 36.264622],
			"银川": [106.27, 38.47],
			"张家港": [120.555821, 31.875428],
			"三门峡": [111.19, 34.76],
			"锦州": [121.15, 41.13],
			"南昌": [115.89, 28.68],
			"柳州": [109.4, 24.33],
			"三亚": [109.511909, 18.252847],
			"自贡": [104.778442, 29.33903],
			"吉林": [126.57, 43.87],
			"阳江": [111.95, 21.85],
			"泸州": [105.39, 28.91],
			"西宁": [101.74, 36.56],
			"宜宾": [104.56, 29.77],
			"呼和浩特": [111.65, 40.82],
			"成都": [104.06, 30.67],
			"大同": [113.3, 40.12],
			"镇江": [119.44, 32.2],
			"桂林": [110.28, 25.29],
			"张家界": [110.479191, 29.117096],
			"宜兴": [119.82, 31.36],
			"北海": [109.12, 21.49],
			"西安": [108.95, 34.27],
			"金坛": [119.56, 31.74],
			"东营": [118.49, 37.46],
			"牡丹江": [129.58, 44.6],
			"遵义": [106.9, 27.7],
			"绍兴": [120.58, 30.01],
			"扬州": [119.42, 32.39],
			"常州": [119.95, 31.79],
			"潍坊": [119.1, 36.62],
			"重庆": [106.54, 29.59],
			"台州": [121.420757, 28.656386],
			"南京": [118.78, 32.04],
			"滨州": [118.03, 37.36],
			"贵阳": [106.71, 26.57],
			"无锡": [120.29, 31.59],
			"本溪": [123.73, 41.3],
			"克拉玛依": [84.77, 45.59],
			"渭南": [109.5, 34.52],
			"马鞍山": [118.48, 31.56],
			"宝鸡": [107.15, 34.38],
			"焦作": [113.21, 35.24],
			"句容": [119.16, 31.95],
			"北京": [116.46, 39.92],
			"徐州": [117.2, 34.26],
			"衡水": [115.72, 37.72],
			"包头": [110, 40.58],
			"绵阳": [104.73, 31.48],
			"乌鲁木齐": [87.68, 43.77],
			"枣庄": [117.57, 34.86],
			"杭州": [120.19, 30.26],
			"淄博": [118.05, 36.78],
			"鞍山": [122.85, 41.12],
			"溧阳": [119.48, 31.43],
			"库尔勒": [86.06, 41.68],
			"安阳": [114.35, 36.1],
			"开封": [114.35, 34.79],
			"济南": [117, 36.65],
			"德阳": [104.37, 31.13],
			"温州": [120.65, 28.01],
			"九江": [115.97, 29.71],
			"邯郸": [114.47, 36.6],
			"临安": [119.72, 30.23],
			"兰州": [103.73, 36.03],
			"沧州": [116.83, 38.33],
			"临沂": [118.35, 35.05],
			"南充": [106.110698, 30.837793],
			"天津": [117.2, 39.13],
			"富阳": [119.95, 30.07],
			"泰安": [117.13, 36.18],
			"诸暨": [120.23, 29.71],
			"郑州": [113.65, 34.76],
			"哈尔滨": [126.63, 45.75],
			"聊城": [115.97, 36.45],
			"芜湖": [118.38, 31.33],
			"唐山": [118.02, 39.63],
			"平顶山": [113.29, 33.75],
			"邢台": [114.48, 37.05],
			"德州": [116.29, 37.45],
			"济宁": [116.59, 35.38],
			"荆州": [112.239741, 30.335165],
			"宜昌": [111.3, 30.7],
			"义乌": [120.06, 29.32],
			"丽水": [119.92, 28.45],
			"洛阳": [112.44, 34.7],
			"秦皇岛": [119.57, 39.95],
			"株洲": [113.16, 27.83],
			"石家庄": [114.48, 38.03],
			"莱芜": [117.67, 36.19],
			"常德": [111.69, 29.05],
			"保定": [115.48, 38.85],
			"湘潭": [112.91, 27.87],
			"金华": [119.64, 29.12],
			"岳阳": [113.09, 29.37],
			"长沙": [113, 28.21],
			"衢州": [118.88, 28.97],
			"廊坊": [116.7, 39.53],
			"菏泽": [115.480656, 35.23375],
			"合肥": [117.27, 31.86],
			"武汉": [114.31, 30.52],
			"大庆": [125.03, 46.58]
		},
			d = function(a) {
				for (var b = [], d = 0; d < a.length; d++) {
					var e = c[a[d].name];
					e && b.push(e.concat(a[d].value))
				}
				return b
			},
			e = {
				backgroundColor: "#404a59",
				title: {
					text: "全国主要城市空气质量",
					subtext: "data from PM25.in",
					sublink: "http://www.pm25.in",
					left: "center",
					textStyle: {
						color: "#fff"
					}
				},
				tooltip: {
					trigger: "item"
				},
				legend: {
					orient: "vertical",
					top: "bottom",
					left: "right",
					data: ["pm2.5"],
					textStyle: {
						color: "#fff"
					}
				},
				visualMap: {
					min: 0,
					max: 300,
					splitNumber: 5,
					color: ["#d94e5d", "#eac736", "#50a3ba"],
					textStyle: {
						color: "#fff"
					}
				},
				geo: {
					map: "china",
					label: {
						emphasis: {
							show: !1
						}
					},
					itemStyle: {
						normal: {
							areaColor: "#323c48",
							borderColor: "#111"
						},
						emphasis: {
							areaColor: "#2a333d"
						}
					}
				},
				series: [{
					name: "pm2.5",
					type: "scatter",
					coordinateSystem: "geo",
					data: d([{
						name: "海门",
						value: 9
					}, {
						name: "鄂尔多斯",
						value: 12
					}, {
						name: "招远",
						value: 12
					}, {
						name: "舟山",
						value: 12
					}, {
						name: "齐齐哈尔",
						value: 14
					}, {
						name: "盐城",
						value: 15
					}, {
						name: "赤峰",
						value: 16
					}, {
						name: "青岛",
						value: 18
					}, {
						name: "乳山",
						value: 18
					}, {
						name: "金昌",
						value: 19
					}, {
						name: "泉州",
						value: 21
					}, {
						name: "莱西",
						value: 21
					}, {
						name: "日照",
						value: 21
					}, {
						name: "胶南",
						value: 22
					}, {
						name: "南通",
						value: 23
					}, {
						name: "拉萨",
						value: 24
					}, {
						name: "云浮",
						value: 24
					}, {
						name: "梅州",
						value: 25
					}, {
						name: "文登",
						value: 25
					}, {
						name: "上海",
						value: 25
					}, {
						name: "攀枝花",
						value: 25
					}, {
						name: "威海",
						value: 25
					}, {
						name: "承德",
						value: 25
					}, {
						name: "厦门",
						value: 26
					}, {
						name: "汕尾",
						value: 26
					}, {
						name: "潮州",
						value: 26
					}, {
						name: "丹东",
						value: 27
					}, {
						name: "太仓",
						value: 27
					}, {
						name: "曲靖",
						value: 27
					}, {
						name: "烟台",
						value: 28
					}, {
						name: "福州",
						value: 29
					}, {
						name: "瓦房店",
						value: 30
					}, {
						name: "即墨",
						value: 30
					}, {
						name: "抚顺",
						value: 31
					}, {
						name: "玉溪",
						value: 31
					}, {
						name: "张家口",
						value: 31
					}, {
						name: "阳泉",
						value: 31
					}, {
						name: "莱州",
						value: 32
					}, {
						name: "湖州",
						value: 32
					}, {
						name: "汕头",
						value: 32
					}, {
						name: "昆山",
						value: 33
					}, {
						name: "宁波",
						value: 33
					}, {
						name: "湛江",
						value: 33
					}, {
						name: "揭阳",
						value: 34
					}, {
						name: "荣成",
						value: 34
					}, {
						name: "连云港",
						value: 35
					}, {
						name: "葫芦岛",
						value: 35
					}, {
						name: "常熟",
						value: 36
					}, {
						name: "东莞",
						value: 36
					}, {
						name: "河源",
						value: 36
					}, {
						name: "淮安",
						value: 36
					}, {
						name: "泰州",
						value: 36
					}, {
						name: "南宁",
						value: 37
					}, {
						name: "营口",
						value: 37
					}, {
						name: "惠州",
						value: 37
					}, {
						name: "江阴",
						value: 37
					}, {
						name: "蓬莱",
						value: 37
					}, {
						name: "韶关",
						value: 38
					}, {
						name: "嘉峪关",
						value: 38
					}, {
						name: "广州",
						value: 38
					}, {
						name: "延安",
						value: 38
					}, {
						name: "太原",
						value: 39
					}, {
						name: "清远",
						value: 39
					}, {
						name: "中山",
						value: 39
					}, {
						name: "昆明",
						value: 39
					}, {
						name: "寿光",
						value: 40
					}, {
						name: "盘锦",
						value: 40
					}, {
						name: "长治",
						value: 41
					}, {
						name: "深圳",
						value: 41
					}, {
						name: "珠海",
						value: 42
					}, {
						name: "宿迁",
						value: 43
					}, {
						name: "咸阳",
						value: 43
					}, {
						name: "铜川",
						value: 44
					}, {
						name: "平度",
						value: 44
					}, {
						name: "佛山",
						value: 44
					}, {
						name: "海口",
						value: 44
					}, {
						name: "江门",
						value: 45
					}, {
						name: "章丘",
						value: 45
					}, {
						name: "肇庆",
						value: 46
					}, {
						name: "大连",
						value: 47
					}, {
						name: "临汾",
						value: 47
					}, {
						name: "吴江",
						value: 47
					}, {
						name: "石嘴山",
						value: 49
					}, {
						name: "沈阳",
						value: 50
					}, {
						name: "苏州",
						value: 50
					}, {
						name: "茂名",
						value: 50
					}, {
						name: "嘉兴",
						value: 51
					}, {
						name: "长春",
						value: 51
					}, {
						name: "胶州",
						value: 52
					}, {
						name: "银川",
						value: 52
					}, {
						name: "张家港",
						value: 52
					}, {
						name: "三门峡",
						value: 53
					}, {
						name: "锦州",
						value: 54
					}, {
						name: "南昌",
						value: 54
					}, {
						name: "柳州",
						value: 54
					}, {
						name: "三亚",
						value: 54
					}, {
						name: "自贡",
						value: 56
					}, {
						name: "吉林",
						value: 56
					}, {
						name: "阳江",
						value: 57
					}, {
						name: "泸州",
						value: 57
					}, {
						name: "西宁",
						value: 57
					}, {
						name: "宜宾",
						value: 58
					}, {
						name: "呼和浩特",
						value: 58
					}, {
						name: "成都",
						value: 58
					}, {
						name: "大同",
						value: 58
					}, {
						name: "镇江",
						value: 59
					}, {
						name: "桂林",
						value: 59
					}, {
						name: "张家界",
						value: 59
					}, {
						name: "宜兴",
						value: 59
					}, {
						name: "北海",
						value: 60
					}, {
						name: "西安",
						value: 61
					}, {
						name: "金坛",
						value: 62
					}, {
						name: "东营",
						value: 62
					}, {
						name: "牡丹江",
						value: 63
					}, {
						name: "遵义",
						value: 63
					}, {
						name: "绍兴",
						value: 63
					}, {
						name: "扬州",
						value: 64
					}, {
						name: "常州",
						value: 64
					}, {
						name: "潍坊",
						value: 65
					}, {
						name: "重庆",
						value: 66
					}, {
						name: "台州",
						value: 67
					}, {
						name: "南京",
						value: 67
					}, {
						name: "滨州",
						value: 70
					}, {
						name: "贵阳",
						value: 71
					}, {
						name: "无锡",
						value: 71
					}, {
						name: "本溪",
						value: 71
					}, {
						name: "克拉玛依",
						value: 72
					}, {
						name: "渭南",
						value: 72
					}, {
						name: "马鞍山",
						value: 72
					}, {
						name: "宝鸡",
						value: 72
					}, {
						name: "焦作",
						value: 75
					}, {
						name: "句容",
						value: 75
					}, {
						name: "北京",
						value: 79
					}, {
						name: "徐州",
						value: 79
					}, {
						name: "衡水",
						value: 80
					}, {
						name: "包头",
						value: 80
					}, {
						name: "绵阳",
						value: 80
					}, {
						name: "乌鲁木齐",
						value: 84
					}, {
						name: "枣庄",
						value: 84
					}, {
						name: "杭州",
						value: 84
					}, {
						name: "淄博",
						value: 85
					}, {
						name: "鞍山",
						value: 86
					}, {
						name: "溧阳",
						value: 86
					}, {
						name: "库尔勒",
						value: 86
					}, {
						name: "安阳",
						value: 90
					}, {
						name: "开封",
						value: 90
					}, {
						name: "济南",
						value: 92
					}, {
						name: "德阳",
						value: 93
					}, {
						name: "温州",
						value: 95
					}, {
						name: "九江",
						value: 96
					}, {
						name: "邯郸",
						value: 98
					}, {
						name: "临安",
						value: 99
					}, {
						name: "兰州",
						value: 99
					}, {
						name: "沧州",
						value: 100
					}, {
						name: "临沂",
						value: 103
					}, {
						name: "南充",
						value: 104
					}, {
						name: "天津",
						value: 105
					}, {
						name: "富阳",
						value: 106
					}, {
						name: "泰安",
						value: 112
					}, {
						name: "诸暨",
						value: 112
					}, {
						name: "郑州",
						value: 113
					}, {
						name: "哈尔滨",
						value: 114
					}, {
						name: "聊城",
						value: 116
					}, {
						name: "芜湖",
						value: 117
					}, {
						name: "唐山",
						value: 119
					}, {
						name: "平顶山",
						value: 119
					}, {
						name: "邢台",
						value: 119
					}, {
						name: "德州",
						value: 120
					}, {
						name: "济宁",
						value: 120
					}, {
						name: "荆州",
						value: 127
					}, {
						name: "宜昌",
						value: 130
					}, {
						name: "义乌",
						value: 132
					}, {
						name: "丽水",
						value: 133
					}, {
						name: "洛阳",
						value: 134
					}, {
						name: "秦皇岛",
						value: 136
					}, {
						name: "株洲",
						value: 143
					}, {
						name: "石家庄",
						value: 147
					}, {
						name: "莱芜",
						value: 148
					}, {
						name: "常德",
						value: 152
					}, {
						name: "保定",
						value: 153
					}, {
						name: "湘潭",
						value: 154
					}, {
						name: "金华",
						value: 157
					}, {
						name: "岳阳",
						value: 169
					}, {
						name: "长沙",
						value: 175
					}, {
						name: "衢州",
						value: 177
					}, {
						name: "廊坊",
						value: 193
					}, {
						name: "菏泽",
						value: 194
					}, {
						name: "合肥",
						value: 229
					}, {
						name: "武汉",
						value: 273
					}, {
						name: "大庆",
						value: 279
					}]),
					symbolSize: 12,
					label: {
						normal: {
							show: !1
						},
						emphasis: {
							show: !1
						}
					},
					itemStyle: {
						emphasis: {
							borderColor: "#fff",
							borderWidth: 1
						}
					}
				}]
			},
			f = echarts.init(b.get(0));
		f.setOption(e)
	}
}]), angular.module("usercenter.checkMobil", ["services.usercenter", "services.i18nNotifications"]), angular.module("usercenter.checkMobil").controller("CheckMobileCtrl", ["$rootScope", "$scope", "$window", "usercenterService", "$modal", "ModalService", "$location", "$timeout", "userinfo", "i18nNotifications", function(a, b, c, d, e, f, g, h, i, j) {
	function k() {
		0 === l ? (b.isCodeAccessiable = !1, b.codeTip = "获取验证码", l = 60) : (b.isCodeAccessiable = !0, b.codeTip = "重新发送(" + l + ")", h(function() {
			l--, k()
		}, 1e3))
	}
	switch (config.product = "popup", b.title = i.title, b.userinfo = i, b.userinfo.code = "", b.title) {
	case "绑定手机":
		b.dec = "绑定手机，确保账号安全";
		break;
	case "手机验证":
		b.dec = "正确验证手机号";
		break;
	case "修改手机号":
		b.dec = "修改为常用手机号，保证账号安全"
	}
	b.checkMobile = function() {
		return /^1\d{10}$/.test(b.userinfo.phone) ? (b.mobileError = "", !0) : ($(".mobile").focus(), b.mobileError = "请填写正确的手机号", !1)
	}, b.checkCode = function() {
		return b.userinfo.code ? (b.codeError = "", !0) : ($(".code").focus(), b.codeError = "验证码不能为空", !1)
	}, b.showImageCode = function() {
		challenge && validate && seccode && b.getCode()
	}, b.getCode = function() {
		if (b.userinfo.phone) {
			b.mobileError = "";
			var a = {
				phone: b.userinfo.phone,
				geetest_challenge: challenge,
				geetest_validate: validate,
				geetest_seccode: seccode
			};
			d.relMobileCode(a).then(function(a) {
				challenge = "", validate = "", seccode = "", a.data.success ? k() : b.codeError = a.data.msg
			})
		} else b.mobileError = "请先输入手机号码才能验证！", $(".mobile").focus()
	};
	var l = 60;
	b.relAccount = function() {
		b.checkMobile() && b.checkCode() && (b.mobileError = "", b.codeError = "", d.relMobile(b.userinfo.phone, b.userinfo.password, b.userinfo.code).then(function(a) {
			a.data.success ? f.openMsgDialog({
				msg: a.data.msg
			}, function() {
				b.$close(b.userinfo.phone)
			}) : b.relErr = a.data.msg
		}))
	}, b.cancel = function() {
		b.$dismiss()
	}
}]), angular.module("usercenter.member", []), angular.module("usercenter.member").controller("MemberCtrl", ["$scope", "$modal", "usercenterService", "ModalService", "$rootScope", function(a, b, c, d, e) {
	a.pageNo = 1, a.pageSize = 10, a.setUserInfo = function() {
		if (1 == a.currentUser.type) a.userType = "个人用户";
		else if (2 == a.currentUser.type ? a.upgradeInfo = "已升级" : a.upgradeInfo = "免费升级", 3 == a.currentUser.type) a.userType = "高级用户";
		else if (21 == a.currentUser.type) a.userType = "企业子用户";
		else if (4 == a.currentUser.type) a.userType = "服务商用户";
		else if (5 == a.currentUser.type) a.userType = "公共账号";
		else if (51 == a.currentUser.type) a.userType = "公共子用户";
		else if (a.userType = "企业用户", a.currentUser.memberType) {
			if (a.currentUser.expiryTime) {
				var b = (new Date).getTime();
				a.currentUser.expiryTime <= b && (a.currentUser.memberType = null)
			}
			1 == a.currentUser.memberType || 6 == a.currentUser.memberType ? a.userPay = "(体验版)" : 7 == a.currentUser.memberType ? a.userPay = "(基础版)" : 8 == a.currentUser.memberType ? a.userPay = "(标准版)" : 2 == a.currentUser.memberType || 9 == a.currentUser.memberType ? a.userPay = "(高级版)" : 3 == a.currentUser.memberType ? a.userPay = "(专业版)" : 4 == a.currentUser.memberType && (a.userPay = "(畅享版)"), 2 != a.currentUser.type || 1 != a.currentUser.memberType && 2 != a.currentUser.memberType && 3 != a.currentUser.memberType && 4 != a.currentUser.memberType || (a.oldVersionUser = !0)
		} else a.userPay = "(免费版)"
	}, a.setUserInfo(), a.memberPrivileges = ["拥有编辑器组件，适用于个人企业用户，提供全面便捷的推广渠道助力企业自我营销和宣传", "拥有编辑器组件，适用于个人企业用户，提供全面便捷的推广渠道助力企业自我营销和宣传", "拥有编辑器组件，适用于个人企业用户，提供全面便捷的推广渠道助力企业自我营销和宣传", "拥有编辑器组件，适用于个人企业用户，提供全面便捷的推广渠道助力企业自我营销和宣传", "拥有编辑器组件，适用于个人企业用户，提供全面便捷的推广渠道助力企业自我营销和宣传", "拥有编辑器组件，适用于个人企业用户，提供全面便捷的推广渠道助力企业自我营销和宣传"], a.getXdLog = function(b, d) {
		a.xdType = b, a.currentPage = d, c.getXdlog(b, d, a.pageSize).then(function(b) {
			if (b.data.success) {
				a.xdLogs = b.data.list;
				for (var c = 0; c < a.xdLogs.length; c++) 2 == a.xdLogs[c].type ? a.xdLogs[c].xd = "-" + a.xdLogs[c].xd : a.xdLogs[c].xd = "+" + a.xdLogs[c].xd;
				a.totalItems = b.data.map.count, a.currentPage = b.data.map.pageNo, a.toPage = b.data.map.pageNo, a.numPages = Math.ceil(a.totalItems / a.pageSize)
			}
		})
	}, a.getXdLog(null, 1), a.$on("buyXd", function() {
		a.getXdLog(null, 1)
	}), a.pageChanged = function(b, c) {
		return 1 > c || c > a.numPages && 1 != c ? void alert("此页超出范围") : (a.currentPage = c, a.toPage = c, void a.getXdLog(b, c))
	}, a.getXdStatNum = function() {
		c.getXdStat().then(function(b) {
			a.getXdStat = b.data.map
		})
	}, a.getXdStatNum(), a.transferXd = function() {
		b.open({
			windowClass: "six-contain",
			templateUrl: "usercenter/transfer.tpl.html",
			controller: "UsercentertransferCtrl",
			resolve: {
				username: function() {
					return a.userinfo.loginName
				}
			}
		}).result.then(function() {
			a.getUserXd(), e.$broadcast("buyXd"), a.getXdStatNum()
		}, function() {})
	}, a.openInvoice = function() {
		a.openInvoiceListModal()
	}, a.openInvoiceListModal = function() {
		b.open({
			windowClass: "console seven-contain",
			templateUrl: "usercenter/console/invoice-list.tpl.html",
			controller: "GetInvoiceListCtrl"
		}).result.then(function() {}, function() {});
	}, a.renew = function(e) {
		c.getCompanyQrCode(e, 1).then(function(f) {
			var g;
			if (1 == e ? g = [{
				name: "30天",
				value: 1
			}] : 2 == e ? g = [{
				name: "180天",
				value: 1
			}] : 3 == e ? g = [{
				name: "1年",
				value: 1
			}] : 4 == e && (g = [{
				name: "1年",
				value: 1
			}]), f.data.success) {
				var h = f.data.obj;
				b.open({
					windowClass: "console",
					templateUrl: "usercenter/payment.tpl.html",
					controller: "PayMentCtrl",
					resolve: {
						qrCodeUrl: function() {
							return h.url
						},
						type: function() {
							return e
						},
						money: function() {
							return h.price / 100
						},
						oprice: function() {
							return h.oprice / 100
						},
						method: function() {
							return "member"
						},
						counts: function() {
							return g
						}
					},
					size: "lg"
				}).result.then(function() {
					c.getUserInfo().then(function(a) {
						a.data.success && (security.currentUser = a.data.obj)
					}), d.openMsgDialog({
						msg: "因网络原因，部分用户开通会有延迟",
						btn: "确定"
					}, function() {
						a.openInvoice()
					})
				}, function() {})
			} else d.openMsgDialog({
				msg: f.data.msg
			})
		})
	}
}]), angular.module("usercenter.privilege", []), angular.module("usercenter.privilege").controller("PrivilegeCtrl", ["$location", "usercenterService", "$scope", "$modal", "security", "ModalService", function(a, b, c, d, e, f) {
	c.tabid = "corporateMember", c.isActive = "privilege", c.$watch(function() {
		return e.currentUser
	}, function(a) {
		a && (c.currentUser = a, c.changeMemberType(), 2 != c.currentUser.type || 1 != c.currentUser.memberType && 2 != c.currentUser.memberType && 3 != c.currentUser.memberType && 4 != c.currentUser.memberType || (c.oldVersonUser = !0))
	}, !0), c.changeMemberType = function() {
		if (c.currentUser && c.currentUser.expiryTime) {
			var a = (new Date).getTime();
			c.currentUser.expiryTime <= a && (c.currentUser.memberType = null)
		}
	}, c.changeMemberType(), c.upgradeAccount = function(a) {
		return 1 != c.currentUser.type || c.companyInfo && 0 === c.companyInfo.status ? 1 == c.currentUser.type && c.companyInfo ? void f.openMsgDialog({
			msg: "您不是企业会员,请先申请企业会员后再进行升级！"
		}) : 2 != c.currentUser.type ? void f.openMsgDialog({
			msg: "尊敬的用户，您当前账号类型无法升级为企业用户！"
		}) : void d.open({
			windowClass: "six-contain console",
			templateUrl: "usercenter/upgrade.tpl.html",
			controller: "UpgradeCtrl",
			resolve: {
				type: function() {
					return a
				}
			}
		}).result.then(function() {}, function() {}) : void f.openMsgDialog({
			msg: "尊敬的用户，请您先申请免费企业用户，通过审核后再次升级",
			btn: "我知道了"
		}, function() {
			d.open({
				windowClass: "seven-contain",
				templateUrl: "usercenter/console/upgrade_company.tpl.html",
				controller: "UsercenterupgradeCtrl",
				resolve: {
					user: function() {
						return {
							id: c.user.id
						}
					}
				}
			}).result.then(function() {
				e.currentUser.type = 2
			}, function() {})
		}, function() {})
	}, c.cancel = function() {
		c.$close()
	}, c.upgradeCompany = function() {
		d.open({
			windowClass: "seven-contain",
			templateUrl: "usercenter/console/upgrade_company.tpl.html",
			controller: "UsercenterupgradeCtrl",
			resolve: {
				user: function() {
					return {
						id: c.user.id
					}
				}
			}
		}).result.then(function() {}, function() {})
	}
}]).controller("UpgradeCtrl", ["$modal", "$scope", "type", "usercenterService", "ModalService", "security", "$location", function(a, b, c, d, e, f, g) {
	b.agents = [{
		area: "河南",
		address: "河南省郑州市管城回族区东明路商城路茂祥大厦八层：河南一百度电子技术有限公司",
		contact: "0371-63222282、13653855809",
		site: "http://www.hneqxiu.com/"
	}, {
		area: "山西",
		address: "山西省晋中开发区汇通北路汇通财富中心15层：山西鼎轩网络传媒有限公司",
		contact: "13363548973、13935180000",
		site: "http://www.sxdxwl.com"
	}, {
		area: "重庆",
		address: "重庆市渝中区上清寺9号环球广场10层：重庆蓝海基业信息技术有限公司",
		contact: "023-63306833、18883214705",
		site: "http://www.ilanhai.cn"
	}, {
		area: "安徽",
		address: "合肥市金寨路329号国轩凯旋大厦11F????：安徽网新科技有限公司",
		contact: "400-678-0888??、15505512251",
		site: "http://www.ibw.cn"
	}, {
		area: "河北",
		address: "石家庄市中华北大街27号鑫明商务大厦1101：河北昀希科技有限公司",
		contact: "4000-636-222、13363876316",
		site: "http://www.hbeqxiu.com"
	}, {
		area: "甘肃",
		address: "甘肃省兰州市城关区天庆国际商务大厦17层:甘肃启航网络科技有限公司??",
		contact: "400-999-0931、13893244664",
		site: "http://www.lzqihang.com"
	}, {
		area: "天津",
		address: "天津市和平区南马路创新大厦30层:天津星源科技有限公司",
		contact: "022_27256676、15822774513",
		site: "http://www.samyon.com"
	}], b.confirm = function() {
		d.getCompanyQrCode(c, 1).then(function(g) {
			b.$close();
			var h;
			if (6 == c ? h = [{
				name: "1个月",
				value: 1
			}, {
				name: "2个月",
				value: 2
			}, {
				name: "3个月",
				value: 3
			}, {
				name: "4个月",
				value: 4
			}, {
				name: "5个月",
				value: 5
			}, {
				name: "6个月",
				value: 6
			}] : 7 == c ? h = [{
				name: "1年",
				value: 1
			}] : 8 == c ? h = [{
				name: "1年",
				value: 1
			}] : 9 == c && (h = [{
				name: "1年",
				value: 1
			}]), g.data.success) {
				var i = g.data.obj;
				a.open({
					windowClass: "console",
					templateUrl: "usercenter/payment.tpl.html",
					controller: "PayMentCtrl",
					resolve: {
						qrCodeUrl: function() {
							return i.url
						},
						type: function() {
							return c
						},
						money: function() {
							return i.price / 100
						},
						oprice: function() {
							return i.oprice / 100
						},
						method: function() {
							return "member"
						},
						counts: function() {
							return h
						}
					},
					size: "lg"
				}).result.then(function() {
					d.getUserInfo().then(function(a) {
						a.data.success && (f.currentUser = a.data.obj)
					}), e.openMsgDialog({
						msg: "因网络原因，部分用户开通会有延迟",
						btn: "确定"
					}, function() {
						b.openInvoice()
					})
				}, function() {})
			} else e.openMsgDialog({
				msg: g.data.msg
			})
		})
	}, b.openAgentModal = function(a) {
		e.openMsgDialog({
			title: "服务商详情",
			msg: '<div class="agent-detail"><div class="pb20"><label>名称：</label>&nbsp;<div class="content">易企秀' + a.area + '地区授权服务中心</div></div><div class="pb20"><label>地址：</label>&nbsp;<div class="content">' + a.address + '</div></div><div class="pb20"><label>联系方式：</label>&nbsp;<div class="content">' + a.contact + '</div></div><div><label>网址：</label>&nbsp;<div class="content"><a href="' + a.site + '" target="_blank">' + a.site + "</a></div></div></div>",
			btn: "确定"
		})
	}, b.openInvoice = function() {
		e.openConfirmDialog({
			msg: "是否开具发票？",
			confirmName: "是",
			cancelName: "否"
		}, function() {
			b.openInvoiceListModal()
		}, function() {
			g.path("/privilege")
		})
	}, b.openInvoiceListModal = function() {
		a.open({
			windowClass: "console seven-contain",
			templateUrl: "usercenter/console/invoice-list.tpl.html",
			controller: "GetInvoiceListCtrl"
		}).result.then(function() {}, function() {})
	}, b.cancel = function() {
		b.$close()
	}
}]).controller("PayMentCtrl", ["$modal", "$scope", "qrCodeUrl", "type", "money", "usercenterService", "method", "counts", "oprice", "ModalService", function(a, b, c, d, e, f, g, h, i, j) {
	console.log(d), b.qrCodeUrl = c;
	var k = e;
	e == i ? b.money = k : b.money = i + "-" + (i - k) + "=" + k, b.type = d, 1 == d ? b.payUrl = CLIENT_CDN + "download/vip1-201512.pdf" : 2 == d ? b.payUrl = CLIENT_CDN + "download/vip2-201512.pdf" : 3 == d ? b.payUrl = CLIENT_CDN + "download/vip4-201512.pdf" : 4 == d ? b.payUrl = CLIENT_CDN + "download/vip3-201512.pdf" : 10 == d && (b.payUrl = CLIENT_CDN + "download/xd-201512.pdf"), b.counts = h, b.payWay = "alipay", h && h.length > 0 && (b.curentCount = h[0].value);
	var l = {},
		m = {};
	l["alipay1" + b.curentCount] = c, m["alipay1" + b.curentCount] = b.money, b.paymented = function() {
		b.$close()
	}, b.invoiceNotice = function() {
		a.open({
			windowClass: "six-contain",
			templateUrl: "usercenter/invoiceNotice.tpl.html",
			controller: "PrivilegeCtrl"
		})
	}, b.cancel = function() {
		b.$dismiss()
	}, "member" == g ? b.goodsType = 0 : b.goodsType = 1, b.getWeChatUrl = function(a) {
		var c = b.payWay;
		b.payWay = a;
		var e = 1;
		if ("wechat" == b.payWay && (e = 0), l[b.payWay + "" + e + b.curentCount]) return b.qrCodeUrl = l[b.payWay + "" + e + b.curentCount], void(b.money = m[b.payWay + "" + e + b.curentCount]);
		if ("member" == g) {
			var h = d,
				i = b.curentCount;
			1 == d && 6 == b.curentCount && (h = 2, i = 1), f.getCompanyQrCode(h, e, i).then(function(a) {
				a.data.success ? (l[b.payWay + "" + e + b.curentCount] = b.qrCodeUrl = a.data.obj.url, a.data.obj.price == a.data.obj.oprice ? b.money = m[b.payWay + "" + e + b.curentCount] = a.data.obj.price / 100 : b.money = m[b.payWay + "" + e + b.curentCount] = a.data.obj.oprice / 100 + "-" + (a.data.obj.oprice / 100 - a.data.obj.price / 100) + "=" + a.data.obj.price / 100) : (j.openMsgDialog({
					msg: a.data.msg
				}), b.payWay = c)
			})
		} else f.getPayXdQrCode(d, e).then(function(a) {
			a.data.success ? (l[b.payWay + "" + e + b.curentCount] = b.qrCodeUrl = a.data.obj.url, a.data.obj.price == a.data.obj.oprice ? b.money = m[b.payWay + "" + e + b.curentCount] = a.data.obj.price / 100 : b.money = m[b.payWay + "" + e + b.curentCount] = a.data.obj.oprice / 100 + "-" + (a.data.obj.oprice / 100 - a.data.obj.price / 100) + "=" + a.data.obj.price / 100) : (j.openMsgDialog({
				msg: a.data.msg
			}), b.payWay = c)
		})
	}, b.setCount = function(a) {
		var c = b.curentCount;
		b.curentCount = a;
		var e = 1;
		if ("wechat" == b.payWay && (e = 0), l[b.payWay + "" + e + b.curentCount]) return b.qrCodeUrl = l[b.payWay + "" + e + b.curentCount], b.money = m[b.payWay + "" + e + b.curentCount], void(b.curentCount = a);
		var g = d,
			h = a;
		1 == d && 6 == a && (g = 2, h = 1), f.getCompanyQrCode(g, e, h).then(function(a) {
			a.data.success ? (l[b.payWay + "" + e + b.curentCount] = b.qrCodeUrl = a.data.obj.url, a.data.obj.price == a.data.obj.oprice ? b.money = m[b.payWay + "" + e + b.curentCount] = a.data.obj.price / 100 : b.money = m[b.payWay + "" + e + b.curentCount] = a.data.obj.oprice / 100 + "-" + (a.data.obj.oprice / 100 - a.data.obj.price / 100) + "=" + a.data.obj.price / 100) : (j.openMsgDialog({
				msg: a.data.msg
			}), b.curentCount = c)
		})
	}
}]), angular.module("usercenter", ["usercenter.privilege", "usercenter.checkMobil"]), angular.module("usercenter").controller("UserCenterCtrl", ["$rootScope", "$scope", "$window", "$routeParams", "usercenterService", "security", "$modal", "ModalService", "$location", "$filter", "i18nNotifications", "thirdpartyService", "$timeout", function(a, b, c, d, e, f, g, h, i, j, k, l, m) {
	b.PREFIX_FILE_HOST = PREFIX_FILE_HOST, b.PREFIX_SERVER_HOST = PREFIX_URL, b.PREFIX_CLIENT_HOST = PREFIX_HOST, b.isActive = "usercenter", b.isVendorUser = f.isVendorUser(), b.editInfo = {
		isEditable: !1
	}, b.password = {}, b.pageSize = 5, b.XdpageNo = 1, b.XdtoPage = "", b.pageNo = 1, b.toPage = b.XdcurrentPage = 1, b.branchToPage = 1, b.viewControl = {
		tab: d.id
	};
	b.showTab = function(a) {
		i.path("/usercenter/" + a, !1), b.viewControl.tab = a
	}, b.currentUser = f.currentUser, b.getUserInfo = function() {
		e.getUserInfo().then(function(a) {
			b.userinfo = a.data.obj, b.master = angular.copy(b.userinfo), b.url = "我做的企业秀，用的是易企秀，免费好用，你试试吧：\r\n" + PREFIX_HOST + "/home/register?u=" + b.userinfo.id, b.userinfo.headImg && b.userinfo.headImg.indexOf("http://") >= 0 && (b.thirdHead = !0);
			var c = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
			"eqs" != b.userinfo.loginName.substr(0, 3) || c.test(b.userinfo.loginName) || (b.userinfo.noRel = "未绑定", /(_qq)$/.test(b.userinfo.loginName) && (b.qqRel = !0), /(_weixin)$/.test(b.userinfo.loginName) && (b.wxRel = !0), /(_weibo)$/.test(b.userinfo.loginName) && (b.wbRel = !0)), /qq/gi.test(b.userinfo.relType) && (b.qqRel = !0), /weixin/gi.test(b.userinfo.relType) && (b.wxRel = !0), /weibo/gi.test(b.userinfo.relType) && (b.wbRel = !0), i.search().bindemail && b.relAccount()
		})
	}, b.getUserInfo(), b.getUserXd(), b.editMessage = function() {
		var a, c, d;
		4 == b.userinfo.type ? (a = "usercenter/console/serverinfo.tpl.html", c = "ApplyCtrl", d = "服务会员基本信息") : (a = "usercenter/console/companyinfo.tpl.html", c = "companyInfoCtrl"), g.open({
			windowClass: "six-contain",
			templateUrl: a,
			controller: c,
			scope: b,
			resolve: {
				userinfo: function() {
					return {
						nick: b.userinfo.nick,
						type: b.userinfo.type,
						id: b.userinfo.id,
						title: d
					}
				}
			}
		}).result.then(function(a) {
			4 == b.userinfo.type ? (b.applyInfo = a.status, b.userinfo.nick = a.applyInfoNew.nick) : a && (b.userinfo.nick = a.nick)
		}, function() {})
	}, b.copyCode = function() {
		var a, b;
		a = $(".invitation-contain span"), b = a.html(), clipboard.setData("text/plain", b)
	}, b.tabid = d.id, b.customerUpload = function() {
		g.open({
			windowClass: "img_console console",
			templateUrl: "scene/console/bg.tpl.html",
			controller: "BgConsoleCtrl",
			resolve: {
				obj: function() {
					return {
						fileType: 1
					}
				}
			}
		}).result.then(function(c) {
			if (c.width / c.height === 1) {
				b.userinfo.headImg = c.data;
				var d = {
					headImg: c.data,
					id: b.userinfo.id
				};
				return void e.saveUserInfo(d).then(function(d) {
					d.data.success && (b.editInfo.isEditable = !1, a.$broadcast("headImg.change", c.data))
				})
			}
			g.open({
				windowClass: "console seven-contain",
				templateUrl: "scene/console/imageCrop.tpl.html",
				controller: "imageCropCtrl",
				backdrop: "static",
				resolve: {
					obj: function() {
						return {
							type: "square",
							properties: {
								src: c.data
							}
						}
					}
				}
			}).result.then(function(c) {
				b.userinfo.headImg = c.src;
				var d = {
					headImg: c.src,
					id: b.userinfo.id
				};
				e.saveUserInfo(d).then(function(c) {
					c.data.success && (b.editInfo.isEditable = !1, a.$broadcast("headImg.change", c.data.obj.headImg))
				})
			}, function() {})
		}, function() {})
	}, b.domain = function() {
		g.open({
			windowClass: "six-contain",
			templateUrl: "usercenter/tab/domain.tpl.html",
			controller: "UserCenterCtrl",
			resolve: {
				param: function() {
					return {
						value: b.domainMess
					}
				}
			}
		}).result.then(function() {
			getDomainMess()
		}, function() {})
	}, b.applyShow = function() {
		g.open({
			windowClass: "six-contain",
			templateUrl: "usercenter/console/serverinfo.tpl.html",
			controller: "ApplyCtrl",
			backdrop: "static",
			invoice: !0,
			resolve: {
				userinfo: function() {
					return {
						status: b.applyInfo,
						id: b.userinfo.id,
						title: "申请成为秀客获取服务商账号",
						invoice: !0
					}
				}
			}
		}).result.then(function(a) {
			b.applyInfo = a
		}, function() {})
	}, m(function() {
		("4" == f.currentUser.type || "1" == f.currentUser.type) && e.getUserStatus().then(function(a) {
			200 == a.data.code && (b.applyInfo = a.data.map.status)
		})
	}, 400), b.know = function() {
		b.xiudian = !1
	}, b.buyXd = function() {
		g.open({
			windowClass: "console",
			templateUrl: "usercenter/buyXd.tpl.html",
			controller: "BuyXdController",
			resolve: {
				getUserXd: function() {
					return function() {
						b.getUserXd(), a.$broadcast("buyXd")
					}
				}
			}
		}).result.then(function() {}, function() {})
	}
}]).controller("BuyXdController", ["$scope", "$modal", "usercenterService", "ModalService", "getUserXd", function(a, b, c, d, e) {
	a.confirm = function() {
		c.getPayXdQrCode(10, 1).then(function(c) {
			if (a.$close(), c.data.success) {
				var f = c.data.obj;
				b.open({
					windowClass: "console",
					templateUrl: "usercenter/payment.tpl.html",
					controller: "PayMentCtrl",
					resolve: {
						qrCodeUrl: function() {
							return f.url
						},
						type: function() {
							return 10
						},
						money: function() {
							return f.price / 100
						},
						oprice: function() {
							return f.oprice / 100
						},
						method: function() {
							return "buyXd"
						},
						counts: function() {}
					}
				}).result.then(function() {
					e()
				}, function() {})
			} else d.openMsgDialog({
				msg: c.data.msg
			})
		})
	}, a.cancel = function() {
		a.$close()
	}
}]), angular.module("app.directives.addelement", []).directive("addElement", ["$compile", function(a) {
	return {
		restrict: "EA",
		link: function(b, c) {
			var d = $("#emailAddress"),
				e = $("#emailAddress").size() + 1;
			c.bind("click", function() {
				var c = angular.element('<div><input type="text" id="p_scnt" style="width:100%; height: 30px; margin-top: 15px;" ng-model="attrs.addElement" name="p_scnt_' + e + '" placeholder="Input Value" /></div>');
				d.append(c);
				var f = c.find("input");
				a(f)(b), e++
			})
		}
	}
}]).directive("showIcon", ["$compile", function(a) {
	return {
		restrict: "EA",
		require: "ngModel",
		scope: {
			check: "&callbackFn"
		},
		link: function(b, c, d, e) {
			var f, g, h = a('<a><span class = "glyphicon glyphicon-ok-circle" ng-show="enabled" style = "margin-top: 8px; color: #9ad64b; font-size: 15px;"></span></a>')(b);
			b.update = function() {
				c[0].blur(), b.check({
					arg1: {
						name: e.$name
					}
				})
			}, c.bind("focus", function() {
				f = e.$viewValue, c.parent().after(h), b.enabled = !0, ("email" === d.name || "mobile" === d.name || "tel" === d.name) && (b.enabled = !1), b.$apply()
			}).bind("blur", function() {
				b.enabled = !1, g = e.$viewValue;
				var a = new RegExp(/(\d{11})|^((\d{7,8})|(\d{4}|\d{3})-(\d{7,8})|(\d{4}|\d{3})-(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1})|(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1}))$/g);
				if ("mobile" === d.name && g && !a.test(c.val())) return alert("手机号码格式错误"), $('input[name="mobile"]').addClass("error"), void $('input[name="mobile"]').change(function() {
					$(this).removeClass("error")
				});
				if ("email" === d.name && g) {
					var h = new RegExp(/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/g);
					if (!h.test(c.val())) return alert("邮箱格式错误！"), $('input[name="email"]').addClass("error"), void $('input[name="email"]').change(function() {
						$(this).removeClass("error")
					})
				}(g || f) && f !== g && b.update(), b.$apply()
			})
		}
	}
}]).directive("ngHover", function() {
	return {
		restrict: "EA",
		scope: {
			resource: "="
		},
		link: function(a, b) {
			b.hover(function() {
				a.$apply(function() {
					a.resource.show = !0
				})
			}, function() {
				a.$apply(function() {
					a.resource.show = !1
				})
			})
		}
	}
}).directive("imgClick", function() {
	return {
		restrict: "EA",
		link: function(a, b) {
			$(b).bind("click", function() {
				$(b).find("img").css("border", "4px solid #F60"), $(b).siblings().find("img").css("border", 0)
			})
		}
	}
}).directive("customFocus", function() {
	return {
		restrict: "EA",
		link: function(a, b) {
			$(b).siblings().bind("click", function() {
				b[0].focus()
			})
		}
	}
}).directive("blurChildren", function() {
	return {
		restrict: "EA",
		link: function(a, b) {
			$(b).on("click", function(a) {
				(a.target == b[0] || $(a.target).hasClass("badge")) && $(".blurClass").find("input:visible").blur()
			})
		}
	}
}).directive("forbiddenClose", function() {
	return {
		restrict: "EAC",
		link: function(a, b) {
			$(b).on("click", function(a) {
				a.stopPropagation()
			})
		}
	}
}).directive("customeImage", function() {
	return {
		restrict: "EA",
		link: function(a, b) {
			$(b).hover(function() {
				$("<div><a></a></div>")
			}, function() {})
		}
	}
}).directive("slides", ["configSerService", function(a) {
	return {
		restrict: "EA",
		link: function(b, c) {
			var d = $(c).find(".slides_container");
			a.getActivityBanner("home").then(function(a) {
				for (var b = a.data.list, e = 0; e < b.length; e++) d.append('<div class="slides-content" style="width: ' + document.documentElement.clientWidth + 'px;"><a target="_blank" href="' + b[e].url + '"><img id="banner' + e + '" src="' + b[e].path + '" width="100%" height="100%" alt="Slide 1"></a></div>');
				document.getElementById("banner0").onload = function() {
					d.find(".slides_control").height($(".slides-content").height())
				}, $(window).on("resize", function() {
					d.find(".slides-content").css("width", document.documentElement.clientWidth), d.find(".slides_control").height($(".slides-content").height())
				}), $(c).slides({
					preload: !0,
					play: 5e3,
					pause: 2500,
					hoverPause: !0
				})
			}, function() {})
		}
	}
}]).directive("slides3", ["configSerService", function(a) {
	return {
		restrict: "EA",
		link: function(b, c, d) {
			var e = $(c).find(".slides_container");
			a.getActivityBanner(d.id).then(function(a) {
				for (var b = a.data.list, f = 0; f < b.length; f++) {
					var g = $('<a href="' + b[f].url + '" style="display:block;" target="' + b[f].target + '" ></a>');
					g.append('<img src="' + b[f].path + '" width="' + d.width + '" height="' + d.height + '" alt="' + b[f].title + '" title="' + b[f].title + '" > '), e.append(g)
				}
				$(c).slides({
					preload: !0,
					play: 3e3,
					pause: 2500,
					hoverPause: !0
				})
			})
		}
	}
}]).directive("addClass", function() {
	return {
		restrict: "EA",
		link: function(a, b) {
			$(b).closest(".textbox-wrap").find("[autofocus]").focus(), $(b).on("blur", function() {
				$(b).closest(".textbox-wrap").removeClass("focused")
			}).on("focus", function() {
				$(b).closest(".textbox-wrap").addClass("focused")
			})
		}
	}
}).directive("loadScript", ["$http", "$timeout", "$rootScope", function(a) {
	return {
		link: function(b, c) {
			var d = function() {
					b.captchaLoaded = !0
				};
			b.$watch(function() {
				return c[0].getAttribute("src")
			}, function(b) {
				b && a.jsonp(c[0].getAttribute("src")).success(d).error(d)
			}), b.$on("$destroy", function() {
				angular.element(".gt_widget").remove()
			})
		}
	}
}]), angular.module("colorpicker.module", []).factory("Helper", function() {
	return {
		closestSlider: function(a) {
			var b = a.matches || a.webkitMatchesSelector || a.mozMatchesSelector || a.msMatchesSelector;
			return b.bind(a)("I") ? a.parentNode : a
		},
		getOffset: function(a, b) {
			for (var c = 0, d = 0, e = 0, f = 0; a && !isNaN(a.offsetLeft) && !isNaN(a.offsetTop);) c += a.offsetLeft, d += a.offsetTop, b || "BODY" !== a.tagName ? (e += a.scrollLeft, f += a.scrollTop) : (e += document.documentElement.scrollLeft || a.scrollLeft, f += document.documentElement.scrollTop || a.scrollTop), a = a.offsetParent;
			return {
				top: d,
				left: c,
				scrollX: e,
				scrollY: f
			}
		},
		stringParsers: [{
			re: /rgba?\(\s*(\d{1,3})\s*,\s*(\d{1,3})\s*,\s*(\d{1,3})\s*(?:,\s*(\d+(?:\.\d+)?)\s*)?\)/,
			parse: function(a) {
				return [a[1], a[2], a[3], a[4]]
			}
		}, {
			re: /rgba?\(\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*(?:,\s*(\d+(?:\.\d+)?)\s*)?\)/,
			parse: function(a) {
				return [2.55 * a[1], 2.55 * a[2], 2.55 * a[3], a[4]]
			}
		}, {
			re: /#([a-fA-F0-9]{2})([a-fA-F0-9]{2})([a-fA-F0-9]{2})/,
			parse: function(a) {
				return [parseInt(a[1], 16), parseInt(a[2], 16), parseInt(a[3], 16)]
			}
		}, {
			re: /#([a-fA-F0-9])([a-fA-F0-9])([a-fA-F0-9])/,
			parse: function(a) {
				return [parseInt(a[1] + a[1], 16), parseInt(a[2] + a[2], 16), parseInt(a[3] + a[3], 16)]
			}
		}]
	}
}).factory("Color", ["Helper", function(a) {
	return {
		value: {
			h: 1,
			s: 1,
			b: 1,
			a: 1
		},
		rgb: function() {
			var a = this.toRGB();
			return "rgb(" + a.r + "," + a.g + "," + a.b + ")"
		},
		rgba: function() {
			var a = this.toRGB();
			return "rgba(" + a.r + "," + a.g + "," + a.b + "," + a.a + ")"
		},
		hex: function() {
			return this.toHex()
		},
		RGBtoHSB: function(a, b, c, d) {
			a /= 255, b /= 255, c /= 255;
			var e, f, g, h;
			return g = Math.max(a, b, c), h = g - Math.min(a, b, c), e = 0 === h ? null : g === a ? (b - c) / h : g === b ? (c - a) / h + 2 : (a - b) / h + 4, e = (e + 360) % 6 * 60 / 360, f = 0 === h ? 0 : h / g, {
				h: e || 1,
				s: f,
				b: g,
				a: d || 1
			}
		},
		setColor: function(b) {
			b = b.toLowerCase();
			for (var c in a.stringParsers) if (a.stringParsers.hasOwnProperty(c)) {
				var d = a.stringParsers[c],
					e = d.re.exec(b),
					f = e && d.parse(e);
				if (f) return this.value = this.RGBtoHSB.apply(null, f), !1
			}
		},
		setHue: function(a) {
			this.value.h = 1 - a
		},
		setSaturation: function(a) {
			this.value.s = a
		},
		setLightness: function(a) {
			this.value.b = 1 - a
		},
		setAlpha: function(a) {
			this.value.a = parseInt(100 * (1 - a), 10) / 100
		},
		toRGB: function(a, b, c, d) {
			a || (a = this.value.h, b = this.value.s, c = this.value.b), a *= 360;
			var e, f, g, h, i;
			return a = a % 360 / 60, i = c * b, h = i * (1 - Math.abs(a % 2 - 1)), e = f = g = c - i, a = ~~a, e += [i, h, 0, 0, h, i][a], f += [h, i, i, h, 0, 0][a], g += [0, 0, h, i, i, h][a], {
				r: Math.round(255 * e),
				g: Math.round(255 * f),
				b: Math.round(255 * g),
				a: d || this.value.a
			}
		},
		toHex: function(a, b, c, d) {
			var e = this.toRGB(a, b, c, d);
			return "#" + (1 << 24 | parseInt(e.r, 10) << 16 | parseInt(e.g, 10) << 8 | parseInt(e.b, 10)).toString(16).substr(1)
		}
	}
}]).factory("Slider", ["Helper", function(a) {
	var b = {
		maxLeft: 0,
		maxTop: 0,
		callLeft: null,
		callTop: null,
		knob: {
			top: 0,
			left: 0
		}
	},
		c = {};
	return {
		getSlider: function() {
			return b
		},
		getLeftPosition: function(a) {
			return Math.max(0, Math.min(b.maxLeft, b.left + ((a.pageX || c.left) - c.left)))
		},
		getTopPosition: function(a) {
			return Math.max(0, Math.min(b.maxTop, b.top + ((a.pageY || c.top) - c.top)))
		},
		setSlider: function(d, e) {
			var f = a.closestSlider(d.target),
				g = a.getOffset(f, e);
			b.knob = f.children[0].style, b.left = d.pageX - g.left - window.pageXOffset + g.scrollX, b.top = d.pageY - g.top - window.pageYOffset + g.scrollY, c = {
				left: d.pageX,
				top: d.pageY
			}
		},
		setSaturation: function(a, c) {
			b = {
				maxLeft: 100,
				maxTop: 100,
				callLeft: "setSaturation",
				callTop: "setLightness"
			}, this.setSlider(a, c)
		},
		setHue: function(a, c) {
			b = {
				maxLeft: 0,
				maxTop: 100,
				callLeft: !1,
				callTop: "setHue"
			}, this.setSlider(a, c)
		},
		setAlpha: function(a, c) {
			b = {
				maxLeft: 0,
				maxTop: 100,
				callLeft: !1,
				callTop: "setAlpha"
			}, this.setSlider(a, c)
		},
		setKnob: function(a, c) {
			b.knob.top = a + "px", b.knob.left = c + "px"
		}
	}
}]).directive("colorpicker", ["$document", "$compile", "Color", "Slider", "Helper", "editService", function(a, b, c, d, e, f) {
	return {
		scope: {
			disable: "@",
			y: "@"
		},
		require: "?ngModel",
		restrict: "A",
		link: function(f, g, h, i) {
			var j, k = {
				x: parseInt(h.x, 10) || 0,
				y: parseInt(f.y, 10) || 0
			},
				l = h.colorpicker ? h.colorpicker : "hex",
				m = angular.isDefined(h.colorpickerPosition) ? h.colorpickerPosition : "bottom",
				n = angular.isDefined(h.colorpickerInline) ? h.colorpickerInline : !1,
				o = angular.isDefined(h.colorpickerFixedPosition) ? h.colorpickerFixedPosition : !1,
				p = angular.isDefined(h.colorpickerParent) ? g.parent() : angular.element(document.body),
				q = angular.isDefined(h.colorpickerWithInput) ? h.colorpickerWithInput : !1,
				r = q ? '<input type="text" name="colorpicker-input">' : "",
				s = n ? "" : '<button type="button" class="close close-colorpicker">&times;</button>',
				t = '<div class="colorpicker dropdown" ng-click="$event.stopPropagation();"><div class="dropdown-menu"><colorpicker-saturation><i></i></colorpicker-saturation><colorpicker-hue><i></i></colorpicker-hue><colorpicker-alpha><i></i></colorpicker-alpha><colorpicker-preview></colorpicker-preview>' + r + s + "</div></div>",
				u = angular.element(t),
				v = c,
				w = u.find("colorpicker-hue"),
				x = u.find("colorpicker-saturation"),
				y = u.find("colorpicker-preview"),
				z = u.find("i");
			if (b(u)(f), f.disable && f.$watch("disable", function(a, b) {
				a != b && "false" == a && J()
			}), f.$watch("y", function(a, b) {
				a && a != b && (k.y = parseInt(a, 10))
			}), q) {
				var A = u.find("input");
				A.on("mousedown", function(a) {
					a.stopPropagation()
				}).on("keyup", function(a) {
					var b = this.value;
					g.val(b), i && f.$apply(i.$setViewValue(b)), a.stopPropagation(), a.preventDefault()
				}), g.on("keyup", function() {
					A.val(g.val())
				})
			}
			var B = function() {
					a.on("mousemove", D), a.on("mouseup", E)
				};
			"rgba" === l && (u.addClass("alpha"), j = u.find("colorpicker-alpha"), j.on("click", function(a) {
				d.setAlpha(a, o), D(a)
			}).on("mousedown", function(a) {
				d.setAlpha(a, o), B()
			})), w.on("click", function(a) {
				d.setHue(a, o), D(a)
			}).on("mousedown", function(a) {
				d.setHue(a, o), B()
			}), x.on("click", function(a) {
				d.setSaturation(a, o), D(a)
			}).on("mousedown", function(a) {
				d.setSaturation(a, o), B()
			}), o && u.addClass("colorpicker-fixed-position"), u.addClass("colorpicker-position-" + m), "true" === n && u.addClass("colorpicker-inline"), p.append(u), i && (i.$render = function() {
				g.val(i.$viewValue)
			}, f.$watch(h.ngModel, function() {
				F()
			})), g.on("$destroy", function() {
				u.remove()
			});
			var C = function() {
					try {
						y.css("backgroundColor", v[l]())
					} catch (a) {
						y.css("backgroundColor", v.toHex())
					}
					x.css("backgroundColor", v.toHex(v.value.h, 1, 1, 1)), "rgba" === l && (j.css.backgroundColor = v.toHex())
				},
				D = function(a) {
					var b = d.getLeftPosition(a),
						c = d.getTopPosition(a),
						e = d.getSlider();
					d.setKnob(c, b), e.callLeft && v[e.callLeft].call(v, b / 100), e.callTop && v[e.callTop].call(v, c / 100), C();
					var h = v[l]();
					return g.val(h), i && f.$apply(i.$setViewValue(h)), q && A.val(h), !1
				},
				E = function() {
					a.off("mousemove", D), a.off("mouseup", E)
				},
				F = function() {
					v.setColor(g.val()), z.eq(0).css({
						left: 100 * v.value.s + "px",
						top: 100 - 100 * v.value.b + "px"
					}), z.eq(1).css("top", 100 * (1 - v.value.h) + "px"), z.eq(2).css("top", 100 * (1 - v.value.a) + "px"), C()
				},
				G = function() {
					var a, b = e.getOffset(g[0]);
					return angular.isDefined(h.colorpickerParent) && (b.left = 0, b.top = 0), "top" === m ? a = {
						top: b.top - 147 + k.y,
						left: b.left + k.x
					} : "right" === m ? a = {
						top: b.top + k.y,
						left: b.left + 126 + k.x
					} : "bottom" === m ? (a = {
						top: b.top + g[0].offsetHeight + 2 + k.y,
						left: b.left + k.x
					}, "grid.color" == h.ngModel && (a.top = $(g[0]).offset().top + 30, a.left = $(g[0]).offset().left)) : "left" === m ? a = {
						top: b.top + k.y,
						left: b.left - 150 + k.x
					} : "sceneToobar" === m && (a = {
						top: b.top + k.y - 110,
						left: b.left - 150 + k.x + 40
					}), {
						top: a.top + "px",
						left: a.left + "px"
					}
				},
				H = function() {
					J()
				};
			n === !1 ? g.on("click", function() {
				F(), u.addClass("colorpicker-visible").css(G()), a.on("mousedown", H)
			}) : (F(), u.addClass("colorpicker-visible").css(G())), u.on("mousedown", function(a) {
				a.stopPropagation(), a.preventDefault()
			});
			var I = function(a) {
					i && f.$emit(a, {
						name: h.ngModel,
						value: i.$modelValue
					})
				},
				J = function() {
					u.hasClass("colorpicker-visible") && (u.removeClass("colorpicker-visible"), I("colorpicker-closed"), a.off("mousedown", H))
				};
			u.find("button").on("click", function() {
				J()
			})
		}
	}
}]), angular.module("app.directives.copyButton", []).directive("copyButton", [function() {
	return {
		restrict: "EA",
		scope: {
			url: "@"
		},
		link: function(a, b, c) {
			var d = new ZeroClipboard(b);
			d.on("copy", function(a) {
				var b = a.clipboardData;
				b.setData("text/plain", c.url.replace(PREFIX_HOST, PREFIX_HOST_ARRAY[Math.floor(12 * Math.random()) % 12]))
			}), d.on("ready", function() {
				d.on("aftercopy", function() {
					alert("复制成功")
				})
			})
		}
	}
}]), angular.module("app.directives.disableKeydown", []).directive("disableEdit", function() {
	function a(a, b) {
		var c = {
			37: "arrow-left",
			38: "arrow-up",
			39: "arrow-right",
			40: "arrow-down",
			9: "tab",
			27: "esc"
		};
		b.keydown(function(a) {
			c[a.which] || a.preventDefault()
		})
	}
	return {
		restrice: "EA",
		link: a
	}
}), angular.module("app.directives.notification", []).directive("notificationFadeout", ["i18nNotifications", function(a) {
	return {
		restrict: "EA",
		link: function(b, c) {
			var d = $(c);
			d.fadeOut(4e3, function() {
				a.remove(b.notification)
			})
		}
	}
}]), angular.module("app.directives.qrcode", []).directive("qrCode", function() {
	return {
		restrict: "A",
		scope: {
			qrUrl: "@"
		},
		link: function(a, b) {
			a.$watch("qrUrl", function(a) {
				//$("canvas", b).length > 0 && $("canvas", b).remove(), a && (a = a.replace(PREFIX_HOST, PREFIX_HOST_ARRAY[Math.floor(12 * Math.random()) % 12]), $(b).qrcode({
				$("canvas", b).length > 0 && $("canvas", b).remove(), a && (a = a.replace(PREFIX_HOST,PREFIX_HOST), $(b).qrcode({
					render: "canvas",
					width: 180,
					height: 180,
					text: a + (/\?/.test(a) ? "&" : "?") + "eqrcode=1"
				}))
			})
		}
	}
}).directive("qrCodeSize", function() {
	return {
		restrict: "A",
		scope: {
			qrUrl: "@"
		},
		link: function(a, b, c) {
			var d = parseInt(c.qrCodeSize, 10);
			a.$watch("qrUrl", function(a) {
				$("canvas", b).length > 0 && $("canvas", b).remove(), a && (a = a.replace(PREFIX_HOST, PREFIX_HOST_ARRAY[Math.floor(12 * Math.random()) % 12]), $(b).qrcode({
					render: "canvas",
					width: d,
					height: d,
					text: a + (/\?/.test(a) ? "&" : "?") + "eqrcode=1"
				}))
			})
		}
	}
}).directive("downloadCanvas", function() {
	return {
		restrict: "EA",
		link: function(a, b) {
			a.$on("download.canvas", function(c, d) {
				var e, f = "png";
				$.each($(b).find(".qr-size"), function(a, b) {
					$(b).attr("qr-code-size") == d && (e = $(b).find("canvas").get(0))
				}), d == $(b).find(".qr-size").attr("qrCodeSize") && console.log(d);
				var g = document.createElement("a"),
					h = document.createEvent("MouseEvents"),
					i = e.toDataURL("image/png"),
					j = function(a) {
						a = a.toLowerCase().replace(/jpg/i, "jpeg");
						var b = a.match(/png|jpeg|bmp|gif/)[0];
						return "image/" + b
					};
				i = i.replace(j(f), "image/octet-stream"), h.initEvent("click", !0, !0), g.download = a.scene.code + ".png", g.href = i, g.dispatchEvent(h)
			})
		}
	}
}), angular.module("app.directives.register", []).directive("qqButton", function() {
	return {
		restrict: "EA",
		scope: {
			someCtrlFn: "&callbackFn",
			openid: "=",
			accesstoken: "="
		},
		link: function(a, b, c) {
			QC.Login({
				btnId: c.id,
				scope: "all"
			}, function(b) {
				var c = b;
				QC.Login.check() && QC.Login.getMe(function(b, d) {
					a.openid = b, a.accesstoken = d, a.someCtrlFn({
						arg1: {
							openId: b,
							accessToken: d,
							type: "qq",
							userInfo: c
						}
					})
				})
			}, function() {
				alert("QQ登录 注销成功")
			}), $("#qqLoginBtn a").removeAttr("onclick").click(function() {
				alert("第三方注册功能即将开放")
			})
		}
	}
}).directive("wbButton", function() {
	return {
		restrict: "EA",
		link: function() {
			WB2.anyWhere(function(a) {
				a.widget.connectButton({
					id: "wb_connect_btn",
					type: "3,2",
					callback: {
						login: function() {},
						logout: function() {}
					}
				})
			}), $("#wb_connect_btn").removeAttr("onclick").click(function(a) {
				return a.stopPropagation(), a.preventDefault(), alert("新浪微博注册功能即将开放"), !1
			})
		}
	}
}), angular.module("common.directives.scroll", []).directive("eqdScroll", function() {
	var a = {
		mouseWheel: !0,
		scrollbars: !0,
		interactiveScrollbars: !0,
		click: !0,
		bounce: !1
	};
	return function(b, c, d) {
		c.css({
			position: "relative",
			overflow: "hidden"
		}), delete a.disableMouse, delete a.preventDefaultException, d.preventException && (a.preventDefaultException = {
			tagName: /^(INPUT|TEXTAREA|BUTTON|SELECT|DIV|SPAN|EM|A|LI|B)$/
		}), "true" == d.disableMouse && (a.disableMouse = !0);
		var e, f = new IScroll(c.get(0), a),
			g = b.$watch(function() {
				clearTimeout(e), e = setTimeout(function() {
					f.refresh()
				}, 100)
			});
		d.refresh && (f.on("scrollStart", function() {
			c.children().on("mousewheel", function() {
				f.y <= f.maxScrollY + 200 && b.$eval(d.refresh)
			})
		}), f.on("scrollEnd", function() {
			c.children().unbind("mousewheel")
		})), d.changePos && f.on("scrollEnd", function() {
			b.pos = {
				y: f.y
			}, b.$eval(d.changePos)
		}), c.on("$destroy", function() {
			f.destroy(), f = null, g(), clearTimeout(e)
		}), b.$on("scroll.refresh." + d.scroll, function() {
			e = setTimeout(function() {
				f.refresh()
			}, 100)
		}), b.$on("scroll.scrollTo", function(a, b, c) {
			f.scrollTo(b, c)
		})
	}
}), angular.module("common.directives.dropDown", []).directive("eqdSelect", ["$rootScope", function(a) {
	function b(b, c) {
		function d() {
			f.unbind("click", d), g.removeClass("visible")
		}
		function e(a) {
			index = a.index(), b.current = b.list[index], g.removeClass("visible")
		}
		var f = (tabletCheck(), $(document)),
			g = c.find(".eqc-drop-down-list"),
			h = g.find(".iScrollIndicator");
		c.on("$destroy", function() {
			f.unbind("click", d)
		}), b.showList = function(c) {
			return c.stopPropagation(), g.hasClass("visible") ? void d() : (a.$broadcast("iscroll.refresh." + b.scrollType), $(".eqc-drop-down-list").removeClass("visible"), g.addClass("visible"), f.click(d), void h.click(function(a) {
				a.stopPropagation()
			}))
		}, b.selectItem = function(a) {
			a.stopPropagation();
			var b = a.target,
				c = b.tagName.toLowerCase(),
				d = $(b);
			"li" == c ? e(d) : "div" == c && (d = d.closest("li"), e(d))
		}
	}
	return {
		restrict: "E",
		replace: !0,
		templateUrl: "directives/select.tpl.html",
		scope: {
			list: "=",
			current: "=",
			scrollType: "@",
			fontFamily: "=",
			isBorder: "@",
			x: "@"
		},
		link: b
	}
}]).controller("SimpleSelectController", ["$scope", "$element", "$attrs", "$parse", "$timeout", function(a, b, c, d, e) {
	var f = this;
	a.list = [], a.current = null, f.addSelectChoice = function(b) {
		a.list.push(b)
	}, f.removeSelectChoice = function(b) {
		var c = a.list.indexOf(b); - 1 !== c && a.list.splice(c, 1)
	};
	var g;
	f.setObjectConfig = function(a) {
		void 0 === g && (g = a)
	}, a.setDefaultSelectedValue = function() {
		angular.forEach(a.list, function(b) {
			b.value == a.model && (a.current = b)
		})
	};
	var h = a.$watchCollection("list", function() {
		a.setDefaultSelectedValue()
	}),
		i = a.$watch("current", function(b) {
			b && a.model != b.value && (a.model = b.value, e(function() {
				c.change && a.$parent.$eval(c.change)
			}, 100))
		}),
		j = a.$watch("model", function(b) {
			b && a.setDefaultSelectedValue()
		});
	a.$on("$destroy", function() {
		h(), i(), j()
	}), a.$watch("model", function(b, c) {
		b != c && angular.forEach(a.list, function(b) {
			b.value == a.model && (a.current = b)
		})
	})
}]).directive("eqxSelect", ["$compile", function(a) {
	var b = '<eqd-select list="list" class="select-contain" current="current"></eqd-select>';
	return {
		restrict: "E",
		scope: {
			model: "="
		},
		controller: "SimpleSelectController",
		compile: function(c, d) {
			var e = d["class"];
			return c.removeClass(e), function(c, d) {
				d.append(a(angular.element(b).addClass(e))(c))
			}
		}
	}
}]).directive("eqxSelectOption", ["$parse", "$interpolate", function(a, b) {
	return {
		restrict: "E",
		require: "^eqxSelect",
		compile: function(c, d) {
			var e, f;
			return d.ngRepeat && (e = a(d.value), f = b(c.html())), function(a, b, c, d) {
				b.css("display", "none");
				var g;
				if (e) {
					var h = e(a);
					d.setObjectConfig(angular.isObject(h)), g = {
						name: f(a),
						value: h
					}
				} else g = {
					name: b.html(),
					value: a.$parent.$eval(c.value)
				};
				d.addSelectChoice(g), b.on("$destroy", function() {
					d.removeSelectChoice(g)
				})
			}
		}
	}
}]), angular.module("app.directives.numChangeAnim", []).directive("numChangeAnim", ["$filter", function(a) {
	return {
		restrict: "A",
		scope: {
			content: "@"
		},
		link: function(b, c) {
			function d(a, b) {
				return Math.floor(a + Math.random() * (b - a))
			}
			function e(a, b) {
				a = a > 0 ? a : 1;
				for (var c = Math.floor(Math.log10(a)), e = Math.floor(a / Math.pow(10, c)), f = 0, g = 10, h = function(h) {
						setTimeout(function() {
							if (10 > g) f = h;
							else {
								var i = c > h ? h : c,
									j = Math.pow(10, i) * e;
								j = j.toString().length == a.toString().length ? a : j, f = d(f, j)
							}
							b(f, 9 == h)
						}, (h * h + h + 2) / 2 * 30)
					}, i = 0; g > i; i++) h(i)
			}
			function f(b, c) {
				$(b).children("span").text(a("number")(c))
			}
			b.$watch("content", function(a) {
				if (a) {
					var b = parseInt(a, 10);
					e(b, function(a, d) {
						f(c, a), d && (f(c, b), $(c).addClass("heartbeat").css({
							"animation-duration": "1s"
						}))
					})
				}
			})
		}
	}
}]), angular.module("app.directives.switchInput", []).directive("switchInput", function() {
	function a(a, b) {
		b.hover(function() {
			a.obj.showinput = !0;
			var c = b.find("input");
			setTimeout(function() {
				c.focus(), c.select()
			}, 0), a.$apply()
		}, function() {
			a.obj.showinput = !1, a.$apply()
		})
	}
	return {
		restrict: "EA",
		scope: {
			obj: "="
		},
		link: a
	}
}), angular.module("security.authority", []).factory("authority", [function() {
	var a = {
		GROUP_CUSTOMER: 1,
		SCENE_HIDE_LASTPAGE_SETTING: 2,
		TRANSFER_SCENE: 4,
		SCENE_EDIT_TRIGGER: 8,
		EXPAND_WEBSITE: 16,
		SCENE_EDIT_SOUND: 32,
		ACCESS_NEW_PAGEFLIP: 64,
		COMP_ANIMATION: 128,
		RADIO_CHECKBOX_RATING: 256,
		INTERACTION: 512,
		ACCESS_DOMAIN_BIND: 1024,
		LOADING_LOGO: 2048,
		TEMPLATE_PAYMENT: 4096,
		INTERACTION_COUNTER: 8192,
		SCENE_PASSWORD: 16384,
		USERCENTER_HISTORY: 32768,
		APPLY_XIUKE: 65536,
		SHAKE_TRIGGER: 131072,
		ACCESS_WX_AUTH: 262144
	},
		b = {
			1: {
				code: 74045,
				name: "普通账号"
			},
			2: {
				code: 323583,
				name: "企业账号"
			},
			21: {
				code: 60415,
				name: "企业子账号"
			},
			5: {
				code: 61439,
				name: "企业账号"
			},
			51: {
				code: 59903,
				name: "企业子账号"
			},
			3: {
				code: 455679,
				name: "高级用户"
			},
			4: {
				code: 129023,
				name: "服务商用户"
			},
			99: {
				code: 127999,
				name: "超级用户"
			}
		};
	return {
		accessDef: a,
		userRoleDef: b
	}
}]), angular.module("security.authorization", ["security.service"]).provider("securityAuthorization", {
	requireAdminUser: ["securityAuthorization", function(a) {
		return a.requireAdminUser()
	}],
	requireAuthenticatedUser: ["securityAuthorization", function(a) {
		return a.requireAuthenticatedUser()
	}],
	$get: ["security", "securityRetryQueue", function(a, b) {
		var c = {
			requireAuthenticatedUser: function() {
				var d = a.requestCurrentUser().then(function() {
					return a.isAuthenticated() ? void 0 : b.pushRetryFn("unauthenticated-client", c.requireAuthenticatedUser)
				});
				return d
			},
			requireAdminUser: function() {
				var d = a.requestCurrentUser().then(function() {
					return a.isAdmin() ? void 0 : b.pushRetryFn("unauthorized-client", c.requireAdminUser)
				});
				return d
			}
		};
		return c
	}]
}), angular.module("security", ["security.service", "security.interceptor", "security.login", "security.authorization"]), angular.module("security.interceptor", ["security.retryQueue"]).factory("securityInterceptor", ["$injector", "$location", "securityRetryQueue", function(a, b, c) {
	return function(d) {
		return d.then(null, function(e) {
			return 401 === e.status && (d = c.pushRetryFn("unauthorized-server", function() {
				return a.get("$http")(e.config)
			})), 403 === e.status && (alert("对不起，您没有查看此内容的权限"), b.path("/home")), d
		})
	}
}]).config(["$httpProvider", function(a) {
	a.responseInterceptors.push("securityInterceptor");
	var b = [PREFIX_URL + "login", PREFIX_URL + "index.php?c=scene&a=createpage&id=", PREFIX_URL + "m/scene/pageList", PREFIX_URL + "index.php?c=upfile&a=upload", PREFIX_URL + "m/c/group/create", PREFIX_URL + "index.php?c=scene&a=my", PREFIX_URL + "index.php?c=scene&a=syslist", PREFIX_URL + "index.php?c=scene&a=saveSettings", PREFIX_URL + "m/scene/stat"];
	a.interceptors.push(["$q", function(a) {
		var c = 0;
		return {
			request: function(d) {
				var e = d.url;
				for (i = 0; i < b.length; i++) 0 === e.indexOf(b[i]) && ($("#loading").show(), c++);
				return d || a.when(d)
			},
			response: function(d) {
				var e = d.config.url;
				for (i = 0; i < b.length; i++) 0 === e.indexOf(b[i]) && (c--, c || $("#loading").hide());
				return d || a.when(d)
			}
		}
	}])
}]), angular.module("security.login.form", ["services.localizedMessages", "app.directives.addelement", "security.thirdparty"]).controller("LoginFormController", ["$rootScope", "$scope", "$timeout", "$window", "security", "localizedMessages", "$location", "$sce", "thirdpartyService", function(a, b, c, d, e, f, g, h, i) {
	function j() {
		0 === p ? (b.isCodeAccessiable = !1, b.codeTip = "获取验证码", p = 60) : (b.isCodeAccessiable = !0, b.codeTip = "重新发送(" + p + ")", c(function() {
			p--, j()
		}, 1e3))
	}
	b.user = {}, b.retrieve = {}, b.showLogin = !0, b.sendPassword = !1, b.unExist = !1, b.authError = null, b.isValidateCodeLogin = e.isValidateCodeLogin, b.validateCodeSrc = PREFIX_URL + "servlet/validateCodeServlet", b.authReason = null, e.getLoginReason() && (b.authReason = e.isAuthenticated() ? f.get("login.reason.notAuthorized") : "为了保障您的账号安全，请登录！"), b.rotate = function(a) {
		$(".modal-content").addClass("flip"), $(".login-form-section").fadeOut(600), c(function() {
			b.showLogin = !a, $(".login-form-section").fadeIn(0), $(".modal-content").removeClass("flip")
		}, 600)
	}, b.cancel = function() {
		b.$dismiss("close")
	}, b.user.rememberAcc = !0, b.rememberName = function(a) {
		a = !a, b.user.rememberAcc = a
	}, b.user.rememberMe = !1, b.rememberMe = function(a) {
		a = !a, b.user.rememberMe = a
	};
	var k, l, m = [];
	window.localStorage && (l = localStorage.getItem("userEmail"), k = localStorage.getItem("usersLoginInfo"), m = k ? JSON.parse(k) : [], l && (b.user.username = l, angular.forEach(m, function(a) {
		a.username === b.user.username && (b.user.password = a.password)
	})));
	var n = [];
	angular.forEach(m, function(a) {
		n.push(a.username)
	}), setTimeout(function() {
		$("#username").autocomplete({
			source: n,
			minLength: 0,
			delay: 0,
			autoFocus: !0,
			select: function(a, c) {
				angular.forEach(m, function(a) {
					a.username === c.item.value && (b.user.username = a.username, b.user.password = a.password)
				}), b.$apply()
			}
		}), $("#username").bind("focus", function() {
			$("#username").autocomplete("search", "")
		})
	}, 300), b.login = function() {
		if (!b.user.username) return b.authReason = "", void(b.authError = "用户名不能为空");
		if (!b.user.password) return b.authReason = "", void(b.authError = "密码不能为空");
		b.authError = null;
		var a = {
			username: b.user.username,
			password: b.user.password,
			rememberMe: b.user.rememberMe
		};
		return !b.isValidateCodeLogin || (a.geetest_challenge = challenge, a.geetest_validate = validate, a.geetest_seccode = seccode, challenge && validate && seccode) ? void e.login($.param(a)).then(function(a) {
			if (challenge = null, validate = null, seccode = null, a) {
				if (selectorA && selectorA(".gt_refresh_button").click(), a.map && (b.isValidateCodeLogin = a.map.isValidateCodeLogin), a.success) if (b.user.rememberAcc) {
					var c = {
						username: b.user.username,
						password: b.user.password
					},
						d = !1;
					angular.forEach(m, function(a) {
						a.username === b.user.username && (d = !0, a.password = b.user.password)
					}), d || m.push(c), localStorage.setItem("userEmail", b.user.username), localStorage.setItem("usersLoginInfo", JSON.stringify(m))
				} else localStorage.removeItem("userEmail"), angular.forEach(m, function(a, c) {
					a.username === b.user.username && m.splice(c, 1)
				}), localStorage.setItem("usersLoginInfo", JSON.stringify(m));
				b.authReason = "", b.authError = a.msg
			} else b.authError = f.get("login.error.invalidCredentials"), submit = !1
		}, function(a) {
			b.authError = f.get("login.error.serverError", {
				exception: a
			})
		}) : (b.authReason = "", void(b.authError = "验证码不能为空"))
	}, b.openRegister = function() {
		a.fromPage = g.path(), g.path("/home/register", !1)
	}, b.clearForm = function() {
		b.user = {}
	}, b.cancelLogin = function() {
		e.cancelLogin()
	}, b.reset = function() {
		b.user = {}, b.retrieve = {}
	};
	var o = "http://api.geetest.com/get.php?gt=1ebc844c9e3a8c23e2ea4b567a8afd2d&time=" + (new Date).getTime();
	b.validateCodeUrl = h.trustAsResourceUrl(o), c(function() {
		$('input[name="userEmail"]').focus()
	}, 300), b.phone = !1, b.phonePwd = function() {
		b.phone = !0
	}, b.emailPwd = function() {
		b.phone = !1
	}, b.getCode = function(a) {
		return a ? void e.getResetCode(a).success(function(a) {
			return b.userPhone = a.success, 110007 === a.code ? void(b.userPhone = "手机号格式不合法") : 1017 === a.code ? void(b.userPhone = "发送验证码过于频繁, 请稍候重试!") : 1016 === a.code ? void(b.userPhone = "发送验证码失败, 请明天再试!") : 110401 === a.code ? void(b.userPhone = "手机号码已被占用，请更换其它手机号码！") : void(200 === a.code && (b.userPhone = "", j()))
		}) : void(b.userPhone = "请填写手机号")
	};
	var p = 60;
	b.retrievePhonePassword = function() {
		return b.retrieve.phone ? b.retrieve.code ? void e.retrievePhonePassword(b.retrieve.phone, b.retrieve.code).then(function(a) {
			200 == a.data.code ? window.location.href = "/home/reset?resetToken=" + a.data.obj : 110013 == a.data.code ? b.retrieveError = "短信验证码失效，请重新获取" : 1018 == a.data.code && (b.retrieveError = "手机验证码输入错误")
		}) : void(b.codeError = "请填写手机验证码") : void(b.userPhone = "请填写手机号")
	}, b.retrievePassword = function() {
		if (!b.retrieve.email) return void(b.retrieveError = "邮箱不能为空");
		var a = /^[a-zA-Z0-9]+((-*|_*|\.?)[a-zA-Z0-9]+)*@[a-zA-Z0-9]+(([-|_]*[a-zA-Z0-9]+)*(\.[a-zA-Z0-9]+)+)+$/;
		return a.test(b.retrieve.email) ? submit ? challenge && validate && seccode ? void e.retrievePassword(b.retrieve.email, challenge, validate, seccode).then(function(a) {
			challenge = "", validate = "", seccode = "", 200 == a.data.code ? (b.sendPassword = !0, submit = !1) : (selectorA && selectorA(".gt_refresh_button").click(), 1003 == a.data.code ? b.retrieveError = "账号不存在" : 1005 == a.data.code && (b.retrieveError = "验证码错误"))
		}) : void(b.retrieveError = "验证码不能为空") : void(b.retrieveError = "验证码匹配错误") : (b.retrieveError = "请正确填写邮箱", !1)
	}, b.openThirdPatyWindow = function(a) {
		e.cancelLogin(), i.openThirtyPartyWindow(a)
	}
}]), angular.module("security.login.reset", ["services.localizedMessages"]).controller("ResetFormController", ["$scope", "security", "localizedMessages", "$location", "resetKey", function(a, b, c, d, e) {
	a.password = {}, a.checkPassword = function() {
		if (a.password.newPw) {
			if (/^[a-zA-Z0-9]{6,16}$/g.test(a.password.newPw)) return a.passError = null, !0;
			a.passError = "密码为6~16个字符(英文字母或数字，区分大小写)"
		} else a.passError = "新密码不能为空";
		return !1
	}, a.checkRepeatPassword = function() {
		if (a.password.confirm) {
			if (a.password.confirm == a.password.newPw) return a.rPassError = "", !0;
			a.rPassError = "两次密码输入不一致，请重新输入"
		} else a.rPassError = "确认密码不能为空";
		return !1
	}, a.reset = function() {
		a.checkPassword() && a.checkRepeatPassword() && b.resetPassByKey(a.password.newPw, e).then(function(b) {
			200 == b.data.code ? (alert("修改成功"), a.$close(), d.path("/main").search({})) : 1011 == b.data.code && (a.authError = b.data.msg)
		})
	}, a.cancel = function() {
		a.$dismiss()
	}
}]).directive("equals", function() {
	return {
		restrict: "A",
		require: "?ngModel",
		link: function(a, b, c, d) {
			if (d) {
				a.$watch(c.ngModel, function() {
					e()
				}), c.$observe("equals", function() {
					e()
				});
				var e = function() {
						var a = d.$viewValue,
							b = c.equals;
						d.$setValidity("equals", a === b)
					}
			}
		}
	}
}), angular.module("security.login", ["security.login.form", "security.login.reset", "security.login.toolbar"]), angular.module("security.login.toolbar", ["services.usercenter"]).directive("loginToolbar", ["security", "$rootScope", "usercenterService", "$location", "dataCacheService", function(a, b, c, d, e) {
	var f = {
		templateUrl: "security/login/toolbar.tpl.html",
		restrict: "E",
		replace: !0,
		scope: !0,
		link: function(c) {
			c.PREFIX_FILE_HOST = PREFIX_FILE_HOST, c.isAuthenticated = a.isAuthenticated, c.login = a.showLogin, c.logout = a.logout, c.requestResetPassword = a.requestResetPassword, c.isAdvancedUser = b.isAdvancedUser, c.isEditor = b.isEditor, c.isVendorUser = b.isVendorUser, c.$watch(function() {
				return a.currentUser
			}, function(a) {
				c.currentUser = a, c.currentUser.headImg ? /^http.*/.test(a.headImg) && (c.headImg = a.headImg) : c.headImg = CLIENT_CDN + "assets/images/defaultuser.jpg"
			}), c.$on("headImg.change", function(a, b) {
				c.currentUser.headImg = b
			}), c.changeCurrent = function() {
				e.clear("sceneList"), b.branchid = "", d.search("branchid", null), d.path("/usercenter/children")
			}, c.openMsgPanel = function() {
				!$(".mes_con").hasClass("open")
			}
		}
	};
	return f
}]), angular.module("security.otherregister.form", ["services.localizedMessages", "app.directives.register"]), angular.module("security.otherregister.form").controller("OtherRegisterFormController", ["$scope", "$timeout", "security", "localizedMessages", "$location", "$http", "$window", "otherRegisterInfo", function(a, b, c, d, e, f, g, h) {
	a.user = {}, a.user.agreement = !0, a.getUserDetail = function() {
		var b = {
			type: "qq",
			openId: h.openId,
			accessToken: h.accessToken
		};
		c.getUserDetail(b.type, b.openId, b.accessToken).then(function(b) {
			a.otherUserInfo = b.data.obj
		})
	}, a.getUserDetail()
}]), angular.module("security.register.form", ["services.localizedMessages", "app.directives.register", "security.thirdparty"]), angular.module("security.register.form").controller("RegisterFormController", ["$scope", "$timeout", "security", "localizedMessages", "$location", "$http", "$window", "thirdpartyService", "regMsg", function(a, b, c, d, e, f, g, h, i) {
	function j() {
		0 === l ? (a.isCodeAccessiable = !1, a.codeTip = "获取验证码", l = 60) : (a.isCodeAccessiable = !0, a.codeTip = "重新发送(" + l + ")", b(function() {
			l--, j()
		}, 1e3))
	}
	i ? a.user = i : a.user = {
		userAccount: null,
		password: null
	}, a.cancel = function() {
		a.$dismiss("close")
	}, a.regPhone = !0, a.regEmail = function() {
		a.regPhone = !1, a.usernameError = "", a.passError = "", a.regErr = "", a.user.userAccount = null, a.user.password = null
	}, a.registerPhone = function() {
		a.regPhone = !0, a.passError = "", a.usernameError = "", a.regErr = "", a.user.userAccount = null, a.user.password = null
	}, a.user.agreement = !0, a.agreement = function(b) {
		b ? a.user.agreement = !0 : a.user.agreement = !1
	}, a.regErr = "";
	var k = !1;
	a.register = function() {
		if (localStorage.getItem("alreadyShowGuide") && localStorage.removeItem("alreadyShowGuide"), !a.user.agreement) return void(a.regErr = "请先同意注册协议再完成注册");
		var b;
		if (a.regPhone) {
			if (!a.user.userAccount) return void(a.regErr = "请填写手机号");
			if (a.user.code ? a.user.password ? a.regErr = "" : a.regErr = "请输入密码" : a.regErr = "请输入验证码", !a.checkPassword(a.user.password)) return void(a.regErr = "密码格式不正确");
			if (b = {
				phone: a.user.userAccount,
				code: a.user.code,
				password: a.user.password
			}, a.user.agreement) {
				if (k) return;
				k = !0;
				var e = "";
				location.hash.indexOf("?") >= 0 && (e = location.hash.replace("/home/register", "")), c.register($.param(b), e, a.regPhone).then(function(b) {
					k = !1, b && (110007 === b.code ? a.regErr = "手机号格式不合法" : 1018 === b.code ? a.regErr = "手机验证码输入错误" : 1006 === b.code ? a.regErr = "重复注册" : 110203 === b.code ? a.regErr = "无效的账号" : 110002 === b.code ? a.regErr = "密码不能为空" : 110004 === b.code ? a.regErr = "无效的邮件地址" : 200 === b.code ? a.regErr = "" : a.regErr = b.msg)
				}, function(b) {
					k = !1, a.regErr = d.get("register.error.serverError", {
						exception: b
					})
				})
			}
		} else {
			if (!a.user.userAccount) return void(a.regErr = "请填写邮箱");
			if (!a.user.password) return void(a.regErr = "请填写密码");
			if (a.regErr = "", !(a.userNotExist && a.checkUsername(a.user.userAccount) && a.checkPassword(a.user.password))) return void(a.regErr = "请填写正确注册信息");
			b = {
				email: a.user.userAccount,
				password: a.user.password
			}, m && m.then(function() {
				if (a.user.agreement) {
					if (k) return;
					k = !0;
					var e = "";
					location.hash.indexOf("?") >= 0 && (e = location.hash.replace("/home/register", "")), c.register($.param(b), e, a.regPhone).then(function(b) {
						k = !1, b && (110007 === b.code ? a.regErr = "手机号格式不合法" : 1018 === b.code ? a.regErr = "手机验证码输入错误" : 1006 === b.code ? a.regErr = "重复注册" : 110203 === b.code ? a.regErr = "无效的账号" : 110002 === b.code ? a.regErr = "密码不能为空" : 110004 === b.code ? a.regErr = "无效的邮件地址" : 200 === b.code ? a.regErr = "" : a.regErr = b.msg)
					}, function(b) {
						k = !1, a.regErr = d.get("register.error.serverError", {
							exception: b
						})
					})
				} else a.regErr = d.get("register.error.agreement")
			})
		}
	}, a.clearError = function() {
		a.userPhone = ""
	}, a.getCode = function(b) {
		if (!b) return void(a.userPhone = "请填写手机号");
		var d = {
			phone: b
		};
		c.getCode($.param(d)).success(function(b) {
			if (200 === b.code) j();
			else {
				if (110007 === b.code) return void(a.userPhone = "手机号格式不合法");
				if (1017 === b.code) return void(a.codeError = "发送验证码过于频繁, 请稍候重试!");
				if (1016 === b.code) return void(a.userPhone = "发送验证码失败, 请明天再试!");
				1006 === b.code ? a.userPhone = "此手机号已被注册" : a.userPhone = b.msg
			}
		})
	}, a.checkCode = function(b) {
		return b ? (a.codeError = "", !0) : (a.codeError = "请输入手机验证码", !1)
	};
	var l = 60,
		m = null;
	a.checkUniqueness = function(b) {
		m = c.checkUniqueness(b).success(function(b) {
			a.userNotExist = b.success, a.userNotExist ? a.usernameError = null : a.usernameError = "已存在，请重新填写"
		})
	}, a.checkIconUser = "", a.checkIconPass = "", a.checkIconRePass = "", a.checkUsername = function(b) {
		if (b) {
			if (!a.regPhone) {
				var c = /^[a-zA-Z0-9]+((-*|_*|\.?)[a-zA-Z0-9]+)*@[a-zA-Z0-9]+(([-|_]*[a-zA-Z0-9]+)*(\.[a-zA-Z0-9]+)+)+$/;
				if (!c.test(b)) return a.usernameError = "请正确填写邮箱", !1
			}
			return a.checkUniqueness(b), !0
		}
		return a.usernameError = "邮箱不能为空", !1
	}, a.checkPassword = function() {
		if (a.user.password) {
			if (/^[a-zA-Z0-9]{6,16}$/g.test(a.user.password)) return a.passError = null, !0;
			a.passError = "密码为6~16个字符(英文字母或数字，区分大小写)"
		} else a.passError = "密码不能为空";
		return !1
	}, a.openLogin = function() {
		e.path("/home/login", !1)
	}, a.reset = function() {
		a.user = {}
	}, a.openThirdPatyWindow = function(a) {
		c.cancelRegister(), h.openThirtyPartyWindow(a)
	}
}]).controller("BindingController", ["$rootScope", "$scope", "$timeout", "security", "localizedMessages", "$location", "$http", "$window", function(a, b) {
	b.qq_url = "https://graph.qq.com/oauth2.0/authorize?response_type=token&client_id=101149132&redirect_uri=" + redirect_uri + "&display=pc", b.weibo_url = "https://api.weibo.com/oauth2/authorize?client_id=3508809852&response_type=token&redirect_uri=" + PREFIX_HOST
}]), angular.module("security.register.company", []), angular.module("security.register.company").controller("companyRegsterCtrl", ["$scope", "security", "$timeout", function(a, b, c) {
	function d() {
		0 === e ? (a.isCodeAccessiable = !1, a.codeTip = "获取验证码", e = 60) : (a.isCodeAccessiable = !0, a.codeTip = "重新发送(" + e + ")", c(function() {
			e--, d()
		}, 1e3))
	}
	a.checkName = function(b) {
		return b.name ? countCharacters(b.name) > 40 ? (a.nameError = "企业名称不能超过40个字符", !1) : (a.nameError = "", !0) : (a.nameError = "请填写企业名称", !1)
	}, a.checkEmail = function(b) {
		var c = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
		return b.email && !c.test(b.email) ? (a.emailError = "请正确填写邮箱", !1) : b.email ? (a.emailError = "", !0) : (a.emailError = "请填写企业邮箱", !1)
	}, a.checkcontacts = function(b) {
		return b.contacts ? countCharacters(b.contacts) > 30 ? (a.contactsError = "联系人不能超过30个字符", !1) : (a.contactsError = "", !0) : (a.contactsError = "请填写联系人", !1)
	}, a.checkAddress = function(b) {
		return b.address ? countCharacters(b.address) > 50 ? (a.addressError = "联系地址不能超过50个字符", !1) : (a.addressError = "", !0) : (a.addressError = "请填写联系地址", !1)
	}, a.checkCode = function(b) {
		return b.code ? (a.codeError = "", !0) : (a.codeError = "请输入手机验证码", !1)
	}, a.checkPassword = function(b) {
		if (b.password) {
			if (/^[a-zA-Z0-9]{6,16}$/g.test(b.password)) return a.pwdError = null, !0;
			a.pwdError = "密码为6~16个字符(英文字母或数字，区分大小写)"
		} else a.pwdError = "密码不能为空";
		return !1
	}, a.getCode = function(c) {
		if (!c || !c.mobile) return a.telError = "请填写手机号码", !1;
		a.telError = "";
		var e = {
			phone: c.mobile
		};
		b.getCode($.param(e)).success(function(b) {
			if (200 === b.code) d();
			else {
				if (110007 === b.code) return void(a.telError = "手机号格式不合法");
				if (1017 === b.code) return void(a.codeError = "发送验证码过于频繁, 请稍候重试!");
				if (1016 === b.code) return void(a.telError = "发送验证码失败, 请明天再试!");
				1006 === b.code ? a.telError = "此手机号已被注册" : a.telError = b.msg
			}
		})
	};
	var e = 60;
	a.checkFormFormat = function(b) {
		return a.checkName(b) && a.checkPassword(b) && a.checkEmail(b) && a.checkcontacts(b) && a.checkAddress(b) ? !0 : !1
	};
	var f = !1;
	a.register = function(c) {
		if (!c) return void(a.regErr = "请填写注册信息");
		a.regErr = "";
		var d = {
			phone: c.mobile,
			password: c.password,
			code: c.code,
			name: c.name,
			email: c.email,
			contacts: c.contacts,
			address: c.address
		};
		a.checkFormFormat(c) && (f || (f = !0, b.register($.param(d), "", c.mobile, !0).then(function(b) {
			f = !1, b && (a.regErr = b.msg)
		})))
	}
}]), angular.module("security.register", ["security.register.form", "security.otherregister.form"]), angular.module("security.retryQueue", []).factory("securityRetryQueue", ["$q", "$log", function(a, b) {
	var c = [],
		d = {
			onItemAddedCallbacks: [],
			hasMore: function() {
				return c.length > 0
			},
			push: function(a) {
				c.push(a), angular.forEach(d.onItemAddedCallbacks, function(c) {
					try {
						c(a)
					} catch (d) {
						b.error("securityRetryQueue.push(retryItem): callback threw an error" + d)
					}
				})
			},
			pushRetryFn: function(b, c) {
				1 === arguments.length && (c = b, b = void 0);
				var e = a.defer(),
					f = {
						reason: b,
						retry: function() {
							a.when(c()).then(function(a) {
								e.resolve(a)
							}, function(a) {
								e.reject(a)
							})
						},
						cancel: function() {
							e.reject()
						}
					};
				return d.push(f), e.promise
			},
			retryReason: function() {
				return d.hasMore() && c[0].reason
			},
			cancelAll: function() {
				for (; d.hasMore();) c.shift().cancel()
			},
			retryAll: function() {
				for (; d.hasMore();) c.shift().retry()
			}
		};
	return d
}]), angular.module("security.service", ["security.retryQueue", "security.login", "security.register", "security.authority", "ui.bootstrap.modal"]).factory("security", ["$rootScope", "$http", "$q", "$location", "securityRetryQueue", "$modal", "ModalService", "authority", "dataCacheService", "authService", function(a, b, c, d, e, f, g, h, i, j) {
	function k(a) {
		a = a || "/", window.location.href = a
	}
	function l() {
		t || (t = j.showAuth({
			type: "login"
		}).then(function(a) {
			"registerEnterprise" === a.type ? (d.path("/reg/guide/company"), e.cancelAll()) : "register" === a.type ? (d.path("/reg/guide/person"), e.cancelAll()) : "login" === a.type && (y.currentUser = null, y.requestCurrentUser(function() {
				var a = i.get("currentuser", "currentuser");
				a !== y.currentUser.id ? (d.path("/main"), e.cancelAll()) : e.retryAll()
			}))
		}, function() {
			e.cancelAll(), k()
		})["finally"](function() {
			t = null
		}))
	}
	function m(a, b) {
		a.close(b)
	}
	function n(a) {
		if (u) throw new Error("Trying to open a dialog that is already open!");
		u = f.open({
			windowClass: "login-container",
			keyboard: !1,
			templateUrl: "security/login/reset.tpl.html",
			controller: "ResetFormController",
			resolve: {
				resetKey: function() {
					return a
				}
			}
		}), u.result.then(function() {
			u = null
		}, function() {
			y.currentUser || d.path("/home", !1).search({}), u = null
		})
	}
	function o(b) {
		if (t) return a.fromPage.indexOf("/home") < 0 ? m(t, "register") : m(t, !0), t = null, void setTimeout(function() {
			o(b)
		}, 300);
		if (v) throw new Error("Trying to open a dialog that is already open!");
		v = f.open({
			windowClass: "login-container",
			keyboard: !1,
			templateUrl: "security/register/register.tpl.html",
			controller: "RegisterFormController",
			resolve: {
				regMsg: function() {
					return b
				}
			}
		}), v.result.then(function() {
			v = null
		}, function() {
			"/home/register" == d.path() && d.path("/home", !1), v = null
		})
	}
	function p(a) {
		if (w) throw new Error("Trying to open a dialog that is already open!");
		w = f.open({
			windowClass: "login-container",
			keyboard: !1,
			templateUrl: "security/register/otherregister.tpl.html",
			controller: "OtherRegisterFormController",
			resolve: {
				otherRegisterInfo: function() {
					return a
				}
			}
		})
	}
	function q(a) {
		x = a
	}
	function r() {
		return x
	}
	function s() {
		t = null
	}
	var t = null,
		u = null,
		v = null,
		w = null;
	e.onItemAddedCallbacks.push(function() {
		e.hasMore() && y.showLogin()
	});
	var x = {},
		y = {
			getLoginReason: function() {
				return e.retryReason()
			},
			showLogin: function() {
				l()
			},
			showRegister: function(a) {
				o(a)
			},
			showOtherRegister: function() {
				p()
			},
			getUserDetail: function(a, c, d) {
				var e = PREFIX_URL + "base/relUserInfo?type=" + a + "&openId=" + c + "&accessToken=" + d,
					f = new Date;
				return e += "&date=" + f.getTime(), b({
					method: "GET",
					url: e,
					withCredentials: !0
				})
			},
			checkUniqueness: function(a) {
				var c = PREFIX_S1_URL + "index.php?c=user&a=checkN&username=" + a,
					d = new Date;
				return c += "&date=" + d.getTime(), b({
					method: "GET",
					url: c,
					withCredentials: !0
				})
			},
			addRegisterInfo: q,
			getRegisterInfo: r,
			getCode: function(a) {
				var c = PREFIX_URL + "index.php?c=user&a=register/code";
				return b({
					method: "POST",
					url: c,
					headers: {
						"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
					},
					withCredentials: !0,
					data: a
				})
			},
			getResetCode: function(a) {
				var c = PREFIX_URL + "eqs/reset/code?phone=" + a,
					d = new Date;
				return c += "&date=" + d.getTime(), b({
					method: "POST",
					url: c,
					withCredentials: !0
				})
			},
			login: function(a) {
				var c = this,
					e = b.post(PREFIX_URL + "index.php?c=user&a=login", a, {
						withCredentials: !0,
						headers: {
							"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
						}
					});
				return e.then(function(a) {
					return 200 === a.status ? (c.isValidateCodeLogin = !1, a.data.success === !0 ? (m(t, !0), y.requestCurrentUser().then(function() {
						("/home" == d.path() || "/home/login" == d.path()) && d.path("main")
					}), a.data) : a.data) : void y.isAuthenticated()
				}, function() {
					y.isAuthenticated()
				})
			},
			closeLoginDialog: s,
			register: function(c, e, f, g) {
				var h;
				return h = f ? b.post(PREFIX_URL + "eqs/phone/register" + e, c, {
					withCredentials: !0,
					headers: {
						"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
					}
				}) : b.post(PREFIX_URL + "index.php?c=user&a=register" + e, c, {
					withCredentials: !0,
					headers: {
						"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
					}
				}), h.then(function(b) {
					if (200 === b.status) {
						if (b.data.success !== !0) return b.data;
						a.firstLogin = !0, a.firstLoginGuide = !0, ("/home" == d.path() || "/home/register" == d.path()) && d.path("main"), y.requestCurrentUser(), g ? d.path("main") : m(v, !0)
					} else y.isAuthenticated()
				}, function() {
					y.isAuthenticated()
				})
			},
			qqLogin: function(a, b) {
				y.getThirdPartyInfo(a).then(function(c) {
					var d = c.openid,
						e = (c.client_id, {
							email: "",
							password: "",
							openId: d,
							accessToken: a,
							type: "qq",
							expires: b
						});
					y.thirdPartLogin(e)
				})
			},
			thirdPartLogin: function() {
				var a = b.post(PREFIX_URL + "index.php?c=otherlogin", $.param(qqRegisterInfo), {
					withCredentials: !0,
					headers: {
						"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
					}
				});
				return a.then(function(a) {
					if (200 === a.status) {
						if (a.data.success !== !0) return a.data;
						("/home" == d.path() || "/home/login" == d.path()) && d.path("main"), y.setLoginSuccess(!0), y.requestCurrentUser(), m(w, !0)
					} else y.isAuthenticated()
				}, function() {
					y.isAuthenticated()
				})
			},
			getThirdPartyInfo: function(a) {
				var b = "https://graph.qq.com/oauth2.0/me?access_token=" + a;
				return $.ajax({
					type: "get",
					url: b,
					dataType: "jsonp",
					jsonp: "jsoncallback",
					jsonpCallback: "callback",
					xhrFields: {
						withCredentials: !0
					}
				})
			},
			weiChatLogin: function(a) {
				return b.post(PREFIX_URL + "eqs/relWechatAccount?code=" + a + "&isMobile=1&time=" + (new Date).getTime(), {}, {
					withCredentials: !0,
					headers: {
						"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
					}
				})
			},
			cancelRegister: function() {
				v = null, d.path("/home", !1)
			},
			hasRel: function(a) {
				v && m(v, !1);
				var c = new Date,
					e = PREFIX_URL + "base/user/hasRel?type=" + a.type + "&openId=" + a.openId + "&time=" + c.getTime(),
					f = b.get(e, {
						withCredentials: !0
					});
				f.then(function(b) {
					200 === b.status ? b.data.success === !0 ? (("/home" == d.path() || "/home/login" == d.path()) && d.path("main"), y.requestCurrentUser()) : "未关联账号" == b.data.msg && p(a) : y.isAuthenticated()
				}, function() {
					y.isAuthenticated()
				})
			},
			cancelLogin: function() {
				t = null, d.path("/home", !1)
			},
			logout: function(a) {
				b({
					withCredentials: !0,
					method: "GET",
					url: PREFIX_URL + "?c=user&a=logout"
				}).then(function() {
					y.currentUser = null, k(a)
				}, function() {
					y.currentUser = null, k(a)
				})
			},
			userPromise: null,
			requestCurrentUser: function(d) {
				if (y.isAuthenticated()) return c.when(y.currentUser);
				var e = new Date;
				return y.userPromise ? y.userPromise : (y.userPromise = b.get(PREFIX_URL + "index.php?c=user&a=check&time=" + e.getTime(), {
					withCredentials: !0
				}).then(function(b) {
					if (y.userPromise = null, b.data.success) {
						if (b.data.obj ? a.userPermit = "," + b.data.obj.extPermi + "," : a.userPermit = null, y.currentUser = b.data.obj, d) d();
						else {
							var c = i.get("currentuser", "currentuser");
							c !== y.currentUser.id && (i.clear(), i.push("currentuser", "currentuser", y.currentUser.id))
						}(!y.currentUser.roleIdList || y.currentUser.roleIdList.length <= 0) && (y.currentUser.roleIdList = [2])
					}
					return y.currentUser
				}, function() {
					y.userPromise = null
				}), y.userPromise)
			},
			resetPassByKey: function(a, c) {
				var d = {
					key: c,
					newPwd: a
				};
				return b.post(PREFIX_URL + "index.php?c=user&a=reset_password", $.param(d), {
					withCredentials: !0,
					headers: {
						"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
					}
				})
			},
			currentUser: null,
			isAuthenticated: function() {
				return !!y.currentUser
			},
			isLoginSuccess: !1,
			setLoginSuccess: function(a) {
				y.isLoginSuccess = a
			},
			thirdPartyUrl: {
				weiChatUrl: "https://open.weixin.qq.com/connect/qrconnect?appid=wxc5f1bbae4bb93ced&redirect_uri=http%3A%2F%2Feqxiu.com&response_type=code&scope=snsapi_login&state=WECHAT_STATE#wechat_redirect",
				qqUrl: "https://graph.qq.com/oauth2.0/authorize?response_type=token&client_id=101149132&redirect_uri=http%3A%2F%2Feqxiu.com&scope=get_user_info",
				weiboUrl: "https://api.weibo.com/oauth2/authorize?client_id=3508809852&response_type=token&redirect_uri=http://eqxiu.com"
			},
			isAllowToAccess: function(a) {
				if (!y.currentUser) return !1;
				var b = h.userRoleDef[y.currentUser.type];
				return b && (b.code & a) > 0 ? !0 : !1
			},
			accessDef: h.accessDef,
			isEditor: function() {
				if (!y.currentUser) return !1;
				var a = y.currentUser.roleIdList;
				if (!a) return !1;
				for (var b = 0; b < a.length; b++) if ("4" == a[b]) return !0;
				return !1
			},
			isAdvancedUser: function() {
				return y.currentUser && "3" == y.currentUser.type ? !0 : !1
			},
			isVendorUser: function() {
				return y.currentUser && "4" == y.currentUser.type ? !0 : !1
			},
			requestResetPassword: function(a) {
				n(a)
			},
			validateToken: function(a) {
				var c = "changepw?token=" + a;
				return b.get(PREFIX_URL + c, {
					withCredentials: !0
				})
			},
			resetPassword: function(a, c) {
				var d = PREFIX_URL + "index.php?c=Usercenter&a=changePwd",
					e = {
						oldPwd: a,
						newPwd: c
					};
				return b.post(d, $.param(e), {
					withCredentials: !0,
					headers: {
						"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
					}
				})
			},
			retrievePhonePassword: function(a, c) {
				var d = PREFIX_URL + "eqs/check/phone/code",
					e = {
						phone: a,
						code: c
					};
				return b.post(d, $.param(e), {
					withCredentials: !0,
					headers: {
						"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
					}
				})
			},
			retrievePassword: function(a, c, d, e) {
				var f = PREFIX_URL + "index.php?c=user&a=forget_password",
					g = {
						email: a,
						geetest_challenge: c,
						geetest_validate: d,
						geetest_seccode: e
					};
				return b.post(f, $.param(g), {
					withCredentials: !0,
					headers: {
						"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
					}
				})
			}
		};
	return y
}]), angular.module("security.thirdparty", ["security.service"]).factory("thirdpartyService", ["$rootScope", "$http", "$location", "$window", "security", "i18nNotifications", function(a, b, c, d, e, f) {
	function g(a) {
		var b = "https://graph.qq.com/oauth2.0/authorize?",
			c = "101149132",
			d = ["client_id=" + c, "redirect_uri=" + a, "scope=get_user_info", "response_type=token"],
			e = d.join("&");
		return i = b + e
	}
	function h(a) {
		var b = "https://open.weixin.qq.com/connect/qrconnect?",
			c = "wxc5f1bbae4bb93ced",
			d = ["appid=" + c, "redirect_uri=" + a, "scope=snsapi_login", "response_type=code", "state=WECHAT_STATE#wechat_redirect"],
			e = d.join("&");
		return j = b + e
	}
	var i, j, k = {
		qqUrl: g,
		wxUrl: h,
		qqLogin: function(a, b) {
			k.getThirdPartyInfo(a).then(function(c) {
				var d = c.openid,
					e = (c.client_id, {
						email: "",
						password: "",
						openId: d,
						accessToken: a,
						type: "qq",
						expires: b
					});
				k.thirdPartLogin(e)
			})
		},
		thirdPartLogin: function(a) {
			var d = b.post(PREFIX_URL + "index.php?c=otherlogin", $.param(a), {
				withCredentials: !0,
				headers: {
					"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
				}
			});
			return d.then(function(a) {
				if (200 === a.status) {
					if (a.data.success !== !0) return a.data;
					("/home" == c.path() || "/home/login" == c.path()) && c.path("main"), e.setLoginSuccess(!0), e.requestCurrentUser()
				} else e.isAuthenticated()
			}, function() {
				e.isAuthenticated()
			})
		},
		getThirdPartyInfo: function(a) {
			var b = "https://graph.qq.com/oauth2.0/me?access_token=" + a;
			return $.ajax({
				type: "get",
				url: b,
				dataType: "jsonp",
				jsonp: "jsoncallback",
				jsonpCallback: "callback",
				xhrFields: {
					withCredentials: !0
				}
			})
		},
		weiChatLogin: function(a) {
			return b.post(PREFIX_URL + "eqs/relWechatAccount?code=" + a + "&isMobile=1&time=" + (new Date).getTime(), {}, {
				withCredentials: !0,
				headers: {
					"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
				}
			})
		},
		unbindRelation: function(c) {
			var d = {
				type: c
			},
				e = "m/u/unRelation";
			b({
				withCredentials: !0,
				method: "POST",
				url: PREFIX_URL + e,
				data: $.param(d),
				headers: {
					"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
				}
			}).then(function(b) {
				b.data.success && a.$broadcast("mail.unbind.success", c)
			})
		},
		wxBindAccount: function(a) {
			k.bindAccountCommon(a)
		},
		qqBindAccount: function(a) {
			k.getThirdPartyInfo(a.access_token).then(function(b) {
				var c = b.openid,
					d = (b.client_id, {
						openId: c,
						accessToken: a.access_token,
						expires: a.expires_in,
						type: "qq"
					});
				k.bindAccountCommon(d)
			}, function() {})
		},
		bindAccountCommon: function(c) {
			var d = "m/u/bind/third";
			b({
				withCredentials: !0,
				method: "POST",
				url: PREFIX_URL + d,
				data: $.param(c),
				headers: {
					"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
				}
			}).then(function(b) {
				b.data.success ? a.$broadcast("rel.success", c.type) : f.pushForCurrentRoute("already.bind.error", "notify.success", {
					msg: b.data.msg
				})
			}, function() {
				alert("服务器异常！")
			})
		},
		openThirtyPartyWindow: function(a) {
			var b, c = eqShow.getDomain(window.location.href),
				e = encodeURIComponent("http://" + c + "/passport.html");
			"qq" == a ? b = k.qqUrl(e) : "weixin" == a && (b = k.wxUrl(e));
			var f = (window.outerHeight - 600) / 2,
				g = (window.outerWidth - 600) / 2;
			d.open(b, "_blank", "width=600,height=600,menubar=no,toolbar=no,location=no,directories=no,status=no,scrollbars=yes,resizable=yes,top=" + f + ",left=" + g)
		}
	};
	return k
}]), angular.module("services.config", []).factory("configService", ["$http", function(a) {
	var b = function() {
			var b = PREFIX_S2_URL + "index.php?c=ad&a=logo";
			return a({
				method: "GET",
				url: b
			})
		},
		c = function() {
			var b = PREFIX_S2_URL + "index.php?c=ad&a=banner";
			return a({
				method: "GET",
				url: b
			})
		},
		d = function() {
			var b = PREFIX_S2_URL + "index.php?c=ad&a=friendlinks";
			return a({
				method: "GET",
				url: b
			})
		};
	return {
		getBanners: c,
		getFriendLinks: d,
		getLogo: b
	}
}]), angular.module("services.dataCache", []), angular.module("services.dataCache").factory("dataCacheService", ["$timeout", "$rootScope", function(a, b) {
	var c = {};
	this.asyncUrl = "", c.clear = function(a) {
		window.sessionStorage && (a || sessionStorage.clear(), delete sessionStorage[a])
	}, c.push = function(a, b, c) {
		if (window.sessionStorage) {
			var d = sessionStorage.getItem(a);
			d = d ? JSON.parse(d) : {}, d[b] = c, sessionStorage.setItem(a, JSON.stringify(d))
		}
	}, c.get = function(a, b) {
		if (!window.sessionStorage) return null;
		var c = sessionStorage.getItem(a);
		return c ? (c = JSON.parse(c), c[b]) : null
	}, c.asyncGet = function(b, c) {
		var d = sessionStorage.getItem(b);
		d = JSON.parse(d);
		var e = a(function() {
			return d[c]
		});
		return e
	}, c.contains = function(a, b) {
		if (!window.sessionStorage) return !1;
		var c = sessionStorage[a];
		return c ? (c = JSON.parse(c), c[b] ? !0 : !1) : !1
	}, c.setAsyncUrl = function(a) {
		this.asyncUrl = a
	}, c.getAsyncUrl = function() {
		return this.asyncUrl
	};
	var d = {
		photo: [],
		audio: [],
		shapes: []
	};
	return c.pushUsedFile = function(a, b) {
		var c;
		switch (a) {
		case 1:
			c = d.photo;
			break;
		case 2:
			c = d.audio;
			break;
		case 7:
			c = d.shapes
		}
		c.indexOf(b) > -1 || c.push(b)
	}, c.removeUsedFile = function(a, b) {
		var c;
		switch (a) {
		case 1:
			c = d.photo;
			break;
		case 2:
			c = d.audio;
			break;
		case 7:
			c = d.shapes
		}
		var e = c.indexOf(b); - 1 != e && c.splice(e, 1);
	}, c.getUsedFiles = function() {
		for (var a = [], b = [], c = 0; c < d.photo.length; c++) d.photo[c] && (a.push(d.photo[c]), b.push(1));
		for (var e = 0; e < d.audio.length; e++) {
			if (!d.audio[e]) return;
			a.push(d.audio[e]), b.push(2)
		}
		for (var f = 0; f < d.shapes.length; f++) {
			if (!d.shapes[f]) return;
			a.push(d.shapes[f]), b.push(7)
		}
		return 0 !== a.length ? {
			file: a.join(","),
			type: b.join(",")
		} : void 0
	}, c.clearUsedFiles = function() {
		d = {
			photo: [],
			audio: [],
			shapes: []
		}
	}, b.$watch("user", function(a, b) {
		if (a != b) {
			var d = c.get("currentuser", "currentuser");
			d != a.id && (c.clear(), c.push("currentuser", "currentuser", a.id))
		}
	}), c
}]), angular.module("services.data", []), angular.module("services.data").factory("dataService", ["$http", "$rootScope", function(a, b) {
	var c = {};
	b.branchid;
	return c.getDatas = function(c) {
		var d = "index.php?c=scenedata&a=statSum";
		return c && (d += (/\?/.test(d) ? "&" : "?") + "user=" + c), a({
			withCredentials: !0,
			method: "GET",
			url: PREFIX_URL + d
		}).then(function(a) {
			if (a.data.success) {
				var c = a.data.obj;
				b.$broadcast("sceneDatas", c)
			}
		})
	}, c.getCustomDatas = function(c) {
		var d = "index.php?c=custom&a=statSum";
		return c && (d += (/\?/.test(d) ? "&" : "?") + "user=" + c), a({
			withCredentials: !0,
			method: "GET",
			url: PREFIX_URL + d
		}).then(function(a) {
			if (a.data.success) {
				var c = a.data.obj;
				b.$broadcast("customDatas", c)
			}
		})
	}, c.getDataBySceneId = function(b, c, d, e) {
		c = c || 1, d = d || 10;
		var f = "index.php?c=scenedata&a=getdata&id=" + b + "&pageNo=" + c + "&pageSize=" + d;
		e && (f += (/\?/.test(f) ? "&" : "?") + "user=" + e);
		var g = new Date;
		return f += "&time=" + g.getTime(), a({
			withCredentials: !0,
			method: "GET",
			url: PREFIX_URL + f
		})
	}, c.getBoardsBySceneId = function(b, c, d, e) {
		c = c || 1, d = d || 10;
		var f = "index.php?c=scenedata&a=getmsgdata&id=" + b + "&pageNo=" + c + "&pageSize=" + d;
		e && (f += (/\?/.test(f) ? "&" : "?") + "user=" + e);
		var g = new Date;
		return f += "&time=" + g.getTime(), a({
			withCredentials: !0,
			method: "GET",
			url: PREFIX_URL + f
		})
	}, c.getDataBySceneId = function(b, c, d, e) {
		c = c || 1, d = d || 10;
		var f = "index.php?c=scenedata&a=getdata&id=" + b + "&pageNo=" + c + "&pageSize=" + d;
		e && (f += (/\?/.test(f) ? "&" : "?") + "user=" + e);
		var g = new Date;
		return f += "&time=" + g.getTime(), a({
			withCredentials: !0,
			method: "GET",
			url: PREFIX_URL + f
		})
	}, c.deleteDataBySceneId = function(b, c) {
		var d = "index.php?c=scenedata&a=delete&sceneId=" + b + "&dataIds=" + c.ids;
		return a({
			withCredentials: !0,
			method: "GET",
			url: PREFIX_URL + d,
			headers: {
				"Content-Type": "text/plain; charset=UTF-8"
			}
		})
	}, c.deleteBoardsBySceneId = function(b, c) {
		var d = "m/scene/msg/data/delete?date=" + Date.now(),
			e = {
				sceneId: b,
				ids: c.ids.join(",")
			};
		return a({
			withCredentials: !0,
			method: "POST",
			url: PREFIX_URL + d,
			headers: {
				"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
			},
			data: $.param(e)
		})
	}, c.getDataDetail = function(b, c) {
		var d = "m/c/detail/" + b;
		c && (d += (/\?/.test(d) ? "&" : "?") + "user=" + c);
		var e = new Date;
		return d += (/\?/.test(d) ? "&" : "?") + "date=" + e.getTime(), a({
			withCredentials: !0,
			method: "GET",
			url: PREFIX_URL + d
		})
	}, c.getDataMessage = function(b) {
		var c = "index.php?c=custom&a=newDataScene";
		b && (c += (/\?/.test(c) ? "&" : "?") + "user=" + b);
		var d = new Date;
		return c += (/\?/.test(c) ? "&" : "?") + "date=" + d.getTime(), a({
			withCredentials: !0,
			method: "GET",
			url: PREFIX_URL + c
		})
	}, c.getAllData = function(b, c, d, e) {
		var f = "index.php?c=custom&a=getAllData&pageSize=10&pageNo=" + b;
		c && (f += (/\?/.test(f) ? "&" : "?") + "user=" + c), e && (f += (/\?/.test(f) ? "&" : "?") + "origin=" + e), d && (f += (/\?/.test(f) ? "&" : "?") + "groupId=" + d);
		var g = new Date;
		return f += (/\?/.test(f) ? "&" : "?") + "time=" + g.getTime(), a({
			withCredentials: !0,
			method: "GET",
			url: PREFIX_URL + f
		})
	}, c.getProspectDataAccount = function(b) {
		var c = "m/c/prospectCount?time=" + (new Date).getTime();
		return b && (c += (/\?/.test(c) ? "&" : "?") + "user=" + b), a({
			withCredentials: !0,
			method: "GET",
			url: PREFIX_URL + c
		})
	}, c.deleteDataById = function(b) {
		var c = "index.php?c=custom&a=delete&id=" + b;
		return a({
			withCredentials: !0,
			method: "GET",
			url: PREFIX_URL + c
		})
	}, c.saveData = function(b, c) {
		var d = c ? "m/c/create" : "m/c/save";
		return a({
			withCredentials: !0,
			method: "POST",
			headers: {
				"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
			},
			url: PREFIX_URL + d,
			data: b
		})
	}, c.getSceneField = function(b) {
		var c = "index.php?c=custom&a=formField&id=" + b,
			d = new Date;
		return c += "?time=" + d.getTime(), a({
			withCredentials: !0,
			method: "GET",
			url: PREFIX_URL + c
		})
	}, c.getPremergeScenes = function(b) {
		var c = "index.php?c=custom&a=newDataScene";
		b && (c += (/\?/.test(c) ? "&" : "?") + "user=" + b);
		var d = new Date;
		return c += (/\?/.test(c) ? "&" : "?") + "time=" + d.getTime(), a({
			withCredentials: !0,
			method: "GET",
			url: PREFIX_URL + c
		})
	}, c.mergeSceneData = function(b, c) {
		var d = "index.php?c=custom&a=imps&id=" + b;
		return a({
			withCredentials: !0,
			method: "POST",
			url: PREFIX_S3_URL + d,
			headers: {
				"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
			},
			data: $.param(c)
		})
	}, c.getOrigin = function(b) {
		var c = "index.php?c=custom&a=origin";
		return b && (c += (/\?/.test(c) ? "&" : "?") + "user=" + b), a({
			withCredentials: !0,
			method: "GET",
			url: PREFIX_URL + c
		})
	}, c.getGroups = function(b) {
		var c = "index.php?c=custom&a=grouplist";
		return b && (c += (/\?/.test(c) ? "&" : "?") + "user=" + b), a({
			withCredentials: !0,
			method: "GET",
			url: PREFIX_URL + c
		})
	}, c.assignGroup = function(b) {
		var c = "m/c/group/set?cIds=" + b.cIds + "&gIds=" + b.gIds;
		return a({
			withCredentials: !0,
			method: "POST",
			url: PREFIX_URL + c,
			headers: {
				"Content-Type": "text/plain; charset=UTF-8"
			}
		})
	}, c.deleteAssociation = function(b) {
		var c = "m/c/group/unset?cId=" + b.cId + "&gId=" + b.gId;
		return a({
			withCredentials: !0,
			method: "POST",
			url: PREFIX_URL + c,
			headers: {
				"Content-Type": "text/plain; charset=UTF-8"
			}
		})
	}, c.createGroup = function(b) {
		var c = "m/c/group/create";
		return a({
			withCredentials: !0,
			method: "POST",
			url: PREFIX_URL + c,
			headers: {
				"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
			},
			data: $.param(b)
		})
	}, c.updateSceneGroup = function(b, c) {
		var d = "index.php?c=scene&a=updateGroup";
		d += (/\?/.test(d) ? "&" : "?") + "time=" + (new Date).getTime();
		var e = {
			id: b,
			name: c
		};
		return a({
			withCredentials: !0,
			method: "POST",
			url: PREFIX_URL + d,
			data: $.param(e),
			headers: {
				"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
			}
		})
	}, c.createSceneGroup = function(b) {
		var c = "index.php?c=scene&a=createGroup";
		return a({
			withCredentials: !0,
			method: "POST",
			url: PREFIX_URL + c,
			data: $.param({
				name: b.name
			}),
			headers: {
				"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
			}
		})
	}, c.deleteCustomer = function(b) {
		var c = "index.php?c=custom&a=delete&ids=" + b.ids;
		return a({
			withCredentials: !0,
			method: "POST",
			url: PREFIX_URL + c,
			headers: {
				"Content-Type": "text/plain; charset=UTF-8"
			}
		})
	}, c.deleteGroup = function(b) {
		var c = {
			id: b
		},
			d = "m/c/group/delete";
		return a({
			withCredentials: !0,
			method: "POST",
			url: PREFIX_URL + d,
			data: $.param(c),
			headers: {
				"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
			}
		})
	}, c.modelMess = function(b) {
		var c = "m/p/sms/tpl/list?sceneId=" + b;
		return a({
			withCredentials: !0,
			method: "GET",
			url: PREFIX_ANALYSIS_HOST + c
		})
	}, c.messageNumber = function() {
		var b = "m/u/user/param/msg";
		return a({
			withCredentials: !0,
			method: "GET",
			url: PREFIX_URL + b
		})
	}, c.getMessModel = function(b) {
		var c = "m/u/list/goods?type=" + b;
		return a({
			withCredentials: !0,
			method: "GET",
			url: PREFIX_URL + c
		})
	}, c.buyMess = function(b) {
		var c = "m/u/user/msg/save",
			d = {
				id: b
			};
		return a({
			withCredentials: !0,
			method: "POST",
			url: PREFIX_URL + c,
			data: $.param(d),
			headers: {
				"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
			}
		})
	}, c.sendMess = function(b, c, d, e, f) {
		var g = "m/p/sms/batchSend",
			h = {
				ids: b,
				id: c,
				mobiles: d,
				sceneId: e,
				content: f
			};
		return a({
			withCredentials: !0,
			method: "POST",
			url: PREFIX_ANALYSIS_HOST + g,
			data: $.param(h),
			headers: {
				"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
			}
		})
	}, c.sendTatolDetail = function(b) {
		var c = "m/p/sms/list";
		return c += "?pageNo=" + b + "&pageSize=10", a({
			withCredentials: !0,
			method: "GET",
			url: PREFIX_ANALYSIS_HOST + c
		})
	}, c.sendDetail = function(b, c) {
		var d = "m/p/sms/details/" + b;
		return d += "?pageNo=" + c + "&pageSize=10", a({
			withCredentials: !0,
			method: "GET",
			url: PREFIX_ANALYSIS_HOST + d
		})
	}, c
}]), angular.module("services.exceptionHandler", ["services.i18nNotifications"]), angular.module("services.exceptionHandler").factory("exceptionHandlerFactory", ["$injector", function(a) {
	return function(b) {
		return function(c, d) {
			var e = a.get("i18nNotifications");
			b(c, d), e.pushForCurrentRoute("error.fatal", "error", {}, {
				exception: c,
				cause: d
			})
		}
	}
}]), angular.module("services.exceptionHandler").config(["$provide", function(a) {
	a.decorator("$exceptionHandler", ["$delegate", "exceptionHandlerFactory", function(a, b) {
		return b(a)
	}])
}]), angular.module("services.httpRequestTracker", []), angular.module("services.httpRequestTracker").factory("httpRequestTracker", ["$http", function(a) {
	var b = {};
	return b.hasPendingRequests = function() {
		return a.pendingRequests.length > 0
	}, b
}]), angular.module("services.i18nNotifications", ["services.notifications", "services.localizedMessages"]), angular.module("services.i18nNotifications").factory("i18nNotifications", ["localizedMessages", "notifications", function(a, b) {
	var c = function(b, c, d, e) {
			return angular.extend({
				message: a.get(b, d),
				type: a.get(c, d)
			}, e)
		},
		d = {
			pushSticky: function(a, d, e, f) {
				return b.pushSticky(c(a, d, e, f))
			},
			pushForCurrentRoute: function(a, d, e, f) {
				return b.pushForCurrentRoute(c(a, d, e, f))
			},
			pushForNextRoute: function(a, d, e, f) {
				return b.pushForNextRoute(c(a, d, e, f))
			},
			getCurrent: function() {
				return b.getCurrent()
			},
			remove: function(a) {
				return b.remove(a)
			},
			removeAll: function() {
				return b.removeAll()
			}
		};
	return d
}]), angular.module("services.localizedMessages", []).factory("localizedMessages", ["$interpolate", "I18N.MESSAGES", function(a, b) {
	var c = function(a, b) {
			return a || "?" + b + "?"
		};
	return {
		get: function(d, e) {
			var f = b[d];
			return f ? a(f)(e) : c(f, d)
		}
	}
}]), angular.module("services.mine", []), angular.module("services.mine").factory("MineService", ["$http", "$rootScope", function(a, b) {
	var c = {};
	return c.getNewSample = function() {
		var b = "index.php?c=scene&a=lable";
		return b += (/\?/.test(b) ? "&" : "?") + "time=" + (new Date).getTime(), a({
			withCredentials: !0,
			method: "POST",
			url: PREFIX_URL + b
		})
	}, c.getMyGroup = function(c) {
		var d = "index.php?c=scene&a=getMyGroup&param=" + c;
		return d += (/\?/.test(d) ? "&" : "?") + "time=" + (new Date).getTime(), a({
			withCredentials: !0,
			method: "POST",
			url: PREFIX_URL + d
		}).then(function(a) {
			200 == a.data.code && b.$broadcast("get.my.group", a.data.list)
		})
	}, c.editGroup = function(c, d) {
		var e = "index.php?c=scene&a=updateGroup";
		e += (/\?/.test(e) ? "&" : "?") + "time=" + (new Date).getTime();
		var f = {
			groupId: c,
			groupName: d
		};
		return a({
			withCredentials: !0,
			method: "POST",
			url: PREFIX_URL + e,
			headers: {
				"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
			},
			data: $.param(f)
		}).then(function(a) {
			200 == a.data.code && b.$broadcast("update.my.group", a.data.list)
		})
	}, c.deleteGroup = function(c, d) {
		var e = "index.php?c=scene&a=deleteGroup&id=" + c;
		return e += (/\?/.test(e) ? "&" : "?") + "time=" + (new Date).getTime(), a({
			withCredentials: !0,
			method: "POST",
			url: PREFIX_URL + e
		}).then(function(a) {
			200 == a.data.code && b.$broadcast("delete.my.group", d)
		})
	}, c.moveGroupScene = function(b, c) {
		var d = "index.php?c=scene&a=setGroup";
		d += (/\?/.test(d) ? "&" : "?") + "time=" + (new Date).getTime();
		var e = {
			id: b,
			sIds: c
		};
		return a({
			withCredentials: !0,
			method: "POST",
			url: PREFIX_URL + d,
			headers: {
				"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
			},
			data: $.param(e)
		})
	}, c.getSysRecommend = function(c) {
		var d = "m/scene/guided";
		c && (d += (/\?/.test(d) ? "&" : "?") + "type=" + c);
		d += (/\?/.test(d) ? "&" : "?") + "time=" + (new Date).getTime(), a({
			withCredentials: !0,
			method: "GET",
			url: PREFIX_URL + d
		}).then(function(a) {
			200 == a.data.code && b.$broadcast("get.getSysRecommend.list", a.data)
		})
	}, c.getCompanySample = function(c, d, e) {
		var f = "m/scene/group/comtemp?userId=" + c + "&pageNo=" + d + "&pageSize=" + e;
		return f += (/\?/.test(f) ? "&" : "?") + "time=" + (new Date).getTime(), a({
			withCredentials: !0,
			method: "POST",
			url: PREFIX_URL + f
		}).then(function(a) {
			200 == a.data.code && b.$broadcast("get.company.sample.scene", a.data.list)
		})
	}, c.getMyScenes = function(d, e, f, g, h, i, j) {
		var k;
		k = d ? "index.php?c=scene&a=my/" + d : "index.php?c=scene&a=my";
		var l = {
			showData: i,
			pageNo: e,
			pageSize: f,
			user: g,
			name: h,
			groupId: j
		};
		return k += (/\?/.test(k) ? "&" : "?") + "time=" + (new Date).getTime(), a({
			withCredentials: !0,
			method: "POST",
			url: PREFIX_URL + k,
			headers: {
				"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
			},
			data: $.param(l)
		}).then(function(a) {
			200 == a.data.code && (c.scenes = a.data, b.$broadcast("get.my.scene.list"))
		})
	}, c.deleteSceneById = function(b, c) {
		var d = "index.php?c=scene&a=delscene&id=" + b;
		return c && (d += "&backup=" + c), a({
			withCredentials: !0,
			method: "GET",
			url: PREFIX_URL + d
		})
	}, c.getMyHistoryScenes = function(b, c, d) {
		var e = "m/scene/recycle/list";
		return e += "?pageNo=" + (b ? b : 1), e += "&pageSize=" + (c ? c : 12), d && (e += "&user=" + d), e += (/\?/.test(e) ? "&" : "?") + "time=" + (new Date).getTime(), a({
			withCredentials: !0,
			method: "GET",
			url: PREFIX_URL + e
		})
	}, c
}]), angular.module("services.modal", ["confirm-dialog", "message-dialog", "bindemail-dialog"]).factory("ModalService", ["$modal", function(a) {
	var b = {};
	return b.openBindEmailDialog = function() {
		a.open({
			keyboard: !1,
			backdropClick: !0,
			windowClass: "confirm-dialog",
			templateUrl: "dialog/bindemail.tpl.html",
			controller: "BindEmailDialogCtrl"
		})
	}, b.openConfirmDialog = function(b, c, d) {
		a.open({
			backdrop: "static",
			keyboard: !1,
			backdropClick: !1,
			windowClass: "confirm-dialog",
			templateUrl: "dialog/confirm.tpl.html",
			controller: "ConfirmDialogCtrl",
			resolve: {
				confirmObj: function() {
					return b
				}
			}
		}).result.then(c, d)
	}, b.openMsgDialog = function(b, c, d) {
		a.open({
			backdrop: "static",
			keyboard: !1,
			backdropClick: !1,
			windowClass: "message-dialog",
			templateUrl: "dialog/message.tpl.html",
			controller: "MessageDialogCtrl",
			resolve: {
				msgObj: function() {
					return b
				}
			}
		}).result.then(c, d)
	}, b
}]), angular.module("I18N.MESSAGES", []).service("I18N.MESSAGES", ["$rootScope", function() {
	var a = {
		"notify.success": "success",
		"notify.info": "info",
		"notify.danger": "danger",
		"notify.warning": "warning",
		"notify.tip": "tip",
		"errors.route.changeError": "Route change error",
		"crud.user.save.success": "A user with id '{{id}}' was saved successfully.",
		"crud.user.remove.success": "A user with id '{{id}}' was removed successfully.",
		"crud.user.remove.error": "Something went wrong when removing user with id '{{id}}'.",
		"crud.user.save.error": "Something went wrong when saving a user...",
		"crud.project.save.success": "A project with id '{{id}}' was saved successfully.",
		"crud.project.remove.success": "A project with id '{{id}}' was removed successfully.",
		"crud.project.save.error": "Something went wrong when saving a project...",
		"login.reason.notAuthorized": "离开久了，麻烦再登录一次吧！",
		"login.reason.notAuthenticated": "为了保障您的账号安全，请登录！",
		"login.error.invalidCredentials": "登录失败，请检查邮箱和密码是否正确。",
		"login.error.serverError": "There was a problem with authenticating: {{exception}}.",
		"register.error.serverError": "There was a problem with authenticating: {{exception}}.",
		"login.reset.notmatch": "新密码和重复密码不匹配",
		"register.error.match": "两次输入密码不一致",
		"register.error.agreement": "请先同意注册协议再完成注册",
		"file.bg.pageSize": "12",
		"scene.save.success.published": "场景已保存成功！",
		"scene.save.success.nopublish": "保存成功，还需要发布哦！",
		"scene.save.success.companyTpl": "成功生成企业样例",
		"scene.clear.success.companyTpl": "成功取消企业样例",
		"companytpl.setting.success": "成功生成企业模板",
		"mytpl.setting.success": "成功生成我的模板",
		"scene.publish.success": "场景发布成功",
		"account.success": "提交成功！",
		"branch.open.success": "账号打开成功！",
		"branch.close.success": "账号关闭成功！",
		"dept.create.success": "部门创建成功！",
		"dept.update.success": "修改成功！",
		"branch.create.success": "账号创建成功！",
		"branch.update.success": "账号修改成功！",
		"scene.setting.success": "场景设置成功！",
		"data.assign.success": "分组成功！",
		"data.delete.success": "数据删除成功！",
		"group.delete.data": "分组内素材移除成功！",
		"custom.data.delete": "此条客户数据删除成功！",
		"group.delete.success": "分组删除成功！",
		"group.create.success": "分组创建成功！",
		"group.edit.success": "分组修改成功！",
		"group.scene.success": "成功将此场景移动至分组",
		"rel.tip": "您的账号还没有绑定邮箱，去用户中心->账号管理，马上绑定",
		"page.change.success": "页面名称修改成功！",
		"email.save.success": "邮箱绑定成功！",
		"bbs.save.success": "论坛账号绑定成功！",
		"reset.psw.success": "密码修改成功！",
		"save.success": "保存成功！",
		"upload.success": "上传成功！",
		"mail.rel.success": "关联成功！",
		"mail.unbind.success": "解除关联成功！",
		"file.assign.success": "分组成功！",
		"already.rel": "此账号已经关联过邮箱",
		"branch.reset.success": "子账号密码重置成功！",
		"already.bind.error": "{{msg}}",
		"reject.crop.image": "不支持裁剪GIF格式图片！",
		"visitor.apply": "信息已经提交审核，审核通过后会更新秀客信息，请耐心等待。",
		"select.trigger.source": "请选择触发源",
		"scratch.percentage.overflow": "涂抹比例不能大于100%",
		"invitation.sendemail.success": "邮件发送成功!",
		"invitation.sendemail.error": "邮件发送失败!",
		"outbox.warning": "红色警告：超出虚线外边框的内容，将无法在手机中被看到",
		"outbox.tip": "橙色警告：超出虚线内边框的内容，在部分老机型手机中将无法看到",
		"already.apply.discovery": "您已申请加入秀场，暂时不能再申请！",
		"already.apply.sample": "您已申请过成为样例，暂时不能再申请！",
		"already.apply.activity": "您已申请过参加活动，暂时不能再申请！",
		"phone.message": "成功开通短信提醒",
		"scene.apply.success": "申请成功",
		"xd.insufficient": "秀点余额不足，去用户中心－>会员服务进行充值",
		"customer.name.overflow": "姓名不能超过50个字符",
		"scene.deny.apply": "审核未通过的场景不能申请活动",
		"scene.incheck.apply": "审核中的场景不能申请活动",
		"scene.accessCode.apply": "加密设置的场景不能加入活动",
		"scene.accessClose.apply": "关闭的场景不能加入活动",
		"spread.share.messagecustomer": "请选择收件人",
		"spread.share.messageless": "可用短信数量不足,请兑换短信",
		"spread.share.messagecontent": "请先选择短信内容!",
		"spread.share.messagesendsuccess": "发送成功",
		"spread.share.messagebuylayout": "请选择购买类型",
		"spread.share.messagebuyxdless": "秀点余额不足,请先购买秀点!",
		"spread.share.guaranteeSucc": "申请保障服务成功",
		"spread.share.guaranteeClose": "取消保障服务成功",
		"print.scene.images.fail": "无法选择空图片",
		"spread.share.guaranteeBuyXd": "购买保障服务成功",
		"spread.share.guaranteeApplyError": "您的场景保障服务剩余天数不足,请先购买",
		"spread.share.guaranteeApplyUnPublice": "场景未发布,不能参加保障服务",
		"spread.share.guaranteeApplyCheck": "审核关闭的场景,不能参加保障服务",
		"spread.share.guaranteeApplyUnCheck": "审核驳回的场景,不能参加保障服务",
		"delete.scene.guarantee": "场景已经静态化,不能删除",
		"transfer.scene.guarantee": "场景已经静态化,不能转送"
	};
	return a
}]), angular.module("services.notifications", []).factory("notifications", ["$rootScope", function(a) {
	var b = {
		STICKY: [],
		ROUTE_CURRENT: [],
		ROUTE_NEXT: []
	},
		c = {},
		d = function(a, b) {
			if (!angular.isObject(b)) throw new Error("Only object can be added to the notification service");
			return a.push(b), b
		};
	return a.$on("$routeChangeSuccess", function() {
		b.ROUTE_CURRENT.length = 0, b.ROUTE_CURRENT = angular.copy(b.ROUTE_NEXT), b.ROUTE_NEXT.length = 0
	}), c.getCurrent = function() {
		return [].concat(b.STICKY, b.ROUTE_CURRENT)
	}, c.pushSticky = function(a) {
		return d(b.STICKY, a)
	}, c.pushForCurrentRoute = function(a) {
		return d(b.ROUTE_CURRENT, a)
	}, c.pushForNextRoute = function(a) {
		return d(b.ROUTE_NEXT, a)
	}, c.remove = function(a) {
		angular.forEach(b, function(b) {
			var c = b.indexOf(a);
			c > -1 && b.splice(c, 1)
		})
	}, c.removeAll = function() {
		angular.forEach(b, function(a) {
			a.length = 0
		})
	}, c
}]), angular.module("services.pagetpl", []), angular.module("services.pagetpl").factory("pageTplService", ["$http", "$rootScope", "$modal", "$q", "dataCacheService", function(a, b, c, d, e) {
	var f = {};
	return f.getPageTpls = function(b) {
		var c = "index.php?c=scene&a=getpagetpl&type=" + b,
			d = new Date;
		return c += (/\?/.test(c) ? "&" : "?") + "time=" + d.getTime(), a({
			withCredentials: !0,
			method: "GET",
			url: PREFIX_URL + c
		})
	}, f.getMyTplList = function(b) {
		var c = "/index.php?c=scene&a=pagelist&id=" + b,
			d = new Date;
		return c += (/\?/.test(c) ? "&" : "?") + "time=" + d.getTime(), a({
			withCredentials: !0,
			method: "GET",
			url: PREFIX_URL + c
		})
	}, f.getPageTplTypes = function() {
		var b = "index.php?c=statics&a=getPageTplType",
			c = new Date;
		return b += (/\?/.test(b) ? "&" : "?") + "time=" + c.getTime(), a({
			withCredentials: !0,
			method: "GET",
			url: PREFIX_URL + b
		})
	}, f.getPageTagLabel = function(b) {
		var c = "index.php?c=statics&a=tagList&type=1";
		null != b && (c += (/\?/.test(c) ? "&" : "?") + "bizType=" + b);
		var d = new Date;
		return c += (/\?/.test(c) ? "&" : "?") + "time=" + d.getTime(), a({
			withCredentials: !0,
			method: "GET",
			url: PREFIX_URL + c
		})
	}, f.getTagSysListWithType = function(b) {
		var c = "index.php?c=upfile&a=systag&type=2";
		null != b && (c += (/\?/.test(c) ? "&" : "?") + "bizType=" + b);
		var d = new Date;
		return c += (/\?/.test(c) ? "&" : "?") + "time=" + d.getTime(), a({
			withCredentials: !0,
			method: "GET",
			url: PREFIX_URL + c
		})
	}, f.getPageTagLabelCheck = function(b) {
		var c = "/m/scene/tag/page/list?id=" + b,
			d = new Date;
		return c += (/\?/.test(c) ? "&" : "?") + "time=" + d.getTime(), a({
			withCredentials: !0,
			method: "GET",
			url: PREFIX_URL + c
		})
	}, f.getPageTplTypestemp = function(b, c, d, f) {
		var g = "index.php?c=scene&a=syspagetpl",
			h = g,
			i = (new Date, {});
		return null != b && (h += (/\?/.test(g) ? "&" : "?") + "tagId=" + b, i.tagId = b), c && (h += (/\?/.test(g) ? "&" : "?") + "name=" + c, i.name = c), d && (h += (/\?/.test(g) ? "&" : "?") + "pageSize=" + d, i.pageSize = d), f && (h += (/\?/.test(g) ? "&" : "?") + "pageNo=" + f, i.pageNo = f), e.contains("pageTpl", h) ? e.asyncGet("pageTpl", h) : (e.setAsyncUrl(h), a({
			withCredentials: !0,
			method: "POST",
			url: PREFIX_URL + g,
			headers: {
				"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
			},
			data: $.param(i)
		}))
	}, f.updataChildLabel = function(b, c) {
		var d = "m/scene/tag/page/set/?ids=" + b;
		null != c && (d += (/\?/.test(d) ? "&" : "?") + "pageId=" + c);
		var e = new Date;
		return d += (/\?/.test(d) ? "&" : "?") + "time=" + e.getTime(), a({
			withCredentials: !0,
			method: "POST",
			url: PREFIX_URL + d
		})
	}, f
}]), angular.module("services.scene", ["services.modal", "services.mine", "services.data", "services.dataCache", "services.pagetpl"]), angular.module("services.scene").factory("sceneService", ["$http", "$rootScope", "$modal", "$q", "$timeout", "security", "$cacheFactory", "ModalService", "i18nNotifications", function(a, b, c, d, e, f, g, h, i) {
	var j = {};
	return j.getPageNames = function(b) {
		var c = "index.php?c=scene&a=pagelist&id=" + b + "?date=" + (new Date).getTime();
		return a({
			withCredentials: !0,
			method: "GET",
			url: PREFIX_URL + c
		})
	}, j.getActivities = function() {
		var b = PREFIX_S1_URL + "index.php?c=eqs&a=activity&all=1&joinNum=1";
		return a({
			withCredentials: !0,
			method: "GET",
			url: b
		})
	}, j.getSceneTemplatePrices = function() {
		var b = PREFIX_URL + "index.php?c=statics&a=scene_template_prices";
		return a({
			withCredentials: !0,
			method: "GET",
			url: b
		})
	}, j.getTplById = function(b) {
		var c = "m/scene/select?id=" + b,
			d = new Date;
		return c += "&time=" + d.getTime(), a({
			withCredentials: !0,
			method: "GET",
			url: PREFIX_URL + c
		})
	}, j.getUserNum = function(b) {
		var c = {
			price: b.price
		},
			d = PREFIX_URL + "m/scene/comtemp/getFreeNumber",
			e = new Date;
		return d += "?time=" + e.getTime(), a({
			withCredentials: !0,
			method: "POST",
			url: d,
			headers: {
				"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
			},
			data: $.param(c)
		})
	}, j.createByTpl = function(b) {
		var c = PREFIX_URL + "index.php?c=scene&a=createBySys";
		return a({
			withCredentials: !0,
			method: "POST",
			url: c,
			headers: {
				"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
			},
			data: $.param(b)
		})
	}, j.getSceneDetail = function(b, c) {
		var d = "index.php?c=scene&a=detail&id=" + b;
		return c && (d += (/\?/.test(d) ? "&" : "?") + "user=" + c), currentScenePromise = a({
			withCredentials: !0,
			method: "GET",
			url: PREFIX_URL + d
		}), currentScene = null, currentScenePromise.then(function(a) {
			currentScene = a.data.obj
		}), currentScenePromise
	}, j.getCurrentScene = function() {
		return currentScene
	}, j.getCurrentScenePromise = function() {
		return currentScenePromise
	}, j.saveSceneSettings = function(b) {
		b = angular.copy(b), angular.isObject(b.bgAudio) && (b.bgAudio = JSON.stringify(b.bgAudio)), b.image = null;
		var c = "index.php?c=scene&a=saveSettings";
		return a({
			withCredentials: !0,
			method: "POST",
			url: PREFIX_URL + c,
			headers: {
				"Content-Type": "text/plain; charset=UTF-8"
			},
			data: JSON.stringify(b)
		})
	}, j.publishScene = function(b, c) {
		var d = "index.php?c=scene&a=publish&id=" + b;
		c && (d += (/\?/.test(d) ? "&" : "?") + "checkType=" + c);
		var e = new Date;
		return d += "&time=" + e.getTime(), a({
			withCredentials: !0,
			method: "GET",
			url: PREFIX_URL + d
		})
	}, j.closeScene = function(b) {
		var c = "index.php?c=scene&a=off&id=" + b,
			d = new Date;
		return c += "&time=" + d.getTime(), a({
			withCredentials: !0,
			method: "GET",
			url: PREFIX_URL + c
		})
	}, j.openScene = function(b) {
		var c = "index.php?c=scene&a=on&id=" + b,
			d = new Date;
		return c += "&time=" + d.getTime(), a({
			withCredentials: !0,
			method: "GET",
			url: PREFIX_URL + c
		})
	}, j.createBlankScene = function(b, c, d) {
		var e = {
			name: b,
			type: c,
			pageMode: d
		},
			f = "index.php?c=scene&a=create";
		return a({
			withCredentials: !0,
			method: "POST",
			url: PREFIX_URL + f,
			headers: {
				"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
			},
			data: $.param(e)
		})
	}, j.copySceneById = function(b) {
		var c = "index.php?c=scene&a=createByCopy&id=" + b;
		return a({
			withCredentials: !0,
			method: "GET",
			url: PREFIX_URL + c
		})
	}, j.deleteSceneById = function(b, c) {
		var d = "index.php?c=scene&a=delscene&id=" + b;
		return c && (d += "&backup=" + c), a({
			withCredentials: !0,
			method: "GET",
			url: PREFIX_URL + d
		})
	}, j.getCoverImages = function() {
		var b = "index.php?c=upfile&a=userList&bizType=99&fileType=1&time=" + (new Date).getTime();
		return a({
			withCredentials: !0,
			method: "GET",
			url: PREFIX_URL + b
		})
	}, j.revoke = function(b) {
		var c = "m/scene/revoke?id=" + b + "&time=" + (new Date).getTime();
		return a({
			withCredentials: !0,
			method: "GET",
			url: PREFIX_URL + c
		})
	}, j.previewSceneTpl = function(b) {
		var c = "index.php?c=scene&a=syspageinfo&id=" + b,
			e = (d.defer(), new Date);
		return c += (/\?/.test(c) ? "&" : "?") + "time=" + e.getTime(), a({
			withCredentials: !0,
			method: "GET",
			url: PREFIX_URL + c
		})
	}, j.recentlyUsedTpls = function() {
		var b = "/m/scene/tpl/recently/used";
		return b += (/\?/.test(b) ? "&" : "?") + "time=" + (new Date).getTime(), a({
			withCredentials: !0,
			method: "GET",
			url: PREFIX_URL + b
		})
	}, j.recordTplUsage = function(b) {
		var c = "m/scene/usePageTpl?id=" + b;
		return a({
			withCredentials: !0,
			method: "POST",
			url: PREFIX_URL + c
		})
	}, j.getElements = function() {
		return elements
	}, j.getElementsMap = function() {
		return elementsMap
	}, j.getComponent = function(a) {
		return elementsMap[a]
	}, j.getSceneObj = function() {
		return currentPage
	}, j.previewScene = function(b) {
		var c = "index.php?c=user&a=getMyTpl&id=" + b,
			e = new Date;
		c += (/\?/.test(c) ? "&" : "?") + "time=" + e.getTime();
		var f = d.defer();
		return a({
			withCredentials: !0,
			method: "GET",
			url: PREFIX_URL + c
		}).then(function(a) {
			for (var b = g.get("tplCache") ? g.get("tplCache") : g("tplCache"), c = 0; c < a.data.list.length; c++) {
				var d = {
					data: {
						obj: {
							elements: a.data.list[c].elements,
							scene: a.data.obj
						}
					}
				};
				b.put(a.data.list[c].id, $.extend(!0, {}, d))
			}
			f.resolve(a)
		}), f.promise
	}, j.comPosition = {
		top: 0
	}, j.getActivityBanner = function(b) {
		var c = PREFIX_S2_URL + "index.php?c=ad&a=banners&pageCode=" + b;
		new Date;
		return a({
			method: "GET",
			url: c
		})
	}, j
}]).service("sceneSettingCache", ["sceneService", "pageTplService", function(a, b) {
	return {
		sceneTplPricesPromise: a.getSceneTemplatePrices(),
		pageTplsPromise: b.getPageTpls(1301),
		bottomPageTplsPromise: b.getPageTpls(1311),
		activitiesPromise: a.getActivities()
	}
}]), angular.module("services.select", []).factory("selectService", ["$rootScope", function(a) {
	var b = {},
		c = [];
	return b.addElement = function(b) {
		b += "", c.indexOf(b) >= 0 || (c.push(b), c.length > 1 && (a.$broadcast("select.more"), a.$broadcast("hideStylePanel")))
	}, b.deleteElement = function(b) {
		a.$broadcast("select.less.id", b);
		var d = c.indexOf(b + "");
		0 > d || (c.splice(d, 1), 0 === c.length && a.$broadcast("close.style.panel"), c.length <= 1 ? a.$broadcast("select.less") : a.$broadcast("hideStylePanel"))
	}, b.clearElements = function() {
		a.$broadcast("select.less", c), c = []
	}, b.getElements = function() {
		return c
	}, b
}]), angular.module("services.spread", ["services.scene"]), angular.module("services.spread").factory("SpreadService", ["$http", "sceneService", "$rootScope", function(a, b, c) {
	var d = {},
		e = function(a) {
			var b = new Date;
			return b.setDate(b.getDate() + a), b.setHours(0), b.setMinutes(0), b.setSeconds(0), b.setMilliseconds(0), b.getTime()
		};
	d.getDataBySceneId = function(b, c, d, e, f, g, h) {
		var i = "index.php?c=Stat&id=" + b;
		g && (i += (/\?/.test(i) ? "&" : "?") + "user=" + g), h && (i += (/\?/.test(i) ? "&" : "?") + "extId=" + h), c && (i += "&startDate=" + c), d && (i += "&endDate=" + d), e && (i += "&pageSize=" + e), f && (i += "&pageNo=" + f);
		var j = new Date;
		return i += "&time=" + j.getTime(), a({
			withCredentials: !0,
			method: "GET",
			url: PREFIX_URL + i
		})
	}, d.getDevicePv = function(b, d) {
		var e = "m/scene/pv/device?id=" + b + "&type=" + d,
			f = new Date;
		return e += "&time=" + f.getTime(), a({
			withCredentials: !0,
			method: "GET",
			url: PREFIX_URL + e
		}).then(function(a) {
			a.data.success ? c.$broadcast("scene.device", a.data.obj, b) : c.$broadcast("scene.device", null, b)
		})
	}, d.queryRegion = function(b, d) {
		var e = PREFIX_URL + "m/scene/pv/region?id=" + b + "&type=" + d,
			f = {
				id: b,
				type: d
			},
			g = new Date;
		return e += "&time=" + g.getTime(), a({
			withCredentials: !0,
			method: "GET",
			url: e,
			data: $.param(f)
		}).then(function(a) {
			a.data.success ? c.$broadcast("region.update", a.data.obj) : c.$broadcast("region.update")
		})
	}, d.getActivities = function() {
		var b = new Date;
		return a({
			withCredentials: !0,
			method: "GET",
			url: PREFIX_URL + "m/u/promotion/list?type=pc&time=" + b.getTime()
		})
	}, d.getActivityDetail = function(b) {
		var c = new Date;
		return a({
			withCredentials: !0,
			method: "GET",
			url: PREFIX_URL + "m/u/promotion?code=" + b + "&time=" + c.getTime()
		})
	}, d.updateName = function(b) {
		var c = PREFIX_URL + "m/scene/expand/save";
		return a({
			withCredentials: !0,
			method: "POST",
			url: c,
			headers: {
				"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
			},
			data: $.param(b)
		})
	};
	c.branchid;
	return d.getSceneDetail = function(a, d) {
		b.getSceneDetail(a, d).then(function(a) {
			c.$broadcast("scene.detail", a.data.obj, d)
		}, function() {})
	}, d.getSceneData = function(a, b, f, g, h) {
		var i = e(b),
			j = e(f),
			k = f - b;
		d.getDataBySceneId(a, i, j, k, 0, g, h).then(function(b) {
			c.$broadcast("scene.data", b.data.list, a, i, j, g)
		}, function() {})
	}, d.expandWebs = [], d.getWebList = function(b, e, f) {
		var g = "m/scene/expand/list";
		b && (g += (/\?/.test(g) ? "&" : "?") + "id=" + b), f && (g += (/\?/.test(g) ? "&" : "?") + "user=" + f), g += (/\?/.test(g) ? "&" : "?") + "showPv=" + e, g += (/\?/.test(g) ? "&" : "?") + "time=" + (new Date).getTime(), a({
			withCredentials: !0,
			method: "GET",
			url: PREFIX_URL + g
		}).then(function(a) {
			a.data.success && (d.expandWebs = a.data.list, c.$broadcast("webs.update"))
		}, function() {})
	}, d.deleteWeb = function(b) {
		var e = PREFIX_URL + "m/scene/expand/delete";
		a({
			withCredentials: !0,
			method: "POST",
			url: e,
			headers: {
				"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
			},
			data: $.param(b)
		}).then(function(a) {
			a.data.success && (d.expandWebs.splice(b.index, 1), c.$broadcast("webs.update"))
		}, function() {})
	}, d.getShareWayList = function(b) {
		var d = PREFIX_URL + "m/scene/social/share/status?id=" + b;
		a({
			withCredentials: !0,
			method: "GET",
			url: d
		}).then(function(a) {
			a.data.success && c.$broadcast("shareway.update", a.data.list)
		})
	}, d.activeShareWay = function(b, d) {
		var e = PREFIX_URL + "m/scene/share?sceneId=" + b + "&type=" + d;
		a({
			withCredentials: !0,
			method: "POST",
			url: e,
			headers: {
				"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
			}
		}).then(function(a) {
			a.data.success && c.$broadcast("active.shareway", d)
		})
	}, d.applyShareWay = function(b, d, e) {
		var f = PREFIX_URL + "m/scene/share/setting/save";
		b && (f += (/\?/.test(f) ? "&" : "?") + "id=" + b), d && (f += (/\?/.test(f) ? "&" : "?") + "type=" + d), e && (f += (/\?/.test(f) ? "&" : "?") + "value=" + e), a({
			withCredentials: !0,
			method: "POST",
			url: f,
			headers: {
				"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
			}
		}).then(function(a) {
			a.data.success && c.$broadcast("apply.scene.share", a.data)
		})
	}, d.guaranteeApply = function(b) {
		var c = new Date,
			d = PREFIX_URL + "m/scene/staticeze/" + b;
		return a({
			withCredentials: !0,
			method: "GET",
			url: d + "?time=" + c.getTime()
		})
	}, d.guaranteeClose = function(b) {
		var c = new Date,
			d = PREFIX_URL + "m/scene/cancel/static/" + b;
		return a({
			withCredentials: !0,
			method: "GET",
			url: d + "?time=" + c.getTime()
		})
	}, d.guaranteeBuy = function(b) {
		var c = PREFIX_URL + "m/scene/static/add?amount=" + b;
		return a({
			withCredentials: !0,
			method: "GET",
			url: c
		})
	}, d.guaranteeDetail = function() {
		var b = new Date,
			c = PREFIX_URL + "m/scene/static/detail";
		return a({
			withCredentials: !0,
			method: "GET",
			url: c + "?time=" + b.getTime()
		})
	}, d
}]), angular.module("services.staticRes", []), angular.module("services.staticRes").factory("staticResService", [function() {
	var a = {},
		b = [{
			name: "行业",
			value: "101"
		}, {
			name: "个人",
			value: "102"
		}, {
			name: "企业",
			value: "103"
		}, {
			name: "节假",
			value: "104"
		}, {
			name: "风格",
			value: "105"
		}, {
			name: "品牌",
			value: "106"
		}];
	a.getSceneType = function() {
		return b
	};
	var c = [{
		name: "版式",
		value: "1101"
	}, {
		name: "风格",
		value: "1103"
	}, {
		name: "互动",
		value: "1102"
	}];
	a.getBigTab = function() {
		return c
	};
	var d = {
		1101: [{
			id: 1,
			name: "图文",
			bizType: 1101
		}, {
			id: 2,
			name: "图集",
			bizType: 1101
		}, {
			id: 4,
			name: "文字",
			bizType: 1101
		}, {
			id: 5,
			name: "图表",
			bizType: 1101
		}],
		1102: [{
			id: 6,
			name: "报名表",
			bizType: 1102
		}, {
			id: 8,
			name: "留言",
			bizType: 1102
		}, {
			id: 9,
			name: "联系",
			bizType: 1102
		}],
		1103: [{
			id: 15,
			name: "黑白",
			bizType: 1103
		}, {
			id: 16,
			name: "红色",
			bizType: 1103
		}, {
			id: 17,
			name: "怀旧",
			bizType: 1103
		}, {
			id: 18,
			name: "现代",
			bizType: 1103
		}, {
			id: 19,
			name: "扁平化",
			bizType: 1103
		}, {
			id: 120,
			name: "黄色",
			bizType: 1103
		}, {
			id: 121,
			name: "绿色",
			bizType: 1103
		}, {
			id: 122,
			name: "紫色",
			bizType: 1103
		}, {
			id: 123,
			name: "黑色",
			bizType: 1103
		}, {
			id: 124,
			name: "白色",
			bizType: 1103
		}, {
			id: 125,
			name: "其他",
			bizType: 1103
		}, {
			id: 260,
			name: "English",
			bizType: 1103
		}, {
			id: 262,
			name: "Android",
			bizType: 1103
		}]
	};
	a.getPageTpls = function(a) {
		return a ? d[a] : d[1101].concat(d[1102]).concat(d[1103])
	};
	var e = [{
		id: 13076,
		name: "风格",
		value: "203",
		remark: "group1/M00/61/89/yq0KA1T2vXqAH3MxAAAdfvrWmmM009.png"
	}, {
		id: 13078,
		name: "节日",
		value: "205",
		remark: "group1/M00/61/89/yq0KA1T2vXqAGI-4AAAWKIt1ceE158.png"
	}, {
		id: 13075,
		name: "企业",
		value: "202",
		remark: "group1/M00/61/89/yq0KA1T2vXqAdp7RAAAOCH36lkY788.png"
	}, {
		id: 13074,
		name: "行业",
		value: "201",
		remark: "group1/M00/61/89/yq0KA1T2vXqARMyQAAASI6ZG0zM493.png"
	}, {
		id: 13077,
		name: "个人",
		value: "204",
		remark: "group1/M00/61/89/yq0KA1T2vXqAIorQAAAVuqdCoU4830.png"
	}, {
		id: 15162,
		name: "正版授权",
		value: "206",
		remark: null
	}];
	a.getBgTypes = function() {
		return e
	};
	var f = [{
		id: 13084,
		name: "图标",
		value: "106",
		remark: "group1/M00/61/89/yq0KA1T2vXqAOVqkAAAX-MAtU0A633.png"
	}, {
		id: 13085,
		name: "动画",
		value: "107",
		remark: "group1/M00/61/89/yq0KA1T2vXqANcAcAAATIr_b2OM515.png"
	}, {
		id: 13083,
		name: "节日",
		value: "105",
		remark: "group1/M00/61/89/yq0KA1T2vXqAGI-4AAAWKIt1ceE158.png"
	}, {
		id: 13081,
		name: "风格",
		value: "103",
		remark: "group1/M00/61/89/yq0KA1T2vXqAH3MxAAAdfvrWmmM009.png"
	}, {
		id: 13080,
		name: "企业",
		value: "102",
		remark: "group1/M00/61/89/yq0KA1T2vXqAdp7RAAAOCH36lkY788.png"
	}, {
		id: 13079,
		name: "行业",
		value: "101",
		remark: "group1/M00/61/89/yq0KA1T2vXqARMyQAAASI6ZG0zM493.png"
	}, {
		id: 13082,
		name: "个人",
		value: "104",
		remark: "group1/M00/61/89/yq0KA1T2vXqAIorQAAAVuqdCoU4830.png"
	}, {
		id: 15161,
		name: "正版授权",
		value: "109",
		remark: null
	}];
	a.getTpTypes = function() {
		return f
	};
	var g = [{
		id: 12918,
		name: "安静",
		value: "2"
	}, {
		id: 12919,
		name: "欢快",
		value: "3"
	}, {
		id: 12920,
		name: "甜蜜",
		value: "4"
	}, {
		id: 48372,
		name: "伤感",
		value: "5"
	}, {
		id: 48373,
		name: "励志",
		value: "6"
	}, {
		id: 48374,
		name: "美好",
		value: "7"
	}, {
		id: 48375,
		name: "轻松",
		value: "8"
	}];
	a.getAudioTypes = function() {
		return g
	};
	var h = [{
		id: 29331,
		name: "交通",
		value: "2"
	}, {
		id: 48376,
		name: "人物",
		value: "3"
	}, {
		id: 48377,
		name: "生活",
		value: "4"
	}, {
		id: 48378,
		name: "自然",
		value: "5"
	}, {
		id: 48379,
		name: "动物",
		value: "6"
	}, {
		id: 48380,
		name: "科技",
		value: "7"
	}, {
		id: 48381,
		name: "卡通",
		value: "8"
	}, {
		id: 48382,
		name: "其它",
		value: "9"
	}];
	return a.getSoundTypes = function() {
		return h
	}, a
}]), angular.module("services.usercenter", ["services.i18nNotifications"]).factory("usercenterService", ["$http", "$rootScope", function(a, b) {
	var c = {};
	return c.getUserInfo = function() {
		var b = PREFIX_URL + "index.php?c=user&a=check";
		return b += "?time=" + (new Date).getTime(), a({
			withCredentials: !0,
			method: "GET",
			url: b
		})
	}, c.getPhoneMessageTime = function() {
		var b = PREFIX_URL + "m/scene/remind/sms/time";
		return b += "?time=" + (new Date).getTime(), a({
			withCredentials: !0,
			method: "GET",
			url: b
		})
	}, c.getCompanyScale = function() {
		var b = PREFIX_URL + "/base/class/company_scale";
		return b += "?time=" + (new Date).getTime(), a({
			withCredentials: !0,
			method: "GET",
			url: b
		})
	}, c.getCompanyIndustry = function() {
		var b = PREFIX_URL + "/base/class/company_industry";
		return b += "?time=" + (new Date).getTime(), a({
			withCredentials: !0,
			method: "GET",
			url: b
		})
	}, c.getCompanyInfo = function() {
		var b = PREFIX_URL + "index.php?c=company&a=info";
		return b += "?time=" + (new Date).getTime(), a({
			withCredentials: !0,
			method: "GET",
			url: b
		})
	}, c.saveCompanyInfo = function(b, c) {
		var d = c ? "m/u/company/upgrade" : "m/u/company/save";
		return a({
			withCredentials: !0,
			method: "POST",
			url: PREFIX_URL + d,
			headers: {
				"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
			},
			data: $.param(b)
		})
	}, c.savePublicInfo = function(b) {
		var c = PREFIX_URL + "m/u/organiz/save";
		return a({
			withCredentials: !0,
			method: "POST",
			url: c,
			headers: {
				"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
			},
			data: $.param(b)
		})
	}, c.saveUserInfo = function(b) {
		var c = PREFIX_URL + "index.php?c=user&a=save";
		return a({
			withCredentials: !0,
			method: "POST",
			url: c,
			headers: {
				"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
			},
			data: $.param(b)
		})
	}, c.phoneMessage = function() {
		var b = PREFIX_URL + "m/scene/buy/remind/sms";
		return b += "?time=" + (new Date).getTime(), a({
			withCredentials: !0,
			method: "GET",
			url: b
		})
	}, c.getUserXd = function() {
		var b = PREFIX_URL + "index.php?c=user&a=xd";
		return b += "&time=" + (new Date).getTime(), a({
			withCredentials: !0,
			method: "GET",
			url: b
		})
	}, c.getgiveXd = function(b) {
		var c = PREFIX_URL + "index.php?c=user&a=giveXd";
		return c += "?time=" + (new Date).getTime(), a({
			withCredentials: !0,
			method: "POST",
			url: c,
			data: $.param(b),
			headers: {
				"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
			}
		})
	}, c.getUserInvoice = function() {
		var b = PREFIX_URL + "m/order/user/invoice";
		return b += "?time=" + (new Date).getTime(), a({
			withCredentials: !0,
			method: "GET",
			url: b
		})
	}, c.saveUserInvoice = function(b) {
		var c = PREFIX_URL + "m/order/user/save/invoice";
		return c += "?time=" + (new Date).getTime(), a({
			withCredentials: !0,
			method: "POST",
			url: c,
			headers: {
				"Content-Type": "text/plain; charset=UTF-8"
			},
			data: JSON.stringify(b)
		})
	}, c.saveOrderInvoice = function(b) {
		var c = PREFIX_URL + "m/order/invoice/save";
		return c += "?time=" + (new Date).getTime(), a({
			withCredentials: !0,
			method: "POST",
			url: c,
			data: $.param(b),
			headers: {
				"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
			}
		})
	}, c.getXdlog = function(b, c, d) {
		var e = PREFIX_URL + "index.php?c=user&a=xdlog&pageNo=" + c + "&pageSize=" + d;
		return e += "&time=" + (new Date).getTime(), b && (e += (/\?/.test(e) ? "&" : "?") + "type=" + b), e += (/\?/.test(e) ? "&" : "?") + "pageNo=" + c, e += (/\?/.test(e) ? "&" : "?") + "pageSize=" + d, a({
			withCredentials: !0,
			method: "POST",
			url: e
		})
	}, c.getXdStat = function() {
		var b = PREFIX_URL + "index.php?c=user&a=XdStat";
		return b += "&time=" + (new Date).getTime(), a({
			withCredentials: !0,
			method: "GET",
			url: b
		})
	}, c.thirdSettingLogName = function(b, c) {
		var d = {
			loginName: b,
			password: c
		},
			e = PREFIX_URL + "m/u/set/login/info";
		return a({
			withCredentials: !0,
			method: "POST",
			url: e,
			data: $.param(d),
			headers: {
				"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
			}
		})
	}, c.relAccount = function(b, c, d, e) {
		var f = {
			loginName: c,
			loginPassword: d
		},
			g = PREFIX_URL + "m/u/bind/email";
		return e && (g += (/\?/.test(g) ? "&" : "?") + "register=1"), g += (/\?/.test(g) ? "&" : "?") + "time=" + (new Date).getTime(), a({
			withCredentials: !0,
			method: "POST",
			url: g,
			data: $.param(f),
			headers: {
				"Content-Type": "text/plain; charset=UTF-8"
			}
		})
	}, c.relEmail = function(b, c, d) {
		var e = {
			email: b,
			pass: c,
			resend: d
		},
			f = PREFIX_URL + "m/u/bind/user/email";
		return a({
			withCredentials: !0,
			method: "POST",
			url: f,
			data: $.param(e),
			headers: {
				"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
			}
		})
	}, c.verifyEmail = function() {
		var b = PREFIX_URL + "index.php?c=usercenter&a=verify";
		return a({
			withCredentials: !0,
			method: "GET",
			url: b,
			headers: {
				"Content-Type": "text/plain; charset=UTF-8"
			}
		})
	}, c.relMobile = function(b, c, d) {
		var e = PREFIX_URL + "m/u/phone/verify?phone=" + b + "&pass=" + c + "&code=" + d;
		return e += "&time=" + (new Date).getTime(), a({
			withCredentials: !0,
			method: "POST",
			url: e,
			headers: {
				"Content-Type": "text/plain; charset=UTF-8"
			}
		})
	}, c.relMobileCode = function(b, c) {
		var d = PREFIX_URL + "m/u/bind/user/phone";
		return c && (d += (/\?/.test(d) ? "&" : "?") + "type=" + c), d += (/\?/.test(d) ? "&" : "?") + "time=" + (new Date).getTime(), a({
			withCredentials: !0,
			method: "POST",
			url: d,
			data: $.param(b),
			headers: {
				"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
			}
		})
	}, c.companyMobile = function(b) {
		var c = PREFIX_URL + "m/u/company/smscode/send";
		return c += "?time=" + (new Date).getTime(), a({
			withCredentials: !0,
			method: "POST",
			url: c,
			data: $.param(b),
			headers: {
				"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
			}
		})
	}, c.setRead = function(b) {
		var c = PREFIX_URL + "index.php?c=user&a=markRead&ids=";
		return b && (c += b), c += (/\?/.test(c) ? "&" : "?") + "time=" + (new Date).getTime(), a({
			withCredentials: !0,
			method: "GET",
			url: c,
			headers: {
				"Content-Type": "text/plain; charset=UTF-8"
			}
		})
	}, c.getNewMessage = function(b, c, d, e) {
		var f = PREFIX_URL + "index.php?c=statics&a=msgList&pageNo=" + b + "&pageSize=" + c;
		return d && (f += "&unread=" + d), e && (f += "&system=" + e), f += "&time=" + (new Date).getTime(), a({
			withCredentials: !0,
			method: "GET",
			url: f
		})
	}, c.getBranches = function(b, c) {
		var d = PREFIX_URL + "index.php?c=ad&a=subList";
		return b && (d += (/\?/.test(d) ? "&" : "?") + "pageSize=" + b), c && (d += (/\?/.test(d) ? "&" : "?") + "pageNo=" + c), d += (/\?/.test(d) ? "&" : "?") + "time=" + (new Date).getTime(), a({
			withCredentials: !0,
			method: "GET",
			url: d
		})
	}, c.getDepts = function() {
		var b = PREFIX_URL + "m/u/tag/list";
		return b += "?time=" + (new Date).getTime(), a({
			withCredentials: !0,
			method: "GET",
			url: b
		})
	}, c.addDept = function(b) {
		var c = PREFIX_URL + "m/u/tag/create";
		return a({
			withCredentials: !0,
			method: "POST",
			url: c,
			headers: {
				"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
			},
			data: $.param(b)
		})
	}, c.updateBranch = function(b) {
		var c = PREFIX_URL + "m/u/sub/save";
		return a({
			withCredentials: !0,
			method: "POST",
			url: c,
			headers: {
				"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
			},
			data: $.param(b)
		})
	}, c.createBranch = function(b) {
		var c = PREFIX_URL + "m/u/sub/create";
		return a({
			withCredentials: !0,
			method: "POST",
			url: c,
			headers: {
				"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
			},
			data: $.param(b)
		})
	}, c.openBranch = function(b, c) {
		var d = PREFIX_URL;
		return d += c ? "m/u/sub/turnOn?id=" + b : "m/u/sub/turnOff?id=" + b, a({
			withCredentials: !0,
			method: "POST",
			url: d,
			headers: {
				"Content-Type": "text/plain; charset=UTF-8"
			}
		})
	}, c.getDomain = function() {
		var b = PREFIX_URL + "m/u/domain";
		return b += "?time=" + (new Date).getTime(), a({
			withCredentials: !0,
			method: "GET",
			url: b
		})
	}, c.bindDomain = function(b) {
		var c = PREFIX_URL + "m/u/domain/bind";
		return a({
			withCredentials: !0,
			method: "POST",
			url: c,
			headers: {
				"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
			},
			data: $.param(b)
		})
	}, c.repairBindDomain = function(b) {
		var c = PREFIX_URL + "m/u/domain/update";
		c += "?url=" + b;
		var d = new Date;
		return c += "&time=" + d.getTime(), a({
			withCredentials: !0,
			method: "GET",
			url: c
		})
	}, c.resetBranchPass = function(c) {
		var d = PREFIX_URL + "m/u/sub/pwd/reset",
			e = {
				id: c
			};
		a({
			withCredentials: !0,
			method: "POST",
			url: d,
			headers: {
				"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
			},
			data: $.param(e)
		}).then(function(a) {
			a.data.success && b.$broadcast("reset.branch.success")
		}, function() {})
	}, c.saveApplyInfo = function(b) {
		var c = PREFIX_URL + "m/u/showker/apply";
		return a({
			withCredentials: !0,
			method: "POST",
			url: c,
			headers: {
				"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
			},
			data: $.param(b)
		})
	}, c.resetApplyInfo = function(b) {
		var c = PREFIX_URL + "m/u/showker/apply";
		return a({
			withCredentials: !0,
			method: "POST",
			url: c,
			headers: {
				"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
			},
			data: $.param(b)
		})
	}, c.getVisitorMsg = function() {
		var b = PREFIX_URL + "m/u/showker/detail",
			c = new Date;
		return b += "?time=" + c.getTime(), a({
			withCredentials: !0,
			method: "GET",
			url: b
		})
	}, c.getAPPlyMessage = function(b) {
		var c = PREFIX_S2_URL + "showker/tag?type=" + b;
		return a({
			method: "GET",
			url: c
		})
	}, c.getUserScene = function() {
		var b = PREFIX_URL + "m/u/scene/list",
			c = new Date;
		return b += "?time=" + c.getTime(), a({
			withCredentials: !0,
			method: "GET",
			url: b
		})
	}, c.getUserStatus = function() {
		var b = PREFIX_URL + "m/u/showker/status";
		return a({
			withCredentials: !0,
			method: "GET",
			url: b
		})
	}, c.getCompanyQrCode = function(b, c, d) {
		var e = PREFIX_URL + "m/u/pay/member/url?goodsId=" + b + "&type=" + c;
		return d && (e += "&amount=" + d), a({
			withCredentials: !0,
			method: "GET",
			url: e
		})
	}, c.getUserMemberDetail = function(b) {
		var c = PREFIX_URL + "m/u/member/detail?userId=" + b;
		return a({
			withCredentials: !0,
			method: "GET",
			url: c
		})
	}, c.getPayXdQrCode = function(b, c) {
		var d = PREFIX_URL + "m/u/pay/xd/url?goodsId=" + b + "&type=" + c;
		return a({
			withCredentials: !0,
			method: "GET",
			url: d
		})
	}, c.sendEmail = function(b) {
		var c = PREFIX_URL + "m/u/invite/user/email";
		return a({
			withCredentials: !0,
			method: "POST",
			url: c,
			headers: {
				"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
			},
			data: $.param(b)
		})
	}, c.getInvoiceList = function(c, d) {
		var e = PREFIX_URL + "m/order/can/invoice/list";
		d && (e += (/\?/.test(e) ? "&" : "?") + "pageSize=" + d), c && (e += (/\?/.test(e) ? "&" : "?") + "pageNo=" + c), a({
			withCredentials: !0,
			method: "GET",
			url: e
		}).then(function(a) {
			a.data.success && b.$broadcast("get.invoice.list", a.data)
		})
	}, c.relForum = function(b, c, d) {
		var e = PREFIX_URL + "m/u/bind/user/bbs",
			f = {
				userName: b,
				passWord: c,
				eqXiuPassWord: d
			};
		return a({
			withCredentials: !0,
			method: "POST",
			url: e,
			data: $.param(f),
			headers: {
				"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
			}
		})
	}, c.buyBranch = function() {
		var b = PREFIX_URL + "m/u/buy/sub/user";
		return a({
			withCredentials: !0,
			method: "POST",
			url: b,
			headers: {
				"Content-Type": "application/x-www-form-urlencoded; charset=UTF-8"
			}
		})
	}, c
}]), angular.module("templates-app", ["dialog/bindemail.tpl.html", "dialog/confirm.tpl.html", "dialog/message.tpl.html", "footer.tpl.html", "header.tpl.html", "main/console/group.tpl.html", "main/downApp.tpl.html", "main/mobileTansform.tpl.html", "notifications.tpl.html", "spread/console/apply.tpl.html", "spread/console/domainBind-guide.tpl.html", "spread/console/guarantee-apply.tpl.html", "spread/console/guarantee-buy.tpl.html", "spread/spread.tpl.html", "spread/tab/data-collect.tpl.html", "spread/tab/share.tpl.html", "spread/tab/statistics.tpl.html", "spread/tab/statistics/access-info.tpl.html", "spread/tab/statistics/components/data-story-device.tpl.html", "spread/tab/statistics/components/data-story-os.tpl.html", "spread/tab/statistics/components/data-story-user-portrait.tpl.html", "spread/tab/statistics/components/date-range.tpl.html", "spread/tab/statistics/components/mta-browser.tpl.html", "spread/tab/statistics/components/mta-client.tpl.html", "spread/tab/statistics/components/mta-operator.tpl.html", "spread/tab/statistics/components/mta-page-speed.tpl.html", "spread/tab/statistics/components/mta-realtime-user.tpl.html", "spread/tab/statistics/components/mta-user-compare.tpl.html", "spread/tab/statistics/components/mta-user-portrait.tpl.html", "spread/tab/statistics/components/scene-pv.tpl.html", "spread/tab/statistics/components/share-channel.tpl.html", "spread/tab/statistics/components/summery-device.tpl.html", "spread/tab/statistics/components/summery-interactive.tpl.html", "spread/tab/statistics/components/third-party-analysis-config.tpl.html", "spread/tab/statistics/expand-web-statistics.tpl.html", "spread/tab/statistics/interactive-statistics.tpl.html", "spread/tab/statistics/page-statistics.tpl.html", "spread/tab/statistics/share-statistics.tpl.html", "spread/tab/statistics/summery.tpl.html", "spread/tab/statistics/text-message-statistics.tpl.html", "spread/tab/statistics/user-statistics.tpl.html", "spread/tab/subtab/buy-message.tpl.html", "spread/tab/subtab/check-scene.tpl.html", "spread/tab/subtab/domain-bind.tpl.html", "spread/tab/subtab/expand-web.tpl.html", "spread/tab/subtab/message-customer.tpl.html", "spread/tab/subtab/message-detail.tpl.html", "spread/tab/subtab/message-post.tpl.html", "spread/tab/subtab/other-service-apply.tpl.html", "spread/tab/subtab/site-import.tpl.html", "spread/tab/subtab/social-share.tpl.html", "spread/tab/subtab/thirdweb.tpl.html", "sysmessage.tpl.html", "test/test-scene.tpl.html", "test/test.tpl.html", "usercenter/buyXd.tpl.html", "usercenter/console/checkMobile.tpl.html", "usercenter/payment.tpl.html", "usercenter/paymentxd.tpl.html", "usercenter/request_reg.tpl.html", "usercenter/tab/privilege.tpl.html"]), angular.module("dialog/bindemail.tpl.html", []).run(["$templateCache", function(a) {
	a.put("dialog/bindemail.tpl.html", "<div class=email-account><h1>您的账号还没有绑定邮箱</h1><p><span>去用户中心>账号管理，</span> <a ng-href=/#/usercenter/account?bindemail><span>马上绑定</span></a></p></div>")
}]), angular.module("dialog/confirm.tpl.html", []).run(["$templateCache", function(a) {
	a.put("dialog/confirm.tpl.html", "<div class=modal-body ng-if=confirmObj.msg><div class=confirm-msg ng-bind-html=confirmObj.msg></div></div><div class=\"btn-contain btn-small\"><a ng-click=ok(); class=btn-main>{{confirmObj.confirmName || ('确定')}}</a> <a ng-click=cancel(); class=btn-grey0>{{confirmObj.cancelName || ('取消')}}</a></div>")
}]), angular.module("dialog/message.tpl.html", []).run(["$templateCache", function(a) {
	a.put("dialog/message.tpl.html", '<div class=modal-header><span class="glyphicon glyphicon-exclamation-sign"></span> <span>{{msgObj.title || (\'提示\')}}</span></div><div class=modal-body ng-if=msgObj.msg><div class="msg text-center" ng-class="msgObj.title ? \'\' : \'msg-padding\'" ng-bind-html=msgObj.msg></div></div><div class=modal-footer><a ng-click=close(); class="btn btn-primary" style="width: 88px">{{msgObj.btn || (\'关闭\')}}</a></div>')
}]), angular.module("footer.tpl.html", []).run(["$templateCache", function(a) {
		a.put("footer.tpl.html", '<div class=scroll data-ng-init=load2()><a class=scroll_top ng-click=goTop()><span class=eqf-clickmore2></span> <span>顶部</span></a></div><div class=app-download><div style=position:relative;height:40px;width:40px><a class="scroll_top bgScroll" ng-click=downApp() ng-show=appIconDown><span class=eqf-phone></span> <span>APP</span></a></div><div ng-hide=appIconDown class=qrcode-download><div class="closedown eqf-wrong" ng-click=closeDown() title=关闭></div><div qr-code qr-url="{{PREFIX_CLIENT_HOST + \'/appdown.html\'}}"></div></div></div><div class=video-user><a target=_blank href=http://class.qq.com/class/13657/p62157.html><span class=eqf-top-video></span> <span>教程</span></a> <a target=_blank href="http://bbs.eqxiu.com/forum.php?mod=viewthread&tid=13225"><span class=eqf-top-contact></span> <span>客服</span></a></div><footer><div class=help-contain><div class="same-content clearfix"><div class="home-help fl"><h6><em>易企秀</em></h6><ul><li><a href=/about target=_blank>关于我们</a></li><li><a href=http://www.lagou.com/gongsi/93527.html target=_blank>人才招聘</a></li><li><a href=/agreement target=_blank>服务协议</a></li><li><a href=http://hypefolio.com target=_blank>Hypefolio</a></li></ul></div><div class="home-help fl"><h6><em>设计制作帮助</em></h6><ul><li><a href="http://bbs.eqxiu.com/plugin.php?id=eqxiu_help:eqxiu_help" target=_blank>制作场景教程</a></li><li><a href=http://eqxiu.com/show target=_blank>找场景案例</a></li><li><a href="http://bbs.eqxiu.com/forum.php?mod=viewthread&tid=13104" target=_blank>轻设计制作教程</a></li><li><a href="http://bbs.eqxiu.com/plugin.php?id=ljqqqun:qq&type=4" target=_blank>QQ群交流</a></li></ul></div><div class="home-help fl"><h6><em>审核问题</em></h6><ul><li><a href="http://bbs.eqxiu.com/forum.php?mod=viewthread&tid=890" target=_blank>场景审核及被关闭</a></li><li><a href="http://bbs.eqxiu.com/forum.php?mod=viewthread&tid=8293" target=_blank>样例审核</a></li><li><a href="http://bbs.eqxiu.com/forum.php?mod=viewthread&tid=13174" target=_blank>秀客及审核被驳回</a></li></ul></div><div class="home-help fl"><h6><em>企业服务</em></h6><ul><li><a href=http://eqxiu.com/privilege target=_blank>免费升级企业账号</a></li><li><a href="http://bbs.eqxiu.com/forum.php?mod=viewthread&tid=11204" target=_blank>升级服务商账号：秀客特权-新</a></li><li><a href="http://bbs.eqxiu.com/forum.php?mod=viewthread&tid=297" target=_blank>去场景上易企秀标识</a></li><li><a href=http://eqxiu.com/show/visitor target=_blank>场景定制</a></li></ul></div><div class="home-help fl" style=width:140px><h6><em>联系我们</em></h6><ul><li><a href="http://bbs.eqxiu.com/forum.php?mod=viewthread&tid=17931" target=_blank>易企秀产品开放合作</a></li><li><a href="http://bbs.eqxiu.com/forum.php?mod=viewthread&tid=17913" target=_blank>区域服务商招募</a></li><li><a href="http://bbs.eqxiu.com/forum.php?mod=viewthread&tid=15985" target=_blank>场景设计与广告推广</a></li><li><a href="http://bbs.eqxiu.com/forum.php?mod=forumdisplay&fid=258&filter=typeid&typeid=632" target=_blank>公共帐号申请及其他</a></li></ul></div></div></div><div class="contact-friend same-content" ng-if="friendLinks.length > 0"><ul class=clearfix><li ng-repeat="link in friendLinks"><a target=_blank ng-href={{link.url}}>{{link.name}}</a></li></ul></div><div class="same-content clearfix pt20 pb20"><div class=fr style=width:270px><div class=fr style=background-color:#fff><img ng-src={{CLIENT_CDN}}assets/images/home/QRcode.svg width=80px height="80px;"></div><p>微信：扫描二维码下载本源码</p><p>邮箱：vip@eqxiu.com</p><p>电话：010-58813666</p><p>工作日：8:45-12:00 13:00-17:30</p></div><div class=fl><p>?? 2015 eqxiu.com. All rights reserved 北京中网易企秀科技有限公司</p><p>电信与信息服务业务经营许可证：京ICP证160037号 | 京ICP备15056244号-5 | 京公网安备11010802018300</p><div class=renzheng style=padding-top:10px><a href="https://ss.knet.cn/verifyseal.dll?sn=e14082111011652865izip000000&amp;ct=df&amp;a=1&amp;pa=0.5974755212664604" target=_blank><img ng-src={{CLIENT_CDN}}assets/images/kexin.svg width=80px height=30px></a> <a href=http://bbs.eqxiu.com/portal.php class="btn btn-main" target=_blank>官方论坛</a> <a><em class="eqf-wechat btn btn-primary"></em><div class=weixin style=background-color:#fff><img ng-src={{CLIENT_CDN}}assets/images/home/QRcode.svg width=120px height=120px></div></a> <a href=http://weibo.com/eqxiu target=_blank><em class="eqf-weibo btn out-red"></em></a> <a href="http://bbs.eqxiu.com/plugin.php?id=ljqqqun:qq&amp;type=4" target=_blank style=padding:0 class="qq-group btn-main background-color-width-change clearfix"><em class="eqf-qq btn"></em> <span>QQ群交流</span></a></div></div></div></footer>')
	
		var footer_str='<div class=scroll data-ng-init=load2()><a class=scroll_top ng-click=goTop()><span class=eqf-clickmore2></span> <span>顶部</span></a></div><div class=app-download><div style=position:relative;height:40px;width:40px><a class="scroll_top bgScroll" ng-click=downApp() ng-show=appIconDown><span class=eqf-phone></span> <span>APP</span></a></div><div ng-hide=appIconDown class=qrcode-download><div class="closedown eqf-wrong" ng-click=closeDown() title=关闭></div><div qr-code qr-url="{{PREFIX_CLIENT_HOST + \'/appdown.html\'}}"></div></div></div><div class=video-user><a target=_blank href=http://class.qq.com/class/13657/p62157.html><span class=eqf-top-video></span> <span>教程</span></a> <a target=_blank href="http://bbs.eqxiu.com/forum.php?mod=viewthread&tid=13225"><span class=eqf-top-contact></span> <span>客服</span></a></div><footer><div class=help-contain><div class="same-content clearfix"><div class="home-help fl"><h6><em>易企秀</em></h6><ul><li><a href=/about target=_blank>关于我们</a></li><li><a href=http://www.lagou.com/gongsi/93527.html target=_blank>人才招聘</a></li><li><a href=/agreement target=_blank>服务协议</a></li><li><a href=http://hypefolio.com target=_blank>Hypefolio</a></li></ul></div><div class="home-help fl"><h6><em>设计制作帮助</em></h6><ul><li><a href="http://bbs.eqxiu.com/plugin.php?id=eqxiu_help:eqxiu_help" target=_blank>制作场景教程</a></li><li><a href=http://eqxiu.com/show target=_blank>找场景案例</a></li><li><a href="http://bbs.eqxiu.com/forum.php?mod=viewthread&tid=13104" target=_blank>轻设计制作教程</a></li><li><a href="http://bbs.eqxiu.com/plugin.php?id=ljqqqun:qq&type=4" target=_blank>QQ群交流</a></li></ul></div><div class="home-help fl"><h6><em>审核问题</em></h6><ul><li><a href="http://bbs.eqxiu.com/forum.php?mod=viewthread&tid=890" target=_blank>场景审核及被关闭</a></li><li><a href="http://bbs.eqxiu.com/forum.php?mod=viewthread&tid=8293" target=_blank>样例审核</a></li><li><a href="http://bbs.eqxiu.com/forum.php?mod=viewthread&tid=13174" target=_blank>秀客及审核被驳回</a></li></ul></div><div class="home-help fl"><h6><em>企业服务</em></h6><ul><li><a href=http://eqxiu.com/privilege target=_blank>免费升级企业账号</a></li><li><a href="http://bbs.eqxiu.com/forum.php?mod=viewthread&tid=11204" target=_blank>升级服务商账号：秀客特权-新</a></li><li><a href="http://bbs.eqxiu.com/forum.php?mod=viewthread&tid=297" target=_blank>去场景上易企秀标识</a></li><li><a href=http://eqxiu.com/show/visitor target=_blank>场景定制</a></li></ul></div><div class="home-help fl" style=width:140px><h6><em>联系我们</em></h6><ul><li><a href="http://bbs.eqxiu.com/forum.php?mod=viewthread&tid=17931" target=_blank>易企秀产品开放合作</a></li><li><a href="http://bbs.eqxiu.com/forum.php?mod=viewthread&tid=17913" target=_blank>区域服务商招募</a></li><li><a href="http://bbs.eqxiu.com/forum.php?mod=viewthread&tid=15985" target=_blank>场景设计与广告推广</a></li><li><a href="http://bbs.eqxiu.com/forum.php?mod=forumdisplay&fid=258&filter=typeid&typeid=632" target=_blank>公共帐号申请及其他</a></li></ul></div></div></div><div class="contact-friend same-content" ng-if="friendLinks.length > 0"><ul class=clearfix><li ng-repeat="link in friendLinks"><a target=_blank ng-href={{link.url}}>{{link.name}}</a></li></ul></div><div class="same-content clearfix pt20 pb20"><div class=fr style=width:270px><div class=fr style=background-color:#fff><img ng-src={{CLIENT_CDN}}assets/images/home/QRcode.svg width=80px height="80px;"></div><p>微信：扫描二维码下载本源码</p><p>邮箱：vip@eqxiu.com</p><p>电话：010-58813666</p><p>工作日：8:45-12:00 13:00-17:30</p></div><div class=fl><p>?? 2015 eqxiu.com. All rights reserved 北京中网易企秀科技有限公司</p><p>电信与信息服务业务经营许可证：京ICP证160037号 | 京ICP备15056244号-5 | 京公网安备11010802018300</p><div class=renzheng style=padding-top:10px><a href="https://ss.knet.cn/verifyseal.dll?sn=e14082111011652865izip000000&amp;ct=df&amp;a=1&amp;pa=0.5974755212664604" target=_blank><img ng-src={{CLIENT_CDN}}assets/images/kexin.svg width=80px height=30px></a> <a href=http://bbs.eqxiu.com/portal.php class="btn btn-main" target=_blank>官方论坛</a> <a><em class="eqf-wechat btn btn-primary"></em><div class=weixin style=background-color:#fff><img ng-src={{CLIENT_CDN}}assets/images/home/QRcode.svg width=120px height=120px></div></a> <a href=http://weibo.com/eqxiu target=_blank><em class="eqf-weibo btn out-red"></em></a> <a href="http://bbs.eqxiu.com/plugin.php?id=ljqqqun:qq&amp;type=4" target=_blank style=padding:0 class="qq-group btn-main background-color-width-change clearfix"><em class="eqf-qq btn"></em> <span>QQ群交流</span></a></div></div></div></footer>';
	
	if(web_muban_status==3){footer_str="<footer>\n" +
		                "<footer>\n" +
		                "	<div class=\"content_center\">\n<center>" +
		                "	<article class=\"footer\">\n" +
		                "	<p class=\"beizhu\"> 2016  "+your_demain_beian+"  All rights reserved   {{web_ipc}}</p>\n" +
		                "	<p>\n" +
		                "	<a href=\"{{web_site}}\" target=\"_blank\" rel=\"nofollow\" style=\"margin: 0 auto;\">\n" +
		                "	<img ng-src=\"{{CLIENT_CDN}}assets/images/sn.png\">\n" +
		                "	</a>\n" +
		                "	</p>\n" +
		                "	</article>\n" +
		                "	</center></div>\n" +
		                "	</footer>";}
		a.put("footer.tpl.html",footer_str);

	
	}]), angular.module("header.tpl.html", []).run(["$templateCache", function(a) {
	a.put("header.tpl.html", '<div class=header-wap><div class=header-contain><div class="same-content clearfix"><div class=head_nav ng-if=showToolBar();><ul class="clearfix head_navs"><li class=background-color-width-change ng-class="{isActive: isActive == \'main\'}"><a href=/#/main>H5场景</a></li><li ng-if="(user.type == 21 && userPermit.indexOf(\',1101,\') >= 0) || user.type !=21" ng-class="{isActive: isActive == \'customer\'}" class=background-color-width-change><a href=/#/main/customer>客户</a></li><li ng-class="{isActive: isActive == \'show\'}" class=background-color-width-change><a href=/#/show target=_blank>秀场</a></li></ul><login-toolbar></login-toolbar></div><a href=/#/main class="hint--bottom hint--rounded" id=logo><img ng-src="{{logoSrc}}"></a></div></div></div>')
}]), angular.module("main/console/group.tpl.html", []).run(["$templateCache", function(a) {
	a.put("main/console/group.tpl.html", '<div class=modal-header><span ng-show=!title>新建组</span> <span ng-show=title>{{title}}</span></div><div class="modal-body add-new-cat" forbidden-list-close><input type=text class=form-control ng-model=group.name placeholder="设置名称"></div><p ng-show=authError style=text-align:center>{{authError}}</p><div class="btn-contain btn-small"><a class="btn-main login" ng-click=confirm()>确认</a> <a class="btn-grey0 cancel" ng-click=cancel()>取消</a></div>')
}]), angular.module("main/downApp.tpl.html", []).run(["$templateCache", function(a) {
	a.put("main/downApp.tpl.html", '<div class=login-form-section><div class=login-content><div class=section-title style=margin-bottom:20px><a class="bbs-help-tip eqf-wrong fr" ng-click=$dismiss()></a><h3>易企秀APP</h3></div><div class=down-code><p qr-code qr-url="http://a.app.qq.com/o/simple.jsp?pkgname=cn.knet.eqxiu"></p><p style=padding-bottom:40px;padding-top:10px>一键生成H5，随时随地查数据</p></div></div></div>')
}]), angular.module("main/mobileTansform.tpl.html", []).run(["$templateCache", function(a) {
	a.put("main/mobileTansform.tpl.html", '<div class=mobile><div class=header><a class="eqf-wrong fr" style=margin-top:25px ng-click=$dismiss()></a>提示</div><div class="content clearfix"><img class="mobile-img fl" ng-src="{{CLIENT_CDN}}assets/images/phone.jpg"><div class="mobile-text pt20"><h2 class=mt20>一旦编辑它就变成电脑场景了</h2><p class=mt20>手机场景一旦编辑，就会变为电脑场景。<br>显示在APP中的电脑列表下（如左图）。<br>此后，就永远是电脑场景了，没有办法再变回来。<br>电脑场景的状态和编辑相对于手机更灵活，也会复杂，请谨慎操作。</p></div></div><div class="footer clearfix"><a class=submit ng-click=$close()>继续</a> <a class="cancel btn-primary" ng-click=$dismiss()>取消</a></div></div>')
}]), angular.module("notifications.tpl.html", []).run(["$templateCache", function(a) {
	a.put("notifications.tpl.html", "<div ng-class=\"['alert', 'alert-'+notification.type]\" ng-repeat=\"notification in notifications.getCurrent()\" notification-fadeout><button class=close ng-click=removeNotification(notification)>×</button> {{notification.message}}</div>")
}]), angular.module("spread/console/apply.tpl.html", []).run(["$templateCache", function(a) {
	a.put("spread/console/apply.tpl.html", '<div class=modal-header><button type=button class=close data-dismiss=modal aria-label=Close ng-click=cancel()><span aria-hidden=true>×</span></button><h4 class=modal-title>{{title}} <span class=action ng-show=!authError>{{description}}</span> <span ng-show=authError>{{authError}}</span></h4></div><div class=dialog-contain><div class="dialog-content ml20" style=margin-top:0><form name=resetForm novalidate class=form-horizontal><div class=form-group style=margin-bottom:0 ng-class="{mt20: applyObj.type == 2 || applyObj.type == 1 || applyObj.type == 4}"><div class="col-sm-offset-3 col-sm-6"><eqx-select class="select-contain select-great border-width" model=apply.showObj change="" ng-show="applyObj.type == 2"><eqx-select-option value=null>申请类别</eqx-select-option><eqx-select-option value=sceneTag ng-repeat="sceneTag in sceneTags">{{sceneTag.name}}</eqx-select-option></eqx-select><eqx-select class="select-contain select-great border-width" model=apply.tplObj change="" ng-show="applyObj.type == 1 && user.type == 4"><eqx-select-option value=tplPrice ng-repeat="tplPrice in tplPrices">{{tplPrice.name}}</eqx-select-option></eqx-select><div class="mt20 mb20" ng-show="applyObj.type == 1 && user.type != 4">确定申请为样例？</div><div class="mt20 mb20" ng-show="applyObj.type == 4">确定申请为企业样例？</div></div></div></form><ul class="mt20 clearfix apply-active"><li class="mr20 mb20" style="display: inline-block;width: 95px;height: 120px;border: 1px solid #ccc" ng-repeat="activityPageTpl in activityPageTpls" ng-click=selectActivePage(activityPageTpl)><div class=checkbox-square ng-class="{checked: activityPageTpl.checked}"><em class=eqf-clickmore></em> <input type=checkbox ng-model=activityPageTpl.checked name=iCheck ng-disabled="scene.isShow==1 || scene.isShow==2"></div><img ng-src="{{PREFIX_FILE_HOST + activityPageTpl.properties.thumbSrc}}"></li></ul></div></div><div class=modal-footer><a class=modal-cancle ng-click=cancel() ng-disabled=form.$invalid>取消</a> <a class="btn btn-primary" ng-click=apply() ng-disabled=form.$invalid>确定</a></div>')
}]), angular.module("spread/console/domainBind-guide.tpl.html", []).run(["$templateCache", function(a) {
	a.put("spread/console/domainBind-guide.tpl.html", '<div class=domain-bind-guide><div class=domain-header><button type=button class=close data-dismiss=modal aria-label=Close ng-click=cancel()><span aria-hidden=true>×</span></button></div><h3 ng-if="user.type == 21" class=guide-message>此功能需企业主帐号开通才能使用</h3><h3 ng-if="user.type != 21" class=guide-message>此功能需要您升级账号才能使用</h3><a class="btn btn-guide" ng-href={{CLIENT_CDN}}privilege target=_blank>升级账号</a></div>')
}]), angular.module("spread/console/guarantee-apply.tpl.html", []).run(["$templateCache", function(a) {
	a.put("spread/console/guarantee-apply.tpl.html", '<div class=modal-header><button type=button class=close data-dismiss=modal aria-label=Close ng-click=cancel()><span aria-hidden=true>×</span></button><h4 class=modal-title>场景保障服务</h4></div><div class="dialog-content ml20 guarantee-content"><div class=detail><p>场景保障服务剩余时长:&nbsp&nbsp<em>{{modal.daysExt+modal.days}}次</em>,&nbsp&nbsp正在为<em>{{modal.amount}}个</em>场景提供保障服务</p></div><div class=guarantee-more><p ng-if="modal.status == 2">是否需要为场景<em>《{{scene.name}}》</em>提供保障服务?</p><p ng-if="modal.status == 1">已经开启场景<em>《{{scene.name}}》</em>的保障服务</p><div class=open-close ng-class="{\'text-center\': userType == 21}"><a class="btn btn-primary btn-close-btn" ng-class="{\'close-open-btn\': userType != 21}" data-hint=点击关闭保障 ng-show="modal.status == 1" ng-click=openGuarantee(modal.status,false)>关闭保障服务</a> <a class="btn btn-primary" ng-class="{\'close-open-btn\': userType != 21}" data-hint=点击开启保障服务 ng-show="modal.status == 2" ng-click="openGuarantee(modal.status ,true)">开启保障服务</a> <a ng-if="userType != 21" type=button class="btn btn-primary buy-btn" ng-click=buyGuarantee()>我要充值</a></div></div><div style class=text-description-box><div eqd-scroll style="" class=text-description-scroll><div class=text-description><h4>场景保障服务FAQ</h4><p>1.&nbsp什么是场景保障服务？</p><div>场景保障服务是易企秀自主研发，专为用户打造的专属CDN加速服务。启用服务后，系统会主动将场景投放至全国各地的网络服务器中，用户浏览场景时系统将就近选择服务器并下载内容，由于访问距离缩短，将缩短场景打开时间，同时极大的降低了由于网络环境故障而造成场景无法访问等情况的出现概率。</div><p>2.&nbsp启用场景保障服务的好处</p><div>缩短场景打开时间，提高场景访问稳定性</div><p>3.&nbsp开启服务后需要等待多长时间服务生效</p><div>用户申请服务后，系统即刻开始投放，该过程大约需要几个小时，建议12小时后开始进行场景的推广</div><p>4.&nbsp启用服务后有哪些限制</p><div>启用服务后，场景链接将会被更新，原链接仍可访问但不具备保障服务；同时场景会优先被系统审核；每次修改场景内容和设置场景信息，系统都需要重新审核并投放，该过程大约需要几个小时，因此不建议用户频繁修改；主动申请关闭服务后，系统需要几个小时撤回投放</div><p>5.&nbsp如何计费</p><div>场景保障服务采用单个场景按次计费模式，1次=1个场景/天。用户可为多个场景同时申请保障服务。申请成功即扣除1次使用时长，每天0点扣除第二天时长。余额不足时，系统将主动关闭服务</div></div></div></div></div>')
}]), angular.module("spread/console/guarantee-buy.tpl.html", []).run(["$templateCache", function(a) {
	a.put("spread/console/guarantee-buy.tpl.html", '<div class=modal-header><button type=button class=close data-dismiss=modal aria-label=Close ng-click=cancel()><span aria-hidden=true>×</span></button><h4 class=modal-title>购买保障服务</h4></div><div class="dialog-contain guarantee-buy"><p class=guarantee-layout>请选择购买类型</p><p class=guarantee-buy-total>秀点余额<em>{{userXd}}点</em></p><div class=dialog-content><form name=resetForm novalidate class=form-horizontal><div class=form-group style=margin-bottom:0><div class="col-sm-6 ml20" style="position: relative;top:10px"><eqx-select class="select-contain select-great border-width" model=model.buylay><eqx-select-option value=null>购买类型</eqx-select-option><eqx-select-option value=guaranteeBuyLay ng-repeat="guaranteeBuyLay in guaranteeBuyLays">{{guaranteeBuyLay.name}}</eqx-select-option></eqx-select></div></div></form></div><a type=button class="btn btn-primary guarantee-buyXd" ng-click=buyXdQ()>充值</a></div><div class=modal-footer><a class=modal-cancle ng-click=cancel()>取消</a> <a class="btn btn-primary" ng-click=guaranteeBuyConfirm()>确定</a></div>')
}]), angular.module("spread/spread.tpl.html", []).run(["$templateCache", function(a) {
	//a.put("spread/spread.tpl.html", '<div ng-include="\'header.tpl.html\'"></div><div id=main class=min_contain><div ng-include="\'sysmessage.tpl.html\'"></div><div class=info-show><div class=same-content><div class="spread-area clearfix"><div class="scene-oper opera-userinfo"><a class="btn btn-border opa-btn background-color-width-change" target=_blank ng-click=viewScene($event)><span class=eqf-eye style=font-size:12px></span> &nbsp;预览场景</a> <a ng-if=!branchid class="btn btn-border opa-btn edit-scene background-color-width-change" ng-click=editScene(scene)><span class=eqf-write></span> &nbsp;编辑场景</a> <a ng-if=!branchid class="btn btn-border opa-btn edit-scene background-color-width-change" ng-click=sceneSettings($event,scene)><span class=eqf-scene-setting></span> &nbsp;设置场景</a></div><div class="scene-cover fl"><img ng-src="{{PREFIX_FILE_HOST + scene.cover}}"></div><div class=scene-detail><div class=scene-name>{{scene.name}}</div><div class="fade-color scene-tip"><span>{{scene.description || \'未添加描述\'}}</span></div><div class="fade-color scene-tip"><span class=first-col style="width: 180px">创建时间： {{scene.createTime | date:\'yyyy年MM月dd日\'}}</span> <span>最后更新： {{scene.updateTime | date:\'yyyy年MM月dd日\'}}</span></div><div class="fade-color scene-tip" ng-show=branchid><span class=first-col>场景状态：{{sceneStadus}}</span></div><div class="fade-color scene-tip" ng-show=!branchid><div class=first-col><span ng-class="{fl: (scene.status == 1 || scene.status == 2) && scene.publishTime}" style=padding-top:3px>场景状态：</span><div class="switch switch-open hint--bottom hint--rounded" data-hint=点击关闭场景 ng-show="scene.bizType !=30 && scene.status == 1 && scene.publishTime " ng-click=openScene(scene.status,false)><div class=circle-con><i class=circle></i></div></div><div class="switch switch-close hint--bottom hint--rounded" data-hint=点击开放场景 ng-show="scene.bizType !=30 && scene.status == 2 && scene.publishTime" ng-click="openScene(scene.status ,true)"><div class=circle-con><i class=circle></i></div></div><span ng-show="scene.bizType !=30 && !scene.publishTime && (scene.status == 2 || scene.status == 1)">未发布</span> <span ng-show="scene.status==-1">审核被拒绝</span> <span ng-show="scene.status==-2">审核中</span></div></div></div></div><div class=spread-tab><ul class="clearfix tab-line"><li ng-if="(user.type ==21 && userPermit.indexOf(\',1301,\') >= 0) || user.type !=21"><a ng-class="{active: viewControl.tab == \'share\'}" ng-click="showShare(\'share\');">分享推广</a></li><li ng-if="(user.type ==21 && userPermit.indexOf(\',1302,\') >= 0) || user.type !=21"><a ng-class="{active: viewControl.tab == \'statistics\'}" ng-click="showStatistics(\'statistics\');" data-event=8212>效果统计</a></li><li ng-if="(user.type == 21 && userPermit.indexOf(\',1303,\') >= 0) || user.type !=21"><a ng-class="{active: viewControl.tab == \'dataCollect\'}" ng-click="dataCollect(\'dataCollect\');">数据汇总</a></li></ul></div></div></div><div class=same-content><div id=share ng-if="viewControl.tab == \'share\'" ng-controller=ShareCtrl><div ng-include="\'spread/tab/share.tpl.html\'"></div></div><div id=statistics ng-if="viewControl.tab == \'statistics\'" ng-controller=StatisticsCtrl><div ng-include="\'spread/tab/statistics.tpl.html\'"></div></div><div id=dataCollect ng-if="viewControl.tab == \'dataCollect\'" ng-controller=DataCollectCtrl><div ng-include="\'spread/tab/data-collect.tpl.html\'"></div></div></div></div><div ng-include="\'footer.tpl.html\'"></div>')
	a.put("spread/spread.tpl.html", '<div ng-include="\'header.tpl.html\'"></div><div id=main class=min_contain><div ng-include="\'sysmessage.tpl.html\'"></div><div class=info-show><div class=same-content><div class="spread-area clearfix"><div class="scene-oper opera-userinfo"><a class="btn btn-border opa-btn background-color-width-change" target=_blank ng-click=viewScene($event)><span class=eqf-eye style=font-size:12px></span> &nbsp;预览场景</a> <a ng-if=!branchid class="btn btn-border opa-btn edit-scene background-color-width-change" ng-click=editScene(scene)><span class=eqf-write></span> &nbsp;编辑场景</a> <a ng-if=!branchid class="btn btn-border opa-btn edit-scene background-color-width-change" ng-click=sceneSettings($event,scene)><span class=eqf-scene-setting></span> &nbsp;设置场景</a></div><div class="scene-cover fl"><img ng-src="{{PREFIX_FILE_HOST + scene.cover}}"></div><div class=scene-detail><div class=scene-name>{{scene.name}}</div><div class="fade-color scene-tip"><span>{{scene.description || \'未添加描述\'}}</span></div><div class="fade-color scene-tip"><span class=first-col style="width: 180px">创建时间： {{scene.createTime | date:\'yyyy年MM月dd日\'}}</span> <span>最后更新： {{scene.updateTime | date:\'yyyy年MM月dd日\'}}</span></div><div class="fade-color scene-tip" ng-show=branchid><span class=first-col>场景状态：{{sceneStadus}}</span></div><div class="fade-color scene-tip" ng-show=!branchid><div class=first-col><span ng-class="{fl: (scene.status == 1 || scene.status == 2) && scene.publishTime}" style=padding-top:3px>场景状态：</span><div class="switch switch-open hint--bottom hint--rounded" data-hint=点击关闭场景 ng-show="scene.bizType !=30 && scene.status == 1 && scene.publishTime " ng-click=openScene(scene.status,false)><div class=circle-con><i class=circle></i></div></div><div class="switch switch-close hint--bottom hint--rounded" data-hint=点击开放场景 ng-show="scene.bizType !=30 && scene.status == 2 && scene.publishTime" ng-click="openScene(scene.status ,true)"><div class=circle-con><i class=circle></i></div></div><span ng-show="scene.bizType !=30 && !scene.publishTime && (scene.status == 2 || scene.status == 1)">未发布</span> <span ng-show="scene.status==-1">审核被拒绝</span> <span ng-show="scene.status==-2">审核中</span></div></div></div></div><div class=spread-tab><ul class="clearfix tab-line"><li ng-if="(user.type ==21 && userPermit.indexOf(\',1301,\') >= 0) || user.type !=21"><a ng-class="{active: viewControl.tab == \'share\'}" ng-click="showShare(\'share\');">分享推广</a></li><li ng-if="(user.type == 21 && userPermit.indexOf(\',1303,\') >= 0) || user.type !=21"><a ng-class="{active: viewControl.tab == \'dataCollect\'}" ng-click="dataCollect(\'dataCollect\');">数据汇总</a></li></ul></div></div></div><div class=same-content><div id=share ng-if="viewControl.tab == \'share\'" ng-controller=ShareCtrl><div ng-include="\'spread/tab/share.tpl.html\'"></div></div><div id=statistics ng-if="viewControl.tab == \'statistics\'" ng-controller=StatisticsCtrl><div ng-include="\'spread/tab/statistics.tpl.html\'"></div></div><div id=dataCollect ng-if="viewControl.tab == \'dataCollect\'" ng-controller=DataCollectCtrl><div ng-include="\'spread/tab/data-collect.tpl.html\'"></div></div></div></div><div ng-include="\'footer.tpl.html\'"></div>')
}]), angular.module("spread/tab/data-collect.tpl.html", []).run(["$templateCache", function(a) {
	a.put("spread/tab/data-collect.tpl.html", '<div class="my-data clearfix" id=myData><div class=tab-nav><ul class="nav nav-pills nav-stacked"><li ng-class="{active:dataTable==\'formData\'}"><a ng-click=getFormData()>表单汇总</a></li><li ng-class="{active:dataTable==\'boardsData\'}"><a ng-click=getBoardsData()>留言汇总</a></li></ul></div><div class=tab-panel><div class=data-item ng-show=totalItems><div><span>数据项</span>：</div><ul class="origin-ul clearfix"><li ng-repeat="header in dataHeaders track by $index"><div class="square table-checkbox"><div class=checkbox-square ng-class="{checked: header.selected}"><em class=eqf-yes2></em> <input type=checkbox ng-model=header.selected ng-change="selectHeader(header,$index,header.selected)"></div></div><label>{{header.title}}</label></li></ul></div><div ng-show="dataContain && totalItems"><div class="clearfix export pb20" id=collectData><span ng-show="((user.type == 21 && userPermit.indexOf(\',1305,\') >= 0) || user.type !=21)" class=data-title ng-click=dataDelete()>删除</span><div ng-show="dataTable==\'formData\' && !showUp && ((user.type == 21 && userPermit.indexOf(\',1304,\') >= 0) || user.type !=21)" class=no-header><a class="btn btn-primary hint--left hint--rounded" ng-click=dataOutNoHeader() data-hint=有修改表单的使用此方式，导出没有名称的数据><span class="export_excel eqf-download"></span></a></div><div ng-show="showUp && ((user.type == 21 && userPermit.indexOf(\',1304,\') >= 0) || user.type !=21)" class="btn-group no-header dropdown"><a class="btn btn-primary dropdown-toggle hint--left hint--rounded" data-hint=有修改表单的使用此方式，导出没有名称的数据><span class="export_excel eqf-download"></span></a><div class="data-page dropdown-menu"><ul><li ng-repeat="dataPageNum in dataPageNums" ng-click=dataOutNoHeaderPage(dataPageNum.start,dataPageNum.end)>{{dataPageNum.start}}-{{dataPageNum.end}}<em>页</em></li></ul></div></div><div ng-show="!showUp && ((user.type == 21 && userPermit.indexOf(\',1304,\') >= 0) || user.type !=21)"></div><div ng-show="showUp && ((user.type == 21 && userPermit.indexOf(\',1304,\') >= 0) || user.type !=21)" class="btn-group dropdown"><div class="data-page dropdown-menu"><ul><li ng-repeat="dataPageNum in dataPageNums" ng-click=dataOutPage(dataPageNum.start,dataPageNum.end)>{{dataPageNum.start}}-{{dataPageNum.end}}<em>页</em></li></ul></div></div><div ng-show="showUp && ((user.type == 21 && userPermit.indexOf(\',1304,\') >= 0) || user.type !=21)" class=btn-group><a class="btn btn-primary" ng-click=openServiceApply()><span class=export_excel>服务应用</span></a></div></div><div class=data class=mb20><div class=table-list><table class=table><tr><th><div class="square table-checkbox"><div class=checkbox-square ng-class="{checked: allSelect.selected}"><em class=eqf-yes2></em> <input type=checkbox ng-model=allSelect.selected ng-change="selectAll()"></div></div></th><th class=data_header ng-style="{width: tdW}" ng-repeat="header in dataShow track by $index">{{header.title}}</th></tr><tr ng-repeat="data in dataShowList"><td><div class="square table-checkbox"><div class=checkbox-square ng-class="{checked: data.selected}"><em class=eqf-yes2></em> <input type=checkbox ng-model=data.selected ng-change="selectData(data)"></div></div></td><td title={{item}} ng-repeat="item in data track by $index">{{item}}</td></tr></table><div ng-show="totalItems > 10" class=clearfix><pagination class=fl first-text=首页 last-text=尾页 previous-text=&lsaquo; next-text=&rsaquo; max-size=10 items-per-page=10 total-items=totalItems ng-model=page.currentPage ng-change=pageChanged(page.currentPage) boundary-links=true rotate=true num-pages=numPages></pagination><div class=current_page><span class=fl>到</span> <input type=text ng-model=toPage ng-keyup="$event.keyCode == 13 ? pageChanged(toPage) : null"><span class=fl>页</span> <a ng-click=pageChanged(toPage) class=go>确定</a></div></div></div></div></div><div class=pt20 ng-show="totalItems && !dataShowList.length">您没有勾选数据</div><div style=text-align:center class="pt20 pb20 mb20" ng-show="totalItems==0"><h2 ng-if="dataTable==\'formData\'" class="mb20 mt20">您的场景数据目前为空</h2><div ng-if="dataTable==\'formData\'" class=mb20>进入编辑页面添加表单类组件，收集需要的数据。</div><h2 ng-if="dataTable==\'boardsData\'" class="mb20 mt20">您的留言数据目前为空</h2><div ng-if="dataTable==\'boardsData\'" class=mb20>进入编辑页面添加留言板组件，收集需要的数据。</div><img ng-src="{{CLIENT_CDN}}assets/images/userdata.svg"></div></div></div>');
}]), angular.module("spread/tab/share.tpl.html", []).run(["$templateCache", function(a) {
	a.put("spread/tab/share.tpl.html", '<div class=share-tab><ul class="nav nav-pills nav-stacked no-border"><li ng-class="{active: viewControl.subtab == \'socialShare\'}"><a class=background-color-width-change ng-click="showSelectSubTab(\'socialShare\')">社交分享</a></li><li ng-class="{active: viewControl.subtab == \'siteImport\'}"><a class=background-color-width-change ng-click="showSelectSubTab(\'siteImport\')">网址嵌入</a></li></ul></div><div class="tab-content p20"><div ng-if="viewControl.subtab == \'socialShare\' && scene.code" ng-controller=SocialShareCtrl><div class=social-share ng-include="\'spread/tab/subtab/social-share.tpl.html\'"></div></div><div ng-if="viewControl.subtab == \'expandWeb\'" ng-controller=ExpandWebCtrl><div ng-include="\'spread/tab/subtab/expand-web.tpl.html\'"></div></div><div ng-if="viewControl.subtab == \'domainBind\'" ng-controller=DomainBindCtrl><div ng-include="\'spread/tab/subtab/domain-bind.tpl.html\'"></div></div><div ng-if="viewControl.subtab == \'siteImport\'" ng-controller=SiteImportCtrl><div ng-include="\'spread/tab/subtab/site-import.tpl.html\'"></div></div><div ng-if="viewControl.subtab == \'messagePost\'" ng-controller=messagePostCtrl><div ng-include="\'spread/tab/subtab/message-post.tpl.html\'"></div></div><div ng-if="viewControl.subtab == \'checkScene\'" ng-controller=CheckSceneCtrl><div ng-include="\'spread/tab/subtab/check-scene.tpl.html\'"></div></div><div id=spread-three ng-if="viewControl.subtab == \'thirdWeb\'" ng-controller=ThirdWebCtrl><div ng-include="\'spread/tab/subtab/thirdweb.tpl.html\'"></div></div></div>')
}]), angular.module("spread/tab/statistics.tpl.html", []).run(["$templateCache", function(a) {
	a.put("spread/tab/statistics.tpl.html", '<div class="tab-view statistics"><ul class="nav nav-pills nav-stacked no-border"><li ng-class="{active: viewControl.subtab == \'summeryViewInfo\'}"><a class=background-color-width-change ng-click="switchIntoTab(\'summeryViewInfo\')" data-event=8213>数据概况</a></li><li ng-class="{active: viewControl.subtab == \'accessInfo\'}"><a class=background-color-width-change ng-click="switchIntoTab(\'accessInfo\')" data-event=8214>访问统计</a></li><li ng-class="{active: viewControl.subtab == \'shareStatistics\'}"><a class=background-color-width-change ng-click="switchIntoTab(\'shareStatistics\')" data-event=8215>分享统计</a></li><li ng-class="{active: viewControl.subtab == \'pageStatistics\'}"><a class=background-color-width-change ng-click="switchIntoTab(\'pageStatistics\')" data-event=8218>页面统计</a></li><li ng-class="{active: viewControl.subtab == \'userStatistics\'}"><a class=background-color-width-change ng-click="switchIntoTab(\'userStatistics\')" data-event=8219>访客分析</a></li><li ng-class="{active: viewControl.subtab == \'interactiveStatistics\'}"><a class=background-color-width-change ng-click="switchIntoTab(\'interactiveStatistics\')" data-event=8216>互动统计</a></li><li ng-class="{active: viewControl.subtab == \'expandWebStatistics\'}" ng-if="user.type != 1"><a class=background-color-width-change ng-click="switchIntoTab(\'expandWebStatistics\')" data-event=8217>扩展网址统计</a></li><li ng-class="{active: viewControl.subtab == \'textMessageStatistics\'}" ng-if=false><a class=background-color-width-change ng-click="switchIntoTab(\'textMessageStatistics\')">短信效果统计</a></li></ul></div><div class="tab-content statistics"><div class="view-info summery-view-info" ng-if="viewControl.subtab == \'summeryViewInfo\' && scene.createTime" summery-view-info></div><div class="view-info access-info" ng-if="viewControl.subtab == \'accessInfo\' && scene.createTime" access-info></div><div class="view-info share-statistics" ng-if="viewControl.subtab == \'shareStatistics\' && scene.createTime" share-statistics></div><div class="view-info share-statistics" ng-if="viewControl.subtab == \'pageStatistics\' && scene.createTime" page-statistics></div><div class="view-info share-statistics" ng-if="viewControl.subtab == \'userStatistics\' && scene.createTime" user-statistics></div><div class="view-info interactive-statistics" ng-if="viewControl.subtab == \'interactiveStatistics\' && scene.createTime" interactive-statistics></div><div class="view-info expand-web-statistics" ng-if="viewControl.subtab == \'expandWebStatistics\' && scene.createTime" expand-web-statistics></div><div ng-if=false class="view-info text-message-statistics" ng-if="viewControl.subtab == \'textMessageStatistics\' && scene.createTime" text-message-statistics></div><p style="text-align: right">备注：效果统计中数据均为2016年1月份之后统计的数据。</p></div>')
}]), angular.module("spread/tab/statistics/access-info.tpl.html", []).run(["$templateCache", function(a) {
	a.put("spread/tab/statistics/access-info.tpl.html", '<div class="view-info access-info"><div class=date-range date-range=dateRange></div><div class="summery-container pv fixed-height"><div class=summery-header><span><i class=eqf-exclaquestion-sign tooltip="● 场景被访问的次数，包括PV量（访问次数），UV量（访问人数）。"></i></span> 场景访问量</div><div class="header-menu btn-group"><label class="btn btn-default btn-sm active">易企秀统计</label></div><div class=summery-body scene-pv=scenePVUV summery-pv-uv=summeryPVUV></div></div><div class="summery-container data-story-stay-time"><div class=summery-header><span><i class=eqf-exclaquestion-sign tooltip-html-unsafe="● 访客访问场景的时间，可以了解到访客哪些时间浏览量最高。<br/>● 有助于选择合适的推广投放时间。"></i></span> 访问时间分布</div><div class=header-tip><span class=btn-demo ng-if=!isAllowedToDataStoryVisitTime>以下为演示数据，</span> <a ng-href="{{PREFIX_HOST + \'/privilege\'}}" ng-if=!isAllowedToDataStoryVisitTime target=_self>如需查看此数据请点击升级账号</a></div><div class="header-menu btn-group"><label class="btn btn-default btn-sm active">数说故事</label></div><div class=summery-body data-story-visit-time=dataStoryAccessInfo.visitTimeDist></div><div class=third-party-not-enabled ng-if="isAllowedToDataStoryVisitTime && !isDataStoryStatisticEnabled" third-party-not-enabled></div></div><div class="summery-container region"><div class=summery-header><span><i class=eqf-exclaquestion-sign tooltip-html-unsafe="● 访客所在的地理位置<br/>● 为场景推广投放地域提供参考。"></i></span> 地域访问</div><div class="header-menu btn-group"><label class="btn btn-default btn-sm active">易企秀统计</label></div><div class=summery-body summery-region=summeryRegion></div></div><div class="summery-container device" ng-class="{\'fixed-height\': deviceProvider == \'eqxiu\'}"><div class=summery-header><span ng-if="!(isMTAStatisticEnabled || isDataStoryStatisticEnabled)"><i class=eqf-exclaquestion-sign tooltip="● 访客访问场景时使用的设备情况分析"></i></span> <span ng-if="isMTAStatisticEnabled || isDataStoryStatisticEnabled"><i class=eqf-exclaquestion-sign tooltip-html-unsafe="● 访客访问场景时使用的设备情况<br/>● 其中数说故事提供的分析为最近两个月的数据。"></i></span> 访问设备</div><div class=header-tip><span class=btn-demo ng-if="!isAllowedToAccessDeviceStatistic && deviceProvider == \'eqxiu\'">以下为演示数据，</span> <a ng-href="{{PREFIX_HOST + \'/privilege\'}}" ng-if="!isAllowedToAccessDeviceStatistic && deviceProvider == \'eqxiu\'" target=_self>如需查看此数据请点击升级账号</a> <span class=btn-demo ng-if="!isAllowedToMTADevice && deviceProvider == \'tencent\'">以下为演示数据，</span> <a ng-href="{{PREFIX_HOST + \'/privilege\'}}" ng-if="!isAllowedToMTADevice && deviceProvider == \'tencent\'" target=_self>如需查看此数据请点击升级账号</a> <span class=btn-demo ng-if="!isAllowedToDataStoryDevice && deviceProvider == \'datastory\'">以下为演示数据，</span> <a ng-href="{{PREFIX_HOST + \'/privilege\'}}" ng-if="!isAllowedToDataStoryDevice && deviceProvider == \'datastory\'" target=_self>如需查看此数据请点击升级账号</a></div><div class="header-menu btn-group"><label class="btn btn-default btn-sm" ng-model=deviceProvider btn-radio="\'eqxiu\'">易企秀统计</label><label class="btn btn-default btn-sm" ng-model=deviceProvider btn-radio="\'tencent\'">腾讯云分析</label><label class="btn btn-default btn-sm" ng-model=deviceProvider btn-radio="\'datastory\'">数说故事</label></div><div class=summery-body ng-if="deviceProvider == \'eqxiu\'" summery-device=summeryDevice top10-device=top10Device></div><div class=summery-body ng-if="deviceProvider == \'tencent\' && (isAllowedToMTADevice ? isMTAStatisticEnabled : true)" mta-client></div><div class=third-party-not-enabled ng-if="deviceProvider == \'tencent\' && isAllowedToMTADevice && !isMTAStatisticEnabled" third-party-not-enabled></div><div class=summery-body ng-if="deviceProvider == \'datastory\'" data-story-device></div><div class=third-party-not-enabled ng-if="deviceProvider == \'datastory\' && isAllowedToDataStoryDevice && !isDataStoryStatisticEnabled" third-party-not-enabled></div></div><div class="summery-container operator"><div class=summery-header><span><i class=eqf-exclaquestion-sign tooltip="● 访客访问场景时使用的网络情况分析"></i></span> 运营商</div><div class=header-tip><span class=btn-demo ng-if=!isAllowedToMTAOperator>以下为演示数据，</span> <a ng-href="{{PREFIX_HOST + \'/privilege\'}}" ng-if=!isAllowedToMTAOperator target=_self>如需查看此数据请点击升级账号</a></div><div class="header-menu btn-group"><label class="btn btn-default btn-sm active">腾讯云分析</label></div><div class=summery-body mta-operator></div><div class=third-party-not-enabled ng-if="isAllowedToMTAOperator && !isMTAStatisticEnabled" third-party-not-enabled></div></div><div class="summery-container browser"><div class=summery-header><span><i class=eqf-exclaquestion-sign tooltip="● 访客访问场景时使用的浏览器情况分析"></i></span> 浏览器</div><div class=header-tip><span class=btn-demo ng-if=!isAllowedToMTABrowser>以下为演示数据，</span> <a ng-href="{{PREFIX_HOST + \'/privilege\'}}" ng-if=!isAllowedToMTABrowser target=_self>如需查看此数据请点击升级账号</a></div><div class="header-menu btn-group"><label class="btn btn-default btn-sm active">腾讯云分析</label></div><div class=summery-body mta-browser></div><div class=third-party-not-enabled ng-if="isAllowedToMTABrowser && !isMTAStatisticEnabled" third-party-not-enabled></div></div></div>')
}]), angular.module("spread/tab/statistics/components/data-story-device.tpl.html", []).run(["$templateCache", function(a) {
	a.put("spread/tab/statistics/components/data-story-device.tpl.html", '<div class="mta-operator-operation-menu mta-client-menu"><div class="btn-group btn-para-ids"><label class="btn btn-default btn-sm" ng-model=dataStoryDevice btn-radio="\'os\'">系统分布</label><label class="btn btn-default btn-sm" ng-model=dataStoryDevice btn-radio="\'brand\'">品牌分布</label><label class="btn btn-default btn-sm" ng-model=dataStoryDevice btn-radio="\'network\'">网络类型</label></div></div><div ng-if="dataStoryDevice == \'os\'" data-story-os class="mta-operator-container basic-chart data-story-device-container"></div><div ng-if="dataStoryDevice == \'brand\'" data-story-brand class="mta-operator-container basic-chart data-story-device-container"></div><div ng-if="dataStoryDevice == \'network\'" data-story-network class="mta-operator-container basic-chart data-story-device-container"></div>')
}]), angular.module("spread/tab/statistics/components/data-story-os.tpl.html", []).run(["$templateCache", function(a) {
	a.put("spread/tab/statistics/components/data-story-os.tpl.html", '<div class="data-story-os-chart fixed-width-chart full-size-chart"><div id=PCmobileDist class=chart-distribution-col-2><div><i class=hd-phone></i><p class=chart-percent id=dist-mobile>{{pcMobile2count.mobile}}%</p><p class=chart-name>移动端</p></div><div><i class=hd-computer></i><p class=chart-percent id=dist-pc>{{pcMobile2count.pc}}%</p><p class=chart-name>PC端</p></div></div><div id=terminalDist class=chart-distribution><div><i class=hd-ios></i><p class=chart-percent id=mobile-ios>{{terminal2count.iphone}}%</p><p class=chart-name>IOS</p></div><div><i class=hd-android></i><p class=chart-percent id=mobile-android>{{terminal2count.android}}%</p><p class=chart-name>Andriod</p></div><div><i class=hd-ellipsis></i><p class=chart-percent id=mobile-other>{{terminal2count.other}}%</p><p class=chart-name>其它</p></div></div></div>')
}]), angular.module("spread/tab/statistics/components/data-story-user-portrait.tpl.html", []).run(["$templateCache", function(a) {
	a.put("spread/tab/statistics/components/data-story-user-portrait.tpl.html", '<div class="basic-chart data-story-user-portrait-container"><div class=data-story-user-gender-chart-container><h4>性别分布</h4><div class="text-center data-story-user-gender-chart"><div class=sex-wrap><i class="icon icon-man"></i><div class=sex-info><span class=sex-text style="color: #88a9eb">男性访客</span><br><span class=percent-big id=man-percent>{{visitorSex.male}}%</span></div></div><div class=sex-wrap><i class="icon icon-women"></i><div class=sex-info><span class=sex-text style="color: #ff7ca4">女性访客</span><br><span class=percent-big id=women-percent>{{visitorSex.female}}%</span></div></div></div></div><div class=data-story-user-label-chart-container><h4>用户标签</h4><div class=data-story-user-label-chart id=interest_box></div></div></div>')
}]), angular.module("spread/tab/statistics/components/date-range.tpl.html", []).run(["$templateCache", function(a) {
	a.put("spread/tab/statistics/components/date-range.tpl.html", '<div class=date-range><ul class=date-menu><li><a class=date-choice ng-class="{\'active\': dateRange.state === 0}" ng-click=switchToState(0)>总量</a></li><li><a class=date-choice ng-class="{\'active\': dateRange.state === 1}" ng-click=switchToState(1)>昨天</a></li><li><a class=date-choice ng-class="{\'active\': dateRange.state === 2}" ng-click=switchToState(2)>最近7天</a></li><li><a class=date-choice ng-class="{\'active\': dateRange.state === 3}" ng-click=switchToState(3)>最近15天</a></li></ul><div class=calender><span class="btn btn-default date-title" ng-click=open($event)>{{dateRange.startTime}} 至 {{dateRange.endTime}}<span class=caret></span></span> <input type=text class=date-picker-input-start datepicker-popup="\'yyyy-MM-dd\'" ng-model=selectedDate.startDate ng-change=selectStartDate() is-open=opened datepicker-options=dateOptions format-day-title="\'yyyy MMMM\'" min-date=scene.createTime max-date=selectedDate.endDate show-button-bar=false close-on-date-selection="false"> <input type=text class=date-picker-input-end datepicker-popup="\'yyyy-MM-dd\'" ng-model=selectedDate.endDate ng-change=selectEndDate() is-open=opened datepicker-options=dateOptions format-day-title="\'yyyy MMMM\'" min-date=selectedDate.startDate max-date=today show-button-bar=false close-on-date-selection="false"></div><div class=third-party-analysis ng-controller=ThirdPartyAnalysisCtrl><button class="btn btn-default" ng-click=enableThirdPartyAnalysis() ng-show="isCurrentUserAccess && !branchid">开启第三方统计</button></div></div>')
}]), angular.module("spread/tab/statistics/components/mta-browser.tpl.html", []).run(["$templateCache", function(a) {
	a.put("spread/tab/statistics/components/mta-browser.tpl.html", '<div class=mta-operator-operation-menu><div class=btn-group><label class="btn btn-default btn-sm" ng-model=browserIdx btn-radio="\'pv\'">浏览量(PV)</label><label class="btn btn-default btn-sm" ng-model=browserIdx btn-radio="\'uv\'">独立访客(UV)</label><label class="btn btn-default btn-sm" ng-model=browserIdx btn-radio="\'vv\'">访问次数(VV)</label><label class="btn btn-default btn-sm" ng-model=browserIdx btn-radio="\'iv\'">独立IP(IV)</label></div></div><div class="mta-operator-container basic-chart"></div><div class="mta-user-compare-detail fit-basic-chart"><div class=mt-user-compare-title><a ng-click="showMtaBrowserDetail = !showMtaBrowserDetail">点击{{showMtaBrowserDetail ? \'收起\' : \'查看\'}}详细数据</a></div><div class=mta-user-compare-detail-table ng-class="{\'show-detail\': showMtaBrowserDetail}"><table class="table table-bordered table-condensed"><thead><tr><th>名称</th><th>浏览量(PV)</th><th>独立访客(UV)</th><th>访问次数(VV)</th><th>独立IP</th></tr></thead><tbody><tr ng-repeat="mtaBrowser in mtaBrowserDetails"><td>{{mtaBrowser.client_name}}</td><td>{{mtaBrowser.pv}}</td><td>{{mtaBrowser.uv}}</td><td>{{mtaBrowser.vv}}</td><td>{{mtaBrowser.iv}}</td></tr></tbody></table></div></div>')
}]), angular.module("spread/tab/statistics/components/mta-client.tpl.html", []).run(["$templateCache", function(a) {
	a.put("spread/tab/statistics/components/mta-client.tpl.html", '<div class="mta-operator-operation-menu mta-client-menu"><div class="btn-group btn-para-ids"><label class="btn btn-default btn-sm" ng-model=paraId btn-radio="\'2\'">操作系统</label><label class="btn btn-default btn-sm" ng-model=paraId btn-radio="\'4\'">分辨率</label><label class="btn btn-default btn-sm" ng-model=paraId btn-radio="\'5\'">屏幕颜色</label><label class="btn btn-default btn-sm" ng-model=paraId btn-radio="\'6\'">语言</label><label class="btn btn-default btn-sm" ng-model=paraId btn-radio="\'9\'">时区</label><label class="btn btn-default btn-sm" ng-model=paraId btn-radio="\'10\'">平台</label></div><div style="margin-bottom: 10px"></div><div class=btn-group><label class="btn btn-default btn-sm" ng-model=browserIdx btn-radio="\'pv\'">浏览量(PV)</label><label class="btn btn-default btn-sm" ng-model=browserIdx btn-radio="\'uv\'">独立访客(UV)</label><label class="btn btn-default btn-sm" ng-model=browserIdx btn-radio="\'vv\'">访问次数(VV)</label><label class="btn btn-default btn-sm" ng-model=browserIdx btn-radio="\'iv\'">独立IP(IV)</label></div></div><div class="mta-operator-container basic-chart mta-client-container"></div><div class="mta-user-compare-detail fit-basic-chart" style="margin-top: 370px"><div class=mt-user-compare-title><a ng-click="showMtaClientDetail = !showMtaClientDetail">点击{{showMtaClientDetail ? \'收起\' : \'查看\'}}详细数据</a></div><div class=mta-user-compare-detail-table ng-class="{\'show-detail\': showMtaClientDetail}"><table class="table table-bordered table-condensed"><thead><tr><th>名称</th><th>浏览量(PV)</th><th>独立访客(UV)</th><th>访问次数(VV)</th><th>独立IP</th></tr></thead><tbody><tr ng-repeat="mtaClient in mtaClientDetails"><td>{{mtaClient.client_name}}</td><td>{{mtaClient.pv}}</td><td>{{mtaClient.uv}}</td><td>{{mtaClient.vv}}</td><td>{{mtaClient.iv}}</td></tr></tbody></table></div></div>')
}]), angular.module("spread/tab/statistics/components/mta-operator.tpl.html", []).run(["$templateCache", function(a) {
	a.put("spread/tab/statistics/components/mta-operator.tpl.html", '<div class=mta-operator-operation-menu><div class=btn-group><label class="btn btn-default btn-sm" ng-model=currentIdx btn-radio="\'pv\'">浏览量(PV)</label><label class="btn btn-default btn-sm" ng-model=currentIdx btn-radio="\'uv\'">独立访客(UV)</label><label class="btn btn-default btn-sm" ng-model=currentIdx btn-radio="\'vv\'">访问次数(VV)</label><label class="btn btn-default btn-sm" ng-model=currentIdx btn-radio="\'iv\'">独立IP</label></div></div><div class="mta-operator-container basic-chart"></div><div class="mta-user-compare-detail fit-basic-chart"><div class=mt-user-compare-title><a ng-click="showOperatorDetail = !showOperatorDetail">点击{{showOperatorDetail ? \'收起\' : \'查看\'}}详细数据</a></div><div class=mta-user-compare-detail-table ng-class="{\'show-detail\': showOperatorDetail}"><table class="table table-bordered table-condensed"><thead><tr><th>运营商</th><th>浏览量(PV)</th><th>独立访客(UV)</th><th>访问次数(VV)</th><th>独立IP</th></tr></thead><tbody><tr ng-repeat="operator in operatorDetails"><td>{{operator.name}}</td><td>{{operator.pv}}</td><td>{{operator.uv}}</td><td>{{operator.vv}}</td><td>{{operator.iv}}</td></tr></tbody></table></div></div>')
}]), angular.module("spread/tab/statistics/components/mta-page-speed.tpl.html", []).run(["$templateCache", function(a) {
	a.put("spread/tab/statistics/components/mta-page-speed.tpl.html", '<div class=mta-page-speed-container><div class=nav-container><div class=btn-group><label class="btn btn-default btn-sm" ng-model=page_speed_function btn-radio="\'area\'">地域</label><label class="btn btn-default btn-sm" ng-model=page_speed_function btn-radio="\'proxy\'">运营商</label></div></div><div class=mta-area ng-if="page_speed_function == \'area\'"><div class=mta-area-chart mta-area-chart></div><div class=mta-area-detail-table><div style="margin-bottom: 10px">各省访问延迟情况</div><div class=mta-area-data><table class="table table-condensed table-bordered"><thead><tr><th>省市</th><th>访问延时（秒）</th><th>历史趋势</th></tr></thead><tbody><tr ng-repeat="province in provinceTableDatas"><td>{{province.area_name}}</td><td>{{province.visitor_speed}}</td><td><a ng-click=viewDetail(province.area_id)>查看</a></td></tr></tbody></table></div><div ng-if=!provinceTableDatas.length style="height: 100px; margin-top: 100px" class="no-data small"><p><img ng-src="{{CLIENT_CDN}}assets/images/userdata.svg"></p><p>暂无数据</p></div></div><div class=mta-area-detail-container ng-if=isViewingDetail><span class=mta-area-back ng-click=closeViewingDetail()><em class="fa fa-arrow-left"></em>返回</span><div class=mta-area-detail mta-area-detail></div></div></div><div class=mta-proxy ng-if="page_speed_function == \'proxy\'"><div class="mta-proxy-chart basic-chart" mta-proxy-chart></div></div></div>')
}]), angular.module("spread/tab/statistics/components/mta-realtime-user.tpl.html", []).run(["$templateCache", function(a) {
	a.put("spread/tab/statistics/components/mta-realtime-user.tpl.html", '<div class=mta-realtime-user-container><div class=group><strong class=group-label>访问时长：</strong><div class=btn-group><label class="btn btn-default btn-sm" ng-model=online_time btn-radio="\'-1\'">全部</label><label class="btn btn-default btn-sm" ng-model=online_time btn-radio="\'0,30\'">0~30s</label><label class="btn btn-default btn-sm" ng-model=online_time btn-radio="\'30,60\'">30~60s</label><label class="btn btn-default btn-sm" ng-model=online_time btn-radio="\'60,180\'">1min~3min</label><label class="btn btn-default btn-sm" ng-model=online_time btn-radio="\'180,300\'">3min~5min</label><label class="btn btn-default btn-sm" ng-model=online_time btn-radio="\'300,600\'">5min~10min</label><label class="btn btn-default btn-sm" ng-model=online_time btn-radio="\'600,86400\'">10min以上</label></div></div><div class=group><strong class=group-label>访问页数：</strong><div class=btn-group><label class="btn btn-default btn-sm" ng-model=page_range btn-radio="\'-1,99999\'">全部</label><label class="btn btn-default btn-sm" ng-model=page_range btn-radio="\'1,1\'">1页</label><label class="btn btn-default btn-sm" ng-model=page_range btn-radio="\'2,2\'">2页</label><label class="btn btn-default btn-sm" ng-model=page_range btn-radio="\'3,5\'">3~5页</label><label class="btn btn-default btn-sm" ng-model=page_range btn-radio="\'6,10\'">6~10页</label><label class="btn btn-default btn-sm" ng-model=page_range btn-radio="\'11,20\'">11~20页</label><label class="btn btn-default btn-sm" ng-model=page_range btn-radio="\'20,99999\'">20页以上</label></div></div><div class=group><strong class=group-label>访问地域：</strong><div class=btn-group><label class="btn btn-default btn-sm" ng-model=area btn-radio="\'-1\'">全部</label><label class="btn btn-default btn-sm" ng-model=area btn-radio="\'0,30\'">地域组合</label></div></div><div class=data-detail><table class="table table-bordered table-condensed"><thead><tr><th>访问时长</th><th>地域</th><th>访客类型</th><th>来源</th></tr></thead><tbody><tr ng-repeat="user in realtimeUsers"><td>{{user.online_time}}</td><td>{{user.area}}</td><td>{{user.visitor_type}}</td><td>{{user.source_type}}</td></tr></tbody></table><div class="no-data small" ng-if=!realtimeUsers.length><p><img ng-src="{{CLIENT_CDN}}assets/images/userdata.svg"></p><p>暂无数据</p></div></div></div>')
}]), angular.module("spread/tab/statistics/components/mta-user-compare.tpl.html", []).run(["$templateCache", function(a) {
	a.put("spread/tab/statistics/components/mta-user-compare.tpl.html", '<div class="mta-user-compare-container basic-chart"></div><div class=mta-user-compare-detail><div class=mt-user-compare-title><a ng-click="showUserCompareDetail = !showUserCompareDetail">点击{{showUserCompareDetail ? \'收起\' : \'查看\'}}详细数据</a></div><div class=mta-user-compare-detail-table ng-class="{\'show-detail\': showUserCompareDetail}"><table class="table table-bordered table-condensed"><thead><tr><th>时间</th><th>新访客数</th><th>新访客占比</th><th>老访客数</th><th>老访客占比</th></tr></thead><tbody><tr ng-repeat="(theDate, visitor) in visitors"><td>{{theDate}}</td><td>{{visitor.new_visitor}}</td><td>{{visitor.new_visitor_percent}}</td><td>{{visitor.old_visitor}}</td><td>{{visitor.old_visitor_percent}}</td></tr></tbody></table></div></div>')
}]), angular.module("spread/tab/statistics/components/mta-user-portrait.tpl.html", []).run(["$templateCache", function(a) {
	a.put("spread/tab/statistics/components/mta-user-portrait.tpl.html", '<div class=mta-user-portrait-container><div class=column><div class=visitor_sex><h4>性别比例</h4><div class=visitor_cont id=sex_chart_container sex-chart></div></div><div class=visitor_user><h4>新用户比例</h4><div class=visitor_cont id=user_chart_container compare-chart></div><div class=legend><p><i class=i_new></i>新用户</p><p><i class=i_old></i>老用户</p></div></div></div><div class=column><div class=visitor_age><h4>年龄分布</h4><div class=visitor_pillar id=age_chart_container age-chart></div></div><div class=visitor_education><h4>学历分布</h4><div class=visitor_streak id=grade_chart_container grade-chart></div><div class=legend id=visitor_grade_legend><p><i class=i_education0></i>未知</p><p><i class=i_education1></i>初中</p><p><i class=i_education2></i>高中</p><p><i class=i_education3></i>本科</p><p><i class=i_education4></i>硕士</p><p><i class=i_education5></i>博士</p></div></div></div><div class="column no-bottom-border"><div class=visitor_prof><h4>Top10 职业分布</h4><div class=visitor_cont id=prof_chart_container style="height: auto; transform: scale(0.85);transform-origin: left center" profession-chart></div></div></div></div>')
}]), angular.module("spread/tab/statistics/components/scene-pv.tpl.html", []).run(["$templateCache", function(a) {
	a.put("spread/tab/statistics/components/scene-pv.tpl.html", '<div class=summery-pv-uv ng-if="$parent.dateRange.state === 0"><div class=summery-pv><div class="max bigger"><span class=num>{{summeryPvUv.mapv}}</span> <span class=tip>日最高(PV)</span></div><div class="min bigger"><span class=num>{{summeryPvUv.mpv}}</span> <span class=tip>日最低(PV)</span></div><div class="average bigger"><span class=num>{{summeryPvUv.apv}}</span> <span class=tip>平均(PV)</span></div><div class="all-pv bigger"><span class=num>{{summeryPvUv.pv}}</span> <span class=tip>总浏览次数</span> <span class=emphasis>PV</span></div><div class=rolline><svg version=1.1 id=图层_1 xmlns=http://www.w3.org/2000/svg x=0px y=0px width=160px height=160px viewbox="0 0 160 160" enable-background="new 0 0 160 160" xml:space=preserve><path fill=#fff d="M150.078,80.31v-0.62H160v0.62H150.078z M149.784,73.583l9.885-0.864l0.054,0.617l-9.885,0.865\n	L149.784,73.583z M148.959,67.526l9.772-1.723l0.107,0.611l-9.771,1.723L148.959,67.526z M147.609,61.563l9.585-2.568l0.16,0.599\n	l-9.584,2.568L147.609,61.563z M145.745,55.741l9.324-3.394l0.212,0.583l-9.324,3.393L145.745,55.741z M143.381,50.103l8.993-4.193\n	l0.262,0.562l-8.993,4.193L143.381,50.103z M140.534,44.693l8.593-4.962l0.31,0.538l-8.593,4.961L140.534,44.693z M137.226,39.551\n	l8.128-5.691l0.356,0.508l-8.128,5.691L137.226,39.551z M133.483,34.718l7.601-6.379l0.399,0.476l-7.601,6.378L133.483,34.718z\n	 M129.333,30.228l7.016-7.016l0.439,0.439l-7.016,7.016L129.333,30.228z M124.807,26.118l6.378-7.601l0.476,0.399l-6.378,7.601\n	L124.807,26.118z M119.941,22.418l5.691-8.128l0.508,0.356l-5.691,8.128L119.941,22.418z M114.77,19.156l4.961-8.593l0.538,0.31\n	l-4.962,8.593L114.77,19.156z M109.335,143.643l0.562-0.262l4.194,8.993l-0.563,0.262L109.335,143.643z M109.335,16.357l4.193-8.993\n	l0.563,0.262l-4.194,8.993L109.335,16.357z M103.677,145.957l0.582-0.212l3.394,9.324l-0.583,0.212L103.677,145.957z\n	 M103.677,14.043l3.393-9.324l0.583,0.212l-3.394,9.324L103.677,14.043z M97.838,147.77l0.599-0.161l2.568,9.585l-0.599,0.16\n	L97.838,147.77z M97.838,12.23l2.568-9.584l0.599,0.16l-2.568,9.585L97.838,12.23z M91.863,149.067l0.611-0.108l1.723,9.772\n	l-0.611,0.107L91.863,149.067z M91.863,10.933l1.723-9.771l0.611,0.107l-1.723,9.772L91.863,10.933z M85.799,149.838l0.618-0.054\n	l0.864,9.885l-0.617,0.054L85.799,149.838z M85.799,10.162l0.865-9.885l0.617,0.054l-0.864,9.885L85.799,10.162z M79.69,150.078\n	h0.62V160h-0.62V150.078z M79.69,0h0.62v9.922h-0.62V0z M72.719,159.669l0.864-9.885l0.618,0.054l-0.865,9.885L72.719,159.669z\n	 M72.719,0.331l0.617-0.054l0.865,9.885l-0.618,0.054L72.719,0.331z M65.803,158.731l1.723-9.772l0.611,0.108l-1.723,9.771\n	L65.803,158.731z M65.803,1.269l0.611-0.107l1.723,9.771l-0.611,0.108L65.803,1.269z M58.995,157.194l2.568-9.585l0.599,0.161\n	l-2.568,9.584L58.995,157.194z M58.995,2.806l0.599-0.16l2.568,9.584l-0.599,0.161L58.995,2.806z M52.347,155.069l3.394-9.324\n	l0.582,0.212l-3.393,9.324L52.347,155.069z M52.347,4.931l0.583-0.212l3.393,9.324l-0.582,0.212L52.347,4.931z M45.909,152.374\n	l4.194-8.993l0.562,0.262l-4.193,8.993L45.909,152.374z M45.909,7.626l0.563-0.262l4.193,8.993l-0.562,0.262L45.909,7.626z\n	 M39.731,149.127l4.962-8.593l0.537,0.31l-4.961,8.593L39.731,149.127z M39.731,10.873l0.538-0.31l4.961,8.593l-0.537,0.31\n	L39.731,10.873z M39.551,22.774l-5.691-8.128l0.508-0.356l5.691,8.128L39.551,22.774z M34.717,26.517l-6.378-7.601l0.476-0.399\n	l6.378,7.601L34.717,26.517z M30.229,30.667l-7.017-7.016l0.439-0.439l7.016,7.016L30.229,30.667z M26.118,35.193l-7.601-6.378\n	l0.399-0.476l7.601,6.379L26.118,35.193z M22.418,40.059l-8.128-5.691l0.356-0.508l8.128,5.691L22.418,40.059z M19.156,45.23\n	l-8.593-4.961l0.31-0.538l8.593,4.962L19.156,45.23z M16.357,50.665l-8.993-4.193l0.262-0.562l8.993,4.193L16.357,50.665z\n	 M14.043,56.323L4.719,52.93l0.212-0.583l9.324,3.394L14.043,56.323z M12.23,62.162l-9.584-2.568l0.16-0.599l9.585,2.568\n	L12.23,62.162z M10.933,68.137l-9.771-1.723l0.107-0.611l9.772,1.723L10.933,68.137z M10.162,74.201l-9.885-0.865l0.055-0.617\n	l9.884,0.864L10.162,74.201z M9.923,80.31H0v-0.62h9.923V80.31z M10.216,86.417l-9.884,0.864l-0.055-0.617l9.885-0.865\n	L10.216,86.417z M11.041,92.474l-9.772,1.723l-0.107-0.61l9.771-1.724L11.041,92.474z M12.391,98.437l-9.585,2.568l-0.16-0.599\n	l9.584-2.568L12.391,98.437z M14.255,104.259l-9.324,3.394l-0.212-0.583l9.324-3.393L14.255,104.259z M16.619,109.897l-8.993,4.194\n	l-0.262-0.563l8.993-4.193L16.619,109.897z M19.466,115.307l-8.593,4.962l-0.31-0.538l8.593-4.961L19.466,115.307z M22.774,120.449\n	l-8.128,5.691l-0.356-0.508l8.128-5.691L22.774,120.449z M26.517,125.283l-7.601,6.378l-0.399-0.475l7.601-6.379L26.517,125.283z\n	 M30.667,129.772l-7.016,7.016l-0.439-0.439l7.017-7.016L30.667,129.772z M35.193,133.882l-6.378,7.601l-0.476-0.399l6.378-7.601\n	L35.193,133.882z M40.059,137.582l-5.691,8.128l-0.508-0.356l5.691-8.128L40.059,137.582z M120.269,149.127l-0.538,0.31\n	l-4.961-8.593l0.537-0.31L120.269,149.127z M120.449,137.226l5.691,8.128l-0.508,0.356l-5.691-8.128L120.449,137.226z\n	 M125.283,133.483l6.378,7.601l-0.476,0.399l-6.378-7.601L125.283,133.483z M129.772,129.333l7.016,7.016l-0.439,0.439l-7.016-7.016\n	L129.772,129.333z M133.882,124.807l7.601,6.379l-0.399,0.475l-7.601-6.378L133.882,124.807z M137.582,119.941l8.128,5.691\n	l-0.356,0.508l-8.128-5.691L137.582,119.941z M140.844,114.77l8.593,4.961l-0.31,0.538l-8.593-4.962L140.844,114.77z\n	 M143.643,109.335l8.993,4.193l-0.262,0.563l-8.993-4.194L143.643,109.335z M145.957,103.677l9.324,3.393l-0.212,0.583l-9.324-3.394\n	L145.957,103.677z M147.77,97.838l9.584,2.568l-0.16,0.599l-9.585-2.568L147.77,97.838z M149.067,91.863l9.771,1.724l-0.107,0.61\n	l-9.772-1.723L149.067,91.863z M149.838,85.799l9.885,0.865l-0.054,0.617l-9.885-0.864L149.838,85.799z"></svg></div></div><div class=summery-uv><div class="max bigger"><span class=num>{{summeryPvUv.mauv}}</span> <span class=tip>日最高(UV)</span></div><div class="min bigger"><span class=num>{{summeryPvUv.muv}}</span> <span class=tip>日最低(UV)</span></div><div class="average bigger"><span class=num>{{summeryPvUv.auv}}</span> <span class=tip>平均(UV)</span></div><div class="all-pv bigger"><span class=num>{{summeryPvUv.uv}}</span> <span class=tip>总浏览次数</span> <span class=emphasis>UV</span></div><div class=rolline><svg version=1.1 id=图层_1 xmlns=http://www.w3.org/2000/svg x=0px y=0px width=160px height=160px viewbox="0 0 160 160" enable-background="new 0 0 160 160" xml:space=preserve><path fill=#fff d="M150.078,80.31v-0.62H160v0.62H150.078z M149.784,73.583l9.885-0.864l0.054,0.617l-9.885,0.865\n	L149.784,73.583z M148.959,67.526l9.772-1.723l0.107,0.611l-9.771,1.723L148.959,67.526z M147.609,61.563l9.585-2.568l0.16,0.599\n	l-9.584,2.568L147.609,61.563z M145.745,55.741l9.324-3.394l0.212,0.583l-9.324,3.393L145.745,55.741z M143.381,50.103l8.993-4.193\n	l0.262,0.562l-8.993,4.193L143.381,50.103z M140.534,44.693l8.593-4.962l0.31,0.538l-8.593,4.961L140.534,44.693z M137.226,39.551\n	l8.128-5.691l0.356,0.508l-8.128,5.691L137.226,39.551z M133.483,34.718l7.601-6.379l0.399,0.476l-7.601,6.378L133.483,34.718z\n	 M129.333,30.228l7.016-7.016l0.439,0.439l-7.016,7.016L129.333,30.228z M124.807,26.118l6.378-7.601l0.476,0.399l-6.378,7.601\n	L124.807,26.118z M119.941,22.418l5.691-8.128l0.508,0.356l-5.691,8.128L119.941,22.418z M114.77,19.156l4.961-8.593l0.538,0.31\n	l-4.962,8.593L114.77,19.156z M109.335,143.643l0.562-0.262l4.194,8.993l-0.563,0.262L109.335,143.643z M109.335,16.357l4.193-8.993\n	l0.563,0.262l-4.194,8.993L109.335,16.357z M103.677,145.957l0.582-0.212l3.394,9.324l-0.583,0.212L103.677,145.957z\n	 M103.677,14.043l3.393-9.324l0.583,0.212l-3.394,9.324L103.677,14.043z M97.838,147.77l0.599-0.161l2.568,9.585l-0.599,0.16\n	L97.838,147.77z M97.838,12.23l2.568-9.584l0.599,0.16l-2.568,9.585L97.838,12.23z M91.863,149.067l0.611-0.108l1.723,9.772\n	l-0.611,0.107L91.863,149.067z M91.863,10.933l1.723-9.771l0.611,0.107l-1.723,9.772L91.863,10.933z M85.799,149.838l0.618-0.054\n	l0.864,9.885l-0.617,0.054L85.799,149.838z M85.799,10.162l0.865-9.885l0.617,0.054l-0.864,9.885L85.799,10.162z M79.69,150.078\n	h0.62V160h-0.62V150.078z M79.69,0h0.62v9.922h-0.62V0z M72.719,159.669l0.864-9.885l0.618,0.054l-0.865,9.885L72.719,159.669z\n	 M72.719,0.331l0.617-0.054l0.865,9.885l-0.618,0.054L72.719,0.331z M65.803,158.731l1.723-9.772l0.611,0.108l-1.723,9.771\n	L65.803,158.731z M65.803,1.269l0.611-0.107l1.723,9.771l-0.611,0.108L65.803,1.269z M58.995,157.194l2.568-9.585l0.599,0.161\n	l-2.568,9.584L58.995,157.194z M58.995,2.806l0.599-0.16l2.568,9.584l-0.599,0.161L58.995,2.806z M52.347,155.069l3.394-9.324\n	l0.582,0.212l-3.393,9.324L52.347,155.069z M52.347,4.931l0.583-0.212l3.393,9.324l-0.582,0.212L52.347,4.931z M45.909,152.374\n	l4.194-8.993l0.562,0.262l-4.193,8.993L45.909,152.374z M45.909,7.626l0.563-0.262l4.193,8.993l-0.562,0.262L45.909,7.626z\n	 M39.731,149.127l4.962-8.593l0.537,0.31l-4.961,8.593L39.731,149.127z M39.731,10.873l0.538-0.31l4.961,8.593l-0.537,0.31\n	L39.731,10.873z M39.551,22.774l-5.691-8.128l0.508-0.356l5.691,8.128L39.551,22.774z M34.717,26.517l-6.378-7.601l0.476-0.399\n	l6.378,7.601L34.717,26.517z M30.229,30.667l-7.017-7.016l0.439-0.439l7.016,7.016L30.229,30.667z M26.118,35.193l-7.601-6.378\n	l0.399-0.476l7.601,6.379L26.118,35.193z M22.418,40.059l-8.128-5.691l0.356-0.508l8.128,5.691L22.418,40.059z M19.156,45.23\n	l-8.593-4.961l0.31-0.538l8.593,4.962L19.156,45.23z M16.357,50.665l-8.993-4.193l0.262-0.562l8.993,4.193L16.357,50.665z\n	 M14.043,56.323L4.719,52.93l0.212-0.583l9.324,3.394L14.043,56.323z M12.23,62.162l-9.584-2.568l0.16-0.599l9.585,2.568\n	L12.23,62.162z M10.933,68.137l-9.771-1.723l0.107-0.611l9.772,1.723L10.933,68.137z M10.162,74.201l-9.885-0.865l0.055-0.617\n	l9.884,0.864L10.162,74.201z M9.923,80.31H0v-0.62h9.923V80.31z M10.216,86.417l-9.884,0.864l-0.055-0.617l9.885-0.865\n	L10.216,86.417z M11.041,92.474l-9.772,1.723l-0.107-0.61l9.771-1.724L11.041,92.474z M12.391,98.437l-9.585,2.568l-0.16-0.599\n	l9.584-2.568L12.391,98.437z M14.255,104.259l-9.324,3.394l-0.212-0.583l9.324-3.393L14.255,104.259z M16.619,109.897l-8.993,4.194\n	l-0.262-0.563l8.993-4.193L16.619,109.897z M19.466,115.307l-8.593,4.962l-0.31-0.538l8.593-4.961L19.466,115.307z M22.774,120.449\n	l-8.128,5.691l-0.356-0.508l8.128-5.691L22.774,120.449z M26.517,125.283l-7.601,6.378l-0.399-0.475l7.601-6.379L26.517,125.283z\n	 M30.667,129.772l-7.016,7.016l-0.439-0.439l7.017-7.016L30.667,129.772z M35.193,133.882l-6.378,7.601l-0.476-0.399l6.378-7.601\n	L35.193,133.882z M40.059,137.582l-5.691,8.128l-0.508-0.356l5.691-8.128L40.059,137.582z M120.269,149.127l-0.538,0.31\n	l-4.961-8.593l0.537-0.31L120.269,149.127z M120.449,137.226l5.691,8.128l-0.508,0.356l-5.691-8.128L120.449,137.226z\n	 M125.283,133.483l6.378,7.601l-0.476,0.399l-6.378-7.601L125.283,133.483z M129.772,129.333l7.016,7.016l-0.439,0.439l-7.016-7.016\n	L129.772,129.333z M133.882,124.807l7.601,6.379l-0.399,0.475l-7.601-6.378L133.882,124.807z M137.582,119.941l8.128,5.691\n	l-0.356,0.508l-8.128-5.691L137.582,119.941z M140.844,114.77l8.593,4.961l-0.31,0.538l-8.593-4.962L140.844,114.77z\n	 M143.643,109.335l8.993,4.193l-0.262,0.563l-8.993-4.194L143.643,109.335z M145.957,103.677l9.324,3.393l-0.212,0.583l-9.324-3.394\n	L145.957,103.677z M147.77,97.838l9.584,2.568l-0.16,0.599l-9.585-2.568L147.77,97.838z M149.067,91.863l9.771,1.724l-0.107,0.61\n	l-9.772-1.723L149.067,91.863z M149.838,85.799l9.885,0.865l-0.054,0.617l-9.885-0.864L149.838,85.799z"></svg></div><div class="header-tip uv-footer" style="top: 0" ng-if=!$parent.$parent.$parent.isAllowedToAccessUVStatistic><span class=btn-demo style="display: inline;font-size: 12px">以下为演示数据，</span> <a ng-href="{{PREFIX_HOST + \'/privilege\'}}" target=_self>如需查看此数据请点击升级账号</a></div></div></div><div class="pv-chart basic-chart"></div><div class="basic-legend pv-legend"><span class=pv>总浏览次数(PV): {{legendPvUv.pv}}</span> <span class=pv>最高浏览次数(PV): {{legendPvUv.mapv}}</span> <span class=pv>最低浏览次数(PV): {{legendPvUv.mpv}}</span> <span class=pv>平均浏览次数(PV): {{legendPvUv.apv}}</span> <span class=uv>总访客次数(UV): {{legendPvUv.uv}}</span> <span class=uv>最高访客次数(UV): {{legendPvUv.mauv}}</span> <span class=uv>最低访客次数(UV): {{legendPvUv.muv}}</span> <span class=uv>平均访客次数(UV): {{legendPvUv.auv}}</span></div>');
}]), angular.module("spread/tab/statistics/components/share-channel.tpl.html", []).run(["$templateCache", function(a) {
	a.put("spread/tab/statistics/components/share-channel.tpl.html", '<div class="basic-chart eqxiu-share-channel-chart" style="width: 740px"></div>')
}]), angular.module("spread/tab/statistics/components/summery-device.tpl.html", []).run(["$templateCache", function(a) {
	a.put("spread/tab/statistics/components/summery-device.tpl.html", '<div class=device-legend><div class="iphone legend-item" tooltip-placement=top tooltip="{{\'苹果手机:\' + legend.iosValue}}"><span class="icon-container eqf-apple"></span> <span class=text-container><span class=text>苹果手机</span> <span class=num>{{legend.ios}}</span></span><div class=percentage-mask style="height: {{legend.ios}}"></div></div><div class="android legend-item" tooltip-placement=top tooltip="{{\'安卓手机:\' + legend.androidValue}}"><span class="icon-container eqf-andorid"></span> <span class=text-container><span class=text>安卓手机</span> <span class=num>{{legend.android}}</span></span><div class=percentage-mask style="height: {{legend.android}}"></div></div><div class="pc legend-item" tooltip-placement=top tooltip="{{\'PC电脑:\' + legend.pcValue}}"><span class="icon-container eqf-computer"></span> <span class=text-container><span class=text>PC电脑</span> <span class=num>{{legend.pc}}</span></span><div class=percentage-mask style="height: {{legend.pc}}"></div></div><div class="other legend-item" tooltip-placement=top tooltip="{{\'其他设备:\' + legend.mobileValue}}"><span class="icon-container eqf-pad"></span> <span class=text-container><span class=text>其他设备</span> <span class=num>{{legend.mobile}}</span></span><div class=percentage-mask style="height: {{legend.mobile}}"></div></div></div><div class=top-list-device top-list-device=top10Device></div><div class="top-list-device top-list-device-mask" ng-hide=top10Device.length><a ng-click=navToAd()>还没有访问量，点击这里试试</a><p><img style="width: 100px;margin-top: 20px;margin-left: 20px" ng-src={{noDataImg}}></p></div>')
}]), angular.module("spread/tab/statistics/components/summery-interactive.tpl.html", []).run(["$templateCache", function(a) {
	a.put("spread/tab/statistics/components/summery-interactive.tpl.html", '<div class=summery-interactive-total><div class=interactive-chart-group><div class=interactive-chart summery-interactive-pie-chart=summeryInteractiveComponent is-summery total=summeryInteractive.total current=summeryInteractive.total></div><div class=interactive-tip><span class=num-sm>{{summeryInteractive.total}}</span> <span class=tip>互动总次数</span></div></div></div><div class=summery-interactive-detail><div class=interactive-chart-group ng-repeat="interactiveComponent in interactiveComponents"><div class=interactive-chart summery-interactive-pie-chart=interactiveComponent total=summeryInteractive.total current=summeryInteractive[interactiveComponent.key]></div><div class=interactive-tip><span class=num-sm>{{summeryInteractive[interactiveComponent.key] || 0}}</span> <span class=tip>{{interactiveComponent.name}}</span></div></div></div>')
}]), angular.module("spread/tab/statistics/components/third-party-analysis-config.tpl.html", []).run(["$templateCache", function(a) {
	a.put("spread/tab/statistics/components/third-party-analysis-config.tpl.html", '<div class=modal-body><button type=button class=close data-dismiss=modal aria-label=Close ng-click=$dismiss()><span aria-hidden=true>×</span></button><div class=analysis-choices><div class="mta analysis-choice" ng-class="{\'selected\': originStatus.isMTAStatisticEnabled || isMTAStatisticEnabled}" ng-click=enableMTA()><img ng-src="{{CLIENT_CDN}}promotion/assets/images/statistic/mta.svg"><p>腾讯云分析</p><div class=mask ng-class="{\'show\': originStatus.isMTAStatisticEnabled}">已启用</div></div><div class="ds analysis-choice" ng-class="{\'selected\': originStatus.isDataStoryStatisticEnabled || isDataStoryStatisticEnabled}" ng-click=enableDataStory()><img ng-src="{{CLIENT_CDN}}promotion/assets/images/statistic/datastory.svg"><p>数说故事</p><div class=mask ng-class="{\'show\': originStatus.isDataStoryStatisticEnabled}">已启用</div></div><div style="clear: both"></div></div></div><div class="text-center pb20 btn-small"><a class="btn btn-default blue mr20" ng-click=confirmToEnable()>开启统计</a><span class=tip>可以多选</span></div>')
}]), angular.module("spread/tab/statistics/expand-web-statistics.tpl.html", []).run(["$templateCache", function(a) {
	a.put("spread/tab/statistics/expand-web-statistics.tpl.html", '<div class="view-info expand-web-statistics"><div class=date-range date-range=dateRange></div><form class=form-horizontal><div class=expand-web-form-group><label class=control-label>扩展名称</label><div class=control-input><eqx-select class="select-contain select-great border-width" model=selectedExpandWeb change=selectThisExpandWeb(selectedExpandWeb)><eqx-select-option value=null>扩展名称</eqx-select-option><eqx-select-option value=expandWeb ng-repeat="expandWeb in expandWebs">{{expandWeb.name}}</eqx-select-option></eqx-select></div></div><div class=expand-web-form-group><label class=control-label>扩展网址</label><div class=control-input><input type=text class=form-control placeholder=扩展网址 ng-model=selectedExpandWebUrl readonly></div></div></form><div class="summery-container expand-web pv fixed-height"><div class=summery-header><span><i class=eqf-exclaquestion-sign tooltip-html-unsafe="● 每个扩展网址被点击的次数<br/>● 为推广营销活动的效果提供统计。"></i></span> 访问量</div><div class="header-menu btn-group"><label class="btn btn-default btn-sm active">易企秀统计</label></div><div class=summery-body ng-if="!expandWebs.length || !selectedExpandWebUrl"><div class=no-expand-webs><h3>您还没有{{ expandWebs.length ? \'选择\' : \'添加\' }}扩展网址</h3><img ng-src="{{CLIENT_CDN}}assets/images/userdata.svg"></div></div><div class=summery-body ng-if="expandWebs.length && selectedExpandWebUrl" scene-pv=expandWebAnalysis summery-pv-uv=summeryExpandWeb></div></div><div class="summery-container device" ng-if=false><div class=summery-header>访问设备</div><div class=header-tip><span class=btn-demo>以下为演示数据，</span> <a ng-href="{{PREFIX_HOST + \'/privilege\'}}" target=_self>如需查看此数据请点击升级账号</a></div><div class="header-menu btn-group"><label class="btn btn-default btn-sm active">易企秀统计</label></div><div class=summery-body summery-device=summeryDevice top10-device=top10Device></div></div></div>')
}]), angular.module("spread/tab/statistics/interactive-statistics.tpl.html", []).run(["$templateCache", function(a) {
	a.put("spread/tab/statistics/interactive-statistics.tpl.html", '<div class="view-info interactive-statistics"><div class=date-range date-range=dateRange></div><div class="summery-container fixed-height"><div class=summery-header><span><i class=eqf-exclaquestion-sign tooltip-html-unsafe="● 访客点击场景中互动组件的次数。<br/>● 为场景制作提供帮助。"></i></span> 交互次数</div><div class="header-menu btn-group"><label class="btn btn-default btn-sm active">易企秀统计</label></div><div class=summery-body interactive-analysis=interactiveAnalysis summery-interactive-datas=summeryInteractiveDatas></div></div></div>')
}]), angular.module("spread/tab/statistics/page-statistics.tpl.html", []).run(["$templateCache", function(a) {
	a.put("spread/tab/statistics/page-statistics.tpl.html", '<div class="view-info page-statistics"><div class=date-range date-range=dateRange></div><div class="summery-container per-page fixed-height"><div class=summery-header><span><i class=eqf-exclaquestion-sign tooltip-html-unsafe="● 场景每页被访客点击的次数，以及每页停留的平均时长。<br/>● 为场景制作提供参考。"></i></span> 访问深度</div><div class=header-tip><span class=btn-demo ng-if="!isAllowdToPageDepth && pageDeepthProvider == \'eqxiu\'">以下为演示数据，</span> <a ng-href="{{PREFIX_HOST + \'/privilege\'}}" ng-if="!isAllowdToPageDepth && pageDeepthProvider == \'eqxiu\'" target=_self>如需查看此数据请点击升级账号</a> <span class=btn-demo ng-if="!isAllowedToMTAPageDeepth && pageDeepthProvider == \'tencent\'">以下为演示数据，</span> <a ng-href="{{PREFIX_HOST + \'/privilege\'}}" ng-if="!isAllowedToMTAPageDeepth && pageDeepthProvider == \'tencent\'" target=_self>如需查看此数据请点击升级账号</a></div><div class="header-menu btn-group"><label class="btn btn-default btn-sm" ng-model=pageDeepthProvider btn-radio="\'eqxiu\'">易企秀统计</label></div><div class=summery-body ng-if="pageDeepthProvider == \'eqxiu\' && pages.length" page-behavior></div><div class="summery-body mta-depth-chart-container" ng-if="pageDeepthProvider == \'tencent\' && pages.length"><div class="mta-depth-chart basic-chart" mta-depth-chart></div></div></div><div class="summery-container stay-time" ng-if=false><div class=summery-header>单页访问时长</div><div class=summery-body stay-time></div></div><div class="summery-container speed-performance"><div class=summery-header><span><i class=eqf-exclaquestion-sign tooltip-html-unsafe="● 可以看到场景在什么地域或网络下被打开的最快或最慢。<br/>● 有助于场景制作时内容多少的调整。"></i></span> 性能监控</div><div class=header-tip><span class=btn-demo ng-if=!isAllowedToPageSpeed>以下为演示数据，</span> <a ng-if=!isAllowedToPageSpeed ng-href="{{PREFIX_HOST + \'/privilege\'}}" target=_self>如需查看此数据请点击升级账号</a></div><div class="header-menu btn-group"><label class="btn btn-default btn-sm active">腾讯云分析</label></div><div class=summery-body mta-page-speed></div><div class=third-party-not-enabled ng-if="isAllowedToPageSpeed && !isMTAStatisticEnabled" third-party-not-enabled></div></div></div>')
}]), angular.module("spread/tab/statistics/share-statistics.tpl.html", []).run(["$templateCache", function(a) {
	a.put("spread/tab/statistics/share-statistics.tpl.html", '<div class="view-info share-statistics"><div class=date-range date-range=dateRange></div><div class="summery-container fixed-height share-trend"><div class=summery-header><span><i class=eqf-exclaquestion-sign tooltip-html-unsafe="● 场景被分享的总次数以及场景每日分享的趋势<br/>● 其中数说故事提供的分析仅限于微信，且为最近两个月的数据。"></i></span> 分享走势</div><div class=header-tip><span class=btn-demo ng-if=!isAllowedToDataStoryShareTrend>以下为演示数据，</span> <a ng-href="{{PREFIX_HOST + \'/privilege\'}}" ng-if=!isAllowedToDataStoryShareTrend target=_self>如需查看此数据请点击升级账号</a></div><div class="header-menu btn-group"><label class="btn btn-default btn-sm active">数说故事</label></div><div class=summery-body data-story-share-trend></div><div class=third-party-not-enabled ng-if="isAllowedToDataStoryShareTrend && !isDataStoryStatisticEnabled" third-party-not-enabled></div></div><div class="summery-container fixed-height share-channel"><div class=summery-header><span><i class=eqf-exclaquestion-sign tooltip-html-unsafe="● 场景在各渠道被打开的次数及占总打开次数的百分比，为场景推广投放时渠道选择提供参考。<br/>● 微信内来源，指统计PV是来源于微信的哪一部分。<br/>● 访客将场景分享到微信的朋友圈或对话框。"></i></span> 分享渠道</div><div class=header-tip><span class=btn-demo ng-if="!isAllowedToAccessShareStatistic && shareChannelProvider == \'eqxiu\'">以下为演示数据，</span> <a ng-href="{{PREFIX_HOST + \'/privilege\'}}" target=_blank ng-if="!isAllowedToAccessShareStatistic && shareChannelProvider == \'eqxiu\'">如需查看此数据请点击升级账号</a> <span class=btn-demo ng-if="!isAllowedToDataStoryShareTo && shareChannelProvider == \'datastory\'">以下为演示数据，</span> <a ng-href="{{PREFIX_HOST + \'/privilege\'}}" ng-if="!isAllowedToDataStoryShareTo && shareChannelProvider == \'datastory\'" target=_self>如需查看此数据请点击升级账号</a></div><div class="header-menu btn-group"><label class="btn btn-default btn-sm" ng-model=shareChannelProvider btn-radio="\'eqxiu\'">易企秀统计</label><label class="btn btn-default btn-sm" ng-model=shareChannelProvider btn-radio="\'datastory\'">数说故事</label></div><div class=summery-body ng-if="shareChannelProvider == \'eqxiu\'" share-channel=shareChannel></div><div class="summery-body data-story-share-channel" ng-if="shareChannelProvider == \'datastory\'" data-story-share-channel=dataStoryShareInfo.from2count share-to=dataStoryShareInfo.share2count></div><div class=summery-footer ng-if="shareChannelProvider == \'datastory\'"><p class=text-right>该部分数据为场景创建以来的总量，暂不支持按天筛选。</p></div><div class=third-party-not-enabled ng-if="isAllowedToDataStoryShareTo && shareChannelProvider == \'datastory\' && !isDataStoryStatisticEnabled" third-party-not-enabled></div></div><div class="summery-container fixed-height"><div class=summery-header><span><i class=eqf-exclaquestion-sign tooltip="● 一层分享：场景第一次被分享；二层分享：一层分享的场景再次被分享；以此类推。"></i></span> 传播层级</div><div class=header-tip><span class=btn-demo ng-if=!isAllowedToDataStoryShareLevel>以下为演示数据，</span> <a ng-href="{{PREFIX_HOST + \'/privilege\'}}" ng-if=!isAllowedToDataStoryShareLevel target=_self>如需查看此数据请点击升级账号</a></div><div class="header-menu btn-group"><label class="btn btn-default btn-sm active">数说故事</label></div><div class="summery-body data-story-share-level" data-story-share-level=dataStoryShareInfo.shareLevels></div><div class=summery-footer><p class=text-right>该部分数据为场景创建以来的总量，暂不支持按天筛选。</p></div><div class=third-party-not-enabled ng-if="isAllowedToDataStoryShareLevel && !isDataStoryStatisticEnabled" third-party-not-enabled></div></div></div>')
}]), angular.module("spread/tab/statistics/summery.tpl.html", []).run(["$templateCache", function(a) {
	a.put("spread/tab/statistics/summery.tpl.html", '<div class="view-info summery-view-info"><div class=clearfix><div class="summery-info summery-pv"><div class=summery-header>累计访问量 <a ng-click="switchIntoTab(\'accessInfo\')">查看详细 ></a></div><div class=summery-body summery-pv=summeryPVUV></div></div><div class="summery-info fixed-height summery-interactive"><div class=summery-header>累计互动次数 <a ng-click="switchIntoTab(\'interactiveStatistics\')">查看详细 ></a></div><div class=summery-body summery-interactive-short=summeryInteractive></div></div></div><div class="summery-container fixed-height share-channel"><div class=summery-header>分享渠道 <a ng-click="switchIntoTab(\'shareStatistics\')">查看详细 ></a></div><div class=header-tip ng-if=!isAllowedToAccessShareStatistic><span class=btn-demo>以下为演示数据，</span> <a ng-href="{{PREFIX_HOST + \'/privilege\'}}" target=_self>如需查看此数据请点击升级账号</a></div><div class=summery-body share-channel=shareChannel></div></div><div class="summery-container region"><div class=summery-header>地域访问量 <a ng-click="switchIntoTab(\'accessInfo\')">查看详细 ></a></div><div class=summery-body summery-region=summeryRegion></div></div><div class="summery-container fixed-height device"><div class=summery-header>访问设备 <a ng-click="switchIntoTab(\'accessInfo\')">查看详细 ></a></div><div class=header-tip ng-if=!isAllowedToAccessDeviceStatistic><span class=btn-demo>以下为演示数据，</span> <a ng-href="{{PREFIX_HOST + \'/privilege\'}}" target=_self>如需查看此数据请点击升级账号</a></div><div class=summery-body summery-device=summeryDevice top10-device=top10Device></div></div></div>')
}]), angular.module("spread/tab/statistics/text-message-statistics.tpl.html", []).run(["$templateCache", function(a) {
	a.put("spread/tab/statistics/text-message-statistics.tpl.html", '<div class="view-info text-message-statistics"><div class=date-range date-range=dateRange></div><div class=summery-container><div class=summery-header>访问量</div><div class=summery-body text-message-analysis></div></div></div>')
}]), angular.module("spread/tab/statistics/user-statistics.tpl.html", []).run(["$templateCache", function(a) {
	a.put("spread/tab/statistics/user-statistics.tpl.html", '<div class="view-info user-statistics"><div class=date-range date-range=dateRange></div><div class="summery-container fixed-height mta-realtime-user"><div class=summery-header><span><i class=eqf-exclaquestion-sign tooltip="● 访客属性分析，如访问场景的时长、所在地域，新老访客类型，访客进入场景的方式。"></i></span> 实时访客</div><div class=header-tip><span class=btn-demo ng-if=!isAllowedToUserStatistic>以下为演示数据，</span> <a ng-if=!isAllowedToUserStatistic ng-href="{{PREFIX_HOST + \'/privilege\'}}" target=_self>如需查看此数据请点击升级账号</a></div><div class="header-menu btn-group"><label class="btn btn-default btn-sm active">腾讯云分析</label></div><div class=summery-body mta-realtime-user></div><div class=third-party-not-enabled ng-if="isAllowedToUserStatistic && !isMTAStatisticEnabled" third-party-not-enabled></div></div><div class="summery-container mta-user-compare"><div class=summery-header><span><i class=eqf-exclaquestion-sign tooltip="● 第一次来到网站的访客数量与曾经访问过该网站的访客数量。"></i></span> 新老访客比</div><div class=header-tip><span class=btn-demo ng-if=!isAllowedToUserCompare>以下为演示数据，</span> <a ng-if=!isAllowedToUserCompare ng-href="{{PREFIX_HOST + \'/privilege\'}}" target=_self>如需查看此数据请点击升级账号</a></div><div class="header-menu btn-group"><label class="btn btn-default btn-sm active">腾讯云分析</label></div><div class=summery-body mta-user-compare></div><div class=third-party-not-enabled ng-if="isAllowedToUserCompare && !isMTAStatisticEnabled" third-party-not-enabled></div></div><div class="summery-container mta-user-portrait"><div class=summery-header><span><i class=eqf-exclaquestion-sign tooltip-html-unsafe="● 访客的性别比例、年龄分布、学历、职业等信息。<br/>● 有助于为场景制作时提供内容倾向性上的参考。<br/>● 数说故事提供的分析为最近两个月的数据。"></i></span> 访客画像</div><div class=header-tip><span class=btn-demo ng-if="!isAllowedToUserPortrait && userPortraitProvider == \'tencent\'">以下为演示数据，</span> <a ng-if="!isAllowedToUserPortrait && userPortraitProvider == \'tencent\'" ng-href="{{PREFIX_HOST + \'/privilege\'}}" target=_self>如需查看此数据请点击升级账号</a> <span class=btn-demo ng-if="!isAllowedToDataStoryUserPortrait && userPortraitProvider == \'datastory\'">以下为演示数据，</span> <a ng-if="!isAllowedToDataStoryUserPortrait && userPortraitProvider == \'datastory\'" ng-href="{{PREFIX_HOST + \'/privilege\'}}" target=_self>如需查看此数据请点击升级账号</a></div><div class="header-menu btn-group"><label class="btn btn-default btn-sm" ng-model=userPortraitProvider btn-radio="\'tencent\'">腾讯云分析</label><label class="btn btn-default btn-sm" ng-model=userPortraitProvider btn-radio="\'datastory\'">数说故事</label></div><div class=summery-body ng-if="userPortraitProvider == \'tencent\' && (isAllowedToUserPortrait ? isMTAStatisticEnabled : true)" mta-user-portrait></div><div class=summery-body ng-if="userPortraitProvider == \'datastory\'" data-story-user-portrait></div><div class=third-party-not-enabled ng-if="isAllowedToUserPortrait && userPortraitProvider == \'tencent\' && !isMTAStatisticEnabled" third-party-not-enabled></div><div class=third-party-not-enabled ng-if="isAllowedToDataStoryUserPortrait && userPortraitProvider == \'datastory\' && !isDataStoryStatisticEnabled" third-party-not-enabled></div></div></div>')
}]), angular.module("spread/tab/subtab/buy-message.tpl.html", []).run(["$templateCache", function(a) {
	a.put("spread/tab/subtab/buy-message.tpl.html", '<div class=buyMess-box><div class=buyMess-header><button type=button class=close data-dismiss=modal aria-label=Close ng-click=cancel()><span aria-hidden=true>×</span></button><h4 class=modal-title>充值类型选择</h4></div><div class=buyMess-content><div class=select-layout><h6>请选择类型</h6><p>秀点余额<em>{{userXd}}点</em></p><a type=button class="btn btn-primary" ng-click=buyXd()>立即购买</a></div><div class=buy-lay><ul ng-click=showradio()><li ng-repeat="getMessModel in getMessModels"><label><div><p>{{getMessModel.name}}<em></em></p><span>{{getMessModel.price}}秀点</span></div><input type=radio ng-value=getMessModel ng-model="model.layout"> <b ng-show="model.layout == getMessModel"></b></label></li></ul></div><div class=modal-footer><a type=button class="btn btn-primary" ng-click=confirm() data-event=8209>确认</a></div></div></div>')
}]), angular.module("spread/tab/subtab/check-scene.tpl.html", []).run(["$templateCache", function(a) {
	a.put("spread/tab/subtab/check-scene.tpl.html", '<div class=check-scene><div class=clearfix><div class=check-list><h2>场景前置审核</h2><p class=p20>分享前优先进行审核,避免在传播中因内容违规而被关闭造成不必要的损失。每天最多可申请3次,每次间隔1小时。</p><div class="text-center mb20" style=height:33px ng-if=!branchid><a ng-if=checkQian class="btn btn-primary" ng-click="checkScene(\'1\')">前置审核</a> <span ng-if=!checkQian class=text-action>该功能仅企业基础版、企业标准版、企业高级版使用。<a ng-show="!branchid && user.type != 21" class=text-primary href=/privilege target=_blank>立即升级</a></span></div></div><div class=check-list><h2>审核关闭提醒</h2><p class=p20>一旦发现违规，第一时间发送短信提醒，避免造成不必要的经济损失。</p><div class="text-center mb20" style=height:33px ng-if=!branchid><a ng-if=!messageTime ng-click=messageAction() class="btn btn-primary">消息提醒</a> <span ng-if=messageTime>已开通，到期日：{{dataTime | date:\'yyyy-MM-dd\'}}</span></div></div><div class=check-list><h2>驳回加急审核</h2><p class=p20>一旦发现违规被关闭，可申请加急审核，系统会优先处理加急审核内容。每天最多可申请3次。</p><div class="text-center mb20" style=height:33px ng-if=!branchid><a ng-if=checkBo class="btn btn-primary" ng-click="checkScene(\'2\')">驳回加急审核</a> <span ng-if=!checkBo>该功能仅企业收费版、服务商账号使用。<a class=text-primary ng-show="user.type != 21" href=/privilege target=_blank>立即升级</a></span></div></div></div><div class="check-guize mt20 p20"><h1>易企秀场景审核规则</h1><p>1.有奖集赞和关注转发（包括提示分享朋友圈、分享、扫码有礼有惊喜）<br>2.医药、整形、虚假广告（医疗整形类：凡涉及医疗整形的场景，包括产品、技术、整形项目、仪器、医师均属违规场景，请谨记）<br>3.色情、赌博、毒品<br>4.邪教、非法集合、传销<br>5.谣言、社会负面、诈骗<br>6.违反国家政策和法律内容</p><p class="text-center pt20 pb20"><a href="http://bbs.eqxiu.com/forum.php?mod=viewthread&tid=890&extra=page%3D1" target=_blank style=font-size:14px;color:#08a1ef>查看更多审核规则</a></p></div></div>')
}]), angular.module("spread/tab/subtab/domain-bind.tpl.html", []).run(["$templateCache", function(a) {
	a.put("spread/tab/subtab/domain-bind.tpl.html", '<div class="server-contain clearfix"><div class="server-dns server-same"><h3>绑定域名</h3><div class=mt20 ng-show=!isShowBindPanel><div ng-show="status==1"><div class=pass-check><div class=check-icon><span class=eqf-yes></span></div><div class="check-desc domain-bind-success"><p>恭喜您已完成域名绑定申请!</p><p>您绑定的域名为--{{domainInfo.url}}</p><p>AppID(应用ID)--{{domainInfo.appId}}</p><p>AppSecret(应用密钥)--{{domainInfo.secretId}}</p><p>有效期{{domainInfo.applyDate | date:\'yyyy年MM月dd日\'}}-{{domainInfo.endDate | date:\'yyyy年MM月dd日\'}}</p><div class=line></div></div></div></div><div ng-show="status==2"><div class=is-in-check><div class=check-icon><span class=eqf-clock-o></span></div><div class="check-desc domain-bind-success"><span>您申请的绑定域名{{domainInfo.url}}已经提交审核</span><div class=line></div><h4>为了域名绑定服务的正常开通，请您完成以下两项任务：</h4><p>1、请将h5.企业域名.com解析至bind.eqxiu.com <a href="http://bbs.eqxiu.com/forum.php?mod=viewthread&tid=17733" target=_blank>如何解析</a></p><p>2、完善已认证的公众号的业务域名和JS安全接口域名信息<a href="http://bbs.eqxiu.com/forum.php?mod=viewthread&tid=21262&page=1&extra=#pid150657" target=_blank>如何填写</a></p><div class=domain-success-content><span>信息正确填写后，我们将在<em>5个工作日</em>内为您开通服务！如果您提交的信息有误，我们会驳回您的申请信息，并退回秀点！请关注我们推送给您的信息！祝您生活愉快！</span></div></div></div></div><div ng-show="status==3"><div class=is-in-fail><div class=check-icon><span class=eqf-glyphicon-ban></span></div><div class=check-desc><span>您申请的域名{{domainInfo.url}}绑定失败，原因是:{{domainInfo.remark}}。您支付的秀点已返还您的账号。您可以填写正确信息后再次申请。</span></div></div><div class=btn-dns><a class="btn btn-primary background-color-width-change" ng-click=reApply()>重新申请</a></div></div><div ng-show="status==5 ||status == 4"><div class=is-in-fail><div class=check-icon><span class=eqf-fobden2></span></div><div class=check-desc><span>您申请的绑定域名{{domainInfo.url}}已到期</span><div class=line></div><h3>域名已到期，需要重新申请</h3></div></div><div class=btn-dns><a class="btn btn-primary background-color-width-change" style="margin-top: 360px" ng-click=reApply()>重新申请</a></div></div></div><div ng-show=isShowBindPanel><div class="step-bar mt20" ng-init="showController.step=1;"><span class="circle fl" ng-class="{\'fill-color\': showController.step == 1}" ng-click=goStep(1);>1</span> <span class=line></span> <span class="circle circle-center" ng-class="{\'fill-color\': showController.step == 2}" ng-click=goStep(2);>2</span> <span class=line></span> <span class="circle fr" ng-class="{\'fill-color\': showController.step == 3}" ng-click=goStep(3);>3</span></div><div class=step1-container ng-show="showController.step==1;"><span class=mt20>域名绑定通过审核后，绑定后的场景即可以使用新域名进行分享</span> <span>场景网址显示为：申请得绑定域名＋场景编码</span><div class=scene-exp><img src={{CLIENT_CDN}}assets/images/usercenter/beforebind1.png></div><div class="scene-exp new-dom"><img src={{CLIENT_CDN}}assets/images/usercenter/afterbind1.png></div><div class=btn-dns><a class="btn btn-primary btn-small background-color-width-change" ng-click=goStep(showController.step+1)>绑定域名</a></div></div><div class=step2-container ng-show="showController.step==2;"><p class=line-height36><span>声明：</span><br><span>1.申请绑定得域名需要经过工信部网站备案。</span><br><span>2.若域名所属放在使用中违反相关法律法规，易企秀有权随时取消域名绑定。</span><br><span>3.您提供的信息仅会在域名绑定环节中使用。</span><br><span>4.公共账号可免费申请该服务功能。</span> <span class=tip><a class=enable href="http://bbs.eqxiu.com/forum.php?mod=viewthread&tid=16855" target=_blank>查看公共账号申请条件</a></span></p><div class=btn-dns><a class=modal-cancle ng-click=goStep(showController.step-1);>不同意</a> <a class="btn btn-primary background-color-width-change" ng-click=goStep(showController.step+1);>同意</a></div></div><div class=step3-container ng-show="showController.step==3;"><form class="form-horizontal mt20" role=form><div class=form-group><label class="col-sm-2 control-label">域名网址</label><div class="col-sm-7 domain-input-three"><input type=text class="form-control input1" placeholder=h5 autofocus ng-class="{error: domainFormatErr1}" ng-blur=checkDomainFormat(model,domainFormatErr1) ng-init="model.url1 = \'h5\'" dot-check ng-model=model.url1><div class="round-dot1 round-dot">.</div><input type=text class="form-control input2" ng-model=model.url2 placeholder=请输入您的域名 autofocus ng-class="{error: domainFormatErr2}" ng-blur=checkDomainFormat(model,domainFormatErr2) dot-check><div class="round-dot2 round-dot">.</div><input type=text class="form-control input3" placeholder=com autofocus ng-class="{error: domainFormatErr3}" ng-blur="checkDomainFormat(model, model.domainFormatErr3)" ng-model=model.url3 ng-init="model.url3 = \'com\'"></div><div class="col-sm-2 tip"><a href="http://bbs.eqxiu.com/forum.php?mod=viewthread&tid=17747" target=_blank><span class=enable>域名要求</span></a></div></div><div class=form-group ng-init="someVariable = null"><label class="col-sm-2 text-right">选择有效期</label><div class=col-sm-7><div ng-show="userType !=5 && userMemberType != 7 && userMemberType != 8&& userMemberType != 9" class=square style=display:inline-block ng-repeat="type in domainInfo.typeList track by $index" ng-class="{ml20: $index!=0}"><div class=radio-square ng-class="{checked: typeIndex == $index}"><em></em> <input type=radio ng-model=model.day id="\'{{type.value}}\'" ng-value=type ng-change=switchDomainType($index) ng-disabled="status==1 || status == 2"></div><label for="\'{{type.value}}\'">{{type.label}}<span>秀点</span>{{type.value}}<span>天</span></label></div><div ng-show="userType == 5 || userMemberType == 7|| userMemberType == 8 || userMemberType == 9">有效期内免费使用</div></div></div><div class=form-group><label class="control-label col-sm-2">应用ID</label><div class=col-sm-7><input type=text class=form-control autofocus ng-class="{error: domainFormatErr4}" ng-model=model.appId ng-blur=checkDomainFormat(model,domainFormatErr4) placeholder=微信公众号APPID></div><div class="col-sm-2 tip"><a href="http://bbs.eqxiu.com/forum.php?mod=viewthread&tid=17732&extra=" target=_blank><span class=enable>如何获取</span></a></div></div><div class=form-group><label class="control-label col-sm-2">应用密钥</label><div class=col-sm-7><input type=password class=form-control autofocus ng-class="{error: domainFormatErr5}" ng-model=model.secretId ng-blur=checkDomainFormat(model,domainFormatErr5) placeholder=微信公众号APPSECRECT></div><div class="col-sm-3 tip"><a href="http://bbs.eqxiu.com/forum.php?mod=viewthread&tid=17732&extra=" target=_blank><span class=enable>如何获取</span></a></div></div></form><div class=clearfix><div class="operation col-sm-offset-2 text-right"><a href="http://bbs.eqxiu.com/forum.php?mod=viewthread&tid=8604" target=_blank><ins>不会操作？</ins></a></div><div class=btn-dns><a class=modal-cancle ng-click=goStep(showController.step-1)>上一步</a> <button class="btn btn-primary background-color-width-change" ng-click=submit()>提交申请</button></div></div><div ng-show=isOpenTip class=tip-modal><div style="margin: 30px 45px"><span style="font-size: 24px;color:#66666">应用ID和应用密钥是微信公众号得开发者信息</span></div><div><div style="margin:0 45px"><img src={{CLIENT_CDN}}assets/images/usercenter/OR3.png> <span style="margin-left: 10px">绑定域名后，场景可以使用得地址</span></div><div style="margin:45px 45px 20px 45px"><img style=position:absolute src={{CLIENT_CDN}}assets/images/usercenter/OR4.png><p><span>您只需要做以下操作即可实现这样得效果：</span><br><span>1.申请微信公众号</span><br><span>2.将申请得域名网址提交到公众号--js安全域名接口</span><br><span>3.在公众号开发者信息中获取应用ID和应用密钥，并在申请绑定域名时添加它们</span><br><span>4.提交至易企秀审核，并由易企秀提交至工信部备案</span></p></div><div class=btn-dns1 style=text-align:center><a class="btn btn-primary background-color-width-change" ng-click="isOpenTip = false;"><span>确定</span></a></div></div></div><div ng-show=isOpenDomain class=tip-modal style="height: 400px"><div style="margin: 30px 45px"><span style="font-size: 24px;color:#66666">什么是域名</span></div><div><div style="margin:45px 45px 20px 45px"><p style="margin-left: 0">域名级数是指一个域名由多少级组成，域名的各个级别被“.”分开，简而言之，有多少个点就是几级域名。如：eqxiu.com为一级域名，而bbs.eqxiu.com为二级域名。</p></div><div class=btn-dns1 style=text-align:center><a class="btn btn-primary background-color-width-change" ng-click="isOpenDomain = false;"><span>确定</span></a></div></div></div></div></div></div></div>')
}]), angular.module("spread/tab/subtab/expand-web.tpl.html", []).run(["$templateCache", function(a) {
	a.put("spread/tab/subtab/expand-web.tpl.html", '<div class=expandweb-title><span>可以用于不同渠道推广和查看效果</span><div class=fr><a class="btn btn-border background-color-width-change" ng-click=addExpandWeb(expandWebs) ng-show=expandWebs.length><span class=eqf-plus2></span> 添加扩展网址</a> <a class="btn btn-border background-color-width-change" ng-href=/promotion/statistics/{{scene.id}}/expandWebStatistics ng-show=expandWebs.length><span class=eqf-date></span> 查看推广效果</a></div></div><div class=expandweb-area auto-focus-selected><div class="expand-web-option add-web text-center" ng-show="!expandWebs.length && !branchid"><a ng-click=addExpandWeb(expandWebs)><span class=eqf-plus2></span> 添加扩展网址</a></div><div class="expand-web-option expand-web mt20 p20" ng-repeat="expandWeb in expandWebs" switch-input obj=expandWeb><div class="qr-size fl" qr-code-size=80 qr-url="{{selectedUrl + \'?qrc=\' + expandWeb.id}}"></div><div class="expand-name expand-col fl"><div class=title>扩展名称</div><div class=content ng-show=!expandWeb.showinput>{{expandWeb.name}}</div><div ng-show=expandWeb.showinput><input type=text ng-model=expandWeb.name ng-focus=recordName(expandWeb.name) ng-blur=updateName(expandWeb)></div></div><div class="expand-url expand-col fl"><div class=title>扩展网址</div><div class=clearfix><div class="content fl" id=copy-expand-url>{{selectedUrl + \'?qrc=\' + expandWeb.id}}</div><a ng-if=isSafari class="btn btn-border ml20 copy-btn" ng-click="copyUrl(\'copy-expand-url\')"><span class=copy-span><span class=eqf-scene-copy></span> &nbsp;复制链接</span></a> <a ng-if=!isSafari class="btn btn-border ml20 copy-btn" copy-button url="{{selectedUrl + \'?qrc=\' + expandWeb.id}}"><span class=copy-span><span class=eqf-scene-copy url="{{selectedUrl + \'?qrc=\' + expandWeb.id}}" copy-button></span> &nbsp;复制链接</span></a></div></div><div class="expand-ope expand-col fr pr20" ng-show=expandWeb.showinput><eqx-select class="select-sm select-contain mr20" model=qrcode.type change=downloadQrcode(qrcode.type)><eqx-select-option value=null>下载二维码</eqx-select-option><eqx-select-option value=qrcodeObj ng-repeat="qrcodeObj in qrcodeList">{{qrcodeObj.name}}</eqx-select-option></eqx-select><a class=fr ng-click="deleteWeb($index, expandWeb)">删除</a></div><div class=download-area download-canvas><div class=qr-size qr-code-size=256 qr-url="{{selectedUrl + \'?qrc=\' + expandWeb.id}}"></div><div class=qr-size qr-code-size=512 qr-url="{{selectedUrl + \'?qrc=\' + expandWeb.id}}"></div><div class=qr-size qr-code-size=1024 qr-url="{{selectedUrl + \'?qrc=\' + expandWeb.id}}"></div></div></div></div>')
}]), angular.module("spread/tab/subtab/message-customer.tpl.html", []).run(["$templateCache", function(a) {
	a.put("spread/tab/subtab/message-customer.tpl.html", '<div class=customer-list><div class=customer-header><button type=button class=close data-dismiss=modal aria-label=Close ng-click=cancel()><span aria-hidden=true>×</span></button><h4 class=modal-title>客户列表</h4></div><div class=same-content style=box-sizing:border-box;width:760px;min-height:170px><div class="cus-bar clearfix" ng-show="dataShow == \'message\'" style="width:800px;margin-left: -66px;margin-top:20px"><div class=fr><eqx-select class="select-sm select-contain border-width" model=customer.group change=getDataBySceneId(pageNo,branchid,customer.group.id,customer.origin.ID)><eqx-select-option value=null>全部群组</eqx-select-option><eqx-select-option value=mygroup ng-repeat="mygroup in groups">{{mygroup.name}}</eqx-select-option></eqx-select></div></div><div class=cus-table style=padding-bottom:20px><table class="table table-hover customer-data-table"><thead><tr><th ng-if=!hideOpea class="col-sm-2 check-line"><div class="checkbox-square customer-check" ng-class="{checked: allImages.selected}"><em class=eqf-clickmore></em> <input class=check-box type=checkbox ng-change=selectAll() ng-model=allImages.selected name=iCheck></div></th><th class=col-sm-3>姓名</th><th class=col-sm-3>手机</th><th class=col-sm-4>客户群组</th></tr></thead><tbody ng-show="dataShow == \'message\' && customerDatas.length"><tr ng-repeat="customerData in customerDatas"><td ng-if=!hideOpea class="check-line col-sm-2"><div class=checkbox-square ng-class="{checked: customerData.selected}"><em class=eqf-clickmore></em> <input type=checkbox ng-model=customerData.selected name=iCheck ng-change=selectCustomer(customerData)></div></td><td class=col-sm-3>{{customerData.name}}</td><td class=col-sm-3>{{customerData.mobile}}</td><td class=col-sm-3>{{customerData.groupName}}</td></tr></tbody></table></div><div ng-show="totalItems > 10" class=clearfix><pagination style="float: left" first-text=首页 last-text=尾页 previous-text=&lsaquo; next-text=&rsaquo; max-size=10 items-per-page=10 total-items=totalItems ng-model=model.currentPage ng-change=pageChanged(model.currentPage,branchid,customer.group.id,customer.origin.ID) boundary-links=true rotate=true num-pages=numPages></pagination><div class=current_page><span class=fl>到</span> <input type=text ng-model=model.toPage ng-keyup="$event.keyCode == 13 ? pageChanged(model.toPage,branchid,customer.group.id,customer.origin.ID) : null"><span class=fl>页</span> <a ng-click=pageChanged(model.toPage,branchid,customer.group.id,customer.origin.ID) class=go>确定</a></div></div><a class="btn btn-primary" ng-click=confirm(); style="position: absolute;left:714px;bottom:20px">确定</a></div></div>');
}]), angular.module("spread/tab/subtab/message-detail.tpl.html", []).run(["$templateCache", function(a) {
	a.put("spread/tab/subtab/message-detail.tpl.html", '<div class="cus-table message-detail"><div class=message-detail-header><button type=button class=close data-dismiss=modal aria-label=Close ng-click=cancel()><span aria-hidden=true>×</span></button><h4 class=modal-title>已发送短信详情</h4></div><table class="table table-hover customer-data-table"><thead><tr><th class=col-sm-4>姓名</th><th class=col-sm-4>手机号</th><th class=col-sm-3>发送状态</th></tr></thead><tbody><tr ng-repeat="sendDetail in sendDetails"><td class=col-sm-4>{{sendDetail.name}}</td><td class=col-sm-4>{{sendDetail.phone}}</td><td ng-show="sendDetail.status==1" class=col-sm-3>已送达</td><td ng-show="sendDetail.status==0" class=col-sm-3>未送达</td></tr></tbody></table></div><div ng-show="detailTotal > 10" class=clearfix style="margin-bottom:10px;margin-left: 20px"><pagination style="float: left" first-text=首页 last-text=尾页 previous-text=&lsaquo; next-text=&rsaquo; max-size=10 items-per-page=10 total-items=detailTotal ng-model=model.DetailPage ng-change=DetailChangePage(msgid,model.DetailPage) boundary-links=true rotate=true num-pages=numPages></pagination><div class=current_page><span class=fl>到</span> <input type=text ng-model=model.detailPage ng-keyup="$event.keyCode == 13 ? DetailChangePage(msgid,model.detailPage) : null"><span class=fl>页</span> <a ng-click=DetailChangePage(msgid,model.detailPage) class=go>确定</a></div></div>')
}]), angular.module("spread/tab/subtab/message-post.tpl.html", []).run(["$templateCache", function(a) {
	a.put("spread/tab/subtab/message-post.tpl.html", '<div class=message-post><div class=message-bg><div class=msg-contain><div class=phone-menu>短信推送</div><div class=message-select><form name=formName role=form><div class=form-group><div class=select-contain style="position: relative;margin-bottom:15px"><div><ui-select multiple tagging=tagTransform ng-model=obj.selectedPeople theme=bootstrap title=收件人><ui-select-match placeholder=收件人 style=line-height:15px>{{$item.name}}</ui-select-match><ui-select-choices repeat="person in people | propsFilter: {name: $select.search}"><div ng-if=person.isTag ng-bind-html="person.name +\'\'| highlight: $select.search"></div></ui-select-choices></ui-select></div><button class="btn green add-customer-button"><a ng-click=getDataBySceneId()>+</a></button></div></div><div class=form-group><div class=message-content-overflow><div class=msg-row><eqx-select class="customer-edit border-width select-contain select-great" model=model.messageContent ng-init="model.messageContent=null" data-event=8210><eqx-select-option value=null>请选择短信模板</eqx-select-option><eqx-select-option value=messageContent ng-repeat="messageContent in messageContents">{{messageContent.content}}</eqx-select-option></eqx-select><a class="btn blue msg-btn" ng-click=sendSettingMsg() role=button data-event=8211>自定义短信</a></div></div></div></form></div><textarea ng-disabled=!msgsetting placeholder=自定义短信需运营商审核，大约5-30分钟发送成功，请勿输入违法内容，以免发送失败。 class=msg-description id=msg-description ng-model=model.settingContent maxlength=54></textarea><button class="btn msg-send green" ng-click=sendMess()>发送</button></div></div><div class="row message-warn"><div class="col-sm-6 account-for-msg"><h5>短信推送资费说明</h5><p>发送一个手机号视为一条短信，10秀点可发送100条短信，90秀点可发送1000条短信，150秀点可发送2000条短信，300秀点可发送5000条短信。</p></div><div class=col-sm-6><div class=warn-count><p>可发送短信数：{{messageNumber}}</p><p>将消耗短信数：{{useMessNum}}</p><a class="btn green" ng-click=buyMess()>充值</a></div></div></div><div class=message-customer-box><h5>已发送短信列表</h5><div ng-if="sendMessTotal == 0">还没有短信推送过，快去试试吧！</div><div ng-if="sendMessTotal != 0"><div class="row msg-customer-title"><div class=col-sm-3>发送时间</div><div class=col-sm-5>发送数量</div><div class=col-sm-2>发送状态</div><div class=col-sm-2></div></div><div class=message-customer-contain ng-repeat="sendTatolDetail in sendTatolDetails"><div class="row msg-contain"><div class="col-sm-3 contain-title">{{sendTatolDetail.createTime |date:"yyyy/MM/dd HH:mm:ss"}}</div><div class="col-sm-5 contain-title">{{sendTatolDetail.msgCount}}</div><div ng-show="sendTatolDetail.success==1" class="col-sm-2 contain-title">发送成功</div><div ng-show="sendTatolDetail.success==0" class="col-sm-2 contain-title">发送失败</div><div ng-if=!openFlg class="col-sm-2 contain-title"><div class=open-info ng-click=sendDetail(sendTatolDetail.id,1)></div></div><div ng-if="openFlg && msgid == sendTatolDetail.id" class="col-sm-2 contain-title"><div class=close-info ng-click=closeUsers()></div></div><div class="col-sm-10 contain-info">{{sendTatolDetail.msgContent}}</div></div><div ng-if="openFlg && msgid == sendTatolDetail.id" class=customer-info><div ng-repeat="sendDetail in sendDetails"><div class=row><div class=col-sm-3>{{sendDetail.name}}</div><div class=col-sm-5>{{sendDetail.phone}}</div><div class=col-sm-2 ng-show="sendDetail.status==1">已发送</div><div class=col-sm-2 ng-show="sendDetail.status==0">发送失败</div></div></div><div ng-show="detailTotal > 10" class=clearfix style="margin-bottom:10px;margin-left: 20px"><pagination style="float: left" first-text=首页 last-text=尾页 previous-text=&lsaquo; next-text=&rsaquo; max-size=10 items-per-page=10 total-items=detailTotal ng-model=model.detailPage ng-change=usersDetailChangePage(msgid,model.detailPage) boundary-links=true rotate=true num-pages=numPages></pagination><div class=current_page><span class=fl>到</span> <input type=text ng-model=model.detailPage ng-keyup="$event.keyCode == 13 ? usersDetailChangePage(msgid,model.detailPage) : null"><span class=fl>页</span> <a ng-click=usersDetailChangePage(msgid,model.detailPage) class=go>确定</a></div></div></div></div></div><div ng-show="sendMessTotal > 10" class=clearfix><pagination style="float: left" first-text=首页 last-text=尾页 previous-text=&lsaquo; next-text=&rsaquo; max-size=10 items-per-page=10 total-items=sendMessTotal ng-model=model.sendDetailPage ng-change=sendDetailChangePage(model.sendDetailPage) boundary-links=true rotate=true num-pages=numPages></pagination><div class=current_page><span class=fl>到</span> <input type=text ng-model=model.messPage ng-keyup="$event.keyCode == 13 ? sendDetailChangePage(model.messPage) : null"><span class=fl>页</span> <a ng-click=sendDetailChangePage(model.messPage) class=go>确定</a></div></div></div></div><show-loading ng-if=loadingShow></show-loading>')
}]), angular.module("spread/tab/subtab/other-service-apply.tpl.html", []).run(["$templateCache", function(a) {
	a.put("spread/tab/subtab/other-service-apply.tpl.html", '<div ng-if="setMessageFlg == \'messageMenu\'" style="height: 256px"><div class=p20><span>服务应用</span> <button type=button class=close data-dismiss=modal aria-label=Close ng-click=cancel()><span aria-hidden=true>×</span></button></div><div class=service-type><button class="btn service-btn" ng-click="openServiceMessage(\'postMessage\')">发短信</button> <button class="btn service-btn" ng-click="openServiceMessage(\'meetingHelper\')">会议助手</button></div></div><div ng-if="setMessageFlg == \'postMessage\'" class="data-message p20"><div id=msg class="linkMan fl mr20"><h5 class=mb20>请选择短信收件人</h5><div class="data mb20"><div class=telephone-list><table class="table table-condensed telephone-table"><thead><tr><th class=header-first><div class="square table-checkbox"><div class=checkbox-square ng-class="{checked: allChecked.checked}"><em class=eqf-yes2></em> <input type=checkbox ng-model=allChecked.checked ng-change="checkAll()"></div></div></th><th class=data_header>联系人</th><th class=data_header>手机</th></tr></thead></table><div style="height: 400px" ng-if=tableShow><div eqd-scroll style="height: 100%" change-pos=changePos(pos) disable-mouse=true prevent-exception=true><table class="table table-condensed telephone-table"><tbody><tr ng-repeat="data in dataServiceList" ng-if=data.colTel><td class=header-first><div class="square table-checkbox"><div class=checkbox-square ng-class="{checked: data.checked}"><em class=eqf-yes2></em> <input type=checkbox ng-model=data.checked ng-change="checkData(data)"></div></div></td><td class=data_header>{{data.colName}}</td><td class=data_header>{{data.colTel}}</td></tr></tbody></table></div></div><div ng-if=!tableShow style="padding-left: 110px; padding-top: 100px">暂无数据</div></div></div></div><div class="push-area fl"><a ng-click=pushTelInfo()><em class=eqf-more2></em></a></div><div class="linkMan fl"><h5 class=mb20>短信收件人</h5><div class="data mb20"><div class=telephone-list><table class="table table-condensed telephone-table"><thead><tr><th class=data_header>联系人</th><th class=data_header>手机</th><th class=header-first></th></tr></thead></table><div style="height: 400px" ng-if=tableShow><div eqd-scroll style="height: 100%" change-pos=changePos(pos) disable-mouse=true prevent-exception=true><table class="table table-condensed telephone-table"><tbody><tr ng-repeat="data in obj.telsList"><td class=data_header>{{data.colName}}</td><td class=data_header>{{data.colTel}}</td><td class=header-first><a ng-click=deleteData($index)><em class=eqf-wrong></em></a></td></tr></tbody></table></div></div></div></div></div><div class="fr pt20"><a class=modal-cancle ng-click="close(\'messageMenu\')">取消</a> <a class="btn btn-primary" style="width: 100px" ng-click=confirm()>确定</a></div></div><div ng-if="setMessageFlg == \'meetingHelper\'" style="height: 256px"><div class=p20><span>会议助手</span> <button type=button class=close data-dismiss=modal aria-label=Close ng-click="openServiceMessage(\'messageMenu\')"><span aria-hidden=true>×</span></button></div><div class=p20 style="font-size: 36px; margin-left: 275px">敬请期待......</div></div>')
}]), angular.module("spread/tab/subtab/site-import.tpl.html", []).run(["$templateCache", function(a) {
	a.put("spread/tab/subtab/site-import.tpl.html", '<div><div class=site-import-area ng-repeat="contentText in contentTexts track by $index"><div class="site-import-title pb20">{{contentText.title}}</div><div class="site-import-col code-col"><div class=code-area><div class=code-con><div>&lt;iframe border=0 width=320px height=641px&nbsp;</div><div class=mid-con>src="{{selectedUrl}}"&gt;</div><div>&lt;/iframe&gt;</div></div><div class="copy-link fr"><a ng-if=isSafari class="btn btn-border" ng-click=copyUrl()><span class=eqf-scene-copy></span> 复制代码</a> <a ng-if=!isSafari class="btn btn-border" copy-button url={{contentText.url}}><span class=eqf-scene-copy></span> 复制代码</a></div></div></div><div class="site-import-col des-col"><div class="des-area fr"><div>{{contentText.textOne}}</div><div class=mid-con>{{contentText.textTwo}}</div><div class=mid-con>{{contentText.textThree}}</div></div></div></div></div>')
}]), angular.module("spread/tab/subtab/social-share.tpl.html", []).run(["$templateCache", function(a) {
	a.put("spread/tab/subtab/social-share.tpl.html", '<div class=share-header><span class="title share-tab-title">社交渠道分享</span> </div><div class=qrcode-area><div class="share-qrcode fl"><div class=qr-size qr-code-size=160 qr-url={{previewUrl}} ng-if="scene.staticStatus !== 1"></div><div class=qr-size qr-code-size=160 qr-url={{urlVip}} ng-if="scene.staticStatus === 1"></div><div class=qrcode-select><p>下载二维码</p><a class="btn btn-border background-color-width-change mr20" ng-click=downloadQrcode(qrcodeObj) ng-repeat="qrcodeObj in qrcodeList"><span class=eqf-download2></span> &nbsp;{{qrcodeObj.name}}</a></div></div><ul class=bdsharebuttons><li><a ng-href={{sinaurl}} target=_blank data-event=8202><img ng-src="{{CLIENT_CDN}}assets/images/weibo.jpg"></a></li><li><a ng-href={{qqurl}} target=_blank data-event=8203><img ng-src="{{CLIENT_CDN}}assets/images/qq.jpg"></a></li><li><a ng-href={{qqzoneurl}} target=_blank data-event=8204><img ng-src="{{CLIENT_CDN}}assets/images/qqzone.jpg"></a></li></ul><div class=download-area download-canvas ng-if="scene.staticStatus !== 1"><div class=qr-size qr-code-size=256 qr-url={{previewUrl}}></div><div class=qr-size qr-code-size=512 qr-url={{previewUrl}}></div><div class=qr-size qr-code-size=1024 qr-url={{previewUrl}}></div></div><div class=download-area download-canvas ng-if="scene.staticStatus === 1"><div class=qr-size qr-code-size=256 qr-url={{urlVip}}></div><div class=qr-size qr-code-size=512 qr-url={{urlVip}}></div><div class=qr-size qr-code-size=1024 qr-url={{urlVip}}></div></div></div><ul class="nav nav-pills no-border overscanwx"><li class=share-title>扫一扫分享到微信</li></ul><div class=url-share><span>复制链接分享</span><div class=url-input><label type=text id=copy-social-url class=form-control>{{previewUrl}}</label><a ng-if=isSafari class="btn btn-border ml20 copy-btn" ng-click="copyUrl(\'copy-social-url\')"><span class=copy-span><span class=eqf-scene-copy copy-button></span> &nbsp;复制链接</span></a> <a ng-if=!isSafari class="btn btn-border ml20 copy-btn" copy-button url={{previewUrl}}><span class=copy-span><span class=eqf-scene-copy copy-button></span> &nbsp;复制链接</span></a></div></div><div ng-class="{showin: $parent.showApplyTip}" class="showxiu show-pos" style="box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5)"><div class=modal-header><button type=button class=close data-dismiss=modal aria-label=Close ng-click=closeActivityModal();><span aria-hidden=true>×</span></button><h4 class=modal-title>参加活动</h4></div><div class=modal-body><p style="line-height: 30px">参加活动后，不可取消或选择其他活动。</p></div><div class=modal-footer><input type=checkbox style=margin-top:0;margin-right:5px ng-model=hideApplyTip ng-init="hideApplyTip=true;"><span style=margin-right:10px>不再提示</span> <a type=button class="btn btn-primary" ng-click="switchApplyActivityTip(true, 3, obj.selectedActivity.sceneId, obj.selectedActivity.id, hideApplyTip);$parent.showApplyTip=false;">确定</a></div></div>')
}]), angular.module("spread/tab/subtab/thirdweb.tpl.html", []).run(["$templateCache", function(a) {
	a.put("spread/tab/subtab/thirdweb.tpl.html", '<div class=pro-third-web><div class=third-web-header><p class=third-web-title>投放方案选择</p><div class=pl250><a class="btn third-web-btn" ng-class="{thirdActive: schemeFlg == \'humanSea\'}" ng-click="tabChange(\'humanSea\')">人海战术</a> <a class="btn third-web-btn" ng-class="{thirdActive: schemeFlg == \'directPush\'}" ng-click="tabChange(\'directPush\')" data-event=8208>网红直推</a></div></div><div class=third-web-bingjun ng-if="schemeFlg == \'humanSea\'"><div class="order-info pl250"><div class="numbers p20"><p class=bingjun-title>投放人数</p><input class=input-fans type=text value={{perPrice}}元/人 ng-readonly="true"> <span style="font-size: 16px">&times;</span> <a class="btn btn-plus" ng-click=minusFans()>-</a> <input class=input-fans type=text value="{{fansCount | number}}" ng-readonly="true"> <a class="btn btn-plus" ng-click=addFans()>+</a></div><div class="bingjun-left p20"><p>订单金额</p><p class=bingjun-cost><span style="font-size: 14px">&yen;</span>{{orderPrice}}</p></div></div><div class="bingjun-subtotal mt20"><span class="bingjun-msg pl250">按照广告覆盖人数收费，人数不同价格会有所不同。</span></div><div class="confirm-order pl250"><a class="btn btn-order green" ng-click=confirmOrder() data-event=8207>确认下单</a></div></div><ul class="clearfix thirdweb" ng-if="schemeFlg == \'directPush\'" style="padding-left: 124px"><li><a ng-click=confirmOrder()><img ng-src={{CLIENT_CDN}}promotion/assets/images/spread3.png data-event="820801"></a><div class=bg></div></li><li><a href="http://www.myunmei.com/?hmsr=YQX" target=_blank><img ng-src={{CLIENT_CDN}}promotion/assets/images/spread4.png data-event="820802"></a><div class=bg></div></li><li><a href="http://www.muqian.com/" target=_blank><img ng-src={{CLIENT_CDN}}promotion/assets/images/spread1.jpg data-event="820803"></a><div class=bg></div></li></ul></div>')
}]), angular.module("sysmessage.tpl.html", []).run(["$templateCache", function(a) {
	a.put("sysmessage.tpl.html", '<div class="sys-contain myMove" ng-if="!!sysMsgs.length && openSysMsgDialog"><div class="same-content sys-msg"><div class=sys-msg-container ng-class="{\'is-closed\': !openSysMsg}"><ul class=messages><li class=message ng-repeat-start="sysMsg in sysMsgs"><span>{{($index + 1) + "."}}</span><span ng-bind-html=sysMsg.content></span></li><li class=separator ng-if=!$last ng-repeat-end></li></ul></div><a class="eqf-wrong msg-close" ng-click=closeSysMsgDialog()></a></div></div>')
}]), angular.module("test/test-scene.tpl.html", []).run(["$templateCache", function(a) {
	a.put("test/test-scene.tpl.html", '<div class=error><div class=header><div class=content><div class=logo><a href=/home target=_blank><img ng-src={{CLIENT_CDN}}assets/images/logoo.png alt=""></a></div></div></div><div class=error_contain><div class=error_con><img ng-src={{CLIENT_CDN}}assets/images/404_03.png alt=""><p style="font-size:24px;margin-top:30px;margin-bottom:15px;padding:0 10px">对不起，您想要进入的页面已经去火星了！</p></div></div></div><div ng-include="\'footer.tpl.html\'"></div>')
}]), angular.module("test/test.tpl.html", []).run(["$templateCache", function(a) {
	a.put("test/test.tpl.html", '<div id=home><div class="summery clearfix"><div class="region col-sm-4"><h2>访问地域Top 5</h2><div style="width: 320px;height: 320px" region-summery-analysis-test></div></div><div class="device col-sm-4"><h2>设备统计概览</h2><div style="width: 320px;height: 320px" device-summery-analysis-test></div></div><div class="interactive col-sm-4"><h2>互动统计概况</h2><div style="width: 320px;height: 320px" interactive-summery-analysis-test></div></div></div><div class=view><h2>展示次数</h2><div style="width: 600px;height: 320px" view-analysis-test></div></div><div class=interactive><h2>互动统计</h2><div style="width: 1000px;height: 320px" interactive-analysis-test></div></div><div class=channel><h2>渠道统计</h2><div style="width: 1000px;height: 320px" channel-analysis-test></div></div><div class=region><h2>地域统计</h2><div style="width: 1000px;height: 620px" region-analysis-test></div></div></div><div ng-include="\'footer.tpl.html\'"></div>')
}]), angular.module("usercenter/buyXd.tpl.html", []).run(["$templateCache", function(a) {
	a.put("usercenter/buyXd.tpl.html", '<div class=modal-body><button type=button class=close data-dismiss=modal aria-label=Close ng-click=cancel()><span aria-hidden=true>×</span></button><div class=confirm-msg><h4 class=text-left>尊敬的易企秀用户</h4><p class="mt20 text-left ml20 mr20" style="line-height: 1.5em">感谢您对易企秀的支持，您即将购买500个秀点。购买、发票等相关问题，请<a class=text-primary target=_blank href="http://bbs.eqxiu.com/forum.php?mod=viewthread&tid=12324">查看详情</a>。<br>1.暂仅支持一次购买500秀点，费用500元；<br>2.包年购买、优惠购买，请先<a class=text-primary href=/privilege target=_blank>升级企业账号</a>；<br>3.购买需要发票的，请联系fapiao@eqxiu.com；</p></div></div><div class="text-right pb20 btn-small"><a class="btn btn-primary mr20" ng-click=confirm()>立即购买</a></div>')
}]), angular.module("usercenter/console/checkMobile.tpl.html", []).run(["$templateCache", function(a) {
	a.put("usercenter/console/checkMobile.tpl.html", '<div class=modal-header><button type=button class=close data-dismiss=modal aria-label=Close ng-click=cancel()><span aria-hidden=true>×</span></button><h4 class=modal-title>{{title}}</h4></div><div class=modal-body><form class=form-horizontal><div class=form-group><label class="control-label col-sm-3">手机号</label><div class=col-sm-7><input class=form-control type=text ng-model=userinfo.phone ng-blur=checkMobile(); placeholder="请输入手机号"><p class=error ng-show=mobileError>{{mobileError}}</p></div></div><div class=form-group><div class=clearfix><label class="control-label col-sm-3">验证码</label><div class=col-sm-5><input style=text-align:left type=text class=form-control maxlength=12 ng-model=userinfo.code ng-blur=checkCode() placeholder="请输入验证码"></div><div class="col-sm-2 tip" ng-show=!isCodeAccessiable><a ng-click=showImageCode() id=submit-button><span class=enable>获取验证码</span></a></div><div class="col-sm-2 tip" ng-show=isCodeAccessiable><a><span class=disable>{{codeTip}}</span></a></div></div><p style=padding-left:27% class=error ng-show=codeError>{{codeError}}</p></div><div class="textbox-wrap validate clearfix mb20"><div><script load-script ng-src={{validateCodeUrl}}></script></div><div id=captcha-box></div></div><div class="pt20 border-dashed"></div><div class=text-center style=padding-bottom:10px;font-size:12px;color:#a3afb7>为保障用户账号安全,您需要填写当前登录账号密码</div><div class=form-group><label for=inputPass class="control-label col-sm-3">密码</label><div class=col-sm-7><input id=inputPass type=password class=form-control maxlength=16 ng-model=userinfo.password placeholder="请输入当前账号密码"><p class=error ng-show=relErr>{{relErr}}</p></div></div></form></div><div class=modal-footer><a class=modal-cancle ng-click=cancel()>取消</a> <button type=button class="btn btn-primary" ng-click=relAccount() data-event=7216>确定</button></div>')
}]), angular.module("usercenter/payment.tpl.html", []).run(["$templateCache", function(a) {
	a.put("usercenter/payment.tpl.html", '<div class=modal-header><button type=button class=close data-dismiss=modal aria-label=Close ng-click=cancel()><span aria-hidden=true>×</span></button><h4 class=modal-title>请选择喜欢的支付方式进行支付</h4></div><div><ul class="nav nav-bg"><li ng-class="{active:payWay==\'alipay\'}"><a ng-click="getWeChatUrl(\'alipay\');">支付宝</a></li><li ng-class="{active:payWay==\'wechat\'}"><a ng-click="getWeChatUrl(\'wechat\');" ng-hide="type==3 || money === 6800 || money === 15600 ">微信</a></li><li ng-class="{active:payWay==\'remit\'}"><a ng-click="getWeChatUrl(\'remit\');">汇款支付</a></li><li ng-class="{active:payWay==\'unionpay\'}"><a ng-click="getWeChatUrl(\'unionpay\');">银联支付</a></li></ul><div class=tab-content><div class=tab-pane ng-class="{active:payWay==\'alipay\'}"><h4 class="text-center mt20">扫码支付</h4><h3 class=text-center style=color:red;margin-top:15px>{{money}}元</h3><div class="qrcode text-center" style="width:100%;padding:12px 0" qr-code qr-url={{qrCodeUrl}}></div></div><div class=tab-pane ng-class="{active:payWay==\'wechat\'}"><h4 class="text-center mt20">扫码支付</h4><h3 class=text-center style=color:red;margin-top:15px>{{money}}元</h3><div class="qrcode text-center" style="width:100%;padding:12px 0" qr-code qr-url={{qrCodeUrl}}></div></div><div class=tab-pane ng-class="{active:payWay==\'remit\'}"><h4 class="text-center mt20">需支付</h4><h3 class=text-center style=color:red;margin-top:15px>{{money}}元</h3><div class="remit-contain p20"><p>对公支付请按照下列步骤进行：</p><p style=padding-top:15px>步骤1：打款<br>公司名称：北京中网易企秀科技有限公司<br>开户行全称：中国工商银行股份有限公司北京海淀支行<br>银行账号：0200049609201083655</p><p style=padding-top:15px><span class=action>重要说明！！！</span><br>步骤2：发邮件到fapiao@eqxiu.com,以便易企秀更快捷给你提供相关服务。邮件内容如下：<br>购买项目：（秀点，企业体验版，企业基础版，企业标准版，企业高级版等）<br>购买金额，购买数量，易企秀账号，联系电话。</p></div></div><div class=tab-pane ng-class="{active:payWay==\'unionpay\'}" ng-init="paying = true;"><div ng-show=paying><h4 class="text-center mt20">需支付</h4><h3 class=text-center style=color:red;margin-top:15px;margin-bottom:20px>{{money}}元</h3><div style="text-align:center;margin-bottom:20px;width: 180px;position: relative;margin-left: -90px;left:50%" ng-show="counts.length>0 && payWay==\'unionpay\'"><eqx-select class="select-great select-contain border-width" model=count ng-init="count = counts[0]" change=setCount(count.value,$index)><eqx-select-option value=count ng-repeat="count in counts track by $index">{{count.name}}</eqx-select-option></eqx-select></div><div class=text-center style=padding-bottom:20px><a ng-click="paying = false" ng-href="{{PREFIX_SERVER_HOST + \'m/u/union/pay?goodsId=\' + type + \'&amount=\' + curentCount}}" target=_blank>立即支付</a></div></div><div ng-show=!paying class="p20 text-center"><p>请在新开启的支付页面中完成支付后，点击完成支付按钮关闭对话框。<br>未完成支付，可点击重新支付按钮再次进行支付</p><p style=margin-top:20px><a class="btn btn-primary" ng-href="{{PREFIX_SERVER_HOST + \'m/u/union/pay?goodsId=\' + type + \'&amount=\' + curentCount}}" target=_blank>重新支付</a></p></div></div></div><div style="text-align:center;margin-bottom:20px;width: 180px;position: relative;margin-left: -90px;left:50%" ng-show="counts.length>0 && payWay!=\'unionpay\'"><eqx-select class="select-great select-contain border-width" model=count ng-init="count = counts[0]" change=setCount(count.value,$index)><eqx-select-option value=count ng-repeat="count in counts track by $index">{{count.name}}</eqx-select-option></eqx-select></div><div ng-show="payWay==\'alipay\'" style=padding-bottom:10px class=text-center><a ng-href="{{PREFIX_SERVER_HOST +\'m/u/alipay/direct?goodsId=\' + type + \'&amount=\' + curentCount+ \'&goodsType=\' + goodsType}}" target=_blank>支付宝网页支付</a></div></div><div class="modal-footer pay-invoice"><a class="btn btn-primary fr" ng-click=paymented()>完成支付</a> <a ng-click=invoiceNotice()>发票须知</a></div>')
}]), angular.module("usercenter/paymentxd.tpl.html", []).run(["$templateCache", function(a) {
	a.put("usercenter/paymentxd.tpl.html", '<div class=modal-header><button type=button class=close data-dismiss=modal aria-label=Close ng-click=cancel()><span aria-hidden=true>×</span></button><h4 class=modal-title>请使用微信扫一扫二维码进行</h4></div><div class=modal-body><div class=qrcode style=width:100% qr-code qr-url={{qrCodeUrl}}></div></div><div class=modal-footer><a class="btn btn-primary" ng-click=paymented()>完成支付</a></div>')
}]), angular.module("usercenter/request_reg.tpl.html", []).run(["$templateCache", function(a) {
	a.put("usercenter/request_reg.tpl.html", "<div class=request_reg><div class=close ng-click=cancel()>x</div><div class=erwei qr-code qr-url=\"{{PREFIX_CLIENT_HOST + '/m/#/wxLogin?id=' + currentUser.id}}\"></div></div>")
}]), angular.module("usercenter/tab/privilege.tpl.html", []).run(["$templateCache", function(a) {
	a.put("usercenter/tab/privilege.tpl.html", '<div ng-if=user ng-include="\'header.tpl.html\'"></div><div class=pri-nav ng-if=!user id=home><header style=background-color:#fff;width:100%;height:60px><div class="we_nav content_center"><div class=link_list><ul class=clearfix><li><a class=background-color-width-change target=_blank href=#/show/visitor>场景定制</a></li><li><a class=background-color-width-change target=_blank href=#/show>秀场</a></li><li ng-class="{isActive: isActive == \'privilege\'}"><a class=background-color-width-change href=#/privilege>会员特权</a></li><li><a class=background-color-width-change href="http://bbs.eqxiu.com/" target=_blank>帮助中心</a></li><li class=login ng-hide=isAuthenticated()><a class=background-color-width-change ng-click=openLogin()>登录</a></li><li ng-hide=isAuthenticated() class=register><a class=background-color-width-change ng-click=openRegister() id=registerFormBtn>注册</a></li><li ng-show=isAuthenticated()><a class=background-color-width-change href=#/main>进入</a></li></ul></div><div id=logo><a href=/home><img ng-src={{logoSrc}}></a></div></div></header></div><div class=privilege-contain><div class=info><div class=versions><div class=my-head></div><div class=content-v><div class=eqf-top-contact></div><div class=des><h2 class=text-left style=padding-bottom:5px>个人会员</h2><h5>提供丰富的素材和模板</h5><h5>助力快速完成创作</h5></div></div><div class=btn-contain><a class="btn btn-primary" ng-if=!user ng-click="openRegister(\'user\',null)">立即注册</a></div></div><div class="versions ml20"><div class=company-head></div><div class=content-v><div class=eqf-huangguan></div><div class=des><h2 class=text-left style=padding-bottom:5px>企业会员</h2><h5>在丰富的素材和模板的基础上</h5><h5>提供全面便捷的推广渠道</h5><h5>助力企业自我营销和宣传</h5></div></div><div class=btn-contain><a class="btn btn-primary" ng-if=!user ng-click="openRegister(\'company\',\'1\')">立即注册</a> <a class="btn btn-primary" ng-if="user && user.type==1" ng-click=upgradeCompany()>免费升级</a></div></div></div><div class=detail-con><table class="table table-bordered detail tab-box-shadow"><tr class=thead><td colspan=2 style="background-color: #08a1ef;border:none"></td><td colspan=2 style="background-color: #76838f;border:none"></td><td colspan=4 style="background-color: #f2a653;border:none"></td></tr><tr><td colspan=2 class=no-lborder style=width:460px;height:70px>服务内容</td><td colspan=2 style=width:240px>免费版</td><td colspan=4 style=width:480px;font-size:12px class=no-rborder>付费版<a class=pl20 href="http://bbs.eqxiu.com/forum.php?mod=viewthread&tid=12324" target=_blank><ins>购买前必读</ins></a></td></tr><tr class=user><td colspan=2 style=padding-top:0 class=no-lborder></td><td class=normarl><i class=eqf-nomarluser></i>个人会员</td><td class=free-com><i class=eqf-companyuser></i>免费企业会员</td><td class=exp-com><i class=eqf-companyuser></i>企业体验版</td><td class=sen-com><i class=eqf-companyuser></i>企业基础版</td><td class=imag-com><i class=eqf-companyuser></i>企业标准版</td><td class="no-rborder pro-com"><i class=eqf-companyuser></i>企业高级版</td></tr><tr><td rowspan=2 class=no-lborder>近期活动</td><td class="bg1 ltd">购买会员赠送秀点</td><td class="bg2 eqf-wrong"></td><td class="bg1 eqf-wrong"></td><td class="bg2 title1" style="background-color: #eff2f4">100点</td><td class="bg1 eqf-wrong"></td><td class="bg2 eqf-wrong"></td><td class="bg1 no-rborder eqf-wrong"></td></tr><tr><td class=ltd>赠送免费购买收费样例次数</td><td class="bg1 eqf-wrong"></td><td class=eqf-wrong></td><td class="bg1 eqf-wrong"></td><td class="">送15次</td><td class=bg1>送25次</td><td class=no-rborder>送60次</td></tr><tr><td rowspan=4 class=no-lborder>平台标识</td><td class="bg1 ltd">使用技术支持底标(15秀点/个)</td><td class=bg2>全价</td><td class=bg1>免费</td><td class=bg2>免费</td><td class=bg1>免费</td><td class=bg2>免费</td><td class="bg1 no-rborder">免费</td></tr><tr><td class=ltd>使用联合底标（30秀点/个）</td><td class=bg1>全价</td><td class="">免费</td><td class=bg1>免费</td><td class="">免费</td><td class=bg1>免费</td><td class=no-rborder>免费</td></tr><tr><td class="ltd bg1">去除平台标识(100秀点/个)</td><td class=bg2>全价</td><td class=bg1>全价</td><td class=bg2>9.5折</td><td class=bg1>送10次<span style="font-size: 10px">(之后8折)</span></td><td class=bg2>送50次<span style="font-size: 10px">(之后8折)</span></td><td class="bg1 no-rborder">送200次<span style="font-size: 10px">(之后8折)</span></td></tr><tr><td class=ltd>自定义载入图(100秀点/个)</td><td class="bg1 eqf-wrong"></td><td class="">全价</td><td class=bg1>9.5折</td><td class="">送5次<span style="font-size: 10px">(之后8折)</span></td><td class=bg1>送25次<span style="font-size: 10px">(之后8折)</span></td><td class=no-rborder>送100次<span style="font-size: 10px">(之后8折)</span></td></tr><tr><td class=no-lborder rowspan=6>产品功能</td><td class="ltd bg1">子账号(增加子账号500秀点/10个)</td><td class="bg2 eqf-wrong"></td><td class=bg1>3</td><td class=bg2>5</td><td class=bg1>10</td><td class=bg2>50</td><td class="bg1 no-rborder">100</td></tr><tr><td class=ltd>创建展示个数</td><td class=bg1>不限制</td><td class="">不限制</td><td class=bg1></td><td class="">不限制</td><td class=bg1>不限制</td><td class=no-rborder>不限制</td></tr><tr><td class="ltd bg1">企业样例和模板</td><td class="eqf-wrong bg2"></td><td class="eqf-yes2 bg1"></td><td class="eqf-yes2 bg2"></td><td class="eqf-yes2 bg1"></td><td class="eqf-yes2 bg2"></td><td class="eqf-yes2 no-rborder bg1"></td></tr><tr><td class=ltd>编辑功能</td><td class=bg1>基础</td><td class="">高级</td><td class=bg1>高级</td><td class="">高级</td><td class=bg1>高级</td><td class=no-rborder>高级</td></tr><tr><td class="ltd bg1">流量统计</td><td class=bg2>基础</td><td class=bg1>基础</td><td class=bg2>高级</td><td class=bg1>高级</td><td class=bg2>高级</td><td class="bg1 no-rborder">高级</td></tr><tr><td class=ltd>数据管理</td><td class=bg1>基础</td><td class="">基础</td><td class=bg1>高级</td><td class="">高级</td><td class=bg1>高级</td><td class=no-rborder>高级</td></tr><tr><td class=no-lborder rowspan=10>高级服务</td><td class="ltd bg1">场景访问域名绑定(100秀点/月)</td><td class="bg2 eqf-wrong"></td><td class="eqf-wrong bg1"></td><td class=bg2>100秀点/月</td><td class=bg1>免费</td><td class=bg2>免费</td><td class="bg1 no-rborder">免费</td></tr><tr><td class=ltd>VIP专属人工客服</td><td class="bg1 eqf-wrong"></td><td class=eqf-wrong></td><td class="bg1 eqf-wrong"></td><td class=eqf-yes2></td><td class="bg1 eqf-yes2"></td><td class="eqf-yes2 no-rborder"></td></tr><tr><td class="ltd bg1">场景回收站功能</td><td class="bg2 eqf-wrong"></td><td class=bg1>3天</td><td class=bg2>7天</td><td class=bg1>7天</td><td class=bg2>15天</td><td class="bg1 no-rborder">15天</td></tr><tr><td class=ltd>场景前置审核</td><td class="bg1 eqf-wrong"></td><td class=eqf-wrong></td><td class="bg1 eqf-wrong"></td><td class=eqf-yes2></td><td class="bg1 eqf-yes2"></td><td class="eqf-yes2 no-rborder"></td></tr><tr><td class="ltd bg1">驳回加急审核</td><td class="eqf-wrong bg2"></td><td class="eqf-wrong bg1"></td><td class="eqf-wrong bg2"></td><td class="eqf-yes2 bg1"></td><td class="eqf-yes2 bg2"></td><td class="eqf-yes2 no-rborder bg1"></td></tr><tr><td class=ltd>审核关闭提醒</td><td class=bg1>10秀点/月</td><td class="">10秀点/月</td><td class=bg1>10秀点/月</td><td class="">免费</td><td class=bg1>免费</td><td class=no-rborder>免费</td></tr><tr><td class="ltd bg1">场景保障服务</td><td class=bg2>100秀点/30次</td><td class=bg1>100秀点/30次</td><td class=bg2>100秀点/30次</td><td class=bg1>赠送100次</td><td class=bg2>赠送200次</td><td class="bg1 no-rborder">赠送300次</td></tr><tr><td class=ltd>访问CDN加速</td><td class="bg1 eqf-wrong"></td><td class=eqf-yes2></td><td class=bg1>专属CDN加速</td><td class="">专属CDN加速</td><td class=bg1>专属CDN加速</td><td class=no-rborder>专属CDN加速</td></tr><tr><td class="bg1 ltd">第三方统计</td><td class="eqf-wrong bg2"></td><td class="eqf-wrong bg1"></td><td class="eqf-wrong bg2"></td><td class=bg1>基础</td><td class=bg2>高级</td><td class="bg1 no-rborder">高级</td></tr><tr><td class=ltd>企业可以申请举办活动</td><td class="bg1 eqf-wrong"></td><td class=eqf-wrong></td><td class="bg1 eqf-yes2"></td><td class=eqf-yes2></td><td class="bg1 eqf-yes2"></td><td class="eqf-yes2 no-rborder"></td></tr><tr><td class=no-lborder>付费模式</td><td class="bg1 ltd">服务付费方式</td><td class=bg2>免费注册使用</td><td class=bg1>免费注册升级</td><td class=bg2>99元/月</td><td class=bg1>3000元/年</td><td class=bg2>6800元/年</td><td class="bg1 no-rborder">15600元/年</td></tr><tr ng-show=oldVersonUser><td class="no-lborder no-bborder">升级模式</td><td class=no-bborder></td><td class="bg1 no-bborder"></td><td class=no-bborder></td><td class="bg1 no-bborder"><a class="btn btn-sm btn-primary" ng-disabled=true>暂停升级</a></td><td class=no-bborder><a class="btn btn-sm btn-primary" ng-disabled=true>升级</a></td><td class="bg1 no-bborder"><a class="btn btn-sm btn-primary" ng-disabled=true>升级</a></td><td class="no-rborder no-bborder"><a class="btn btn-sm btn-primary" ng-disabled=true>升级</a></td></tr><tr ng-show=!oldVersonUser><td class="no-lborder no-bborder">升级模式</td><td class=no-bborder></td><td class="bg1 no-bborder"><a class="btn btn-sm btn-primary" ng-if=!user ng-click="openRegister(\'user\', null)">立即注册</a></td><td class=no-bborder><a class="btn btn-sm btn-primary" ng-if=!user ng-click="openRegister(\'company\', null)">立即注册</a> <a class="btn btn-sm btn-primary" ng-if="user && user.type == 1" ng-click=upgradeCompany()>免费升级</a></td><td class="bg1 no-bborder"><a class="btn btn-sm btn-primary" ng-if=!user ng-disabled=true>立即注册</a> <a class="btn btn-sm btn-primary" ng-if="user && !(user.type==2 || user.type==1 || user.type==21)" ng-disabled=true>暂停升级</a> <a class="btn btn-sm btn-primary" ng-if="user && user.type==1" ng-disabled=true>暂停升级</a> <a class="btn btn-sm btn-primary" ng-if="user && user.type==2 && !user.memberType" ng-disabled=true>暂停升级</a> <a class="btn btn-sm btn-primary" ng-if="user && user.type==2 && user.memberType && user.memberType!=6" ng-disabled=true>暂停升级</a> <a class="btn btn-sm btn-primary" ng-if="user && user.type==2 && user.memberType==6" ng-disabled=true>暂停续费</a></td><td class=no-bborder><a class="btn btn-sm btn-primary" ng-if=!user ng-click="openRegister(\'company\',\'7\')">立即注册</a> <a class="btn btn-sm btn-primary" ng-disabled=true ng-if="user && !(user.type==2 || user.type==1 || user.type==21)">升级</a> <a class="btn btn-sm btn-primary" ng-if="user && user.type==1" ng-click=upgradeCompany()>升级</a> <a class="btn btn-sm btn-primary" ng-if="user && user.type==2 && (!user.memberType || user.memberType==6)" ng-click=upgradeAccount(7)>升级</a> <a class="btn btn-sm btn-primary" ng-if="user && user.type==2 && (user.memberType==8 || user.memberType==9)" ng-disabled=true>升级</a> <a class="btn btn-sm btn-primary" ng-if="user && user.type==2 && user.memberType==7" ng-click=upgradeAccount(7)>继续购买</a></td><td class="bg1 no-bborder"><a class="btn btn-sm btn-primary" ng-if=!user ng-click="openRegister(\'company\',\'8\')">立即注册</a> <a class="btn btn-sm btn-primary" ng-disabled=true ng-if="user && !(user.type==2 || user.type==1 || user.type==21)">升级</a> <a class="btn btn-sm btn-primary" ng-if="user && user.type==1" ng-click=upgradeCompany()>升级</a> <a class="btn btn-sm btn-primary" ng-if="user && user.type==2 && user.memberType != 8 && user.memberType != 9" ng-click=upgradeAccount(8)>升级</a> <a class="btn btn-sm btn-primary" ng-if="user && user.type==2 && user.memberType==9" ng-disabled=true>升级</a> <a class="btn btn-sm btn-primary" ng-if="user && user.type==2 && user.memberType==8" ng-click=upgradeAccount(8)>继续购买</a></td><td class="no-rborder no-bborder"><a class="btn btn-sm btn-primary" ng-if=!user ng-click="openRegister(\'company\',\'9\')">立即注册</a> <a class="btn btn-sm btn-primary" ng-disabled=true ng-if="user && !(user.type==2 || user.type==1 || user.type==21)">升级</a> <a class="btn btn-sm btn-primary" ng-if="user && user.type==1" ng-click=upgradeCompany()>升级</a> <a class="btn btn-sm btn-primary" ng-if="user && user.type==2 && user.memberType!=9" ng-click=upgradeAccount(9)>升级</a> <a class="btn btn-sm btn-primary" ng-if="user && user.type==2 && user.memberType==9" ng-click=upgradeAccount(9)>继续购买</a></td></tr></table><div class="more-info flash" ng-click="showMoreInfo=true;" ng-hide=showMoreInfo><div class=icon><i class=eqf-right></i></div><span class=word>合作<br>会员</span></div><table class="detail1 table-bordered table" ng-show=showMoreInfo><tr><td colspan=2 style=height:5px;background-color:#ff5448;padding:0;border:none></td></tr><tr><td colspan=2 style=height:70px>需申请</td></tr><tr class=user><td class="no-rborder service"><i class=eqf-serviceuser></i>服务商</td><td class=love-com><i class=eqf-loveheart></i>公共账号</td></tr><tr><td class="bg2 eqf-wrong"></td><td class="bg1 eqf-wrong"></td></tr><tr><td class="bg1 eqf-wrong"></td><td class=eqf-wrong></td></tr><tr><td class=bg2>免费</td><td class="bg1 eqf-wrong"></td></tr><tr><td class=bg1>免费</td><td class="">免费</td></tr><tr><td class=bg2 style=height:67px>全价<br></td><td class="bg1 eqf-wrong"></td></tr><tr><td class="bg1 eqf-wrong" style=height:67px></td><td class="">专属免费</td></tr><tr><td class="bg2 eqf-wrong"></td><td class=bg1>100</td></tr><tr><td class=bg1>不限制</td><td class="">不限制</td></tr><tr><td class="bg2 eqf-wrong"></td><td class="bg1 eqf-yes2"></td></tr><tr><td class=bg1>高级</td><td class="">高级</td></tr><tr><td class=bg2>高级</td><td class=bg1>高级</td></tr><tr><td class=bg1>高级</td><td class="">高级</td></tr><tr><td class=bg2>100秀点/月</td><td class=bg1>免费</td></tr><tr><td class="bg1 eqf-wrong"></td><td class=eqf-yes2></td></tr><tr><td class=bg2>3天</td><td class=bg1>15天</td></tr><tr><td class="bg1 eqf-wrong"></td><td class=eqf-yes2></td></tr><tr><td class="bg2 eqf-wrong"></td><td class="bg1 eqf-yes2"></td></tr><tr><td class="bg1 eqf-wrong"></td><td class="">免费</td></tr><tr><td class=bg2>100秀点/30次</td><td class=bg1>100秀点/30次</td></tr><tr><td class="bg1 eqf-yes2"></td><td class="">专属CDN加速</td></tr><tr><td class="bg2 eqf-wrong"></td><td class=bg1>高级</td></tr><tr><td class="eqf-wrong bg1"></td><td class=eqf-yes2></td></tr><tr><td class=bg2>免费申请合作</td><td class=bg1>免费申请合作</td></tr><tr><td class=bg1><a class="btn btn-sm btn-primary" target=_blank ng-href=active>了解详情</a></td><td class=""><a class="btn btn-sm btn-primary" href="http://bbs.eqxiu.com/forum.php?mod=viewthread&tid=16855&extra=" target=_blank>了解详情</a></td></tr></table><div ng-show=showMoreInfo class=right-div>&nbsp;</div></div></div><div ng-include="\'footer.tpl.html\'"></div>');
}]), angular.module("templates-common", ["directives/select.tpl.html", "security/login/form.tpl.html", "security/login/reset.tpl.html", "security/login/toolbar.tpl.html", "security/register/companyReg.tpl.html", "security/register/otherregister.tpl.html", "security/register/register.tpl.html"]), angular.module("directives/select.tpl.html", []).run(["$templateCache", function(a) {
	a.put("directives/select.tpl.html", '<div class=clearfix><div class=eqc-mask ng-click=showList($event)><div class=eqc-name>{{current.name}}</div><span class="more eqf-clickmore"></span></div><div class="eqc-drop-down-list transform-change"><div class=list><div class=eqc-scroll prevent-exception=true disable-mouse=true eqd-scroll={{scrollType}}><ul class=clearfix ng-click=selectItem($event)><li ng-repeat="item in list" ng-class="{active: item == current}" ng-style="{fontFamily: item.fontFamily}" class=eqc-target>{{item.name}}</li></ul></div></div></div></div>')
}]), angular.module("security/login/form.tpl.html", []).run(["$templateCache", function(a) {
	a.put("security/login/form.tpl.html", '<div class=login-form-section><div class=login-content><form class=loginForm novalidate ng-show="showLogin && !sendPassword" autocomplete=off><div class=section-title><a class="bbs-help-tip eqf-wrong fr" ng-click=cancel()></a><h3>登录</h3></div><div class=register-login-content><div class=textbox-wrap><label>登录名：</label><input class=form-control id=username placeholder=请填写手机号或注册邮箱/账号 type=text ng-model=user.username autocomplete=off disableautocomplete add-class> <span class=error_text></span></div><div class=textbox-wrap><label>密码：</label><input class=form-control placeholder=密码 type=password ng-model=user.password autocomplete=off disableautocomplete ng-keyup="$event.keyCode == 13 ? login() : null" required add-class> <span class=error_text></span></div><div class="textbox-wrap validate clearfix mb20" ng-if=isValidateCodeLogin><div><script load-script ng-src={{validateCodeUrl}}></script></div></div><div class="login-form-action clearfix"><a class=fr ng-click=openRegister()><ins>注册</ins></a><div class="custom-checkbox fl pr20"><div class=checkbox-square ng-class="{checked: user.rememberAcc == true}"><em class=eqf-yes2></em> <input type=checkbox ng-click=rememberName(user.rememberAcc) ng-model=user.rememberAcc name=rememberAcc></div><span>记住账号</span></div><div class="custom-checkbox fl"><div class=checkbox-square ng-class="{checked: user.rememberMe == true}"><em class=eqf-yes2></em> <input type=checkbox ng-click=rememberMe(user.rememberMe) ng-model=user.rememberMe name=rememberMe></div><span>一周内免登录</span></div></div><span class=error_text><em ng-show=authError>{{authError}}</em></span><div class="login-form-action clearfix"><a class="btn pull-left btn-main" ng-click=login()><span>登录</span></a></div><div class="login-form-action clearfix third-party mt20" style=line-height:30px><a id=wechatLoginBtn ng-click="openThirdPatyWindow(\'weixin\')" class="wx_login all-change"><em class=eqf-wechat></em><span>微信登录</span></a> <a id="qqLoginBtn " ng-click="openThirdPatyWindow(\'qq\')" class="qq_login all-change"><em class=eqf-qq></em><span>QQ登录</span></a></div></div><div class="reg-login-footer clearfix"><h6 ng-show="!sendPassword && !unExist" class=fr>为了获得更好的使用，建议使用谷歌浏览器（chrome）</h6><a ng-click=rotate(showLogin)><ins>忘记密码？</ins></a></div></form><form class=retrieveForm ng-show="!showLogin && !sendPassword" novalidate><div class=section-title><a class="bbs-help-tip eqf-wrong fr" ng-click=rotate(showLogin)></a><h3>找回密码</h3></div><div class=register-login-content style=padding-bottom:40px><div class=textbox-wrap ng-show=!phone><input class=form-control id=retrieveUsername name=userEmail placeholder=邮箱 type=text ng-model=retrieve.email ng-keyup="$event.keyCode == 13 ? retrievePassword() : null" required autofocus add-class></div><div class=textbox-wrap ng-show=phone><label>手机号：</label><input class=form-control placeholder=手机号 type=text ng-model="retrieve.phone"> <span class=error_text><em ng-show=userPhone>{{userPhone}}</em></span></div><div class=textbox-wrap ng-show=phone><label>验证码：</label><div class=clearfix><input style=width:200px class="form-control fl" id=password name=code placeholder=验证码 type=text ng-model=retrieve.code required add-class> <a ng-if=!isCodeAccessiable ng-click=getCode(retrieve.phone) class="btn-primary fl code">验证码</a> <span class="code fl" ng-if=isCodeAccessiable>{{codeTip}}</span></div><span class=error_text><em ng-show=codeError>{{codeError}}</em></span></div><div class=mt20 ng-if=!phone><script load-script ng-src={{validateCodeUrl}}></script></div><div class=clearfix><a class=fr style=font-size:12px;padding-top:10px ng-click=rotate(showLogin)><ins>我想起来了</ins></a> <a class=fl ng-show=!phone ng-click=phonePwd() style=font-size:12px;padding-top:10px><ins>使用手机号码找回</ins></a> <a class=fl ng-show=phone ng-click=emailPwd() style=font-size:12px;padding-top:10px><ins>使用邮箱找回</ins></a></div><div class="login-form-action mt20 pb20"><div class=error_text><em ng-show=retrieveError>{{retrieveError}}</em></div><a class="btn btn-main" ng-show=!phone ng-click=retrievePassword()><span>找回密码</span></a> <a class="btn btn-main" ng-show=phone ng-click=retrievePhonePassword()><span>找回密码</span></a></div></div></form><div ng-show="sendPassword && !phone" class="section-title text-center"><h3>恭喜你，找回密码成功。</h3></div><div class="send_email text-center pt20 pb20"><span ng-show="sendPassword && !phone">重置密码的链接已发送到你的 {{retrieve.email}}邮箱，登录邮箱重置密码吧！</span></div></div></div>')
}]), angular.module("security/login/reset.tpl.html", []).run(["$templateCache", function(a) {
	a.put("security/login/reset.tpl.html", '<div class=login-form-section><div class=login-content><form class=loginForm novalidate><div class=section-title><h3>重设密码</h3></div><div class=register-login-content><div class=textbox-wrap><label>新密码：</label><input class=form-control name=pass placeholder=新密码 type=password ng-model=password.newPw placeholder="密码6~16个字符(英文字母或数字 区分大小写)" ng-keyup="$event.keyCode == 13 ? reset() : null" ng-blur=checkPassword() required add-class><div class=error_text><span ng-show=passError>{{passError}}</span></div></div><div class=textbox-wrap><label>确认密码：</label><input class=form-control name=confirmPassword placeholder=确认密码 type=password ng-model=password.confirm ng-keyup="$event.keyCode == 13 ? reset() : null" ng-blur=checkRepeatPassword() required add-class><div class=error_text><span ng-show=rPassError>{{rPassError}}</span></div></div><div class="login-form-action clearfix reset-btn"><a class="btn btn-main blue-btn" ng-click=reset()>确认</a> <a class="btn btn-gray0 reset-btn" ng-click=cancel()>取消</a></div></div></form><div class=login-form-tip><h6>为了获得更好的使用，建议使用谷歌浏览器（chrome）、360浏览器、IE11浏览器。</h6></div></div></div>')
}]), angular.module("security/login/toolbar.tpl.html", []).run(["$templateCache", function(a) {
	a.put("security/login/toolbar.tpl.html", '<ul class="nav pull-right clearfix" style=margin-right:0px;position:relative><li class="" style=width:150px;margin-top:-2px;cursor:pointer ng-show=sendXd.state><img ng-click=openReg() ng-src="{{CLIENT_CDN}}assets/images/xiudianyaoqing.png"></li><li class="mes_con dropdown" style=position:static><div style=position:relative;padding-top:5px class="hint--right hint--rounded" data-hint=消息><a class="mes_content eqf-music dropdown-toggle background-color-width-change" style="position: relative" ng-click=openMsgPanel()></a> <span class=mes_count ng-if=newMsgCount>{{newMsgCount}}</span></div><div class="dropdown-menu msg_pannel box-shadow zoomIn-change" role=menu forbidden-close style="transform-origin: 100% 0"><div class="msg-title clearfix"><div class="panel_title pull-left"><em>您有</em><span class=mes_new>{{newMsgCount}}</span><em>新消息</em></div><div class="panel_title text-right" style=margin-left:0px><a ng-click=setRead() ng-if=false>设为已读消息</a></div></div><div ng-if="newMsgs.length>0" class="panel_content head_list_newMsg ellipsis" ng-repeat="newMsg in newMsgs"><em ng-class="{new_msg: newMsg.status == 1}"></em><a href=/#/message ng-bind-html=newMsg.content></a></div><div class="panel_more text-center"><a href=/#/message>查看全部消息 >></a></div></div></li><li ng-show=isAuthenticated() ng-class="{\'border-img\': (user.type == 2 || user.type == 5) && showBranchSelect}" class="custom_img background-color-width-change" ng-mouseover="showCode = true" ng-mouseleave="showCode = false"><div class=head_hover><div class=vip_c><a ng-href=/#/usercenter/account><em ng-if=!currentUser.headImg class=eqf-top-contact></em> <img ng-if=currentUser.headImg ng-src="{{currentUser.headImg.indexOf(\'http\') < 0 ? (PREFIX_FILE_HOST + currentUser.headImg):headImg }}"></a></div><div class="head_click box-shadow" ng-show="showCode == true"><div class=itemList><a href=/#/usercenter/member>用户中心</a></div><div class=itemList ng-if="user.type == 2 || user.type == 5"><a href=/#/usercenter/children>账户管理</a></div><div class=itemList ng-if=branchid><a ng-click=changeCurrent()>返回主账号</a></div><div class=itemList><a ng-click=logout()>退出</a></div></div></div></li><li class="head-creat transform-change" ng-if="myScene && !branchid"><a href=/scene class=""><em class=eqf-plus2></em></a></li></ul>')
}]), angular.module("security/register/companyReg.tpl.html", []).run(["$templateCache", function(a) {
	a.put("security/register/companyReg.tpl.html", '<div class=companyReg><div class=login-form-section><div class=login-content><form class=form-horizontal style=overflow:hidden><div class=section-title><h3>免费申请企业帐号获得更多功能&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h3></div><div class=company-user-modal><div class=textbox-wrap><input type=type class=form-control ng-model=companyInfo.mobile placeholder=手机号 ng-class={error:telError} maxlength=20> <span class=tips>必填</span> <span class=error_text><em ng-show=telError>{{telError}}</em></span></div><div class=textbox-wrap><input style=width:350px type=type class=form-control ng-class={error:codeError} placeholder=验证码 ng-model=companyInfo.code ng-blur=checkCode(companyInfo)> <span class=code ng-show=!isCodeAccessiable ng-click=getCode(companyInfo)>获取验证码</span> <span class="code enble" ng-show=isCodeAccessiable>{{codeTip}}</span> <span class=tips>必填</span> <span class=error_text><em ng-show=codeError>{{codeError}}</em></span></div><div class=textbox-wrap><input type=type class=form-control ng-class={error:pwdError} placeholder=密码 ng-model=companyInfo.password ng-blur=checkPassword(companyInfo)> <span class=tips>必填</span> <span class=error_text><em ng-show=pwdError>{{pwdError}}</em></span></div><div class=textbox-wrap><input class=form-control type=text ng-model=companyInfo.name placeholder=企业名称 ng-blur=checkName(companyInfo) ng-class="{error:nameError}"> <span class=tips>必填</span> <span class="error_text clearfix"><em ng-show=nameError>{{nameError}}</em></span></div><div class=textbox-wrap><input type=text class=form-control ng-model=companyInfo.email placeholder=企业邮箱 ng-blur=checkEmail(companyInfo) ng-class={error:emailError} maxlength=40> <span class=tips>必填</span> <span class=error_text><em ng-show=emailError>{{emailError}}</em></span></div><div class=textbox-wrap><input type=text class=form-control ng-model=companyInfo.contacts placeholder=联系人 ng-class={error:contactsError} ng-blur=checkcontacts(companyInfo)> <span class=tips>必填</span> <span class=error_text><em ng-show=contactsError>{{contactsError}}</em></span></div><div class=textbox-wrap><input type=text class=form-control ng-model=companyInfo.address placeholder=联系地址 ng-class={error:addressError} ng-blur=checkAddress(companyInfo)> <span class=tips>必填</span> <span class=error_text><em ng-show=addressError>{{addressError}}</em></span></div><span class=error_text><em ng-show=regErr>{{regErr}}</em></span><div class="login-form-action clearfix pb40"><a style=width:500px;height:45px;line-height:33px;font-size:14px class="btn btn-success btn-main" ng-click=register(companyInfo)>注册</a><div class=clearfix style=font-size:12px;padding-top:15px;padding-right:50px><a target=_blank href=/privilege style=color:#08a1ef;float:right>了解企业账号详情>></a> <span>已注册过易企秀帐号，请至<a target=_blank href=/privilege style=color:#08a1ef>会员页升级</a></span></div></div></div><div class=stars-active><div class=stars id=stars3></div><div class=stars id=stars4></div></div></form></div><div style=height:200px;text-align:center><img ng-src={{CLIENT_CDN}}assets/images/star3.svg></div></div><footer><div class="same-content clearfix pt20 pb20"><div class=fr style=width:270px><div class=fr style=background-color:#fff><img ng-src={{CLIENT_CDN}}assets/images/home/QRcode.svg width=80px height="80px;"></div><p>微信：扫描二维码下载本源码</p><p>邮箱：vip@eqxiu.com</p><p>电话：010-58813666</p><p>工作日：9:00-20:00</p></div><div class=fl><p>?? 2015 eqxiu.com. All rights reserved 北京中网易企秀科技有限公司</p><p>电信与信息服务业务经营许可证：京ICP证160037号 | 京ICP备15056244号-5 | 京公网安备11010802018300</p><div class=renzheng style=padding-top:10px><a href="https://ss.knet.cn/verifyseal.dll?sn=e14082111011652865izip000000&amp;ct=df&amp;a=1&amp;pa=0.5974755212664604" target=_blank><img ng-src={{CLIENT_CDN}}assets/images/kexin.svg width=80px height=30px></a> <a href=http://bbs.eqxiu.com/portal.php class="btn btn-main" target=_blank>官方论坛</a> <a><em class="eqf-wechat btn btn-primary"></em><div class=weixin style=background-color:#fff><img ng-src={{CLIENT_CDN}}assets/images/home/QRcode.svg width=120px height=120px></div></a> <a href=http://weibo.com/eqxiu target=_blank><em class="eqf-weibo btn out-red"></em></a> <a href="http://bbs.eqxiu.com/plugin.php?id=ljqqqun:qq&amp;type=4" target=_blank style=padding:0 class="qq-group btn-main background-color-width-change clearfix"><em class="eqf-qq btn"></em> <span>QQ群交流</span></a></div></div></div></footer></div>')
}]), angular.module("security/register/otherregister.tpl.html", []).run(["$templateCache", function(a) {
	a.put("security/register/otherregister.tpl.html", '<form name=formName novalidate class=login-form><div class=text-center><div style="position: relative; top: 0px; font-size: 15px">第三方账号已授权</div><div style="margin-top: 15px">欢迎您&nbsp;<code>{{otherUserInfo.nickname}}</code>&nbsp;<img ng-src="{{otherUserInfo.figureUrl}}">，完善以下信息，就可以使用我们的服务!</div></div><div class=login_form><div class="alert alert-danger" role=alert ng-show=regErr>{{regErr}}</div><div class=input-wrap><input name=userEmail placeholder="邮箱 " type=email ng-model=user.email ng-keyup="$event.keyCode == 13 ? fullfil() : null" required autofocus></div><div class=input-wrap><input name=pass placeholder=密码 type=password ng-model=user.password ng-keyup="$event.keyCode == 13 ? fullfil() : null" required></div><div class=input-wrap><input name=repeatPass placeholder=确认密码 type=password ng-model=user.repeatPassword ng-keyup="$event.keyCode == 13 ? fullfil() : null" required></div><div class=checkbox><label><input type=checkbox ng-model=user.agreement> 我已阅读并同意<a href=/agreement target=_blank>《易企秀用户注册协议》</a></label></div><div class="login-btn btn-main" ng-click=fullfil() ng-disabled=form.$invalid>完&nbsp;&nbsp;善</div></div></form>')
}]), angular.module("security/register/register.tpl.html", []).run(["$templateCache", function(a) {
	a.put("security/register/register.tpl.html", '<div class=login-form-section><div class=login-content><form name=regForm autocomplete=off><div class=section-title><a class="bbs-help-tip eqf-wrong fr" ng-click=cancel()></a><h3>注册</h3></div><div class=register-login-main><div class=register-login-left><div ng-show=regPhone><div class=textbox-wrap><label>手机号</label><input class=form-control id=registerName placeholder=可用做登录名 type=text ng-model=user.userAccount ng-blur=clearError() ng-keyup="$event.keyCode == 13 ? register() : null"> <span class=error_text><em ng-show=userPhone>{{userPhone}}</em></span></div><div class=textbox-wrap><label>验证码</label><div class=clearfix><input style=width:200px class="form-control fl" id=password name=code placeholder=填写手机收到的验证码 type=text ng-keyup="$event.keyCode == 13 ? register() : null" ng-blur=checkCode(user.code) ng-model=user.code required add-class> <a ng-if=!isCodeAccessiable ng-click=getCode(user.userAccount) class="btn-primary fl code">获取验证码</a> <span class="code fl" ng-if=isCodeAccessiable>{{codeTip}}</span></div><span class=error_text><em ng-show=codeError>{{codeError}}</em></span></div></div><div ng-show=!regPhone><div class=textbox-wrap><label>邮箱</label><input class=form-control id=registerName name=userEmail placeholder=可用做登录名 type=text ng-model=user.userAccount ng-keyup="$event.keyCode == 13 ? register() : null" ng-blur="checkUsername(user.userAccount)"> <span class=error_text><em ng-show=usernameError>{{usernameError}}</em></span></div></div><div class=textbox-wrap><label>密码</label><input class=form-control id=confirmPassword name=repeatPass placeholder="密码6~16个字符(英文字母或数字 区分大小写)" type=password ng-model=user.password ng-keyup="$event.keyCode == 13 ? register() : null" ng-blur=checkPassword() required add-class> <span class=error_text><em ng-show="passError || (!passError&&regErr)">{{passError || regErr}}</em></span></div><div class="login-form-action clearfix"><a ng-class="{\'gray0\':!user.agreement}" id=registerBtn ng-click=register() class="btn btn-success pull-left btn-main"><span>立即注册</span></a></div><div class=switch-reg><a ng-click=openLogin() class=fr id=havaAccount><ins>已有账户?</ins></a> <a ng-click=regEmail() ng-show=regPhone><ins>通过邮箱注册</ins></a> <a ng-click=registerPhone() ng-show=!regPhone><ins>通过手机号注册</ins></a></div></div><div class=register-login-right><div class="login-form-action clearfix third-party mt20" style=line-height:30px><a id=wechatLoginBtn ng-click="openThirdPatyWindow(\'weixin\')" class="wx_login all-change"><em class=eqf-wechat></em><span>使用微信注册</span></a> <a id="qqLoginBtn " ng-click="openThirdPatyWindow(\'qq\')" class="qq_login all-change"><em class=eqf-qq></em><span>使用QQ注册</span></a></div></div></div><div class="reg-login-footer clearfix"><div class=checkbox><div class="custom-checkbox fl"><div class=checkbox-square ng-class="{checked: user.agreement == true, hover: user.agreement == false && hovered == true}"><em class=eqf-yes2></em> <input type=checkbox ng-change=agreement(user.agreement) ng-model=user.agreement name=iCheck></div></div><span class=checkbox-text>&nbsp;同意<a href=/agreement target=_blank><span>《用户注册协议》</span></a></span><div class=register-question><a href="http://bbs.eqxiu.com/forum.php?mod=viewthread&tid=1903&highlight=%D7%A2%B2%E1" target=newBlank>注册遇到问题？</a></div></div></div></form></div></div>')
}]);