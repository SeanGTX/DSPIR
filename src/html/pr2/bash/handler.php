<?php

include("index.php");
$param = $_POST['command'];
if (!isset($param)) echo "Bad request";

$command = explode(" ", $param);

switch ($command[0]) {

    case 'whoami':
        echo phpinfo();
        break;

    case 'ls':{
        $path;
        if(count($command) > 1)
            $path = __DIR__ . $command[1];
        else
            $path = __DIR__;
        foreach(list_files($path) as $elem){
            echo $elem . "<br>";
        }

    } break;

    case 'id':
        echo $_SERVER['SERVER_ADMIN'];
        break;

    case 'ps':
        $execstring='ps -f -u www-data 2>&1';
        $output;
        exec($execstring, $output);
        foreach($output as $elem)
            echo $elem . "<br>";
        break;

    default:
        echo "Bad command";
        break;
}


function list_files($path)
{
    if ($path[mb_strlen($path) - 1] != '/') {
        $path .= '/';
    }

    $files = array();
    $dh = opendir($path);
    while (false !== ($file = readdir($dh))) {
        if ($file != '.' && $file != '..' && $file[0] != '.') {
            $files[] = $file;
        }
    }

    closedir($dh);
    return $files;
}
