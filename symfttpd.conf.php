<?php
/**
 * Default configuration options
 *
 * Do not edit this file!
 * Use the user-level config $HOME/.symfttpd.conf.php
 * and the project-level one at $PROJECT/config/symfttpd.conf.php
 *
 * @author Laurent Bachelier <laurent@bachelier.name>
 */

// {{{ mksymlinks configuration

/**
 * Path to symfttpd files
 * Useful for creating the link to genconf.
 * Do not change/copy it unless you know what you are doing.
 * @var string symfttpd path
 */
$options['path'] = dirname(__FILE__);

/**
 * Create the symlink to genconf
 * @var string|boolean false or path relative to the project root
 */
$options['genconf'] = 'config/lighttpd.php';

/**
 * Create the symlink to the symfony data directory
 * (not recommended unless using symfony 1.0)
 * @var string|boolean false or path relative to the project root
 */
$options['data_symlink'] = false;

/**
 * Create the symlink to the symfony lib directory
 * (lib/vendor/symfony is the recommended path for 1.1+)
 * @var string|boolean false or path relative to the project root
 */
$options['lib_symlink']  = 'lib/vendor/symfony';

/**
 * Create the symlink to the symfony directory
 * (not recommended)
 * @var string|boolean false or path relative to the project root
 */
$options['symfony_symlink'] = false;

/**
 * Create the symlink for "/sf"
 * (recommended)
 * @var string|boolean false or "web/sf"
 */
$options['web_symlink'] = 'web/sf';

/**
 * Try to run symfony:publish-assets
 * @var boolean
 */
$options['do_plugins'] = true;

/**
 * Create relative symlinks
 * (recommended)
 * @var boolean
 */
$options['relative'] = true;

/**
 * Wanted symfony version
 * You should override this in the project-level config
 * @var string
 */
$options['want'] = '1.4';


/**
 * symfony paths
 * You should override this in the user-level config
 * @var array version=>path
 */
$options['sf_path'] = array(
    '1.0'=>getenv('HOME').'/Dev/symfony/1.0',
    '1.1'=>getenv('HOME').'/Dev/symfony/1.1',
    '1.2'=>getenv('HOME').'/Dev/symfony/1.2',
    '1.3'=>getenv('HOME').'/Dev/symfony/1.3',
    '1.4'=>getenv('HOME').'/Dev/symfony/1.4',
);

// }}}

// {{{ spawn configuration

/**
 * symfttpd will try to find the executables by using the PATH environment
 * variable, then by using this variable.
 * @var array List of directories
 */
$options['custom_path'] = array('/usr/sbin');

/**
 * Absolute path to the lighttpd server executable
 * @var string|boolean false to autodetect (try to find "lighttpd" in the path)
 */
$options['lighttpd_cmd'] = false;

/**
 * Absolute path to the CLI PHP executable
 * @var string|boolean false to autodetect (try to find "php" in the path)
 */
$options['php_cmd'] = realpath(PHP_BINDIR.'/php');

/**
 * Absolute path to the CGI PHP executable
 * @var string|boolean false to autodetect (try to find "php-cgi" in the path)
 */
$options['php-cgi_cmd'] = realpath(PHP_BINDIR.'/php-cgi');

/**
 * Default server template path
 * @var string|null null to autodetect (try to find "php-cgi" in the path)
 */
$options['config_template'] = dirname(__FILE__).'/data/lighttpd.conf.php';

// }}}
