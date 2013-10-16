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
            
            if(isset($_REQUEST['a']) && isset($_REQUEST['c']) && isset($_REQUEST['m']) && isset($_REQUEST['xi']) && isset($_REQUEST['cantidad']))
            {
                $a = (double) $_REQUEST['a'];
                $c = (double) $_REQUEST['c'];
                $m = (double) $_REQUEST['m'];
                $Xi = (double) $_REQUEST['xi'];
                $cantidadDeNumeros = (double) $_REQUEST['cantidad'];
                
                $aleatorios->congruencial($a, $c, $m, $Xi, $cantidadDeNumeros);
             ?>
            <h2>Generador Congruencial</h2> 
            <table id="tablita">
            <thead><tr><th>Numeros del Generador</th><th>Numeros entre 0 y 1</th></tr></thead>
            <!--<tfoot><tr><td colspan="4"><div id="paging"><ul><li><a href="#"><span>Previous</span></a></li><li><a href="#" class="active"><span>1</span></a></li><li><a href="#"><span>2</span></a></li><li><a href="#"><span>3</span></a></li><li><a href="#"><span>4</span></a></li><li><a href="#"><span>5</span></a></li><li><a href="#"><span>Next</span></a></li></ul></div></tr></tfoot>-->
            <tbody>
        
             <?php
             $numeros = $aleatorios->arrayPseuPos;
             $numerosCeroUno = $aleatorios->arrayPseuPosCeroUno;
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
             $tabla = $aleatorios->kolmogorov_smirnov(0);
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
                $pruebaPromedios = $aleatorios->promedios(0);
            ?>
            
            <h3>Promedio: <?php printf($pruebaPromedios[1]) ?></h3>
            <h3>Z: <?php printf($pruebaPromedios[0]) ?></h3>
            <?php 
            
            $aleatorios->guardarEnArchivo(0);
            echo "<a href='numerosAleatorios.csv'>Descargar Archivo con numeros Aleatorios</a>";               
            }
            else{
        ?>
        <form action="generadores.php" method="post">
            <p><input type="text" id="semilla" name="xi" value="" placeholder="Semilla"></p>
            <p><input type="text" id ="a" name="a" value="" placeholder="Valor de A"></p>
            <p><input type="text" id ="c" name="c" value="" placeholder="Valor de C"></p>
            <p><input type="text" id ="m" name="m" value="" placeholder="Valor de M"></p>
            <p><input type="text" id ="cant" name="cantidad" value="" placeholder="Cantidad de Numeros"></p>
            <p class="submit">
            <!--<button onclick="congruencial()">Generar</button>-->
            <input type="submit" name="commit" value="Login">
            </p>
        </form>  
        <?php }?>
    </body>
</html>
