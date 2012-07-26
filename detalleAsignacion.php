
<?
error_reporting(0);

function curPageURL() {
 $pageURL = 'http';
 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}


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


$link=Conectarse(); 
 
 
$id_asignacion = $_REQUEST["id"];
$fecha = $_REQUEST["fecha"];
$sala = $_REQUEST['sala'];
$id_hermano_p = $_REQUEST['id_hermano_P'];
$id_hermano_A = $_REQUEST['id_hermano_A'];
$tipoAsignacion = 0;

$qTipoAsignacion = "select titulo, tipo_asignacion, fecha from asignaciones".
" where id =".$id_asignacion;


 $resultado = mysql_query($qTipoAsignacion,$link); 

   while($res = mysql_fetch_assoc($resultado)) {
$tipoAsignacion = $res["tipo_asignacion"];
$fechaTema =$res["fecha"];
$asignacion = $res["titulo"];
}


$qSalasDisponibles = "select codigo_tipo, texto from tipos_detalle ".
" where id_tipo =5".
" and codigo_tipo not in(".
" select tipo_sala from asignacion_hermanos".
" where id_asignacion =".$id_asignacion.
" group by tipo_sala";

if ($tipoAsignacion == 3){
$qSalasDisponibles =$qSalasDisponibles. " having count(tipo_sala) =2)" ;
}else{
$qSalasDisponibles =$qSalasDisponibles. " having count(tipo_sala) =1)" ;
}


$query = "SELECT h.id hermano, ah.id_asignacion, nombre,apellido_casada, apellido_paterno, apellido_materno,tdp.texto  participacion ,tds.texto sala, leccion   FROM hermanos h". 
" inner join asignacion_hermanos ah on h.id= ah.id_hermano".
" left join tipos_detalle tds on ah.tipo_sala = tds.codigo_tipo and tds.id_tipo = 5".
" left join tipos_detalle tdp on ah.tipo_participacion = tdp.codigo_tipo and tdp.id_tipo = 4".
" where h.participa = 1";
if ($id_asignacion > 0){
    $query = $query . " and  ah.id_asignacion = ". $id_asignacion;
    }

 
 $query2 = "SELECT tipo_asignacion from asignaciones".
" where id=". $id_asignacion;



$result2=mysql_query($query2,$link);


 while($r2 = mysql_fetch_assoc($result2)) {
    $tipo_asignacion = "1,2,4";
    
    if ($r2['tipo_asignacion'] == 1){
        $tipo_asignacion = "1";
        }
    else if ($r2['tipo_asignacion'] == 2 ){
        $tipo_asignacion = "2,4";
        
        }
    else if ($r2['tipo_asignacion'] == 3){
        $tipo_asignacion = "3";
           
            }
    else if ($r2['tipo_asignacion'] == 4){
            $tipo_asignacion = "1,2,4";
           
            }
            
 }

function Respuesta($id_asignacion,$tipo_asignacion , $participacion)
{
  
    
 $link=Conectarse(); 

       
             
             
             $query3 = "SELECT   h.id hermano, nombre,apellido_casada, apellido_paterno, apellido_materno  ,".
                       " DATE_FORMAT(max(fecha),'%d/%m/%Y') as ultimo_tema FROM   hermanos h".
                       " left join asignacion_hermanos ah on h.id = ah.id_hermano".
                       " left join asignaciones a on a.id = ah.id_asignacion".
                       " where h.participa = 1".
                       " and nivel_escuela in (".$tipo_asignacion.")".
                       " and h.id not in (".
                                        " select h.id from hermanos h ".
                                        " inner join asignacion_hermanos ah on h.id = ah.id_hermano".
                                        " inner join asignaciones a on a.id = ah.id_asignacion".
                                        " where fecha =(select fecha from asignaciones where id=".$id_asignacion."))".
                       " group by h.id , nombre,apellido_casada, apellido_paterno, apellido_materno".
                       " order by a.fecha_realiza asc";
             
             $result3=mysql_query($query3,$link); 
             
              echo '<fieldset data-role="controlgroup" data-filter="true">'.
             '<legend>Selecciones</legend>';
             
              while($r3 = mysql_fetch_assoc($result3)) {
             
             
               
             
               echo '<input type="radio" name="id_hermano_'.$participacion.'" id="'.$r3['hermano'] .'" value="'.$r3['hermano'] .'"   data-theme="d"/>'.
                 '<label for="'.$r3['hermano'] .'">'. $r3['nombre']." ".
                 $r3['apellido_casada']." ".
                 $r3['apellido_paterno'].'      '. $r3['ultimo_tema'].' </label>';
             }
             echo '</fieldset>';
             
    
}

 function lecciones(){
  
   $link=Conectarse(); 
  
  $id_hermano =  0 + $_GET['id_hermano'];
  
  
  $query = " select l.id , l.leccion, aplica_a , max(fecha_realiza) as fecha_realiza".
  " from lecciones l".
  " left join asignacion_hermanos ah on ah.leccion = l.id and ah.id_hermano =".$id_hermano.
  " left join asignaciones a on a.id = ah.id_asignacion ".
  " group by l.id";
  
  $result=mysql_query($query,$link); 
    $rows = array();
  
  
  
    while($r = mysql_fetch_assoc($result)) {
    
        
       echo '<li id='.$r['id'] .'><a href="#">'
                                    .'<h3>'.$r['leccion'].'</h3>'.
                                    '<center><p><strong>'.$r['fecha_realiza'].'</strong></p></center>'.
                                    '<p class="ui-li-aside"><strong>'.$r['aplica_a'].'</strong></p>'.
                                    '<span class="ui-li-count">'.$r['id'].'</span>'.
                                    "</a></li>";
    }
  
 
}





$sala = $_GET["sala"];
$participacion    = $_GET["participacion"];
$leccion    = $_GET["leccion"];



?> 

<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
   <meta content="text/html; charset=UTF-8" http-equiv=Content-Type>  
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title></title>
  <meta name="description" content="">
  <meta name="author" content="">

  <meta name="viewport" content="width=device-width,initial-scale=-1">

  <!-- CSS concatenated and minified via ant build script-->

  <link rel="stylesheet" href="css/jquery.mobile-1.0rc1.min.css">
  <!-- end CSS-->


</head>

<body>

<form action="Discursos.php?fecha=<?= $fecha ; ?>" method="POST">
    <div id="container" data-role="page" data-theme="b" data-position="fixed">
    <div data-role="header" data-theme="b">
      <a href="#" data-rel="back">Atras</a>
       <h3>Asigna Tema</h3>
       
       <!-- <a href="asignatema.php?id=" data-icon="arrow-r" class="ui-btn-right">Siguiente</a> -->
    
    </div>
      <div id="main" role="main" data-role="content" data-theme="b" >
      
    <div data-role="fieldcontain">
   <input type="submit"  value="Siguiente" data-icon="arrow-r" >
  
   <input type="hidden" name="idAsignacion" id="idAsignacion" value=<?= $id_asignacion; ?> readonly/>
    <label for="asignacion">Asignacion:</label>
  <input type="text" name="asignacion" id="asignacion" value=<?= '"'.$asignacion.'"'; ?> readonly/>
   
   
   
   <div data-role="collapsible" data-content-theme="c">
            		<h3>Principal</h3>
    				<div>
    					 <?
                        Respuesta($id_asignacion, $tipo_asignacion,'P' );
                        ?>
                        
                    </div>
   </div><!-- collapsible -->
   
    <? if($tipo_asignacion == "3"){ ?>
     <div data-role="collapsible" data-content-theme="c">
   <h3>Ayudante</h3>
   <div>
   	 <?
       Respuesta($id_asignacion,$tipo_asignacion, 'A' );
       ?>
       
   </div>
   
       </div><!-- collapsible -->                
 <? } ?>                    
                    
                    
                 
                        
                 <br>
                 
              <label for="tipo_sala">Sala</label>
                        <select name="tipo_sala" id="tipo_sala" data-theme="d" data-native-menu="false">
                        <? 
                        
                        $resultado=mysql_query($qSalasDisponibles,$link); 
                     
                        
                        while($res = mysql_fetch_assoc($resultado)) {
                       
                            if($sala == $res['codigo_tipo'] ){
                            $selected = " selected=selected ";
                            }else{
                                $selected= "";
                                }
                         
                            echo "<option value=".$res['codigo_tipo'] .$selected.">".$res['texto']."</option>";
                        }
                        ?>
                      </select>
                      <br>
                        <label for="leccion">Leccion:</label>
                        <input type="tel" name="leccion" id="leccion" data-theme="d" value=<?= '"'.$leccion.'"'; ?> />
                            			

     <div data-role="collapsible" data-content-theme="c">
<h3>Ver Lecciones</h3>
<div>
<ul data-role="listview" data-inset="true" id ="menu" data-filter="true" >
     <?
    lecciones();
    ?>
    </ul>
</div>

    </div><!-- collapsible -->   
                  

  
  
    </div><!--content-->
    

  
  </div> <!-- end of #container -->

</form>

  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="js/libs/jquery-1.6.2.min.js"><\/script>')</script>
  <script src="js/libs/jquery.mobile-1.0rc1.min.js"></script>

  <!-- scripts concatenated and minified via ant build script-->
  <script defer src="js/plugins.js"></script>
  <script defer src="js/script.js"></script>
  <!-- end scripts-->


    <script >
$(function(){

  $("li").click(function(){
    $("#leccion").val($(this).attr("id"));
    
  })
})
  </script>
  
</body>
</html>

