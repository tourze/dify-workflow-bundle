<?php

declare(strict_types=1);

namespace Tourze\DifyWorkflowBundle\Request;

use HttpClientBundle\Request\ApiRequest;

/**
 * 获取 workflow 日志请求
 */
final class GetWorkflowLogsRequest extends ApiRequest
{
    public function __construct(
        private readonly ?string $keyword = null,
        private readonly ?string $status = null,
        private readonly int $page = 1,
        private readonly int $limit = 20,
    ) {
    }

    public function getRequestPath(): string
    {
        return '/workflows/logs';
    }

    public function getRequestMethod(): string
    {
        return 'GET';
    }

    /**
     * @return array<string, mixed>
     */
    public function getRequestOptions(): array
    {
        $query = [];

        if (null !== $this->keyword) {
            $query['keyword'] = $this->keyword;
        }

        if (null !== $this->status) {
            $query['status'] = $this->status;
        }

        if (1 !== $this->page) {
            $query['page'] = $this->page;
        }

        if (20 !== $this->limit) {
            $query['limit'] = $this->limit;
        }

        return [
            'query' => $query,
        ];
    }

    public function getKeyword(): ?string
    {
        return $this->keyword;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }
}
