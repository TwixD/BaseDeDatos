<?php
class BaseDeDatos{
	private $conexion;
	private $servidor;
	private $usuario;
	private $password;
	private $puerto;
	private $db;
	public $tipo;

	public function __construct($servidor,$usuario,$password,$db,$puerto,$tipo='mysql'){
		$this->servidor = $servidor;
		$this->usuario = $usuario;
		$this->password = $password;
		$this->db = $db;
		$this->puerto = $puerto;
		$this->tipo = trim(strtolower($tipo));
	

	if($this->tipo == "mysql"){
		$this->conexion = mysql_connect($this->servidor.":".$this->puerto,$this->usuario,$this->password);
		mysql_select_db($this->db);
	}
	if($this->tipo == "mssql"){
		$this->conexion = mssql_connect($this->servidor.":".$this->puerto,$this->usuario,$this->password);
		mssql_select_db($this->db);
	}
	}

	public function setQuery($query){
		if($this->tipo == 'mysql'){
			$query = mysql_real_escape_string($query);
			return $this->idConsulta = mysql_query($query);
		}
		if($this->tipo == 'mssql'){
			$query = str_replace("'", "''", $query);
			return $this->idConsulta = mysql_query($query);
		}
	}

	public function queryToArray(){
		if($this->tipo == 'mysql'){
			return mysql_fetch_assoc($this->idConsulta);
		}
		if($this->tipo == 'mssql'){
			return mssql_fetch_assoc($this->idConsulta);
		}
	}

	public function __destruct(){
		if($this->tipo == 'mysql'){
			mysql_close($this->conexion);
		}
		if($this->tipo == 'mssql'){
			mssql_close($this->conexion);
		}
	}
}
?>