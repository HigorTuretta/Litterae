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
    
    static function set_value($valor, $default = "") { 
        
        global $dados;
        
        if (isset($dados[$valor])) {
            return $dados[$valor];
        } else {
            return $default;
        }
        
    }
        
    
    
}
