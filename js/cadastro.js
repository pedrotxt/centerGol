/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
function iniciarAjax(){
            var ajax;
            if(window.XMLHttpRequest){
                ajax = new XMLHttpRequest();

            } else if(window.ActiveXObject){
                ajax = new ActiveXObject("Msxml2.XMLHTTP");
                if(!ajax){
                    ajax = new ActiveXObject("Microsoft.XMLHTTP");
                }
            }
            else {
                alert("Seu Navegador não tem suporte a Ajax.")
            }
            return ajax;
        }

function validaLogin(){
   continua = true;
   var texto = document.getElementById("login_cad").value;
   var caracteres="!#$%&*()-[]{}'\"/çâãáéêẽíîĩõóôúũû<>";
   for(i=0; i<texto.length; i++){
      if (caracteres.indexOf(texto.charAt(i),0)!=-1){
           document.getElementById("valida_login").innerHTML = "<table summary='tabela de erro' class='erro'><tr><td><img src='img/erro2.jpg' alt='Erro' width='20px' height='20px' /></td><td>Seu login não pode conter caracteres especiais!</td></tr></table>";
           continua = false;
            }
   }
    if(continua){
    var ajax = iniciarAjax();
    if(ajax){
        
        ajax.onreadystatechange = function(){
            if(ajax.readyState == 4){
                if(ajax.status == 200){
                   
                    document.getElementById("valida_login").innerHTML = ajax.responseText;
                }else{
                     alert(ajax.statusText);
                }
            }
        }
        login = document.getElementById("login_cad").value;
        dados = "login="+login;
        ajax.open("POST", "js/login.php", true);
        ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        ajax.send(dados);
        document.getElementById("valida_login").innerHTML = "<img src='img/carregar.gif' alt='Carregando...' />";

}



    }


}


function validaEmail(){
    document.getElementById("valida_email").innerHTML = "";
    var texto = document.getElementById("email").value;
    var caracteres="#$%&*()-[]{}'\"/<>";
   for(i=0; i<texto.length; i++){
      if (caracteres.indexOf(texto.charAt(i),0)!=-1){
           document.getElementById("valida_email").innerHTML = "<table summary='tabela de erro' class='erro'><tr><td><img src='img/erro2.jpg' alt='Erro 'width='20px' height='20px' /></td><td>O Email digitado não é válido!</td></tr></table>";
      }
   }
var campo_email = document.getElementById("email").value;
	//Checando se o endereço e-mail não esta vazio
	if(campo_email=="") {
        document.getElementById("valida_email").innerHTML = "<table summary='tabela de erro' class='erro'><tr><td><img src='img/erro2.jpg' alt='Erro' width='20px' height='20px' /></td><td>O campo está vazio!</td></tr></table>";

	}
	//Checando se o endereço de e-mail é válido
	if(!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(document.getElementById("email").value))) {
		   document.getElementById("valida_email").innerHTML = "<table summary='tabela de erro' class='erro'><tr><td><img src='img/erro2.jpg' alt='Erro' width='20px' height='20px' /></td><td>O Email digitado não é válido!</td></tr></table>";

	}

}

function validaSenha(){
    document.getElementById("valida_senha").innerHTML = "";
    senha1 = document.getElementById("senha2").value;
    senha2 = document.getElementById("consenha").value;
    if(senha1 != senha2){
		   document.getElementById("valida_senha").innerHTML = "<table summary='tabela de erro' class='erro'><tr><td><img src='img/erro2.jpg' alt='Erro' width='20px' height='20px' /></td><td>As senhas não conferem!</td></tr></table>";
    }else{
          document.getElementById("valida_senha").innerHTML = "";
    }

}

function validaNome(){
    document.getElementById("valida_nome").innerHTML = "";
    var texto = document.getElementById("nome").value;
    var caracteres="#$%&*()-[]{}'\"/<>";
   for(i=0; i<texto.length; i++){
      if (caracteres.indexOf(texto.charAt(i),0)!=-1){
           document.getElementById("valida_nome").innerHTML = "<table summary='tabela de erro' class='erro'><tr><td><img src='img/erro2.jpg' alt='Erro 'width='20px' height='20px' /></td><td>O nome digitado não é válido pois contem caracteres especiais!</td></tr></table>";
      }
   }
var campo_nome = document.getElementById("nome").value;
	//Checando se o endereço e-mail não esta vazio
	if(campo_nome=="") {
        document.getElementById("valida_nome").innerHTML = "<table summary='tabela de erro' class='erro'><tr><td><img src='img/erro2.jpg' alt='Erro' width='20px' height='20px' /></td><td>O campo está vazio!</td></tr></table>";

	}

}

function validaDescricao(){
    document.getElementById("valida_descricao").innerHTML = "";
    var texto = document.getElementById("descricao").value;
    var caracteres="#$%&*()-[]{}'\"/<>";
   for(i=0; i<texto.length; i++){
      if (caracteres.indexOf(texto.charAt(i),0)!=-1){
           document.getElementById("valida_descricao").innerHTML = "<table summary='tabela de erro' class='erro'><tr><td><img src='img/erro2.jpg' alt='Erro 'width='20px' height='20px' /></td><td>A descrição digitada não é válida pois contem caracteres especiais!</td></tr></table>";
      }
   }
var campo_descricao = document.getElementById("descricao").value;
	//Checando se o endereço e-mail não esta vazio
	if(campo_descricao=="") {
        document.getElementById("valida_descricao").innerHTML = "<table summary='tabela de erro' class='erro'><tr><td><img src='img/erro2.jpg' alt='Erro' width='20px' height='20px' /></td><td>O campo está vazio!</td></tr></table>";

	}

}
