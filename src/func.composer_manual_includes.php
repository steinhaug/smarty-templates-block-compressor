<?php

require_once 'minify/src/Minify.php';
require_once 'minify/src/CSS.php';
require_once 'minify/src/JS.php';
require_once 'minify/src/Exception.php';
require_once 'minify/src/Exceptions/BasicException.php';
require_once 'minify/src/Exceptions/FileImportException.php';
require_once 'minify/src/Exceptions/IOException.php';
require_once 'path-converter/src/ConverterInterface.php';
require_once 'path-converter/src/Converter.php';

function smarty_block_compressor($params, $content, &$template, &$repeat){

    if (!$repeat){
        if( isset($params['type']) AND ($params['type'] == 'css') ){
            return minify_css($content);
        } else if( isset($params['type']) AND ($params['type'] == 'js') ){
            return minify_js($content);
        } else if( isset($params['type']) AND ($params['type'] == 'html') ){
            return minify_html($content);
        }
        return $content;
    }
}

function html_turbo_compressor($buffer,$only_comments=false, $xtra_header=false) {
    if(!$xtra_header){
        $buffer = preg_replace('#<!---EOF[^\\[<>].*?(?<!!)EOF--->#s', '', $buffer); // Removing: <!--EOF whatever EOF--->
        $buffer = preg_replace('#<!-- /[^\\[<>].*?(?<!!) -->#s', '', $buffer);      // Removing: <!-- /whatever -->
        $buffer = preg_replace('#<!--\*[^\\[<>].*?(?<!!)\*-->#s', '', $buffer);     // Removing: <!--*whatever*-->

        $buffer = preg_replace('#<!--/ [^\\[<>].*?(?<!!) -->#s', '', $buffer);      // Removing: <!--/ (.*) -->

    } else {
        $buffer = preg_replace('#<!--\*[^\\[<>].*?(?<!!)\*-->#s', '', $buffer);     // Removing: <!--*whatever*-->
    }
    if($only_comments)
        return $buffer;

        $buffer = preg_replace("/\s+/", ' ', $buffer);

        $buffer = str_replace("</td> </tr>", '</td></tr>', $buffer);
        $buffer = str_replace("</li> </ul>", '</li></ul>', $buffer);
        $buffer = str_replace("</li> <li",   '</li><li', $buffer);
        $buffer = str_replace("</td> <td",   '</td><td', $buffer);

        if($xtra_header){
            $buffer = str_replace("> <script", '><script', $buffer);
            $buffer = str_replace("> <link",   '><link', $buffer);
            $buffer = str_replace("> <meta",   '><meta', $buffer);
    }

    return $buffer;
}

function print_performance_graph($subject,$minified,$html){
	$before = strlen(gzcompress($html));
	$after = strlen(gzcompress($minified));	
	$improvement =  100 * (1-($after/$before));
	echo  "<table style='width:100%; border:1px solid grey;text-align:center'><tr><th colspan=3><b>$subject</th><tr><th>Gzipped Bytes Before PHPWee</th><th>Gzipped Bytes After PHPWee</th><th>% Performance Boost</th></tr><tr><td>$before before</td><td>$after after</td><td> $improvement % faster </td></table><br><br>";
}

function minify_css($css){
    $minifier = new MatthiasMullie\Minify\CSS( $css );
    $css = $minifier->minify();
    return $css . "\n";
}
function minify_js($js){
    $minifier = new MatthiasMullie\Minify\JS( $js );
    $js = $minifier->minify();
    return $js . "\n";
}
function minify_html($html,$only_comments=false, $xtra_header=false){
    $html = html_turbo_compressor($html, $only_comments, $xtra_header);
    return $html . "\n";
}
