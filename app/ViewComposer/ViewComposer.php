<?php
	namespace App\ViewComposer;
	use App\Models\Admin\Category;
	use App\Models\Admin\Page;
	use App\Models\Admin\Site;
	use App\Models\Admin\Product;
// use App\Models\Client;
use Illuminate\View\View;
	class ViewComposer{
		protected $page =null;
		protected $customer =null;
		protected $website =null;
		protected $category =null;
		protected $product = null;
		public function __construct(Category $category, Page $page, Site $website,Product $product){
			$this->category = $category;
			$this->page = $page;
			$this->website = $website;
			$this->product = $product;
			// $this->customer = $customer;

		}
		public function compose(View $view){

            $frontcategories= $this->category->with('subcategories')->where(['status' => 'Publish', 'show_in_menu' => 1, 'is_parent' => 1])->where('slug', '!=', 'products')->orderBy('show_order', 'ASC')->take(7)->get();
            $productCategories= $this->category->with('subcategories')->where(['status' => 'Publish', 'show_in_menu' => 1, 'is_parent' => 1])->where('slug', '!=', 'products')->orderBy('show_order', 'ASC')->take(9)->get();
            // dd($productCategories);
			$legel_page = $this->page->where(['status' => 'Publish', 'page_type'=> 'legal'])->get();
			$about_page  = $this->page->where(['status' => 'Publish', 'page_name'=> 'about'])->first();
			$listpage = $this->page->where(['status' => 'Publish', 'page_type'=> 'non-article'])->where('page_name', '!=', 'product')->where('page_name', '!=', 'index')->orderBy('order', 'ASC')->get();
			$footer_list =$this->page->where(['status' => 'Publish', 'show_footer' => 'yes'])->where('page_name', '!=', 'index')->orderBy('order', 'ASC')->get();

	        $products = $this->product->where('status', 'Publish')->get();
	        // $customers= $this->customer->where('status', 'Publish')->get();


			$web_detail= $this->website->first();

			$allCategories = Category::where(['status' => 'Publish', 'is_parent' => 1])->orderBy('show_order', 'desc')->paginate(9);
			// dd($allCategories);


			$view->with([
				'frontcategories' => $frontcategories,
				'productCategories' => $productCategories,
			    'legel_page'	=> $legel_page,
				'web_detail'		=> $web_detail,
				'about_page'	=> $about_page,
				'listpage'		=> $listpage,
				'footer_list'	=> $footer_list,
				'products'      => $products,
				// 'customers'      => $customers,
				'allCategories' => $allCategories

			]);
		}
	}
?>
