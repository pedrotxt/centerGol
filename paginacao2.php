<?php
if ($p <= 5 and $p_total >= 10) {
	$pag_inicio = 1;
	$pag_fim = 10;
} else if ($p <= 5 and $p_total < 10) {
	$pag_inicio = 1;
	$pag_fim = $p_total;
} else if ($p > 5) {
	$pag_inicio = $p - 5;
	$pag_fim = $p + 5;
}

if ($pag_fim > $p_total) {
	$pag_fim = $p_total;
}

$pag_fim_calc = $p_total - $p;

if ($pag_fim_calc == 0) {
	$pag_inicio = $pag_inicio - 4;
} else if ($pag_fim_calc == 1) {
	$pag_inicio = $pag_inicio - 3;
} else if ($pag_fim_calc == 2) {
	$pag_inicio = $pag_inicio - 2;
} else if ($pag_fim_calc == 3) {
	$pag_inicio = $pag_inicio - 1;
}

if ($pag_inicio < 1) {
	$pag_inicio = 1;
}

for ($i = $pag_inicio; $i <= $pag_fim; $i++) {


if ($i == $pag_inicio) {

if ($i == $p) {
	$paginacao = "<b>". $i ."</b>";
} else {
	$paginacao = "<a href=". $p_nome .".php?id=". $p_id ."&p=". $i .">". $i ."</a>";
}

} else {

if ($i == $p) {
	$paginacao .= " | <b>". $i ."</b>";
} else {
	$paginacao .= " | <a href=". $p_nome .".php?id=". $p_id ."&p=". $i .">". $i ."</a>";
}

}


}
?>
<div id="divide"></div>

<div class="box_branco">
	<div class="topo_esquerdo"><div class="topo_direito"><div class="topo_meio"></div></div></div>
	<div class="conteudo">

<div id="align_center"><?=$paginacao?></div>

	</div>
	<div class="baixo_esquerdo"><div class="baixo_direito"><div class="baixo_meio"></div></div></div>
</div>