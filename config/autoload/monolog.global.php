<?php

declare(strict_types=1);

return [
   "monolog"=>[
       "name" => "test-php-api",
       "stream" => getenv("MONOLOG_STREAM"),
       "hostname" => getenv("HOSTNAME"),
   ]
];
