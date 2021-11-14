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
        <div>
            <ul>
                <li>Fecha: {{date('d-m-Y', strtotime($acta->fecha_reunion))}}</li>
                <li>Hora de Inicio: {{date('H:i', strtotime($acta->hora_inicio))}}</li>
                <li>Hora de Término: {{date('H:i', strtotime($acta->hora_termino))}}</li>
            </ul>
        </div>
        @if($ver==1)
            <div>
                <p> Asisten </p>
                <ul>
                    @foreach($asistentes as $asistente)
                        <li>{{$asistente->name}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div>
            <p> Temas Tratados </p>
            <ol>
                @foreach($temas as $tema)
                    <li>{{$tema->titulo}}</li>
                @endforeach
            </ol>
        </div>
        @if($ver == 1)
            <div>
                <p>Acciones, Acuerdos y Comentarios</p>
                <ol>
                    @foreach($temas as $tema)
                        <li>
                        @foreach($tema['acciones'] as $accion)
                            @if($accion->tipo == 'Ejecución')
                                Accion: {{$accion->titulo}} ({{$accion->usuario->name}}).
                            @elseif($accion->tipo == 'Acuerdo')
                                Acuerdo: {{$accion->titulo}}
                            @endif
                                <br>
                        @endforeach
                        @if($tema->comentarios != null)
                            Comentarios: {{$tema->comentarios}}
                        @endif
                        </li>
                    @endforeach
                </ol>
            </div>
            <div>
                @if($acta->adendas!=NULL)
                    <p> Adendas </p>
                    <ul>
                        <li> {{$acta->adendas}}</li>
                    </ul>
                @endif
            </div>
        @endif
    </div>
</body>

</html>