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



function busca(){

    ajax = iniciarAjax();
    if(ajax){
        ajax.onreadystatechange = function(){
            if(ajax.readyState == 4){
                if(ajax.status == 200){
                    document.getElementById("res_busca").innerHTML = ajax.responseText;
                }else{
                    alert(ajax.statusText);
                }
                
            }
        }

        nome = document.getElementById("busca").value;
        if(nome.length >= 2){
        dados = "busca="+nome;
        ajax.open("POST", "js/busca.php", true);
        ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        ajax.send(dados);
        document.getElementById("res_busca").innerHTML = "<div class='lateral_menu'><table class='menu_busca' summary='Buscando'><tr><td><img src='img/carregar.gif' alt='Carregar' /></td><td><i>Procurando Jogador...</i></td></tr></table></div>";
    }

    }

}


