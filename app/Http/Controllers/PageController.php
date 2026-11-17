<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::query()->orderBy('slug')->get();

        return view('admin.pages', compact('pages'));
    }

    public function edit(Page $page)
    {
        return view('admin.editPage', compact('page'));
    }

    public function update(Request $request, Page $page)
    {
        $data = $request->validate([
            'title_az' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'title_ru' => 'required|string|max:255',
            'body_az' => 'nullable|string',
            'body_en' => 'nullable|string',
            'body_ru' => 'nullable|string',
        ]);

        $page->update($data);

        return redirect()
            ->route('pages.index')
            ->with('success', __('Page updated successfully.'));
    }

    public function showPublic(?string $slug = null)
    {
        $slug = $slug ?: request()->route('slug');
        abort_unless($slug, 404);

        $page = Page::findBySlug($slug);
        abort_unless($page, 404);

        return view('page', compact('page'));
    }
}
