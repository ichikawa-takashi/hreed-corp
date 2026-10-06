<?php
session_start();
$_SESSION['count'] = isset($_SESSION['count']) ? $_SESSION['count'] + 1 : 1;
header('Cache-Control: no-store');
echo 'count: ' . $_SESSION['count'] . '<br>';
echo 'session_id: ' . session_id() . '<br>';
echo 'save_handler: ' . ini_get('session.save_handler') . '<br>';
echo 'save_path: ' . ini_get('session.save_path') . '<br>';
echo 'save_path writable: ' . (is_writable(session_save_path() ?: sys_get_temp_dir()) ? 'yes' : 'no');
