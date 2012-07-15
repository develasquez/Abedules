
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

$id = $_GET["id"];

$query = "SELECT ".
"id ".
",nombre ".   
",apellido_paterno    ".
",apellido_materno	".
",apellido_casada	".
",direccion	".
",telefono	".
",tipo_sexo	".
",tipo_privilegio	".
",nivel_escuela	".
",activo	".
",vigente	".
",participa	".
",id_grupo  ".
"FROM hermanos  ".
"where id =". $id  ;

//Respuesta($query);

$nombre = $_POST["nombre"];
$apellido_paterno    = $_POST["apellido_paterno"];
$apellido_materno	= $_POST["apellido_materno"];
$apellido_casada	= $_POST["apellido_casada"];
$direccion	= $_POST["direccion"];
$telefono	= $_POST["telefono"];
$tipo_sexo	= $_POST["tipo_sexo"];
$tipo_privilegio	= $_POST["tipo_privilegio"];
$nivel_escuela	= $_POST["nivel_escuela"];
$activo	= $_POST["activo"];
$vigente	= $_POST["vigente"];
$participa	= $_POST["participa"];
$id_grupo  = $_POST["id_grupo"];



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

  
    <?
    
    
    
     $link=Conectarse(); 
    if($nombre != ""){
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
    ' where id= '.$_POST["id"];
    
    echo ($update);
    //$result=mysql_query($update,$link); 
    
    
    }
    
    $result=mysql_query($query,$link); 
    $rows = array();
    while($r = mysql_fetch_assoc($result)) {
    $tipo_privilegio = $r['tipo_privilegio']; 
    $nivel_escuela = $r['nivel_escuela'];
    $grupo = $r['id_grupo'];
    
    
    
    
    
    ?>
    <div id="container" data-role="page" data-theme="b" data-position="fixed">
    <form action="detalleHermano.php" > 
    <div data-role="header" data-theme="b">
       <h1>Page Title</h1>
       
      </div>
      <div id="main" role="main" data-role="content" data-theme="b" >
      
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" id="nombre" value=<?= '"'.$r['nombre'].'"'; ?> />
    <label for="apellido_paterno">Apellido Paterno:</label>
    <input type="text" name="apellido_paterno" id="apellido_paterno" value=<?= '"'.$r['apellido_paterno'].'"'; ?> />
    <label for="apellido_materno">Apellido Materno:</label>
    <input type="text" name="apellido_materno" id="apellido_materno" value=<?= '"'.$r['apellido_materno'].'"'; ?> />
    <label for="apellido_casada">Apellido Casada:</label>
    <input type="text" name="apellido_casada" id="apellido_casada" value=<?= '"'.$r['apellido_casada'].'"'; ?>/>
    <label for="direccion">Dirección:</label>
    <input type="text" name="direccion" id="direccion" value=<?='"'. $r['direccion'].'"'; ?>/>
    <label for="telefono">Telefono:</label>
    <input type="text" name="telefono" id="telefono" value=<?= '"'.$r['telefono'].'"'; ?>/>
       <div data-role="fieldcontain">
   <fieldset data-role="controlgroup">
   	<legend>Sexo:</legend>
        	<input type="radio" name="tipo_sexo" id="radio-hermano" value=1  <? if($r['tipo_sexo'] == "1"){echo "checked";}?>/>
        	<label for="radio-hermano">Hermano</label>
   
        	<input type="radio" name="tipo_sexo" id="radio-hermana" value=2 <?if($r['tipo_sexo'] == "2"){echo "checked";}?>  />
        	<label for="radio-hermana">Hermana</label>
   </fieldset>
   </div>
    <div data-role="fieldcontain">
    	<label for="tipo_privilegio">Privilegio</label>
    	<select name="tipo_privilegio" id="tipo_privilegio" data-theme="d" data-native-menu="false">
        <?  $query_tipos_privilegio = "select codigo_tipo, texto from tipos_detalle where id_tipo = 2";
        $resultado=mysql_query($query_tipos_privilegio,$link); 
        
        while($res = mysql_fetch_assoc($resultado)) {
            if ($res['codigo_tipo'] == $tipo_privilegio ){
            $selected = " selected=selected ";}
            else{
            $selected = " ";    
                }
            echo "<option value=".$res['codigo_tipo'] .$selected.">".$res['texto']."</option>";
        }
        ?>
    	</select>
    </div>
    <div data-role="fieldcontain">
    	<label for="nivel_escuela" >Nivel Escuela</label>
    	<select name="nivel_escuela" id="nivel_escuela" data-theme="d" data-native-menu="false">
    	  <?  $query_nivel_escuela = "select codigo_tipo, texto from tipos_detalle where id_tipo = 3";
        $resul=mysql_query($query_nivel_escuela,$link); 
        
        while($re = mysql_fetch_assoc($resul)) {
            if ($re['codigo_tipo'] == $nivel_escuela ){
            $select = " selected=selected ";}
            else{
            $select = " ";    
                }
            echo "<option value=".$re['codigo_tipo'] .$select.">".$re['texto']."</option>";
        }
        ?>
    	</select>
    </div>
      <?
    if ($r['activo'] == "1" ){
    $selectActivo = " selected=selected ";}
    else{
    $selectActivo = " ";    
        }
    ?>
    
   
    <div data-role="fieldcontain">
    <label for="select-choice-15">Activo:</label>
    <select name="activo" id="activo" data-role="slider" disabled >
    	<option value=0>No</option>
    	<option value=1 <? echo $selectActivo ?>>Si</option>
    </select>
    </div> 
    <?
    if ($r['participa'] == "1" ){
    $selectParticipa = " selected=selected ";}
    else{
    $selectParticipa = " ";    
        }
    ?>
    
    <div data-role="fieldcontain">
    <label for="select-choice-15">Participa:</label>
    <select name="participa" id="participa" data-role="slider" disabled >
    	<option value=0>No</option>
        <option value=1 <? echo $selectParticipa ?>>Si</option>
    </select>
    </div> 
      <?
    if ($r['vigente'] == "1" ){
    $selectVigente = " selected=selected ";}
    else{
    $selectVigente = " ";    
        }
    ?>
    
    <div data-role="fieldcontain">
    <label for="select-choice-15">Vigente:</label>
    <select name="vigente" id="vigente" data-role="slider" disabled >
    	<option value=0>No</option>
        <option value=1 <? echo $selectVigente ?>>Si</option>
    </select>
    </div> 
    
    
       <div data-role="fieldcontain">
        <label for="select-choice-15">Grupo</label>
    	<select name="select-choice-15" id="select-choice-15" data-theme="d" data-native-menu="false">
       <option value=1 <? if($grupo == "1" ){ echo "selected=selected "; } ?>>Grupo 1</option>
       <option value=2 <? if($grupo == "2" ){ echo "selected=selected "; } ?>>Grupo 2</option>
       <option value=3 <? if($grupo == "3" ){ echo "selected=selected "; } ?>>Grupo 3</option>
       <option value=4 <? if($grupo == "4" ){ echo "selected=selected "; } ?>>Grupo 4</option>
       <option value=5 <? if($grupo == "5" ){ echo "selected=selected "; } ?>>Grupo 5</option>

    	</select>
    </div>
    
    <?} ?>

    </div><!--content-->
    

  
  </div> <!--! end of #container -->
    </form>

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

