<?php
/*
 * space-tactics-php8
 * Planet.php | 1/27/23, 11:02 PM
 * Copyright (C)  2023 ShaoKhan
 *
 * This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with this program. If not, see <https://www.gnu.org/licenses/>.
 */

namespace App\Entity;

use App\Repository\PlanetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlanetRepository::class)]
#[ORM\Table(name: "planet")]
class Planet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = NULL;

    #[ORM\Column(length: 255)]
    private ?string $user_uuid = NULL;

    #[ORM\Column(length: 255)]
    private ?string $name = NULL;

    #[ORM\Column]
    private ?int $universe = NULL;

    #[ORM\Column]
    private ?int $system_x = NULL;

    #[ORM\Column]
    private ?int $system_y = NULL;

    #[ORM\Column]
    private ?int $system_z = NULL;

    #[ORM\Column]
    private ?int $type = NULL;

    #[ORM\Column(type: Types::SMALLINT, nullable: TRUE)]
    private ?int $destroyed = NULL;

    #[ORM\Column(nullable: TRUE)]
    private ?float $metal = NULL;

    #[ORM\Column(nullable: TRUE)]
    private ?float $metal_max = NULL;

    #[ORM\Column(nullable: TRUE)]
    private ?float $crystal = NULL;

    #[ORM\Column(nullable: TRUE)]
    private ?float $crystal_max = NULL;

    #[ORM\Column(nullable: TRUE)]
    private ?float $deuterium = NULL;

    #[ORM\Column(nullable: TRUE)]
    private ?float $deuterium_max = NULL;

    #[ORM\Column(nullable: TRUE)]
    #[ORM\OneToMany(mappedBy: "building_id", targetEntity: "App\Entity\PlanetBuilding")]
    #[ORM\JoinColumn(name: 'metal_building', referencedColumnName: 'building_id')]
    private ?int $metal_building = NULL;

    #[ORM\Column(nullable: TRUE)]
    #[ORM\OneToMany(mappedBy: "building_id", targetEntity: "App\Entity\PlanetBuilding")]
    #[ORM\JoinColumn(name: 'crystal_building', referencedColumnName: 'building_id')]
    private ?int $crystal_building = NULL;

    #[ORM\Column(nullable: TRUE)]
    #[ORM\OneToMany(mappedBy: "building_id", targetEntity: "App\Entity\PlanetBuilding")]
    #[ORM\JoinColumn(name: 'deuterium_building', referencedColumnName: 'building_id')]
    private ?int $deuterium_building = NULL;

    #[ORM\Column(nullable: TRUE)]
    #[ORM\OneToMany(mappedBy: "building_id", targetEntity: "App\Entity\PlanetBuilding")]
    #[ORM\JoinColumn(name: 'metal_building', referencedColumnName: 'building_id')]
    private ?int $solar_building = NULL;

    #[ORM\Column(nullable: TRUE)]
    #[ORM\OneToMany(mappedBy: "building_id", targetEntity: "App\Entity\PlanetBuilding")]
    #[ORM\JoinColumn(name: 'nuclear_building', referencedColumnName: 'building_id')]
    private ?int $nuclear_building = NULL;

    #[ORM\Column(nullable: TRUE)]
    #[ORM\OneToMany(mappedBy: "building_id", targetEntity: "App\Entity\PlanetBuilding")]
    #[ORM\JoinColumn(name: 'robot_building', referencedColumnName: 'building_id')]
    private ?int $robot_building = NULL;

    #[ORM\Column(nullable: TRUE)]
    #[ORM\OneToMany(mappedBy: "building_id", targetEntity: "App\Entity\PlanetBuilding")]
    #[ORM\JoinColumn(name: 'nanite_building', referencedColumnName: 'building_id')]
    private ?int $nanite_building = NULL;

    #[ORM\Column(nullable: TRUE)]
    #[ORM\OneToMany(mappedBy: "building_id", targetEntity: "App\Entity\PlanetBuilding")]
    #[ORM\JoinColumn(name: 'hangar_building', referencedColumnName: 'building_id')]
    private ?int $hangar_building = NULL;

    #[ORM\Column(nullable: TRUE)]
    #[ORM\OneToMany(mappedBy: "building_id", targetEntity: "App\Entity\PlanetBuilding")]
    #[ORM\JoinColumn(name: 'metalstorage_building', referencedColumnName: 'building_id')]
    private ?int $metalstorage_building = NULL;

    #[ORM\Column(nullable: TRUE)]
    #[ORM\OneToMany(mappedBy: "building_id", targetEntity: "App\Entity\PlanetBuilding")]
    #[ORM\JoinColumn(name: 'crystalstorage_building', referencedColumnName: 'building_id')]
    private ?int $crystalstorage_building = NULL;

    #[ORM\Column(nullable: TRUE)]
    #[ORM\OneToMany(mappedBy: "building_id", targetEntity: "App\Entity\PlanetBuilding")]
    #[ORM\JoinColumn(name: 'deuteriumstorage_building', referencedColumnName: 'building_id')]
    private ?int $deuteriumstorage_building = NULL;

    #[ORM\Column(nullable: TRUE)]
    #[ORM\OneToMany(mappedBy: "building_id", targetEntity: "App\Entity\PlanetBuilding")]
    #[ORM\JoinColumn(name: 'metal_building', referencedColumnName: 'building_id')]
    private ?int $laboratory_building = NULL;

    #[ORM\Column(nullable: TRUE)]
    #[ORM\OneToMany(mappedBy: "building_id", targetEntity: "App\Entity\PlanetBuilding")]
    #[ORM\JoinColumn(name: 'university_building', referencedColumnName: 'building_id')]
    private ?int $university_building = NULL;

    #[ORM\Column(nullable: TRUE)]
    #[ORM\OneToMany(mappedBy: "building_id", targetEntity: "App\Entity\PlanetBuilding")]
    #[ORM\JoinColumn(name: 'alliancehangar_building', referencedColumnName: 'building_id')]
    private ?int $alliancehangar_building = NULL;

    #[ORM\Column(nullable: TRUE)]
    #[ORM\OneToMany(mappedBy: "building_id", targetEntity: "App\Entity\PlanetBuilding")]
    #[ORM\JoinColumn(name: 'missilesilo_building', referencedColumnName: 'building_id')]
    private ?int $missilesilo_building = NULL;

    #[ORM\Column(nullable: TRUE)]
    private ?int $missilelauncher_defense = NULL;

    #[ORM\Column(nullable: TRUE)]
    private ?int $phalanx_defense = NULL;

    #[ORM\Column(nullable: TRUE)]
    private ?int $smalllaser_defense = NULL;

    #[ORM\Column(nullable: TRUE)]
    private ?int $biglaser_defense = NULL;

    #[ORM\Column(nullable: TRUE)]
    private ?int $gausscannon_defense = NULL;

    #[ORM\Column(nullable: TRUE)]
    private ?int $ioncannon_defense = NULL;

    #[ORM\Column(nullable: TRUE)]
    private ?int $plasmacannon_defense = NULL;

    #[ORM\Column(nullable: TRUE)]
    private ?int $smallshield_defense = NULL;

    #[ORM\Column(nullable: TRUE)]
    private ?int $bigshield_defense = NULL;

    #[ORM\Column(nullable: TRUE)]
    private ?int $planetshield_defense = NULL;

    #[ORM\Column(nullable: TRUE)]
    private ?int $gravitoncannon_defense = NULL;

    #[ORM\Column(nullable: TRUE)]
    private ?int $interceptormissile_defense = NULL;

    #[ORM\Column(nullable: TRUE)]
    private ?int $orbitaldefenseplatform_defense = NULL;

    #[ORM\Column(nullable: TRUE)]
    private ?int $smalltransportship_ship = NULL;

    #[ORM\Column(nullable: TRUE)]
    private ?int $bigtransportship_ship = NULL;

    #[ORM\Column(nullable: TRUE)]
    private ?int $lighthunter_ship = NULL;

    #[ORM\Column(nullable: TRUE)]
    private ?int $heavyhunter_ship = NULL;

    #[ORM\Column(nullable: TRUE)]
    private ?int $cruiser_ship = NULL;

    #[ORM\Column(nullable: TRUE)]
    private ?int $battleship_ship = NULL;

    #[ORM\Column(nullable: TRUE)]
    private ?int $colonyship_ship = NULL;

    #[ORM\Column(nullable: TRUE)]
    private ?int $smallrecycler_ship = NULL;

    #[ORM\Column(nullable: TRUE)]
    private ?int $mediumrecycler_ship = NULL;

    #[ORM\Column(nullable: TRUE)]
    private ?int $bigrecycler_ship = NULL;

    #[ORM\Column(nullable: TRUE)]
    private ?int $spyprobe_ship = NULL;

    #[ORM\Column(nullable: TRUE)]
    private ?int $bomber_ship = NULL;

    #[ORM\Column(nullable: TRUE)]
    private ?int $solarsatellite_ship = NULL;

    #[ORM\Column(nullable: TRUE)]
    private ?int $destroyer_ship = NULL;

    #[ORM\Column(nullable: TRUE)]
    private ?int $deathstar_ship = NULL;

    #[ORM\Column(nullable: TRUE)]
    private ?int $battlecruiser_ship = NULL;

    #[ORM\Column(nullable: TRUE)]
    private ?int $lunenoire_ship = NULL;

    #[ORM\Column(nullable: TRUE)]
    private ?int $evolutiontransporter_ship = NULL;

    #[ORM\Column(nullable: TRUE)]
    private ?int $gigarecycler_ship = NULL;

    #[ORM\Column(nullable: TRUE)]
    private ?int $dmcollector_ship = NULL;

    #[ORM\Column(nullable: TRUE)]
    private ?float $darkmatter = NULL;

    #[ORM\Column(length: 255, unique: TRUE)]
    private ?string $slug = NULL;

    #[ORM\Column]
    private ?int $terraforming_building = null;

    #[ORM\Column]
    private ?int $moonbase_building = null;

    #[ORM\Column]
    private ?int $jumpgate_building = null;

    #[ORM\Column]
    private ?int $laserphalanx_building = null;

    #[ORM\OneToMany(mappedBy: 'planet_id', targetEntity: PlanetBuilding::class)]
    private Collection $planetBuildings;

    public function __construct()
    {
        $this->planetBuildings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserUuid(): ?string
    {
        return $this->user_uuid;
    }

    public function setUserUuid(string $user_uuid): self
    {
        $this->user_uuid = $user_uuid;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getUniverse(): ?int
    {
        return $this->universe;
    }

    public function setUniverse(int $universe): self
    {
        $this->universe = $universe;

        return $this;
    }

    public function getSystemX(): ?int
    {
        return $this->system_x;
    }

    public function setSystemX(int $system_x): self
    {
        $this->system_x = $system_x;

        return $this;
    }

    public function getSystemY(): ?int
    {
        return $this->system_y;
    }

    public function setSystemY(int $system_y): self
    {
        $this->system_y = $system_y;

        return $this;
    }

    public function getSystemZ(): ?int
    {
        return $this->system_z;
    }

    public function setSystemZ(int $system_z): self
    {
        $this->system_z = $system_z;

        return $this;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(int $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getDestroyed(): ?int
    {
        return $this->destroyed;
    }

    public function setDestroyed(?int $destroyed): self
    {
        $this->destroyed = $destroyed;

        return $this;
    }

    public function getMetal(): ?float
    {
        return $this->metal;
    }

    public function setMetal(?float $metal): self
    {
        $this->metal = $metal;

        return $this;
    }

    public function getMetalMax(): ?float
    {
        return $this->metal_max;
    }

    public function setMetalMax(?float $metal_max): self
    {
        $this->metal_max = $metal_max;

        return $this;
    }

    public function getCrystal(): ?float
    {
        return $this->crystal;
    }

    public function setCrystal(?float $crystal): self
    {
        $this->crystal = $crystal;

        return $this;
    }

    public function getCrystalMax(): ?float
    {
        return $this->crystal_max;
    }

    public function setCrystalMax(?float $crystal_max): self
    {
        $this->crystal_max = $crystal_max;

        return $this;
    }

    public function getDeuterium(): ?float
    {
        return $this->deuterium;
    }

    public function setDeuterium(?float $deuterium): self
    {
        $this->deuterium = $deuterium;

        return $this;
    }

    public function getDeuteriumMax(): ?float
    {
        return $this->deuterium_max;
    }

    public function setDeuteriumMax(?float $deuterium_max): self
    {
        $this->deuterium_max = $deuterium_max;

        return $this;
    }

    public function getMissilelauncherDefense(): ?int
    {
        return $this->missilelauncher_defense;
    }

    public function setMissilelauncherDefense(?int $missilelauncher_defense): self
    {
        $this->missilelauncher_defense = $missilelauncher_defense;

        return $this;
    }

    public function getPhalanxDefense(): ?int
    {
        return $this->phalanx_defense;
    }

    public function setPhalanxDefense(?int $phalanx_defense): self
    {
        $this->phalanx_defense = $phalanx_defense;

        return $this;
    }

    public function getSmalllaserDefense(): ?int
    {
        return $this->smalllaser_defense;
    }

    public function setSmalllaserDefense(?int $smalllaser_defense): self
    {
        $this->smalllaser_defense = $smalllaser_defense;

        return $this;
    }

    public function getBiglaserDefense(): ?int
    {
        return $this->biglaser_defense;
    }

    public function setBiglaserDefense(?int $biglaser_defense): self
    {
        $this->biglaser_defense = $biglaser_defense;

        return $this;
    }

    public function getGausscannonDefense(): ?int
    {
        return $this->gausscannon_defense;
    }

    public function setGausscannonDefense(?int $gausscannon_defense): self
    {
        $this->gausscannon_defense = $gausscannon_defense;

        return $this;
    }

    public function getIoncannonDefense(): ?int
    {
        return $this->ioncannon_defense;
    }

    public function setIoncannonDefense(?int $ioncannon_defense): self
    {
        $this->ioncannon_defense = $ioncannon_defense;

        return $this;
    }

    public function getPlasmacannonDefense(): ?int
    {
        return $this->plasmacannon_defense;
    }

    public function setPlasmacannonDefense(?int $plasmacannon_defense): self
    {
        $this->plasmacannon_defense = $plasmacannon_defense;

        return $this;
    }

    public function getSmallshieldDefense(): ?int
    {
        return $this->smallshield_defense;
    }

    public function setSmallshieldDefense(?int $smallshield_defense): self
    {
        $this->smallshield_defense = $smallshield_defense;

        return $this;
    }

    public function getBigshieldDefense(): ?int
    {
        return $this->bigshield_defense;
    }

    public function setBigshieldDefense(?int $bigshield_defense): self
    {
        $this->bigshield_defense = $bigshield_defense;

        return $this;
    }

    public function getPlanetshieldDefense(): ?int
    {
        return $this->planetshield_defense;
    }

    public function setPlanetshieldDefense(?int $planetshield_defense): self
    {
        $this->planetshield_defense = $planetshield_defense;

        return $this;
    }

    public function getGravitoncannonDefense(): ?int
    {
        return $this->gravitoncannon_defense;
    }

    public function setGravitoncannonDefense(?int $gravitoncannon_defense): self
    {
        $this->gravitoncannon_defense = $gravitoncannon_defense;

        return $this;
    }

    public function getInterceptormissileDefense(): ?int
    {
        return $this->interceptormissile_defense;
    }

    public function setInterceptormissileDefense(?int $interceptormissile_defense): self
    {
        $this->interceptormissile_defense = $interceptormissile_defense;

        return $this;
    }

    public function getOrbitaldefenseplatformDefense(): ?int
    {
        return $this->orbitaldefenseplatform_defense;
    }

    public function setOrbitaldefenseplatformDefense(?int $orbitaldefenseplatform_defense): self
    {
        $this->orbitaldefenseplatform_defense = $orbitaldefenseplatform_defense;

        return $this;
    }

    public function getSmalltransportshipShip(): ?int
    {
        return $this->smalltransportship_ship;
    }

    public function setSmalltransportshipShip(?int $smalltransportship_ship): self
    {
        $this->smalltransportship_ship = $smalltransportship_ship;

        return $this;
    }

    public function getBigtransportshipShip(): ?int
    {
        return $this->bigtransportship_ship;
    }

    public function setBigtransportshipShip(?int $bigtransportship_ship): self
    {
        $this->bigtransportship_ship = $bigtransportship_ship;

        return $this;
    }

    public function getLighthunterShip(): ?int
    {
        return $this->lighthunter_ship;
    }

    public function setLighthunterShip(?int $lighthunter_ship): self
    {
        $this->lighthunter_ship = $lighthunter_ship;

        return $this;
    }

    public function getHeavyhunterShip(): ?int
    {
        return $this->heavyhunter_ship;
    }

    public function setHeavyhunterShip(?int $heavyhunter_ship): self
    {
        $this->heavyhunter_ship = $heavyhunter_ship;

        return $this;
    }

    public function getCruiserShip(): ?int
    {
        return $this->cruiser_ship;
    }

    public function setCruiserShip(?int $cruiser_ship): self
    {
        $this->cruiser_ship = $cruiser_ship;

        return $this;
    }

    public function getBattleshipShip(): ?int
    {
        return $this->battleship_ship;
    }

    public function setBattleshipShip(?int $battleship_ship): self
    {
        $this->battleship_ship = $battleship_ship;

        return $this;
    }

    public function getColonyshipShip(): ?int
    {
        return $this->colonyship_ship;
    }

    public function setColonyshipShip(?int $colonyship_ship): self
    {
        $this->colonyship_ship = $colonyship_ship;

        return $this;
    }

    public function getSmallrecyclerShip(): ?int
    {
        return $this->smallrecycler_ship;
    }

    public function setSmallrecyclerShip(?int $smallrecycler_ship): self
    {
        $this->smallrecycler_ship = $smallrecycler_ship;

        return $this;
    }

    public function getMediumrecyclerShip(): ?int
    {
        return $this->mediumrecycler_ship;
    }

    public function setMediumrecyclerShip(?int $mediumrecycler_ship): self
    {
        $this->mediumrecycler_ship = $mediumrecycler_ship;

        return $this;
    }

    public function getBigrecyclerShip(): ?int
    {
        return $this->bigrecycler_ship;
    }

    public function setBigrecyclerShip(?int $bigrecycler_ship): self
    {
        $this->bigrecycler_ship = $bigrecycler_ship;

        return $this;
    }

    public function getSpyprobeShip(): ?int
    {
        return $this->spyprobe_ship;
    }

    public function setSpyprobeShip(?int $spyprobe_ship): self
    {
        $this->spyprobe_ship = $spyprobe_ship;

        return $this;
    }

    public function getBomberShip(): ?int
    {
        return $this->bomber_ship;
    }

    public function setBomberShip(?int $bomber_ship): self
    {
        $this->bomber_ship = $bomber_ship;

        return $this;
    }

    public function getSolarsatelliteShip(): ?int
    {
        return $this->solarsatellite_ship;
    }

    public function setSolarsatelliteShip(?int $solarsatellite_ship): self
    {
        $this->solarsatellite_ship = $solarsatellite_ship;

        return $this;
    }

    public function getDestroyerShip(): ?int
    {
        return $this->destroyer_ship;
    }

    public function setDestroyerShip(?int $destroyer_ship): self
    {
        $this->destroyer_ship = $destroyer_ship;

        return $this;
    }

    public function getDeathstarShip(): ?int
    {
        return $this->deathstar_ship;
    }

    public function setDeathstarShip(?int $deathstar_ship): self
    {
        $this->deathstar_ship = $deathstar_ship;

        return $this;
    }

    public function getBattlecruiserShip(): ?int
    {
        return $this->battlecruiser_ship;
    }

    public function setBattlecruiserShip(?int $battlecruiser_ship): self
    {
        $this->battlecruiser_ship = $battlecruiser_ship;

        return $this;
    }

    public function getLunenoireShip(): ?int
    {
        return $this->lunenoire_ship;
    }

    public function setLunenoireShip(?int $lunenoire_ship): self
    {
        $this->lunenoire_ship = $lunenoire_ship;

        return $this;
    }

    public function getEvolutiontransporterShip(): ?int
    {
        return $this->evolutiontransporter_ship;
    }

    public function setEvolutiontransporterShip(?int $evolutiontransporter_ship): self
    {
        $this->evolutiontransporter_ship = $evolutiontransporter_ship;

        return $this;
    }

    public function getGigarecyclerShip(): ?int
    {
        return $this->gigarecycler_ship;
    }

    public function setGigarecyclerShip(?int $gigarecycler_ship): self
    {
        $this->gigarecycler_ship = $gigarecycler_ship;

        return $this;
    }

    public function getDmcollectorShip(): ?int
    {
        return $this->dmcollector_ship;
    }

    public function setDmcollectorShip(?int $dmcollector_ship): self
    {
        $this->dmcollector_ship = $dmcollector_ship;

        return $this;
    }

    public function getDarkmatter(): ?float
    {
        return $this->darkmatter;
    }

    public function setDarkmatter(?float $darkmatter): self
    {
        $this->darkmatter = $darkmatter;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getAllBuildings(): array
    {
        $buildings[1] = ['name' => 'metal_building', 'level' => $this->getMetalBuilding()];
        $buildings[2] = ['name' => 'crystal_building', 'level' => $this->getCrystalBuilding()];
        $buildings[3]  = ['name' => 'deuterium_building', 'level' => $this->getDeuteriumBuilding()];
        $buildings[4]  = ['name' => 'solar_building', 'level' => $this->getSolarBuilding()];
        $buildings[5]  = ['name' => 'university_building', 'level' => $this->getLaboratoryBuilding()];
        $buildings[6]  = ['name' => 'nuclear_building', 'level' => $this->getUniversityBuilding()];
        $buildings[7]  = ['name' => 'robot_building', 'level' => $this->getNuclearBuilding()];
        $buildings[8]  = ['name' => 'nanite_building', 'level' => $this->getRobotBuilding()];
        $buildings[9]  = ['name' => 'hangar_building', 'level' => $this->getNaniteBuilding()];
        $buildings[10]  = ['name' => 'metalstorage_building', 'level' => $this->getHangarBuilding()];
        $buildings[11]  = ['name' => 'crystalstorage_building', 'level' => $this->getMetalstorageBuilding()];
        $buildings[12]  = ['name' => 'deuteriumstorage_building', 'level' => $this->getCrystalstorageBuilding()];
        $buildings[13]  = ['name' => 'laboratory_building', 'level' => $this->getDeuteriumstorageBuilding()];
        $buildings[15]  = ['name' => 'alliancehangar_building', 'level' => $this->getAlliancehangarBuilding()];
        $buildings[17]  = ['name' => 'missilesilo_building', 'level' => $this->getMissilesiloBuilding()];

        return $buildings;
    }

    public function getMetalBuilding(): ?int
    {
        return $this->metal_building;
    }

    public function setMetalBuilding(?int $metal_building): self
    {
        $this->metal_building = $metal_building;

        return $this;
    }

    public function getCrystalBuilding(): ?int
    {
        return $this->crystal_building;
    }

    public function setCrystalBuilding(?int $crystal_building): self
    {
        $this->crystal_building = $crystal_building;

        return $this;
    }

    public function getDeuteriumBuilding(): ?int
    {
        return $this->deuterium_building;
    }

    public function setDeuteriumBuilding(?int $deuterium_building): self
    {
        $this->deuterium_building = $deuterium_building;

        return $this;
    }

    public function getSolarBuilding(): ?int
    {
        return $this->solar_building;
    }

    public function setSolarBuilding(?int $solar_building): self
    {
        $this->solar_building = $solar_building;

        return $this;
    }

    public function getLaboratoryBuilding(): ?int
    {
        return $this->laboratory_building;
    }

    public function setLaboratoryBuilding(?int $laboratory_building): self
    {
        $this->laboratory_building = $laboratory_building;

        return $this;
    }

    public function getUniversityBuilding(): ?int
    {
        return $this->university_building;
    }

    public function setUniversityBuilding(?int $university_building): self
    {
        $this->university_building = $university_building;

        return $this;
    }

    public function getNuclearBuilding(): ?int
    {
        return $this->nuclear_building;
    }

    public function setNuclearBuilding(?int $nuclear_building): self
    {
        $this->nuclear_building = $nuclear_building;

        return $this;
    }

    public function getRobotBuilding(): ?int
    {
        return $this->robot_building;
    }

    public function setRobotBuilding(?int $robot_building): self
    {
        $this->robot_building = $robot_building;

        return $this;
    }

    public function getNaniteBuilding(): ?int
    {
        return $this->nanite_building;
    }

    public function setNaniteBuilding(?int $nanite_building): self
    {
        $this->nanite_building = $nanite_building;

        return $this;
    }

    public function getHangarBuilding(): ?int
    {
        return $this->hangar_building;
    }

    public function setHangarBuilding(?int $hangar_building): self
    {
        $this->hangar_building = $hangar_building;

        return $this;
    }

    public function getMetalstorageBuilding(): ?int
    {
        return $this->metalstorage_building;
    }

    public function setMetalstorageBuilding(?int $metalstorage_building): self
    {
        $this->metalstorage_building = $metalstorage_building;

        return $this;
    }

    public function getCrystalstorageBuilding(): ?int
    {
        return $this->crystalstorage_building;
    }

    public function setCrystalstorageBuilding(?int $crystalstorage_building): self
    {
        $this->crystalstorage_building = $crystalstorage_building;

        return $this;
    }

    public function getDeuteriumstorageBuilding(): ?int
    {
        return $this->deuteriumstorage_building;
    }

    public function setDeuteriumstorageBuilding(?int $deuteriumstorage_building): self
    {
        $this->deuteriumstorage_building = $deuteriumstorage_building;

        return $this;
    }

    public function getAlliancehangarBuilding(): ?int
    {
        return $this->alliancehangar_building;
    }

    public function setAlliancehangarBuilding(?int $alliancehangar_building): self
    {
        $this->alliancehangar_building = $alliancehangar_building;

        return $this;
    }

    public function getMissilesiloBuilding(): ?int
    {
        return $this->missilesilo_building;
    }

    public function setMissilesiloBuilding(?int $missilesilo_building): self
    {
        $this->missilesilo_building = $missilesilo_building;

        return $this;
    }

    public function getTerraformingBuilding(): ?int
    {
        return $this->terraforming_building;
    }

    public function setTerraformingBuilding(int $terraforming_building): self
    {
        $this->terraforming_building = $terraforming_building;

        return $this;
    }

    public function getMoonbaseBuilding(): ?int
    {
        return $this->moonbase_building;
    }

    public function setMoonbaseBuilding(int $moonbase_building): self
    {
        $this->moonbase_building = $moonbase_building;

        return $this;
    }

    public function getJumpgateBuuilding(): ?int
    {
        return $this->jumpgate_buuilding;
    }

    public function setJumpgateBuuilding(int $jumpgate_buuilding): self
    {
        $this->jumpgate_buuilding = $jumpgate_buuilding;

        return $this;
    }

    public function getLaserphalanxBuilding(): ?int
    {
        return $this->laserphalanx_building;
    }

    public function setLaserphalanxBuilding(int $laserphalanx_building): self
    {
        $this->laserphalanx_building = $laserphalanx_building;

        return $this;
    }

    public function getPlanetType(): ?int
    {
        return $this->planet_type;
    }

    public function setPlanetType(int $planet_type): self
    {
        $this->planet_type = $planet_type;

        return $this;
    }

    public function getPlantType(): ?PlanetType
    {
        return $this->plant_type;
    }

    public function setPlantType(PlanetType $plant_type): self
    {
        $this->plant_type = $plant_type;

        return $this;
    }

    /**
     * @return Collection<int, PlanetBuilding>
     */
    public function getPlanetBuildings(): Collection
    {
        return $this->planetBuildings;
    }

    public function addPlanetBuilding(PlanetBuilding $planetBuilding): self
    {
        if (!$this->planetBuildings->contains($planetBuilding)) {
            $this->planetBuildings->add($planetBuilding);
            $planetBuilding->setPlanetId($this);
        }

        return $this;
    }

    public function removePlanetBuilding(PlanetBuilding $planetBuilding): self
    {
        if ($this->planetBuildings->removeElement($planetBuilding)) {
            // set the owning side to null (unless already changed)
            if ($planetBuilding->getPlanetId() === $this) {
                $planetBuilding->setPlanetId(null);
            }
        }

        return $this;
    }
}
