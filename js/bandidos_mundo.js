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


function menuLateral(){


    $('#menuLateral').load('js/menuLateral.php');
    


}

function mudarTexto(cidade){

   if(cidade == 2){
        document.getElementById("textoCidade").innerHTML = "<font color='red'><b>EUA</b></font><br /> Aqui rola muito dinheiro e grupos organizados de venda de drogas, os bandidos mais perigosos estão por aqui mas apenas os melhores policiais podem prender nessas terras.<br /><br /><br /><br /> <table summary='tabela de cidade' class='conteudo2'><tr><td>Energia:</td><td><b><font color='red'>40</font></b></td></tr><tr></tr></table>";
    }
    else if(cidade == 3){
        document.getElementById("textoCidade").innerHTML = "<font color='red'><b>Inglaterra</b></font> <br /> Os maiores traficantes da Europa gostam de ter casas aqui, e por isso seus centros de comando também ficam na Inglaterra.<br /><br /><br /><br /><br /> <table summary='tabela de cidade' class='conteudo2'><tr><td>Energia:</td><td><b><font color='red'>30</font></b></td></tr></tr></table>";
    }
    else if(cidade == 4){
        document.getElementById("textoCidade").innerHTML = "<font color='red'><b>França</b></font> <br />A França é um ótimo lugar de se viver e por isso muitos chefes do crime vivem aqui, trabalhe com a Interpol e pegue o máximo que poder. <br /> <br /> <br /> <br /> <br /> <table summary='tabela de cidade' class='conteudo2'><tr><td>Energia:</td><td><b><font color='red'>20</font></b></td></tr></table>";
    }
    else if(cidade == 5){
        document.getElementById("textoCidade").innerHTML = "<font color='red'><b>Argentina</b></font> <br /> Aqui é um bom lugar para você começar a fazer seu nome prendendo bandidos internacionais. <br /><br /><br /><br /><br /><br /> <table summary='tabela de cidade' class='conteudo2'><tr><td>Energia:</td><td><b><font color='red'>10</font></b></td></tr></table>";
    }
    
    else{
        document.getElementById("textoCidade").innerHTML = "<b>Escolha um País.</b>";
    }

   


}


function procurarBandidos(bairro){
    var ajax = iniciarAjax();
   if(ajax){
       ajax.onreadystatechange = function(){
           if(ajax.readyState == 4){
               if(ajax.status == 200){
                   if(ajax.responseText == "erro"){

                     window.location = "index_sair.php";
                    }else{


                   document.getElementById("resposta").innerHTML = ajax.responseText;
                   menuLateral();
                    }
               }else{
                   alert(ajax.statusText);
               }

           }
       }
   }
       

        dados = "bairro="+bairro;
        ajax.open("POST", "js/mundo.php", true);
        ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        ajax.send(dados);
        document.getElementById("resposta").innerHTML = "<div class='conteudo'><table summary='load' class='conteudo'><tr><td width='30px'><img src='img/carregar.gif' alt='carregar' /></td><td><b>Procurando Bandido...</b></td></tr></table></div>";
           

}


function procurarBandidosBatalhao(){
    var ajax = iniciarAjax();
   if(ajax){
       ajax.onreadystatechange = function(){
           if(ajax.readyState == 4){
               if(ajax.status == 200){
                   document.getElementById("resposta_batalhao").innerHTML = ajax.responseText;
                   menuLateral();
               }else{
                   alert(ajax.statusText);
               }

           }
       }
   }


        dados = "bairro=5";
        ajax.open("POST", "js/cidade.php", true);
        ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        ajax.send(dados);
        document.getElementById("resposta_batalhao").innerHTML = "<div class='conteudo'><table summary='load' class='conteudo'><tr><td width='30px'><img src='img/carregar.gif' alt='carregar' /></td><td><b>Procurando Bandido...</b></td></tr></table></div>";


}


function lutar(id){
 
//   ajax = iniciarAjax();
//   if(ajax){
//       ajax.onreadystatechange = function(){
//           if(ajax.readyState == 4){
//               if(ajax.status == 200){
//                 
//                    document.getElementById("resposta").innerHTML = ajax.responseText;
//                    menuLateral();
//               }else{
//                   alert(ajax.statusText);
//               }
//           }
//       }
//   }
//
//   dados = "id="+id;
//   ajax.open("POST", "js/prender_mundo.php", true);
//   ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
//   ajax.send(dados);
//   document.getElementById("resposta").innerHTML = "<div class='conteudo'><table summary='load' class='conteudo'><tr><td width='30px'><img src='img/carregar.gif' alt='carregar' /></td><td><b>Tentando bater no bandido...</b></td></tr></table></div>";
//    
    
    $('#resposta').hide(0);
    $('#load').show(0);
    
    $('#resposta').load('js/prender_mundo.php', {id:id}, function(){
        $('#resposta').show(0);
        $('#load').hide(0);
        
        
    })
    


}

function lutar_batalhao(id){

   ajax = iniciarAjax();
   if(ajax){
       ajax.onreadystatechange = function(){
           if(ajax.readyState == 4){
               if(ajax.status == 200){

                    document.getElementById("resposta_batalhao").innerHTML = ajax.responseText;
                    menuLateral();
               }else{
                   alert(ajax.statusText);
               }
           }
       }
   }

   dados = "id="+id;
   ajax.open("POST", "js/prender_batalhao.php", true);
   ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
   ajax.send(dados);
    document.getElementById("resposta_batalhao").innerHTML = "<div class='conteudo'><table summary='load' class='conteudo'><tr><td width='30px'><img src='img/carregar.gif' alt='carregar' /></td><td><b>Tentando bater no bandido...</b></td></tr></table></div>";



}

function propina(id){
  
//   ajax = iniciarAjax();
//   if(ajax){
//       ajax.onreadystatechange = function(){
//           if(ajax.readyState == 4){
//               if(ajax.status == 200){
//
//                    document.getElementById("resposta").innerHTML = ajax.responseText;
//                    menuLateral();
//               }else{
//                   alert(ajax.statusText);
//               }
//           }
//       }
//   }
//
//   dados = "id="+id;
//   ajax.open("POST", "js/prender2.php", true);
//   ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
//   ajax.send(dados);
//   document.getElementById("resposta").innerHTML = "<div class='conteudo'><table summary='load' class='conteudo'><tr><td width='30px'><img src='img/carregar.gif' alt='carregar' /></td><td><b>Honestidade...</b></td></tr></table></div>";
//    
    
    $('#resposta').hide(0);
    $('#load').show(0);
    
    $('#resposta').load('js/prender2.php', {id:id}, function(){
        $('#resposta').show(0);
        $('#load').hide(0);
        
        
    })


}





