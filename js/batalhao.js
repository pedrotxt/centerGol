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


function deletar(){
    var ajax = iniciarAjax();
    if(ajax){
        ajax.onreadystatechange = function(){
            if(ajax.readyState == 4){
                if(ajax.status == 200){
                    document.getElementById("resposta_deletar").innerHTML = ajax.responseText;
                }else{
                    alert(ajax.statusText);
                }
            }
        }

        jogador = document.getElementById("deletar_jogador").value;

        dados = "jogador="+jogador;
        ajax.open("POST", "js/deletar_jogador_batalhao.php", true);
        ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        ajax.send(dados);
        document.getElementById("resposta_deletar").innerHTML = "<div class='conteudo'><table summary='load' class='conteudo'><tr><td width='20px'><img src='img/carregar.gif' alt='carregar' /></td><td><b>Deletando Jogador...</b></td></tr></table></div>";
       

}
}

function descricao(){
    var ajax = iniciarAjax();
    if(ajax){
        ajax.onreadystatechange = function(){
            if(ajax.readyState == 4){
                if(ajax.status == 200){
                    document.getElementById("resposta_descricao").innerHTML = ajax.responseText;
                }else{
                    alert(ajax.statusText);
                }
            }
        }

        texto = document.getElementById("texto").value;

        dados = "texto="+texto;
        ajax.open("POST", "js/editar_batalhao.php", true);
        ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        ajax.send(dados);
        document.getElementById("resposta_descricao").innerHTML = "<div class='conteudo'><table summary='load' class='conteudo'><tr><td width='20px'><img src='img/carregar.gif' alt='carregar' /></td><td><b>Editando Descrição...</b></td></tr></table></div>";


}



}

