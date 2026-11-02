<?php

namespace App\Http\Controllers;

use App\Support\Insights;
use Illuminate\View\View;

class PageController extends Controller
{
    public function home(Insights $insights): View
    {
        return view('pages.home', [
            'pageLabel' => 'Home',
            'articles' => $insights->featured(9),
        ]);
    }

    public function safety(Insights $insights): View
    {
        return view('pages.safety', [
            'pageLabel' => 'Safety',
            'articles' => $insights->featured(3, 'safety'),
        ]);
    }

    public function research(): View
    {
        return view('pages.research', ['pageLabel' => 'Research']);
    }

    public function company(Insights $insights): View
    {
        return view('pages.company', [
            'pageLabel' => 'Company',
            'articles' => $insights->featured(3, 'company'),
        ]);
    }

    public function careers(): View
    {
        return view('pages.careers', ['pageLabel' => 'Careers']);
    }

    public function privacy(): View
    {
        return view('pages.privacy', ['pageLabel' => 'Privacy Policy']);
    }
}
