echo off
set "SQLITE3_EXE=C:\msys64\ucrt64\bin\sqlite3.exe"
set "DEF_ROOT_PATH=..\..\..\.."
set "DEF_DATABASE_FILE=db\sqlite\db\database.dat"
set "DEF_DELETE_SQL_FILE=db\sqlite\delete\batch\sql\input\delete-all-tables.sql"
set "DEF_DELETE_OUTPUT_FILE=db\sqlite\delete\batch\sql\output\delete-all-tables.sql"
set "DEF_DATABASE_PATH=%DEF_ROOT_PATH%\%DEF_DATABASE_FILE%"
set "DEF_DELETE_SQL_PATH=%DEF_ROOT_PATH%\%DEF_DELETE_SQL_FILE%"
set "DEF_DELETE_OUTPUT_PATH=%DEF_ROOT_PATH%\%DEF_DELETE_OUTPUT_FILE%"
::where sqlite3
%SQLITE3_EXE% --version

set /p oAnswer=[Info]:Voulez-vous supprimer toutes les tables ? (yes/[non]) :
if [%oAnswer%] == [] ( goto :cAnswerNo )
if not [%oAnswer%] == [yes] ( goto :cAnswerNo )

:cDeleteAllTable
%SQLITE3_EXE% %DEF_DATABASE_PATH% ".output %DEF_DELETE_OUTPUT_PATH%" ^
".read %DEF_DELETE_SQL_PATH%"

:cFileIsEmpty
for /f %%i in ("%DEF_DELETE_OUTPUT_PATH%") do set size=%%~zi
if [%size%] == [0] ( goto :cFileEmpty )

%SQLITE3_EXE% %DEF_DATABASE_PATH% ".read %DEF_DELETE_OUTPUT_PATH%"
type %DEF_DELETE_OUTPUT_PATH%
goto :cAnswerYes

:cFileEmpty
echo [Warning]:Aucune table n'a ete trouve.^|dbPath=%DEF_DATABASE_FILE%
goto :cEnd

:cAnswerYes
echo [Info]:La suppression de toutes les tables a reussi.^|dbPath=%DEF_DATABASE_FILE%
goto :cEnd

:cAnswerNo
echo [Warning]:La suppression de toutes les tables a ete annulee.^|dbPath=%DEF_DATABASE_FILE%
goto :cEnd

:cEnd
