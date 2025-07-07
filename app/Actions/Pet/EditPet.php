<?php
declare(strict_types=1);

namespace App\Actions\Pet;

use App\ApiClients\PetStoreApiClient;
use App\Dto\Pet;

class EditPet
{
    public function __construct(
        private PetStoreApiClient $petStoreApiClient
    ) {
    }

    /**
     * @param array $petData
     * @return Pet
     * @throws \App\Exceptions\ApiValidationException
     * @throws \App\Exceptions\InvalidPetIdException
     * @throws \App\Exceptions\PetNotFoundException
     */
    public function execute(array $petData): Pet
    {
        return $this->petStoreApiClient->edit($petData);
    }
}