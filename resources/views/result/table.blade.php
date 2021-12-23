<div class="table-responsive">
    <table class="table-bordered table mt-2 w-100 ">
        <thead class="thead-light">
        <tr>
            <th rowspan="2">#</th>
            <th rowspan="2">Name</th>
            <th rowspan="2">Faculty</th>
            <th rowspan="2">Year In Progress</th>
            <th colspan="8">Dimension Scores</th>
        </tr>
        <tr>
            @foreach($categories as $category)
            <th>{{$category->name}} </th>
            @endforeach
        
        </tr>
        </thead>
        @foreach($results as $i => $result)
        <tr>
            @if($result->user->student)
            <td>{{$i-1}}</a></td>
            <td class="text-left">{{$result->user->name}} </td>
            <td>{{$result->user->student->faculty ?? ''}}</td>
            <td>{{$result->user->student->year_in_progress ?? ''}}</td>
            <td> 8 </td>
            <td> 7 </td>
            <td> 3 </td>
            <td> 2 </td>
            <td> 8 </td>
            <td> 4 </td>
            <td> 5 </td>
            <td> 9 </td>
            @endif
        </tr>
        @endforeach

    </table>
</div>