<? /*asignaciones de hermanos ordenadas por fecha 

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

select
h.id,
h.nombre,
ta.texto,
ah.leccion,
DATE_FORMAT(a.fecha,'%d/%m/%Y')  fecha
 from hermanos h
left join asignacion_hermanos ah on h.id = ah.id_hermano
left join asignaciones a on ah.id_asignacion = a.id
left join tipos_detalle ta on a.tipo_asignacion = ta.codigo_tipo and id_tipo = 3
where h.nivel_escuela in (2,4)
and tipo_privilegio <> 1
and h.participa = 1
and h.id not in (select h.id from hermanos h
inner join asignacion_hermanos ah on h.id = ah.id_hermano
inner join asignaciones a on ah.id_asignacion = a.id
where a.fecha > '2011-12-01'
)
order by a.fecha,
nivel_escuela asc*/
?>

<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="es"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="es"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="es"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="es"> <!--<![endif]-->
<head>
     <!--<meta content="text/html; charset=iso-8859-1" http-equiv=Content-Type>  -->
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
     <form action="SemanasDiscursos.php" method="GET">
        <label for="ano">Año</label>
         <select name="ano" id="ano" data-theme="d" data-native-menu="false">
        <option value="2012">2012</option>
        <option value="2011">2011</option>
        </select>
           <br>
            <fieldset data-role="controlgroup">
           <legend>Seleccione un Mes</legend>
        <input type="radio" name="mes" id="enero" value="1"   data-theme="d"/>
       <label for="enero">Enero</label>
       
       <input type="radio" name="mes" id="febrero" value="2"   data-theme="d"/>
       <label for="febrero">Febrero</label>
       
       <input type="radio" name="mes" id="marzo" value="3"   data-theme="d"/>
       <label for="marzo">Marzo</label>
       
       <input type="radio" name="mes" id="abril" value="4"   data-theme="d"/>
       <label for="abril">Abril</label>
    
        <input type="radio" name="mes" id="mayo" value="5"   data-theme="d"/>
        <label for="mayo">Mayo</label>
        
        <input type="radio" name="mes" id="junio" value="6"   data-theme="d"/>
        <label for="junio">Junio</label>
        
        <input type="radio" name="mes" id="julio" value="7"   data-theme="d"/>
        <label for="julio">Julio</label>
        
        <input type="radio" name="mes" id="agosto" value="8"   data-theme="d"/>
        <label for="agosto">Agosto</label>
        
        <input type="radio" name="mes" id="septiembre" value="9"   data-theme="d"/>
        <label for="septiembre">Septiembre</label>
        
        <input type="radio" name="mes" id="octubre" value="10"   data-theme="d"/>
        <label for="octubre">Octubre</label>
        
        <input type="radio" name="mes" id="noviembre" value="11"   data-theme="d"/>
        <label for="noviembre">Noviembre</label>
    
        <input type="radio" name="mes" id="diciembre" value="12"   data-theme="d"/>
        <label for="diciembre">Diciembre</label>
        </fieldset>
        
    <input type="submit" id="aceptar" value="Aceptar" />
        </form>
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




