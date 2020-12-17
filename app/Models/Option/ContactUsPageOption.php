<?php

namespace App\Models\Option;

use App\Service\Option\OptionModelInterface;

class ContactUsPageOption extends AbstractOptionModel implements OptionModelInterface
{
    /**
     * @var string
     */
    protected $beforeImage;

    /**
     * @var string
     */
    protected $afterImage;

    /**
     * @var string
     */
    protected $image;

    public function getSlug()
    {
        return 'contact_page';
    }
}
