<?php

namespace Mailery\Channel\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Yiisoft\Yii\View\ViewRenderer;
use Mailery\Channel\Repository\ChannelRepository;
use Mailery\Widget\Search\Form\SearchForm;
use Mailery\Widget\Search\Model\SearchByList;
use Mailery\Channel\Filter\ChannelFilter;
use Mailery\Channel\Search\ChannelSearchBy;
use Mailery\Channel\Model\ChannelTypeList;

class DefaultController
{
    private const PAGINATION_INDEX = 10;

    /**
     * @param ViewRenderer $viewRenderer
     * @param ChannelRepository $channelRepo
     */
    public function __construct(
        private ViewRenderer $viewRenderer,
        private ChannelRepository $channelRepo
    ) {
        $this->viewRenderer = $viewRenderer
            ->withController($this)
            ->withViewPath(dirname(dirname(__DIR__)) . '/views');
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
