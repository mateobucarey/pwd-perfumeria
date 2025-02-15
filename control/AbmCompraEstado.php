<?php
require_once __DIR__ . '/../vendor/autoload.php';


 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\Exception;
 use PHPMailer\PHPMailer\SMTP; 

class AbmCompraEstado{

     /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     * @param array $param
     * @return CompraEstado
     */
    private function cargarObjeto($param){

        $obj = null;
        if( array_key_exists('idcompraestado',$param) and array_key_exists('idcompra',$param)     
          and array_key_exists('idcompraestadotipo',$param) and array_key_exists('cefechaini',$param) and array_key_exists('cefechafin',$param)){
        
            $objCompra = new Compra();
            $objCompra->setIdCompra($param['idcompra']);
            $objCompra->cargar();
            $objTipoEstado = new CompraEstadoTipo();
            $objTipoEstado->setIdCompraEstadoTipo($param['idcompraestadotipo']);
            $objTipoEstado->cargar();

            $obj = new CompraEstado();
            $obj->setear($param['idcompraestado'], $objCompra,$objTipoEstado,$param['cefechaini'],$param['cefechafin']);
        }
        return $obj;
    }

    /**
     * Espera como parametro un arreglo asociativo donde las claves coinciden con los nombres de las variables instancias del objeto
     *  que son claves
     * @param array $param
     * @return CompraEstado
     */
    private function cargarObjetoConClave($param){
        $obj = null;
        if(isset($param['idcompraestado']) ){
            $obj = new CompraEstado();
            $obj->setear($param['idcompraestado'],null,null,null,null);
        }
        return $obj;
    }


     /**
     * Corrobora que dentro del arreglo asociativo estan seteados los campos claves
     * @param array $param
     * @return boolean
     */
    
    private function seteadosCamposClaves($param){
        $resp = false;
        if (isset($param['idcompraestado']))
            $resp = true;
        return $resp;
    }


    /**
     * 
     * @param array $param
     */
    public function alta($param){
        $resp = false;
        $unObjCompraEstado = $this->cargarObjeto($param);
        if ($unObjCompraEstado!=null && $unObjCompraEstado->insertar()){
            $resp = true;
        }
        return $resp;
        
    }

    /**
     * permite eliminar un objeto 
     * @param array $param
     * @return boolean
     */
    public function baja($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $unObjCompraEstado = $this->cargarObjetoConClave($param);
            if ($unObjCompraEstado!=null && $unObjCompraEstado->eliminar()){
                $resp = true;
            }
        }
        
        return $resp;
    }
    
    /**
     * permite modificar un objeto
     * @param array $param
     * @return boolean
     */
    public function modificar($param){
        $resp = false;
        if ($this->seteadosCamposClaves($param)){
            $unObjCompraEstado = $this->cargarObjeto($param);
            if($unObjCompraEstado!=null && $unObjCompraEstado->modificar()){
                $resp = true;
            }
        }
        return $resp;
    }
    
   /**
     * permite buscar un objeto
     * @param array $param
     * @return array
     */
    public function buscar($param){
        $where = " true ";
        if ($param<>null){
            if  (isset($param['idcompraestado']))
                $where.=" and idcompraestado ='".$param['idcompraestado']."'";
            if  (isset($param['idcompra']))
                $where.=" and idcompra ='".$param['idcompra']."'";
            if  (isset($param['idcompraestadotipo']))
                $where.=" and idcompraestadotipo ='".$param['idcompraestadotipo']."'";
            if  (isset($param['cefechaini']))
                $where.=" and cefechaini ='".$param['cefechaini']."'";
            if  (isset($param['cefechafin']))
                $where.=" and cefechafin ='".$param['cefechafin']."'";
        }
        $obj = new CompraEstado();
        $arreglo = $obj->listar($where);
        return $arreglo;
    }


    

    /**
     * Recibe el id(un numero no array) del usuario y coloca la compra en el estado Iniciada
     */
    public function pagarCompra($idusuario){
        $resp = false;
        $objCompra = new AbmCompra();
        $arayCompra = $objCompra->buscarCarrito($idusuario);
        $compra = $arayCompra[0];
        $fecha['idcompra'] = $compra->getIdCompra();
        $fecha['cofecha'] = date('Y-m-d H:i:s');
        $fecha['idusuario'] = $compra->getObjUsuario()->getIdUsuario();
        verEstructura($fecha);
        $compraExitosa = $objCompra->modificar($fecha);
      
        if($compraExitosa){
            $objEstado = new AbmCompraEstado();
            $param['idcompraestado'] = 0;
            $param['idcompra'] = $compra->getIdCompra();
            $param['idcompraestadotipo'] = 1;
            $param['cefechaini'] = date('Y-m-d H:i:s');
            $param['cefechafin'] = null;
            $exito = $objEstado->alta($param);
            $resp = true;
            if($exito){
                $nuevaCompra = new AbmCompra();
                $aux['idcompra'] = 0;
                $aux['cofecha'] = null;
                $aux['idusuario'] = $idusuario;
                $nuevaCompra->alta($aux);
                
               $estadoCompra = $param['idcompraestadotipo'];
               $mensaje = $this->obtenerEstadoCompra($estadoCompra);

               $AbmUsuario = new AbmUsuario();
               $arregloUsuario['idusuario']=$idusuario;
               $usuario = $AbmUsuario->buscar($arregloUsuario);
               $email = $usuario[0]->getUsMail();
               $nombreUsuario = $usuario[0]->getUsNombre();

           
               $asunto = "iniciada";

               $this->enviarMail($email, $nombreUsuario, $asunto, $mensaje);


            }else{
                echo "Algo fallo 2";
            }
        }else{
            echo "Algo fallo";
        }
        return $resp;

    }

    /**
     * Acepta una compra
     */
    public function aceptarCompra($datos){
        $resp = false;
        $objCompra = new AbmCompra();
        $arayCompra = $objCompra->buscar($datos);
        $compra = $arayCompra[0];

        $objEstado = new AbmCompraEstado();
        $param['idcompra'] = $compra->getIdCompra();
        $param['idcompraestadotipo'] = 1;
        $param['cefechafin'] = null;
        $exito = $objEstado->buscar($param);

        if($exito){

            $ItemComprados = new AbmCompraItem();
            $idCompra['idcompra'] = $param['idcompra'];
            $listaItems = $ItemComprados->buscar($idCompra);
          
            $objProducto = new AbmProducto();
           
            for ($i = 0; $i < count($listaItems); $i++){
                $idUnItem['idproducto'] = $listaItems[$i]->getObjProducto()->getIdProducto(); 
                $productoGondola = $objProducto->buscar($idUnItem);
                $cantLlevar = $listaItems[$i]->getCiCantidad();
                $stockGondola = $productoGondola[0]->getProCantstock();
                $nuevoStock = $stockGondola - $cantLlevar;
                $datosProductos['idproducto'] = $productoGondola[0]->getIdProducto();
                $datosProductos['pronombre'] = $productoGondola[0]->getProNombre();
                $datosProductos['prodetalle'] = $productoGondola[0]->getProDetalle();
                $datosProductos['procantstock'] = $nuevoStock;
                $datosProductos['imagenproducto'] = $productoGondola[0]->getImagenProducto();
                $objProducto->modificar($datosProductos);
            }


            $estado = $exito[0];
            $param['idcompraestado'] = $estado->getIdCompraEstado();
            $param['idcompra'] = $estado->getObjCompra()->getIdCompra();
            $param['idcompraestadotipo'] = $estado->getObjCompraEstadoTipo()->getIdCompraEstadoTipo();
            $param['cefechaini'] = $estado->getCeFechaIni();
            $param['cefechafin'] = date('Y-m-d H:i:s');
            $objEstado->modificar($param);

            $cancelado = new AbmCompraEstado();
            $param['idcompraestado'] = 0;
            $param['idcompra'] = $compra->getIdCompra();
            $param['idcompraestadotipo'] = 2;
            $param['cefechaini'] = date('Y-m-d H:i:s');
            $param['cefechafin'] = null;
            $exito = $cancelado->alta($param);
        
            $resp = true;

             $estadoCompra = $param['idcompraestadotipo'];
             $mensaje = $this->obtenerEstadoCompra($estadoCompra);

             $AbmUsuario = new AbmUsuario();
             $idusuario = $compra->getObjUsuario()->getIdUsuario();
             $arregloUsuario['idusuario']=$idusuario;
             $usuario = $AbmUsuario->buscar($arregloUsuario);
             $email = $usuario[0]->getUsMail();
             $nombreUsuario = $usuario[0]->getUsNombre();

            $asunto = "aceptada";

             $this->enviarMail($email, $nombreUsuario, $asunto, $mensaje);

        }
        return $resp;
    }

    /**
     * Cambia el Estado A enviada
     */
    public function enviarCompra($datos){
        $resp = false;
        $objCompra = new AbmCompra();
        $arayCompra = $objCompra->buscar($datos);
        $compra = $arayCompra[0];

            $objEstado = new AbmCompraEstado();
            $param['idcompra'] = $compra->getIdCompra();
            $param['idcompraestadotipo'] = 2;
            $param['cefechafin'] = '0000-00-00 00:00:00';
            $exito = $objEstado->buscar($param);
            verEstructura($exito);

            if($exito){
                $estado = $exito[0];
                $param['idcompraestado'] = $estado->getIdCompraEstado();
                $param['idcompra'] = $estado->getObjCompra()->getIdCompra();
                $param['idcompraestadotipo'] = $estado->getObjCompraEstadoTipo()->getIdCompraEstadoTipo();
                $param['cefechaini'] = $estado->getCeFechaIni();
                $param['cefechafin'] = date('Y-m-d H:i:s');
                $objEstado->modificar($param);

                $cancelado = new AbmCompraEstado();
                $param['idcompraestado'] = 0;
                $param['idcompra'] = $compra->getIdCompra();
                $param['idcompraestadotipo'] = 3;
                $param['cefechaini'] = date('Y-m-d H:i:s');
                $param['cefechafin'] = null;
                $exito = $cancelado->alta($param);
                $resp = true;
            
                echo "Envio realizado";


                
             $estadoCompra = $param['idcompraestadotipo'];
             $mensaje = $this->obtenerEstadoCompra($estadoCompra);

             $AbmUsuario = new AbmUsuario();
             $idusuario = $compra->getObjUsuario()->getIdUsuario();
             $arregloUsuario['idusuario']=$idusuario;
             $usuario = $AbmUsuario->buscar($arregloUsuario);
             $email = $usuario[0]->getUsMail();
             $nombreUsuario = $usuario[0]->getUsNombre();

             $asunto = "enviada";

             $this->enviarMail($email, $nombreUsuario, $asunto, $mensaje);

            }else{
                echo "Algo fallo";
            }
            return $resp;
    }

    /**
     * Recibe un obj compraEstado, cancela una compra y devuelve el stock a su estado anterior
     */
    public function cancelarCompra($datos){

        $objEstado = new AbmCompraEstado();
        $busqueda['idcompra'] = $datos['idcompra'];
        $busqueda['cefechafin'] = '0000-00-00 00:00:00';
        $colEstado = $objEstado->buscar($busqueda);
        verEstructura($colEstado);
        
        $estado = $colEstado[0];
        verEstructura($estado);
        $param['idcompraestado'] = $estado->getIdCompraEstado();
        $param['idcompra'] = $estado->getObjCompra()->getIdCompra();
        $param['idcompraestadotipo'] = $estado->getObjCompraEstadoTipo()->getIdCompraEstadoTipo();
        $param['cefechaini'] = $estado->getCeFechaIni();
        $param['cefechafin'] = date('Y-m-d H:i:s');
        if($param['idcompraestadotipo'] != 1 ){
            echo "idcompraestadotipo es distinto de 1 <br>";
            $ItemComprados = new AbmCompraItem();
            $idCompra['idcompra'] = $estado->getObjCompra()->getIdCompra();;
            $listaItems = $ItemComprados->buscar($idCompra);
            $objProducto = new AbmProducto();
            for ($i = 0; $i < count($listaItems); $i++){
                $idUnItem['idproducto'] = $listaItems[$i]->getObjProducto()->getIdProducto();
                $productoGondola = $objProducto->buscar($idUnItem);
                $cantLlevar = $listaItems[$i]->getCiCantidad();
                $stockGondola = $productoGondola[0]->getProCantstock();
                $nuevoStock = $stockGondola + $cantLlevar;
                $datosProductos['idproducto'] = $productoGondola[0]->getIdProducto();
                $datosProductos['pronombre'] = $productoGondola[0]->getProNombre();
                $datosProductos['prodetalle'] = $productoGondola[0]->getProDetalle();
                $datosProductos['procantstock'] = $nuevoStock;
                $datosProductos['imagenproducto'] = $productoGondola[0]->getImagenProducto();
                $objProducto->modificar($datosProductos);
            }
        }

        $exito = $objEstado->modificar($param);
       
        if($exito){
            echo "Se realizo la cancelacion <br>";
            $cancelado = new AbmCompraEstado();
            $param['idcompraestado'] = 0;
            $param['idcompra'] = $estado->getObjCompra()->getIdCompra();;
            $param['idcompraestadotipo'] = 4;
            $param['cefechaini'] = date('Y-m-d H:i:s');
            $param['cefechafin'] = null;
            $exito = $cancelado->alta($param);
            $resp = true;
            
        $estadoCompra = $param['idcompraestadotipo'];
        $mensaje = $this->obtenerEstadoCompra($estadoCompra);

        $AbmUsuario = new AbmUsuario();
        $AbmCompra = new AbmCompra();
        

        $compra = $AbmCompra->buscar($idCompra);

        $idusuario = $compra[0]->getObjUsuario()->getIdUsuario();
        $arregloUsuario['idusuario']=$idusuario;
        $usuario = $AbmUsuario->buscar($arregloUsuario);
        $email = $usuario[0]->getUsMail();
        $nombreUsuario = $usuario[0]->getUsNombre();

        $asunto = "cancelada";

        $this->enviarMail($email, $nombreUsuario, $asunto, $mensaje);
        }

        return $resp;
    }

    //funcion correo 
    public function enviarMail($email, $nombreUsuario, $asunto, $mensaje){

        $mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'mateobucarey021@gmail.com';                     //SMTP username
    $mail->Password   = 'cebx rjlh ajya jqaj';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('mateobucarey021@gmail.com', 'Perfumeria');
    $mail->addAddress($email, $nombreUsuario);     //Add a recipient
    //$mail->addAddress('ellen@example.com');               //Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $asunto;
    $mail->Body    = $mensaje;
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    // echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
    }

    public function obtenerEstadoCompra($estadoCompra){
        $msjCompra = "";
        if ($estadoCompra == 1) {
            $msjCompra = "Usted ha iniciado un proceso de compra en la Tienda de Perfumes";
        } elseif ($estadoCompra == 2) {
            $msjCompra = "Su compra en la Tienda de Perfumes ha sido aceptada";
        } elseif ($estadoCompra == 3) {
            $msjCompra = "Su compra en la Tienda de Perfumes fue enviada";
        } elseif ($estadoCompra == 4) {
            $msjCompra = "Su compra en la Tienda de Perfumes ha sido cancelada";
        }
        return $msjCompra;
    }


}

?>