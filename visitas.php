<?php
/**
 * Created by PhpStorm.
 * User: INGAN
 * Date: 12/03/2019
 * Time: 11:54 AM
 */
class Visitas{
    private $rutaJson;
    private $segundosEspera;
    //$rutaJson -> RUTA DONDE ESTA EL JSON
    //$segundosEspera -> TIEMPO PARA QUE VUELVA SUMAR VISITA POR CLIENTE
    public function __construct($rutaJson, int $segundosEspera){
        $this->rutaJson = $rutaJson;
        $this->segundosEspera = $segundosEspera;
        //COOKIE PARA EVITAR SUMAR POR CADA VEZ QUE RECARGUE LA PAGINA EL CLIENTE
        setcookie("time", '0', time()+$segundosEspera, "/", "", 0, 1);
    }
    public function obtenerVisitas(){
        //LEER JSON
        $fileJson = file_get_contents($this->rutaJson);
        //JSON - ARRAY
        return json_decode($fileJson,true);
    }
    public function sumarVisita(){
        //VERIFICAR SI EXISTE LA COOKIE PARA PERMITIR SUMAR
        if(!isset($_COOKIE['time'])){
            //OBTENER VISITAS
            $visitaRegistradas = $this->obtenerVisitas();
            //SUMAR VISITA
            $visita = array("vistas" => (int)$visitaRegistradas['vistas'] + 1);
            try{
                //ABRIR JSON CON PERMSISO DE ESCRITURA
                $fh = fopen($this->rutaJson, 'w');
                //ARRAY -> JSON Y ESCRIBIR
                fwrite($fh, json_encode($visita,JSON_UNESCAPED_UNICODE));
                //CERRAR JSON
                fclose($fh);
            }catch(Exception $e){
                //ENVIO A ALGUN LOG
            }
            //CREAR COOKIE NUEVAMENTE PARA QUE ESPERE LOS SEGUNDOS ESTABLECIDOS
            setcookie("time", '0', time()+$this->segundosEspera, "/", "", 0, 1);
        }
    }
}