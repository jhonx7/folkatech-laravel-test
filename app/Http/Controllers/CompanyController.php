<?php

namespace App\Http\Controllers;

use App\Models\Companies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Companies::orderByDesc('created_at')->paginate(10);
        return view('companies.index', [
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'logo' => ['nullable', 'image', 'mimes:jpg,png,jpeg,gif', 'dimensions:min_width=100,min_height=100'],
            'email' => ['nullable', 'email'],
            'website' => ['nullable', 'string'],
        ]);

        try {
            $logoFile = $request->file('logo');
            $logo = null;
            if ($logoFile) {
                $logo = $logoFile->storeAS('logo', 'logo-' . time() . '.' . $logoFile->getClientOriginalExtension(), 'public');
            }

            $newCompany = new Companies();
            $newCompany->name = $request->input('name');
            $newCompany->logo = $logo ? $logo : null;
            $newCompany->email = $request->input('email');
            $newCompany->website = $request->input('website');
            $newCompany->save();

            return redirect()->route('company.index')->with('success', 'Company created successfully');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $data = Companies::find($id);
            if (!$data) {
                throw new NotFoundHttpException();
            }

            return view('companies.show', [
                'data' => $data
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $data = Companies::find($id);
            if (!$data) {
                throw new NotFoundHttpException();
            }

            return view('companies.edit', [
                'data' => $data
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required'],
            'logo' => ['nullable', 'image', 'mimes:jpg,png,jpeg,gif', 'dimensions:min_width=100,min_height=100'],
            'email' => ['nullable', 'email'],
            'website' => ['nullable', 'string'],
        ]);
        try {
            $data = Companies::find($id);
            if (!$data) {
                throw new NotFoundHttpException();
            }
            $logoFile = $request->file('logo');
            $logo = null;
            if ($logoFile) {
                $logoPath = "public/logo/" . $data->logo;
                if (Storage::exists($logoPath)) {
                    Storage::delete($logoPath);
                }
                $logo = $logoFile->storeAS('logo', 'logo-' . time() . '.' . $logoFile->getClientOriginalExtension(), 'public');
            }

            $data->name = $request->input('name');
            $data->logo = $logo ? $logo : $data->logo;
            $data->email = $request->input('email');
            $data->website = $request->input('website');
            $data->save();

            return redirect()->route('company.index')->with('success', 'Company updated successfully');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $data = Companies::find($id);
            if (!$data) {
                throw new NotFoundHttpException();
            }
            $data->delete();
            return redirect()->route('company.index')->with('success', 'Company deleted successfully');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
