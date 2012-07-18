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


$nombre = $_POST["nombre"];
$apellido_paterno    = $_POST["apellido_paterno"];
$apellido_materno = $_POST["apellido_materno"];
$apellido_casada  = $_POST["apellido_casada"];
$direccion  = $_POST["direccion"];
$telefono   = $_POST["telefono"];
$tipo_sexo  = $_POST["tipo_sexo"];
$tipo_privilegio  = $_POST["tipo_privilegio"];
$nivel_escuela = $_POST["nivel_escuela"];
$activo  = $_POST["activo"];
$vigente = $_POST["vigente"];
$participa  = $_POST["participa"];
$id_grupo  = $_POST["id_grupo"];


 $update="update hermanos set".
    ' nombre ="'. $_POST["nombre"].'"'.   
    ' ,apellido_paterno="'.$_POST["apellido_paterno"].'"'.
    ' ,apellido_materno="'.$_POST["apellido_materno"].'"'.
    ' ,apellido_casada"'.$_POST["apellido_casada"].'"'.
    ' ,direccion"'.$POST["direccion"].'"'.
    ' ,telefono="'.$_POST["telefono"].'"'.
    ' ,tipo_sexo='.$_POST["tipo_sexo"].
    ' ,tipo_privilegio='.$_POST["tipo_privilegio"].
    ' ,nivel_escuela='.$_POST["nivel_escuela"].
    ' ,activo='.$_POST["activo"].
    ' ,vigente='.$_POST["vigente"].
    ' ,participa='.$_POST["participa"].
    ' ,id_grupo='.$_POST["id_grupo"].
    ' where id= '.$_REQUEST["id"];
    
    echo ($update);

?>