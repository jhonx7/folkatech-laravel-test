<?php

namespace App\Http\Controllers;

use App\Models\Companies;
use App\Models\Employees;
use App\Models\User;
use App\Notifications\EmployeeCreated;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class EmployeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $companyId)
    {
        try {
            $company = Companies::find($companyId);
            if (!$company) {
                throw new NotFoundHttpException('Company not found');
            }
            $data = Employees::where('companies_id', $companyId)->orderByDesc('created_at')->paginate(10);
            return view('employee.index', [
                'data' => $data,
                'company' => $company
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $companyId)
    {
        try {
            $company = Companies::find($companyId);
            if (!$company) {
                throw new NotFoundHttpException('Company not found');
            }
            return view('employee.create', [
                'company' => $company
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $companyId)
    {
        $request->validate([
            'firstname' => ['required'],
            'lastname' => ['required'],
            'email' => ['nullable', 'email'],
            'phone' => ['nullable', 'string'],
        ]);

        try {
            $company = Companies::find($companyId);
            if (!$company) {
                throw new NotFoundHttpException('Company not found');
            }
            $employee = new Employees();
            $employee->firstname = $request->input('firstname');
            $employee->lastname = $request->input('lastname');
            $employee->email = $request->input('email');
            $employee->phone = $request->input('phone');
            $employee->companies_id = $companyId;
            $employee->save();

            $admin = User::where('email', 'admin@folkatech.com')->first();
            if ($admin) {
                $admin->notify(new EmployeeCreated($employee));
            }
            return redirect()->route('employee.index', ['companyId' => $companyId])->with('success', 'Employee created successfully');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $companyId, string $id)
    {
        try {
            $company = Companies::find($companyId);
            if (!$company) {
                throw new NotFoundHttpException('Company not found');
            }
            $data = Employees::find($id);
            if (!$data) {
                throw new NotFoundHttpException();
            }

            return view('employee.show', [
                'data' => $data
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $companyId, string $id)
    {
        try {
            $company = Companies::find($companyId);
            if (!$company) {
                throw new NotFoundHttpException('Company not found');
            }
            $data = Employees::find($id);
            if (!$data) {
                throw new NotFoundHttpException();
            }

            return view('employee.edit', [
                'data' => $data,
                'company' => $company
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $companyId, string $id)
    {
        $request->validate([
            'firstname' => ['required'],
            'lastname' => ['required'],
            'email' => ['nullable', 'email'],
            'phone' => ['nullable', 'string'],
        ]);

        try {
            $company = Companies::find($companyId);
            if (!$company) {
                throw new NotFoundHttpException('Company not found');
            }
            $data = Employees::find($id);
            if (!$data) {
                throw new NotFoundHttpException();
            }


            $data->firstname = $request->input('firstname');
            $data->lastname = $request->input('lastname');
            $data->email = $request->input('email');
            $data->phone = $request->input('phone');
            $data->save();

            return redirect()->route('employee.index', ['companyId' => $companyId])->with('success', 'Employee updated successfully');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $companyId, string $id)
    {
        try {
            $company = Companies::find($companyId);
            if (!$company) {
                throw new NotFoundHttpException('Company not found');
            }
            $data = Employees::find($id);
            if (!$data) {
                throw new NotFoundHttpException();
            }
            $data->delete();
            return redirect()->route('employee.index', ['companyId' => $companyId])->with('success', 'Employee deleted successfully');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
