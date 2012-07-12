
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
    
        
       echo "<li id=".$r['id'] ."><a href=detalleHermano.php?id=".$r['id'].">".$r['nombre']." ".$r['apellido_paterno']." ".$r['apellido_materno']."</a></li>";
    }
  
   
    mysql_free_result($rows); 
    mysql_close($link); 
}


$query = "select ".
"id, nombre, apellido_paterno, apellido_materno  ".
"from hermanos as hermanos ".
"where hermanos.tipo_sexo = 1 ".
"order by  ".
"hermanos.nombre, ".
"hermanos.apellido_paterno ";
echo $query;

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

  <div id="container" data-role="page" data-add-back-btn="true">
  <div data-role="header" data-theme="b">
     <center><h3>Hermanos y Hermanas</h3></center>
    </div>
    <div id="main" role="main" data-role="content" data-theme="b" >

       
        <ul data-role="listview" data-inset="true" id ="menu" data-filter="true" >
    
        <li data-role="list-divider">Menu Principal</li>
        <?
        Respuesta($query);
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

