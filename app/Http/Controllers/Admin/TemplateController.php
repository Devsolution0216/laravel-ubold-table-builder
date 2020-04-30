<?php

namespace App\Http\Controllers\Admin;

use App\Models\Template;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;

use App\Models\Customer;
use App\Http\Requests\Admin\TemplateRequest;
use File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class TemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('users_manage')) {
            return abort(500);
        }

        $templates = Template::all();

        return view('admin.template.index', compact('templates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::all()->pluck('name', 'id');
        return view('admin.template.create', compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TemplateRequest $request)
    {
        $template = new Template;
        $template->name = $request->input('name');
        $template->col_cnt = $request->input('col_cnt');
        $template->fix_row_cnt = $request->input('fix_row_cnt');
        
        if ($request->input('customer_ids')) {
            $template->customer_ids = ",". implode(",", $request->input('customer_ids')) .",";
        }
        
        $template->save();

        $fields = [];
        for ($i = 1; $i < intval($request->input('col_cnt') + 1); $i++) {
            $col_name = str_replace(' ', '_', $request->input('col_name' . $i));
            $col_type = $request->input('col_type' . $i);
            $col_value = $request->input('col_value' . $i);
            $rows_value = '';
            for ($j = 1; $j < intval($request->input('fix_row_cnt')) + 1; $j++)
            {
                $key = 'row'.$j.'_col'.$i.'_value';
                $row_value = $request->input($key);
                if ($rows_value == '') $rows_value .= $row_value;
                else $rows_value .= ','.$row_value;
            }
            DB::table('template_details')->insert(
                ['template_id' => $template->id
                    , 'name' => $col_name
                    , 'type' => $col_type
                    , 'value' => $col_value
                    , 'rows_value' => $rows_value
                ]
            );
            $field = [];
            $field['type'] = $col_type;
            $field['name'] = $col_name;
            $field['value'] = $col_value;
            array_push($fields, $field);
        }
        //String Text Integer Double Date DateTime Boolean
        $table_name = 'template_'.$template->id;
        Schema::create($table_name, function(Blueprint $table) use ($fields, $table_name)
        {
            $table->increments('id');
            $table->integer('customer_id')->default(0);
            foreach ($fields as $field)
            {
                $col_type = $field['type'];
                $col_name = $field['name'];
                if ($col_type == "Text")
                {
                    $table->longText($col_name)->nullable();
                } else if ($col_type == "Integer")
                {
                    $table->double($col_name)->nullable();
                } else if ($col_type == "Date")
                {
                    $table->date($col_name)->nullable();
                } else if ($col_type == "Time")
                {
                    $table->time($col_name)->nullable();
                } else if ($col_type == "CheckBox")
                {
                    $table->boolean($col_name)->default(0);
                } else if ($col_type == "SelectDown")
                {
                    $table->string($col_name)->nullable();
                }
            }
            $table->timestamps();
        });
        return redirect()->route('admin.templates.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $template = Template::find($id);
        $details = DB::table('template_details')->where('template_id', $id)->orderBy('id')->get();
        return view('admin.template.show', compact('template', 'details'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $template = Template::find($id);
        $template->delete();

        DB::table('template_details')->where('template_id', '=', $id)->delete();
        Schema::dropIfExists('template_'.$id);
    }

    public function edit($id)
    {
        $customers = Customer::all()->pluck('name', 'id');
        $template = Template::find($id);
        $details = DB::table('template_details')->where('template_id', $id)->orderBy('id')->get();
        return view('admin.template.edit', compact('template', 'details', 'customers'));
    }

    public function update(Request $request, $id)
    {
        $template = Template::find($id);
        if ($request->input('customer_ids')) {
            $template->customer_ids = ",". implode(",", $request->input('customer_ids')) .",";
        }

        $template->save();
        return redirect()->route('admin.templates.index');
    }
}
