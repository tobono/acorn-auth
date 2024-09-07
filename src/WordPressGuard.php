<?php

namespace Tobono\Auth;

use Illuminate\Auth\SessionGuard;

class WordPressGuard extends SessionGuard
{

    public function user()
    {
        if ($this->loggedOut) {
            return;
        }


        // If we've already retrieved the user for the current request we can just
        // return it back immediately. We do not want to fetch the user data on
        // every call to this method because that would be tremendously slow.
        if (! is_null($this->user)) {
            return $this->user;
        }

        $id = get_current_user_id();

        if($id !== 0 && $this->user = $this->provider->retrieveById($id)) {
            $this->fireAuthenticatedEvent($this->user);
        }

        return $this->user;
    }
}
