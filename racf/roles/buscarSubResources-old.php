<?php
include ("../../conectar7.php"); 


    $criterio1=$_GET["criterio1"];
    $parametro1=$_GET["parametro1"];
    $tipoBusqueda=$_GET["tipoBusqueda"];
    
    

    $donde="";
    if ($parametro1<>""){ $donde=$donde."subresourcesToRolesTable.".$criterio1." = '".$parametro1."' AND ";}
    if ($parametro2<>""){ $donde=$donde."rolesTable.".$criterio2." LIKE '".$parametro2."%' AND ";}
    if ($parametro3<>""){ $donde=$donde."rolesTable.".$criterio3." LIKE '".$parametro3."%' AND ";}
    $consulta="SELECT subresourcesToRolesTable.id_subresource , subresourcesToRolesTable.id_role, subResourceTable.subResourceName FROM subResourceTable, subresourcesToRolesTable WHERE ".$donde."subResourceTable.id_sresource=subresourcesToRolesTable.id_subresource AND subresourcesToRolesTable.borrado=0;";
    //SELECT rolesToUsersTable.id_role, internalUsersTable.id_intUser, rolesTable.roleName FROM internalUsersTable, rolesTable, rolesToUsersTable WHERE internalUsersTable.id_intUser='2' AND rolesToUsersTable.id_role=rolesTable.id_role 
    //ORDER BY internalUsersTable.intUserName LIMIT ".$paginainicio.",10
    //echo $consulta;
    //$donde2="";
    //if ($parametro1<>""){ $donde2=$donde2."internalUsersTable.".$criterio1." <> '".$parametro1."' AND ";}
    $consulta2="SELECT subResourceTable.id_sresource as id, subResourceTable.subResourceName as name FROM subResourceTable EXCEPT (SELECT subresourcesToRolesTable.id_subresource as id, subResourceTable.subResourceName as name FROM subresourcesToRolesTable, subResourceTable WHERE subresourcesToRolesTable.id_role=".$parametro1." AND subresourcesToRolesTable.borrado=0);";  
    //echo $consulta2;
    
    
    
    $rs_tabla = mysqli_query($conexion,$consulta);
    $nr_usuarios= mysqli_num_rows($rs_tabla);
    
    if ($tipoBusqueda=='listar') {
        echo '<input type="hidden" id="nroLineas" name="numeroLineas" value="'.$nr_Lineas.'">';

        echo '                      <div id="cabeceraResultado" class="header"> 
        Recursos Asignados al Role </div>';
        echo '				<div id="frmResultado">';
        echo '			<table class="fuente8" width="100%" cellspacing=0 cellpadding=3 border=0 ID="Table1">';
        echo '					<tr class="cabeceraTabla">';
        echo '						<td width="20%"><div align="center">CODIGO DEL RECURSO</div></td>';
        echo '						<td width="60%"><div align="center">NOMBRE DEL RECURSO</div></td>';
        echo '						<td width="20%"><div align="center">QUITAR DE LA LISTA</div></td>';
        echo '					</tr>';
        echo '			</table>';
        echo '			</div>';



        while ($nr_usuarios > 0) {
            if ($nr_usuarios % 2) { $fondolinea="itemParTabla"; } else { $fondolinea="itemImparTabla"; }
            $row = mysqli_fetch_row($rs_tabla);
            echo '<table class="fuente8" width="100%" cellspacing=0 cellpadding=3 border=0 ID="Table1">';
            echo '<tr class="'.$fondolinea.'">';
            echo '<td width="20%"><div align="center">'.$row[0].'</div></td>';
            echo '<td width="60%"><div align="center">'.$row[2].'</div></td>';
            echo '<td width="20%"><div align="center"><a href="#"><img src="../../img/borrar.svg" width="16" height="16" border="0"  onClick="ABReso('.$row[0].','.$parametro1.',&#34;quitar&#34;)" title="Quitar"></a></div></td>';
            echo '</tr>';
            echo '</table>';
            /* echo "Codigo de lote: ",$row[0], " Articulo: ",$row[1]," Cantidad: ",$row[2], " Fecha de inizio: ",$row[3]," Hora de inicio: ",$row[4]," Fecha de finalizacion: ".$row[5],"Hora de finalizacion: ",$row[6];*/
            /*     echo "<script type='text/javascript'>console.error('$row');</script>";*/
            $nr_usuarios--;
       }

    $rs_tabla2 = mysqli_query($conexion,$consulta2);
    $nr_usuarios2= mysqli_num_rows($rs_tabla2);
    echo '                      <div id="cabeceraResultado" class="header"> 
    Recursos disponibiles</div>';
    echo '				<div id="frmResultado">';
    echo '			<table class="fuente8" width="100%" cellspacing=0 cellpadding=3 border=0 ID="Table1">';
    echo '					<tr class="cabeceraTabla">';
    echo '						<td width="20%"><div align="center">CODIGO DEL RECURSO</div></td>';
    echo '						<td width="60%"><div align="center">NOMBRE DEL RECURSO</div></td>';
    echo '						<td width="20%"><div align="center">AGREGAR A LA LISTA</div></td>';
    echo '					</tr>';
    echo '			</table>';
    echo '			</div>';

    while ($nr_usuarios2 > 0) {
        if ($nr_usuarios2 % 2) { $fondolinea="itemParTablaAAgregar"; } else { $fondolinea="itemImparTablaAAgregar"; }
        $row2 = mysqli_fetch_row($rs_tabla2);
      
        echo '<table class="fuente8" width="100%" cellspacing=0 cellpadding=3 border=0 ID="Table1">';
        echo '<tr class="'.$fondolinea.'">';
        echo '<td width="20%"><div align="center">'.$row2[0].'</div></td>';
        echo '<td width="60%"><div align="center">'.$row2[1].'</div></td>';
        echo '<td width="20%"><div align="center"><a href="#"><img src="../../img/agregar.svg" width="16" height="16" border="0"  onClick="ABReso('.$row2[0].','.$parametro1.',&#34;agregar&#34;)" title="Agregar"></a></div></td>';
        echo '</tr>';
        echo '</table>';
        /* echo "Codigo de lote: ",$row[0], " Articulo: ",$row[1]," Cantidad: ",$row[2], " Fecha de inizio: ",$row[3]," Hora de inicio: ",$row[4]," Fecha de finalizacion: ".$row[5],"Hora de finalizacion: ",$row[6];*/
        /*     echo "<script type='text/javascript'>console.error('$row');</script>";*/
        $nr_usuarios2--;



    }
    }
    if ($tipoBusqueda=='modificar') {
        while ($nr_usuarios > 0) {
            $row = mysqli_fetch_row($rs_tabla);
                    $data['codusuario']= $row[0];
                    $data['nombre']= $row[1];
                    $data['mail']= $row[2];
                    $data['estado']= $row[3];
                    $data['clave']= $row[4];
                    echo json_encode($data);
              
        $nr_usuarios--;
        }
    }
    
	
?>
