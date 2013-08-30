    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <?php echo anchor(base_url(),'SSP','class="brand"'); ?>
          <div class="nav-collapse collapse">
            <ul class="nav">
                <li class="active"><?php echo anchor(base_url(),'Inicio') ?></li>
              <li><a href="#about">&iquest;Quienes Somos?</a></li>
              <li><a href="#contact">Contactanos</a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Nuestros Servicios<b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="#">Asesoria medica</a></li>
                  <li><a href="#">Programas de nutrición</a></li>
                  <li><a href="#">Programas de ejercicio</a></li>
                  <li class="divider"></li>
                  <li class="nav-header">Laboratorios</li>
                  <li><a href="#">Consulta nuestras ubicaciones</a></li>
                  <li><a href="#">Solicitar estudio de laboratorio</a></li>
                </ul>
              </li>
            </ul>
              <?php
              if($this->session->userdata('logueado')==FALSE){
                  $this->load->view('login_view');
              }else{
                  $this->load->view('menu_sesion_view');
              }
              ?>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
