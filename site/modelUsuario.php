<?php

class modelUsuario
{

    /*
     *  Verifica se existe usuários na base de dados, caso não exista criar o
     *  usuário administrador
     */

    function criarSuperUser($conDb)
    {

        $rscUser = $conDb->db_select("SELECT COUNT(*) AS QTD FROM usuario");
        $rs      = $conDb->db_busca_dados($rscUser);

        if ($rs->QTD == 0) {

            $rsUsuario = $conDb->db_insert(
                "INSERT INTO usuario
                                            ( Login, NomeCompleto, Senha, Nivel, Email )
                                            VALUES( ?, ?, ?, ?, ? ) ",
                array(
                    "admin",
                    "Administrador do Sistema",
                    password_hash("sarinha", PASSWORD_DEFAULT),
                    1,
                    "admin@goodplate.com.br"
                )
            );

            if ($rsUsuario > 0) {
                return true;
            } else {
                echo "Falha na inclusão do super usuário";
                exit;
            }
        }

        return true;
    }


    /*
     * Buscar usuário usuário pelo campo Login
     */

    function buscaLogin($conDb, $userName)
    {

        $rsc = $conDb->db_select(
            "SELECT * FROM usuario WHERE Login = ?",
            array($userName)
        );

        return $conDb->db_busca_dados($rsc);
    }


    /*
     * Buscar usuário usuário pelo campo Login
     */

    function buscaUsuarioID($conDb, $CodUsuario)
    {

        $modelRsc = $conDb->db_select(
            "SELECT * FROM usuario WHERE CodUsuario = ?",
            array($CodUsuario)
        );

        if ($conDb->db_num_linhas($modelRsc) == 0) {
            return array();
        } else {
            $aRet = $conDb->db_busca_array_all($modelRsc);
            return $aRet[0];
        }
    }


    /*
     * Busca usuários cadastrados na base de dados
     */

    function lista($conDb)
    {

        $modelRsc = $conDb->db_select("SELECT * FROM usuario ORDER BY Login");

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

        return ($status == 0 ? "Inativo" : ($status == 1 ? "Ativo" : "Bloqueado"));
    }

    /*
     * Retorna descrição do nível do usuário
     */

    function mostraNivel($nivel)
    {

        return ($nivel == 1 ? "Administrador" : "Usuário");
    }


    /*
     * Insere um novo usuário na tabela de usuários
     */

    function insert($conDb, $data)
    {

        $rs = $conDb->db_insert(
            "INSERT INTO usuario
                                  ( StatusCadastro, Nivel, NomeCompleto, Email, Login, Senha  )
                                  VALUES ( ?, ?, ?, ?, ?, ? )",
            $data
        );

        if ($rs > 0) {
            return true;
        } else {
            return false;
        }
    }


    /*
     * Altera os dados de um usuário na base de dados
     */

    function update($conDb, $data)
    {

        $rs = $conDb->db_update(
            "UPDATE usuario
                                  SET StatusCadastro = ? , Nivel = ?, NomeCompleto = ?, Email = ?, Login = ?
                                  WHERE CodUsuario = ? ",
            $data
        );

        if ($rs > 0) {
            return true;
        } else {
            return false;
        }
    }

    /*
     * Excluir um usuário na base de dados
     */

    function delete($conDb, $codUsuario)
    {

        $rs = $conDb->db_delete("DELETE FROM usuario WHERE CodUsuario = ? ", array($codUsuario));

        if ($rs > 0) {
            return true;
        } else {
            return false;
        }
    }
}
