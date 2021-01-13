@extends ('layouts.app')

@section('title', 'Page Title')

    <title>Member Data</title>

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Members</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Members</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 card">
                    <div class="card-header">
                        <h3 class="mb-0">Member Detail</h3>
                    </div>
                    <div class="card-body">
                        <div class='mt-3 mb-5'>
                            Name: {{ ucwords($member->name) }}<br>
                            @if ($member->phone_no != null)
                                Phone: {{ $member->phone_no }}
                                <a href="https://api.whatsapp.com/send?phone={{ $member->phone_no }}" target="blank"><i
                                        class="fab fa-whatsapp icon-green"></i></a>
                                <a href="tel:{{ $member->phone_no }}"><i class="fas fa-phone"></i></a>
                            @endif
                            <br>
                            {{ ucwords($member->employment_status) }}
                        </div>

                        <div class="row mt-5">
                            <a href="{{ route('member.edit', $member->id) }}" class="btn btn-primary mr-2">Edit</a>

                            <form class='mb-0' action="{{ route('member.destroy', $member->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger mr-2" onclick="return confirm('Are you sure?')"
                                    type="submit">Delete <i class="fa fa-trash"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
