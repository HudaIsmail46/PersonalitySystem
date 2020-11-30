@if (!$runnerJob->completed_at && $runnerJob->state != "canceled")
    <div class="row mt-2 ml-0">
        <form action="{{ route('runner_job.complete', $runnerJob->id) }}" method="post">
            @csrf
            @method('PUT')
            <button class="btn btn-success mr-2" type="submit">Complete</button>
        </form>

        <form action="{{ route('runner_job.abort', $runnerJob->id) }}" method="post">
            @csrf
            @method('PUT')
            <button class="btn btn-danger mr-2" type="submit">Unable to complete</button>
        </form>
    </div>
@endif
