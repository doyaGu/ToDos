<?php

namespace App\Http\Requests;

use App\Task;
use Illuminate\Validation\Rule;

class TaskEditRequest extends TaskFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rule = parent::rules();

        $status_rule = Rule::in(array_keys(Task::STATUS));

        return $rule + [
                'status' => 'required|' . $status_rule,
            ];
    }
}
