<?php


class modelPortifolio 
{
        
    
    /*
     * Buscar publicacao usuário pelo campo codPublicacao
     */
    function buscaCategoria($conDb){
        $modelRsc = $conDb->db_select("SELECT * FROM categoria WHERE StatusCategoria = 'A'");

        if ( $conDb->db_num_linhas($modelRsc) == 0  ) {
            return array();
        } else {
            return $conDb->db_busca_dados_all($modelRsc);
        }
    }

    function buscaRecentes($conDb){
        $modelRsc = $conDb->db_select("SELECT * FROM blog WHERE StatusPostagem = 'H' ORDER BY dataPostagem DESC LIMIT 6");

        if ( $conDb->db_num_linhas($modelRsc) == 0  ) {
            return array();
        } else {
            return $conDb->db_busca_dados_all($modelRsc);
        }
    }

    function buscaRecentesSlides($conDb){
        $modelRsc = $conDb->db_select("SELECT * FROM blog WHERE StatusPostagem = 'H' ORDER BY dataPostagem DESC LIMIT 3");

        if ( $conDb->db_num_linhas($modelRsc) == 0  ) {
            return array();
        } else {
            return $conDb->db_busca_dados_all($modelRsc);
        }
    }

    function buscaCategoriaPorCod($conDb, $codPostagem){
        $modelRsc = $conDb->db_select("SELECT * FROM categoria WHERE codPublicacao = ?", 
        array($codPostagem));

        if ( $conDb->db_num_linhas($modelRsc) == 0  ) {
            return array();
        } else {
            return $conDb->db_busca_dados_all($modelRsc);
        }
    }

    function buscaCodPostagem($conDb, $codPostagem)
    {
        
        $modelRsc = $conDb->db_select( "SELECT * FROM blog WHERE codPublicacao = ?", 
                                  array($codPostagem) );
        
        if ( $conDb->db_num_linhas($modelRsc) == 0  ) {
            return array();
        } else {
            $aRet = $conDb->db_busca_array_all($modelRsc);
            return $aRet[0];
        }
        
    }


    /*
     * Busca publicações cadastradas na base de dados
     */
    
    function lista($conDb) {
        
        $modelRsc = $conDb->db_select( "SELECT * FROM blog ORDER BY dataPostagem desc" );
        
        if ( $conDb->db_num_linhas($modelRsc) == 0  ) {
            return array();
        } else {
            return $conDb->db_busca_dados_all($modelRsc);
        }
        
    }

    function listaHabilitados($conDb) {
        
        $modelRsc = $conDb->db_select( "SELECT * FROM blog WHERE StatusPostagem = 'H' ORDER BY dataPostagem desc" );
        
        if ( $conDb->db_num_linhas($modelRsc) == 0  ) {
            return array();
        } else {
            return $conDb->db_busca_dados_all($modelRsc);
        }
        
    }

    /*
     * Retorna descrição do status
     */
        
    function mostraStatus($status) {
        
        return ($status == "H" ? "Habilitado" : "Desabilitado" );
        
    }
      
    
    /*
     * Insere uma nova categoria  na tabela categoria
     */
    
    function insert($conDb, $data) 
    {
        
        $rs = $conDb->db_insert( "INSERT INTO blog 
                                  ( CodCategoria, Titulo, SubTitulo, Descricao, ImgCapa, Img1 )
                                  VALUES ( ?, ?, ?, ?, ? ,?)",
                                 $data );
        
        if ($rs > 0) {
            return true;
        } else {
            return false;
        }
                
    }
    

    /*
     * Altera os dados de uma categoria no banco
     */
    
    function update($conDb, $data) 
    {
    
        $rs = $conDb->db_update( "UPDATE blog
                                  SET CodCategoria = ? , Titulo = ?, SubTitulo = ?, Descricao = ?, ImgCapa = ?, Img1 = ?
                                  WHERE codPublicacao = ? ",
                                $data );
        
        if ($rs > 0) {
            return true;
        } else {
            return false;
        }
        
    }    
    
    /*
     * Excluir uma categoria do banco
     */
    
    function delete($conDb, $codPublicacao) 
    {
    
        $rs = $conDb->db_delete( "DELETE FROM blog WHERE codPublicacao = ? " , array( $codPublicacao ) );
        
        if ($rs > 0) {
            return true;
        } else {
            return false;
        }
        
    }
        
    
}
