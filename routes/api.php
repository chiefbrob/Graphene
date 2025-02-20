<?php

use Illuminate\Http\Request;

/* Note: All Routes in this file are automatically prepended with /api */
Route::group(['middleware' => ['public.api.auth', 'no.save.session'], 'prefix' => 'public'], function () {

    /* Manage Groups */
    Route::get('/groups','GroupController@list_all_groups');

    //depricate this when old sync turned off
    Route::post('/groups/update/{slug}','GroupController@update_group_by_slug');
    Route::get('/groups/members/{slug?}', 'GroupController@members_by_slug');
    Route::post('/groups/members/{slug?}', 'GroupController@add_members_by_slug');
    Route::delete('/groups/members/{slug?}', 'GroupController@remove_members_by_slug');
    // Route::get('/groups/{group}/members','GroupController@list_members');




    Route::put('/groups/{slug}','GroupController@update_group_by_slug');
    Route::get('/groups/{group}/members','GroupController@list_members')->whereNumber('group');
    Route::get('/groups/{slug}/members', 'GroupController@members_by_slug');


    Route::match(['get','post'],'/apps/search/{type?}','AppController@search');

    Route::get('/reports/{name}/{param1?}','ReportController@run');

    // Return workflow submission by id
    Route::get('/workflows/submissions/{submission}','PublicAPIWorkflowController@get_submission'); 
    // Return all workflow submissions by instance_id
    Route::get('/workflows/instances/{instance}/submissions','PublicAPIWorkflowController@get_all_instance_submissions');
    // Submit a new workflow submission on behalf of user (unique_id), given a workflow instance_id
    // Example: /workflows/instances/92/user/B0012345/state/origin/action/submit
    // POST [data=>[],enforce_permissions=true|false]
    Route::post('/workflows/instances/{workflow_instance}/user/{unique_id}/state/{start_state}/action/{action}','WorkflowSubmissionActionController@api_create')
        ->middleware('validate.user'); // Build User Object from unique_id
    // Update an existing workflow_submission on behalf of user (unique_id), given a workflow sumbission_id
    // PUT [data=>[],comment='']
    Route::put('/workflows/submissions/{workflow_submission}/user/{unique_id}/action/{action}','WorkflowSubmissionActionController@api_action')
        ->middleware('validate.user'); // Build User Object from unique_id

    // Manage users
    Route::post('/users','UserController@create_unique');

    Route::get('/users/{unique_id}','UserController@unique');
    Route::put('/users/{unique_id}','UserController@update_unique');
    Route::get('/users/{unique_id}/groups','UserController@unique_groups');
    Route::put('/users/{unique_id}/groups','UserController@update_unique_groups');
    Route::delete('/users/{unique_id}','UserController@inactivate');

    //look into user deletion as it relates to workflow history - possibly only remove site membership
});
