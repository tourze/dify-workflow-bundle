<?php

declare(strict_types=1);

namespace Tourze\DifyWorkflowBundle\Request;

use HttpClientBundle\Request\ApiRequest;

/**
 * 执行 workflow 请求
 */
final class WorkflowRunRequest extends ApiRequest
{
    public function __construct(
        /** @var array<string, mixed> */
        private readonly array $inputs,
        private readonly string $responseMode,
        private readonly string $user,
    ) {
    }

    public function getRequestPath(): string
    {
        return '/workflows/run';
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
                'inputs' => $this->inputs,
                'response_mode' => $this->responseMode,
                'user' => $this->user,
            ],
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function getInputs(): array
    {
        return $this->inputs;
    }

    public function getResponseMode(): string
    {
        return $this->responseMode;
    }

    public function getUser(): string
    {
        return $this->user;
    }
}
