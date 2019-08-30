        <script type='text/javascript' src='js/jquery-1.3.2.min.js'></script>
        <script type='text/javascript' src='js/jquery-ui.js'></script>
        <link type='text/css' href='js/black-tie/jquery-ui-1.8.18.custom.css' rel='stylesheet' />

            <script type="text/javascript">

                $(function() {







                    // Dialog			
                    $('#dialog').dialog({
                        autoOpen: true,
                        width: 450,
                        buttons: {
                            "Desativar Tutorial": function() {
                                $(this).dialog("close");
                                location.href = "inicio.php?desabilitar";

                            },
                            "Continuar Tutorial": function() {
                                $(this).dialog("close");
                                $('#dialog2').dialog('open');

                            }

                        }
                    });

                    $('#dialog2').dialog({
                        autoOpen: false,
                        width: 450,
                        buttons: {
                            "Continuando...": function() {
                                $(this).dialog("close");
                                $('#dialog3').dialog('open');
                            }
                        }
                    });

                    $('#dialog3').dialog({
                        autoOpen: false,
                        width: 450,
                        buttons: {
                            "Continuando...": function() {
                                $(this).dialog("close");
                                $('#dialog4').dialog('open');
                            }
                        }
                    });

                    $('#dialog4').dialog({
                        autoOpen: false,
                        width: 450,
                        buttons: {
                            "Continuando...": function() {
                                $(this).dialog("close");
                                $('#dialog5').dialog('open');
                            }
                        }
                    });

                    $('#dialog5').dialog({
                        autoOpen: false,
                        width: 450,
                        buttons: {
                            "Continuando...": function() {
                                $(this).dialog("close");
                                $('#dialog6').dialog('open');
                            }
                        }
                    });

                    $('#dialog6').dialog({
                        autoOpen: false,
                        width: 450,
                        buttons: {
                            "Continuando...": function() {
                                $(this).dialog("close");
                                $('#dialog7').dialog('open');
                            }
                        }
                    });
					$('#dialog7').dialog({
                        autoOpen: false,
                        width: 450,
                        buttons: {
                            "Continuando...": function() {
                                $(this).dialog("close");
                                $('#dialog8').dialog('open');
                            }
                        }
                    });
					 $('#dialog8').dialog({
                        autoOpen: false,
                        width: 450,
                        buttons: {
                            "Continuando...": function() {
                                $(this).dialog("close");
                                $('#dialog9').dialog('open');
                            }
                        }
                    });
					$('#dialog9').dialog({
                        autoOpen: false,
                        width: 450,
                        buttons: {
                            "Continuando...": function() {
                                $(this).dialog("close");
                                $('#dialog10').dialog('open');
                            }
                        }
                    });
					$('#dialog10').dialog({
                        autoOpen: false,
                        width: 450,
                        buttons: {
                            "Tutorial Acabou, Agora você está mais Experiente! Clique Aqui para Receber seu VIP": function() {
                                $(this).dialog("close");
                                location.href = "ganhar_vip.php";
                            }
                        }
                    });
					
                });
            </script>

            <div id="dialog" title="Tutorial centergol">
                <div class='texto_imagem'>
                    <img src="figuras/principal/treinador.png" alt="Capitão" >
                        Bem Vindo ao centergol, sou o Treinador "Alex" e vou te ensinar a jogar!</div>
                <br/><br/>
               <strong> O que é o centergol?</strong>
                <br/><br/>
                É atualmente o jogo de futebol online mais completo, mais interativo e sem dúvidas o mais divertido. É um jogo que está sempre inovando, conta atualmente com seu sistema de contrato para que os usuários possam sentir a sensação de ser contratado por um clube, de ter seu passe ofertado, de sentir o gosto de poder escolher entre vários clubes para defender. Marca gols com o sistema automático e também com dois entretenimentos, Passe Certo e Pênalti. Seque o seu rival e marque gol para o adversário dele na Rodada. Pode também desafiar os usuários em cobranças de pênalti valendo LC (dinheiro virtual do jogo), computando seus resultados e saldo. Conta também com um sistema de mercado interno para que os usuários possam vender seus ítens que não querem mais, o que torna o jogo cada vez mais interativo. Entre nessa você também e venha descobrir o prazer de jogar centergol, que a cada dia que passa só pensa em trazer mais novidades.
                <br /><br />
                <strong>OBS: Ao completar o tutorial você ganha 1 dia de VIP Gratis!</strong>
            </div>


            <div id="dialog2" title="Tutorial centergol">
                 <div class='texto_imagem'>
                    <img src="figuras/principal/treinador.png" alt="Capitão" >
                        Bem Vindo ao centergol, sou o Treinador "Alex" e vou te ensinar a jogar!</div>
                <br/><br/>
               <strong> O que é Rodada?</strong>
                <br/><br/>
                Sistema de rodada serve para você ver quem seu time está enfrentando, se ele está perdendo ou ganhando, você pode ver o publico atual do jogo e também a Renda atual que o jogo lucrou.
                <br /> <br />
                <strong>Cada rodada dura 24 Horas.</strong>
                <br /><br />
                <div id="jogos" style="margin-top: 5px;border-top: 1px dashed #AAAAAA;padding-top: 5px">
                    <font color="red">
                        <b>Jogos:</b> </font> No sistema de rodada você verifica com quem seu time está jogando, se está ganhando ou perdendo.</div>
                <div id="publico" style="margin-top: 5px;border-top: 1px dashed #AAAAAA;padding-top: 5px">
                    <font color="red">
                        <b>Publico:</b> </font> É gerado com o número de online nos dois times na troca da rodada.
                </div>
                <div id="renda" style="margin-top: 5px;border-top: 1px dashed #AAAAAA;padding-top: 5px">
                    <font color="red">
                        <b>Renda:</b> </font> A Renda do jogo só é aplicada ao time mandante.
                 </div>
                <div id="placar" style="margin-top: 5px;border-top: 1px dashed #AAAAAA;padding-top: 5px">
                    <font color="red">
                        <b>Diferença:</b> </font> Para vencer o jogo a diferença tem que ser no mínimo 60%
                 </div>

            </div>


            <div id="dialog3" title="Tutorial centergol">
                 <div class='texto_imagem'>
                    <img src="figuras/principal/treinador.png" alt="Capitão" >
                        Bem Vindo ao centergol, sou o Treinador "Alex" e vou te ensinar a jogar!</div>
                <br/><br/>
               <strong> Meu Perfil</strong>
                <br/><br/>
                No Meu Perfil você ver todas as suas estatísticas como:<br /><br /><strong> Nome<br /> Vip<br /> Time<br /> Avatar<br /> Dinheiro<br /> Camisa<br /> Amigos<br /> Itens,<br /> Conquistas<br /> Mercado<br /> Convidados<br /> Carreira<br /> Historico<br /> Seu ranking<br /> Desafios<br /> Contratos<br /> etc...</strong>
                <br /><br />
                <div id="troca" style="margin-top: 5px;border-top: 1px dashed #AAAAAA;padding-top: 5px">
                    <font color="red">
                        <b>Trocas na Temporada:</b> </font> Você só pode trocar de time 3 vezes na Temporada</div>
            </div>


            <div id="dialog4" title="Tutorial centergol">
                <div class='texto_imagem'>
                    <img src="figuras/principal/treinador.png" alt="Capitão" >
                        Bem Vindo ao centergol, sou o Treinador "Alex" e vou te ensinar a jogar!</div>
                <br/><br/>
               <strong> Meu Time</strong>
                <br/><br/>
                No Meu Time você ver todas as estatísticas do seu Time como:<br /><br /><strong> Nome<br /> Estado<br /> Gols<br /> Titulos<br /> Estádio<br /> Total de Jogadores<br /> Jogadores Online<br /> Quantas pessoas está secando seu Time<br /> Reputação,<br /> Cúpula<br /> Melhor da Rodada<br /> etc...</strong>
                <br /><br />
                <div id="troca" style="margin-top: 5px;border-top: 1px dashed #AAAAAA;padding-top: 5px">
                    <font color="red">
                        <b>Trocar de Time:</b> </font> Você só pode sair do seu Time atual depois que marcar 100 Gols com a Camisa !</div>
            </div>

            <div id="dialog5" title="Tutorial centergol">
            <div class='texto_imagem'>
                    <img src="figuras/principal/treinador.png" alt="Capitão" >
                        Bem Vindo ao centergol, sou o Treinador "Alex" e vou te ensinar a jogar!</div>
                        <br/><br/>
               <strong> Procurar</strong>
                <br/><br/>
                No procurar você pode encontrar qualquer jogador registrado no centergol, Basta você digitar as iniciais de um jogador ou o nome Completo<br />
                Exemplo:
                Meu é Alex se eu pesquisar por Ale vai procurar todos os Jogadores com as Iniciais Ale
                <br /><br />
               <div id="troca" style="margin-top: 5px;border-top: 1px dashed #AAAAAA;padding-top: 5px">
                    <font color="red">
                        <b>Importante:</b> </font> Sistema listará apenas 30 resultados em ordem de gols.</div>
               <div id="troca" style="margin-top: 5px;border-top: 1px dashed #AAAAAA;padding-top: 5px">
                    <font color="red">
                        <b>Importante:</b> </font> Seja o mais preciso possível na sua busca.</div>
           </div>
           
           
                       <div id="dialog6" title="Tutorial centergol">
            <div class='texto_imagem'>
                    <img src="figuras/principal/treinador.png" alt="Capitão" >
                        Bem Vindo ao centergol, sou o Treinador "Alex" e vou te ensinar a jogar!</div>
                        <br/><br/>
               <strong> STFC</strong>
                <br/><br/>
                Faça a sua denúncia e aguarde o contato dos administradores.
                <br /><br />
               <div id="troca" style="margin-top: 5px;border-top: 1px dashed #AAAAAA;padding-top: 5px">
                    <font color="red">
                        <b>Importante:</b> </font> Apenas Denúncias Importantes e que você tenha certeza!</div>
           </div>
           
           
           <div id="dialog7" title="Tutorial centergol">
            <div class='texto_imagem'>
                    <img src="figuras/principal/treinador.png" alt="Capitão" >
                        Bem Vindo ao centergol, sou o Treinador "Alex" e vou te ensinar a jogar!</div>
                        <br/><br/>
               <strong> Campeões</strong>
                <br/><br/>
                Nessa categoria ficam gravados todos os campeões de todas as temporadas que já passou!
    
           </div>
           
            <div id="dialog8" title="Tutorial centergol">
            <div class='texto_imagem'>
                    <img src="figuras/principal/treinador.png" alt="Capitão" >
                        Bem Vindo ao centergol, sou o Treinador "Alex" e vou te ensinar a jogar!</div>
                        <br/><br/>
               <strong> Shopping</strong>
                <br/><br/>
                Shopping é nossa LOJA, nele você pode comprar VIP, LC Cash, A cada compra no site você ganha Pontos com esse pontos você pode trocar por + VIPs e LC Cash no Propio Shopping!
                
                Algumas Vantagens VIP<BR /><BR />
                
<table width="420" cellpadding="0" cellspacing="0">
	<tr>
		<td width="240px" id="usuario_vip1"><span class="img16"><img width="16" height="16" src="figuras/principal/usuario_vip.png" title="Usuário VIP" alt="Usuário VIP"></span> Usuário VIP</td>
		<td width="240px"><span class="img16"><img width="16" height="16" src="figuras/principal/usuario_normal.png" title="Usuário Normal" alt="Usuário Normal"></span> Usuário Normal</td>
	</tr>
	<tr>
		<td style="padding-top: 5px">Escolhe a cor do nome</td>
		<td style="padding-top: 5px">Nome preto</td>
	</tr>
	<tr>
		<td style="padding-top: 5px">Chute Automático: <b>4</b> minutos</td>
		<td style="padding-top: 5px">Chute Automático: <b>8</b> minutos</td>
	</tr>
	<tr>
		<td style="padding-top: 5px">Entretenimentos: <b>4</b> minutos</td>
		<td style="padding-top: 5px">Entretenimentos: <b>8</b> minutos</td>
	</tr>
	<tr>
		<td style="padding-top: 5px">Pode usar Energia</td>
		<td style="padding-top: 5px">Não pode usar Energia</td>
	</tr>
	<tr>
		<td style="padding-top: 5px">Pode usar Veneno</td>
		<td style="padding-top: 5px">Não pode usar Veneno</td>
	</tr>
	<tr>
		<td style="padding-top: 5px">Pode usar Sacola</td>
		<td style="padding-top: 5px">Não pode usar Sacola</td>
	</tr>
	<tr>
		<td style="padding-top: 5px">Pode Secar um time</td>
		<td style="padding-top: 5px">Não pode Secar um time</td>
	</tr>
</table>
<br /><br />
<div id="troca" style="margin-top: 5px;border-top: 1px dashed #AAAAAA;padding-top: 5px">
                    <font color="red">
                        <b>Importante:</b> </font> Comprando VIP pelo site ele vai diretamente para seus ITENS ou seja se você não usar ele não vai acabar, Apenas usuários que compra VIP pelo site pode negociar/vender ele no Mercado do jogo.</div>    
           </div>
           
                       <div id="dialog9" title="Tutorial centergol">
            <div class='texto_imagem'>
                    <img src="figuras/principal/treinador.png" alt="Capitão" >
                        Bem Vindo ao centergol, sou o Treinador "Alex" e vou te ensinar a jogar!</div>
                        <br/><br/>
               <strong> Chutes</strong>
                <br/><br/>
               <div id="troca" style="margin-top: 5px;border-top: 1px dashed #AAAAAA;padding-top: 5px">
                    <font color="red">
                        <b>Chute Automatico:</b> <br /><img src="figuras/principal/botao_chute.png" /><br /> </font>Quando acaba o tempo que fica na parte superior a Direita você faz 1 Gol Automatico, No Tutorial passado explicamos as vantagens VIP ou seja Usuário Normal 8 minutos, Usuários VIP 4 Minutos</div>
               <div id="troca" style="margin-top: 5px;border-top: 1px dashed #AAAAAA;padding-top: 5px">
                    <font color="red">
                        <b>Secar Automatico:</b><br /><img src="figuras/principal/botao_secar.png" /><br /> </font>Você seleciona um time para Secar para marcar gol automaticamente para o adversário dele</div>
                             <div id="troca" style="margin-top: 5px;border-top: 1px dashed #AAAAAA;padding-top: 5px">
                    <font color="red">
                        <b>Entretenimentos:</b><br /><img src="figuras/principal/botao_entre.png" /><br /> </font>Quando acaba o tempo que fica na parte superior a Direita você ganha 1 chance de fazer o Passe Certo e Chutar Pênalti, No Tutorial passado explicamos as vantagens VIP ou seja Usuário Normal 8 minutos, Usuários VIP 4 Minutos</div>
           </div>
           
                                  <div id="dialog10" title="Tutorial centergol">
            <div class='texto_imagem'>
                    <img src="figuras/principal/treinador.png" alt="Capitão" >
                        Bem Vindo ao centergol, sou o Treinador "Alex" e vou te ensinar a jogar!</div>
                        <br/><br/>
               <strong> Prêmio Diario</strong>
                <br/><br/>
               <div id="troca" style="margin-top: 5px;border-top: 1px dashed #AAAAAA;padding-top: 5px">
                    <font color="red">
                        <b>Prêmio Diario:</b> <br /><img src="figuras/principal/diario.png" /><br /> </font>No Prêmio diario você pode receber prêmios aleatorios e todo dia depois das 00:00 você pode receber novamente algum desses Prêmios!<br /></div>
           
           </div>