<html>
    <head>
        <title>
            Reinas
        </title>
        <link rel="stylesheet" type="text/css" href="fondo.css">
        <link href="tools/style.css" rel="stylesheet" type="text/css" >
    </head>
    <div class="footer">
        <h1>Resultados:</h1>	
    </div>    
    <body class="miestilo">
        <?php
        error_reporting(E_ERROR);

//Se obtiene el tamaño de la tabla de ajedrez
        $boardX = $_POST['boardX'];
        $boardY = $_POST['boardX'];

//Funcion que rota la tabla en 90 grados.
        function rotateBoard($p, $boardX) {
            $a = 0;
            while ($a < count($p)) {
                $b = strlen(decbin($p[$a])) - 1;
                $tmp[$b] = 1 << ($boardX - $a - 1);
                ++$a;
            }
            ksort($tmp);
            return $tmp;
        }

//Esta funcion econtrara las rotaciones de una solucion
         function findRotation($p, $boardX, $solutions) {
            $tmp = rotateBoard($p, $boardX);
//Tablero rotado 90
            if (in_array($tmp, $solutions)) {
                
            } else {
                $solutions[] = $tmp;
            }

            $tmp = rotateBoard($tmp, $boardX);
//Tablero rotado 180
            if (in_array($tmp, $solutions)) {
                
            } else {
                $solutions[] = $tmp;
            }

            $tmp = rotateBoard($tmp, $boardX);
//Tablero rotado 270
            if (in_array($tmp, $solutions)) {
                
            } else {
                $solutions[] = $tmp;
            }

//Tablero Reflejado
            $tmp = array_reverse($p);
            if (in_array($tmp, $solutions)) {
                
            } else {
                $solutions[] = $tmp;
            }

            $tmp = rotateBoard($tmp, $boardX);
//Tablero Reflejado  y rotado 90 grados
            if (in_array($tmp, $solutions)) {
                
            } else {
                $solutions[] = $tmp;
            }

            $tmp = rotateBoard($tmp, $boardX);
//Tablero Reflejado y rotado 180 grados
            if (in_array($tmp, $solutions)) {
                
            } else {
                $solutions[] = $tmp;
            }

            $tmp = rotateBoard($tmp, $boardX);
//Tablero Reflejado y rotado 270 grados
            if (in_array($tmp, $solutions)) {
                
            } else {
                $solutions[] = $tmp;
            }
            return $solutions;
        }

//Esta funcion es la que genera el tablero
        function renderBoard($p, $boardX) {
            echo "<center><table border=10 cellspacing= style='text-align:left;display:block'>";
            for ($y = 0; $y < $boardX; ++$y) {
                echo '<tr>';
                for ($x = 0; $x < $boardX; ++$x) {
                    if (($x + $y) & 1) {
                        $cellCol = '#ffffff';
                    } else {
                        $cellCol = '#000000';
                    }

                    if ($p[$y] == 1 << $x) {
                        echo "<td bgcolor=" . $cellCol . "><img  src='./reina.png'></td>";
                    } else {
                        echo "<td bgcolor=" . $cellCol . "> </td>";
                    }
                }
                
            }
            echo '<tr></tr></table></center>&nbsp';
        }

//Esta funcion permite generar el siguiente orden de filas
        function pc_next_permutation($p) {
            $size = count($p) - 1;
//Se desliza por la matriz buscando el siguiente mas pequeño
            for ($i = $size - 1; $p[$i] >= $p[$i + 1]; --$i) {
                
            }

//Si esto no ocurre se termina con las permutaciones 
//Se revierte el arreglo: (1, 2, 3, 4) => (4, 3, 2, 1) 
            if ($i == -1) {
                return false;
            }

//Se desplaza por la matriz en busqueda de un valor mas grande que el anterior
            for ($j = $size; $p[$j] <= $p[$i]; --$j) {
                
            }
//Se intercambian 
            $tmp = $p[$i];
            $p[$i] = $p[$j];
            $p[$j] = $tmp;
//Intercambiar los elementos del medio por los del final 
            for (++$i, $j = $size; $i < $j; ++$i, --$j) {
                $tmp = $p[$i];
                $p[$i] = $p[$j];
                $p[$j] = $tmp;
            }
            return $p;
        }

//Esta funcion chequea las filas para ver si falta alguna
        function checkBoard($p, $boardX) {
            $a = 0; //esta es la fila que esta siendo chequeada
            while ($a < count($p)) {
                $b = 1;
                while ($b < ($boardX - $a)) {
                    $x = $p[$a + $b] << $b;
                    $y = $p[$a + $b] >> $b;
                    if ($p[$a] == $x | $p[$a] == $y) {
                        return false;
                    }
                    ++$b;
                }
                ++$a;
            }
            return true;
        }

        if (isset($_POST['process']) && isset($_POST['boardX'])) {
//Dentro de este IF está el código que se ejecutará al hacer click en enviar.
//Primero se crean las diferentes filas posibles
            for ($x = 0; $x < $boardX; ++$x) {
                $row[$x] = 1 << $x;
            }

//Ahora se necesitan crear los posibles ordenes de filas, será igual al [boardY]!
            $tableCount = 0;
            $solcount = 0;
            $solutions = array();?>
       <center> <table>
            
                <?php while ($row != false) { ?>
            <tr>
                <?php
                    $tableCount=0;
                    while($tableCount != 3){ ?>
                        <?php if (checkBoard($row, $boardX)) {
                    if (!in_array($row, $solutions)) {
                        $solutions[] = $row;?>
            <td>
                        <?php renderBoard($row, $boardX);echo"<br>";?>
            </td> 
                        
                        <?php $solutions = findRotation($row, $boardX, $solutions);
                        ++$solcount;
                        $tableCount++;
                    }
                }
                $row = pc_next_permutation($row);
                if($row == FALSE) {break;}?>
                    <?php 
                    
                    }?>
            </tr>
                <?php }?>
            
        </table></center>

            <?php echo  "<center><strong><br>Soluciones Unicas(Sin repetir): " . $solcount . "<br>Soluciones Totales: " . count($solutions) . "  - Incluyendo Soluciones Simetricas<br></strong></center><br>";
//se imprimen las soluciones
        }
//Este codigo recolecta los parametros iniciales
        echo <<<_END

        
 
_END;
        ?>
    <form name="input" action="select.php" method="post">
            <input type="hidden" name="process" value="yes" />
        <center><input type="submit" class="btn" value="Volver" /></center>
        <br><br>
    </body>
</html>