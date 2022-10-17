<?php

function dumper($data)
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";
    exit;
}


function getHost()
{
    return 'http://localhost:8080';
}
