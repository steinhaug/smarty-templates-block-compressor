<?php

/* 
   Build the plugin into phar archive 
   author: kim@steinhaug.com

   At the moment no commands and no options available,
   reasoning being it is not needed.

 */

$buildRoot = "./build";
 
$phar = new Phar($buildRoot . "/block.compressor.phar", 
	FilesystemIterator::CURRENT_AS_FILEINFO |     	FilesystemIterator::KEY_AS_FILENAME, "block.compressor.phar");
   
$phar["index.php"] = file_get_contents("./src/func.composer_manual_includes.php");
$phar["minify/src/Minify.php"] = file_get_contents("./vendor/matthiasmullie/minify/src/Minify.php");
$phar["minify/src/CSS.php"] = file_get_contents("./vendor/matthiasmullie/minify/src/CSS.php");
$phar["minify/src/JS.php"] = file_get_contents("./vendor/matthiasmullie/minify/src/JS.php");
$phar["minify/src/Exception.php"] = file_get_contents("./vendor/matthiasmullie/minify/src/Exception.php");
$phar["minify/src/Exceptions/BasicException.php"] = file_get_contents("./vendor/matthiasmullie/minify/src/Exceptions/BasicException.php");
$phar["minify/src/Exceptions/FileImportException.php"] = file_get_contents("./vendor/matthiasmullie/minify/src/Exceptions/FileImportException.php");
$phar["minify/src/Exceptions/IOException.php"] = file_get_contents("./vendor/matthiasmullie/minify/src/Exceptions/IOException.php");
$phar["path-converter/src/ConverterInterface.php"] = file_get_contents("./vendor/matthiasmullie/path-converter/src/ConverterInterface.php");
$phar["path-converter/src/Converter.php"] = file_get_contents("./vendor/matthiasmullie/path-converter/src/Converter.php");
$phar["minify/data/js/keywords_after.txt"] = file_get_contents("./vendor/matthiasmullie/minify/data/js/keywords_after.txt");
$phar["minify/data/js/keywords_before.txt"] = file_get_contents("./vendor/matthiasmullie/minify/data/js/keywords_before.txt");
$phar["minify/data/js/keywords_reserved.txt"] = file_get_contents("./vendor/matthiasmullie/minify/data/js/keywords_reserved.txt");
$phar["minify/data/js/operators.txt"] = file_get_contents("./vendor/matthiasmullie/minify/data/js/operators.txt");
$phar["minify/data/js/operators_after.txt"] = file_get_contents("./vendor/matthiasmullie/minify/data/js/operators_after.txt");
$phar["minify/data/js/operators_before.txt"] = file_get_contents("./vendor/matthiasmullie/minify/data/js/operators_before.txt");
$phar->setStub($phar->createDefaultStub("index.php"));
