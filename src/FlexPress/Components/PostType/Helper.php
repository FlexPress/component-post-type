<?php

namespace FlexPress\Components\PostType;

class Helper
{

    /**
     * @var \SplObjectStorage
     * @author Tim Perry
     */
    protected $postTypes;

    public function __construct(\SplObjectStorage $postTypes, array $postTypeArray)
    {
        $this->postTypes = $postTypes;

        if (!empty($postTypeArray)) {

            foreach ($postTypeArray as $postType) {

                if (!$postType instanceof AbstractPostType) {

                    $message = "One or more of the post types you have passed to ";
                    $message .= get_class($this);
                    $message .= " does not extend the AbstractPostType class.";

                    throw new \RuntimeException($message);

                }

                $this->postTypes->attach($postType);

            }

        }

    }

    /**
     * Registers all the post types added
     * @author Tim Perry
     */
    public function registerPostTypes()
    {

        if (!function_exists('register_post_type')) {
            return;
        }

        $this->postTypes->rewind();
        while ($this->postTypes->valid()) {

            $postType = $this->postTypes->current();
            register_post_type($postType->getName(), $postType->getArgs());
            $this->postTypes->next();

        }

    }
}
