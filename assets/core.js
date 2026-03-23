var ld;									// fetched date at page loading
var gt;									// global timer handler
var mreq 		= true;
var elems 		= new Array();
var felems 	= new Array();
var _tt = null;
var _frame;
var _flag = 1;
var _vflag = false;

function _(id) {
	return document.getElementById( id );
}
function _tcls (elem, cls) {
	var exists = false;
	var newClass = '';
	var arr = elem.getAttribute("class").split(" ");
	for (var i = 0, count = arr.length; i < count; i++) {
		if (arr[i] != cls ) {
			if (newClass != "") {
				newClass += " ";
			}
			newClass += arr[i];
		} else {
			exists = true;
		}
	}

	elem.setAttribute("class", newClass + (exists?'': " "+cls) );
}
function _rcls (elem, cls) {
	var newClass = '';
	var arr = elem.getAttribute("class").split(" ");
	for (var i = 0, count = arr.length; i < count; i++) {
		if (arr[i] != cls ) {
			if (newClass != "") {
				newClass += " ";
			}
			newClass += arr[i];
		}
	}

	elem.setAttribute("class", newClass);
}



function Allmsg(){
	for(var x=0;x<document.msg.elements.length;x++){
		var y=document.msg.elements[x];if(y.name!='s10')y.checked=document.msg.s10.checked;
	}
} 

function NF(x){return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");}

function init() {
    ld = (new Date).getTime();
    for (var a = document.getElementsByTagName("input"), b = 0, c = a.length; b < c; b++) {
        var d = a[b];
        if (d.getAttribute("type") == "image" && d.className == "dynamic_img") d.onmouseover = function () {
            this.className = "dynamic_img over"
        }, d.onmouseout = function () {
            this.className = "dynamic_img"
        }, d.onmousedown = function () {
            this.className = "dynamic_img clicked"
        }
    }
    a = document.getElementsByTagName("table");
    b = 0;
    for (c = a.length; b < c; b++) if (d = a[b], d.hasAttribute("class") && d.getAttribute("class").indexOf("row_table_data") > -1) {
        trs = d.getElementsByTagName("tbody")[0].getElementsByTagName("tr");
        for (var d = 0, e = trs.length; d < e; d++) trs[d].onmouseover = function () {
            this.setAttribute("class", this.getAttribute("class") + " hlight")
        }, trs[d].onmouseout = function () {
            _rcls(this, "hlight")
        }, trs[d].onmousedown = function () {
            _tcls(this, "marked")
        }
    }
    felems = [];
    for (b = 1; b < 5; b++) d = _("l" + b), d != null && (felems.push({
        e: d,
        r: parseFloat(d.getAttribute("title")),
        cv: parseInt(d.innerHTML),
        v: parseInt(d.innerHTML),
        x: d.getAttribute("id") == "l1" ? parseInt(document.getElementById('granary').innerHTML) : parseInt(document.getElementById('warehouse').innerHTML)
    }));
    elems = [];
    a = document.getElementsByTagName("span");
    b = 0;
    for (c = a.length; b < c; b++) d = a[b], d.getAttribute("id") != "timer1" && d.getAttribute("id") != "timer2" || (e = d.innerHTML.split(":"), isNaN(e[2]) || (e = new Number(e[0]) * 3600 + new Number(e[1]) * 60 + new Number(e[2]), elems.push({
        e: d,
        s: e,
        f: d.getAttribute("id") == "timer1" ? -1 : 1
    })));
    gt = window.setInterval(render, 1E3)
}

function render() {
    for (var a = parseInt(((new Date).getTime() - ld) / 1E3), b = 0, c = felems.length; b < c; b++) {
        var d = felems[b],
            e = Math.floor(d.v + parseFloat(a / 3600 * d.r));
        e > d.x && (e = d.x);
        d.cv = e;
        d.e.innerHTML = e
    }
    b = 0;
    for (c = elems.length; b < c; b++) {
        d = elems[b];
        e = d.s + a * d.f;
        if (e < 0) {
            window.clearInterval(gt);
            window.location.href = window.location.href;
            break
        }
        var f = Math.floor(e % 3600 / 60),
            i = Math.floor(e % 60);
        d.e.innerHTML = Math.floor(e / 3600) + ":" + (f < 10 ? "0" : "") + f + ":" + (i < 10 ? "0" : "") + i
    }
}

function showManual(b, c) {
    p = document.getElementById("ce");
    if (p != null) p.innerHTML = '<div id="_pwin" class="popup3"><div id="drag" onmousedown="dragStart(event, \'_pwin\')"></div><a href="#" class="No" onClick="hideManual(); return false;"><img src="assets/default/img/un/x.gif" border="1" class="popup4" alt="Move"></a><iframe frameborder="0" id="Frame" src="help?c=' + b + "&id=" + c + '" width="412" height="440" border="0"></iframe></div>';
    return false;
}
function hideManual() {
	p = document.getElementById("ce");
	if (p!=null) {
		p.innerHTML = '';
	}
	    return false;
}

function showInfo(a, b) {
    var c = _mp.mtx[a][b],
        d = c[5],
        e = c[6];
    _("map_infobox").setAttribute("class", d ? "village" : "oasis_empty");
    _("mbx_11").innerHTML = "-";
    _("mbx_12").innerHTML = "-";
    _("mbx_13").innerHTML = "-";
    d ? (_("mbx_1").innerHTML = e ? textb.t3 : '<span class="tribe tribe' + c[7] + '">' + c[10] + "</span>", _("mbx_11").innerHTML = c[9], _("mbx_12").innerHTML = e ? "-" : c[8], _("mbx_13").innerHTML = c[11] != "" ? c[11] : "-") : _("mbx_1").innerHTML = e ? textb.t4 : textb.t2 + " " + textb.f[c[7]]
}

function hideInfo() {
	_("x").innerHTML = _mp["x"];
	_("y").innerHTML = _mp["y"];
	_("map_infobox").setAttribute ( "class", "default" );
	_("mbx_1").innerHTML = textb.t1;
	_("mbx_11").innerHTML = "-";
	_("mbx_12").innerHTML = "-";
	_("mbx_13").innerHTML = "-";
}

function createRequestObject() {
	var http=null;
	try {
		http = new XMLHttpRequest();
	} catch (e) {
		try {
			http = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {
			http = new ActiveXObject("Microsoft.XMLHTTP");
		}
	}

    return http;
}

function renderMap(a, b) {
    if (!mreq) return !1;
    var c = createRequestObject(),
        d = "map?id=" + a.getAttribute("vid") + (b ? "&l" : "");
    if (c == null) return window.location = d, mreq = !0, !1;
    mreq = !1;
    d += "&_a1_";
    c.onreadystatechange = function () {
        if (c.readyState == 4 || c.readyState == "complete") if (mreq = !0, c.responseText.length > 0) {
            eval(c.responseText);
            _("x").innerHTML = _mp.x;
            _("y").innerHTML = _mp.y;
            _("mcx").setAttribute("value", _mp.x);
            _("mcy").setAttribute("value", _mp.y);
            _("ma_n1").setAttribute("vid", _mp.n1);
            _("ma_n2").setAttribute("vid", _mp.n2);
            _("ma_n3").setAttribute("vid", _mp.n3);
            _("ma_n4").setAttribute("vid", _mp.n4);
            _("ma_n1p7").setAttribute("vid", _mp.n1p7);
            _("ma_n2p7").setAttribute("vid", _mp.n2p7);
            _("ma_n3p7").setAttribute("vid", _mp.n3p7);
            _("ma_n4p7").setAttribute("vid", _mp.n4p7);
            for (var a = 0, d = _mp.mtx.length; a < d; a++) for (var b = _mp.mtx[a], g = 0, k = b.length; g < k; g++) {
                var h = b[g];
                _("i_" + a + "_" + g).setAttribute("class", h[3]);
                var j = _("a_" + a + "_" + g);
                j.setAttribute("title", h[4]);
                j.setAttribute("href", "village3?id=" + h[0]);
                if (a == 0) _("my" + g).innerHTML = h[2];
                if (g == 0) _("mx" + a).innerHTML = h[1]
            }
        }
    };
    c.open("GET", d, !0);
    c.send(null);
    return !1
}

function slm () {
var url = "map?l&id=" + _mp["mtx"][3][3][0];
window.location = url;
return false;
}

function add_res (id) { 
	set_res (id, _("r" + id).value + carry);
}
function upd_res (id, max) {
	set_res (id, max? merchNum * carry : isNaN (_("r" + id).value)? 0 : _("r" + id).value);
}
function set_res (id, v) {
    if (id == 1) { 
	if ( v > Res1) {
		v = Res1;
	}
    }
    if (id == 2) { 
	if ( v > Res2) {
		v = Res2;
	}
    }
    if (id == 3) { 
	if ( v > Res3) {
		v = Res3;
	}
    }
    if (id == 4) { 
	if ( v > Res4) {
		v = Res4;
	}
    }
	if (v > merchNum * carry) {
		v = merchNum * carry;
	}
	
	if (v == 0) {
		v = "";
	}
	_("r" + id).value = v;
}

// Determine browser and version.
 
function Browser() {
    var a, b, c;
    this.isNS = this.isIE = !1;
    this.version = null;
    a = navigator.userAgent;
    b = "MSIE";
    if ((c = a.indexOf(b)) >= 0) this.isIE = !0, this.version = parseFloat(a.substr(c + b.length));
    else if (b = "Netscape6/", (c = a.indexOf(b)) >= 0) this.isNS = !0, this.version = parseFloat(a.substr(c + b.length));
    else if (a.indexOf("Gecko") >= 0) this.isNS = !0, this.version = 6.1
}
var browser = new Browser,
    dragObj = {
        zIndex: 0
    };

function dragStart(a, b) {
    var c, d;
    if (b) dragObj.elNode = document.getElementById(b);
    else {
        if (browser.isIE) dragObj.elNode = window.event.srcElement;
        if (browser.isNS) dragObj.elNode = a.target;
        if (dragObj.elNode.nodeType == 3) dragObj.elNode = dragObj.elNode.parentNode
    }
    browser.isIE && (c = window.event.clientX + document.documentElement.scrollLeft + document.body.scrollLeft, d = window.event.clientY + document.documentElement.scrollTop + document.body.scrollTop);
    browser.isNS && (c = a.clientX + window.scrollX, d = a.clientY + window.scrollY);
    dragObj.cursorStartX = c;
    dragObj.cursorStartY = d;
    dragObj.elStartLeft = parseInt(dragObj.elNode.style.right, 10);
    dragObj.elStartTop = parseInt(dragObj.elNode.style.top, 10);
    if (isNaN(dragObj.elStartLeft)) dragObj.elStartLeft = d3l;
    if (isNaN(dragObj.elStartTop)) dragObj.elStartTop = 99;
    dragObj.elNode.style.zIndex = ++dragObj.zIndex;
    if (browser.isIE) document.attachEvent("onmousemove", dragGo), document.attachEvent("onmouseup", dragStop), window.event.cancelBubble = !0, window.event.returnValue = !1;
    browser.isNS && (document.addEventListener("mousemove", dragGo, !0), document.addEventListener("mouseup", dragStop, !0), a.preventDefault())
}

function dragGo(a) {
    var b, c;
    browser.isIE && (b = window.event.clientX + document.documentElement.scrollLeft + document.body.scrollLeft, c = window.event.clientY + document.documentElement.scrollTop + document.body.scrollTop);
    browser.isNS && (b = a.clientX + window.scrollX, c = a.clientY + window.scrollY);
    dragObj.elNode.style.right = dragObj.elStartLeft - b + dragObj.cursorStartX + "px";
    dragObj.elNode.style.top = dragObj.elStartTop + c - dragObj.cursorStartY + "px";
    if (browser.isIE) window.event.cancelBubble = !0, window.event.returnValue = !1;
    browser.isNS && a.preventDefault()
}
function dragStop() {
    browser.isIE && (document.detachEvent("onmousemove", dragGo), document.detachEvent("onmouseup", dragStop));
    browser.isNS && (document.removeEventListener("mousemove", dragGo, !0), document.removeEventListener("mouseup", dragStop, !0))
}

function showTask () {
	if (_tt != null) { return; }

	var obj = _("anm");
	obj.style.visibility = "visible";
	if (_flag == 1) {
		_frame = {
			'right':0,
			'top':25,
			'width':118,
			'height':142
		};
	} else {
		var p = _("ce");
		if (p!=null) {
			p.innerHTML = '';
		}				
	}
	
	_tt = window.setInterval(renderTask, browser.isIE?5:10, new Date);
}

function renderTask () {
	var obj = _("anm");
	_frame.right 		-= 22*_flag;		if (_frame.right < -700) { _frame.right = -700; }		
	if(d3l > 0) {
		obj.style.right 	= _frame.right + "px";
	} else {
		obj.style.left 	= _frame.right + "px";
	}
	_frame.top 		-= 3*_flag;			if (_frame.top < -70) { _frame.top = -70; }				obj.style.top 		= _frame.top + "px";
	_frame.width		+= 10*_flag;		if (_frame.width > 430) { _frame.width = 430; }		obj.style.width 	= _frame.width + "px";
	_frame.height	+= 7*_flag;		if (_frame.height > 456) { _frame.height = 456; }	obj.style.height	= _frame.height + "px";
	
	if ((_frame.right == -700 && _frame.top == -70 &&  _frame.width == 430 && _frame.height == 456) || _frame.right>=25) {
		window.clearInterval(_tt);
		_flag *= -1;
		obj.style.visibility = "hidden";
		
		if (_flag == -1) {
			goto_guide();
		} else {
			if(_vflag) {
				goto_guide('f');
			} else {
				_tt = null;
			}
		}
	}
}

function PopupMap(i){
	pb=document.getElementById("ce");
    if(pb!=null){
    	var iframeHeight = 575, iframeWidth  = 624;
	    var tc='<div class="popup_map">'+'<div id="drag2">'+'<a class="No" href="#" style="position: absolute;right: ' + Math.round(((documentWidth() - iframeWidth) / 2 )+iframeWidth-30) + 'px; top: ' + Math.round(((documentHeight() - iframeHeight) / 2 ) + 10) + 'px;z-index:1001;" id="map_popclose" onclick="Close(); return false;"><img src="assets/x.gif" border="0" width="20px" height="20px"></a><iframe frameborder="0" id="Frame" src="wingold" style="position: absolute; width: '+iframeWidth+'px; height: '+iframeHeight+'px; right: ' + Math.round((documentWidth() - iframeWidth) / 2) + 'px;  top: ' + Math.round((documentHeight() - iframeHeight) / 2) + 'px" border="0" scrolling="no"></iframe>'+'</div></div>';
		pb.innerHTML=tc;
	}
}
function Close(){pb=document.getElementById("ce");if(pb!=null){pb.innerHTML='';}}
function documentWidth() {
    return Math.max(
        document.documentElement.clientWidth,
        document.body.scrollWidth,
        document.documentElement.scrollWidth,
        document.body.offsetWidth,
        document.documentElement.offsetWidth
    );
}

function documentHeight() {
    return Math.max(
        document.documentElement.clientHeight,
        document.body.offsetHeight,
        document.documentElement.offsetHeight
    );
}

function GetPings(){var X = performance;
    var NTi = Date.now();
    var Time_S = X.timing.navigationStart;
    var dT = NTi-Time_S;
    var dt = NTi-TIMER_START;
    var dP = X.timing.responseStart  - X.timing.requestStart;
    var Stall = dT-dP-dt;
    return [dP,dt,dT,Stall];
}

function AutoComp(inp, arr) {
  var currentFocus;
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      this.parentNode.appendChild(a);
      for (i = 0; i < arr.length; i++) {
        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          b = document.createElement("DIV");
          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i].substr(val.length);
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          b.addEventListener("click", function(e) {
              inp.value = this.getElementsByTagName("input")[0].value;
              closeAllLists();
          });
          a.appendChild(b);
        }
      }
  });
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        currentFocus++;
        addActive(x);
      } else if (e.keyCode == 38) { //up
        currentFocus--;
        addActive(x);
      } else if (e.keyCode == 13) {
        e.preventDefault();
        if (currentFocus > -1) {
          if (x) x[currentFocus].click();
        }
      }
  });
  function addActive(x) {
    if (!x) return false;
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }
  document.addEventListener("click", function (e) {
      closeAllLists(e.target);
  });
}

function ToggleType(GId,T){var Ty=ToggleType.Ty||0;
	ToggleType.Ty=!Ty;
	Es=$("input[EyePwd='"+GId+"']");
	Es.prop('type',Ty?'password':'text');
	$(T).css('color',Ty?'silver':'red');
}
function reportChat(X,Y){$.post("chat?reportChat",{"X":X,"Y":Y},R=>{console.log(R)});$("#chatbox").replaceWith('<p style="color:green;font-size: 20px;text-align: center;">Ø·Ú¾Ø¸â€¦ Ø·Â±Ø¸Ù¾Ø·Â¹ Ø·Â§Ø¸â€žØ·Â¨Ø¸â€žØ·Â§Ø·Ø› Ø·Â¨Ø¸â€ Ø·Â¬Ø·Â§Ø·Â­</p><svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52"><circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"></circle><path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"></path></svg>');}
function reportMsg(X){$.get("nachrichten?id="+ X +"&Flag");$(".msg_content,.msg_foot").hide();$(".msg_head").replaceWith('<p style="color:green;font-size: 20px;text-align: center;">Ø·Ú¾Ø¸â€¦ Ø·Â±Ø¸Ù¾Ø·Â¹ Ø·Â§Ø¸â€žØ·Â¨Ø¸â€žØ·Â§Ø·Ø› Ø·Â¨Ø¸â€ Ø·Â¬Ø·Â§Ø·Â­</p><svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52"><circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"></circle><path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"></path></svg>');}
function EyePwd(){var GId=0,E,i,S,Es=$("input[type='password']");GId++;
  for(i=0;i<Es.length;i++){E=Es.eq(i);
	E.attr('EyePwd',GId);
	E.get(0).insertAdjacentHTML('afterend',"<c Id='EyePwd_Eye' class='NoSelect' onclick='ToggleType("+GId+",this)'>Ù‹Úºâ€˜Ù¾</c>");
  }
}

function NumbersKeypad(){
    var ParseIndian=function(S){return(S.replace(/[Ø·Â¸ Ø·Â¸Ø·Å’Ø·Â¸Ø¢Â¢Ø·Â¸Ø¢Â£Ø·Â¸Ø¢Â¤Ø·Â¸Ø¢Â¥Ø·Â¸Ø¢Â¦Ø·Â¸Ø¢Â§Ø·Â¸Ø¢Â¨Ø·Â¸Ø¢Â©]/g,function(d){return d.charCodeAt(0)-1632; }).replace(/[Ø·Ø›Ø¢Â°Ø·Ø›Ø¢Â±Ø·Ø›Ø¢Â²Ø·Ø›Ø¢Â³Ø·Ø›Ø¢Â´Ø·Ø›Ø¢ÂµØ·Ø›Ø¢Â¶Ø·Ø›Ø¢Â·Ø·Ø›Ø¢Â¸Ø·Ø›Ø¢Â¹]/g,function(d){return d.charCodeAt(0)-1776;}));}
    var E=$('input[Typ="N"]');
    E.attr('pattern','[0-9]*');
    E.attr('inputmode','numeric');
    E.attr('type','tel');
    E.keyup(function(){this.value=ParseIndian(this.value);});
}
function XCopy(Id){
    var range = document.createRange();
    range.selectNode(document.getElementById(Id));
    window.getSelection().removeAllRanges(); // clear current selection
    window.getSelection().addRange(range); // to select text
    document.execCommand("copy");
    window.getSelection().removeAllRanges();// to deselect
}

function Copy(S,F=null){_.P(S);P=_.P;/*Does not work*/
  var X = $("<i style='display:off'>"+S+"<i>");
  X.select();document.execCommand("copy");
  if(F){F();}
}

function Copied(E,S,OC,IsA=0,CC=''){E=$(E);var X;
	E.html(S);
	if(IsA){
		for(var i in OC){X=$(OC[i]);
			X.removeAttr('onclick');
			X.css('cursor','text');
			if(CC){X.attr('class',CC);}
		}
	}else{X=$(OC);
		X.removeAttr('onclick');
		X.css('cursor','text');
		if(CC){X.attr('class',CC);}
	}
}

function Run_Speed_attr(H=null,Com=null){
	var NF=function(x){return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, Com);}
	if(H===null){H='b';}
	if(Com===null){Com=',';}
	//if(NF===null){NF=X=>X;}
	var Now=()=>new Date().getTime()/1000;
	var SecStr=(T)=>{var H,M,S;H=parseInt(T/3600);M=parseInt(T/60)-H*60;S=T-H*3600-M*60;return (H<10?'0'+H:H)+':'+(M<10?'0'+M:M)+':'+(S<10?'0'+S:S);}	
	var Sec=(H,S,Inc,Re=1)=>{var Stop;var Fu=()=>{if(S==0){clearInterval(Stop);if(Re){location.reload(true);}}S+=Inc;H.html(SecStr(S));};Fu();Stop=setInterval(Fu,1000);}
	var Counter=(H,S,L,Sp,l=false,HFun=X=>X,At0=X=>X)=>{var Stop,X,T=Now();if(typeof H=='string'){H=$(H);}var Fu=()=>{X=S+Math.round((Now()-T)*Sp);if(Sp>0){X=X>L?L:X;if(X>=L){clearInterval(Stop);}}else{if(l!==false){X=X<l?l:X;if(X<=l){clearInterval(Stop);}}if(X==0){At0();}}H.html(NF(HFun(X)));};Stop=setInterval(Fu,1000/(Sp>50?50:Sp));}
	var E=$(H+'[Speed]');
	for(var i=0;i<E.length;i++){
		var e=E.eq(i);var S=e.attr('Speed');
		var [Sp,L,l]=e.attr('Speed').split(',');
		S=e.html();
		S=S.split(Com).join("");
		Counter(e,+S,+L,+Sp,+l);
	}
	var E=$(H+'[Time]');
	for(var i=0;i<E.length;i++){
		var e=E.eq(i);var S=e.attr('Time');if(e.attr('Speed')){continue;}
		var [Inc,Re,S]=e.attr('Time').split(',');Re=+Re;
		Counter(e,+S,1e15,+Inc,0,SecStr,Re?()=>{location.reload(true);}:X=>X);	
	}
}


function Chref_Attr(){
    $('a[chref]').click(function(){var E = $(this);
    if(confirm(E.attr('msg')||'Ø¸â€¡Ø¸â€ž Ø·Â£Ø¸â€ Ø·Ú¾ Ø¸â€¦Ø·Ú¾Ø·Â£Ø¸Æ’Ø·Â¯')){window.location=E.attr('chref');}
})
}
function showManual(b, c) {
        $(".overlay").show();
        $('.wrapper,#res,#ltimeWrap').css('filter','blur(3px)');
        $("#caption").html('Ø§Ù„Ø¯Ù„ÙŠÙ„ Ø§Ù„Ø³Ø±ÙŠØ¹');
        $(".Screen-content").html('<iframe frameborder="0" id="Frame" src="help?c=' + b + "&id=" + c + '" width="360" height="440" border="0"></iframe>');
        return false;
}
function n(url,e){
        $(".overlay").show();
        $('.wrapper,#res,#ltimeWrap').css('filter','blur(3px)');
        $("#caption").html(e);
        $.get(url,r=>{$(".Screen-content").html(r);});
}