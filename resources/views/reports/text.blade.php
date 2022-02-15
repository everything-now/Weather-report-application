@foreach ($observations as $observation)
    @if (!$observation->exists)
         {{ 'Observation for this airport not found' . "\n"}}
    @else
        @if ($observation->airportName) {{ $observation->airportName . "\n" }} @endif
        @if ($observation->date) {{ $observation->date . "\n"}} @endif
        @if ($observation->wind) Wind: {{ $observation->wind . "\n"}} @endif
        @if ($observation->visibility) Visibility: {{ $observation->visibility . "\n"}} @endif
        @if ($observation->skyConditions) Sky conditions: {{ $observation->skyConditions . "\n"}} @endif
        @if ($observation->temperature) Temperature: {{ $observation->temperature . "\n"}} @endif
        @if ($observation->weather) Weather: {{ $observation->weather . "\n"}} @endif
        @if ($observation->heatIndex) Heat index: {{ $observation->heatIndex . "\n"}} @endif
        @if ($observation->windchill) Windchill: {{ $observation->windchill . "\n"}} @endif
        @if ($observation->dewPoint) Dew point: {{ $observation->dewPoint . "\n"}} @endif
        @if ($observation->relativeHumidity) Relative humidity: {{ $observation->relativeHumidity . "\n"}} @endif
        @if ($observation->pressureAltimeter) Pressure altimeter: {{ $observation->pressureAltimeter . "\n"}} @endif
        @if ($observation->pressureTendency) Pressure tendency: {{ $observation->pressureTendency . "\n"}} @endif
        @if ($observation->ob) ob: {{ $observation->ob . "\n"}} @endif
        @if ($observation->cycle) cycle: {{ $observation->cycle . "\n"}} @endif
    @endif
@endforeach
