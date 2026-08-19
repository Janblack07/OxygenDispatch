@include('errors._error-layout', [
    'statusCode' => '403',
    'title' => 'Acceso no autorizado',
    'message' => 'No tiene permisos para ingresar a esta sección.',
    'description' => 'La cuenta actual no cuenta con autorización suficiente para acceder al módulo solicitado. Si considera que debe tener acceso, comuníquese con el administrador del sistema.',
    'primaryActionLabel' => 'Volver al inicio',
    'primaryActionUrl' => url('/'),
])
