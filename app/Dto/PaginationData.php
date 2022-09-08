<?php

namespace App\Dto;

use App\Exceptions\PaginatorOutOfBoundException;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\UrlWindow;
use Illuminate\Support\Arr;
use Spatie\DataTransferObject\Casters\ArrayCaster;
use Spatie\DataTransferObject\DataTransferObject;

class PaginationData extends DataTransferObject
{
    public array $items;
    public int $perPage;
    public int $currentPage;
    public int $totalItems;
    public int $showingFromItemNumber;
    public int $showingToItemNumber;
    public LinkData $first;
    public LinkData $previous;
    public LinkData $next;
    public LinkData $last;

    /** @var \App\Dto\LinkData[] */
    #[CastWith(ArrayCaster::class, itemType: LinkData::class)]
    public array $linksBefore;

    /** @var \App\Dto\LinkData[] */
    #[CastWith(ArrayCaster::class, itemType: LinkData::class)]
    public array $linksBetween;

    /** @var \App\Dto\LinkData[] */
    #[CastWith(ArrayCaster::class, itemType: LinkData::class)]
    public array $linksAfter;

    public static function fromPaginator($paginator): self
    {
        return static::make(
            $paginator->items(),
            $paginator->total(),
            $paginator->toArray()['per_page'] ?? Arr::get($paginator->toArray(), 'counts.perPage'),
            $paginator->currentPage(),
            $paginator->getPageName(),
        );
    }

    public static function make(array $items, int $totalItems, int $perPage, ?int $currentPage = null, string $pageName = 'page'): self
    {
        if ($currentPage < 1) {
            $currentPage = 1;
        }

        $paginator = new class (collect($items)->take($perPage)->all(), $totalItems, $perPage, $currentPage, ['path' => Paginator::resolveCurrentPath(), 'pageName' => $pageName]) extends LengthAwarePaginator {
            public $onEachSide = 1;

            public function toArray()
            {
                return $this->toDto()->toArray();
            }

            public function toDto(): PaginationData
            {
                $window = UrlWindow::make($this);

                if ($this->lastPage() < $this->currentPage()) {
                    throw new PaginatorOutOfBoundException();
                }

                return new PaginationData([
                    'items' => $this->items->toArray(),
                    'currentPage' => $this->currentPage(),
                    'perPage' => $this->perPage(),
                    'totalItems' => $this->total(),
                    'showingFromItemNumber' => $this->firstItem() ?? 0,
                    'showingToItemNumber' => $this->lastItem() ?? 0,
                    'first' => $first = new LinkData([
                        'label' => 'First',
                        'href' => collect($this->getUrlRange(1, 1))->first(),
                    ]),
                    'last' => $last = new LinkData([
                        'label' => 'Last',
                        'href' => collect($this->getUrlRange($this->lastPage(), $this->lastPage()))->first(),
                    ]),
                    'previous' => $this->previousPageUrl()
                        ? new LinkData(['label' => 'Previous', 'href' => $this->previousPageUrl()])
                        : $first,
                    'next' => $this->nextPageUrl()
                        ? new LinkData(['label' => 'Next', 'href' => $this->nextPageUrl()])
                        : $last,
                    'linksBefore' => LinkData::arrayOf(
                        collect($window['first'])->map(fn ($url, $page) => ['label' => "{$page}", 'href' => $url])->values()->all()
                    ),
                    'linksBetween' => LinkData::arrayOf(
                        collect($window['slider'])->map(fn ($url, $page) => ['label' => "{$page}", 'href' => $url])->values()->all()
                    ),
                    'linksAfter' => LinkData::arrayOf(
                        collect($window['last'])->map(fn ($url, $page) => ['label' => "{$page}", 'href' => $url])->values()->all()
                    ),
                ]);
            }
        };

        return $paginator->withQueryString()->toDto();
    }
}
