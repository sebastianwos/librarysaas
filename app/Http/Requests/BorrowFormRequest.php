<?php

namespace App\Http\Requests;

use App\Book;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class BorrowFormRequest extends FormRequest
{
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
        $book = $this->route()->getParameter('book');
        $bookMaxReturnDate = Carbon::now()->addWeeks($book->period);
        return [
            'return_at' => 'required|date|after:today|before:'.$bookMaxReturnDate->toDateString()
        ];
    }
}
