/**
 * Quiz Logic for the Online Quiz App
 *
 * This script controls the entire quiz-taking experience, including
 * the advanced lifeline features with usage counts.
 * CORRECTED LOGIC: Lifelines are only disabled after an answer is selected.
 */
document.addEventListener('DOMContentLoaded', () => {
    // --- ELEMENT SELECTORS ---
    const quizContainer = document.getElementById('quiz-container');
    if (!quizContainer) return;

    // Quiz elements
    const questionEl = document.getElementById('question');
    const optionsEl = document.getElementById('options');
    const nextBtn = document.getElementById('next-btn');
    const progressTextEl = document.getElementById('progress-text');
    const progressBarFull = document.getElementById('progress-bar-full');
    const scoreEl = document.getElementById('score-value');
    const timerEl = document.getElementById('timer-value');
    const hintBoxEl = document.getElementById('hint-box');

    // Quit Modal elements
    const quitBtn = document.getElementById('quit-btn');
    const quitModal = document.getElementById('quit-modal');
    const modalConfirmBtn = document.getElementById('modal-confirm-btn');
    const modalCancelBtn = document.getElementById('modal-cancel-btn');

    // Lifeline elements
    const lifeline5050Btn = document.getElementById('lifeline-5050');
    const lifelineHintBtn = document.getElementById('lifeline-hint');
    const lifelineTimeBtn = document.getElementById('lifeline-time');
    const lifeline5050CounterEl = document.getElementById('lifeline-5050-counter');
    const lifelineHintCounterEl = document.getElementById('lifeline-hint-counter');
    const lifelineTimeCounterEl = document.getElementById('lifeline-time-counter');

    // --- STATE VARIABLES ---
    const quizId = quizContainer.dataset.quizId;
    let questions = [];
    let currentQuestionIndex = 0;
    let score = 0;
    let timer;
    let timeLeft = 1800; // 10 minutes

    // Lifeline state
    let lifelineCounts = {
        fiftyFifty: 10,
        hint: 10,
        time: 10
    };

    /**
     * Fetches quiz questions from the API
     */
    async function fetchQuestions() {
        try {
            const response = await fetch(`api/get_questions.php?id=${quizId}`);
            if (!response.ok) throw new Error('Network response was not ok');
            const data = await response.json();
            if (data.error) throw new Error(data.error);
            
            questions = data;
            if (questions.length > 0) {
                startQuiz();
            } else {
                quizContainer.innerHTML = '<p class="message error">This quiz has no questions. Please try another.</p>';
            }
        } catch (error) {
            console.error('Error fetching questions:', error);
            quizContainer.innerHTML = `<p class="message error">Failed to load quiz. Please <a href="dashboard.php">go back</a>.</p>`;
        }
    }

    /**
     * Initializes the quiz
     */
    function startQuiz() {
        updateLifelineCounters();
        displayQuestion();
        startTimer();

        nextBtn.addEventListener('click', handleNextQuestion);
        quitBtn.addEventListener('click', showQuitModal);
        modalCancelBtn.addEventListener('click', hideQuitModal);
        modalConfirmBtn.addEventListener('click', () => endQuiz(true));
        
        lifeline5050Btn.addEventListener('click', useFiftyFifty);
        lifelineHintBtn.addEventListener('click', useHint);
        lifelineTimeBtn.addEventListener('click', useTime);
    }

    /**
     * Displays the current question and options
     */
    function displayQuestion() {
        optionsEl.innerHTML = '';
        nextBtn.style.display = 'none';
        hintBoxEl.classList.remove('visible');
        hintBoxEl.textContent = '';

        const currentQuestion = questions[currentQuestionIndex];
        questionEl.textContent = currentQuestion.question_text;

        const options = [currentQuestion.option1, currentQuestion.option2, currentQuestion.option3, currentQuestion.option4];
        options.forEach((option, index) => {
            const optionDiv = document.createElement('div');
            optionDiv.classList.add('option');
            optionDiv.textContent = option;
            optionDiv.dataset.number = index + 1;
            optionDiv.addEventListener('click', selectAnswer);
            optionsEl.appendChild(optionDiv);
        });

        updateProgress();
        disableLifelines(false); // Re-enable lifelines for the new question
    }

    /**
     * Handles answer selection
     */
    function selectAnswer(e) {
        const selectedOption = e.target;
        const correct = parseInt(selectedOption.dataset.number) === parseInt(questions[currentQuestionIndex].correct_answer);

        if (correct) {
            selectedOption.classList.add('correct');
            score++;
            scoreEl.textContent = score;
        } else {
            selectedOption.classList.add('incorrect');
            const correctOptionNumber = questions[currentQuestionIndex].correct_answer;
            const correctOptionEl = optionsEl.querySelector(`[data-number='${correctOptionNumber}']`);
            if (correctOptionEl) correctOptionEl.classList.add('correct');
        }

        Array.from(optionsEl.children).forEach(option => {
            option.removeEventListener('click', selectAnswer);
            option.style.cursor = 'not-allowed';
        });

        // *** CRITICAL FIX: Only disable all lifelines AFTER an answer is chosen.
        disableLifelines(true);

        nextBtn.style.display = 'block';
    }
    
    /**
     * Moves to the next question
     */
    function handleNextQuestion() {
        currentQuestionIndex++;
        if (currentQuestionIndex < questions.length) {
            displayQuestion();
        } else {
            endQuiz();
        }
    }

    // --- LIFELINE FUNCTIONS ---

    function useFiftyFifty() {
        if (lifeline5050Btn.classList.contains('disabled')) return;
        if (lifelineCounts.fiftyFifty <= 0) return;
        
        lifelineCounts.fiftyFifty--;
        updateLifelineCounters();

        const correctOption = questions[currentQuestionIndex].correct_answer;
        const incorrectOptions = [];
        optionsEl.childNodes.forEach(optionNode => {
            if (parseInt(optionNode.dataset.number) !== correctOption) {
                incorrectOptions.push(optionNode);
            }
        });
        
        incorrectOptions.sort(() => Math.random() - 0.5);
        incorrectOptions[0].classList.add('hide');
        incorrectOptions[1].classList.add('hide');
    }

    function useHint() {
        if (lifelineHintBtn.classList.contains('disabled')) return;
        if (lifelineCounts.hint <= 0) return;
        
        lifelineCounts.hint--;
        updateLifelineCounters();
        
        const hintText = questions[currentQuestionIndex].hint;
        hintBoxEl.textContent = hintText || "Sorry, no hint is available for this question.";
        hintBoxEl.classList.add('visible');
    }

    function useTime() {
        if (lifelineTimeBtn.classList.contains('disabled')) return;
        if (lifelineCounts.time <= 0) return;
        
        lifelineCounts.time--;
        updateLifelineCounters();
        
        timeLeft += 15;
    }
    
    function updateLifelineCounters() {
        lifeline5050CounterEl.textContent = lifelineCounts.fiftyFifty;
        lifelineHintCounterEl.textContent = lifelineCounts.hint;
        lifelineTimeCounterEl.textContent = lifelineCounts.time;

        if (lifelineCounts.fiftyFifty <= 0) lifeline5050Btn.classList.add('disabled');
        if (lifelineCounts.hint <= 0) lifelineHintBtn.classList.add('disabled');
        if (lifelineCounts.time <= 0) lifelineTimeBtn.classList.add('disabled');
    }

    function disableLifelines(shouldDisable) {
        const buttons = [lifeline5050Btn, lifelineHintBtn, lifelineTimeBtn];
        if (shouldDisable) {
            buttons.forEach(btn => btn.classList.add('disabled'));
        } else {
            // Re-enable based on remaining counts
            if (lifelineCounts.fiftyFifty > 0) lifeline5050Btn.classList.remove('disabled');
            if (lifelineCounts.hint > 0) lifelineHintBtn.classList.remove('disabled');
            if (lifelineCounts.time > 0) lifelineTimeBtn.classList.remove('disabled');
        }
    }


    // --- UTILITY AND QUIZ FLOW FUNCTIONS ---

    function updateProgress() {
        const progressPercentage = ((currentQuestionIndex + 1) / questions.length) * 100;
        progressBarFull.style.width = `${progressPercentage}%`;
        progressTextEl.textContent = `Question ${currentQuestionIndex + 1} / ${questions.length}`;
    }

    function startTimer() {
        timer = setInterval(() => {
            timeLeft--;
            const minutes = Math.floor(timeLeft / 60);
            const seconds = timeLeft % 60;
            timerEl.textContent = `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;

            if (timeLeft <= 0) {
                clearInterval(timer);
                endQuiz(true);
            }
        }, 1000);
    }
    
    function showQuitModal() {
        quitModal.classList.add('is-visible');
    }
    
    function hideQuitModal() {
        quitModal.classList.remove('is-visible');
    }

    async function endQuiz(forceEnd = false) {
        clearInterval(timer);
        
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = 'result.php';

        const scoreInput = document.createElement('input');
        scoreInput.type = 'hidden';
        scoreInput.name = 'score';
        scoreInput.value = score;
        form.appendChild(scoreInput);

        const totalInput = document.createElement('input');
        totalInput.type = 'hidden';
        totalInput.name = 'total_questions';
        totalInput.value = questions.length;
        form.appendChild(totalInput);

        const quizIdInput = document.createElement('input');
        quizIdInput.type = 'hidden';
        quizIdInput.name = 'quiz_id';
        quizIdInput.value = quizId;
        form.appendChild(quizIdInput);

        document.body.appendChild(form);
        form.submit();
    }

    // --- INITIALIZATION ---
    fetchQuestions();
});
