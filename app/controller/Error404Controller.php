<?php

declare(strict_types=1);

load('Controller');

final class Error404Controller extends Controller
{
    public function Error404(): void
    {
        $this->view = 'error-404';
        $this->title = 'Page not found';
        $this->renderLayout();
    }
}
