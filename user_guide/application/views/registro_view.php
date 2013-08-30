
<?php 
echo form_open('login/registro','class="form-horizontal"'); 

echo form_fieldset('Nuevo registro');
?>
  <div class="control-group">
    <label class="control-label" for="inputNombre">Nombre:</label>
    <div class="controls">
        <input type="text" id="inputNombre" name="nombre" value="<?php echo set_value('nombre'); ?>">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputApellidos">Apellidos:</label>
    <div class="controls">
        <input type="text" id="inputApellidos" name="apellidos" value="<?php echo set_value('apellidos'); ?>">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputFechaNac">Fecha de nacimiento:</label>
    <div class="controls">
        <input type="text" id="inputFechaNac" name="fecha_nac" value="<?php echo set_value('fecha_nac'); ?>" class="datepicker">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" >Genero:</label>
    <div class="controls">
      <label class="radio">
        <input type="radio" name="genero" id="masculino" value="M">
        Masculino
      </label>
      <label class="radio">
        <input type="radio" name="genero" id="femenino" value="F">
        Femenino
      </label>
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputEmail">Email</label>
    <div class="controls">
        <input type="text" id="inputEmail" <?php echo set_value('email'); ?> name="email">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputPassword">Password</label>
    <div class="controls">
        <input type="password" id="inputPassword" placeholder="Password" name="password">
    </div>
  </div>
  <div class="control-group">
    <div class="controls">
      <button type="submit" class="btn">Registrar</button>
    </div>
  </div>

<?php 
echo form_fieldset_close();
echo form_close(); 
?>

<script>
$('.datepicker').datepicker({
    format:'dd/mm/yyyy'
})
</script>