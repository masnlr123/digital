<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Attendance;
use Redirect;
use Auth;
use Carbon\Carbon;
// use Request;
use Session;
use App\Exports\ExportAttendance;
use Maatwebsite\Excel\Facades\Excel;

class CrudController extends Controller
{
    public function __construct()
    {
        // parent::__construct();
    }
    public function new(){
        $current_user = Auth::user();
        return view('crud.create', compact(array('current_user')));
    }


    protected function getStub($type)
    {
        return file_get_contents(resource_path("stubs/$type.stub"));
    }

    protected function model($name, $data)
    {
        $table_name  = strtolower($name);
        $table  = "protected \$table = '".$table_name."';";
        $fillable_data = "protected \$fillable = [";
        foreach($data as $key => $col){
            $col_name = mb_strtolower($col['name']);
            $col_name = str_replace(' ', '_', $col_name);
            $fillable_data .= "'".$col_name."',";
        }
        $fillable_data .= "'created_by',";
        $fillable_data .= "'created_at',";
        $fillable_data .= "'deleted_at'";
        $fillable_data .= "];";
        $modelTemplate = str_replace(
            [
                '{{modelName}}',
                '{{tableName}}',
                '{{tableFillable}}',
            ],
            [
                $name,
                $table,
                $fillable_data,
            ],
            $this->getStub('Model')
        );

        file_put_contents(app_path("/Models/{$name}.php"), $modelTemplate);
    }


    protected function controller($name)
    {
        $controllerTemplate = str_replace(
            [
                '{{modelName}}',
                '{{modelNamePluralLowerCase}}',
                '{{modelNameSingularLowerCase}}'
            ],
            [
                $name,
                strtolower(str_plural($name)),
                strtolower($name)
            ],
            $this->getStub('Controller')
        );
        file_put_contents(app_path("/Http/Controllers/Backend/{$name}Controller.php"), $controllerTemplate);
    }

    protected function index($name)
    {
        $indexTemplate = str_replace(
            [
                '{{modelName}}',
                '{{modelNamePluralCase}}',
                '{{modelNameUpperCase}}',
                '{{modelNameUpperCaseFirst}}',
                '{{modelNameSingularLowerCase}}'
            ],
            [
                $name,
                str_plural($name),
                strtoupper($name),
                ucfirst($name),
                strtolower($name)
            ],
            $this->getStub('index')
        );
        $new = strtolower($name);
        $path = resource_path("/views/admin/{$new}");
        mkdir($path, 0777, true);
        file_put_contents(resource_path("/views/backend/{$new}/index.blade.php"), $indexTemplate);
    }

    protected function create($name)
    {
        $createTemplate = str_replace(
            [
                '{{modelName}}',
                '{{modelNamePluralCase}}',
                '{{modelNameUpperCase}}',
                '{{modelNameUpperCaseFirst}}',
                '{{modelNameSingularLowerCase}}'
            ],
            [
                $name,
                str_plural($name),
                strtoupper($name),
                ucfirst($name),
                strtolower($name)
            ],
            $this->getStub('create')
        );
        $new = strtolower($name);
        file_put_contents(resource_path("/views/backend/{$new}/create.blade.php"), $createTemplate);
    }

    protected function edit($name)
    {
        $editTemplate = str_replace(
            [
                '{{modelName}}',
                '{{modelNamePluralCase}}',
                '{{modelNameUpperCase}}',
                '{{modelNameUpperCaseFirst}}',
                '{{modelNameSingularLowerCase}}'
            ],
            [
                $name,
                str_plural($name),
                strtoupper($name),
                ucfirst($name),
                strtolower($name)
            ],
            $this->getStub('edit')
        );
        $new = strtolower($name);
        file_put_contents(resource_path("/views/backend/{$new}/edit.blade.php"), $editTemplate);
    }
    public function proceed()
    {
            $name = $this->argument('name');
            $lower = strtolower($name);
            $this->controller($name);
            $this->model($name);
            $this->index($name);
            $this->create($name);
            $this->edit($name);
            File::append(base_path('routes/web.php'),
         "\n".'/*------------------- Crud Operation For '.$name.' -------------------*/'."\n\n".
        'Route::get(\''.'/admin/'.$lower."/datatables', 'Backend".'\\'."{$name}Controller@datatables')->name('admin-{$lower}-datatables');"."\n".     
        'Route::get(\''.'/admin/'.$lower."', 'Backend".'\\'."{$name}Controller@index')->name('admin-{$lower}-index');"."\n".
        'Route::get(\''.'/admin/'.$lower."/create', 'Backend".'\\'."{$name}Controller@create')->name('admin-{$lower}-create');"."\n".
        'Route::post(\''.'/admin/'.$lower."/create', 'Backend".'\\'."{$name}Controller@store')->name('admin-{$lower}-store');"."\n".
        'Route::get(\''.'/admin/'.$lower."/edit/{id}', 'Backend".'\\'."{$name}Controller@edit')->name('admin-{$lower}-edit');"."\n".
        'Route::post(\''.'/admin/'.$lower."/edit/{id}', 'Backend".'\\'."{$name}Controller@update')->name('admin-{$lower}-update');"."\n".
        'Route::get(\''.'/admin/'.$lower."/delete/{id}', 'Backend".'\\'."{$name}Controller@destroy')->name('admin-{$lower}-delete');"."\n"
        );
    }

    public function action(Request $request)
    {
        $moduleName = $request->get('module_name');
        $modulePluralName = $request->get('module_plural_name');
        $col_list = $request->get('col_list');
        $this->model($moduleName, $col_list);
        // $this->model($moduleName, $col_list);
        return Redirect::back()->with('success', 'CRUD Updated!');
    }

}
