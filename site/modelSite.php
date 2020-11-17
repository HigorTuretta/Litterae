<?php


class modelSlides
{


    //busca slides por codigo
    function buscaCodSlides($conDb, $codSlide)
    {

        $modelRsc = $conDb->db_select(
            "SELECT * FROM slides WHERE codSlide = ? ORDER BY codSlide",
            array($codSlide)
        );

        if ($conDb->db_num_linhas($modelRsc) == 0) {
            return array();
        } else {
            $aRet = $conDb->db_busca_array_all($modelRsc);
            return $aRet[0];
        }
    }

    //busca slides por Status
    function buscaSlidesHabilitadosRecentes($conDb)
    {

        $modelRsc = $conDb->db_select(
            "SELECT * FROM slides WHERE StatusSlide = 'H' ORDER BY codSlide DESC"
        );

        if ($conDb->db_num_linhas($modelRsc) == 0) {
            return array();
        } else {
            return $conDb->db_busca_dados_all($modelRsc);
        }
    }


    /*
     * Busca publicações cadastradas na base de dados
     */

    function lista($conDb)
    {

        $modelRsc = $conDb->db_select("SELECT * FROM slides ORDER BY codSlide");

        if ($conDb->db_num_linhas($modelRsc) == 0) {
            return array();
        } else {
            return $conDb->db_busca_dados_all($modelRsc);
        }
    }
    /*
     * Retorna descrição do status
     */

    function mostraStatus($status)
    {

        return ($status == "H" ? "Habilitado" : "Desabilitado");
    }


    /*
     * Insere um novo Slide  na tabela slides
     */

    function insert($conDb, $data)
    {

        $rs = $conDb->db_insert(
            "INSERT INTO slides 
                                  ( Imagem, StatusSlide)
                                  VALUES ( ?, ?)",
            $data
        );

        if ($rs > 0) {
            return true;
        } else {
            return false;
        }
    }


    /*
     * Altera os dados de um Slide no banco
     */

    function update($conDb, $data)
    {

        $rs = $conDb->db_update(
            "UPDATE slides
                                  SET Imagem = ? , StatusSlide = ?
                                  WHERE codSlide = ? ",
            $data
        );

        if ($rs > 0) {
            return true;
        } else {
            return false;
        }
    }

    /*
     * Excluir uma categoria do banco
     */

    function delete($conDb, $codSlide)
    {

        $rs = $conDb->db_delete("DELETE FROM slides WHERE codSlide = ? ", array($codSlide));

        if ($rs > 0) {
            return true;
        } else {
            return false;
        }
    }
}

class modelPortifolio
{

    // Busca postagem mais recentes para alimentar a página home do site
    function buscaRecentes($conDb)
    {
        $modelRsc = $conDb->db_select("SELECT * FROM blog WHERE StatusPostagem = 'H' ORDER BY dataPostagem DESC LIMIT 6");

        if ($conDb->db_num_linhas($modelRsc) == 0) {
            return array();
        } else {
            return $conDb->db_busca_dados_all($modelRsc);
        }
    }

    // busca a categoria pelo codigo de postagem
    function buscaCategoriaPorCod($conDb, $codPostagem)
    {
        $modelRsc = $conDb->db_select(
            "SELECT * FROM categoria WHERE codPublicacao = ?",
            array($codPostagem)
        );

        if ($conDb->db_num_linhas($modelRsc) == 0) {
            return array();
        } else {
            return $conDb->db_busca_dados_all($modelRsc);
        }
    }

    // busca pelo codigo de postagem
    function buscaCodPostagem($conDb, $codPostagem)
    {

        $modelRsc = $conDb->db_select(
            "SELECT * FROM blog WHERE codPublicacao = ?",
            array($codPostagem)
        );

        if ($conDb->db_num_linhas($modelRsc) == 0) {
            return array();
        } else {
            $aRet = $conDb->db_busca_array_all($modelRsc);
            return $aRet[0];
        }
    }

    /*
     * Busca publicações cadastradas na base de dados ordenando da mais recente para a mais antiga
     */

    function lista($conDb)
    {

        $modelRsc = $conDb->db_select("SELECT * FROM blog ORDER BY dataPostagem desc");

        if ($conDb->db_num_linhas($modelRsc) == 0) {
            return array();
        } else {
            return $conDb->db_busca_dados_all($modelRsc);
        }
    }

    // Lista publicações habilitadas
    function listaHabilitados($conDb)
    {

        $modelRsc = $conDb->db_select("SELECT * FROM blog WHERE StatusPostagem = 'H' ORDER BY dataPostagem desc");

        if ($conDb->db_num_linhas($modelRsc) == 0) {
            return array();
        } else {
            return $conDb->db_busca_dados_all($modelRsc);
        }
    }

    /*
     * Retorna descrição do status
     */

    function mostraStatus($status)
    {

        return ($status == "H" ? "Habilitado" : "Desabilitado");
    }


    /*
     * Insere uma nova postagem 
     */

    function insert($conDb, $data)
    {

        $rs = $conDb->db_insert(
            "INSERT INTO blog 
                                  ( CodCategoria, Titulo, SubTitulo, Descricao, ImgCapa, Img1, Img2, Img3, Img4 )
                                  VALUES ( ?, ?, ?, ?, ? ,?, ?, ?, ?)",
            $data
        );

        if ($rs > 0) {
            return true;
        } else {
            return false;
        }
    }


    /*
     * Altera os dados de uma postagem
     */

    function update($conDb, $data)
    {

        $rs = $conDb->db_update(
            "UPDATE blog
                                  SET CodCategoria = ? , Titulo = ?, SubTitulo = ?, Descricao = ?, ImgCapa = ?, Img1 = ?, Img2 = ?, Img3 = ?, Img4 = ?
                                  WHERE codPublicacao = ? ",
            $data
        );

        if ($rs > 0) {
            return true;
        } else {
            return false;
        }
    }

    /*
     * Excluir uma postagem do banco
     */

    function delete($conDb, $codPublicacao)
    {

        $rs = $conDb->db_delete("DELETE FROM blog WHERE codPublicacao = ? ", array($codPublicacao));

        if ($rs > 0) {
            return true;
        } else {
            return false;
        }
    }
}


class modelSobreNos
{

    //Busca dados para alimentar a página
    function buscaSobreNos($conDb) {
        
        $modelRsc = $conDb->db_select( "SELECT * FROM sobrenos LIMIT 1 " );
        
        if ( $conDb->db_num_linhas($modelRsc) == 0  ) {
            return array();
        } else {
            return $conDb->db_busca_dados($modelRsc);
        }
        
    }

    // busca pelo codigo 
    function buscaCodSobre($conDb, $codSobre)
    {

        $modelRsc = $conDb->db_select(
            "SELECT * FROM sobrenos WHERE codSobre = ?",
            array($codSobre)
        );

        if ($conDb->db_num_linhas($modelRsc) == 0) {
            return array();
        } else {
            $aRet = $conDb->db_busca_array_all($modelRsc);
            return $aRet[0];
        }
    }

    /*
     * Busca dados da tabela sobrenos no banco 
     */

    function lista($conDb)
    {

        $modelRsc = $conDb->db_select("SELECT * FROM sobrenos ");

        if ($conDb->db_num_linhas($modelRsc) == 0) {
            return array();
        } else {
            return $conDb->db_busca_dados_all($modelRsc);
        }
    }

    /*
     * Insere na tabela sobrenos
     */

    function insert($conDb, $data)
    {

        $rs = $conDb->db_insert(
            "INSERT INTO sobrenos 
                                  ( Titulo,  Descricao, Imagem )
                                  VALUES ( ?, ?, ?)",
            $data
        );

        if ($rs > 0) {
            return true;
        } else {
            return false;
        }
    }


    /*
     * Altera os dados da tabela sobrenos
     */

    function update($conDb, $data)
    {

        $rs = $conDb->db_update(
            "UPDATE sobrenos
                                  SET Titulo = ?, Descricao = ?, Imagem = ?
                                  WHERE codSobre = ? ",
            $data
        );

        if ($rs > 0) {
            return true;
        } else {
            return false;
        }
    }

    /*
     * Excluir do banco SobreNos
     */

    function delete($conDb, $codSobre)
    {

        $rs = $conDb->db_delete("DELETE FROM sobrenos WHERE codSobre = ? ", array($codSobre));

        if ($rs > 0) {
            return true;
        } else {
            return false;
        }
    }
}
