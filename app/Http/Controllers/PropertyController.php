<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\PropertyRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class PropertyController extends Controller
{
    private $propertyRepository;

    public function __construct(PropertyRepositoryInterface $propertyRepository)
    {
        $this->propertyRepository = $propertyRepository;
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
}
