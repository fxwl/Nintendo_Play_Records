<?php


require '../../Domain/Nintendo/NintendoInterface.php';
require '../../Domain/WeiXin/WeiXin.php';

require '../../functions.php';


$Authorization = 'eyJhbGciOiJSUzI1NiIsImtpZCI6Ijc4MTY0NDJiLTI1N2UtNGZlMi1iNDM2LTkwOTEyNDk2ZDVlZCIsImprdSI6Imh0dHBzOi8vYWNjb3VudHMubmludGVuZG8uY29tLzEuMC4wL2NlcnRpZmljYXRlcyJ9.eyJzdWIiOiIxODkwMGM2ZDgzOGQ3YjhlIiwidHlwIjoidG9rZW4iLCJhYzpzY3AiOlswLDgsMTAsMTIsMTddLCJleHAiOjE2NjM4Mjk4NTUsImlhdCI6MTY2MzgyODk1NSwiYWM6Z3J0Ijo2NCwiYXVkIjoiNWMzOGUzMWNkMDg1MzA0YiIsImlzcyI6Imh0dHBzOi8vYWNjb3VudHMubmludGVuZG8uY29tIiwianRpIjoiMDM4ODIyMTktMDY4ZC00NzQxLTk2OWYtNGFmYTdlNTI3NzYxIn0.bt8aP6BSmKKF-yP28GNIgMdkKhK-HynHR2f1TImertvOs5tu-s71dOvlyTtkcqC26_dfnyS0tOc3-YNnQtTnsgWeXIdAbBx7SPRomc7sbMyXECTVL2T1bSPRmK8SDkVP9g9VHTQUiEZePojUCGhexl2lXDSvnsHhvKAdtiRxIOMrYi8sjBh0W7kGOG0uZyZAzUpQBBe8PVJDg1GVCCLYyoOKFKJxG14ZmZPMg8A-JRJNOXko6aUT4bD3pziqtoR5Ak13x923J-MtQvJEUeeCzfeeo6M9d-EFkhEp1_SCDKvPcodWrvVKlppKnlEjQYDmXgbbWOWOgTKK47Wy5Wy8dw';


//$res = (new App\functions)->GetPlayHistories($Authorization);

$res = (new App\Domain\WeiXin\WeiXin)->getAll('111');


print_r($res);
