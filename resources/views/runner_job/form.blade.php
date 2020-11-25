@if (!$runnerJob->completed_at)
    <tr>
        <tfoot>
            <td>
                <form action="{{ route('runner_job.complete', $runnerJob->id) }}" method="post">
                    @csrf
                    @method('PUT')
                <button class="btn btn-success mr-2" type="submit">Complete</button>
                </form>
            </td>
        </tfoot>
    </tr>
@endif
