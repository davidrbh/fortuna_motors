<?php

/**
 * Home Controller
 *
 * Handles homepage functionality.
 *
 * @property Views $views
 */
class Home extends Controllers
{
    /**
     * Constructor method.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Display the homepage.
     *
     * Sets data for the page and loads the corresponding view.
     */
    public function home()
    {
        // Set data for the page
        $data = [
            'page_id' => 1,
            'page_tag' => 'Mini Framework V1.0',
            'page_title' => 'Homepage',
            'page_name' => 'home',
            'page_functions_js' => 'functions_home.js',
        ];


        // Load the view
        $this->views->getView($this, 'home', $data);
    }
}
