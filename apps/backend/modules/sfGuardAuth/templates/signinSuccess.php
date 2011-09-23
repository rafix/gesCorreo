<?php if ($form->hasErrors()): ?>
	    <div class="flash_error">
	        <strong>Error</strong>: El nombre de usuario o contraseña no son válidos.
	    </div>
	<?php endif; ?>

	<div id="login">
	        <form action="<?php echo url_for('@sf_guard_signin') ?>" method="post">
                <h1>gesCorreo</h1>
	            <fieldset id="inputs">
	            <?php echo $form['username']->render(array('id' => 'username', 'placehorder' => 'Username',)) ?>

	            <?php echo $form['password']->render(array('id' => 'password', 'placehorder' => 'Password',)) ?>
                </fieldset>
                <fieldset id="actions">
	            
	            <input type="submit" id="submit" value="Entrar">
                <!--<a href="<?php echo url_for('@sf_guard_password'); ?>"><?php echo ('¿Problemas para acceder a su cuenta?') ?></a>-->
                
	            <?php //echo $form['_csrf_token'] ?>
                </fieldset>
                

	    </form>



	</div>
