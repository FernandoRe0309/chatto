<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('registro', 'AuthController::registro');
$routes->post('guardar-registro', 'AuthController::guardarRegistro');

$routes->get('login', 'AuthController::login');
$routes->post('validar-login', 'AuthController::validarLogin');

$routes->get('logout', 'AuthController::logout');
$routes->get('usuarios', 'UsuariosController::index');

$routes->get('chat/(:num)', 'ChatController::chat/$1');
$routes->post('enviar', 'ChatController::enviar');

$routes->get('/forgot', 'AuthController::forgotForm');
$routes->post('/forgot', 'AuthController::sendReset');

$routes->get('/reset/(:any)', 'AuthController::resetForm/$1');
$routes->post('/reset', 'AuthController::resetPassword');

$routes->get('/ia', 'IAController::index');
$routes->post('/ia/chat', 'IAController::chat');

$routes->get('/mensajes/(:num)', 'ChatController::obtenerMensajes/$1');

$routes->post('api/login',     'AuthController::apiLogin');
$routes->post('api/registro',  'AuthController::apiRegistro');
$routes->post('api/recuperar', 'AuthController::apiRecuperar');
$routes->get('api/usuarios',      'ChatController::apiUsuarios');
$routes->post('api/conversacion', 'ChatController::apiConversacion');
$routes->get('api/mensajes',      'ChatController::apiMensajes');
$routes->post('api/enviar',       'ChatController::apiEnviar');

$routes->get('grupos', 'GrupoController::index');
$routes->get('grupos/crear', 'GrupoController::crear');
$routes->post('grupos/guardar', 'GrupoController::guardar');

$routes->get('grupo_chat/(:num)', 'GrupoController::chat/$1');
$routes->post('grupo/enviar', 'GrupoController::enviarMensaje');

$routes->get('perfil', 'AuthController::perfil');

$routes->post('webauthn/register-challenge', 'WebAuthnController::registerChallenge');
$routes->post('webauthn/register-verify',    'WebAuthnController::registerVerify');
$routes->post('webauthn/auth-challenge',     'WebAuthnController::authChallenge');
$routes->post('webauthn/auth-verify',        'WebAuthnController::authVerify');
$routes->post('webauthn/eliminar',           'WebAuthnController::eliminar');
$routes->get('webauthn/estado',              'WebAuthnController::estado');
