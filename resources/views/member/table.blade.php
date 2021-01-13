<div class="table-responsive">
    <table class="table table-bordered table-striped">
        <tr>
            <th>Member Id</th>
            <th>Name</th>
            <th>Phone No</th>
            <th></th>
        </tr>
        <tr>
            @foreach ($members as $member)

                <td><a href={{ route('member.show', $member->id) }}>{{ $member->id }}</td>
                <td>{{ $member->name }}</td>
                <td>
                    @if ($member->phone_no != null)
                        {{ $member->phone_no }}
                        <a href="https://api.whatsapp.com/send?phone= {{ $member->phone_no }}" target="blank"><i
                                class="fab fa-whatsapp icon-green"></i></a>
                        <a href="tel:{{ $member->phone_no }}"><i class="fas fa-phone"></i></a>
                    @endif
                </td>
                <td>
                    <div class="row">
                        <div class="d-flex">
                            <a href={{ route('member.show', $member->id) }}><button
                                    class='btn btn-s btn-primary mr-2'>View
                                </button></a>
                        </div>
                        <a href={{ route('member.edit', $member->id) }}><button
                                class='btn btn-primary mr-2'>Edit</button></a>

                        <form action={{ route('member.destroy', $member->id) }} method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" onclick="return confirm('Are you sure?')"
                                type="submit">Delete</button>
                        </form>
                    </div>
                </td>
        </tr>
        @endforeach
    </table>
</div>
