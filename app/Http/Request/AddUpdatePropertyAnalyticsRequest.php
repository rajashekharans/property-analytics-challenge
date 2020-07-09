<?php
namespace App\Http\Request;

use Illuminate\Http\Request;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AddUpdatePropertyAnalyticsRequest
{
    private $propertyId;

    public function setPropertyId(int $propertyId): void
    {
        $this->propertyId = $propertyId;
    }

    public function getPropertyId(): int
    {
        return $this->propertyId;
    }

    public function formatRequest(Request $request): array
    {
        $data = $request->all();

        $data['property_id'] = $this->getPropertyId();

        $validator = Validator::make($data, [
            'analytic_type_id' => 'required',
            'value' => 'required',
        ]);

        if ($validator->fails()) {
            throw new HttpResponseException(
                response()->json(
                    ['messages' => (new ValidationException($validator))->errors()],
                    JsonResponse::HTTP_UNPROCESSABLE_ENTITY
                )
            );
        }

        return $data;
    }
}
