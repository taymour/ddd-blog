<?php

declare(strict_types=1);

namespace App\Content\Infrastructure\Symfony\Listener;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

final class ExceptionListener
{
    public function __construct(
        private readonly KernelInterface $kernel,
    ) {}

    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        if ($this->kernel->getEnvironment() === 'dev') {
            return;
        }

        $statusCode = $exception instanceof HttpExceptionInterface
            ? $exception->getStatusCode()
            : JsonResponse::HTTP_INTERNAL_SERVER_ERROR;

        $data = [
            'error' => [
                'message' => $exception->getMessage(),
                'code' => $statusCode,
            ],
        ];

        $response = new JsonResponse($data, $statusCode);

        $event->setResponse($response);
    }
}
