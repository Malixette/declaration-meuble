<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OfficeTourisme
 *
 * @ORM\Table(name="office_tourisme")
 * @ORM\Entity
 */
class OfficeTourisme
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ot_referent_nom", type="string", length=255, nullable=true)
     */
    private $otReferentNom;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ot_referent_prénom", type="string", length=255, nullable=true)
     */
    private $otReferentPrénom;


}
