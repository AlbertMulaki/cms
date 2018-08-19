<?php

function create($class, $attributes = [], $times = 1)
{
    return factory($class, $times)->create($attributes);
}

function make($class, $attributes = [], $times = 1)
{
    return factory($class, $times)->make($attributes);
}

function raw($class, $attributes = [], $times = 1)
{
    return factory($class, $times)->raw($attributes);
}
