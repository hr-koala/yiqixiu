(function() {
	var _ozclick = "0";
	var _oziframe = "0";
	var _oz_updatetail = "0";
	var _ozpoc = "";
	var _ozrec = "ozrec";
	var _ozjcnt_type = "__COUNT__";
	var V = undefined;
	V = {
		bW: function() {
			this.cC = "2229.oadz.com";
			this.cU = "s.oadz.com";
			this.bA = "cnt;C1;2229;.70c.com;bqDag9oDxCXg06185Z3ugg9QOMU=;";
			this.dE = "jcnt;C1;2229;.70c.com;LbhT6uwngdhUy5McQ52Vuemf3+Y=;";
			this.ca = "0F310";
			this.cb = "";
			this.bo = 50;
			if (_ozjcnt_type == 1) {
				this.bo = 5;
			}
			this.t = window;
			this.aw = this.t.top;
			this.aP = this.t.screen;
			this.bK = this.t.document;
			this.dc = navigator;
			this.cS = (this.dc.appName == 'Microsoft Internet Explorer');
			this.cK = new Image();
			this.dv = new Image();
			this.bw = this.bA.split(";")[2];
			this.aq = undefined;
			this.aK = undefined;
			this.L = undefined;
			this.al = undefined;
			this.aU = undefined;
			this.bm = undefined;
			this.aQ = undefined;
			this.by = undefined;
			this.bS = undefined;
			this.H = 0;
			this.bE = 0;
			this.cF = 512;
			this.bU = 512;
			this.dG = 1024;
			this.dr = "\x49\x4e\x50\x55\x54";
			this.dK = "\x62\x75\x74\x74\x6f\x6e";
			this.ct = "\x69\x6d\x61\x67\x65";
			this.dQ = "\x73\x75\x62\x6d\x69\x74";
			this.da = "\x62\x6f\x64\x79";
			this.ce = "\x68\x74\x6d\x6c";
			this.cI = "\x46\x4c\x41\x53\x48";
			this.as = "\x4f\x5a\x5f\x30\x61\x5f" + this.bw;
			this.ba = "\x4f\x5a\x5f\x31\x55\x5f" + this.bw;
			this.aH = "\x4f\x5a\x5f\x31\x59\x5f" + this.bw;
			this.cl = "\x4f\x5a\x5f\x31\x4b\x5f" + this.bw;
			this.cT = "\x4f\x5a\x5f\x31\x53\x5f" + this.bw;
		},
		aR: function() {
			if (!this.aq) {
				if (this.bG().indexOf("https") == 0) {
					this.aq = "https://" + this.cU + "/" + this.bA;
				} else {
					this.aq = "http://" + this.cC + "/" + this.bA;
				}
			}
			return this.aq;
		},
		bb: function() {
			if (!this.aK) {
				if (this.bG().indexOf("https") == 0) {
					this.aK = "https://" + this.cU + "/" + this.dE;
				} else {
					this.aK = "http://" + this.cC + "/" + this.dE;
				}
			}
			return this.aK;
		},
		aJ: function(bs, h, ad, by) {
			var O = "";
			if (ad && ad > 0) O = bs + "=" + h + ";expires=" + ad.toGMTString() + ";path=/;domain=" + by;
			else O = bs + "=" + h + ";path=/;domain=" + by;
			this.bK.cookie = O;
		},
		bP: function(bs) {
			var O = this.bK.cookie,
				bg, ap, ae = O.indexOf(bs + "=");
			if (ae != -1) {
				bg = ae + bs.length + 1;
				ap = O.indexOf(";", bg);
				if (ap == -1) {
					ap = O.length;
				}
				return O.substring(bg, ap);
			}
			return null;
		},
		aM: function() {
			var aX = undefined;
			if (!this.by) {
				this.by = this.bK.domain;
				if (this.by.indexOf(".") > -1) {
					var l = this.by.split(".");
					this.by = l[l.length - 2] + "." + l[l.length - 1];
					if (l.length > 2 && l[l.length - 3] != "www") {
						aX = l[l.length - 2];
						if (aX.length <= 2 || (aX == "com" || aX == "edu" || aX == "gov" || aX == "net" || aX == "org" || aX == "mil")) {
							this.by = l[l.length - 3] + "." + aX + "." + l[l.length - 1];
						}
					}
				}
			}
			return this.by;
		},
		bG: function() {
			var v = "";
			try {
				try {
					v = this.aw.location.href;
				} catch (ex) {
					v = this.t.location.href;
				}
			} catch (ex) {}
			if (!v) {
				v = "-";
			}
			if (v.length > this.bU) {
				v = v.substring(0, this.bU);
			}
			v = escape(v);
			return v;
		},
		cD: function() {
			var an = "";
			try {
				an = this.t.location.href;
			} catch (ex) {}
			if (!an) {
				an = "-";
			}
			if (an.length > this.bU) {
				an = an.substring(0, this.bU);
			}
			an = escape(an);
			return an;
		},
		bz: function() {
			if (!this.L) {
				try {
					try {
						this.L = this.aw.document.referrer;
					} catch (ex) {
						this.L = this.bK.referrer;
					}
					if (!this.L) {
						this.L = this.aw.opener.location.href;
					}
				} catch (ex) {}
				if (!this.L) {
					this.L = "-";
				}
				if (this.L.length > this.dG) {
					this.L = this.L.substring(0, this.dG);
				}
				this.L = escape(this.L);
			}
			return this.L;
		},
		bk: function(F, bF) {
			try {
				if (F && bF && F.getAttribute(bF)) {
					return F.getAttribute(bF).toString();
				}
			} catch (ex) {}
			return null;
		},
		ax: function(F) {
			if (F && F.name) {
				return F.name.toString();
			} else if (this.bk(F, "name")) {
				return this.bk(F, "name");
			} else if (F && F.id) {
				return F.id.toString();
			} else {
				return "-";
			}
		},
		dq: function(F) {
			var K = 1,
				bv = 0;
			while (F && K <= 50) {
				F = F.parentNode;
				K++;
				if (F && F.tagName == "DIV") {
					var bx = this.ax(F);
					if (bx && bx.indexOf("__") == 0 && bx.length > 2) {
						bv = 1;
						break;
					}
				}
			}
			if (bv == 1) {
				return F;
			} else {
				return null;
			}
		},
		db: function(F, ag) {
			if (!F.onclick) {
				F.onclick = ag;
			} else {
				if (this.cS) {
					F.attachEvent("onclick", ag);
				} else {
					F.addEventListener("click", ag, false);
				}
			}
		},
		cv: function() {
			var K = 0;
			if (typeof(V.t.frames) != "undefined" && V.t.frames) {
				for (K = 0; K < V.t.frames.length; K++) {
					try {
						V.db(V.t.frames[K].document, V.bD);
					} catch (ex) {}
				}
			}
			if (V.t["__99_8B5_pageonload"]) {
				V.t["__99_8B5_pageonload"]();
			}
		},
		dC: function(F) {
			var K = 1;
			while (F && F.tagName != "A" && F.tagName != "AREA" && K <= 10) {
				F = F.parentNode;
				K++;
			}
			if (F && (F.tagName == "A" || F.tagName == "AREA")) {
				return F;
			} else {
				return null;
			}
		},
		dn: function(F) {
			var K = 1,
				bH = undefined,
				J = undefined;
			if (_ozclick == 1) {
				J = this.ax(F);
				while (F && K <= 5 && !(J && J.indexOf("__") == 0 && J.length > 2 && F.onclick)) {
					F = F.parentNode;
					J = this.ax(F);
					K++;
				}
				if (F && F.onclick && J && J.indexOf("__") == 0 && J.length > 2) {
					return F;
				}
			} else {
				if (F && F.tagName) {
					bH = F.tagName.toLowerCase();
				}
				while (F && !F.onclick && K <= 5 && bH != this.da && bH != this.ce) {
					if (F.parentNode && F.parentNode.tagName) {
						F = F.parentNode;
						bH = F.tagName.toLowerCase();
						K++;
					} else {
						return null;
					}
				}
				if (F && F.onclick && bH != this.da && bH != this.ce) {
					return F;
				}
			}
			return null;
		},
		bD: function(R) {
			if (V.H < V.bo) {
				var T = null,
					aW = "-",
					aG = null,
					J = "-",
					G = null,
					bf = null,
					aA = null,
					aj = null,
					aC = 0,
					aB = 0,
					ac = 0,
					i = 0;
				if (!R) {
					if (V.t.event) {
						R = V.t.event;
						T = R.srcElement;
					} else {
						try {
							for (i = 0; i < V.t.frames.length; i++) {
								if (V.t.frames[i].event) {
									R = V.t.frames[i].event;
									T = R.srcElement;
								}
							}
						} catch (ex) {}
					}
				} else {
					if (R.target) {
						T = R.target;
					} else if (R.srcElement) {
						T = R.srcElement;
					}
				}
				if (R && T) {
					bf = V.dC(T);
					if (bf && bf.href) {
						G = bf;
						aG = "A";
						J = escape(V.ax(G));
						aW = escape(G.href);
						if (!aW) {
							aW = "-";
						}
					} else if (T.tagName == V.dr && (T.type == V.dK || T.type == V.ct || T.type == V.dQ)) {
						G = T;
						aG = V.dr;
						J = escape(V.ax(G));
					} else {
						G = V.dn(T);
						if (G) {
							aG = G.tagName;
							J = escape(V.ax(G));
						}
					}
					if (G) {
						if (aG && aG != "-") {
							aj = V.dq(G);
							V.bn = V.bk(G, _ozpoc);
							V.bS = V.bk(G, _ozrec);
							if (typeof(R.pageX) != 'undefined') {
								aB = R.pageX;
								ac = R.pageY;
							} else if (typeof(R.x) != 'undefined') {
								aB = R.x;
								ac = R.y;
							}
							if (aj) {
								var cq = escape(V.ax(aj));
								aA = aG + "*" + J + "*" + aB + "*" + ac + "*" + cq;
							} else {
								aA = aG + "*" + J + "*" + aB + "*" + ac;
							}
							aC = Math.floor((new Date()).getTime() / 1000);
							if (J.toLowerCase().indexOf("__ad_") == 0 || J.toLowerCase().indexOf("__zntg_") == 0) {
								V.dI(J, aC, aW);
							} else if (aj) {
								J = escape(V.ax(aj));
								if (J.toLowerCase().indexOf("__ad_") == 0 || J.toLowerCase().indexOf("__zntg_") == 0) {
									V.dI(J, aC, aW);
								}
							}
						}
						if (aG && V.bb() != '') {
							try {
								if (V.H == 0 && V.bE == 1) {
									V.H = 1;
									V.bE = V.H + 1;
								} else {
									if (V.bE == 1) {
										V.H = 2;
									} else {
										V.H = V.bE;
									}
									V.bE = V.H + 1;
								}
							} catch (ex) {
								V.H = 99;
							}
							V.dJ(aA, V.H, aW);
							V.ci(100);
						}
					}
				}
			}
		},
		ci: function(bc) {
			var dj = (new Date()).getTime();
			while (((new Date()).getTime() - dj) < bc) {}
		},
		di: function(type) {
			var bc = (new Date()).getTime();
			if (type == 1) {
				bc = Math.floor(bc / 1000);
			}
			return "ozrand=" + bc;
		},
		dJ: function(aA, H, aW) {
			if (this.bb() != '' && this.bG() && this.al && this.aQ && aA && H > 0 && aW) {
				this.dv.src = this.bb() + "?" + H + "&" + this.bG() + "&" + this.al + "&" + this.aQ + "&" + aA + "&" + aW + "&" + this.cO() + "&" + this.di(1);
			}
		},
		ds: function(bq, ar) {
			var aI;
			try {
				if (typeof(bq) != "undefined") {
					if (bq.length > this.cF) {
						bq = bq.substring(0, this.cF);
					}
					aI = escape("&" + bq);
				}
			} catch (ex) {}
			if (typeof(aI) == "undefined") {
				aI = "-";
			}
			if (ar) {
				this.bm = aI;
			}
			return aI;
		},
		cY: function(aN, ar) {
			var bd;
			try {
				if (typeof(aN) != "undefined" && aN.indexOf("#") == 0 && aN.length > 1) {
					bd = escape(aN);
				}
			} catch (ex) {}
			if (typeof(bd) == "undefined") {
				bd = "-";
			}
			if (ar) {
				this.aQ = bd;
			}
			return bd;
		},
		az: function(bZ) {
			try {
				var dR = /^\d+$/;
				return dR.test(bZ);
			} catch (ex) {}
			return false;
		},
		dM: function() {
			var ak = undefined;
			try {
				ak = this.dc.userAgent;
				if (ak && ak.toLowerCase().indexOf("alexa") > -1) {
					return 1;
				}
			} catch (ex) {}
			return 0;
		},
		aD: function() {
			var aa = 0,
				bu = 0;
			if (this.aP) {
				aa = this.aP.width;
				bu = this.aP.height;
				if (aa && bu && this.az(aa) && this.az(bu)) {
					return aa + "*" + bu;
				}
			}
			return "0*0";
		},
		cX: function() {
			var bB = "-";
			try {
				bB = escape(this.bK.title.substring(0, 30));
			} catch (ex) {}
			if (!bB) {
				bB = "-";
			}
			var bV = undefined;
			try {
				if (_ozuid) {
					bV = escape(_ozuid);
				}
			} catch (ex) {}
			if (!bV) {
				bV = "-";
			}
			var ai = this.dA();
			if (!ai) {
				ai = "-";
			}
			var ah = 0;
			try {
				var ad = new Date().getTime();
				if (_oztime && ad > _oztime) {
					ah = ad - _oztime;
				}
			} catch (ex) {}
			var am = undefined;
			try {
				if (_oznvs) {
					am = escape(_oznvs);
				}
			} catch (ex) {}
			if (!am) {
				am = "-";
			}
			var k = Math.floor(new Date().getTime() / 1000);
			var C = this.av(k);
			var cB = "0";
			if (C.indexOf("&ltime=") != -1) {
				cB = C.substr(C.indexOf("&ltime=") + 7);
			}
			var aO = this.bO(true, k);
			var j = this.bC();
			var au = this.bi();
			return "ozlvd=" + cB + "&ozept=" + bB + "&ozsru=" + bV + "&ozsat=" + escape("-") + "&ozver=" + escape("-") + "&ozscr=" + this.aD() + "&ozplt=" + ah + "&ozos=" + escape("-") + "&ozalx=" + this.dM() + "&oznvs=" + am + "&ozsac=" + ai + "&ozccu=" + escape(C) + "&ozccy=" + escape(aO) + "&ozcck=" + escape(j) + "&ozccs=" + escape(au);
		},
		cO: function() {
			var bV = undefined;
			try {
				if (_ozuid) {
					bV = escape(_ozuid);
				}
			} catch (ex) {}
			if (!bV) {
				bV = "-";
			}
			if (!this.bn) this.bn = "-";
			if (!this.bS) this.bS = "-";
			if (!this.bm) this.bm = "-";
			var am = undefined;
			try {
				if (_oznvs) {
					am = escape(_oznvs);
				}
			} catch (ex) {}
			if (!am) {
				am = "-";
			}
			var k = Math.floor(new Date().getTime() / 1000);
			var C = this.av(k);
			var aO = this.bO(false, k);
			var j = this.bC();
			var au = this.bi();
			return "ozsru=" + bV + "&ozscr=" + this.aD() + "&ozpoc=" + escape(this.bn) + "&ozprm=" + this.bm + "&oznvs=" + am + "&ozrec=" + escape(this.bS) + "&ozccu=" + escape(C) + "&ozccy=" + escape(aO) + "&ozcck=" + escape(j) + "&ozccs=" + escape(au);
		},
		dg: function(aQ, bm) {
			var v = undefined;
			if (_oziframe == 0) {
				v = this.bG();
			} else {
				v = this.cD();
			}
			if (this.aU && this.aU != "-") {
				this.al = this.aU;
			} else {
				this.al = this.bz();
			}
			this.cK.src = this.aR() + "?1&" + v + "&" + this.al + "&" + aQ + "&" + bm + "&" + this.cX();
			if (aQ == "-") {
				this.aU = v;
			} else {
				this.aU = v + aQ;
			}
		},
		cR: function(R) {
			var cN = 1;
			try {
				if (R.eventPhase && R.eventPhase == 0) {
					cN = 0;
				}
			} catch (ex) {}
			if (cN) {
				if (!this.t.event) {
					this.bD(R);
				} else {
					this.bD();
				}
			}
		},
		cw: function(J) {
			var aA = "";
			if (J && J != '') {
				if (this.H < this.bo) {
					this.H++;
					aA = this.cI + "*" + J + "*0*0";
					this.dJ(aA, this.H, '-');
					this.ci(100);
				}
			}
		},
		de: function(af, bQ) {
			var ar = 0;
			if (typeof(_oz_updatetail) != "undefined" && _oz_updatetail == 1) {
				ar = 1;
				this.H = 0;
				this.bE = 1;
			}
			var aI = this.ds(af, ar);
			var bd = this.cY(bQ, ar);
			this.dg(bd, aI);
		},
		dI: function(J, aC, bM) {
			var v = this.bG(),
				O = this.bP(this.as),
				K = 0,
				aF = 0,
				aE = 0;
			J = escape(J);
			if (O) {
				for (K = 0; K < O.length; K++) {
					if (O.charAt(K) == '&') {
						aF++;
						if (aF == 1) {
							aE = K + 1;
						}
					}
				}
				if (aF < 4) {
					O = O + "&" + J + "*" + aC + "*" + v + "*" + bM;
				} else if (aF == 4 && aE > 0) {
					O = O.substr(aE) + "&" + J + "*" + aC + "*" + v + "*" + bM;
				}
			} else {
				O = J + "*" + aC + "*" + v + "*" + bM;
			}
			this.aJ(this.as, O, 0, this.aM());
		},
		dA: function() {
			var h = undefined,
				k = Math.floor((new Date()).getTime() / 1000),
				O = "",
				ao = undefined,
				bL = undefined,
				K = 0;
			try {
				ao = this.bP(this.as).split("&");
				for (K = 0; K < ao.length; K++) {
					bL = ao[K].split("*");
					if ((k - bL[1]) < 900 && bL[2] == escape(this.bz()) && bL[3] == this.bG()) {
						h = bL[0];
					} else {
						O += (O == "" ? "" : "&") + ao[K];
					}
				}
				this.aJ(this.as, O, 0, this.aM());
			} catch (ex) {}
			return h;
		},
		av: function(k) {
			var O = "-";
			try {
				O = this.bP(this.ba);
				var dB = new Date();
				var aS = 0;
				if (!O) {
					var cJ = Math.round(dB.getTime() / 1000);
					var bp = cJ.toString(16);
					var dk = bp.length;
					bp = bp.substring(dk - 7, dk);
					var cd = "";
					for (var K = 0; K < 3; K++) {
						var dO = Math.floor(Math.random() * 255);
						var df = dO.toString(16);
						cd += (df.length == 1 ? "0" : "") + df;
					}
					var dF = "v" + bp + cd + ".0";
					O = "vid=" + dF + "&ctime=" + k + "&ltime=" + aS;
				} else {
					if (O && O.indexOf("ctime=") != -1) {
						var bJ = O.substr(O.indexOf("ctime=") + 6);
						var cu = bJ.indexOf("&");
						if (cu != -1) {
							bJ = bJ.substring(0, cu);
						}
						if (bJ.match(/^\d*$/)) {
							aS = new Number(bJ);
						}
					}
					O = O.substring(0, O.lastIndexOf("&ctime")) + "&ctime=" + k + "&ltime=" + aS;
				}
				this.aJ(this.ba, O, new Date(dB.getTime() + 252288000000), this.aM());
			} catch (ex) {}
			return O;
		},
		bO: function(cW, k) {
			var O = "-";
			try {
				var aO = this.bP(this.aH);
				var C = this.bP(this.ba);
				if (aO) {
					O = aO;
					O = O.substring(0, O.lastIndexOf("&ctime")) + C.substring(C.lastIndexOf("&ctime")) + "&compid=" + this.bw;
					this.aJ(this.aH, O, 0, this.aM());
				}
				if (cW) {
					var bN = 0;
					var be = "-";
					var aZ = "-";
					var v = this.bG();
					var bI = this.bz();
					var dH = 1;
					var bv = 0;
					if (bI != "-") {
						var ck = this.aR().split(";")[3].split(":");
						for (var K = 0; K < ck.length; K++) {
							if (bI.indexOf(ck[K]) != -1) {
								dH = 0;
							}
						}
						if (dH == 1) {
							bN = 1;
						}
					}
					var aL = v.lastIndexOf("%3Fozu_sid%3D");
					if (aL == -1) {
						aL = v.lastIndexOf("%26ozu_sid%3D");
					}
					var aV = v.lastIndexOf("%3Fozs%3D");
					if (aV == -1) {
						aV = v.lastIndexOf("%26ozs%3D");
					}
					if (aL != -1 && aL > aV) {
						bN = 1;
						var ab = v.split(/%3Fozu_sid%3D|%26ozu_sid%3D/);
						if (ab.length > 1) {
							var ay = ab[1];
							var ap = ay.indexOf("%26");
							if (ap != -1) {
								ay = ay.substr(0, ap);
							}
							be = ay;
							bv = 1;
						}
					}
					if (aV != -1 && aV > aL) {
						bN = 1;
						var aY = v.split(/%3Fozs%3D|%26ozs%3D/);
						for (var K = 1; K < aY.length && K < 4; K++) {
							var bj = aY[K];
							var ap = bj.indexOf("%26");
							if (ap != -1) {
								bj = bj.substr(0, ap);
							}
							if (bj.indexOf("-") == -1) {
								aZ = bj;
								bv = 2;
								break;
							} else {
								var bh = bj.split("-");
								if (bh.length == 2 && bh[1] == this.bw) {
									aZ = bh[0];
									bv = 2;
									break;
								}
							}
						}
					}
					if (!aO && bI == "-") {
						bN = 1;
					}
					if (bN) {
						O = "erefer=" + bI + "&eurl=" + v + "&etime=" + k + C.substring(C.lastIndexOf("&ctime")) + "&compid=" + this.bw;
						this.aJ(this.aH, O, 0, this.aM());
						if (be != "-" || aZ != "-") {
							var j = "";
							var cz = O.indexOf("&etime=");
							if (cz != -1) {
								j = "etime=" + k + "&ozu_sid=" + be + "&ozs=" + aZ + "&flag=" + bv + "&compid=" + this.bw;
								this.aJ(this.cl, j, new Date(new Date().getTime() + 30 * 86400 * 1000), this.aM());
								this.aJ(this.cT, j, 0, this.aM());
							}
						}
					}
				}
			} catch (ex) {}
			return O;
		},
		bC: function() {
			var j = "-",
				h = null;
			try {
				h = this.bP(this.cl);
				if (h) {
					j = h;
				}
			} catch (ex) {}
			return j;
		},
		bi: function() {
			var au = "-",
				h = null;
			try {
				h = this.bP(this.cT);
				if (h) {
					au = h;
				}
			} catch (ex) {}
			return au;
		},
		dp: function() {
			try {
				if (typeof(this.cQ) == "undefined") {
					this.bW();
					this.cQ = 1;
					this.bE = 1;
					this.aT = 1;
				} else {
					this.cQ = 2;
					this.aT = 2;
				}
				if (this.aT == 1) {
					this.ds(this.t._ozprm, 1);
					this.cY(this.t._ozurltail, 1);
					if (this.t.onload) {
						this.t["__99_8B5_pageonload"] = this.t.onload;
					}
					this.t.onload = this.cv;
					this.db(this.bK, this.bD);
					this.dg(this.aQ, this.bm);
				}
			} catch (ex) {}
			return this;
		}
	};
	if (typeof(_99_8B5) == "undefined") {
		_99_8B5 = V.dp();
		__ozflash = function(J) {
			_99_8B5.cw(J);
		};
		__ozclk = function() {
			try {
				var R = _99_8B5.t.event || arguments.callee.caller.arguments[0];
				_99_8B5.cR(R);
			} catch (e) {}
		};
		__ozfac2 = function(af, bQ) {
			_99_8B5.de(af, bQ);
		};
	}
})();