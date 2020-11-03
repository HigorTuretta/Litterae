<?php

    require_once 'modelUsuario.php';
    
    $model = new modelUsuario();

    if ($acao == "efetuarLogin" ) {
        
        /*
         * Verifica se existe usuários na base de dados, se não existir,
         * criar o login administrador
         */
        
        if (!$model->criarSuperUser($conDb)){
            header("Location: " . SITE_URL . "login" );       // página login
            exit;
        }
                
        /*
         * Validar o login informado no formulário
         */
        
        $arUser = $model->buscaLogin($conDb, trim($_POST["Login"]) );
        
        if ( $arUser ) {            // Usuário localizado na base de dados
            
            // validar a senha
            
            if (!password_verify(trim($_POST["Senha"]), $arUser->Senha) ) {
                $_SESSION["msgError"] = "Senha informa é inválida";
                header("Location: " . SITE_URL . "login" );
                exit;
            }
            
            // validar o status do usuário
            
            if ($arUser->StatusCadastro == 0 ) {
                $_SESSION["msgError"] = "Usuário Inativo, não será possível prosseguir!";
                header("Location: " . SITE_URL . "login" );
                exit;
            }
            
            //  Criar flag's de usuário logado no sistema
            
            $_SESSION["userCodigo"] = $arUser->CodUsuario;
            $_SESSION["userLogin"]  = $arUser->Login;
            $_SESSION["userNivel"]  = $arUser->Nivel;
            $_SESSION["userSenha"]  = $arUser->Senha;
            
            // Direcionar o usuário para página Administrativa
            
            header("Location: " . SITE_URL . "areaAdministrativa" );
            exit;
            
            //
                        
        } else {                    // Usuário não localizado na base de dados
            $_SESSION["msgError"] = "Não foi possível localizar o login informado!";
            header("Location: " . SITE_URL . "login" );
            exit;
        }
        
    } else if ($acao == "logout") {

        // Destruindo as sessões de controle de login
        
        unset( $_SESSION["userCodigo"] );
        unset( $_SESSION["userLogin"]  );
        unset( $_SESSION["userNivel"]  ); 
        unset( $_SESSION["userSenha"]  );
        
        //
        
        ?>
        <script language="JavaScript">
            window.location="<?= SITE_URL ?>";
        </script>
        <?php
        
    } else if ($acao == "Insert") {
        
        $data = array(
                       $_POST["StatusCadastro"],
                       $_POST["Nivel"],
                       $_POST["NomeCompleto"],
                       $_POST["Email"],
                       $_POST["Login"],
                       password_hash($_POST["Senha"], PASSWORD_DEFAULT )
                    );
        
        $result = $model->insert( $conDb, $data );
        
        if ($result) {
            $_SESSION["msgSucesso"] = "Usuário incluído com sucesso !";
        } else {
            $_SESSION["msgError"] = "Não foi possível incluir o usuário no banco de dados !";
        }
        
        ?>
        <script language="JavaScript">
            window.location="<?= SITE_URL ?>listaUsuario";
        </script>
        <?php        

    } else if ($acao == "Update") {

        $data = array(
                       $_POST["StatusCadastro"],
                       $_POST["Nivel"],
                       $_POST["NomeCompleto"],
                       $_POST["Email"],
                       $_POST["Login"],
                       $_POST["CodUsuario"]
                    );
        
        $result = $model->update($conDb, $data);

        if ($result) {
            $_SESSION["msgSucesso"] = "Usuário alterado com sucesso !";
        } else {
            $_SESSION["msgError"] = "Não foi possível alterar o usuário no banco de dados !";
        }
        
        ?>
        <script language="JavaScript">
            window.location="<?= SITE_URL ?>listaUsuario";
        </script>
        <?php
        
    } else if ($acao == "Delete") {
                
        $result = $model->delete($conDb, $_POST['CodUsuario']);

        if ($result) {
            $_SESSION["msgSucesso"] = "Usuário excluído com sucesso !";
        } else {
            $_SESSION["msgError"] = "Não foi possível excluir o usuário no banco de dados !";
        }
        
        ?>
        <script language="JavaScript">
            window.location="<?= SITE_URL ?>listaUsuario";
        </script>
        <?php
        
    }
    
    ?>
    <script language="JavaScript">
        window.location="<?= SITE_URL ?>";
    </script>
    <?php      