<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <title>gesCorreo Interfaz de Administracion</title>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php use_stylesheet('admin.css') ?>
    <?php include_javascripts() ?>
    <?php include_stylesheets() ?>
  </head>
  <body>
    <div id="container">
      <div id="header">
        <h1>
          <a href="<?php echo url_for('@homepage') ?>">
            <img src="/images/logo.jpg" alt="gesCorreo" />
          </a>
        </h1>
      </div>

    <?php if ($sf_user->isAuthenticated()): ?>
      <div id="menu">
        <ul>
          <li><?php echo link_to('Areas', '@gc_area') ?></li>
          <li><?php echo link_to('Dominios', '@gc_transport') ?></li>
          <li><?php echo link_to('Grupos', '@gc_group') ?></li>
          <li><?php echo link_to('Buzones', '@gc_mailbox') ?></li>
          <li><?php echo link_to('Filtros', '@gc_filtro_sender') ?></li>|
          <li><?php echo link_to('Roles', '@sf_guard_group') ?></li>
          <li><?php echo link_to('Permisos', '@sf_guard_permission') ?></li>
          <li><?php echo link_to('Usuarios', '@sf_guard_user') ?> |</li>
          <li><?php echo link_to('Salir', '@sf_guard_signout') ?></li>
        </ul>
      </div>
     <?php endif; ?>
     
      <div id="content">
        <?php echo $sf_content ?>
      </div>

      <div id="footer">
        <h4>Sistema de Gestión de Correo</h4>
      </div>
    </div>
  </body>
</html>

