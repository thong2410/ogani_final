<?php

namespace App\Libraries\ViewComposers;

use Illuminate\View\View;
use App\Category;

class CategoryComposer
{
    /**
     * Bind data to the view.
     * Bind data vào view. $view->with('ten_key_se_dung_trong_view', $data);
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        // get all category (for demo purpose)
        $categories = Category::whereNull('parent_id')->with('children')->get();
		
	// bind to view
        $view->with('getCategories', $categories);
    }
}