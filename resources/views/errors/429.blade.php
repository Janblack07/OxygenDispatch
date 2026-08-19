@include('errors._error-layout', [
    'statusCode' => '429',
    'title' => 'Demasiadas solicitudes',
    'message' => 'Se realizaron demasiadas acciones en poco tiempo.',
    'description' => 'El sistema limitó temporalmente las solicitudes para proteger la estabilidad de la plataforma. Espere unos minutos antes de volver a intentar.',
    'primaryActionLabel' => 'Volver al inicio',
    'primaryActionUrl' => url('/'),
])
