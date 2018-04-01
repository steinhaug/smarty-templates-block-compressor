# Smarty templates block compressor

[![License](https://raw.githubusercontent.com/steinhaug/smarty-templates-block-compressor/master/src/assets/minify.svg)](https://github.com/steinhaug/smarty-templates-block-compressor/blob/master/LICENSE)

Dropin plugin for Smarty Templates to compress inline blocks of CSS, javascript or HTML. The compression used for this plugin relies the [minifier.org](https://www.minifier.org/) PHP library.

## PREREQUISITE

Make sure you have composer running from CLI, and make sure you have PHP in the system path so its executable from CLI aswell. You need composer to download the latest version of the minifier labrary, and you will need PHP to run the build script so you get the compiled phar file.

## OVERVIEW

You will need to download the minifier classes to your project by doing this:

```bash
$ composer require matthiasmullie/minify
```

Then you will have to compile the plugin with the build.php function:

```bash
$ php build.php
```

In the build directory you should now find a file called "block.compressor.phar" which should be renamed to "block.compressor.php". This file can be dropped into your Smarty Templates plugins folder.

## SYNTAX

```html
<script>
{compressor type="[css|js|html]"}
  var somejs = value;
  var morejs = value;
{/compressor}
</script>
```
If type is omitted no compression is done at the moment.

## YOU COULD TRY A PRECOMPILED FILE

Depending on your setup you could try with a precompiled file, just drop it into your Smarty Tempates plugins folder and you are ready to go.

[prebuildt phar file ready for Smarty Plugins folder](https://github.com/steinhaug/smarty-templates-block-compressor/tree/master/prebuild-history)

## License

MIT