<?php

namespace App\Services\CakeService;

use App\Models\Cake;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CakeService implements CakeServiceContract
{
    /**
     * @var Cake
     */
    protected $cake;

    /**
     * @param Cake $cake
     */
    public function __construct(Cake $cake)
    {
        $this->cake = $cake;
    }

    /**
     * @return Cake[]|Collection
     */
    public function getCakes(): Collection
    {
        return $this->cake::all();
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function storeCake(array $attributes): Cake
    {
        return $this->cake::create($attributes);
    }

    /**
     * @param int $id
     * @return Cake
     */
    public function getCake(int $id): Cake
    {
        if ($cake = $this->cake::find($id)) {
            return $cake;
        }

        throw new ModelNotFoundException("Cake not found.", 404);
    }

    /**
     * @param array $attributes
     * @param int $id
     * @return Cake
     */
    public function updateCake(array $attributes, int $id): Cake
    {
        $cake = $this->getCake($id);
        $cake->update($attributes);
        return $cake->fresh();
    }

    /**
     * @param int $id
     * @return bool
     * @throws Exception
     */
    public function deleteCake(int $id): bool
    {
        $cake = $this->getCake($id);

        if (! $cake->interested()->where('cake_id', $cake->id)->first()) {
            return $cake->delete();
        }

        throw new Exception("Este bolo não pode ser excluído pois há uma lista de clientes interessados. Entre em contato com o Administrador.", 400);
    }
}