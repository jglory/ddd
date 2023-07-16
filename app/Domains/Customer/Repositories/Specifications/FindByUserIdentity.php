<?php

namespace App\Domains\Customer\Repositories\Specifications;

use App\Models\Repository\Specification;
use App\Values\EmailAddress;

/**
 * FindByUserIdentity specification
 */
class FindByUserIdentity extends Specification
{
    public readonly EmailAddress $email;
    public readonly string $password;

    /**
     * @param EmailAddress $email
     * @param string $password
     */
    public function __construct(EmailAddress $email, string $password)
    {
        $this->email = $email;
        $this->password = $password;
    }
}
