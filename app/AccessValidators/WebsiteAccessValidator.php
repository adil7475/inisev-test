<?php

namespace App\AccessValidators;

use App\Models\User;
use App\Models\Website;

class WebsiteAccessValidator
{
    /**
     * @param User $user
     * @param Website $website
     * @return mixed
     */
    public function isUserAlreadySubscribedToWebsite(User $user, Website $website)
    {
        return $user->websites->contains($website);
    }
}
