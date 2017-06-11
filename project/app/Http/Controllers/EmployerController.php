<?php

namespace App\Http\Controllers;

use App\Employer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class EmployerController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function employers()
    {
        return view('employers_list');
    }

    /**
     * view table with employers
     * @return mixed
     */
    public function index()
    {
        return Datatables::of(Employer::query())->addColumn('action', function ($user) {
            if ($user->chief != 0)
                return '<a href="employers/edit-' . $user->id . '" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-pencil"></i></a>
            <a href="employers/view-' . $user->id . '" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-eye-open"></i></a>
            <a href="employers/delete-' . $user->id . '" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-remove"></i></a>';
            else
                return '<a href="employers/view-' . $user->id . '" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-eye-open"></i></a>';
        })->editColumn('chief', function ($user) {
            $chief = $user->parent;
            return $chief["fio"];
        })->make(true);

    }

    /**
     * view concrete employer
     * @param $id
     * @return $this
     */
    public function view_employer($id)
    {
        $employer = Employer::find($id);
        $chief = $employer->parent;

        return view('view_employer')->with([
            'employer' => $employer,
            'chief' => $chief
        ]);
    }

    /**
     * create new employer
     * @return $this
     */
    public function new_employer()
    {
        $chiefs = DB::table('employers')->select('id', 'fio')->get();
        return view('new_employer')->with([
            'chiefs' => $chiefs
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [

            'fio' => 'required|max:60',
            'position' => 'required|max:30',
            'date' => 'required',
            'salary' => 'required|integer',
            'chief' => 'required'

        ]);

        if ($request->hasFile('img_path')) {
            $date = date('d.m.Y');
            $root = $_SERVER['DOCUMENT_ROOT'] . "/project/images/";
            if (!file_exists($root . $date)) {
                mkdir($root . $date);
            }
            $f_name = $request->file('img_path')->getClientOriginalName();
            $request->file('img_path')->move($root . $date, $f_name);
            $all = $request->all();
            $all['img_path'] = "/project/images/" . $date . "/" . $f_name;
            Employer::create($all);
        } else
            Employer::create($request->all());

        return redirect('/employers');

    }

    /**
     * edit employer information
     * @param $id
     * @return $this
     */
    public function edit_employer($id)
    {
        $employer = Employer::find($id);
        $chiefs = DB::table('employers')->select('id', 'fio')->get();
        $chief = $employer->parent;
        return view('edit_employer')->with([
            'chiefs' => $chiefs,
            'employer' => $employer,
            'chief' => $chief,
        ]);
    }

    /**
     * get changing fields
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function edit(Request $request, $id)
    {
        $this->validate($request, [
            'fio' => 'max:60',
            'position' => 'max:30',
            'salary' => 'integer',
        ]);

        $employer = Employer::find($id);
        $data = $request->all();
        if ($request->hasFile('img_path')) {
            $date = date('d.m.Y');
            $root = $_SERVER['DOCUMENT_ROOT'] . "/project/images/";
            if (!file_exists($root . $date)) {
                mkdir($root . $date);
            }
            $f_name = $request->file('img_path')->getClientOriginalName();
            $request->file('img_path')->move($root . $date, $f_name);
            $employer->img_path = "/project/images/" . $date . "/" . $f_name;
        }
        if ($data["fio"])
            $employer->fio = $data["fio"];
        if ($data["position"])
            $employer->position = $data["position"];
        if ($data["date"])
            $employer->date = $data["date"];
        if ($data["salary"])
            $employer->salary = $data["salary"];
        if ($data["chief"])
            $employer->chief = $data["chief"];
        $employer->save();
        return redirect('/employers');
    }

    /**
     * delete employer
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function delete_employer($id)
    {
        $employer = Employer::find($id);
        $chief = $employer->parent;
        foreach ($employer->childs as $arr) {
            $arr->parent()->associate($chief);
            $arr->save();
        }
        $employer->delete();
        return redirect('/employers');
    }
}
