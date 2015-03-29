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
            return Response::make($response, $statusCode);
        }
    }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        try {
            $statusCode = 200;
            $response = [
                'project'  => []
            ];

            $project = Project::create([
                'title' => Input::get('title'),
                'user_id' => 1,//Auth::user()->first,
                'description' => Input::get('description'),
                'text' => Input::get('text'),
                'is_draft' => Input::get('is_draft'),
                'is_closed' => Input::get('is_closed')
            ]);

            if ($project) {
                $response['project'][] = [
                    'id' => $project->id,
                    'title' => $project->title,
                    'description' => $project->description,
                    'text' => $project->text,
                    'created_at' => $project->created_at,
                    'updated_at' => $project->updated_at,
                ];
                $response['status'] = 'ok';
            } else {
                $response['status'] = 'error';
            }

        } catch (Exception $e) {
            $statusCode = 400;
        } finally {
            return Response::make($response, $statusCode);
        }

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

            $project = Project::findOrFail($id);

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
            return Response::make($response, $statusCode);
        }
    }

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        try{
            $statusCode = 200;
            $response = [
                'projects'  => [],
                'status' => 'save_error'
            ];
            $project = Project::findOrFail($id);

            $project->title = Input::get('title',$project->title);
            $project->description = Input::get('description',$project->description);
            $project->text = Input::get('text',$project->text);
            $project->is_draw = Input::get('is_draw',$project->is_draw);
            $project->is_closed = Input::get('is_closed',$project->is_closed);

            if ($project->save()) {
                $response['status'] = 'save_error';
            }

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
            return Response::make($response, $statusCode);
        }
    }


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        {
            try{
                $statusCode = 200;
                $response = [
                    'status'  => 'ok'
                ];

                $project = Project::findOrFail($id);

                $project->delete();
                $response['status'] = 'ok';

            }catch (Exception $e){
                $statusCode = 400;
                $response['status'] = 'error';
            } finally {
                return Response::make($response, $statusCode);
            }
        }
    }
}
