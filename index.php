<?php

session_start();                // iniciando o uso de sessão

require_once 'config/config.php';
require_once 'url.php';

// carregando a página

require_once $pasta . '/comuns/cabecalho.php';

require_once $pasta . '/' . $control . '.php';

require_once $pasta . '/comuns/rodape.php';
       