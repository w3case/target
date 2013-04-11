<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Target
 *
 * Sistema CMS W3case Target
 * Target - Sua melhor solução em manutenção para seu website. Um produto da Agência W3Case
 *
 * @package		Target
 * @author		W3Case Soluções Interativas
 * @copyright           Copyright (c) 2007 - 2013, W3Case, LTDA.
 * @license		Todos os direitos reservados a w3case soluções interativas
 * @link		http://www.w3case.com.br/target
 * @since		Version 4.0
 * @filesource
 */
// ------------------------------------------------------------------------

/*
 * Retorna a versão do sistema vigente
 */
function Version()
{
    $xml = @simplexml_load_file("http://www.whostbr.com.br/cms/version/version.xml");
    return $xml->Version;
}

/*
 * Função para verificar campos
 * @param Array contendo o campos a serem verificados
 * @return Boolean
 */

function verificarCampos($dados = array(), $tipo = "post")
{
    // Verifica se há dados no vetor
    if (count($dados) == 0)
        return false;

    // Caso o Metodo de envio seja Post ou Get, executa a verificação
    if ($tipo == 'post')
    {
        foreach ($dados as $value)
        {
            if (empty($_POST[$value]))
            {
                echo 'Por favor, verifique os campos necessários';
                exit;
            }
        }
    }
    else
    {
        foreach ($dados as $value)
        {
            if (empty($_GET[$value]))
            {
                echo 'Por favor, verifique os campos necessários';
                exit;
            }
        }
    }
}

/*
 * Função para validar o CPF
 * @param String
 * @return boolean
 * 
 * CPF com 000.000.000-00 não serão truncados
 */
function validaCPF($cpf)
{   
    $cpf = preg_replace('/[^0-9]/', "", $cpf);
    // Verifica se nenhuma das sequÃªncias abaixo foi digitada, caso seja, retorna falso
    if (strlen($cpf) != 11 || $cpf == '11111111111' || $cpf == '22222222222' || $cpf == '33333333333' || $cpf == '44444444444' || $cpf == '55555555555' || $cpf == '66666666666' || $cpf == '77777777777' || $cpf == '88888888888' || $cpf == '99999999999')
    {
        return false;
    }
    else
    {   // Calcula os nÃºmeros para verificar se o CPF Ã© verdadeiro
        for ($t = 9; $t < 11; $t++)
        {
            for ($d = 0, $c = 0; $c < $t; $c++)
            {
                $d += $cpf{$c} * (($t + 1) - $c);
            }

            $d = ((10 * $d) % 11) % 10;

            if ($cpf{$c} != $d)
            {
                return false;
            }
        }

        return true;
    }
}