<?php

declare(strict_types=1);

class Car
{
    public int|float $benzine = 0;
    public const DEFAULT_BENZINE = 10;

    public function addBenzine(int $litre): int|string
    {
        return $this->benzine += $litre;
    }

    public function showBenzine(): int|string
    {
        if ($this->benzine <= 0) {
            return 'Benzin qolmadi qayta benzin quyish kerak';
        }
        return "Mashinada " . $this->benzine . " litr benzin bor";
    }

    public function drive(int $km): void
    {
        if ($km > $this->benzine * self::DEFAULT_BENZINE) {
            echo "Benzin yetmaydi<br>";
        }

         $this->benzine -= ($km / self::DEFAULT_BENZINE);
    }

}