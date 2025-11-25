<?php

namespace App\Patterns\Observer;

final class ForecastDisplay implements DisplayInterface
{
    private float $currentPressure;
    private float $lastPressure;

    public function __construct(
        private readonly WeatherData $weatherData,
        private readonly Output $output,
    ) {
        $this->currentPressure = $this->weatherData->pressure;
        $this->lastPressure = $this->weatherData->pressure;
        $weatherData->addDisplay($this);
    }

    public function update(): void
    {
        $this->lastPressure = $this->currentPressure;
        $this->currentPressure = $this->weatherData->pressure;
        $this->output->addMessage($this->info());
    }

    private function info(): string
    {
        return sprintf(
            "Last pressure = %01.1f, current pressure = %01.1f",
            $this->lastPressure,
            $this->currentPressure,
        );
    }
}
