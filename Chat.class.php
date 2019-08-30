<?php
class Chat{
	private $nome;
	private $mensagem;
	private $tempoLimite;

	public function __construct(){
		$this->tempoLimite = TEMPO_LIMITE;
	}

	public function setNome($nome){
		$this->nome = $nome;
	}
	public function getNome(){
		return $this->nome;
	}
	public function setMensagem($msg){
		$this->mensagem = $msg;
	}
	public function getMensagem(){
		return $this->mensagem;
	}

	public function inserir(){
		$strSQL = "INSERT INTO chat SET nome = ?, mensagem = ? , datahora = NOW()";
		$stmt  = BD::getConn()->prepare($strSQL);
		$data  = array($this->getNome(), $this->getMensagem());
		return $stmt->execute($data);
	}
	public function excluir(){
		$strSQL = "DELETE FROM chat WHERE DATE_ADD(datahora, INTERVAL {$this->tempoLimite} DAY) < NOW()";
		$stmt   = BD::getConn()->query($strSQL);
	}
	public function listar(){
		$strSQL = "SELECT nome,mensagem FROM chat ORDER BY id DESC LIMIT 0, 30";
		return BD::getConn()->query($strSQL);
	}


}





