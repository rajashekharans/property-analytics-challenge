<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Repositories\PropertyRepositoryInterface;
use App\Repositories\PropertyAnalyticRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

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
        $validator = Validator::make($request->all(), [
            'suburb' => 'required',
            'state' => 'required',
            'country' => 'required'
        ]);

        if ($validator->fails()) {
            $response['response'] = $validator->messages();
            return new JsonResponse($response, Response::HTTP_BAD_REQUEST);
        }

        $response = $this->propertyRepository->create($request->all());

        return new JsonResponse($response, Response::HTTP_CREATED);
    }

    public function addUpdatePropertyAnalytics(Request $request, int $propertyId): JsonResponse
    {
        $data = $request->all();

        $data['property_id'] = $propertyId;

        $validator = Validator::make($data, [
            'analytic_type_id' => 'required',
            'value' => 'required',
        ]);

        if ($validator->fails()) {
            $response['response'] = $validator->messages();
            return new JsonResponse($response, Response::HTTP_BAD_REQUEST);
        }

        $response = $this->propertyAnalyticRepository->updateOrCreate($data);

        return new JsonResponse($response->toArray(), Response::HTTP_OK);
    }

    public function getPropertyAnalytics(int $propertyId): JsonResponse
    {
        $response = $this->propertyRepository->findPropertyAnalyticsByPropertyId($propertyId);

        return new JsonResponse($response->toArray(), Response::HTTP_OK);
    }
}
