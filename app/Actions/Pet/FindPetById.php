<?php
declare(strict_types=1);

namespace App\Actions\Pet;

use App\ApiClients\PetStoreApiClient;
use App\Dto\Pet;

class FindPetById
{
    public function __construct(
        private PetStoreApiClient $petStoreApiClient
    ) {
    }

    /**
     * @param int $petId
     * @return Pet
     * @throws \App\Exceptions\PetNotFoundException
     */
    public function execute(int $petId): Pet
    {
        return $this->petStoreApiClient->get($petId);
    }
}