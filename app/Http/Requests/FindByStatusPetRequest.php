<?php
declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FindByStatusPetRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'status' => 'required|array',
            'status.*' => 'required|string',
        ];
    }
}
