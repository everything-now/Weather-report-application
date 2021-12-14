<h1 style="color:red; text-align:center;">Metar Report for {{ now()->format('Y-m-d H:i') }} </h1>

@foreach ($observations as $observation)
    <h2 style="color:blue;">{{ $observation->airportCode }}</h2>

    @if (!$observation->exists)
        Observation for this airport not found
    @else
        @if ($observation->airportName) <br> {{ $observation->airportName }} @endif
        @if ($observation->date) <br> {{ $observation->date }} @endif
        @if ($observation->wind) <br><b>Wind:</b> {{ $observation->wind }} @endif
        @if ($observation->visibility) <br><b>Visibility:</b> {{ $observation->visibility }} @endif
        @if ($observation->skyConditions) <br><b>Sky conditions:</b> {{ $observation->skyConditions }} @endif
        @if ($observation->temperature) <br><b>Temperature:</b> {{ $observation->temperature }} @endif
        @if ($observation->weather) <br><b>Weather:</b> {{ $observation->weather }} @endif
        @if ($observation->heatIndex) <br><b>Heat index:</b> {{ $observation->heatIndex }} @endif
        @if ($observation->windchill) <br><b>Windchill:</b> {{ $observation->windchill }} @endif
        @if ($observation->dewPoint) <br><b>Dew point:</b> {{ $observation->dewPoint }} @endif
        @if ($observation->relativeHumidity) <br><b>Relative humidity:</b> {{ $observation->relativeHumidity }} @endif
        @if ($observation->pressureAltimeter) <br><b>Pressure altimeter:</b> {{ $observation->pressureAltimeter }} @endif
        @if ($observation->pressureTendency) <br><b>Pressure tendency:</b> {{ $observation->pressureTendency }} @endif
        @if ($observation->ob) <br><b>ob:</b> {{ $observation->ob }} @endif
        @if ($observation->cycle) <br><b>cycle:</b> {{ $observation->cycle }} @endif
    @endif
@endforeach
