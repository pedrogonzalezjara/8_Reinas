
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>8 Reinas - AnÃ¡lisis de Algoritmos</title>
<link href="tools/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="tools/jquery.min.js"></script> 
<script type="text/javascript" src="tools/cufon-yui.js"></script>
<script type="text/javascript" src="tools/Chalet_400.font.js"></script>
<script type="text/javascript" src="tools/Proxima_Nova_Rg_400-Proxima_Nova_Rg_700.font.js"></script>
<script type="text/javascript">
	Cufon.replace('a.logo', {fontFamily: 'Chalet'});
	Cufon.replace('a.logo span', {fontFamily: 'Chalet'});
	Cufon.replace('h1', {fontFamily: 'Proxima Nova Rg', textShadow: '#295c66 1px 1px'});
	Cufon.replace('h2', {fontFamily: 'Proxima Nova Rg', textShadow: '#295c66 1px 1px' });
</script>
<link rel="stylesheet" type="text/css" href="fondo.css"/>
</head>
    <body class="miestilo">
<div class="header">
	<div class="logo"><img src="images/logo.jpg"></div>
</div>
        <br></br>
<form name="input" action="queens.php" method="post">
    <div class="footer">
	<h1>Seleccione Numero de Reinas </h1>
        <center>Numero de Filas y Columnas <select name="boardX" /></center>
	
</div>
    <div>
         
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4" >4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
<option value="8" selected="selected">8</option>
</select>
             <br></br>
        <input type="hidden" name="process" value="yes" /><br>
    <input type="submit" class="btn" value="Enviar" />
    </div>
   
</form>
</body>
</html>

        

