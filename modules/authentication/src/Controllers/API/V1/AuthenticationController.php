<?php


namespace ShakilAhmmed\ImageUploader\Authentication\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use ShakilAhmmed\ImageUploader\Authentication\Actions\TokenGenerateAction;
use ShakilAhmmed\ImageUploader\Authentication\Requests\LoginFormRequest;
use ShakilAhmmed\ImageUploader\Authentication\Requests\RegisterFormRequest;
use Symfony\Component\HttpFoundation\Response;

class AuthenticationController extends Controller
{
    /**
     * @param RegisterFormRequest $request
     * @param User $user
     * @return JsonResponse
     */
    public function register(RegisterFormRequest $request, User $user): JsonResponse
    {
        try {
            $user->fill($request->all())->save();
            return $this->successResponse($user, 'User successfully register.', Response::HTTP_OK);
        } catch (Exception $exception) {
            return $this->errorResponse($exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @param LoginFormRequest $request
     * @param TokenGenerateAction $tokenGenerateAction
     * @return JsonResponse
     */
    public function login(LoginFormRequest $request, TokenGenerateAction $tokenGenerateAction): JsonResponse
    {
        if (!auth()->attempt($request->only('email', 'password'))) {
            return $this->errorResponse('UnAuthorised Access', Response::HTTP_UNAUTHORIZED);
        }

        [$tokenGenerate, $accessToken] = $tokenGenerateAction->handle();

        $response = [
            'user' => auth()->user(),
            'token_type' => 'Bearer',
            'access_token' => $accessToken,
            'expires_at' => Carbon::parse(
                $tokenGenerate->token->expires_at
            )->toDateTimeString()

        ];
        return $this->successResponse($response, 'Authorised Access.', Response::HTTP_OK);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        $request->user()->token()->revoke();
        return $this->successResponse([], 'ou have been successfully logged out!', Response::HTTP_OK);
    }

    /**
     * @param TokenGenerateAction $tokenGenerateAction
     * @return JsonResponse
     */
    public function refresh(TokenGenerateAction $tokenGenerateAction): JsonResponse
    {
        try {
            [$tokenGenerate, $accessToken] = $tokenGenerateAction->handle();
            $response = [
                'token' => $accessToken,
                'user' => auth()->user(),
                'token_type' => 'Bearer',
                'expires_at' => Carbon::parse(
                    $tokenGenerate->token->expires_at
                )->toDateTimeString()
            ];
            return $this->successResponse($response, 'Authorised Access.', Response::HTTP_OK);
        } catch (Exception $e) {
            return $this->errorResponse('User does not exist', Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

}
