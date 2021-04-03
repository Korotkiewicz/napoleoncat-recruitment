<?php

namespace NapoleonCat\Services;

use NapoleonCat\Services\ATProviderInterface;

class LongLivedATProvider implements ATProviderInterface
{
    /**
     * @param string $pageSocialId
     * @return string
     */
    public function getPageAccessToken(string $pageSocialId): string
    {
        return getenv('LONG_TERM_USER_TOKEN');
    }
}
