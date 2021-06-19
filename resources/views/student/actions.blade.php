<div class="row justify-content-center">

@can('edit students')
    <form action={{ route('student.edit', $id)}} method="get">
        @csrf
        <button class="btn btn-sm btn-primary" type="submit">Edit</button>
    </form>
@endcan

@can('delete students')

    <form action={{ route('student.destroy', $id)}} method="post">
        @csrf
        @method('DELETE')
        <button class="btn btn-sm ml-1 btn-danger"  onclick="return confirm('Are you sure?')" type="submit">Delete</button>
    </form>
@endcan

</div>