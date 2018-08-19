<?php

function create($class, $attributes = [], $times = '')
{
    return factory($class)->create($attributes);
}

function make($class, $attributes = [], $times = '')
{
    return factory($class, $times)->make($attributes);
}

function raw($class, $attributes = [])
{
    return factory($class)->raw($attributes);
}
