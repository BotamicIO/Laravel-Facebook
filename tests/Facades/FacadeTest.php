<?php

declare(strict_types=1);

/*
 * This file is part of Laravel Facebook.
 *
 * (c) Brian Faust <hello@basecode.sh>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Artisanry\Tests\Facebook\Facades;

use Artisanry\Facebook\Facades\Facebook;
use Artisanry\Facebook\FacebookManager;
use Artisanry\Tests\Facebook\AbstractTestCase;
use GrahamCampbell\TestBenchCore\FacadeTrait;

class FacadeTest extends AbstractTestCase
{
    use FacadeTrait;

    /**
     * Get the facade accessor.
     *
     * @return string
     */
    protected function getFacadeAccessor()
    {
        return 'facebook.auth.manager';
    }

    /**
     * Get the facade class.
     *
     * @return string
     */
    protected function getFacadeClass()
    {
        return Facebook::class;
    }

    /**
     * Get the facade root.
     *
     * @return string
     */
    protected function getFacadeRoot()
    {
        return FacebookManager::class;
    }
}
