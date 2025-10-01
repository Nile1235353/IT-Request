<style>
    /* နှိုင်းယှဉ်ချက်အရ Tailwind CSS ပုံစံဖြင့် ရေးသားထားသည်။ */
    .feedback-card {
        max-width: 500px;
        margin: 40px auto;
        padding: 2rem;
        background-color: #ffffff;
        border-radius: 12px;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        border: 1px solid #e5e7eb;
    }
    .feedback-textarea {
        width: 100%;
        padding: 12px;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        resize: vertical; /* Allow vertical resizing only */
        box-sizing: border-box;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }
    .feedback-textarea:focus {
        border-color: #4f46e5; /* Indigo-600 on focus */
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.2);
        outline: none;
    }
    .submit-btn {
        width: 100%;
        padding: 10px;
        background-color: #4f46e5; /* Indigo-600 */
        color: white;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.15s ease-in-out;
        margin-top: 20px;
    }
    .submit-btn:hover {
        background-color: #4338ca; /* Darker indigo on hover */
    }
</style>



<div class="feedback-card">
    <h3 style="font-size: 1.5rem; font-weight: 700; color: #1f2937; margin-bottom: 1.5rem; text-align: center;">
        Your Feedback is Essential
    </h3>
    <form method="POST" action="{{ route('feedback.submit', $job_id) }}">
        @csrf
        
        <label for="user_feedback" style="display: block; font-size: 0.9rem; color: #4b5563; margin-bottom: 0.5rem;">
            Please provide your feedback on the completed work:
        </label>
        
        <textarea 
            name="user_feedback" 
            id="user_feedback"
            rows="5" 
            class="feedback-textarea" 
            placeholder="Write your feedback here (e.g., The bug was fixed quickly, but the communication could be better)..." 
            required
        ></textarea>
        
        @error('user_feedback')
            <p style="color: #ef4444; font-size: 0.85rem; margin-top: 0.5rem;">{{ $message }}</p>
        @enderror

        <button type="submit" class="submit-btn">
            Submit Feedback & Close Request
        </button>
    </form>
</div>