<?php

    /*
     * a variavel atual recebe o que estiver na variável
     * pag, caso não tenha nada a variavel atual recebe
     * login
     */

    $atual = (isset($_GET['pag']) ? $_GET['pag'] : 'home' );
    $pasta = 'site';
    
    /*
     * verifica se a a variavel pag possui alguma /
     * caso possua significa que tem parametros
     */
    
    if (substr_count($atual, "/") > 0 ){
        $atual      = explode( "/" , $atual );
        $control    = ( file_exists("{$pasta}/".$atual[0].".php" ) ? $atual[0] : "erro" );
        $acao       = $atual[ 1 ];
        $id         = ( isset( $atual[ 2 ] ) ? $atual[ 2 ] : 0 );
    } else {
        $control    = ( file_exists("{$pasta}/".$atual.".php" ) ? $atual : "erro" );
        $acao       = "";
        $id         = 0;
    }