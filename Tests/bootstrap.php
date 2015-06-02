<?php

if ( !$loader = @include __DIR__.'/../vendor/autoload.php' )
    echo 'Update your dependencies for composer by doing composer install...';