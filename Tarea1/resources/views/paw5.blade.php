<?php 

$V = 5; 
  
function isSafe($v, $graph, &$path, $pos) 
{ 
    
    if ($graph[$path[$pos - 1]][$v] == 0) 
        return false; 
  
    for ($i = 0; $i < $pos; $i++) 
        if ($path[$i] == $v) 
            return false; 
  
    return true; 
} 
  

function hamCycleUtil($graph, &$path, $pos) 
{ 
    global $V; 

    if ($pos == $V) 
    { 
 
        if ($graph[$path[$pos - 1]][$path[0]] == 1) 
            return true; 
        else
            return false; 
    } 

    for ($v = 1; $v < $V; $v++) 
    { 

        if (isSafe($v, $graph, $path, $pos)) 
        { 
            $path[$pos] = $v; 

            if (hamCycleUtil($graph, $path,  
                                     $pos + 1) == true) 
                return true; 

            $path[$pos] = -1; 
        } 
    } 
  
    return false; 
} 
  

function hamCycle($graph) 
{ 
    global $V; 
    $path = array_fill(0, $V, 0); 
    for ($i = 0; $i < $V; $i++) 
        $path[$i] = -1; 

    $path[0] = 0; 
    if (hamCycleUtil($graph, $path, 1) == false) 
    { 
        echo("\nNo es grafo hamiltoniano"); 
        return 0; 
    } 
  
    printSolution($path); 
    return 1; 
} 

function printSolution($path) 
{ 
    global $V; 
    echo("El grafo es hamiltoniano y este es el circuito\n"); 
    for ($i = 0; $i < $V; $i++) 
        echo(" ".$path[$i]." "); 

    echo(" ".$path[0]." \n"); 
} 
function Llenar0s($Matriz, $Cant)
{
    for($i=0;$i<$Cant;$i++)
    {
        for($j=0;$j<$Cant;$j++)
        {
                $Matriz[$i][$j]=0;
        }
    }
    return $Matriz;
}
function Llenar1s($Matriz ,$Auxiliar, $Cant)
{

    for($i=0;$i<sizeof($Auxiliar);$i=$i+3)
    {
        $Matriz[$Auxiliar[$i]-1][$Auxiliar[$i+1]-1]=1;
    }
    return $Matriz;
}
function MostrarMatriz($Matriz , $Cant)
{
    for($i=0;$i<$Cant;$i++)
    { echo'<br>';
        for($j=0;$j<$Cant;$j++)
        {
            echo $Matriz[$i][$j]," ";
            echo ' ';
        }
    }
}
$Auxiliar=unserialize($Matriz);
$MatrizA=array();
$MatrizA=Llenar0s($MatrizA,$CantV);
$MatrizA=Llenar1s($MatrizA,$Auxiliar,$CantV);


hamCycle($MatrizA); 
?>