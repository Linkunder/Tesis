
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

      <?php 

      $idDesafio = $_POST["id"];


      ?>
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Detalle del desafío <?php echo $idDesafio?> - AJAX</h4>
      </div>



      <div class="modal-body">
        <h5 class="texto-modal-negro">Los es de MatchDay están viendo tu desafío.</h5>

       <h5 class="texto-modal-negro"><?php echo $nombre?></h5>



      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Volver <i class="fa fa-arrow-circle-left" aria-hidden="true"></i></button>
        <!--button type="submit" class="btn btn-primary">Desafiar <i class="fa fa-check" aria-hidden="true"></i></button-->
      </div>



    </div>
  </div>