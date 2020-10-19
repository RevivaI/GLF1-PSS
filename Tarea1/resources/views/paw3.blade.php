


<!DOCTYPE html>
<html>
<head>
	<title>P3</title>
</head>
<body>
<?php 

class Node 
{
	public $Numbre; //Nombrenumero del nodo (nodo 1, 2 , 3, ...)
	public $Edges = array(); // Arreglo para las conexiones
	public $Pesos = array(); // Arreglo con el peso de las conexiones
	public $Searched;
	public function __construct($N)
	{
		$this->Numbre=$N;
		$this->Searched=false;
	}
	public function addEdges($Edge)
	{
		$this->Edges[sizeof($this->Edges)]=$Edge;
	}
	public function addPesos($Peso)
	{
		$this->Pesos[sizeof($this->Pesos)]=$Peso;
	}
	public function getEdges()
	{
		return $this->Edges;
	}
	public function getPesos()
	{
		return $this->Pesos;
	}
	public function setSearched($Bolo)
	{
		$this->Searched=$Bolo;
	}
	public function getSearched()
	{
		return $this->Searched;
	}
	public function getValor()
	{
		return $this->Numbre;
	}

}
class Grafo
{
	public $Vertices; //Cantidad de vertices
	public $Nodos= array(); //Define un array de nodos para obtener el grafo
	public $Matriz = array();//Matriz Adyacencia
	public $Aux = array();// Matriz Identidad
	public $Graph = array();
	public $mRes = array();//Matriz Caminos totales
	public $simplEtiq= array();//Matriz simple con pesos
	public $Recorrdio = array();
	public $Duracion=0;
	
	public function __construct($CantV)
	{
		$this->Vertices=$CantV;
		for($i=0;$i<$CantV;$i++)
		{
			$a=new Node($i+1);
			$this->Graph[$i+1]=$a;
			$this->Nodos[sizeof($this->Nodos)]=$a;
		}
	}
	public function getVertices()
	{
		return $this->Vertices;
	}
	public function addRecorrido($r)
	{

		$this->Recorrdio[sizeof($this->Recorrdio)]=$r;
	}
	public function addDuracion($t)
	{
		$this->Duracion=$this->Duracion+$t;
	}
	public function ARecorrido($a)
	{
		$this->Recorrdio[sizeof($this->Recorrdio)]=$a;
	}
	public function ASearched($Bolo,$a)
	{
		$this->Nodos[$a-1]->setSearched($Bolo);
	}
	public function AñadirEdge ($a,$b,$peso)
	{
		
		$this->Nodos[$a-1]->addEdges($b);
		
		$this->Nodos[$a-1]->addPesos($peso);
	}
	public function MostrarGrafo()
	{
		for($i=0;$i<$this->Vertices;$i++)
		{
			$aux=$this->Nodos[$i]->getEdges();
			$aux2=$this->Nodos[$i]->getPesos();
			echo "Nodo ",$i+1," está conectado con : (";
			for($j=0;$j<sizeof($aux);$j++)
			{
				echo " ",$aux[$j]," ";
			}
			echo " )<br> Pesos : (";
			for($k=0;$k<sizeof($aux2);$k++)
			{
				echo " ",$aux2[$k]," ";
			}
			

			echo " )<br> ";
		}
	}
	public function setMatriz()
	{
		for($i=0;$i<$this->Vertices;$i++)
		{
			for($j=0;$j<$this->Vertices;$j++)
			{
				$this->Matriz[$i][$j]=0;
				$this->simplEtiq[$i][$j]=0;
				$this->Aux[$i][$j]=0;
				$this->mRes[$i][$j]=0;
			}
			$this->mRes[$i][$i]=1;
			$this->Aux[$i][$i]=1;
			$auxiliar=$this->Nodos[$i];//eje x
			for($k=0;$k<sizeof($auxiliar->getEdges());$k++)
			{
				$auxiliar2=$auxiliar->getEdges()[$k]-1;//eje y
				$this->Matriz[$i][$auxiliar2]=1;
				$this->simplEtiq[$i][$auxiliar2]=$this->Nodos[$i]->getPesos()[$k];
			}
		}

	}
	public function getRecorrido()
	{
		return $this->Recorrdio;
	}
	public function getmRes()
	{
		return $this->mRes;
	}
	public function getmatriz()
	{
		return $this->Matriz;
	}
	public function DelRecorrido()
	{
		$this->Recorrdio[0]="";
	}
	public function getNodes()
	{
		return $this->Nodos;
	}
	public function MostrarReco()
	{
		if(sizeof($this->Recorrdio)>0 && $this->Recorrdio[0]!=="")
		{
			echo "<h1>Recorrido : (=>";
		
		for($i=0;$i<sizeof($this->Recorrdio);$i++)
		{
			echo " ",$this->Recorrdio[$i],"";
		}
		echo ")</h1>";
		}
		

	}
	public function getDuracion()
	
	{
		return $this->Duracion;
	}
	public function MostrarDuracion()
	{
		if($this->Duracion>0)
		echo "<h1> Duracion = ",$this->Duracion,"</h1>";
	}	

}


function Dijkstra($a,$b,$Graf)
{	$ward=$a;
	$aux=1231;
	$Aux=9999999;
	$pos=0;
	$d=0;
	$Break=0;
	$Graf->ARecorrido($a);
	$Graf->ASearched(true,$a);
	while($a!=$b)
	{
		for($i=0;$i<sizeof($Graf->getNodes()[$a-1]->getEdges());$i++)
		{
			
			if($Graf->getNodes()[($Graf->getNodes()[$a-1]->getEdges()[$i])-1]->getSearched()==false)
			{
				$Graf->getNodes()[$Graf->getNodes()[$a-1]->getEdges()[$i]-1]->SetSearched(true);
				if($Graf->getNodes()[$a-1]->getEdges()[$i]==$b)
				{

					$aux=$Graf->getNodes()[$a-1]->getPesos()[$i];
					$d=$Graf->getNodes()[$a-1]->getEdges()[$i];

				}
				if($Graf->getNodes()[$a-1]->getPesos()[$i]<$Aux)
				{
					$Aux=$Graf->getNodes()[$a-1]->getPesos()[$i];
					$d=$Graf->getNodes()[$a-1]->getEdges()[$i];
				
				}
			}


		}
		if($d!=0)
		{
			$a=$d;
			$Graf->addDuracion($Aux);
			for($i=0;$i<sizeof($Graf->getRecorrido());$i++)
			{
				if($Graf->GetRecorrido()[$i]==$d)
				{
					$pos++;
				}
			}
			if($pos!=0)
			{
				$Graf->addRecorrido($d);
			}
			
		}
		$Break++;
		
		$aux=9999999;

		if($Break==10)
		{
			$a=$b;
			$Graf->DelRecorrido();
			$Graf->addDuracion(-$Graf->getDuracion());
		}

	}
	if($Break==10)
	{
		echo "<h1>NO HAY camino  desde ",$ward," hasta ",$b," ";
	}
	else
	{
		echo "<h1>El camino mas corto desde ",$ward," hasta ",$b," ";
	}

	
	return $Graf;

}



function LlenarGrafo($CantV,$Auxiliar)
{
	$Arrayo= new Grafo($CantV);
	for($x=0;$x<sizeof($Auxiliar);$x=$x+3)
	{
		$Arrayo->AñadirEdge($Auxiliar[$x],$Auxiliar[$x+1],$Auxiliar[$x+2]);
	}
	return $Arrayo;
}
$Auxiliar=unserialize($Matriz);
$Test = LlenarGrafo($CantV,$Auxiliar);
$Test->setMatriz();
$Test->MostrarGrafo();

$Test=Dijkstra($a,$b,$Test);
$Test->MostrarReco();
$Test->MostrarDuracion();

//----------------------------------------------------------------------------//


?>
<form name="finalizar" method="post" action="{{route ('paw5')}}">
	<input type='submit' value='Siguiente' name=submit2'>
	@csrf
	<input type='hidden' value='<?php echo serialize($Auxiliar)?>' name='Arr'> 
	<input type='hidden' value='<?php echo $CantV?>' name='CantV'></form>
</body>
</html>


<?php 

























/*
function ($Grafo, $a,$b)
{	$GrafoZ=$Grafo;
	$Camino=array();
	$Camino[0]=$a;
	$Menor=99999999;
	$PesodelCamino=array();
	$NoquedanCaminos=false;
	$FlujoMaximo=0;
	while($NoquedanCaminos==true)
	{
		for($i=0;$i<size($GrafoZ->getNodes()[$a-1]->getEdges();$i++)
		{
			$Camino[sizeof($Camino)]=$GrafoZ->getNodes()[$a-1]->getEdges[$i];
			$PesodelCamino[sizeof($PesodelCamino)]=$GrafoZ->getNodes()[$a-1]->getPesos[$i];
			if($GrafoZ->getNodes()[$a-1]->getEdges()[$i]==$b)
			{
				$FlujoMaximo+=$GrafoZ->getNodes()[$a-1]->getPesos()[$i];
				for($j=0;$j<sizeof($Camino);$j++)
				{
					if($GrafoZ->getNodes()[$a-1]->getPesos()[$j]<$Menor)
					{
						$Menor=$GrafoZ->getNodes[]->getPesos()
					}
				}
				for($j=0;$j<sizeof($Camino);$j++)
				{
					$GrafoZ->
				}
			}
		}
	}
}

*/
?>