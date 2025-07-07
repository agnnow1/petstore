<?php
declare(strict_types=1);

namespace App\Dto;

class Pet
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly array $photoUrls,
        public readonly string $status
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'],
            name: $data['name'] ?? 'No name',
            photoUrls: $data['photoUrls'] ?? [],
            status: $data['status']
        );
    }
}