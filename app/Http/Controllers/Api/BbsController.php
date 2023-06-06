<?php

namespace App\Http\Controllers\Api;

use App\Handlers\Bbs\Exceptions\ArticleUnauthorized as ArticleUnauthorizedException;
use App\Handlers\Bbs\Exceptions\CommentUnauthorized as CommentUnauthorizedException;
use App\Http\Controllers\Api\Bbs\Requests\AddNewArticle as AddNewArticleRequest;
use App\Http\Controllers\Api\Bbs\Requests\AddNewComment as AddNewCommentRequest;
use App\Http\Controllers\Api\Bbs\Requests\DeleteArticle as DeleteArticleRequest;
use App\Http\Controllers\Api\Bbs\Requests\DeleteComment as DeleteCommentRequest;
use App\Http\Controllers\Api\Bbs\Requests\GetArticle as GetArticleRequest;
use App\Http\Controllers\Api\Bbs\Requests\GetArticleList as GetArticleListRequest;
use App\Http\Controllers\Api\Bbs\Transformers\AddNewArticleFail as AddNewArticleFailTransformer;
use App\Http\Controllers\Api\Bbs\Transformers\AddNewArticleSuccess as AddNewArticleSuccessTransformer;
use App\Http\Controllers\Api\Bbs\Transformers\AddNewCommentFail as AddNewCommentFailTransformer;
use App\Http\Controllers\Api\Bbs\Transformers\AddNewCommentSuccess as AddNewCommentSuccessTransformer;
use App\Http\Controllers\Api\Bbs\Transformers\DeleteArticleFail as DeleteArticleFailTransformer;
use App\Http\Controllers\Api\Bbs\Transformers\DeleteArticleSuccess as DeleteArticleSuccessTransformer;
use App\Http\Controllers\Api\Bbs\Transformers\DeleteCommentFail as DeleteCommentFailTransformer;
use App\Http\Controllers\Api\Bbs\Transformers\DeleteCommentSuccess as DeleteCommentSuccessTransformer;
use App\Http\Controllers\Api\Bbs\Transformers\GetArticleFail as GetArticleFailTransformer;
use App\Http\Controllers\Api\Bbs\Transformers\GetArticleSuccess as GetArticleSuccessTransformer;
use App\Http\Controllers\Api\Bbs\Transformers\GetArticleListFail as GetArticleListFailTransformer;
use App\Http\Controllers\Api\Bbs\Transformers\GetArticleListSuccess as GetArticleListSuccessTransformer;
use App\Http\Controllers\Controller;
use App\Http\Exceptions\Exception as HttpException;
use App\Modules\Command\Factories\Factory as CommandFactory;
use App\Modules\Rns\HandlerRns;
use App\Values\Http\StatusCode as HttpStatusCode;

class BbsController extends Controller
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

    /**
     * @param GetArticleRequest $request
     * @return mixed
     */
    public function getArticle(GetArticleRequest $request)
    {
        try {
            $request->validate();

            $command = $this->factory->create($request);
            $handler = $this->rns->lookup($command);
            $article = $handler->process($command);

            return (new GetArticleSuccessTransformer())->process($article);
        } catch (HttpException $e) {
            return (new GetArticleFailTransformer())->process($e);
        } catch (\Exception $e) {
            return (new GetArticleFailTransformer())->process(
                new HttpException(
                    $e->getMessage(),
                    new HttpStatusCode(HttpStatusCode::HTTP_UNPROCESSABLE_ENTITY)
                )
            );
        }
    }

    /**
     * @param GetArticleListRequest $request
     * @return mixed
     */
    public function getArticleList(GetArticleListRequest $request)
    {
        try {
            $request->validate();

            $command = $this->factory->create($request);
            $handler = $this->rns->lookup($command);
            $result = $handler->process($command);

            return (new GetArticleListSuccessTransformer())->process($result);
        } catch (HttpException $e) {
            return (new GetArticleListFailTransformer())->process($e);
        } catch (\Exception $e) {
            return (new GetArticleListFailTransformer())->process(
                new HttpException(
                    $e->getMessage(),
                    new HttpStatusCode(HttpStatusCode::HTTP_UNPROCESSABLE_ENTITY)
                )
            );
        }
    }

    /**
     * @param AddNewArticleRequest $request
     * @return void
     */
    public function addNewArticle(AddNewArticleRequest $request)
    {
        try {
            $request->validate();

            $command = $this->factory->create($request);
            $handler = $this->rns->lookup($command);
            $article = $handler->process($command);

            return (new AddNewArticleSuccessTransformer())->process($article);
        } catch (HttpException $e) {
            return (new AddNewArticleFailTransformer())->process($e);
        } catch (\Exception $e) {
            return (new AddNewArticleFailTransformer())->process(
                new HttpException(
                    $e->getMessage(),
                    new HttpStatusCode(HttpStatusCode::HTTP_UNPROCESSABLE_ENTITY)
                )
            );
        }
    }

    /**
     * @param DeleteArticleRequest $request
     * @return mixed
     */
    public function deleteArticle(DeleteArticleRequest $request)
    {
        try {
            $request->validate();

            $command = $this->factory->create($request);
            $handler = $this->rns->lookup($command);
            $article = $handler->process($command);

            return (new DeleteArticleSuccessTransformer())->process($article);
        } catch (HttpException $e) {
            return (new DeleteArticleFailTransformer())->process($e);
        } catch (\Exception $e) {
            $statusCode = null;
            switch (get_class($e)) {
                case ArticleUnauthorizedException::class:
                    $statusCode = new HttpStatusCode(HttpStatusCode::HTTP_UNAUTHORIZED);
                    break;
                default:
                    $statusCode = new HttpStatusCode(HttpStatusCode::HTTP_UNPROCESSABLE_ENTITY);
            }
            return (new DeleteArticleFailTransformer())->process(
                new HttpException($e->getMessage(), $statusCode)
            );
        }
    }

    /**
     * @param AddNewCommentRequest $request
     * @return mixed
     */
    public function addNewComment(AddNewCommentRequest $request)
    {
        try {
            $request->validate();

            $command = $this->factory->create($request);
            $handler = $this->rns->lookup($command);
            $article = $handler->process($command);

            return (new AddNewCommentSuccessTransformer())->process($article);
        } catch (HttpException $e) {
            return (new AddNewCommentFailTransformer())->process($e);
        } catch (\Exception $e) {
            return (new AddNewCommentFailTransformer())->process(
                new HttpException(
                    $e->getMessage(),
                    new HttpStatusCode(HttpStatusCode::HTTP_UNPROCESSABLE_ENTITY)
                )
            );
        }
    }

    /**
     * @param DeleteCommentRequest $request
     * @return mixed
     */
    public function deleteComment(DeleteCommentRequest $request)
    {
        try {
            $request->validate();

            $command = $this->factory->create($request);
            $handler = $this->rns->lookup($command);
            $article = $handler->process($command);

            return (new DeleteCommentSuccessTransformer())->process($article);
        } catch (HttpException $e) {
            return (new DeleteCommentFailTransformer())->process($e);
        } catch (\Exception $e) {
            $statusCode = null;
            switch (get_class($e)) {
                case CommentUnauthorizedException::class:
                    $statusCode = new HttpStatusCode(HttpStatusCode::HTTP_UNAUTHORIZED);
                    break;
                default:
                    $statusCode = new HttpStatusCode(HttpStatusCode::HTTP_UNPROCESSABLE_ENTITY);
            }
            return (new DeleteCommentFailTransformer())->process(
                new HttpException($e->getMessage(), $statusCode)
            );
        }
    }
}
