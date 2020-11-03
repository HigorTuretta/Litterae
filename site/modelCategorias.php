<?php


class modelCategorias
{


    //busca categorias por codigo
    function buscaCodCategoria($conDb, $codCategoria)
    {

        $modelRsc = $conDb->db_select(
            "SELECT * FROM categoria WHERE codCategoria = ? ORDER BY Descricao",
            array($codCategoria)
        );

        if ($conDb->db_num_linhas($modelRsc) == 0) {
            return array();
        } else {
            $aRet = $conDb->db_busca_array_all($modelRsc);
            return $aRet[0];
        }
    }

    //busca categorias por Status
    function buscaCategoriaAtivas($conDb){
        $modelRsc = $conDb->db_select("SELECT * FROM categoria WHERE StatusCategoria = 'A' ORDER BY Descricao");

        if ( $conDb->db_num_linhas($modelRsc) == 0  ) {
            return array();
        } else {
            return $conDb->db_busca_dados_all($modelRsc);
        }
    }


    /*
     * Busca categorias cadastradas na base de dados
     */

    function lista($conDb)
    {

        $modelRsc = $conDb->db_select("SELECT * FROM categoria ORDER BY Descricao");

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

        return ($status == "A" ? "Ativa" : "Inativa");
    }


    /*
     * Insere uma nova categoria no banco
     */

    function insert($conDb, $data)
    {

        $rs = $conDb->db_insert(
            "INSERT INTO categoria 
                                  ( Descricao, StatusCategoria)
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
     * Altera os dados de uma categoria no banco
     */

    function update($conDb, $data)
    {

        $rs = $conDb->db_update(
            "UPDATE categoria
                                  SET Descricao = ? , StatusCategoria = ?
                                  WHERE codCategoria = ? ",
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

    function delete($conDb, $codCategoria)
    {

        $rs = $conDb->db_delete("DELETE FROM categoria WHERE codCategoria = ? ", array($codCategoria));

        if ($rs > 0) {
            return true;
        } else {
            return false;
        }
    }
}
