<table class="table table-bordered table-striped mt-4">
    <tr>
        <th colspan="2">{{$category}}</th>
        <th colspan={{ $scale }} class="w-50">
            <div class="row">
                <div class="mr-auto">
                    Strongly Disagree</div>
                <div class="ml-auto">
                    Strongly Agree</div>
            </div>
        </th>
    </tr>
    <tr>
        <th>No</th>
        <th>Questions</th>
        @for ($i = 1; $i <= $scale; $i++)
            <th>{{ $i }}</th>
        @endfor

    </tr>
    @foreach ($questions as $index => $question)
        @if ($question->question_category == $category)
            <tr>
                <td>{{ $index + 1 }}
                </td>
                <td class="text-left">
                    {{ $question->question_text }}
                </td>
                @for ($i = 1; $i <= $scale; $i++)
                    <td>
                        <div class="form-group">
                            <input class="form-check-input" type="radio"
                                name="questions[{{ $question->id }}]"
                                id="option-{{ $i }}"
                                value="{{ $i }}" @if (old(" questions.$question->id") == $i) checked @endif>

                        </div>
                    </td>
                @endfor
            </tr>
        @endif
    @endforeach

</table>