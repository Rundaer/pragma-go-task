<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Shared\Application;

interface QueryBus
{
    public function ask(Query $query) : Response|null;
}
