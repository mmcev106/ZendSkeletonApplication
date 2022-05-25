<?php

namespace Application\Model\Service;

use App\Di\InjectableInterface;
use Application\Model\Repository\GitApiRepository;
use Composer\Util\Git;

class GitService implements InjectableInterface
{
    /**
     * @var GitApiRepository
     * @Inject(name="Application\Model\Repository\GitApiRepository")
     */
    protected $gitRepo;

    public function insertGitData($data)
    {
        $this->gitRepo->clearDataTable();
        foreach ($data as $gitInfo) {
            $this->gitRepo->insertData($this->cleanUpData($gitInfo));
        }
        return $this->gitRepo->getData();
    }

    public function getGitData()
    {
        return $this->gitRepo->getData();
    }


    public function cleanUpData($list)
    {
        $newList = [];
            $newList['git_id'] = $list['id'];
            $newList['full_name'] = $list['name'];
            $newList['url'] = $list['html_url'];
            $newList['created_date'] = $list['created_at'];
            $newList['last_push_date'] = $list['pushed_at'];
            if(strlen($list['description']) > 255){
                $newList['project_description'] = utf8_encode(substr($list['description'],0,252)."...");
            }
            else{
                $newList['project_description'] = $list['description'];
            }
            $newList['number_of_stars'] = $list['stargazers_count'];
        return $newList;
    }

    /**
     * @param GitApiRepository $gitRepo
     * @return GitService
     */
    public function setGitRepo($gitRepo)
    {
        $this->gitRepo = $gitRepo;
        return $this;
    }
}