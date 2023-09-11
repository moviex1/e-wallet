<?php

namespace App\Mapper\OperationMapper;

use App\Entity\Operation;

interface OperationMapper
{
    public function map(): Operation;

}