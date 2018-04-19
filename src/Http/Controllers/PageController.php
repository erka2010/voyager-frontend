<?php

namespace Pvtl\VoyagerFrontend\Http\Controllers;

use Pvtl\VoyagerPages\Page;
use Pvtl\VoyagerFrontend\Helpers\Layouts;
use Pvtl\VoyagerFrontend\Traits\Breadcrumbs;
use Illuminate\Http\Request;

class PageController extends \Pvtl\VoyagerPages\Http\Controllers\PageController
{
    use Breadcrumbs;

    protected $viewPath = 'voyager-frontend::modules.pages.default';

    /**
     * POST B(R)EAD - Read data.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     *
     * @return View
     */
    public function edit(Request $request, $id)
    {
        $view = parent::edit($request, $id);

        $view['layouts'] = Layouts::getLayouts('voyager-frontend');

        return $view;
    }


    /**
     * POST - Change Page Layout
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id - the page id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changeLayout(Request $request, $id)
    {
        $page = Page::findOrFail((int)$id);
        $page->layout = $request->layout;
        $page->save();

        return redirect()
            ->back()
            ->with([
                'message' => __('voyager.generic.successfully_updated') . " Page Layout",
                'alert-type' => 'success',
            ]);
    }
}
