<?php

namespace App\Patterns\Observer;

final class WeatherData
{
    /** @var \SplObjectStorage<DisplayInterface> */
    private \SplObjectStorage $displays;

    public function __construct(
        private(set) float $temperature {
            get => $this->temperature;
        },
        private(set) float $humidity {
            get => $this->humidity;
        },
        private(set) float $pressure {
            get => $this->pressure;
        }
    ) {
        $this->displays = new \SplObjectStorage();
    }

    public function change(float $temperature, float $humidity, float $pressure): void
    {
        $this->temperature = $temperature;
        $this->humidity = $humidity;
        $this->pressure = $pressure;
        $this->measurementsChanged();
    }

    public function addDisplay(DisplayInterface $display): void
    {
        $this->displays->attach($display);
    }

    public function removeDisplay(DisplayInterface $display): void
    {
        $this->displays->detach($display);
    }

    private function measurementsChanged(): void
    {
        foreach ($this->displays as $display) {
            $display->update();
        }
    }
}
