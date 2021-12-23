<table class="table table-bordered table-striped mt-4">
    <tr>
        <th colspan="2">{{$category->name}}</th>
        <th colspan={{ $scale }} class="w-50">
            <div class="row">
                <div class="mr-auto">
                    {{$scale_value[0]}}</div>
                <div class="ml-auto">
                    {{$scale_value[$scale -1]}}</div>
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
    @foreach ($questions as $key => $question)
        @if ($question->question_category == $category->id)
            <tr>
                <td>{{ $key + 1 }}
                </td>
                <td class="text-left">
                    {{ $question->question_text }}
                </td>
                @for ($i = 1; $i <= $scale; $i++)
                    <td>
                        <div class="form-group">
                            <input class="form-check-input ml-0" type="radio"
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