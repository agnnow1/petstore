<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Actions\Pet\CreatePet;
use App\Actions\Pet\DeletePet;
use App\Actions\Pet\EditPet;
use App\Actions\Pet\FindPetById;
use App\Actions\Pet\FindPetByStatus;
use App\Exceptions\ApiValidationException;
use App\Exceptions\InvalidPetIdException;
use App\Exceptions\PetNotFoundException;
use App\Http\Requests\CreatePetRequest;
use App\Http\Requests\DeletePetRequest;
use App\Http\Requests\EditPetRequest;
use App\Http\Requests\FindByIdPetRequest;
use App\Http\Requests\FindByStatusPetRequest;

class PetController
{
    public function create()
    {
        return view('pets.create');
    }

    public function createPost(CreatePetRequest $request, CreatePet $createPet)
    {
        try {
            $petData = $request->validated();
            $pet = $createPet->execute($petData);

            return redirect()
                ->route('pets.edit', ['id' => $pet->id])
                ->with([
                    'success' => 'Pet created successfully.',
                    'pet_data' => $pet
                ]);
        } catch (\Exception $e) {
            return redirect()
                ->route('pets.create')
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    public function findByStatus(FindByStatusPetRequest $request, FindPetByStatus $findPetByStatus)
    {
        $status = $request->validated('status');

        $pets = $findPetByStatus->execute($status);

        return view('pets.results', compact('pets', 'status'));
    }

    public function findById(FindByIdPetRequest $request, FindPetById $findPetById)
    {
        $id = $request->validated('id');

        try {
            $pet = $findPetById->execute((int) $id);

            return redirect()
                ->route('pets.edit', ['id' => $pet->id])
                ->with([
                    'success' => 'Pet found.',
                    'pet_data' => $pet,
                ]);
        } catch (PetNotFoundException $e) {
            return redirect()
                ->route('home')
                ->with('error', $e->getMessage());
        } catch (\Exception $e) {
            return redirect()
                ->route('home')
                ->with('error', 'Something went wrong while fetching the pet.');
        }
    }

    public function edit(int $id, FindPetById $findPetById)
    {
        $pet = session('pet_data');

        if (!$pet) {
            try {
                $pet = $findPetById->execute($id);
            } catch (PetNotFoundException $e) {
                return redirect()->route('home')->with('error', 'Pet does not exist');
            }
        }

        return view('pets.edit', [
            'pet' => $pet,
        ]);
    }

    public function editPost(EditPetRequest $request, EditPet $editPet)
    {
        $petData = $request->validated();

        try {
            $pet = $editPet->execute($petData);

            return redirect()
                ->route('pets.edit', ['id' => $petData['id']])
                ->with([
                    'success' => 'Pet updated successfully.',
                    'pet_data' => $pet
                ]);
        } catch (ApiValidationException|InvalidPetIdException|PetNotFoundException $e) {
            $errorMessage = $e->getMessage();
        } catch (\Exception $e) {
            $errorMessage = 'Something went wrong while editing pet.';
        }

        return redirect()->route('home')->with('error', $errorMessage);

    }

    public function delete(DeletePetRequest $request, DeletePet $deletePet)
    {
        $id = $request->validated('id');

        try {
            $deletePet->execute((int) $id);
            return redirect()->route('home')->with('success', 'Pet deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('home')->with('error', 'Failed to delete pet.');
        }
    }
}