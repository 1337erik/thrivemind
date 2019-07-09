<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Task;

class ManageTaskRequest extends FormRequest
{

    /**
     * Transform the error messages into JSON
     *
     * @param array $errors
     * @return \Illuminate\Http\JsonResponse
     */
    public function response( array $errors )
    {
        return response()->json( $errors, 422 );
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // I'm using a policy gate instead
        return true;

        // could have used the following:
        // return Gate::allows( 'manage_tasks', $this->route( 'task' ) );

        // the reason I chose not to implement that is because I am not using authorization on the 'index' route,
        // however I am using the validation. It is not clunky at all to simply outsource the authorizatiomn to a policy - which I'm using in more places
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

            'title'       => 'sometimes|required',
            'description' => 'nullable',
            'notes'       => 'nullable',
            'due_date'    => 'date',
            'duration'    => 'nullable|numeric'
        ];
    }

    /**
     * 
     * Custom messages for validation
     * 
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'Title is required!',
            'description.required' => 'Description is required!',
            'notes.required' => 'Notes are required!',
        ];
    }

    /**
     * Example of how I can have controller logic in a form request:
     * the advantage of this would be even more removal of the code from the controller... but I dont really like it
     */
    public function persist()
    {
        $this->route( 'task' )->update( $this->validated() );
    }

}
