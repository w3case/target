<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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