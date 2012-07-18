
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

 $link=Conectarse(); 
 
 
$id_asignacion = $_GET["id"];
echo $id_asignacion;
$tipoAsignacion = 0;

$qTipoAsignacion = "select tipo_asignacion, fecha from asignaciones".
" where id =".$id_asignacion;


 $resultado = mysql_query($qTipoAsignacion,$link); 

   while($res = mysql_fetch_assoc($resultado)) {
$tipoAsignacion = $res["tipo_asignacion"];
$fechaTema =$res["fecha"];
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

if ($tipoAsignacion == 3){
$qParticipacionesDisponibles = "select codigo_tipo, texto from tipos_detalle". 
" where id_tipo =4".
" and codigo_tipo not in(".
" select tipo_participacion from asignacion_hermanos".
" where id_asignacion =". $id_asignacion. ")" ;

}else{
    $qParticipacionesDisponibles ="";
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
       <h1>Asigna Tema</h1>
       <a href="asignatema.php?id=<?= $id_asignacion; ?>" data-icon="gear" class="ui-btn-right">Siguiente</a>
        <a href="Discursos.php?fecha=<?= $fechaTema; ?>" data-icon="gear" class="ui-btn-left">Asignaciones</a>
      </div>
      <div id="main" role="main" data-role="content" data-theme="b" >
      
    <div data-role="fieldcontain">
    	<label for="tipo_privilegio">Sala</label>
    	<select name="tipo_privilegio" id="tipo_privilegio" data-theme="d" data-native-menu="false">
        <? 
        $resultado=mysql_query($qSalasDisponibles,$link); 
        
        while($res = mysql_fetch_assoc($resultado)) {
            if($sala == $res['codigo_tipo'] ){
            $selected = "selected";
            }else{
                $selected= "";
                }
            echo "<option value=".$res['codigo_tipo'] .$selected.">".$res['texto']."</option>";
        }
        ?>
    	</select>
    </div>
    <div data-role="fieldcontain">
    	<label for="nivel_escuela" >Participacion</label>
    	<select name="nivel_escuela" id="nivel_escuela" data-theme="d" data-native-menu="false">
    	  <?  
        $resul=mysql_query($qParticipacionesDisponibles,$link); 
        
        while($re = mysql_fetch_assoc($resul)) {
            
            if($participacion == $re['codigo_tipo'] ){
                $select = " selected=selected ";
                }
          
            echo "<option value=".$re['codigo_tipo'] .$select.">".$re['texto']."</option>";
        }
        ?>
    	</select>
        <label for="nombre">Leccion:</label>
        <input type="tel" name="leccion" id="leccion" value=<?= '"'.$leccion.'"'; ?> />
        
  </div>
 
  
  
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

