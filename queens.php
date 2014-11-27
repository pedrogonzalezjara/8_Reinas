<html>
    <head>
        <title>
            Reinas
        </title>
    </head>
    <body background = "fondo2.png">
        <?php
        error_reporting(E_ERROR);
        
        //echo "<td bgcolor=" . $cellCol . "><img src='./utem4.png'></td>";
        
        echo "<h1>Problema de las 8 Reinas</h1>";
//Get the size of the board
        $boardX = $_POST['boardX'];
        $boardY = $_POST['boardX'];

// Function to rotate a board 90 degrees
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

// This function will find rotations of a solution
        function findRotation($p, $boardX, $solutions) {
            $tmp = rotateBoard($p, $boardX);
// Rotated 90
            if (in_array($tmp, $solutions)) {
                
            } else {
                $solutions[] = $tmp;
            }

            $tmp = rotateBoard($tmp, $boardX);
// Rotated 180
            if (in_array($tmp, $solutions)) {
                
            } else {
                $solutions[] = $tmp;
            }

            $tmp = rotateBoard($tmp, $boardX);
// Rotated 270
            if (in_array($tmp, $solutions)) {
                
            } else {
                $solutions[] = $tmp;
            }

// Reflected
            $tmp = array_reverse($p);
            if (in_array($tmp, $solutions)) {
                
            } else {
                $solutions[] = $tmp;
            }

            $tmp = rotateBoard($tmp, $boardX);
// Reflected and Rotated 90
            if (in_array($tmp, $solutions)) {
                
            } else {
                $solutions[] = $tmp;
            }

            $tmp = rotateBoard($tmp, $boardX);
// Reflected and Rotated 180
            if (in_array($tmp, $solutions)) {
                
            } else {
                $solutions[] = $tmp;
            }

            $tmp = rotateBoard($tmp, $boardX);
// Reflected and Rotated 270
            if (in_array($tmp, $solutions)) {
                
            } else {
                $solutions[] = $tmp;
            }
            return $solutions;
        }

// This is a function which will render the board
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
                        echo "<td bgcolor=" . $cellCol . "><img width=30 height=30 src='./reina.png'></td>";
                    } else {
                        echo "<td bgcolor=" . $cellCol . "> </td>";
                    }
                }
                echo '<tr>';
            }
            echo '<tr></tr></table></center>&nbsp';
        }

//This function allows me to generate the next order of rows.
        function pc_next_permutation($p) {
            $size = count($p) - 1;
// slide down the array looking for where we're smaller than the next guy 

            for ($i = $size - 1; $p[$i] >= $p[$i + 1]; --$i) {
                
            }

// if this doesn't occur, we've finished our permutations 
// the array is reversed: (1, 2, 3, 4) => (4, 3, 2, 1) 
            if ($i == -1) {
                return false;
            }

// slide down the array looking for a bigger number than what we found before 
            for ($j = $size; $p[$j] <= $p[$i]; --$j) {
                
            }
// swap them 
            $tmp = $p[$i];
            $p[$i] = $p[$j];
            $p[$j] = $tmp;
// now reverse the elements in between by swapping the ends 
            for (++$i, $j = $size; $i < $j; ++$i, --$j) {
                $tmp = $p[$i];
                $p[$i] = $p[$j];
                $p[$j] = $tmp;
            }
            return $p;
        }

//This function needs to check the current state to see if there are any 
        function checkBoard($p, $boardX) {
            $a = 0; //this is the row being checked
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
//Within here is the code that needs to be run if process is clicked.
//First I need to create the different possible rows
            for ($x = 0; $x < $boardX; ++$x) {
                $row[$x] = 1 << $x;
            }

//Now I need to create all the possible orders of rows, will be equal to [boardY]!
            $solcount = 0;
            $solutions = array();
            while ($row != false) {
                if (checkBoard($row, $boardX)) {
                    if (!in_array($row, $solutions)) {
                        $solutions[] = $row;
                        renderBoard($row, $boardX);
                        $solutions = findRotation($row, $boardX, $solutions);
                        ++$solcount;
                    }
                }
                $row = pc_next_permutation($row);
            }
            echo "<br><br>&nbsp&nbsp&nbsp&nbspFilas/Columnas: " . $boardX . "<br>&nbsp&nbsp&nbsp&nbspSoluciones Unicas(Sin repetir): " . $solcount . "<br>&nbsp&nbsp&nbsp&nbspN°Soluciones Totales: " . count($solutions) . "  - Incluyendo Soluciones Simetricas<br>";
//print_r($solutions);
        }

//This code collects the starting parameters
        echo <<<_END
<form name="input" action="queens.php" method="post">
&nbsp&nbsp&nbsp&nbspNumero de Filas y Columnas <select name="boardX" />
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4" >4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
<option value="8" selected="selected">8</option>
</select>
    <input type="hidden" name="process" value="yes" />
&nbsp<input type="submit" value="Enviar" />
</form>
 
_END;
        ?>
    </body>
</html>