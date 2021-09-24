#!/bin/bash
mkdir ../public/swagger
php ../vendor/bin/openapi --output ../public/swagger ./swagger-v1.php ../public
