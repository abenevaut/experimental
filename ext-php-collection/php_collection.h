/* collection extension for PHP (c) 2024 Antoine Benevaut */

#ifndef PHP_COLLECTION_H
# define PHP_COLLECTION_H

extern zend_module_entry collection_module_entry;
# define phpext_collection_ptr &collection_module_entry

# define PHP_COLLECTION_VERSION "0.1.0"

# if defined(ZTS) && defined(COMPILE_DL_COLLECTION)
ZEND_TSRMLS_CACHE_EXTERN()
# endif

#endif	/* PHP_COLLECTION_H */
