<?php

class ProjectNewsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($projectId)
	{
        try{
            $statusCode = 200;
            $response = [
                'projects'  => []
            ];

            $project = Project::findOrFail($projectId);
//            var_dump($newsArray->count(),$newsArray);

            foreach($project->news as $news){
                var_dump($news);
                $response['news'][] = [
                    'id' => $news->id,
                    'title' => $news->title,
                    'description' => $news->description,
                    'text' => $news->text,
                    'created_at' => $news->created_at,
                    'updated_at' => $news->updated_at,
                ];
            }

        }catch (Exception $e){
            $statusCode = 400;
        } finally {
            return Response::make($response, $statusCode);;
        }
//
//        $news = Project::findOrFail($projectId)->news();
//        var_dump($news);exit;
//
//        return Response::make($news, 200);
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
     * @param  int  $projectId
     * @param  int  $newsId
	 * @return Response
	 */
	public function show($projectId, $newsId)
	{
        $news = Project::findOrFail($projectId)->news()->findOrFail($newsId);

        return Response::make($news, 200);
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
