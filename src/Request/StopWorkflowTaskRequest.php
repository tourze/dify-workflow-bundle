<?php

declare(strict_types=1);

namespace Tourze\DifyWorkflowBundle\Request;

use HttpClientBundle\Request\ApiRequest;

/**
 * 停止响应 workflow 任务请求
 */
final class StopWorkflowTaskRequest extends ApiRequest
{
    public function __construct(
        private readonly string $taskId,
        private readonly string $user,
    ) {
    }

    public function getRequestPath(): string
    {
        return "/workflows/tasks/{$this->taskId}/stop";
    }

    public function getRequestMethod(): string
    {
        return 'POST';
    }

    /**
     * @return array<string, mixed>
     */
    public function getRequestOptions(): array
    {
        return [
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'user' => $this->user,
            ],
        ];
    }

    public function getTaskId(): string
    {
        return $this->taskId;
    }

    public function getUser(): string
    {
        return $this->user;
    }
}
