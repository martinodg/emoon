<?
require_once("../conectar7.php"); 
require_once("../mysqli_result.php");

$codfamilia=$_GET["codfamilia"];
$cadena_busqueda=$_GET["cadena_busqueda"];

$query="SELECT * FROM familias WHERE codfamilia='$codfamilia'";
$rs_query=mysqli_query($conexion,$query);

?>

<html>
	<head>
		<title>Principal</title>
		<link href="../estilos/estilos.css" type="text/css" rel="stylesheet">
		<script language="javascript">
		
		var cursor;
		if (document.all) {
		// Está utilizando EXPLORER
		cursor='hand';
		} else {
		// Está utilizando MOZILLA/NETSCAPE
		cursor='pointer';
		}
		
		function aceptar(codfamilia) {
			location.href="guardar_familia.php?codfamilia=" + codfamilia + "&accion=baja" + "&cadena_busqueda=<? echo $cadena_busqueda?>";
		}
		
		function cancelar() {
			location.href="index.php?cadena_busqueda=<? echo $cadena_busqueda?>";
		}
		
		</script>
	</head>
	<body>
		<div id="pagina">
			<div id="zonaContenido">
				<div align="center">
				<div id="tituloForm" class="header">ELIMINAR FAMILIA </div>
				<div id="frmBusqueda">
					<table class="fuente8" width="98%" cellspacing=0 cellpadding=3 border=0>
						<tr>
							<td width="15%">C&oacute;digo</td>
							<td width="85%" colspan="2"><?php echo $codfamilia?></td>
					    </tr>
						<tr>
							<td width="15%">Nombre</td>
						    <td width="85%" colspan="2"><?php echo mysqli_result($rs_query,0,"nombre")?></td>
					    </tr>
					</table>
			  </div>
				<div id="botonBusqueda">
					<img src="../img/botonaceptar.jpg" width="85" height="22" onClick="aceptar(<? echo $codfamilia?>)" border="1" onMouseOver="style.cursor=cursor">
					<button type="button" id="btncancelar"  onClick="cancelar()" onMouseOver="style.cursor=cursor"> <img src="../img/cancelar.svg" alt="cancelar" /> <span>Cancelar</span> </button>
			  </div>
			 </div>
		  </div>
		</div>
	</body>
</html>
