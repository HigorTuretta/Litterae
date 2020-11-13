<?php


class modelContatos
{


    //busca contato por codigo
    function buscaCodContato($conDb, $codContato)
    {

        $modelRsc = $conDb->db_select(
            "SELECT * FROM contato WHERE codContato = ?",
            array($codContato)
        );

        if ($conDb->db_num_linhas($modelRsc) == 0) {
            return array();
        } else {
            $aRet = $conDb->db_busca_array_all($modelRsc);
            return $aRet[0];
        }
    }
    function buscaNovosContatos($conDb)
    {
        $modelRsc = $conDb->db_select("SELECT COUNT(*) AS NovosRegistros FROM contato WHERE StatusPedido = '1' ");

        if ($conDb->db_num_linhas($modelRsc) == 0) {
            return array();
        } else {
            return $conDb->db_busca_dados($modelRsc);
        }
    }

    /*
     * Busca contatos cadastrados na base de dados
     */

    function lista($conDb)
    {

        $modelRsc = $conDb->db_select("SELECT * FROM contato ORDER BY StatusPedido");

        if ($conDb->db_num_linhas($modelRsc) == 0) {
            return array();
        } else {
            return $conDb->db_busca_dados_all($modelRsc);
        }
    }
    /*
     * Retorna descrição do status do pedido
     */

    function mostraStatusPedido($status)
    {

        return ($status == "1" ? "Pendente" : ($status == "2" ? "Lido" : "Concluído"));
    }

    /*
     * Retorna descrição do status do pedido
     */

    function mostraTipoProjeto($tipoProjeto)
    {

        return ($tipoProjeto == "1" ? "Parede" : ($tipoProjeto == "2" ? "Quadro" : ($tipoProjeto == "3" ? "Lettering Public." : "Lettering Geral")));
    }

    // função para marcar como lido
    function marcarLido($conDb, $codContato)
    {
        $rs = $conDb->db_update(
            "UPDATE contato
                 SET StatusPedido = '2' 
                 WHERE codContato = ? ",
            $codContato
        );

        if ($rs > 0) {
            return true;
        } else {
            return false;
        }
    }

    // função para desmarcar como lido
    function desmarcarLido($conDb, $codContato)
    {
        $rs = $conDb->db_update(
            "UPDATE contato
                 SET StatusPedido = '1' 
                 WHERE codContato = ? ",
            $codContato
        );

        if ($rs > 0) {
            return true;
        } else {
            return false;
        }
    }

    // função para desmarcar como lido
    function marcarConcluido($conDb, $codContato)
    {
        $rs = $conDb->db_update(
            "UPDATE contato
                 SET StatusPedido = '3' 
                 WHERE codContato = ? ",
            $codContato
        );

        if ($rs > 0) {
            return true;
        } else {
            return false;
        }
    }
    // função para desmarcar como lido
    function desmarcarConcluido($conDb, $codContato)
    {
        $rs = $conDb->db_update(
            "UPDATE contato
                 SET StatusPedido = '2' 
                 WHERE codContato = ? ",
            $codContato
        );

        if ($rs > 0) {
            return true;
        } else {
            return false;
        }
    }

    /*
     * Insere uma novo contato no banco
     */

    function insert($conDb, $data)
    {

        $rs = $conDb->db_insert(
            "INSERT INTO contato 
                                  ( Nome, Email, TipoProjeto, Descricao)
                                  VALUES ( ?, ?, ?, ?)",
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
            "UPDATE contato
                 SET StatusPedido = ? 
                 WHERE codContato = ? ",
            $data
        );

        if ($rs > 0) {
            return true;
        } else {
            return false;
        }
    }

    /*
     * Excluir um contato do banco
     */

    function delete($conDb, $codContato)
    {

        $rs = $conDb->db_delete("DELETE FROM contato WHERE codContato = ? ", array($codContato));

        if ($rs > 0) {
            return true;
        } else {
            return false;
        }
    }
}
