<?php

namespace Mailery\Channel\Controller;

use Mailery\Channel\Service\ChannelCrudService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Yiisoft\Router\UrlGeneratorInterface as UrlGenerator;
use Yiisoft\Yii\View\ViewRenderer;
use Mailery\Channel\Repository\ChannelRepository;
use Psr\Http\Message\ResponseFactoryInterface as ResponseFactory;
use Mailery\Widget\Search\Form\SearchForm;
use Mailery\Widget\Search\Model\SearchByList;
use Mailery\Channel\Filter\ChannelFilter;
use Mailery\Channel\Search\ChannelSearchBy;
use Mailery\Channel\Model\ChannelTypeList;

class DefaultController
{
    private const PAGINATION_INDEX = 10;

    /**
     * @var ViewRenderer
     */
    private ViewRenderer $viewRenderer;

    /**
     * @var ResponseFactory
     */
    private ResponseFactory $responseFactory;

    /**
     * @var ChannelRepository
     */
    private ChannelRepository $channelRepo;

    /**
     * @param ViewRenderer $viewRenderer
     * @param ResponseFactory $responseFactory
     * @param ChannelRepository $channelRepo
     */
    public function __construct(
        ViewRenderer $viewRenderer,
        ResponseFactory $responseFactory,
        ChannelRepository $channelRepo
    ) {
        $this->viewRenderer = $viewRenderer
            ->withController($this)
            ->withViewBasePath(dirname(dirname(__DIR__)) . '/views');

        $this->responseFactory = $responseFactory;
        $this->channelRepo = $channelRepo;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function index(Request $request, ChannelTypeList $channelTypes): Response
    {
        $queryParams = $request->getQueryParams();
        $pageNum = (int) ($queryParams['page'] ?? 1);
        $searchBy = $queryParams['searchBy'] ?? null;
        $searchPhrase = $queryParams['search'] ?? null;

        $searchForm = (new SearchForm())
            ->withSearchByList(new SearchByList([
                new ChannelSearchBy(),
            ]))
            ->withSearchBy($searchBy)
            ->withSearchPhrase($searchPhrase);

        $filter = (new ChannelFilter())
            ->withSearchForm($searchForm);

        $paginator = $this->channelRepo->getFullPaginator($filter)
            ->withPageSize(self::PAGINATION_INDEX)
            ->withCurrentPage($pageNum);

        return $this->viewRenderer->render('index', compact('searchForm', 'paginator', 'channelTypes'));
    }
}
