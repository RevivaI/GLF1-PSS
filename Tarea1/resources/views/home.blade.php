<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
</head>
<body>
	<h1>¿Cuantos vertices tiene el grafo?</h1>
	<form name="f1" method="post" action="{{ route ('Pag2')}}">
		@csrf
		<input type="number" name="CantVer" placeholder="Numero de vertices..."><br>
		<input type="submit" value="Siguiente.">
	</form>

	</body>
</html>