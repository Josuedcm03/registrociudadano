<h2 style="font-family: sans-serif; color: #2d3748;">Reporte de Ciudadanos por Ciudad</h2>

@foreach($groupedCitizens as $city => $citizens)
    <h3 style="font-family: sans-serif; color: #4a5568;">{{ $city }}</h3>
    @if(count($citizens))
        <ul>
            @foreach($citizens as $citizen)
                <li style="font-family: sans-serif;">
                    {{ $citizen->name }} 
                    @if(isset($citizen->email) && $citizen->email)
                        ({{ $citizen->email }})
                    @endif
                </li>
            @endforeach
        </ul>
    @else
        <p style="font-family: sans-serif; color: #a0aec0;">Sin ciudadanos registrados.</p>
    @endif
@endforeach