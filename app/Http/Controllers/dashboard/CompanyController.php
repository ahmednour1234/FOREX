<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Helpers\FileHelper;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::latest()->paginate(20);
        return view('content.companies.index', compact('companies'));
    }

    public function create()
    {
        return view('content.companies.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'title_ar' => 'nullable|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:100',
            'link' => 'nullable|url',
            'image' => 'nullable|image|max:2048',
            'regulation' => 'nullable|string',
            'stars' => 'nullable',
                        'category'=>'nullable'

        ]);

        if ($request->hasFile('image')) {
            $data['image'] = FileHelper::uploadImage($request->file('image'), 'content/companies');
        }

        $data['count_vote'] = 0;
        $data['active'] = true;
        $data['stars'] = $data['stars'] ?? 0;

        Company::create($data);

        return redirect()->route('dashboard.companies.index')->with('success', 'Company created successfully.');
    }

    public function edit(Company $company)
    {
        return view('content.companies.edit', compact('company'));
    }

    public function update(Request $request, Company $company)
    {
        $data = $request->validate([
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'title_ar' => 'nullable|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:100',
            'link' => 'nullable|url',
            'image' => 'nullable|image|max:2048',
            'regulation' => 'nullable|string',
            'stars' => 'nullable',
            'category'=>'nullable'
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = FileHelper::uploadImage($request->file('image'), 'content/companies');
        }

        $company->update($data);

        return redirect()->route('dashboard.companies.index')->with('success', 'Company updated successfully.');
    }

    public function show(Company $company)
    {
        return view('content.companies.show', compact('company'));
    }

    public function activate($id)
    {
        $company = Company::findOrFail($id);
        $company->update(['active' => true]);

        return redirect()->back()->with('success', 'Company activated.');
    }

    public function deactivate($id)
    {
        $company = Company::findOrFail($id);
        $company->update(['active' => false]);

        return redirect()->back()->with('success', 'Company deactivated.');
    }
}
