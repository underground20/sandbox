<?php

namespace Test\Patterns\Observer;

use App\Patterns\Observer\AvgTemperatureDisplay;
use App\Patterns\Observer\CurrentConditionsDisplay;
use App\Patterns\Observer\ForecastDisplay;
use App\Patterns\Observer\Output;
use App\Patterns\Observer\WeatherData;
use PHPUnit\Framework\TestCase;

final class WeatherDataTest extends TestCase
{
    public function testMeasurementsChangedWithoutDisplays(): void
    {
        $output = new Output();
        $weatherData = new WeatherData(10.0, 12.0, 15.0);
        $weatherData->change(25.0, 15.0, 17.0);

        $this->assertSame([], $output->messages);
    }

    public function testMeasurementsNotChangedAfterRemoveDisplay(): void
    {
        $output = new Output();
        $weatherData = new WeatherData(10.0, 12.0, 15.0);
        $conditionsDisplay = new CurrentConditionsDisplay($weatherData, $output);
        $weatherData->change(25.0, 15.0, 17.0);

        $this->assertSame(['Current conditions: temperature 25 degrees, humidity: 15%'], $output->messages);

        $weatherData->removeDisplay($conditionsDisplay);
        $weatherData->change(25.0, 15.0, 17.0);

        $this->assertSame(['Current conditions: temperature 25 degrees, humidity: 15%'], $output->messages);
    }

    public function testMeasurementsChangedOnce(): void
    {
        $output = new Output();
        $weatherData = new WeatherData(10.0, 12.0, 15.0);
        new CurrentConditionsDisplay($weatherData, $output);
        new ForecastDisplay($weatherData, $output);
        $weatherData->change(25.0, 15.0, 17.0);

        $this->assertSame([
            'Current conditions: temperature 25 degrees, humidity: 15%',
            'Last pressure = 15.0, current pressure = 17.0'
        ], $output->messages);
    }

    public function testMeasurementsChangedForAvgTemperatureDisplay(): void
    {
        $output = new Output();
        $weatherData = new WeatherData(10.0, 12.0, 15.0);
        new AvgTemperatureDisplay($weatherData, $output);
        $weatherData->change(25.0, 15.0, 17.0);
        $weatherData->change(9.0, 20.0, 20.0);
        $weatherData->change(36.0, 25.0, 30.0);

        $this->assertSame([
            'Avg/Max/Min temperature = 17.5/25.0/10.0',
            'Avg/Max/Min temperature = 14.7/25.0/9.0',
            'Avg/Max/Min temperature = 20.0/36.0/9.0',
        ], $output->messages);
    }

    public function testMeasurementsChangedFew(): void
    {
        $output = new Output();
        $weatherData = new WeatherData(10.0, 12.0, 15.0);
        new CurrentConditionsDisplay($weatherData, $output);
        new ForecastDisplay($weatherData, $output);
        $weatherData->change(25.0, 15.0, 17.0);
        $weatherData->change(30.0, 20.0, 20.0);
        $weatherData->change(36.0, 25.0, 30.0);

        $this->assertSame([
            'Current conditions: temperature 25 degrees, humidity: 15%',
            'Last pressure = 15.0, current pressure = 17.0',
            'Current conditions: temperature 30 degrees, humidity: 20%',
            'Last pressure = 17.0, current pressure = 20.0',
            'Current conditions: temperature 36 degrees, humidity: 25%',
            'Last pressure = 20.0, current pressure = 30.0'
        ], $output->messages);
    }
}
