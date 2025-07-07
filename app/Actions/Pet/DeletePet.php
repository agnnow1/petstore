<?php
declare(strict_types=1);

namespace App\Actions\Pet;

use App\ApiClients\PetStoreApiClient;

class DeletePet
{
    public function __construct(
        private PetStoreApiClient $petStoreApiClient
    ) {
    }

    /**
     * @param int $petId
     * @return void
     * @throws \App\Exceptions\ApiRequestFailedException
     * @throws \App\Exceptions\InvalidPetIdException
     * @throws \App\Exceptions\PetNotFoundException
     */
    public function execute(int $petId): void
    {
        $this->petStoreApiClient->delete($petId);
    }
}