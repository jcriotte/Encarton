<?php

namespace App\Model;

/**
 * Music Story Objects Iterator Class
 */
class MusicStoryObjects implements \Iterator
{

    /**
     * Current item key
     * @var int
     */
    private $position;

    /**
     * Number of pages
     * @var int
     */
    private $page_count;

    /**
     * Number of items per page
     * @var int
     */
    private $count;

    /**
     * Current page
     * @var int
     */
    private $current_page;

    /**
     * MusicStoryObjects list
     * @var array
     */
    private $data;

    /**
     * Constructor
     * @param array $items Music Story objects
     * @param int $count Number of items per page
     * @param int $page_count Number of pages
     * @param type $current_page Current page
     */
    public function __construct($items, $count, $page_count, $current_page)
    {
        $this->data = $items;
        $this->count = $count;
        $this->page_count = $page_count;
        $this->current_page = $current_page;
        $this->position = 0;
    }

    /**
     * Get the result count
     * @return integer
     */
    public function size()
    {
        return $this->count;
    }

    /**
     * Check existence of next page
     * @return boolean
     */
    public function hasNextPage()
    {
        return ($this->current_page < $this->page_count);
    }

    /**
     * Check existence of previous page
     * @return boolean
     */
    public function hasPrevPage()
    {
        return ($this->current_page > 1);
    }

    /**
     * Rewind iterator
     */
    public function rewind()
    {
        $this->position = 0;
    }

    /**
     * Get current MusicStoryObject
     * @return MusicStoryObject
     */
    public function current()
    {
        return isset($this->data[$this->position]) ? $this->data[$this->position] : null;
    }

    /**
     * Get current MusicStoryObject key
     * @return int
     */
    public function key()
    {
        return $this->position;
    }

    /**
     * Increment iterator position
     */
    public function next()
    {
        ++$this->position;
    }

    /**
     * Decrement iterator position
     */
    public function prev()
    {
        --$this->position;
    }

    /**
     * Check existence of current Object
     * @return boolean
     */
    public function valid()
    {
        return isset($this->data[$this->position]);
    }

    /**
     * Check existence of next Object
     * @return boolean
     */
    public function hasNext()
    {
        return isset($this->data[$this->position + 1]);
    }

    /**
     * Check existence of previous Object
     * @return boolean
     */
    public function hasPrev()
    {
        return isset($this->data[$this->position - 1]);
    }
}
