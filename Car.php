<?php

declare(strict_types=1);

class Car
{
    public int|float $benzine = 0;
    public const DEFAULT_BENZINE = 10;
    public const MAX = 90;
    public int $used;
    public int $speed;

    public function addBenzine(int $litre): int|string
    {
        return $this->benzine += $litre;
    }

    public function showBenzine(): int|string
    {
        if ($this->benzine === 0){
            return 'Benzin qolmadi qayta benzin quyish kerak';
        }
        return "Mashinada " . $this->benzine . " litr benzin bor";
    }

    public function drive(int $km, int $speed): string|int|float
    {
        $this->used = 1;
        $this->speed = $speed;
        if ($this->speed > self::MAX) {
            $this->used = 2;
        }

        if ($km > $this->benzine * self::DEFAULT_BENZINE / $this->used) {
            return "Benzin yetmaydi<br>"; // chunki siz " . $km . "km ga " . $speed . "km/s ga yuryabiz";
        }

        return $this->benzine -= ($km / self::DEFAULT_BENZINE) * $this->used;
    }

    public function policeDanger(): string|int|null
    {
        return (self::MAX < $this->speed) ? 'Bu tezlik bilan radarga tushasiz' : null;
    }
}