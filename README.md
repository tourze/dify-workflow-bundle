# Dify Workflow Bundle

[English](README.md) | [中文](README.zh-CN.md)

Symfony Bundle for Dify AI workflow execution, task management, and logging capabilities.

## Features

- **Workflow Execution**: Execute Dify workflows with parameter passing
- **Task Management**: Monitor and control workflow tasks
- **Logging System**: Comprehensive workflow execution logging
- **Status Tracking**: Real-time workflow and task status monitoring
- **Stop Control**: Ability to stop running workflow tasks

## Installation

```bash
composer require tourze/dify-workflow-bundle
```

## Configuration

Add the bundle to your `config/bundles.php`:

```php
return [
    // ... other bundles
    Tourze\DifyWorkflowBundle\DifyWorkflowBundle::class => ['all' => true],
];
```

## API Endpoints

- **Execute Workflow**: Start workflow execution with parameters
- **Get Workflow Logs**: Retrieve detailed execution logs  
- **Stop Workflow Task**: Terminate running workflow tasks

## Usage

```php
// Execute a workflow
$workflowService->executeWorkflow($appId, $userId, $inputs);

// Get workflow logs
$logs = $workflowService->getWorkflowLogs($workflowId);

// Stop a workflow task
$workflowService->stopWorkflowTask($taskId);
```

## Requirements

- PHP 8.1+
- Symfony 7.3+
- tourze/dify-core-bundle

## License

This bundle is released under the MIT license. See the [LICENSE](LICENSE) file for details.