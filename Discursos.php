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
$asignacion = 0;
$participacionA = 0;
$fecha = $_GET["fecha"];
$idAsignacion = $_POST["asignacion"];
$participacionP = $_POST["id_hermano_P"];
$participacionA = $_POST["id_hermano_A"];
$tipo_sala =$_POST["tipo_sala"];
$leccion =$_POST["leccion"];

if ($idAsignacion != 0){
echo 1;
  if ($tipo_sala == 1){

    $tipo_participacionP = 1;
    $tipo_participacionA = 2;
  }else{
    $tipo_participacionP = 3;
    $tipo_participacionA = 4;
  }
$link=Conectarse();
    $sqlP = "INSERT INTO `asignacion_hermanos`(`id_hermano`, `id_asignacion`, `tipo_sala`, `tipo_participacion`, `leccion`, `realizo`)"
     . "VALUES (".$participacionP.",".$asignacion.",".$tipo_sala.",".$tipo_participacionP.",".$leccion.",0)";
     echo $sqlP;
    $result=mysql_query($sqlP,$link); 
  
  if ($participacionA !=0){
        $sqlA = "INSERT INTO `asignacion_hermanos`(`id_hermano`, `id_asignacion`, `tipo_sala`, `tipo_participacion`, `leccion`, `realizo`)"
     . "VALUES (".$participacionP.",".$asignacion.",".$tipo_sala.",".$tipo_participacionA.",".$leccion.",0)";
     echo $sqlA;
     $result=mysql_query($sqlA,$link); 
  
  }
  mysql_close($link); 
}

$query = "SELECT a.id,titulo, count(ia.tipo_sala) count FROM asignaciones a\n"
    . "left join asignacion_hermanos ia on ia.id_asignacion= a.id\n"
    . "where fecha='" .$fecha. "' "
    . "group by a.id,titulo\n"
    . "order by tipo_asignacion\n"
    . "";

$sql = "\n"
    . "SELECT h.id hermano, nombre,apellido_casada, apellido_paterno, apellido_materno, ta.texto,ifnull( tp.texto,'') participacion, ah.leccion FROM hermanos h\n"
    . " left join asignacion_hermanos ah on h.id = ah.id_hermano\n"
    . " left join asignaciones a on a.id = ah.id_asignacion\n"
    . "left join tipos_detalle ta on ta.codigo_tipo = a.tipo_asignacion and ta.id_tipo=3\n"
    . "left join tipos_detalle tp on tp.codigo_tipo = ah.tipo_participacion and tp.id_tipo=4\n"
    . "\n"
    . " where fecha='" .$fecha. "' "
    . " ";



function Respuesta($query,$fecha)
{
  
    
 $link=Conectarse(); 
    $result=mysql_query($query,$link); 
    $rows = array();
  
    while($r = mysql_fetch_assoc($result)) {
    
        
       echo "<li id=".$r['id'] ."><a data-ajax=false href=detalleAsignacion.php?id=".$r['id']."&fecha=".$fecha.">".$r['titulo']."<span class=ui-li-count>".$r['count']."</span></a></li>";
    }
  
   
    mysql_free_result($result); 
    mysql_close($link); 
}

function Asignados($sql)
{
  
    
 $link=Conectarse(); 
    $result=mysql_query($sql,$link); 
    $rows = array();
  
    while($r = mysql_fetch_assoc($result)) {
    
        
       echo '<li id='.$r['hermano'] .'><a href="#">'
                                    .'<p><strong>'.$r['nombre'].' ' .$r['apellido_casada'].' '.$r['apellido_paterno'].  '</strong></p>'.
                                    '<p><strong>'.$r['texto'].'</strong></p>'.
                                    '<p class="ui-li-aside"><strong>'.$r['participacion'].'</strong></p>'.
                                    '<span class="ui-li-count">'.$r['leccion'].'</span>'.
                                    "</a></li>";
    }
  
   
    mysql_free_result($result); 
    mysql_close($link); 
}



 
?>
<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="es"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="es"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="es"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="es"> <!--<![endif]-->
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

  <script src="js/libs/modernizr-2.0.6.min.js"></script>
</head>

<body>

  <div id="container" data-role="page" data-add-back-btn="true">
  <div data-role="header" data-theme="b">
    <a href="#" data-rel="back">Atras</a>
    <h3>Asignaciones</h3>
    </div>
    <div id="main" role="main" data-role="content" data-theme="b" >


        <ul data-role="listview" data-inset="true" id ="menu" data-filter="true" >
    
        <li data-role="list-divider">Asignaciones</li>

        <?
        Respuesta($query,$fecha);
        ?>
        
        
        </ul>

<br>
<br>

        <ul data-role="listview" data-inset="true" id ="Asignados"  >
    
        <li data-role="list-divider">Asignados</li>

        <?
        Asignados($sql);
        ?>
        
        
        </ul>
    
    </div><!--content-->
    

 
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