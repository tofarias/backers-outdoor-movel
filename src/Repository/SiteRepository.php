
<?php

declare(strict_types=1);
namespace Backers\Repository;

use Backers\Models\Client;

class SiteRepository extends DefaultRepository implements SiteRepositoryInterface
{
    public function __construct()
    {
        parent::__construct(Client::class);
    }
}