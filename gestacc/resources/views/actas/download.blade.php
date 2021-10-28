<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Descargar acta</title>
</head>

<body>
    <div style="font-family: Calibri, sans-serif; font-size: 16px">
        <div>
            <h4 style="text-align: center; font-size: 20px;">Comité Curricular ICC</h4>
        </div>
        <div>
            <h5 style="font-size: 16px"><strong>Reunión {{$acta->tipo_reunion}} 
            @php
                $date = DateTime::createFromFormat("Y-m-d", $acta->fecha_reunion);
                echo $date->format("Y");
            @endphp-{{$acta->numero_reunion}}</strong></h5>
        </div>
        <div class="">
            <ul>
                <li>Fecha: {{$acta->fecha_reunion}}</li>
                <li>Hora de Inicio: {{$acta->hora_inicio}}</li>
                <li>Hora de Término: {{$acta->hora_termino}}</li>
            </ul>
        </div>
        @if($ver==1)
            <div class="">
                <p> Asisten </p>
                <ul>
                    @foreach($asistentes as $asistente)
                        <li>{{$asistente->name}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="">
            <p> Temas Tratados </p>
            <ol>
                @foreach($temas as $tema)
                    <li>{{$tema->titulo}}</li>
                @endforeach
            </ol>
        </div>
        @if($ver == 1)
            <div class="">
                <p>Acciones, Acuerdos y Comentarios</p>
                <ol>
                    @foreach($temas as $tema)
                        <li>{{$tema->comentarios}}
                        @foreach($tema['acciones'] as $accion)
                            <br>
                            {{$accion->titulo}}
                            @if($accion->tipo == 'Ejecución')
                                ({{$accion->usuario->name}}).
                            @endif
                        @endforeach
                        </li>
                    @endforeach
                </ol>
            </div>
        @endif
    </div>
</body>

</html>