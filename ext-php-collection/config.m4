PHP_ARG_ENABLE([collection],
  [whether to enable collection support],
  [AS_HELP_STRING([--enable-collection],
    [Enable collection support])],
  [no])

if test "$PHP_COLLECTION" != "no"; then
  AC_DEFINE(HAVE_COLLECTION, 1, [ Have collection support ])

  PHP_NEW_EXTENSION(collection, collection.c, $ext_shared)
fi
