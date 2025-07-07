<?php
declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeletePetRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'id' => 'required|int'
        ];
    }
}