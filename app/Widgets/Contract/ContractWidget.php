<?php

namespace App\Widgets\Contract;

interface ContractWidget
{
    public function execute();

    public function setParams($params = []);
}
