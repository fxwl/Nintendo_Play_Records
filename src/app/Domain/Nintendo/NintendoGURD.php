<?php

namespace App\Domain\Nintendo;

use App\Domain\Nintendo\NintendoInterface as DomainNintendoInterface;


class NintendoGURD
{

    public function GetPlayHistories($Authorization)
    {

        $DomainNintendoInterface = new DomainNintendoInterface();

        $GetPlayHistoriesJson = $DomainNintendoInterface->GetPlayHistories($Authorization);

        $GetPlayHistoriesJsonCode = $DomainNintendoInterface->recur('code', $GetPlayHistoriesJson);

        if ($GetPlayHistoriesJsonCode != '') {

            $clientId = '5c38e31cd085304b';
            $sessionToken = 'eyJhbGciOiJIUzI1NiJ9.eyJleHAiOjE3MjY1NzIxODksImp0aSI6OTg4Mzc3NjQ1MSwiaWF0IjoxNjYzNTAwMTg5LCJhdWQiOiI1YzM4ZTMxY2QwODUzMDRiIiwic3ViIjoiMTg5MDBjNmQ4MzhkN2I4ZSIsInN0OnNjcCI6WzAsOCwxMCwxMiwxN10sImlzcyI6Imh0dHBzOi8vYWNjb3VudHMubmludGVuZG8uY29tIiwidHlwIjoic2Vzc2lvbl90b2tlbiJ9.8ZE3FHm4W3ioj0ywI0qPpWZhCtnhwX8hegVUmxqnxU0';

            $PostAuthorization = $DomainNintendoInterface->PostAuthorization($clientId, $sessionToken);
            $PostAuthorizationJson = json_decode($PostAuthorization);

            $Authorization = $DomainNintendoInterface->recur('access_token', $PostAuthorizationJson);

            $GetPlayHistoriesJson = $DomainNintendoInterface->GetPlayHistories($Authorization);

        }

        return $GetPlayHistoriesJson;
    }

}
