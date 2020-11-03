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
    function buscaSlidesHabilitados($conDb)
    {

        $modelRsc = $conDb->db_select(
            "SELECT * FROM slides WHERE StatusSlide = 'H' ORDER BY codSlide"
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
