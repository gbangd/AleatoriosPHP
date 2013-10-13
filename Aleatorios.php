<?php
/**
 * Description of Aleatorios
 *
  */
class Aleatorios {
    
    public $arrayPseuPos;
    public $arrayCuadrados;
   
    public function Aleatorios()
    {
        $this->arrayCuadrados = Array();
        $this->arrayPseuPos = Array();
    }
    
    public function congruencial($a, $c, $m, $Xi, $cantidadDeNumeros)
    {
        $contador =0;
        while($contador < $cantidadDeNumeros)
        {
            $Xi = (($a*$Xi)+$c)%$m;
            $this->arrayPseuPos[$contador] = $Xi;
            $contador++;
        }
    }
    
}

?>
