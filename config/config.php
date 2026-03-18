<?php
// Parseamos la URL de la base de datos de Render
$dbUrl = parse_url(getenv('postgresql://olivera:xZopBO4FwXBgcKa0C5YHHXJIRWUdaCNM@dpg-d6tb93tm5p6s73b9dmag-a/trello_db_de3j'));

return [
  'host'    => $dbUrl['host'] ?? 'localhost',
  'db'      => ltrim($dbUrl['path'], '/') ?? 'trello',
  'user'    => 'olivera',
  'pass'    => 'xZopBO4FwXBgcKa0C5YHHXJIRWUdaCNM',
  'port'    => $dbUrl['port'] ?? '5432',
  'charset' => 'utf8',
];