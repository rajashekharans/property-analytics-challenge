<?php

namespace App\Http\Request;

use Illuminate\Http\Request;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class GetSummaryOfPropertyAnalyticsRequest
{
    public function formatRequest(Request $request): array
    {
        $validator = Validator::make($request->all(), [
            'analytic_type_id' => 'required',
        ]);

        $validator->after(function ($validator) use ($request) {
            if (!$request->hasAny(['state', 'suburb', 'country'])) {
                $validator->errors()->add('field', 'One of the required field in [suburb, state, country] is missing.');
            }
        });
        ;

        if ($validator->fails()) {
            throw new HttpResponseException(
                response()->json(
                    ['messages' => (new ValidationException($validator))->errors()],
                    JsonResponse::HTTP_UNPROCESSABLE_ENTITY
                )
            );
        }

        $field_name = '';
        if($request->has('state')) {
            $field_name = 'state';
        } else if($request->has('suburb')) {
            $field_name = 'suburb';
        } else if($request->has('country')) {
            $field_name = 'country';
        }

        return [
            'field_name' => $field_name,
            'field_value' => $request->query($field_name),
            'analytic_type' => $request->query('analytic_type_id')
        ];

    }
}
