<?php
namespace App\Repository\Core;

use App\Model\Core\Gare;

class GareRepository
{
    /**
     * @var Gare
     */
    private $gare;

    /**
     * GareRepository constructor.
     * @param Gare $gare
     */

    public function __construct(Gare $gare)
    {
        $this->gare = $gare;
    }

    public function create($gare_alias_libelle_noncontraint)
    {
        return $this->gare->newQuery()
            ->create([
                "name" => $gare_alias_libelle_noncontraint,
            ]);
    }

    public function search($get)
    {
        return $this->gare->newQuery()
            ->where('name', 'like', '%'.$get.'%')
            ->first();
    }

}

