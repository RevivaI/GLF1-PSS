<?php
		$AuxMagnitud=0;
		$Arra= array();
		$Array2= array();
		$Aux=array();
		$disi="k";

	if(isset($_POST['submit']))
	{

		$CantV=$_POST['CantV'];
		$Array= array();
		$Array2= array();
		$Aux=array();
		$Aux=unserialize($_POST['arreglo']);
		if($_POST['input1']!=="" && $_POST['input2']!=="" && $_POST['input3']!=="")
		{
			if($_POST['DS']=="D")
			{
				echo "Grafo Dirigido";
				echo '<br><br><br>';
				$Array2[0]=$_POST['input1'];
				$Array2[1]=$_POST['input2'];
				$Array2[2]=$_POST['input3'];
				$Arra=array_merge($Arra,$Aux,$Array2);
				if($Arra[2]>0)
				{
					$AuxMagnitud=1;
				}
				if($Arra[2]==0)
				{
					$AuxMagnitud=2;
				}
				$disi="D";
			}
			if($_POST['DS']=="S")
			{
				echo "Grafo Simple";
				echo '<br><br><br>';

				if($_POST['input1']==$_POST['input2'])
				{
					$Array2[0]=$_POST['input1'];
					$Array2[1]=$_POST['input2'];
					$Array2[2]=$_POST['input3'];
				}

				else
				{
					$Array2[0]=$_POST['input1'];
					$Array2[1]=$_POST['input2'];
					$Array2[2]=$_POST['input3'];
					$Array2[3]=$_POST['input2'];
					$Array2[4]=$_POST['input1'];
					$Array2[5]=$_POST['input3'];
				}



				
				
				$Arra=array_merge($Arra,$Aux,$Array2);
				if($Arra[2]>0)
				{
					$AuxMagnitud=1;
				}
				if($Arra[2]==0)
				{
					$AuxMagnitud=2;
				}
				$disi="S";
			}
			
		}
		else
		{	echo '<p>Favor no dejar campos vacios.</p>';
			$Arra=array_merge($Arra,$Aux);
			if($_POST['DS']=="D")
			{
				$disi="D";
				echo "Grafo Dirigido";
				echo '<br><br><br>';
			}
			if($_POST['DS']=="S")
			{
				$disi="S";
				echo "Grafo Simple";
				echo '<br><br><br>';
			}
			if(sizeof($Arra)>2)
			{
				if($Arra[2]>0)
				{
					$AuxMagnitud=1;
				}
				if($Arra[2]==0)
				{
					$AuxMagnitud=2;
				}
			}
			
		}

	}
	?>
<!DOCTYPE html>

<html>
<head>
	<title>P2</title>
</head>
<body>


<form name='uwu' method='post' action=''>
<?php echo "<input type='hidden' name='CantV' value='$CantV' >";?>
<input type='hidden' name='arreglo' value='<?php echo serialize($Arra)?>'>
@csrf
(Vertice      --- Vertice)<?php if($AuxMagnitud==0)echo "    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Si es grafo etiquetado ingrese magnitud, de lo contrario deje en 0"?> <br> <br><input type='number' name='input1' min='1' max='<?php echo $CantV ?>'/>

  <input type='number' name='input2' min='1' max='<?php echo $CantV?>'>

<?php if($AuxMagnitud==0)
{
	
	echo	"Magnitud <input type='number' name='input3' min='0' value='0'>";
}
if($AuxMagnitud==1)
{
	echo "Magnitud <input type='number' name='input3' min='1' value='1' >";
}
if($AuxMagnitud==2)
{
	echo" <input type='hidden' value='0' name='input3'>";
}
?>
<?php if($AuxMagnitud==0)
{echo'
<input type="radio" name="DS" value="D" required> Dirigido
  <input type="radio" name="DS" value="S" required> Simple';
}
	if($disi=="D" && $AuxMagnitud!=0)
	{
		echo'<input type="hidden" name="DS" value="D">';
	}
	if($disi=="S" && $AuxMagnitud!=0)
	{
		echo'<input type="hidden" name="DS" value="S">';
	}
?>

<input type='submit' value='Agregar Arista' name='submit'></form><br><br>

<form name="finalizar" method="post" action="{{route ('paw4')}}">
	<input type='submit' value='Finalizar aristas' name=submit2'>
	@csrf
	<?php if($AuxMagnitud==0)
	{
		echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;De igual forma, si selecciona Dirigido/Simple, aplicará para todo el grafo.';
	}?>
	
	<input type='hidden' value='<?php echo serialize($Arra)?>' name='Arr'> 
	<input type='hidden' value='<?php echo $CantV?>' name='CantV'></form>




<?php

	if($disi=="D")
	{
		for($i=0;$i<sizeof($Arra);$i=$i+3)
		{

				echo "<br>&nbsp;&nbsp;";
				echo "Arista{",$Arra[$i],"=>";

				echo $Arra[$i+1],"}";
				if($Arra[$i+2]>0)
					echo "&nbsp;&nbsp;Magnitud ", $Arra[$i+2];
				
		}
	}
	if($disi=="S")
	{
		for($i=0;$i<sizeof($Arra);$i=$i+6)
		{

				echo "<br>&nbsp;&nbsp;";
				echo "Arista{",$Arra[$i],",";

				echo $Arra[$i+1],"}";
				if($Arra[$i+2]>0)
					echo "&nbsp;&nbsp;Magnitud ", $Arra[$i+2];
				
		}
	}
	
?>
	</body>
</html>

