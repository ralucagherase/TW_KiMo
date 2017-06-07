set doc=C:\xampp\htdocs\KiMo
set HH=%TIME: =0%
set HH=%HH:~0,2%
set TESTMI="59"
set TESTHH="00"
set /A MI=1%TIME:~3,2% %% 100 + 1

if %MI%==60 (
	set MI=00
	set /A HH=1%HH% %% 100 + 1
) else if %MI% lss 10 (
	set MI=0%MI%
)

if %HH%==24 (
	set HH=00
) else if %HH% lss 10 (
	set HH=0%HH%
)
cd "%doc%"
schtasks /create /tn "UpdatePositionDaemon" /tr "C:\xampp\php\php.exe C:\xampp\htdocs\KiMo\bin\update_position_daemon.php" /sc once /st %HH%:%MI%