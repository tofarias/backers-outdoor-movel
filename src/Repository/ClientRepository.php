<?php

declare(strict_types=1);
namespace Backers\Repository;

use Backers\Models\Client;

class ClientRepository extends DefaultRepository implements ClientRepositoryInterface
{
    public function __construct()
    {
        parent::__construct(Client::class);
    }
}