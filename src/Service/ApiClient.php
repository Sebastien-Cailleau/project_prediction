<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class ApiClient
{
  private $client;

  public function __construct(HttpClientInterface $httpClientInterface)
  {
    $this->client = $httpClientInterface;
  }

  public function getResponse($apiUrl)
  {
    $response = $this->client->request(
      'GET',
      $apiUrl
    );
    $content = $response->toArray();

    return $content;
  }

  public function getLastResult()
  {
    $lastResult = $this->getResponse('http://ergast.com/api/f1/current/last/results.json');

    $lastResult = $lastResult['MRData']['RaceTable']['Races'][0];
    return $lastResult;
  }

  public function getDriverStandings()
  {
    $driverStandings = $this->getResponse('http://ergast.com/api/f1/current/driverStandings.json');

    $driverStandings = $driverStandings['MRData']['StandingsTable']['StandingsLists'][0]['DriverStandings'];

    return $driverStandings;
  }

  public function getNextRound()
  {
    $nextRound = $this->getResponse('http://ergast.com/api/f1/current/next.json');

    $nextRound = $nextRound['MRData']['RaceTable']['Races'][0];
    dump($nextRound);

    return $nextRound;
  }
}
