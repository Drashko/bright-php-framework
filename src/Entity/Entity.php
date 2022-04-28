<?php

namespace src\Entity;

abstract class Entity
{
    abstract  function getTable() : string;
    abstract  function getId() : int;
    abstract  function mappedData() : array;
}