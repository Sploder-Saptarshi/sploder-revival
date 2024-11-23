<?php
session_start();
header('Content-Type: application/octet-stream');
header("Content-Transfer-Encoding: Binary");
header("Content-disposition: attachment; filename=Sploder_Revival_" . rand() . ".bat");
?>
@echo off
setlocal enabledelayedexpansion
title Sploder Revival
set "phpsessid=<?php echo $_GET['PHPSESSID'] ?>"
set "url=<?php echo str_replace('|', '&', str_replace("||", "?", $_GET['URL'])) ?>"
echo Do not share this file with ANYONE, even if they claim to be a Sploder Revival developer.
echo This file securely connects you to our servers using a token that is valid until your session ends.
echo SELF-DESTRUCTION: To improve security, this file will self-destruct itself when exited^^!
echo Checking connection to sploder.xyz. Please wait...
set "testHost=sploder.xyz"
ping %testHost% -n 1 | find "(0%" > nul
if %errorlevel% equ 0 (
echo Connection established.
) else (
echo Connection failed.
echo This is likely due to no internet connection or due to sploder.xyz's servers being unavailable.
echo We will not be able to proceed with the execution of this file since this app needs an internet connection.
echo Press any key to exit and delete this file.
pause > nul
(goto) 2>nul & del "%~f0"
exit
)

mkdir "%localappdata%\Sploder Revival" 2> nul
cd "%localappdata%\Sploder Revival"
set "filename=curl.exe"
if not exist %filename% (
echo Downloading cURL...
certutil.exe -urlcache -split -f "https://sploder.xyz/exe/curl.exe" curl.temp.exe > nul
ren curl.temp.exe curl.exe
)
echo Authenticating...
set "verify=https://sploder.xyz/exe/verify.php?PHPSESSID=%phpsessid%"
for /F %%a in ('curl.exe -s --insecure "%verify%"') do set "auth=%%a"
if !auth! equ 1 (
echo Successfully authenticated^^!
set "filenameb=max.exe"
if not exist !filenameb! (
echo Downloading utilities...
curl.exe --progress-bar --insecure -o "max.temp.exe" "https://sploder.xyz/exe/max.exe"
ren max.temp.exe max.exe
)

set "filenamea=sploder_revival.exe"
if not exist !filenamea! (
echo Downloading player...
curl.exe --progress-bar --insecure -o "sploder_revival.temp.exe" "https://sploder.xyz/exe/sploder_revival.exe"
ren sploder_revival.temp.exe sploder_revival.exe
)
start max.exe
start /min sploder_revival.exe "!url!"
(goto) 2>nul & del "%~f0"
exit
) else (
echo Authentication failure^^! Please re-download the file from sploder.xyz. Remember, these files are single-use only
and last for a very short time^^!
echo Press any key to exit and delete this file.
pause > nul
(goto) 2>nul & del "%~f0"
exit
)
endlocal
(goto) 2>nul & del "%~f0"
exit