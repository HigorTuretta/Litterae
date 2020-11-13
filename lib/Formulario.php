<?php


class Formulario
{

    /*
     * Exibe ação para o formulario (ou sub-titulo)
     */

    static function form_sub_titulo($acao)
    {

        $cRet = "";

        if ($acao == "visualizar") {
            $cRet = "Visualização";
        } else if ($acao == "novo") {
            $cRet = "Inclusão";
        } else if ($acao == "alterar") {
            $cRet = "Alteração";
        } else if ($acao == "excluir") {
            $cRet = "Exclusão";
        }

        return $cRet;
    }

    /*
     * Retornar a ação a ser realizada na base dados
     * 
     */

    static function formAcao($acao)
    {

        $cRet = "";

        if ($acao == "novo") {
            $cRet = "Insert";
        } else if ($acao == "alterar") {
            $cRet = "Update";
        } else if ($acao == "excluir") {
            $cRet = "Delete";
        }

        return $cRet;
    }



    /*
     * Seta o valor para o campo do formulário
     */

    static function set_value($valor, $default = "")
    {

        global $dados;

        if (isset($dados[$valor])) {
            return $dados[$valor];
        } else {
            return $default;
        }
    }

    // exibe mensagem de sucesso ou erro
    static function exibeMensagem()
    {

        $cRet = "";

        if (isset($_SESSION["msgSucesso"])) {

            $cRet = '
            <div class="row">
                <div class="col-12">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">' .
                $_SESSION["msgSucesso"] . '
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>';

            unset($_SESSION["msgSucesso"]);
        }

        if (isset($_SESSION["msgError"])) {

            $cRet = ' <div class="row">
                <div class="col-12">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        ' . $_SESSION["msgError"] . '
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>';

            unset($_SESSION["msgError"]);
        }

        return $cRet;
    }

    static function setDataTable($idTable)
    {
        return '<script type="text/javascript">
        $(document).ready( () => {
            $("#' . $idTable . '").DataTable({
    
                language: 
                        {
                            "sEmptyTable": "Nenhum registro encontrado",
                            "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                            "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                            "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                            "sInfoPostFix": "",
                            "sInfoThousands": ".",
                            "sLengthMenu": "_MENU_ resultados por página",
                            "sLoadingRecords": "Carregando...",
                            "sProcessing": "Processando...",
                            "sZeroRecords": "Nenhum registro encontrado",
                            "sSearch": "Pesquisar",
                            "oPaginate": {
                                "sNext": "Próximo",
                                "sPrevious": "Anterior",
                                "sFirst": "Primeiro",
                                "sLast": "Último"
                            },
                            "oAria": {
                                "sSortAscending": ": Ordenar colunas de forma ascendente",
                                "sSortDescending": ": Ordenar colunas de forma descendente"
                            },
                            "select": {
                                "rows": {
                                    "_": "Selecionado %d linhas",
                                    "0": "Nenhuma linha selecionada",
                                    "1": "Selecionado 1 linha"
                                }
                            },
                            "buttons": {
                                "copy": "Copiar para a área de transferência",
                                "copyTitle": "Cópia bem sucedida",
                                "copySuccess": {
                                    "1": "Uma linha copiada com sucesso",
                                    "_": "%d linhas copiadas com sucesso"
                                }
                            }
                        }
    
            })
        })
    </script>';
    }
}
