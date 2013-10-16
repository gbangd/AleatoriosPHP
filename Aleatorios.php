<?php
/**
 * Description of Aleatorios
 *
  */
class Aleatorios {
    
    public $arrayPseuPos;
    public $arrayPseuPosCeroUno;
    public $arrayCuadrados;
    public $arrayCuadradosCeroUno;
   
    public function Aleatorios()
    {
        $this->arrayCuadrados = Array();
        $this->arrayCuadradosCeroUno = Array();
        $this->arrayPseuPosCeroUno = Array();
        $this->arrayPseuPos = Array();
    }
    
    public function congruencial($a, $c, $m, $Xi, $cantidadDeNumeros)
    {
        $contador =0;
        while($contador < $cantidadDeNumeros)
        {
            $Xi = (($a*$Xi)+$c)%$m;
            $this->arrayPseuPos[$contador] = $Xi;
            $this->arrayPseuPosCeroUno[$contador] = round (($Xi /$m), 3);
            $contador++;
        }
    }
    
    public function cuadradosMedios($Xi, $cantidadDeNumeros)
    {
        $contador = 0;
        while($contador < $cantidadDeNumeros)
        {
            $ncuadrado = pow($Xi, 2);
            $vector = str_split((string)$ncuadrado);
            
            if(!$this->esPar($vector))
                array_unshift ($vector, '0');
            
            while(count($vector)>4)
            {
                array_shift($vector);
                $vector = $this->rotar($vector);
            }
            
            $datofinal = implode('', $vector);
            $this->arrayCuadrados[$contador] = (double) $datofinal;
            $this->arrayCuadradosCeroUno[$contador]  = (double) ($datofinal/10000);
            
            $Xi = (double) $datofinal;
            
            $contador ++;
        }
    }
    
    public function esPar($vector)
    {
        if(count($vector) % 2 == 0)
            return true;
        
        return false;
    }
    
    public function rotar($dato1)
    {
        $dato2 = Array();
        for($x= 0; $x<count($dato1); $x++)
            $dato2[$x] = $dato1[(count($dato1)-1) - $x];

        return $dato2;
    }
}

?>
