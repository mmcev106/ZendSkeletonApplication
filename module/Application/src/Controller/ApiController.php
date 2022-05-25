<?php

namespace Application\Controller;

use App\AbstractAppController;
use Application\Model\Service\GitService;
use GuzzleHttp\Client;
use Zend\View\Model\ViewModel;

class ApiController extends AbstractAppController
{
    /**
     * @var GitService
     * @Inject(name="Application\Model\Service\GitService")
     */
    protected $gitService;

    const API_URL = 'https://api.github.com/search/repositories?q=language:php&sort=stars&order=desc&per_page=100';

    public function indexAction()
    {
        for($page=1 ; $page <10; $page++) {
            $pageUrl = self::API_URL . '&page=' . $page;
            $resultList[] = $this->getList($pageUrl);
            usleep(200000);
        }
        $results = [];
        foreach ($resultList as $list) {
            $result = $this->gitService->insertGitData($list['items']);
            $results = array_merge($results, $result);
        }
        $viewModel = new ViewModel(['results' => $results]);
        $viewModel->setTemplate('application/api/index');
        return $viewModel;

    }

    public function getList($url)
    {
        $options = '';
        $result = $this->doRequest('GET', $url,[]);
        return $this->getFromResult($result);
    }

    public function getConnectionInfo($endpoint)
    {
        return $this->connectionInfo[$endpoint];
    }

    public function doRequest($method, $url,$options)
    {
        try {
            return $this->getClient()->request($method, $url, $options);
        } catch (Throwable $e) {
            error_log("PHP Error: API Request Failed: " . $e->getMessage() . $e->getTraceAsString());
            die("Error");
        }

    }

    public function getClient()
    {
        $this->client = new Client(['defaults' => ['verify' => false]]);
        return $this->client;
    }

    private function getFromResult($result, $key = null)
    {
        $result = json_decode((string)$result->getBody()->getContents(), true);
        if ($key) {
            return $result[$key];
        }
        return $result;
    }

    /**
     * @param GitService $gitService
     * @return ApiController
     */
    public function setGitService($gitService)
    {
        $this->gitService = $gitService;
        return $this;
    }

}