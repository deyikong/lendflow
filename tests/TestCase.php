<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Tests\Traits\ActingJWTUser;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use ActingJWTUser;
}
