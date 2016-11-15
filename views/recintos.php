<?php 



$_SESSION['idRecinto']=NULL;



//Comprobamos que el usuario registrado siempre vea el header jugador

    if(isset($_SESSION['login_user_id'])){
        include('layout/headerJugador.php');
        $jugar=1;
    }else{
        include('layout/header.php');
        $jugar=0; 
    }
        
?>





        <!-- Portfolio section start -->
        <!--link rel="stylesheet" type="text/css" href="css/bootstrap.css" /-->
        <link href="assets/css/profile.css" rel="stylesheet">
    
        <div id="contact-us" class="parallax">
             <?php if(isset($_GET["nuevo"])){ 
                        if($_GET["nuevo"]==1){   ?>

                             <div class="container">
                             <div class="alert alert-success fade in">
                             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                             <strong>Listo!</strong> Comentario agregado!
                            </div>
                             </div>


            <?php          }else{ ?>
                           <div class="container">
                             <div class="alert alert-success fade in">
                             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                             <strong>Listo!</strong> Puntuacion agregada!
                            </div>
                             </div>

                               <?php     }

                        }
                ?>

            <div class="container">
                <br>
                <ol class="breadcrumb transparent">
                    <li class="breadcrumb-item"><a href="?controlador=Index&accion=indexJugador"> <i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
                    <li class="breadcrumb-item active">Recintos</li>
                </ol>
                    <?php 
                    if($jugar==1){  
                    ?>
                    <div class="page-header">
                      <h2> Elige la cancha para el partido <i class="fa fa-futbol-o" aria-hidden="true"></i> </h2>
                    </div>
                    <?php    
                    } else {
                    ?>
                    <div class="page-header">
                      <h2> Busca tu cancha ideal <i class="fa fa-futbol-o" aria-hidden="true"></i> </h2>
                    </div>
                    <?php           
                    }?>

                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <form action="?controlador=Recinto&accion=busquedaRecintos" method="POST" >
                            <input type="text" class="form-control" placeholder="Busca tu cancha..." name="search" id="texto-input-white"/>

                            <!--Aqui como se "recarga" debemos seguir manteniendo la "seleccion de cancha"-->
                            <?php 
                            if($jugar==1){
                            ?>
                            <input  name="jugar" hidden value="1"/>
                            <?php } 
                            if(isset($_SESSION['login_user_id'])){
                            ?>
                            <input type="text" class="fomr-control" hidden name="tipo" value="1"/>
                            <?php }else{?>
							<input type="text" class="fomr-control" hidden name="tipo" value="0"/>
                            <?php } ?>
                            
                                <div class="col-md-12">
                                    <br/>
                                    <button class="btn btn-primary btn-lg col-md-12 " type="submit">
                                        Buscar
                                        <i class="fa fa-search" aria-hidden="true"></i>
                                    </button>  
                                </div>     
                        </form>
                    </div><!-- /.col-lg-6 -->
                </div>


                <?php
                    $search = '';
                    $cont = 0;
                    if (isset($vars['search'])) {
                      $search = $vars['search'];
                    }
                    if ($search!=''){  // if search

                        // AHORA VIENEN LOS RESULTADOS
                        ?>
                <h3>Resultados</h3>

                <ul class="nav nav-pills">
                    <li class="filter" data-filter="photo"></li>
                    <li class="filter" data-filter="identity"></li>
                </ul>
                <div id="single-project">
                    <?php
                    } // fin if search
                    foreach ($vars['recintos'] as $key) {   // foreach recintos
                        if($key['estado'] == 1){
                        $nombre = $key['nombre'];
                        $pos = strripos($nombre, $search);
                        $tipo = $key['tipo'];
                        $pos2 = strripos($tipo, $search);
                        $superficie = $key['superficie'];
                        $pos3 = strripos($superficie, $search);
                        $idRecinto = $key['idRecinto'];
                        if ($pos !== false  ||   $pos2!==false  || $pos3!==false )  {  // if filtro dentro de foreach recintos
                            
                    ?>



                    <div id="slidingDiv<?php echo $cont?>" class="toggleDiv row-fluid single-project">
                        <div class="span6"> 
                            <style>
                                .Flexible-container {
                                    position: relative;
                                    padding-bottom: 56.25%;
                                    padding-top: 80px;
                                    height: 0;
                                  /* overflow: hidden; */
                                }
                                .Flexible-container iframe,   
                                .Flexible-container object,  
                                .Flexible-container embed {
                                    position: absolute;
                                    top: 0;
                                    left: 0;
                                    width: 100%;
                                    height: 100%;
                                }
                            </style>
                            <div class="Flexible-container">
                                <iframe
                                  width="600"   height="500"  frameborder="5" style="border:0"  maptype="satellite"
                                  src="https://www.google.com/maps/embed/v1/place?key=AIzaSyDR2WyVnnd9GsSTKys5OEkowPu41kMpEUs
                                    &q=Chile + Chillan + <?php echo $key['direccion'];?>" allowfullscreen>
                                </iframe>
                                <br>
                            </div>
                        </div>
                        <div class="span6">
                            <div class="project-description">
                                <div class="project-title clearfix">
                                    <h3> <?php echo $nombre ?></h3>
                                    <span class="show_hide close">
                                        <i class="icon-cancel"></i> 
                                    </span>

                                </div>



                                <div class="project-info">
                                <table width='100%'>
                                        <tr>
                                        <td width='50%'>
                                        <span>Implementos</span>
                                        </td>
                                        <td width='50%'>
                                        <button type="button" class="btn btn-primary btn-xs" href="javascript:void(0);" data-toggle="modal" data-target="#modal"  onclick="carga_ajax('modal','implementos','<?php echo $idRecinto ?>');">Ver <i class="fa fa-eye"></i> </button>
                                        </td>
                                        </tr>
                                        <tr>
                                        <td>
                                        <span>Telefono</span> 
                                        </td>
                                        <td>
                                        <?php echo $key['telefono'];?>
                                        </td>
                                        </tr>
                                        <tr>
                                        <td>
                                        <span>Direccion</span>
                                        </td>
                                        <td>
                                        <?php echo $key['direccion'];?>
                                        </td>
                                        </tr>                                  
                                    <!-- Aqui debe ir un boton para ver los horarios (Modal) -->
                                        <tr>
                                            <td><span>Horario y precios</span></td>
                                            <td><button type="button" class="btn btn-primary btn-xs" href="javascript:void(0);" data-toggle="modal" data-target="#modal" id="botonHorario" onclick="carga_ajax('modal','horarios', '<?php echo $idRecinto ?>');">Ver <i class="fa fa-eye"></i> </button></td>
                                        </tr>
                                        <tr>
                                            <td><span>Superficie</span></td>
                                            <td><?php echo $key['superficie'];?></td>
                                        </tr>
                                    
                                </table>
                                    <div>
                                        <span>Puntuación</span><?php 
                                        //Si la puntuacion del recinto es 0 significa que no ha recibido puntuaciones por lo tanto debemos mostrar un mensaje, y si es distnto de 0 se muestra la puntuacion
                                        if($key['puntuacion']== 0 ){
                                            echo "Este recinto no tiene puntuaciones";
                                        }else{

                                       
                                        echo " ".round($key['puntuacion'],1);


                                
                                    }?>
                              
                                    <br/>
                                    <?php
                                     //Con este if se comprueba que el jusgador tenga un estado activo y no haya comentado en este recinto
                                        if(isset($_SESSION['login_user_estado'])){
        
                                        	$contadorPuntuacion=0;
                                        	$contadorPartido = 0;

                                        	foreach ($vars['partidos'] as $partido) {
                                        		if($partido['idRecinto'] == $idRecinto){
                                        			$contadorPartido++;
                                        		}
                                        	}
                                        	foreach ($vars['puntuaciones'] as $puntuacion) {

                                        		if($puntuacion['idRecinto'] == $idRecinto){
                                        			$contadorPuntuacion++;
                                        			$puntuacionUsuario = $puntuacion['valoracion'];
                                        		}
                                        	}

                                        		//Si el contador es 0 significa que no ha puntuado el recinto
                                                if($_SESSION['login_user_estado']==1 && $contadorPuntuacion == 0){?>

                                    
                                  <?php 
                                  //Si ha jugado un partido en el recinto deportivo
                                  if($contadorPartido == 1){ ?>
                                     <form method="post" action="?controlador=Puntuacion&accion=setPuntuacion" >
                                    <input  class ="with-gap" name="valoracion" type="radio" id="estrella1" value="1" />
                                    <label for="estrella1">1</label>
                                    <input class ="with-gap" name="valoracion" type="radio" id="estrella2" value="2"/>
                                    <label for="estrella2">2</label>
                                    <input class ="with-gap" name="valoracion" type="radio" id="estrella3" value="3" />
                                    <label for="estrella3">3</label>
                                    <input class ="with-gap" name="valoracion" type="radio" id="estrella4"  value="4"/>
                                    <label for="estrella4">4</label>
                                    <input class ="with-gap" name="valoracion" type="radio" id="estrella5" value="5" />
                                    <label for="estrella5">5</label>
                                    <input type="hidden" name="idUsuario" value="<?php  echo $_SESSION['login_user_id'] ?>" />
                                    <input type="hidden" name="idRecinto" value="<?php echo $key['idRecinto'] ?>" />
                                    <button class= "btn btn-success" type="submit" name="action">Puntuar</button>
                                    <?php } else {?>   

                               
                                        <?php }?>
                                </form>

                             <?php }else{
                             		//Si ha jugado se guar
                    				//$puntuacionUsuario= $jefePuntuacion->valoracionUsuario($_SESSION['idUsuario'],$key->getIdRecinto());
                             		//
                                            ?>

                            <form method="post" action="" >
                                    <input  class ="with-gap" name="puntuacion" type="radio" id="estrella1"  value="1" <?php if($puntuacionUsuario==1){ echo "checked"; }else{ echo "disabled";}?>/>
                                    <label for="estrella1">1</label>
                                    <input class ="with-gap" name="puntuacion" type="radio" id="estrella2" value="2" <?php if($puntuacionUsuario==2){ echo "checked"; }else{ echo "disabled";}?>/>
                                    <label for="estrella2">2</label>
                                    <input class ="with-gap" name="puntuacion" type="radio" id="estrella3" value="3" <?php if($puntuacionUsuario==3){ echo "checked"; }else{ echo "disabled";}?>/>
                                    <label for="estrella3">3</label>
                                    <input class ="with-gap" name="puntuacion" type="radio" id="estrella4"  value="4" <?php if($puntuacionUsuario==4){ echo "checked"; }else{ echo "disabled";}?>/>
                                    <label for="estrella4">4</label>
                                    <input class ="with-gap" name="puntuacion" type="radio" id="estrella5" value="5" <?php if($puntuacionUsuario==5){ echo "checked"; }else{ echo "disabled";}?>/>
                                    <label for="estrella5">5</label>

                                    
                                    : Ya puntuaste este recinto. 
                                </form>
                                     <?php  }


                                    } ?>
                                    </div>
                                    
                                    <br/>
                                    <!-- hasta aqui deberia quedar una tabla para abarcar lo de arriba -->
                                    <?php 
                                    $_SESSION["idRecinto"]=$idRecinto;
                                    if($jugar==1){ ?>
                                    <center>
                                        <button class="btn btn-primary btn-lg" href="#" data-toggle="modal" data-target="#modalTipoPartido" >
                                            Jugar Aqui
                                        </button> 
                                    </center>
                                    <?php  } ?>
                       
                                </div>

                                <p></p> <!--puede ir algo mas escrito aqui -->
                            </div>

                        </div>
                        <br/>

                        <!--        COMENTARIOS  -->
                        <div class="col-md-12">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    ¿Qué dicen los demás acerca de <?php echo $nombre?>?
                                </div>
                            </div>
                            <!--Comprobar si se puede comentar o no -->
                            <?php 
                            if(isset($_SESSION['login_user_estado'])){
                            if($_SESSION['login_user_estado']==1 ){


                            if($contadorPartido == 1){ 
                                ?>

                            <div class="panel-body comments">
                                <form method="post" action="?controlador=Comentario&accion=setComentario">
                                    <input id="comentario" class="form-control comentario" onkeyup="clean('comentario');" onkeydown="clean('comentario');" name="contenido" placeholder="Escribe tu comentario" rows="2" required id="texto-input-white"></input>
                                    <input type="hidden" name="idUsuario" value="<?php echo $_SESSION['login_user_id']  ?>">
                                    <input type="hidden" name="idRecinto" value="<?php echo $idRecinto ?>">
                                    <br>
                                    <!--<a class="small pull-left" href="#">Entra y comenta</a>-->
                                    <button type="button submit" class="btn btn-info pull-right" name="action" >Comentar</button>
                                </form>
                            </div>
                            <?php 
                            }else{?>
                         
                                
                                <div class="alert alert-danger alert-dismissible fade in" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <strong>Aviso</strong> Juega en este recinto para comentar y puntuar
                                </div>
                                <br>

                           <?php }
                            }else{ //fin if estado 
                                if($_SESSION['login_user_estado']==2){ ?>

                                <div class="alert alert-error alert-dismissible fade in" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                   <strong>Aviso</strong> No puedes comentar, tu perfil se encuentra con restricciones.
                                </div>
                                <br>

                                <?php }
                               

                                if($jugar==0 && !(isset($_SESSION['login_user_id']))){ ?>
                                
                                <div class="alert alert-danger alert-dismissible fade in" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <strong>Aviso</strong> Inicia sesión para comentar
                                </div>
                                <br>
                                <?php 
                                }
                                //Si el jugador no ha jugado en el recinto deportivo
                              if( $contadorPartido != 1){ ?>
                                
                                <div class="alert alert-danger alert-dismissible fade in" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <strong>Aviso</strong> Juega en este recinto para comentar y puntuar
                                </div>
                                <br>
                                <?php 
                                }
                            }
                             
                            }
                            ?>
                            <br/>
                            <ul class="media-list">
                        <li class="media">
                            <?php 
                            //Traemos los comentarios
                            $contComentario = 0; 

                            if($vars['comentarios'] != NULL){
                            foreach($vars['comentarios'] as $comentario){

                                

                                if ($comentario['idRecinto']==$_SESSION["idRecinto"]) {
                                    $contComentario++;
                                ?>
                                    <div class="comment">
                                        <div class="col-sm-2">
                                            <div class="profile-userpic">
                                            <img src="assets/images/usuarios/<?php echo $comentario['fotografia']; ?>" alt="" class="img-circle img-responsive" >
                                            </div>
                                        </div>
                                        <div class="col-sm-10">
                                            <div class="media-body">
                                             <strong class="text-success"><?php echo $comentario['nombre']." ".$comentario['apellido'];?></strong> 
                                                <span class="text-muted">
                                                    <small class="text-muted"><?php echo $comentario['fecha'] ?></small>
                                                </span>
                                                <p >
                                                    <?php echo $comentario['contenido'] ?>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <hr/>

                                <?php 
                                } 

                            }//FIN FOREACH COMENTARIOS

                            if ($contComentario==0){
                                echo "Este recinto no tiene comentarios.";
                            }


                            } 
                            ?> 
                        </li>
                    </ul>
                        </div>
                        



                    </div> <!-- Fin Sliding Div-->

                    <?php 
                    $cont++;
                    }
                }  // fin if filtro dentro de foreach
            } // fin foreach recintos
            ?>




            <ul id="portfolio-grid" class="thumbnails row">
                <?php
                $cont = 0;
                foreach ($vars['recintos'] as $key) {   // foreach recintos
                    if($key['estado'] == 1){
                    $nombre = $key['nombre'];
                    $pos = strripos($nombre, $search);
                    $tipo = $key['tipo'];
                    $pos2 = strripos($tipo, $search);
                    $superficie = $key['superficie'];
                    $pos3 = strripos($superficie, $search);
                    $idRecinto = $key['idRecinto'];
                    if ($pos !== false  ||   $pos2!==false  || $pos3!==false )  {  // if filtro dentro de foreach recintos            
                    ?>
                <li class="span4 mix web">
                <div class="thumbnail">
                    <img src="assets/images/recintos/<?php echo $key['fotografia'];?>" height='640' width='400' alt="project 1">
                    <a href="#single-project" class="more show_hide" rel="#slidingDiv<?php echo $cont?>">
                        <i class="icon-plus"></i>
                    </a>
                    <h3> <?php echo "$nombre" ?> </h3>
                    <p>Cancha de <?php echo $key['tipo']; ?></p>
                    <div class="mask"></div>
                </div>
                </li>
                <?php 
                    $cont++;
                }
                    }
                }
                ?>
            </ul>



            
        </div>
    </div>
</div>
<style type="text/css">
	.modal { overflow: auto !important; }
</style>
        <!-- MODALES-->
 <!-- MODAL HORARIOS-->

<!--MODAL IMPLEMENTOS-->
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Ventana normal</h4>
      </div>
      <div class="modal-body">
        <h1>Texto #manosenelcódigo</h1>
      </div>
      <div class="modal-footer">
            <h4>pie de página</h4>
      </div>
    </div>
  </div>
</div>
<!--Modal-->
 <!-- MODAL IMPLEMENTOS-->
   

        <!--MODAL Tipo de partido-->
<div class="container">
    <div class="modal fade" id="modalTipoPartido">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title">Elige el tipo de partido</h3>
                </div>
                <div class="modal-body">
                <h5 class="texto-modal-negro">Selecciona el tipo de partido que quieres organizar.
          </h5>     
                                        
                                        <br/>
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <button type="button" class="btn btn-primary center-block" data-dismiss="modal" data-toggle="modal" data-target="#modalRevuelta">Revuelta</button>
                                                </div>
                                                <div class="col-md-4">
                                                    <button type="button" class="btn btn-primary center-block" data-dismiss="modal" data-toggle="modal" data-target="#modalEquipoPropio">Equipo Propio</button>
                                                </div>
                                                <div class="col-md-4">
                                                    <button type="button" class="btn btn-primary center-block" data-dismiss="modal" data-toggle="modal" data-target="#modalAB" >A v/s B</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar <i class="fa fa-times" aria-hidden="true"></i></button>
                                    </div> 
                </div>
            </div>
        </div>
    </div>
<!--MODAL Equipo Propio-->       
<div class="container">
    <div class="modal fade" id="modalEquipoPropio">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title">Define la hora, fecha y cantidad de jugadores</h3>
                </div>
                <div class="modal-body">
                    <form  method="post" action="?controlador=Partido&accion=partidoEquipoPropio" class="design-form" >
                        <div class="container">  
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label class="label-partido" for="fecha">Fecha del partido</label>

                                        <input type="date" name="fecha" placeholder="Fecha del partido" class="form-control" id="equipo" required="required" >

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label class="label-partido" for="hora">Hora</label>
                                        <input type="time" name="hora" placeholder="Hora" class="form-control partido" id="equipo" required="required" min="09:00:00" max="23:00:00">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label class="label-partido" for="jugadores">Numero de jugadores</label>
                                        <input type="number" name="cantidad"  class="form-control partido" id="equipo" required="required" title="Solo puede ingresar hasta 22 jugadores" placeholder="Ingresa número de jugadores..." pattern="^[0|1]\d{1}$|[0-9]|2+[0|1|2]" min="2">
                                        <input  name="idRecinto" class="hide" value="<?php echo $_SESSION['idRecinto'];?>"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label class="label-partido" for="color">Color</label>
                                        <input type="text" name="color"  class="form-control partido" id="equipo" required="required" placeholder="Ingresa color de vestimenta...">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal" data-toggle="modal" data-target="#modalTipoPartido">Cancelar <i class="fa fa-times" aria-hidden="true"></i></button>
                                <button type="submit" class="btn btn-primary">Aceptar <i class="fa fa-check" aria-hidden="true"></i></button>
                            </div>
                            </div>
                            </div>
                        </div>
                    </form>   
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL Revuelta-->
<div class="container">
    <div class="modal fade" id="modalRevuelta">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title">Define la hora, fecha y cantidad de jugadores</h3>
                </div>
                <div class="modal-body">
                    <form  method="post" action="?controlador=Partido&accion=partidoRevuelta" class="design-form" >
                        <div class="container">  
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label class="label-partido" for="fecha">Fecha del partido</label>
                                        <input type="date" name="fecha" placeholder="Fecha del partido" class="form-control" id="equipo" required="required" >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label class="label-partido" for="hora">Hora</label>
                                        <input type="time" name="hora" placeholder="Hora" class="form-control partido" id="equipo" required="required" min="09:00:00" max="23:00:00">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label class="label-partido" for="jugadores">Numero de jugadores</label>
                                        <input type="int" name="cantidad"  class="form-control partido" id="equipo" required="required" title="Solo puede ingresar hasta 22 jugadores" placeholder="Ingresa número de jugadores totales..." pattern="^[0|1]\d{1}$|[0-9]|2+[0|1|2]">
                                        <input  name="idRecinto" class="hide" value="<?php echo $_SESSION['idRecinto'];?>"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label class="label-partido" for="color">Color 1</label>
                                        <input type="text" name="color"  class="form-control partido" id="equipo" required="required" placeholder="Ingresa color de vestimenta equipo A...">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label class="label-partido" for="color2">Color 2</label>
                                        <input type="text" name="color2"  class="form-control partido" id="equipo" required="required" placeholder="Ingresa color de vestimenta equipo B...">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal" data-toggle="modal" data-target="#modalTipoPartido">Cancelar <i class="fa fa-times" aria-hidden="true"></i></button>
                                <button type="submit" class="btn btn-primary">Aceptar <i class="fa fa-check" aria-hidden="true"></i></button>
                            </div>
                            </div>
                            </div>
                        </div>
                    </form>   
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL A VS B-->
<div class="container">
    <div class="modal fade" id="modalAB">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title">Define la hora, fecha y cantidad de jugadores</h3>
                </div>
                <div class="modal-body">
                    <form  method="post" action="?controlador=Partido&accion=partidoAB" class="design-form" >
                        <div class="container">  
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label class="label-partido" for="fecha">Fecha del partido</label>
                                        <input type="date" name="fecha" placeholder="Fecha del partido" class="form-control" id="equipo" required="required" >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label class="label-partido" for="hora">Hora</label>
                                        <input type="time" name="hora" placeholder="Hora" class="form-control partido" id="equipo" required="required" min="09:00:00" max="23:00:00">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label class="label-partido" for="jugadores">Numero de jugadores</label>
                                        <input type="int" name="cantidad"  class="form-control partido" id="equipo" required="required" title="Solo puede ingresar hasta 22 jugadores" placeholder="Ingresa número de jugadores totales..." pattern="^[0|1]\d{1}$|[0-9]|2+[0|1|2]">
                                        <input  name="idRecinto" class="hide" value="<?php echo $_SESSION['idRecinto'];?>"/>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label class="label-partido" for="color">Color Equipo A</label>
                                        <input type="text" name="color"  class="form-control partido" id="equipo" required="required" placeholder="Ingresa color de vestimenta equipo A...">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label class="label-partido" for="color2">Color Equipo B</label>
                                        <input type="text" name="color2"  class="form-control partido" id="equipo" required="required" placeholder="Ingresa color de vestimenta equipo B...">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal" data-toggle="modal" data-target="#modalTipoPartido">Cancelar <i class="fa fa-times" aria-hidden="true"></i></button>
                                <button type="submit" class="btn btn-primary">Aceptar <i class="fa fa-check" aria-hidden="true"></i></button>
                            </div>
                            </div>
                            </div>
                        </div>
                    </form>   
                </div>
            </div>
        </div>
    </div>
</div>

<footer id="footer">
    <div class="footer-top wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="300ms">
      <div class="container text-center">
        <div class="footer-logo">
          <a href="index.html"><img class="img-responsive" src="assets/images/logo.png" alt=""></a>
        </div>
        <div class="social-icons">
          <ul>
            <li><a class="envelope" href="#"><i class="fa fa-envelope"></i></a></li>
            <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li> 
            <li><a class="dribbble" href="#"><i class="fa fa-dribbble"></i></a></li>
            <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
            <li><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
            <li><a class="tumblr" href="#"><i class="fa fa-tumblr-square"></i></a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="footer-bottom">
      <div class="container">
        <div class="row">
          <div class="col-sm-6">
            <p>&copy; 2016 Oxygen Theme.</p>
          </div>
          <div class="col-sm-6">
            <p class="pull-right">Crafted by <a href="http://designscrazed.org/">Allie</a></p>
          </div>
        </div>
      </div>
    </div>
  </footer>  




        <!-- ScrollUp button end -->
        <!-- Include javascript -->
        <script type="text/javascript" src="assets/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="assets/js/dataTables.bootstrap.min.js"></script>

        <script src="assets/js/jquery.js"></script>
        <script type="text/javascript" src="assets/js/jquery.mixitup.js"></script>
        <script type="text/javascript" src="assets/js/bootstrap.js"></script>
        <script type="text/javascript" src="assets/js/modernizr.custom.js"></script>
        <script type="text/javascript" src="assets/js/jquery.bxslider.js"></script>
        <script type="text/javascript" src="assets/js/jquery.cslider.js"></script>
        <script type="text/javascript" src="assets/js/jquery.placeholder.js"></script>
        <script type="text/javascript" src="assets/js/jquery.inview.js"></script>

        <!-- css3-mediaqueries.js for IE8 or older -->
        <!--[if lt IE 9]>
            <script src="js/respond.min.js"></script>
        <![endif]-->
        <script type="text/javascript" src="assets/js/app.js"></script>

        <!--Puntuacion -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="assets/js/star-rating.js" type="text/javascript"></script>


        <script src="http://maps.googleapis.com/maps/api/js"></script>
        <script>
        function initialize() {
          var mapProp = {
            center:new google.maps.LatLng(-36.602459, -72.077014),
            zoom:14,
            mapTypeId:google.maps.MapTypeId.ROADMAP
          };
          var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
        }


        google.maps.event.addDomListener(window, 'load', initialize);
        google.maps.event.addDomListener(
            window,
            'load',
            function () {
                 //1000 milliseconds == 1 second,
                 //play with this til find a happy minimum delay amount
                window.setTimeout(initialize, 1000);
            }
        );
        </script>
        <script type="text/javascript">
            $(function () {
                $(".demo1").bootstrapNews({
                    newsPerPage: 1,
                    autoplay: true,
                    pauseOnHover:true,
                    direction: 'up',
                    newsTickerInterval: 4000,
                    onToDo: function () {
                    
                    }
                });
            });

        </script>

        <script>
            /*
            $('#modalImplementos').on('show.bs.modal', function(){
                alert("Hola");
                //$('#modalImplementos').load('?controlador=Recinto&accion=implementosRecinto');
                $('#modalImplementos').load('?controlador=Recinto&accion=implementosRecinto');
                 
            })
            */
            function carga_ajax(div, tipo, id){
                if(tipo == 'implementos'){
                     $.post(
                    '?controlador=Recinto&accion=implementosRecinto&id='+id,
                    function(resp){
                        $("#"+div+"").html(resp);
                    }
                    ); 
                }
                if(tipo == 'horarios'){
                    $.post(
                        '?controlador=Recinto&accion=horariosRecinto&id='+id,
                        function(resp){
                            $("#"+div+"").html(resp);
                        }
                    ); 
                }

            }

            
        </script>
        <script type="text/javascript">
        function clean(e){
        var textfield = document.getElementById(e);
        var groserias = ["puta", "puto","marica","mierda","wn","weon","hueon","huevon","ctm", "conchetumadre", "conchatumadre", "conchesumadre","conshasumadre","concha","pico","raja","culo","culia","culiao","qlo","qla","chucha","shusha","ahueonado","ahueonao","maraca","aweonao","huevon","malparidos","maricon","mrd","xuxa"]
        //var regex ="["mierda"]"/gi;
        for(var i=0; i<groserias.length; i++){
        var regex= new RegExp("(^|\\s)"+groserias[i]+"($|(?=\\s))","gi")
        textfield.value = textfield.value.replace(regex, function($0, $1){return $1 + ""});
                                            }   
        }
        </script>                                  

    </body>
</html>



