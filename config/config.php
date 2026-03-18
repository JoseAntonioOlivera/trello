<?php
// En Render usamos la variable que ellos nos dan
$databaseUrl = getenv('DATABASE_URL');
$dbUrl = $databaseUrl ? parse_url($databaseUrl) : [];

return [
  // Si hay DATABASE_URL usamos pgsql (Render), si no, mysql (Local)
  'driver'  => $databaseUrl ? 'pgsql' : 'mysql', 
  'host'    => $dbUrl['host'] ?? 'localhost',
  'db'      => isset($dbUrl['path']) ? ltrim($dbUrl['path'], '/') : 'nombre_tu_bd_local',
  'user'    => $dbUrl['user'] ?? 'root',
  'pass'    => $dbUrl['pass'] ?? '',
  'port'    => $dbUrl['port'] ?? '5432',
  'charset' => 'utf8',
];
