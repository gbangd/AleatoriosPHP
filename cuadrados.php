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
            <?php 
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
