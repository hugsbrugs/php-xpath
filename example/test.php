<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Hug\Xpath\Xpath as Xpath;

$html = file_get_contents(__DIR__ . '/../data/free.fr.html');
// $html = file_get_contents(__DIR__ . '/../data/free.fr-invalid.html');
$html_iframe = file_get_contents(__DIR__ . '/../data/iframe.html');

/* ************************************************* */
/* *************** Xpath::extract_all ************** */
/* ************************************************* */

$query = '//a';
$test = Xpath::extract_all($html, $query);
echo 'Xpath::extract_all' . "\n";
echo print_r($test, true) . "\n";

/* ************************************************* */
/* ************** Xpath::extract_first ************* */
/* ************************************************* */

$query = '//body//h3';
$test = Xpath::extract_first($html, $query);
echo 'Xpath::extract_first' . "\n";
echo var_dump($test) ."\n";

/* ************************************************* */
/* **************** Xpath::get_body **************** */
/* ************************************************* */

$test = Xpath::get_body($html);
echo 'Xpath::get_body' . "\n";
echo $test ."\n";

/* ************************************************* */
/* ************** Xpath::replace_body ************** */
/* ************************************************* */

$new_body = '<div>coucou toi</div>';
$test = Xpath::replace_body($html, $new_body);
echo 'Xpath::replace_body' . "\n";
echo $test ."\n";

/* ************************************************* */
/* ************** Xpath::extract_style ************* */
/* ************************************************* */

$query = '//body//div[@class="inscriptionadsl"]';
$style_property = 'height';
$test = Xpath::extract_style($html, $query, $style_property);
echo 'Xpath::extract_style' . "\n";
echo print_r($test, true) ."\n";

/* ************************************************* */
/* ************* Xpath::extract_iframe ************* */
/* ************************************************* */

$domain = 'hugo.maugey.fr';
$test = Xpath::extract_iframe($html_iframe, $domain);
echo 'Xpath::extract_iframe' . "\n";
echo print_r($test, true) ."\n";

