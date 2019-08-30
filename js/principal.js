function carregar(page) {
	document.getElementById('principal').innerHTML  = "<div class='box'><div class='topo_esquerdo'><div class='topo_direito'><div class='topo_meio'><h1>Aguarde</h1></div></div></div><div class='conteudo'><div id='linha10'><span class='img16'><img width='16' height='16' src='figuras/principal/icon_carregando.gif'></span> Carregando dados...</div></div><div class='baixo_esquerdo'><div class='baixo_direito'><div class='baixo_meio'></div></div></div></div>";
	ajaxGet(page,"document.getElementById('principal').innerHTML", false);
}
function gol() {
	document.getElementById('minha_conta').innerHTML = 'Aguarde...';
	ajaxGet('minha_conta.php',"document.getElementById('minha_conta').innerHTML", false);
}
function gol_comemoracao() {
	carregar('comemoracao_ajax.php');
	document.getElementById('minha_conta').innerHTML = 'Aguarde...';
	ajaxGet('minha_conta.php',"document.getElementById('minha_conta').innerHTML", false);
}
function entretenimentos() {
	ajaxGet('entretenimentos.php',"document.getElementById('tempo_entretenimentos_tent').innerHTML", false);
}
function minha_conta() {
	document.getElementById('minha_conta').innerHTML = 'Aguarde...';
	ajaxGet('minha_conta.php',"document.getElementById('minha_conta').innerHTML", false);
}
function secar() {
	ajaxGet('tempo_secar.php',"document.getElementById('tempo_secar').innerHTML", false);
}
function verificar_email(page) {
	document.getElementById('verificar_email').innerHTML  = "Aguarde...";
	ajaxGet(page,"document.getElementById('verificar_email').innerHTML", false);
}
function verificar_usuario(page) {
	document.getElementById('verificar_usuario').innerHTML  = "Aguarde...";
	ajaxGet(page,"document.getElementById('verificar_usuario').innerHTML", false);
}
function embaixadinha() {
	new_window('embaixadinha.php','embaixada','400','302','no');
}
function change_div(dv) {

	if (dv == "login_info") {
		if (logininfo == 0) {
			document.getElementById('login_info').style.display = "block";
			logininfo = 1;
		} else {
			document.getElementById('login_info').style.display = "none";
			logininfo = 0;
		}
	}
	if (dv == "minha_conta_nivel") {
		if (mcnivel == 0) {
			document.getElementById('minha_conta_nivel').style.display = "block";
			mcnivel = 1;
			set_cookie('mcnivel', 1, '/', '', '');
		} else {
			document.getElementById('minha_conta_nivel').style.display = "none";
			mcnivel = 0;
			set_cookie('mcnivel', 0, '/', '', '');
		}
	}
	if (dv == "minha_conta_itens") {
		if (mcitens == 0) {
			document.getElementById('minha_conta_itens').style.display = "block";
			mcitens = 1;
			set_cookie('mcitens', 1, '/', '', '');
		} else {
			document.getElementById('minha_conta_itens').style.display = "none";
			mcitens = 0;
			set_cookie('mcitens', 0, '/', '', '');
		}
	}
	if (dv == "usuario_mensagem") {
		if (usuariomensagem == 0) {
			document.getElementById('usuario_mensagem').style.display = "block";
			usuariomensagem = 1;
		} else {
			document.getElementById('usuario_mensagem').style.display = "none";
			usuariomensagem = 0;
		}
	}
	if (dv == "usuario_olheiro") {
		if (usuariomensagem == 0) {
			document.getElementById('usuario_olheiro').style.display = "block";
			usuariomensagem = 1;
		} else {
			document.getElementById('usuario_olheiro').style.display = "none";
			usuariomensagem = 0;
		}
	}
	if (dv == "usuario_usando") {
		if (usuariousando == 0) {
			document.getElementById('usuario_usando').style.display = "block";
			usuariousando = 1;
		} else {
			document.getElementById('usuario_usando').style.display = "none";
			usuariousando = 0;
		}
	}

}
function limite_texto(mf,cf,m) {
	if (mf.value.length>m) { mf.value=mf.value.substring(0,m); } else { if (cf!=null) { cf.value=m-mf.value.length; } }
}
function conv(numero) {
	if (numero <= 9) { return "0" + numero; }
	else { return numero; }
}
var checkflag = "false";
function check(field) {
	if (checkflag == "false") {
		for (i = 0; i < field.length; i++) {
			field[i].checked = true;
		}
		checkflag = "true";
		return true;
	}
	else {
		for (i = 0; i < field.length; i++) {
			field[i].checked = false;
		}
		checkflag = "false";
		return true;
	}
}
function new_window(mypage, myname, w, h, scroll) {
	var winl = (screen.width - w) / 2;
	var wint = (screen.height - h) / 2;
	winprops =
	'height='+h+',width='+w+',top='+wint+',left='+winl+',scrollbars='+scroll+',noresizable'
	win = window.open(mypage, myname, winprops)
	if (parseInt(navigator.appVersion) >= 4) { win.window.focus(); }
}
function set_cookie(name, value, path, domain, secure) {
	var cookie_string = name + "=" + escape (value);
	var expires = new Date (2050, 1, 1);
	cookie_string += "; expires=" + expires.toGMTString();
	if (path) cookie_string += "; path=" + escape (path);
	if (domain) cookie_string += "; domain=" + escape (domain);
	if (secure) cookie_string += "; secure";
	document.cookie = cookie_string;
}
function get_cookie(name) {
	var start = document.cookie.indexOf(name + "=");
	var len = start + name.length + 1;
	if ((!start) && (name != document.cookie.substring(0, name.length))) { return null; }
	if (start == -1) return null;
	var end = document.cookie.indexOf(';', len);
	if (end == -1) end = document.cookie.length;
	return unescape(document.cookie.substring(len, end));
}
function ajaxGet(url,elemento_retorno,exibe_carregando){
    var ajax1 = pegaAjax();
    if(ajax1){
        url = antiCacheRand(url)
        ajax1.onreadystatechange = ajaxOnReady
        ajax1.open("GET", url ,true);
        //ajax1.setRequestHeader("Content-Type", "text/html; charset=iso-8859-1");//"application/x-www-form-urlencoded");
        ajax1.setRequestHeader("Cache-Control", "no-cache");
        ajax1.setRequestHeader("Pragma", "no-cache");
		if(exibe_carregando){ put("<div class=\"fonte10\" align=\"center\">Carregando...</div>")    }
        ajax1.send(null)
        return true;
    }else{
        return false;
    }
    function ajaxOnReady(){
        if (ajax1.readyState == 4){
            if(ajax1.status == 200){
                var texto=ajax1.responseText;
                if(texto.indexOf(" ")<0) texto=texto.replace(/\+/g," ");
                //texto=unescape(texto); //descomente esta linha se tiver usado o urlencode no php ou asp
                put(texto);
                extraiScript(texto);
            }else{
                if(exibe_carregando){put("Falha no carregamento. " + httpStatus(ajax1.status));}
            }
            ajax1 = null
        }else if(exibe_carregando){//para mudar o status de cada carregando
                put("Carregando..." )
        }
    }
    function put(valor){ //coloca o valor na variavel/elemento de retorno
        if((typeof(elemento_retorno)).toLowerCase()=="string"){ //se for o nome da string
            if(valor!="Falha no carregamento"){
                eval(elemento_retorno + '= unescape("' + escape(valor) + '")')
            }
        }else if(elemento_retorno.tagName.toLowerCase()=="input"){
            valor = escape(valor).replace(/\%0D\%0A/g,"")
            elemento_retorno.value = unescape(valor);
        }else if(elemento_retorno.tagName.toLowerCase()=="select"){        
            select_innerHTML(elemento_retorno,valor)
        }else if(elemento_retorno.tagName){
            elemento_retorno.innerHTML = valor;
            //alert(elemento_retorno.innerHTML)
        }    
    }
    function pegaAjax(){ //instancia um novo xmlhttprequest
        if(typeof(XMLHttpRequest)!='undefined'){return new XMLHttpRequest();}
        var axO=['Microsoft.XMLHTTP','Msxml2.XMLHTTP','Msxml2.XMLHTTP.6.0','Msxml2.XMLHTTP.4.0','Msxml2.XMLHTTP.3.0'];
        for(var i=0;i<axO.length;i++){ try{ return new ActiveXObject(axO[i]);}catch(e){} }
        return null;
    }
    function httpStatus(stat){ //retorna o texto do erro http
        switch(stat){
            case 0: return "Erro desconhecido de javascript";
            case 400: return "400: Solicitação incompreensível"; break;
            case 403: case 404: return "404: Não foi encontrada a URL solicitada"; break;
            case 405: return "405: O servidor não suporta o método solicitado"; break;
            case 500: return "500: Erro desconhecido de natureza do servidor"; break;
            case 503: return "503: Capacidade máxima do servidor alcançada"; break;
            default: return "Erro " + stat + ". Mais informações em http://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html"; break;
        }
    }
    function antiCacheRand(aurl){
        var dt = new Date();
        if(aurl.indexOf("?")>=0){ //já tem parametros
            return aurl + "&" + encodeURI(Math.random() + "_" + dt.getTime());
        }else{ return aurl + "?" + encodeURI(Math.random() + "_" + dt.getTime());}
    }
}
function select_innerHTML(objeto,innerHTML){
    objeto.innerHTML = ""
    var selTemp = document.createElement("micoxselect")
    var opt;
    selTemp.id="micoxselect1"
    document.body.appendChild(selTemp)
    selTemp = document.getElementById("micoxselect1")
    selTemp.style.display="none"
    if(innerHTML.toLowerCase().indexOf("<option")<0){ //se não é option eu converto
        innerHTML = "<option>" + innerHTML + "</option>"
    }
    innerHTML = innerHTML.replace(/<option/g,"<span").replace(/<\/option/g,"</span")
    selTemp.innerHTML = innerHTML
    for(var i=0;i<selTemp.childNodes.length;i++){
        if(selTemp.childNodes[i].tagName){
            opt = document.createElement("OPTION")
            for(var j=0;j<selTemp.childNodes[i].attributes.length;j++){
                opt.setAttributeNode(selTemp.childNodes[i].attributes[j].cloneNode(true))
            }
            opt.value = selTemp.childNodes[i].getAttribute("value")
            opt.text = selTemp.childNodes[i].innerHTML
            if(document.all){ //IEca
                objeto.add(opt)
            }else{
                objeto.appendChild(opt)
            }                    
        }    
    }
    document.body.removeChild(selTemp)
    selTemp = null
}
function extraiScript(texto){
    // inicializa o inicio
    var ini = 0;
    // loop enquanto achar um script
    while (ini!=-1){
        // procura uma tag de script
        ini = texto.indexOf('<script', ini);
        // se encontrar
        if (ini >=0){
            // define o inicio para depois do fechamento dessa tag
            ini = texto.indexOf('>', ini) + 1;
            // procura o final do script
            var fim = texto.indexOf('</script>', ini);
            // extrai apenas o script
            codigo = texto.substring(ini,fim);
            // executa o script
            //eval(codigo);
            novo = document.createElement("script")
            novo.text = codigo;
            document.body.appendChild(novo);
        }
    }
}