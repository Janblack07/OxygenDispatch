@include('errors._error-layout', [
    'statusCode' => '503',
    'title' => 'Servicio no disponible',
    'message' => 'El sistema se encuentra temporalmente fuera de servicio.',
    'description' => 'OxygenDispatch puede estar en mantenimiento o reiniciándose. Espere unos minutos y vuelva a intentarlo.',
    'primaryActionLabel' => 'Intentar nuevamente',
    'primaryActionUrl' => url('/'),
])
