<?php
	$datostabla = '<div class="box">';
	$datostabla .='<table class="table is-stripped is-narrow is-bordered">';

	if ($gestor = opendir($_SERVER['DOCUMENT_ROOT'].'/backup/')){
		
		while (false !== ($archivo = readdir($gestor))){
			if (preg_match("/sql/i", $archivo)){
				$datostabla .= "<tr>";
				$datostabla .= "<td align='center'><img src='../img/database.png' alt='' />&nbsp;$archivo</td>";
				$datostabla .= "<td><center><a style='text-decoration:none;' href='../php/backup_down.php?arch=$archivo'><img src='../img/icon_download.gif' title='Descargar Respaldo' alt='' /><br />Descargar</a></center></td>";
				$datostabla .= '<td><center><font color="#3c57a7"><a style="cursor:pointer;" onclick="eliminar(&quot;'.$archivo.'&quot;)"><img src="../img/table_row_delete.png" title="Eliminar Respaldo" alt=""/><br />Eliminar</a></font></center></td>';
				$datostabla .= '<td><center><font color="#3c57a7"><a style="cursor:pointer;" onclick="cargar(&quot;'.$archivo.'&quot;)"><img src="../img/table_row_insert.png" title="Subir Respaldo" alt=""/><br />Cargar</a></font></center></td>';
				$datostabla .= "</tr>";
			}
		}
		closedir($gestor);
	}

	$datostabla .= "</table>";
	$datostabla .= "</div>";
	$response=null;
	$response[0] = array('tabla' => $datostabla);
	
	echo json_encode($response);
?>