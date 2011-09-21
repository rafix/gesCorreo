<?php
require_once dirname(__FILE__).'/../bootstrap/unit.php';

$t = new lime_test(8, new lime_output_color());

$t->is(GesCorreo::slugify('Vicerrectoría'), 'vicerrectoria');
$t->is(GesCorreo::slugify('departamento de humanidades'), 'departamento-de-humanidades');
$t->is(GesCorreo::slugify('departamento de    humanidades'), 'departamento-de-humanidades');
$t->is(GesCorreo::slugify('dpto. tele'), 'dpto-tele');
$t->is(GesCorreo::slugify('  info'), 'info');
$t->is(GesCorreo::slugify('info  '), 'info');
$t->is(GesCorreo::slugify(''), 'n-a');
$t->is(GesCorreo::slugify(' - '), 'n-a');



?>
