echo off
set "PHP_EXE=C:\wamp64\v3.3.0\bin\php\php8.2.0\php.exe"
set "DEF_ROOT_PATH=..\..\..\.."
::where php
%PHP_EXE% --version
%PHP_EXE% -f php/main.php
