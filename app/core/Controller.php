<?php

declare(strict_types=1);

/**
 * [Description Controller]
 */
abstract class Controller
{
    /**
     * @var string
     */
    protected string $title;
    /**
     * @var string
     */
    protected string $description = DEFAULT_DESCRIPTION;
    /**
     * @var string
     */
    protected string $keywords = DEFAULT_KEYWORDS;
    /**
     * @var string
     */
    protected string $robots = DEFAULT_ROBOTS;
    /**
     * @var string
     */
    protected string $canonical = CANONICAL_URL;
    /**
     * @var string
     */
    protected string $view;

    /**
     * This function require the layout.php file that contains the HTML.
     * 
     */
    protected function renderLayout(): void
    {
        require_once APP . '/view/layout.php';
    }

    /**
     * Responsible for importing the div files in the layout.
     * If it is necessary not to import the website template divs as the main header,
     * which is repeated on all pages, just pass the parameter useTemplate as false. By default, this parameter is true.
     * 
     * @param string $divName
     * @param bool $useTemplate
     * 
     */
    protected function add(string $divName, bool $useTemplate = true): void
    {
        $template = APP . '/view/template/' . $divName . '.php';
        $customDiv = APP . '/view/' . $this->view . '/' . $divName . '.php';

        if (file_exists($template) && $useTemplate) {
            require_once $template;
        }
        if (file_exists($customDiv)) {
            require_once $customDiv;
        }
    }

    protected function getTitle(): string
    {
        return $this->title . TITLE_SUFIX;
    }

    protected function getDescription(): string
    {
        return $this->description;
    }

    protected function getKeywords(): string
    {
        return $this->keywords;
    }

    protected function getRobots(): string
    {
        return $this->robots;
    }

    protected function getCanonical(): string
    {
        return $this->canonical;
    }
}
