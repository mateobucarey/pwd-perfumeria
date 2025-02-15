<?php
class Producto {

    private $idproducto;
    private $pronombre;
    private $prodetalle;
    private $procantstock;
    private $imagenproducto; 
    private $mensajeoperacion;

    public function __construct(){
        $this->idproducto="";
        $this->pronombre="";
        $this->prodetalle="";
        $this->procantstock="";
        $this->imagenproducto="";
        $this->mensajeoperacion ="";
    }

    public function setear($idproducto, $pronombre, $prodetalle, $procantstock,$imagenproducto){
        $this->setIdProducto($idproducto);
        $this->setProNombre($pronombre);
        $this->setProDetalle($prodetalle);
        $this->setProCantstock($procantstock);
        $this->setImagenProducto($imagenproducto);
        }

    public function getIdProducto(){
         return $this->idproducto;
    }
    public function setIdProducto($valor){
        $this->idproducto = $valor;
    }

    public function getProNombre(){
        return $this->pronombre;  
    }
    public function setProNombre($valor){
        $this->pronombre = $valor;
    }

    public function getProDetalle(){
        return $this->prodetalle;   
    }
    public function setProDetalle($valor){
        $this->prodetalle = $valor;
    }

    public function getProCantstock(){
        return $this->procantstock;
    }
    public function setProCantstock($valor){
        $this->procantstock = $valor;
    }

    public function getImagenProducto(){
        return $this->imagenproducto;
    }
    public function setImagenProducto($valor){
        $this->imagenproducto = $valor;
    }

    public function getmensajeoperacion(){
        return $this->mensajeoperacion;
    }
    public function setmensajeoperacion($valor){
        $this->mensajeoperacion = $valor;
    }
  
    /**
	 * Recupera los datos del usuario por idusuario
	 * @param int $idusuario
	 * @return true en caso de encontrar los datos, false en caso contrario 
	 */		
	public function cargar(){
        $resp = false;
        $base=new BaseDatos();
        $sql = "SELECT * FROM producto WHERE idproducto = ".$this->getIdProducto()."";
        if ($base->Iniciar()) {
            $res = $base->Ejecutar($sql);
            if($res>-1){
                if($res>0){
                    $row = $base->Registro();
                    $this->setear($row['idproducto'], $row['pronombre'], $row['prodetalle'],$row['procantstock'],$row['imagenproducto']);
                }
            }    
        } else {
            $this->setmensajeoperacion("Producto->listar: ". $base->getError());
        }
        return $resp;
    }

     /**
     * Esta función lee los valores actuales de los atributos del objeto e inserta un nuevo
     * registro en la base de datos a partir de ellos.
     * Retorna un booleano que indica si le operación tuvo éxito
     * 
     * @return boolean
     */
    public function insertar(){
        $resp = false;
        $base=new BaseDatos();
        $sql="INSERT INTO producto (pronombre, prodetalle, procantstock, imagenproducto)
        VALUES ('".$this->getProNombre()."','".$this->getProDetalle()."','".$this->getProCantstock()."','".$this->getImagenProducto()."')";
      if ($base->Iniciar()) {
        if ($elid = $base->Ejecutar($sql)){
            $this->setIdProducto($elid);
            $resp = true;
        }else{
            $this->setmensajeoperacion("Producto->insertar: ".$base->getError());
        }

    }else{
        $this->setmensajeoperacion("Producto->insertar: ".$base->getError());
    }
    return $resp;
  }

   /**
     * Esta función lee los valores actuales de los atributos del objeto y los actualiza en la
     * base de datos.
     * Retorna un booleano que indica si le operación tuvo éxito
     * 
     * @return boolean
     */
    public function modificar(){
        $resp = false;
        $base = new BaseDatos();
        $sql = "UPDATE producto SET pronombre = '".$this->getProNombre()."',prodetalle = '".$this->getProDetalle()."',procantstock = '".$this->getProCantStock().
        "', imagenproducto='".$this->getImagenProducto()."' WHERE idproducto = '". $this->getIdProducto()."' ";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($sql)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion("Producto->modificar: ".$base->getError());
            }
        } else {
            $this->setmensajeoperacion("Producto->modificar: ".$base->getError());
        }
        return $resp;
    }

     /**
     * Esta función lee el id actual del objeto y si puede lo borra de la base de datos
     * Retorna un booleano que indica si le operación tuvo éxito
     * 
     * @return boolean
     */
    public function eliminar(){
        $resp = false;
        $base = new BaseDatos();

        $sql = "DELETE FROM producto WHERE idproducto = ".$this->getIdProducto()."";

        if ($base->Iniciar()) {
          if ($base->Ejecutar($sql)) {
            return true;
          } else {
            $this->setmensajeoperacion("Producto->eliminar: ".$base->getError());
          }
        } else {
          $this->setmensajeoperacion("Producto->eliminar: ".$base->getError());
        }
        return $resp;
    }
    
    /**
     * Esta función recibe condiciones de busqueda en forma de consulta sql para obtener
     * los registros requeridos.
     * Si por parámetro se envía el valor "" se devolveran todos los registros de la tabla
     * 
     * La función devuelve un arreglo compuesto por todos los objetos que cumplen la condición indicada
     * por parámetro
     * 
     * @return array
     */
    public function listar($parametro = ""){
        $arreglo = array();
        $base = new BaseDatos();
        $sql = "SELECT * FROM producto ";
    
       if ($parametro != "") {
         $sql .= "WHERE".$parametro;
        }
       $res = $base->Ejecutar($sql);
       if ($res > -1) {
         if ($res > 0) {
           while ($row = $base->Registro()) {
           
            $obj= new Producto();

             $obj->setear($row['idproducto'], $row['pronombre'], $row['prodetalle'],$row['procantstock'],$row['imagenproducto']);
    
             array_push($arreglo, $obj);
           }
         }
        }
            return $arreglo;
        }

     /**
     * Esta función lee todos los valores de todos los atributos del objeto y los devuelve
     * en un arreglo asociativo
     * 
     * @return array
     */
    public function obtenerInfo(){
        $info = [];
        $info['idproducto'] = $this->getIdProducto();
        $info['pronombre'] = $this->getProNombre();
        $info['prodetalle'] =$this->getProDetalle();
        $info['procantstock'] =$this->getProCantStock();
        return $info;
    }

}

?>
