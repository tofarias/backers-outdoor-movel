<?php
declare(strict_types=1);
namespace Backers\Repository;


use Backers\Models\Client;

class CategoryCostsRepository extends DefaultRepository implements ClientInterface
{
    public function __construct()
    {
        parent::__construct(Client::class);
    }
}