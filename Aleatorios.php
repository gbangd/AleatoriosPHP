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
        
    //Generadores 
    
    public function congruencial($a, $c, $m, $Xi, $cantidadDeNumeros)
    {
        $contador =0;
        while($contador < $cantidadDeNumeros)
        {
            $Xi = (($a*$Xi)+$c)%$m;
            $this->arrayPseuPos[$contador] = $Xi;
            $this->arrayPseuPosCeroUno[$contador] = round(($Xi /($m-1)),3);
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
    
    private function esPar($vector)
    {
        if(count($vector) % 2 == 0)
            return true;
        
        return false;
    }
    
    private function rotar($dato1)
    {
        $dato2 = Array();
        for($x= 0; $x<count($dato1); $x++)
            $dato2[$x] = $dato1[(count($dato1)-1) - $x];

        return $dato2;
    }
    
    
    //Pruebas de Frecuencia
    
    public function kolmogorov_smirnov($generador)
    {
        $vectorOrdenado = Array();
        $vectorIN = Array();
        $vectorRestaUno = Array();
        $vectorRestaDos = Array();
        
        $vectorFinal = Array();
        
        //F(Xi)
        if($generador == 0)
            $vectorOrdenado = $this->ordenar($this->arrayPseuPosCeroUno);
        else 
            $vectorOrdenado = $this->ordenar($this->arrayCuadradosCeroUno);
        
        
        //i/n
        for($i=0; $i< count($vectorOrdenado);$i++)
        {
            $vectorIN[$i] = ($i+1)/count($vectorOrdenado);
        }
        //i/n - F(Xi)
        for($i=0; $i< count($vectorOrdenado);$i++)
        {
            $vectorRestaUno[$i] = $vectorIN[$i]-$vectorOrdenado[$i];
        }
        //F(Xi)- (i-1)/n
        for($i=0; $i< count($vectorOrdenado);$i++)
        {
            $vectorRestaDos[$i] = $vectorOrdenado[$i] - (($i)/count($vectorOrdenado));
        }
        //Dmax y Dmin
        $dMax = $this->mayor($vectorRestaUno);
        $dMin = $this->menor($vectorRestaDos);
        
        
        //Tabla de Kolmogorov-Smirnov
        $vectorFinal[0] = $vectorOrdenado;
        $vectorFinal[1] = $vectorIN;
        $vectorFinal[2] = $vectorRestaUno;
        $vectorFinal[3] = $vectorRestaDos;
        $vectorFinal[4] = array($dMax,$dMin);
        
        return $vectorFinal;
        
    }
    
    public function promedios($generador)
    {
        if($generador == 0)
            $vectorOrdenado = $this->promedio($this->arrayPseuPosCeroUno);
        else 
            $vectorOrdenado = $this->promedio($this->arrayCuadradosCeroUno);
    }
    
    private function promedio($vector)
    {
        $suma =0;
        for($i=0;$i<count($vector);$i++)
        {
            $suma += $vector[$i];
        }
        return $suma;
    }
    
    private function mayor($vector)
    {
        $mayor = -9999999;
        
        for($i=0; $i< count($vector);$i++)
        {
            if(((double) $vector[$i]) > $mayor)
                $mayor = (double) $vector[$i];
        }
        
        return $mayor;
    }
    
    private function menor($vector)
    {
        $menor = 9999999;
        
        for($i=0; $i< count($vector);$i++)
        {
            if(($vector[$i]) < $menor)
                $menor = $vector[$i];
        }
        
        return $menor;
    }
    
    private function ordenar($vector)
    {
        $vectorOrdenado = $vector;
        
        for($i=1;$i<count($vector);$i++)
        {
            for($j=0;$j<(count($vector)-$i);$j++)
            {
                if($vectorOrdenado[$j]>$vectorOrdenado[$j+1])
                {
                    $temp = $vectorOrdenado[$j+1];
                    $vectorOrdenado[$j+1] = $vectorOrdenado[$j];
                    $vectorOrdenado[$j] = $temp;
                }
            }
        }
        
        return $vectorOrdenado;
        
    }
    
}

?>
