<?php
declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePetRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'photoUrls' => 'required|array',
            'photoUrls.*' =>  'required|string|url',
            'status' => 'required|string'
        ];
    }
}