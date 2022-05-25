<?php

namespace Application\Model\Entity;

use App\Model\Entity\AbstractEntity;

class GitDataEntity extends AbstractEntity implements \JsonSerializable
{
    /**
     * @var int
     */
    public $id;
    /**
     * @var string
     */
    public $gitId;
    /**
     * @var string
     */
    public $fullName;
    /**
     * @var string
     */
    public $url;
    /**
     * @var string
     */
    public $createdDate;
    /**
     * @var string
     */
    public $lastPushDate;
    /**
     * @var string
     */
    public $projectDesc;
    /**
     * @var string
     */
    public $numberOfStars;

    public function getMetadata()
    {
        $this->setRepositoryName(\Application\Model\Repository\GitApiRepository::class);
        $this->setTable('gitData');
        $this->setField('id', 'int', null, true);
        $this->setField('git_id', null, 'gitId');
        $this->setField('full_name', null, 'fullName');
        $this->setField('url', null, 'url');
        $this->setField('created_date', null, 'createdDate');
        $this->setField('last_push_date', null, 'lastPushDate');
        $this->setField('project_description', null, 'projectDesc');
        $this->setField('number_of_stars', null, 'numberOfStars');
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * @param string $fullName
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    /**
     * @param string $createdDate
     */
    public function setCreatedDate($createdDate)
    {
        $this->createdDate = $createdDate;
    }

    /**
     * @return string
     */
    public function getLastPushDate()
    {
        return $this->lastPushDate;
    }

    /**
     * @param string $lastPushDate
     */
    public function setLastPushDate($lastPushDate)
    {
        $this->lastPushDate = $lastPushDate;
    }

    /**
     * @return string
     */
    public function getProjectDesc()
    {
        return $this->projectDesc;
    }

    /**
     * @param string $projectDesc
     */
    public function setProjectDesc($projectDesc)
    {
        $this->projectDesc = $projectDesc;
    }

    /**
     * @return string
     */
    public function getNumberOfStars()
    {
        return $this->numberOfStars;
    }

    /**
     * @param string $numberOfStars
     */
    public function setNumberOfStars($numberOfStars)
    {
        $this->numberOfStars = $numberOfStars;
    }
    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'gitId' => $this->gitId,
            'fullName' => $this->fullName,
            'url' => $this->url,
            'createdDate' => $this->createdDate,
            'lastPushDate' => $this->lastPushDate,
            'projectDesc' => $this->projectDesc,
            'numberOfStars' => $this->numberOfStars,
        ];
    }

    /**
     * @return string
     */
    public function getGitId()
    {
        return $this->gitId;
    }

    /**
     * @param string $gitId
     */
    public function setGitId($gitId)
    {
        $this->gitId = $gitId;
    }
}