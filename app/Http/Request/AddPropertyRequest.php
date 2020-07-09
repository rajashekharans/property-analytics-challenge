<?php
namespace App\Http\Request;

use Illuminate\Http\Request;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AddPropertyRequest
{
    public function formatRequest(Request $request): array
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'suburb' => 'required',
            'state' => 'required',
            'country' => 'required'
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
