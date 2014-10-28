<?php

class db{

  private $dbhost;
  private $dbuser;
  private $dbpass;
  private $dbname;
  private $conn;

//En el constructor de la clase establecemos los parámetros de conexión con la base de datos

  function __construct($dbuser = 'root', $dbpass = '', $dbname = 'feedback', $dbhost = 'localhost'){

    $this->dbhost = $dbhost;
    $this->dbuser = $dbuser;
    $this->dbpass = $dbpass;
    $this->dbname = $dbname;

  }

//El método abrir establece una conexión con la base de datos

  public function abrir(){
    $this->conn = mysqli_connect($this->dbhost, $this->dbuser, $this->dbpass,$this->dbname);
    if (mysqli_connect_errno()) {
      die('Error al conectar con mysql');
    }

  }

//El método "consulta" ejecuta la sentencia select que recibe por parámetro "$query" a la base de datos y devuelve un array asociativo con los datos que obtuvo de la base de datos para facilitar su posteiror manejo.

  public function consulta($query){
    $valores = array();
	
    $result = mysqli_query($this->conn,$query);
    if (!$result) {
      die('Error query BD:' . mysqli_error());
    }else{
      $num_rows= mysqli_num_rows($result);
      for($i=0;$i<$num_rows;$i++){
        $row = mysqli_fetch_assoc($result);
        array_push($valores, $row);
      }
    }

    return $valores;
  }

//La función sql nos permite ejecutar una senetencia sql en la base de datos, se suele utilizar para senetencias insert y update.

  public function sql($sql){
    $resultado=mysqli_query($this->conn,$sql);
    return $resultado;
  }
  //La función id nos devuelve el identificador del último registro insertado en la base de datos

  public function id(){
    return mysqli_insert_id($this->conn);
  }

//La función "cerrar" finaliza la conexión con la base de datos.

  public function cerrar(){
    mysqli_close($this->conn);
  }

//La función 'escape' escapa los caracteres especiales de una cadena para usarla en una sentencia SQL

  public function escape($value){
    return mysqli_real_escape_string($this->conn,$value);
  }
  //Funcion Para obtener los datos de las tiendas.
  public function select($tbl){
	  $res = $this->sql("SELECT * FROM ".$tbl);  
	 return $res;
  }
	//Funcion Para guardar los registros.
  public function save($datos,$codigo){
	  $sql = 'INSERT INTO datos(nombre, apellido, email,telefono,dni,codigo,recogida) VALUES("'.$datos['nombre'].'","'.$datos['apellidos'].'","'.$datos['email'].'","'.$datos['telefono'].'","'.$datos['dni'].'","'.$codigo.'","'.$datos['tienda'].'")';
	  $res = $this->sql($sql);  
	  if($res){
		  $resp = "Su registro a sido confirmado";
	  }else{
		  $resp = "NO se ha logrado terminar el registro. Por favor vuelva a intentarlo.";
	  }
	 return $resp;
  }
  function urls_amigables($url) {
 
      // Tranformamos todo a minusculas
 
      $url = strtolower($url);
 
      //Rememplazamos caracteres especiales latinos
 
      $find = array('á', 'é', 'í', 'ó', 'ú', 'ñ');
 
      $repl = array('a', 'e', 'i', 'o', 'u', 'n');
 
      $url = str_replace ($find, $repl, $url);
 
      // Añadimos los guiones
 
      $find = array(' ', '&', '\r\n', '\n', '+');
      $url = str_replace ($find, '-', $url);
 
      // Eliminamos y Reemplazamos otros carácteres especiales
 
      $find = array('/[^a-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/');
 
      $repl = array('', '-', '');
 
      $url = preg_replace ($find, $repl, $url);
 
      return $url;
 
}
}