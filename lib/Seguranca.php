<?php

class Seguranca
{

    /*
     * Verifica se o usuário está logado, caso não esteja será direcionado para a view login
     */

    static function esta_logado($nivel = 0)
    {

        if (!isset($_SESSION['userCodigo'])) {

?>
            <script language="JavaScript">
                window.location = "<?= SITE_URL ?>login";
            </script>
            <?php

        }

        // Verifica o nivel de acesso necessário para entrar na rotina solicitada

        if ($nivel != 0) {

            if ($_SESSION['userNivel'] == 2 && $nivel == 1) {
            ?>

                <div class="container">

                    <div class="form-group">
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dimiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            Usuário sem permissão de acesso !
                        </div>
                    </div>

                </div>

<?php

                exit;
            }
        }
    }
}
