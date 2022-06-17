<?php
declare(strict_types=1);

namespace App\Service\Git;

use App\Entity\GitEntity;
use App\Repository\Git\GitRepositoryInterface;
use Exception;
use src\Utility\Sanitizer;

class GitCreateService implements GitCreateServiceInterface
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
     * @return GitEntity|null
     * @throws Exception
     */
    public function create(array $data): GitEntity|null
    {
        $sanitized = Sanitizer::clean($data);
        if(!empty($sanitized)){
            $git = $this->gitEntity
                ->setName($sanitized['name'])
                ->setDescription($sanitized['description'])
                ->setExample($sanitized['example'])
                ->setCreatedAt(date("Y-m-d H:i:s"));
            return $this->gitRepository->create($git);
        }
        return null;
    }
}