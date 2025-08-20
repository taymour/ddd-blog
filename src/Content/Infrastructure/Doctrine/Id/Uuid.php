<?php

declare(strict_types=1);

namespace App\Content\Infrastructure\Doctrine\Id;

use App\Content\Domain\Model\UuidInterface;
use Symfony\Component\Uid\Uuid as SymfonyUuid;

final class Uuid implements UuidInterface
{
    private string $uuid;

    private function __construct()
    {
    }

    public static function createNew(): self
    {
        $uuid = new self();
        $uuid->uuid = SymfonyUuid::v4()->toString();

        return $uuid;
    }

    public static function fromString(string $uuid): self
    {
        $instance = new self();
        $instance->uuid = $uuid;

        return $instance;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }
}
