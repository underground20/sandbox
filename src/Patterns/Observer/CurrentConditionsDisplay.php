<?php

namespace App\Patterns\Observer;

final class CurrentConditionsDisplay implements DisplayInterface
{
    private float $temperature;
    private float $humidity;

    public function __construct(
        private readonly WeatherData $weatherData,
        private readonly Output $output,
    ) {
        $this->temperature = $weatherData->temperature;
        $this->humidity = $this->weatherData->humidity;
        $weatherData->addDisplay($this);
    }

    public function update(): void
    {
        $this->temperature = $this->weatherData->temperature;
        $this->humidity = $this->weatherData->humidity;
        $this->output->addMessage($this->info());
    }

    private function info(): string
    {
        return sprintf(
            "Current conditions: temperature %01.0f degrees, humidity: %01.0f%%",
            $this->temperature,
            $this->humidity,
        );
    }
}
