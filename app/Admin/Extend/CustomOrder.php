<?php

namespace App\Admin\Extend;

use SleepingOwl\Admin\Display\Column\Order;

class CustomOrder extends Order {

    /**
     * @var \Closure|object callable
     */
    protected $queryPreparer;

    /**
     * Set Callback for prepare load options Query.
     *
     * Example:
     * <code>
     * <?php
     * AdminFormElement::select('column', 'Label')
     *     ->modelForOptions(MyModel::class)
     *     ->setLoadOptionsQueryPreparer(function($item, QueryBuilder $query) {
     *         return $query
     *             ->where('column', 'value')
     *             ->were('owner_id', Auth::user()->id)
     *     });
     * ?>
     * </code>
     *
     * @param callable $callback The Callback with $item and $options args.
     * @return $this
     */
    public function setQueryPreparer($callback) {
        $this->queryPreparer = $callback;

        return $this;
    }

    /**
     * Get Callback for prepare load options Query.
     * @return callable
     */
    public function getQueryPreparer() {
        return $this->queryPreparer;
    }

    /**
     * Get models total count.
     * @return int
     */
    protected function totalCount()
    {
        $query = $this->getModelConfiguration()->getRepository()->getQuery();

        // call the pre load options query preparer if has be set
        if (! is_null($preparer = $this->getQueryPreparer())) {
            $query = $preparer($this, $query);
        }

        return $query->count();
    }
}