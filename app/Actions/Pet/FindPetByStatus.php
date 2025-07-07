<?php
declare(strict_types=1);

namespace App\Actions\Pet;

use App\ApiClients\PetStoreApiClient;
use App\Dto\Pet;

class FindPetByStatus
{
    public function __construct(
        private PetStoreApiClient $petStoreApiClient
    ) {
    }

    /**
     * @param array $status
     * @return Pet[]
     */
    public function execute(array $status): array
    {
        return $this->petStoreApiClient->findByStatus($status);
    }
}