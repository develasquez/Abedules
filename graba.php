<?

function Conectarse() 
{ 
   
   if (!($link=mysql_connect("localhost","root","devenew1"))) 
   { 
      echo '{"success":true, "data":[], "errors":"Error al conectar con la Base de Datos" }'; 
      exit(); 
   } 
   if (!mysql_select_db("abedules",$link)) 
   { 
      echo '{"success":true, "data":[], "errors":"Error seleccionando la base de datos" }'; 
      exit(); 
   } 
   return $link; 
} 





 $update="update hermanos set".
    ' nombre ="'. $_GET["nombre"].'"'.   
    ' ,apellido_paterno="'.$_GET["apellido_paterno"].'"'.
    ' ,apellido_materno="'.$_GET["apellido_materno"].'"'.
    ' ,apellido_casada"'.$_GET["apellido_casada"].'"'.
    ' ,direccion"'.$_GET["direccion"].'"'.
    ' ,telefono="'.$_GET["telefono"].'"'.
    ' ,tipo_sexo='.$_GET["tipo_sexo"].
    ' ,tipo_privilegio='.$_GET["tipo_privilegio"].
    ' ,nivel_escuela='.$_GET["nivel_escuela"].
    ' ,activo='.$_GET["activo"].
    ' ,vigente='.$_GET["vigente"].
    ' ,participa='.$_GET["participa"].
    ' ,id_grupo='.$_GET["id_grupo"].
    ' where id= '.$_REQUEST["id"];
    
    echo ($update);

?>