<?php


namespace App\Service;


use App\Repository\ActivityRepository;

/**
 * Class ActivityManager
 * @package App\Service
 */
class ActivityManager
{
    /**
     * @var ActivityRepository
     */
    private $activityRepository;

    /**
     * ActivityManager constructor.
     * @param ActivityRepository $repo
     */
    public function __construct(ActivityRepository $repo)
    {
        $this->activityRepository = $repo;
    }

    /**
     * Find all activities
     * @param null $limit
     * @param null $offset
     * @return array|null
     */
    public function getActivities($limit = null, $offset = null) : ?array
    {
        return $this->activityRepository->findBy(
            [],
            [],
            $limit,
            $offset
        );
    }

    /**
     * Find all popular activities
     * @param null $limit
     * @param null $offset
     * @return array|null
     */
    public function getPopular($limit = null, $offset = null) : ?array
    {
        return $this->activityRepository->findBy(
            ['popular' => 1],
            [],
            $limit,
            $offset
        );
    }

    /**
     * Find all activities with specific category
     * @param string $category
     * @param null $limit
     * @param null $offset
     * @return array|null
     */
    public function getByCategory(string $category, $limit = null, $offset = null) : ?array
    {
        return $this->activityRepository->findByCategory($category, $limit, $offset);
    }

    /**
     * Find all activities with price less than $price param
     * @param int $price
     * @param null $limit
     * @param null $offset
     * @return array|null
     */
    public function getByMaxPrice(int $price, $limit = null, $offset = null) : ?array
    {
        return $this->activityRepository->findByMaxPrice($price, $limit, $offset);
    }
}