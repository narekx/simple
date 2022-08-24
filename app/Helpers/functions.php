<?php

function get_class_constants ($class)
{
    $reflectionClass = new ReflectionClass($class);
    return $reflectionClass->getConstants();
}
