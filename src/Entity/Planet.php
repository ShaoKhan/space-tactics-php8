<?php

namespace App\Entity;

use App\Repository\PlanetRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlanetRepository::class)]
class Planet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $user_uuid = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $universe = null;

    #[ORM\Column]
    private ?int $system_x = null;

    #[ORM\Column]
    private ?int $system_y = null;

    #[ORM\Column]
    private ?int $system_z = null;

    #[ORM\Column]
    private ?int $type = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $destroyed = null;

    #[ORM\Column(nullable: true)]
    private ?float $metal = null;

    #[ORM\Column(nullable: true)]
    private ?float $metal_max = null;

    #[ORM\Column(nullable: true)]
    private ?float $crystal = null;

    #[ORM\Column(nullable: true)]
    private ?float $crystal_max = null;

    #[ORM\Column(nullable: true)]
    private ?float $deuterium = null;

    #[ORM\Column(nullable: true)]
    private ?float $deuterium_max = null;

    #[ORM\Column(nullable: true)]
    private ?int $metal_building = null;

    #[ORM\Column(nullable: true)]
    private ?int $crystal_building = null;

    #[ORM\Column(nullable: true)]
    private ?int $deuterium_building = null;

    #[ORM\Column(nullable: true)]
    private ?int $solar_building = null;

    #[ORM\Column(nullable: true)]
    private ?int $nuclear_building = null;

    #[ORM\Column(nullable: true)]
    private ?int $robot_building = null;

    #[ORM\Column(nullable: true)]
    private ?int $nanite_building = null;

    #[ORM\Column(nullable: true)]
    private ?int $hangar_building = null;

    #[ORM\Column(nullable: true)]
    private ?int $metalstorage_building = null;

    #[ORM\Column(nullable: true)]
    private ?int $crystalstorage_building = null;

    #[ORM\Column(nullable: true)]
    private ?int $deuteriumstorage_building = null;

    #[ORM\Column(nullable: true)]
    private ?int $laboratory_building = null;

    #[ORM\Column(nullable: true)]
    private ?int $university_building = null;

    #[ORM\Column(nullable: true)]
    private ?int $alliancehangar_building = null;

    #[ORM\Column(nullable: true)]
    private ?int $missilesilo_building = null;

    #[ORM\Column(nullable: true)]
    private ?int $missilelauncher_defense = null;

    #[ORM\Column(nullable: true)]
    private ?int $phalanx_defense = null;

    #[ORM\Column(nullable: true)]
    private ?int $smalllaser_defense = null;

    #[ORM\Column(nullable: true)]
    private ?int $biglaser_defense = null;

    #[ORM\Column(nullable: true)]
    private ?int $gausscannon_defense = null;

    #[ORM\Column(nullable: true)]
    private ?int $ioncannon_defense = null;

    #[ORM\Column(nullable: true)]
    private ?int $plasmacannon_defense = null;

    #[ORM\Column(nullable: true)]
    private ?int $smallshield_defense = null;

    #[ORM\Column(nullable: true)]
    private ?int $bigshield_defense = null;

    #[ORM\Column(nullable: true)]
    private ?int $planetshield_defense = null;

    #[ORM\Column(nullable: true)]
    private ?int $gravitoncannon_defense = null;

    #[ORM\Column(nullable: true)]
    private ?int $interceptormissile_defense = null;

    #[ORM\Column(nullable: true)]
    private ?int $orbitaldefenseplatform_defense = null;

    #[ORM\Column(nullable: true)]
    private ?int $smalltransportship_ship = null;

    #[ORM\Column(nullable: true)]
    private ?int $bigtransportship_ship = null;

    #[ORM\Column(nullable: true)]
    private ?int $lighthunter_ship = null;

    #[ORM\Column(nullable: true)]
    private ?int $heavyhunter_ship = null;

    #[ORM\Column(nullable: true)]
    private ?int $cruiser_ship = null;

    #[ORM\Column(nullable: true)]
    private ?int $battleship_ship = null;

    #[ORM\Column(nullable: true)]
    private ?int $colonyship_ship = null;

    #[ORM\Column(nullable: true)]
    private ?int $smallrecycler_ship = null;

    #[ORM\Column(nullable: true)]
    private ?int $mediumrecycler_ship = null;

    #[ORM\Column(nullable: true)]
    private ?int $bigrecycler_ship = null;

    #[ORM\Column(nullable: true)]
    private ?int $spyprobe_ship = null;

    #[ORM\Column(nullable: true)]
    private ?int $bomber_ship = null;

    #[ORM\Column(nullable: true)]
    private ?int $solarsatellite_ship = null;

    #[ORM\Column(nullable: true)]
    private ?int $destroyer_ship = null;

    #[ORM\Column(nullable: true)]
    private ?int $deathstar_ship = null;

    #[ORM\Column(nullable: true)]
    private ?int $battlecruiser_ship = null;

    #[ORM\Column(nullable: true)]
    private ?int $lunenoire_ship = null;

    #[ORM\Column(nullable: true)]
    private ?int $evolutiontransporter_ship = null;

    #[ORM\Column(nullable: true)]
    private ?int $gigarecycler_ship = null;

    #[ORM\Column(nullable: true)]
    private ?int $dmcollector_ship = null;

    #[ORM\Column(nullable: true)]
    private ?float $darkmatter = null;

    #[ORM\Column(length: 255, unique: true)]
    private ?string $slug = null;

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
}
