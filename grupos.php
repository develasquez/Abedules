
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


function Respuesta($query)
{
  
    
 $link=Conectarse(); 
    $result=mysql_query($query,$link); 
    $rows = array();
    while($r = mysql_fetch_assoc($result)) {
        $rows[] = $r;
    }
    $json_response = '{"success":true, "data":' . json_encode($rows) . ', "errors":false }';
    print ($json_response) ;
    mysql_free_result($result); 
    mysql_close($link); 
}


$query = "select ".
"asignaciones.titulo as Titulo ".
",hermanos.nombre as Nombre ".
",hermanos.apellido_casada ". 
", hermanos.apellido_paterno ".
",hermanos.apellido_materno ".
",td_sala.texto as Sala ".
",asignacion_hermanos.leccion ".
",asignaciones.fecha_realiza as Fecha ".
" from asignaciones as asignaciones ".
"inner join asignacion_hermanos as asignacion_hermanos on asignaciones.id = asignacion_hermanos.id_asignacion ".
"inner join hermanos as hermanos on asignacion_hermanos.id_hermano = hermanos.id ".
"inner join tipos_detalle as td_sala  on asignacion_hermanos.tipo_sala = td_sala.codigo_tipo and  td_sala.id_tipo = 5 ".
"order by  ".
"asignaciones.tipo_asignacion ".
",asignacion_hermanos.tipo_sala ";

//Respuesta($query);
?> 

<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
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

  <div id="container" data-role="page" data-theme="b" data-position="fixed">
  <div data-role="header" data-theme="b">
    <a href="#" data-rel="back">Atras</a>
     <center><h3>Hermanos y Hermanas (Grupos)</h3></center>
    </div>
    <div id="main" role="main" data-role="content" data-theme="b" >

    
        <ul data-role="listview" data-inset="true" id ="menu" >
    
        <li data-role="list-divider">Seleccione un Grupo</li>
    
    	<li  id="g1"><a href="hermanos.php?grupo=1">Grupo 1</a>
        </li>
        <li  id="g2"><a href="hermanos.php?grupo=2">Grupo 2</a>
        </li>
        <li  id="g3"><a href="hermanos.php?grupo=3">Grupo 3</a>
        </li>
        <li  id="g4"><a href="hermanos.php?grupo=4">Grupo 4</a>
        </li>
        <li  id="g5"><a href="hermanos.php?grupo=5">Grupo 5</a>
        </li>
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

