<?php

namespace App\Entity;

use App\Repository\UniRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UniRepository::class)]
class Uni
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = NULL;

    #[ORM\Column(nullable: TRUE)]
    private ?int $users_amount = NULL;

    #[ORM\Column]
    private ?float $game_speed = NULL;

    #[ORM\Column]
    private ?float $fleet_speed = NULL;

    #[ORM\Column]
    private ?int $resource_multiplier = NULL;

    #[ORM\Column]
    private ?int $storage_multiplier = NULL;

    #[ORM\Column(type: Types::SMALLINT, nullable: TRUE)]
    private ?int $message_delete_behavior = NULL;

    #[ORM\Column(type: Types::SMALLINT, nullable: TRUE)]
    private ?int $message_delete_days = NULL;

    #[ORM\Column(type: Types::SMALLINT, nullable: TRUE)]
    private ?int $halt_speed = NULL;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $fleet_cdr = NULL;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $def_in_tf = NULL;

    #[ORM\Column]
    private ?int $planet_fields = NULL;

    #[ORM\Column(length: 75)]
    private ?string $uni_name = NULL;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $uni_enabled = NULL;

    #[ORM\Column(type: Types::TEXT, nullable: TRUE)]
    private ?string $closed_text = NULL;

    #[ORM\Column]
    private ?int $metal_standard_income = NULL;

    #[ORM\Column]
    private ?int $crystal_standard_income = NULL;

    #[ORM\Column]
    private ?int $deuterium_standard_income = NULL;

    #[ORM\Column]
    private ?int $energy_standard_income = NULL;

    #[ORM\Column(type: Types::SMALLINT, nullable: TRUE)]
    private ?int $noob_protection = NULL;

    #[ORM\Column(nullable: TRUE)]
    private ?int $noob_protectiontime = NULL;

    #[ORM\Column(length: 255, nullable: TRUE)]
    private ?string $forum_url = NULL;

    #[ORM\Column(type: Types::SMALLINT, nullable: TRUE)]
    private ?int $admin_attackable = NULL;

    #[ORM\Column(length: 100, nullable: TRUE)]
    private ?string $language = NULL;

    #[ORM\Column(type: Types::SMALLINT, nullable: TRUE)]
    private ?int $teamspeak_mod = NULL;

    #[ORM\Column(length: 255, nullable: TRUE)]
    private ?string $teamspeak_server = NULL;

    #[ORM\Column(type: Types::SMALLINT, nullable: TRUE)]
    private ?int $teamspeak_tcp_port = NULL;

    #[ORM\Column(type: Types::SMALLINT, nullable: TRUE)]
    private ?int $teamspeak_udp_port = NULL;

    #[ORM\Column(type: Types::SMALLINT, nullable: TRUE)]
    private ?int $registration_closed = NULL;

    #[ORM\Column(length: 255, nullable: TRUE)]
    private ?string $welcome_text = NULL;

    #[ORM\Column(type: Types::SMALLINT, nullable: TRUE)]
    private ?int $min_build_time = NULL;

    #[ORM\Column(length: 255, nullable: TRUE)]
    private ?string $modules = NULL;

    #[ORM\Column(length: 255, nullable: TRUE)]
    private ?string $tradeable_ships = NULL;

    #[ORM\Column(nullable: TRUE)]
    private ?int $tradeable_ships_fee = NULL;

    #[ORM\Column]
    private ?int $galaxy_width = NULL;

    #[ORM\Column]
    private ?int $galaxy_height = NULL;

    #[ORM\Column]
    private ?int $galaxy_depth = NULL;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $max_construction_count = NULL;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $max_science_count = NULL;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $max_ship_count = NULL;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $max_start_planets_per_player = NULL;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $max_planets_astrophysics = NULL;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $max_planets_officers = NULL;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $max_planets_science = NULL;

    #[ORM\Column]
    private ?int $flight_deuterium_cost_per_click = NULL;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $max_dm_missions = NULL;

    #[ORM\Column]
    private ?int $max_resource_overflow = NULL;

    #[ORM\Column]
    private ?int $moon_chance_factor = NULL;

    #[ORM\Column]
    private ?int $moon_chance = NULL;

    #[ORM\Column]
    private ?int $trader_dm_cost = NULL;

    #[ORM\Column]
    private ?int $university_factor_science = NULL;

    #[ORM\Column]
    private ?int $max_fleets_per_association = NULL;

    #[ORM\Column(type: Types::SMALLINT, nullable: TRUE)]
    private ?int $delete_moon_debris = NULL;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $min_umode_time = NULL;

    #[ORM\Column]
    private ?int $gate_interval_time = NULL;

    #[ORM\Column]
    private ?int $start_metal = NULL;

    #[ORM\Column]
    private ?int $start_crystal = NULL;

    #[ORM\Column]
    private ?int $start_deuterium = NULL;

    #[ORM\Column]
    private ?int $start_dm = NULL;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $referal_active = NULL;

    #[ORM\Column]
    private ?int $referal_bonus_dm = NULL;

    #[ORM\Column]
    private ?int $referal_minpoints = NULL;

    #[ORM\Column]
    private ?int $referal_max_referals = NULL;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $del_user_manual = NULL;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $send_inavtive_mail = NULL;

    #[ORM\Column]
    private ?int $silo_size_factor = NULL;

    #[ORM\Column]
    private ?int $energy_factor = NULL;

    #[ORM\Column]
    private ?int $alliance_min_points = NULL;

    #[ORM\Column]
    private ?int $expedition_res_limit = NULL;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsersAmount(): ?int
    {
        return $this->users_amount;
    }

    public function setUsersAmount(int $users_amount): self
    {
        $this->users_amount = $users_amount;

        return $this;
    }

    public function getGameSpeed(): ?float
    {
        return $this->game_speed;
    }

    public function setGameSpeed(float $game_speed): self
    {
        $this->game_speed = $game_speed;

        return $this;
    }

    public function getFleetSpeed(): ?float
    {
        return $this->fleet_speed;
    }

    public function setFleetSpeed(float $fleet_speed): self
    {
        $this->fleet_speed = $fleet_speed;

        return $this;
    }

    public function getResourceMultiplier(): ?int
    {
        return $this->resource_multiplier;
    }

    public function setResourceMultiplier(int $resource_multiplier): self
    {
        $this->resource_multiplier = $resource_multiplier;

        return $this;
    }

    public function getStorageMultiplier(): ?int
    {
        return $this->storage_multiplier;
    }

    public function setStorageMultiplier(int $storage_multiplier): self
    {
        $this->storage_multiplier = $storage_multiplier;

        return $this;
    }

    public function getMessageDeleteBehavior(): ?int
    {
        return $this->message_delete_behavior;
    }

    public function setMessageDeleteBehavior(?int $message_delete_behavior): self
    {
        $this->message_delete_behavior = $message_delete_behavior;

        return $this;
    }

    public function getMessageDeleteDays(): ?int
    {
        return $this->message_delete_days;
    }

    public function setMessageDeleteDays(?int $message_delete_days): self
    {
        $this->message_delete_days = $message_delete_days;

        return $this;
    }

    public function getHaltSpeed(): ?int
    {
        return $this->halt_speed;
    }

    public function setHaltSpeed(?int $halt_speed): self
    {
        $this->halt_speed = $halt_speed;

        return $this;
    }

    public function getFleetCdr(): ?int
    {
        return $this->fleet_cdr;
    }

    public function setFleetCdr(int $fleet_cdr): self
    {
        $this->fleet_cdr = $fleet_cdr;

        return $this;
    }

    public function getDefInTf(): ?int
    {
        return $this->def_in_tf;
    }

    public function setDefInTf(int $def_in_tf): self
    {
        $this->def_in_tf = $def_in_tf;

        return $this;
    }

    public function getPlanetFields(): ?int
    {
        return $this->planet_fields;
    }

    public function setPlanetFields(int $planet_fields): self
    {
        $this->planet_fields = $planet_fields;

        return $this;
    }

    public function getUniName(): ?string
    {
        return $this->uni_name;
    }

    public function setUniName(string $uni_name): self
    {
        $this->uni_name = $uni_name;

        return $this;
    }

    public function getUniEnabled(): ?int
    {
        return $this->uni_enabled;
    }

    public function setUniEnabled(int $uni_enabled): self
    {
        $this->uni_enabled = $uni_enabled;

        return $this;
    }

    public function getClosedText(): ?string
    {
        return $this->closed_text;
    }

    public function setClosedText(?string $closed_text): self
    {
        $this->closed_text = $closed_text;

        return $this;
    }

    public function getMetalStandardIncome(): ?int
    {
        return $this->metal_standard_income;
    }

    public function setMetalStandardIncome(int $metal_standard_income): self
    {
        $this->metal_standard_income = $metal_standard_income;

        return $this;
    }

    public function getCrystalStandardIncome(): ?int
    {
        return $this->crystal_standard_income;
    }

    public function setCrystalStandardIncome(int $crystal_standard_income): self
    {
        $this->crystal_standard_income = $crystal_standard_income;

        return $this;
    }

    public function getDeuteriumStandardIncome(): ?int
    {
        return $this->deuterium_standard_income;
    }

    public function setDeuteriumStandardIncome(int $deuterium_standard_income): self
    {
        $this->deuterium_standard_income = $deuterium_standard_income;

        return $this;
    }

    public function getEnergyStandardIncome(): ?int
    {
        return $this->energy_standard_income;
    }

    public function setEnergyStandardIncome(int $energy_standard_income): self
    {
        $this->energy_standard_income = $energy_standard_income;

        return $this;
    }

    public function getNoobProtection(): ?int
    {
        return $this->noob_protection;
    }

    public function setNoobProtection(?int $noob_protection): self
    {
        $this->noob_protection = $noob_protection;

        return $this;
    }

    public function getNoobProtectiontime(): ?int
    {
        return $this->noob_protectiontime;
    }

    public function setNoobProtectiontime(?int $noob_protectiontime): self
    {
        $this->noob_protectiontime = $noob_protectiontime;

        return $this;
    }

    public function getForumUrl(): ?string
    {
        return $this->forum_url;
    }

    public function setForumUrl(?string $forum_url): self
    {
        $this->forum_url = $forum_url;

        return $this;
    }

    public function getAdminAttackable(): ?int
    {
        return $this->admin_attackable;
    }

    public function setAdminAttackable(?int $admin_attackable): self
    {
        $this->admin_attackable = $admin_attackable;

        return $this;
    }

    public function getLanguage(): ?string
    {
        return $this->language;
    }

    public function setLanguage(?string $language): self
    {
        $this->language = $language;

        return $this;
    }

    public function getTeamspeakMod(): ?int
    {
        return $this->teamspeak_mod;
    }

    public function setTeamspeakMod(?int $teamspeak_mod): self
    {
        $this->teamspeak_mod = $teamspeak_mod;

        return $this;
    }

    public function getTeamspeakServer(): ?string
    {
        return $this->teamspeak_server;
    }

    public function setTeamspeakServer(?string $teamspeak_server): self
    {
        $this->teamspeak_server = $teamspeak_server;

        return $this;
    }

    public function getTeamspeakTcpPort(): ?int
    {
        return $this->teamspeak_tcp_port;
    }

    public function setTeamspeakTcpPort(?int $teamspeak_tcp_port): self
    {
        $this->teamspeak_tcp_port = $teamspeak_tcp_port;

        return $this;
    }

    public function getTeamspeakUdpPort(): ?int
    {
        return $this->teamspeak_udp_port;
    }

    public function setTeamspeakUdpPort(?int $teamspeak_udp_port): self
    {
        $this->teamspeak_udp_port = $teamspeak_udp_port;

        return $this;
    }

    public function getRegistrationClosed(): ?int
    {
        return $this->registration_closed;
    }

    public function setRegistrationClosed(int $registration_closed): self
    {
        $this->registration_closed = $registration_closed;

        return $this;
    }

    public function getWelcomeText(): ?string
    {
        return $this->welcome_text;
    }

    public function setWelcomeText(?string $welcome_text): self
    {
        $this->welcome_text = $welcome_text;

        return $this;
    }

    public function getMinBuildTime(): ?int
    {
        return $this->min_build_time;
    }

    public function setMinBuildTime(?int $min_build_time): self
    {
        $this->min_build_time = $min_build_time;

        return $this;
    }

    public function getModules(): ?string
    {
        return $this->modules;
    }

    public function setModules(?string $modules): self
    {
        $this->modules = $modules;

        return $this;
    }

    public function getTradeableShips(): ?string
    {
        return $this->tradeable_ships;
    }

    public function setTradeableShips(?string $tradeable_ships): self
    {
        $this->tradeable_ships = $tradeable_ships;

        return $this;
    }

    public function getTradeableShipsFee(): ?int
    {
        return $this->tradeable_ships_fee;
    }

    public function setTradeableShipsFee(?int $tradeable_ships_fee): self
    {
        $this->tradeable_ships_fee = $tradeable_ships_fee;

        return $this;
    }

    public function getGalaxyWidth(): ?int
    {
        return $this->galaxy_width;
    }

    public function setGalaxyWidth(int $galaxy_width): self
    {
        $this->galaxy_width = $galaxy_width;

        return $this;
    }

    public function getGalaxyHeight(): ?int
    {
        return $this->galaxy_height;
    }

    public function setGalaxyHeight(int $galaxy_height): self
    {
        $this->galaxy_height = $galaxy_height;

        return $this;
    }

    public function getGalaxyDepth(): ?int
    {
        return $this->galaxy_depth;
    }

    public function setGalaxyDepth(int $galaxy_depth): self
    {
        $this->galaxy_depth = $galaxy_depth;

        return $this;
    }

    public function getMaxConstructionCount(): ?int
    {
        return $this->max_construction_count;
    }

    public function setMaxConstructionCount(int $max_construction_count): self
    {
        $this->max_construction_count = $max_construction_count;

        return $this;
    }

    public function getMaxScienceCount(): ?int
    {
        return $this->max_science_count;
    }

    public function setMaxScienceCount(int $max_science_count): self
    {
        $this->max_science_count = $max_science_count;

        return $this;
    }

    public function getMaxShipCount(): ?int
    {
        return $this->max_ship_count;
    }

    public function setMaxShipCount(int $max_ship_count): self
    {
        $this->max_ship_count = $max_ship_count;

        return $this;
    }

    public function getMaxStartPlanetsPerPlayer(): ?int
    {
        return $this->max_start_planets_per_player;
    }

    public function setMaxStartPlanetsPerPlayer(int $max_start_planets_per_player): self
    {
        $this->max_start_planets_per_player = $max_start_planets_per_player;

        return $this;
    }

    public function getMaxPlanetsAstrophysics(): ?int
    {
        return $this->max_planets_astrophysics;
    }

    public function setMaxPlanetsAstrophysics(int $max_planets_astrophysics): self
    {
        $this->max_planets_astrophysics = $max_planets_astrophysics;

        return $this;
    }

    public function getMaxPlanetsOfficers(): ?int
    {
        return $this->max_planets_officers;
    }

    public function setMaxPlanetsOfficers(int $max_planets_officers): self
    {
        $this->max_planets_officers = $max_planets_officers;

        return $this;
    }

    public function getMaxPlanetsScience(): ?int
    {
        return $this->max_planets_science;
    }

    public function setMaxPlanetsScience(int $max_planets_science): self
    {
        $this->max_planets_science = $max_planets_science;

        return $this;
    }

    public function getFlightDeuteriumCostPerClick(): ?int
    {
        return $this->flight_deuterium_cost_per_click;
    }

    public function setFlightDeuteriumCostPerClick(int $flight_deuterium_cost_per_click): self
    {
        $this->flight_deuterium_cost_per_click = $flight_deuterium_cost_per_click;

        return $this;
    }

    public function getMaxDmMissions(): ?int
    {
        return $this->max_dm_missions;
    }

    public function setMaxDmMissions(int $max_dm_missions): self
    {
        $this->max_dm_missions = $max_dm_missions;

        return $this;
    }

    public function getMaxResourceOverflow(): ?int
    {
        return $this->max_resource_overflow;
    }

    public function setMaxResourceOverflow(int $max_resource_overflow): self
    {
        $this->max_resource_overflow = $max_resource_overflow;

        return $this;
    }

    public function getMoonChanceFactor(): ?int
    {
        return $this->moon_chance_factor;
    }

    public function setMoonChanceFactor(int $moon_chance_factor): self
    {
        $this->moon_chance_factor = $moon_chance_factor;

        return $this;
    }

    public function getMoonChance(): ?int
    {
        return $this->moon_chance;
    }

    public function setMoonChance(int $moon_chance): self
    {
        $this->moon_chance = $moon_chance;

        return $this;
    }

    public function getTraderDmCost(): ?int
    {
        return $this->trader_dm_cost;
    }

    public function setTraderDmCost(int $trader_dm_cost): self
    {
        $this->trader_dm_cost = $trader_dm_cost;

        return $this;
    }

    public function getUniversityFactorScience(): ?int
    {
        return $this->university_factor_science;
    }

    public function setUniversityFactorScience(int $university_factor_science): self
    {
        $this->university_factor_science = $university_factor_science;

        return $this;
    }

    public function getMaxFleetsPerAssociation(): ?int
    {
        return $this->max_fleets_per_association;
    }

    public function setMaxFleetsPerAssociation(int $max_fleets_per_association): self
    {
        $this->max_fleets_per_association = $max_fleets_per_association;

        return $this;
    }

    public function getDeleteMoonDebris(): ?int
    {
        return $this->delete_moon_debris;
    }

    public function setDeleteMoonDebris(int $delete_moon_debris): self
    {
        $this->delete_moon_debris = $delete_moon_debris;

        return $this;
    }

    public function getMinUmodeTime(): ?int
    {
        return $this->min_umode_time;
    }

    public function setMinUmodeTime(int $min_umode_time): self
    {
        $this->min_umode_time = $min_umode_time;

        return $this;
    }

    public function getGateIntervalTime(): ?int
    {
        return $this->gate_interval_time;
    }

    public function setGateIntervalTime(int $gate_interval_time): self
    {
        $this->gate_interval_time = $gate_interval_time;

        return $this;
    }

    public function getStartMetal(): ?int
    {
        return $this->start_metal;
    }

    public function setStartMetal(int $start_metal): self
    {
        $this->start_metal = $start_metal;

        return $this;
    }

    public function getStartCrystal(): ?int
    {
        return $this->start_crystal;
    }

    public function setStartCrystal(int $start_crystal): self
    {
        $this->start_crystal = $start_crystal;

        return $this;
    }

    public function getStartDeuterium(): ?int
    {
        return $this->start_deuterium;
    }

    public function setStartDeuterium(int $start_deuterium): self
    {
        $this->start_deuterium = $start_deuterium;

        return $this;
    }

    public function getStartDm(): ?int
    {
        return $this->start_dm;
    }

    public function setStartDm(int $start_dm): self
    {
        $this->start_dm = $start_dm;

        return $this;
    }

    public function getReferalActive(): ?int
    {
        return $this->referal_active;
    }

    public function setReferalActive(int $referal_active): self
    {
        $this->referal_active = $referal_active;

        return $this;
    }

    public function getReferalBonusDm(): ?int
    {
        return $this->referal_bonus_dm;
    }

    public function setReferalBonusDm(int $referal_bonus_dm): self
    {
        $this->referal_bonus_dm = $referal_bonus_dm;

        return $this;
    }

    public function getReferalMinpoints(): ?int
    {
        return $this->referal_minpoints;
    }

    public function setReferalMinpoints(int $referal_minpoints): self
    {
        $this->referal_minpoints = $referal_minpoints;

        return $this;
    }

    public function getReferalMaxReferals(): ?int
    {
        return $this->referal_max_referals;
    }

    public function setReferalMaxReferals(int $referal_max_referals): self
    {
        $this->referal_max_referals = $referal_max_referals;

        return $this;
    }

    public function getDelUserManual(): ?int
    {
        return $this->del_user_manual;
    }

    public function setDelUserManual(int $del_user_manual): self
    {
        $this->del_user_manual = $del_user_manual;

        return $this;
    }

    public function getSendInavtiveMail(): ?int
    {
        return $this->send_inavtive_mail;
    }

    public function setSendInavtiveMail(int $send_inavtive_mail): self
    {
        $this->send_inavtive_mail = $send_inavtive_mail;

        return $this;
    }

    public function getSiloSizeFactor(): ?int
    {
        return $this->silo_size_factor;
    }

    public function setSiloSizeFactor(int $silo_size_factor): self
    {
        $this->silo_size_factor = $silo_size_factor;

        return $this;
    }

    public function getEnergyFactor(): ?int
    {
        return $this->energy_factor;
    }

    public function setEnergyFactor(int $energy_factor): self
    {
        $this->energy_factor = $energy_factor;

        return $this;
    }

    public function getAllianceMinPoints(): ?int
    {
        return $this->alliance_min_points;
    }

    public function setAllianceMinPoints(int $alliance_min_points): self
    {
        $this->alliance_min_points = $alliance_min_points;

        return $this;
    }

    public function getExpeditionResLimit(): ?int
    {
        return $this->expedition_res_limit;
    }

    public function setExpeditionResLimit(int $expedition_res_limit): self
    {
        $this->expedition_res_limit = $expedition_res_limit;

        return $this;
    }
}
