<?php

namespace App\Service\Option;

use App\Entity\Option\Option;

class OptionManager
{
    static public $instance;

    public function saveOptionModel(OptionModelInterface $model)
    {
        $option = Option::where(['slug' => $model->getSlug()])->first();

        if (!$option) {
            Option::create([
                'slug'  => $model->getSlug(),
                'value' => serialize($model)
           ])->save();
            return true;
        }

        $option->value = serialize($model);

        $option->save();

        return true;

    }

    public function getOptionModel($slug)
    {
        return Option::where(['slug' => $slug])->first();
    }

    public function get($slug, $fieldName)
    {
        $option = $this->getOptionModel($slug);

        if (!$option) return null;

        $entity = unserialize($option->value);

        if ($entity->$fieldName == null) return null;

        return $entity->$fieldName;
    }

    public function save(OptionModelInterface $model)
    {
        return $this->saveOptionModel($model);
    }

    /**
     * Get the globally available instance of the container.
     *
     * @return static
     */
    public static function getInstance()
    {
        if (is_null(static::$instance)) {
            static::$instance = new static;
        }

        return static::$instance;
    }
}
