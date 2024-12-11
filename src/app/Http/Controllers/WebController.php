<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Actions\ActionsSystem;

class WebController extends Controller
{

    public function index() {
        $page                       = new \stdClass();
        $page->{'PopularGames'}     = ActionsSystem::Action('PopularGames');
        $page->{'PopularApps'}      = ActionsSystem::Action('PopularApps');

        $page->{'GamesCategories'}  = ActionsSystem::Action('GamesCategories');
        $page->{'AppsCategories'}   = ActionsSystem::Action('AppsCategories');

        $page->{'PopularDownLoads'} = ActionsSystem::Action('PopularDownLoads');
        $page->{'NewerApps'}        = ActionsSystem::Action('NewerApps');

        $page->{'PopularBlogs'}     = ActionsSystem::Action('PopularBlogs');

        return view('main.index',   ['page' => $page]);
    }

    public function categoriesGames() {
        $page                           = new \stdClass();
        $page->{'mainTitle'}            = 'Игры';
        $page->{'CategoriesList'}       = ActionsSystem::Action('CategoriesList', ['main_url' => 'games']);

        $page->{'Popular'}              = ActionsSystem::Action('PopularGames');
        $page->{'PopularListTile'}      = 'Самые популярные игры';
        $page->{'PopularlistTitleUrl'}  = '/games';
        $page->{'PopularRootUrl'}       = '/games';

        return view('main.categories',  ['page' => $page]);
    }

    public function categoriesApps() {
        $page                           = new \stdClass();
        $page->{'mainTitle'}            = 'Приложения';
        $page->{'CategoriesList'}       = ActionsSystem::Action('CategoriesList', ['main_url' => 'apps']);

        $page->{'Popular'}              = ActionsSystem::Action('PopularApps');
        $page->{'PopularListTile'}      = 'Самые популярные приложения';
        $page->{'PopularlistTitleUrl'}  = '/apps';
        $page->{'PopularRootUrl'}       = '/apps';

        return view('main.categories',  ['page' => $page]);
    }

    private function urlPage(string $main_url, string $url) {
        return ActionsSystem::Action('AppOrCategory', ['main_url' => $main_url, 'url' => $url]);
    }

    public function urlPageGames(string $url) {
        return $this->urlPage('games', $url);
    }

    public function urlPageApps(string $url) {
        return $this->urlPage('apps', $url);
    }

    public function download(string $url) {
        return ActionsSystem::Action('DownloadApp', ['url' => $url]);
    }

    public function search() {
        return ActionsSystem::Action('SearchApp');
    }

    public function blogs() {
        return ActionsSystem::Action('BlogsPage');
    }

    public function blogPage(string $url) {
        return ActionsSystem::Action('BlogPage', ['url' => $url]);
    }

    public function sitemap() {
        return ActionsSystem::Action('GenerateSiteMap');
    }
}
