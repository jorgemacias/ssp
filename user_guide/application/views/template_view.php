<?php 
    $this->load->view('header_view');
?>
  <body>

      <?php 
        $this->load->view('top_menu_view');
      ?>
      
    <div class="container">
    <div id="mensaje" >
      <?php if(validation_errors()!=FALSE){ ?>
        <div class="alert alert-block alert-error fade in">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <p><?php echo validation_errors() ?></p>
        </div>
      <?php  } ?>
      <?php if(isset($mensaje)){ ?>
        <div class="alert alert-block alert-<?php echo $tipo_mensaje?> fade in">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <p><?php echo $mensaje ?></p>
        </div>
      <?php  } ?>
    </div>
    <div class="row-fluid">
    <div class="span12">
    <?php
    if($this->session->userdata('logueado')==FALSE){
        if(isset($vista)){
            $this->load->view($vista);
        }else{
            $this->load->view('pantalla_inicio_view');
        }
        
    }else{
        if(isset($vista)){
            $this->load->view($vista);
        }else{
            $this->load->view('panel_view');
        }
    }
    ?>
    </div>
      <hr>

      <footer>
        <?php $this->load->view('footer_view'); ?>
      </footer>

    </div> <!-- /container -->
    </div>
  </body>
</html>
