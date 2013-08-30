<?php echo form_open('login/acceso','class="navbar-form pull-right"'); ?>
<input name="email" class="span2" type="text" placeholder="Email" value="<?php echo set_value('email'); ?>">
<input name="password" class="span2" type="password" placeholder="Password" value="">
    <button type="submit" class="btn">Entrar</button>
    <?php echo anchor('login/registro','Registrate','class="btn btn-info"')?>
</form>
