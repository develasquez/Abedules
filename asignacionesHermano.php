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

$id_asignacion = $_GET["id"];


$query = "SELECT h.id hermano, ah.id_asignacion, nombre,apellido_casada, apellido_paterno, apellido_materno,tdp.texto  participacion ,tds.texto sala, leccion   FROM hermanos h". 
" inner join asignacion_hermanos ah on h.id= ah.id_hermano".
" left join tipos_detalle tds on ah.tipo_sala = tds.codigo_tipo and tds.id_tipo = 5".
" left join tipos_detalle tdp on ah.tipo_participacion = tdp.codigo_tipo and tdp.id_tipo = 4".
" where h.participa = 1";
if ($id_asignacion > 0){
    $query = $query . " and  ah.id_asignacion = ". $id_asignacion;
    }



function Respuesta($query ,  $id_asignacion)
{
  
    
 $link=Conectarse(); 
    $result=mysql_query($query,$link); 
    $rows = array();
    $numero_rows = mysql_num_rows($result);
   
    if($numero_rows > 0){
        
        echo ' <ul data-role="listview" data-inset="true" id ="lista_hermanos" data-filter="true" >'.
        '<li data-role="list-divider">Hermanos</li>';
    while($r = mysql_fetch_assoc($result)) {
    
        
       echo "<li id=".$r['id'] ."><a href=asignacionesHermano.php?id=".$r['id'].">".
                                $r['nombre']." ".
                                $r['apellido_casada']." ".
                                $r['apellido_paterno'].
                                "<p>".$r['participacion']."</p>".
                                '<span class="ui-li-count">'.$r['leccion'].'</span>'.
                                "</a></li>";
    }
    echo ' </ul>';
    }else{
        
         $query2 = "SELECT tipo_asignacion from asignaciones".
        " where id=". $id_asignacion;
        
    
        
        $result2=mysql_query($query2,$link);
        
   
         while($r2 = mysql_fetch_assoc($result2)) {
            $tipo_asignacion = "1,2,4";
            
            if ($r['tipo_asignacion'] = 1){
                $tipo_asignacion = "1";
                }
            else if ($r['tipo_asignacion'] = 2 ){
                $tipo_asignacion = "2,4";
                
                }
            else if ($r['tipo_asignacion'] = 3){
                $tipo_asignacion = "3";
                   
                    }
            else if ($r['tipo_asignacion'] = 4){
                    $tipo_asignacion = "1,2,4";
                   
                    }
                    
            
             
             
             $query3 = "SELECT   h.id hermano, nombre,apellido_casada, apellido_paterno, apellido_materno  ,".
                       " DATE_FORMAT(max(fecha),'%d/%m/%Y') as ultimo_tema FROM   hermanos h".
                       " inner join asignacion_hermanos ah on h.id = ah.id_hermano".
                       " inner join asignaciones a on a.id = ah.id_asignacion".
                       " where h.participa = 1".
                       " and nivel_escuela in (".$tipo_asignacion.")".
                       " group by h.id , nombre,apellido_casada, apellido_paterno, apellido_materno".
                       " order by a.fecha_realiza asc";
             
             $result3=mysql_query($query3,$link); 
             
              echo '<fieldset data-role="controlgroup">'.
             '<legend>Seleccione un Mes</legend>';
             
              while($r3 = mysql_fetch_assoc($result3)) {
             
             
               
             
               echo '<input type="radio" name="id_hermano" id="'.$r3['hermano'] .'" value="'.$r3['hermano'] .'"   data-theme="d"/>'.
                 '<label for="'.$r3['hermano'] .'">'. $r3['nombre']." ".
                 $r3['apellido_casada']." ".
                 $r3['apellido_paterno'].'      '. $r3['ultimo_tema'].' </label>';
             }
             echo '</fieldset>';
             
             }
        
        
        
        
        }
   
    mysql_free_result($rows); 
    mysql_close($link); 
}
$sala = $_GET["sala"];
$participacion    = $_GET["participacion"];
$leccion    = $_GET["leccion"];


?>
<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="es"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="es"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="es"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="es"> <!--<![endif]-->
<head>
     <meta content="text/html; charset=iso-8859-1" http-equiv=Content-Type>  
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title></title>
  <meta name="description" content="">
  <meta name="author" content="">

  <meta name="viewport" content="width=device-width,initial-scale=-1">

  <!-- CSS concatenated and minified via ant build script-->

  <link rel="stylesheet" href="css/jquery.mobile-1.0rc1.min.css">
  <!-- end CSS-->

  <script src="js/libs/modernizr-2.0.6.min.js"></script>
</head>

<body>

  <div id="container" data-role="page" data-add-back-btn="true">
  <form action="detalleAsignacion.php" method="GET">
  <div data-role="header" data-theme="b" data-position="inline">
  
     <input type="hidden" name="id" id="id" value=<?= '"'.$id_asignacion.'"'; ?> />
     <input type="hidden" name="sala" id="sala" value=<?= '"'.$sala.'"'; ?> />
     <input type="hidden" name="participacion" id="participacion" value=<?= '"'.$participacion.'"'; ?> />
     <input type="hidden" name="leccion" id="leccion" value=<?= '"'.$leccion.'"'; ?> />
     
         <h1>Hermanos Disponibles</h1>
         <input type="submit" data-icon="check" data-theme="b" class="ui-btn-right">Seleccionar</a>
    </div>
    <div id="main" role="main" data-role="content" data-theme="b" >

       
      
        <?
        Respuesta($query,  $id_asignacion);
        ?>
        
        
    
    
    </div><!--content-->
    

 </form>
  </div> <!--! end of #container -->


  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="js/libs/jquery-1.6.2.min.js"><\/script>')</script>
  <script src="js/libs/jquery.mobile-1.0rc1.min.js"></script>

  <!-- scripts concatenated and minified via ant build script-->
  <script defer src="js/plugins.js"></script>
  <script defer src="js/script.js"></script>
  <!-- end scripts-->


  <script> // Change UA-XXXXX-X to be your site's ID
    window._gaq = [['_setAccount','UAXXXXXXXX1'],['_trackPageview'],['_trackPageLoadTime']];
    Modernizr.load({
      load: ('https:' == location.protocol ? '//ssl' : '//www') + '.google-analytics.com/ga.js'
    });
  </script>


  <!--[if lt IE 7 ]>
    <script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
    <script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
  <![endif]-->
  
</body>
</html>
