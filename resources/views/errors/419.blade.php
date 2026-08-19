@include('errors._error-layout', [
    'statusCode' => '419',
    'title' => 'Sesión expirada',
    'message' => 'La sesión ha expirado por seguridad.',
    'description' => 'Esto puede ocurrir cuando la página permanece abierta por mucho tiempo antes de enviar un formulario. Vuelva al sistema, actualice la página e intente realizar la operación nuevamente.',
    'primaryActionLabel' => 'Volver al inicio',
    'primaryActionUrl' => url('/'),
])
