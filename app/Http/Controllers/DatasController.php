<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Template;
use App\User;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DatasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::all();

        return view('datas.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($customerId, $templateId)
    {
        $details = DB::table('template_details')->where('template_id', $templateId)->orderBy('id', 'asc')->get();
        return view('datas.create', compact('details', 'customerId', 'templateId'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $customerId, $templateId)
    {
        $datas = $request->all();
        unset($datas['_token']);
        $datas = [ "customer_id" => $customerId ] + $datas;
        
        $checks = DB::table('template_details')->where('template_id', $templateId)->where('type', 'CheckBox')->get();
        foreach ($checks as $check){
            if (array_key_exists($check->name, $datas)){
                $datas[$check->name] = 1;
            }else{
                $datas += [$check->name => 0];
            }
        }

        DB::table('template_' . $templateId)->insert(
            $datas
        );
        return redirect(url('/datas'))
            ->with('customerId', $customerId)
            ->with('templateId', $templateId);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $customerId, $templateId)
    {
        $data = DB::table('template_' . $templateId)->find($id);        
        $details = DB::table('template_details')->where('template_id', $templateId)->orderBy('id', 'asc')->get();

        return view('datas.edit', compact('details', 'customerId', 'templateId', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $customerId, $templateId)
    {
        $datas = $request->all();

        unset($datas['_token']);


        $checks = DB::table('template_details')->where('template_id', $templateId)->where('type', 'CheckBox')->get();
        foreach ($checks as $check){
            if (array_key_exists($check->name, $datas)){
                $datas[$check->name] = 1;
            }else{
                $datas += [$check->name => 0];
            }
        }


        DB::table('template_' . $templateId)->where('id', $id)->update(
            $datas
        );

        return redirect(url('/datas'))
            ->with('customerId', $customerId)
            ->with('templateId', $templateId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $templateId)
    {
        DB::table('template_' . $templateId)->where('id', $id)->delete();
    }

    public function getDetails($customerId, $templateId)
    {
        $details = DB::table('template_details')->where('template_id', $templateId)->orderBy('id', 'asc')->get();
        $datas = DB::select("SELECT * FROM template_" . $templateId ." WHERE customer_id = ". $customerId ." ORDER BY id ASC");
        $htmlTable = '<table id="dataTable" class="table dt-responsive table-striped nowrap dataTable no-footer">';
        $htmlHeader = '<thead><tr><th>#</th>';
        $htmlBody = '<tbody>';

        $htmlFixRows = '';

        foreach ($details as $detail){
            $htmlHeader .= '<th>'. $detail->name .'</th>';
        }

        for ($ix = 0; $ix < Template::find($templateId)->fix_row_cnt; $ix ++){
            $htmlFixRows .= '<tr><td></td>';
            foreach ($details as $detail){
                $col_fixRows = explode(',', $detail->rows_value);

                $htmlFixRows .= '<td>'. $col_fixRows[$ix] .'</td>';
            }
            $htmlFixRows .= '<td></td></tr>';
        }

        $htmlHeader .= '<th>'. __('templates.action') .'</th></tr></thead>';
        $index = 1;
        $htmlBody .= $htmlFixRows;
        foreach ($datas as $data){
            $htmlBody .= '<tr data-entry-id="'. $data->id .'"><td>'. $index .'</td>';

            foreach ($details as $detail){
                $name = $detail->name;
                $htmlBody .= '<td>'. $data->$name .'</td>';
            }


            $htmlBody .= '<td>
                <a href="'. url('/datas/'. $data->id .'/edit/'. $customerId . '/' . $templateId) .'" class="btn btn-warning btn-xs waves-effect waves-light"><i class="mdi mdi-square-edit-outline"></i>'. __('templates.edit') .'</a>
                <button type="button" class="btn btn-danger btn-xs waves-effect waves-light" onclick="del('. $data->id .')"><i class="mdi mdi-delete"></i>'. __('templates.delete') .'</button>
            </td></tr>';
            $index ++;
        }
        $htmlBody .= '</tbody>';
        $htmlTable .= $htmlHeader . $htmlBody . '</table>';
        return $htmlTable;
    }

    public function getTemplates($customerId){
        if ($customerId == 0)
            $templates = Template::all();
        else
            $templates = Template::where('customer_ids', 'LIKE', '%,'. $customerId .',%')->get();

        return $templates;
    }

    public function saveDefault(Request $request){
        $userId = Auth()->user()->id;
        $templateId = $request->templateId;
        $user = User::find($userId);
        $user->default_table = $templateId;
        $user->save();
        return "Success";
    }

    public function hdata(Request $request){
        $api_key = $request->api_key;
        $table_name = $request->table;
        
        $customer = Customer::where('api_key', $api_key)->first();
        $table = Template::where('name', $table_name)->first();

        if(!is_null($customer) && !is_null($table)){
            $customer_id = $customer->id;
            $table_id = $table->id;
            echo($this->getData($customer_id, $table_id));
        }
    }

    public function getData($customerId, $templateId)
    {
        $details = DB::table('template_details')->where('template_id', $templateId)->orderBy('id', 'asc')->get();
        $datas = DB::select("SELECT * FROM template_" . $templateId ." WHERE customer_id = ". $customerId ." ORDER BY id ASC");

        $html = '<!DOCTYPE html>
            <html>
            <head>
            <style>
                table {
                    margin-top: 50px;
                    border-collapse: collapse;
                    width: 100%;
                }
                th, td {
                    text-align: left;
                    padding: 8px;
                }
                tr:nth-child(even){
                    background-color: #f2f2f2
                }
                th {
                    background-color: #4CAF50;
                    color: white;
                }
            </style>
            </head>
            <body>';
        $htmlTable = '<table id="dataTable" class="table dt-responsive table-striped nowrap dataTable no-footer">';
        $htmlHeader = '<thead><tr><th>#</th>';
        $htmlBody = '<tbody>';

        $htmlFixRows = '';

        foreach ($details as $detail){
            $htmlHeader .= '<th>'. $detail->name .'</th>';
        }

        for ($ix = 0; $ix < Template::find($templateId)->fix_row_cnt; $ix ++){
            $htmlFixRows .= '<tr><td></td>';
            foreach ($details as $detail){
                $col_fixRows = explode(',', $detail->rows_value);

                $htmlFixRows .= '<td>'. $col_fixRows[$ix] .'</td>';
            }
            $htmlFixRows .= '<td></td></tr>';
        }

        $htmlHeader .= '</tr></thead>';
        $index = 1;
        $htmlBody .= $htmlFixRows;
        foreach ($datas as $data){
            $htmlBody .= '<tr data-entry-id="'. $data->id .'"><td>'. $index .'</td>';

            foreach ($details as $detail){
                $name = $detail->name;
                $htmlBody .= '<td>'. $data->$name .'</td>';
            }

            $index ++;
        }
        $htmlBody .= '</tbody>';
        $htmlTable .= $htmlHeader . $htmlBody . '</table>';
        $html .= $htmlTable . '</body></html>';
        return $html;
    }
}
