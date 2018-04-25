<?php

namespace App\Traits;

trait RequestsThrottlingCompatibility
{
    /**
     * Resolve request signature.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return string
     */
    protected function resolveRequestSignature($request)
    {
        if ($user = $request->user()) {
            return sha1($user->getAuthIdentifier());
        }

        return sha1($request->server('SERVER_NAME') . '|' . $request->ip());
    }
}
