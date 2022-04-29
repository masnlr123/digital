<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Projects;
use App\Activity;
use App\Campaigns;
use Auth;
use Redirect;
class ProjectController extends Controller
{

    public function index()
    {
        $projects = Projects::all();
        return view('projects.index', compact(array('projects')));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('projects.create');
    }

    public function store(Request $request)
    {
    	$user = Auth::user();
        $store_proejct = new Projects([
			'name' => $request->get('name'),
            'shortcode' => $request->get('shortcode'),
			'project_type' => $request->get('project_type'),
			'launch_date' => $request->get('launch_date'),
			'business_name' => $request->get('business_name'),
			'developer' => $request->get('developer'),
			'gated_community' => $request->get('gated_community'),
			'ownership' => $request->get('ownership'),
			'current_status' => $request->get('current_status'),
			'hand_over_date' => $request->get('hand_over_date'),
			'rera_no' => $request->get('rera_no'),
			'lms' => $request->get('lms'),
			'furnishing_status' => $request->get('furnishing_status'),
			'target_audience' => $request->get('target_audience'),
			'awards' => $request->get('awards'),
			'website' => $request->get('website'),
			'site_address' => $request->get('site_address'),
			'email' => $request->get('email'),
			'acres' => $request->get('acres'),
			'blocks' => $request->get('blocks'),
			'floors' => $request->get('floors'),
			'units' => $request->get('units'),
			'total_floors' => $request->get('total_floors'),
			'product_range' => $request->get('product_range'),
			'amenities' => $request->get('amenities'),
			'top_competitor' => $request->get('top_competitor'),
			'status' => $request->get('status'),
			'created_by' => $user->name
        ]);
        $store_proejct->save();

        $activity_log = new Activity([
            'name' => 'CreateProject',
            'model' => 'Projects',
            'model_id' => $store_proejct->id,
            'description' => 'The Project Has been created!',
            'created_by' => $user->name,
        ]);
        $activity_log->save();
		return Redirect::back()->with('proejct_added','Creative task saved!');
    	// return redirect('/projects')->with('success', 'Creative task saved!');
    }
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $project = Projects::find($id);

        if($request->get('name')) { $project->name= $request->get('name'); }
        if($request->get('shortcode')) { $project->shortcode= $request->get('shortcode'); }
        if($request->get('project_type')) { $project->project_type= $request->get('project_type'); }
        if($request->get('launch_date')) { $project->launch_date= $request->get('launch_date'); }
        if($request->get('business_name')) { $project->business_name= $request->get('business_name'); }
        if($request->get('developer')) { $project->developer= $request->get('developer'); }
        if($request->get('gated_community')) { $project->gated_community= $request->get('gated_community'); }
        if($request->get('ownership')) { $project->ownership= $request->get('ownership'); }
        if($request->get('current_status')) { $project->current_status= $request->get('current_status'); }
        if($request->get('hand_over_date')) { $project->hand_over_date= $request->get('hand_over_date'); }
        if($request->get('rera_no')) { $project->rera_no= $request->get('rera_no'); }
        if($request->get('lms')) { $project->lms= $request->get('lms'); }
        if($request->get('furnishing_status')) { $project->furnishing_status= $request->get('furnishing_status'); }
        if($request->get('target_audience')) { $project->target_audience= $request->get('target_audience'); }
        if($request->get('awards')) { $project->awards= $request->get('awards'); }
        if($request->get('website')) { $project->website= $request->get('website'); }
        if($request->get('site_address')) { $project->site_address= $request->get('site_address'); }
        if($request->get('email')) { $project->email= $request->get('email'); }
        if($request->get('acres')) { $project->acres= $request->get('acres'); }
        if($request->get('blocks')) { $project->blocks= $request->get('blocks'); }
        if($request->get('floors')) { $project->floors= $request->get('floors'); }
        if($request->get('units')) { $project->units= $request->get('units'); }
        if($request->get('total_floors')) { $project->total_floors= $request->get('total_floors'); }
        if($request->get('product_range')) { $project->product_range= $request->get('product_range'); }
        if($request->get('amenities')) { $project->amenities= $request->get('amenities'); }
        if($request->get('top_competitor')) { $project->top_competitor= $request->get('top_competitor'); }
        if($request->get('status')) { $project->status= $request->get('status'); }



        $project->created_by = $user->name;
        $project->save();
        $activity_log = new Activity([
            'name' => 'UpdateProject',
            'model' => 'Projects',
            'model_id' => $project->id,
            'description' => 'The Project Has been Updated!',
            'created_by' => $user->name,
        ]);
        $activity_log->save();

        return response()->json([
            'success' => 'Record has been deleted successfully!'
        ]);
        // return Redirect::back()->with('proejct_added','Creative task saved!');
    }

    public function details($id)
    {
        $user = Auth::user();
        $projects = Projects::find($id);
        $campaigns = Campaigns::where('project', $projects->shortcode);
        // $activity = Activity::where('model', 'CreativeTask')->where('model_id', $creative_task->id)->get();
        return view('projects.details', compact(array('projects', 'user','campaigns')));    
    }
    public function delete($id)
    {
        $projects = Projects::find($id);
        $projects->delete();
        return Redirect::back();    
    }
}
