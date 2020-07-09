<?php

namespace App\Http\Controllers;

use App\Http\Request\AddPropertyRequest;
use App\Http\Request\AddUpdatePropertyAnalyticsRequest;
use App\Http\Request\GetSummaryOfPropertyAnalyticsRequest;
use App\Http\Response\GetSummaryOfPropertyAnalyticsResponse;
use App\Repositories\PropertyRepositoryInterface;
use App\Repositories\PropertyAnalyticRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    private $propertyRepository;
    private $propertyAnalyticRepository;

    public function __construct(
        PropertyRepositoryInterface $propertyRepository,
        PropertyAnalyticRepositoryInterface $propertyAnalyticRepository
    ){
        $this->propertyRepository = $propertyRepository;
        $this->propertyAnalyticRepository = $propertyAnalyticRepository;
    }

    public function addProperty(Request $request): JsonResponse
    {
        $formattedRequest = new AddPropertyRequest();

        $response = $this->propertyRepository->create(
            $formattedRequest->formatRequest($request)
        );

        return new JsonResponse($response, Response::HTTP_CREATED);
    }

    public function addUpdatePropertyAnalytics(Request $request, int $propertyId): JsonResponse
    {
        $formattedRequest = new AddUpdatePropertyAnalyticsRequest();
        $formattedRequest->setPropertyId($propertyId);

        $response = $this->propertyAnalyticRepository->updateOrCreate(
            $formattedRequest->formatRequest($request)
        );

        return new JsonResponse($response->toArray(), Response::HTTP_OK);
    }

    public function getPropertyAnalytics(int $propertyId): JsonResponse
    {
        $response = $this->propertyRepository->findPropertyAnalyticsByPropertyId($propertyId);

        return new JsonResponse($response->toArray(), Response::HTTP_OK);
    }

    public function getSummaryOfPropertyAnalytics(Request $request): JsonResponse
    {
        $formattedRequest = (new GetSummaryOfPropertyAnalyticsRequest())->formatRequest($request);

        $properties = $this->propertyRepository->findPropertyByFieldName(
            $formattedRequest['field_name'],
            $formattedRequest['field_value']
        );

        $propertyArray = $properties->pluck('id');

        $analytics = $this->propertyAnalyticRepository->getAnalytics(
            $propertyArray->toArray(),
            $formattedRequest['analytic_type']
        );

        $analyticsArray = $analytics->pluck('value');

        $response = new GetSummaryOfPropertyAnalyticsResponse($analyticsArray, $propertyArray);

        return new JsonResponse($response->jsonSerialize(), Response::HTTP_OK);
    }
}
