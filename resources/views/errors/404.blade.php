@include('errors._error-layout', [
    'statusCode' => '404',
    'title' => 'Página no encontrada',
    'message' => 'La página solicitada no existe o fue movida.',
    'description' => 'Verifique que la dirección sea correcta. También es posible que el registro haya sido eliminado, cambiado de ubicación o que el enlace utilizado ya no esté disponible.',
    'primaryActionLabel' => 'Volver al inicio',
    'primaryActionUrl' => url('/'),
])
