<?php


namespace App\Services;


use Illuminate\Support\Str;
use App\Models\Category;

class CategoryService
{
    private $main_category = null;
    private $categories = [];

    public function __construct()
    {
        if(request('parent')) {
            Category::where("slug",request('parent'))->firstOrFail();
            $this->categories[] = $this->main_category = request('parent');
        }

        if(request('child')) {
            Category::where("slug",request('child'))->firstOrFail();
            $this->categories[] = $this->main_category = request('child');
        }

        if(request('grandchild')) {
            Category::where("slug",request('grandchild'))->firstOrFail();
            $this->categories[] =  $this->main_category = request('grandchild');
        }
    }

    public static function filter($request)
    {
        return Category::when($request->name, fn($query) => $query->where("name", "LIKE", "%" . $request->name . "%"))
            ->when($request->filled('status'), fn($query) => $query->where("status", $request->status))
            ->with(['parent', 'user'])
            ->orderBy('name')
            ->paginate(20);
    }

    public function createOrUpdate($request)
    {
        $data = [
            "user_id" => auth()->id(),
            "slug" => Str::slug(request('name')),
        ];

        if ($request->id) {
            $data['rank'] = Category::findOrFail($request->id)->children->max('rank') + 1;
        }

        if ($request->hasFile('photo')) {
            $request->file('photo')->store("categories", "public");
            $data['image'] = $request->file('photo')->hashName();
        }

        Category::updateOrCreate(['id' => $request->id], $request->all() + $data);
    }

    public function sort_children($request)
    {
        \DB::beginTransaction();
        foreach ($request->data as $id => $rank) {
            Category::whereId($id)->update(['rank' => $rank]);
        }
        \DB::commit();

        return true;
    }

    public function getMainCategory()
    {
        return $this->main_category;
    }

    public function getCategories()
    {
        return $this->categories;
    }
}
