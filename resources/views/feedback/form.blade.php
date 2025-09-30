<form method="POST" action="{{ route('feedback.submit', $job_id) }}">
    @csrf
    <textarea name="user_feedback" rows="5" placeholder="Write your feedback..." required></textarea>
    <button type="submit">Submit Feedback</button>
</form>
