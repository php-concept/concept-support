<?php declare(strict_types=1);

namespace Concept\Support;

use Closure;

final class FactoryResolver
{
    /**
     * @template T of object
     * @param Closure(): mixed $factory
     * @param class-string<T> $expected
     * @return T
     */
    public static function required(Closure $factory, string $expected, string $subject): object
    {
        return ContractGuard::instanceOf($factory(), $expected, $subject);
    }

    /**
     * @template T of object
     * @param (Closure(): mixed)|null $factory
     * @param class-string<T> $expected
     * @return T|null
     */
    public static function optional(?Closure $factory, string $expected, string $subject): ?object
    {
        if ($factory === null) {
            return null;
        }

        return self::required($factory, $expected, $subject);
    }
}
