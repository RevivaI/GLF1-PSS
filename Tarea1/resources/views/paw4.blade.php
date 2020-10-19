<!DOCTYPE html>
<html>
<head>
	<title>Pass</title>
</head>
<body>
	<?php 
function C($Matriz,$CantV)
{
	$Identidad=array();
	$Identidad=Llenar0s($Identidad,$CantV);
	for($i=0;$i<$CantV;$i++)
	{
		$Identidad[$i][$i]=1;
	}

	if($CantV==2)
	{
		return SumarM($Identidad,$Matriz,$CantV);
	}
	else
	{
		$Base=SumarM($Identidad,$Matriz,$CantV);

		$Auxiliar=$Matriz;
		for($x=2;$x<$CantV;$x++)
		{
			$Matriz=ElevarMatriz($Matriz,$Auxiliar,$CantV);
			$Base=SumarM($Base,$Matriz,$CantV);
		}
		return $Base;
	}
}

function ElevarMatriz($Matriz1,$Matriz2 ,$Cant)
{	
	$MatrizB=array();
		for ($i=0;$i<$Cant;$i++)
		{
			for($j=0;$j<$Cant;$j++)
			{
				$Acum=0;
		         for ($k=0;$k<$Cant;$k++)
		          {
		          	$Acum=$Acum+($Matriz2[$i][$k]*$Matriz1[$k][$j]);
				  }
				  $MatrizB[$i][$j]=$Acum;
			}
		}
	return $MatrizB;
}

function SumarM($Matriz1,$Matriz2,$CantV)
{	
	for($i=0;$i<$CantV;$i++)
	{
		for($j=0;$j<$CantV;$j++)
		{
			$Matriz1[$i][$j]=$Matriz1[$i][$j]+$Matriz2[$i][$j];
		}
	}
	return $Matriz1;
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
function Conexa($Matriz,$CantV)
{$cont=0;
	for($i=0;$i<$CantV;$i++)
	{
		for($j=0;$j<$CantV;$j++)
		{
			if($Matriz[$i][$j]==0)
			{
				$cont++;
			}
		}
	}
	if($cont>0)
	{
		echo "El grafo ingresado no es conexo";
	}
	else
	{
		echo "El grafo ingresado es conexo";
	}
}
$Auxiliar=array();
$Auxiliar=unserialize($Matriz);
$MatrizA=array();
$MatrizA=Llenar0s($MatrizA,$CantV);
$MatrizA=Llenar1s($MatrizA,$Auxiliar,$CantV);
echo '<h2>Dado el grafo, su matriz de adyacencia es: <br>';
MostrarMatriz($MatrizA,$CantV);
$MatrizB=C($MatrizA,$CantV);
echo '<br><br> Mientras que su Matriz de caminos totales es:<br> <br>  ';
MostrarMatriz($MatrizB,$CantV);
echo'<br> <br> </h2>';
Conexa($MatrizB,$CantV);


?>



<form name="Next" method="post" action="{{route ('paw3')}}">

	<h2>Encontrar el camino mas corto desde:</h2>
	<input type='number' min='0' max='<?php echo $CantV?>' name='n1'>
	<h2>hasta:</h2>
	<input type='number' min='0' max='<?php echo $CantV?>' name='n2'>
	<input type='submit' value='Camino mas corto' name=submit2'>
	@csrf
	<input type='hidden' value='<?php echo $Matriz?>' name='Arr'> 
	<input type='hidden' value='<?php echo $CantV?>' name='CantV'></form>
	<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</body>
</html>