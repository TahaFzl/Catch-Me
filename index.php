<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Catch Me — Ultra Cute</title>
<link rel="icon" type="image/png" href="favicon.png">
<style>
body {
    margin: 0;
    height: 100vh;
    overflow: hidden;
    font-family: 'Segoe UI', Roboto, sans-serif;
    background: linear-gradient(-45deg,rgb(0, 0, 0),rgb(16, 0, 0), rgb(39, 39, 39));
    background-size: 600% 600%;
    animation: gradientBG 20s ease infinite;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    color: #fefefe;
}
@keyframes gradientBG {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

#difficulty {
    position: fixed;
    top: 20px;
    left: 50%;
    transform: translateX(-50%);
    padding: 10px 20px;
    border-radius: 30px;
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.3);
    color: #fff;
    font-size: 1em;
    backdrop-filter: blur(12px);
    cursor: pointer;
    transition: all 0.3s ease;
}
#difficulty:hover {
    background: rgba(255, 255, 255, 0.2);
}

#runaway {
    width: 200px;
    height: 200px;
    display: flex;
    align-items: center;
    justify-content: space-evenly;
    border-radius: 50%;
    position: absolute;
    cursor: pointer;
    background: radial-gradient(circle at top, #061161, #780206);
    box-shadow: 0 0 40px rgba(255, 182, 193, 0.8), inset 0 0 20px rgba(255, 255, 255, 0.5);
    border: 2px solid rgba(255, 255, 255, 0.4);
    animation: floatButton 3s ease-in-out infinite;
    transition: all 0.3s ease;
    right: calc(50% - 100px);
    bottom: calc(50% - 100px);
}

@keyframes floatButton {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-15px); }
}

.eye {
    width: 50px;
    height: 50px;
    background: #fff;
    border-radius: 50%;
    position: relative;
    overflow: hidden;
    box-shadow: inset 0 -5px 12px rgba(255, 105, 180, 0.6);
}
.pupil {
    width: 20px;
    height: 20px;
    background: #000;
    border-radius: 50%;
    position: absolute;
    top: 15px;
    left: 15px;
    transition: top 0.1s, left 0.1s;
}
.eye::after {
    content: '';
    width: 8px;
    height: 8px;
    background: #fff;
    border-radius: 50%;
    position: absolute;
    top: 8px;
    left: 8px;
    box-shadow: 2px 2px 5px rgba(255,255,255,0.7);
}

.blush {
    position: absolute;
    bottom: 8px;
    width: 20px;
    height: 10px;
    background: rgba(255, 105, 180, 0.7);
    border-radius: 10px;
    left: 50%;
    transform: translateX(-50%);
    animation: blushGlow 1.5s infinite alternate;
}
@keyframes blushGlow {
    from { opacity: 0.6; transform: translateX(-50%) scale(1); }
    to { opacity: 1; transform: translateX(-50%) scale(1.2); }
}

#speech {
    position: absolute;
    top: -60px;
    font-size: 1.2em;
    padding: 8px 16px;
    background: rgba(0, 0, 0, 0.6);
    color: #fff;
    border-radius: 20px;
    border: 1px solid rgba(255, 255, 255, 0.3);
    backdrop-filter: blur(10px);
}

#stats {
    position: fixed;
    bottom: 20px;
    padding: 12px 24px;
    border-radius: 24px;
    font-size: 0.9em;
    backdrop-filter: blur(16px);
    background: rgba(255,255,255,0.08);
    box-shadow: 0 4px 20px rgba(0,0,0,0.4);
    text-align: center;
}

.modal {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%) scale(0.9);
    opacity: 0;
    background: rgba(20, 20, 20, 0.9);
    border-radius: 24px;
    padding: 40px;
    text-align: center;
    backdrop-filter: blur(20px);
    box-shadow: 0 8px 30px rgba(0,0,0,0.6);
    border: 1px solid rgba(255,255,255,0.2);
    transition: opacity 0.4s ease, transform 0.4s ease;
    pointer-events: none;
}
.modal.show {
    opacity: 1;
    transform: translate(-50%, -50%) scale(1);
    pointer-events: all;
}
.modal h2 {
    font-size: 2em;
    margin-bottom: 20px;
    color: #fff;
}
.modal button {
    padding: 12px 28px;
    font-size: 1em;
    border: none;
    border-radius: 25px;
    cursor: pointer;
    background: rgba(255,255,255,0.1);
    color: #fff;
    transition: background 0.2s, transform 0.2s;
}
.modal button:hover {
    background: rgba(255,255,255,0.2);
    transform: scale(1.05);
}
.confetti {
    position: fixed;
    border-radius: 50%;
    opacity: 0.8;
    animation: fall 3s linear forwards;
}
@keyframes fall {
    to { transform: translateY(100vh) rotate(720deg); opacity: 0; }
}
</style>
</head>
<body>

<select id="difficulty">
    <option value="easy">Easy 🐢</option>
    <option value="medium" selected>Medium ⚡</option>
    <option value="hard">Hard 🔥</option>
</select>

<button id="runaway">
    <div id="speech">Catch me if you can!</div>
    <div class="eye"><div class="pupil"></div><div class="blush"></div></div>
    <div class="eye"><div class="pupil"></div><div class="blush"></div></div>
</button>

<div id="modal" class="modal">
    <h2 id="modalMessage">You Won!</h2>
    <button id="resetButton">Play Again</button>
</div>

<div id="stats">
    <div>Level: <span id="level">1</span></div>
    <div>Time: <span id="timer">0s</span></div>
    <div>Misses: <span id="counter">0</span></div>
    <div>Wins: <span id="wins">0</span></div>
    <div>Best: <span id="bestTime">-</span></div>
</div>

<script>
const button = document.getElementById('runaway');
const pupils = document.querySelectorAll('.pupil');
const speech = document.getElementById('speech');
const modal = document.getElementById('modal');
const modalMessage = document.getElementById('modalMessage');
const resetBtn = document.getElementById('resetButton');
const difficultySelect = document.getElementById('difficulty');
const counterEl = document.getElementById('counter');
const timerEl = document.getElementById('timer');
const winsEl = document.getElementById('wins');
const bestTimeEl = document.getElementById('bestTime');
const levelEl = document.getElementById('level');

let misses = 0, won = false, timer = 0, wins = 0, bestTime = null, level = 1, interval;
let speechShown = true;
let lastMoveTime = 0;
let moveDelay = 600;
let detectDistance = 200;

difficultySelect.addEventListener('change', () => {
    const diff = difficultySelect.value;
    if (diff === 'easy') {
        moveDelay = 2000;
        detectDistance = 400;
    } else if (diff === 'medium') {
        moveDelay = 600;
        detectDistance = 200;
    } else if (diff === 'hard') {
        moveDelay = 100;
        detectDistance = 70;
    }
});

document.addEventListener('mousemove', e => {
    const btnRect = button.getBoundingClientRect();
    const centerX = btnRect.left + btnRect.width / 2;
    const centerY = btnRect.top + btnRect.height / 2;
    const angle = Math.atan2(e.clientY - centerY, e.clientX - centerX);
    const maxMove = 14;
    const offsetX = Math.cos(angle) * maxMove;
    const offsetY = Math.sin(angle) * maxMove;

    pupils.forEach(pupil => {
        pupil.style.left = `${Math.min(22, Math.max(4, 8 + offsetX))}px`;
        pupil.style.top  = `${Math.min(22, Math.max(4, 8 + offsetY))}px`;
    });

    if (won) return;
    const dist = Math.hypot(e.clientX - centerX, e.clientY - centerY);
    if (dist < detectDistance) moveButton();
});

button.addEventListener('mouseenter', moveButton);
button.addEventListener('mousedown', e => { e.preventDefault(); moveButton(); });
button.addEventListener('click', () => {
    won = true;
    modalMessage.textContent = '🎉 You Won!';
    modal.classList.add('show');
    clearInterval(interval);
    button.style.animation = 'none';
    wins++;
    winsEl.textContent = wins;
    if (!bestTime || timer < bestTime) {
        bestTime = timer;
        bestTimeEl.textContent = `${bestTime}s`;
    }
    launchConfetti();
});

resetBtn.addEventListener('click', resetGame);

function moveButton() {
    const now = Date.now();
    if (now - lastMoveTime < moveDelay) return;
    lastMoveTime = now;

    const winW = window.innerWidth, winH = window.innerHeight;
    const randX = Math.random() * (winW - 200);
    const randY = Math.random() * (winH - 200);
    const scale = 0.98 + Math.random() * 0.04;

    button.style.right = `${randX}px`;
    button.style.bottom = `${randY}px`;
    button.style.left = 'auto';
    button.style.top = 'auto';
    button.style.transform = `scale(${scale})`;
    misses++;
    counterEl.textContent = misses;

    if (speechShown) {
        speech.style.display = 'none';
        speechShown = false;
    }

    if (misses % 10 === 0) {
        level++;
        levelEl.textContent = level;
    }
    if (misses >= 50) {
        won = true;
        modalMessage.textContent = '💀 You Lost! Try Again?';
        modal.classList.add('show');
        clearInterval(interval);
        button.style.animation = 'none';
    }
}

function resetGame() {
    misses = 0;
    timer = 0;
    won = false;
    level = 1;
    speechShown = true;
    modal.classList.remove('show');
    speech.style.display = 'block';
    counterEl.textContent = '0';
    timerEl.textContent = '0s';
    levelEl.textContent = '1';
    button.style.right = 'calc(50% - 100px)';
    button.style.bottom = 'calc(50% - 100px)';
    button.style.animation = 'floatButton 3s ease-in-out infinite';
    button.style.transform = 'none';
    startTimer();
}

function startTimer() {
    clearInterval(interval);
    interval = setInterval(() => {
        timer++;
        timerEl.textContent = `${timer}s`;
    }, 1000);
}

function launchConfetti() {
    for (let i = 0; i < 30; i++) {
        const c = document.createElement('div');
        c.classList.add('confetti');
        c.style.background = `hsl(${Math.random() * 360}, 70%, 60%)`;
        c.style.width = `${Math.random() * 6 + 4}px`;
        c.style.height = `${Math.random() * 6 + 4}px`;
        c.style.left = `${Math.random() * window.innerWidth}px`;
        c.style.top = '-10px';
        document.body.appendChild(c);
        setTimeout(() => c.remove(), 3000);
    }
}
startTimer();
</script>

</body>
</html>