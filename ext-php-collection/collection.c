/* collection extension for PHP (c) 2024 Antoine Benevaut */

#ifdef HAVE_CONFIG_H
# include <config.h>
#endif

#include "php.h"
#include "ext/standard/info.h"
#include "php_collection.h"
#include "collection_arginfo.h"

/* {{{ PHP_RINIT_FUNCTION */
PHP_RINIT_FUNCTION(collection)
{
#if defined(ZTS) && defined(COMPILE_DL_COLLECTION)
	ZEND_TSRMLS_CACHE_UPDATE();
#endif

	return SUCCESS;
}
/* }}} */

/* {{{ PHP_MINFO_FUNCTION */
PHP_MINFO_FUNCTION(collection)
{
	php_info_print_table_start();
	php_info_print_table_row(2, "collection support", "enabled");
	php_info_print_table_row(2, "collection version", PHP_COLLECTION_VERSION);
	php_info_print_table_end();
}
/* }}} */

/* {{{ collection_module_entry */
zend_module_entry collection_module_entry = {
	STANDARD_MODULE_HEADER,
	"collection",					/* Extension name */
	ext_functions,					/* zend_function_entry */
	NULL,							/* PHP_MINIT - Module initialization */
	NULL,							/* PHP_MSHUTDOWN - Module shutdown */
	PHP_RINIT(collection),			/* PHP_RINIT - Request initialization */
	NULL,							/* PHP_RSHUTDOWN - Request shutdown */
	PHP_MINFO(collection),			/* PHP_MINFO - Module info */
	PHP_COLLECTION_VERSION,		/* Version */
	STANDARD_MODULE_PROPERTIES
};
/* }}} */

#ifdef COMPILE_DL_COLLECTION
# ifdef ZTS
ZEND_TSRMLS_CACHE_DEFINE()
# endif
ZEND_GET_MODULE(collection)
#endif
