<?php

declare(strict_types=1);

/*
 * This file is part of the tenancy/tenancy package.
 *
 * Copyright Tenancy for Laravel
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @see https://tenancy.dev
 * @see https://github.com/tenancy
 */

namespace Tenancy\Affects\Routes\Events;

use Illuminate\Routing\RouteCollection;
use Illuminate\Routing\Router;
use Tenancy\Identification\Events\Switched;

class ConfigureRoutes
{
    public function __construct(
        public Switched $event,
        public Router $router
    ) {}

    /**
     * Flush all tenant routes for this request.
     *
     * @return $this
     */
    public function flush()
    {
        $this->router->setRoutes(new RouteCollection());

        return $this;
    }

    /**
     * Adds routes from a routes.php file to the current request.
     *
     * @param array  $attributes
     * @param string $path
     *
     * @return $this
     */
    public function fromFile(array $attributes, string $path): static
    {
        $this->router->group($attributes, $path);

        return $this;
    }
}
