<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <title>
        <?php if (!include_slot('title')): ?>
          gesCorreo - Buscador de usuarios
        <?php endif; ?>
    </title>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php use_javascript('jquery-1.4.1.min.js') ?>
    <?php use_javascript('search.js') ?>
    <?php include_javascripts() ?>
    <?php include_stylesheets() ?>
  </head>
  <body>
    <div id="container">
      <div id="header">
        <div class="content">
          <h1><a href="<?php echo url_for('@homepage') ?>">
            <img src="/images/logo.gif" alt="gesCorreo" />
          </a></h1>

          <div id="sub_header">
            <div class="post">
              
            </div>

		<div class="search">
                    <h2>Buscar Usuario</h2>
                          <form action="<?php echo url_for('@gc_mailbox_search') ?>" method="get">
                            <input type="text" name="query" value="<?php echo $sf_request->getParameter('query') ?>" id="search_keywords" />
                            <input type="submit" value="search" />
                            <img id="loader" src="/images/loader.gif" style="vertical-align: middle; display: none" />
                        <div class="help">
                            Introduce palabras claves (nombre, usuario, area, email, dominio...)
                        </div>
</form>
		</div>
          </div>
        </div>
      </div>

      <div id="content">
        <?php if ($sf_user->hasFlash('notice')): ?>
          <div class="flash_notice"><?php echo $sf_user->getFlash('notice') ?></div>
        <?php endif; ?>

        <?php if ($sf_user->hasFlash('error')): ?>
          <div class="flash_notice"><?php echo $sf_user->getFlash('error') ?></div>
        <?php endif; ?>



        <div class="content">
          <?php echo $sf_content ?>
        </div>
      </div>

      <div id="footer">
        <div class="content">
          <span class="symfony">
            
            powered by <a href="http://upredes.upr.edu.cu/">
            <img src="/images/upredes-mini.png" alt="UPRedes" /></a>
          
        </div>
      </div>
    </div>
  </body>
</html>
