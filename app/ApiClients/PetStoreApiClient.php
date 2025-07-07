<?php
declare(strict_types=1);

namespace App\ApiClients;

use App\Dto\Pet;
use App\Exceptions\ApiRequestFailedException;
use App\Exceptions\ApiValidationException;
use App\Exceptions\InvalidPetIdException;
use App\Exceptions\PetNotFoundException;
use Illuminate\Support\Facades\Http;

class PetStoreApiClient
{
    const API_URL = 'https://petstore.swagger.io/v2';

    /**
     * @param array $petData
     * @return Pet
     * @throws \Exception
     */
    public function create(array $petData): Pet
    {
        $response = Http::post(self::API_URL . '/pet', $petData);

        if ($response->failed()) {
            throw new \Exception('Could not add pet. Try again.');
        }

        return Pet::fromArray($response->json());
    }

    /**
     * @param array $petData
     * @return Pet
     * @throws ApiValidationException
     * @throws InvalidPetIdException
     * @throws PetNotFoundException
     */
    public function edit(array $petData): Pet
    {
        $response = Http::put(self::API_URL . '/pet', $petData);

        if ($response->failed()) {
            $status = $response->status();

            match ($status) {
                400 => throw new InvalidPetIdException('Invalid ID supplied.'),
                404 => throw new PetNotFoundException('Pet not found.'),
                405 => throw new ApiValidationException('Validation exception.'),
                default => throw new \RuntimeException('Unexpected API error: ' . $status),
            };
        }

        return Pet::fromArray($response->json());
    }

    /**
     * @throws PetNotFoundException
     */
    public function get(int $id): Pet
    {
        $response = Http::get(
            sprintf('%s/pet/%d', self::API_URL, $id)
        );

        if ($response->status() === 404) {
            throw new PetNotFoundException(sprintf('Pet with id %d does not exist.', $id));
        }

        if ($response->failed()) {
            throw new \RuntimeException("Failed to fetch pet.");
        }

        return Pet::fromArray($response->json());
    }

    /**
     * @return Pet[]
     */
    public function findByStatus(array $status): array
    {
        $query = http_build_query(['status' => $status], '', '&', PHP_QUERY_RFC3986);
        $query = preg_replace('/%5B\d+%5D(?==)/', '', $query);

        $response = Http::get(self::API_URL . '/pet/findByStatus?' . $query);

        return array_map(
            fn(array $data) => Pet::fromArray($data),
            $response->json()
        );
    }

    /**
     * @param int $id
     * @return void
     * @throws ApiRequestFailedException
     * @throws InvalidPetIdException
     * @throws PetNotFoundException
     */
    public function delete(int $id): void
    {
        $response = Http::delete(sprintf('%s/pet/%d', self::API_URL, $id));

        if ($response->failed()) {
            match ($response->getStatusCode()) {
                400 => throw new InvalidPetIdException('Invalid ID supplied.'),
                404 => throw new PetNotFoundException('Pet not found.'),
                default => throw new ApiRequestFailedException('API request failed with status ' . $response->getStatusCode())
            };
        }
    }
}