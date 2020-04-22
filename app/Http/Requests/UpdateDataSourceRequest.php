<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\DataSource;

/**
 * Class UpdateDataSourceRequest
 *
 */
class UpdateDataSourceRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return DataSource::$updateRules;
    }
}
