<?php

namespace App\Api\Controller;

use App\Service\ActivityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Class ApiController
 * @package App\Controller
 * @Route("/api", name="api")
 */
class ApiController extends AbstractController
{
    /**
     * @var ActivityManager
     */
    private $activityManager;

    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * ApiController constructor.
     * @param ActivityManager $activityManager
     */
    public function __construct(ActivityManager $activityManager)
    {
        $this->activityManager = $activityManager;

        $this->serializer = new Serializer(
            [new GetSetMethodNormalizer(), new ArrayDenormalizer()],
            [new JsonEncoder()]
        );
    }

    /**
     * @Route(
     *     "/activities/{limit}/{offset}",
     *     name="activities_list",
     *     requirements={"limit"="\d+", "offset"="\d+"},
     *     methods={"GET"}
     *     )
     * @param int $offset
     * @param int $limit
     * @return JsonResponse
     */
    public function index(int $limit = 20, int $offset = 0) : JsonResponse
    {
        $activities = $this->activityManager->getActivities($limit, $offset);

        $data = $this->serializer->serialize($activities, 'json', [
            'circular_reference_handler' => function ($object) {
                return $object->getId();
            }
        ]);
        return $this->json(['activities' => $data]);
    }

    /**
     * @Route(
     *     "/activities/popular/{isPopular}/{limit}/{offset}",
     *     name="activities_popular",
     *     requirements={"limit"="\d+", "offset"="\d+"},
     *     methods={"GET"}
     *     )
     *
     * @param int $isPopular
     * @param int $limit
     * @param int $offset
     * @return JsonResponse
     */
    public function popular(int $isPopular = 1, int $limit = 20, int $offset = 0) : JsonResponse
    {
        $popular = $this->activityManager->getPopular($limit, $offset);

        $data = $this->serializer->serialize($popular, 'json', [
            'circular_reference_handler' => function ($object) {
                return $object->getId();
            }
        ]);

        return $this->json(['activities' => $data]);
    }

    /**
     * @Route(
     *     "/activities/category/{categoryName}/{limit}/{offset}",
     *     name="categories",
     *     requirements={"limit"="\d+", "offset"="\d+", "categoryName"="\w+"},
     *     methods={"GET"}
     *     )
     *
     * @param string $categoryName
     * @param int $limit
     * @param $offset
     *
     * @return JsonResponse
     */
    public function category(string $categoryName, $limit = 20, $offset = 0) : JsonResponse
    {
        $activities = $this->activityManager->getByCategory($categoryName, $limit, $offset);

        $data = $this->serializer->serialize($activities, 'json', [
            'circular_reference_handler' => function ($object) {
                return $object->getId();
            }
        ]);
        return $this->json(['activities' => $data]);
    }

    /**
     * @Route(
     *     "/activities/maxprice/{price}/{limit}/{offset}",
     *     name="maxprice",
     *     requirements={"limit"="\d+", "offset"="\d+"},
     *     methods={"GET"}
     *     )
     * @param int $price
     * @param int $limit
     * @param int $offset
     *
     * @return JsonResponse
     */
    public function maxPrice(int $price, int $limit = 20, $offset = 0) : JsonResponse
    {
        $activities = $this->activityManager->getByMaxPrice($price, $limit, $offset);

        $data = $this->serializer->serialize($activities, 'json', [
            'circular_reference_handler' => function ($object) {
                return $object->getId();
            }
        ]);

        return $this->json(['activities' => $data]);
    }
}