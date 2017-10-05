<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
class SearchMovieRequest extends Request {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'genre' => array('required'),
            'showing' => array('required', 'regex:/^([01]?[0-9]|2[0-3])\:+[0-5][0-9]$/'),
        ];
    }

    public function messages()
    {
        return [
            'showing.regex' => 'Expected format is 09:30 (hh:mm)',
        ];
    }
    
}
