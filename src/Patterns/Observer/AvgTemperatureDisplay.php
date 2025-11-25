<?php

namespace App\Patterns\Observer;

final class AvgTemperatureDisplay implements DisplayInterface
{
    /** @var list<float> */
    private array $temperatures;

    public function __construct(
        private readonly WeatherData $weatherData,
        private readonly Output $output,
    ) {
        $this->temperatures[] = $this->weatherData->temperature;
        $weatherData->addDisplay($this);
    }

    public function update(): void
    {
        $this->temperatures[] = $this->weatherData->temperature;
        $this->output->addMessage($this->info());
    }

    private function info(): string
    {
        return sprintf(
            "Avg/Max/Min temperature = %01.1f/%01.1f/%01.1f",
            $this->calculateAvg(),
            max($this->temperatures),
            min($this->temperatures),
        );
    }

    private function calculateAvg(): float
    {
        return array_sum($this->temperatures) / count($this->temperatures);
    }
}
