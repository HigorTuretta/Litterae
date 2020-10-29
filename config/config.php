<?php

    require_once 'lib/Database.php';

    // Constante com endereço base do site

    define( "SITE_URL" , "http://litterae/" );
        
    // Define constantes com configurações para 
    // conecta a base de dos 
    
    define( "DB_TYPE"       , "mysql" );
    define( "DB_HOST"       , "localhost" );
    define( "DB_PORT"       , "3308" );
    define( "DB_USER"       , "root" );
    define( "DB_PASSWORD"   , "" );
    define( "DB_BDADOS"     , "litterae" );
    
    /* realiza a conexão com a base de dados */
    
    $conDb = new Database(
                            DB_TYPE,
                            DB_HOST,
                            DB_PORT,
                            DB_USER,
                            DB_PASSWORD,
                            DB_BDADOS
                        );