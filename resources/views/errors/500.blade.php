@include('errors._error-layout', [
    'statusCode' => '500',
    'title' => 'Error interno del sistema',
    'message' => 'No se pudo completar la operación solicitada.',
    'description' => 'El sistema encontró un problema inesperado. La información del error fue registrada para revisión técnica. Intente nuevamente más tarde o comuníquese con el administrador si el problema continúa.',
    'primaryActionLabel' => 'Volver al inicio',
    'primaryActionUrl' => url('/'),
])
