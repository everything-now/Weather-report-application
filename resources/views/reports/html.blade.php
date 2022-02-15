<h1 style="color:red; text-align:center;">Metar Report for {{ now()->format('Y-m-d H:i') }} </h1>

@foreach ($observations as $observation)
    <h2 style="color:blue;">{{ $observation->airportCode }}</h2>

    @if (!$observation->exists)
        Observation for this airport not found
    @else
        @if ($observation->airportName) <br> {{ $observation->airportName }} @endif
        @if ($observation->date) <br> {{ $observation->date }} @endif
        @if ($observation->wind) <br><strong>Wind:</strong> {{ $observation->wind }} @endif
        @if ($observation->visibility) <br><strong>Visibility:</strong> {{ $observation->visibility }} @endif
        @if ($observation->skyConditions) <br><strong>Sky conditions:</strong> {{ $observation->skyConditions }} @endif
        @if ($observation->temperature) <br><strong>Temperature:</strong> {{ $observation->temperature }} @endif
        @if ($observation->weather) <br><strong>Weather:</strong> {{ $observation->weather }} @endif
        @if ($observation->heatIndex) <br><strong>Heat index:</strong> {{ $observation->heatIndex }} @endif
        @if ($observation->windchill) <br><strong>Windchill:</strong> {{ $observation->windchill }} @endif
        @if ($observation->dewPoint) <br><strong>Dew point:</strong> {{ $observation->dewPoint }} @endif
        @if ($observation->relativeHumidity) <br><strong>Relative humidity:</strong> {{ $observation->relativeHumidity }} @endif
        @if ($observation->pressureAltimeter) <br><strong>Pressure altimeter:</strong> {{ $observation->pressureAltimeter }} @endif
        @if ($observation->pressureTendency) <br><strong>Pressure tendency:</strong> {{ $observation->pressureTendency }} @endif
        @if ($observation->ob) <br><strong>ob:</strong> {{ $observation->ob }} @endif
        @if ($observation->cycle) <br><strong>cycle:</strong> {{ $observation->cycle }} @endif
    @endif
@endforeach
