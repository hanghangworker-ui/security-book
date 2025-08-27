@echo off
setlocal enabledelayedexpansion

rem 获取当前日期和时间
for /f "tokens=1-4 delims=/-. " %%i in ("%date%") do (
    set yyyy=%%i
    set mm=%%j
    set dd=%%k
)

set hh=%time:~0,2%
set nn=%time:~3,2%
set ss=%time:~6,2%

rem 去掉小时的空格
if "%hh:~0,1%"==" " set hh=0%hh:~1,1%

set commitmsg=%yyyy%-%mm%-%dd%_%hh%-%nn%-%ss%

git config --global core.autocrlf input

git add .
git commit -m "%commitmsg%"
git push

endlocal