<?php

/**
 * Error Controller
 *
 * Handles displaying error pages.
 *
 * @property Views $views
 */
class Errors extends Controllers
{
	public function __construct()
	{
		// Call the parent constructor
		parent::__construct();
	}

	/**
	 * Display the "not found" error page.
	 *
	 * Loads the "error" view when a page is not found.
	 */
	public function notFound()
	{
		// Load the "error" view
		$this->views->getView($this, "error");
	}
}

// Create an instance of the Errors controller
$notFound = new Errors();

// Call the notFound method to display the error page
$notFound->notFound();
