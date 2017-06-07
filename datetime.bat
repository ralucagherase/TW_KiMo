set HH=%TIME: =0%
set HH=%HH:~0,2%
set TESTMI="59"
set TESTHH="00"
set /A MI=%TIME:~3,2%+1
set /A TESTMI=1%TESTMI% %% 100 + 1

if %TESTMI%==60 (
	set TESTMI=00
	set /A TESTHH=1%TESTHH% %% 100 + 1
) else if %TESTMI% lss 10 (
	set TESTMI=0%TESTMI%
)

if %TESTHH%==24 (
	set TESTHH=00
) else if %TESTMI% lss 10 (
	set TESTHH=0%TESTHH%
)

echo %TESTHH%:%TESTMI%