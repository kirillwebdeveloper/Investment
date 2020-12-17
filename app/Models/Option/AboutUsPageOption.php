<?php

namespace App\Models\Option;

use App\Service\Option\OptionModelInterface;

class AboutUsPageOption extends AbstractOptionModel implements OptionModelInterface
{
    /** @var string */
    protected $title;

    /** @var string */
    protected $body;

    public function getSlug()
    {
        return 'about_page';
    }
}
