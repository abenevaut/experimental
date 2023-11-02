; Windows msys2
pacman -S mingw-w64-x86_64-llvm


windows valgrind alternative - NOT FREE - https://www.deleaker.com/blog/2022/03/14/memory-leak-detection-tool-for-mingw/#how-to-fix-memory-leak

https://www.slideshare.net/jpauli/understanding-php-memory


time USE_ZEND_ALLOC=1 php main.php
time USE_ZEND_ALLOC=0 php main.php

USE_ZEND_ALLOC=1 valgrind php main.php
USE_ZEND_ALLOC=0 valgrind php main.php

should demo that PHP with ZendMM is ~10% faster (slide 29)

https://github.com/arnaud-lb/php-memory-profiler



