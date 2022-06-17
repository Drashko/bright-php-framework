<?php

namespace App\Service\Git;

use App\Entity\GitEntity;
use App\Repository\Git\GitRepositoryInterface;
use Exception;
use src\Utility\Sanitizer;

class GitUpdateService implements GitUpdateServiceInterface
{

    private GitEntity $gitEntity;

    private GitRepositoryInterface $gitRepository;

    public function __construct(GitEntity $gitEntity, GitRepositoryInterface $gitRepository)
    {
        $this->gitEntity = $gitEntity;
        $this->gitRepository = $gitRepository;
    }

    /**
     * @param array $data
     * @param string $id
     * @return mixed
     * @throws Exception
     */
    public function update(array $data, string $id): mixed
    {
        $sanitized = Sanitizer::clean($data);
        if(!empty($sanitized)){
            $git = $this->gitEntity
                ->setName($sanitized['name'])
                ->setDescription($sanitized['description'])
                ->setExample($sanitized['example'])
                ->setUpdatedAt((date("Y-m-d H:i:s")));
            return $this->gitRepository->update($git, (int) $id);
        }
    }
}