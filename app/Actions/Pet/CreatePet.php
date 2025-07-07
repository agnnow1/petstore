<?php
declare(strict_types=1);

namespace App\Actions\Pet;

use App\ApiClients\PetStoreApiClient;
use App\Dto\Pet;

class CreatePet
{
    public function __construct(
        private PetStoreApiClient $petStoreApiClient
    ) {
    }

    /**
     * @param array $petData
     * @return Pet
     * @throws \Exception
     */
    public function execute(array $petData): Pet
    {
        return $this->petStoreApiClient->create($petData);
    }
}