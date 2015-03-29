<?php

class ProjectController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        try{
            $statusCode = 200;
            $response = [
                'projects'  => []
            ];

            $projects = Project::where('is_draft',0)->where('is_closed',0)->get();

            foreach($projects as $project){
                $response['projects'][] = [
                    'id' => $project->id,
                    'title' => $project->title,
                    'description' => $project->description,
                    'text' => $project->text,
                    'created_at' => $project->created_at,
                    'updated_at' => $project->updated_at,
                ];
            }

        }catch (Exception $e){
            $statusCode = 400;
        } finally {
            return Response::make($response, $statusCode);;
        }
    }


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        try{
            $statusCode = 200;
            $response = [
                'projects'  => []
            ];

            $project = Project::where('id',$id)->firstOrFail();

            $response['projects'][] = [
                'id' => $project->id,
                'title' => $project->title,
                'description' => $project->description,
                'text' => $project->text,
                'created_at' => $project->created_at,
                'updated_at' => $project->updated_at,
            ];

        }catch (Exception $e){
            $statusCode = 400;
        } finally {
            return Response::make($response, $statusCode);;
        }
    }


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
