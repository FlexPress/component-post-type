<?php

namespace FlexPress\Components\PostType;

abstract class AbstractPostType
{

    /**
     * Gets the singular name
     *
     * @return string
     * @author Tim Perry
     */
    public function getSingularName()
    {
        return ucwords($this->getName());
    }

    /**
     * Gets the plural name
     *
     * @return string
     * @author Tim Perry
     */
    public function getPluralName()
    {
        return $this->getSingularName() . "s";
    }

    /**
     *
     * Gets the args
     *
     * @return array
     * @author Tim Perry
     */
    public function getArgs()
    {
        return array(
            'labels' => $this->getLabels(),
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'rewrite' => array('slug' => strtolower($this->getSingularName())),
            'capability_type' => 'post',
            'has_archive' => true,
            'hierarchical' => false,
            'menu_position' => null,
            'supports' => array('title', 'editor', 'thumbnail')
        );
    }

    /**
     * Gets the labels used in the args
     *
     * @return array
     * @author Tim Perry
     */
    protected function getLabels()
    {
        $pluralName = $this->getPluralName();
        $singularName = $this->getSingularName();

        return array(
            'name' => $singularName,
            'singular_name' => $singularName,
            'add_new' => 'Add New',
            'add_new_item' => 'Add New ' . $singularName,
            'edit_item' => 'Edit ' . $singularName,
            'new_item' => 'New ' . $singularName,
            'all_items' => 'All ' . $pluralName,
            'view_item' => 'View ' . $singularName,
            'search_items' => 'Search ' . $pluralName,
            'not_found' => 'No ' . $pluralName . ' found',
            'not_found_in_trash' => 'No ' . $pluralName . ' found in Trash',
            'parent_item_colon' => '',
            'menu_name' => $pluralName
        );
    }

    /**
     * Gets the name of the taxonomy
     *
     * @return string
     * @author Tim Perry
     */
    abstract public function getName();
}