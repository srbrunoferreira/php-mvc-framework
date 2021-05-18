<?php

declare(strict_types=1);

load('Controller');

final class SiteController extends Controller
{
    public function home(): void
    {
        $this->view = 'home';
        $this->title = 'Home';
        $this->renderLayout();
    }

    public function about(): void
    {
        $this->view = 'about';
        $this->title = 'About';
        $this->renderLayout();
    }

    public function contact(): void
    {
        $this->view = 'contact';
        $this->title = 'Contact';
        $this->renderLayout();
    }

    public function delete(string $string, int $id): void
    {
        $this->view = 'contact';
        $this->title = 'Delete usr';
        $this->renderLayout();
        s('FETCH: ');
        s('string: ' . $string);
        s('id: ' . $id);
    }
}
