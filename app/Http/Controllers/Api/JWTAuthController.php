<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Auth\Requests\Leave as AuthLeaveRequest;
use App\Http\Controllers\Api\Auth\Requests\Login as AuthLoginRequest;
use App\Http\Controllers\Api\Auth\Requests\Refresh as AuthRefreshRequest;
use App\Http\Controllers\Api\Auth\Requests\Register as AuthRegisterRequest;
use App\Http\Controllers\Api\Auth\Transformers\LeaveFail as LeaveFailTransformer;
use App\Http\Controllers\Api\Auth\Transformers\LeaveSuccess as LeaveSuccessTransformer;
use App\Http\Controllers\Api\Auth\Transformers\LoginFail as LoginFailTransformer;
use App\Http\Controllers\Api\Auth\Transformers\LoginSuccess as LoginSuccessTransformer;
use App\Http\Controllers\Api\Auth\Transformers\RefreshFail as RefreshFailTransformer;
use App\Http\Controllers\Api\Auth\Transformers\RefreshOk as RefreshOkTransformer;
use App\Http\Controllers\Api\Auth\Transformers\RegisterFail as RegisterFailTransformer;
use App\Http\Controllers\Api\Auth\Transformers\RegisterOk as RegisterOkTransformer;
use App\Http\Controllers\Controller;
use App\Http\Exceptions\Exception as HttpException;
use App\Modules\Command\Factories\Factory as CommandFactory;
use App\Modules\Rns\HandlerRns;
use App\Values\Http\StatusCode as HttpStatusCode;
use Illuminate\Support\Facades\Auth;

class JWTAuthController extends Controller
{
    private CommandFactory $factory;
    private HandlerRns $rns;

    /**
     * @param CommandFactory $factory
     * @param HandlerRns $rns
     */
    public function __construct(CommandFactory $factory, HandlerRns $rns)
    {
        $this->factory = $factory;
        $this->rns = $rns;
    }

    protected function packResult(mixed $data, HttpStatusCode $code = new HttpStatusCode(HttpStatusCode::HTTP_OK))
    {
        return [$data, $code];
    }

    public function register(AuthRegisterRequest $request)
    {
        try {
            $request->validate();

            $command = $this->factory->create($request);
            $handler = $this->rns->lookup($command);
            $customer = $handler->process($command);

            return (new RegisterOkTransformer())->process($this->packResult($customer, (new HttpStatusCode(HttpStatusCode::HTTP_CREATED))));
        } catch (HttpException $e) {
            return (new RegisterFailTransformer())->process($e);
        } catch (\Exception $e) {
            return (new RegisterFailTransformer())->process(
                new HttpException(
                    $e->getMessage(),
                    new HttpStatusCode(HttpStatusCode::HTTP_UNPROCESSABLE_ENTITY)
                )
            );
        }
    }

    /**
     * 로그인을 수행한다.
     *
     * @param AuthLoginRequest $request
     *
     * @return mixed
     */
    public function login(AuthLoginRequest $request)
    {
        try {
            $request->validate();

            $command = $this->factory->create($request);
            $handler = $this->rns->lookup($command);
            $token = $handler->process($command);
            if (is_null($token)) {
                throw new HttpException('회원 인증에 실패하였습니다.', new HttpStatusCode(HttpStatusCode::HTTP_UNAUTHORIZED));
            }

            return (new LoginSuccessTransformer())->process($token);
        } catch (HttpException $e) {
            return (new LoginFailTransformer())->process($e);
        } catch (\Exception $e) {
            return (new LoginFailTransformer())->process(
                new HttpException(
                    $e->getMessage(),
                    new HttpStatusCode(HttpStatusCode::HTTP_UNPROCESSABLE_ENTITY)
                )
            );
        }
    }

    /**
     * 인증 토큰 재발행을 수행한다.
     *
     * @param AuthRefreshRequest $request
     *
     * @return mixed
     */
    public function refresh(AuthRefreshRequest $request)
    {
        try {
            $request->validate();

            $command = $this->factory->create($request);
            $handler = $this->rns->lookup($command);
            $token = $handler->process($command);

            return (new RefreshOkTransformer())->process($this->packResult($token));
        } catch (HttpException $e) {
            return (new RefreshFailTransformer())->process($e);
        } catch (\Exception $e) {
            return (new RefreshFailTransformer())->process(
                new HttpException(
                    $e->getMessage(),
                    new HttpStatusCode(HttpStatusCode::HTTP_UNPROCESSABLE_ENTITY)
                )
            );
        }
    }

    /**
     * 서비스를 탈퇴한다.
     *
     * @param AuthLeaveRequest $request
     *
     * @return mixed
     */
    public function leave(AuthLeaveRequest $request)
    {
        try {
            $request->validate();

            $command = $this->factory->create($request);
            $handler = $this->rns->lookup($command);
            $token = $handler->process($command);

            return (new LeaveSuccessTransformer())->process($token);
        } catch (HttpException $e) {
            return (new LeaveFailTransformer())->process($e);
        } catch (\Exception $e) {
            return (new LeaveFailTransformer())->process(
                new HttpException(
                    $e->getMessage(),
                    new HttpStatusCode(HttpStatusCode::HTTP_UNPROCESSABLE_ENTITY)
                )
            );
        }
    }

    public function logout()
    {
        Auth::guard('api')->logout();

        return response()->json([
            'status' => 'success',
            'message' => 'logout'
        ], 200);
    }

    public function user()
    {
        return response()->json(Auth::guard('api')->user());
    }
}
