<?php

use Illuminate\Support\Arr;
use App\Models\group;

function getAllGroup()
{
    $group = new group;
     return $group->getAll();
}