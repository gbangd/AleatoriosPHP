<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
         <?php
            require './Aleatorios.php';
            $aleatorios = new Aleatorios();
            
            if(isset($_REQUEST['xi']) && isset($_REQUEST['cantidad']))
            {
                $Xi = (double) $_REQUEST['xi'];
                $cantidadDeNumeros = (double) $_REQUEST['cantidad'];
                
                $aleatorios->cuadradosMedios($Xi, $cantidadDeNumeros);
             ?>
            <h2>Generador Cuadrados Medios</h2> 
            <table id="tablita">
            <thead><tr><th>Numeros del Generador</th><th>Numeros entre 0 y 1</th></tr></thead>
            <!--<tfoot><tr><td colspan="4"><div id="paging"><ul><li><a href="#"><span>Previous</span></a></li><li><a href="#" class="active"><span>1</span></a></li><li><a href="#"><span>2</span></a></li><li><a href="#"><span>3</span></a></li><li><a href="#"><span>4</span></a></li><li><a href="#"><span>5</span></a></li><li><a href="#"><span>Next</span></a></li></ul></div></tr></tfoot>-->
            <tbody>
        
             <?php
             $numeros = $aleatorios->arrayCuadrados;
             $numerosCeroUno = $aleatorios->arrayCuadradosCeroUno;
             $contador =0;
             while($contador < $cantidadDeNumeros)
             {
             ?>
                <tr>
                    <td><?php printf($numeros[$contador]) ?></td>
                    <td><?php printf($numerosCeroUno[$contador]) ?></td>
                </tr>
             <?php
               $contador++;
             }
            ?>
            </tbody>
            </table>
            
            <h2>Kolmogorov-Smirnov</h2>
            <table id="tablita2" border="1">
            <thead>
                <tr>
                    <th>i</th>
                    <th>F(Xi)</th>
                    <th>i/n</th>
                    <th>i/n - F(Xi)</th>
                    <th>F(Xi)- (i-1)/n</th>
                </tr>
            </thead>
            <!--<tfoot><tr><td colspan="4"><div id="paging"><ul><li><a href="#"><span>Previous</span></a></li><li><a href="#" class="active"><span>1</span></a></li><li><a href="#"><span>2</span></a></li><li><a href="#"><span>3</span></a></li><li><a href="#"><span>4</span></a></li><li><a href="#"><span>5</span></a></li><li><a href="#"><span>Next</span></a></li></ul></div></tr></tfoot>-->
            <tbody>
        
             <?php
             $tabla = $aleatorios->kolmogorov_smirnov(1);
             //$numerosCeroUno = $aleatorios->arrayPseuPosCeroUno;
             $contador2 =0;
             while($contador2 < $cantidadDeNumeros)
             {
             ?>
                <tr>
                    <td><?php printf((int)$contador2+1) ?></td>
                    <td><?php printf($tabla[0][$contador2]) ?></td>
                    <td><?php printf($tabla[1][$contador2]) ?></td>
                    <td><?php printf($tabla[2][$contador2]) ?></td>
                    <td><?php printf($tabla[3][$contador2]) ?></td>
                </tr>
             <?php
               $contador2++;
             }
            ?>
                <tr>
                    <td colspan="3"></td>
                    <td><b>D+ = </b> <?php printf($tabla[4][0]) ?></td>
                    <td><b>D- = </b> <?php printf($tabla[4][1]) ?></td>
                </tr>
            </tbody>
            </table>
            
            <h2>Prueba de Promedios</h2>
            
            <?php
                $pruebaPromedios = $aleatorios->promedios(1);
            ?>
            
            <h3>Promedio: <?php printf($pruebaPromedios[1]) ?></h3>
            <h3>Z: <?php printf($pruebaPromedios[0]) ?></h3>
            <h2>Chi-Cuadrada</h2> 
            <table id="tablita3" border="1">
            <thead>
                <tr>
                    <th>Intervalo</th>
                    <th>Oi</th>
                    <th>Ei</th>
                    <th>(Oi-Ei)²/Ei</th>
                </tr>
            </thead>
            <!--<tfoot><tr><td colspan="4"><div id="paging"><ul><li><a href="#"><span>Previous</span></a></li><li><a href="#" class="active"><span>1</span></a></li><li><a href="#"><span>2</span></a></li><li><a href="#"><span>3</span></a></li><li><a href="#"><span>4</span></a></li><li><a href="#"><span>5</span></a></li><li><a href="#"><span>Next</span></a></li></ul></div></tr></tfoot>-->
            <tbody>
        
             <?php
             $tablaChi = $aleatorios->chi_cuadrada(1);
             //$numerosCeroUno = $aleatorios->arrayPseuPosCeroUno;
             $contador3 =0;
             $sumatoria = 0;
             while($contador3 < count($tablaChi[0]))
             {
             ?>
                <tr>
                    <td><?php printf($tablaChi[0][$contador3]) ?></td>
                    <td><?php printf($tablaChi[1][$contador3]) ?></td>
                    <td><?php printf($cantidadDeNumeros/count($tablaChi[0])) ?></td>
                    <td><?php printf($tablaChi[2][$contador3]) ?></td>
                </tr>
             <?php
                $sumatoria += $tablaChi[2][$contador3];  
                $contador3++;
             }
            ?>
                <tr>
                    <td colspan="3"></td>
                    <td><b>Sumatoria = </b><?php print $sumatoria;?></td>
                </tr>
            </tbody>
            </table>
            
            <?php 
            $aleatorios->guardarEnArchivo(1);
            
            echo "<a href='numerosAleatorios.csv'>Descargar Archivo con numeros Aleatorios</a>";            
            }
            else{
        ?>
        <form action="cuadrados.php" method="post">
            <p><input type="text" id="semilla" name="xi" value="" placeholder="Semilla"></p>
            <p><input type="text" id ="cant" name="cantidad" value="" placeholder="Cantidad de Numeros"></p>
            <p class="submit">
            <!--<button onclick="congruencial()">Generar</button>-->
            <input type="submit" name="commit" value="Login">
            </p>
        </form>  
        <?php }?>
    </body>
</html>
