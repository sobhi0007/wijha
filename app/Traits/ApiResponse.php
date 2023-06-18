<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

trait ApiResponse
{
    /**
     * Resource was successfully created
     *
     * @param $data
     *
     * @return JsonResponse
     */
    protected function createdResponse($data): JsonResponse
    {
        $response = $this->successResponse(
            Response::HTTP_CREATED,
            $data,
            trans('lang.api_created')
        );

        return response()->json($response, Response::HTTP_CREATED);
    }

    /**
     * Resource was successfully updated
     *
     * @param $data
     *
     * @return JsonResponse
     */
    protected function updatedResponse($data): JsonResponse
    {
        $response = $this->successResponse(Response::HTTP_OK, $data, trans('lang.api_updated'));

        return response()->json($response, Response::HTTP_OK);
    }

    /**
     * Resource was successfully deleted
     *
     * @return JsonResponse
     */
    protected function deletedResponse(): JsonResponse
    {
        $response = $this->successResponse(
            Response::HTTP_NO_CONTENT,
            [],
            trans('lang.api_deleted')
        );

        return response()->json($response, Response::HTTP_NO_CONTENT);
    }

    /**
     * Returns general error
     *
     * @param $errors
     *
     * @return JsonResponse
     */
    protected function ApiErrorResponse($errors = null, $message = null): JsonResponse
    {
        $response = $this->errorResponse(Response::HTTP_BAD_REQUEST, $errors, $message);

        return response()->json($response, Response::HTTP_BAD_REQUEST);
    }

    /**
     * Returns general error
     *
     * @param null $data
     * @param null $message
     *
     * @return JsonResponse
     */
    protected function ApiSuccessResponse($data = null, $message = null): JsonResponse
    {
        $response = $this->successResponse(Response::HTTP_OK, $data, $message);

        return response()->json($response, Response::HTTP_OK);
    }

    /**
     * Client does not have proper permissions to perform action.
     *
     * @return JsonResponse
     */
    protected function unAuthorizedResponse(): JsonResponse
    {
        $response = $this->errorResponse(Response::HTTP_FORBIDDEN, null, trans('lang.api_unauthorized'));

        return response()->json($response, Response::HTTP_FORBIDDEN);
    }

    /**
     * @return JsonResponse
     */
    protected function unAuthenticatedResponse($data = null, $message = null): JsonResponse
    {
        $response = $this->errorResponse(
            Response::HTTP_UNAUTHORIZED,
            $data,
            $message != null ? $message : trans('lang.api_unauthenticated')
        );

        return response()->json($response, Response::HTTP_UNAUTHORIZED);
    }

    /**
     * Returns a list of resources
     *
     * @param array $data
     *
     * @return JsonResponse
     */
    protected function listResponse($data): JsonResponse
    {
        $response = $this->successResponse(Response::HTTP_OK, $data, trans('lang.api_ok'));

        return response()->json($response, Response::HTTP_OK);
    }

    /**
     * Requested resource wasn't found
     *
     * @return JsonResponse
     */
    protected function notFoundResponse(): JsonResponse
    {
        $response = $this->errorResponse(Response::HTTP_NOT_FOUND, [], trans('lang.api_notfound'));

        return response()->json($response, Response::HTTP_NOT_FOUND);
    }

    /**
     * Return information for single resource
     *
     * @param $data
     *
     * @return JsonResponse
     */
    protected function showResponse($data): JsonResponse
    {
        $response = $this->successResponse(Response::HTTP_OK, $data, trans('lang.api_ok'));

        return response()->json($response, Response::HTTP_OK);
    }

    /**
     * Return error when request is properly formatted, but contains validation errors
     *
     * @param $errors_array
     *
     * @return JsonResponse
     */
    protected function validationErrorResponse($errors_array): JsonResponse
    {
        $errors = [];

        foreach ($errors_array as $key => $value) {
            $errors[$key] = [
                $value[0]
                // 'field' => $key,
                // 'error' => $value[0],
            ];
        }

        $response = $this->errorResponse(
            Response::HTTP_UNPROCESSABLE_ENTITY,
            compact('errors'),
            trans('lang.api_unprocessableEntity')
        );

        return response()->json($response, Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * Standard error envelope structure
     *
     * @param int    $code
     * @param mixed  $errors
     * @param string $message
     *
     * @return array
     */
    protected function errorResponse(
        int $code = Response::HTTP_BAD_REQUEST,
        $errors = [],
        string $message = 'Bad Request'
    ): array {
        $response = [
            'status' => false,
            'code' => $code,
            'message' => $message,
        ];

        is_array($errors)
            ? $response = array_merge($response, $errors)
            : $response['errors'] = $errors;

        return $response;
    }

    /**
     * Standard success envelope structure
     *
     * @param int    $code
     * @param mixed  $data
     * @param string $message
     *
     * @return array
     */
    protected function successResponse(int $code = Response::HTTP_OK, $data = [], string $message = 'OK'): array
    {
        $response = [
            'status' => true,
            'code' => $code,
            'message' => $message,
        ];

        // is_array($data) ? $response = array_merge($response, $data) : $response['data'] = $data;
        $response['data'] = $data;

        return $response;
    }
}
